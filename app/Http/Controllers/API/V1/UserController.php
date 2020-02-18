<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Position;
use App\Role;
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
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
            'position' => ['required'],
            'salary' => ['required'],
            'role' => ['required'],
            'phone' => ['required'],
            'start_date' => ['required'],
            'official_date' => ['required'],
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
            'gender_id' => $request->gender,
            'email' => $request->email,
            'email_verified_at' => now(),
            'username' => $request->username?$request->username:uniqid(),
            'password' => $request->password?Hash::make($request->password):Hash::make('password'),
            'position_id' => $request->position,
            'salary' => $request->salary,
            'role_id' => $request->role,
            'phone' => $request->phone,
            'start_date' => $request->start_date,
            'official_date' => $request->official_date,
            'remember_token' => Str::random(10),
        ]);
        return response()->json(['Created']);
    }

    public function gettingPositions(){
        $positions = Position::all();
        return response()->json($positions);
    }

    public function gettingRoles(){
        $roles = Role::all();
        return response()->json($roles);
    }
}
