<?php

namespace App\Http\Controllers\API\V1;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function clients(){
        return response()->json(Client::all());
    }
}
