<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'video.required' => 'Selecione um vídeo!',
            'video.mimes' => 'O arquivo deve ser um vídeo .mp4!',
            'imagem.required' => 'Selecione uma imagem!',
            'imagem.mimes' => 'O arquivo deve ser uma imagem .jpg, jpeg, png!',
            'documento.required' => 'Selecione um documento .pdf!',
            'documento.mimes' => 'O arquivo deve ser um documento .pdf!',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->get('file_type')=='video') {
            return [
                $this->get('file_type') => 'required|mimes:mp4|max:204800',
            ];
        }

        if($this->get('file_type')=='imagem') {
            return [
                $this->get('file_type') => 'required|mimes:jpg,jpeg,png|max:10240',
            ];
        }

        if($this->get('file_type')=='documento') {
            return [
                $this->get('file_type') => 'required|mimes:pdf|max:10240',
            ];
        }
    }
}
