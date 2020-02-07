<?php

namespace App\Http\Controllers\API\V1;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function clients(){
        $clients = Client::join('users', 'clients.user_id', 'users.id')->get();
        return response()->json($clients);
    }
    public function store(Request $request){
        $request->validate([
            'client_name' => 'required',
        ]);

        Client::create([
            'user_id' => Auth::id(),
            'client_code' => uniqid(),
            'client_name' => $request->client_name,
        ]);
        return response()->json(['Created']);
    }
}
