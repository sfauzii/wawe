<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{

    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('permission:create role')->only(['create', 'store']);
        $this->middleware('permission:edit role')->only(['edit', 'update']);
        $this->middleware('permission:delete role')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $roles = Role::get();
        // return view('pages.admin.roles-permissions.role.index', [
        //     'roles' => $roles,
        // ]);

        $roles = Role::with(['users' => function ($query) {
            $query->select('id', 'name', 'photo'); // Adjust this based on your user model attributes
        }])->withCount('users')->get();


        return view('pages.admin.roles-permissions.role.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.roles-permissions.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name'],
        ]);

        Role::create([
            'name' => $request->name
        ]);

        Alert::success('Success', 'Role created successfully');

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
    public function edit(Role $role)
    {
        return view('pages.admin.roles-permissions.role.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)

    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,' . $role->id],
        ]);

        $role->update([
            'name' => $request->name
        ]);

        Alert::success('Success', 'Role updated successfully');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();

        Alert::success('Success', 'Role deleted successfully');

        return redirect()->route('roles.index');
    }

    public function addPermissionsToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('pages.admin.roles-permissions.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function givePermissionsToRole(Request $request, $roleId)
    {

        $request->validate([
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($roleId);
        $permissions = Permission::whereIn('id', $request->permission)->get();
        $role->syncPermissions($permissions);

        Alert::success('Success', 'Permissions added to role');

        return redirect()->back();
    }
}
