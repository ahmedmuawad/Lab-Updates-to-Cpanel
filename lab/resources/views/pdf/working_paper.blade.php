@php
use App\Models\Patient;
use App\Models\GroupTest;
@endphp

@extends('layouts.pdf')

@section('content')
    <style>
        .receipt_title td,
        th {
            border-color: white;
        }

        .receipt_title .total {
            background-color: #ddd;
        }

        .table th {
            color: {{ $reports_settings['test_head']['color'] }} !important;
            font-size: {{ $reports_settings['test_head']['font-size'] }} !important;
            font-family: {{ $reports_settings['test_head']['font-family'] }} !important;
        }

        .total {
            font-family: {{ $reports_settings['test_head']['font-family'] }} !important;
        }

        .due_date {
            font-family: {{ $reports_settings['test_head']['font-family'] }} !important;
        }

        .test_name {
            color: {{ $reports_settings['test_name']['color'] }} !important;
            font-size: {{ $reports_settings['test_name']['font-size'] }} !important;
            font-family: {{ $reports_settings['test_name']['font-family'] }} !important;
        }

        .text-center {
            text-align: center;
        }

        .demTable {
            width: 100%;
            border: 1px dashed #b3adad;
            border-collapse: collapse;
            padding: 5px;
        }

        .demTable th {
            border: 1px dashed #b3adad;
            padding: 5px;
            background: #f0f0f0;
            color: #313030;
        }

        .demTable td {
            border: 1px dashed #b3adad;
            text-align: left;
            padding: 5px;
            background: #ffffff;
            color: #313030;
        }


        .demoTable {
            width: 100%;
            border: 1px solid #b3adad;
            border-collapse: collapse;
            padding: 5px;
        }

        .demoTable th {
            border: 1px solid #b3adad;
            padding: 5px;
            background: #f0f0f0;
            color: #313030;
        }

        .demoTable td {
            border: 1px solid #b3adad;
            text-align: center;
            padding: 5px;
            background: #ffffff;
            color: #313030;
        }
    </style>

    <div class="invoice">
        <h2 class="text-center">Working paper</h2>
        @if (isset($group['patient']))
            <table width="100%" class="table table-bordered pdf-header">
                <tbody>
                    <tr>
                        <td width="50%">
                            <span class="title">Barcode:</span>
                            <span class="data">
                                {{ $group['barcode'] }}
                            </span>

                        </td>
                        <td width="50%">
                            <span class="title">Order id:</span>
                            <span class="data">
                                {{ $group['id'] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <span class="title">Doctor:</span>
                            <span class="data">
                                @if (isset($group['doctor']))
                                    {{ $group['doctor']['name'] }}
                                @endif
                                @if (isset($group['normalDoctor']))
                                    {{ $group['normalDoctor']['name'] }}
                                @endif
                            </span>

                        </td>
                        <td width="50%">
                            <span class="title">Price:</span>
                            <span class="data">
                                {{ $group['total'] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <span class="title">Patient Code:</span>
                            <span class="data">
                                @if (isset($group['patient']))
                                    {{ $group['patient']['code'] }}
                                @endif
                            </span>
                        </td>
                        <td width="50%">
                            <span class="title">Patient Name :</span>
                            <span class="data">
                                @if (isset($group['patient']))
                                    {{ $group['patient']['name'] }}
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="title">Age:</span>
                            <span class="data">
                                @if (isset($group['patient']))
                                    {{ $group['patient']['age'] }}
                                @endif
                            </span>

                        </td>
                        <td>
                            <span class="title">Gender:</span> <span class="data">
                                @if (isset($group['patient']))
                                    {{ __($group['patient']['gender']) }}
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="title">Patient phone number:</span>
                            <span class="data">
                                @if (isset($group['patient']))
                                    {{ __($group['patient']['phone']) }}
                                @endif
                            </span>
                        </td>
                        <td>
                            <span class="title">Sample collection date:</span>
                            <span class="data">
                                {{ $group['sample_collection_date'] }}
                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="title">Date:</span>
                            <span class="data">
                                {{ get_system_date() }}
                            </span>
                        </td>
                        <td>
                            <span class="title">Employee id:</span>
                            <span class="data">
                                {{ auth()->guard('admin')->user()->id }}
                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="title">Employee name:</span>
                            <span class="data">
                                {{ auth()->guard('admin')->user()->name }}
                            </span>
                        </td>
                        <td>
                            <span class="title">Pationt Info:</span>
                            <span class="data">
                                @if (isset($group['patient']))
                                    {{ $group['patient']['fluid_patient'] == 1 ? __('Hemophilia') : ' ' }} -
                                    {{ $group['patient']['diabetic'] == 1 ? __('Diabetic') : ' ' }} -
                                    {{ $group['patient']['liver_patient'] == 1 ? __('Liver Patient') : ' ' }} -
                                    {{ $group['patient']['pregnant'] == 1 ? __('Pregnant') : ' ' }}
                                    {{-- {{ __( $group['patient']['fluid_patient'] == 1 ? $group['patient']['fluid_patient'] : ' ' $group['patient']['diabetic'] == 1 ? $group['patient']['diabetic'] : ''    ) }} --}}
                                @endif
                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span class="title">Branch:</span>
                            <span class="data">
                                {{ $group['branch']['name'] }}
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>


            </br>
            <h4>{{ __('Required tests') }}</h4>
            </br>

            @if ($group->all_tests->isNotEmpty() || $group->cultures->isNotEmpty()  )
                <table class="demTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Test ID</th>
                            <th>Test Name</th>
                            <th>Sample Type</th>
                            <th>Result</th>
                            <th>Signature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($group['all_tests'] as $key => $test)
                            <tr>
                                <td class="workingpapertd">{{ $key + 1 }}</td>
                                <td class="workingpapertd">{{ $test['test']['id'] }}</td>
                                <td class="workingpapertd">{{ $test['test']['name'] }}</td>
                                <td class="workingpapertd">{{ $test['test']['sample_type'] }}</td>
                                <td class="workingpapertd">&nbsp;</td>
                                <td class="workingpapertd">&nbsp;</td>
                            </tr>
                        @endforeach
                        @foreach ($group['cultures'] as $key => $culture)
                            <tr>
                                <td class="workingpapertd">{{ $key + 1 }}</td>
                                <td class="workingpapertd">{{ $culture['culture']['id'] }}</td>
                                <td class="workingpapertd"> {{ $culture['culture']['name'] }}</td>
                                <td class="workingpapertd"> {{ $culture['culture']['sample_type'] }}</td>
                                <td class="workingpapertd">&nbsp;</td>
                                <td class="workingpapertd">&nbsp;</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if ($group->rays->isNotEmpty())
                <table class="demTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Ray ID</th>
                            <th>Ray Name</th>
                            <th>Shortcut</th>
                            <th>Result</th>
                            <th>Signature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($group['rays'] as $key => $ray)
                            <tr>
                                <td class="workingpapertd">{{ $key + 1 }}</td>
                                <td class="workingpapertd">{{ $ray['ray']['id'] }}</td>
                                <td class="workingpapertd"> {{ $ray['ray']['name'] }}</td>
                                <td class="workingpapertd"> {{ $ray['ray']['shortcut'] }}</td>
                                <td class="workingpapertd">&nbsp;</td>
                                <td class="workingpapertd">&nbsp;</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif




            @php

                $testsIds = [];
                foreach ($group['tests'] as $key => $test) {
                    array_push($testsIds, $test['test']['id']);
                }

                $patientGroups = Patient::with('groups.all_tests')
                    ->find($group['patient']['id'])
                    ->groups()
                    ->with('all_tests')
                    ->where('id', '<', $group['id'])
                    ->where('done', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();

                foreach ($patientGroups as $group) {
                    $group->tests = $group->all_tests->whereIn('test_id', $testsIds);
                }

                $testId = [];
                $idsOfTest = [];

                foreach ($patientGroups as $group) {
                    foreach ($group->tests as $test) {
                        if (!in_array($test->test_id, $testId)) {
                            array_push($testId, $test->test_id);
                            array_push($idsOfTest, $test->id);
                        }
                    }
                }

                $resultes = GroupTest::with('results.component', 'test.components', 'group')
                    ->whereIn('id', $idsOfTest)
                    ->get();

            @endphp

            @foreach ($resultes as $res)
                <h5>Test Name: {{ $res->test->name }} - invoice(#ID:{{ $res->group->id }}) - Date:
                    {{ $res->group->created_at }}</h5>

                @if ($res['test_id'] == 473)
                    <table class="demoTable">
                        <thead>
                            <tr>
                                <th>HB</span></th>
                                <th>RBCs</th>
                                <th>PLT</th>
                                <th>WBCs</th>
                                <th>Lymphocytes</th>
                                <th>Monocytes</th>
                                <th>Eosinophils</th>
                                <th>Basophils</th>
                                <th>Neutrophil </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($res['results'] as $result)
                                    @if ($result['component']['id'] == 1248 ||
                                        $result['component']['id'] == 1249 ||
                                        $result['component']['id'] == 1255 ||
                                        $result['component']['id'] == 1257 ||
                                        $result['component']['id'] == 1261 ||
                                        $result['component']['id'] == 1262 ||
                                        $result['component']['id'] == 1263 ||
                                        $result['component']['id'] == 1264 ||
                                        $result['component']['id'] == 1266)
                                        <td>{{ $result['result'] }}</td>
                                    @endif
                                @endforeach

                            </tr>
                        </tbody>
                    </table>
                @elseif($res['test_id'] == 1025)
                    <table class="demoTable">
                        <thead>
                            <tr>
                                @foreach ($res['results'] as $result)
                                    @if ($result['component']['id'] == 1458 ||
                                        $result['component']['id'] == 1457 ||
                                        $result['component']['id'] == 1461 ||
                                        $result['component']['id'] == 1462 ||
                                        $result['component']['id'] == 1464)
                                        <th>{{ $result['component']['name'] }}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($res['results'] as $result)
                                    @if ($result['component']['id'] == 1458 ||
                                        $result['component']['id'] == 1457 ||
                                        $result['component']['id'] == 1461 ||
                                        $result['component']['id'] == 1462 ||
                                        $result['component']['id'] == 1464)
                                        <td>{{ $result['result'] }}</td>
                                    @endif
                                @endforeach

                            </tr>
                        </tbody>
                    </table>
                @elseif($res['test_id'] == 1203)
                    <table class="demoTable">
                        <thead>
                            <tr>
                                @foreach ($res['results'] as $result)
                                    @if ($result['component']['id'] == 1442 ||
                                        $result['component']['id'] == 1441 ||
                                        $result['component']['id'] == 1443 ||
                                        $result['component']['id'] == 1444)
                                        <th>{{ $result['component']['name'] }}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($res['results'] as $result)
                                    @if ($result['component']['id'] == 1442 ||
                                        $result['component']['id'] == 1441 ||
                                        $result['component']['id'] == 1443 ||
                                        $result['component']['id'] == 1444)
                                        <td>{{ $result['result'] }}</td>
                                    @endif
                                @endforeach

                            </tr>
                        </tbody>
                    </table>
                @else
                    <table class="demoTable">
                        <thead>
                            <tr>
                                @foreach ($res['results'] as $result)
                                    <th>{{ $result['component']['name'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($res['results'] as $result)
                                    <td>{{ $result['result'] }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                @endif
            @endforeach
        @endif
    </div>



@endsection
