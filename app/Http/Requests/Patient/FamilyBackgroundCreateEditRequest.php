<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class FamilyBackgroundCreateEditRequest extends FormRequest
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
            'patient_id' => 'required|numeric|gt:0',
            'system_id' => 'required|numeric|gt:0',
            'relationship' =>'required|max:255',
            'condition' => 'required|max:5000'
        ];
    }
}
