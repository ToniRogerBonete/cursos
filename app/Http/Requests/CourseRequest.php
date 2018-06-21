<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name.required' => 'Digite o nome do curso!',
            'category.required' => 'Escolha uma categoria!',
            'level.required' => 'Escolha um nível!',
            'description.required' => 'Digite a descrição!',
            'objective.required' => 'Digite o objetivo!',
            'requisites.required' => 'Digite os requisitos!',
            'audience.required' => 'Digite público alvo!',
            'type_sale.required' => 'Defina o tipo de venda!',
            'price.required' => 'Digite o preço do curso!',
            'video_presentation.required' => 'Anexe um vídeo de apresentação!',
            'discipline.required' => 'Adicione pelo menos uma disciplina!',
            'content.required' => 'Exitem disciplinas sem conteúdo!'
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

        if($this->get('status')=='2') {
            $rules['category'] = 'required';
            $rules['level'] = 'required';
            $rules['description'] = 'required';
            $rules['objective'] = 'required';
            $rules['requisites'] = 'required';
            $rules['audience'] = 'required';
            $rules['type_sale'] = 'required';
            $rules['video_presentation'] = 'required';
            $rules['discipline'] = 'required';
            $rules['content'] = 'required';
        }

        if($this->get('status')=='2' and $this->get('type_sale')=='1') {
            $rules['price'] = 'required';
        }

        return $rules;
    }
}
