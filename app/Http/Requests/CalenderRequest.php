<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalenderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'monday.start_time.*'          => 'present|required_if:day_0,==,1|date_format:H:i|before:monday.end_time.*',
            'monday.end_time.*'            => 'present|required_if:day_0,==,1|date_format:H:i',
            'tuesday.start_time.*'         => 'present|required_if:day_0,==,1|date_format:H:i|before:tuesday.end_time.*',
            'tuesday.end_time.*'           => 'present|required_if:day_0,==,1|date_format:H:i',
            'wednesday.start_time.*'       => 'present|required_if:day_0,==,1|date_format:H:i|before:wednesday.end_time.*',
            'wednesday.end_time.*'         => 'present|required_if:day_0,==,1|date_format:H:i',
            'thursday.start_time.*'        => 'present|required_if:day_0,==,1|date_format:H:i|before:thursday.end_time.*',
            'thursday.end_time.*'          => 'present|required_if:day_0,==,1|date_format:H:i',
            'friday.start_time.*'          => 'present|required_if:day_0,==,1|date_format:H:i|before:friday.end_time.*',
            'friday.end_time.*'            => 'present|required_if:day_0,==,1|date_format:H:i',
            'saturday.start_time.*'        => 'present|required_if:day_0,==,1|date_format:H:i|before:saturday.end_time.*',
            'saturday.end_time.*'          => 'present|required_if:day_0,==,1|date_format:H:i',
            'sunday.start_time.*'          => 'present|required_if:day_0,==,1|date_format:H:i|before:sunday.end_time.*',
            'sunday.end_time.*'            => 'present|required_if:day_0,==,1|date_format:H:i',
        ];
    }

    public function messages() :array
    {
        $messages = [];
        
        foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $key => $day){
            /* start times */
            $messages[$day . '.start_time.*.present']       = 'Required field.';
            $messages[$day . '.start_time.*.required_if']   = 'Required field.';
            $messages[$day . '.start_time.*.date_format']   = 'Incorrect format.';
            $messages[$day . '.start_time.*.before']        = 'Invalid time';
            /* end time */
            $messages[$day . '.end_time.*.present']       = 'Required field.';
            $messages[$day . '.end_time.*.required_if']   = 'Required field.';
            $messages[$day . '.end_time.*.date_format']   = 'Incorrect format.';
        }

        return $messages;
    }
}
