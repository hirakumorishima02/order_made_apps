<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'profile' => 'required|min:10|max:1000',
            'github' => 'alpha_dash',
            'url' => 'url',
            'name' => 'required|max:10'
        ];
    }
    public function messages(){
        return [
            'profile.required'  => 'プロフィールを入力してください。',
            'profile.min' => 'プロフィールは10文字以上記入してください。',
            'profile.max' => 'プロフィールは最大1,000文字以内で記入してください。',
            'github.alpha_dash' => 'GitHubアカウントは英数文字、「-」、「_」のみで入力してください。',
            'url.url' => 'ポートフォリオがURL形式ではありません。',
            'name.required' => '名前は必須項目です。',
            'name.max' => '名前は最大10文字以内で記入してください。'
        ];
    }
}