@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="content-header">
  <div class="container-fluid">
    @include('flash.flash-message')
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0">Families</h1>
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
            <h3 class="card-title">Families Data</h3>
          </div>
          <div class="card-body" id="returnsData">
            <table id="familiesDataTable" class="table table-striped table-bordered dataTable display" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="10%">ID</th>
                  <th width="10%">Name</th>
                  <th width="10%">Email</th>
                  <th width="15%">Contact</th>
                  <th width="10%">Gender</th>
                  {{-- <th width="10%">Age</th> --}}
                  {{-- <th width="10%">Area</th>  --}}                 
                  <th width="15%">Action</th>
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
    var dataTable = $('#familiesDataTable').DataTable({
      "responsive": true,
      "serverSide": true,
      "processing": true,
      "ajax":{
      "url": "{{ url('admin/get_families') }}",
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
        // { "data": "age" },
        // { "data": "area" },
        { "data": "options" },
      ],
      "columnDefs": [
        // { "width": "10%", "targets": 2 },        
        // { "width": "13%", "targets": 3 },        
      ],
      "order": [[0, 'desc']]
    });
});

function removeFamilies(id) {
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
              url: "{{url('admin/destroyFamilies')}}",
              data: {id:id,_token: "{{ csrf_token() }}"},
              success: function (data) {
                $("#"+id).remove();
              Swal.fire(
                'Deleted!',
                'Familie has been deleted.',
                'success'
              )
            }
          });
        }
    });
}
</script>
@endsection
