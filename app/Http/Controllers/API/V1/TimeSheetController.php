<?php

namespace App\Http\Controllers\API\V1;

use App\CompanyStructure;
use App\Http\Controllers\Controller;
use App\ProjectDetail;
use App\TimeSheet;
use App\TimeSheetDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeSheetController extends Controller
{
    public function store(Request $request){
//        $request->validate([
//            'project_detail_id' => 'required',
//            'working_date' => 'required',
//            'start_time' => 'required',
//            'end_time' => 'required',
//        ]);


        $companyStructureId = CompanyStructure::where('using', true)->first()->company_structure_id;

        foreach ($request[0] as $item){
            $timeSheetId = TimeSheet::create([
                'user_id' => Auth::id(),
                'project_detail_id' => $item['project_detail_id'],
            ])->time_sheet_id;

            TimeSheetDetail::create([
                'time_sheet_id' => $timeSheetId,
                'work_date' => $item['working_date'],
                'start_time' => $item['start_time'],
                'end_time' => $item['end_time'],
                'current_salary' => Auth::user()->salary,
                'company_structure_id' => $companyStructureId,
            ]);
        }

        return response()->json(['created']);
    }

    public function projectDetails(){
        $projectDetails = ProjectDetail::all();
        return response()->json($projectDetails);
    }
}
