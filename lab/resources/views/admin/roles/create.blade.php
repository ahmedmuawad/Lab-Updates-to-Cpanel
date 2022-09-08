@extends('layouts.app')

@section('title')
{{ __('Create Role') }}
@endsection

@section('css')
@endsection


@section('content')
<div class="app-content content ">
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ __('Create Role') }}</h3>
    </div>
    <!-- /.card-header -->
    <form method="POST" action="{{route('admin.roles.store')}}">
        @csrf
        <div class="card-body">
            <div class="col-lg-12">
                @include('admin.roles._form')
            </div>
        </div>
        <div class="card-footer">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check"></i>
                    {{__('Save')}}
                </button>
            </div>
        </div>
    </form>

    <!-- /.card-body -->
</div>

@endsection
@section('scripts')
    <script src="{{url('js/admin/roles.js')}}"></script>
@endsection
