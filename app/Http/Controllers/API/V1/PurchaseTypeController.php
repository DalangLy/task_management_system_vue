<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\PurchaseType;
use Illuminate\Http\Request;

class PurchaseTypeController extends Controller
{
    public function purchaseTypes(){
        $purchaseTypes = PurchaseType::all();
        return response()->json($purchaseTypes);
    }

    public function store(Request $request){
        $request->validate([
            'purchase_type_name' => 'required',
        ]);

        PurchaseType::create([
            'purchase_type_name' => $request->purchase_type_name,
        ]);

        return response()->json(['created']);
    }
}
