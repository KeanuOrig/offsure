<?php

namespace App\Services\Maintenance;

use App\Repositories\Maintenance\EmployeeRepository;
use App\Services\BaseService;

class EmployeeService extends BaseService
{
    private $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($data)
    {
        return $this->executeFunction(function () use ($data) {
            return $this->repository->index($data);
        });
    }

    public function store($data)
    {        
        return $this->executeFunction(function () use ($data) {
            $data['edit_by'] = auth()->User()->email;
            return $this->repository->store($data);
        });
    }

    public function update($data, $id)
    {
        return $this->executeFunction(function () use ($data, $id) {
            $data['edit_by'] = auth()->User()->email;
            return $this->repository->update($data, $id);
        });
    }

    public function destroy($id)
    {
        return $this->executeFunction(function () use ($id) {
            return $this->repository->destroy($id);
        });
    }

    public function show($id)
    {
        return $this->executeFunction(function () use ($id) {
            return $this->repository->show($id);
        });
    }
}
