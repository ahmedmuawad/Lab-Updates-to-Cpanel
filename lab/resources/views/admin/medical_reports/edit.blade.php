@extends('layouts.app')

@section('title')
{{__('Edit medical report')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{url('plugins/summernote/summernote-bs4.css')}}">
@endsection

@section('content')


@can('view_medical_report')

<div class="row">
  <div class="col-lg-12">

    <a href="{{route('admin.medical_reports.show',$group['id'])}}" class="btn btn-danger float-right mb-3">
      <i class="fa fa-file-pdf"></i> {{__('Print Report')}}
    </a>

    <button type="button" class="btn btn-info float-right mb-3 mr-1" data-toggle="modal" data-target="#patient_modal">
      <i class="fas fa-user-injured"></i>  {{$group['patient']['name']}} - {{__($group['patient']['gender'])}} - {{$group['patient']['age']}}
    </button>
    @can('sign_medical_report')
        <a class="btn btn-success float-right mb-3 mr-1" href="{{route('admin.medical_reports.review',$group['id'])}}">
            <i class="fas fa-eye" aria-hidden="true"></i>
            {{__('Review Report')}}
        </a>
    @endcan
    @can('sign_medical_report')
        <a class="btn btn-success float-right mb-3 mr-1" href="{{route('admin.medical_reports.sign',$group['id'])}}">
            <i class="fas fa-signature" aria-hidden="true"></i>
            {{__('Sign Report')}}
        </a>
    @endcan

    <a @if(isset($previous)) href="{{route('admin.medical_reports.edit',$previous['id'])}}" @endif class="btn btn-info @if(!isset($previous)) disabled @endif">
      <i class="fa fa-backward mr-2"></i>
      {{__('Previous')}}
    </a>
    <a @if(isset($next)) href="{{route('admin.medical_reports.edit',$next['id'])}}" @endif class="btn btn-success @if(!isset($next)) disabled @endif">
        {{__('Next')}}
        <i class="fa fa-forward ml-2"></i>
    </a>

  </div>
</div>
@endcan


<form action="{{route('admin.medical_reports.upload_report',$group['id'])}}" method="POST" enctype="multipart/form-data">
  <div class="card card-primary">
    <div class="card-header">
      <h5 class="card-title ">
          @if($group['uploaded_report'])
            <i class="fa fa-check-double text-success"></i>
          @endif
          {{__('Upload report')}}
        </h5>
        <div class="card-tools ">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0" style="display: none;">
      <div class="row">
        <div class="col-lg-12">
          <label>
            {{__('You can upload a pdf file as the report')}}
          </label>
          <div class="form-group">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="report" accept="application/pdf" class="custom-file-input" id="report" required>
                <label class="custom-file-label" for="report">{{__('Report')}}</label>
              </div>
              @if($group['uploaded_report'])
              <div class="input-group-append">
                <span class="input-group-text" id="">
                  <a href="{{$group['report_pdf']}}" target="_blank">
                    <i class="fa fa-file-pdf"></i>
                  </a>
                </span>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer" style="display: none;">
      <button type="submit" class="btn btn-primary">
        <i class="fa fa-check"></i>
        {{__('Upload')}}
      </button>
    </div>
  </div>
</form>

<!-- tests -->
@if(count($group['all_tests']))
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{__('Tests')}}</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      @if(count($group['all_tests']))
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="taps">
            @foreach($group['all_tests'] as  $test)
            <li class="nav-item">
              <a class="nav-link text-capitalize" href="#test_{{$test['id']}}" data-toggle="tab">@if($test['done']) <i class="fa fa-check text-success"></i> @endif {{$test['test']['name']}}</a>
            </li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body p-0">
          <div class="tab-content">
            @foreach($group['all_tests'] as $test)
            <div class="tab-pane overflow-auto" id="test_{{$test['id']}}">
              @if($test->check_test == 1)
              <form action="{{route('admin.medical_reports.update',$test['id'])}}" method="POST">
                      <input type="hidden" class="form-control reference_range" name="group_id" value="{{$group['id']}}" >
                      <input type="hidden" class="form-control reference_range" name="test_id" value="{{$test['test_id']}}" >

                @csrf
                @method('put')
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="200px">{{__('Name')}}</th>
                      <th width="100px" class="text-center">{{__('Unit')}}</th>
                      <th width="400px" class="text-center">{{__('Reference Range')}}</th>
                      <th width="200px" class="text-center">{{__('Result')}}</th>
                      <th class="text-center" style="width:200px">{{__('Status')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($test['results'] as $key => $result)
                      @if(isset($result['component']))
                        @if($result['component']['title'])
                          <tr>
                            <td colspan="5">
                              <b>{{$result['component']['name']}} {{$result['component']['id']}}</b>
                            </td>
                          </tr>
                        @else
                          <tr>
                            <td>{{$result['component']['name']}} {{$result['component']['id']}}</td>
                            <td class="text-center">{{$result['component']['unit']}}</td>
                            <td class="text-center">
                              @if(isset($result['component'])&&count($result['component']['reference_ranges']))
                              <div class="card card-primary card-outline">
                                <div class="card-header">
                                  <h5 class="card-title">
                                  {{__('Reference ranges')}}
                                  </h5>
                                  <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                      </button>
                                      <button type="button" class="btn btn-tool delete-reference" data-url="{{ route('admin.medical_report.save.reference.range') }}" data-component="{{$result['component']['id']}}" data-card-widget="remove" data-reference="{!! $result['component']['reference_range'] !!}"><i class="fas fa-times"></i>
                                      </button>

                                      @php


                                          $component_new = App\Models\Test::find($result['component']['id']);

                                          $new_reference = $component_new->reference_range_new_component()->where('group_id' , $group['id'])->first();

                                      @endphp

                                      <!--{{ $component_new->reference_range_new_component }}-->


                                      <input type="hidden" class="form-control reference_range" name="reference_range_new[]" value="{{ $component_new->reference_range_new_component && $new_reference ? $new_reference->referance_range : $result['component']['reference_range'] }}" >
                                      <input type="hidden" class="form-control reference_range" name="component_id[]" value="{{$result['component']['id']}}" >

                                  </div>
                                </div>
                                <div class="card-body p-0" style="display: none;">
                                  <table class="table table-striped table-bordered">
                                    <thead>
                                      <tr>
                                        <th>{{__('Gender')}}</th>
                                        <th>{{__('Age')}}</th>
                                        <th>{{__('Critical low')}}</th>
                                        <th>{{__('Normal')}}</th>
                                        <th>{{__('Critical high')}}</th>
                                      </tr>
                                    </thead>
                                    @foreach($result['component']['reference_ranges'] as $reference_range)
                                    <tr>
                                      <td>
                                        {{__($reference_range['gender'])}}
                                      </td>
                                      <td>
                                        {{__($reference_range['age_from'])}} : {{$reference_range['age_to']}} {{__($reference_range['age_unit'])}}
                                      </td>
                                      <td>
                                        {{$reference_range['critical_low_from']}}
                                      </td>
                                      <td>
                                        {{$reference_range['normal_from']}} : {{$reference_range['normal_to']}}
                                      </td>
                                      <td>
                                        {{$reference_range['critical_high_from']}}
                                      </td>
                                    </tr>
                                    @endforeach
                                  </table>
                                </div>
                              </div>
                              @endif
                              <!--{!! $result['component']['reference_range'] !!}-->

                              @php


                                  $component_new = App\Models\Test::find($result['component']['id']);

                                  $new_reference = $component_new->reference_range_new_component()->where('group_id' , $group['id'])->first();

                              @endphp

                              <!--{{ $component_new->reference_range_new_component }}-->

                              {!! $component_new->reference_range_new_component && $new_reference ? $new_reference->referance_range : $result['component']['reference_range'] !!}


                            </td>
                            <td>
                              @if($result['component']['type']=='text')
                                <input type="hidden" id="isi_settings" value="{{ $medical_settings['isi'] }}">
                                <input type="text" name="result[{{$result['id']}}][result]" class="{{ $result['component']['id'] == 1257 ? 'WBCs' : '' }} {{ $result['component']['id'] == 1261 ? 'Lymphocytes' : '' }} {{ $result['component']['id'] == 1262 ? 'Monocytes' : '' }} {{ $result['component']['id'] == 1263 ? 'Eosinophils' : '' }} {{ $result['component']['id'] == 1264 ? 'Basophils' : '' }} {{ $result['component']['id'] == 1266 ? 'Neutrophil' : '' }} {{ $result['component']['id'] == 1267 ? 'Segment' : '' }} {{ $result['component']['id'] == 1268 ? 'Band' : '' }} form-control  {{ $result['component']['id'] == 1419 ? 'a_Lymphocytes' : '' }} {{ $result['component']['id'] == 1420 ? 'a_Monocytes' : '' }} {{ $result['component']['id'] == 1421 ? 'a_Eosinophils' : '' }} {{ $result['component']['id'] == 1422 ? 'a_Basophils' : '' }} {{ $result['component']['id'] == 1424 ? 'a_Neutrophil' : '' }} {{ $result['component']['id'] == 1425 ? 'a_Segment' : '' }} {{ $result['component']['id'] == 1426 ? 'a_Band' : '' }} test_result {{ $result['component']['id'] == 1249 ? 'rpcs' : '' }} {{ $result['component']['id'] == 1253 ? 'mchc' : '' }} {{ $result['component']['id'] == 1251 ? 'mcv' : '' }} {{ $result['component']['id'] == 1248 ? 'Hemoglobin' : '' }} {{ $result['component']['id'] == 1252 ? 'mch' : '' }} {{ $result['component']['id'] == 1250 ? 'hct' : '' }} {{$result['component']['id'] == 1483 ? 'cho' : '' }} {{$result['component']['id'] == 1484 ? 'Triglycerides' : '' }} {{$result['component']['id'] == 1485 ? 'hdl' : '' }} {{$result['component']['id'] == 1486 ? 'ldl' : '' }} {{$result['component']['id'] == 1487 ? 'Risk1' : '' }} {{$result['component']['id'] == 1488 ? 'Risk2' : '' }} {{$result['component']['id'] == 532 ? 'pt' : '' }} {{$result['component']['id'] == 1479 ? 'Concentration' : '' }} {{ $result['component']['id'] == 1543 ? 'PT_Time' : '' }} {{ $result['component']['id'] == 1544 ? 'Control_Time' : '' }} {{ $result['component']['id'] == 1545 ? 'Activity' : '' }} {{ $result['component']['id'] == 1546 ? 'INR' : '' }}" data-component="{{ $result['component']['id'] }}" data-url="{{ route('admin.medical_report.get-comment') }}" @if($result['component']['id'] == 1544)  value="{{ $medical_settings['pt_control_time'] }}" readonly @else value="{{$result['result']}}"  @endif
                                  @if(!empty($result->reference_range()))
                                      normal_from="{{$result->reference_range()->normal_from}}"
                                      normal_to="{{$result->reference_range()->normal_to}}"
                                      critical_high_from="{{$result->reference_range()->critical_high_from}}"
                                      critical_low_from="{{$result->reference_range()->critical_low_from}}"
                                  @endif
                                >
                              @else
                                <select name="result[{{$result['id']}}][result]" class="form-control select_result test_result"
                                  @if(!empty($result->reference_range()))
                                    normal_from="{{$result->reference_range()->normal_from}}"
                                    normal_to="{{$result->reference_range()->normal_to}}"
                                    critical_high_from="{{$result->reference_range()->critical_high_from}}"
                                    critical_low_from="{{$result->reference_range()->critical_low_from}}"
                                  @endif
                                >
                                  <option value="" value="" disabled selected>{{__('Select result')}}</option>
                                  @foreach($result['component']['options'] as $option)
                                    <option value="{{$option['name']}}" @if($option['name']==$result['result']) selected @endif>{{$option['name']}}</option>
                                  @endforeach
                                  <!-- Deleted option -->
                                  @if(!$result['component']['options']->contains('name',$result['result']))
                                    <option value="{{$result['result']}}" selected>{{$result['result']}}</option>
                                  @endif
                                  <!-- \Deleted option -->
                                </select>
                              @endif
                            </td>
                            <td style="width:10px" class="text-center">
                                <select name="result[{{$result['id']}}][status]" class="form-control status" data-component="{{ $result['component']['id'] }}" @if($result['component']['status']) @else style="display:none;" @endif>
                                  <option value="" value="" disabled selected>{{__('Select status')}}</option>
                                  <option value="Critical high" @if($result['status']=='Critical high') selected @endif>{{__('Critical high')}}</option>
                                  <option value="High" @if($result['status']=='High') selected @endif>{{__('High')}}</option>
                                  <option value="Normal" @if($result['status']=='Normal') selected @endif>{{__('Normal')}}</option>
                                  <option value="Low" @if($result['status']=='Low') selected @endif>{{__('Low')}}</option>
                                  <option value="Critical low" @if($result['status']=='Critical low') selected @endif>{{__('Critical low')}}</option>
                                  <!-- New status -->
                                  @if(!empty($result['status'])&&!in_array($result['status'],['High','Normal','Low','Critical high','Critical low']))
                                    <option value="{{$result['status']}}" selected>{{$result['status']}}</option>
                                  @endif
                                  <!-- \New status -->
                                </select>
                              @if($result['component']['status'])
                              @endif
                            </td>
                          </tr>
                        @endif
                      @endif
                    @endforeach
                    <tr>
                      <td colspan="5">

                        <textarea name="comment" id="" cols="30" rows="3" placeholder="{{__('Comment')}}" class="form-control comment">{{$test['comment']}}</textarea>

                        <button type="button" class="btn btn-primary btn-block btn-add-comment" data-id="{{ $test['test']['id'] }}" data-url="{{ route('admin.medical_report.add_comment') }}" data-test-id="{{$test['id']}}">{{__('Add comment')}}</button>

                        {{--<select id="select_comment_test_{{$test['id']}}" class="form-control select_comment">
                          <option value="" disabled selected>{{__('Select comment')}}</option>
                          @foreach($test['test']['comments'] as $comment)
                            <option value="{{$comment['comment']}}">{{$comment['comment']}}</option>
                          @endforeach
                        </select>--}}
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5">
                        <button class="btn btn-primary"><i class="fa fa-check"></i> {{__('Save')}}</button>
                      </td>
                    </tr>
                  </tfoot>
                </table>

              </form>
              @else
                <div class="alert alert-warning">{{__('Check Test First')}}</div>
              @endif
            </div>
            @endforeach
            <!-- /.tab-pane -->

          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      @else
      <!-- check  tests selected -->
        <h6 class="text-center">
            {{__('No data available')}}
        </h6>
        <!-- End check  tests selected -->
      @endif

    </div>
    <!-- /.card-body -->
  </div>
@endif
<!-- End tests -->

<!-- Cultures -->
@php
  $antibiotic_count=0;
@endphp
@if(count($group['all_cultures']))
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{__('Cultures')}}</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      @if(count($group['all_cultures']))
        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="taps">
              @foreach($group['all_cultures'] as $culture)
              <li class="nav-item">
                <a class="nav-link text-capitalize" href="#culture_{{$culture['id']}}" data-toggle="tab">@if($culture['done']) <i class="fa fa-check text-success"></i> @endif {{$culture['culture']['name']}}</a>
              </li>
              @endforeach
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              @foreach($group['all_cultures'] as $culture)
              <div class="tab-pane" id="culture_{{$culture['id']}}">
                <form method="POST" action="{{route('admin.medical_reports.update_culture',$culture['id'])}}" class="culture_form">
                  @csrf
                  <div class="row">
                    @foreach($culture['culture_options'] as $culture_option)
                        @if(isset($culture_option['culture_option']))
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label for="culture_option_{{$culture_option['id']}}">{{$culture_option['culture_option']['value']}}</label>
                              <select class="form-control select2" name="culture_options[{{$culture_option['id']}}]" id="culture_option_{{$culture_option['id']}}">
                                <option value="" selected>{{__('none')}}</option>
                                @foreach($culture_option['culture_option']['childs'] as $option)
                                  <option value="{{$option['value']}}" @if($option['value']==$culture_option['value']) selected @endif)>{{$option['value']}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        @endif
                    @endforeach
                  </div>

                  <div class="card card-primary">
                    <div class="card-header">
                      <h5 class="card-title">
                        {{__('Antibiotics')}}
                      </h5>
                    </div>
                    <div class="card-body p-0">
                      <div class="row">
                        <div class="col-lg-12 overflow-auto">
                            <table class="table table-striped table-bordered m-0">
                              <thead>
                                <tr>
                                  <th width="">{{__('Antibiotic')}}</th>
                                  <th width="200px">{{__('Sensitivity')}}</th>
                                  <th width="20px">
                                    <button type="button" class="btn btn-primary btn-sm"
                                      onclick="add_antibiotic('{{$select_antibiotics}}',this)">
                                      <i class="fa fa-plus"></i>
                                    </button>
                                  </th>
                                </tr>
                              </thead>
                              <tbody class="antibiotics">
                                @foreach($culture['antibiotics'] as $antibiotic)
                                  @php
                                    $antibiotic_count++;
                                  @endphp
                                <tr>
                                  <td>
                                    <select class="form-control antibiotic" name="antibiotic[{{$antibiotic_count}}][antibiotic]" required>
                                      <option value="" disabled selected>{{__('Select Antibiotic')}}</option>
                                      @foreach($select_antibiotics as $select_antibiotic)
                                      <option value="{{$select_antibiotic['id']}}"
                                        @if($select_antibiotic['id']==$antibiotic['antibiotic_id']) selected @endif>
                                        {{$select_antibiotic['name']}}</option>
                                      @endforeach
                                    </select>
                                  </td>
                                  <td>
                                    <select class="form-control" name="antibiotic[{{$antibiotic_count}}][sensitivity]" required>
                                      <option value="" disabled selected>{{__('Select Sensitivity')}}</option>
                                      <option value="{{__('High')}}" @if($antibiotic['sensitivity'] == __('High')) selected @endif>{{__('High')}}
                                      </option>
                                      <option value="{{__('Moderate')}}" @if($antibiotic['sensitivity'] == __('Moderate')) selected @endif>{{__('Moderate')}}
                                      </option>
                                      <option value="{{__('Resistant')}}" @if($antibiotic['sensitivity'] == __('Resistant')) selected @endif>{{__('Resistant')}}
                                      </option>
                                    </select>
                                  </td>
                                  <td>
                                    <button type="button" class="btn btn-danger btn-sm delete_row">
                                      <i class="fa fa-trash"></i>
                                    </button>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <td colspan="3">
                                    <textarea class="form-control comment" name="comment" id="" cols="30" rows="3" placeholder="{{__('Comment')}}">{{$culture['comment']}}</textarea>
                                    <select id="select_comment_culture_{{$culture['id']}}" class="form-control select_comment">
                                      <option value="" disabled selected>{{__('Select comment')}}</option>
                                      @foreach($culture['culture']['comments'] as $comment)
                                        <option value="{{$comment['comment']}}">{{$comment['comment']}}</option>
                                      @endforeach
                                    </select>
                                  </td>
                                </tr>

                              </tfoot>
                            </table>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <td colspan="3">
                        <button class="btn btn-primary"><i class="fa fa-check"></i> {{__('Save')}}</button>
                      </td>
                    </div>
                  </div>
                </form>
              </div>
              @endforeach
              <!-- /.tab-pane -->
            </div>
          </div>
        </div>
      @else
        <!-- Check Cultures Selected -->
        <h6 class="text-center">
          {{__('No data available')}}
        </h6>
        <!-- End Check Cultures Selected -->
      @endif
    </div>
  </div>
@endif
<!-- antibiotic count -->
<input type="hidden" id="antibiotic_count" value="{{$antibiotic_count}}">
<!-- End Cultures-->

<input type="hidden" id="patient_id" value="{{$group['patient_id']}}">




{{-- rays --}}
@if(isset($group['rays']) && $group['rays']->isNotEmpty() )
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{__('Rays')}}</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      @if(count($group['rays']))
        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="taps">
              @foreach($group['rays'] as $ray)
              <li class="nav-item">
                <a class="nav-link text-capitalize" href="#ray_{{$ray['id']}}" data-toggle="tab">@if($ray['checked']) <i class="fa fa-check text-success"></i> @endif {{$ray['ray']['name']}}</a>
              </li>
              @endforeach
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              @foreach($group['rays'] as $ray)
              <div class="tab-pane" id="ray_{{$ray['id']}}">
                {{-- <form method="POST" action="#" class="ray_form"> --}}
                <form method="POST" action="{{route('admin.medical_reports.update_ray',$ray['id'])}}" class="ray_form">
                  @csrf
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                          <label for="comment">{{__('Comment')}}</label>
                          <textarea name="comment" id="comment" cols="30" rows="10"
                              class="form-control"> @if(isset($ray->result)) <?= $ray->result->comment  ?>   @endif  </textarea>
                      </div>
                  </div>
                  </div>
                  <div class="card-footer">
                    <td colspan="3">
                      <button class="btn btn-primary"><i class="fa fa-check"></i> {{__('Save')}}</button>
                    </td>
                  </div>
                </form>
              </div>
              @endforeach
              <!-- /.tab-pane -->
            </div>
          </div>
        </div>
      @else
        <!-- Check Cultures Selected -->
        <h6 class="text-center">
          {{__('No data available')}}
        </h6>
        <!-- End Check Cultures Selected -->
      @endif
    </div>

  </div>
