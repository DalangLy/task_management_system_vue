<?php

namespace App\Http\Controllers\API\V1;

use App\ClientAccount;
use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectDetail;
use App\Purchase;
use App\TimeSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboards(){
        $dashboards = ProjectDetail::join('projects', 'project_details.project_id', 'projects.project_id')
            ->join('client_accounts', 'projects.client_account_id', 'client_accounts.client_account_id')
            ->get();


        foreach ($dashboards as $dashboard){
            $employees = TimeSheet::join('users', 'time_sheets.user_id', 'users.id')
                ->join('time_sheet_details', 'time_sheets.time_sheet_id', 'time_sheet_details.time_sheet_id')
                ->join('company_structures', 'time_sheet_details.company_structure_id', 'company_structures.company_structure_id')
                ->where('time_sheets.project_detail_id', $dashboard->project_detail_id)
                ->get();

            $purchases = Purchase::where('purchases.project_detail_id', $dashboard->project_detail_id)
                //->where('purchases.approved', true)
                ->get();

            $dashboard->employees = $employees;
            $dashboard->purchases = $purchases;
        }

        return response()->json($dashboards);
    }

//    public function dashboards(){
//        $dashboards = ClientAccount::join('clients', 'client_accounts.client_id', 'clients.client_id')
//            ->get();
//
//        $projects = Project::where('projects.client_account_id', $dashboards[0]->client_account_id)->get();
//
//        return response()->json($projects);
//    }

    public function dashboardDetail($id){
        $selectedDashboards = ProjectDetail::join('projects', 'project_details.project_id', 'projects.project_id')
            ->join('client_accounts', 'projects.client_account_id', 'client_accounts.client_account_id')
            ->where('project_details.project_detail_id', $id)
            ->first();

        $employees = TimeSheet::join('users', 'time_sheets.user_id', 'users.id')
            ->where('time_sheets.project_detail_id', $selectedDashboards->project_detail_id)
            ->get();

        $purchases = Purchase::join('purchase_types', 'purchases.purchase_type_id', 'purchase_types.purchase_type_id')
            ->where('purchases.project_detail_id', $selectedDashboards->project_detail_id)
            //->where('purchases.approved', true)
            ->get();

        $selectedDashboards->employees = $employees;
        $selectedDashboards->purchases = $purchases;

        return response()->json($selectedDashboards);
    }
}
