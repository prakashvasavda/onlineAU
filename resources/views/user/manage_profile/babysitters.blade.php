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
                    <label for="name">Full Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" placeholder="" class="form-field @error('name') is-invalid @enderror" value="{{ old('name', isset($candidate->name) ? $candidate->name : null) }}" >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-input">
                    <label for="surname">Surname <span class="text-danger">*</span></label>
                    <input type="text" id="surname" name="surname" placeholder="" class="form-field" value="{{ old('name', $candidate->surname) }}" >
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
                    <label for="password">Password <span class="text-danger">*</span></label>
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
                    <label for="id_number">ID Number <span class="text-danger">*</span></label>
                    <input type="number" id="id_number" name="id_number" placeholder="" class="form-field"  value="{{ old('id_number', isset($candidate->id_number) ? $candidate->id_number : null) }}">
                    @if ($errors->has('id_number'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('id_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="contact_number">Contact Number</label>
                    <input type="number" id="contact_number" name="contact_number" placeholder="" class="form-field"  value="{{ old('contact_number', isset($candidate->contact_number) ? $candidate->contact_number : null) }}">
                    @if ($errors->has('contact_number'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('contact_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="other_services">Other Services </label>
                    <select id="other_services" name="other_services[]" multiple class="form-field">
                        <option value="au-pairs" {{ (isset($candidate->other_services) && is_array($candidate->other_services) && in_array("au-airs", $candidate->other_services)) ? "selected" : "" }}>Au-Pairs</option>
                        <option value="nannies" {{ (isset($candidate->other_services) && is_array($candidate->other_services) && in_array("nannies", $candidate->other_services)) ? "selected" : "" }}>Nannies</option>
                        <option value="petsitters" {{ (isset($candidate->other_services) && is_array($candidate->other_services) &&  in_array("petsitters", $candidate->other_services)) ? "selected" : "" }}>petsitters</option>
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
                    <label for="marital_status">Marital Status</label>
                    <ul class="radio-box-list d-flex flex-wrap">
                        <li class="radio-box-item"><input type="radio" name="marital_status" value="married" {{ isset($candidate->marital_status) && $candidate->marital_status == 'married' ? 'checked' : null }}><label>Married</label></li>
                        <li class="radio-box-item"><input type="radio" name="marital_status" value="single" {{ isset($candidate->marital_status) && $candidate->marital_status == 'single' ? 'checked' : null }}><label>Single</label></li>
                        <li class="radio-box-item"><input type="radio" name="marital_status" value="in a relationship" {{ isset($candidate->marital_status) && $candidate->marital_status == "in a relationship" ? 'checked' : null }}><label>In a Relationship</label></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="gender">Gender</label>
                    <ul class="radio-box-list d-flex flex-wrap">
                        <li class="radio-box-item"><input type="radio" name="gender" value="male" {{ isset($candidate->gender) && $candidate->gender == 'male' ? 'checked' : null }}><label>Male</label></li>
                        <li class="radio-box-item"><input type="radio" name="gender" value="female" {{ isset($candidate->gender) && $candidate->gender == 'female' ? 'checked' : null }}><label>Female</label></li>
                        <li class="radio-box-item"><input type="radio" name="gender" value="other" {{ isset($candidate->gender) && $candidate->gender == 'other' ? 'checked' : null }}><label>Other</label></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="ethnicity">Ethnicity</label>
                    <input type="text" id="ethnicity" name="ethnicity" placeholder="" class="form-field" value="{{ old('ethnicity', isset($candidate->ethnicity) ? $candidate->ethnicity : null) }}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="religion">Religion</label>
                    <select id="religion" name="religion" class="form-field">
                        <option value="" selected="selected" disabled="disabled">Select one</option>
                        <option value="african traditional and diasporic" {{ isset($candidate->religion) && $candidate->religion == 'african traditional and diasporic' ? 'selected' : null }}>African Traditional &amp; Diasporic</option>
                        <option value="agnostic" {{ isset($candidate->religion) && $candidate->religion == 'agnostic' ? 'selected' : null }}>Agnostic</option>
                        <option value="atheist" {{ isset($candidate->religion) && $candidate->religion == 'atheist' ? 'selected' : null }}>Atheist</option>
                        <option value="baha'i" {{ isset($candidate->religion) && $candidate->religion == "baha'i" ? 'selected' : null }}>Baha'i</option>
                        <option value="buddhism" {{ isset($candidate->religion) && $candidate->religion == 'buddhism' ? 'selected' : null }}>Buddhism</option>
                        <option value="cao dai" {{ isset($candidate->religion) && $candidate->religion == "cao dai" ? 'selected' : null }}>Cao Dai</option>
                        <option value="chinese traditional religion" {{ isset($candidate->religion) && $candidate->religion == "chinese traditional religion" ? 'selected' : null }}>Chinese traditional religion</option>
                        <option value="christianity" {{ isset($candidate->religion) && $candidate->religion == "christianity" ? 'selected' : null }}>Christianity</option>
                        <option value="hinduism" {{ isset($candidate->religion) && $candidate->religion == "hinduism" ? 'selected' : null }}>Hinduism</option>
                        <option value="islam" {{ isset($candidate->religion) && $candidate->religion == "islam" ? 'selected' : null }}>Islam</option>
                        <option value="jainism" {{ isset($candidate->religion) && $candidate->religion == "jainism" ? 'selected' : null }}>Jainism</option>
                        <option value="juche" {{ isset($candidate->religion) && $candidate->religion == "juche" ? 'selected' : null }}>Juche</option>
                        <option value="judaism" {{ isset($candidate->religion) && $candidate->religion == "judaism" ? 'selected' : null }}>Judaism</option>
                        <option value="neo-paganism" {{ isset($candidate->religion) && $candidate->religion == "neo-paganism" ? 'selected' : null }}>Neo-Paganism</option>
                        <option value="nonreligious" {{ isset($candidate->religion) && $candidate->religion == "nonreligious" ? 'selected' : null }}>Nonreligious</option>
                        <option value="rastafarianism" {{ isset($candidate->religion) && $candidate->religion == "rastafarianism" ? 'selected' : null }}>Rastafarianism</option>
                        <option value="secular" {{ isset($candidate->religion) && $candidate->religion == "secular" ? 'selected' : null }}>Secular</option>
                        <option value="shinto" {{ isset($candidate->religion) && $candidate->religion == "shinto" ? 'selected' : null }}>Shinto</option>
                        <option value="sikhism" {{ isset($candidate->religion) && $candidate->religion == "sikhism" ? 'selected' : null }}>Sikhism</option>
                        <option value="spiritism" {{ isset($candidate->religion) && $candidate->religion == "spiritism" ? 'selected' : null }}>Spiritism</option>
                        <option value="tenrikyo" {{ isset($candidate->religion) && $candidate->religion == "tenrikyo" ? 'selected' : null }}>Tenrikyo</option>
                        <option value="unitarian-universalism" {{ isset($candidate->religion) && $candidate->religion == "unitarian-universalism" ? 'selected' : null }}>Unitarian-Universalism</option>
                        <option value="zoroastrianism" {{ isset($candidate->religion) && $candidate->religion == "zoroastrianism" ? 'selected' : null }}>Zoroastrianism</option>
                        <option value="primal-indigenous" {{ isset($candidate->religion) && $candidate->religion == "primal-indigenous" ? 'selected' : null }}>primal-indigenous</option>
                        <option value="other" {{ isset($candidate->religion) && $candidate->religion == "other" ? 'selected' : null }}>Other</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="home_language">Home Language</label>
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
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="additional_language">Additional Language</label>
                    <select id="additional_language" name="additional_language" multiple class="form-field">
                        <option value="" disabled="disabled">Select one</option>
                        <option value="english" {{ isset($candidate->additional_language) && $candidate->additional_language == "english" ? 'selected' : null }}>English</option>
                        <option value="afrikaans" {{ isset($candidate->additional_language) && $candidate->additional_language == "afrikaans" ? 'selected' : null }}>Afrikaans</option>
                        <option value="zulu (isizulu)" {{ isset($candidate->additional_language) && $candidate->additional_language == "zulu (isizulu)" ? 'selected' : null }}>Zulu (isiZulu)</option>
                        <option value="xhosa (isixhosa)"  {{ isset($candidate->additional_language) && $candidate->additional_language == "xhosa (isixhosa)" ? 'selected' : null }}>Xhosa (isiXhosa)</option>
                        <option value="northern sotho (sesotho sa leboa)"  {{ isset($candidate->additional_language) && $candidate->additional_language == "northern sotho (sesotho sa leboa)" ? 'selected' : null }}>Northern Sotho (Sesotho sa Leboa)</option>
                        <option value="sotho (sesotho)" {{ isset($candidate->additional_language) && $candidate->additional_language == "otho (sesotho)" ? 'selected' : null }}>Sotho (Sesotho)</option>
                        <option value="swazi (siswati)" {{ isset($candidate->additional_language) && $candidate->additional_language == "wazi (siswati)" ? 'selected' : null }}>Swazi (siSwati)</option>
                        <option value="tsonga (xitsonga)" {{ isset($candidate->additional_language) && $candidate->additional_language == "tsonga (xitsonga)" ? 'selected' : null }}>Tsonga (Xitsonga)</option>
                        <option value="tswana (setswana)" {{ isset($candidate->additional_language) && $candidate->additional_language == "tswana (setswana)" ? 'selected' : null }}>Tswana (Setswana)</option>
                        <option value="venda (tshivenda)" {{ isset($candidate->additional_language) && $candidate->additional_language == "venda (tshivenda)" ? 'selected' : null }}>Venda (Tshivenda)</option>
                        <option value="southern ndebele (isindebele)" {{ isset($candidate->additional_language) && $candidate->additional_language == "southern ndebele (isindebele)" ? 'selected' : null }}>Southern Ndebele (isiNdebele)</option>
                        <option value="spanish" {{ isset($candidate->additional_language) && $candidate->additional_language == "spanish" ? 'selected' : null }}>Spanish</option>
                        <option value="french" {{ isset($candidate->additional_language) && $candidate->additional_language == "french" ? 'selected' : null }}>French</option>
                        <option value="hindi" {{ isset($candidate->additional_language) && $candidate->additional_language == "hindi" ? 'selected' : null }}>Hindi</option>
                        <option value="arabic" {{ isset($candidate->additional_language) && $candidate->additional_language == "arabic" ? 'selected' : null }}>Arabic</option>
                        <option value="bengali" {{ isset($candidate->additional_language) && $candidate->additional_language == "bengali" ? 'selected' : null }}>Bengali</option>
                        <option value="portuguese" {{ isset($candidate->additional_language) && $candidate->additional_language == "portuguese" ? 'selected' : null }}>Portuguese</option>
                        <option value="russian" {{ isset($candidate->additional_language) && $candidate->additional_language == "russian" ? 'selected' : null }}>Russian</option>
                        <option value="japanese" {{ isset($candidate->additional_language) && $candidate->additional_language == "japanese" ? 'selected' : null }}>Japanese</option>
                        <option value="punjabi" {{ isset($candidate->additional_language) && $candidate->additional_language == "punjabi" ? 'selected' : null }}>Punjabi</option>
                        <option value="german" {{ isset($candidate->additional_language) && $candidate->additional_language == "german" ? 'selected' : null }}>German</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="disabilities">Disabilities</label>
                    <input type="text" id="disabilities" name="disabilities" placeholder="" class="form-field" value="{{ old('disabilities', isset($candidate->disabilities) ? $candidate->disabilities : null) }}">
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="childcare_experience">How many years of childcare experience do you have</label>
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
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="area">Area<span class="text-danger">*</span></label>
                    <input type="text" id="area" name="area" placeholder="" class="form-field address-input"  value="{{ old('area', isset($candidate->area) ? $candidate->area : null) }}">
                    @if ($errors->has('area'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('area') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="ages_of_children_you_worked_with">Ages of children you worked with</label>
                    <select id="ages_of_children_you_worked_with" multiple name="ages_of_children_you_worked_with[]" class="form-field ">
                        <option value="" disabled>Select</option>
                        <option value="0_12_months" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("0_12_months", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>0-12 months</option>
                        <option value="1_3_years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("1_3_years", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>1-3 years</option>
                        <option value="4_7_years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("4_7_years", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>4-7 years</option>
                        <option value="8_13_years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("8_13_years", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>8-13 years</option>
                        <option value="13_16_years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("13_16_years", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>13-16 years</option>
                    </select>
                    @if ($errors->has('ages_of_children_you_worked_with'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('ages_of_children_you_worked_with') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="dependants">Do you have any dependants</label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="dependants" value="yes" {{ isset($candidate->dependants) && $candidate->dependants == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="dependants" value="no"  {{ isset($candidate->dependants) && $candidate->dependants == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="chronical_medication">Are you on any chronical medication</label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="chronical_medication" value="yes" {{ isset($candidate->chronical_medication) && $candidate->chronical_medication == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="chronical_medication" value="no" {{ isset($candidate->chronical_medication) && $candidate->chronical_medication == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="drivers_license">Do you have your drivers license</label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="drivers_license" value="yes" {{ isset($candidate->drivers_license) && $candidate->drivers_license == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="drivers_license" value="no" {{ isset($candidate->drivers_license) && $candidate->drivers_license == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="vehicle">Do you have your own vehicle</label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="vehicle" value="yes" {{ isset($candidate->vehicle) && $candidate->vehicle == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="vehicle" value="no" {{ isset($candidate->vehicle) && $candidate->vehicle == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="car_accident">Have you ever been in a car accident</label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="car_accident" value="yes" {{ isset($candidate->car_accident) && $candidate->car_accident == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="car_accident" value="no" {{ isset($candidate->car_accident) && $candidate->car_accident == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="experience_special_needs">Do you have experience with special needs</label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="experience_special_needs" value="yes" {{ isset($candidate->experience_special_needs) && $candidate->experience_special_needs == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="experience_special_needs" value="no" {{ isset($candidate->experience_special_needs) && $candidate->experience_special_needs == 'no' ? 'checked' : null }}>No</li>
                    </ul>
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
                                        <label for="daterange">Date range</label>
                                        <input type="text" id="daterange" name="daterange[]" class="form-field" placeholder=""  value="{{ old('daterange[]', isset($value->daterange) ? $value->daterange : null) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="heading">Heading</label>
                                        <input type="text" id="heading" name="heading[]" class="form-field" placeholder="" value="{{ old('heading[]', isset($value->heading) ? $value->heading : null) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="description">Description</label>
                                        <input type="text" id="description" name="description[]" class="form-field" placeholder="" value="{{ old('description[]', isset($value->description) ? $value->description : null) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="reference">Reference Name</label>
                                        <input type="text" id="reference" name="reference[]" class="form-field" placeholder="" value="{{ old('reference[]', isset($value->reference) ? $value->reference : null) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="tel_number">Tel Number</label>
                                        <input type="text" id="tel_number" name="tel_number[]" class="form-field" placeholder=""value="{{ old('tel_number[]', isset($value->tel_number) ? $value->tel_number : null) }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="daterange">Date range</label>
                                        <input type="text" id="daterange" name="daterange[]" value="10/01/2023 - 12/15/2023" class="form-field" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="heading">Heading</label>
                                        <input type="text" id="heading" name="heading[]" class="form-field" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="description">Description</label>
                                        <input type="text" id="description" name="description[]" class="form-field" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="reference">Reference Name</label>
                                        <input type="text" id="reference" name="reference[]" class="form-field" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="tel_number">Tel Number</label>
                                        <input type="text" id="tel_number" name="tel_number[]" class="form-field" placeholder="">
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>

            <div class="row">
                
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="hourly_rate_pay">What is your hourly rate <span class="text-danger">*</span></label>
                        <div class="input-group mb-1">
                            <span class="input-group-text">R</span>
                                <input type="text" name="hourly_rate_pay" id="hourly_rate_pay" class="form-field" placeholder="" value="{{ old('hourly_rate_pay', isset($candidate->hourly_rate_pay) ? $candidate->hourly_rate_pay : '') }}">
                            <span class="input-group-text">hr</span>
                        </div>
                    @if ($errors->has('hourly_rate_pay'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('hourly_rate_pay') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="situated">Situated</label>
                    <input type="text" id="situated" name="situated" placeholder="" class="form-field @error('situated') is-invalid @enderror"  value="{{ old('situated', isset($candidate->situated) ? $candidate->situated : null) }}">
                    @error('situated')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="day_hour">What are your available days and hours</label>
                    <div class="table-responsive">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                    <tr>
                                        <td></td>
                                        <th>Mo</th>
                                        <th>Tu</th>
                                        <th>We</th>
                                        <th>Th</th>
                                        <th>Fr</th>
                                        <th>Sa</th>
                                        <th>Su</th>
                                    </tr>
                                    <tr>
                                        <th>Morning: 07:00 – 13:00</th>
                                        <td>
                                            <label><input type="checkbox" name="morning[]" value="mo_morning" id="" {{ isset($morning_availability) && in_array("mo_morning", $morning_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="morning[]" value="tu_morning" id="" {{ isset($morning_availability) && in_array("tu_morning", $morning_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="morning[]" value="we_morning" id="" {{ isset($morning_availability) && in_array("we_morning", $morning_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="morning[]" value="th_morning" id="" {{ isset($morning_availability) && in_array("th_morning", $morning_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="morning[]" value="fr_morning" id="" {{ isset($morning_availability) && in_array("fr_morning", $morning_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="morning[]" value="sa_morning" id="" {{ isset($morning_availability) && in_array("sa_morning", $morning_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="morning[]" value="su_morning" id="" {{ isset($morning_availability) && in_array("su_morning", $morning_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Afternoon: 13:00 – 17:00</th>
                                        <td>
                                            <label><input type="checkbox" name="afternoon[]" value="mo_afternoon" id="" {{ isset($afternoon_availability) && in_array("mo_afternoon", $afternoon_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="afternoon[]" value="tu_afternoon" id="" {{ isset($afternoon_availability) && in_array("tu_afternoon", $afternoon_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="afternoon[]" value="we_afternoon" id="" {{ isset($afternoon_availability) && in_array("we_afternoon", $afternoon_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="afternoon[]" value="th_afternoon" id="" {{ isset($afternoon_availability) && in_array("th_afternoon", $afternoon_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="afternoon[]" value="fr_afternoon" id="" {{ isset($afternoon_availability) && in_array("fr_afternoon", $afternoon_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="afternoon[]" value="sa_afternoon" id="" {{ isset($afternoon_availability) && in_array("sa_afternoon", $afternoon_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="afternoon[]" value="su_afternoon" id="" {{ isset($afternoon_availability) && in_array("su_afternoon", $afternoon_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Evening: 17:00 – 21:00</th>
                                        <td>
                                            <label><input type="checkbox" name="evening[]" value="mo_evening" id="" {{ isset($evening_availability) && in_array("mo_evening", $evening_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="evening[]" value="tu_evening" id="" {{ isset($evening_availability) && in_array("tu_evening", $evening_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="evening[]" value="we_evening" id="" {{ isset($evening_availability) && in_array("we_evening", $evening_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="evening[]" value="th_evening" id="" {{ isset($evening_availability) && in_array("th_evening", $evening_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="evening[]" value="fr_evening" id="" {{ isset($evening_availability) && in_array("fr_evening", $evening_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="evening[]" value="sa_evening" id="" {{ isset($evening_availability) && in_array("sa_evening", $evening_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="evening[]" value="su_evening" id="" {{ isset($evening_availability) && in_array("su_evening", $evening_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                    </tr>
                                    <tr>
                                         <th>Night: 21:00 – 00:00</th>
                                        <td>
                                            <label><input type="checkbox" name="night[]" value="mo_night" id="" {{ isset($night_availability) && in_array("mo_night", $night_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="night[]" value="tu_night" id="" {{ isset($night_availability) && in_array("tu_night", $night_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="night[]" value="we_night" id="" {{ isset($night_availability) && in_array("we_night", $night_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="night[]" value="th_night" id="" {{ isset($night_availability) && in_array("th_night", $night_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="night[]" value="fr_night" id="" {{ isset($night_availability) && in_array("fr_night", $night_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="night[]" value="sa_night" id="" {{ isset($night_availability) && in_array("sa_night", $night_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                        <td>
                                            <label><input type="checkbox" name="night[]" value="su_night" id="" {{ isset($night_availability) && in_array("su_night", $night_availability ) ? 'checked' : '' }}></label>
                                        </td>
                                    </tr>
                                </tbody>
                        </table>
                        <p style="font-size: small; font-style: italic;">These hours are intended solely to provide a general indication of availability. Specific hours can be further discussed with the family as needed</p>
                    </div>
                    @error('morning')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
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


        $(window).on("load", function () {
            var file = "{{ isset($candidate->profile) ? $candidate->profile : 'user-profile.png' }}";
            if(file !== null){
                $('.js--image-preview').addClass('js--no-default');
                $('.js--image-preview').html('<img src="{{ url('../storage/app/public/uploads/') }}/' + file + '" alt="">');
            }
        });
    });
</script>
@endsection
