<div class="table-responsive timeForm">
    <table class="table table-borderless table-sm">
        <tbody>
            @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $index => $day)
                <tr class="{{ $day }}-row">
                    <td><input type="checkbox" id="{{ $day . '-check'}}" name={{ "day_".$index }} value="1" onchange="enableCalenderRow('{{ $day }}')" {{ old('day_'.$index) || isset($calendars[$day]['start_time'][0]) || isset($calendars[$day]['end_time'][0]) ? 'checked' : '' }}></td>
                    <td>{{ ucfirst($day) }}</td>
                    <td><input type="text" id="{{ $day . '_start_time_0' }}" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][0] ?? $calendars[$day]['start_time'][0] ?? null }}" placeholder="Add Time" {{ old('day_'.$index) || isset($calendars[$day]['start_time'][0]) || isset($calendars[$day]['end_time'][0]) ? '' : 'disabled' }}></td>
                    <td>to</td>
                    <td><input type="text" id="{{ $day . '_end_time_0' }}" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][0] ?? $calendars[$day]['end_time'][0] ?? null }}" placeholder="Add Time" {{ old('day_'.$index) || isset($calendars[$day]['start_time'][0]) || isset($calendars[$day]['end_time'][0]) ? '' : 'disabled' }}></td>
                    <td onclick="addCalendarRow('{{ $day }}')">
                        <a href="javaScript:;" class="btn add-btn icon">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </td>
                </tr>

                @if(empty(old($day)) && isset($calendars[$day]) && !empty($calendars[$day]) && is_array($calendars[$day]))
                    @foreach($calendars[$day]['start_time'] as $key => $value)
                        @if(isset($key) && $key >= 1)
                            <tr class="{{ $day }}-row">
                                <td>&nbsp;</td>
                                <td>{{ ucfirst($day) }}</td>
                                <td><input type="text" id="{{ $day . '_start_time_' . $key }}"  onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][$key] ?? null }}" placeholder="Add Time"></td>
                                <td>to</td>
                                <td><input type="text" id="{{ $day . '_end_time_' . $key }}" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][$key] ?? null }}" placeholder="Add Time"></td>
                                <td onclick="removeCalendarRow(event)">
                                    <a href="javaScript:;" class="btn add-btn icon">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                
                @if(old($day) && !empty(old($day)) && is_array(old($day)))
                    @foreach(old($day)['start_time'] as $key => $value)
                        @if(isset($key) && $key >= 1)
                            <tr class="{{ $day }}-row">
                                <td>&nbsp;</td>
                                <td>{{ ucfirst($day) }}</td>
                                <td><input type="text" id="{{ $day . '_start_time_' . $key }}" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][$key] ?? null }}" placeholder="Add Time"></td>
                                <td>to</td>
                                <td><input type="text" id="{{ $day . '_end_time_' . $key }}" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][$key] ?? null }}" placeholder="Add Time"></td>
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
@if ($errors->has('day_0') || $errors->has('day_1') || $errors->has('day_2') || $errors->has('day_3') || $errors->has('day_4') || $errors->has('day_5') || $errors->has('day_6')) 
    <span class="text-danger">
        <strong>{{ "At least one day of the week must be selected." }}</strong>
    </span>
@endif

@section('script')
@parent
<script type="text/javascript">
   $(document).ready(function() {
        @if($errors->any())
            var errorMessages = {!! json_encode($errors->toArray()) !!};
            console.log(errorMessages);
            const prefixesToCheck = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            $.each(errorMessages, function(key, value) {
                if (prefixesToCheck.some(prefix => key.startsWith(prefix))) {
                    var newKey = key.replace(/\./g, '_');
                    $("#"+newKey).after(`
                        <div>
                            <span class="text-danger">
                                <strong>`+value+`</strong>
                            </span>
                        </div>
                    `);
                }
            });
        @endif
    });
</script>
@endsection