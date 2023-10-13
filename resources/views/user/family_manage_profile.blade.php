@extends('layouts.main')
@section('content')
<div class="single-form-section">
    <div class="container">
        <div class="title-main">
            <h2>Welcome to Online Au-Pairs</h2>
            <h3>{{ isset($menu) ? ucfirst($menu) : '' }}</h3>
        </div>
        @include('flash.front-message')

      <form class="row" name="frm" action="{{ route('update-family', ['id' => $family->id]) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label>Profile Photo <span class="text-danger">*</span></label>
                    <div class="box">
                        <div class="js--image-preview"></div>
                        <div class="upload-options">
                            <label>
                                <input type="file" id="profile" name="profile" class="image-upload" accept="image/*" >
                                <input type="hidden" name="hidden_profile" value="{{ isset($family->profile) ? 'true' : 'false' }}">
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
                    <input type="text" id="name" name="name" placeholder="" class="form-field @error('name') is-invalid @enderror"  value="{{ old('name', isset($family->name) ? $family->name : '') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-input">
                    <div class="form-input">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', isset($family->email) ? $family->email : '') }}" placeholder="" class="form-field @error('email') is-invalid @enderror" autocomplete="off">
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
                    <label for="email">Password </label>
                    <input type="password" id="password" name="password" placeholder="" class="form-field @error('password') is-invalid @enderror"  value="" readonly onfocus="this.removeAttribute('readonly');">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="address">Your Address <span class="text-danger">*</span></label>
                    <input type="text" id="address" name="family_address" placeholder="" class="form-field @error('family_address') is-invalid @enderror"  value="{{ old('family_address', isset($family->family_address) ? $family->family_address : '') }}">
                    <div class="icon-option" style="display: none;">
                        <a href="javaScript:;" class="btn btn-info edit-btn"><i class="fa-solid fa-pencil"></i></a>
                    </div>
                    @error('family_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="city">City <span class="text-danger">*</span></label>
                    <input type="text" id="city" name="family_city" placeholder="" class="form-field @error('family_city') is-invalid @enderror"  value="{{ old('family_city', isset($family->family_city) ? $family->family_city : '') }}">
                    <div class="icon-option" style="display: none;">
                        <a href="javaScript:;" class="btn btn-info edit-btn"><i class="fa-solid fa-pencil"></i></a>
                    </div>
                    @error('family_city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="language">Add Language <span class="text-danger">*</span></label>
                    <select id="language" name="home_language" multiple class="form-field @error('home_language') is-invalid @enderror" >
                        <option value="" disabled="disabled">Select</option>
                        <option value="english" {{ isset($family->home_language) && $family->home_language == "english" ? 'selected' : null }}>English</option>
                        <option value="afrikaans" {{ isset($family->home_language) && $family->home_language == "afrikaans" ? 'selected' : null }}>Afrikaans</option>
                        <option value="zulu (isizulu)" {{ isset($family->home_language) && $family->home_language == "zulu (isizulu)" ? 'selected' : null }}>Zulu (isiZulu)</option>
                        <option value="xhosa (isixhosa)"  {{ isset($family->home_language) && $family->home_language == "xhosa (isixhosa)" ? 'selected' : null }}>Xhosa (isiXhosa)</option>
                        <option value="northern sotho (sesotho sa leboa)"  {{ isset($family->home_language) && $family->home_language == "northern sotho (sesotho sa leboa)" ? 'selected' : null }}>Northern Sotho (Sesotho sa Leboa)</option>
                        <option value="sotho (sesotho)" {{ isset($family->home_language) && $family->home_language == "otho (sesotho)" ? 'selected' : null }}>Sotho (Sesotho)</option>
                        <option value="swazi (siswati)" {{ isset($family->home_language) && $family->home_language == "wazi (siswati)" ? 'selected' : null }}>Swazi (siSwati)</option>
                        <option value="tsonga (xitsonga)" {{ isset($family->home_language) && $family->home_language == "tsonga (xitsonga)" ? 'selected' : null }}>Tsonga (Xitsonga)</option>
                        <option value="tswana (setswana)" {{ isset($family->home_language) && $family->home_language == "tswana (setswana)" ? 'selected' : null }}>Tswana (Setswana)</option>
                        <option value="venda (tshivenda)" {{ isset($family->home_language) && $family->home_language == "venda (tshivenda)" ? 'selected' : null }}>Venda (Tshivenda)</option>
                        <option value="southern ndebele (isindebele)" {{ isset($family->home_language) && $family->home_language == "southern ndebele (isindebele)" ? 'selected' : null }}>Southern Ndebele (isiNdebele)</option>
                        <option value="spanish" {{ isset($family->home_language) && $family->home_language == "spanish" ? 'selected' : null }}>Spanish</option>
                        <option value="french" {{ isset($family->home_language) && $family->home_language == "french" ? 'selected' : null }}>French</option>
                        <option value="hindi" {{ isset($family->home_language) && $family->home_language == "hindi" ? 'selected' : null }}>Hindi</option>
                        <option value="arabic" {{ isset($family->home_language) && $family->home_language == "arabic" ? 'selected' : null }}>Arabic</option>
                        <option value="bengali" {{ isset($family->home_language) && $family->home_language == "bengali" ? 'selected' : null }}>Bengali</option>
                        <option value="portuguese" {{ isset($family->home_language) && $family->home_language == "portuguese" ? 'selected' : null }}>Portuguese</option>
                        <option value="russian" {{ isset($family->home_language) && $family->home_language == "russian" ? 'selected' : null }}>Russian</option>
                        <option value="japanese" {{ isset($family->home_language) && $family->home_language == "japanese" ? 'selected' : null }}>Japanese</option>
                        <option value="punjabi" {{ isset($family->home_language) && $family->home_language == "punjabi" ? 'selected' : null }}>Punjabi</option>
                        <option value="german" {{ isset($family->home_language) && $family->home_language == "german" ? 'selected' : null }}>German</option>
                    </select>
                    @error('home_language')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="no_children">Number of children <span class="text-danger">*</span></label>
                    <input type="number" id="no_children" name="no_children" placeholder="" class="form-field @error('no_children') is-invalid @enderror" value="{{ old('no_children', isset($family->no_children) ? $family->no_children : '') }}">
                    <div class="icon-option" style="display: none;">
                        <a href="javaScript:;" class="btn btn-info edit-btn"><i class="fa-solid fa-pencil"></i></a>
                    </div>
                    @error('no_children')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            @if(isset($family->age) && !empty($family->age))
                @foreach($family->age as $key => $value)
                    @if ($key >= 1)  
                        @break  
                    @else
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-input">
                                <label for="age_children">Age of children <span class="text-danger">*</span></label>
                                <select id="age_children" name="age[]" class="form-field @error('age') is-invalid @enderror" >
                                    <option value="baby" {{ $value == "baby" ? 'selected' : '' }}>Baby</option>
                                    <option value="gradeschooler" {{ $value == "gradeschooler" ? 'selected' : '' }}>Gradeschooler</option>
                                    <option value="toddler" {{ $value == "toddler" ? 'selected' : '' }}>Toddler</option>
                                    <option value="teenager" {{ $value == "teenager" ? 'selected' : '' }}>Teenager</option>
                                    <option value="preschooler" {{ $value == "preschooler" ? 'selected' : '' }}>Preschooler</option>
                                </select>
                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-input">
                        <label for="age_children">Age of children <span class="text-danger">*</span></label>
                        <select id="age_children" name="age[]" class="form-field @error('age') is-invalid @enderror" >
                            <option value="" disabled="disabled" selected>Select Age</option>
                            <option value="baby">Baby</option>
                            <option value="gradeschooler">Gradeschooler</option>
                            <option value="toddler">Toddler</option>
                            <option value="teenager">Teenager</option>
                            <option value="preschooler">Preschooler</option>
                        </select>
                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            @endif 
           

            <div id="more_childern" class="row p-0 m-0">
                @if(isset($family->age) && !empty($family->age))
                    @foreach($family->age as $key => $value)
                        @if ($key >= 1) 
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-input">
                                    <label for="age_children">Age of children <span class="text-danger">*</span></label>
                                    <select id="age_children" name="age[]" class="form-field @error('age') is-invalid @enderror" >
                                        <option value="baby" {{ $value == "baby" ? 'selected' : '' }}>Baby</option>
                                        <option value="gradeschooler" {{ $value == "gradeschooler" ? 'selected' : '' }}>Gradeschooler</option>
                                        <option value="toddler" {{ $value == "toddler" ? 'selected' : '' }}>Toddler</option>
                                        <option value="teenager" {{ $value == "teenager" ? 'selected' : '' }}>Teenager</option>
                                        <option value="preschooler" {{ $value == "preschooler" ? 'selected' : '' }}>Preschooler</option>
                                    </select>
                                    @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    @endforeach     
                @endif 
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="describe_kids">Describe your kids in 3 words <span class="text-danger">*</span></label>
                    <select id="describe_kids" name="describe_kids[]" multiple class="form-field @error('describe_kids') is-invalid @enderror" >
                        <option value="energetic" {{ (isset($family->describe_kids) && in_array("energetic", $family->describe_kids)) ? "selected" : " " }}>Energetic</option>
                        <option value="curious" {{ (isset($family->describe_kids) && in_array("curious", $family->describe_kids)) ? "selected" : " " }}>Curious</option>
                        <option value="sporty" {{ (isset($family->describe_kids) && in_array("sporty", $family->describe_kids)) ? "selected" : " " }}>Sporty</option>
                        <option value="creative" {{ (isset($family->describe_kids) && in_array("creative", $family->describe_kids)) ? "selected" : " " }}>Creative</option>
                        <option value="friendly" {{ (isset($family->describe_kids) && in_array("friendly", $family->describe_kids)) ? "selected" : " " }}>Friendly</option>
                        <option value="talkative" {{ (isset($family->describe_kids) && in_array("talkative", $family->describe_kids)) ? "selected" : " " }}>Talkative</option>
                        <option value="calm" {{ (isset($family->describe_kids) && in_array("calm", $family->describe_kids)) ? "selected" : " " }}>Calm</option>
                        <option value="playful" {{ (isset($family->describe_kids) && in_array("playful", $family->describe_kids)) ? "selected" : " " }}>Playful</option>
                        <option value="funny" {{ (isset($family->describe_kids) && in_array("funny", $family->describe_kids)) ? "selected" : " " }}>Funny</option>
                        <option value="intelligent" {{ (isset($family->describe_kids) && in_array("intelligent", $family->describe_kids)) ? "selected" : " " }}>Intelligent</option>
                        <option value="affectionate" {{ (isset($family->describe_kids) && in_array("affectionate", $family->describe_kids)) ? "selected" : " " }}>Affectionate</option>
                        <option value="independent" {{ (isset($family->describe_kids) && in_array("independent", $family->describe_kids)) ? "selected" : " " }}>Independent</option>
                    </select>
                    @error('describe_kids')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_babysitter_comfortable">We need a babysitter comfortable with <span class="text-danger">*</span></label>
                    <select id="family_babysitter_comfortable" name="family_babysitter_comfortable[]" multiple class="form-field @error('family_babysitter_comfortable') is-invalid @enderror" >
                        <option value="" disabled="disabled">Select</option>
                        <option value="pets" {{ isset($family->family_babysitter_comfortable) && in_array("pets", $family->family_babysitter_comfortable) ? 'selected' : null}}>Pets</option>
                        <option value="cooking" {{ isset($family->family_babysitter_comfortable) && in_array("cooking", $family->family_babysitter_comfortable) ? 'selected' : null}}>Cooking</option>
                        <option value="chores" {{ isset($family->family_babysitter_comfortable) && in_array("chores", $family->family_babysitter_comfortable) ? 'selected' : null}}>Chores</option>
                        <option value="homeworkassistance" {{ isset($family->family_babysitter_comfortable) && in_array("homeworkassistance", $family->family_babysitter_comfortable) ? 'selected' : null}}>Homework assistance</option>
                    </select>
                     @error('family_babysitter_comfortable')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_types_babysitter">Type of babysitter needed <span class="ms-2" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="primary-tooltip" data-bs-title="To save money, you can also choose to occasionally look after each other's children. We call this parents-help-parents."><i class="fa-solid fa-circle-question"></i></span></label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="family_types_babysitter" value="babysitter" {{ isset($family->family_types_babysitter) && $family->family_types_babysitter == "babysitter" ? "checked" : ' ' }}><label>Babysitter</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_types_babysitter" value="nanny" {{ isset($family->family_types_babysitter) && $family->family_types_babysitter == "nanny" ? "checked" : ' ' }}><label>Nanny</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_types_babysitter" value="other parent (parents-help-parents)" {{ isset($family->family_types_babysitter) && $family->family_types_babysitter == "other parent (parents-help-parents)" ? "checked" : ' ' }}><label>Other parent (parents-help-parents)</label></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_location">Preferred babysitting location </label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="family_location" value="at our home" class="form-field @error('family_location') is-invalid @enderror" {{ isset($family->family_location) && $family->family_location == "at our home" ? "checked" : '' }}><label>At our home</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_location" value="at the babysitter's" class="form-field @error('family_location') is-invalid @enderror" {{ isset($family->family_location) && $family->family_location == "at the babysitter's" ? "checked" : '' }}><label>At the babysitter's</label></li>
                    </ul>
                    @if ($errors->has('last_name'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_profile_see">Who can see your profile? </label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" checked name="family_profile_see" value="everyone" {{ old('family_profile_see') === "everyone" ? "checked" : '' }} data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="primary-tooltip" data-bs-title="Babysits users, public search engines, and job boards can iew your profile."><label>Everyone</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_profile_see" value="only babysits users" {{ old('family_profile_see') === "only babysits users" ? "checked" : '' }} data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="primary-tooltip" data-bs-title="Only babysits users can view your profile. this may reduce the responses you get."><label>Only Babysits users</label></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_notifications">Do you want to get notifications from new babysitters in your area? </label>
                    <ul class="d-flex flex-wrap" >
                         <li><input type="radio" checked name="family_notifications" value="yes" {{ isset($family->family_notifications) && $family->family_notifications == "yes" ? 'checked' : '' }}>Yes</li>
                        <li><input type="radio" name="family_notifications" value="no" {{ isset($family->family_notifications) && $family->family_notifications == "no" ? 'checked' : '' }}>No</li>
                    </ul>
                    @if ($errors->has('family_notifications'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('family_notifications') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="">What hourly rate are you willing to pay? </label>
                    <div class="input-group mb-1">
                        <span class="input-group-text">R</span>
                            <input type="text" name="salary_expectation" id="salary_expectation" class="form-field" placeholder="" value="{{ old('salary_expectation', isset($family->salary_expectation) ? $family->salary_expectation : '') }}">
                        <span class="input-group-text">hr</span>
                    </div>
                    <p class="fw-light small">Average rate that other families offer: R16,34<br>For your safety and protection, only pay through Online Au-Pairs.</p>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="family_description">Tell a little about your family, so babysitters can get to know you. <span class="text-danger">*</span></label>
                <textarea id="family_description" name="family_description" placeholder="" class="form-field @error('family_description') is-invalid @enderror" rows="5" >{{ old('family_description', isset($family->family_description) ? $family->family_description : '') }}</textarea>
                <p class="text-end fw-light fst-italic small">Minimum 200 Characters</p>
                @if ($errors->has('family_description'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('family_description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-12">
                <div class="form-input">
                    <label for="">When do you need a babysitter? </label>
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
                                    <th>Afternoon</th>
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
                                    <th>Evening</th>
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
                                    <th>Night</th>
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
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-input switch-input">
                    <input type="checkbox" name="family_special_need_option" id="special-needs" class="switch" {{isset($family->family_special_need_option) && $family->family_special_need_option == 1 ? 'checked' : '' }}>
                    <label for="special-needs">We are looking for someone who has experience with children with special needs </label>
                    <p>For example with children with behavioral problems, an intellectual disability or a chronic illness. <a href="javaScript:;">Learn more</a></p>
                    <div id="special-needs-section" class="special-needs-types w-100 mt-3" {{isset($family->family_special_need_option) && $family->family_special_need_option == 1 ? '' : 'hidden'}}>
                        <label class="w-100 mb-3">Specific experience:</label>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) && in_array("anxiety_disorder", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-disorder-btn" autocomplete="off" value="anxiety_disorder">
                            <label class="form-check-label" for="special-needs-disorder-btn">Anxiety disorder</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("adhd", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-adhd-btn" autocomplete="off" value="adhd">
                            <label class="form-check-label" for="special-needs-adhd-btn">Attention Deficit Hyperactivity Disorder (ADHD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("autism", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-autism-btn" autocomplete="off" value="autism">
                            <label class="form-check-label" for="special-needs-autism-btn">Autism Spectrum Disorder (ASD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("asthma", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-asthma-btn" autocomplete="off" value="asthma">
                            <label class="form-check-label" for="special-needs-asthma-btn">Asthma</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("odd_cd", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-odd-cd-btn" autocomplete="off" value="odd_cd">
                            <label class="form-check-label" for="special-needs-odd-cd-btn">Oppositional Defiant Disorder and Conduct Disorders (ODD/CD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("deaf_and_hard_hearing", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-hard-hearing-btn" autocomplete="off" value="deaf_and_hard_hearing">
                            <label class="form-check-label" for="special-needs-hard-hearing-btn">Deaf and hard of hearing</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("global_development_delay", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-dev-delay-btn" autocomplete="off" value="global_development_delay">
                            <label class="form-check-label" for="special-needs-dev-delay-btn">Global development delay</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("diabetes", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-diabetes-btn" autocomplete="off" value="diabetes">
                            <label class="form-check-label" for="special-needs-diabetes-btn">Diabetes</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("language_disorder", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-lang-dis-btn" autocomplete="off" value="language_disorder">
                            <label class="form-check-label" for="special-needs-lang-dis-btn">Language disorder</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("epilepsy", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-epilepsy-btn" autocomplete="off" value="epilepsy">
                            <label class="form-check-label" for="special-needs-epilepsy-btn">Epilepsy</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("hemophilia", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-hemophilia-btn" autocomplete="off" value="hemophilia">
                            <label class="form-check-label" for="special-needs-allergies-btn">Food allergies</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("hemophilia", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-hemophilia-btn" autocomplete="off" value="hemophilia">
                            <label class="form-check-label" for="special-needs-hemophilia-btn">Hemophilia</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("obsessive_compulsive_disorder", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-compulsive-btn" autocomplete="off" value="obsessive_compulsive_disorder">
                            <label class="form-check-label" for="special-needs-compulsive-btn">Obsessive compulsive disorder (OCD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("physically_limited", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-limited-btn" autocomplete="off" value="physically_limited">
                            <label class="form-check-label" for="special-needs-limited-btn">Physically limited</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("sleep_disorder", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-sleep-dis-btn" autocomplete="off" value="sleep_disorder">
                            <label class="form-check-label" for="special-needs-sleep-dis-btn">Sleep disorder</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("tics", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-tics-btn" autocomplete="off" value="tics">
                            <label class="form-check-label" for="special-needs-tics-btn">Tics</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" {{ isset($family->family_special_need_value ) &&  in_array("visual_impairment", $family->family_special_need_value ) ? 'checked' : '' }} id="special-needs-visual-btn" autocomplete="off" value="visual_impairment">
                            <label class="form-check-label" for="special-needs-visual-btn">Visual impairment</label>
                        </div>
                    </div>
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
@parent
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

    $("#no_children").keyup(function(){
        var no_children = $("#no_children").val();
        $("#more_childern").html('');
        if(no_children > 1) {
            for (var i = no_children - 1; i >= 1; i--) {
                $("#more_childern").append('<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="form-input"><label for="age_children">Age of children</label><select name="age[]" class="form-field" ><option value="" disabled="disabled" selected>Select Age</option><option value="baby">Baby</option><option value="gradeschooler">Gradeschooler</option><option value="toddler">Toddler</option><option value="teenager">Teenager</option><option value="preschooler">Preschooler</option></select></div></div>');
            }
        }
    });

    $(window).on("load", function () {
        var file = "{{ isset($family->profile) ? $family->profile : null }}";
        if(file !== null){
            $('.js--image-preview').addClass('js--no-default');
            $('.js--image-preview').html('<img src="{{ url('../storage/app/public/uploads/') }}/' + file + '" alt="">');
        }
    });
});
</script>
@endsection
