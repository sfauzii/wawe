<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.users.settings.my-profile.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {   
        $user = Auth::user();

        // Custom validation rules
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z0-9_]+$/',
                Rule::unique('users')->ignore($user->id),
            ],
            'photo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'username.unique' => 'Username must be unique',
            'username.regex' => 'Username must not contain spaces and can only include letters, numbers, and underscores.',
        ]);

        if ($validator->fails()) {
            // Check for the validation errors and display appropriate alerts
            if ($validator->errors()->has('username')) {
                if ($validator->errors()->first('username') == 'Username must be unique') {
                    Alert::error('Error', 'Username already taken, please choose another one.');
                } elseif ($validator->errors()->first('username') == 'Username must not contain spaces and can only include letters, numbers, and underscores.') {
                    Alert::error('Error', 'Username must not contain spaces and can only include letters, numbers, and underscores.');
                }
            }
    
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle the photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile', 'public');

            if ($photoPath && $user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->photo = $photoPath;
        }

        $user->update($request->except('photo'));

        Alert::success('Success', 'Profile updated successfully');

        return redirect()->route('edit-profile', ['id' => $user->id]);
    }

    public function editPassword($id) {

        $user = User::findOrFail($id);

        return view('pages.users.settings.my-password.edit-password');
    }

    public function updatePassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'different:old_password',
            ],
            'confirm_password' => 'required|string|same:new_password',
        ]);

        if($validator->fails()) {

            $messages = $validator->errors()->all();
            $alertMessage = implode(' ', $messages);

            Alert::error('Validation Error', $alertMessage);

            return redirect()->back()->withInput();
        }

        $user = Auth::user();

        if(!Hash::check($request->old_password, $user->password)) {
            Alert::error('Error', 'Your old password is incorrect');
            return redirect()->back();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        Alert::success('Success', 'Password updated successfully');
        return redirect()->back();
    }
}
