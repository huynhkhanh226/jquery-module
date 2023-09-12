<div class="ft_container heightW27F3400" id="divContainerW27F3400" style="width: 100%;">
    <div class="ft_rel_container">
        <table class="ft_rc " style="width: 160px;">
            <thead>
            <tr>
                <th class="flashreport">Flash Report</th>
            </tr>
            </thead>
        </table>
        <div class="ft_cwrapper heightW27F3400" style="width: 161px;">
            <table class="ft_c" id="tabLeftW27F3400" style="width: 161px; top: 0px;">
                <thead>
                <tr>
                    <th style="width: 160px;" class="flashreport">Flash Report</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rsData as $row)
                    <tr class="ui-widget-content detail-row {{$row["ClassParent"]}} {{$row["IsHide"]==1?"hide":""}}" data-parent="{{$row["Parent"]}}" data-id="{{$row["DateID"]}}">
                        <td class="fixcol detail-date" data-mode="0" data-parent="{{$row["Parent"]}}"
                            data-id="{{$row["DateID"]}}" {{"style='min-width: 160px;max-width: 160px;background-color:".$row["Color"].";color:".$row["ColorText"].";".($row["IsChild"]==0 ? "cursor:pointer":"")."'"}}>
                            @if ($row["IsChild"]==0)
                                {{str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",str_pad("", $row["Level"], "-"));}}
                                <span style="cursor: default" class="fa fa-plus-square-o"></span>&nbsp;                            &nbsp;
                            @endif
                            {{$row["Date"]}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ft_rwrapper widthW27F3400">
            <table class="ft_r widthW27F3400" style="left: 0px;">
                <thead>
                {{$header}}
                </thead>
            </table>
        </div>
        <div class="ft_scroller heightW27F3400" id="scrollW27F3400">
            <table id="tableW27F3400Main" class="widthW27F3400">
                <thead>
                {{$header}}
                </thead>
                <tbody>
                @foreach($rsData as $row)
                    <tr class="ui-widget-content detail-row {{$row["ClassParent"]}} {{$row["IsHide"]==1?"hide":""}}" data-parent="{{$row["Parent"]}}" data-id="{{$row["DateID"]}}">
                        <td class="fixcol detail-date" data-mode="0" data-parent="{{$row["Parent"]}}"
                            data-id="{{$row["DateID"]}}" {{"style='min-width: 160px;max-width: 160px;background-color:".$row["Color"].";color:".$row["ColorText"].";".($row["IsChild"]==0 ? "cursor:pointer":"")."'"}}>
                            {{$row["Parent"]=="" && $row["IsChild"]==1 ?"":"&nbsp;&nbsp;"}}
                            @if ($row["IsChild"]==0)
                                <span style="cursor: default" class="fa fa-plus-square-o"></span>&nbsp;
                            @elseif ($row["IsChild"]==1 && $row["Level"]==0)
                                &nbsp;
                            @else
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                            {{$row["Date"]}}</td>
                        @foreach($arrayField as $field)
                            <td class="text-right {{($showdetail==1 && !($row["IsChild"]==1 && $row["Level"]==0)) || ($showdetail==0 && $row["Parent"]!="" && !($row["IsChild"]==1 && $row["Level"]==0))?"cell-detail":""}}" data-dateid="{{$row["DateID"]}}"
                                data-field="{{htmlspecialchars ($field["FieldName"])}}"
                                style="{{("min-width:".$field["Length"]."px")}};">{{number_format($row[$field["FieldName"]], $field["NumberFormat"])}}</td>
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
<section id="cellW27F3400"></section>
<script>
    var heiFlashReport = $("#scrollW27F3400 th.flashreport").height();
    $("#divContainerW27F3400 .ft_rc th.flashreport").height(heiFlashReport);
    $("#divContainerW27F3400 .ft_cwrapper th.flashreport").height(heiFlashReport);

    $(".ft_cwrapper").on("dblclick", ".detail-date", function () {
        showChild(this);
    });

    $(".ft_cwrapper").on("click", ".detail-date span", function () {
        showChild($(this).parent());
    });

    $("#scrollW27F3400").on("click",".cell-detail", function () {
        $("#divContainerW27F3400 .l3-loading").removeClass("hide");
        $(".qtip").remove();
        var cell = $(this);
        var id = cell.attr("data-dateid");
        var field = cell.attr("data-field");
        $.ajax({
            method: "POST",
            url: "{{url('W27F3400/showDetail')}}",
            data: {div: '{{$division}}', id: id, field: field, showdetail: '{{$showdetail}}', property: '{{$property}}', subdiv: '{{$subdiv}}', protype: '{{$protype}}', redate:"{{$redate}}"},
            success: function (data) {
                cell.qtip({
                    overwrite: true, // Make sure the tooltip won't be overridden once created
                    content: data,
                    show: {
                        event: "click", // Use the same show event as triggered event handler
                        ready: true // Show the tooltip immediately upon creation
                    },
                    style: {
                        classes: 'qtip-blue qtip-shadow qtipW27F3400'
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
                            $('#pgrid_W27F3400_Detail').pqGrid("refreshDataAndView");
                            $("#divContainerW27F3400 .l3-loading").addClass("hide");
                        }
                    }
                });
            }
        });
    });

    function showChild(cell) {
        $("#divContainerW27F3400 .l3-loading").removeClass("hide");
        var id = $(cell).attr("data-id");
        var mode = $(cell).attr("data-mode");
        if (mode == "0") {
            if ($(cell).hasClass("rowloaded")){//Đã load chi tiết
                //Show all child row from next level
                $("#scrollW27F3400").find("tr.detail-row[data-parent=" + id + "]").removeClass("hide");
                $(".ft_cwrapper").find("tr.detail-row[data-parent=" + id + "]").removeClass("hide");
                $("#divContainerW27F3400 .l3-loading").addClass("hide");
            }else{
                var arrF = {{json_encode($arrayField)}};
                $.ajax({
                    method: "POST",
                    url: "{{url('W27F3400/showRow')}}",
                    data: {arrayField: arrF, dateid: id, showdetail: '{{$showdetail}}'},
                    success: function (data) {
                        var row_index = $(cell).parent().index();
                        var currentObject = $.parseJSON(data);
                        $('#tabLeftW27F3400 > tbody > tr').eq(row_index).after(currentObject.row1);
                        $('#tableW27F3400Main > tbody > tr').eq(row_index).after(currentObject.row2);
                        $("#scrollW27F3400").getNiceScroll().resize();
                        $("#divContainerW27F3400 .l3-loading").addClass("hide");
                    }
                });
            }
            $(cell).attr("data-mode", "1");
            $(cell).find("span").removeClass("fa-plus-square-o");
            $(cell).find("span").addClass("fa-minus-square-o");
            $(cell).addClass("rowloaded");
        } else {
            //Hide all row have class contain id
            $("#scrollW27F3400").find("tr.detail-row."+id).addClass("hide");
            $(".ft_cwrapper").find("tr.detail-row."+id).addClass("hide");
            $(".ft_cwrapper").find("tr.detail-row."+id).find("span").addClass("fa-plus-square-o");
            $(".ft_cwrapper").find("tr.detail-row."+id).attr("data-mode", "0");
            $(cell).attr("data-mode", "0");
            $(cell).find("span").addClass("fa-plus-square-o");
            $(cell).find("span").removeClass("fa-minus-square-o");
            $("#divContainerW27F3400 .l3-loading").addClass("hide");
        }
        $("#scrollW27F3400").getNiceScroll().resize();
    }
    //Resize all header by ft_container
    var wiW27F3400 = $(".ft_container").width();
    $(".widthW27F3400").width(wiW27F3400);
    $(".ft_rwrapper.widthW27F3400").width(wiW27F3400 + 20);
    var heightW27F3400 = $("#modalW27F3400").find(".modal-content").height() - $("#frmW27F3400").height();
    $(".heightW27F3400").height(heightW27F3400 - 50);

    $("#scrollW27F3400").niceScroll({
        autohidemode: true,
        cursorwidth: '10px'
    });

    //Set position when scroll
    $("#scrollW27F3400").scroll(function () {
        $(".qtip").remove();
        $("#divContainerW27F3400 .ft_c").css('top', ($(this).scrollTop() * -1));
        $(".ft_r.widthW27F3400").css('left', ($(this).scrollLeft() * -1));
    });
</script>
