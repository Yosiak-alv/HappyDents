<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class PatientSystemCreateEditRequest extends FormRequest
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
            'system_id' => 'required|array',
            'system_id.*' =>'numeric|gt:0|decimal:0|max:255', //representa la iteracion de cada una 
        ];
    }

    public function validatedSystemId():array
    {
        return $this->only('system_id')['system_id'];
    }
}
