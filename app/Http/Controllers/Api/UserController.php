<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // Crear un nuevo usuario
        $user = new User;
        $user->name = $request->name;
        $user->email =  $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response([
            'success' => true,
            'message' => 'Usuario agregado correctamente.',
            'data'    => [],
        ]);
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }
}
