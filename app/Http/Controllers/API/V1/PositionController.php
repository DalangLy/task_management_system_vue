<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function positions(){
        $position = Position::all();
        return response()->json($position);
    }

    public function store(Request $request){
        $request->validate([
            'position' => 'required',
        ]);

        Position::create([
            'position' => $request->position,
        ]);

        return response()->json(['created']);
    }
}
