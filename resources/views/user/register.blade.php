@extends('layouts.register')

@section('content')
<div class="container">
    <div class="title-main">
        <h2>Welcome to Online Au-Pairs</h2>
        <h3>sign up to be {{isset($type) ? $type : ''}}</h3>
    </div>
    @include('flash.flash-message')


    <form method="POST" class="row" action="{{ route('store_candidate') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ Route::current()->parameter('service') }}" name="role">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="name">Full Name <span class="text-danger">*</span></label>
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
                <label for="age">Age <span class="text-danger">*</span></label>
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
                <input type="file" id="profile" name="profile" placeholder="" class="form-field" >
                @error('profile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="id_number">ID Number <span class="text-danger">*</span></label>
                <input type="number" id="id_number" name="id_number" placeholder="" class="form-field @error('id_number') is-invalid @enderror"  value="{{ old('id_number') }}">
                @error('id_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
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
                <label for="email">Email Address <span class="text-danger">*</span></label>
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
                <label for="situated">Situated</label>
                <input type="text" id="situated" name="situated" placeholder="" class="form-field @error('situated') is-invalid @enderror"  value="{{ old('situated') }}">
                @error('situated')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="area">Area <span class="text-danger">*</span></label>
                <input type="text" id="address-input" name="area" placeholder="" class="form-field @error('area') is-invalid @enderror"  value="{{ old('area') }}">
                @error('area')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="gender">Gender</label>
                <ul class="radio-box-list d-flex flex-wrap">
                    <li class="radio-box-item"><input type="radio" name="gender" value="male" {{ old('gender') == "male" ? "checked" : '' }}><label>Male</label></li>
                    <li class="radio-box-item"><input type="radio" name="gender" value="female" {{ old('gender') == "female" ? "checked" : '' }}><label>Female</label></li>
                    <li class="radio-box-item"><input type="radio" name="gender" value="other" {{ old('gender') == "other" ? "checked" : '' }}><label>Other</label></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="ethnicity">Ethnicity</label>
                <input type="text" id="ethnicity" name="ethnicity" value="{{ old("ethnicity") }}" placeholder="" class="form-field">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="religion">Religion</label>
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
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="home_language">Home Language</label>
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
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="additional_language">Additional Language</label>
                <select id="additional_language" name="additional_language" class="form-field">
                    <option value="" disabled="disabled">Select</option>
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
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="disabilities">Disabilities</label>
                <input type="text" id="disabilities" name="disabilities" value="{{ old('disabilities') }}" placeholder="" class="form-field">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="marital_status">Marital Status</label>
                <ul class="radio-box-list d-flex flex-wrap">
                    <li class="radio-box-item"><input type="radio" name="marital_status" value="married" {{ old('marital_status') == "married" ? "checked" : ''}}><label>Married</label></li>
                    <li class="radio-box-item"><input type="radio" name="marital_status" value="single" {{ old('marital_status') == "single" ? "checked" : ''}}><label>Single</label></li>
                    <li class="radio-box-item"><input type="radio" name="marital_status" value="in a relationship" {{ old('marital_status') == "in a relationship" ? "checked" : ''}}><label>In a Relationship</label></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="dependants">Do you have any dependants</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="dependants" value="yes" {{ old('dependants') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="dependants" value="no" {{ old('dependants') == "no" ? "checked" : '' }}>No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="chronical_medication">Are you on any chronical medication</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="chronical_medication" value="yes" {{ old('chronical_medication') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="chronical_medication" value="no" {{ old('chronical_medication') == "no" ? "checked" : '' }}>No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="drivers_license">Do you have your drivers license</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="drivers_license" value="yes" {{ old('drivers_license') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="drivers_license" value="no" {{ old('drivers_license') == "no" ? "checked" : '' }}>No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="vehicle">Do you have your own vehicle</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="vehicle" value="yes" {{ old('vehicle') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="vehicle" value="no" {{ old('vehicle') == "yes" ? "checked" : '' }}>No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="car_accident">Have you ever been in a car accident</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="car_accident" value="yes" {{ old('car_accident') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="car_accident" value="no" {{ old('car_accident') == "no" ? "checked" : '' }}>No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="childcare_experience">How many years of childcare experience do you have</label>
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
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="experience_special_needs">Do you have experience with special needs</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="experience_special_needs" value="yes" {{ old('experience_special_needs') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="experience_special_needs" value="no" {{ old('experience_special_needs') == "no" ? "checked" : '' }}>No</li>
                </ul>
            </div>
        </div>

        <div class="col-12">
            <div class="form-inputs" id="dynamic_field">
                <label class="mb-2 fst-italic">List your previous childcare work experience with contactable references.</label>
                <div class="icon-option all-in-one">
                    <a href="javaScript:;" class="btn btn-primary add-btn" id="add"><i class="fa-solid fa-plus"></i></a>
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
            <div class="form-input">
                <label for="salary_expectation">What is your salary expectation/hourly rate</label>
                <input type="number" id="salary_expectation" name="salary_expectation" placeholder="" class="form-field @error('salary_expectation') is-invalid @enderror"  value="{{ old('salary_expectation') }}">
                @error('salary_expectation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="day_hour">What are your available days and hours <span class="text-danger">*</span></label>
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
                                    <th>Morning</th>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="mo_morning" id="" {{ (old('morning') !== null && in_array("mo_morning", old('morning'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="tu_morning" id="" {{ (old('morning') !== null && in_array("tu_morning", old('morning'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="we_morning" id="" {{ (old('morning') !== null && in_array("we_morning", old('morning'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="th_morning" id="" {{ (old('morning') !== null && in_array("th_morning", old('morning'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="fr_morning" id="" {{ (old('morning') !== null && in_array("fr_morning", old('morning'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="sa_morning" id="" {{ (old('morning') !== null && in_array("sa_morning", old('morning'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="su_morning" id="" {{ (old('morning') !== null && in_array("su_morning", old('morning'))) ? 'checked' : '' }}></label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Afternoon</th>
                                    <td>
                                        <label><input type="checkbox" name="afternoon[]" value="mo_afternoon" id="" {{ (old('afternoon') !== null && in_array("mo_afternoon", old('afternoon'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="afternoon[]" value="tu_afternoon" id="" {{ (old('afternoon') !== null && in_array("tu_afternoon", old('afternoon'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="afternoon[]" value="we_afternoon" id="" {{ (old('afternoon') !== null && in_array("we_afternoon", old('afternoon'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="afternoon[]" value="th_afternoon" id="" {{ (old('afternoon') !== null && in_array("th_afternoon", old('afternoon'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="afternoon[]" value="fr_afternoon" id="" {{ (old('afternoon') !== null && in_array("fr_afternoon", old('afternoon'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="afternoon[]" value="sa_afternoon" id="" {{ (old('afternoon') !== null && in_array("sa_afternoon", old('afternoon'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="afternoon[]" value="su_afternoon" id="" {{ (old('afternoon') !== null && in_array("su_afternoon", old('afternoon'))) ? 'checked' : '' }}></label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Evening</th>
                                    <td>
                                        <label><input type="checkbox" name="evening[]" value="mo_evening" id="" {{ (old('evening') !== null && in_array("mo_evening", old('evening'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="evening[]" value="tu_evening" id="" {{ (old('evening') !== null && in_array("tu_evening", old('evening'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="evening[]" value="we_evening" id="" {{ (old('evening') !== null && in_array("we_evening", old('evening'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="evening[]" value="th_evening" id="" {{ (old('evening') !== null && in_array("th_evening", old('evening'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="evening[]" value="fr_evening" id="" {{ (old('evening') !== null && in_array("fr_evening", old('evening'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="evening[]" value="sa_evening" id="" {{ (old('evening') !== null && in_array("sa_evening", old('evening'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="evening[]" value="su_evening" id="" {{ (old('evening') !== null && in_array("su_evening", old('evening'))) ? 'checked' : '' }}></label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Night</th>
                                    <td>
                                        <label><input type="checkbox" name="night[]" value="mo_night" id="" {{ (old('night') !== null && in_array("mo_night", old('night'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="night[]" value="tu_night" id="" {{ (old('night') !== null && in_array("tu_night", old('night'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="night[]" value="we_night" id="" {{ (old('night') !== null && in_array("we_night", old('night'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="night[]" value="th_night" id="" {{ (old('night') !== null && in_array("th_night", old('night'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="night[]" value="fr_night" id="" {{ (old('night') !== null && in_array("fr_night", old('night'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="night[]" value="sa_night" id="" {{ (old('night') !== null && in_array("sa_night", old('night'))) ? 'checked' : '' }}></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="night[]" value="su_night" id="" {{ (old('night') !== null && in_array("su_night", old('night'))) ? 'checked' : '' }}></label>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                </div>
                @error('morning')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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
