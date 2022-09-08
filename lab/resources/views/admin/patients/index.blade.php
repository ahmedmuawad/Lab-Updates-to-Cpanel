@extends('layouts.app')

@section('title')
{{__('Patients')}}
@endsection

{{-- @section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="nav-icon fas fa-user-injured"></i>
            {{__('Patients')}}
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Patients')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection --}}

@section('content')

<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="invoice-list-wrapper">
            <div class="card">
                <section id="advanced-search-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">{{__('Patients Table')}}</h4>
                                @can('create_patient')
                                  <a href="{{route('admin.patients.create')}}" class="btn btn-primary btn-sm float-right">
                                    <i class="fa fa-plus"></i> {{__('Create')}} 
                                  </a>
                                @endcan
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                <!-- Tools -->
                                <div id="accordion">
                                  <div class="card card-info">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary collapsed" aria-expanded="false">
                                      <i class="fas fa-file-excel"></i>
                                      {{__('Import / Export')}}
                                    </a>
                                    <div id="collapseOne" class="panel-collapse in collapse">
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-lg-12 text-center">
                                            <a class="btn btn-success" href="{{route('admin.patients.export')}}">
                                              <i class="fa fa-file-excel"></i>
                                              {{__('Export')}}
                                            </a>
                                            <a class="btn btn-success" href="{{route('admin.patients.download_template')}}">
                                              <i class="fa fa-file-excel"></i>
                                              {{__('Download template')}}
                                            </a>
                                          </div>
                                          <div class="col-lg-12">
                                            <!-- import form -->
                                            <form action="{{route('admin.patients.import')}}" method="POST" enctype="multipart/form-data">
                                              @csrf
                                              <div class="row mt-3">
                                                <div class="col-lg-12">
                                                  <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                      <h5 class="card-title">
                                                          {{__('Import')}}
                                                      </h5>
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="input-group">
                                                        <div class="custom-file">
                                                          <input type="file" class="custom-file-input" id="exampleInputFile" name="import" required>
                                                          <label class="custom-file-label" for="exampleInputFile">{{__('Choose file')}}</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="card-footer">
                                                      <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-check"></i>
                                                        {{__('Import')}}
                                                      </button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </form>
                                            <!-- /import form -->
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- \Tools -->
                              </div>
                            </div>
                            <hr class="my-0">
                            <div class="card-datatable">
                                <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><table class="table table-striped table-bordered" id="patients_table" role="grid" aria-describedby="DataTables_Table_2_info">
                                    <thead>
                                        <tr role="row">
                                          <th width="10px">
                                            <input type="checkbox" class="check_all" name="" id="">
                                          </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 138.688px;" aria-label="#: activate to sort column ascending">#</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 142.438px;" aria-label="Created By: activate to sort column ascending">{{__('Code')}}</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 142.438px;" aria-label="Created By: activate to sort column ascending">{{__('Name')}}</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 142.438px;" aria-label="Created By: activate to sort column ascending">{{__('Phone')}}</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 142.438px;" aria-label="Created By: activate to sort column ascending">{{__('Email')}}</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 142.438px;" aria-label="Created By: activate to sort column ascending">{{__('Contract')}}</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 142.438px;" aria-label="Created By: activate to sort column ascending">{{__('Total')}}</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 142.438px;" aria-label="Created By: activate to sort column ascending">{{__('Paid')}}</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 142.438px;" aria-label="Created By: activate to sort column ascending">{{__('Due')}}</th>
                                            <th class="" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 128.844px;" aria-label="Barcode: activate to sort column ascending">{{__('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        </tr>
                                    </tfoot>
                              </table>
                            </div>
                            <!--Search Form -->
                        </div>
                    </div>
                </div>
            </section>
            </div>
        </section>
      </div>
  </div>
</div>
{{--  
<div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{__('Patients Table')}}</h3>
      @can('create_patient')
      <a href="{{route('admin.patients.create')}}" class="btn btn-primary btn-sm float-right">
       <i class="fa fa-plus"></i> {{__('Create')}} 
      </a>
      @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body">
     
      <div class="row">
        <div class="col-lg-12">
          <!-- Tools -->
          <div id="accordion">
            <div class="card card-info">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary collapsed" aria-expanded="false">
                <i class="fas fa-file-excel"></i>
                {{__('Import / Export')}}
              </a>
              <div id="collapseOne" class="panel-collapse in collapse">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12 text-center">
                      <a class="btn btn-success" href="{{route('admin.patients.export')}}">
                        <i class="fa fa-file-excel"></i>
                        {{__('Export')}}
                      </a>
                      <a class="btn btn-success" href="{{route('admin.patients.download_template')}}">
                        <i class="fa fa-file-excel"></i>
                        {{__('Download template')}}
                      </a>
                    </div>
                    <div class="col-lg-12">
                      <!-- import form -->
                      <form action="{{route('admin.patients.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                          <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h5 class="card-title">
                                    {{__('Import')}}
                                </h5>
                              </div>
                              <div class="card-body">
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="import" required>
                                    <label class="custom-file-label" for="exampleInputFile">{{__('Choose file')}}</label>
                                  </div>
                                </div>
                              </div>
                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-check"></i>
                                  {{__('Import')}}
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <!-- /import form -->
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- \Tools -->
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 table-responsive">
          <table id="patients_table" class="table table-striped table-bordered" width="100%">
            <thead>
            <tr>
              <th width="10px">
                <input type="checkbox" class="check_all" name="" id="">
              </th>
              <th width="10px">#</th>
              <th>{{__('Code')}}</th>
              <th>{{__('Name')}}</th>
              <th>{{__('Phone')}}</th>
              <th>{{__('Email')}}</th>
              <th>{{__('Contract')}}</th>
              <th width="100px">{{__('Total')}}</th>
              <th width="100px">{{__('Paid')}}</th>
              <th width="100px">{{__('Due')}}</th>
              <th width="150px">{{__('Action')}}</th>
            </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>

        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>

--}}
  @endsection
@section('scripts')
  <script>
    var can_delete=@can('delete_patient')true @else false @endcan
  </script>
  <script src="{{url('js/admin/patients.js')}}"></script>
@endsection