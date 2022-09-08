@extends('layouts.app')

@section('title')
    {{__('Groups')}}
@endsection

@section('content')


    <div class="content-header row">
    </div>
    <div class="content-body">

        <!-- filter -->

        <div id="accordion">

            <div class="card card-info">

                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary collapsed"

                   aria-expanded="false">

                    <i class="fas fa-filter"></i> {{ __('Filters') }}

                </a>
                <form method="get" action="{{route('admin.groups.index')}}">
                    <div id="collapseOne" class="panel-collapse in collapse">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-3">

                                    <div class="form-group">

                                        <label for="filter_date">{{ __('Date') }}</label>

                                        <input type="text" class="form-control" id="filter_date" name="filter_date"

                                               placeholder="{{ __('Date') }}">

                                    </div>

                                </div>

                                <div class="col-lg-3">

                                    <div class="form-group">

                                        <label for="filter_created_by">{{ __('Created by') }}</label>

                                        <select name="filter_created_by" id="filter_created_by"

                                                class="form-control user_id">

                                        </select>

                                    </div>

                                </div>

                                <div class="col-lg-3">

                                    <div class="form-group">

                                        <label for="filter_signed_by">{{ __('Signed by') }}</label>

                                        <select name="filter_signed_by" id="filter_signed_by" class="form-control user_id">

                                        </select>

                                    </div>

                                </div>

                                <div class="col-lg-3">

                                    <div class="form-group">

                                        <label for="filter_status">{{ __('Status') }}</label>

                                        <select name="filter_status" id="filter_status" class="form-control select2">

                                            <option value="" selected>{{ __('All') }}</option>

                                            <option value="1">{{ __('Done') }}</option>

                                            <option value="0">{{ __('Pending') }}</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-lg-3">

                                    <div class="form-group">

                                        <label for="filter_barcode">{{ __('Barcode') }}</label>

                                        <input type="text" class="form-control" id="filter_barcode"

                                               placeholder="{{ __('Barcode') }}">

                                    </div>

                                </div>

                                <div class="col-lg-3">

                                    <div class="form-group">

                                        <label for="filter_contract">{{ __('Contract') }}</label>

                                        <select name="filter_contract" id="filter_contract" class="form-control" data-url="{{ route('admin.calculate_contract_id') }}">

                                        </select>

                                    </div>

                                </div>

                                <div class="col-lg-3 lab-to-lab @if(isset($labs)) d-block  @else d-none @endif">

                                    <div class="form-group">
                                        <label>{{__('lab')}}</label>
                                        <select class="form-control" name="labs" id="lab" multiple>

                                        </select>
                                    </div>

                                </div>

                                <div class="col-lg-3 lab-to-lab @if(isset($labs)) d-block  @else d-none @endif">

                                    <div class="form-group">
                                        <label for="government_id">{{__('Government')}}</label>
                                        <select name="government_id" id="government_id" class="form-control">
                                            <option></option>
                                            @foreach($governments as $government)
                                                <option value="{{ $government->id }}">{{ $government->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-lg-3 lab-to-lab @if(isset($labs)) d-block  @else d-none @endif">
                                    <div class="form-group">
                                        <label for="region_id">{{__('Region')}}</label>
                                        <select name="region_id" id="region_id" class="form-control">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 lab-to-lab @if(isset($labs)) d-block  @else d-none @endif">
                                    <div class="form-group">
                                        <label for="rep_id">{{__('Representative')}}</label>
                                        <select name="rep_id" id="rep_id" class="form-control">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </form>

            </div>

        </div>

        <!-- \filter -->

        <section class="invoice-list-wrapper">
            <div class="card">


                <section id="advanced-search-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">{{ __('Invoices') }}</h4>
                                    @can('create_group')
                                        <a href="{{ route('admin.groups.create') }}" class="t-button btn btn-primary btn-add-record ml-2">
                                            <i class="fa fa-plus"></i> {{ __('Create') }}
                                        </a>

                                        <button class="btn btn-info ml-2" id="pay_delayed_money" data-url="{{ route('admin.group.pay_delayed_money') }}">
                                            <i class="fa fa-dollar-sign"></i> {{ __('Pay delayed money') }}
                                            <span id="total_delayed_money" class="badge badge-info" style="font-size: 20px">0</span>
                                        </button>
                                    @endcan
                                </div>

                                <hr class="my-0">
                                <div class="card-datatable px-2">
                                    <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive" style="width:100% !important;">
                                        <div class="d-flex justify-content-between align-items-center mx-0 row">
                                            <div class="col-sm-12 col-md-6"><div class="dataTables_length" id="DataTables_Table_2_length">
                                                </div>
                                            </div></div>
                                        <table class="table table-striped table-bordered" id="groups_table" role="grid" aria-describedby="DataTables_Table_2_info" style="width:100% !important;">
                                            <thead>
                                            <tr role="row">
                                                <th width="10px"><input type="checkbox" class="check_all" name="" id=""></th>
                                                <th class="control sorting_asc" rowspan="1" colspan="1" style="width: 45.3594px; display: none;" aria-label=""></th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 138.688px;" aria-label="#: activate to sort column ascending">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 142.438px;" aria-label="Created By: activate to sort column ascending">{{ __('Created By') }}</th>
                                                <!-- <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 128.844px;" aria-label="Barcode: activate to sort column ascending">{{ __('Barcode') }}</th> -->
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 116.594px;" aria-label="Patient Code: activate to sort column ascending">{{ __('Patient Code') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 116.594px;" aria-label="Patient Code: activate to sort column ascending">{{ __('Patient Name') }}</th>
                                                <!-- <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 129.172px;" aria-label="Contract: activate to sort column ascending">{{ __('Contract') }}</th> -->
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Subtotal: activate to sort column ascending">{{ __('Subtotal') }}</th>
                                                <!-- <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Discount: activate to sort column ascending">{{ __('Discount') }}</th> -->
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Total: activate to sort column ascending">{{ __('Total') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Paid: activate to sort column ascending">{{ __('Paid')}}</th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Due: activate to sort column ascending">{{ __('Due') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Delayed Money: activate to sort column ascending">{{ __('Delayed Money') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Date: activate to sort column ascending">{{ __('Date') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Branch: activate to sort column ascending">{{ __('Branch') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Status: activate to sort column ascending">{{ __('Status') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="groups_table" rowspan="1" colspan="1" style="width: 163.906px;" aria-label="Action: activate to sort column ascending">{{ __('Action') }}</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th width="10px"><input type="checkbox" class="check_all" name="" id=""></th>
                                                <th rowspan="1" colspan="1">#</th>
                                                <th rowspan="1" colspan="1">{{ __('Created By') }}</th>
                                                <!-- <th rowspan="1" colspan="1">{{ __('Barcode') }}</th> -->
                                                <th rowspan="1" colspan="1">{{ __('Patient Code') }}</th>
                                                <th rowspan="1" colspan="1">{{ __('Patient Name') }}</th>
                                                <!-- <th rowspan="1" colspan="1">{{ __('Contract') }}</th> -->
                                                <th rowspan="1" colspan="1">{{ __('Subtotal') }}</th>
                                                <!-- <th rowspan="1" colspan="1">{{ __('Discount') }}</th> -->
                                                <th rowspan="1" colspan="1">{{ __('Total') }}</th>
                                                <th rowspan="1" colspan="1">{{ __('Paid')}}</th>
                                                <th rowspan="1" colspan="1">{{ __('Due') }}</th>
                                                <th rowspan="1" colspan="1">{{ __('Delayed Money') }}</th>
                                                <th rowspan="1" colspan="1">{{ __('Date') }}</th>
                                                <th rowspan="1" colspan="1">{{ __('Branch') }}</th>
                                                <th rowspan="1" colspan="1">{{ __('Status') }}</th>
                                                <th rowspan="1" colspan="1">{{ __('Action') }}</th>

                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            <tr class="odd">
                                                <td valign="top" colspan="6" class="dataTables_empty">
                                                    Loading...
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

    </div>


    <!-- /.card-body -->
    </div>

    @include('admin.groups.modals.print_barcode')
@endsection
@section('scripts')
    <script>
        var can_delete =
            @can('delete_group')
                true
        @else
            false
        @endcan;
        var can_view =
            @can('view_group')
                true
        @else
            false
        @endcan;
    </script>
    <script src="{{ url('js/select2.js') }}"></script>
    <script src="{{ url('js/admin/groups.js') }}"></script>
    <script>
        $(document).on('change', '.check-test', function() {

            var checked = $(this).is(':checked');

            if (checked) {
                $(this).next().val($(this).val());
            } else {
                $(this).next().val('');
            }

        });

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

        $('.check_all').on('click', function(e) {
            if($(this).is(':checked',true))
            {
                $(".bulk_checkbox").prop('checked', true);
            } else {
                $(".bulk_checkbox").prop('checked',false);
            }
        });
        function add(accumulator, a) {
            return accumulator + a;
        }
        $('#pay_delayed_money').on('click', function(e) {
            var allVals = [];
            var allIds = [];
            $(".bulk_checkbox:checked").each(function() {
                if (typeof $(this).data('delayed_money') != 'string') {
                    allIds.push($(this).val());
                    allVals.push($(this).data('delayed_money'));
                }
            });
            let sum = allVals.reduce(add, 0)

            if(allVals.length <=0)
            {
                alert("Please select row.");
            }  else {
                var check = confirm("Are you sure you want to pay ( "+sum +" LE)?");
                if(sum != 0) {
                    if (check) {
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                            data: {ids: allIds, values: allVals},
                            success: function (data) {
                                if(data.success) {
                                    alert(data.msg);
                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 2000);
                                } else {
                                    alert(data.msg)
                                }
                            }
                        });
                    }
                } else {
                    alert("Amount must be greater than 0.");
                }
            }
        })
    </script>
@endsection
