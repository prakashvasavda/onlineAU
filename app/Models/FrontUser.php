<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FrontUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table   = 'front_users';
    protected $dates = ['deleted_at'];
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
        'type_of_pet',
        'how_many_pets',
        'number_of_pets',
        'pet_medication_or_disabilities',
        'pet_medication_or_disabilities_specification',
        'hourly_rate_pay',
        'type_of_id_number',
        'pet_medication_specify',
    ];

    public function needs_babysitter(){
        return $this->hasOne(NeedsBabysitter::class, 'family_id');
    }

    public function previous_experience(){
        return $this->hasMany(PreviousExperience::class, 'candidate_id');
    }

    public function candidate_reviews(){
        return $this->hasMany(CandidateReview::class, 'candidate_id');
    }

    public function family_reviews(){
        return $this->hasMany(FamilyReview::class, 'family_id');
    }

    public function user_subscriptions(){
        return $this->hasMany(UserSubscription::class, 'user_id');
    }

    public function calendars(){
        return $this->hasOne(Calendar::class, 'front_user_id');
    }

    protected static function boot(){
        parent::boot();

        static::deleting(function ($front_user) {
            $front_user->needs_babysitter()->delete();
            $front_user->candidate_reviews()->delete();
            $front_user->family_reviews()->delete();
            $front_user->user_subscriptions()->delete();
        });
    }
}
