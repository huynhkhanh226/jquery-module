@extends('layout.layoutM')
@section('content')
    <div class="row">
        <div class="col-xs-12" style="padding: 0px;">
            @define $arrID = array('');
            @define $arrName = array('');
            @foreach($reportTypeList as $row)
                @if (array_search($row['ReportGroupID'], $arrID) == "")
                    @define array_push($arrID,$row['ReportGroupID']);
                    @define array_push($arrName,$row['ReportGroupName']);
                @endif
            @endforeach
            @define $i = 1;
            @while ($i < sizeof($arrID))
                @foreach($reportTypeList as $row)
                    @if ($arrID[$i] == $row['ReportGroupID'])
                        <a  href="{{url('/W94F3000').'/'.$pFrom.'/'.$g.'/'.$row['MReportID']}}"
                            style="padding-left: 35px !important;" class="list-group-item"><i
                                    class="fa fa-area-chart text-yellow"></i> &nbsp; {{$row['MReportName']}}</a>
                    @endif
                @endforeach
                @define $i = $i + 1;
            @endwhile
        </div>
    </div>
@stop


