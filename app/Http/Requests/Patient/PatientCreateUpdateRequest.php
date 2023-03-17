<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientCreateUpdateRequest extends FormRequest
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
        return [
            'dui' => ['required','regex:/^\d{8}-\d{1}$/','max:10',Rule::unique('patients','dui')->ignore($this->paciente?->id)],
            'name' => ['required','max:255'],
            'lastname' => ['required','max:255'],
            'genre' => ['required','max:255'],
            'branch_office_id' => ['required'],
            'email' => ['required','email','max:255',Rule::unique('patients','email')->ignore($this->paciente?->id)],
            'phone' => 'required|numeric',
            'second_phone' => 'nullable',
            'address' => 'required|max:5000',
            'occupation' => 'required',
            'birthdate' => 'required|date',
            'contact_name' => 'nullable|max:255',
            'contact_phone' => 'nullable',
            'contact_email' => ['nullable','email','max:255',Rule::unique('patients','contact_email')->ignore($this->paciente?->id)]
        ];
    }
}
