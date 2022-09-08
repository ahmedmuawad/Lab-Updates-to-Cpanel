<!-- Patient Info -->

 <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{__('Patient Info')}}
        </h3>
        @can('create_patient')
            <button type="button" class="btn btn-primary btn-sm add_patient float-right"  data-toggle="modal" data-target="#patient_modal">
                <i class="fa fa-exclamation-triangle"></i>  {{__('New Patient ?')}}
            </button>
        @endcan
        @can('edit_patient')
            <button type="button" class="btn btn-warning btn-sm mr-1 float-right" id="edit_patient">
                <i class="fa fa-edit"></i>  {{__('Edit patient')}}
            </button>
        @endcan
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="text-center m-0 p-0">
                            {{__('Avatar')}}
                        </h5>
                    </div>
                    <div class="card-body m-0 p-0">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="@if(isset($group)&&!empty($group['patient']['avatar'])){{url('uploads/patient-avatar/'.$group['patient']['avatar'])}}@else{{url('img/avatar.png')}}@endif" data-toggle="lightbox" data-title="Avatar">
                                    <img src="@if(isset($group)&&!empty($group['patient']['avatar'])){{url('uploads/patient-avatar/'.$group['patient']['avatar'])}}@else{{url('img/avatar.png')}}@endif"  class="img-thumbnail" id="patient_avatar" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-danger btn-sm float-right" id="delete_patient_avatar" style="width:100%" patient_id="@if(isset($patient)){{$patient['id']}}@endif">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Code')}}</label>
                            <select id="code" name="patient_id" class="form-control" required>
                                @if(isset($group)&&isset($group['patient']))
                                    <option value="{{$group['patient']['id']}}" selected>{{$group['patient']['code']}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Prefix')}}</label>
                            <input class="form-control" id="prefix" @if(isset($group)&&isset($group['patient'])) value=" {{__($group['patient']['prefix']) ?? '' }} " @endif readonly>

                            <!-- <select id="prefix" name="prefix" id="prefix" class="form-control" required>
                                @if(isset($group)&&isset($group['patient']))
                                    <option value="{{$group['patient']['prefix']}}" selected>{{$group['patient']['prefix']}}</option>
                                @endif
                            </select> -->
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Name')}}</label>
                            <select id="name" name="patient_id" class="form-control" required>
                                @if(isset($group)&&isset($group['patient']))
                                    <option value="{{$group['patient']['id']}}" selected>{{$group['patient']['name']}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Nationality')}}</label>
                            <input class="form-control" id="nationality" @if(isset($group)&&isset($group['patient'])) value=" {{$group['patient']['country']['nationality'] ?? '' }} " @endif readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('National ID')}}</label>
                            <input class="form-control" id="national_id" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['national_id']}}" @endif readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Passport No.')}}</label>
                            <input class="form-control" id="passport_no" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['passport_no']}}" @endif readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Date of birth')}}</label>
                            <input class="form-control" id="dob" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['dob']}}" @endif readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Age')}}</label>
                            <input class="form-control" id="age" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['age']}}" @endif readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Phone')}}</label>
                            <input class="form-control" id="phone" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['phone']}}" @endif  readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Phone')}} 2</label>
                            <input class="form-control" id="phone2" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['phone2']}}" @endif  readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Email')}}</label>
                            <input class="form-control" id="email" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['email']}}" @endif readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Gender')}}</label>
                            <input class="form-control" id="gender" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['gender']}}" @endif readonly>
                        </div>
                    </div>
                    <div class="col-lg-3 d-none date_pms">
                        <div class="form-group">
                            <label>{{__('Date PMS')}}</label>
                            <input class="form-control" id="date_pms" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['date_pms']}}" @endif readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Address')}}</label>
                            <input class="form-control" id="address" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['address']}}" @endif readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Hours Fasting')}}</label>
                            <input class="form-control" id="hours_fasting" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['hours_fasting']}}" @endif readonly>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Type Doctor')}}</label>
                            <select class="form-control" name="doctor_type" id="type_doctor">
                                <option selected disabled label=""></option>
                                <option @if (isset($group)&&isset($group['doctor'])) selected @endif value="0">{{ __('Doctor with commission') }}</option>
                                <option @if (isset($group)&&isset($group['normalDoctor'])) selected @endif value="1">{{ __('Normal Doctor') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 @if (isset($group)&&isset($group['doctor'])) d-block @else d-none @endif doctor">
                        <div class="form-group">
                            <label>{{__('Doctor')}}</label>
                            @can('create_doctor')
                                <button type="button" class="btn btn-primary btn-sm float-right"  data-toggle="modal" data-target="#doctor_modal"><i class="fa fa-exclamation-triangle"></i> {{__('New Doctor ?')}}</button>
                            @endcan
                            <select class="form-control" name="doctor_id" id="doctor">
                                @if(isset($group)&&isset($group['doctor']))
                                    <option value="{{$group['doctor']['id']}}" selected>{{$group['doctor']['name']}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 @if (isset($group)&&isset($group['normalDoctor'])) d-block @else d-none @endif  normal_doctor">
                        <div class="form-group">
                            <label>{{__('Normal Doctor')}}</label>
                            @can('create_doctor')
                                <button type="button" class="btn btn-primary btn-sm float-right"  data-toggle="modal" data-target="#normal_doctor_modal"><i class="fa fa-exclamation-triangle"></i> {{__('New Normal Doctor ?')}}</button>
                            @endcan
                            <select class="form-control" name="normal_doctor_id" id="normal_doctor">
                                @if(isset($group)&&isset($group['normalDoctor']))
                                    <option value="{{$group['normalDoctor']['id']}}" selected>{{$group['normalDoctor']['name']}}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="d-block">{{__('Contract')}}</label>
                            <button type="button" class="btn btn-danger btn-xs float-right cancel_contract @if(!isset($group)||!isset($group['contract'])) disabled @endif">
                                {{__('Cancel')}}
                            </button>
                            <button type="button" class="mb-1 btn btn-success btn-xs float-right mr-1 ml-1 apply_contract @if(!isset($group)||isset($group['contract'])) disabled @endif">
                                {{__('Apply')}}
                            </button>
                            <input type="hidden" name="contract_id" id="contract_id" @if(isset($group)&&isset($group['contract'])&&!$group->contract->trashed()) value="{{$group['contract']['id']}}" @endif readonly>
                            <!-- <input type="text" class="form-control" id="contract_title" @if(isset($group)&&isset($group['contract'])&&!$group->contract->trashed()) value="{{$group['contract']['title']}}" @endif readonly> -->
                            <select name="" id="contract_title" data-url="{{ route('admin.update_patient_contract_id') }}" class="form-control" style="
                            width: 60%;">
                                <option label=""></option>
                                @foreach($contracts as $contract)
                                    <option value="{{ $contract->id }}">{{ $contract->title }}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>
                    <div class="col-lg-3 lab-to-lab d-none @if(isset($group) AND $group->contract != null) @if($group->contract->type == 'lab_to_lab') d-block @endif @endif">
                        <div class="form-group">
                            <label for="government_id">{{__('Government')}}</label>
                            <select name="government_id" id="government_id" class="form-control">
                                <option></option>
                                @foreach($governments as $government)
                                    <option @if(isset($group)) @if($government->id == $group->government_id) selected @endif @endif value="{{ $government->id }}">{{ $government->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 lab-to-lab d-none @if(isset($group) AND $group->contract != null) @if($group->contract->type == 'lab_to_lab') d-block @endif @endif">
                        <div class="form-group">
                            <label for="region_id">{{__('Region')}}</label>
                            <select name="region_id" id="region_id" class="form-control">
                                <option></option>
                                @if(isset($group)&&$group['government_id'])
                                    <option value="{{$group['region_id']}}" selected>{{$group->region->name}}</option>
                                @endif
                            </select>

                        </div>
                    </div>

                    <div class="col-lg-3 lab-to-lab d-none @if(isset($group) AND $group->contract != null) @if($group->contract->type == 'lab_to_lab') d-block @endif @endif">
                        <div class="form-group">
                            <label for="user_id">{{__('Lab')}}</label>
                            <select name="user_id" id="user_id" class="form-control select2">
                                @if(isset($group)&&$group['government_id'])
                                    @if (isset($group->user))
                                    <option value="{{$group['user_id']}}" selected>{{$group->user->lab_code}} - {{$group->user->name}}</option>
                                    @endif
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 lab-to-lab d-none @if(isset($group) AND $group->contract != null) @if($group->contract->type == 'lab_to_lab') d-block @endif @endif">
                        <div class="form-group">
                            <label for="rep_id">{{__('Representative')}}</label>
                            <select name="rep_id" id="rep_id" class="form-control">
                                <option></option>
                                @if(isset($group)&&$group['government_id'])
                                    <option value="{{$group['rep_id']}}" selected>{{$group->representative->name}}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Sample collection date')}}</label>
                            <input type="text" class="form-control flatpickr" name="sample_collection_date" id="sample_collection_date" @if(isset($group)) value="{{$group['sample_collection_date']}}" @else value="{{date('y-m-d h:i')}}" @endif>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>{{__('Invoice date')}}</label>

                            <input type="text" class="form-control flatpickr" name="created_at" id="created_at" @if(isset($group)) value="{{$group['created_at']}}" @else value="{{date('y-m-d h:i')}}" @endif>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="form-group">
                            <label> Branch </label>

                            <input type="text" class="form-control" name="" id=""  value="{{session('branch_name')}}" disabled>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <h6>{{__('Diseases suffered by the patient')}}</h6>
                    </div>
                        <div class="row">
                    {{-- Start Questions --}}
                    {{-- Fluid Patient --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input @if(isset($group)&&isset($group['patient'])) checked @endif" name="fluid_patient" id="fluid_patient"  type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    {{__('Hemophilia')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Diabetic --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="diabetic" id="diabetic" {{ isset($group['patient']) && $group['patient']['diabetic'] == 1 ? 'checked' : '' }}  type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    {{__('Diabetic')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- gland --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="gland" id="gland" {{ isset($group['patient']) && $group['patient']['gland'] == 1 ? 'checked' : '' }}  type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    {{__('gland')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- tumors --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="tumors" id="tumors" {{ isset($group['patient']) && $group['patient']['tumors'] == 1 ? 'checked' : '' }}  type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    {{__('tumors')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- antibiotic --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="antibiotic" id="antibiotic" {{ isset($group['patient']) && $group['patient']['antibiotic'] == 1 ? 'checked' : '' }}  type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    {{__('antibiotic')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- iron --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="iron" id="iron" {{ isset($group['patient']) && $group['patient']['iron'] == 1 ? 'checked' : '' }}  type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    {{__('iron')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- cortisone --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="cortisone" id="cortisone" {{ isset($group['patient']) && $group['patient']['cortisone'] == 1 ? 'checked' : '' }}  type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    {{__('cortisone')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Liver Patient --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="liver_patient" id="liver_patient" {{ isset($group['patient']) && $group['patient']['liver_patient'] == 1 ? 'checked' : '' }}  type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    {{__('Liver Patient')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Pregnant --}}
                    {{-- <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="pregnant" {{ isset($group['patient']) && $group['patient']['pregnant'] == 1 ? 'checked' : '' }} id="pregnant" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    {{__('Pregnant')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- Other --}}
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="{{__('Other')}}" @if(isset($group)&&isset($group['patient']['answer_other'])) value="{{$group['patient']['answer_other']}}" @endif id="answer_other" style="height: 50px">{{ isset($group['patient']) && $group['patient']['answer_other'] ? $group['patient']['answer_other'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                {{-- End   Questions --}}
</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /patient info-->

<!-- Tests -->
<div class="row">
    <div class="col-lg-4">
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">
                    {{__('Tests')}}
                </h5>
            </div>
            <div class="card-header">
                <select name="" id="select_test" class="form-control"></select>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th width="40%">
                                {{__('Name')}}
                            </th>
                            <th width="20%">
                                {{__('Category')}}
                            </th>
                            <th>
                                {{__('Price')}}
                            </th>
                            <th>
                                {{__('In/Out')}}
                            </th>
                            <th>
                                {{__('Cost')}}
                            </th>
                            <th width="10px">
                            </th>
                        </tr>
                    </thead>
                    <tbody id="selected_tests">
                        @if(isset($group))
                            @foreach($group['tests'] as $test)
                            <tr class="selected_test" id="test_{{$test['test_id']}}" default_price="{{$test['test']['test_price']['price']}}">
                                <td>
                                   {{$test['test']['name']}}
                                   <input type="hidden" class="tests_id" name="tests[{{$test['test_id']}}][id]" value="{{$test['test_id']}}">
                                </td>
                                <td>
                                    {{$test['test']['category']['name']}}
                                </td>
                                <td class="test_price">
                                    {{$test['price']}}
                                </td>
                                <td >
                                    {{$test['lab_to_lab_status']}}
                                </td>
                                <td >
                                    {{$test['lab_to_lab_cost']}}
                                </td>
                                <td>
                                   <button type="button" class="btn btn-danger btn-sm delete_selected_row">
                                      <i class="fa fa-trash"></i>
                                   </button>
                                </td>
                                <input type="hidden" class="price" name="tests[{{$test['test_id']}}][price]" value="{{$test['price']}}">
                                <input type="hidden" class="cost_lab_to_lab" name="tests[{{$test['test_id']}}][cost]" value="{{$test['lab_to_lab_cost']}}">
                             </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">
                    {{__('Cultures')}}
                </h5>
            </div>
            <div class="card-header">
                <select name="" id="select_culture" class="form-control"></select>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th width="40%">
                                {{__('Name')}}
                            </th>
                            <th width="20%">
                                {{__('Category')}}
                            </th>
                            <th>
                                {{__('Price')}}
                            </th>
                            <th>
                                {{__('In/Out')}}
                            </th>
                            <th>
                                {{__('Cost')}}
                            </th>
                            <th width="10px">
                            </th>
                        </tr>
                    </thead>
                    <tbody id="selected_cultures">
                        @if(isset($group))
                            @foreach($group['cultures'] as $culture)
                            <tr class="selected_culture" id="culture_{{$culture['culture_id']}}" default_price="{{$culture['culture']['culture_price']['price']}}">
                                <td>
                                    {{$culture['culture']['name']}}
                                    <input type="hidden" class="cultures_id" name="cultures[{{$culture['culture_id']}}][id]" value="{{$culture['culture_id']}}">
                                </td>
                                <td>
                                    {{$culture['culture']['category']['name']}}
                                </td>
                                <td class="culture_price">
                                    {{$culture['price']}}
                                </td>
                                <td>
                                    {{$culture['lab_to_lab_status']}}
                                </td>
                                <td>
                                    {{$culture['lab_to_lab_cost']}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm delete_selected_row">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                <input type="hidden" class="price" name="cultures[{{$culture['culture_id']}}][price]" value="{{$culture['price']}}">
                                <input type="hidden" class="cost_lab_to_lab" name="cultures[{{$culture['culture_id']}}][cost]" value="{{$culture['lab_to_lab_cost']}}">
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">
                    {{__('Packages')}}
                </h5>
            </div>
            <div class="card-header">
                <select name="" id="select_package" class="form-control"></select>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th width="50%">
                                {{__('Name')}}
                            </th>
                            <th>
                                {{__('Price')}}
                            </th>
                            <th>
                                {{__('In/Out')}}
                            </th>
                            <th>
                                {{__('Cost')}}
                            </th>
                            <th width="10px">
                            </th>
                        </tr>
                    </thead>
                    <tbody id="selected_packages">
                        @if(isset($group))
                            @foreach($group['packages'] as $package)
                            <tr class="selected_package" id="package_{{$package['package_id']}}" default_price="{{$package['package']['package_price']['price']}}">
                                <td>
                                   {{$package['package']['name']}}
                                    <input type="hidden" class="packages_id" name="packages[{{$package['package_id']}}][id]" value="{{$package['package_id']}}">
                                </td>
                                <td class="package_price">
                                    {{$package['price']}}
                                </td>
                                <td>
                                    {{$package['lab_to_lab_status']}}
                                </td>
                                <td>
                                    {{$package['lab_to_lab_cost']}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm delete_selected_row">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                <input type="hidden" class="price" name="packages[{{$package['package_id']}}][price]" value="{{$package['price']}}">
                                <input type="hidden" class="cost_lab_to_lab" name="packages[{{$package['package_id']}}][cost]" value="{{$package['lab_to_lab_cost']}}">

                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- \Tests -->

{{-- <!-- test -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-danger">
            <div class="card-header">
                <h5 class="card-title">
                    {{__('Tests')}}
                </h5>
            </div>
            <div class="card-body tests">
                <table class="table table-striped table-sm invoice-datatable" width="100%">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th width="10px">#</th>
                            <th>{{__('Test Name')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Price')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tests as $test)
                            <tr>
                                <td class="order">

                                </td>
                                <td>
                                    <input type="checkbox"  class="test" id="test_{{$test['id']}}" value="{{$test['id']}}" price="{{$test['test_price']['price']}}" default_price="{{$test['test_price']['price']}}">
                                </td>
                                <td>
                                    <label for="test_{{$test['id']}}">{{$test['name']}}</label>
                                </td>
                                <td>
                                    {{$test['category']['name']}}
                                </td>
                                <td class="table_price">
                                    {{formated_price($test['test_price']['price'])}}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
       <div class="card card-danger">
           <div class="card-header">
               <h5 class="card-title text-center">
                   {{__('Cultures')}}
               </h5>
           </div>
           <div class="card-body cultures">
                <table class="table table-striped table-sm invoice-datatable" width="100%">
                    <thead>
                        <tr>
                            <td>Order</td>
                            <th width="10px">#</th>
                            <th>{{__('Culture Name')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Price')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cultures as $culture)
                            <tr>
                                <td class="order">

                                </td>
                                <td>
                                    <input type="checkbox" class="culture" id="culture_{{$culture['id']}}" value="{{$culture['id']}}" price="{{$culture['culture_price']['price']}}" default_price="{{$culture['culture_price']['price']}}">
                                </td>
                                <td>
                                    <label for="culture_{{$culture['id']}}">{{$culture['name']}}</label>
                                </td>
                                <td>
                                    {{$culture['category']['name']}}
                                </td>
                                <td class="table_price">
                                    {{formated_price($culture['culture_price']['price'])}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>
       </div>
    </div>

    <div class="col-lg-12">
        <div class="card card-danger">
            <div class="card-header">
                <h5 class="card-title text-center">
                    {{__('Packages')}}
                </h5>
            </div>
            <div class="card-body packages">
                 <table class="table table-striped table-sm invoice-datatable" width="100%">
                     <thead>
                         <tr>
                             <td>Order</td>
                             <th width="10px">#</th>
                             <th>{{__('Package name')}}</th>
                             <th>{{__('Price')}}</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($packages as $package)
                             <tr>
                                <td class="order">

                                </td>
                                <td>
                                    <input type="checkbox" class="package" id="package_{{$package['id']}}" value="{{$package['id']}}" price="{{$package['package_price']['price']}}" default_price="{{$package['package_price']['price']}}">
                                </td>
                                <td>
                                    <label for="package_{{$package['id']}}">{{$package['name']}}</label>
                                </td>
                                <td class="table_price">
                                    {{formated_price($package['package_price']['price'])}}
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
            </div>
        </div>
    </div>
 </div>
<!-- \End test --> --}}

<div class="row">
    <div class="col-lg-6">
        <!-- Receipt -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    {{__('Receipt')}}
                </h3>
            </div>
            <div class="card-body p-0" id="receipt">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table  table-stripped" id="receipt_table">
                            <tbody>

                                <tr>
                                    <td width="100px">{{__('Subtotal')}}</td>
                                    <td width="300px">
                                        <input type="number" id="subtotal" name="subtotal"  @if(isset($group)) value="{{$group['subtotal']}}" @else value="0"  @endif readonly class="form-control">
                                    </td>
                                    <td>
                                        {{get_currency()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td>{{__('Discount')}}</td>
                                    <td>
                                        <input type="number" class="form-control" id="discount" name="discount"  @if(isset($group)) value="{{$group['discount']}}" @else value="0"  @endif>
                                    </td>
                                    <td>
                                       <!-- {{get_currency()}}-->
                                       %
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" id="discount_value" name="discount_value"  @if(isset($group)) value="{{$group['discount_value']}}" @else value="0"  @endif>
                                    </td>
                                </tr>

                                <tr>
                                    <td>{{__('Total')}}</td>
                                    <td>
                                        <input type="number" id="total" name="total" class="form-control" @if(isset($group)) value="{{$group['total']}}" @else value="0"  @endif  readonly>
                                    </td>
                                    <td>
                                        {{get_currency()}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('Paid')}}</td>
                                    <td>
                                        <input type="number" id="paid" name="paid" min="0" class="form-control" @if(isset($group)) value="{{$group['paid']}}" @else value="0"  @endif  readonly required>
                                    </td>
                                    <td>
                                        {{get_currency()}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('Due')}}</td>
                                    <td>
                                        <input type="number" id="due" name="due" class="form-control" @if(isset($group)) value="{{$group['due']}}" @else value="0"  @endif   readonly>
                                    </td>
                                    <td>
                                        {{get_currency()}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('Lab To Lab Cost')}}</td>
                                    <td>
                                        <input type="number" id="lab_cost" name="cost" class="form-control" @if(isset($group)) value="{{$group['cost']}}" @else value="0"  @endif>
                                    </td>
                                    <td>
                                        {{get_currency()}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('After Lab To Lab')}}</td>
                                    <td>
                                        <input type="number" id="after_lab" name="total_after_cost" class="form-control" @if(isset($group)) value="{{$group['total_after_cost']}}" @else value="0"  @endif  readonly>
                                    </td>
                                    <td>
                                        {{get_currency()}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- \Receipt -->
    </div>
    <div class="col-lg-6">
        <!-- Payments -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="card-title">
                            {{__('Payments')}}
                        </h5>
                        <button type="button" class="btn btn-primary d-inline float-right" id="add_payment">
                            <i class="fa fa-plus"></i> {{__('Payment')}}
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-warning d-inline" id="create_payment_method_button" data-toggle="modal" data-target="#create_payment_method_modal">
                            <i class="fa fa-plus"></i> {{__('Payment method')}}
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        @php
                            $payments_count=0;
                        @endphp
                        <table class="table table-striped table-bordered" id="payments_table">
                            <thead>
                                <th width="30%">{{__('Date')}}</th>
                                <th width="30%">{{__('Amount')}}</th>
                                <th>{{__('Payment method')}}</th>
                                <th width="10px"></th>
                            </thead>
                            <tbody>
                                @if(isset($group))
                                    @foreach($group['payments'] as $payment)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control new_datepicker" name="payments[{{$payments_count}}][date]" value="{{$payment['date']}}" placeholder="{{__('Date')}}" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control amount" name="payments[{{$payments_count}}][amount]" value="{{$payment['amount']}}" id="" required>
                                        </td>
                                        <td>
                                            <select name="payments[{{$payments_count}}][payment_method_id]" id="" class="form-control payment_method_id" required>
                                                <option value="" disabled selected>{{__('Select payment method')}}</option>
                                                <option value="{{$payment['payment_method_id']}}" @if($payment['payment_method_id'] == 1) selected @endif>{{$payment['payment_method']['name']}}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete_payment">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @php
                                        $payments_count++;
                                    @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <input type="hidden" id="payments_count" value="{{$payments_count}}">
                    </div>
                </div>
            </div>
        </div>
        <!--\Payments -->
    </div>

</div>


<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <button type="submit" class="btn btn-primary form-control">{{__('Save')}}</button>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <a href="{{route('admin.groups.index')}}" class="btn btn-danger form-control cancel_form">{{__('Cancel')}}</a>
    </div>
</div>

<br>
