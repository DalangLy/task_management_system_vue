<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\TaskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskTypeController extends Controller
{
    public function taskTypes(){
        $taskTypes = TaskType::join('users', 'task_types.user_id', 'users.id')
            ->get();
        return response()->json($taskTypes);
    }

    public function store(Request $request){
        $request->validate([
            'task_type' => 'required',
        ]);

        TaskType::create([
            'user_id' => Auth::id(),
            'task_type' => $request->task_type,
        ]);

        return response()->json(['created']);
    }
}
