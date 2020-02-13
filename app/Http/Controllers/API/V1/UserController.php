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
        $users = User::join('genders', 'users.gender_id', 'genders.gender_id')
            ->join('roles', 'users.role_id', 'roles.role_id')
            ->join('positions', 'users.position_id', 'positions.position_id')->get();
        return response()->json($users);
    }

    public function selectedUser($id){
        $selectedUser = User::find($id);
        return response()->json($selectedUser);
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $photo = null;
        if($request->avatar) {
            $explodeRawImage = explode(',', $request->avatar);
            $decodedImage = base64_decode($explodeRawImage[1]);
            $generateRandomNumberForFileName = explode(" ", microtime());
            $imageNameWithExtension = $generateRandomNumberForFileName[0] . '.' . explode('/', explode(':', substr($request->avatar, 0, strpos($request->avatar, ';')))[1])[1];
            $saveDirectory = storage_path() . '/app/public/user_avatars/' . $imageNameWithExtension;
            file_put_contents($saveDirectory, $decodedImage);
            $photo = 'storage/user_avatars/'.$imageNameWithExtension;
        }

        User::create([
            'avatar' => $photo,
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
