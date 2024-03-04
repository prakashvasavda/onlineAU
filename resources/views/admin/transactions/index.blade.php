@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage {{isset($menu) ? ucwords($menu) : ""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{isset($menu) ? ucwords($menu) : ""}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include ('admin.includes.error')
            <div id="responce" class="alert alert-success" style="display: none">
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary card-outline">
                        {{-- <div class="card-header">
                            <h3 class="card-title">{{isset($menu) ? ucwords($menu) : ""}} Table</h3>
                        </div> --}}
                        <div class="card-body table-responsive">
                            <table id="transactionsTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Payment ID</th>
                                        <th>Amount</th>
                                        <th>Package Name</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('jquery')
<script type="text/javascript">
    $(function () {
        var table = $('#transactionsTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ url('admin/transactions') }}",
            columns: [
                {data: 'name_first', name: 'name_first'},
                {data: 'm_payment_id', name: 'm_payment_id'},
                {data: 'amount_net', name: 'amount_net'},
                {data: 'item_name', name: 'item_name'},
                {data: 'created_at', name: 'created_at'},
            ]
        });
    });

    function deleteReview(review_id, role){
        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete', 
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "{{url('admin/reviews')}}/"+review_id,
                    type: "DELETE",
                    data: {_token: '{{csrf_token()}}', review_id:review_id, role:role},
                    success: function(response){
                        // if(response.status == 200){
                            $('#reviewTable').DataTable().ajax.reload();
                            swal("Deleted", "Record successfully deleted!", "success");
                        //}
                    }
                });
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    }
</script>
@endsection
