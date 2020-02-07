<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function roles(){
        $roles = Role::all();
        return response()->json($roles);
    }

    public function store(Request $request){
        $request->validate([
            'role' => 'required',
            'display_name' => 'required',
        ]);

        Role::create([
            'role' => strtolower($request->role),
            'role_display_name' => $request->display_name,
        ]);
        return response()->json(['created']);
    }
}
