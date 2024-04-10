@extends('layouts.register')

@section('content')
<div class="container">
    <div class="title-main">
        <h2>Welcome to Online Au-Pairs</h2>
        <h3>{{ isset($menu) ? ucfirst($menu) : '' }}</h3>
    </div>
    @include('flash.front-message')
    <form method="POST" class="row" action="{{ route('update-family-calender', ['id' =>  Session::has('frontUser') ? Session::get('frontUser')->id : null]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ml-5">
            <div class="mb-2">
                <label for="day_hour">What are your available days and hours</label>
            </div>
            <div class="table-responsive timeForm">
                <table class="table table-borderless table-sm">
                    <tbody>
                        @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                            <tr id="{{ $day }}-row">
                                <td><input type="checkbox"></td>
                                <td>{{ ucfirst($day) }}</td>
                                <td><input type="time" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][0] ?? null }}"></td>
                                <td>to</td>
                                <td><input type="time" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][0] ?? null }}"></td>
                                <td onclick="addCalendarRow('{{ $day }}')">
                                    <a href="javaScript:;" class="btn add-btn icon">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </td>
                            </tr>

                            @if(isset($calendars[$day]) && !empty($calendars[$day]) && is_array($calendars[$day]))
                                @foreach($calendars[$day]['start_time'] as $key => $value)
                                    @if(isset($key) && $key >= 1 && isset($calendars[$day]['start_time'][$key]) && isset($calendars[$day]['end_time'][$key]))
                                        <tr id="{{ $day }}-row">
                                            <td><input type="checkbox"></td>
                                            <td>{{ ucfirst($day) }}</td>
                                            <td><input type="time" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][$key] }}"></td>
                                            <td>to</td>
                                            <td><input type="time" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][$key] }}"></td>
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
                                    @if(isset($key) && $key >= 1 && isset(old($day)['start_time'][$key]) && isset(old($day)['end_time'][$key]))
                                        <tr id="{{ $day }}-row">
                                            <td><input type="checkbox"></td>
                                            <td>{{ ucfirst($day) }}</td>
                                            <td><input type="time" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][$key] }}"></td>
                                            <td>to</td>
                                            <td><input type="time" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][$key] }}"></td>
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
