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
                                'status',
                                'role',
                            ];

}
