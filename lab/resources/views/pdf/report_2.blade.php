@php
use App\Models\Patient;
use App\Models\GroupTest;

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

foreach ($patientGroups as $gro) {
    $gro->tests = $gro->all_tests->whereIn('test_id', $testsIds);
}

$testId = [];
$idsOfTest = [];

foreach ($patientGroups as $gro) {
    foreach ($gro->tests as $test) {
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

@extends('layouts.pdf_2')
@section('title')
    {{ __('Report') }}-#{{ $group['id'] }}-{{ date('Y-m-d') }}
@endsection
@section('content')
    <style>
        {{-- CBC Style --}} table,
        th,
        td {
            border: 1px solid #e7e7e7;
            border-collapse: collapse;
            height: 20px;
            color: #000;
        }

        td {
            border: 1px solid #e7e7e7;
            padding: 2px;
            color: #000;
        }

        .pinfo {
            border-collapse: collapse;
            border-radius: 10px;
            height: 30px;
            width: 100%;
            color: #000;
        }

        .theadcbc {
            border: 1px solid #e7e7e7;
            background-color: #b4e4f7;
            color: #00658c;
            font-weight: bold;
            font-size: 18px;
            height: 30px;
        }

        .relativeh {
            border: 1px solid #e7e7e7;
            background-color: #b4e4f7;
            color: #00658c;
            font-weight: bold;
            font-size: 14px;
            height: 30px;
        }

        .absolutetd {
            border: 1px solid #e7e7e7;
            background-color: #b4e4f7;
            color: #00658c;
            font-weight: bold;
            font-size: 14px;
            height: 30px;
        }

        .tleft {
            float: left;
            width: 50%;
            padding-bottom: 10px;
        }

        .tright {
            float: right;
            width: 49%;
            padding-bottom: 10px;
        }

        {{-- another test Style --}} .ttable {
            width: 100%;
        }

        .testtable {
            border: 1px solid #e7e7e7;
            border-collapse: collapse;
            height: 30px;
            width: 100%;

        }

        .tdtest {
            background-color: #f8f8f8;
            padding: 2px;
            height: 30px;
            font-size: 16px;
            text-align: center;
        }


        .theadtest {
            border: 1px solid #e7e7e7;
            background-color: #b4e4f7;
            color: #00658c;
            font-weight: bold;
            font-size: 18px;
            height: 30px;
            text-align: center;
        }

        .ttitle {
            background-color: #f4f4f4;
            font-weight: 600;
            text-align: center;
        }

        .tsthead {
            color: #00658c;
            text-align: left;
            text-decoration: underline;

        }

        .category_title {
            color: #000;
            text-align: center;
            text-decoration: underline;

        }

        .comment {
            padding: 10px;
            text-align: left;
            font-size: 18px;
        }

        .commentb {
            padding: 10px;
            text-align: left;
            font-size: 16px;
        }
    </style>
    <div class="printable">
        @php
            $count_categories = 0;
        @endphp
        @foreach ($categories as $key => $category)
            @if (count($category['tests']) || count($category['cultures']))
                @php
                    $count_categories++;
                    $count = 0;
                @endphp
                @if ($count_categories > 1)
                    <pagebreak>
                    </pagebreak>
                @endif



                {{-- <h2 class="category_title">{{ $category['name'] }}</h2> --}}
                @if (count($category['tests']))
                    @if (count($category['tests']) > 1)
                        <table class="ttable">
                            <thead class="testtable">
                                <tr>
                                    <td class="theadtest" width="30%">Test </td>
                                    <td class="theadtest" width="20%">Result</td>

                                    <td class="theadtest" width="10%">Unit</td>
                                    @if (session('report_design') == '1')
                                        <td class="theadtest" width="15%">Status</td>
                                    @endif
                                    <td class="theadtest" width="25%">Normal Range</td>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($category['tests'] as $test)
                                    @foreach ($test['results'] as $result)
                                        <!-- Title -->
                                        @if (isset($result['component']))
                                            @if ($result['component']['title'])
                                                <tr>
                                                    <td colspan="5" class="ttitle">
                                                        <b>{{ $result['component']['name'] }}</b>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="ttitle">
                                                        {{ $result['component']['name'] }}
                                                    </td>
                                                    <td class="tdtest">{{ $result['result'] }}</td>

                                                    <td class="tdtest"> {{ $result['component']['unit'] }} </td>
                                                    @if (session('report_design') == '1')
                                                        <td class="tdtest">{{ $result['status'] }}</td>
                                                    @endif
                                                    <td class="tdtest">


                                                        @php
                                                            
                                                            $component_new = App\Models\Test::find($result['component']['id']);
                                                            
                                                            $new_reference = $component_new
                                                                ->reference_range_new_component()
                                                                ->where('group_id', $group['id'])
                                                                ->first();
                                                            
                                                        @endphp

                                                        <!--{{ $component_new->reference_range_new_component }}-->

                                                        {!! $component_new->reference_range_new_component && $new_reference
                                                            ? $new_reference->referance_range
                                                            : $result['component']['reference_range'] !!}
                                                        <!--{!! $result['component']['reference_range'] !!}-->
                                                    </td>


                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach




                                <!-- Comment -->
                                @if (isset($test['comment']))
                                    <br>
                                    <tr class="comment">
                                        <td colspan="5">
                                            <table class="comment" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td width="10px" nowrap="nowrap"><b>Comment:</b></td>
                                                        <td class="commentb">
                                                            {!! str_replace("\n", '<br />', $test['comment']) !!}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                                <!-- /comment -->
                            </tbody>
                        </table>
                    @else
                        @foreach ($category['tests'] as $test)
                            @php
                                $count++;
                            @endphp
                            <!--CBC Report ID 473-->


                            @if ($test['test']['id'] == 473)
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td class="theadcbc">Test </td>
                                            <td class="theadcbc">Result</td>

                                            <td class="theadcbc">Unit</td>
                                            @if (session('report_design') == '1')
                                                <td class="theadcbc">Status</td>
                                            @endif
                                            <td class="theadcbc">Normal Range</td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($test['results'] as $result)
                                            @if (isset($result['component']))
                                                @if ($result['component']['id'] == 1261 ||
                                                    $result['component']['id'] == 1262 ||
                                                    $result['component']['id'] == 1263 ||
                                                    $result['component']['id'] == 1264 ||
                                                    $result['component']['id'] == 1266 ||
                                                    $result['component']['id'] == 1267 ||
                                                    $result['component']['id'] == 1268 ||
                                                    $result['component']['id'] == 1419 ||
                                                    $result['component']['id'] == 1420 ||
                                                    $result['component']['id'] == 1421 ||
                                                    $result['component']['id'] == 1422 ||
                                                    $result['component']['id'] == 1424 ||
                                                    $result['component']['id'] == 1425 ||
                                                    $result['component']['id'] == 1426 ||
                                                    $result['component']['id'] == 1258 ||
                                                    $result['component']['id'] == 1260 ||
                                                    $result['component']['id'] == 1265 ||
                                                    $result['component']['id'] == 1418 ||
                                                    $result['component']['id'] == 1423)
                                                @else
                                                    <tr>
                                                        <td> {{ $result['component']['name'] }}</td>
                                                        <td> {{ $result['result'] }}</td>

                                                        <td>{{ $result['component']['unit'] }} </td>
                                                        @if (session('report_design') == '1')
                                                            <td> {{ $result['status'] }} </td>
                                                        @endif
                                                        <td>
                                                            @php
                                                                $component_new = App\Models\Test::find($result['component']['id']);
                                                                $new_reference = $component_new
                                                                    ->reference_range_new_component()
                                                                    ->where('group_id', $group['id'])
                                                                    ->first();
                                                            @endphp
                                                            <!--{{ $component_new->reference_range_new_component }}-->
                                                            {!! $component_new->reference_range_new_component && $new_reference
                                                                ? $new_reference->referance_range
                                                                : $result['component']['reference_range'] !!}
                                                            <!--{!! $result['component']['reference_range'] !!}-->
                                                        </td>


                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                                <br>
                                <div class="tleft">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td class="relativeh" width="50%">Test</td>
                                                <td class="relativeh" width="25%">Relative Count %</td>
                                                <td class="relativeh" width="25%">Normal Range</td>
                                            </tr>
                                        </thead>
                                        @foreach ($test['results'] as $result)
                                            @if (isset($result['component']))
                                                @if ($result['component']['id'] == 1261 ||
                                                    $result['component']['id'] == 1262 ||
                                                    $result['component']['id'] == 1263 ||
                                                    $result['component']['id'] == 1264 ||
                                                    $result['component']['id'] == 1266 ||
                                                    $result['component']['id'] == 1267 ||
                                                    $result['component']['id'] == 1268)
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $result['component']['name'] }}</td>
                                                            <td>{{ $result['result'] }}</td>
                                                            <td>
                                                                @php
                                                                    $component_new = App\Models\Test::find($result['component']['id']);
                                                                    $new_reference = $component_new
                                                                        ->reference_range_new_component()
                                                                        ->where('group_id', $group['id'])
                                                                        ->first();
                                                                @endphp
                                                                <!--{{ $component_new->reference_range_new_component }}-->
                                                                {!! $component_new->reference_range_new_component && $new_reference
                                                                    ? $new_reference->referance_range
                                                                    : $result['component']['reference_range'] !!}
                                                                <!--{!! $result['component']['reference_range'] !!}-->
                                                            </td>
                                                        </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="tright">
                                    <table>
                                        <thead>
                                            <tr>

                                                <td class="absolutetd" width="50%">Absolute Count 10³/µl</td>
                                                <td class="absolutetd" width="100%">Normal Range</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($test['results'] as $result)
                                                @if (isset($result['component']))
                                                    @if ($result['component']['id'] == 1419 ||
                                                        $result['component']['id'] == 1420 ||
                                                        $result['component']['id'] == 1421 ||
                                                        $result['component']['id'] == 1422 ||
                                                        $result['component']['id'] == 1424 ||
                                                        $result['component']['id'] == 1425 ||
                                                        $result['component']['id'] == 1426)
                                                        <tr>

                                                            <td>{{ $result['result'] }}</td>
                                                            <td>
                                                                @php
                                                                    $component_new = App\Models\Test::find($result['component']['id']);
                                                                    $new_reference = $component_new
                                                                        ->reference_range_new_component()
                                                                        ->where('group_id', $group['id'])
                                                                        ->first();
                                                                @endphp
                                                                <!--{{ $component_new->reference_range_new_component }}-->
                                                                {!! $component_new->reference_range_new_component && $new_reference
                                                                    ? $new_reference->referance_range
                                                                    : $result['component']['reference_range'] !!}
                                                                <!--{!! $result['component']['reference_range'] !!}-->
                                                            </td>

                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <!-- Comment -->

                                @if (isset($test['comment']))
                                    <br>
                                    <table class="comment" width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="10px" nowrap="nowrap"><b>Comment:</b></td>
                                                <td class="commentb">
                                                    {!! str_replace("\n", '<br />', $test['comment']) !!}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                                <!-- /comment -->
                                <!--/ end CBC Report ID 473-->
                            @else
                                <table class="ttable">
                                    <thead class="testtable">
                                        <tr>
                                            <td class="theadtest" width="30%">Test </td>
                                            <td class="theadtest" width="20%">Result</td>

                                            <td class="theadtest" width="10%">Unit</td>
                                            @if (session('report_design') == '1')
                                                <td class="theadtest" width="15%">Status</td>
                                            @endif
                                            <td class="theadtest" width="25%">Normal Range</td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($test['results'] as $result)
                                            <!-- Title -->
                                            @if (isset($result['component']))
                                                @if ($result['component']['title'])
                                                    <tr align="left">
                                                        <td class="tdtest">
                                                            <h3 class="tdtest">{{ $result['component']['name'] }}</h3>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="tdtest" width="25%">
                                                            {{ $result['component']['name'] }}
                                                        </td>
                                                        <td class="tdtest" width="15%">{{ $result['result'] }}
                                                        </td>

                                                        <td class="tdtest">
                                                            {{ $result['component']['unit'] }}
                                                        </td>
                                                        @if (session('report_design') == '1')
                                                            <td class="tdtest" width="20%">
                                                                {{ $result['status'] }}
                                                            </td>
                                                        @endif
                                                        <td class="tdtest" width="40%">
                                                            @php
                                                                $component_new = App\Models\Test::find($result['component']['id']);
                                                                $new_reference = $component_new
                                                                    ->reference_range_new_component()
                                                                    ->where('group_id', $group['id'])
                                                                    ->first();
                                                            @endphp
                                                            <!--{{ $component_new->reference_range_new_component }}-->
                                                            {!! $component_new->reference_range_new_component && $new_reference
                                                                ? $new_reference->referance_range
                                                                : $result['component']['reference_range'] !!}
                                                            <!--{!! $result['component']['reference_range'] !!}-->
                                                        </td>

                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        <!-- Comment -->
                                        @if (isset($test['comment']))
                                            <tr class="comment">
                                                <td colspan="5">
                                                    <table class="comment">
                                                        <tbody>
                                                            <tr>
                                                                <th width="80px">
                                                                    <b>Comment</b>
                                                                </th>
                                                                <td colspan="4">
                                                                    {!! str_replace("\n", '<br />', $test['comment']) !!}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endif
                                        <!-- /comment -->
                                    </tbody>
                                </table>
                            @endif
                        @endforeach
                    @endif
                @endif

                @if (session()->get('history') == $group['id'])
                    @foreach ($resultes as $res)
                        @if ($test['test']['id'] == $res->test->id)
                            <h5>Test Name: {{ $res->test->name }} - invoice(#ID:{{ $res->group->id }}) - Date:
                                {{ $res->group->created_at }}</h5>

                            @if ($res['test_id'] == 473)
                                <table class="ttable">
                                    <thead>
                                        <tr>
                                            <th class="theadcbc" class="theadcbc">HB</span></th>
                                            <th class="theadcbc">RBCs</th>
                                            <th class="theadcbc">PLT</th>
                                            <th class="theadcbc">WBCs</th>
                                            <th class="theadcbc">Lymphocytes</th>
                                            <th class="theadcbc">Monocytes</th>
                                            <th class="theadcbc">Eosinophils</th>
                                            <th class="theadcbc">Basophils</th>
                                            <th class="theadcbc">Neutrophil </th>

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
                                                    <td class="tdtest">{{ $result['result'] }}</td>
                                                @endif
                                            @endforeach

                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($res['test_id'] == 1025)
                                <table class="ttable">
                                    <thead>
                                        <tr>
                                            @foreach ($res['results'] as $result)
                                                @if ($result['component']['id'] == 1458 ||
                                                    $result['component']['id'] == 1457 ||
                                                    $result['component']['id'] == 1461 ||
                                                    $result['component']['id'] == 1462 ||
                                                    $result['component']['id'] == 1464)
                                                    <th class="theadtest">{{ $result['component']['name'] }}</th>
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
                                                    <td class="tdtest">{{ $result['result'] }}</td>
                                                @endif
                                            @endforeach

                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($res['test_id'] == 1203)
                                <table class="ttable">
                                    <thead>
                                        <tr>
                                            @foreach ($res['results'] as $result)
                                                @if ($result['component']['id'] == 1442 ||
                                                    $result['component']['id'] == 1441 ||
                                                    $result['component']['id'] == 1443 ||
                                                    $result['component']['id'] == 1444)
                                                    <th class="theadtest">{{ $result['component']['name'] }}</th>
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
                                                    <td class="tdtest">{{ $result['result'] }}</td>
                                                @endif
                                            @endforeach

                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <table class="ttable">
                                    <thead>
                                        <tr>
                                            @foreach ($res['results'] as $result)
                                                <th class="theadtest">{{ $result['component']['name'] }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($res['results'] as $result)
                                                <td class="tdtest">{{ $result['result'] }}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        @endif
                    @endforeach
                @endif


                @if (count($category['cultures']))
                    @foreach ($category['cultures'] as $culture)
                        @php
                            $count++;
                        @endphp
                        @if ($count > 1)
                            <pagebreak>
                        @endif
                        <!-- culture title -->
                        <h3 class="category_title"> {{ $culture['culture']['name'] }} </h3>

                        <table class="ttable">
                            <tbody>
                                @foreach ($culture['culture_options'] as $culture_option)
                                    @if (isset($culture_option['value']) && isset($culture_option['culture_option']))
                                        <tr>
                                            <td class="theadtest">{{ $culture_option['culture_option']['value'] }}
                                                : </td>
                                            <td class="tdtest">{{ $culture_option['value'] }} </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <table class="ttable">
                            <thead>
                                <tr>
                                    <td class="theadtest" width="30%">Name</td>
                                    <td class="theadtest" width="30%">Sensitivity</td>
                                    <td class="theadtest" width="30%">Commercial name</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($culture['high_antibiotics'] as $antibiotic)
                                    <tr>
                                        <td class="tdtest" width="30%"> {{ $antibiotic['antibiotic']['name'] }} </td>
                                        <td class="tdtest" width="30%"> {{ $antibiotic['sensitivity'] }} </td>
                                        <td class="tdtest" width="30%">
                                            {{ $antibiotic['antibiotic']['commercial_name'] }} </td>
                                    </tr>
                                @endforeach
                                @foreach ($culture['moderate_antibiotics'] as $antibiotic)
                                    <tr>
                                        <td class="tdtest" width="30%"> {{ $antibiotic['antibiotic']['name'] }} </td>
                                        <td class="tdtest" width="30%"> {{ $antibiotic['sensitivity'] }} </td>
                                        <td class="tdtest" width="30%">
                                            {{ $antibiotic['antibiotic']['commercial_name'] }} </td>
                                    </tr>
                                @endforeach
                                @foreach ($culture['resident_antibiotics'] as $antibiotic)
                                    <tr>
                                        <td class="tdtest" width="30%"> {{ $antibiotic['antibiotic']['name'] }} </td>
                                        <td class="tdtest" width="30%"> {{ $antibiotic['sensitivity'] }} </td>
                                        <td class="tdtest" width="30%">
                                            {{ $antibiotic['antibiotic']['commercial_name'] }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <!-- Comment -->
                        @if (isset($culture['comment']))
                            <table width="100%" class="comment">
                                <tbody>
                                    <tr>
                                        <td width="10px" nowrap="nowrap"><b>Comment:</b></td>
                                        <td class="commentb">
                                            {!! str_replace("\n", '<br />', $culture['comment']) !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                        <!-- /comment -->
                        @if ($count > 1)
                            </pagebreak>
                        @endif
                    @endforeach
                @endif
            @endif
            @if ($key == 0)
                {{-- rays --}}
                @if (isset($category['rays']) && count($category['rays']))
                    @php
                        $count_categories++;
                        $count = 0;
                    @endphp
                    @if ($count_categories > 1)
                        <pagebreak>
                        </pagebreak>
                    @endif
                    @foreach ($category['rays'] as $ray)
                        {{-- @php

                            $count++;
                        @endphp
                        @if ($count > 1)
                            <pagebreak>
                        @endif --}}
                        <!-- culture title -->
                        <h3 class="category_title"> {{ $ray['ray']['name'] }} </h3>

                        <table class="ttable">
                            <thead>
                                <tr>
                                    <td class="theadtest" width="30%">Name</td>
                                    <td class="theadtest">comment</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="tdtest" width="30%">{{ $ray['ray']['name'] }} </td>
                                    <td class="tdtest"><?= $ray['result']['comment'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        @if ($count > 1)
                            </pagebreak>
                        @endif
                    @endforeach
                @endif
                {{-- end rays --}}
            @endif
        @endforeach

    </div>
@endsection
