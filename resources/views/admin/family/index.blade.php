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
                            <table id="familyTable" class="table table-bordered table-striped dataTable display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;">Name</th>
                                        <th style="width: 15%;">Email</th>
                                        <th style="width: 15%;">Create At</th>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Subscriptions</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                    <th scope="col">Package</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody id="subscriptionTable">
                 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Modal -->
@endsection

@section('jquery')
<script type="text/javascript">
    $(function () {
        var table = $('#familyTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[2, 'desc']],
            ajax: "{{ route('admin.families') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'formatted_created_at', name: 'formatted_created_at'},
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

    function viewSubscriptions(user_id, role){
        event.preventDefault();
        $.ajax({
            url: "{{url('admin/get-user-subsctiptions')}}/"+user_id,
            type: "GET",
            data: {_token: '{{csrf_token()}}' },
            success: function(response){
                $("#subscriptionTable").empty();
                $('#subscriptionTable').append(response);
                $('#exampleModal').modal('toggle'); 
            }
        });
    }

    function closeModal(){
        $('#exampleModal').modal('toggle'); 
    }
</script>
@endsection
