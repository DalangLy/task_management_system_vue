<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\ProjectDetail;
use App\TimeSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectDetailController extends Controller
{
    public function works(){
        $works = ProjectDetail::join('users', 'project_details.user_id', 'users.id')
            ->join('projects', 'project_details.project_id', 'projects.project_id')
            ->join('task_types', 'project_details.task_type_id', 'task_types.task_type_id')
            ->get();
        return response()->json($works);
    }

    public function store(Request $request){
        $request->validate([
            'end_date' => 'required',
            'start_date' => 'required',
            'fee' => 'required',
            'project_id' => 'required',
            'task_name' => 'required',
            'task_type_id' => 'required',
        ]);

        $projectDetailId = ProjectDetail::create([
            'project_id' => $request->project_id,
            'task_type_id' => $request->task_type_id,
            'working_code' => uniqid(),
            'task_name' => $request->task_name,
            'user_id' => Auth::id(),
            'fee' => $request->fee,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ])->project_detail_id;

        TimeSheet::create([
            'user_id' => Auth::id(),
            'project_detail_id' => $projectDetailId,
        ]);

        return response()->json(['created']);
    }
}
