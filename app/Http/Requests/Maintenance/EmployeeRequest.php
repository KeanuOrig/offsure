<?php

namespace App\Http\Requests\Maintenance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->isMethod('post') || $this->isMethod('put')) {
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'company_id' => [
                    'required',
                    Rule::exists('companies', 'id'),
                ],
            ];
        } elseif($this->isMethod('get')) {
            return [
                'pages' => 'nullable',
            ];
        }
    }
}
