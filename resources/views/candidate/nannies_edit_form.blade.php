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
                                </div>

                                <div class="col-md-6">
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
                                        <label for="religion">Religion</label>
                                        <select id="religion" name="religion" class="form-control">
                                            <option value="" selected="selected" disabled="disabled">Select one</option>
                                            <option value="african traditional &amp; Diasporic" {{ isset($candidate->religion) && $candidate->religion == 'african traditional' ? 'selected' : null }}>African Traditional &amp; Diasporic</option>
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
                                        <label for="additional_language">Additional Language</label>
                                        <select id="additional_language" name="additional_language" multiple class="form-control">
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
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="disabilities">Disabilities</label>
                                        <input type="text" id="disabilities" name="disabilities" placeholder="" class="form-control" value="{{ old('disabilities', isset($candidate->disabilities) ? $candidate->disabilities : null) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="south_african_citizen">Are you a South African citizen? </label>
                                        <ul class="flex-wrap" >
                                            <li><input type="radio" checked name="south_african_citizen" value="yes" {{ old('south_african_citizen', $candidate->south_african_citizen) === "yes" ? "checked" : '' }} >&nbsp; Yes</li>
                                            <li><input type="radio" name="south_african_citizen" value="no" {{ old('south_african_citizen', $candidate->south_african_citizen) === "no" ? "checked" : '' }} >&nbsp; No</li>
                                        </ul>
                                        @if ($errors->has('south_african_citizen'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('south_african_citizen') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="working_permit">If NO do you have a working permit? </label>
                                        <ul class="flex-wrap">
                                            <li><input type="radio" checked name="working_permit" value="yes" {{ old('working_permit', $candidate->working_permit) === "yes" ? "checked" : '' }} >&nbsp; Yes</li>
                                            <li><input type="radio" name="working_permit" value="no" {{ old('working_permit', $candidate->working_permit) === "no" ? "checked" : '' }} >&nbsp; No</li>
                                        </ul>
                                        @if ($errors->has('working_permit'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('working_permit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="ages_of_children_you_worked_with">Ages of children you worked with? <span class="text-danger">*</span></label>
                                        <select id="ages_of_children_you_worked_with" multiple name="ages_of_children_you_worked_with[]" class="form-control">
                                            <option value="" disabled>Select</option>
                                            <option value="baby" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("baby", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>Baby</option>
                                            <option value="gradeschooler" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("gradeschooler", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>Gradeschooler</option>
                                            <option value="toddler" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("toddler", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>Toddler</option>
                                            <option value="teenager" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("teenager", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>Teenager</option>
                                            <option value="preschooler" {{ (!empty(old('ages_of_children_you_worked_with')) && in_array("preschooler", old('ages_of_children_you_worked_with')))? 'selected' : '' }}>Preschooler</option>
                                        </select>
                                        @if ($errors->has('ages_of_children_you_worked_with'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('ages_of_children_you_worked_with') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="first_aid">Do you have first aid? </label>
                                        <ul class="flex-wrap" >
                                            <li><input type="radio" checked name="first_aid" value="yes" {{ old('first_aid', $candidate->first_aid) === "yes" ? "checked" : '' }} >&nbsp; Yes</li>
                                            <li><input type="radio" name="first_aid" value="no" {{ old('first_aid', $candidate->first_aid) === "no" ? "checked" : '' }} >&nbsp; No</li>
                                        </ul>
                                        @if ($errors->has('first_aid'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('first_aid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="smoker_or_non_smoker">Smoker / Non-Smoker</label>
                                        <ul class="radio-box-list">
                                            <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="smoker" {{ $candidate->smoker_or_non_smoker == 'smoker' ? 'checked' : '' }}><label>&nbsp; Smoker</label></li>
                                            <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="non_smoker" {{ $candidate->smoker_or_non_smoker == 'non_smoker' ? 'checked' : '' }}><label>&nbsp; Non Smoker</label></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="available_date">From which date would you be available? <span class="text-danger">*</span></label>
                                        <input type="date" id="available_date" name="available_date" value="{{ old('available_date', $candidate->available_date) }}" class="form-control">
                                        @if ($errors->has('available_date'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('available_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="marital_status">Marital Status</label>
                                        <select class="form-control" name="marital_status">
                                            <option selected disabled>select</option>
                                            <option value="married" {{ isset($candidate->marital_status) && $candidate->marital_status == 'married' ? 'selected' : null }}>married</option>
                                            <option value="single" {{ isset($candidate->marital_status) && $candidate->marital_status == 'single' ? 'selected' : null }}>Single</option>
                                            <option value="in a relationship" {{ isset($candidate->marital_status) && $candidate->marital_status == "in a relationship" ? 'selected' : null }}>In a relationship</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="dependants">Do you have any dependants</label>
                                        <select class="form-control" name="dependants">
                                            <option selected disabled>select</option>
                                            <option value="yes" {{ isset($candidate->dependants) && $candidate->dependants == 'yes' ? 'selected' : null }}>Yes</option>
                                            <option value="no" {{ isset($candidate->dependants) && $candidate->dependants == 'no' ? 'selected' : null }}>No</option>
                                        </select>
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
                                        <label for="drivers_license">Do you have your drivers license</label>
                                        <select class="form-control" name="drivers_license">
                                            <option selected>select</option>
                                            <option value="yes" {{ isset($candidate->drivers_license) && $candidate->drivers_license == 'yes' ? 'selected' : null }}>Yes</option>
                                            <option value="no" {{ isset($candidate->drivers_license) && $candidate->drivers_license == 'no' ? 'selected' : null }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="vehicle">Do you have your own vehicle</label>
                                        <select class="form-control" name="vehicle">
                                            <option selected>select</option>
                                            <option value="yes" {{ isset($candidate->vehicle) && $candidate->vehicle == 'yes' ? 'selected' : null }}>Yes</option>
                                            <option value="no" {{ isset($candidate->vehicle) && $candidate->vehicle == 'no' ? 'selected' : null }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="car_accident">Have you ever been in a car accident</label>
                                        <select class="form-control" name="car_accident">
                                            <option selected>select</option>
                                            <option value="yes" {{ isset($candidate->car_accident) && $candidate->car_accident == 'yes' ? 'selected' : null }}>Yes</option>
                                            <option value="no" {{ isset($candidate->car_accident) && $candidate->car_accident == 'no' ? 'selected' : null }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="experience_special_needs">Do you have experience with special needs</label>
                                        <select class="form-control" name="experience_special_needs">
                                            <option selected>select</option>
                                            <option value="yes" {{ isset($candidate->experience_special_needs) && $candidate->experience_special_needs == 'yes' ? 'selected' : null }}>Yes</option>
                                            <option value="no" {{ isset($candidate->experience_special_needs) && $candidate->experience_special_needs == 'no' ? 'selected' : null }}>No</option>
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
                                        <textarea id="about_yourself" name="about_yourself" class="form-control" rows="5" >{{ old('about_yourself', $candidate->about_yourself) }}</textarea>
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