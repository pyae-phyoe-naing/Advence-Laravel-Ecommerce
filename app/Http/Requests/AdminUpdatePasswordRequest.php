<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdatePasswordRequest extends FormRequest
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
            'current_pwd'=>'required',
            'new_pwd'=>'required|min:6',
            'confirm_pwd'=>'required',
        ];
    }
    public function messages()
    {
        return [
              'current_pwd.required'=>'လက်ရှိစကား၀ှက်လိုအပ်ပါသည်။',
              'new_pwd.required'=>'စကား၀ှက်အသစ်လိုအပ်ပါသည်။',
              'new_pwd.min'=>'စကား၀ှက်အသစ်သည်အနည်းဆုံး ၆ လုံးဖြစ်ရန်လိုအပ်ပါသည်။',
              'confirm_pwd.required'=>'အတည်ပြုစကား၀ှက်လိုအပ်ပါသည်။',
        ];
    }
}
