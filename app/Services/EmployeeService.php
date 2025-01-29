<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    public function getAllEmployees() {
        return Employee::all();
    }

    public function createEmployee(array $data) {
        return Employee::create($data);
    }
}
