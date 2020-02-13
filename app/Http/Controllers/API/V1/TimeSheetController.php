<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\ProjectDetail;
use App\TimeSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeSheetController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'project_detail_id',
        ]);

        TimeSheet::create([
            'user_id' => Auth::id(),
            'salary' => Auth::user()->salary,
            'project_detail_id' => $request->project_detail_id,
        ]);

        return response()->json(['created']);
    }

    public function projectDetails(){
        $projectDetails = ProjectDetail::all();
        return response()->json($projectDetails);
    }
}
