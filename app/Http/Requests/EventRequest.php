<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            // 'content' => 'required',
            // 'title' => 'required',
            // 'number_from' => 'required|integer|min:1',
            // 'number_to' => 'required|integer|min:1|gte:number_from',
            // 'avalable_date' => 'required',
            // 'avalable_time' => 'required',
            // 'place' => 'required|integer|min:0',
            // 'price' => 'required',
            // 'files.*' => 'mimetypes:image/png,image/jpeg',

        ];
    }

    // public function messages()
    // {
    //     return [
    //         'required'    => ':attributeを入力してください。',
    //         'max'         => ':attributeは:max文字以内で入力してください。',
    //         'date_format' => ':attributeを正しく入力してください。',
    //     ];
    // }
}
