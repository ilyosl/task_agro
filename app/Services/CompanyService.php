<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyService
{
    public function getAllCompanies()
    {
        if(auth()->user()->hasRole('company')){
            return Company::query()->where('user_id', auth()->user()->id)->get();
        }
        return Company::all();
    }

    public function getCompany(Company $company): JsonResponse
    {
        if($this->checkAccess($company)){
            return response()->json(['message' => 'Access denied'], 403);
        }
        return response()->json($company);
    }
    public function createCompany(array $data) {
        $data['user_id'] = auth()->user()->id;
        return Company::create($data);
    }

    public function updateCompany(Company $company, array $data) {
        if($this->checkAccess($company)){
            return response()->json(['message' => 'Access denied'], 403);
        }
        return response()->json($company->update($data));
    }

    public function deleteCompany(Company $company) {
        if($this->checkAccess($company)){
            return response()->json(['message' => 'Access denied'], 403);
        }
        $company->delete();
        return response()->json(['message' => 'Company deleted'], 204);
    }

    public function checkAccess(Company $company)
    {
        return (auth()->user()->hasRole('company') && ($company->user_id !== auth()->user()->id));
    }
}