@endif
{{-- end rays --}}

@can('view_medical_report')
<div class="row">
  <div class="col-lg-12">

    <a href="{{route('admin.medical_reports.show',$group['id'])}}" class="btn btn-danger float-right mb-3">
      <i class="fa fa-file-pdf"></i> {{__('Print Report')}}
    </a>

    <button type="button" class="btn btn-info float-right mb-3 mr-1" data-toggle="modal" data-target="#patient_modal">
      <i class="fas fa-user-injured"></i> {{__('Patient info')}}
    </button>
    @can('sign_medical_report')
        <a class="btn btn-success float-right mb-3 mr-1" href="{{route('admin.medical_reports.review',$group['id'])}}">
            <i class="fas fa-eye" aria-hidden="true"></i>
            {{__('Review Report')}}
        </a>
    @endcan
    @can('sign_medical_report')
        <a class="btn btn-success float-right mb-3 mr-1" href="{{route('admin.medical_reports.sign',$group['id'])}}">
            <i class="fas fa-signature" aria-hidden="true"></i>
            {{__('Sign Report')}}
        </a>
    @endcan

    <a @if(isset($previous)) href="{{route('admin.medical_reports.edit',$previous['id'])}}" @endif class="btn btn-info @if(!isset($previous)) disabled @endif">
      <i class="fa fa-backward mr-2"></i>
      {{__('Previous')}}
    </a>
    <a @if(isset($next)) href="{{route('admin.medical_reports.edit',$next['id'])}}" @endif class="btn btn-success @if(!isset($next)) disabled @endif">
        {{__('Next')}}
        <i class="fa fa-forward ml-2"></i>
    </a>
  </div>
