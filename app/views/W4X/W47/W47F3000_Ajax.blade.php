<div class="ft_container heightW47F3000" id="divContainerW47F3000{{$itemcode}}" style="width: 100%;">
    <div class="ft_rel_container">
        <table class="ft_rc " style="width: 401px;">
            <thead>
            <tr>
                <th colspan="2" style="min-width: 400px;font-weight: normal;text-align: left !important;font-style: italic;">{{Helpers::getRS($g,"Don_vi_tinh").': '.$textunit}}</th>
            </tr>
            </thead>
        </table>
        <div class="ft_cwrapper heightW47F3000" style="width: 401px;">
            <table class="ft_c" id="tabLeftW47F3000" style="width: 401px; top: 0px;">
                <thead>
                <tr>
                    <th colspan="2" style="min-width: 400px;font-weight: normal;text-align: left !important;font-style: italic;">{{Helpers::getRS($g,"Don_vi_tinh").': '.$textunit}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rsData as $row)
                    <tr class="ui-widget-content detail-row {{$row["ParentID"]}}" style="{{$row['Style']}}" data-parent='{{$row["ParentID"]}}' data-itemcode='{{$row['ItemCode']}}'>
                        <td class="fixcol {{$row["IsShowDetail"]==1?'rowloaded':''}}" data-mode="{{$row["IsShowDetail"]}}"
                            {{$row["IsColspan"]==1?'colspan="2"':''}} style="{{$row['Style']}};border-right: none" data-itemcode="{{$row['ItemCode']}}" data-level="{{$row['Level']}}">
                            @if ($row['IsHaveDetail']==1)
                                <span class="pointer fa {{$row["IsShowDetail"]==1?'fa-chevron-circle-down':'fa-chevron-circle-right'}}" id="spShowChild_{{$itemcode}}"></span>
                            @endif
                            @if ($row['IsHyperlink']==1)
                                <a style="text-decoration: underline !important;" onclick="addTabW47F3000('{{$row["ItemCode"]}}', '{{$row["TabName"]}}', this)">
                                    {{$row["ItemDesc84"]}}
                                </a>
                        </td>
                        @else
                        {{$row["ItemDesc84"]}}</td>
                        @endif
                        @if ($row['IsColspan']==0)
                            <td class="fixcol" data-mode="0" style="{{$row['Style']}}">{{$row["ItemDesc01"]}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ft_rwrapper widthW47F30001">
            <table class="ft_r widthW47F3000" style="left: 0px;">
                <thead>
                <th colspan="2" style="min-width: 400px;">&nbsp;</th>
                @define $begin = new DateTime( $datefrom );
                @define $end = new DateTime( $dateto );
                @define $end = $end->modify( '+1 day' );
                @define $interval = DateInterval::createFromDateString('1 day');
                @define $period = new DatePeriod($begin, $interval, $end);
                @foreach ($period as $dt)
                    <th style="min-width: 100px;max-width: 100px;background-color: #0065B2;color: #ffffff;">{{$dt->format("d/m/Y")}}</th>
                @endforeach
                </thead>
            </table>
        </div>
        <div class="ft_scroller heightW47F3000" id="scrollW47F3000">
            <table id="tableW47F3000Main" class="widthW47F3000" style="border-right: solid 1px #DDDDDD">
                <thead>
                <th colspan="2" style="min-width: 400px;font-weight: normal;text-align: left !important;font-style: italic;">{{Helpers::getRS($g,"Don_vi_tinh").': '.$textunit}}</th>
                @foreach ( $period as $dt )
                    <th style="min-width: 100px;max-width: 100px;background-color: #0065B2;color: #ffffff;">{{$dt->format("d/m/Y")}}</th>
                @endforeach
                </thead>
                <tbody>
                @foreach($rsData as $row)
                    <tr class="ui-widget-content detail-row {{$row["ParentID"]}}" style="{{$row['Style']}}" data-parent='{{$row["ParentID"]}}' data-itemcode='{{$row['ItemCode']}}'>
                        <td class="fixcol {{$row["IsShowDetail"]==1?'rowloaded':''}}" data-mode="{{$row["IsShowDetail"]}}"
                            {{$row["IsColspan"]==1?'colspan="2"':''}} style="{{$row['Style']}};border-right: none" data-itemcode="{{$row['ItemCode']}}" data-level="{{$row['Level']}}">
                            @if ($row['IsHaveDetail']==1)
                                <span class="pointer fa {{$row["IsShowDetail"]==1?'fa-chevron-circle-down':'fa-chevron-circle-right'}}" id="spShowChild_{{$itemcode}}"></span>
                            @endif
                            @if ($row['IsHyperlink']==1)
                                <a style="text-decoration: underline !important;" onclick="addTabW47F3000('{{$row["ItemCode"]}}', '{{$row["TabName"]}}', this)">
                                    {{$row["ItemDesc84"]}}
                                </a>
                        </td>
                        @else
                        {{$row["ItemDesc84"]}}</td>
                        @endif
                        @if ($row['IsColspan']==0)
                            <td class="fixcol" data-mode="0" style="{{$row['Style']}}">{{$row["ItemDesc01"]}}</td>
                        @endif
                        @foreach ( $period as $dt )
                            <td style="{{$row['Style']}}">{{$row[$dt->format("Ymd")]}}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        if (arrayMasterW47F3000 == null) arrayMasterW47F3000 = JSON.stringify({{json_encode($inputAll)}});
        //Resize all header by ft_container
        var wiW47F3000 = $("#divContainerW47F3000{{$itemcode}}").width();
        $("#divContainerW47F3000{{$itemcode}} .widthW47F3000").width(wiW47F3000);
        $("#divContainerW47F3000{{$itemcode}} .ft_rwrapper.widthW47F3000").width(wiW47F3000 + 20);
        $("#divContainerW47F3000{{$itemcode}} .heightW47F3000").height(heightW47F3000 - 197);

        $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").niceScroll({
            autohidemode: true,
            cursorwidth: '10px'
        });

        //Set position when scroll
        $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").scroll(function () {
            $("#divContainerW47F3000{{$itemcode}} .ft_c").css('top', ($(this).scrollTop() * -1));
            $("#divContainerW47F3000{{$itemcode}} .ft_r.widthW47F3000").css('left', ($(this).scrollLeft() * -1));
        });

        //Bắt event trên cột fix và scroll
        $('#divContainerW47F3000{{$itemcode}} .ft_cwrapper.heightW47F3000').on('mousewheel', function (event) {
            var pos = $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").scrollTop();
            if (event.deltaY < 0) {
                $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").scrollTop(pos + 30);
            } else {
                $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").scrollTop(pos - 30);
            }
        });
    });


    $('#divContainerW47F3000{{$itemcode}}').on('click', '#spShowChild_{{$itemcode}}', function () {
        $("#divContainerW47F3000{{$itemcode}} .l3-loading").removeClass("hide");
        var cell = $(this).parent();
        var itemcode = $(cell).attr("data-itemcode");
        var level = $(cell).attr("data-level");
        var mode = $(cell).attr("data-mode");
        if (mode == "0") {
            if ($(cell).hasClass("rowloaded")) {//Đã load chi tiết
                //Show all child row from next level
                $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").find("tr.detail-row[data-parent=" + itemcode + "]").removeClass("hide");
                $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row[data-parent=" + itemcode + "]").removeClass("hide");
                $("#divContainerW47F3000{{$itemcode}} .l3-loading").addClass("hide");
            } else {
                $("#modalW47F3000 .cube-loading").removeClass("hide");
                $.ajax({
                    method: "POST",
                    url: "{{url('W47F3000/showRows')}}",
                    data: {itemcode: itemcode, array: arrayMasterW47F3000, level: level},
                    success: function (data) {
                        var row_index = $(cell).parent().index();
                        var currentObject = $.parseJSON(data);
                        $('#divContainerW47F3000{{$itemcode}} #tabLeftW47F3000 > tbody > tr').eq(row_index).after(currentObject.row1);
                        $('#divContainerW47F3000{{$itemcode}} #tableW47F3000Main > tbody > tr').eq(row_index).after(currentObject.row2);
                        $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").getNiceScroll().resize();
                        $("#modalW47F3000 .cube-loading").addClass("hide");
                    }
                });
            }
            $(cell).attr("data-mode", "1");
            $(cell).find("span").removeClass("fa-chevron-circle-right");
            $(cell).find("span").addClass("fa-chevron-circle-down");
            $(cell).addClass("rowloaded");
        } else {
            //Hide all row have class contain id
            $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").find("tr.detail-row." + itemcode).addClass("hide");
            $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row." + itemcode).addClass("hide");
            $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row." + itemcode).find("span").addClass("fa-plus-square-o");
            $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row." + itemcode).attr("data-mode", "0");
            $(cell).attr("data-mode", "0");
            $(cell).find("span").addClass("fa-chevron-circle-right");
            $(cell).find("span").removeClass("fa-chevron-circle-down");
            $("#divContainerW47F3000{{$itemcode}} .l3-loading").addClass("hide");
        }
        $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").getNiceScroll().resize();
    });
</script>
