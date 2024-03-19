<?php

namespace App\Http\Requests\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
                'name' => 'required',
                'email' => 'required',
                'logo' => 'required|file|mimes:jpeg,jpg'
            ];
        } elseif($this->isMethod('get')) {
            return [
                'pages' => 'nullable',
            ];
        }
    }
}