</div>
@endcan

@include('admin.medical_reports._patient_modal')

@endsection
@section('scripts')
<script src="{{url('js/admin/medical_reports.js')}}"></script>

<script>

  $('.rpcs').keyup(function(){

      var hct = $('.hct').val();

      var Hemoglobin = $('.Hemoglobin').val();

      var num = (hct / $(this).val()) * 10;
      var num2 = Hemoglobin / $(this).val() * 10

      $('.mcv').val(num.toFixed(2));
      $('.mch').val(num2.toFixed(2));

  });

  $('.PT_Time').keyup(function(){

    var isi_settings = $('#isi_settings').val();
    console.log(isi_settings);
    var controlTime = $('.Control_Time').val();

    var res = ($('.PT_Time').val() / controlTime) ** isi_settings;

    $('.INR').val(res.toFixed(2));

    var inr = $('.INR').val();
    var res2 = (1/inr)*100;

    $('.Activity').val(res2.toFixed(2));

  });


  $('.hct').keyup(function(){

      var rpcs = $('.rpcs').val();
      var Hemoglobin = $('.Hemoglobin').val();

      var num = ($(this).val() / rpcs) * 10 ;
      var num2 = Hemoglobin / $(this).val() * 100 ;

      $('.mcv').val(num.toFixed(2));
      $('.mchc').val(num2.toFixed(2));

  });

  $('.Hemoglobin').keyup(function(){

      var rpcs = $('.rpcs').val();
      var hct = $('.hct').val();

      var num = rpcs / $(this).val() * 10 ;
      var num2 = $(this).val() / hct * 100;

      $('.mch').val(num.toFixed(2));
      $('.mchc').val(num.toFixed(2));
  });
  /* ========= */

  $('.cho').keyup(function(){

    var Triglycerides = $('.Triglycerides').val();
    var hdl = (parseInt($('.hdl').val()) + parseInt(Triglycerides)) / 5;

    var num = $(this).val() - hdl;

    $('.ldl').val(num.toFixed(2));

    var ldl = $('.ldl').val();

    var num2 = $(this).val() / parseInt($('.hdl').val());
    var num3 = ldl / parseInt($('.hdl').val());

    $('.Risk1').val(num2.toFixed(2));
    $('.Risk2').val(num3.toFixed(2));


  });

  $('.Triglycerides').keyup(function(){

    var cho = $('.cho').val();
    var hdl = (parseInt($('.hdl').val()) + parseInt($(this).val())) / 5;

    var num = parseInt(cho) - hdl;

    $('.ldl').val(num.toFixed(2));

  });

  $('.hdl').keyup(function(){

    var cho = parseInt($('.cho').val());
    var Triglycerides = (parseInt($(this).val()) + parseInt($('.Triglycerides').val())) / 5;

    var num = cho - Triglycerides

    $('.ldl').val(num.toFixed(2));

    var ldl = $('.ldl').val();

    var num = cho / $(this).val();

    var num2 = ldl / $(this).val();

    $('.Risk1').val(num.toFixed(2));
    $('.Risk2').val(num2.toFixed(2));

  });

  /* ========= */
  // $('.pt').keyup(function(){

  //   var num = 12 / $(this).val();

  //   $('.Concentration').val(num.toFixed(2));

  // });

  /*=======================================*/
  $('.Lymphocytes').keyup(function(){

    var num = $('.WBCs').val() * $(this).val() / 100;

    $('.a_Lymphocytes').val(num.toFixed(2));

  });

  $('.Monocytes').keyup(function(){

    var num = $('.WBCs').val() * $(this).val() / 100;

    $('.a_Monocytes').val(num.toFixed(2));

  });

  $('.Eosinophils').keyup(function(){

    var num = $('.WBCs').val() * $(this).val() / 100;

    $('.a_Eosinophils').val(num.toFixed(2));

  });

  $('.Basophils').keyup(function(){

    var num = $('.WBCs').val() * $(this).val() / 100;

    $('.a_Basophils').val(num.toFixed(2));

  });

  $('.Neutrophil').keyup(function(){

    var num = $('.WBCs').val() * $(this).val() / 100;

    $('.a_Neutrophil').val(num.toFixed(2));

  });

  $('.Segment').keyup(function(){

    var num = $('.WBCs').val() * $(this).val() / 100;

    $('.a_Segment').val(num.toFixed(2));

  });

  $('.Band').keyup(function(){

    var num = $('.WBCs').val() * $(this).val() / 100;

    $('.a_Band').val(num.toFixed(2));

  });

  $('.WBCs').keyup(function(){

    var num1 = $('.Lymphocytes').val() * $(this).val() / 100;
    var num2 = $('.Monocytes').val() * $(this).val() / 100;
    var num3 = $('.Eosinophils').val() * $(this).val() / 100;
    var num4 = $('.Basophils').val() * $(this).val() / 100;
    var num5 = $('.Neutrophil').val() * $(this).val() / 100;
    var num6 = $('.Segment').val() * $(this).val() / 100;
    var num7 = $('.Band').val() * $(this).val() / 100;

    $('.a_Lymphocytes').val(num1.toFixed(2));
    $('.a_Monocytes').val(num2.toFixed(2));
    $('.a_Eosinophils').val(num3.toFixed(2));
    $('.a_Basophils').val(num4.toFixed(2));
    $('.a_Neutrophil').val(num5.toFixed(2));
    $('.a_Segment').val(num6.toFixed(2));
    $('.a_Band').val(num7.toFixed(2));

  });

</script>
@endsection