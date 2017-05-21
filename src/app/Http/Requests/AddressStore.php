<?php

namespace Afrittella\LaravelAddressable\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = implode(',', config('laravel-addressable.types'));
        return [
            "type" => "required|in:".$types,
            "organization" => "string|max:255",
            "first_name" => "required_with:last_name|string|max:255",
            "last_name" => "required_with:first_name|string|max:255",
            "street" => "required|string|max:255",
            "street_number" => "string|max:255",
            "city" => "required|string|max:255",
            "state" => "required|string|max:255",
            "state_code" => "string|max:255",
            "country" => "required|country|max:255",
            "country_code" => "string|cca3",
            "postcode" => "required|max:10",
            "lat" => "numeric|between:-90.0,90.0",
            "lng" => "numeric|between:-180.0,180.0"
        ];
    }
}
