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

                <div class="form-input mb-3">
                    <label for="surname">Surname <span class="text-danger">*</span></label>
                    <input type="text" id="surname" name="surname" placeholder="" class="form-field" value="{{ old('surname', isset($candidate->surname) ? $candidate->surname : null) }}" >
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
                    <label for="religion">Religion <span class="text-danger">*</span></label>
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
                @if ($errors->has('religion'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('religion') }}</strong>
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
                    <label for="additional_language">Additional Language <span class="text-danger">*</span></label>
                    <select id="additional_language" name="additional_language" multiple class="form-field">
                        <option value="" selected="selected" disabled="disabled">Select one</option>
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
                @if ($errors->has('additional_language'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('additional_language') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="south_african_citizen">Are you a South African citizen <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap" >
                        <li><input type="radio" checked name="south_african_citizen" value="yes" {{ old('south_african_citizen', $candidate->south_african_citizen) === "yes" ? "checked" : '' }} >Yes</li>
                        <li><input type="radio" name="south_african_citizen" value="no" {{ old('south_african_citizen', $candidate->south_african_citizen) === "no" ? "checked" : '' }} >No</li>
                    </ul>
                    @if ($errors->has('south_african_citizen'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('south_african_citizen') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="working_permit">If NO do you have a working permit <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" checked name="working_permit" value="yes" {{ old('working_permit', $candidate->working_permit) === "yes" ? "checked" : '' }} >Yes</li>
                        <li><input type="radio" name="working_permit" value="no" {{ old('working_permit', $candidate->working_permit) === "no" ? "checked" : '' }} >No</li>
                    </ul>
                    @if ($errors->has('working_permit'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('working_permit') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="ages_of_children_you_worked_with">Ages of children you worked with <span class="text-danger">*</span></label>
                    <select id="ages_of_children_you_worked_with" multiple name="ages_of_children_you_worked_with[]" class="form-field">
                        <option value="" >Select</option>
                        <option value="0-12 months" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && (in_array("0-12 months", $candidate->ages_of_children_you_worked_with) || in_array("0_12_months", $candidate->ages_of_children_you_worked_with)))? 'selected' : '' }}>0-12 months</option>
                        <option value="1-3 years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && (in_array("1-3 years", $candidate->ages_of_children_you_worked_with) || in_array("1_3_years", $candidate->ages_of_children_you_worked_with)))? 'selected' : '' }}>1-3 years</option>
                        <option value="4-7 years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && (in_array("4-7 years", $candidate->ages_of_children_you_worked_with) || in_array("4_7_years", $candidate->ages_of_children_you_worked_with)))? 'selected' : '' }}>4-7 years</option>
                        <option value="8-13 years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && (in_array("8-13 years", $candidate->ages_of_children_you_worked_with) || in_array("8_13_years", $candidate->ages_of_children_you_worked_with)))? 'selected' : '' }}>8-13 years</option>
                        <option value="13-16 years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && (in_array("13-16 years", $candidate->ages_of_children_you_worked_with) || in_array("13_16_years", $candidate->ages_of_children_you_worked_with)))? 'selected' : '' }}>13-16 years</option>
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
                    <label for="first_aid">Do you have first aid <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap" >
                        <li><input type="radio" checked name="first_aid" value="yes" {{ old('first_aid', $candidate->first_aid) === "yes" ? "checked" : '' }} >Yes</li>
                        <li><input type="radio" name="first_aid" value="no" {{ old('first_aid', $candidate->first_aid) === "no" ? "checked" : '' }} >No</li>
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
                    <label for="available_date">From which date would you be available? <span class="text-danger">*</span></label>
                    <input type="date" id="available_date" name="available_date" value="{{ old('available_date', $candidate->available_date) }}" class="form-field">
                    @if ($errors->has('available_date'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('available_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="smoker_or_non_smoker">Smoker / Non-Smoker <span class="text-danger">*</span></label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="smoker" {{ $candidate->smoker_or_non_smoker == 'smoker' ? 'checked' : '' }}><label>Smoker</label></li>
                        <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="non_smoker" {{ $candidate->smoker_or_non_smoker == 'non_smoker' ? 'checked' : '' }}><label>Non Smoker</label></li>
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
                    <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                    <ul class="radio-box-list d-flex flex-wrap">
                        <li class="radio-box-item"><input type="radio" name="marital_status" value="married" {{ isset($candidate->marital_status) && $candidate->marital_status == 'married' ? 'checked' : null }}><label>Married</label></li>
                        <li class="radio-box-item"><input type="radio" name="marital_status" value="single" {{ isset($candidate->marital_status) && $candidate->marital_status == 'single' ? 'checked' : null }}><label>Single</label></li>
                        <li class="radio-box-item"><input type="radio" name="marital_status" value="in a relationship" {{ isset($candidate->marital_status) && $candidate->marital_status == "in a relationship" ? 'checked' : null }}><label>In a Relationship</label></li>
                    </ul>
                </div>
                @if ($errors->has('marital_status'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('marital_status') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="dependants">Do you have any dependants <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="dependants" value="yes" {{ isset($candidate->dependants) && $candidate->dependants == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="dependants" value="no"  {{ isset($candidate->dependants) && $candidate->dependants == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
                @if ($errors->has('dependants'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('dependants') }}</strong>
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
                    <label for="drivers_license">Do you have your drivers license <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="drivers_license" value="yes" {{ isset($candidate->drivers_license) && $candidate->drivers_license == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="drivers_license" value="no" {{ isset($candidate->drivers_license) && $candidate->drivers_license == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
                @if ($errors->has('drivers_license'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('drivers_license') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="vehicle">Do you have your own vehicle <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="vehicle" value="yes" {{ isset($candidate->vehicle) && $candidate->vehicle == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="vehicle" value="no" {{ isset($candidate->vehicle) && $candidate->vehicle == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
                @if ($errors->has('vehicle'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('vehicle') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="car_accident">Have you ever been in a car accident <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="car_accident" value="yes" {{ isset($candidate->car_accident) && $candidate->car_accident == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="car_accident" value="no" {{ isset($candidate->car_accident) && $candidate->car_accident == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
                @if ($errors->has('car_accident'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('car_accident') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="first_aid">Would you be comfortable with doing light housework as well <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap" >
                        <li><input type="radio" checked name="comfortable_with_light_housework" value="yes" {{ old('comfortable_with_light_housework', $candidate->comfortable_with_light_housework) === "yes" ? "checked" : '' }} >Yes</li>
                        <li><input type="radio" name="comfortable_with_light_housework" value="no" {{ old('comfortable_with_light_housework', $candidate->comfortable_with_light_housework) === "no" ? "checked" : '' }} >No</li>
                    </ul>
                    @if ($errors->has('comfortable_with_light_housework'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('comfortable_with_light_housework') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="experience_special_needs">Do you have experience with special needs <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" name="experience_special_needs" value="yes" {{ isset($candidate->experience_special_needs) && $candidate->experience_special_needs == 'yes' ? 'checked' : null }}>Yes</li>
                        <li><input type="radio" name="experience_special_needs" value="no" {{ isset($candidate->experience_special_needs) && $candidate->experience_special_needs == 'no' ? 'checked' : null }}>No</li>
                    </ul>
                </div>
                @if ($errors->has('experience_special_needs'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('experience_special_needs') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="live_in_or_live_out">Live in / Live out <span class="text-danger">*</span></label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="live_in_or_live_out" checked value="live in" {{ old('live_in_or_live_out', $candidate->live_in_or_live_out) === "live in" ? 'checked' : '' }} class="form-field"><label>Live in</label></li>
                        <li class="radio-box-item"><input type="radio" name="live_in_or_live_out" value="live out" {{ old('live_in_or_live_out', $candidate->live_in_or_live_out) === "live out" ? 'checked' : '' }} class="form-field"><label>Live out</label></li>
                    </ul>
                    @if ($errors->has('live_in_or_live_out'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('live_in_or_live_out') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="special_needs_specifications">If yes please specify</label>
                <textarea id="special_needs_specifications" name="special_needs_specifications" placeholder="" class="form-field" rows="5" >{{ old('special_needs_specifications', $candidate->special_needs_specifications) }}</textarea>
                <p class="text-end fw-light fst-italic small">Maximum 500 Characters</p>
                @if ($errors->has('special_needs_specifications'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('special_needs_specifications') }}</strong>
                    </span>
                @endif
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
                    <label for="salary_expectation">What is your salary expectation <span class="text-danger">*</span></label>
                    <input type="number" id="salary_expectation" name="salary_expectation" placeholder="" class="form-field @error('salary_expectation') is-invalid @enderror"  value="{{ old('salary_expectation', isset($candidate->salary_expectation) ? $candidate->salary_expectation : null) }}">
                    @error('salary_expectation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="childcare_experience">How many years of childcare experience do you have <span class="text-danger">*</span></label>
                    <select id="childcare_experience" name="childcare_experience" class="form-field">
                        <option value="" selected="selected" disabled="disabled">Select</option>
                        <option value="6 months" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "6 months" ? "selected" : '' }}>6 Months</option>
                        <option value="1 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "1 years" ? "selected" : '' }}>1 years</option>
                        <option value="1.5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "1.5 years" ? "selected" : '' }}>1.5 years</option>
                        <option value="2 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "2 years" ? "selected" : '' }}>2 years</option>
                        <option value="2.5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "2.5 years" ? "selected" : '' }}>2.5 years</option>
                        <option value="3 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "3 years" ? "selected" : '' }}>3 years</option>
                        <option value="3.5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "3.5 years" ? "selected" : '' }}>3.5 years</option>
                        <option value="4 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "4 years" ? "selected" : '' }}>4 years</option>
                        <option value="4.5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "4.5 years" ? "selected" : '' }}>4.5 years</option>
                        <option value="5 years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "5 years" ? "selected" : '' }}>5 years</option>
                        <option value="5+ years" {{ isset($candidate->childcare_experience) && $candidate->childcare_experience == "5+ years" ? "selected" : '' }}>5+ years</option>
                    </select>
                </div>
                @if ($errors->has('hourly_rate_pay'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('hourly_rate_pay') }}</strong>
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
                    
                    @if(isset($previous_experience) && !$previous_experience->isEmpty())
                        @foreach($previous_experience as $key => $value)
                            <div class="row mt-3">
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
                        <div class="row mt-3">
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

            <div class="row"></div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="mb-2">
                    <label for="day_hour">What are your available days and hours</label>
                </div>
                @include('user.calender.edit')
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


        $(window).on("load", function () {
            var file = "{{ isset($candidate->profile) ? $candidate->profile : 'front-user.png' }}";
            if(file !== null){
                $('.js--image-preview').addClass('js--no-default');
                $('.js--image-preview').html('<img src="{{ asset('uploads/profile/') }}/' + file + '" alt="">');
            }
        });

        /*get validaton errors*/
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
