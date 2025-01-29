<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    public function getAllCompanies() {
        return Company::all();
    }

    public function createCompany(array $data) {
        return Company::create($data);
    }
}
