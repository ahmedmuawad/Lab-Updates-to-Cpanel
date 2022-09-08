@extends('layouts.pdf')
@section('title')
    {{__('Report')}}-#{{$group['id']}}-{{date('Y-m-d')}}
@endsection
@section('content')
<style>
    .test_title{
        font-size: 20px;
        background-color: #dddddd;
        border: 1px solid black!important;
    }
    .beak-page{
        page-break-inside: avoid!important;
    }
    .subtitle{
        font-size: 15px;
    }
   .test{
       margin-top: 20px;
    }
    .transparent{
        border-color: white;
    }
    .transparent th{
        border-color: white;
    }
    .test_head td,th{
        border: 1px solid #dee2e6;
    }
    .no-border{
        border-color: white;
    }
    .comment tr th,.comment tr td{
        border-color: white!important;
        vertical-align: top!important;
        text-align: left;
        padding:0px!important;
    }
    .sensitivity{
        margin-top: 20px;
    }
    .test_title{
        color:{{$reports_settings['test_title']['color']}}!important;
        font-size:{{$reports_settings['test_title']['font-size']}}px!important;
        font-family:{{$reports_settings['test_title']['font-family']}}!important;
    }
    .test_name{
        color:{{$reports_settings['test_name']['color']}}!important;
        font-size:{{$reports_settings['test_name']['font-size']}}px!important;
        font-family:{{$reports_settings['test_name']['font-family']}}!important;
    }
    .test_head th{
        color:{{$reports_settings['test_head']['color']}}!important;
        font-size:{{$reports_settings['test_head']['font-size']}}px!important;
        font-family:{{$reports_settings['test_head']['font-family']}}!important;
    }
    .unit{
        color:{{$reports_settings['unit']['color']}}!important;
        font-size:{{$reports_settings['unit']['font-size']}}px!important;
        font-family:{{$reports_settings['unit']['font-family']}}!important;
    }
    .reference_range{
        color:{{$reports_settings['reference_range']['color']}}!important;
        font-size:{{$reports_settings['reference_range']['font-size']}}px!important;
        font-family:{{$reports_settings['reference_range']['font-family']}}!important;
    }
    .result{
        color:{{$reports_settings['result']['color']}}!important;
        font-size:{{$reports_settings['result']['font-size']}}px!important;
        font-family:{{$reports_settings['result']['font-family']}}!important;
    }
    .status{
        color:{{$reports_settings['status']['color']}}!important;
        font-size:{{$reports_settings['status']['font-size']}}px!important;
        font-family:{{$reports_settings['status']['font-family']}}!important;
    }
    .comment th,.comment td{
        color:{{$reports_settings['comment']['color']}}!important;
        font-size:{{$reports_settings['comment']['font-size']}}px!important;
        font-family:{{$reports_settings['comment']['font-family']}}!important;
    }
    .antibiotic_name{
        color:{{$reports_settings['antibiotic_name']['color']}}!important;
        font-size:{{$reports_settings['antibiotic_name']['font-size']}}px!important;
        font-family:{{$reports_settings['antibiotic_name']['font-family']}}!important;
    }
    .sensitivity{
        color:{{$reports_settings['sensitivity']['color']}}!important;
        font-size:{{$reports_settings['sensitivity']['font-size']}}px!important;
        font-family:{{$reports_settings['sensitivity']['font-family']}}!important;
    }
    .commercial_name{
        color:{{$reports_settings['commercial_name']['color']}}!important;
        font-size:{{$reports_settings['commercial_name']['font-size']}}px!important;
        font-family:{{$reports_settings['commercial_name']['font-family']}}!important;
    }
