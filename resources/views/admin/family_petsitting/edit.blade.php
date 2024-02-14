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
                                                            <td><input type="time" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][0] ?? null }}"></td>
                                                            <td>to</td>
                                                            <td><input type="time" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][0] ?? null }}"></td>
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
                                                                        <td><input type="time" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][$key] }}"></td>
                                                                        <td>to</td>
                                                                        <td><input type="time" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][$key] }}"></td>
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
                                                                        <td><input type="time" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][$key] }}"></td>
                                                                        <td>to</td>
                                                                        <td><input type="time" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][$key] }}"></td>
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

