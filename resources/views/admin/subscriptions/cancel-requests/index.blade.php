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
                                        <th>Email</th>
                                        <th>Package Name</th>
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
@include ('admin.includes.modal')
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
                {data: 'email', name: 'email'},
                {data: 'package_name', name: 'package_name'},
                {data: 'status', name: 'status'},
                {data: 'end_date', name: 'end_date'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'},
            ]
        });
    });

    function approveRequest(id, front_user_id){
        $('input[type="hidden"][id="user-id"]').val(front_user_id);
        $('input[type="hidden"][id="subscription-id"]').val(id);
        $("#approve-request-modal").modal('show');
    }

    function updateRequest(){
        var formData = $('#approve-request-form').serialize();
        formData += "&_token={{ csrf_token() }}";
        $("#approve-request-modal").modal('hide');
        $.ajax({
            type: "POST",
            url: "{{ route('admin.subscriptions.cancel-requests.update') }}",
            data: formData,
            success: function (response) {
                if(response.status == 200){
                    $("#approve-request-form").trigger('reset');
                    $('#cancellationRequestsTable').DataTable().ajax.reload();
                    swal("Success", "Status updated successfully!", "success");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    }

    function closeModal(){
        $("#approve-request-modal").modal('hide');
    }
</script>
@endsection
