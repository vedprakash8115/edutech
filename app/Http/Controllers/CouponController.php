<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CouponTargetProduct;
use App\Models\Elibrary;
use App\Models\Test;
use App\Models\VideoCourse;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\liveClass;
// use App\Models\liveClass;
use RealRashid\SweetAlert\Facades\Alert;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('marketing.coupon.index' , compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marketing.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'user_type' => 'required|string',
            'coupon_code' => 'required|string|unique:coupons,coupon_code',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after:start_date',
            'discount_type' => 'required|string',
            'product_type' => 'required|string',
            'inspirant_applicant' => 'required|string',
            'fixed_amount' => 'nullable|numeric|required_if:discount_type,fixed',
            'percentage' => 'nullable|numeric|required_if:discount_type,percentage|max:100',
            // Assuming products table
        ]);
    
        // Create the coupon
        $coupon = Coupon::create($validatedData);
    
        // Store the target products if any
        if (!empty($request->target_product_id)) {
            foreach ($request->target_product_id as $targetProductId) {
                CouponTargetProduct::create([
                    'coupon_id' => $coupon->id,
                    'target_product_id' => $targetProductId,
                ]);
            }
        }
    
        // Apply discount based on the product type
        foreach ($request->input('target_product_id', []) as $pid) {
            switch ($request->product_type) {
                case 'live_content':
                    $data = LiveClass::find($pid);
                    break;
                case 'video_content':
                    $data = VideoCourse::find($pid);
                    break;
                case 'elibrary_content':
                    $data = Elibrary::find($pid);
                    break;
                case 'bundle_content':
                    $data = Book::find($pid);
                    break;
                default:
                    return response()->json(['error' => 'Invalid product type'], 400);
            }
    
            if ($data) {
                // Apply the discount based on discount type
                if ($request->discount_type == 'fixed' && isset($request->fixed_amount)) {
                    $data->discount_price = max(0, $data->price - $request->fixed_amount);
                } elseif ($request->discount_type == 'percentage' && isset($request->percentage)) {
                    $data->discount_price = max(0, $data->price - ($request->percentage / 100) * $data->price);
                }
                $data->save();
            }
        }
    
        return back()->with('success', 'Coupon created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $single_data = Coupon::findOrFail($id);

        // // Get target product IDs associated with the coupon
        // $targetProducts = CouponTargetProduct::where('coupon_id', $single_data->id)
        //                                      ->pluck('target_product_id') // Get only the target_product_id values
        //                                      ->toArray(); // Convert the collection to an array
    
        // // Add target product IDs to single_data with the key 'target_product_data'
        // $single_data->target_product_id = $targetProducts;
        // dd($targetProducts);
        return view('marketing.coupon.create' , compact('single_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Fetch existing target products for the coupon
        $existingTargetProducts = CouponTargetProduct::where('coupon_id', $id)->get();
    
        // Validate input data
        $validatedData = $request->validate([
            'user_type' => 'required|string',
            'coupon_code' => 'required|string|unique:coupons,coupon_code,' . $id,
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after:start_date',
            'discount_type' => 'required|string',
            'product_type' => 'required|string',
            'inspirant_applicant' => 'required|string',
            'fixed_amount' => 'nullable|numeric|required_if:discount_type,fixed',
            'percentage' => 'nullable|numeric|required_if:discount_type,percentage|max:100',
        ]);
    
        // Find the coupon by ID
        $coupon = Coupon::findOrFail($id);
        $coupon->update($validatedData);
    
        // Update target products if new ones are provided
        $this->updateTargetProducts($request->target_product_id, $coupon->id);
    
        // Determine which products to apply discounts on
        $targetProductIds = $request->target_product_id ?? $existingTargetProducts->pluck('target_product_id')->toArray();
        $this->applyDiscounts($targetProductIds, $request->product_type, $request->discount_type, $request->fixed_amount, $request->percentage);
    
        return redirect()->back()->with('success', 'Coupon updated successfully.');
    }
    
    /**
     * Update the associated target products for a coupon.
     *
     * @param array|null $targetProductIds
     * @param int $couponId
     */
    protected function updateTargetProducts(?array $targetProductIds, int $couponId)
    {
        if (!empty($targetProductIds)) {
            // Remove existing associated target products
            CouponTargetProduct::where('coupon_id', $couponId)->delete();
    
            // Add new target products
            foreach ($targetProductIds as $targetProductId) {
                CouponTargetProduct::create([
                    'coupon_id' => $couponId,
                    'target_product_id' => $targetProductId,
                ]);
            }
        }
    }
    
    /**
     * Apply discounts to the specified products based on the discount type.
     *
     * @param array $productIds
     * @param string $productType
     * @param string $discountType
     * @param float|null $fixedAmount
     * @param float|null $percentage
     */
    protected function applyDiscounts(array $productIds, string $productType, string $discountType, ?float $fixedAmount, ?float $percentage)
    {
        foreach ($productIds as $pid) {
            $data = $this->getProductByType($productType, $pid);
    
            if ($data) {
                // Apply the discount based on discount type
                if ($discountType === 'fixed' && isset($fixedAmount)) {
                    $data->discount_price = max(0, $data->price - $fixedAmount);
                } elseif ($discountType === 'percentage' && isset($percentage)) {
                    $data->discount_price = max(0, $data->price - ($percentage / 100) * $data->price);
                }
                $data->save();
            }
        }
    }
    
    /**
     * Get product data by its type.
     *
     * @param string $productType
     * @param int $productId
     * @return mixed
     */
    protected function getProductByType(string $productType, int $productId)
    {
        switch ($productType) {
            case 'live_content':
                return LiveClass::find($productId);
            case 'video_content':
                return VideoCourse::find($productId);
            case 'elibrary_content':
                return Elibrary::find($productId);
            case 'bundle_content':
                return Book::find($productId);
            default:
                return null;
        }
    }
    
    
    
    

    /**
     * Remove the specified resource from storage.
     */public function destroy($id)
{
    // Find the coupon by ID
    $coupon = Coupon::findOrFail($id);

    // Delete associated target products
    CouponTargetProduct::where('coupon_id', $coupon->id)->delete();

    // Delete the coupon
    $coupon->delete();

    return redirect()->back()->with('success', 'Coupon deleted successfully.');
}

    // CouponController.php
    public function getLiveClasses($id)
    {
        switch ($id) {
            case 1:
                $data = LiveClass::all();
                break;
            case 2:
                $data = VideoCourse::all(); // Assuming VideoCourse is your model
                break;
            case 3:
                $data = Test::all(); // Assuming MockTest is your model
                break;
            case 4:
                $data = Elibrary::all(); // Assuming ELibrary is your model
                break;
            case 5:
                $data = Book::all(); // Assuming Book is your model
                break;
            default:
                return response()->json(['error' => 'Invalid ID'], 400);
        }
        
        return response()->json($data);
    }
    

}
