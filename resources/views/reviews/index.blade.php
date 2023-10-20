@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        @include('flash.flash-message')
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Reviews</h1>
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
                        <h3 class="card-title">Reviews</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="reviewsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Review Note</th>
                                    <th>Date</th>
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
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    $(function () {
        var table = $('#reviewsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.reviews') }}",
            columns: [
                {data: 'name', "width": "20%",          name: 'name'},
                {data: 'role', "width": "20%",          name: 'role'},
                {data: 'review_note', "width": "20%",   name: 'review_note'},
                {data: 'created_at', "width": "30%",    name: 'created_at'},
                {data: 'action', "width": "10%",        name: 'action'},
            ]
        });
    });

    function deleteReview(review_id, role){
        event.preventDefault();
        Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this record?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: "No, cancel",
                closeOnConfirm: false,
                closeOnCancel: false
       }).then((result) => {
            if (result.isConfirmed) {    
                $.ajax({
                    url: "{{url('admin/delete-review')}}/"+review_id,
                    type: "POST",
                    data: {_token: '{{csrf_token()}}', review_id:review_id, role:role},
                    success: function(data){
                        console.log(data);
                        $('#reviewsTable').DataTable().ajax.reload();
                        Swal.fire("Deleted", "Your data successfully deleted!", "success");
                    }
                });
            } else {
                Swal.fire("Cancelled", "Your data safe!", "error");
            }
        });
    }
</script>
@endsection