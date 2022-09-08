@extends('layouts.app')

@section('title')
{{__('Edit Labs')}}
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <i class="nav-icon fas fa-file-contract"></i>
              {{__('labs')}}
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.labs.index')}}">{{__('Labs')}}</a></li>
            <li class="breadcrumb-item active">{{__('Edit Labs')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
    <div class="app-content content ">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{__('Edit Labs')}}</h3>
            </div>
            <!-- /.card-header -->
            <form method="POST" action="{{route('admin.labs.update',$lab->id)}}" id="lab_form">
                <!-- /.card-header -->
                <div class="card-body">
                    @csrf
                    @method('put')
                    @include('admin.labs._form')
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary save_lab">
                      <i class="fa fa-check"></i> {{__('Save')}}
                    </button>
                </div>
            </form>
            <!-- /.card-body -->
          </div>
    </div>
@endsection
@section('scripts')
  <script src="{{url('js/admin/labs.js')}}"></script>
  <script>
      $('#government_id').change(function () {
          $.get("{{ url('admin/visits/') }}" + "/" + jQuery('#government_id').val() + "/get-regions",
              function(response){
                  let region_base = document.getElementById('region_id')
                  region_base.innerHTML = "";
                  region_base.innerHTML += "<option></option>";
                  response.data.forEach(function(e) {
                      region_base.innerHTML += "<option value='" + e.id +"" + "'>" + e.name + "</option>";
                  })

                  let rep_base = document.getElementById('rep_id')
                  rep_base.innerHTML = "";
                  rep_base.innerHTML += "<option></option>";
                  response.rep.forEach(function(e) {
                      rep_base.innerHTML += "<option value='" + e.id +"" + "'>" + e.name + "</option>";
                  })
              }
          );
      })
  </script>
@endsection