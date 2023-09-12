<div class="ft_container heightW47F3010" id="divContainerW47F3010{{$itemcode}}" style="width: 100%;">
    <div class="ft_rel_container">
        <table class="ft_rc">
            <thead>
            <tr>
                @define $fixwidth = 0;
                @define $daCheck = 0;
                @foreach($rsCol as $col)
                    @if ($col['IsFixed']==1 && $col['Caption'] != "")
                    <th colspan="{{$col['CountCol']}}" class="fix-header {{$col['ForecastYear'] == 0 || $col['ForecastYear'] == $btnYear || $col['ForecastYear'] == $year?'':'hide'}}" data-year="{{$col['ForecastYear']}}" style="min-width: {{$col['Length']}}px;max-width: {{$col['Length']}}px;background-color: #0065B2;color: #ffffff;height: 54px;">{{$col['Caption']}}</th>
                    @define $fixwidth += $col['Length']
                    @endif
                @endforeach
            </tr>
            </thead>
        </table>
        <div class="ft_cwrapper heightW47F3010" style="min-width: {{$fixwidth+1}}px;max-width: {{$fixwidth+1}}px;">
            <table class="ft_c" id="tabLeftW47F3010" style="min-width: {{$fixwidth+1}}px;max-width: {{$fixwidth+1}}px; top: 0px;">
                <thead>
                <tr>
                    @define $daCheck = 0;
                    @foreach($rsCol as $col)
                        @if ($col['IsFixed']==1 && $col['Caption'] != "")
                            <th colspan="{{$col['CountCol']}}" class="fix-header {{$col['ForecastYear'] == 0 || $col['ForecastYear'] == $btnYear || $col['ForecastYear'] == $year?'':'hide'}}" data-year="{{$col['ForecastYear']}}" style="min-width: {{$col['Length']}}px;max-width: {{$col['Length']}}px;background-color: #0065B2;color: #ffffff;">{{$col['Caption']}}</th>
                            @define $fixwidth += $col['Length']
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($rsData as $row)
                    <tr class="ui-widget-content detail-row {{$row["ParentNode"]=="" || $format["IsShowDetail"]==1?'':'hide'}}" data-parent='{{$row["ParentNode"]}}' data-itemcode='{{$row['ItemCode']}}'>
                        @foreach($rsCol as $col)
                            @define $count = 0
                            @if ($col['FieldName']!="" && $col['IsFixed']==1)
                                @define $format =json_decode($row['Format'],true)
                                @define $value = $col['Decimals']=="-1"?$row[$col['FieldName']]:($row[$col['FieldName']] != ''?number_format($row[$col['FieldName']],$col['Decimals']): '')
                                <td class="fixcol" data-year="{{$col['ForecastYear']}}" data-parent='{{$row["ParentNode"]}}' data-mode="{{$format["IsShowDetail"]}}" data-fieldname="{{$col['FieldName']}}" style="{{$format['StyleDescription']}}" data-itemcode="{{$row['ItemCode']}}" data-haschild="{{$format['IsHaveDetail']}}">
                                    @if($count ==0)
                                        @if ($format['IsHaveDetail']==1)
                                            <span style="margin-left: {{$format["Margin"] * 4}}px" class="pointer fa {{$format["IsShowDetail"]==1?'fa-chevron-circle-down':'fa-chevron-circle-right'}}" id="spShowChild_{{$itemcode}}"></span>
                                        @else
                                            <span style="margin-left: {{$format["Margin"] * 5}}px">&nbsp;</span>
                                        @endif
                                        @if ($format['IsHyperlink']==1)
                                            <a style="text-decoration: underline !important;" onclick="addTabW47F3010('{{$row["ItemCode"]}}','{{$row["Parameter"]}}', '{{$row["TabName"]}}', this)">
                                                {{$value}}
                                            </a>
                                        @else
                                            {{$value}}
                                        @endif
                                    @else
                                        {{$value}}
                                    @endif
                                </td>
                            @endif
                            @define $count += 1
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ft_rwrapper widthW47F30101">
            <table class="ft_r widthW47F3010" style="left: 0px;">
                <thead>
                @define $daCheck = "";
                @foreach($rsCol as $col)
                    @if($col['Level']!=$daCheck && $daCheck==0)
                        </tr><tr>
                    @endif
                    <th {{$col['IsFixed']==1?'':'colspan='.$col['CountCol']}} class="{{$col['ForecastYear'] == 0 || $col['ForecastYear'] == $btnYear || $col['ForecastYear'] == $year?'':'hide'}}" data-year="{{$col['ForecastYear']}}" style="min-width: {{$col['Length']}}px;max-width: {{$col['Length']}}px;background-color: #0065B2;color: #ffffff;">{{$col['Caption']}}</th>
                    @define $daCheck += $col['Level']
                @endforeach
                </thead>
            </table>
        </div>
        <div class="ft_scroller heightW47F3010 maintable3010 scrollW47F3010{{$itemcode}}" id="scrollW47F3010">
            <table id="tableW47F3010Main" class="widthW47F3010" style="border-right: solid 1px #DDDDDD">
                <thead>
                @define $daCheck = "";
                @foreach($rsCol as $col)
                @if($col['Level']!=$daCheck && $daCheck==0)
                </tr><tr>
                    @endif
                    <th {{$col['IsFixed']==1?'':'colspan='.$col['CountCol']}} class="{{$col['ForecastYear'] == 0 || $col['ForecastYear'] == $btnYear || $col['ForecastYear'] == $year?'':'hide'}}" data-year="{{$col['ForecastYear']}}" style="min-width: {{$col['Length']}}px;max-width: {{$col['Length']}}px;background-color: #0065B2;color: #ffffff;">{{$col['Caption']}}</th>
                    @define $daCheck += $col['Level']
                @endforeach
                </thead>
                <tbody>
                @foreach($rsData as $row)
                    <tr class="ui-widget-content detail-row {{$row["ParentNode"]=="" || $format["IsShowDetail"]==1?'':'hide'}}" data-parent='{{$row["ParentNode"]}}' data-itemcode='{{$row['ItemCode']}}'>
                        @define $count = 0
                        @foreach($rsCol as $col)
                            @if ($col['FieldName']!="")
                            @define $format =json_decode($row['Format'],true)
                            @define $value = $col['Decimals']=="-1"?$row[$col['FieldName']]:($row[$col['FieldName']] != ''?number_format($row[$col['FieldName']],$col['Decimals']): '')
                            <td class="fixcol {{$col['ForecastYear'] == 0 || $col['ForecastYear'] == $btnYear || $col['ForecastYear'] == $year?'':'hide'}}" data-mode="{{$format["IsShowDetail"]}}" data-year="{{$col['ForecastYear']}}" style="min-width: {{$col['Length']}}px;max-width: {{$col['Length']}}px;{{$col['IsFixed']==1?$format['StyleDescription']:$format['Style']}}" data-fieldname="{{$col['FieldName']}}" data-parent='{{$row["ParentNode"]}}' data-itemcode='{{$row['ItemCode']}}'>
                                @if($count==0)
                                    @if ($format['IsHaveDetail']==1)
                                        <span style="margin-left: {{$format["Margin"] * 4}}px" class="pointer fa {{$format["IsShowDetail"]==1?'fa-chevron-circle-down':'fa-chevron-circle-right'}}" id="spShowChild_{{$itemcode}}"></span>
                                    @else
                                        <span style="margin-left: {{$format["Margin"] * 5}}px">&nbsp;</span>
                                    @endif
                                    @if ($format['IsHyperlink']==1)
                                        <a style="text-decoration: underline !important;" onclick="addTabW47F3010('{{$row["ItemCode"]}}','{{$row["Parameter"]}}', '{{$row["TabName"]}}', this)">
                                            {{$value}}
                                        </a>
                                    @else
                                        {{$value==''?'&nbsp;':$value}}
                                    @endif
                                @else
                                    {{$value==''?'&nbsp;':$value}}
                                @endif
                            </td>
                            @define $count += 1
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@if ($itemcode == "")
    @include('W9X.W91.W91F4010')
