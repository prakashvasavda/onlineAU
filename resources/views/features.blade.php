@extends('layouts.app')
@section('content')
@section('css')
@endsection
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Features</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
      @include('flash.flash-message')
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Features</h3>
              </div>
              <form method="POST" action="{{ route('admin.store_features') }}" id="myForm">
              @csrf
              <input type="hidden" name="package_id" value="{{ Route::current()->parameter('id') }}">
                <div class="card-body">
                  <div class="container">
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <a href="javascript:void(0)" id="cloneButton" class="btn btn-success" style="float:right;">Add More Features</a>
                      </div>
                    </div>
                  </div>
                    @if(isset($getFeaturesData) && !empty($getFeaturesData))                    
                      @foreach($getFeaturesData as $key=>$value)
                      <div class="row newClone">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="featureName">Feature Name</label>
                                  <input type="text" name="feature[]" class="form-control" placeholder="Enter Feature Name" value="{{ $value['title'] }}">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="status">Status</label>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" name="status[{{$key}}]" value="1" {{ ($value['status'] == 1 ? "checked" : "") }}>
                                      <label class="form-check-label" for="status">Active</label>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label>&nbsp;</label>
                                  <button type="button" class="btn btn-danger btn-block" id="removeButton">Remove</button>
                              </div>
                          </div>
                      </div>
                      @endforeach
                    @else
                      <div class="row newClone">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="featureName">Feature Name</label>
                                  <input type="text" name="feature[]" class="form-control" placeholder="Enter Feature Name">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="status">Status</label>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" name="status[0]" value="1">
                                      <label class="form-check-label" for="status">Active</label>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label>&nbsp;</label>
                                  <button type="button" class="btn btn-danger btn-block" id="removeButton">Remove</button>
                              </div>
                          </div>
                      </div>
                    @endif
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('js')
<script>
  $(document).ready(function () {
    var rowCount = '{{ count($getFeaturesData) }}';
      $("#cloneButton").click(function () {
          var clonedRow = $(".newClone").first().clone();
          clonedRow.find("input[type=text]").val("");
          clonedRow.find("input[type=checkbox]").prop("checked", false);
          clonedRow.find("input[type=checkbox]").each(function () {
                var currentIndex = rowCount;
                var newName = "status[" + currentIndex + "]";
                $(this).attr("name", newName);
            });
          $(".container").append(clonedRow);
          rowCount++;
      });
      $(document).on("click", "#removeButton", function () {          
          $(this).closest(".newClone").remove();
      });
  });
</script>
@endsection
