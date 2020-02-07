<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function projects(){
        $projects = Project::join('users', 'projects.user_id', 'users.id')
            ->join('client_accounts', 'projects.client_account_id', 'client_accounts.client_account_id')
            ->join('clients', 'client_accounts.client_id', 'clients.client_id')
            ->get();
        return response()->json($projects);
    }

    public function store(Request $request){
        $request->validate([
            'client_account' => 'required',
            'project_name' => 'required',
        ]);

        Project::create([
            'client_account_id' => $request->client_account,
            'user_id' => Auth::id(),
            'project_code' => uniqid(),
            'project_name' =>$request->project_name,
        ]);

        return response()->json(['created']);
    }
}
