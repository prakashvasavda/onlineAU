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
                    <label for="email">Password <span class="text-danger">*</span></label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="" class="form-field @error('password') is-invalid @enderror"  value="" readonly onfocus="this.removeAttribute('readonly');">
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
                    <label for="number_of_pets">Number of pets <span class="text-danger">*</span></label>
                    <input type="number" id="no_children" name="number_of_pets" value="{{ old('number_of_pets', 1) }}" placeholder="" class="form-field @error('number_of_pets') is-invalid @enderror" >
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
                    <label for="type_of_pet">Type of pet <span class="text-danger">*</span></label>
                    <select id="type_of_pet_0" name="type_of_pet[]" class="form-field ">
                        <option value="" >Select</option>
                        <option value="dog" {{ isset(old('type_of_pet')[0]) && old('type_of_pet')[0] == "dog" ? "selected" : " " }}>Dog</option>
                        <option value="cat" {{ isset(old('type_of_pet')[0]) && old('type_of_pet')[0] == "cat" ? "selected" : " " }}>Cat</option>
                        <option value="hamster and guinea pig" {{ isset(old('type_of_pet')[0]) && old('type_of_pet')[0] == "hamster and guinea pig" ? "selected" : " " }}>Hamster &amp; Guinea pig</option>
                        <option value="reptile" {{ isset(old('type_of_pet')[0]) && old('type_of_pet')[0] == "reptile" ? "selected" : " " }}>Reptile</option>
                        <option value="spider" {{ isset(old('type_of_pet')[0]) && old('type_of_pet')[0] == "spider" ? "selected" : " " }}>Spider</option>
                    </select>
                    @error('type_of_pet.0')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="how_many_pets">How many pets <span class="text-danger">*</span></label>
                    <input type="number" id="how_many_pets_0" name="how_many_pets[]" value="{{ old('how_many_pets')[0] ?? 1 }}" placeholder="" class="form-field" >
                    @error('how_many_pets.0')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            {{-- old data --}}
            @if(old('number_of_pets') && old('number_of_pets') > 1)
                @for ($i = 1; $i < old('number_of_pets'); $i++)
                    @if ($i < 5)
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 old-input-pets">
                            <div class="form-input">
                                <label for="type_of_pet">Type of pet <span class="text-danger">*</span></label>
                                <select id={{ "type_of_pet_" . $i }} name="type_of_pet[]" class="form-field ">
                                    <option value="" >Select</option>
                                    <option value="dog" {{ isset(old('type_of_pet')[$i]) && old('type_of_pet')[$i] == "dog" ? "selected" : " " }}>Dog</option>
                                    <option value="cat" {{ isset(old('type_of_pet')[$i]) && old('type_of_pet')[$i] == "cat" ? "selected" : " " }}>Cat</option>
                                    <option value="hamster and guinea pig" {{ isset(old('type_of_pet')[$i]) && old('type_of_pet')[$i] == "hamster and guinea pig" ? "selected" : " " }}>Hamster &amp; Guinea pig</option>
                                    <option value="reptile" {{ isset(old('type_of_pet')[$i]) && old('type_of_pet')[$i] == "reptile" ? "selected" : " " }}>Reptile</option>
                                    <option value="spider" {{ isset(old('type_of_pet')[$i]) && old('type_of_pet')[$i] == "spider" ? "selected" : " " }}>Spider</option>
                                </select>
                                @error('type_of_pet.' . $i)
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 old-input-pets">
                            <div class="form-input">
                                <label for="how_many_pets">How many pets <span class="text-danger">*</span></label>
                                <input type="number" id={{ "how_many_pets_" . $i }} name="how_many_pets[]" value="{{ old('how_many_pets')[$i] ?? 1 }}" placeholder="" class="form-field" >
                                @error('how_many_pets.' . $i)
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                @endfor
            @endif
            {{-- end of old data --}}
            <div id="more_childern" class="row p-0 m-0"></div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="pet_medication_or_disabilities">Is your pet on any medication or have any disabilities <span class="text-danger">*</span></label>
                    <ul class="d-flex flex-wrap" >
                        <li><input type="radio" checked name="pet_medication_or_disabilities" value="yes" {{ old('pet_medication_or_disabilities') == "yes" ? "checked" : '' }} >Yes</li>
                        <li><input type="radio" name="pet_medication_or_disabilities" value="no" {{ old('pet_medication_or_disabilities') == "no" ? "checked" : '' }} >No</li>
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
                <label for="pet_medication_specify">If yes please specify.</label>
                <textarea id="pet_medication_specify" name="pet_medication_specify" placeholder="" class="form-field @error('pet_medication_specify') is-invalid @enderror" rows="5" >{{ old('pet_medication_specify') }}</textarea>
                <p class="text-end fw-light fst-italic small">Maximum 500 Characters</p>
                @if ($errors->has('pet_medication_specify'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('pet_medication_specify') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="candidate_duties">What will be the candidate’s duties. <span class="text-danger">*</span></label>
                <textarea id="candidate_duties" name="candidate_duties" class="form-field" rows="5" >{{ old('candidate_duties') }}</textarea>
                <p class="text-end fw-light fst-italic small">Maximum 500 Characters</p>
                @if ($errors->has('candidate_duties'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('candidate_duties') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="mb-2">
                    <label for="day_hour">Days & times needed <span class="text-danger">*</span></label>
                </div>
                @include('user.calender.add')
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

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-input">
                    <div class="form-input d-flex flex-wrap mb-2">
                        <input type="checkbox" name="terms_and_conditions" {{ old('terms_and_conditions') ? "checked" : " " }} id="terms_and_conditions" autocomplete="off">
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
        var number_of_pets = $("#no_children").val();

        /* add custom validation */
        if(number_of_pets > 5){
            !$('#no-pets-error-msg').length ? $("#no_children").after(`<span id="no-pets-error-msg" class="text-danger"><strong>The number of pets field must be less than or equal to 5.</strong></span>`) : "";
            return false;
        }

        $('.old-input-pets').length && $(".old-input-pets").remove();
        $('#no-pets-error-msg').length && $("#no-pets-error-msg").remove();

        $("#more_childern").html('');
        if(number_of_pets > 1) {
            for (var i = number_of_pets - 1; i >= 1; i--) {
                $("#more_childern")
                .append(`
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-3">
                        <div class="form-input">
                            <label for="type_of_pet">Type of pet <span class="text-danger">*</span></label>
                            <select name="type_of_pet[]" class="form-field" >
                                <option value="" >Select</option>
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
                            <input type="number" name="how_many_pets[]" value="1" placeholder="" class="form-field" >
                        </div>
                    </div>
                `);
            }
        }
    });
});
</script>
@endsection