@endif
<script>
    $(document).ready(function () {
        $('#secW47F3010 .btnReportYear').html(parseInt('{{$btnYear}}'));
        if (arrayMasterW47F3010 == null) arrayMasterW47F3010 = JSON.stringify({{json_encode($inputAll)}});
        yearW47F3010 = parseInt('{{$year}}');
        //Resize all header by ft_container
        var wiW47F3010 = $("#divContainerW47F3010{{$itemcode}}").width();
        $("#divContainerW47F3010{{$itemcode}} .widthW47F3010").width(wiW47F3010);
        $("#divContainerW47F3010{{$itemcode}} .ft_rwrapper.widthW47F3010").width(wiW47F3010 + 20);
        $("#divContainerW47F3010{{$itemcode}} .heightW47F3010").height(heightW47F3010 - 207);

        $("#divContainerW47F3010{{$itemcode}} .maintable3010").niceScroll({
            autohidemode: true,
            cursorwidth: '10px',
            hidecursordelay: 3000
        });

        //Set position when scroll
        $("#divContainerW47F3010{{$itemcode}} .maintable3010").scroll(function () {
            $("#divContainerW47F3010{{$itemcode}} .ft_c").css('top', ($(this).scrollTop() * -1));
            $("#divContainerW47F3010{{$itemcode}} .ft_r.widthW47F3010").css('left', ($(this).scrollLeft() * -1));
        });

        //Bắt event trên cột fix và scroll
        $('#divContainerW47F3010{{$itemcode}} .ft_cwrapper.heightW47F3010').on('mousewheel', function (event) {
            var pos = $("#divContainerW47F3010{{$itemcode}} #scrollW47F3010").scrollTop();
            if (event.deltaY < 0) {
                $("#divContainerW47F3010{{$itemcode}} #scrollW47F3010").scrollTop(pos + 30);
            } else {
                $("#divContainerW47F3010{{$itemcode}} #scrollW47F3010").scrollTop(pos - 30);
            }
        });
    });

    //Event dành cho click các icon tại các node cha (IsHaveDetail = 1)
    $('#divContainerW47F3010{{$itemcode}}').on('click', '#spShowChild_{{$itemcode}}', function () {
        $("#divContainerW47F3010{{$itemcode}} .l3-loading").removeClass("hide");
        var cell = $(this).parent();
        var itemcode = $(cell).attr("data-itemcode");
        var mode = $(cell).attr("data-mode");
        if (mode == "0") {
            //Show all child row from next level
            $("#divContainerW47F3010{{$itemcode}} #scrollW47F3010").find("tr.detail-row[data-parent='" + itemcode + "']").removeClass("hide");
            $("#divContainerW47F3010{{$itemcode}} .ft_cwrapper").find("tr.detail-row[data-parent='" + itemcode + "']").removeClass("hide");
            $("#divContainerW47F3010{{$itemcode}} .l3-loading").addClass("hide");
            $(cell).attr("data-mode", "1");
            $(cell).find("span").removeClass("fa-chevron-circle-right");
            $(cell).find("span").addClass("fa-chevron-circle-down");
        } else {
            //Hide all row have class contain id
            hideChildW47F3010(itemcode);
            $(cell).attr("data-mode", "0");
            $(cell).find("span").addClass("fa-chevron-circle-right");
            $(cell).find("span").removeClass("fa-chevron-circle-down");
            $("#divContainerW47F3010{{$itemcode}} .l3-loading").addClass("hide");
        }
        $("#divContainerW47F3010{{$itemcode}} #scrollW47F3010").getNiceScroll().resize();
    });

    //Hàm đệ quy dùng để ẩn các row con theo n cấp
    var hideChildW47F3010 = function (itemcode) {
        var elem = $("#divContainerW47F3010{{$itemcode}} #scrollW47F3010").find("tr.detail-row[data-parent='" + itemcode + "']");
        elem.each(function() {
            var ic = $(this).attr('data-itemcode');
            var haschild = $(this).attr('data-haschild');
            if(haschild==1){
                $(this).attr("data-mode", "0");
                $(this).find("span").addClass("fa-chevron-circle-right");
                $(this).find("span").removeClass("fa-chevron-circle-down");
            }
            hideChildW47F3010(ic);
        });
        if ($("#divContainerW47F3010{{$itemcode}} .ft_cwrapper").find("tr.detail-row[data-parent='" + itemcode + "']").find("span").hasClass("fa-chevron-circle-down")){
            $("#divContainerW47F3010{{$itemcode}} .ft_cwrapper").find("tr.detail-row[data-parent='" + itemcode + "']").find("span").addClass("fa-chevron-circle-right");
            $("#divContainerW47F3010{{$itemcode}} .ft_cwrapper").find("tr.detail-row[data-parent='" + itemcode + "']").find("span").removeClass("fa-chevron-circle-down");
            $("#divContainerW47F3010{{$itemcode}} .ft_cwrapper").find("tr.detail-row[data-parent='" + itemcode + "']").attr("data-mode", "0");
            $("#divContainerW47F3010{{$itemcode}} .ft_cwrapper").find("tr.detail-row[data-parent='" + itemcode + "'] td.fixcol").attr("data-mode", "0");
        }
        $("#divContainerW47F3010{{$itemcode}} #scrollW47F3010").find("tr.detail-row[data-parent='" + itemcode + "']").addClass("hide");
        $("#divContainerW47F3010{{$itemcode}} .ft_cwrapper").find("tr.detail-row[data-parent='" + itemcode + "']").addClass("hide");
    };

    //Phần set lại height cho đúng với header
    var capHeightW47F3010 = $('#divContainerW47F3010{{$itemcode}} .widthW47F3010 thead').height();
    if (capHeightW47F3010 < 53)capHeightW47F3010=53;
    $('#divContainerW47F3010{{$itemcode}} th.fix-header').height(capHeightW47F3010 - 7);
</script>
