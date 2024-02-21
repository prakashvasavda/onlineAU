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
                        <h1>Edit {{isset($menu) ? ucwords($menu) : ""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/candidates/babysitters')}}">{{isset($menu) ? ucwords($menu) : ""}}</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{isset($menu) ? ucwords($menu) : ""}} Form</h3>
                        </div>
                        {{-- form --}}
                        <form method="POST" id="request_data" action="{{ route('admin.candidates.update-babysitters', ['id' => $candidate->id]) }}" enctype="multipart/form-data">
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
                                            <label for="password">Password <span class="text-danger d-none">*</span></label>
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
                                            @if ($errors->has('id_number'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('id_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
                                            <input type="number" id="contact_number" name="contact_number" placeholder="" class="form-control"  value="{{ old('contact_number', isset($candidate->contact_number) ? $candidate->contact_number : null) }}">
                                            @if ($errors->has('contact_number'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                                </span>
                                            @endif
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
                                            <label for="area">Type in your City <span class="text-danger">*</span></label>
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
                                            <label for="religion">Religion <span class="text-danger">*</span></label>
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
                                        @if ($errors->has('religion'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('religion') }}</strong>
                                            </span>
                                        @endif
                                    </div>

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
                                </div>

                                <div class="row">
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

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="additional_language">Additional Language <span class="text-danger">*</span></label>
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
                                            @if ($errors->has('additional_language'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('additional_language') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                                            <ul class="radio-box">
                                                <li class="radio-box-item"><input type="radio" name="marital_status" value="married" {{ isset($candidate->marital_status) && $candidate->marital_status == 'married' ? 'checked' : null }}><label>&nbsp;Married</label></li>
                                                <li class="radio-box-item"><input type="radio" name="marital_status" value="single" {{ isset($candidate->marital_status) && $candidate->marital_status == 'single' ? 'checked' : null }}><label>&nbsp;Single</label></li>
                                                <li class="radio-box-item"><input type="radio" name="marital_status" value="in a relationship" {{ isset($candidate->marital_status) && $candidate->marital_status == "in a relationship" ? 'checked' : null }}><label>&nbsp;In a Relationship</label></li>
                                            </ul>
                                            @if ($errors->has('marital_status'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="dependants">Do you have any dependants <span class="text-danger">*</span></label>
                                            <ul class="radio-box">
                                                <li><input type="radio" name="dependants" value="yes" {{ isset($candidate->dependants) && $candidate->dependants == 'yes' ? 'checked' : null }}>&nbsp; Yes</li>
                                                <li><input type="radio" name="dependants" value="no"  {{ isset($candidate->dependants) && $candidate->dependants == 'no' ? 'checked' : null }}>&nbsp; No</li>
                                            </ul>
                                            @if ($errors->has('dependants'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('dependants') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="chronical_medication">Are you on any chronical medication <span class="text-danger">*</span></label>
                                            <ul class="radio-box">
                                                <li><input type="radio" name="chronical_medication" value="yes" {{ isset($candidate->chronical_medication) && $candidate->chronical_medication == 'yes' ? 'checked' : null }}>&nbsp; Yes</li>
                                                <li><input type="radio" name="chronical_medication" value="no" {{ isset($candidate->chronical_medication) && $candidate->chronical_medication == 'no' ? 'checked' : null }}>&nbsp; No</li>
                                            </ul>
                                            @if ($errors->has('chronical_medication'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('chronical_medication') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="drivers_license">Do you have your drivers license <span class="text-danger">*</span></label>
                                            <ul class="radio-box">
                                                <li><input type="radio" name="drivers_license" value="yes" {{ isset($candidate->drivers_license) && $candidate->drivers_license == 'yes' ? 'checked' : null }}>&nbsp;Yes</li>
                                                <li><input type="radio" name="drivers_license" value="no" {{ isset($candidate->drivers_license) && $candidate->drivers_license == 'no' ? 'checked' : null }}>&nbsp;No</li>
                                            </ul>
                                            @if ($errors->has('drivers_license'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('drivers_license') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="vehicle">Do you have your own vehicle <span class="text-danger">*</span></label>
                                            <ul class="radio-box">
                                                <li><input type="radio" name="vehicle" value="yes" {{ isset($candidate->vehicle) && $candidate->vehicle == 'yes' ? 'checked' : null }}>&nbsp;Yes</li>
                                                <li><input type="radio" name="vehicle" value="no" {{ isset($candidate->vehicle) && $candidate->vehicle == 'no' ? 'checked' : null }}>&nbsp;No</li>
                                            </ul>
                                            @if ($errors->has('vehicle'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('vehicle') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="car_accident">Have you ever been in a car accident <span class="text-danger">*</span></label>
                                            <ul class="radio-box">
                                                <li><input type="radio" name="car_accident" value="yes" {{ isset($candidate->car_accident) && $candidate->car_accident == 'yes' ? 'checked' : null }}>&nbsp;Yes</li>
                                                <li><input type="radio" name="car_accident" value="no" {{ isset($candidate->car_accident) && $candidate->car_accident == 'no' ? 'checked' : null }}>&nbsp;No</li>
                                            </ul>
                                            @if ($errors->has('car_accident'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('car_accident') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="hourly_rate_pay">What is your hourly rate <span class="text-danger">*</span></label>
                                            <div class="input-group mb-1">
                                                <span class="input-group-text">R</span>
                                                    <input type="text" name="hourly_rate_pay" id="hourly_rate_pay" class="form-control" placeholder="" value="{{ old('hourly_rate_pay', isset($candidate->hourly_rate_pay) ? $candidate->hourly_rate_pay : '') }}">
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
                                        <div class="form-group">
                                            <label for="experience_special_needs">Do you have experience with special needs <span class="text-danger">*</span></label>
                                            <ul class="flex-wrap">
                                                <li><input type="radio" name="experience_special_needs" value="yes" {{ isset($candidate->experience_special_needs) && $candidate->experience_special_needs == 'yes' ? 'checked' : null }}>&nbsp; Yes</li>
                                                <li><input type="radio" name="experience_special_needs" value="no" {{ isset($candidate->experience_special_needs) && $candidate->experience_special_needs == 'no' ? 'checked' : null }}>&nbsp;  No</li>
                                            </ul>
                                        </div>
                                        @if ($errors->has('experience_special_needs'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('experience_special_needs') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="first_aid">Do you have first aid <span class="text-danger">*</span></label>
                                            <ul class="flex-wrap">
                                                <li><input type="radio" name="first_aid" value="yes" {{ old('first_aid', $candidate->first_aid) == "yes" ? "checked" : '' }}>&nbsp; Yes</li>
                                                <li><input type="radio" name="first_aid" value="no" {{ old('first_aid', $candidate->first_aid) == "no" ? "checked" : '' }}>&nbsp; No</li>
                                            </ul>
                                        </div>
                                        @if ($errors->has('first_aid'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('first_aid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="smoker_or_non_smoker">Smoker / Non-Smoker <span class="text-danger">*</span></label>
                                            <ul class="radio-box-list">
                                                <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="smoker" {{ $candidate->smoker_or_non_smoker == 'smoker' ? 'checked' : '' }}><label>&nbsp;  Smoker</label></li>
                                                <li class="radio-box-item"><input type="radio" name="smoker_or_non_smoker" value="non_smoker" {{ $candidate->smoker_or_non_smoker == 'non_smoker' ? 'checked' : '' }}><label>&nbsp; Non Smoker</label></li>
                                            </ul>
                                        </div>
                                        @if ($errors->has('smoker_or_non_smoker'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('smoker_or_non_smoker') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="childcare_experience">How many years of childcare experience do you have <span class="text-danger">*</span></label>
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
                                            @if ($errors->has('childcare_experience'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('childcare_experience') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="ages_of_children_you_worked_with">Ages of children you worked with <span class="text-danger">*</span></label>
                                            <select id="ages_of_children_you_worked_with" multiple name="ages_of_children_you_worked_with[]" class="form-control" size="5" style="height: 100%;">
                                                <option value="" disabled>Select</option>
                                                <option value="0_12_months" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("0_12_months", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>0-12 months</option>
                                                <option value="1_3_years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("1_3_years", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>1-3 years</option>
                                                <option value="4_7_years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("4_7_years", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>4-7 years</option>
                                                <option value="8_13_years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("8_13_years", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>8-13 years</option>
                                                <option value="13_16_years" {{ (!empty($candidate->ages_of_children_you_worked_with) && is_array($candidate->ages_of_children_you_worked_with) && in_array("13_16_years", $candidate->ages_of_children_you_worked_with))? 'selected' : '' }}>13-16 years</option>
                                            </select>
                                            @if ($errors->has('ages_of_children_you_worked_with'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('ages_of_children_you_worked_with') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                
                                </div>

                               <div class="row">
                                    <div class="col-12">
                                        <div class="form-inputs" id="dynamic_field">
                                            <div class="d-flex flex-row justify-content-between align-items-start">
                                                <label class="mb-2 fst-italic">List your previous childcare work experience with contactable references.</label>
                                                <div class="icon-option all-in-one d-flex flex-row d-none">
                                                    <p>Add Reference</p>
                                                    <a href="javaScript:;" class="btn btn-primary add-btn" id="add"><i class="fa-solid fa-plus"></i></a>
                                                </div>
                                            </div>
                                            
                                            @if(isset($previous_experience) && !$previous_experience->isEmpty())
                                                @foreach($previous_experience as $key => $value)
                                                    <div class="row">
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
                                                <div class="row">
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
                                            <label for="about_yourself">Tell us a bit more about yourself  <span class="text-danger">*</span></label>
                                            <textarea id="about_yourself" name="about_yourself" class="form-control" rows="7" >{{ old('about_yourself', $candidate->about_yourself) }}</textarea>
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
                                            <label for="day_hour">What are your available days and hours</label>
                                        </div>
                                        <div class="timeForm">
                                            <table class="table table-bordered table-sm">
                                                <tbody>
                                                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                                        <tr id="{{ $day }}-row">
                                                            <td><input type="checkbox" checked disabled></td>
                                                            <td>{{ ucfirst($day) }}</td>
                                                            <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][0] ?? null }}"></td>
                                                            <td>to</td>
                                                            <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][0] ?? null }}"></td>
                                                            <td onclick="addCalendarRow('{{ $day }}')">
                                                                <a href="javaScript:;" class="btn add-btn icon">
                                                                    <i class="fa fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                        
                                                         @if(isset($calendars[$day]) && !empty($calendars[$day]) && is_array($calendars[$day]))
                                                            @foreach($calendars[$day]['start_time'] as $key => $value)
                                                                @if(isset($key) && $key >= 1 && isset($calendars[$day]['start_time'][$key]) && isset($calendars[$day]['end_time'][$key]))
                                                                    <tr id="{{ $day }}-row">
                                                                        <td><input type="checkbox" checked disabled></td>
                                                                        <td>{{ ucfirst($day) }}</td>
                                                                        <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][$key] }}"></td>
                                                                        <td>to</td>
                                                                        <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][$key] }}"></td>
                                                                        <td onclick="removeCalendarRow(event)">
                                                                            <a href="javaScript:;" class="btn add-btn icon">
                                                                                <i class="fa fa-trash"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        
                                                        @if(old($day) && is_array(old($day)))
                                                            @foreach(old($day)['start_time'] as $key => $value)
                                                                @if(isset($key) && $key >= 1 && isset(old($day)['start_time'][$key]) && isset(old($day)['end_time'][$key]))
                                                                    <tr id="{{ $day }}-row">
                                                                        <td><input type="checkbox" checked disabled></td>
                                                                        <td>{{ ucfirst($day) }}</td>
                                                                        <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][$key] }}"></td>
                                                                        <td>to</td>
                                                                        <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][$key] }}"></td>
                                                                        <td onclick="removeCalendarRow(event)">
                                                                            <a href="javaScript:;" class="btn add-btn icon">
                                                                                <i class="fa fa-trash"></i>
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

                                </div>

                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.candidates.babysitters') }}" ><button class="btn btn-default" type="button">Back</button></a>
                                <button type="submit" id="submitButton" class="btn btn-info float-right">Update</button>
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

