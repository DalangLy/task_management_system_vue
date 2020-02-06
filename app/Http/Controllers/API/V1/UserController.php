<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function users(){
        return response()->json(User::all());
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'username' => uniqid(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        return response()->json(['Created']);
    }
}
