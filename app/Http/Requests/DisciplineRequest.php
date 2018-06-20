<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisciplineRequest extends FormRequest
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

    public function messages()
    {
        return [
            'name.required' => 'Digite o nome da disciplina!',
            'minimun_time.required' => 'Defina o tempo mínimo de duração!',
            'price.required' => 'Digite o valor da disciplina!'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required'
        ];

        if($this->get('price')) {
            $rules['minimun_time'] = 'required';
            $rules['price'] = 'required';
        }

        return $rules;
    }
}
