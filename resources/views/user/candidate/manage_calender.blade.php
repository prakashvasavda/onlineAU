@extends('layouts.register')

@section('content')
<div class="container">
    <div class="title-main">
        <h2>Welcome to Online Au-Pairs</h2>
        <h3>Manage Calender</h3>
    </div>
    @include('flash.front-message')
    <form method="POST" class="row" action="{{ route('update-candidate-calender', ['id' =>  Session::has('frontUser') ? Session::get('frontUser')->id : null]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ml-5">
            <div class="mb-2">
                <label class="d-none" for="day_hour">What are your available days and hours</label>
            </div>
            @include('user.calender.edit')
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
