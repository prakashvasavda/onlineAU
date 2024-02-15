@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{"Subscription Cancel Requests"}}</h1>
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
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <div class="row">
                                {{-- <div class="col-md-12">
                                    <a href="#"><button class="btn btn-info float-right" type="button" style="margin-right: 1.5%;"><i class="fa fa-plus pr-1"></i> Add New</button></a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="cancellationRequestsTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Package Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>End Date</th>
                                        <th>Created At</th>
                                        <th>Action</th>
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
        var table = $('#cancellationRequestsTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.subscriptions.cancel-requests') }}",
            columns: [
                {data: 'user_name', name: 'user_name'},
                {data: 'package_name', name: 'package_name'},
                {data: 'm_payment_id', name: 'm_payment_id'},
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
