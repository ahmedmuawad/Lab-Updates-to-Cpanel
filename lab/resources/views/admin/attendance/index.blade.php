@extends('layouts.app')

@section('title')
    {{__('Attendance')}}
@endsection


@section('content')
<div class="app-content content ">
<div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">
        {{__('Attendance Table')}}
      </h3>
      @can('create_hr')
        <a href="{{route('admin.attendance.create')}}" class="btn btn-primary btn-sm float-right">
          <i class="fa fa-plus"></i> {{ __('Create') }}
        </a>
      @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body">
       <div class="col-lg-12 table-responsive">
          <table id="reports_table" class=" table table table-striped table-bordered"  width="100%">
            <thead>
            <tr>
              <th width="10px">
                <input type="checkbox" class="check_all" name="" id="">
              </th>
              <th width="10px">#</th>
              <th>{{__('Employee')}}</th>
              <th>{{__('Start Shift')}}</th>
              <th>{{__('End Shift')}}</th>
              <th width="100px">{{__('Action')}}</th>
            </tr>
            </thead>
            <tbody>
               
            </tbody>
          </table>
       </div>
    </div>
    <!-- /.card-body -->
  </div>
</div>
@endsection
@section('scripts')
  <script>
    var can_delete=@can('delete_attendance')true @else false @endcan
  </script>
  <script src="{{url('js/admin/attendance.js')}}"></script>
@endsection