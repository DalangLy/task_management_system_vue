<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\ProjectDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboards(){
        $dashboard = ProjectDetail::join('time_sheets', 'project_details.project_detail_id', 'time_sheets.project_detail_id')
            ->get();
        return response()->json($dashboard);
    }
}
