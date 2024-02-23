<div class="table-responsive timeForm">
    <table class="table table-borderless table-sm">
        <tbody>
            @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $key => $day)
                <tr class="{{ $day }}-row">
                    <td><input type="checkbox" id="{{ $day . '-check'}}" name={{ "day_".$key }} value="1" onchange="enableCalenderRow('{{ $day }}')" {{ old('day_'.$key) ? 'checked' : '' }}></td>
                    <td>{{ ucfirst($day) }}</td>
                    <td><input type="text" id="{{ $day . '_start_time_0' }}" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[start_time][]" value="{{ old($day)['start_time'][0] ?? null }}" placeholder="Add Time" {{ old('day_'.$key) ? '' : 'disabled' }}><div></td>
                    <td>to</td>
                    <td><input type="text" id="{{ $day . '_end_time_0' }}" onfocus="(this.type='time')" onblur="(this.type='text')" name="{{ $day }}[end_time][]" value="{{ old($day)['end_time'][0] ?? null }}" placeholder="Add Time" {{ old('day_'.$key) ? '' : 'disabled' }}></td>
                    <td onclick="addCalendarRow('{{ $day }}')">
                        <a href="javaScript:;" class="btn add-btn icon">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </td>
                </tr>

                @if(old($day) && is_array(old($day)))
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

@section('script')
@parent
<script type="text/javascript">
   $(document).ready(function() {
        @if($errors->any())
            var errorMessages = {!! json_encode($errors->toArray()) !!};
            const prefixesToCheck = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            $.each(errorMessages, function(key, value) {
                if (prefixesToCheck.some(prefix => key.startsWith(prefix))) {
                    var newKey = key.replace(/\./g, '_');
                    console.log(newKey);
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
