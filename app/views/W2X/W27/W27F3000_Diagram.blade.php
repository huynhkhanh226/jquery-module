@if (isset($rs[0]["Caption"]))
    <table id="tblW27F3000_Diagram" class='diagram' border='1' cellpadding='0' cellspacing='0' valign="middle" >
        <thead>
        <tr>
            <th class="storey"><div class="headerDiagram">Storey</div></th>
            @define $iUnit = array()
            @foreach ($rs  as $row)
                {{--@if ($row['IsHide']==0)--}}
                <th><div class="headerDiagram">{{$row['Caption']}}</div></th>
                @define array_push($iUnit,$row['GroupField'])
                {{--@endif--}}
            @endforeach
        </tr>
        </thead>
        @define $icount = 0
        @foreach ($connection->select("EXEC W27P3000 '$div', '".$input['proid']."', '".$input['tags']."', '".$input['level01']."', '".$input['level02']."', '".Session::get('Lang')."', 0, '".Auth::user()->user()->UserID."', 'D27F3000', '".$input['protype']."'") as $row)
            <tr>
                <td class="no-padding"><div class="headerDiagram leftDiagram">{{$row['FloorID']}}</div></td>
                @for($i=0;$i<count($iUnit);$i++)
                    @define $count = $row['Count_'.$iUnit[$i]]
                    @if ($count==0)
                        <td class='no-office'></td>
                    @else
                        <td class='no-office' nowrap>
                            <div style="float: left;display: inline-flex;position:relative;width: 100%">
                                @define $max = 100/$count
                                @for($co=1;$co<=$count;$co++)
                                    @define $field = $iUnit[$i]."_".$co
                                    <div class='{{$i==0?"office mrgl":"office"}}' id='{{$row['OfficeNo_'.$field]}}'
                                         style='width: {{$max}}%;background-color:{{$row['ColorCode_'.$field]}};position:relative;'>{{$row['Description_'.$field]}}
                                        <br><a class="glyphicon glyphicon-circle-info text-black pull-right"
                                               offno="{{$row['OfficeNo_'.$field]}}" mode="0"
                                               proid="{{$input['proid']}}"></a>
                                        @if ($row['IsBooking_'.$field]=="1")
                                            <a class="glyphicon glyphicon-hand-up text-black pull-right"
                                               offno="{{$row['OfficeNo_'.$field]}}" mode="1"
                                               proid="{{$input['proid']}}"></a>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </td>
                    @endif
                @endfor
            </tr>
            @define $icount ++
        @endforeach

    </table>
@else
    <div class="row">
        <div class="col-md-12 text-center">
            <label>{{Helpers::getRS($g,"Khong_co_du_lieuU")}}</label>
        </div>
    </div>
@endif
<script>
    $(document).ready(function () {
        $("#tblW27F3000_Diagram").tableHeadFixer({"head": true, "left": 1});
        $("#modalW27F3000").find("#divTopDiagramW27F3000").html("&nbsp;{{isset($rs[0]['Description']) ? $rs[0]['Description'] : ""}}");
    });
</script>