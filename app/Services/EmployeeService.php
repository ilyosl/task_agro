<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class EmployeeService
{
    public function getAllEmployees() {
        if(auth()->user()->hasRole('admin')){
            return Employee::all();
        }
        return Employee::query()->where('company_id', auth()->user()->id)->get();
    }

    public function createEmployee(array $data) {
        $data['company_id'] = auth()->user()->id;
        return Employee::create($data);
    }
    public function updateEmployee(Employee $employee, array $data): JsonResponse
    {
        if($this->checkAccess($employee)){
            return response()->json(['message' => 'Access denied'], 403);
        }
        $employee->update($data);
        return response()->json($employee);
    }
    public function deleteEmployee(Employee $employee) {
        if($this->checkAccess($employee)){
            return response()->json(['message' => 'Access denied'], 403);
        }
        $employee->delete();
        return response()->json(null, 204);
    }

    public function checkAccess(Employee $employee)
    {
        return (auth()->user()->hasRole('company') && ($employee->company_id !== auth()->user()->company->id));
    }
}
