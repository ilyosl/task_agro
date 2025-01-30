<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService) {
        $this->companyService = $companyService;
        $this->middleware('role:admin')->except(['index', 'show', 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->companyService->getAllCompanies();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        return $this->companyService->createCompany($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): JsonResponse
    {
        return $this->companyService->getCompany($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        return $this->companyService->updateCompany($company, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): JsonResponse
    {
        return $this->companyService->deleteCompany($company);
    }
}
