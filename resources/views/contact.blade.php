@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="content-header">
  <div class="container-fluid">
    @include('flash.flash-message')
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0">Contact</h1>
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
            <h3 class="card-title">Contact Data</h3>
          </div>
          <div class="card-body" id="returnsData">
            <table id="contactDataTable" class="table table-bordered table-striped table-re">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Number</th>
                  <th>Message</th>
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
    var dataTable = $('#contactDataTable').DataTable({
      "serverSide": true,
      "processing": true,
      "ajax":{
      "url": "{{ url('admin/get-contact') }}",
      "dataType": "json",
      "type": "POST",
      "data":{ _token: "{{csrf_token()}}"}
      },
      "columns": [
        { "data": "id" },
        { "data": "name" },
        { "data": "email" },
        { "data": "number" },
        { "data": "message" },
        { "data": "options" },
      ],
      "columnDefs": [
        { "width": "45%", "targets": 4 },
      ],
      "order": [[0, 'desc']]
    });
});

function removeContact(id) {
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
              url: "{{url('admin/destroyContact')}}",
              data: {id:id,_token: "{{ csrf_token() }}"},
              success: function (data) {
                $("#"+id).remove();
              Swal.fire(
                'Deleted!',
                'Contact has been deleted.',
                'success'
              )
            }
          });
        }
    });
}
</script>
@endsection
