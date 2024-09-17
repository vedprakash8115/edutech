<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $role = Role::orderBy('id', 'DESC')->paginate(5);
        return view('role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        $data = [];
        foreach ($permissions as $permission) {
            $temp = explode('.', $permission->name);
            if (!isset($data[$temp[0]])) {
                $data[$temp[0]] = [];
            }
            $name = '';
            for ($i = 0; $i < count($temp); $i++) {
                $namePart = str_replace('_', ' ', $temp[$i]);
                $name .= $namePart;
                if ($i < count($temp) - 1) {
                    $name .= ' ';
                }
            }
            $data[$temp[0]][] = (object)['name' => $name, 'id' => $permission->id];
        }
        $dataArray = $data;



        return view('role.create', compact('dataArray','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array',
        ]);
        $role = Role::create(['name' => $request->input('name')]);

        $permissionNames = $request->input('permission');
        $permissions = Permission::whereIn('id', $permissionNames)->pluck('id');
        $role->syncPermissions($permissions);

        Alert::toast('Role created successfully', 'success');
        return redirect()->route('roles.index');
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
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $permissionNames = $request->input('permissions');
        if (!empty($permissionNames)) {
            $validPermissions = Permission::whereIn('id', $permissionNames)->pluck('id');
            $role->syncPermissions($validPermissions);
        } else {
            $role->syncPermissions([]);
        }
        Alert::toast('Role Updated successfully', 'success');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
