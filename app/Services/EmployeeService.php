<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class EmployeeService
{
    public function getAllEmployees() {
        if(auth()->user()->hasRole('admin')){
            return response()->json(Employee::all());
        }
        return response()->json(Employee::query()->where('company_id', auth()->user()->id)->get());
    }

    public function getEmployee(Employee $employee) {
        if($this->checkAccess($employee)){
            return response()->json(['message' => 'Access denied'], 403);
        }
        return response()->json($employee);
    }

    public function createEmployee(array $data) {
        $data['company_id'] = auth()->user()->id;
        return response()->json(Employee::create($data),201);
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
        return response()->json(['message' => 'Employee deleted'], 204);
    }

    public function checkAccess(Employee $employee)
    {
        return (auth()->user()->hasRole('company') && ($employee->company_id !== auth()->user()->company->id));
    }
}
