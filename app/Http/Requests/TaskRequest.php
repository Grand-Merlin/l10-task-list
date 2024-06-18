<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Autorise l'utilisateur a executer la requete
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
            //On ajoute ici ce que l'on avais a l'interieur des route afin d'evité de les recopier plusieur fois
            'title'=>'required|max:255',
            'description'=>'required',
            'long_description'=>'required'
        ];
    }
}
