<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAPIController extends Controller
{
  public function profile()
  {
    $user = auth()->user();

    return response()->json([
      'status' => 'success',
      'data' => $user
    ]);
  }

  public function updateProfile(Request $request)
  {
    $user = auth()->user();

    $request->validate([
      'name' => 'nullable|string|max:255',
      'email' => 'nullable|email|unique:users,email,' . $user->id,
      'phone_number' => 'nullable|numeric',
      'date_of_birth' => 'nullable|date',
      'password' => 'nullable|min:3',
    ]);

    if ($request->filled('name')) {
      $user->name = $request->name;
    }

    if ($request->filled('email')) {
      $user->email = $request->email;
    }

    if ($request->filled('phone_number')) {
      $user->phone_number = $request->phone_number;
    }

    if ($request->filled('date_of_birth')) {
      $user->date_of_birth = $request->date_of_birth;
    }

    if ($request->filled('password')) {
      $user->password = Hash::make($request->password);
    }

    $user->save();

    return response()->json([
      'status' => 'success',
      'message' => 'Profile updated successfully',
      'data' => $user
    ]);
  }

  public function updateAvatar(Request $request)
  {
    $user = auth()->user();

    $request->validate([
      'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('avatar')) {
      if ($user->avatar) {
        @unlink(public_path('img/profile/' . $user->avatar));
      }
      $image = $request->file('avatar');
      $imageName = time() . '.' . $image->extension();
      $image->move(public_path('img/profile'), $imageName);
      $user->avatar = $imageName;
      $user->save();
    }

    return response()->json([
      'status' => 'success',
      'message' => 'Avatar updated successfully',
      'data' => [
        'avatar' => $user->avatar,
        'avatar_url' => url('img/profile/' . $user->avatar)
      ]
    ]);
  }
}
