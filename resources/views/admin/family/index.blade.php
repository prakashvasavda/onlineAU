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
                            <table id="familyTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Cell Number</th>
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
        var table = $('#familyTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.families') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'cell_number', name: 'cell_number'},
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
                $.ajax({
                    url: "{{url('admin/delete-family')}}/"+user_id,
                    type: "DELETE",
                    data: {_token: '{{csrf_token()}}' },
                    success: function(response){
                        if(response.status == 200){
                            $('#familyTable').DataTable().ajax.reload();
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