<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponTargetProduct extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'coupon_target_products';
    protected $primaryKey = 'id';

    public function targetProducts()
    {
        return $this->belongsToMany(Coupon::class);
    }
}
