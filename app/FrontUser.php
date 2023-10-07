<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrontUser extends Model
{
    protected $guarded = [];
    protected $table   = 'front_users';
    protected $fillable = [
        'name',
        'age',
        'profile',
        'id_number',
        'contact_number',
        'email',
        'password',
        'situated',
        'area',
        'gender',
        'ethnicity',
        'religion',
        'home_language',
        'additional_language',
        'disabilities',
        'marital_status',
        'dependants',
        'chronical_medication',
        'drivers_license',
        'vehicle',
        'car_accident',
        'childcare_experience',
        'experience_special_needs',
        'salary_expectation',
        'available_day',
        'family_city',
        'family_address',
        'no_children',
        'describe_kids',
        'family_description',
        'family_types_babysitter',
        'family_location',
        'family_babysitter_comfortable',
        'family_profile_see',
        'family_notifications',
        'family_special_need_option',
        'family_special_need_value',
        'status',
        'role',
        'email_verified_at',
        'remember_token',
    ];


}
