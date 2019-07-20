<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'title' => 'required|min:5|max:20',
            'money' => 'required|integer',
            'content' => 'required|max:min:30|max:1000',
            'wish_at' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください。',
            'title.min' => 'タイトルは5文字以上で入力してください。',
            'title.max' => 'タイトルは20文字以下で入力してください。。',
            'money.required' => '報酬を入力してください。',
            'money.integer' => '報酬は数字で入力してください。',
            'content.required' => '本文を入力してください。',
            'content.min' => '本文は30文字以上入力してください。',
            'content.max' => '本文は1000文字以内で入力してください。',
            'wish_at.required' => '納期を入力してください。',
        ];
    }
}
