<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestBookingRequest extends FormRequest
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
        return [
            'locationType' => 'required',
            'customerEmail' => 'required|email',
            //        'test_center_id' => "required_if:locationType,1",//LocationTypeEnum::Center
            //        'state_id' => 'required_if:locationType,2',//LocationTypeEnum::Home
            'addressLine1' => 'required_if:location_type,2',//LocationTypeEnum::Home
            //        'test_type_id' => 'required',
            'dueDate' => 'required',
            'startTime' => 'required',
        ];
    }
}
