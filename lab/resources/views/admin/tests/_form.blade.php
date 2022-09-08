<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">{{__('Category')}}</label>
            <select name="category_id" class="form-control" id="category" required>
                @if(isset($test) && $test['category'])
                    <option value="{{$test['category_id']}}" selected>{{$test['category']['name']}}</option>
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-3">
      <div class="form-group">
        <label for="name">{{__('Name')}}</label>
        <input type="text" class="form-control" name="name" id="name" @if(isset($test)) value="{{$test->name}}" @endif required>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="form-group">
        <label for="shortcut">{{__('Shortcut')}}</label>
        <input type="text" class="form-control" name="shortcut" id="shortcut" @if(isset($test)) value="{{$test->shortcut}}" @endif required>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="form-group">
        <label for="sample_type">{{__('Sample Type')}}</label>
        <input type="text" class="form-control" name="sample_type" id="sample_type" @if(isset($test)) value="{{$test->sample_type}}" @endif required>
      </div>
    </div>
    <div class="col-lg-3">
       <div class="form-group">
            <label for="price">{{__('Price')}}</label>
            <div class="input-group form-group mb-3">
                <input type="number" class="form-control" name="price" min="0" id="price" @if(isset($test)) value="{{$test->price}}" @endif required>
                <div class="input-group-append">
                <span class="input-group-text">
                    {{get_currency()}}
                </span>
                </div>
            </div>
       </div>
    </div>
    <div class="col-lg-3">
       <div class="form-group">
            <label for="num_day_receive">{{__('Num Day Receive')}}</label>
            <div class="input-group form-group mb-3">
                <input type="number" class="form-control" name="num_day_receive" min="0" step="1" id="num_day_receive" value="{{isset($test) ? $test->num_day_receive : 0 }}" required>
            </div>
       </div>
    </div>
    <div class="col-lg-3">
       <div class="form-group">
            <label for="num_hour_receive">{{__('Num Hour Receive')}}</label>
            <div class="input-group form-group mb-3">
                <input type="number" class="form-control" name="num_hour_receive" min="0" step="1" id="num_hour_receive" value="{{isset($test) ? $test->num_hour_receive : 1 }}" required>
            </div>
       </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
             <label for="num_day_receive">{{__('Lab To Lab Status')}}</label>
             <div class="input-group form-group mb-3">
                 <select name="lab_to_lab_status" class="form-control" id="lab_status">
                     <option value="0" @if(isset($test)) @if($test['lab_to_lab_status'] == 0) selected  @endif @endif>{{ __('IN') }}</option>
                     <option value="1" @if(isset($test)) @if($test['lab_to_lab_status'] == 1) selected  @endif @endif>{{ __('Out') }}</option>
                 </select>
             </div>
        </div>
     </div>

     <div class="col-lg-3 lab_cost @if (isset($test)) @if ($test['lab_to_lab_status'] == 0) d-none @else d-block  @endif @else d-none  @endif">
        <div class="form-group">
            <label for="lab_to_lab_cost">{{__('Lab To Lab Cost')}}</label>
            <div class="input-group form-group mb-3">
                <input type="number" class="form-control" id="lab_to_lab_cost" name="lab_to_lab_cost" @if(isset($test))value="{{$test['lab_to_lab_cost']}}" @endif  required>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
             <label for="precautions">{{__('Precautions')}}</label>
             <textarea name="precautions" id="precautions" rows="3" class="form-control" placeholder="{{__('Precautions')}}">@if(isset($test)){{$test['precautions']}}@endif</textarea>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
             <label for="details">{{__('Details')}}</label>
             <textarea name="details" id="details" rows="3" class="form-control" placeholder="{{__('details')}}">@if(isset($test)){{$test['details']}}@endif</textarea>
        </div>
    </div>

    <div class="col-12">
        <div id="accordion">

            <div class="card card-info">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary mb-2 collapsed"
                   aria-expanded="false">
                    <i class="fas fa-dollar-sign"></i> {{ __('Contract Price') }}
                </a>
                {{-- get all contract --}}
                <div id="collapseOne" class="row pl-2 panel-collapse in collapse">
                    @foreach ($contracts as $key => $contract)

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="contract_id">{{ $contract->title }}</label>
                                <input type="hidden" class="form-control" name="contract_id[]" multiple id="contract_id" value="{{ $contract->id }}" required>

                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="price_contract">{{__('Price')}}</label>
                                <div class="input-group form-group mb-3">
                                    <input type="number" class="form-control" name="price_contract[]" multiple min="1" step="1" id="price_contract" value="{{isset($test) ? $test->contract_prices[$key]['price'] : 1 }}" required>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>

                {{-- get all contract --}}

            </div>

        </div>
    </div>


