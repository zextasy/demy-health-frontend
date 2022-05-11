<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestBookingRequest extends FormRequest
{
    const VALIDATION_RULE_REQUIRED_IF_LOCATION_TYPE_HOME = "required_if:locationType,2";

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
            "locationType" => "required",
            "customerEmail" => "required|email",
            "selectedTestCenter" => "required_if:locationType,1",//LocationTypeEnum::Center
            "selectedState" => self::VALIDATION_RULE_REQUIRED_IF_LOCATION_TYPE_HOME,
            "selectedLocalGovernmentArea" => self::VALIDATION_RULE_REQUIRED_IF_LOCATION_TYPE_HOME,
            "addressLine1" => self::VALIDATION_RULE_REQUIRED_IF_LOCATION_TYPE_HOME,//LocationTypeEnum::Home
            "selectedTestType" => "required",
            "dueDate" => "required|after_or_equal:now",
        ];
    }

    public function messages()
    {
        return [
            'locationType.required' => 'Please choose a location type',
            'selectedTestCenter.required_if' => 'Please choose a center',
            'selectedState.required_if' => 'Please choose a state',
            'selectedLocalGovernmentArea.required_if' => 'Please choose a local government area',
            'addressLine1.required_if' => 'Please enter your address',
            'selectedTestType.required' => 'Please choose a test',
            'dueDate.after_or_equal' => 'The date must be in the future',
        ];
    }
}
