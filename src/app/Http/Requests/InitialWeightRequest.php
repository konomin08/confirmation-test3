<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitialWeightRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_weight' => ['required', 'regex:/^\d{1,4}(\.\d{1})?$/'],
            'target_weight' => ['required', 'regex:/^\d{1,4}(\.\d{1})?$/'],
        ];
    }

    public function messages()
    {
        return [
            'current_weight.required' => '現在の体重を入力してください',
            'current_weight.regex' => '4桁までの数字で、小数点は1桁で入力してください',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.regex' => '4桁までの数字で、小数点は1桁で入力してください',
        ];
    }
}

