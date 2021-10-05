<?php

namespace App\Http\Requests\API;

use App\Models\VolunteerService;
use InfyOm\Generator\Request\APIRequest;

class UpdateVolunteerServiceAPIRequest extends APIRequest
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
        $rules = VolunteerService::$rules;
        
        return $rules;
    }
}
