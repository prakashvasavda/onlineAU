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
                            <li class="breadcrumb-item"><a href="{{url('admin/family-petsitting')}}">{{isset($menu) ? ucwords($menu) : ""}}</a></li>
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

                        <form method="POST" id="request_data" action="{{ url('admin/family-petsitting', ['id' => $family->id]) }}" enctype="multipart/form-data">
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" placeholder="" class="form-control" value="{{ old('name', isset($family->name) ? $family->name : null) }}" >
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="surname">Surname <span class="text-danger">*</span></label>
                                            <input type="text" id="surname" name="surname" placeholder="" class="form-control" value="{{ old('surname', $family->surname) }}" >
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
                                            <input type="email" id="email" name="email" value="{{ old('email', isset($family->email) ? $family->email : '') }}" placeholder="" class="form-control" autocomplete="off">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="email">Password </label>
                                            <input type="password" id="password" name="password" placeholder="" class="form-control @error('password') is-invalid @enderror"  value="" readonly onfocus="this.removeAttribute('readonly');">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="profile">Profile Picture <span class="text-danger">*</span></label>
                                            <input type="file" id="profile" name="profile" placeholder="" class="form-control" value="{{ old('profile', isset($family->profile) ? $family->profile : null) }}" accept="image/*">
                                            @if ($errors->has('profile'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('profile') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                           <label for="cell_number">Cell Number <span class="text-danger">*</span></label>
                                           <input type="number" id="cell_number" name="cell_number" value="{{ old('cell_number', isset($family->cell_number) ? $family->cell_number : '') }}" placeholder="" class="form-control">
                                           @if ($errors->has('cell_number'))
                                               <span class="text-danger">
                                                   <strong>{{ $errors->first('cell_number') }}</strong>
                                               </span>
                                           @endif
                                       </div>
                                   </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="type_of_id_number">Type of ID Number <span class="text-danger">*</span></label>
                                            <ul class="radio-box-list">
                                                <li class="radio-box-item"><input type="radio" checked name="type_of_id_number" value="south_african" {{ old('type_of_id_number', isset($family->type_of_id_number) ? $family->type_of_id_number : '') === "south_african" ? "checked" : '' }} >&nbsp;South Africa ID</li>
                                                <li class="radio-box-item"><input type="radio" name="type_of_id_number" value="other" {{ old('type_of_id_number', isset($family->type_of_id_number) ? $family->type_of_id_number : '') === "other" ? "checked" : '' }} >&nbsp;Foreign ID</li>
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
                                            <label for="id_number">ID number <span class="text-danger">*</span></label>
                                            <input type="text" id="id_number" name="id_number" value="{{ old('id_number', isset($family->id_number) ? $family->id_number : '') }}" placeholder="" class="form-control">
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
                                            <label for="duration_needed">Duration needed <span class="text-danger">*</span></label>
                                            <input type="text" id="duration_needed" name="duration_needed" placeholder="duration needed" value="{{ old('duration_needed', isset($family->duration_needed) ? $family->duration_needed : '') }}" class="form-control">
                                            @if ($errors->has('duration_needed'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('duration_needed') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="start_date">Start date <span class="text-danger">*</span></label>
                                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', isset($family->start_date) ? $family->start_date : '') }}" class="form-control">
                                            @if ($errors->has('start_date'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('start_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="address">Your Address <span class="text-danger">*</span></label>
                                            <input type="text" id="address" name="family_address" placeholder="" class="form-control @error('family_address') is-invalid @enderror"  value="{{ old('family_address', isset($family->family_address) ? $family->family_address : '') }}">
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
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="no_children">Number of pets <span class="text-danger">*</span></label>
                                            <input type="number" id="no_children" name="number_of_pets" placeholder="" class="form-control" value="{{ old('number_of_pets', isset($family->number_of_pets) ? $family->number_of_pets : 1) }}">
                                            <div class="icon-option" style="display: none;">
                                                <a href="javaScript:;" class="btn btn-info edit-btn"><i class="fa-solid fa-pencil"></i></a>
                                            </div>
                                            @if ($errors->has('number_of_pets'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('number_of_pets') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if(isset($family->type_of_pet) && !empty($family->type_of_pet) && is_array($family->type_of_pet))
                                        @foreach($family->type_of_pet as $key => $value)
                                            @if ($key >= 1)  
                                                @break  
                                            @else
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="type_of_pet">Type of pet <span class="text-danger">*</span></label>
                                                        <select id="age_children" name="type_of_pet[]" class="form-control">
                                                            <option value="dog" {{isset($value) && $value == "dog" ? "selected" : ""}}>Dog</option>
                                                            <option value="cat" {{isset($value) && $value == "cat" ? "selected" : ""}}>Cat</option>
                                                            <option value="hamster and guinea pig" {{isset($value) && $value == "hamster and guinea pig" ? "selected" : ""}}>Hamster &amp; Guinea pig</option>
                                                            <option value="reptile" {{isset($value) && $value == "reptile" ? "selected" : ""}}>Reptile</option>
                                                            <option value="spider" {{isset($value) && $value == "spider" ? "selected" : ""}}>Spider</option>
                                                        </select>
                                                        @if ($errors->has('type_of_pet'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('type_of_pet') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="gender_of_children">How many pets <span class="text-danger">*</span></label>
                                                        <input type="number" id="gender_of_children" name="how_many_pets[]" value="{{ isset($family->how_many_pets[$key]) ? $family->how_many_pets[$key] : null }}" placeholder="" class="form-control">
                                                        @if ($errors->has('how_many_pets'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('how_many_pets') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="age_children">Type of pet <span class="text-danger">*</span></label>
                                                <select id="age_children" name="type_of_pet[]" class="form-control" >
                                                    <option value="dog">Dog</option>
                                                    <option value="cat">Cat</option>
                                                    <option value="hamster and guinea pig">Hamster &amp; Guinea pig</option>
                                                    <option value="reptile">Reptile</option>
                                                    <option value="spider">Spider</option>
                                                </select>
                                                @if ($errors->has('type_of_pet'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('type_of_pet') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="gender_of_children">How many pets<span class="text-danger">*</span></label>
                                                <input type="number" id="gender_of_children" name="how_many_pets[]" value="1" placeholder="" class="form-control">
                                                @if ($errors->has('how_many_pets'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('how_many_pets') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif 
                                </div>
                                <div id="more_childern" class="row p-0">
                                    @if(isset($family->type_of_pet) && !empty($family->type_of_pet) && is_array($family->type_of_pet))
                                        @foreach($family->type_of_pet as $key => $value)
                                            @if ($key >= 1) 
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                     <div class="form-group">
                                                        <label for="type_of_pet">Type of pet <span class="text-danger">*</span></label>
                                                        <select id="age_children" name="type_of_pet[]" class="form-control">
                                                            <option value="dog" {{isset($value) && $value == "dog" ? "selected" : ""}}>Dog</option>
                                                            <option value="cat" {{isset($value) && $value == "cat" ? "selected" : ""}}>Cat</option>
                                                            <option value="hamster and guinea pig" {{isset($value) && $value == "hamster and guinea pig" ? "selected" : ""}}>Hamster &amp; Guinea pig</option>
                                                            <option value="reptile" {{isset($value) && $value == "reptile" ? "selected" : ""}}>Reptile</option>
                                                            <option value="spider" {{isset($value) && $value == "spider" ? "selected" : ""}}>Spider</option>
                                                        </select>
                                                        @if ($errors->has('type_of_pet'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('type_of_pet') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                     <div class="form-group">
                                                        <label for="gender_of_children">How many pets <span class="text-danger">*</span></label>
                                                        <input type="number" id="gender_of_children" name="how_many_pets[]" value="{{ isset($family->how_many_pets[$key]) ? $family->how_many_pets[$key] : null }}" placeholder="" class="form-control">
                                                        @if ($errors->has('how_many_pets'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('how_many_pets') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach     
                                    @endif 
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="pet_medication_or_disabilities">Is your pet on any medication or have any disabilities <span class="text-danger">*</span></label>
                                                <ul class="radio-box-list" >
                                                    <li><input type="radio" name="pet_medication_or_disabilities" value="yes" {{ isset($family->pet_medication_or_disabilities) && $family->pet_medication_or_disabilities == "yes" ? 'checked' : '' }}>&nbsp;Yes</li>
                                                    <li><input type="radio" name="pet_medication_or_disabilities" value="no" {{ isset($family->pet_medication_or_disabilities) && $family->pet_medication_or_disabilities == "no" ? 'checked' : '' }}>&nbsp;No</li>
                                                </ul>
                                            @if ($errors->has('pet_medication_or_disabilities'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('pet_medication_or_disabilities') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="pet_medication_specify">If yes please specify</label>
                                        <textarea id="pet_medication_specify" name="pet_medication_specify" placeholder="" class="form-control" rows="2" >{{ old('pet_medication_specify', isset($family->pet_medication_specify) ? $family->pet_medication_specify : '') }}</textarea>
                                        <p class="text-end fw-light fst-italic small">Maximum 500 Characters</p>
                                        @if ($errors->has('pet_medication_specify'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('pet_medication_specify') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="candidate_duties">What will be the candidate’s duties <span class="text-danger">*</span></label>
                                            <textarea id="candidate_duties" name="candidate_duties" class="form-control" rows="8" >{{ old('candidate_duties', isset($family->candidate_duties) ? $family->candidate_duties : '') }}</textarea>
                                            <p class="text-end fw-light fst-italic small">Maximum 500 Characters</p>
                                            @if ($errors->has('candidate_duties'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('candidate_duties') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">When do you need a petsitter </label>
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
                                                            <th>Morning: 07:00 – 13:00</th>
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
                                                            <th>Afternoon: 13:00 – 17:00</th>
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
                                                            <th>Evening: 17:00 – 21:00</th>
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
                                                            <th>Night: 21:00 – 00:00</th>
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
                                                <p style="font-size: small; font-style: italic;">These hours are intended solely to provide a general indication of availability. Specific hours can be further discussed with the family as needed</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>                     
                            </div>
                            <div class="card-footer">
                                <a href="{{ url('admin/family-petsitting') }}" ><button class="btn btn-default" type="button">Back</button></a>
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
        var file = "{{ isset($family->profile) ? $family->profile : 'front-user.png' }}";
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
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="type_of_pet">Type of pet <span class="text-danger">*</span></label>
                            <select name="type_of_pet[]" class="form-control">
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                                <option value="hamster and guinea pig">Hamster &amp; Guinea pig</option>
                                <option value="reptile">Reptile</option>
                                <option value="spider">Spider</option>
                            </select>
                        </div>
                    </div> 

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="gender_of_children">How many pets <span class="text-danger">*</span></label>
                            <input type="number" id="how_many_pets" name="how_many_pets" value="1" placeholder="" class="form-control" >
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

    /*for debuggging purpose*/
    @if($errors->any())
        var errorMessages = {!! json_encode($errors->toArray()) !!};
        console.log(errorMessages);
    @endif
</script>
@endsection

