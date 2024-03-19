<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Services\Maintenance\EmployeeService;
use App\Http\Requests\Maintenance\EmployeeRequest;

class EmployeeController extends Controller
{
    private $service;

    public function __construct(EmployeeService $service)
    {
        $this->service = $service;
    }

    public function index(EmployeeRequest $request)
    {
        return $this->service->index($request->toArray());
    }

    public function store(EmployeeRequest $request)
    {
        return $this->service->store($request->toArray());
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(EmployeeRequest $request, $id)
    {
        return $this->service->update($request->toArray(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
