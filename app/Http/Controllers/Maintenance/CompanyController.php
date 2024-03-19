<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Services\Maintenance\CompanyService;
use App\Http\Requests\Maintenance\CompanyRequest;

class CompanyController extends Controller
{
    private $service;

    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

    public function index(CompanyRequest $request)
    {
        return $this->service->index($request->toArray());
    }

    public function store(CompanyRequest $request)
    {   
        return $this->service->store($request);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(CompanyRequest $request, $id)
    {   
        return $this->service->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
