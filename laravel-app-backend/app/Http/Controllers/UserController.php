<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return new ApiResource(false, $validator->getMessageBag()->getMessages(), null);
        }

        $user = User::where('username', '=', $request->username)->firstOrFail();

        if (Hash::check($request->password, $user->password)) {
            return new ApiResource(true, 'Data user berhasil ditemukan', $user);
        } else {
            return new ApiResource(false, 'Kombinasi username dan password tidak sesuai', null);
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username,except,id',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return new ApiResource(false, $validator->getMessageBag()->getMessages(), null);
        }

        $newUser = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return new ApiResource(true, 'Data user berhasil disimpan', $newUser);
    }
}
