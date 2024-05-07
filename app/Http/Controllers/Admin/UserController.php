<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('pages.admin.user.create');
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
            'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Menambahkan validasi untuk field photos
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.create')->withErrors($validator)->withInput();
        }

        $path = $request->file('photos') ? $request->file('photos')->store('public/photos') : null; // Menyimpan file photo jika ada

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'photos' => $path, // Menambahkan path photo ke dalam database
        ]);

        Session::flash('success', 'User created successfully.');

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
    public function edit(string $id)
    {
        $user = User::findOrFail(decrypt($id));

        return view('pages.admin.user.edit', [
            'user' => $user,
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
            'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Menambahkan validasi untuk field photos
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.edit', $id)->withErrors($validator)->withInput();
        }

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->password) {
            $userData['password'] = bcrypt($request->password);
        }

        $path = $request->file('photos') ? $request->file('photos')->store('public/photos') : $user->photos; // Menyimpan file photo jika ada atau menggunakan yang lama

        $userData['photos'] = $path;

        DB::transaction(function () use ($user, $userData, $request) {
            $user->update($userData);

            if ($request->has('roles')) {
                $user->roles = $request->roles; // Update roles directly
                $user->save();
            } else {
                $user->roles = 'USER'; // Set default role if no roles are provided
                $user->save();
            }
        });

        Session::flash('success', 'User updated successfully.');

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
        Session::flash('success', 'User deleted successfully.');

        return redirect()->route('user.index');
    }
}
