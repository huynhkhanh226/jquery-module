<div class="ft_container heightW01F3040" id="divContainerW01F3040" style="width: 100%;">
    <div class="ft_rel_container">
        <table class="ft_rc table table-striped" style="width: 200px;">
            <thead>
            <tr>
                <th class="flashreport">Detail</th>
            </tr>
            </thead>
        </table>
        <div class="ft_cwrapper heightW01F3040" style="width: 200px;">
            <table class="ft_c table table-striped" id="tabLeftW01F3040" style="width: 200px; top: 0px;">
                <thead>
                <tr>
                    <th style="width: 200px;" class="flashreport">Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rsData as $row)
                    <tr class="ui-widget-content detail-row {{$row["ClassParent"]}} {{$row["IsHide"]==1?"hide":""}}" data-parent="{{$row["Parent"]}}" data-id="{{$row["DateID"]}}">
                        <td class="fixcol detail-date" data-mode="{{$showdetail}}" data-parent="{{$row["Parent"]}}"
                            data-id="{{$row["DateID"]}}" {{"style='min-width: 200px;max-width:200px;background-color:".$row["Color"].";color:".$row["ColorText"].";".($row["IsChild"]==0 ? "cursor:pointer":"")."'"}}>
                            @if ($row["IsChild"]==0)
                                {{str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",str_pad("", $row["Level"], "-"))}}
                                <span style="cursor: default" class="fa {{$showdetail == 1 && $row["Level"] == 0 ? 'fa-minus-square-o' : 'fa-plus-square-o'}}"></span>&nbsp;
                            @endif
                            {{$row["Date"]}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ft_rwrapper">
            <table class="ft_r widthW01F3040 table table-striped" style="left: 0px; width: auto !important;">
                <thead>
                {{$header}}
                </thead>
            </table>
        </div>
        <div class="ft_scroller heightW01F3040" id="scrollW01F3040">
            <table id="tableW01F3040Main" class="widthW01F3040 table table-striped" style="width: auto !important;">
                <thead>
                {{$header}}
                </thead>
                <tbody>
                @foreach($rsData as $row)
                    <tr class="ui-widget-content detail-row {{$row["ClassParent"]}} {{$row["IsHide"]==1?"hide":""}}" data-parent="{{$row["Parent"]}}" data-id="{{$row["DateID"]}}">
                        <td class="fixcol detail-date" data-mode="{{$showdetail}}" data-parent="{{$row["Parent"]}}"
                            data-id="{{$row["DateID"]}}" {{"style='min-width: 200px;max-width: 200px;background-color:".$row["Color"].";color:".$row["ColorText"].";".($row["IsChild"]==0 ? "cursor:pointer":"")."'"}}>
                            {{$row["Parent"]=="" && $row["IsChild"]==1 ?"":"&nbsp;&nbsp;"}}
                            @if ($row["IsChild"]==0)
                                <span style="cursor: default" class="fa {{$showdetail == 1 && $row["Level"] == 0 ? 'fa-minus-square-o' : 'fa-plus-square-o'}}"></span>&nbsp;
                            @elseif ($row["IsChild"]==1 && $row["Level"]==0)
                                &nbsp;
                            @else
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                            {{$row["Date"]}}</td>
                        @foreach($arrayField as $field)
                            @define $val = intval($row[$field["FieldName"]]) == 0 ? '' : number_format($row[$field["FieldName"]], $field["NumberFormat"])
                            @if ($field["IsHyperlink"] == 1)
                                <td  class="text-right {{($showdetail==1 && !($row["IsChild"]==1 && $row["Level"]==0)) || ($showdetail==0 && $row["Parent"]!="" && !($row["IsChild"]==1 && $row["Level"]==0))?"cell-detail":""}}" data-dateid="{{$row["DateID"]}}"
                                    data-field="{{htmlspecialchars ($field["FieldName"])}}"
                                    style="{{("min-width:".$field["Length"]."px")}}; {{$row['Style']}}"><a style="text-decoration: underline;" onclick="showFormDetailW01F3041('{{base64_encode(json_encode($row))}}', '{{$field["DivisionID"]}}', '{{$field["ProjectID"]}}')">{{$val}}</a></td>
                            @else
                                <td class="text-right {{($showdetail==1 && !($row["IsChild"]==1 && $row["Level"]==0)) || ($showdetail==0 && $row["Parent"]!="" && !($row["IsChild"]==1 && $row["Level"]==0))?"cell-detail":""}}" data-dateid="{{$row["DateID"]}}"
                                    data-field="{{htmlspecialchars ($field["FieldName"])}}"
                                    style="{{("min-width:".$field["Length"]."px")}}; {{$row['Style']}}">{{$val}}</td>
                            @endif

                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="l3-loading hide">
        <i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;Loading...
    </div>
</div>
<section id="cellW01F3040"></section>
<script>
    var heiFlashReport = $("#scrollW01F3040 th.flashreport").height();
    $("#divContainerW01F3040 .ft_rc th.flashreport").height(heiFlashReport);
    $("#divContainerW01F3040 .ft_cwrapper th.flashreport").height(heiFlashReport);

    $(".ft_cwrapper").on("dblclick", ".detail-date", function () {
        showChild(this);
    });

    $(".ft_cwrapper").on("click", ".detail-date span", function () {
        showChild($(this).parent());
    });

    $("#scrollW01F3040").on("click",".cell-detail", function () {
        /*$("#divContainerW01F3040 .l3-loading").removeClass("hide");
        $(".qtip").remove();
        var cell = $(this);
        var id = cell.attr("data-dateid");
        var field = cell.attr("data-field");
        $.ajax({
            method: "POST",
            url: "{{url('W01F3040/'.$pForm.'/'.$g.'/showDetail')}}",
            data: {div: '{{$division}}', id: id, field: field, showdetail: '{{$showdetail}}', property: '{{$property}}', subdiv: '{{$subdiv}}', redate:"{{$redate}}"},
            success: function (data) {
                cell.qtip({
                    overwrite: true, // Make sure the tooltip won't be overridden once created
                    content: data,
                    show: {
                        event: "click", // Use the same show event as triggered event handler
                        ready: true // Show the tooltip immediately upon creation
                    },
                    style: {
                        classes: 'qtip-blue qtip-shadow qtipW01F3040'
                    },
                    position: {
                        viewport: $(window),
                        my: 'bottom center',  // Position my top left...
                        at: 'top center' // at the bottom right of...
                        //target: cell // my target
                    },
                    hide: 'unfocus',
                    adjust: {
                        method: 'flipinvert flipinvert' // Requires Viewport plugin
                    },
                    events: {
                        visible: function (event, api) {
                            $('#pgrid_W01F3040_Detail').pqGrid("refreshDataAndView");
                            $("#divContainerW01F3040 .l3-loading").addClass("hide");
                        }
                    }
                });
            }
        });*/
    });

    function showChild(cell) {
        $("#divContainerW01F3040 .l3-loading").removeClass("hide");
        var id = $(cell).attr("data-id");
        var mode = $(cell).attr("data-mode");
        if (mode == "0") {
            if ($(cell).hasClass("rowloaded")){//Đã load chi tiết
                //Show all child row from next level
                $("#scrollW01F3040").find("tr.detail-row[data-parent=" + id + "]").removeClass("hide");
                $(".ft_cwrapper").find("tr.detail-row[data-parent=" + id + "]").removeClass("hide");
                $("#divContainerW01F3040 .l3-loading").addClass("hide");
            }else{

                var div = $('#cboDivisionIDW01F3040').val();
                var subdiv = $('#cboSubDivisionIDW01F3040').val();
                var property = $('#cboPropertyIDW01F3040').val();
                var isReceive = $("#chkIsReceiveW01F3040").is(':checked') ? 1 : 0;
                var isPayment = $("#chkIsPaymentW01F3040").is(':checked') ? 1 : 0;

                var arrF = {{json_encode($arrayField)}};
                var params = $("#frmW01F3040").serialize() + "&div=" + div + "&property=" + property + "&subdiv=" + subdiv + "&isReceive=" + isReceive + "&isPayment=" + isPayment;
                params += "&showdetail=" + '{{$showdetail}}';
                params += "&dateid=" + id;
                params += "&arrayField=" + "{{base64_encode(json_encode($arrayField))}}";
                $.ajax({
                    method: "POST",
                    url: "{{url('W01F3040/view/'.$pForm.'/'.$g.'/showRow')}}",
                    data: params,
                    success: function (data) {
                        var row_index = $(cell).parent().index();
                        var currentObject = $.parseJSON(data);
                        $('#tabLeftW01F3040 > tbody > tr').eq(row_index).after(currentObject.row1);
                        $('#tableW01F3040Main > tbody > tr').eq(row_index).after(currentObject.row2);
                        $("#scrollW01F3040").getNiceScroll().resize();
                        $("#divContainerW01F3040 .l3-loading").addClass("hide");
                    }
                });
            }
            $(cell).attr("data-mode", "1");
            $(cell).find("span").removeClass("fa-plus-square-o");
            $(cell).find("span").addClass("fa-minus-square-o");
            $(cell).addClass("rowloaded");
        } else {
            //Hide all row have class contain id
            $("#scrollW01F3040").find("tr.detail-row."+id).addClass("hide");
            $(".ft_cwrapper").find("tr.detail-row."+id).addClass("hide");
            $(".ft_cwrapper").find("tr.detail-row."+id).find("span").addClass("fa-plus-square-o");
            $(".ft_cwrapper").find("tr.detail-row."+id).attr("data-mode", "0");
            $(cell).attr("data-mode", "0");
            $(cell).find("span").addClass("fa-plus-square-o");
            $(cell).find("span").removeClass("fa-minus-square-o");
            $("#divContainerW01F3040 .l3-loading").addClass("hide");
        }
        $("#scrollW01F3040").getNiceScroll().resize();
    }
    //Resize all header by ft_container
    var wiW01F3040 = $("#divDetailW01F3040").width();
    $(".widthW01F3040").width(wiW01F3040);
    $(".ft_rwrapper.widthW01F3040").width(wiW01F3040 + 20);
    var heightW01F3040 = $("#divD01F3040_W01F3040_W01F3040").height() - $("#frmW01F3040").height() + 30;
    $(".heightW01F3040").height(heightW01F3040 - 50);

    $("#scrollW01F3040").niceScroll({
        autohidemode: true,
        cursorwidth: '10px'
    });

    //Set position when scroll
    $("#scrollW01F3040").scroll(function () {
        $(".qtip").remove();
        $("#divContainerW01F3040 .ft_c").css('top', ($(this).scrollTop() * -1));
        $(".ft_r.widthW01F3040").css('left', ($(this).scrollLeft() * -1));
    });

    function showFormDetailW01F3041(rowText, divisionID, projectID){
        var rowData =  JSON.parse(atob(rowText));
        console.log(rowData);
        showFormDialogPost("{{url('W01F3041/'.$pForm.'/'.$g)}}", "modalW01F3041", {
            divisionID: divisionID,
            projectID: projectID,
            yearShow: $("#cboYearShowW01F3040").val(),
            reportDate : $("#txtReportDateW01F3040").val(),
            dateID: rowData.DateID
        }, null);

    }
</script>
