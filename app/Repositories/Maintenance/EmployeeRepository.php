<?php

namespace App\Repositories\Maintenance;

use App\Models\Maintenance\Employee;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Http;

class EmployeeRepository extends BaseRepository
{
    private $model;

    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function index($data)
    {
        return $this->model->paginate(10);
    }

    public function store($data)
    {     
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->find($id);

    }
}
