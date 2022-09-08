@extends('layouts.app')

@section('title')
{{ __('Create Employees') }}
@endsection




@section('content')
<div class="app-content content ">
<div class="card card-primary">
@if ($errors->any())
    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
        <div class="alert-body">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info mr-50 align-middle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
            <span>Error : <strong>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </span>
        </div>
    </div>
@endif
    <div class="card-header">
        <h3 class="card-title">{{ __('Create Employees') }}</h3>
    </div>
    <!-- /.card-header -->
    <form method="POST" action="{{route('admin.employees.store')}}">
        @csrf
        <div class="card-body">
            <div class="col-lg-12">
                @include('admin.employees._form')
            </div>
        </div>
        <div class="card-footer">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-check"></i>  {{__('Save')}}
                </button>
            </div>
        </div>
    </form>

    <!-- /.card-body -->
</div>
</div>
@endsection
@section('scripts')
    <script src="{{url('js/admin/employees.js')}}"></script>
@endsection