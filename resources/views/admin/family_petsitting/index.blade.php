@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{isset($menu) ? ucwords($menu) : ""}}</h1>
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
                               {{--  <div class="col-md-12">
                                    <a href="#"><button class="btn btn-info float-right" type="button" style="margin-right: 1.5%;"><i class="fa fa-plus pr-1"></i> Add New</button></a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="familyPetsittingTable" class="table table-bordered table-striped dataTable display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;">Name</th>
                                        <th style="width: 15%;">Email</th>
                                        <th style="width: 15%;">Created At</th>
                                        <th style="width: 15%;">Payment</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 10%;">Action</th>
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
        var table = $('#familyPetsittingTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[2, 'desc']],
            ajax: "{{ url('admin/family-petsitting') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'payment_status', name: 'payment_status', orderable: false, searchable: false},
                {data: 'user_status', name: 'user_status', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    function deleteFamily(user_id, role){
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
                swal(showProgressAlert("Processing...", "Please wait"));
                $.ajax({
                    url: "{{url('admin/family-petsitting')}}/"+user_id,
                    type: "DELETE",
                    data: {_token: '{{csrf_token()}}' },
                    success: function(response){
                        console.log(response);
                        if(response.status == 200){
                            $('#familyPetsittingTable').DataTable().ajax.reload();
                            swal("Deleted", "Record successfully deleted!", "success");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    }
</script>
@endsection
