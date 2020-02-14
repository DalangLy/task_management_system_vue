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
            'project_detail_id' => 'required',
            'working_date' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
        ]);

        TimeSheet::create([
            'user_id' => Auth::id(),
            'current_work_salary' => Auth::user()->salary,
            'project_detail_id' => $request->project_detail_id,
            'working_date' => $request->working_date,
            'start_time' => $request->startTime,
            'end_time' => $request->endTime,
        ]);

        return response()->json(['created']);
    }

    public function projectDetails(){
        $projectDetails = ProjectDetail::all();
        return response()->json($projectDetails);
    }
}
