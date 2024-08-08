<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::with(['roles', 'users'])->get();
        return view('pages.admin.roles-permissions.permission.index', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.roles-permissions.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','unique:permissions,name']
        ]);
        
        Permission::create([
            'name' => $request->name
        ]);

        Alert::success('Success', 'Permission was successfully created');

        return redirect()->route('permissions.index');
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
    public function edit(Permission $permission)

    {
        return view('pages.admin.roles-permissions.permission.edit', [
            'permission' => $permission
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name,' . $permission->id],
        ]);

        $permission->update([
            'name'=> $request->name
        ]);

        Alert::success('Success', 'Permission was successfully updated');

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find( $id );
        if($permission) {
            $permission->delete();
            Alert::success('Success','Permission deleted successfully');
        }else {
            Alert::error('Error','Permission not found');
        }

        return redirect()->route('permissions.index');
    }
}
