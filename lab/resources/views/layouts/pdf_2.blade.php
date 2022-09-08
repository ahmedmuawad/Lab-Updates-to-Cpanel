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
            margin-header: 150px;
            margin-bottom: 200px;
            margin-footer: 0px;
            }
        @endif


        table, th, td {
            border: 1px solid black;
            font-family:cairo!important;
            border-collapse: collapse;
          height: 20px;
        }
        td{
        padding: 2px;
        font-family:cairo!important;
        }
       .pinfo {
        border-collapse: collapse;
        font-family:cairo!important;
        border-radius: 10px;
        height: 30px;
        width: 100%;
       }
        .title{
            background-color: #ddd;
            font-family:{{$reports_settings['patient_title']['font-family']}}!important;
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
            background-color:{{$reports_settings['report_footer']['background-color']}};
            color:{{$reports_settings['report_footer']['color']}}!important;
            font-size:{{$reports_settings['report_footer']['font-size']}}!important;
            font-family:{{$reports_settings['report_footer']['font-family']}}!important;
            text-align:{{$reports_settings['report_footer']['text-align']}}!important;
        }
        .signature{
            align-content: right;
            padding-bottom: 100px;
            text-align: right;
            float: right;
            color:{{$reports_settings['signature']['color']}}!important;
            font-size:{{$reports_settings['signature']['font-size']}}!important;
            font-family:{{$reports_settings['signature']['font-family']}}!important;
        }

@if(session('rtl'))
            .pdf-header{
                direction:ltr;
            }
        @endif
    </style>

</head>
<body>

@if($type!==3&&$type!==4&&$type!==5&&$type!==6&&$type!==7)
        <htmlpageheader name="page-header">

            @if (isset($group['patient']))
            <table style="width: 100%;">

              <tr>
                 <td width="15%" style="background-color:#EBECF0;">Name:</td>
                  <td style="width:25%;">
                  @if (isset($group['patient']))
                     {{ $group['patient']['name'] }}
                 @endif</td>
                 <td style="background-color:#EBECF0;">Barcode:</td>
                 <td width="25%"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($group['barcode'], $barcode_settings['type'])}}" alt="barcode" class="margin"></td>
                 @if (isset($group['patient']) && $group['patient']['avatar'] && $reports_settings['show_avatar'])
                 <td rowspan="4"><img src="@if (!empty($group['patient']['avatar'])) {{ url('uploads/patient-avatar/' . $group['patient']['avatar']) }} @else {{ url('img/avatar.png') }} @endif"
                     max-width="90px" max-height="90px"></td>
                 @endif
                 <td rowspan="4"> @if (isset($group['patient']))
                     <img src="https://chart.googleapis.com/chart?chs={{ $reports_settings['qrcode-dimension'] }}x{{ $reports_settings['qrcode-dimension'] }}&cht=qr&chl={{ url('patient/login/' . $group['patient']['code']) }}&choe=UTF-8"
                         title="Link to Google.com" />
                 @endif</td>


              </tr>
              <tr>
                 <td style="background-color:#EBECF0;">P.Info:</td>
                 <td width="25%">
             <table class="pinfo">
             <tr>
               <td width="50%">
               @if (isset($group['patient']))
                     {{ __($group['patient']['gender']) }}
               @endif
               </td>
               <td width="50%">
               @if (isset($group['patient']))
                     {{ $group['patient']['age'] }}
               @endif</td>

             </tr>
             </table>
             </td>
                 <td style="background-color:#EBECF0;">Patient ID:</td>
                 <td width="25%">
                 @if (isset($group['patient']))
                     {{ __($group['patient']['code']) }}
                  @endif
                 </td>
              </tr>
                <tr>
                 <td style="background-color:#EBECF0;">Reffered by:</td>
                 <td width="25%">
                 @if (isset($group['doctor']))
                     {{ $group['doctor']['name'] }}
                 @endif
                 </td>
                 <td style="background-color:#EBECF0;">D.Collection:</td>
                 <td width="25%">{{ $group['sample_collection_date'] }}</td>
              </tr>
                @php
                    $num_date = '';
                    $diff = '';
                    $created_at_report = '';
                    // get num_date from relationship tests
                    $tests = $group->tests()->whereHas('test', function ($query) {
                        $query->where('num_day_receive', '!=', 0);
                    })->get();
                    if(count($tests)) {
                        foreach ($group['tests'] as $test) {
                            $num_date = $test->test->orderby('num_day_receive', 'desc')->first();
                            $created_at_report = $test;
                        }

                        // get created_at and add day use carbon
                        $created_at = $created_at_report ? $created_at_report->created_at : '';
                        if ($created_at) {
                            $created_at = \Carbon\Carbon::parse($created_at);
                            $diff = $created_at->addDays($num_date->num_day_receive);
                        }
                    } else {
                        foreach ($group['tests'] as $test) {
                            $num_date = $test->test->orderby('num_hour_receive', 'desc')->first();
                            $created_at_report = $test;
                        }

                        // get created_at and add day use carbon
                        $created_at = $created_at_report ? $created_at_report->created_at : '';
                        if ($created_at) {
                            $created_at = \Carbon\Carbon::parse($created_at);
                            $diff = $created_at->addHours($num_date->num_hour_receive);
                        }
                    }

                @endphp
              <tr>
                 <td style="background-color:#EBECF0;">D.Reporting:</td>
                  @if($diff)
                      <td width="25%"> {{ $diff->format('Y-m-d g:i A') }}</td>
                  @else
                      <td width="25%"> {{ date('d-m-Y H:i', strtotime($group['signed_date'])) }}</td>
                  @endif
                 @if (isset($group['patient']) && $group['patient']['passport_no'])
                 <td style="background-color:#EBECF0;">Passport:</td>
                 <td width="25%">{{ $group['patient']['passport_no'] }}</td>
                 @endif
              </tr>
              <tr>
                  <td width="15%" style="background-color:#EBECF0;">Branch:</td>
                  <td style="width:25%;">
                      {{ $group['branch']['name'] }}
                  </td>
                  <td width="15%" style="background-color:#EBECF0;">{{ __('Sample Collected') }}:</td>
                  <td style="width:25%;">
                      @if($group['is_out'])
                          <bdi>{{ __('Inside') }}</bdi> {{ $info['name'] }}
                      @else
                          <bdi>{{ __('Outside') }}</bdi> {{ $info['name'] }}
                      @endif
                  </td>

              </tr>

           </table>
          @endif
                  </htmlpageheader>
              @endif
                <br>
    <br>
              @yield('content')




              <htmlpagefooter name="page-footer" class="page-footer">
                @if ($type == 1)
                    @if ($reports_settings['show_signature'] || $reports_settings['show_qrcode'])
        <div class="signature">
                                        @if ($reports_settings['show_signature'])
                                            <p class="signature">

                                            </p>
                                        @endif

                                        @if ($reports_settings['show_signature'])
                                            @if (!empty($group['signed_by']))
                                                <p>
                                                    <img src="{{ url('uploads/signature/' . $group['signed_by_user']['signature']) }}"
                                                        alt="" height="150">
                                                </p>
                                            @endif
                                        @endif
        </div>
                    @endif
                @endif
    </htmlpagefooter>


</body>

</html>
