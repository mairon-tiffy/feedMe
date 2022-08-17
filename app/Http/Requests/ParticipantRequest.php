<?php

namespace App\Http\Requests;

use App\Models\EventDetail;
use App\Models\Participant;
use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $event_detail = EventDetail::
        where('id', '=', )
        ->whereNull('deleted_at')
        ->get();


        return [
            //
            'number' => 'required|integer|  :$number',
        ];
    }

    public function messages()
    {
        return [
            'required'    => ':attributeを入力してください。',
            'max'         => ':attributeは参加可能人数を超えています。',
        ];
    }

}
