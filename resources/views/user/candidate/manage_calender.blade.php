@extends('layouts.register')

@section('content')
<div class="container">
    <div class="title-main">
        <h2>Welcome to Online Au-Pairs</h2>
        <h3>Manage Calender</h3>
    </div>
    @include('flash.flash-message')
    <form method="POST" class="row" action="{{ route('update-candidate-calender', ['id' =>  Session::has('frontUser') ? Session::get('frontUser')->id : null]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ml-5"> 
            <div class="form-input">
                <label for="day_hour">What are your available days and hours</label>
                <div class="">
                    <table class="table table-borderless table-sm" width="100%" style="">
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
                                    <th>Afternoon</th>
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
                                    <th>Evening</th>
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
                                    <th>Night</th>
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
                </div>
                @error('morning')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-input-btn text-center">
                <input type="submit" class="btn btn-primary round" value="update">
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script type="text/javascript">
   
</script>
@endsection
