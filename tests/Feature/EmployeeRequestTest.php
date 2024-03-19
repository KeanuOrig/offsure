<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Requests\Maintenance\EmployeeRequest;
use Illuminate\Support\Facades\Validator;

class EmployeeRequestTest extends TestCase
{
    /**
     * Test validation rules for the EmployeeRequest form request.
     *
     * @return void
     */
    public function testValidationRules()
    {

        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_id' => 1,
        ];

        $request = new EmployeeRequest();

        $validator = Validator::make($data, $request->rules());
        
        $this->assertTrue(!$validator->fails());
    }
}
