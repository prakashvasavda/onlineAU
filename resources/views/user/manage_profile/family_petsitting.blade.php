@extends('layouts.main')
@section('content')
<div class="single-form-section">
    <div class="container">
        <div class="title-main">
            <h2>Welcome to Online Au-Pairs</h2>
            <h3>{{ isset($menu) ? ucfirst($menu) : '' }}</h3>
        </div>
        @include('flash.front-message')

      <form class="row" name="frm" action="{{ url('family-petsitting', ['id' => $family->id]) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label>Profile Photo </label>
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
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" placeholder="" class="form-field @error('name') is-invalid @enderror"  value="{{ old('name', isset($family->name) ? $family->name : '') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-input">
                    <div class="form-input">
                       <label for="surname"> Surname <span class="text-danger">*</span></label>
                        <input type="text" id="surname" name="surname" placeholder="" class="form-field"  value="{{ old('surname', isset($family->surname) ? $family->surname : '') }}">
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
                        <input type="email" id="email" name="email" value="{{ old('email', isset($family->email) ? $family->email : '') }}" placeholder="" class="form-field @error('email') is-invalid @enderror" autocomplete="off">
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
                    <label for="email">Password <span class="text-danger">*</span></label>
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
                        <li><input type="radio" checked name="type_of_id_number" value="south_african" {{ old('type_of_id_number', isset($family->type_of_id_number) ? $family->type_of_id_number : '') === "south_african" ? "checked" : '' }} >South African ID</li>
                        <li><input type="radio" name="type_of_id_number" value="other" {{ old('type_of_id_number', isset($family->type_of_id_number) ? $family->type_of_id_number : '') === "other" ? "checked" : '' }} >Foreign ID</li>
                    </ul>
                    @if ($errors->has('type_of_id_number'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('type_of_id_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="id_number">ID number <span class="text-danger">*</span></label>
                <input type="text" id="id_number" name="id_number" value="{{ old('id_number', isset($family->id_number) ? $family->id_number : '') }}" placeholder="" class="form-field">
                @if ($errors->has('id_number'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('id_number') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="cell_number">Cell Number <span class="text-danger">*</span></label>
                <input type="number" id="cell_number" name="cell_number" value="{{ old('cell_number', isset($family->cell_number) ? $family->cell_number : '') }}" placeholder="" class="form-field">
                @if ($errors->has('cell_number'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('cell_number') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="address">Your Address <span class="text-danger">*</span></label>
                    <input type="text" id="address" name="family_address" placeholder="" class="form-field address-input @error('family_address') is-invalid @enderror"  value="{{ old('family_address', isset($family->family_address) ? $family->family_address : '') }}">
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
                    <label for="no_children">Number of pets <span class="text-danger">*</span></label>
                    <input type="number" id="no_children" name="number_of_pets" placeholder="" class="form-field" value="{{ old('number_of_pets', isset($family->number_of_pets) ? $family->number_of_pets : 1) }}">
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
                            <div class="form-input">
                                <label for="type_of_pet">Type of pet <span class="text-danger">*</span></label>
                                <select id="age_children" name="type_of_pet[]" class="form-field">
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
                            <div class="form-input">
                                <label for="gender_of_children">How many pets <span class="text-danger">*</span></label>
                                <input type="number" id="gender_of_children" name="how_many_pets[]" value="{{ isset($family->how_many_pets[$key]) ? $family->how_many_pets[$key] : null }}" placeholder="" class="form-field">
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
                    <div class="form-input">
                        <label for="age_children">Type of pet <span class="text-danger">*</span></label>
                        <select id="age_children" name="type_of_pet[]" class="form-field" >
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
                    <div class="form-input">
                        <label for="gender_of_children">How many pets <span class="text-danger">*</span></label>
                        <input type="number" id="gender_of_children" name="how_many_pets[]" value="1" placeholder="" class="form-field">
                        @if ($errors->has('how_many_pets'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('how_many_pets') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            @endif 


            <div id="more_childern" class="row p-0 m-0">
                @if(isset($family->type_of_pet) && !empty($family->type_of_pet) && is_array($family->type_of_pet))
                    @foreach($family->type_of_pet as $key => $value)
                        @if ($key >= 1) 
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                                 <div class="form-input">
                                    <label for="type_of_pet">Type of pet <span class="text-danger">*</span></label>
                                    <select id="age_children" name="type_of_pet[]" class="form-field">
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

                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                                 <div class="form-input">
                                    <label for="gender_of_children">How many pets <span class="text-danger">*</span></label>
                                    <input type="number" id="gender_of_children" name="how_many_pets[]" value="{{ isset($family->how_many_pets[$key]) ? $family->how_many_pets[$key] : null }}" placeholder="" class="form-field">
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
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="pet_medication_or_disabilities">Is your pet on any medication or have any disabilities <span class="text-danger">*</span></label>
                        <ul class="radio-box-list">
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
                <div class="form-input">
                    <label for="start_date">Start date <span class="text-danger">*</span></label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date', isset($family->start_date) ? $family->start_date : '') }}" class="form-field">
                    @if ($errors->has('start_date'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="pet_medication_specify">If yes please specify.</label>
                <textarea id="pet_medication_specify" class="form-field" name="pet_medication_specify" placeholder="" rows="2" >{{ old('pet_medication_specify', isset($family->pet_medication_specify) ? $family->pet_medication_specify : '') }}</textarea>
                <p class="text-end fw-light fst-italic small">Minimum 200 Characters</p>
                @if ($errors->has('pet_medication_specify'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('pet_medication_specify') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="candidate_duties">What will be the candidate’s duties. <span class="text-danger">*</span></label>
                <textarea id="candidate_duties" name="candidate_duties" class="form-field" rows="5" >{{ old('candidate_duties', isset($family->candidate_duties) ? $family->candidate_duties : '') }}</textarea>
                <p class="text-end fw-light fst-italic small">Minimum 200 Characters</p>
                @if ($errors->has('candidate_duties'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('candidate_duties') }}</strong>
                    </span>
                @endif
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
                                    <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][0] ?? null }}" placeholder="Add Time"></td>
                                    <td>to</td>
                                    <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][0] ?? null }}" placeholder="Add Time"></td>
                                    <td onclick="addCalendarRow('{{ $day }}')">
                                        <a href="javaScript:;" class="btn add-btn icon">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>
                                    </td>
                                </tr>

                                @if(isset($calendars[$day]) && !empty($calendars[$day]) && is_array($calendars[$day]))
                                    @foreach($calendars[$day]['start_time'] as $key => $value)
                                        @if(isset($key) && $key >= 1 && isset($calendars[$day]['start_time'][$key]) || isset($calendars[$day]['end_time'][$key]))
                                            <tr id="{{ $day }}-row">
                                                <td><input type="checkbox"></td>
                                                <td>{{ ucfirst($day) }}</td>
                                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][$key] ?? null }}" placeholder="Add Time"></td>
                                                <td>to</td>
                                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][$key] ?? null }}" placeholder="Add Time"></td>
                                                <td onclick="removeCalendarRow(event)">
                                                    <a href="javaScript:;" class="btn add-btn icon">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                
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

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="duration_needed">Duration needed <span class="text-danger">*</span></label>
                    <input type="text" id="duration_needed" name="duration_needed" value="{{ old('duration_needed', isset($family->duration_needed) ? $family->duration_needed : '') }}" class="form-field">
                    @if ($errors->has('duration_needed'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('duration_needed') }}</strong>
                        </span>
                    @endif
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
                //$("#more_childern").append('<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="form-input"><label for="age_children">Age of children</label><select name="age[]" class="form-field" ><option value="" disabled="disabled" selected>Select Age</option><option value="baby">Baby</option><option value="gradeschooler">Gradeschooler</option><option value="toddler">Toddler</option><option value="teenager">Teenager</option><option value="preschooler">Preschooler</option></select></div></div>');
                $("#more_childern")
                .append(`
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                        <div class="form-input">
                            <label for="type_of_pet">Type of pet <span class="text-danger">*</span></label>
                            <select name="type_of_pet[]" class="form-field">
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                                <option value="hamster and guinea pig">Hamster &amp; Guinea pig</option>
                                <option value="reptile">Reptile</option>
                                <option value="spider">Spider</option>
                            </select>
                        </div>
                    </div> 

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                        <div class="form-input">
                            <label for="gender_of_children">How many pets <span class="text-danger">*</span></label>
                            <input type="number" id="how_many_pets" name="how_many_pets" value="1" placeholder="" class="form-field" >
                        </div>
                    </div>
                `);
            }
        }
    });

    $(window).on("load", function () {
        var file = "{{ isset($family->profile) ? $family->profile : 'front-user.png' }}";
        if(file !== null){
            $('.js--image-preview').addClass('js--no-default');
            $('.js--image-preview').html('<img src="{{ asset('uploads/profile/') }}/' + file + '" alt="">');
        }
    });
});
</script>
@endsection
