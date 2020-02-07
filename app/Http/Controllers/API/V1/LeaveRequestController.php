<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function leaveRequests(){
        $leaveRequests = LeaveRequest::join('users', 'leave_requests.user_id', 'users.id')
            ->get();
        return response()->json($leaveRequests);
    }

    public function store(Request $request){
        $request->validate([
            'reason' => 'required',
            'leave_from' => 'required',
            'leave_to' => 'required',
        ]);

        LeaveRequest::create([
            'user_id' => Auth::id(),
            'reason' => $request->reason,
            'leave_from' => $request->leave_from,
            'leave_to' => $request->leave_to,
        ]);

        return response()->json(['created']);
    }
}
