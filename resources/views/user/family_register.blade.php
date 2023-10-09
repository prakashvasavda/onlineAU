@extends('layouts.main')
@section('content')
<div class="single-form-section">
    <div class="container">
        <div class="title-main">
            <h2>Welcome to Online Au-Pairs</h2>
            <h3>sign up</h3>
        </div>
        @include('flash.front-message')

        <form class="row" name="frm" action="{{ route('store_family') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label>Profile Photo <span class="text-danger">*</span></label>
                    <div class="box">
                        <div class="js--image-preview"></div>
                        <div class="upload-options">
                            <label><input type="file" id="profile" name="profile" class="image-upload" accept="image/*" ></label>
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
                    <input type="text" id="name" name="name" placeholder="" class="form-field @error('name') is-invalid @enderror"  value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-input">
                    <div class="form-input">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="" class="form-field @error('email') is-invalid @enderror" autocomplete="off">
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
                    <input type="text" id="address" name="family_address" placeholder="" class="form-field @error('family_address') is-invalid @enderror"  value="{{ old('family_address') }}">
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
                    <input type="text" id="city" name="family_city" placeholder="" class="form-field @error('family_city') is-invalid @enderror"  value="{{ old('family_city') }}">
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
                    <input type="number" id="no_children" name="no_children" placeholder="" class="form-field @error('no_children') is-invalid @enderror" >
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
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="age_children">Age of children <span class="text-danger">*</span></label>
                    <select id="age_children" name="age[]" class="form-field @error('age') is-invalid @enderror" >
                        <option selected="selected" value="Baby">Baby</option>
                        <option value="gradeschooler" {{ (!empty(old('age')) && in_array("gradeschooler", old('age')))? 'selected' : '' }}>Gradeschooler</option>
                        <option value="toddler" {{ (!empty(old('age')) && in_array("toddler", old('age')))? 'selected' : '' }}>Toddler</option>
                        <option value="teenager" {{ (!empty(old('age')) && in_array("teenager", old('age')))? 'selected' : '' }}>Teenager</option>
                        <option value="preschooler" {{ (!empty(old('age')) && in_array("preschooler", old('age')))? 'selected' : '' }}>Preschooler</option>
                    </select>
                    @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div id="more_childern" class="row p-0 m-0"></div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="describe_kids">Describe your kids in 3 words <span class="text-danger">*</span></label>
                    <select id="describe_kids" name="describe_kids" class="form-field @error('describe_kids') is-invalid @enderror" >
                        <option value="" disabled="disabled" selected>Select</option>
                        <option value="energetic" {{ old('describe_kids') === 'energetic' ? 'selected' : '' }}>Energetic</option>
                        <option value="curious" {{ old('describe_kids') === 'curious' ? 'selected' : '' }}>Curious</option>
                        <option value="sporty" {{ old('describe_kids') === 'sporty' ? 'selected' : '' }}>Sporty</option>
                        <option value="creative" {{ old('describe_kids') === 'creative' ? 'selected' : '' }}>Creative</option>
                        <option value="friendly" {{ old('describe_kids') === 'friendly' ? 'selected' : '' }}>Friendly</option>
                        <option value="talkative" {{ old('describe_kids') === 'talkative' ? 'selected' : '' }}>Talkative</option>
                        <option value="calm" {{ old('describe_kids') === 'calm' ? 'selected' : '' }}>Calm</option>
                        <option value="playful" {{ old('describe_kids') === 'playful' ? 'selected' : '' }}>Playful</option>
                        <option value="funny" {{ old('describe_kids') === 'funny' ? 'selected' : '' }}>Funny</option>
                        <option value="intelligent" {{ old('describe_kids') === 'intelligent' ? 'selected' : '' }}>Intelligent</option>
                        <option value="affectionate" {{ old('describe_kids') === 'affectionate' ? 'selected' : '' }}>Affectionate</option>
                        <option value="independent" {{ old('describe_kids') === 'independent' ? 'selected' : '' }}>Independent</option>
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
                        <option value="pets" {{ (!empty(old('family_babysitter_comfortable')) && in_array("pets", old('family_babysitter_comfortable'))) ? "selected" : '' }}>Pets</option>
                        <option value="cooking" {{ (!empty(old('family_babysitter_comfortable')) && in_array("cooking", old('family_babysitter_comfortable'))) ? "selected" : '' }}>Cooking</option>
                        <option value="chores" {{ (!empty(old('family_babysitter_comfortable')) && in_array("chores", old('family_babysitter_comfortable'))) ? "selected" : '' }}>Chores</option>
                        <option value="homeworkassistance" {{ (!empty(old('family_babysitter_comfortable')) && in_array("homeworkassistance", old('family_babysitter_comfortable'))) ? "selected" : '' }}>Homework assistance</option>
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
                        <li class="radio-box-item"><input type="radio" name="family_types_babysitter" checked value="babysitter" {{ old('family_types_babysitter') === 'babysitter' ? 'checked' : '' }}><label>Babysitter</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_types_babysitter" value="nanny" {{ old('family_types_babysitter') === 'nanny' ? 'checked' : '' }}><label>Nanny</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_types_babysitter" value="other parent (parents-help-parents)" {{ old('family_types_babysitter') === 'other parent (parents-help-parents)' ? 'checked' : '' }}><label>Other parent (parents-help-parents)</label></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_location">Preferred babysitting location </label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="family_location" checked value="at our home" {{ old('family_location') === "at our home" ? 'checked' : '' }} class="form-field @error('family_location') is-invalid @enderror"><label>At our home</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_location" value="at the babysitter's" {{ old('family_location') === "at the babysitter's" ? 'checked' : '' }} class="form-field @error('family_location') is-invalid @enderror"><label>At the babysitter's</label></li>
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
                        <li><input type="radio" checked name="family_notifications" value="yes" {{ old('family_notifications') === "yes" ? "checked" : '' }} >Yes</li>
                        <li><input type="radio" name="family_notifications" value="no" {{ old('family_notifications') === "no" ? "checked" : '' }} >No</li>
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
                            <input type="text" name="salary_expectation" id="salary_expectation" class="form-field" placeholder="" value="{{old('salary_expectation')}}">
                        <span class="input-group-text">hr</span>
                    </div>
                    <p class="fw-light small">Average rate that other families offer: R16,34<br>For your safety and protection, only pay through Online Au-Pairs.</p>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="family_description">Tell a little about your family, so babysitters can get to know you. <span class="text-danger">*</span></label>
                <textarea id="family_description" name="family_description" placeholder="" class="form-field @error('family_description') is-invalid @enderror" rows="5" >{{ old('family_description') }}</textarea>
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
                </div>
            </div>
            <div class="col-12">
                <div class="form-input switch-input">
                    <input type="checkbox" name="family_special_need_option" id="special-needs" class="switch" {{ old('family_special_need_option') == 'on' ? 'checked' : '' }}>
                    <label for="special-needs">We are looking for someone who has experience with children with special needs </label>
                    <p>For example with children with behavioral problems, an intellectual disability or a chronic illness. <a href="javaScript:;">Learn more</a></p>
                    <div id="special-needs-section" class="special-needs-types w-100 mt-3" {{ old('family_special_need_option') == 'on' ? '' : 'hidden' }}>
                        <label class="w-100 mb-3">Specific experience:</label>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-disorder-btn" autocomplete="off" value="anxiety_disorder" {{ !empty(old('family_special_need_value')) && in_array("anxiety_disorder", old('family_special_need_value')) ? "checked" : '' }}>
                            <label class="form-check-label" for="special-needs-disorder-btn">Anxiety disorder</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-adhd-btn" autocomplete="off" value="adhd" {{ !empty(old('family_special_need_value')) && in_array("adhd", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-adhd-btn">Attention Deficit Hyperactivity Disorder (ADHD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-autism-btn" autocomplete="off" value="autism" {{ !empty(old('family_special_need_value')) && in_array("autism", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-autism-btn">Autism Spectrum Disorder (ASD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-asthma-btn" autocomplete="off" value="asthma" {{ !empty(old('family_special_need_value')) && in_array("asthma", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-asthma-btn">Asthma</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-odd-cd-btn" autocomplete="off" value="odd_cd" {{ !empty(old('family_special_need_value')) && in_array("odd_cd", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-odd-cd-btn">Oppositional Defiant Disorder and Conduct Disorders (ODD/CD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-hard-hearing-btn" autocomplete="off" value="deaf_and_hard_hearing" {{ !empty(old('family_special_need_value')) && in_array("deaf_and_hard_hearing", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-hard-hearing-btn">Deaf and hard of hearing</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-dev-delay-btn" autocomplete="off" value="global_development_delay" {{ !empty(old('family_special_need_value')) && in_array("global_development_delay", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-dev-delay-btn">Global development delay</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-diabetes-btn" autocomplete="off" value="diabetes" {{ !empty(old('family_special_need_value')) && in_array("diabetes", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-diabetes-btn">Diabetes</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-lang-dis-btn" autocomplete="off" value="language_disorder" {{ !empty(old('family_special_need_value')) && in_array("language_disorder", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-lang-dis-btn">Language disorder</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-epilepsy-btn" autocomplete="off" value="epilepsy" {{ !empty(old('family_special_need_value')) && in_array("epilepsy", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-epilepsy-btn">Epilepsy</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-allergies-btn" autocomplete="off" value="food_allergies" {{ !empty(old('family_special_need_value')) && in_array("food_allergies", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-allergies-btn">Food allergies</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-hemophilia-btn" autocomplete="off" value="hemophilia" {{ !empty(old('family_special_need_value')) && in_array("hemophilia", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-hemophilia-btn">Hemophilia</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-compulsive-btn" autocomplete="off" value="obsessive_compulsive_disorder" {{ !empty(old('family_special_need_value')) && in_array("obsessive_compulsive_disorder", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-compulsive-btn">Obsessive compulsive disorder (OCD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-limited-btn" autocomplete="off" value="physically_limited" {{ !empty(old('family_special_need_value')) && in_array("physically_limited", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-limited-btn">Physically limited</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-sleep-dis-btn" autocomplete="off" value="sleep_disorder" {{ !empty(old('family_special_need_value')) && in_array("sleep_disorder", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-sleep-dis-btn">Sleep disorder</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-tics-btn" autocomplete="off" value="tics" {{ !empty(old('family_special_need_value')) && in_array("tics", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-tics-btn">Tics</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-visual-btn" autocomplete="off" value="visual_impairment" {{ !empty(old('family_special_need_value')) && in_array("visual_impairment", old('family_special_need_value')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="special-needs-visual-btn">Visual impairment</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-input-btn text-center">
                    <input type="submit" class="btn btn-primary round" value="signup">
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
                $("#more_childern").append('<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="form-input"><label for="age_children">Age of children</label><select name="age[]" class="form-field" ><option value="Baby" selected="selected">Baby</option><option value="Gradeschooler">Gradeschooler</option><option value="Toddler">Toddler</option><option value="Teenager">Teenager</option><option value="Preschooler">Preschooler</option></select></div></div>');
            }
        }
    });
});
</script>
@endsection
