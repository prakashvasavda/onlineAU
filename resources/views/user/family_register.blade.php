@extends('layouts.main')

@section('content')



<div class="single-form-section">
    <div class="container">
        <div class="title-main">
            <h2>Welcome to Online Au-Pairs</h2>
            <h3>sign up</h3>
        </div>
        @include('flash.front-message')
        <form class="row" name="frm" action="{{ route('store_family') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label>Profile Photo</label>
                    <div class="box">
                        <div class="js--image-preview"></div>
                        <div class="upload-options">
                            <label><input type="file" id="profile" name="profile" class="image-upload" accept="image/*" required></label>
                            @error('profile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input mb-3">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="" class="form-field @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-input mb-3">
                    <div class="form-input">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="" class="form-field @error('email') is-invalid @enderror" required value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-input">
                    <label for="email">Password</label>
                    <input type="password" id="password" name="password" placeholder="" class="form-field @error('password') is-invalid @enderror" required value="">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="address">Your Address</label>
                    <input type="text" id="address" name="family_address" placeholder="" class="form-field @error('family_address') is-invalid @enderror" required value="{{ old('family_address') }}">
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
                    <label for="city">City</label>
                    <input type="text" id="city" name="family_city" placeholder="" class="form-field @error('family_city') is-invalid @enderror" required value="{{ old('family_city') }}">
                    <div class="icon-option" style="display: none;">
                        <a href="javaScript:;" class="btn btn-info edit-btn"><i class="fa-solid fa-pencil"></i></a>
                    </div>
                    @error('family_city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="language">Add Language</label>
                    <select id="language" name="home_language" multiple class="form-field @error('home_language') is-invalid @enderror" required>
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
                    @error('home_language')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="no_children">Number of children</label>
                    <input type="number" id="no_children" name="no_children" placeholder="" class="form-field @error('no_children') is-invalid @enderror" required>
                    <div class="icon-option" style="display: none;">
                        <a href="javaScript:;" class="btn btn-info edit-btn"><i class="fa-solid fa-pencil"></i></a>
                    </div>
                    @error('no_children')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="age_children">Age of children</label>
                    <select id="age_children" name="age[]" class="form-field @error('age') is-invalid @enderror" required>
                        <option selected="selected" value="Baby">Baby</option>
                        <option value="Gradeschooler">Gradeschooler</option>
                        <option value="Toddler">Toddler</option>
                        <option value="Teenager">Teenager</option>
                        <option value="Preschooler">Preschooler</option>
                    </select>
                    @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div id="more_childern"></div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="describe_kids">Describe your kids in 3 words</label>
                    <select id="describe_kids" name="describe_kids" multiple class="form-field @error('describe_kids') is-invalid @enderror" required>
                        <option value="" disabled="disabled">Select</option>
                        <option value="Energetic">Energetic</option>
                        <option value="Curious">Curious</option>
                        <option value="Sporty">Sporty</option>
                        <option value="Creative">Creative</option>
                        <option value="Friendly">Friendly</option>
                        <option value="Talkative">Talkative</option>
                        <option value="Calm">Calm</option>
                        <option value="Playful">Playful</option>
                        <option value="Funny">Funny</option>
                        <option value="Intelligent">Intelligent</option>
                        <option value="Affectionate">Affectionate</option>
                        <option value="Independent">Independent</option>
                    </select>
                    @error('describe_kids')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_types_babysitter">Type of babysitter needed<span class="ms-2" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="primary-tooltip" data-bs-title="To save money, you can also choose to occasionally look after each other's children. We call this parents-help-parents."><i class="fa-solid fa-circle-question"></i></span></label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="family_types_babysitter" checked value="Babysitter"><label>Babysitter</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_types_babysitter" value="Nanny"><label>Nanny</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_types_babysitter" value="Other parent (parents-help-parents)"><label>Other parent (parents-help-parents)</label></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_location">Preferred babysitting location</label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="family_location" checked value="At our home"><label>At our home</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_location" value="At the babysitter's"><label>At the babysitter's</label></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_babysitter_comfortable">We need a babysitter comfortable with</label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" name="family_babysitter_comfortable" checked value="Pets"><label>Pets</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_babysitter_comfortable" value="Cooking"><label>Cooking</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_babysitter_comfortable" value="Chores"><label>Chores</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_babysitter_comfortable" value="Homework assistance"><label>Homework assistance</label></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input">
                    <label for="family_profile_see">Who can see your profile?</label>
                    <ul class="radio-box-list">
                        <li class="radio-box-item"><input type="radio" checked name="family_profile_see" value="everyone" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="primary-tooltip" data-bs-title="Babysits users, public search engines, and job boards can iew your profile."><label>Everyone</label></li>
                        <li class="radio-box-item"><input type="radio" name="family_profile_see" value="Only Babysits users" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="primary-tooltip" data-bs-title="Only babysits users can view your profile. this may reduce the responses you get."><label>Only Babysits users</label></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-input mb-3">
                    <label for="family_notifications">Do you want to get notifications from new babysitters in your area?</label>
                    <ul class="d-flex flex-wrap">
                        <li><input type="radio" checked name="family_notifications" value="Yes">Yes</li>
                        <li><input type="radio" name="family_notifications" value="No">No</li>
                    </ul>
                </div>
                <div class="form-input">
                    <label for="">What hourly rate are you willing to pay?</label>
                    <div class="input-group mb-1">
                      <span class="input-group-text">$</span>
                      <input type="text" name="salary_expectation" id="salary_expectation" class="form-field" placeholder="">
                      <span class="input-group-text">hr</span>
                    </div>
                    @error('salary_expectation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p class="fw-light small">Average rate that other families offer: US$16,34<br>For your safety and protection, only pay through Babysits.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="family_description">Tell a little about your family, so babysitters can get to know you.</label>
                <textarea id="family_description" name="family_description" placeholder="" class="form-field @error('family_description') is-invalid @enderror" rows="5" required>{{ old('family_description') }}</textarea>
                <p class="text-end fw-light fst-italic small">Minimum 200 Characters</p>
                @error('family_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12">
                <div class="form-input">
                    <label for="">When do you need a babysitter?</label>
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
                                        <label><input type="checkbox" name="morning[]" value="mo_morning" id=""></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="tu_morning" id=""></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="we_morning" id=""></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="th_morning" id=""></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="fr_morning" id=""></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="sa_morning" id=""></label>
                                    </td>
                                    <td>
                                        <label><input type="checkbox" name="morning[]" value="su_morning" id=""></label>
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
                </div>
            </div>
            <div class="col-12">
                <div class="form-input switch-input">
                    <input type="checkbox" name="family_special_need_option" id="special-needs" class="switch">
                    <label for="special-needs">We are looking for someone who has experience with children with special needs</label>
                    <p>For example with children with behavioral problems, an intellectual disability or a chronic illness. <a href="javaScript:;">Learn more</a></p>
                    <div id="special-needs-section" class="special-needs-types w-100 mt-3" hidden>
                        <label class="mb-3">Specific experience:</label>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-disorder-btn" autocomplete="off" value="anxiety_disorder">
                            <label class="form-check-label" for="special-needs-disorder-btn">Anxiety disorder</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-adhd-btn" autocomplete="off" value="adhd">
                            <label class="form-check-label" for="special-needs-adhd-btn">Attention Deficit Hyperactivity Disorder (ADHD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-autism-btn" autocomplete="off" value="autism">
                            <label class="form-check-label" for="special-needs-autism-btn">Autism Spectrum Disorder (ASD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-asthma-btn" autocomplete="off" value="asthma">
                            <label class="form-check-label" for="special-needs-asthma-btn">Asthma</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-odd-cd-btn" autocomplete="off" value="odd_cd">
                            <label class="form-check-label" for="special-needs-odd-cd-btn">Oppositional Defiant Disorder and Conduct Disorders (ODD/CD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-hard-hearing-btn" autocomplete="off" value="deaf_and_hard_hearing">
                            <label class="form-check-label" for="special-needs-hard-hearing-btn">Deaf and hard of hearing</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-dev-delay-btn" autocomplete="off" value="global_development_delay">
                            <label class="form-check-label" for="special-needs-dev-delay-btn">Global development delay</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-diabetes-btn" autocomplete="off" value="diabetes">
                            <label class="form-check-label" for="special-needs-diabetes-btn">Diabetes</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-lang-dis-btn" autocomplete="off" value="language_disorder">
                            <label class="form-check-label" for="special-needs-lang-dis-btn">Language disorder</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-epilepsy-btn" autocomplete="off" value="epilepsy">
                            <label class="form-check-label" for="special-needs-epilepsy-btn">Epilepsy</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-allergies-btn" autocomplete="off" value="food_allergies">
                            <label class="form-check-label" for="special-needs-allergies-btn">Food allergies</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-hemophilia-btn" autocomplete="off" value="hemophilia">
                            <label class="form-check-label" for="special-needs-hemophilia-btn">Hemophilia</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-compulsive-btn" autocomplete="off" value="obsessive_compulsive_disorder">
                            <label class="form-check-label" for="special-needs-compulsive-btn">Obsessive compulsive disorder (OCD)</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-limited-btn" autocomplete="off" value="physically_limited">
                            <label class="form-check-label" for="special-needs-limited-btn">Physically limited</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-sleep-dis-btn" autocomplete="off" value="sleep_disorder">
                            <label class="form-check-label" for="special-needs-sleep-dis-btn">Sleep disorder</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-tics-btn" autocomplete="off" value="tics">
                            <label class="form-check-label" for="special-needs-tics-btn">Tics</label>
                        </div>
                        <div class="form-input d-flex flex-wrap mb-2">
                            <input type="checkbox" name="family_special_need_value[]" id="special-needs-visual-btn" autocomplete="off" value="visual_impairment">
                            <label class="form-check-label" for="special-needs-visual-btn">Visual impairment</label>
                        </div>
                    </div>
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
@section('js')
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
                $("#more_childern").append('<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="form-input"><label for="age_children">Age of children</label><select name="age[]" class="form-field" required><option value="Baby" selected="selected">Baby</option><option value="Gradeschooler">Gradeschooler</option><option value="Toddler">Toddler</option><option value="Teenager">Teenager</option><option value="Preschooler">Preschooler</option></select></div></div>');
            }
        }
    });
});
</script>
@endsection