</style>
<div class="printable">
    @php
        $count_categories=0
    @endphp
    @foreach($categories as $category)
        @if(count($category['tests'])||count($category['cultures']))
            @php
                $count_categories++;
                $count=0;
            @endphp
            {{--@if($count_categories>1)
                <pagebreak>
                </pagebreak>
            @endif--}}
            <h4 class="test_title" align="center">
                {{$category['name']}}
            </h4>
            @if(count($category['tests']))
                @if( count( $category['tests'] ) > 1 )

                        <table class="table test beak-page">
                            <thead>

                            <tr class="transparent">
                                <th colspan="5"></th>
                            </tr>
                            <tr class="test_head">
                                <th width="30%" class="text-left">Test</th>
                                <th width="17.5%">Result</th>
                                <th width="17.5%">Unit</th>
                                <th width="17.5%">Normal Range</th>
                                <th width="17.5%">Status</th>
                            </tr>
                            </thead>
                            <tbody class="table-bordered">

                            @foreach($category['tests'] as $test)
                                @foreach($test["results"] as $result)
                                    <!-- Title -->
                                    @if(isset($result['component']))
                                    @if($result['component']['id'] == 1261 || $result['component']['id'] == 1262 || $result['component']['id'] == 1263 || $result['component']['id'] == 1264 || $result['component']['id'] == 1266 || $result['component']['id'] == 1267 || $result['component']['id'] == 1268 || $result['component']['id'] == 1419 || $result['component']['id'] == 1420 || $result['component']['id'] == 1421 || $result['component']['id'] == 1422 || $result['component']['id'] == 1424 || $result['component']['id'] == 1425 || $result['component']['id'] == 1426 || $result['component']['id'] == 1258 || $result['component']['id'] == 1260 || $result['component']['id'] == 1265 || $result['component']['id'] == 1418 || $result['component']['id'] == 1423)

                                    @else
                                        @if($result['component']['title'])
                                            <tr>
                                                <td colspan="5" class="component_title test_name">
                                                    <b>{{$result['component']['name']}}</b>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="text-captitalize test_name">{{$result["component"]["name"]}}</td>
                                                <td align="center" class="result">{{$result["result"]}}</td>
                                                <td align="center" class="unit">{{$result["component"]["unit"]}}</td>
                                                <td align="center" class="reference_range">
                                                    {!! $result["component"]["reference_range"] !!}
                                                </td>
                                                <td align="center" class="status">
                                                    {{$result['status']}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                    @endif
                                @endforeach

                            @endforeach

                            <!-- Comment -->
                            @if(isset($test['comment']))
                                <tr class="comment">
                                    <td colspan="5">
                                        <table class="comment">
                                            <tbody>
                                            <tr>
                                                <th width="80px">
                                                    <b>Comment :</b>
                                                </th>
                                                <td>
                                                    {!! str_replace("\n", '<br />',  $test['comment']) !!}
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


                        <div class="row">
                            <div class="card-body p-0 col-lg-2">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr class="analysis_head">
                                            <th width="5%"> Test </th>
                                            <th width="10%" class="text-center">Relative Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category['tests'] as $test)
                                            @foreach($test["results"] as $result)


                                                @if(isset($result['component']))
                                                @if($result['component']['id'] == 1261 || $result['component']['id'] == 1262 || $result['component']['id'] == 1263 || $result['component']['id'] == 1264 || $result['component']['id'] == 1266 || $result['component']['id'] == 1267 || $result['component']['id'] == 1268)
                                                    <!-- Title -->

                                                    <tr>
                                                        <td>{{$result["component"]["name"]}}</td>
                                                        <!-- <td class="text-center">{{$result["result"]}}</td> -->
                                                        <!-- <td class="text-center">{{$result["component"]["unit"]}}</td> -->
                                                        <td class="text-center">
                                                        ({{$result["result"]}}) {{$result["component"]["unit"]}}  {!! $result["component"]["reference_range"] !!}
                                                        </td>

                                                    </tr>
                                                @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                        @if(isset($test['comment']))
                                        <tr>
                                            <td colspan="5">
                                                <table width="100%">
                                                    <tbody>
                                                        <tr class="comment">
                                                            <th width="90px">{{__('Comment')}} :</th>
                                                            <td>
                                                                {!! str_replace("\n", '<br />',  $test['comment']) !!}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>

                            <div class="card-body p-0 col-lg-2">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr class="analysis_head">
                                            <th width="10%" class="text-center">{{__('Absolute Count')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category['tests'] as $test)
                                            @foreach($test["results"] as $result)
                                                @if(isset($result['component']))
                                                @if($result['component']['id'] == 1419 || $result['component']['id'] == 1420 || $result['component']['id'] == 1421 || $result['component']['id'] == 1422 || $result['component']['id'] == 1424 || $result['component']['id'] == 1425 || $result['component']['id'] == 1426)
                                                    <!-- Title -->

                                                    <tr>
                                                        <!-- <td>{{$result["component"]["name"]}}</td> -->
                                                        <!-- <td class="text-center">{{$result["result"]}}</td> -->
                                                        <!-- <td class="text-center">{{$result["component"]["unit"]}}</td> -->
                                                        <td class="text-center">
                                                        ({{$result["result"]}}) {{$result["component"]["unit"]}}  {{ strip_tags($result["component"]["reference_range"]) }}
                                                        </td>

                                                    </tr>
                                                @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                        @if(isset($test['comment']))
                                        <tr>
                                            <td colspan="5">
                                                <table width="100%">
                                                    <tbody>
                                                        <tr class="comment">
                                                            <th width="90px">{{__('Comment')}} :</th>
                                                            <td>
                                                                {!! str_replace("\n", '<br />',  $test['comment']) !!}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>


                @else

                    @foreach($category['tests'] as $test)
                        @php
                            $count++;
                        @endphp
                        <table class="table test beak-page">
                            <thead>
                            <tr>
                                <th  class="test_title" align="center" colspan="5">
                                    <h5>{{$test['test']['name']}}</h5>
                                </th>
                            </tr>
                            <tr class="transparent">
                                <th colspan="5"></th>
                            </tr>
                            <tr class="test_head">
                                <th width="30%" class="text-left">Test</th>
                                <th width="17.5%">Result</th>
                                <th width="17.5%">Unit</th>
                                <th width="17.5%">Normal Range</th>
                                <th width="17.5%">Status</th>
                            </tr>
                            </thead>
                            <tbody class="table-bordered">
                            @foreach($test["results"] as $result)
                                <!-- Title -->
                                @if(isset($result['component']))
                                @if($result['component']['id'] == 1261 || $result['component']['id'] == 1262 || $result['component']['id'] == 1263 || $result['component']['id'] == 1264 || $result['component']['id'] == 1266 || $result['component']['id'] == 1267 || $result['component']['id'] == 1268 || $result['component']['id'] == 1419 || $result['component']['id'] == 1420 || $result['component']['id'] == 1421 || $result['component']['id'] == 1422 || $result['component']['id'] == 1424 || $result['component']['id'] == 1425 || $result['component']['id'] == 1426 || $result['component']['id'] == 1258 || $result['component']['id'] == 1260 || $result['component']['id'] == 1265 || $result['component']['id'] == 1418 || $result['component']['id'] == 1423)

                                @else
                                    @if($result['component']['title'])
                                        <tr>
                                            <td colspan="5" class="component_title test_name">
                                                <b>{{$result['component']['name']}}</b>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-captitalize test_name">{{$result["component"]["name"]}}</td>
                                            <td align="center" class="result">{{$result["result"]}}</td>
                                            <td align="center" class="unit">{{$result["component"]["unit"]}}</td>
                                            <td align="center" class="reference_range">
                                                {!! $result["component"]["reference_range"] !!}
                                            </td>
                                            <td align="center" class="status">
                                                {{$result['status']}}
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                @endif
                            @endforeach
                            <!-- Comment -->
                            @if(isset($test['comment']))
                                <tr class="comment">
                                    <td colspan="5">
                                        <table class="comment">
                                            <tbody>
                                            <tr>
                                                <th width="80px">
                                                    <b>Comment :</b>
                                                </th>
                                                <td>
                                                    {!! str_replace("\n", '<br />',  $test['comment']) !!}
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
                    @endforeach




                    <div class="row">
                        <div class="card-body p-0 col-lg-2">
                            <table class="table table-striped table-bordered table-sm">
                                <thead>
                                    <tr class="analysis_head">
                                        <th width="5%">Test</th>
                                        <th width="10px" class="text-center">Relative Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category['tests'] as $test)
                                        @foreach($test["results"] as $result)


                                            @if(isset($result['component']))
                                            @if($result['component']['id'] == 1261 || $result['component']['id'] == 1262 || $result['component']['id'] == 1263 || $result['component']['id'] == 1264 || $result['component']['id'] == 1266 || $result['component']['id'] == 1267 || $result['component']['id'] == 1268)
                                                <!-- Title -->

                                                <tr>
                                                    <td>{{$result["component"]["name"]}}</td>
                                                    <!-- <td class="text-center">{{$result["result"]}}</td> -->
                                                    <!-- <td class="text-center">{{$result["component"]["unit"]}}</td> -->
                                                    <td class="text-center">
                                                    ({{$result["result"]}}) {{$result["component"]["unit"]}}  {!! $result["component"]["reference_range"] !!}
                                                    </td>

                                                </tr>
                                            @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                    @if(isset($test['comment']))
                                    <tr>
                                        <td colspan="5">
                                            <table width="100%">
                                                <tbody>
                                                    <tr class="comment">
                                                        <th width="90px">{{__('Comment')}} :</th>
                                                        <td>
                                                            {!! str_replace("\n", '<br />',  $test['comment']) !!}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>

                        <div class="card-body p-0 col-lg-2">
                            <table class="table table-striped table-bordered table-sm">
                                <thead>
                                    <tr class="analysis_head">
                                        <th width="10px" class="text-center">{{__('Absolute Count')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category['tests'] as $test)
                                        @foreach($test["results"] as $result)
                                            @if(isset($result['component']))
                                            @if($result['component']['id'] == 1419 || $result['component']['id'] == 1420 || $result['component']['id'] == 1421 || $result['component']['id'] == 1422 || $result['component']['id'] == 1424 || $result['component']['id'] == 1425 || $result['component']['id'] == 1426)
                                                <!-- Title -->

                                                <tr>
                                                    <!-- <td>{{$result["component"]["name"]}}</td> -->
                                                    <!-- <td class="text-center">{{$result["result"]}}</td> -->
                                                    <!-- <td class="text-center">{{$result["component"]["unit"]}}</td> -->
                                                    <td class="text-center">
                                                    ({{$result["result"]}}) {{$result["component"]["unit"]}}  {{ strip_tags($result["component"]["reference_range"]) }}
                                                    </td>

                                                </tr>
                                            @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                    @if(isset($test['comment']))
                                    <tr>
                                        <td colspan="5">
                                            <table width="100%">
                                                <tbody>
                                                    <tr class="comment">
                                                        <th width="90px">{{__('Comment')}} :</th>
                                                        <td>
                                                            {!! str_replace("\n", '<br />',  $test['comment']) !!}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>




                @endif

            @endif

            @if(count($category['cultures']))
                @foreach($category['cultures'] as $culture)
                    @php
                        $count++;
                    @endphp
                    @if($count>1)
                    <pagebreak>
                    @endif
                    <!-- culture title -->
                    <h5 class="test_title" align="center">
                        {{$culture['culture']['name']}}
                    </h5>
                    <!-- /culture title -->

                    <!-- culture options -->
                    <table class="table" width="100%">
                        <tbody>
                            @foreach($culture['culture_options'] as $culture_option)
                                @if(isset($culture_option['value'])&&isset($culture_option['culture_option']))
                                    <tr>
                                        <th class="no-border test_name" width="10px" nowrap="nowrap" align="left">
                                            <span class="option_title">{{$culture_option['culture_option']['value']}} :</span>
                                        </th>
                                        <td class="no-border result">
                                            {{$culture_option['value']}}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /culture options -->

                    <!-- sensitivity -->
                    <table class="table table-bordered sensitivity" width="100%">
                        <thead class="test_head">
                            <tr>
                                <th align="left">Name</th>
                                <th align="center">Sensitivity</th>
                                <th align="left">Commercial name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($culture['high_antibiotics'] as $antibiotic)
                                <tr>
                                    <td width="200px" nowrap="nowrap" align="left" class="antibiotic_name">
                                        {{$antibiotic['antibiotic']['name']}}
                                    </td>
                                    <td width="120px" nowrap="nowrap" align="center" class="sensitivity">
                                        {{$antibiotic['sensitivity']}}
                                    </td>
                                    <td class="commercial_name">
                                        {{$antibiotic['antibiotic']['commercial_name']}}
                                    </td>
                                </tr>
                            @endforeach

                            @foreach($culture['moderate_antibiotics'] as $antibiotic)
                                <tr>
                                    <td width="200px" nowrap="nowrap" align="left">
                                        {{$antibiotic['antibiotic']['name']}}
                                    </td>
                                    <td width="120px" nowrap="nowrap" align="center">
                                        {{$antibiotic['sensitivity']}}
                                    </td>
                                    <td>
                                        {{$antibiotic['antibiotic']['commercial_name']}}
                                    </td>
                                </tr>
                            @endforeach

                            @foreach($culture['resident_antibiotics'] as $antibiotic)
                            <tr>
                                <td width="200px" nowrap="nowrap" align="left">
                                    {{$antibiotic['antibiotic']['name']}}
                                </td>
                                <td width="120px" nowrap="nowrap" align="center">
                                    {{$antibiotic['sensitivity']}}
                                </td>
                                <td>
                                    {{$antibiotic['antibiotic']['commercial_name']}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Comment -->
                    @if(isset($culture['comment']))
                    <table width="100%"  class="comment">
                        <tbody>
                            <tr>
                                <td width="10px" nowrap="nowrap no-border"><b>Comment</b> :</td>
                                <td>
                                    {!! str_replace("\n", '<br />',  $culture['comment']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    <!-- /comment -->
                    @if($count>1)
                    </pagebreak>
                    @endif
                @endforeach
            @endif
        @endif
    @endforeach

</div>

@endsection