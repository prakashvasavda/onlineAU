@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Families</span>
                            <span class="info-box-number">{{ $front_users->total_families ?? "0" }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Petsittings</span>
                            <span class="info-box-number">{{ $front_users->total_family_petsittings ?? "0" }}</span>
                        </div>
                    </div>
                </div>
            </div>
               
            <div class="row"> 
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Petisitters</span>
                            <span class="info-box-number">{{ $front_users->total_petsitters ?? "0" }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Nannies</span>
                            <span class="info-box-number">{{ $front_users->total_nannies ?? "0" }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Babysitters</span>
                            <span class="info-box-number">{{ $front_users->total_babysitters ?? "0" }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Au-Pairs</span>
                            <span class="info-box-number">{{ $front_users->total_aupairs ?? "0" }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Latest Registrations</h3>
                        </div>
                        <div class="card-body">
                            <table id="candidatesTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($candidates) && !empty($candidates))
                                        @foreach ($candidates as $key => $value)
                                        <tr>
                                            <td>{{ $value->name ?? "-" }}</td>
                                            <td>{{ $value->role ?? "-" }}</td>
                                            <td>{{ $value->created_at ?? "-" }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Latest Transactions</h3>
                        </div>
                        <div class="card-body">
                            <table id="paymentTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Amount</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($payment) && !empty($payment))
                                        @foreach ($payment as $key => $value)
                                        <tr>
                                            <td>{{ $value->m_payment_id ?? "-" }}</td>
                                            <td>{{ $value->amount_gross ?? "-" }}</td>
                                            <td>{{ $value->created_at ?? "-" }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
