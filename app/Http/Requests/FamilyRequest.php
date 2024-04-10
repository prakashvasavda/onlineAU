<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FamilyRequest extends FormRequest
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
        $rules = [
            'name'                          => "required|max:50",
            'email'                         => 'required|email', //required|email|unique:front_users,email
            'family_address'                => "required|max:100",
            'family_city'                   => "required|max:100",
            'home_language'                 => "required",
            'no_children'                   => "required|gte:1|lte:5",
            'family_notifications'          => "required",
            'cell_number'                   => "required|min:10|max:10|regex:/[0-9]{9}/",
            'id_number'                     => 'required' . ($this->input('type_of_id_number') == 'south_african' ? '|numeric|digits:13' : ''),
            'start_date'                    => "required",
            'duration_needed'               => "required|numeric|gte:1|lt:24",
            'petrol_reimbursement'          => "required",
            'candidate_duties'              => "required|max:500",
            'surname'                       => "required|max:50",
            'live_in_or_live_out'           => "required",
            'type_of_id_number'             => "required",
            'profile'                       => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'what_do_you_need'              => ['required', 'array'],
            'family_description'            => "required|max:500",
            'hourly_rate_pay'               => "required|numeric|digits_between:2,5",
            'salary_expectation'            => "required|numeric|digits_between:2,10",

            /* monday */
            'monday.start_time.*'          => 'present|required_if:day_0,==,1|date_format:H:i|before:monday.end_time.*',
            'monday.end_time.*'            => 'present|required_if:day_0,==,1|date_format:H:i',
            /* tuesday */
            'tuesday.start_time.*'         => 'present|required_if:day_1,==,1|date_format:H:i|before:tuesday.end_time.*',
            'tuesday.end_time.*'           => 'present|required_if:day_1,==,1|date_format:H:i',
            /* wednesday */
            'wednesday.start_time.*'       => 'present|required_if:day_2,==,1|date_format:H:i|before:wednesday.end_time.*',
            'wednesday.end_time.*'         => 'present|required_if:day_2,==,1|date_format:H:i',
            /* thursday */
            'thursday.start_time.*'        => 'present|required_if:day_3,==,1|date_format:H:i|before:thursday.end_time.*',
            'thursday.end_time.*'          => 'present|required_if:day_3,==,1|date_format:H:i',
            /* friday */
            'friday.start_time.*'          => 'present|required_if:day_4,==,1|date_format:H:i|before:friday.end_time.*',
            'friday.end_time.*'            => 'present|required_if:day_4,==,1|date_format:H:i',
            /* saturday */
            'saturday.start_time.*'        => 'present|required_if:day_5,==,1|date_format:H:i|before:saturday.end_time.*',
            'saturday.end_time.*'          => 'present|required_if:day_5,==,1|date_format:H:i',
            /* sunday */
            'sunday.start_time.*'          => 'present|required_if:day_6,==,1|date_format:H:i|before:sunday.end_time.*',
            'sunday.end_time.*'            => 'present|required_if:day_6,==,1|date_format:H:i',

            /* one day from the calender is required */
            'day_0'                        => 'required_without_all:day_1,day_2,day_3,day_4,day_5,day_6', 
            'day_1'                        => 'required_without_all:day_0,day_2,day_3,day_4,day_5,day_6', 
            'day_2'                        => 'required_without_all:day_0,day_1,day_3,day_4,day_5,day_6',
            'day_3'                        => 'required_without_all:day_0,day_1,day_2,day_4,day_5,day_6',
            'day_4'                        => 'required_without_all:day_0,day_1,day_2,day_3,day_5,day_6',
            'day_5'                        => 'required_without_all:day_0,day_1,day_2,day_3,day_4,day_6',
            'day_6'                        => 'required_without_all:day_0,day_1,day_2,day_3,day_4,day_5',

            /* Age and gender of children */
            'age'                          => "required|array",
            'age.*'                        => ['required', Rule::in(['0-12 months', '1-3 years', '4-7 years', '8-13 years', '13-16 years']), 'distinct'],
            'gender_of_children'           => "required|array",
            'gender_of_children.*'         => "required|in:male,female",

            'password' => [
                'nullable',
                'string',
                'min:8',                    // must be at least 10 characters in length
                'regex:/[a-z]/',            // must contain at least one lowercase letter
                'regex:/[A-Z]/',            // must contain at least one uppercase letter
                'regex:/[0-9]/',            // must contain at least one digit
                'regex:/[@$!%*#?&]/',       // must contain a special character
            ],
        ];

        return $rules;
    }

    public function messages() :array
    {
        $messages = [
            'age.*.in'                      => 'Invalid selected age.',
            'age.*.required'                => 'The age field is required.',
            'age.*.distinct'                => 'The age field must be unique.',
            'gender_of_children.*.in'       => 'Invalid gender selected for a child.',
            'gender_of_children.*.required' => 'The gender field is required.',
            'no_children.required'          => 'The number of children field is required.',
            'password.required'             => 'The password field is required.',
            'password.string'               => 'The password must be a string.',
            'password.min'                  => 'The password must be at least 8 characters in length.',
            'password.regex'                => 'The password must meet the following requirements: at least one lowercase letter, one uppercase letter, one digit, and one special character.',
        ];

        foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $key => $day){
            /* start times */
            $messages[$day . '.start_time.*.present']       = 'The start time is required on ' . ucfirst($day) . '.';
            $messages[$day . '.start_time.*.required_if']   = 'The start time is required on ' . ucfirst($day) . '.';
            $messages[$day . '.start_time.*.date_format']   = 'The start time on ' . ucfirst($day) . ' should be in the correct format (H:i).';
            $messages[$day . '.start_time.*.before']        = 'The start time on ' . ucfirst($day) . ' must be before the end time.';
            
            /* end time */
            $messages[$day . '.end_time.*.present']         = 'The end time is required on ' . ucfirst($day) . '.';
            $messages[$day . '.end_time.*.required_if']     = 'The end time is required on ' . ucfirst($day) . '.';
            $messages[$day . '.end_time.*.date_format']     = 'The end time on ' . ucfirst($day) . ' should be in the correct format (H:i).';
            
            $messages['day_' . $key .'.required_without_all']   = 'At least one day of the week in the calendar must be selected.';

        }

        return $messages;
    }
}
