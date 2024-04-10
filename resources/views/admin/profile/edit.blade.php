@extends('layouts.app')
@section('content')
    <div class="content-wrapper" style="min-height: 946px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{'Profile'}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{'Profile'}}</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
             @include ('admin.includes.error')
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit {{'Profile'}}</h3>
                        </div>
                        {!! Form::model($users,['url' => url('admin/profile/'.$users->id),'method'=>'patch','id' => 'bannerForm','class' => 'form-horizontal','files'=>true]) !!}
                        <div class="card-body">
                            @include ('admin.profile.form')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.dashboard') }}" ><button class="btn btn-default" type="button">Back</button></a>
                            <button class="btn btn-secondary float-right" type="submit">Update</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

