<div class="timeForm">
    <table class="table table-bordered table-sm">
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
                            <i class="fa fa-plus"></i>
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
                                        <i class="fa fa-trash"></i>
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
@section('jquery')
@parent
<script type="text/javascript">
   $(document).ready(function() {
        @if($errors->any())
            var errorMessages = {!! json_encode($errors->toArray()) !!};
            const prefixesToCheck = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            $.each(errorMessages, function(key, value) {
                if (prefixesToCheck.some(prefix => key.startsWith(prefix))) {
                    var newKey = key.replace(/\./g, '_');
                    var errorMsg = containsWord(value, "before") ? "Invalid time" : "Required field";
                    $("#"+newKey).after(`
                        <div>
                            <span class="text-danger">
                                <strong>`+errorMsg+`</strong>
                            </span>
                        </div>
                    `);
                }
            });
        @endif
    });

    function containsWord(str, word) {
        var pattern = new RegExp("\\b" + word + "\\b", "i");
        return pattern.test(str);
    }
</script>
@endsection