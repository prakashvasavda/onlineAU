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
        'other_services',
        'south_african_citizen',
        'working_permit',
        'ages_of_children_you_worked_with',
        'first_aid',
        'smoker_or_non_smoker',
        'available_date',
        'about_yourself',
        'comfortable_with_light_housework',
        'petrol_reimbursement',
        'experience_with_animals',
        'do_you_like_animals',
        'surname',
        'terms_and_conditions',
        'cell_number',
        'start_date',
        'duration_needed',
        'candidate_duties',
        'what_do_you_need',
        'animals_comfortable_with',
        'gender_of_children',
        'live_in_or_live_out',
        'special_needs_specifications',
    ];

    public function needs_babysitter(){
        return $this->hasOne(NeedsBabysitter::class, 'family_id');
    }

    public function previous_experience(){
        return $this->hasMany(PreviousExperience::class, 'candidate_id');
    }
}
