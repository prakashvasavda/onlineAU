@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="content-header">
  <div class="container-fluid">
    @include('flash.flash-message')
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 class="m-0">Packages</h1>        
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
            <h3 class="card-title">Packages Data</h3>
          </div>
          <div class="card-body" id="returnsData">
            <table id="packageDataTable" class="table table-bordered table-striped table-re">
              <thead>
                <tr>                  
                  <th>Id</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Add/Update Features</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($packages))
                  @foreach($packages as $key=>$row)
                    <tr>
                      <td class="count">{{ $key+1 }}</td>
                      <td class="tick_number">{{ $row['name'] }}</td>
                      <td class="dispute_reference">{{ $row['price'] }}</td>
                      <td class="rrn"><a href="{{ route('admin.features',$row['id']) }}" class="btn btn-primary" title="Add Features"><i class="fa fa-plus"></i></a></td>
                    </tr>
                  @endforeach
                @endif
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
$(document).ready(function() {
  var table = $('#packageDataTable').DataTable({
  });
});
</script>
@endsection
