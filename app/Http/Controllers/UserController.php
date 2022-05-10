<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }


    public function edit()
    {
        return view('auth.editprofile');
    }


    public function update(Request $request)
    {
        $input = $request->except('_token');
        $user = User::find($input['id']);
        $user->update($input);

        return redirect(route('main'))->with('success', 'Your profile has been successfully updated!');
    }

}
