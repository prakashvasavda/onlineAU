@extends('layouts.main')
@section('content')
<div class="single-form-section">
    <div class="container">
        <div class="title-main">
            <h2>Welcome to Online Au-Pairs</h2>
            <h3>{{ isset($menu) ? ucfirst($menu) : null }}</h3>
        </div>
        @include('flash.front-message')
        <form method="POST" class="row" action="{{ route('update-candidate', ['id' => $candidate->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" value="{{ Route::current()->parameter('service') }}" name="role">
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label>Profile Photo <span class="text-danger">*</span></label>
                    <div class="box">
                        <div class="js--image-preview"></div>
                        <div class="upload-options">
                            <label>
                                <input type="file" id="profile" name="profile" class="image-upload" accept="image/*" >
                                <input type="hidden" name="hidden_profile" value="{{ isset($candidate->profile) ? 'true' : 'false' }}">
                            </label>
                        </div>
                    </div>
                </div>
                @if ($errors->has('profile'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('profile') }}</strong>
                    </span>
                @endif
            </div>

             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input mb-3">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" placeholder="" class="form-field @error('name') is-invalid @enderror" value="{{ old('name', isset($candidate->name) ? $candidate->name : null) }}" >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-input">
                    <label for="surname">Surname <span class="text-danger">*</span></label>
                    <input type="text" id="surname" name="surname" placeholder="" class="form-field" value="{{ old('surname', $candidate->surname) }}" >
                    @if ($errors->has('surname'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('surname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <div class="form-input">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="mail" id="email" name="email" placeholder="" class="form-field @error('email') is-invalid @enderror" autocomplete="off"  value="{{ old('email', isset($candidate->email) ? $candidate->email : null) }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="password">Password </label>
                    <input type="password" id="password" name="password" placeholder="" class="form-field @error('password') is-invalid @enderror" readonly onfocus="this.removeAttribute('readonly');">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="type_of_id_number">Type of ID Number <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap mt-2">
                        <li><input type="radio" checked name="type_of_id_number" value="south_african" {{ old('type_of_id_number', isset($candidate->type_of_id_number) ? $candidate->type_of_id_number : '') === "south_african" ? "checked" : '' }} >South African ID</li>
                        <li><input type="radio" name="type_of_id_number" value="other" {{ old('type_of_id_number', isset($candidate->type_of_id_number) ? $candidate->type_of_id_number : '') === "other" ? "checked" : '' }} >Foreign ID</li>
                    </ul>
                    @if ($errors->has('type_of_id_number'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('type_of_id_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
          
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="id_number">ID Number <span class="text-danger">*</span></label>
                    <input type="text" id="id_number" name="id_number" placeholder="" class="form-field @error('id_number') is-invalid @enderror"  value="{{ old('id_number', isset($candidate->id_number) ? $candidate->id_number : null) }}">
                    @error('id_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="age">Age <span class="text-danger">*</span></label>
                    <input type="number" id="age" name="age" placeholder="" class="form-field @error('age') is-invalid @enderror"  value="{{ old('age', isset($candidate->age) ? $candidate->age : null) }}">
                    @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
                    <input type="number" id="contact_number" name="contact_number" placeholder="" class="form-field @error('contact_number') is-invalid @enderror"  value="{{ old('contact_number', isset($candidate->contact_number) ? $candidate->contact_number : null) }}">
                    @error('contact_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
 
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="area">Type in your City <span class="text-danger">*</span></label>
                    <input type="text" id="area" name="area" placeholder="" class="form-field address-input @error('area') is-invalid @enderror"  value="{{ old('area', isset($candidate->area) ? $candidate->area : null) }}">
                    @error('area')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="gender">Gender <span class="text-danger">*</span></label>
                    <ul class="radio-box-list d-flex flex-wrap">
                        <li class="radio-box-item"><input type="radio" name="gender" value="male" {{ isset($candidate->gender) && $candidate->gender == 'male' ? 'checked' : null }}><label>Male</label></li>
                        <li class="radio-box-item"><input type="radio" name="gender" value="female" {{ isset($candidate->gender) && $candidate->gender == 'female' ? 'checked' : null }}><label>Female</label></li>
                        <li class="radio-box-item"><input type="radio" name="gender" value="other" {{ isset($candidate->gender) && $candidate->gender == 'other' ? 'checked' : null }}><label>Other</label></li>
                    </ul>
                </div>
                @if ($errors->has('gender'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="ethnicity">Ethnicity <span class="text-danger">*</span></label>
                    <input type="text" id="ethnicity" name="ethnicity" placeholder="" class="form-field" value="{{ old('ethnicity', isset($candidate->ethnicity) ? $candidate->ethnicity : null) }}">
                </div>
                @if ($errors->has('ethnicity'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('ethnicity') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="smoker_or_non_smoker">Smoker / Non-Smoker <span class="text-danger">*</span></label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" checked value="smoker" {{ old('smoker_or_non_smoker', $candidate->smoker_or_non_smoker) == 'smoker' ? 'checked' : '' }}><label>Smoker</label></li>
                        <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="non_smoker" {{ old('smoker_or_non_smoker', $candidate->smoker_or_non_smoker) == 'non_smoker' ? 'checked' : '' }}><label>Non Smoker</label></li>
                    </ul>
                </div>
                @if ($errors->has('smoker_or_non_smoker'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('smoker_or_non_smoker') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="home_language">Home Language <span class="text-danger">*</span></label>
                    <select id="home_language" name="home_language" class="form-field">
                        <option value="" selected="selected" disabled="disabled">Select one</option>
                        <option value="english" {{ isset($candidate->home_language) && $candidate->home_language == "english" ? 'selected' : null }}>English</option>
                        <option value="afrikaans" {{ isset($candidate->home_language) && $candidate->home_language == "afrikaans" ? 'selected' : null }}>Afrikaans</option>
                        <option value="zulu (isizulu)" {{ isset($candidate->home_language) && $candidate->home_language == "zulu (isizulu)" ? 'selected' : null }}>Zulu (isiZulu)</option>
                        <option value="xhosa (isixhosa)"  {{ isset($candidate->home_language) && $candidate->home_language == "xhosa (isixhosa)" ? 'selected' : null }}>Xhosa (isiXhosa)</option>
                        <option value="northern sotho (sesotho sa leboa)"  {{ isset($candidate->home_language) && $candidate->home_language == "northern sotho (sesotho sa leboa)" ? 'selected' : null }}>Northern Sotho (Sesotho sa Leboa)</option>
                        <option value="sotho (sesotho)" {{ isset($candidate->home_language) && $candidate->home_language == "otho (sesotho)" ? 'selected' : null }}>Sotho (Sesotho)</option>
                        <option value="swazi (siswati)" {{ isset($candidate->home_language) && $candidate->home_language == "wazi (siswati)" ? 'selected' : null }}>Swazi (siSwati)</option>
                        <option value="tsonga (xitsonga)" {{ isset($candidate->home_language) && $candidate->home_language == "tsonga (xitsonga)" ? 'selected' : null }}>Tsonga (Xitsonga)</option>
                        <option value="tswana (setswana)" {{ isset($candidate->home_language) && $candidate->home_language == "tswana (setswana)" ? 'selected' : null }}>Tswana (Setswana)</option>
                        <option value="venda (tshivenda)" {{ isset($candidate->home_language) && $candidate->home_language == "venda (tshivenda)" ? 'selected' : null }}>Venda (Tshivenda)</option>
                        <option value="southern ndebele (isindebele)" {{ isset($candidate->home_language) && $candidate->home_language == "southern ndebele (isindebele)" ? 'selected' : null }}>Southern Ndebele (isiNdebele)</option>
                        <option value="spanish" {{ isset($candidate->home_language) && $candidate->home_language == "spanish" ? 'selected' : null }}>Spanish</option>
                        <option value="french" {{ isset($candidate->home_language) && $candidate->home_language == "french" ? 'selected' : null }}>French</option>
                        <option value="hindi" {{ isset($candidate->home_language) && $candidate->home_language == "hindi" ? 'selected' : null }}>Hindi</option>
                        <option value="arabic" {{ isset($candidate->home_language) && $candidate->home_language == "arabic" ? 'selected' : null }}>Arabic</option>
                        <option value="bengali" {{ isset($candidate->home_language) && $candidate->home_language == "bengali" ? 'selected' : null }}>Bengali</option>
                        <option value="portuguese" {{ isset($candidate->home_language) && $candidate->home_language == "portuguese" ? 'selected' : null }}>Portuguese</option>
                        <option value="russian" {{ isset($candidate->home_language) && $candidate->home_language == "russian" ? 'selected' : null }}>Russian</option>
                        <option value="japanese" {{ isset($candidate->home_language) && $candidate->home_language == "japanese" ? 'selected' : null }}>Japanese</option>
                        <option value="punjabi" {{ isset($candidate->home_language) && $candidate->home_language == "punjabi" ? 'selected' : null }}>Punjabi</option>
                        <option value="german" {{ isset($candidate->home_language) && $candidate->home_language == "german" ? 'selected' : null }}>German</option>
                    </select>
                </div>
                @if ($errors->has('home_language'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('home_language') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="animals_comfortable_with">Which animals do you feel comfortable working with <span class="text-danger">*</span></label>
                    <select id="animals_comfortable_with" multiple name="animals_comfortable_with[]" class="form-field">
                        <option value="" disabled>Select</option>
                        <option value="dogs" {{ isset($candidate->animals_comfortable_with) && in_array("dogs", $candidate->animals_comfortable_with) ? "selected" : "" }}>Dogs</option>
                        <option value="cats" {{ isset($candidate->animals_comfortable_with) && in_array("cats", $candidate->animals_comfortable_with) ? "selected" : "" }}>Cats</option>
                        <option value="hamsters_and_guinea_pigs" {{ isset($candidate->animals_comfortable_with) && in_array("hamsters_and_guinea_pigs", $candidate->animals_comfortable_with) ? "selected" : "" }}>Hamsters &amp; Guinea pigs</option>
                        <option value="reptiles" {{ isset($candidate->animals_comfortable_with) && in_array("reptiles", $candidate->animals_comfortable_with) ? "selected" : "" }}>Reptiles</option>
                        <option value="spiders" {{ isset($candidate->animals_comfortable_with) && in_array("spiders", $candidate->animals_comfortable_with) ? "selected" : "" }}>Spiders</option>
                    </select> 
                    @if ($errors->has('animals_comfortable_with'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('animals_comfortable_with') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
          
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="disabilities">Disabilities <span class="text-danger">*</span></label>
                    <input type="text" id="disabilities" name="disabilities" placeholder="" class="form-field" value="{{ old('disabilities', isset($candidate->disabilities) ? $candidate->disabilities : null) }}">
                </div>
                @if ($errors->has('disabilities'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('disabilities') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="experience_with_animals">Do you have experience with animals <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="experience_with_animals" value="yes" {{ old('experience_with_animals', $candidate->experience_with_animals) == "yes" ? "checked" : '' }}>Yes</li>
                        <li><input type="radio" name="experience_with_animals" value="no" {{ old('experience_with_animals', $candidate->experience_with_animals) == "no" ? "checked" : '' }}>No</li>
                    </ul>
                </div>
                @if ($errors->has('experience_with_animals'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('experience_with_animals') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="do_you_like_animals">Do you like animals <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="do_you_like_animals" value="yes" {{ old('do_you_like_animals', $candidate->do_you_like_animals) == "yes" ? "checked" : '' }}>Yes</li>
                        <li><input type="radio" name="do_you_like_animals" value="no" {{ old('do_you_like_animals', $candidate->do_you_like_animals) == "no" ? "checked" : '' }}>No</li>
                    </ul>
                </div>
                @if ($errors->has('do_you_like_animals'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('do_you_like_animals') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="chronical_medication">Are you on any chronical medication <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="chronical_medication" value="yes" {{ isset($candidate->chronical_medication) && $candidate->chronical_medication == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="chronical_medication" value="no" {{ isset($candidate->chronical_medication) && $candidate->chronical_medication == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
                @if ($errors->has('chronical_medication'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('chronical_medication') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="childcare_experience">How many years of petsitting experience do you have <span class="text-danger">*</span></label>
                    <select id="childcare_experience" name="childcare_experience" class="form-field">
                        <option value="" selected="selected" disabled="disabled">Select</option>
                        <option value="6 months" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "6 months" ? "selected" : '' }}>6 Months</option>
                        <option value="1 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "1 years" ? "selected" : '' }}>1 years</option>
                        <option value="1.5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "1.5 years" ? "selected" : '' }}>1.5 years</option>
                        <option value="2 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "2 years" ? "selected" : '' }}>2 years</option>
                        <option value="2.5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "2.5 years" ? "selected" : '' }}>2.5 years</option>
                        <option value="3 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "3 yearsyearsyears" ? "selected" : '' }}>3 years</option>
                        <option value="3.5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "3.5 yearsyears" ? "selected" : '' }}>3.5 years</option>
                        <option value="4 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "4 years" ? "selected" : '' }}>4 years</option>
                        <option value="4.5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "4.5 yearsyearsyears" ? "selected" : '' }}>4.5 years</option>
                        <option value="5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "5 yearsyears" ? "selected" : '' }}>5 years</option>
                        <option value="5+ years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "5+ years" ? "selected" : '' }}>5+ years</option>
                    </select>
                </div>
                @if ($errors->has('childcare_experience'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('childcare_experience') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="salary_expectation">What is your hourly rate <span class="text-danger">*</span></label>
                    <div class="input-group mb-1">
                        <span class="input-group-text">R</span>
                            <input type="text" name="salary_expectation" id="salary_expectation" class="form-field" placeholder="" value="{{ old('salary_expectation', isset($candidate->salary_expectation) ? $candidate->salary_expectation : null) }}">
                        <span class="input-group-text">hr</span>
                    </div>
                    @if ($errors->has('salary_expectation'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('salary_expectation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="other_services">Other Services <span class="text-danger">*</span></label>
                    <select id="other_services" name="other_services[]" multiple class="form-field">
                        <option value="au-airs" {{ isset($candidate->role) && $candidate->role == "au-pairs" ? "disabled" : "" }} {{ (isset($candidate->other_services) && in_array("au-airs", $candidate->other_services)) ? "selected" : "" }}>Au-Pairs</option>
                        <option value="nannies" {{ isset($candidate->role) && $candidate->role == "nannies" ? "disabled" : "" }} {{ (isset($candidate->other_services) && in_array("nannies", $candidate->other_services)) ? "selected" : "" }}>Nannies</option>
                        <option value="babysitters" {{ isset($candidate->role) && $candidate->role == "babysitters" ? "disabled" : "" }} {{ (isset($candidate->other_services) &&  in_array("babysitters", $candidate->other_services)) ? "selected" : "" }}>babysitters</option>
                        <option value="petsitters" {{ isset($candidate->role) && $candidate->role == "petsitters" ? "disabled" : "" }} {{ (isset($candidate->other_services) && in_array("petsitters", $candidate->other_services)) ? "selected" : "" }}>petsitters</option>
                    </select>
                    @if ($errors->has('other_services'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('other_services') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="situated">Situated <span class="text-danger">*</span></label>
                    <input type="text" id="situated" name="situated" placeholder="" class="form-field @error('situated') is-invalid @enderror"  value="{{ old('situated', isset($candidate->situated) ? $candidate->situated : null) }}">
                    @error('situated')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
             <div class="col-12">
                <div class="form-inputs" id="dynamic_field">
                    <div class="d-flex flex-row justify-content-between align-items-start">
                        <label class="mb-2 fst-italic">List your previous childcare work experience with contactable references.</label>
                        <div class="icon-option all-in-one d-flex flex-row">
                            <p>Add Reference</p>
                            <a href="javaScript:;" class="btn btn-primary add-btn" id="add"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    
                    @if(isset($previous_experience) && !$previous_experience->isEmpty())
                        @foreach($previous_experience as $key => $value)
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="daterange">Date range <span class="text-danger">*</span></label>
                                        <input type="text" id={{ "daterange_" . $key }} name="daterange[]" class="form-field" placeholder=""  value="{{ old('daterange[]', isset($value->daterange) ? $value->daterange : null) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="heading">Heading <span class="text-danger">*</span></label>
                                        <input type="text" id={{ "heading_" . $key }} name="heading[]" class="form-field" placeholder="" value="{{ old('heading[]', isset($value->heading) ? $value->heading : null) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <input type="text" id={{ "description_" . $key }} name="description[]" class="form-field" placeholder="" value="{{ old('description[]', isset($value->description) ? $value->description : null) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="reference">Reference Name <span class="text-danger">*</span></label>
                                        <input type="text" id={{ "reference_" . $key }} name="reference[]" class="form-field" placeholder="" value="{{ old('reference[]', isset($value->reference) ? $value->reference : null) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="tel_number">Tel Number <span class="text-danger">*</span></label>
                                        <input type="text" id={{ "tel_number_" . $key }} name="tel_number[]" class="form-field" placeholder=""value="{{ old('tel_number[]', isset($value->tel_number) ? $value->tel_number : null) }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-input">
                                    <label for="daterange">Date range <span class="text-danger">*</span></label>
                                    <input type="text" id="daterange" name="daterange[]" value="{{ isset(old('daterange')[0]) ? old('daterange')[0] : '' }}" class="form-field" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-input">
                                    <label for="heading">Heading <span class="text-danger">*</span></label>
                                    <input type="text" id="heading" name="heading[]" value="{{ isset(old('heading')[0]) ? old('heading')[0] : null }}" class="form-field heading" placeholder="">
                                </div>
                                @error('heading.0')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-input">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <input type="text" id="description" name="description[]" value="{{ isset(old('description')[0]) ? old('description')[0] : null }}" class="form-field" placeholder="">
                                </div>
                                @error('description.0')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-input">
                                    <label for="reference">Reference Name <span class="text-danger">*</span></label>
                                    <input type="text" id="reference" name="reference[]" value="{{ isset(old('reference')[0]) ? old('reference')[0] : null }}" class="form-field" placeholder="">
                                </div>
                                @error('reference.0')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-input">
                                    <label for="tel_number">Tel Number <span class="text-danger">*</span></label>
                                    <input type="text" id="tel_number" name="tel_number[]" value="{{ isset(old('tel_number')[0]) ? old('tel_number')[0] : null }}" class="form-field" placeholder="">
                                </div>
                                @error('tel_number.0')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if(old('daterange') && is_array(old('daterange')))
                @foreach(old('daterange') as $key => $value)
                    @if(isset($key) && $key >= 1)
                        <div class="col-12">
                            <div class="form-inputs" id="dynamic_field">
                                <div class="row mt-4" id="row{{ isset($key) ? $key : null }}">
                                    <label class="mb-2 fst-italic">List your previous childcare work experience with contactable references.</label>
                                    <div class="icon-option all-in-one">
                                        <a href="javaScript:;" class="btn btn-danger delete-btn" id="{{ isset($key) ? $key : null }}"><i class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-input">
                                            <label for="daterange">Date range <span class="text-danger">*</span></label>
                                            <input type="text" id={{ "daterange_" . $key }} name="daterange[]" value="{{ isset(old('daterange')[$key]) ? old('daterange')[$key] : null }}" class="form-field" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-input">
                                            <label for="heading">Heading <span class="text-danger">*</span></label>
                                            <input type="text" id={{ "heading_" . $key }} name="heading[]" value="{{ isset(old('heading')[$key]) ? old('heading')[$key] : null }}" class="form-field heading" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-input">
                                            <label for="description">Description <span class="text-danger">*</span></label>
                                            <input type="text" id={{ "description_" . $key }} name="description[]" value="{{ isset(old('description')[$key]) ? old('description')[$key] : null }}" class="form-field" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-input">
                                            <label for="reference">Reference Name <span class="text-danger">*</span></label>
                                            <input type="text" id={{ "reference_" . $key }} name="reference[]" value="{{ isset(old('reference')[$key]) ? old('reference')[$key] : null }}" class="form-field" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-input">
                                            <label for="tel_number">Tel Number <span class="text-danger">*</span></label>
                                            <input type="text" id={{ "tel_number_" . $key }} name="tel_number[]" value="{{ isset(old('tel_number')[$key]) ? old('tel_number')[$key] : null }}" class="form-field" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

            <div class="row">
                
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="about_yourself">Tell us a bit more about yourself <span class="text-danger">*</span></label>
                <textarea id="about_yourself" name="about_yourself" class="form-field" rows="5" >{{ old('about_yourself', $candidate->about_yourself) }}</textarea>
                <p class="text-end fw-light fst-italic small">Maximum 500 Characters</p>
                @if ($errors->has('about_yourself'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('about_yourself') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="mb-2">
                    <label for="day_hour">What are your available days and hours</label>
                </div>
                <div class="table-responsive timeForm">
                    <table class="table table-borderless table-sm">
                        <tbody>
                            @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                <tr id="{{ $day }}-row">
                                    <td><input type="checkbox"></td>
                                    <td>{{ ucfirst($day) }}</td>
                                    <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][0] ?? null }}" placeholder="Add Time"></td>
                                    <td>to</td>
                                    <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][0] ?? null }}" placeholder="Add Time"></td>
                                    <td onclick="addCalendarRow('{{ $day }}')">
                                        <a href="javaScript:;" class="btn add-btn icon">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>
                                    </td>
                                </tr>

                                @if(isset($calendars[$day]) && !empty($calendars[$day]) && is_array($calendars[$day]))
                                    @foreach($calendars[$day]['start_time'] as $key => $value)
                                        @if(isset($key) && $key >= 1 && isset($calendars[$day]['start_time'][$key]) && isset($calendars[$day]['end_time'][$key]))
                                            <tr id="{{ $day }}-row">
                                                <td><input type="checkbox"></td>
                                                <td>{{ ucfirst($day) }}</td>
                                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][$key] }}" placeholder="Add Time"></td>
                                                <td>to</td>
                                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][$key] }}" placeholder="Add Time"></td>
                                                <td onclick="removeCalendarRow(event)">
                                                    <a href="javaScript:;" class="btn add-btn icon">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                
                                @if(old($day) && is_array(old($day)))
                                    @foreach(old($day)['start_time'] as $key => $value)
                                        @if(isset($key) && $key >= 1 && isset(old($day)['start_time'][$key]) && isset(old($day)['end_time'][$key]))
                                            <tr id="{{ $day }}-row">
                                                <td><input type="checkbox"></td>
                                                <td>{{ ucfirst($day) }}</td>
                                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][$key] }}" placeholder="Add Time"></td>
                                                <td>to</td>
                                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][$key] }}" placeholder="Add Time"></td>
                                                <td onclick="removeCalendarRow(event)">
                                                    <a href="javaScript:;" class="btn add-btn icon">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <p style="font-size: small; font-style: italic;">These hours are intended solely to provide a general indication of availability. Specific hours can be further discussed with the family as needed</p>
                </div>
                @if ($errors->has('calender'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('calender') }}</strong>
                    </span>
                @endif
            </div> 
            
            <div class="col-12">
                <div class="form-input-btn text-center">
                    <input type="submit" class="btn btn-primary round" value="update">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        var imageInput = $('#profile');
        imageInput.change(function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.js--image-preview').addClass('js--no-default');
                    $('.js--image-preview').html('<img src="' + e.target.result + '" alt="Image Preview">');
                };
                reader.readAsDataURL(file);
            } else {
                $('.js--image-preview').empty();
            }
        });

        @if($errors->any())
            var errorMessages = {!! json_encode($errors->toArray()) !!};
            const prefixesToCheck = ['heading.', 'description.', 'reference.', 'tel_number.', 'daterange.'];
            console.log(errorMessages);
            $.each(errorMessages, function(key, value) {
                if (prefixesToCheck.some(prefix => key.startsWith(prefix))) {
                    var newKey = key.replace(/\./g, '_');
                    $("#"+newKey).after(`
                        <span class="text-danger">
                            <strong>`+value+`</strong>
                        </span>
                    `);
                }
            });
        @endif
    });

    $(window).on("load", function () {
        var file = "{{ isset($candidate->profile) ? $candidate->profile : 'front-user.png' }}";
        if(file !== null){
            $('.js--image-preview').addClass('js--no-default');
            $('.js--image-preview').html('<img src="{{ asset('uploads/profile/') }}/' + file + '" alt="">');
        }
    });
</script>
@endsection
