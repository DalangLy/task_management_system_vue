<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\ProjectDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboards(){
        $dashboard = ProjectDetail::all();
        return response()->json($dashboard);
    }
}
