<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizCreateRequest extends FormRequest
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
            'title' => 'required|min:3|max:50|unique:quizzes',
            'description' => 'required|max:500',
            'category_id' => 'required'
        ];
    }

    //Laravel 8 tr için githubdan paket kurulumu yapıp locale tr yaptık.
    public function attributes()
    {
        return [
            'title' => 'Başlık',
            'description' => 'Açıklama',
            'category_id' => 'Kategori'
        ];
    }
}
