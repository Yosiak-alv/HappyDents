<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class OdontogramRequest extends FormRequest
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
            'detention_id' => 'required|array',
            'detention_id.*' =>'numeric|gt:0|decimal:0|max:255', //representa la iteracion de cada una 
            'condition' => 'array',
            'condition*' => 'max:5000'
        ];
    }

    public function validatedDetentionsId(): array
    {
        return $this->only('detention_id')['detention_id'];
    }
}
