<?php

namespace App\Http\Controllers\API\V1;

use App\CompanyStructure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyStructureController extends Controller
{
    public function companyStructure(){
        $companyStructure = CompanyStructure::where('using', true)->first();
        return response()->json($companyStructure);
    }
}
