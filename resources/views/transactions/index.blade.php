@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        @include('flash.flash-message')
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Transactions</h1>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- small box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transactions</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="transactionsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Package Name</th>
                                    <th>Transaction ID</th>
                                    <th>Transaction Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    $(function () {
        var table = $('#transactionsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.transactions') }}",
            columns: [
                {data: 'name_first', "width": "20%",    name: 'name_first'},
                {data: 'item_name', "width": "20%",     name: 'item_name'},
                {data: 'm_payment_id', "width": "20%",  name: 'm_payment_id'},
                {data: 'amount_gross', "width": "20%",  name: 'amount_gross'},
                {data: 'created_at', "width": "20%",    name: 'created_at'},
            ]
        });
    });
</script>
@endsection