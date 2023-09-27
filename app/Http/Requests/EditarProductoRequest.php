<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nombre" => ["required","string"],
            "precio" => ["required","numeric"],
            "categoria_id" => ["required"],
            "url" => ["nullable","string"],
        ];
    }

    public function messages (){
        return [
            "nombre.required" => "El nombre es requerido",
            "precio.required" => "El precio es requerido",
            "precio.numeric" => "El precio debe de ser numerico",
            "categoria_id.required" => "La categoria es requerida",
            "url.string" => "La url debe de ser una cadena de texto",
        ];
    }
}
