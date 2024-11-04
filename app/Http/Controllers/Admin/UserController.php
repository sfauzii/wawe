<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create user')->only(['create', 'store']);
        $this->middleware('check.permission:view user')->only('index');
        $this->middleware('check.permission:edit user')->only(['edit', 'update']);
        $this->middleware('check.permission:delete user')->only(['destroy']);
    }
    public function index()
    {
        $users = User::all();

        return view('pages.admin.user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('pages.admin.user.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Menambahkan validasi untuk field photos
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.create')->withErrors($validator)->withInput();
        }

        // $path = $request->file('photos') ? $request->file('photos')->store('public/photos') : null; // Menyimpan file photo jika ada

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            // 'photos' => $path, // Menambahkan path photo ke dalam database
        ]);

        $user->roles()->detach();

        $user->roles()->attach($request->roles);

        // Session::flash('success', 'User created successfully.');
        Alert::success('Success', 'User created successfully.');

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail(decrypt($id));

        return view('pages.admin.user.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // $user = User::findOrFail(decrypt($id));

        $roles = Role::pluck('name', 'id')->all();

        $userRoles = $user->roles()->pluck('id')->toArray();

        return view('pages.admin.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail(decrypt($id));

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            // 'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Menambahkan validasi untuk field photos
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);


        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->roles()->detach();
        $user->roles()->attach($request->roles);


        // if ($validator->fails()) {
        //     return redirect()->route('user.edit', $id)->withErrors($validator)->withInput();
        // }

        // $userData = [
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'email' => $request->email,
        // ];

        // if ($request->password) {
        //     $userData['password'] = bcrypt($request->password);
        // }

        // $path = $request->file('photos') ? $request->file('photos')->store('public/photos') : $user->photos; // Menyimpan file photo jika ada atau menggunakan yang lama

        // $userData['photos'] = $path;

        // DB::transaction(function () use ($user, $userData, $request) {
        //     $user->update($userData);

        //     if ($request->has('roles')) {
        //         $user->roles = $request->roles; // Update roles directly
        //         $user->save();
        //     } else {
        //         $user->roles = 'USER'; // Set default role if no roles are provided
        //         $user->save();
        //     }
        // });

        // Session::flash('success', 'User updated successfully.');
        Alert::success('Success', 'User has been updated successfully');

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail(decrypt($id));
        $user->delete();

        // Flash a success message to the session
        // Session::flash('success', 'User deleted successfully.');
        Alert::success('Success', 'User has been deleted successfully');

        return redirect()->route('user.index');
    }
}
