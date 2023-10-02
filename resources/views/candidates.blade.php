@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="content-header">
  <div class="container-fluid">
    @include('flash.flash-message')
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0">Candidates</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- small box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Candidates Data</h3>
          </div>
          <div class="card-body" id="returnsData">
            <table id="candidatesDataTable" class="table table-bordered table-striped table-re">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>Area</th>
                  <th>Role</th>
                  <th>Status</th>
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
$(document).ready(function () {
    var dataTable = $('#candidatesDataTable').DataTable({
      "serverSide": true,
      "processing": true,
      "ajax":{
      "url": "{{ url('admin/get_candidates') }}",
      "dataType": "json",
      "type": "POST",
      "data":{ _token: "{{csrf_token()}}"}
      },
      "columns": [
        { "data": "id" },
        { "data": "name" },
        { "data": "email" },
        { "data": "contact_number" },
        { "data": "gender" },
        { "data": "age" },
        { "data": "area" },
        { "data": "role" },
        { "data": "status" },
        { "data": "options" },
      ],
      "columnDefs": [
        { "width": "10%", "targets": 8 },        
        { "width": "13%", "targets": 9 },        
      ],
      "order": [[0, 'desc']],
      "fnDrawCallback": function() {
        $("input[data-bootstrap-switch]").each(function() {
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
        $('.statusChanged').on('switchChange.bootstrapSwitch', function (e, data) {
          var id = $(this).val();
          var status = 0;
          if(data == true) {
            status = 1;
          }
          $.ajax({
              type: "POST",
              url: "{{url('admin/statusCandidates')}}",
              data: {id:id,status:status,_token: "{{ csrf_token() }}"},
              success: function (data) {
              }
          });
        });
      }
    });
});

function removeCandidates(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
              type: "POST",
              url: "{{url('admin/destroyCandidates')}}",
              data: {id:id,_token: "{{ csrf_token() }}"},
              success: function (data) {
                $("#"+id).remove();
              Swal.fire(
                'Deleted!',
                'Candidates has been deleted.',
                'success'
              )
            }
          });
        }
    });
}
</script>
@endsection
