@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ ucfirst($menu) }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Candidate</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">

        @include('flash.flash-message')
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>There were some errors:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Candidate</h3>
                    </div>
                    <form method="POST" id="request_data" action="{{ route('admin.update-candidate', ['id' => $candidate->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                             <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-input">
                                        <label>Candidate Photo</label>
                                        <div class="box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label>
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" placeholder="" class="form-control" value="{{ old('name', isset($candidate->name) ? $candidate->name : null) }}" >
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="surname">Surname <span class="text-danger">*</span></label>
                                        <input type="text" id="surname" name="surname" placeholder="" class="form-control" value="{{ old('surname', $candidate->surname) }}" >
                                        @if ($errors->has('surname'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('surname') }}</strong>
                                            </span>
                                        @endif
                                    </div>        
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="mail" id="email" name="email" placeholder="" class="form-control" autocomplete="off"  value="{{ old('email', isset($candidate->email) ? $candidate->email : null) }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" id="password" name="password" placeholder="" class="form-control @error('password') is-invalid @enderror" readonly onfocus="this.removeAttribute('readonly');">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="profile">Profile Picture</label>
                                        <input type="file" id="profile" name="profile" placeholder="" class="form-control" value="{{ old('profile', isset($candidate->profile) ? $candidate->profile : null) }}">
                                        @error('profile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="id_number">ID Number <span class="text-danger">*</span></label>
                                        <input type="number" id="id_number" name="id_number" placeholder="" class="form-control"  value="{{ old('id_number', isset($candidate->id_number) ? $candidate->id_number : null) }}">
                                        @error('id_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="number" id="contact_number" name="contact_number" placeholder="" class="form-control"  value="{{ old('contact_number', isset($candidate->contact_number) ? $candidate->contact_number : null) }}">
                                        @error('contact_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="age">Age <span class="text-danger">*</span></label>
                                        <input type="number" id="age" name="age" placeholder="" class="form-control"  value="{{ old('age', isset($candidate->age) ? $candidate->age : null) }}">
                                        @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="situated">Situated</label>
                                        <input type="text" id="situated" name="situated" placeholder="" class="form-control"  value="{{ old('situated', isset($candidate->situated) ? $candidate->situated : null) }}">
                                        @error('situated')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="area">Area Pin <span class="text-danger">*</span></label>
                                        <input type="number" id="area" name="area" placeholder="" class="form-control"  value="{{ old('area', isset($candidate->area) ? $candidate->area : null) }}">
                                        @error('area')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" name="gender">
                                            <option selected disabled="disabled">Select</option>
                                            <option value="male" {{ isset($candidate->gender) && $candidate->gender == 'male' ? 'selected' : null }}>Male</option>
                                            <option value="female" {{ isset($candidate->gender) && $candidate->gender == 'female' ? 'selected' : null }}>Female</option>
                                            <option value="other" {{ isset($candidate->gender) && $candidate->gender == 'other' ? 'selected' : null }}>Other</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="ethnicity">Ethnicity</label>
                                        <input type="text" id="ethnicity" name="ethnicity" placeholder="" class="form-control" value="{{ old('ethnicity', isset($candidate->ethnicity) ? $candidate->ethnicity : null) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="disabilities">Disabilities</label>
                                        <input type="text" id="disabilities" name="disabilities" placeholder="" class="form-control" value="{{ old('disabilities', isset($candidate->disabilities) ? $candidate->disabilities : null) }}">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="home_language">Home Language</label>
                                        <select id="home_language" name="home_language" class="form-control">
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
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="animals_comfortable_with">Which animals do you feel comfortable working with <span class="text-danger">*</span></label>
                                        <select id="animals_comfortable_with" multiple name="animals_comfortable_with[]" class="form-control">
                                            <option value="" disabled>Select</option>
                                            <option value="dogs" {{ !empty($candidate->animals_comfortable_with) && in_array("dogs", $candidate->animals_comfortable_with) ? "selected" : " " }}>Dogs</option>
                                            <option value="cats" {{ !empty($candidate->animals_comfortable_with) && in_array("cats", $candidate->animals_comfortable_with) ? "selected" : " " }}>Cats</option>
                                            <option value="hamsters_and_guinea_pigs" {{ !empty($candidate->animals_comfortable_with) && in_array("hamsters_and_guinea_pigs", $candidate->animals_comfortable_with) ? "selected" : " " }}>Hamsters &amp; Guinea pigs</option>
                                            <option value="reptiles" {{!empty($candidate->animals_comfortable_with) && in_array("reptiles", $candidate->animals_comfortable_with) ? "selected" : " " }}>Reptiles</option>
                                            <option value="spiders" {{ !empty($candidate->animals_comfortable_with) && in_array("spiders", $candidate->animals_comfortable_with) ? "selected" : " " }}>Spiders</option>
                                        </select> 
                                        @if ($errors->has('animals_comfortable_with'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('animals_comfortable_with') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="smoker_or_non_smoker">Smoker / Non-Smoker</label>
                                        <ul class="radio-box-list">
                                            <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="smoker" {{ $candidate->smoker_or_non_smoker == 'smoker' ? 'checked' : '' }}><label>&nbsp;  Smoker</label></li>
                                            <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="non_smoker" {{ $candidate->smoker_or_non_smoker == 'non_smoker' ? 'checked' : '' }}><label>&nbsp; Non Smoker</label></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="experience_with_animals">Do you have experience with animals?</label>
                                        <ul class="flex-wrap">
                                            <li><input type="radio" name="experience_with_animals" value="yes" {{ old('experience_with_animals', $candidate->experience_with_animals) == "yes" ? "checked" : '' }}>&nbsp; Yes</li>
                                            <li><input type="radio" name="experience_with_animals" value="no" {{ old('experience_with_animals', $candidate->experience_with_animals) == "no" ? "checked" : '' }}>&nbsp; No</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="do_you_like_animals">Do you like animals?</label>
                                        <ul class="flex-wrap">
                                            <li><input type="radio" name="do_you_like_animals" value="yes" {{ old('do_you_like_animals', $candidate->do_you_like_animals) == "yes" ? "checked" : '' }}>&nbsp; Yes</li>
                                            <li><input type="radio" name="do_you_like_animals" value="no" {{ old('do_you_like_animals', $candidate->do_you_like_animals) == "no" ? "checked" : '' }}>&nbsp; No</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="chronical_medication">Are you on any chronical medication</label>
                                        <select class="form-control" name="chronical_medication">
                                            <option selected disabled>select</option>
                                            <option value="yes" {{ isset($candidate->chronical_medication) && $candidate->chronical_medication == 'yes' ? 'selected' : null }}>Yes</option>
                                            <option value="no" {{ isset($candidate->chronical_medication) && $candidate->chronical_medication == 'no' ? 'selected' : null }}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="childcare_experience">How many years of childcare experience do you have</label>
                                        <select id="childcare_experience" name="childcare_experience" class="form-control">
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
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group" id="dynamic_field">
                                        <label class="mb-2 fst-italic">List your previous childcare work experience with contactable references.</label>
                                       {{--  <div class="icon-option all-in-one">
                                            <a href="javaScript:;" class="btn btn-primary add-btn" id="add"><i class="fas fa-plus"></i></a>
                                        </div> --}}

                                        @if(isset($previous_experience) && !$previous_experience->isEmpty())
                                            @foreach($previous_experience as $key => $value)
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="daterange">Date range</label>
                                                            <input type="text" id="daterange" name="daterange[]" class="form-control" placeholder=""  value="{{ old('daterange[]', isset($value->daterange) ? $value->daterange : null) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="heading">Heading</label>
                                                            <input type="text" id="heading" name="heading[]" class="form-control" placeholder="" value="{{ old('heading[]', isset($value->heading) ? $value->heading : null) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <input type="text" id="description" name="description[]" class="form-control" placeholder="" value="{{ old('description[]', isset($value->description) ? $value->description : null) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="reference">Reference Name</label>
                                                            <input type="text" id="reference" name="reference[]" class="form-control" placeholder="" value="{{ old('reference[]', isset($value->reference) ? $value->reference : null) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="tel_number">Tel Number</label>
                                                            <input type="text" id="tel_number" name="tel_number[]" class="form-control" placeholder=""value="{{ old('tel_number[]', isset($value->tel_number) ? $value->tel_number : null) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="daterange">Date range</label>
                                                            <input type="text" id="daterange" name="daterange[]" value="10/01/2023 - 12/15/2023" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="heading">Heading</label>
                                                            <input type="text" id="heading" name="heading[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <input type="text" id="description" name="description[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="reference">Reference Name</label>
                                                            <input type="text" id="reference" name="reference[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="tel_number">Tel Number</label>
                                                            <input type="text" id="tel_number" name="tel_number[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="about_yourself">Tell us a bit more about yourself? </label>
                                        <textarea id="about_yourself" name="about_yourself" class="form-control" rows="8" >{{ old('about_yourself', $candidate->about_yourself) }}</textarea>
                                        <p class="text-end fw-light fst-italic small">Minimum 200 Characters</p>
                                        @if ($errors->has('about_yourself'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('about_yourself') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="day_hour">What are your available days and hours <span class="text-danger">*</span></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm">
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
                                                                <label><input type="checkbox" name="morning[]" value="mo_morning" id="" {{ isset($morning) && in_array("mo_morning", $morning ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="morning[]" value="tu_morning" id="" {{ isset($morning) && in_array("tu_morning", $morning ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="morning[]" value="we_morning" id="" {{ isset($morning) && in_array("we_morning", $morning ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="morning[]" value="th_morning" id="" {{ isset($morning) && in_array("th_morning", $morning ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="morning[]" value="fr_morning" id="" {{ isset($morning) && in_array("fr_morning", $morning ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="morning[]" value="sa_morning" id="" {{ isset($morning) && in_array("sa_morning", $morning ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="morning[]" value="su_morning" id="" {{ isset($morning) && in_array("su_morning", $morning ) ? 'checked' : '' }}></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Afternoon: 13:00 – 17:00</th>
                                                            <td>
                                                                <label><input type="checkbox" name="afternoon[]" value="mo_afternoon" id="" {{ isset($afternoon) && in_array("mo_afternoon", $afternoon ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="afternoon[]" value="tu_afternoon" id="" {{ isset($afternoon) && in_array("tu_afternoon", $afternoon ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="afternoon[]" value="we_afternoon" id="" {{ isset($afternoon) && in_array("we_afternoon", $afternoon ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="afternoon[]" value="th_afternoon" id="" {{ isset($afternoon) && in_array("th_afternoon", $afternoon ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="afternoon[]" value="fr_afternoon" id="" {{ isset($afternoon) && in_array("fr_afternoon", $afternoon ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="afternoon[]" value="sa_afternoon" id="" {{ isset($afternoon) && in_array("sa_afternoon", $afternoon ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="afternoon[]" value="su_afternoon" id="" {{ isset($afternoon) && in_array("su_afternoon", $afternoon ) ? 'checked' : '' }}></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Evening: 17:00 – 21:00</th>
                                                            <td>
                                                                <label><input type="checkbox" name="evening[]" value="mo_evening" id="" {{ isset($evening) && in_array("mo_evening", $evening ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="evening[]" value="tu_evening" id="" {{ isset($evening) && in_array("tu_evening", $evening ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="evening[]" value="we_evening" id="" {{ isset($evening) && in_array("we_evening", $evening ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="evening[]" value="th_evening" id="" {{ isset($evening) && in_array("th_evening", $evening ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="evening[]" value="fr_evening" id="" {{ isset($evening) && in_array("fr_evening", $evening ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="evening[]" value="sa_evening" id="" {{ isset($evening) && in_array("sa_evening", $evening ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="evening[]" value="su_evening" id="" {{ isset($evening) && in_array("su_evening", $evening ) ? 'checked' : '' }}></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Night: 21:00 – 00:00</th>
                                                            <td>
                                                                <label><input type="checkbox" name="night[]" value="mo_night" id="" {{ isset($night) && in_array("mo_night", $night ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="night[]" value="tu_night" id="" {{ isset($night) && in_array("tu_night", $night ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="night[]" value="we_night" id="" {{ isset($night) && in_array("we_night", $night ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="night[]" value="th_night" id="" {{ isset($night) && in_array("th_night", $night ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="night[]" value="fr_night" id="" {{ isset($night) && in_array("fr_night", $night ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="night[]" value="sa_night" id="" {{ isset($night) && in_array("sa_night", $night ) ? 'checked' : '' }}></label>
                                                            </td>
                                                            <td>
                                                                <label><input type="checkbox" name="night[]" value="su_night" id="" {{ isset($night) && in_array("su_night", $night ) ? 'checked' : '' }}></label>
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
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="salary_expectation">What is your salary expectation/hourly rate</label>
                                        <input type="number" id="salary_expectation" name="salary_expectation" placeholder="" class="form-control @error('salary_expectation') is-invalid @enderror"  value="{{ old('salary_expectation', isset($candidate->salary_expectation) ? $candidate->salary_expectation : null) }}">
                                        @error('salary_expectation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="other_services">Other Services </label>
                                        <select id="other_services" name="other_services[]" multiple class="form-control">
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
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submitButton" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    $(window).on("load", function () {
        var file = "{{ isset($candidate->profile) ? $candidate->profile : null }}";
        if(file !== null){
            $('.js--image-preview').addClass('js--no-default');
            $('.js--image-preview').html('<img src="{{ url('../storage/app/public/uploads/') }}/' + file + '" alt="" width = "100px" height = "100px" >');
        }
    });
</script>
@endsection