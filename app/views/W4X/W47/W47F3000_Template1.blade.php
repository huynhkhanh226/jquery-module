<div class="row">
    <div class="col-md-6">
        @if ($isShowPlan==1)
            <div class="checkbox mgt3">
                <label>
                    <input type="checkbox" class="chkIsPlanW47F3000" id="chkIsPlanW47F3000{{$itemcode}}" {{$isPlan==1?'checked':''}}> {{Helpers::getRS($g,"Ke_hoach_thanh_toan_gia_dinh")}}
                </label>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        @if ($isShowButton==1)
        <button type="button" class="btn btn-default smallbtn pull-right btnShowHistory{{$itemcode}}"><span class="fa fa-history"></span> {{Helpers::getRS($g,"Lich_su_gia_dinh")}}</button>
        @endif
    </div>
</div>
<div class="ft_container heightW47F3000" id="divContainerW47F3000{{$itemcode}}" style="width: 100%;">
    <div class="ft_rel_container">
        <table class="ft_rc" style="width: 401px;">
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
                    @define $format =json_decode($row['Format'],true)
                    <tr class="ui-widget-content detail-row {{$row["ParentID"]}}" style="{{$row['Style']}}" data-parent='{{$row["ParentID"]}}' data-itemcode='{{$row['ItemCode']}}'>
                        <td class="fixcol {{$format["IsShowDetail"]==1?'rowloaded':''}}" data-mode="{{$format["IsShowDetail"]}}" data-haschild="{{$format['IsHaveDetail']}}"
                            {{$format["IsColspan"]==1?'colspan="2"':''}} style="{{$row['Style']}};border-right: none" data-itemcode="{{$row['ItemCode']}}" data-level="{{$row['Level']}}"
                            data-parameter="{{ htmlspecialchars($row['Parameter']) }}" data-isPlan="{{$format['IsPlan']}}" data-isButtonHistory="{{$format['IsButtonHistory']}}">

                            @if ($format['IsHaveDetail']==1)
                                <span style="margin-left: {{$format["Margin"] * 4}}px" class="pointer fa {{$format["IsShowDetail"]==1?'fa-chevron-circle-down':'fa-chevron-circle-right'}}" id="spShowChild_{{$itemcode}}"></span>
                            @else
                                <span style="margin-left: {{$format["Margin"] * 5}}px">&nbsp;</span>
                            @endif
                            @if ($format['IsHyperlink']==1)
                                <a style="text-decoration: underline !important;" onclick="addTabW47F3000('{{$row["ItemCode"]}}', '{{$row["TabName"]}}', this, '{{$format["ViewTemplate"]}}',{{$format["IsBeginMonth"]}}, {{$format["IsPaging"]}})">
                                    {{$row["ItemDesc84"]}}
                                </a>
                            @else
                                {{$row["ItemDesc84"]}}
                            @endif
                        </td>
                        @if ($format['IsColspan']==0)
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
                @define $begin = new DateTime( $newDateFrom );
                @define $end = new DateTime( $dateto );
                @define $end = $end->modify( '+1 day' );
                @define $interval = DateInterval::createFromDateString('1 day');
                @define $period = new DatePeriod($begin, $interval, $end);
                @foreach ($period as $dt)
                    <th style="min-width: {{$widthcol}}px;max-width: {{$widthcol}}px;background-color: #0065B2;color: #ffffff;">{{$dt->format("d/m/Y")}}</th>
                @endforeach
                </thead>


            </table>
        </div>
        <div class="ft_scroller heightW47F3000" id="scrollW47F3000">
            <table id="tableW47F3000Main" class="widthW47F3000" style="border-right: solid 1px #DDDDDD">
                <thead>
                <th colspan="2" style="min-width: 400px;font-weight: normal;text-align: left !important;font-style: italic;">{{Helpers::getRS($g,"Don_vi_tinh").': '.$textunit}}</th>
                @foreach ( $period as $dt )
                    <th style="min-width: {{$widthcol}}px;max-width: {{$widthcol}}px;background-color: #0065B2;color: #ffffff;">{{$dt->format("d/m/Y")}}</th>
                @endforeach
                </thead>

                <tbody>
                @foreach($rsData as $row)
                    @define $format =json_decode($row['Format'],true)
                    <tr class="ui-widget-content detail-row {{$row["ParentID"]}}" style="{{$row['Style']}}" data-parent='{{$row["ParentID"]}}' data-itemcode='{{$row['ItemCode']}}'>
                        <td class="fixcol {{$format["IsShowDetail"]==1?'rowloaded':''}}" data-mode="{{$format["IsShowDetail"]}}"
                            {{$format["IsColspan"]==1?'colspan="2"':''}} style="{{$row['Style']}};border-right: none" data-itemcode="{{$row['ItemCode']}}" data-level="{{$row['Level']}}"
                            data-parameter="{{HTML::entities($row['Parameter'])}}" data-isPlan="{{$format['IsPlan']}}" data-isButtonHistory="{{$format['IsButtonHistory']}}">
                            @if ($format['IsHaveDetail']==1)
                                <span style="margin-left: {{$format["Margin"] * 4}}px" class="pointer fa {{$format["IsShowDetail"]==1?'fa-chevron-circle-down':'fa-chevron-circle-right'}}" id="spShowChild_{{$itemcode}}"></span>
                            @else
                                <span style="margin-left: {{$format["Margin"] * 5}}px">&nbsp;</span>
                            @endif
                            @if ($format['IsHyperlink']==1)
                                <a style="text-decoration: underline !important;" onclick="addTabW47F3000('{{$row["ItemCode"]}}', '{{$row["TabName"]}}', this, '{{$format["ViewTemplate"]}}',{{$format["IsBeginMonth"]}},{{$format["IsPaging"]}})">
                                    {{$row["ItemDesc84"]}}
                                </a>
                            @else
                                {{$row["ItemDesc84"]}}
                            @endif
                        </td>
                        @if ($format['IsColspan']==0)
                            <td class="fixcol" data-mode="0" style="{{$row['Style']}}">{{$row["ItemDesc01"]}}</td>
                        @endif
                        @foreach ( $period as $dt )
                            @define $format = json_decode($row[$dt->format("Ymd").'_Format'],true)
                            @define $value = $row[$dt->format("Ymd")]
                            <td style="{{$format['Style']}}">{{$format['Decimal']==-1?$value:$value==0 || $value==''?'':Helpers::formatNegativeNumber($value,$format['Decimal'])}}</td>
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
        @if ($isShowPlan==1)
        $("#divContainerW47F3000{{$itemcode}} .heightW47F3000").height(heightW47F3000 - 120);
        @else
        $("#divContainerW47F3000{{$itemcode}} .heightW47F3000").height(heightW47F3000 - 120);
        @endif

        $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").niceScroll({
            autohidemode: true,
            cursorwidth: '10px',
            hidecursordelay: 3000
        });

        $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").hover(function(){
            $(this).getNiceScroll().resize();
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

    //Event dành cho click các icon tại các node cha (IsHaveDetail = 1)
    $('#divContainerW47F3000{{$itemcode}}').on('click', '#spShowChild_{{$itemcode}}', function () {
        $("#divContainerW47F3000{{$itemcode}} .l3-loading").removeClass("hide");
        var cell = $(this).parent();
        var itemcode = $(cell).attr("data-itemcode");
        var level = $(cell).attr("data-level");
        var mode = $(cell).attr("data-mode");
        var parameter = $(cell).attr("data-parameter");
        var isPlan = $(cell).attr("data-isPlan");
        if (mode == "0") {
            if ($(cell).hasClass("rowloaded")) {//Đã load chi tiết thì ko load lại
                //Show all child row from next level
                $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").find("tr.detail-row[data-parent=" + itemcode + "]").removeClass("hide");
                $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row[data-parent=" + itemcode + "]").removeClass("hide");
                $("#divContainerW47F3000{{$itemcode}} .l3-loading").addClass("hide");
            } else {
                $("#modalW47F3000 .cube-loading").removeClass("hide");
                var isBeginMonth = {{$isBeginMonth}};
                $.ajax({
                    method: "POST",
                    url: "{{url('W47F3000/showRows')}}",
                    data: {itemcode: itemcode, array: arrayMasterW47F3000, level: level, parameter: parameter, isPlan: isPlan, isBeginMonth: isBeginMonth},
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
            hideChildW47F3000(itemcode);
            $(cell).attr("data-mode", "0");
            $(cell).find("span").addClass("fa-chevron-circle-right");
            $(cell).find("span").removeClass("fa-chevron-circle-down");
            $("#divContainerW47F3000{{$itemcode}} .l3-loading").addClass("hide");
        }
        $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").getNiceScroll().resize();
    });

    //Hàm đệ quy dùng để ẩn các row con theo n cấp
    var hideChildW47F3000 = function (itemcode) {
        var elem = $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").find("tr.detail-row." + itemcode);
        elem.each(function() {
            var ic = $(this).attr('data-itemcode');
            var haschild = $(this).attr('data-haschild');
            if(haschild==1){
                $(this).attr("data-mode", "0");
                $(this).find("span").addClass("fa-chevron-circle-right");
                $(this).find("span").removeClass("fa-chevron-circle-down");
            }
            hideChildW47F3000(ic);
        });
        if ($("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row." + itemcode).find("span").hasClass("fa-chevron-circle-down")){
            $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row." + itemcode).find("span").addClass("fa-chevron-circle-right");
            $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row." + itemcode).find("span").removeClass("fa-chevron-circle-down");
            $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row." + itemcode).attr("data-mode", "0");
            $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row." + itemcode +' td.fixcol').attr("data-mode", "0");
        }
        $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").find("tr.detail-row." + itemcode).addClass("hide");
        $("#divContainerW47F3000{{$itemcode}} .ft_cwrapper").find("tr.detail-row." + itemcode).addClass("hide");
    };

    //Xóa toàn bộ tab hiện tại và load lại
    $('#tabChild_{{$itemcode}}').on('change', '#chkIsPlanW47F3000{{$itemcode}}', function () {
        var isPlan = $(this).is(':checked') ? 1 : 0;
        $("#modalW47F3000 .cube-loading").removeClass("hide");
        $("#tabChild_{{$itemcode}}").off();
        $("#tabChild_{{$itemcode}}").children().off();
        $("#tabChild_{{$itemcode}}").empty();
        $('#divModalW47F3002').off();
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {itemcode: '{{$itemcode}}', array: arrayMasterW47F3000, level: '{{$level}}', parameter: '{{$parameter}}', isPlan: isPlan, isShowPlan: '{{$isShowPlan}}', isShowButton:'{{$isShowButton}}', IsBeginMonth: '{{$isBeginMonth}}'},
            success: function (data) {
                $("#tabChild_{{$itemcode}}").empty();
                $("#divModalW47F3002").empty();
                $("#modalW47F3002").empty();
                $("#tabChild_{{$itemcode}}").html(data);
                $("#modalW47F3000 .cube-loading").addClass("hide");
                console.log($('#modalW47F3002'));

            }
        });
    });

    //Hiển thị modal Lịch sử giả định - W47F3002
    $("#tabChild_{{$itemcode}}").on('click','.btnShowHistory{{$itemcode}}', function () {
        $("#modalW47F3000 .cube-loading").removeClass("hide");
        $.ajax({
            method: "GET",
            url: "{{'W47F3002'}}",
            data: {array: arrayMasterW47F3000, parameter: '{{$parameter}}', isPlan: '{{$isPlan}}'},
            success: function (data) {
                $("#divModalW47F3002").html(data);
                $('#modalW47F3002').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
                $("#modalW47F3000 .cube-loading").addClass("hide");
            }
        });
    });
</script>
<style>
    .nicescroll-cursors{
        z-index: 99999 !important;
    }
</style>