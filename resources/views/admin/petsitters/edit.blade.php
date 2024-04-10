@extends('layouts.app')
@section('content')
    <div class="content-wrapper" style="min-height: 946px;">
        <section class="content-header">
            <div class="container-fluid">
               
                <div class="row">
                    @include ('admin.includes.error')
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>There were some errors:</strong>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    @endif
                </div>
               
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Petsitter</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/candidates/petsitters')}}">{{isset($menu) ? ucwords($menu) : ""}}</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit Petsitter</h3>
                        </div>

                        {{-- form --}}
                        <form method="POST" id="request_data" action="{{ route('admin.candidates.update-petsitters', ['id' => $candidate->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-input">
                                            <label>Candidate Photo <span class="text-danger">*</span></label>
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
                                            <label for="type_of_id_number">Type of ID Number <span class="text-danger">*</span></label>
                                            <ul class="radio-box-list">
                                                <li class="radio-box-item"><input type="radio" checked name="type_of_id_number" value="south_african" {{ old('type_of_id_number', isset($candidate->type_of_id_number) ? $candidate->type_of_id_number : '') === "south_african" ? "checked" : '' }} >&nbsp;South Africa ID</li>
                                                <li class="radio-box-item"><input type="radio" name="type_of_id_number" value="other" {{ old('type_of_id_number', isset($candidate->type_of_id_number) ? $candidate->type_of_id_number : '') === "other" ? "checked" : '' }} >&nbsp;Foreign ID</li>
                                            </ul>
                                            @if ($errors->has('type_of_id_number'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('type_of_id_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="id_number">ID Number <span class="text-danger">*</span></label>
                                            <input type="text" id="id_number" name="id_number" placeholder="" class="form-control"  value="{{ old('id_number', isset($candidate->id_number) ? $candidate->id_number : null) }}">
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
                                            <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
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
                                            <label for="profile">Profile Picture <span class="text-danger">*</span></label>
                                            <input type="file" id="profile" name="profile" placeholder="" class="form-control" accept="image/*" value="{{ old('profile', isset($candidate->profile) ? $candidate->profile : null) }}">
                                            @error('profile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="area">Type in your city <span class="text-danger">*</span></label>
                                            <input type="text" id="area" name="area" placeholder="" class="form-control"  value="{{ old('area', isset($candidate->area) ? $candidate->area : null) }}">
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
                                            <label for="gender">Gender <span class="text-danger">*</span></label>
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
                                            <label for="ethnicity">Ethnicity <span class="text-danger">*</span></label>
                                            <input type="text" id="ethnicity" name="ethnicity" placeholder="" class="form-control" value="{{ old('ethnicity', isset($candidate->ethnicity) ? $candidate->ethnicity : null) }}">
                                            @if ($errors->has('ethnicity'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('ethnicity') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="disabilities">Disabilities <span class="text-danger">*</span></label>
                                            <input type="text" id="disabilities" name="disabilities" placeholder="" class="form-control" value="{{ old('disabilities', isset($candidate->disabilities) ? $candidate->disabilities : null) }}">
                                            @if ($errors->has('disabilities'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('disabilities') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="home_language">Home Language <span class="text-danger">*</span></label>
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
                                            @if ($errors->has('home_language'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('home_language') }}</strong>
                                                </span>
                                            @endif
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
                                            <label for="smoker_or_non_smoker">Smoker / Non-Smoker <span class="text-danger">*</span></label>
                                            <ul class="radio-box-list">
                                                <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="smoker" {{ $candidate->smoker_or_non_smoker == 'smoker' ? 'checked' : '' }}><label>&nbsp;  Smoker</label></li>
                                                <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="non_smoker" {{ $candidate->smoker_or_non_smoker == 'non_smoker' ? 'checked' : '' }}><label>&nbsp; Non Smoker</label></li>
                                            </ul>
                                            @if ($errors->has('smoker_or_non_smoker'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('smoker_or_non_smoker') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="experience_with_animals">Do you have experience with animals <span class="text-danger">*</span></label>
                                            <ul class="flex-wrap">
                                                <li><input type="radio" name="experience_with_animals" value="yes" {{ old('experience_with_animals', $candidate->experience_with_animals) == "yes" ? "checked" : '' }}>&nbsp; Yes</li>
                                                <li><input type="radio" name="experience_with_animals" value="no" {{ old('experience_with_animals', $candidate->experience_with_animals) == "no" ? "checked" : '' }}>&nbsp; No</li>
                                            </ul>
                                            @if ($errors->has('experience_with_animals'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('experience_with_animals') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="do_you_like_animals">Do you like animals <span class="text-danger">*</span></label>
                                            <ul class="flex-wrap">
                                                <li><input type="radio" name="do_you_like_animals" value="yes" {{ old('do_you_like_animals', $candidate->do_you_like_animals) == "yes" ? "checked" : '' }}>&nbsp; Yes</li>
                                                <li><input type="radio" name="do_you_like_animals" value="no" {{ old('do_you_like_animals', $candidate->do_you_like_animals) == "no" ? "checked" : '' }}>&nbsp; No</li>
                                            </ul>
                                            @if ($errors->has('do_you_like_animals'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('do_you_like_animals') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="childcare_experience">How many years of petsitting experience do you have <span class="text-danger">*</span></label>
                                            <select id="childcare_experience" name="childcare_experience" class="form-control">
                                                <option value="">Select</option>
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
                                            @if ($errors->has('childcare_experience'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('childcare_experience') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="situated">Situated <span class="text-danger">*</span></label>
                                            <input type="text" id="situated" name="situated" placeholder="" class="form-control"  value="{{ old('situated', isset($candidate->situated) ? $candidate->situated : null) }}">
                                            @error('situated')
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
                                            <label for="hourly_rate_pay">What is your hourly rate <span class="text-danger">*</span></label>
                                            <div class="input-group mb-1">
                                                <span class="input-group-text">R</span>
                                                    <input type="text" name="hourly_rate_pay" id="hourly_rate_pay" class="form-control" placeholder="" value="{{ old('hourly_rate_pay', isset($candidate->hourly_rate_pay) ? $candidate->hourly_rate_pay : null) }}">
                                                <span class="input-group-text">hr</span>
                                            </div>
                                            @if ($errors->has('hourly_rate_pay'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('hourly_rate_pay') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-inputs" id="dynamic_field">
                                            <div class="d-flex flex-row justify-content-between align-items-start">
                                                <label class="mb-2 fst-italic">List your previous petsitting work experience with contactable references.</label>
                                                <div class="icon-option all-in-one d-flex flex-row d-none">
                                                    <p>Add Reference</p>
                                                    <a href="javaScript:;" class="btn btn-primary add-btn" id="add"><i class="fa-solid fa-plus"></i></a>
                                                </div>
                                            </div>
                                            
                                            @if(isset($previous_experience) && !$previous_experience->isEmpty())
                                                @foreach($previous_experience as $key => $value)
                                                    <div class="row mb-3">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-input">
                                                                <label for="daterange">Date range <span class="text-danger">*</span></label>
                                                                <input type="text" id={{ "daterange_" . $key }} name="daterange[]" class="form-control" placeholder=""  value="{{ old('daterange[]', isset($value->daterange) ? $value->daterange : null) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-input">
                                                                <label for="heading">Heading <span class="text-danger">*</span></label>
                                                                <input type="text" id={{ "heading_" . $key }} name="heading[]" class="form-control" placeholder="" value="{{ old('heading[]', isset($value->heading) ? $value->heading : null) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-input">
                                                                <label for="description">Description <span class="text-danger">*</span></label>
                                                                <input type="text" id={{ "description_" . $key }} name="description[]"class="form-control" placeholder="" value="{{ old('description[]', isset($value->description) ? $value->description : null) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-input">
                                                                <label for="reference">Reference Name <span class="text-danger">*</span></label>
                                                                <input type="text" id={{ "reference_" . $key }} name="reference[]" class="form-control" placeholder="" value="{{ old('reference[]', isset($value->reference) ? $value->reference : null) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-input">
                                                                <label for="tel_number">Tel Number <span class="text-danger">*</span></label>
                                                                <input type="text" id={{ "tel_number_" . $key }} name="tel_number[]" class="form-control" placeholder=""value="{{ old('tel_number[]', isset($value->tel_number) ? $value->tel_number : null) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-input">
                                                            <label for="daterange">Date range <span class="text-danger">*</span></label>
                                                            <input type="text" id="daterange" name="daterange[]" value="{{ isset(old('daterange')[0]) ? old('daterange')[0] : '' }}" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-input">
                                                            <label for="heading">Heading <span class="text-danger">*</span></label>
                                                            <input type="text" id="heading" name="heading[]" value="{{ isset(old('heading')[0]) ? old('heading')[0] : null }}" class="form-control" placeholder="">
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
                                                            <input type="text" id="description" name="description[]" value="{{ isset(old('description')[0]) ? old('description')[0] : null }}" class="form-control" placeholder="">
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
                                                            <input type="text" id="reference" name="reference[]" value="{{ isset(old('reference')[0]) ? old('reference')[0] : null }}" class="form-control" placeholder="">
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
                                                            <input type="text" id="tel_number" name="tel_number[]" value="{{ isset(old('tel_number')[0]) ? old('tel_number')[0] : null }}" class="form-control" placeholder="">
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="about_yourself">Tell us a bit more about yourself <span class="text-danger">*</span></label>
                                            <textarea id="about_yourself" name="about_yourself" class="form-control" rows="8" >{{ old('about_yourself', $candidate->about_yourself) }}</textarea>
                                            <p class="text-end fw-light fst-italic small">Maximum 500 Characters</p>
                                            @if ($errors->has('about_yourself'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('about_yourself') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="mb-2">
                                            <label for="day_hour">What are your available days and hours <span class="text-danger">*</span></label>
                                        </div>
                                        {{-- calender --}}
                                        @include ('admin.calender.edit')
                                        {{-- end calender --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.candidates.petsitters') }}" ><button class="btn btn-default" type="button">Back</button></a>
                                <button type="submit" id="submitButton" class="btn btn-secondary float-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('jquery')
<script type="text/javascript">

    $(window).on("load", function () {
        var file = "{{ isset($candidate->profile) ? $candidate->profile : 'front-user.png' }}";
        if(file !== null){
            $('.js--image-preview').addClass('js--no-default');
            $('.js--image-preview').html('<img src="{{ asset('uploads/profile/') }}/' + file + '" alt="" width = "100px" height = "100px" >');
        }
    });

    $(document).on("change", "#special-needs", function(){
        if($("#special-needs").is(":checked")){
            $("#special-needs-section").css("display", "block");
        }else{
            $("#special-needs-section").css("display", "none");
        }
    });

    $("#no_children").keyup(function(){
        var no_children = $("#no_children").val();
        $("#more_childern").html('');
        if(no_children > 1) {
            for (var i = no_children - 1; i >= 1; i--) {
                $("#more_childern")
                .append(`
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                        <div class="form-group">
                            <label for="age_children">Age of children</label>
                            <select name="age[]" class="form-control" >
                                <option value="Baby"="selected">Baby</option>
                                <option value="Gradeschooler">Gradeschooler</option>
                                <option value="Toddler">Toddler</option>
                                <option value="Teenager">Teenager</option>
                                <option value="Preschooler">Preschooler</option>
                            </select>
                        </div>
                    </div> 

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                        <div class="form-group">
                            <label for="gender_of_children">Gender of children</label>
                            <select name="gender_of_children[]" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                `);
            }
        }
    });
   
    function createOptionAlert(title, text, type) {
        return {
            title: title,
            text: text,
            type: type,
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        };
    }

    $(document).ready(function() {
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

