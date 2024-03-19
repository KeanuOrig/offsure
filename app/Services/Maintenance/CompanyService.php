<?php

namespace App\Services\Maintenance;

use App\Repositories\Maintenance\CompanyRepository;
use App\Services\BaseService;
use App\Traits\FileUpload;
use App\Traits\SendEmail;

class CompanyService extends BaseService
{
    use FileUpload, SendEmail;
    private $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($data)
    {
        return $this->executeFunction(function () use ($data) {
            return $this->repository->index($data);
        });
    }

    public function store($request)
    {           
        return $this->executeFunction(function () use ($request) {

            $file = $request->file('logo');

            $upload = $this->upload($file, 'logo', 'company');

            if (!$upload) {
                throw new \Exception('File upload failed. Please try again.');
            }

            $data = $request->all();
            $data['edit_by'] = auth()->User()->email;
            $data['logo'] = json_encode($upload);

            $to_email = [];
            $to_email[] = env('TO_EMAIL', 'keanujohnorig@gmail.com');
            $to_email[] = 'keanujohnorig@gmail.com';

            $this->email($data, 'email.new_company', $to_email, [], []);
            
            return $this->repository->store($data);
        });
    }

    public function update($request, $id)
    {
        return $this->executeFunction(function () use ($request, $id) {

            $upload = $this->upload($request, 'logo', 'company');

            if (!$upload) {
                throw new \Exception('File upload failed. Please try again.');
            }

            $data = $request->all();
            $data['edit_by'] = auth()->User()->email;
            $data['logo'] = json_encode($upload);

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
