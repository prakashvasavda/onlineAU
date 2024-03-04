@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{"Manage Subscription Cancel Requests"}}</h1>
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
                            <h3 class="card-title">Cancellation Request Table</h3>
                        </div> --}}
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
        if (!$("#approve-request-form").valid()) {
            return false;
        }

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

    $(document).ready(function() {
        $.validator.addMethod("greaterThanToday", function(value, element) {
            var currentDate = new Date();
            var selectedDate = new Date(value);
            return selectedDate > currentDate;
        }, "Please select a date greater than today");

        $("#approve-request-form").validate({
            rules: {
                approval_status: "required",
                end_date: {
                    required: true,
                    greaterThanToday: true
                }
            },
            messages: {
                approval_status: "Please select an approval status",
                end_date: {
                    required: "Please enter an end date",
                    greaterThanToday: "End date must be greater than today"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("type") === "radio") {
                    error.appendTo(element.parent().parent()).addClass("text-danger"); 
                } else {
                    error.appendTo(element.parent()).addClass("text-danger");
                }
            }
        });
    });
</script>
@endsection
