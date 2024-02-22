<div class="timeForm">
    <table class="table table-bordered table-sm">
        <tbody>
            @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                <tr id="{{ $day }}-row">
                    <td><input type="checkbox" checked disabled></td>
                    <td>{{ ucfirst($day) }}</td>
                    <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][0] ?? $calendars[$day]['start_time'][0] ?? null }}"></td>
                    <td>to</td>
                    <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][0] ?? $calendars[$day]['end_time'][0] ?? null }}"></td>
                    <td onclick="addCalendarRow('{{ $day }}')">
                        <a href="javaScript:;" class="btn add-btn icon">
                            <i class="fa fa-plus"></i>
                        </a>
                    </td>
                </tr>

                 @if(isset($calendars[$day]) && !empty($calendars[$day]) && is_array($calendars[$day]))
                    @foreach($calendars[$day]['start_time'] as $key => $value)
                        @if(isset($key) && $key >= 1)
                            <tr id="{{ $day }}-row">
                                <td><input type="checkbox" checked disabled></td>
                                <td>{{ ucfirst($day) }}</td>
                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][$key] ?? null }}"></td>
                                <td>to</td>
                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][$key] ?? null }}"></td>
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
                        @if(isset($key) && $key >= 1 && isset(old($day)['start_time'][$key]) || isset(old($day)['end_time'][$key]))
                            <tr id="{{ $day }}-row">
                                <td><input type="checkbox" checked disabled></td>
                                <td>{{ ucfirst($day) }}</td>
                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][$key] ?? null }}"></td>
                                <td>to</td>
                                <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][$key] ?? null }}"></td>
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