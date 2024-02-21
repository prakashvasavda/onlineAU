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
                    <label>Profile Photo</label>
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
                    <label for="name"> Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" placeholder="" class="form-field @error('name') is-invalid @enderror"  value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-input">
                    <div class="form-input">
                       <label for="surname"> Surname <span class="text-danger">*</span></label>
                        <input type="text" id="surname" name="surname" placeholder="" class="form-field"  value="{{ old('surname') }}">
                         @if ($errors->has('surname'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('surname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
               <div class="form-input">
                    <div class="form-input">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="" class="form-field @error('email') is-invalid @enderror"> 
                        @if ($errors->has('email'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="email">Password  <span class="text-danger">*</span></label>
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
                <label for="id_number">ID Number <span class="text-danger">*</span></label>
                <input type="text" id="id_number" name="id_number" value="{{ old('id_number') }}" placeholder="" class="form-field">
                @if ($errors->has('id_number'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('id_number') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="address">Your Address <span class="text-danger">*</span></label>
                    <input type="text" id="address-input" name="family_address" placeholder="" class="form-field @error('family_address') is-invalid @enderror address-input"  value="{{ old('family_address') }}">
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
                    <label for="no_children">Number of children <span class="text-danger">*</span></label>
                    <input type="number" id="no_children" name="no_children" value="{{ old('no_children', 1) }}" placeholder="" class="form-field @error('no_children') is-invalid @enderror" >
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
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="age_children">Age of children <span class="text-danger">*</span></label>
                    <select id="age_children" name="age[]" class="form-field @error('age') is-invalid @enderror" >
                        {{-- <option value="" >Select</option> --}}
                        <option value="0-12 months" {{ (!empty(old('age')) && in_array("0-12 months", old('age')))? 'selected' : '' }}>0-12 Months</option>
                        <option value="1-3 years" {{ (!empty(old('age')) && in_array("1-3 years", old('age')))? 'selected' : '' }}>1-3 Years</option>
                        <option value="4-7 years" {{ (!empty(old('age')) && in_array("4-7 years", old('age')))? 'selected' : '' }}>4-7 Years</option>
                        <option value="8-13 years" {{ (!empty(old('age')) && in_array("8-13 years", old('age')))? 'selected' : '' }}>8-13 Years</option>
                        <option value="13-16 years" {{ (!empty(old('age')) && in_array("13-16 years", old('age')))? 'selected' : '' }}>13-16 Years</option>
                    </select>
                    @error('age.0')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="gender_of_children">Gender of children <span class="text-danger">*</span></label>
                    <select id="gender_of_children" name="gender_of_children[]" class="form-field">
                        {{-- <option value="" >Select</option> --}}
                        <option value="male" {{ (!empty(old('gender_of_children')) && in_array("male", old('gender_of_children')))? 'selected' : '' }}>Male</option>
                        <option value="female" {{ (!empty(old('gender_of_children')) && in_array("female", old('gender_of_children')))? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender_of_children.0')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div id="more_childern" class="row p-0 m-0"></div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="cell_number">Cell Number <span class="text-danger">*</span></label>
                <input type="number" id="cell_number" name="cell_number" value="{{ old('cell_number') }}" placeholder="" class="form-field">
                @if ($errors->has('cell_number'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('cell_number') }}</strong>
                    </span>
                @endif
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
                    <label for="what_do_you_need">What do you need <span class="text-danger">*</span> <span class="ms-2 d-none" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="primary-tooltip" data-bs-title="To save money, you can also choose to occasionally look after each other's children. We call this parents-help-parents."><i class="fa-solid fa-circle-question"></i></span></label>
                    <select id="what_do_you_need" multiple name="what_do_you_need[]" class="form-field">
                        <option value="" disabled>Select</option>
                        <option value="babysitter" {{ (!empty(old('what_do_you_need')) && in_array("babysitter", old('what_do_you_need')))? 'selected' : '' }}>Babysitter</option>
                        <option value="petsitter" {{ (!empty(old('what_do_you_need')) && in_array("petsitter", old('what_do_you_need')))? 'selected' : '' }}>Petsitter</option>
                        <option value="au_pair" {{ (!empty(old('what_do_you_need')) && in_array("au_pair", old('what_do_you_need')))? 'selected' : '' }}>Au-Pair</option>
                        <option value="nanny" {{ (!empty(old('what_do_you_need')) && in_array("nanny", old('what_do_you_need')))? 'selected' : '' }}>Nanny</option>
                    </select>
                     @if ($errors->has('what_do_you_need'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('what_do_you_need') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_notifications">Do you want to get notifications from new candidates in your area <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap mt-2">
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
                    <label for="start_date">Start date <span class="text-danger">*</span></label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" class="form-field">
                    @if ($errors->has('start_date'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="duration_needed">Duration needed (In Months) <span class="text-danger">*</span></label>
                    <input type="number" id="duration_needed" name="duration_needed" value="{{ old('duration_needed') }}" class="form-field">
                    @if ($errors->has('duration_needed'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('duration_needed') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="petrol_reimbursement">Petrol Reimbursement <span class="text-danger">*</span></label>
                    <select id="petrol_reimbursement" name="petrol_reimbursement" class="form-field">
                        <option selected="selected" disabled>Select</option>
                        <option value="aa_rates" {{ old('petrol_reimbursement') == "aa_rates" ? "selected" : " " }}>AA rates</option>
                        <option value="included_in_salary" {{ old('petrol_reimbursement') == "included_in_salary" ? "selected" : " " }}>Included in salary</option>
                        <option value="extra_amount" {{ old('petrol_reimbursement') == "extra_amount" ? "selected" : " " }}>Extra amount</option>
                    </select>
                    @if ($errors->has('petrol_reimbursement'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('petrol_reimbursement') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="live_in_or_live_out">Live in / Live out <span class="text-danger">*</span></label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="live_in_or_live_out" value="live in" {{ old('live_in_or_live_out') === "live in" ? 'checked' : '' }} class="form-field" checked><label>Live in</label></li>
                        <li class="radio-box-item"><input type="radio" name="live_in_or_live_out" value="live out" {{ old('live_in_or_live_out') === "live out" ? 'checked' : '' }} class="form-field"><label>Live out</label></li>
                    </ul>
                    @if ($errors->has('live_in_or_live_out'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('live_in_or_live_out') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
          
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="candidate_duties">What will be the candidate’s duties <span class="text-danger">*</span></label>
                <textarea id="candidate_duties" name="candidate_duties" class="form-field" rows="5" >{{ old('candidate_duties') }}</textarea>
                <p class="text-end fw-light fst-italic small">Maximum 500 Characters</p>
                @if ($errors->has('candidate_duties'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('candidate_duties') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="family_description">Tell a little about your family, so candidates can get to know you <span class="text-danger">*</span></label>
                <textarea id="family_description" name="family_description" placeholder="" class="form-field @error('family_description') is-invalid @enderror" rows="5" >{{ old('family_description') }}</textarea>
                <p class="text-end fw-light fst-italic small">Maximum 500 Characters</p>
                @if ($errors->has('family_description'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('family_description') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="">What hourly rate are you willing to pay per day <span class="text-danger">*</span></label>
                    <div class="input-group mb-1">
                        <span class="input-group-text">R</span>
                            <input type="text" name="hourly_rate_pay" id="hourly_rate_pay" class="form-field" placeholder="" value="{{old('hourly_rate_pay')}}">
                        <span class="input-group-text">hr</span>
                    </div>
                    <p class="fw-light small">Average rate that other families offer: R16,34<br>For your safety and protection, only pay through Online Au-Pairs.</p>
                    @if ($errors->has('hourly_rate_pay'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('hourly_rate_pay') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="salary_expectation">What salary are you willing to pay <span class="text-danger">*</span></label>
                    <input type="number" id="salary_expectation" name="salary_expectation" placeholder="" class="form-field @error('salary_expectation') is-invalid @enderror"  value="{{ old('salary_expectation') }}">
                    @if ($errors->has('salary_expectation'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('salary_expectation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="mb-2">
                    <label for="day_hour">Days & times needed</label>
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

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-input">
                    <div class="form-input d-flex flex-wrap mb-2">
                        <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" autocomplete="off">
                        <label class="form-check-label" for="terms_and_conditions"> 
                            <p><a href="{{ route('terms-and-conditions', ['service' => 'family']) }}" target="_blank">Accept Terms and Conditions </a><span class="text-danger">*</span></p>
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
                $("#more_childern")
                .append(`
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-2">
                        <div class="form-input">
                            <label for="age_children">Age of children <span class="text-danger">*</span></label>
                            <select name="age[]" class="form-field" >
                                <option value="0-12 months">0-12 Months</option>
                                <option value="1-3 years">1-3 Years</option>
                                <option value="4-7 years">4-7 Years</option>
                                <option value="8-13 years">8-13 Years</option>
                                <option value="13-16 years">13-16 Years</option>
                            </select>
                        </div>
                    </div> 

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-2">
                        <div class="form-input">
                            <label for="gender_of_children">Gender of children <span class="text-danger">*</span></label>
                            <select name="gender_of_children[]" class="form-field">
                                <option value="" >Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                `);
            }
        }
    });

    /*get validaton errors*/
    @if($errors->any())
        var errorMessages = {!! json_encode($errors->toArray()) !!};
        console.log(errorMessages);
    @endif
});

$(window).on('load', function(){
    $("#no_children").keyup();
});
</script>
@endsection
