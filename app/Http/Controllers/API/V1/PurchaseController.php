<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\ProjectDetail;
use App\Purchase;
use App\PurchaseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function purchases(){
        $purchases = Purchase::join('users', 'purchases.user_id', 'users.id')
            ->join('purchase_types', 'purchases.purchase_type_id', 'purchase_types.purchase_type_id')
            ->join('project_details', 'purchases.project_detail_id', 'project_details.project_detail_id')
            ->join('projects', 'project_details.project_id', 'projects.project_id')
            ->get();
        return response()->json($purchases);
    }

    public function store(Request $request){
        $request->validate([
            'project_detail_id' => 'required',
            'purchase_type_id' => 'required',
            'paid' => 'required',
            'subject' => 'required',
        ]);

        Purchase::create([
            'user_id' => Auth::id(),
            'project_detail_id' => $request->project_detail_id,
            'purchase_type_id' => $request->purchase_type_id,
            'paid' => $request->paid,
            'subject' => $request->subject,
            'description' => $request->description,
        ]);

        return response()->json(['created']);
    }

    public function projectDetails(){
        $projectDetails = ProjectDetail::all();
        return response()->json($projectDetails);
    }

    public function purchaseTypes(){
        $purchaseTypes = PurchaseType::all();
        return response()->json($purchaseTypes);
    }
}
