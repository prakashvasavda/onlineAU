@extends('layouts.register')

@section('content')
<div class="container">
    <div class="title-main">
        <h2>Welcome to Online Au-Pairs</h2>
        <h3>sign up</h3>
    </div>
    @include('flash.flash-message')
    <form method="POST" class="row" action="{{ route('store_candidate') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ Route::current()->parameter('service') }}" name="role">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="name">Full Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" placeholder="" class="form-field @error('name') is-invalid @enderror" value="{{ old('name') }}" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="age">Age <span class="text-danger">*</span></label>
                <input type="number" id="age" name="age" placeholder="" class="form-field @error('age') is-invalid @enderror"  value="{{ old('age') }}">
                @error('age')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="profile">Profile Picture</label>
                <input type="file" id="profile" name="profile" placeholder="" class="form-field" >
                @error('profile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="id_number">ID Number <span class="text-danger">*</span></label>
                <input type="number" id="id_number" name="id_number" placeholder="" class="form-field @error('id_number') is-invalid @enderror"  value="{{ old('id_number') }}">
                @error('id_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="contact_number">Contact Number</label>
                <input type="number" id="contact_number" name="contact_number" placeholder="" class="form-field @error('contact_number') is-invalid @enderror"  value="{{ old('contact_number') }}">
                @error('contact_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="email">Email Address <span class="text-danger">*</span></label>
                <input type="mail" id="email" name="email" placeholder="" class="form-field @error('email') is-invalid @enderror"  value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="situated">Situated</label>
                <input type="text" id="situated" name="situated" placeholder="" class="form-field @error('situated') is-invalid @enderror"  value="{{ old('situated') }}">
                @error('situated')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="area">Area Pin <span class="text-danger">*</span></label>
                <input type="number" id="area" name="area" placeholder="" class="form-field @error('area') is-invalid @enderror"  value="{{ old('area') }}">
               {{--  <select class="js-example-basic-single" name="state">
                    <option value="AL">Alabama</option>
                    <option value="WY">Wyoming</option>
                </select> --}}
                @error('area')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="gender">Gender</label>
                <ul class="radio-box-list d-flex flex-wrap">
                    <li class="radio-box-item"><input type="radio" name="gender" value="male"><label>Male</label></li>
                    <li class="radio-box-item"><input type="radio" name="gender" value="female"><label>Female</label></li>
                    <li class="radio-box-item"><input type="radio" name="gender" value="other"><label>Other</label></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="ethnicity">Ethnicity</label>
                <input type="text" id="ethnicity" name="ethnicity" placeholder="" class="form-field">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="religion">Religion</label>
                <select id="religion" name="religion" class="form-field">
                    <option value="" selected="selected" disabled="disabled">Select one</option>
                    <option value="African Traditional &amp; Diasporic">African Traditional &amp; Diasporic</option>
                    <option value="Agnostic">Agnostic</option>
                    <option value="Atheist">Atheist</option>
                    <option value="Baha'i">Baha'i</option>
                    <option value="Buddhism">Buddhism</option>
                    <option value="Cao Dai">Cao Dai</option>
                    <option value="Chinese traditional religion">Chinese traditional religion</option>
                    <option value="Christianity">Christianity</option>
                    <option value="Hinduism">Hinduism</option>
                    <option value="Islam">Islam</option>
                    <option value="Jainism">Jainism</option>
                    <option value="Juche">Juche</option>
                    <option value="Judaism">Judaism</option>
                    <option value="Neo-Paganism">Neo-Paganism</option>
                    <option value="Nonreligious">Nonreligious</option>
                    <option value="Rastafarianism">Rastafarianism</option>
                    <option value="Secular">Secular</option>
                    <option value="Shinto">Shinto</option>
                    <option value="Sikhism">Sikhism</option>
                    <option value="Spiritism">Spiritism</option>
                    <option value="Tenrikyo">Tenrikyo</option>
                    <option value="Unitarian-Universalism">Unitarian-Universalism</option>
                    <option value="Zoroastrianism">Zoroastrianism</option>
                    <option value="primal-indigenous">primal-indigenous</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="home_language">Home Language</label>
                <select id="home_language" name="home_language" class="form-field">
                    <option value="" selected="selected" disabled="disabled">Select one</option>
                    <option value="English">English</option>
                    <option value="Afrikaans">Afrikaans</option>
                    <option value="Zulu (isiZulu)">Zulu (isiZulu)</option>
                    <option value="Xhosa (isiXhosa)">Xhosa (isiXhosa)</option>
                    <option value="Northern Sotho (Sesotho sa Leboa)">Northern Sotho (Sesotho sa Leboa)</option>
                    <option value="Sotho (Sesotho)">Sotho (Sesotho)</option>
                    <option value="Swazi (siSwati)">Swazi (siSwati)</option>
                    <option value="Tsonga (Xitsonga)">Tsonga (Xitsonga)</option>
                    <option value="Tswana (Setswana)">Tswana (Setswana)</option>
                    <option value="Venda (Tshivenda)">Venda (Tshivenda)</option>
                    <option value="Southern Ndebele (isiNdebele)">Southern Ndebele (isiNdebele)</option>
                    <option value="Spanish">Spanish</option>
                    <option value="French">French</option>
                    <option value="Hindi">Hindi</option>
                    <option value="Arabic">Arabic</option>
                    <option value="Bengali">Bengali</option>
                    <option value="Portuguese">Portuguese</option>
                    <option value="Russian">Russian</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Punjabi">Punjabi</option>
                    <option value="German">German</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="additional_language">Additional Language</label>
                <select id="additional_language" name="additional_language" multiple class="form-field">
                    <option value="" disabled="disabled">Select</option>
                    <option value="English">English</option>
                    <option value="Afrikaans">Afrikaans</option>
                    <option value="Zulu (isiZulu)">Zulu (isiZulu)</option>
                    <option value="Xhosa (isiXhosa)">Xhosa (isiXhosa)</option>
                    <option value="Northern Sotho (Sesotho sa Leboa)">Northern Sotho (Sesotho sa Leboa)</option>
                    <option value="Sotho (Sesotho)">Sotho (Sesotho)</option>
                    <option value="Swazi (siSwati)">Swazi (siSwati)</option>
                    <option value="Tsonga (Xitsonga)">Tsonga (Xitsonga)</option>
                    <option value="Tswana (Setswana)">Tswana (Setswana)</option>
                    <option value="Venda (Tshivenda)">Venda (Tshivenda)</option>
                    <option value="Southern Ndebele (isiNdebele)">Southern Ndebele (isiNdebele)</option>
                    <option value="Spanish">Spanish</option>
                    <option value="French">French</option>
                    <option value="Hindi">Hindi</option>
                    <option value="Arabic">Arabic</option>
                    <option value="Bengali">Bengali</option>
                    <option value="Portuguese">Portuguese</option>
                    <option value="Russian">Russian</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Punjabi">Punjabi</option>
                    <option value="German">German</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="disabilities">Disabilities</label>
                <input type="text" id="disabilities" name="disabilities" placeholder="" class="form-field">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="marital_status">Marital Status</label>
                <ul class="radio-box-list d-flex flex-wrap">
                    <li class="radio-box-item"><input type="radio" name="marital_status" value="Married"><label>Married</label></li>
                    <li class="radio-box-item"><input type="radio" name="marital_status" value="Single"><label>Single</label></li>
                    <li class="radio-box-item"><input type="radio" name="marital_status" value="In a Relationship"><label>In a Relationship</label></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="dependants">Do you have any dependants</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="dependants" value="Yes">Yes</li>
                    <li><input type="radio" name="dependants" value="No">No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="chronical_medication">Are you on any chronical medication</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="chronical_medication" value="Yes">Yes</li>
                    <li><input type="radio" name="chronical_medication" value="No">No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="drivers_license">Do you have your drivers license</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="drivers_license" value="Yes">Yes</li>
                    <li><input type="radio" name="drivers_license" value="No">No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="vehicle">Do you have your own vehicle</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="vehicle" value="Yes">Yes</li>
                    <li><input type="radio" name="vehicle" value="No">No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="car_accident">Have you ever been in a car accident</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="car_accident" value="Yes">Yes</li>
                    <li><input type="radio" name="car_accident" value="No">No</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="childcare_experience">How many years of childcare experience do you have</label>
                <select id="childcare_experience" name="childcare_experience" class="form-field">
                    <option value="" selected="selected" disabled="disabled">Select</option>
                    <option value="6 Months">6 Months</option>
                    <option value="1 years">1 years</option>
                    <option value="1.5 years">1.5 years</option>
                    <option value="2 years">2 years</option>
                    <option value="2.5 years">2.5 years</option>
                    <option value="3 years">3 years</option>
                    <option value="3.5 years">3.5 years</option>
                    <option value="4 years">4 years</option>
                    <option value="4.5 years">4.5 years</option>
                    <option value="5 years">5 years</option>
                    <option value="5+ years">5+ years</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="experience_special_needs">Do you have experience with special needs</label>
                <ul class="d-flex flex-wrap">
                    <li><input type="radio" name="experience_special_needs" value="Yes">Yes</li>
                    <li><input type="radio" name="experience_special_needs" value="No">No</li>
                </ul>
            </div>
        </div>
        <div class="col-12">
            <div class="form-inputs" id="dynamic_field">
                <label class="mb-2 fst-italic">List your previous childcare work experience with contactable references.</label>
                <div class="icon-option all-in-one">
                    <a href="javaScript:;" class="btn btn-primary add-btn" id="add"><i class="fa-solid fa-plus"></i></a>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="daterange">Date range</label>
                            <input type="text" id="daterange" name="daterange[]" value="10/01/2023 - 12/15/2023" class="form-field" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="heading">Heading</label>
                            <input type="text" id="heading" name="heading[]" class="form-field" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description[]" class="form-field" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="reference">Reference Name</label>
                            <input type="text" id="reference" name="reference[]" class="form-field" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-input">
                            <label for="tel_number">Tel Number</label>
                            <input type="text" id="tel_number" name="tel_number[]" class="form-field" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="salary_expectation">What is your salary expectation/hourly rate</label>
                <input type="number" id="salary_expectation" name="salary_expectation" placeholder="" class="form-field @error('salary_expectation') is-invalid @enderror"  value="{{ old('salary_expectation') }}">
                @error('salary_expectation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="day_hour">What are your available days and hours <span class="text-danger">*</span></label>
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
                                <th>Morning</th>
                                <td>
                                    <label><input type="checkbox" name="morning[]" value="mo_morning" id="" class="@error('morning') is-invalid @enderror"></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="morning[]" value="tu_morning" id="" class="@error('morning') is-invalid @enderror"></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="morning[]" value="we_morning" id="" class="@error('morning') is-invalid @enderror"></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="morning[]" value="th_morning" id="" class="@error('morning') is-invalid @enderror"></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="morning[]" value="fr_morning" id="" class="@error('morning') is-invalid @enderror"></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="morning[]" value="sa_morning" id="" class="@error('morning') is-invalid @enderror"></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="morning[]" value="su_morning" id="" class="@error('morning') is-invalid @enderror"></label>
                                </td>
                            </tr>
                            <tr>
                                <th>Afternoon</th>
                                <td>
                                    <label><input type="checkbox" name="afternoon[]" value="mo_afternoon" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="afternoon[]" value="tu_afternoon" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="afternoon[]" value="we_afternoon" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="afternoon[]" value="th_afternoon" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="afternoon[]" value="fr_afternoon" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="afternoon[]" value="sa_afternoon" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="afternoon[]" value="su_afternoon" id=""></label>
                                </td>
                            </tr>
                            <tr>
                                <th>Evening</th>
                                <td>
                                    <label><input type="checkbox" name="evening[]" value="mo_evening" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="evening[]" value="tu_evening" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="evening[]" value="we_evening" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="evening[]" value="th_evening" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="evening[]" value="fr_evening" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="evening[]" value="sa_evening" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="evening[]" value="su_evening" id=""></label>
                                </td>
                            </tr>
                            <tr>
                                <th>Night</th>
                                <td>
                                    <label><input type="checkbox" name="night[]" value="mo_night" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="night[]" value="tu_night" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="night[]" value="we_night" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="night[]" value="th_night" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="night[]" value="fr_night" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="night[]" value="sa_night" id=""></label>
                                </td>
                                <td>
                                    <label><input type="checkbox" name="night[]" value="su_night" id=""></label>
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

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-input">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input type="password" id="password" name="password" placeholder="" class="form-field @error('password') is-invalid @enderror" >
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-input-btn text-center">
                <input type="submit" class="btn btn-primary round" value="signup">
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script type="text/javascript">
    // $(document).ready(function(){
    //     $('.js-example-basic-single').select2({width: '100%'});      
    // });
</script>
@endsection
