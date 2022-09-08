@extends('layouts.app')

@section('title')
{{__('Edit Contract')}}
@endsection


@section('content')
<div class="app-content content ">
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{__('Edit Contract')}}</h3>
    </div>
    <!-- /.card-header -->
    <form method="POST" action="{{route('admin.contracts.update',$contract->id)}}" id="contract_form">
        <!-- /.card-header -->
        <div class="card-body">
            @csrf
            @method('put')
            @include('admin.contracts._form')
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary save_contract">
              <i class="fa fa-check"></i> {{__('Save')}}
            </button>
        </div>
    </form>
    <!-- /.card-body -->
  </div>
</div>
@endsection
@section('scripts')
  <script src="{{url('js/admin/contracts.js')}}"></script>
@endsection