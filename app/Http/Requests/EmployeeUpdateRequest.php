<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
        $emp_id  =  $this->route('id');
       
        return [
            'emp_name' => 'required|string|max:50',
            'email' => 'required|email|unique:employees,email,'.$emp_id,
            'department_id' => 'required|numeric',
            'designation_id' => 'required|numeric',
            'address' => 'required|string|max:100',
            'phone_number' => 'required|numeric|min:10',
        ];
    }

    protected function failedValidations(Validator $validator){
        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors()
        ], 422));
    }
}
