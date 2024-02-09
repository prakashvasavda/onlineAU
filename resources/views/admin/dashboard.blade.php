@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <a href="{{ route('admin.families') }}" class="small-box-footer">
                        <div class="small-box bg-white">
                            <div class="inner">
                                <h3>{{ isset($front_users->total_families) ? $front_users->total_families : "0" }}</h3>
                                <p>Total Families</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-6 col-6">
                    <a href="{{ route('admin.family-petsitting.index') }}" class="small-box-footer">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ isset($front_users->total_family_petsittings) ? $front_users->total_family_petsittings : "0" }}</h3>
                                <p>Total Family Petsitting</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{ route('admin.candidates.petsitters') }}" class="small-box-footer">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ isset($front_users->total_petsitters) ? $front_users->total_petsitters : "0" }}</h3>
                                <p>Total Petisitters</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{ route('admin.candidates.nannies') }}" class="small-box-footer">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ isset($front_users->total_nannies) ? $front_users->total_nannies : "0" }}</h3>
                                <p>Total Nannies</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{ route('admin.candidates.babysitters') }}" class="small-box-footer">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ isset($front_users->total_babysitters) ? $front_users->total_babysitters : "0" }}</h3>
                                <p>Total Babysitters</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{ route('admin.candidates.aupairs') }}" class="small-box-footer">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ isset($front_users->total_aupairs) ? $front_users->total_aupairs : "0" }}</h3>
                                <p>Total Au-Pairs</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
