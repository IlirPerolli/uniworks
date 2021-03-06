<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStorePostRequest extends FormRequest
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
            'file_id'=>'required|mimetypes:application/pdf|max:4096',
            'title'=>'required|max:2000|min:2',
//            'author'=>'max:256|regex:/^[\pL\s\-]+$/u| min:0',
//            'author.*'=>'max:256|regex:/^[\pL\s\-]+$/u|min:0',
            'abstract'=>'required|max:4000|min:2',
            'resource'=>'max:2000',
            'category_id' => 'required|integer',
        ];
    }
    public function messages(){
        return [
            'file_id.required'=>'Ju lutem ngarkoni një dodument.',
            'file_id.mimes'=>'Ju lutem ngarkoni foto të formatit: pdf.',
            'title.required'=>'Titulli duhet të plotësohet.',
            'title.max'=>'Titulli duhet te kete maksimum 200 karaktere.',
            'title.min'=>'Titulli duhet te kete minimum 2 karaktere.',
            'author.*.max'=>'Autori duhet te kete maksimum 256 karaktere.',
            'author.*.regex'=>'Autori duhet te speciale.',

            'abstract.required'=>'Abstrakti duhet të plotësohet.',
            'abstract.max'=>'Titulli duhet te kete maksimum 4000 karaktere.',
            'abstract.min'=>'Abstrakti duhet te kete minimum 2 karaktere.',
            'category_id.required'=>'Kategoria duhet të plotësohet.',
            'category_id.integer'=>'Kategoria duhet të plotësohet.',
            'resource.max'=>'Burimi duhet të ketë maksimum 2000 karaktere.',
        ];
    }
}
