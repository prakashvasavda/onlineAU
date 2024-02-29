<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PetsittingRequest extends FormRequest
{
    
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
            'name'                          => "required|max:50",
            'email'                         => 'required|email', //required|email|unique:front_users,email
            'family_address'                => "required|max:100",
            'cell_number'                   => "required|min:10|max:10|regex:/[0-9]{9}/",
            'start_date'                    => "required",
            'duration_needed'               => "required|numeric|gt:1|lt:24",
            'candidate_duties'              => "required|max:500",
            'surname'                       => "required|max:50",
            'id_number'                     => 'required' . ($this->input('type_of_id_number') == 'south_african' ? '|numeric|digits:13' : ''),
            'type_of_id_number'             => "required",
            'number_of_pets'                => "required|gte:1|lte:5",
            'pet_medication_or_disabilities'=> "required",
            'pet_medication_specify'        => "required_if:pet_medication_or_disabilities,==,yes|max:500",

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

            /* type of pet and number of pet validation */
            'type_of_pet'                   => "required|array",
            'type_of_pet.*'                 => ['required', Rule::in(['dog', 'cat', 'hamster and guinea pig', 'reptile', 'spider']), 'distinct'],
            'how_many_pets'                 => "required|array",
            'how_many_pets.*'               => "required|gte:1|lte:5",

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
    }

    public function messages() :array
    {
        $messages = [
            'type_of_pet.*.in'                   => 'Invalid selected type of pet.',
            'type_of_pet.*.required'             => 'The type of pet field is required.',
            'type_of_pet.*.distinct'             => 'The type of pet field must be unique.',
            'how_many_pets.*.gte'                => 'Pets number must be 1 or more.',
            'how_many_pets.*.lte'                => 'Pets number must less 5.',
            'how_many_pets.*.required'           => 'The number of pets field is required.',
            
            'password.string'                    => 'The password must be a string.',
            'password.min'                       => 'The password must be at least 8 characters in length.',
            'password.regex'                     => 'The password must meet the following requirements: at least one lowercase letter, one uppercase letter, one digit, and one special character.',
            'pet_medication_specify.required_if' => "Specification field is required when you have selected yes on the above field.",
        ];
        
        foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $key => $day){
            /* start times */
            $messages[$day . '.start_time.*.present']       = 'Required field.';
            $messages[$day . '.start_time.*.required_if']   = 'Required field.';
            $messages[$day . '.start_time.*.date_format']   = 'Incorrect format.';
            $messages[$day . '.start_time.*.before']        = 'Invalid time';
            /* end time */
            $messages[$day . '.end_time.*.present']         = 'Required field.';
            $messages[$day . '.end_time.*.required_if']     = 'Required field.';
            $messages[$day . '.end_time.*.date_format']     = 'Incorrect format.';
            /* day validation */
            $messages['day_' . $key .'.required_without_all']   = 'At least one day of the week in the calendar must be selected.';
        }

        /* if the user is logged in as an admin */
        if(auth()->check()){
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
        }

        return $messages;
    }
}
