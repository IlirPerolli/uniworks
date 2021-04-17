<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSearchRequest extends FormRequest
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
            'q'=>['required','min:2']
        ];
    }
    public function messages(){
        return [
            'q.required'=>'Ju lutem plotësoni fushën.',
            'q.min'=>'Ju lutem jepni fjalë më të gjatë.',

        ];
    }
}