</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">{{__('Test Components')}}</h3>
                <ul class="list-style-none">
                    <li class="d-inline float-right">
                        <button type="button" class="btn btn-primary btn-sm add_component">
                            <i class="fa fa-plus"></i>
                            {{__('Component')}}
                        </button>
                    </li>
                    <li class="d-inline float-right mr-1">
                        <button type="button" class="btn btn-primary btn-sm  add_title">
                            <i class="fa fa-plus"></i>
                            {{__('Title')}}
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class=" table table-striped table-bordered components">
                            <thead  >
                                <th class="text-center name">{{__('Name')}}</th>
                                <th class="text-center unit">{{__('Unit')}}</th>
                                <th class="text-center result">{{__('Result')}}</th>
                                <th class="text-center reference_ranges">{{__('Reference Range')}}</th>
                                <th class="text-center separated">{{__('Separated')}}</th>
                                <th class="text-center status">{{__('Status')}}</th>
                                <th width="10px"></th>
                            </thead>
                            <tbody class="items">
                                @php
                                  $count=0;
                                  $count_reference_ranges=0;
                                  $count_comments=0;
                                @endphp
                                @if(isset($test))
                                    @foreach($test['components'] as $component)
                                        @php
                                            $count++;
                                        @endphp
                                        <tr num="{{$count}}" test_id="{{$component['id']}}">
                                            @if($component['title'])
                                                <td colspan="6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="component[{{$count}}][title]" value="true">
                                                        <input type="hidden" name="component[{{$count}}][id]" value="{{$component['id']}}">
                                                        {{$component['id']}}
                                                        <input type="text" class="form-control" name="component[{{$count}}][name]" placeholder="{{__('Name')}}" value="{{$component['name']}}" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delete_row">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="form-group">
                                                        <input type="hidden" name="component[{{$count}}][id]" value="{{$component['id']}}">
                                                        {{$component['id']}}
                                                        <input type="text" class="form-control" name="component[{{$count}}][name]" placeholder="{{__('Name')}}" value="{{$component['name']}}" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="component[{{$count}}][unit]" placeholder="{{__('Unit')}}" value="{{$component['unit']}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul class="p-0 list-style-none">
                                                        <li>
                                                            <input class="select_type" value="text" type="radio" name="component[{{$count}}][type]" id="text_{{$count}}" @if($component['type']=='text') checked @endif required> <label for="text_{{$count}}">{{__('Text')}}</label>
                                                        </li>
                                                        <li>
                                                            <input class="select_type" value="select" type="radio" name="component[{{$count}}][type]" id="select_{{$count}}" @if($component['type']=='select') checked @endif required> <label for="select_{{$count}}">{{__('Select')}}</label>
                                                        </li>
                                                    </ul>
                                                    <div class="options">
                                                        @if($component['type']=='select')
                                                        <table width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('Option')}}</th>
                                                                    <th width="10px" class="text-center">
                                                                        <button type="button" class="btn btn-primary btn-sm add_option">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </th>
                                                                </tr>
                                                            </head>
                                                            <tbody>
                                                            @foreach($component['options'] as $option)
                                                                <tr option_id="{{$option['id']}}">
                                                                    <td>
                                                                        <input type="text" name="component[{{$count}}][old_options][{{$option['id']}}]" value="{{$option['name']}}" class="form-control" required>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-danger btn-sm text-center delete_option">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <table class="table table-bordered reference_range">
                                                        <thead>
                                                            <tr>
                                                              <th class="gender text-center">{{__('Gender')}}</th>
                                                              <th class="age_unit text-center">{{__('Age unit')}}</th>
                                                              <th class="age_from text-center">{{__('Age')}}</th>
                                                              <th class="age text-center">{{__('Critical low')}}</th>
                                                              <th class="age text-center">{{__('Normal')}}</th>
                                                              <th class="age text-center">{{__('Critical high')}}</th>
                                                              <th width="10px">
                                                                <button type="button" class="btn btn-sm btn-primary add_range">
                                                                  <i class="fa fa-plus"></i>
                                                                </button>
                                                              </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($component['reference_ranges'] as $reference_range)
                                                                @php $count_reference_ranges++ @endphp
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <select class="form-control" name="component[{{$count}}][reference_ranges][{{$count_reference_ranges}}][gender]" required>
                                                                            <option value="both" @if($reference_range['gender']=='both') selected @endif>{{__('Both')}}</option>
                                                                            <option value="male" @if($reference_range['gender']=='male') selected @endif>{{__('Male')}}</option>
                                                                            <option value="female" @if($reference_range['gender']=='female') selected @endif>{{__('Female')}}</option>
                                                                            <option value="pregnant" @if($reference_range['gender']=='pregnant') selected @endif>{{__('Pregnant')}}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <select class="form-control" name="component[{{$count}}][reference_ranges][{{$count_reference_ranges}}][age_unit]" required>
                                                                            <option value="day" @if($reference_range['age_unit']=='day') selected @endif>{{__('Days')}}</option>
                                                                            <option value="month" @if($reference_range['age_unit']=='month') selected @endif>{{__('Months')}}</option>
                                                                            <option value="year" @if($reference_range['age_unit']=='year') selected @endif>{{__('Years')}}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <input type="number" name="component[{{$count}}][reference_ranges][{{$count_reference_ranges}}][age_from]" class="form-control" value="{{$reference_range['age_from']}}" required>:
                                                                        <input type="number" name="component[{{$count}}][reference_ranges][{{$count_reference_ranges}}][age_to]" class="form-control" value="{{$reference_range['age_to']}}" required>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <input type="text" name="component[{{$count}}][reference_ranges][{{$count_reference_ranges}}][critical_low_from]" class="form-control" value="{{$reference_range['critical_low_from']}}">
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <input type="text" name="component[{{$count}}][reference_ranges][{{$count_reference_ranges}}][normal_from]" class="form-control" value="{{$reference_range['normal_from']}}">:
                                                                        <input type="text" name="component[{{$count}}][reference_ranges][{{$count_reference_ranges}}][normal_to]" class="form-control" value="{{$reference_range['normal_to']}}">
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <input type="text" name="component[{{$count}}][reference_ranges][{{$count_reference_ranges}}][critical_high_from]" class="form-control" value="{{$reference_range['critical_high_from']}}">
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <button type="button" class="btn btn-sm btn-danger delete_range">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="component[{{$count}}][reference_range]" placeholder="{{__('Reference Range')}}">{!!$component['reference_range']!!}</textarea>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input class="check_separated" num="{{$count}}" type="checkbox" name="component[{{$count}}][separated]" @if($component['separated']) checked @endif>
                                                    <div class="component_price">
                                                        @if($component['separated'])
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h5 class="card-title">
                                                                {{__('Price')}}
                                                                </h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="input-group form-group mb-3">
                                                                    <input type="number" class="form-control" name="component[{{$count}}][price]" value="{{$component['price']}}" min="0" class="price" required>
                                                                    <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        {{get_currency()}}
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input  type="checkbox" name="component[{{$count}}][status]" @if($component['status']) checked @endif>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delete_row">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <ul class="list-style-none">
                    <li class="d-inline float-right">
                        <button type="button" class="btn btn-primary btn-sm add_component">
                            <i class="fa fa-plus"></i>
                            {{__('Component')}}
                        </button>
                    </li>
                    <li class="d-inline float-right mr-1">
                        <button type="button" class="btn btn-primary btn-sm  add_title">
                            <i class="fa fa-plus"></i>
                            {{__('Title')}}
                        </button>
                    </li>
                </ul>
            </div>
         </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">
                    {{__('Result comments')}}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped table-bordered" id="comments_table">
                            <thead>
                                <tr>
                                    <th>{{__('Comment')}}</th>
                                    <th>{{__('Component')}}</th>
                                    <th>{{__('Case')}}</th>
                                    <th width="10px">
                                        @if(isset($test) && $test->id == 473)
                                        @else
                                        <button type="button" class="btn btn-primary float-right add_comment" data-id="{{ isset($test) ? $test->id : '' }}" data-url="{{ route('admin.get_component') }}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($test))
                                    @foreach($test['comments'] as $comment)
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comments[{{$count_comments}}]" class="form-control" id="" cols="30" rows="3" required>{{$comment['comment']}}</textarea>
                                                </div>
                                            </td>
                                            @foreach($comment->components as $com)
                                            <tr>
                                            <td class="append_comment">
                                                <div class="form-group">
                                                    <select name="component_id[{{$count_comments}}]" class="form-control" id="">
                                                        <option value="">{{__('Select component')}}</option>
                                                        @foreach($test['components'] as $component)
                                                            <option value="{{$component['id']}}" @if($component['id'] == $com->component_id) selected @endif>{{$component['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" id="" name="case[{{$count_comments}}]">
                                                        <option value="1" @if(1 == $com->case_id)) selected @endif>Normal</option>
                                                        <option value="2" @if(2 == $com->case_id)) selected @endif>High</option>
                                                        <option value="3" @if(3 == $com->case_id)) selected @endif>Low</option>
                                                        <option value="4" @if(4 == $com->case_id)) selected @endif>Critical high</option>
                                                        <option value="5" @if(5 == $com->case_id)) selected @endif>Critical low</option>
                                                    </select>
                                                </div>
                                            </td>
                                            </tr>
                                            <hr>
                                            @endforeach
                                            @if(isset($test) && $test->id == 473)
                                            @else
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm delete_comment">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button type="button" class="btn btn-info btn-sm add_componentid" data-id="{{ $test->id }}" data-url="{{ route('admin.get_component') }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                            @endif
                                        </tr>
                                        @php
                                            $count_comments++;
                                        @endphp
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>{{__('Comment')}}</th>
                                    <th>{{__('Component')}}</th>
                                    <th>{{__('Case')}}</th>
                                    <th width="10px">
                                        @if(isset($test) && $test->id == 473)
                                        @else
                                        <button type="button" class="btn btn-primary float-right add_comment" data-id="{{ isset($test) ? $test->id : '' }}" data-url="{{ route('admin.get_component') }}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        @endif
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="" id="count" value="{{$count}}">
<input type="hidden" name="" id="count_reference_ranges" value="{{$count_reference_ranges}}">
<input type="hidden" name="" id="count_comments" value="{{$count_comments}}">


@php
    $consumption_count=0
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title">
                    {{__('Consumptions')}}
                </h5>
                <button type="button" class="btn btn-primary float-right add_consumption">
                   <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>{{__('Product')}}</th>
                            <th width="100px">{{__('Quantity')}}</th>
                            <th width="10px"></th>
                        </tr>
                    </thead>
                    <tbody class="test_consumptions">
                      @if(isset($test))
                        @foreach($test['consumptions'] as $consumption)
                            @php
                                $consumption_count++;
                            @endphp
                            <tr class="consumption_row">
                                <td>
                                    <div class="form-group">
                                        <select class="form-control product_id" id="consumption_product_{{$consumption_count}}" name="consumptions[{{$consumption_count}}][product_id]" required>
                                            <option value="{{$consumption['product_id']}}" selected>{{$consumption['product']['name']}}</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="consumptions[{{$consumption_count}}][quantity]" placeholder="{{__('Quantity')}}" value="{{$consumption['quantity']}}" required>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger delete_consumption">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                      @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="consumption_count" value="{{$consumption_count}}">

