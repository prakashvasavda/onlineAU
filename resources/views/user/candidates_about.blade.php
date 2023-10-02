@extends('layouts.main')
@section('content')
<div class="candidate-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="candidate-img">
                    <img src="images/candidate-img1.png" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <div class="candidate-content">
                    <h3>NAME: JANE<br>
                        AGE: 21<br>
                        LOCATION: GAUTENG<br>
                        SPECIALITY: BABYSITTING AND NANNY<br>
                        HOURLY RATE: R70,00/HR
                    </h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="candidate-contact">
                    <p class="mb-2"><a href="javaScript:;" class="btn icon-with-text btn-link p-0"><i class="fa-regular fa-heart"></i>Save</a></p>
                    <a href="javaScript:;" class="btn btn-primary round">CONTACT JANE</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="review-section">
    <div class="container">
        <h2><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>12 Reviews</h2>
        <p>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET  DOLORE MAGNA ALIQUA. UT ENIM AD MINIM VENIAM, QUIS NOSTRUD EXERCITATION ULLAMCO LABORIS NISI UT ALIQUIP EX  EA COMMODO CONSEQUAT. DUIS AUTE IRURE DOLOR IN REPREHENDERIT IN VOLUPTATE VELIT ESSE CILLUM DOLORE EU  FUGIAT NULLA PARIATUR. EXCEPTEUR SINT OCCAECAT CUPIDATAT NON PROIDENT, SUNT IN CULPA QUI OFFICIA DESERUNT  MOLLIT ANIM ID EST LABORUM.</p>
        <!-- write-review-form -->
        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 me-auto">
            <form class="mt-5">
                <div class="form-input mb-2">
                    <div class="rating-star">
                        <input type="radio" name="rating" id="rating-5">
                        <label for="rating-5"></label>
                        <input type="radio" name="rating" id="rating-4">
                        <label for="rating-4"></label>
                        <input type="radio" name="rating" id="rating-3">
                        <label for="rating-3"></label>
                        <input type="radio" name="rating" id="rating-2">
                        <label for="rating-2"></label>
                        <input type="radio" name="rating" id="rating-1">
                        <label for="rating-1"></label>
                    </div>
                </div>
                <div class="form-input mb-2">
                    <label for="write_review">Review</label>
                    <textarea id="write_review" name="write_review" placeholder="" class="form-field" rows="5" required></textarea>
                </div>
                <div class="form-input-btn">
                    <input type="submit" class="btn btn-primary round" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="about-candidate">
    <div class="container">
        <div class="title-main">
            <h3>About me</h3>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="about-candidate-box">
                    <li>
                        <div class="about-candidate-title">
                            <img src="images/religion-icon1.png" alt="">
                            <h4>religion:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>Dinamic content</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="images/disabilities-icon1.png" alt="">
                            <h4>disabilities:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>Dinamic content</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="images/language-icon1.png" alt="">
                            <h4>HOME LANGUAGE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>Dinamic content</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="images/marital-status-icon1.png" alt="">
                            <h4>MARITAL STATUS:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>Dinamic content</h4>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="about-candidate-box">
                    <li>
                        <div class="about-candidate-title">
                            <img src="images/driving-licence-icon1.png" alt="">
                            <h4>DRIVERS LICENSE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>Dinamic content</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="images/vehicle-icon1.png" alt="">
                            <h4>OWN VEHICLE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>Dinamic content</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="images/years-experience-icon1.png" alt="">
                            <h4>YEARS OF EXPERIENCE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>Dinamic content</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="images/dependants-icon1.png" alt="">
                            <h4>DEPENDANTS</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>Dinamic content</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="candidate-availability">
    <div class="container">
        <div class="title-main">
            <h3>Availability</h3>
        </div>
        <div class="can-avail-table table-responsive">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <td></td>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                    </tr>
                    <tr>
                        <th>06:00 - 12:00</th>
                        <td>
                            <label><input type="checkbox" name="mo1" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="tu1" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="we1" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="th1" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="fr1" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="sa1" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="su1" value="1" id=""></label>
                        </td>
                    </tr>
                    <tr>
                        <th>12:00 - 17:00</th>
                        <td>
                            <label><input type="checkbox" name="mo2" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="tu2" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="we2" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="th2" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="fr2" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="sa2" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="su2" value="1" id=""></label>
                        </td>
                    </tr>
                    <tr>
                        <th>17:00 - 22:00</th>
                        <td>
                            <label><input type="checkbox" name="mo3" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="tu3" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="we3" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="th3" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="fr3" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="sa3" value="1" id=""></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="su3" value="1" id=""></label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="btn-main d-flex flex-wrap justify-content-evenly align-items-center mt-5">
            <a href="javaScript:;" class="btn btn-primary round">CONTACT JANE</a>
            <a href="javaScript:;" class="btn btn-primary round">BACK TO ALL CANDIDATES</a>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        alert("here");
    });
</script>
@endsection
