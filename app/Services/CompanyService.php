<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyService
{
    public function getAllCompanies()
    {
        if(auth()->user()->hasRole('company')){
            return response()->json(Company::query()->where('user_id', auth()->user()->id)->get());
        }
        return response()->json(Company::all());
    }

    public function getCompany(Company $company): JsonResponse
    {
        if($this->checkAccess($company)){
            return response()->json(['message' => 'Access denied'], 403);
        }
        return response()->json($company);
    }
    public function createCompany(array $data) {

        if(!isset($data['user_id'])) {
            $data['user_id'] = auth()->user()->id;
        }
        return response()->json(Company::create($data), 201);
    }

    public function updateCompany(Company $company, array $data) {
        if($this->checkAccess($company)){
            return response()->json(['message' => 'Access denied'], 403);
        }
        return response()->json($company->update($data));
    }

    public function deleteCompany(Company $company) {
        if(!auth()->user()->hasRole('admin') && $this->checkAccess($company)){
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
