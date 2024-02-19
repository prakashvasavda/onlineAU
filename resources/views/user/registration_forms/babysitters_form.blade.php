@extends('layouts.register')
@section('content')
<div class="container">
    <div class="title-main">
        <h2>Welcome to Online Au-Pairs</h2>
        <h3>sign up to be {{isset($type) ? $type : ''}}</h3>
    </div>
    @include('flash.front-message')
    
    <form method="POST" class="row" action="{{ route('store_candidate') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ Route::current()->parameter('service') }}" name="role">
         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="name">Name <span class="text-danger small">*</span></label>
                <input type="text" id="name" name="name" placeholder="" class="form-field @error('name') is-invalid @enderror" value="{{ old('name') }}" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="surname">Surname <span class="text-danger small">*</span></label>
                <input type="text" id="surname" name="surname" placeholder="" class="form-field" value="{{ old('name') }}" >
                @if ($errors->has('surname'))
                    <span class="text-danger small">
                        <strong>{{ $errors->first('surname') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="email">Email Address <span class="text-danger small">*</span></label>
                <input type="mail" id="email" name="email" placeholder="" class="form-field @error('email') is-invalid @enderror"  value="{{ old('email') }}" autocomplete="off">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="password">Password <span class="text-danger small">*</span></label>
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
                    <li><input type="radio" checked name="type_of_id_number" value="south_african" {{ old('type_of_id_number') === "south_african" ? "checked" : '' }} >South African ID</li>
                    <li><input type="radio" name="type_of_id_number" value="other" {{ old('type_of_id_number') === "other" ? "checked" : '' }} >Foreign ID</li>
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
                <label for="id_number">ID Number <span class="text-danger small">*</span></label>
                <input type="text" id="id_number" name="id_number" placeholder="" class="form-field @error('id_number') is-invalid @enderror"  value="{{ old('id_number') }}">
                @error('id_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="age">Age <span class="text-danger small">*</span></label>
                <input type="number" id="age" name="age" placeholder="" class="form-field @error('age') is-invalid @enderror"  value="{{ old('age') }}">
                @error('age')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="profile">Profile Picture </label>
                <input type="file" id="profile" name="profile" placeholder="" class="form-field" accept="image/*" >
                @if ($errors->has('profile'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('profile') }}</strong>
                    </span>
                @endif
            </div>
        </div>

       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                <ul class="radio-box-list d-flex flex-wrap">
                    <li class="radio-box-item"><input type="radio" name="marital_status" value="married" {{ old('marital_status') == "married" ? "checked" : ''}}><label>Married</label></li>
                    <li class="radio-box-item"><input type="radio" name="marital_status" value="single" {{ old('marital_status') == "single" ? "checked" : ''}}><label>Single</label></li>
                    <li class="radio-box-item"><input type="radio" name="marital_status" value="in a relationship" {{ old('marital_status') == "in a relationship" ? "checked" : ''}}><label>In a Relationship</label></li>
                </ul>
                @if ($errors->has('marital_status'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('marital_status') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="gender">Gender <span class="text-danger">*</span></label>
                <ul class="radio-box-list d-flex flex-wrap">
                    <li class="radio-box-item"><input type="radio" name="gender" value="male" {{ old('gender') == "male" ? "checked" : '' }}><label>Male</label></li>
                    <li class="radio-box-item"><input type="radio" name="gender" value="female" {{ old('gender') == "female" ? "checked" : '' }}><label>Female</label></li>
                    <li class="radio-box-item"><input type="radio" name="gender" value="other" {{ old('gender') == "other" ? "checked" : '' }}><label>Other</label></li>
                </ul>
                @if ($errors->has('gender'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="ethnicity">Ethnicity <span class="text-danger">*</span></label>
                <input type="text" id="ethnicity" name="ethnicity" value="{{ old("ethnicity") }}" placeholder="" class="form-field">
                @if ($errors->has('ethnicity'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('ethnicity') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="religion">Religion <span class="text-danger">*</span></label>
                <select id="religion" name="religion" class="form-field">
                    <option value="" selected="selected" disabled="disabled">Select one</option>
                    <option value="african traditional and diasporic" {{ old('religion') == "african traditional and diasporic" ? "selected" : ''}}>African Traditional &amp; Diasporic</option>
                    <option value="agnostic" {{ old('religion') == "agnostic" ? "selected" : ''}}>Agnostic</option>
                    <option value="atheist" {{ old('religion') == "atheist" ? "selected" : ''}}>Atheist</option>
                    <option value="baha'i" {{ old('religion') == "baha'i" ? "selected" : ''}}>Baha'i</option>
                    <option value="buddhism" {{ old('religion') == "buddhism" ? "selected" : ''}}>Buddhism</option>
                    <option value="cao dai" {{ old('religion') == "cao dai" ? "selected" : ''}}>Cao Dai</option>
                    <option value="chinese traditional religion" {{ old('religion') == "chinese traditional religion" ? "selected" : ''}}>Chinese traditional religion</option>
                    <option value="christianity" {{ old('religion') == "christianity" ? "selected" : ''}}>Christianity</option>
                    <option value="hinduism" {{ old('religion') == "hinduism" ? "selected" : ''}}>Hinduism</option>
                    <option value="islam" {{ old('religion') == "islam" ? "selected" : ''}}>Islam</option>
                    <option value="jainism" {{ old('religion') == "jainism" ? "selected" : ''}}>Jainism</option>
                    <option value="juche" {{ old('religion') == "juche" ? "selected" : ''}}>Juche</option>
                    <option value="judaism" {{ old('religion') == "judaism" ? "selected" : ''}}>Judaism</option>
                    <option value="neo-paganism" {{ old('religion') == "neo-paganism" ? "selected" : ''}}>Neo-Paganism</option>
                    <option value="nonreligious" {{ old('religion') == "nonreligious" ? "selected" : ''}}>Nonreligious</option>
                    <option value="rastafarianism" {{ old('religion') == "rastafarianism" ? "selected" : ''}}>Rastafarianism</option>
                    <option value="secular" {{ old('religion') == "secular" ? "selected" : ''}}>Secular</option>
                    <option value="shinto" {{ old('religion') == "shinto" ? "selected" : ''}}>Shinto</option>
                    <option value="sikhism" {{ old('religion') == "sikhism" ? "selected" : ''}}>Sikhism</option>
                    <option value="spiritism" {{ old('religion') == "spiritism" ? "selected" : ''}}>Spiritism</option>
                    <option value="tenrikyo" {{ old('religion') == "tenrikyo" ? "selected" : ''}}>Tenrikyo</option>
                    <option value="unitarian-universalism" {{ old('religion') == "unitarian-universalism" ? "selected" : ''}}>Unitarian-Universalism</option>
                    <option value="zoroastrianism" {{ old('religion') == "zoroastrianism" ? "selected" : ''}}>Zoroastrianism</option>
                    <option value="primal-indigenous" {{ old('religion') == "primal-indigenous" ? "selected" : ''}}>primal-indigenous</option>
                    <option value="other" {{ old('religion') == "other" ? "selected" : ''}}>Other</option>
                </select>
                @if ($errors->has('religion'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('religion') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="home_language">Home Language <span class="text-danger">*</span></label>
                <select id="home_language" name="home_language" class="form-field">
                    <option value="" selected="selected" disabled="disabled">Select one</option>
                    <option value="english" {{ old('home_language') === 'english' ? 'selected' : '' }}>English</option>
                    <option value="afrikaans" {{ old('home_language') === 'afrikaans' ? 'selected' : '' }}>Afrikaans</option>
                    <option value="zulu (isizulu)" {{ old('home_language') === 'zulu (isizulu)' ? 'selected' : '' }}>Zulu (isiZulu)</option>
                    <option value="xhosa (isixhosa)" {{ old('home_language') === 'xhosa (isixhosa)' ? 'selected' : '' }}>Xhosa (isiXhosa)</option>
                    <option value="northern sotho (sesotho sa leboa)" {{ old('home_language') === 'northern sotho (sesotho sa leboa)' ? 'selected' : '' }}>Northern Sotho (Sesotho sa Leboa)</option>
                    <option value="sotho (sesotho)" {{ old('home_language') === 'sotho (sesotho)' ? 'selected' : '' }}>Sotho (Sesotho)</option>
                    <option value="swazi (siswati)" {{ old('home_language') === 'swazi (siswati)' ? 'selected' : '' }}>Swazi (siSwati)</option>
                    <option value="tsonga (xitsonga)" {{ old('home_language') === 'tsonga (xitsonga)' ? 'selected' : '' }}>Tsonga (Xitsonga)</option>
                    <option value="tswana (setswana)" {{ old('home_language') === 'tswana (setswana)' ? 'selected' : '' }}>Tswana (Setswana)</option>
                    <option value="venda (tshivenda)" {{ old('home_language') === 'venda (tshivenda)' ? 'selected' : '' }}>Venda (Tshivenda)</option>
                    <option value="southern ndebele (isindebele)" {{ old('home_language') === 'southern ndebele (isindebele)' ? 'selected' : '' }}>Southern Ndebele (isiNdebele)</option>
                    <option value="spanish" {{ old('home_language') === 'spanish' ? 'selected' : '' }}>Spanish</option>
                    <option value="french" {{ old('home_language') === 'french' ? 'selected' : '' }}>French</option>
                    <option value="hindi" {{ old('home_language') === 'hindi' ? 'selected' : '' }}>Hindi</option>
                    <option value="arabic" {{ old('home_language') === 'arabic' ? 'selected' : '' }}>Arabic</option>
                    <option value="bengali" {{ old('home_language') === 'bengali' ? 'selected' : '' }}>Bengali</option>
                    <option value="portuguese" {{ old('home_language') === 'portuguese' ? 'selected' : '' }}>Portuguese</option>
                    <option value="russian" {{ old('home_language') === 'russian' ? 'selected' : '' }}>Russian</option>
                    <option value="japanese" {{ old('home_language') === 'japanese' ? 'selected' : '' }}>Japanese</option>
                    <option value="punjabi" {{ old('home_language') === 'punjabi' ? 'selected' : '' }}>Punjabi</option>
                    <option value="german" {{ old('home_language') === 'german' ? 'selected' : '' }}>German</option>
                </select>
                @if ($errors->has('home_language'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('home_language') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="additional_language">Additional Language <span class="text-danger">*</span></label>
                <select id="additional_language" name="additional_language" class="form-field">
                    <option value="" >Select</option>
                    <option value="english" {{ old('additional_language') === 'english' ? 'selected' : '' }}>English</option>
                    <option value="afrikaans" {{ old('additional_language') === 'afrikaans' ? 'selected' : '' }}>Afrikaans</option>
                    <option value="zulu (isizulu)" {{ old('additional_language') === 'zulu (isizulu)' ? 'selected' : '' }}>Zulu (isiZulu)</option>
                    <option value="xhosa (isixhosa)" {{ old('home_language') === 'xhosa (isixhosa)' ? 'selected' : '' }}>Xhosa (isiXhosa)</option>
                    <option value="northern sotho (sesotho sa leboa)" {{ old('additional_language') === 'northern sotho (sesotho sa leboa)' ? 'selected' : '' }}>Northern Sotho (Sesotho sa Leboa)</option>
                    <option value="sotho (sesotho)" {{ old('additional_language') === 'sotho (sesotho)' ? 'selected' : '' }}>Sotho (Sesotho)</option>
                    <option value="swazi (siswati)" {{ old('additional_language') === 'swazi (siswati)' ? 'selected' : '' }}>Swazi (siSwati)</option>
                    <option value="tsonga (xitsonga)" {{ old('additional_language') === 'tsonga (xitsonga)' ? 'selected' : '' }}>Tsonga (Xitsonga)</option>
                    <option value="tswana (setswana)" {{ old('additional_language') === 'tswana (setswana)' ? 'selected' : '' }}>Tswana (Setswana)</option>
                    <option value="venda (tshivenda)" {{ old('additional_language') === 'venda (tshivenda)' ? 'selected' : '' }}>Venda (Tshivenda)</option>
                    <option value="southern ndebele (isindebele)" {{ old('additional_language') === 'southern ndebele (isindebele)' ? 'selected' : '' }}>Southern Ndebele (isiNdebele)</option>
                    <option value="spanish" {{ old('additional_language') === 'spanish' ? 'selected' : '' }}>Spanish</option>
                    <option value="french" {{ old('additional_language') === 'french' ? 'selected' : '' }}>French</option>
                    <option value="hindi" {{ old('additional_language') === 'hindi' ? 'selected' : '' }}>Hindi</option>
                    <option value="arabic" {{ old('additional_language') === 'arabic' ? 'selected' : '' }}>Arabic</option>
                    <option value="bengali" {{ old('additional_language') === 'bengali' ? 'selected' : '' }}>Bengali</option>
                    <option value="portuguese" {{ old('additional_language') === 'portuguese' ? 'selected' : '' }}>Portuguese</option>
                    <option value="russian" {{ old('additional_language') === 'russian' ? 'selected' : '' }}>Russian</option>
                    <option value="japanese" {{ old('additional_language') === 'japanese' ? 'selected' : '' }}>Japanese</option>
                    <option value="punjabi" {{ old('additional_language') === 'punjabi' ? 'selected' : '' }}>Punjabi</option>
                    <option value="german" {{ old('additional_language') === 'german' ? 'selected' : '' }}>German</option>
                </select>
            </div>
            @if ($errors->has('additional_language'))
                <span class="text-danger">
                    <strong>{{ $errors->first('additional_language') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="contact_number">Contact Number</label>
                <input type="number" id="contact_number" name="contact_number" placeholder="" class="form-field @error('contact_number') is-invalid @enderror"  value="{{ old('contact_number') }}">
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
                <input type="text" id="area" name="area" placeholder="" class="form-field @error('area') is-invalid @enderror address-input"  value="{{ old('area') }}">
                @if ($errors->has('area'))
                    <span class="text-danger small">
                        <strong>{{ $errors->first('area') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="dependants">Do you have any dependants <span class="text-danger">*</span></label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="dependants" value="yes" {{ old('dependants') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="dependants" value="no" {{ old('dependants') == "no" ? "checked" : '' }}>No</li>
                </ul>
                @if ($errors->has('dependants'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('dependants') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="chronical_medication">Are you on any chronical medication <span class="text-danger">*</span></label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="chronical_medication" value="yes" {{ old('chronical_medication') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="chronical_medication" value="no" {{ old('chronical_medication') == "no" ? "checked" : '' }}>No</li>
                </ul>
                @if ($errors->has('chronical_medication'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('chronical_medication') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="drivers_license">Do you have your drivers license <span class="text-danger">*</span></label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="drivers_license" value="yes" {{ old('drivers_license') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="drivers_license" value="no" {{ old('drivers_license') == "no" ? "checked" : '' }}>No</li>
                </ul>
                @if ($errors->has('drivers_license'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('drivers_license') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="vehicle">Do you have your own vehicle <span class="text-danger">*</span></label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="vehicle" value="yes" {{ old('vehicle') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="vehicle" value="no" {{ old('vehicle') == "no" ? "checked" : '' }}>No</li>
                </ul>
                @if ($errors->has('vehicle'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('vehicle') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="car_accident">Have you ever been in a car accident <span class="text-danger">*</span></label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="car_accident" value="yes" {{ old('car_accident') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="car_accident" value="no" {{ old('car_accident') == "no" ? "checked" : '' }}>No</li>
                </ul>
                @if ($errors->has('car_accident'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('car_accident') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="experience_special_needs">Do you have experience with special needs <span class="text-danger">*</span></label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="experience_special_needs" value="yes" {{ old('experience_special_needs') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="experience_special_needs" value="no" {{ old('experience_special_needs') == "no" ? "checked" : '' }}>No</li>
                </ul>
                @if ($errors->has('experience_special_needs'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('experience_special_needs') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="first_aid">Do you have first aid <span class="text-danger">*</span></label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="first_aid" value="yes" {{ old('first_aid') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="first_aid" value="no" {{ old('first_aid') == "no" ? "checked" : '' }}>No</li>
                </ul>
                @if ($errors->has('first_aid'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('first_aid') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="smoker_or_non_smoker">Smoker / Non-Smoker <span class="text-danger">*</span></label>
                <ul class="radio-box-list">
                    <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" checked value="smoker" {{ old('smoker_or_non_smoker') === 'smoker' ? 'checked' : '' }}><label>Smoker</label></li>
                    <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="non_smoker" {{ old('smoker_or_non_smoker') === 'non_smoker' ? 'checked' : '' }}><label>Non Smoker</label></li>
                </ul>
                @if ($errors->has('smoker_or_non_smoker'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('smoker_or_non_smoker') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="childcare_experience">How many years of childcare experience do you have <span class="text-danger">*</span></label>
                <select id="childcare_experience" name="childcare_experience" class="form-field">
                    <option value="" selected="selected" disabled="disabled">Select</option>
                    <option value="6 months" {{ old('childcare_experience') == "6 months" ? "selected" : '' }}>6 Months</option>
                    <option value="1 years" {{ old('childcare_experience') == "1 years" ? "selected" : '' }}>1 year</option>
                    <option value="1.5 years" {{ old('childcare_experience') == "1.5 years" ? "selected" : '' }}>1.5 years</option>
                    <option value="2 years" {{ old('childcare_experience') == "2 years" ? "selected" : '' }}>2 years</option>
                    <option value="2.5 years" {{ old('childcare_experience') == "2.5 years" ? "selected" : '' }}>2.5 years</option>
                    <option value="3 years" {{ old('childcare_experience') == "3 years" ? "selected" : '' }}>3 years</option>
                    <option value="3.5 years" {{ old('childcare_experience') == "3.5 years" ? "selected" : '' }}>3.5 years</option>
                    <option value="4 years" {{ old('childcare_experience') == "4 years" ? "selected" : '' }}>4 years</option>
                    <option value="4.5 years" {{ old('childcare_experience') == "4.5 years" ? "selected" : '' }}>4.5 years</option>
                    <option value="5 years" {{ old('childcare_experience') == "5 years" ? "selected" : '' }}>5 years</option>
                    <option value="5+ years" {{ old('childcare_experience') == "5+ years" ? "selected" : '' }}>5+ years</option>
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
                <label for="ages_of_children_you_worked_with">Ages of children you worked with <span class="text-danger small">*</span></label>
                <select id="ages_of_children_you_worked_with" multiple name="ages_of_children_you_worked_with[]" class="form-field ">
                    <option value="" disabled>Select</option>
                    <option value="0_12_months" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("0_12_months", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>0-12 months</option>
                    <option value="1_3_years" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("1_3_years", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>1-3 years</option>
                    <option value="4_7_years" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("4_7_years", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>4-7 years</option>
                    <option value="8_13_years" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("8_13_years", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>8-13 years</option>
                    <option value="13_16_years" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("13_16_years", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>13-16 years</option>
                </select>
                @if ($errors->has('ages_of_children_you_worked_with'))
                    <span class="text-danger small">
                        <strong>{{ $errors->first('ages_of_children_you_worked_with') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-none">
            <div class="form-input">
                <label for="other_services">Other Services </label>
                <select id="other_services" name="other_services[]" multiple class="form-field">
                    <option value="au-pairs" {{ !empty(old('other_services')) && is_array(old('other_services')) && in_array("au-pairs", old('other_services')) ? "selected" : "" }}>Au-Pairs</option>
                    <option value="nannies" {{ !empty(old('other_services')) && is_array(old('other_services')) && in_array("nannies", old('other_services')) ? "selected" : "" }}>Nannies</option>
                    <option value="petsitters" {{ !empty(old('other_services')) && is_array(old('other_services')) && in_array("petsitters", old('other_services')) ? "selected" : "" }}>petsitters</option>
                </select>
                @if ($errors->has('other_services'))
                    <span class="text-danger small">
                        <strong>{{ $errors->first('other_services') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="hourly_rate_pay">What is your hourly rate <span class="text-danger small">*</span></label>
                    <div class="input-group mb-1">
                        <span class="input-group-text">R</span>
                            <input type="text" name="hourly_rate_pay" id="hourly_rate_pay" class="form-field" placeholder="" value="{{old('hourly_rate_pay')}}">
                        <span class="input-group-text">hr</span>
                    </div>
                @if ($errors->has('hourly_rate_pay'))
                    <span class="text-danger small">
                        <strong>{{ $errors->first('hourly_rate_pay') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="disabilities">Disabilities <span class="text-danger fw-bolder">*</span></label>
                <input type="text" id="disabilities" name="disabilities" value="{{ old('disabilities') }}" placeholder="" class="form-field">
            </div>
            @if ($errors->has('disabilities'))
                <span class="text-danger">
                    <strong>{{ $errors->first('disabilities') }}</strong>
                </span>
            @endif
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
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="daterange">Date range</label>
                            <input type="text" id="daterange" name="daterange[]" value="{{ isset(old('daterange')[0]) ? old('daterange')[0] : '10/01/2023 - 12/15/2023' }}" class="form-field" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="heading">Heading</label>
                            <input type="text" id="heading" name="heading[]" value="{{ isset(old('heading')[0]) ? old('heading')[0] : null }}" class="form-field" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description[]" value="{{ isset(old('description')[0]) ? old('description')[0] : null }}" class="form-field" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="reference">Reference Name</label>
                            <input type="text" id="reference" name="reference[]" value="{{ isset(old('reference')[0]) ? old('reference')[0] : null }}" class="form-field" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="tel_number">Tel Number</label>
                            <input type="text" id="tel_number" name="tel_number[]" value="{{ isset(old('tel_number')[0]) ? old('tel_number')[0] : null }}" class="form-field" placeholder="">
                        </div>
                    </div>
                </div>
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
                                        <label for="daterange">Date range</label>
                                        <input type="text" id="daterange" name="daterange[]" value="{{ isset(old('daterange')[$key]) ? old('daterange')[$key] : null }}" class="form-field" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="heading">Heading</label>
                                        <input type="text" id="heading" name="heading[]" value="{{ isset(old('heading')[$key]) ? old('heading')[$key] : null }}" class="form-field" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="description">Description</label>
                                        <input type="text" id="description" name="description[]" value="{{ isset(old('description')[$key]) ? old('description')[$key] : null }}" class="form-field" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="reference">Reference Name</label>
                                        <input type="text" id="reference" name="reference[]" value="{{ isset(old('reference')[$key]) ? old('reference')[$key] : null }}" class="form-field" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label for="tel_number">Tel Number</label>
                                        <input type="text" id="tel_number" name="tel_number[]" value="{{ isset(old('tel_number')[$key]) ? old('tel_number')[$key] : null }}" class="form-field" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label for="about_yourself">Tell us a bit more about yourself <span class="text-danger">*</span></label>
            <textarea id="about_yourself" name="about_yourself" class="form-field" rows="5" >{{ old('about_yourself') }}</textarea>
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
                                <td><input type="time" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][0] ?? null }}"></td>
                                <td>to</td>
                                <td><input type="time" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][0] ?? null }}"></td>
                                <td onclick="addCalendarRow('{{ $day }}')">
                                    <a href="javaScript:;" class="btn add-btn icon">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </td>
                            </tr>

                            @if(old($day) && is_array(old($day)))
                                @foreach(old($day)['start_time'] as $key => $value)
                                    @if(isset($key) && $key >= 1 && isset(old($day)['start_time'][$key]) && isset(old($day)['end_time'][$key]))
                                        <tr id="{{ $day }}-row">
                                            <td><input type="checkbox"></td>
                                            <td>{{ ucfirst($day) }}</td>
                                            <td><input type="time" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][$key] }}"></td>
                                            <td>to</td>
                                            <td><input type="time" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][$key] }}"></td>
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

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-none">
            <div class="form-input">
                <div class="form-input d-flex flex-wrap mb-2">
                    <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" checked autocomplete="off">
                    <label class="form-check-label" for="terms_and_conditions"> 
                        <p><a href="{{ route('terms-and-conditions', ['service' => 'candidate']) }}" target="_blank">Accept Terms and Conditions </a></p>
                    </label>
                </div>

                @if ($errors->has('terms_and_conditions'))
                    <span class="text-danger small">
                        <strong>{{ $errors->first('terms_and_conditions') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-input-btn text-center">
                <input type="submit" class="btn btn-primary round" value="signup">
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection
