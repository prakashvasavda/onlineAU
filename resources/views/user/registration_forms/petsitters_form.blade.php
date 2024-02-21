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
                <label for="name">Name <span class="text-danger">*</span></label>
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
                <label for="surname">Surname <span class="text-danger">*</span></label>
                <input type="text" id="surname" name="surname" placeholder="" class="form-field" value="{{ old('surname') }}" >
                @if ($errors->has('surname'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('surname') }}</strong>
                    </span>
                @endif
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
                <label for="profile">Profile Picture <span class="text-danger">*</span></label>
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
                <label for="id_number">ID Number <span class="text-danger">*</span></label>
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
                <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
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
                <label for="area">Type in your City <span class="text-danger">*</span></label>
                <input type="text" id="" name="area" placeholder="" class="form-field @error('area') is-invalid @enderror address-input"  value="{{ old('area') }}">
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
                <label for="salary_expectation">What is your hourly rate <span class="text-danger">*</span></label>
                <div class="input-group mb-1">
                    <span class="input-group-text">R</span>
                        <input type="text" name="salary_expectation" id="salary_expectation" class="form-field" placeholder="" value="{{old('salary_expectation')}}">
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
                <label for="situated">Situated <span class="text-danger">*</span></label>
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
                <label for="experience_with_animals">Do you have experience with animals <span class="text-danger">*</span></label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="experience_with_animals" value="yes" {{ old('experience_with_animals') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="experience_with_animals" value="no" {{ old('experience_with_animals') == "no" ? "checked" : '' }}>No</li>
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
                    <li><input type="radio" name="do_you_like_animals" value="yes" {{ old('do_you_like_animals') == "yes" ? "checked" : '' }}>Yes</li>
                    <li><input type="radio" name="do_you_like_animals" value="no" {{ old('do_you_like_animals') == "no" ? "checked" : '' }}>No</li>
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
                <label for="animals_comfortable_with">Which animals do you feel comfortable working with <span class="text-danger">*</span></label>
                <select id="animals_comfortable_with" multiple name="animals_comfortable_with[]" class="form-field">
                    <option value="" disabled>Select</option>
                    <option value="dogs" {{ !empty(old('animals_comfortable_with')) && in_array("dogs", old('animals_comfortable_with')) ? "selected" : " " }}>Dogs</option>
                    <option value="cats" {{ !empty(old('animals_comfortable_with')) && in_array("cats", old('animals_comfortable_with')) ? "selected" : " " }}>Cats</option>
                    <option value="hamsters_and_guinea_pigs" {{!empty(old('animals_comfortable_with')) && in_array("hamsters_and_guinea_pigs", old('animals_comfortable_with')) ? "selected" : " " }}>Hamsters &amp; Guinea pigs</option>
                    <option value="reptiles" {{!empty(old('animals_comfortable_with')) && in_array("reptiles", old('animals_comfortable_with')) ? "selected" : " " }}>Reptiles</option>
                    <option value="spiders" {{ !empty(old('animals_comfortable_with')) && in_array("spiders", old('animals_comfortable_with')) ? "selected" : " " }}>Spiders</option>
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
                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][0] ?? null }}" placeholder="Add Time"></td>
                                <td>to</td>
                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][0] ?? null }}" placeholder="Add Time"></td>
                                <td onclick="addCalendarRow('{{ $day }}')">
                                    <a href="javaScript:;" class="btn add-btn icon">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </td>
                            </tr>

                            @if(old($day) && is_array(old($day)))
                                @foreach(old($day)['start_time'] as $key => $value)
                                    @if(isset($key) && $key >= 1 && isset(old($day)['start_time'][$key]) || isset(old($day)['end_time'][$key]))
                                        <tr id="{{ $day }}-row">
                                            <td><input type="checkbox"></td>
                                            <td>{{ ucfirst($day) }}</td>
                                            <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][$key] ?? null }}" placeholder="Add Time"></td>
                                            <td>to</td>
                                            <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][$key] ?? null }}" placeholder="Add Time"></td>
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

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-input">
                <div class="form-input d-flex flex-wrap mb-2">
                    <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" autocomplete="off">
                    <label class="form-check-label" for="terms_and_conditions"> 
                        <p><a href="{{ route('terms-and-conditions', ['service' => 'candidate']) }}" target="_blank">Accept Terms and Conditions </a><span class="text-danger">*</span></p>
                    </label>
                </div>

                @if ($errors->has('terms_and_conditions'))
                    <span class="text-danger">
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
@parent
<script type="text/javascript">
    $(document).ready(function() {
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
</script>
@endsection
