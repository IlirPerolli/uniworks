<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateCategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255|min:2',
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Kategoria duhet të plotësohet.',
            'name.max'=>'Kategoria duhet te kete maksimum 255 karaktere.',
            'name.min'=>'Kategoria duhet te kete minimum 2 karaktere.',

        ];
    }
}
