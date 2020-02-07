<?php

namespace App\Http\Controllers\API\V1;

use App\ClientAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAccountController extends Controller
{
    public function clientAccounts(){
        $clientAccounts = ClientAccount::join('clients', 'client_accounts.client_id', 'clients.client_id')
            ->get();
        return response()->json($clientAccounts);
    }

    public function store(Request $request){
        $request->validate([
            'client' => 'required',
            'client_account_name' => 'required',
        ]);

        ClientAccount::create([
            'user_id' => Auth::id(),
            'client_id' => $request->client,
            'client_account' => $request->client_account_name,
        ]);

        return response()->json(['created']);
    }
}
