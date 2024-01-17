@php
    $how_works = [
        "babysitter" => "#how-babysitters-works",
        "petsitter"  => "#how-petsitters-works",
        "au_pair"    => "#how-aupairs-works",
        "nanny"      => "#how-nannies-works",
    ]
@endphp

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <p>Dear admin,</p>
    <p>
        The following Candidate <a target="blank" href="{{ route('candidate-detail', ['id' => session()->get('frontUser')->id]) }}">{{ session()->has('frontUser') ? session()->get('frontUser')->name : "-"}}</a> 
        is interested in the following  position
    </p>
    <p>
        @if(isset($services) && !empty($services))
            <ul>
                @foreach($services as $key => $value)
                    @php $service = trim($value); @endphp
                    <li>
                        <a target="blank" href="{{ route('sign-up', ['service' => 'candidate']) }}{{ array_key_exists($service, $how_works) ? $how_works[$service] : "" }}">{{ ucfirst($service) }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </p>
    <p>(side note: this is the <a target="blank" href="{{ route('family-detail', ['id' => $data['family_id']]) }}">link</a>  the button was pressed on.)</p>
    <p>Kind regards</p>
</body>
</html>