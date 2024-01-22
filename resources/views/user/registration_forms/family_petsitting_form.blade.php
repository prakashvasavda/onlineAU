@extends('layouts.main')
@section('content')
<div class="single-form-section">
    <div class="container">
        <div class="title-main">
            <h2>Welcome to Online Au-Pairs</h2>
            <h3>sign up</h3>
        </div>
        @include('flash.front-message')

        <form class="row" name="frm" action="{{ route('store-family-petsitting') }}" enctype="multipart/form-data" method="post">
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
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
                    <label for="address">Your Address <span class="text-danger">*</span></label>
                    <input type="text" id="address-input" name="family_address" placeholder="" class="form-field @error('family_address') is-invalid @enderror address-input"  value="{{ old('family_address') }}">
                    <div class="icon-option" style="display: none;">
                        <a href="javaScript:;" class="btn btn-info edit-btn"><i class="fa-solid fa-pencil"></i></a>
                    </div>
                    @if ($errors->has('family_address'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('family_address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="number_of_pets">Number of pets</label>
                    <input type="number" id="no_children" name="number_of_pets" value="1" placeholder="" class="form-field @error('number_of_pets') is-invalid @enderror" >
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
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="type_of_pet">Type of pet</label>
                    <select id="type_of_pet" name="type_of_pet[]" class="form-field ">
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                        <option value="hamster and guinea pig">Hamster &amp; Guinea pig</option>
                        <option value="reptile">Reptile</option>
                        <option value="spider">Spider</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="gender_of_children">How many pets </label>
                    <input type="number" id="gender_of_children" name="how_many_pets[]" value="1" placeholder="" class="form-field" >
                    @if ($errors->has('how_many_pets'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('how_many_pets') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div id="more_childern" class="row p-0 m-0"></div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="pet_medication_or_disabilities">Is your pet on any medication or have any disabilities </label>
                    <ul class="d-flex flex-wrap" >
                        <li><input type="radio" name="pet_medication_or_disabilities" value="yes" {{ old('pet_medication_or_disabilities') === "yes" ? "checked" : '' }} >Yes</li>
                        <li><input type="radio"checked name="pet_medication_or_disabilities" value="no" {{ old('pet_medication_or_disabilities') === "no" ? "checked" : '' }} >No</li>
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
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" class="form-field">
                    @if ($errors->has('start_date'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="pet_medication_or_disabilities_specification">If yes please specify.</label>
                <textarea id="pet_medication_or_disabilities_specification" name="pet_medication_or_disabilities_specification" placeholder="" class="form-field @error('pet_medication_or_disabilities_specification') is-invalid @enderror" rows="5" >{{ old('family_description') }}</textarea>
                <p class="text-end fw-light fst-italic small">Minimum 200 Characters</p>
                @if ($errors->has('pet_medication_or_disabilities_specification'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('pet_medication_or_disabilities_specification') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="candidate_duties">What will be the candidate’s duties. <span class="text-danger">*</span></label>
                <textarea id="candidate_duties" name="candidate_duties" class="form-field" rows="5" >{{ old('candidate_duties') }}</textarea>
                <p class="text-end fw-light fst-italic small">Minimum 200 Characters</p>
                @if ($errors->has('candidate_duties'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('candidate_duties') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="">When do you need a petisitter </label>
                    <div class="shift-table">
                        <div class="table-arrows">
                            <a href="javaScript:;" id="left-button"><i class="fa-solid fa-chevron-left"></i></a>
                            <a href="javaScript:;" id="right-button"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
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
                                        <th>Afternoon: 13:00 – 17:00</th>
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
                                        <th>Evening: 17:00 – 21:00</th>
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
                                        <th>Night: 21:00 – 00:00</th>
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
                            <p style="font-size: small; font-style: italic;">These hours are intended solely to provide a general indication of availability. Specific hours can be further discussed with the family as needed</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="duration_needed">Duration needed <span class="text-danger">*</span></label>
                    <input type="text" id="duration_needed" name="duration_needed" value="{{ old('duration_needed') }}" class="form-field">
                    @if ($errors->has('duration_needed'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('duration_needed') }}</strong>
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
        var number_of_pets = $("#no_children").val();
        $("#more_childern").html('');
        if(number_of_pets > 1) {
            for (var i = number_of_pets - 1; i >= 1; i--) {
                $("#more_childern")
                .append(`
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="type_of_pet">Type of pet</label>
                            <select name="type_of_pet[]" class="form-field" >
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                                <option value="hamster and guinea pig">Hamster &amp; Guinea pig</option>
                                <option value="reptile">Reptile</option>
                                <option value="spider">Spider</option>
                            </select>
                        </div>
                    </div> 

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="gender_of_children">How many pets</label>
                            <input type="number" id="gender_of_children" name="how_many_pets[]" value="1" placeholder="" class="form-field" >
                        </div>
                    </div>
                `);
            }
        }
    });
});
</script>
@endsection
