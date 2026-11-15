<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use App\Models\Department;
use App\Models\Trend;
use Illuminate\Http\Request;

class AdmissionsController extends Controller
{

    public function allAdmission()
    {
        $all_company = CompanyInformation::where('admission', '0')->get();
        foreach ($all_company as $company) {
            $company['admission'] = 'accepted';
            $company->update([
                'admission' => $company['admission']
            ]);
        }
        return response()->json(__('words.All companies were accepted into the exhibition'));
    }

    public function showCompanyNotAdmission()
    {
        $all_company = CompanyInformation::where('admission', '0')->get();
        if (!$all_company->isEmpty()) {
            return response()->json($all_company);
        } else {
            return response()->json(__('words.There are no unacceptable companies'));
        }
    }

    public function admissionCompany(Request $request, $id)
    {
        $request->validate([
            'admission' => 'required|string'
        ]);
        $validationData = $request->all();
        $company = CompanyInformation::find($id);
        $company->update([
            'admission' => $validationData['admission']
        ]);
        return response()->json(__('words.The company has been successfully accepted'));
    }


    public function admissionTrend(Request $request, $id)
    {
        $request->validate([
            'admission' => 'required|string',
        ]);
        $validationData = Trend::find($id);
        $validationData->update([
            'admission' => $request['admission']
        ]);
        return response()->json(__('words.The product trend has been successfully accepted'));
    }

    public function orderTrend()
    {
        $order = Trend::where('admission', '0')->get();
        return response()->json($order);
    }
}
