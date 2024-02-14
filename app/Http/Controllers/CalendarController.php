<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\FrontUser;
use Illuminate\Http\Request;
 

class CalendarController extends Controller {
    
    public function store_calender($input, $id){
        $candidate = FrontUser::find($id);

        if(empty($input) || empty($candidate)){
            return 0;
        }
       
        $data = [
            'front_user_id' => $id,
            'monday'        => isset($input['monday']) ? json_encode($input['monday']) : null,
            'tuesday'       => isset($input['tuesday']) ? json_encode($input['tuesday']) : null,
            'wednesday'     => isset($input['wednesday']) ? json_encode($input['wednesday']) : null,
            'thursday'      => isset($input['thursday']) ? json_encode($input['thursday']) : null,
            'friday'        => isset($input['friday']) ? json_encode($input['friday']) : null,
            'saturday'      => isset($input['saturday']) ? json_encode($input['saturday']) : null,
            'sunday'        => isset($input['sunday']) ? json_encode($input['sunday']) : null,
            'status'        => 1,
        ];

        return $candidate->calendars()->updateOrCreate(['front_user_id' => $id], $data);
    }

    public function decode_calender($data){
        return $response = [
            'monday'    =>  !empty($data['monday']) ? json_decode($data['monday'], true) : [],
            'tuesday'   =>  !empty($data['tuesday']) ? json_decode($data['tuesday'], true) : [],
            'wednesday' =>  !empty($data['wednesday']) ? json_decode($data['wednesday'], true) : [],
            'thursday'  =>  !empty($data['thursday']) ? json_decode($data['thursday'], true) : [],
            'friday'    =>  !empty($data['friday']) ? json_decode($data['friday'], true) : [],
            'saturday'  =>  !empty($data['saturday']) ? json_decode($data['saturday'], true) : [],
            'sunday'    =>  !empty($data['sunday']) ? json_decode($data['sunday'], true) : [],
        ];
    }
}
