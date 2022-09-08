<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>
        @yield('title')
    </title>

    <style>
        @if($type==3||$type==4||$type==5||$type==6||$type==7)
        @page {
                margin-top: {{$reports_settings['margin-top']}}px;
                margin-right: {{$reports_settings['margin-right']}}px;
                margin-left: {{$reports_settings['margin-left']}}px;
                margin-bottom: {{$reports_settings['margin-bottom']}}px;
            }
        @else
            @page {
                header: page-header;
                footer: page-footer;

            margin-left: {{ $reports_settings['margin-left'] }}px;
            margin-right: {{ $reports_settings['margin-right'] }}px;

            margin-top: 300px;
            margin-header: 0px;

            margin-bottom: 115px;


                margin-footer: 0px;


            }
        @endif

        .table-bordered {
            border: 1px solid black;
            border-collapse: collapse;
            background-color: white!important;
        }

        .table-bordered,
        .table-bordered td {
            border: 1px solid black;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid black !important;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            height:2px;
            padding: 1px;
        }
        table td,th{
            padding: 1px;
            height:2px;
        }
        .title{
            background-color: #fff;
        }
        .branch_name{
            color:{{$reports_settings['branch_name']['color']}}!important;
            font-size:{{$reports_settings['branch_name']['font-size']}}!important;
            font-family:{{$reports_settings['branch_name']['font-family']}}!important;
        }
        .branch_info{
            color:{{$reports_settings['branch_info']['color']}}!important;
            font-size:{{$reports_settings['branch_info']['font-size']}}!important;
            font-family:{{$reports_settings['branch_info']['font-family']}}!important;
        }
        .title{
            color:{{$reports_settings['patient_title']['color']}}!important;
            font-size:{{$reports_settings['patient_title']['font-size']}}!important;
            font-family:{{$reports_settings['patient_title']['font-family']}}!important;
            text-align: right!important;
        }
        .data{
            color:{{$reports_settings['patient_data']['color']}}!important;
            font-size:{{$reports_settings['patient_data']['font-size']}}!important;
            font-family:{{$reports_settings['patient_data']['font-family']}}!important;
        }
        .header{
            border:{{$reports_settings['report_header']['border-width']}} solid {{$reports_settings['report_header']['border-color']}};
            background-color:{{$reports_settings['report_header']['background-color']}};
            text-align:{{$reports_settings['report_header']['text-align']}}!important;
        }
        .footer{
            border:{{$reports_settings['report_footer']['border-width']}} solid {{$reports_settings['report_footer']['border-color']}};
            background-color:{{$reports_settings['report_footer']['background-color']}};
            color:{{$reports_settings['report_footer']['color']}}!important;
            font-size:{{$reports_settings['report_footer']['font-size']}}!important;
            font-family:{{$reports_settings['report_footer']['font-family']}}!important;
            text-align:{{$reports_settings['report_footer']['text-align']}}!important;
        }
        .signature{
            color:{{$reports_settings['signature']['color']}}!important;
            font-size:{{$reports_settings['signature']['font-size']}}!important;
            font-family:{{$reports_settings['signature']['font-family']}}!important;
        }
        @if(session('rtl'))
            .pdf-header{
                direction:rtl;
            }
        @endif
    </style>

</head>
<body>

@if($type!==3&&$type!==4&&$type!==5&&$type!==6&&$type!==7)
        <htmlpageheader name="page-header">
<div align="center">

    <img src="https://lab.kashlab.info/img/logo.png"  max-width="150px" max-height="150px" padding-bottom="50px;">
    <br> 

</div>
<br> 
            @if (isset($group['patient']))
                <table width="100%" class="table table-bordered pdf-header" padding-top="350px;">

                    <tbody>
                        <tr>
                            <td rowspan="4">
                                @if (isset($group['patient']))
                                    <img src="https://chart.googleapis.com/chart?chs={{ $reports_settings['qrcode-dimension'] }}x{{ $reports_settings['qrcode-dimension'] }}&cht=qr&chl={{ url('patient/login/' . $group['patient']['code']) }}&choe=UTF-8"
                                        title="Link to Google.com" />
                                @endif

                            </td>
                            @if (isset($group['patient']) && $group['patient']['avatar'] && $reports_settings['show_avatar'])
                                <td rowspan="4">
                                    <img src="@if (!empty($group['patient']['avatar'])) {{ url('uploads/patient-avatar/' . $group['patient']['avatar']) }} @else {{ url('img/avatar.png') }} @endif"
                                        max-width="100px" max-height="100px">

                                </td>
                            @endif
                            <td>
                                <span class="title">{{ __('Name') }}: </span> <span class="data">
                                    @if (isset($group['patient']))
                                        {{ $group['patient']['name'] }}
                                    @endif
                                </span>

                            </td>

                            <td>

                                <span class="title">{{ __('Referred By') }}:</span> <span
                                    class="data">
                                    @if (isset($group['doctor']))
                                        {{ $group['doctor']['name'] }}
                                    @endif
                                </span>

                            </td>

                            </td>
                        </tr>


                        <tr>

                            </td>
                            <td>
                                <span class="title">{{ __('Gender') }}: </span> <span
                                    class="data">
                                    @if (isset($group['patient']))
                                        {{ __($group['patient']['gender']) }}
                                    @endif
                                </span>

                            </td>

                            <td>
                                <span class="title">{{ __('Age') }}:</span><span class="data">
                                    @if (isset($group['patient']))
                                        {{ $group['patient']['age'] }}
                                    @endif
                                </span>

                            </td>


                        <tr>
                            @if (isset($group['patient']) && $group['patient']['passport_no'])
                                <td>
                                    <span class="title">{{ __('Passport No.') }}:</span>
                                    <span class="data">
                                        {{ $group['patient']['passport_no'] }}
                                    </span>

                                </td>
                            @endif
                            <td>
                                <span class="title">{{ __('Patient Code') }}:</span>
                                <span class="data">
                                    @if (isset($group['patient']))
                                        {{ __($group['patient']['code']) }}
                                    @endif
                                </span>

                            </td>
                        </tr>
                        <tr>
                            <td>

                                <span class="title">{{ __('Sample collection date') }}:</span>
                                <span class="data">{{ $group['sample_collection_date'] }}
                                </span>

                            </td>
                            <td>
                                <span class="title">{{ __('Requested Date') }}: </span>
                                <span class="data">
                                    {{ date('d-m-Y H:i', strtotime($group['signed_date'])) }}
                                </span>

                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif






        </htmlpageheader>
    @endif
    @yield('content')




</body>

</html>
