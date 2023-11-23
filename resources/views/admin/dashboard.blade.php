@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <a href="{{url('/users')}}" class="small-box-footer">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>55</h3>
                                <p>Total Families</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{url('/stock_category')}}" class="small-box-footer">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>10</h3>
                                <p>Total Candidates</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-sitemap"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{url('/stock')}}" class="small-box-footer">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>50</h3>
                                <p>Total Visits</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-th"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
