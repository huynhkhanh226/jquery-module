@if ($isShowPlan==1)
    <div class="checkbox mgt3">
        <label>
            <input type="checkbox" class="chkIsPlanW47F3000" id="chkIsPlanW47F3000{{$itemcode}}" {{$isPlan==1?'checked':''}}> {{Helpers::getRS($g,"Ke_hoach_thanh_toan_gia_dinh")}}
        </label>
    </div>
@endif
<div class="ft_container heightW47F3000" id="divContainerW47F3000{{$itemcode}}" style="width: 100%;">
    <div class="ft_rel_container">
        <table class="ft_rc">
            <thead>
            <tr style="line-height:1.4;">
                @define $fixwidth = 0;
                @foreach($rsColLevel0 as $col0)
                    @define if($col0['IsFixed']==0)break;
                    <th style="min-width: {{$col0['Length']}}px;max-width: {{$col0['Length']}}px;background-color: #0065B2;color: #ffffff;">{{$col0['Caption']}}
                        @if ($col0['IsFilter'] == 1)
                            <button class="btnSearchW47F3000 no-border pull-right pdt0 pdb0" data-fieldname="{{$col0['FieldName']}}"><span class="fa fa-search"></span></button>
                        @endif
                    </th>
                    @define $fixwidth += $col0['Length']
                @endforeach
            </tr>
            {{--<tr style="line-height:1.4;">
                @define $fixwidth = 0;
                @foreach($rsColLevel1 as $col1)
                    @define if($col1['IsFixed']==0) break;
                    <th style="min-width: {{$col1['Length']}}px;max-width: {{$col1['Length']}}px;background-color: #0065B2;color: #ffffff;height: 25.5px !important">{{$col1['Caption']}}

                    </th>
                    @define $fixwidth += $col1['Length']
                @endforeach
            </tr>--}}
            </thead>
        </table>
        <div class="ft_cwrapper heightW47F3000" style="width: {{$fixwidth+1}}px;">
            <table class="ft_c" id="tabLeftW47F3000" style="width: {{$fixwidth -2}}px; top: 0px;">
                <thead>
                <tr>
                    @foreach($rsColLevel0 as $col0)
                        @define if($col0['IsFixed']==0)break;
                        <th style="min-width: {{$col0['Length']}}px;max-width: {{$col0['Length']}}px;background-color: #0065B2;color: #ffffff;">{{$col0['Caption']}}</th>
                    @endforeach
                </tr>
                 {{--<tr>
                    @foreach($rsColLevel1 as $col1)
                        @define if($col1['IsFixed']==0)break;
                        <th style="min-width: {{$col1['Length']}}px;max-width: {{$col1['Length']}}px;background-color: #0065B2;color: #ffffff;height: 25.5px">{{$col1['Caption']}}</th>
                    @endforeach
                </tr>--}}
                </thead>
                <tbody>
                @foreach($rsData as $row)
                    @define $colcount = 0
                    @define $colspan = intval($row['Colspan'])
                    <tr class="ui-widget-content detail-row">
                        @foreach($rsColLevel0 as $col)
                            @if($colcount == 0 || $colcount >= $colspan)
                                @define if($col['IsFixed']==0)break;
                                @define $format =json_decode($row[$col['FieldName'].'_Format'],true)
                                <td {{$colspan>0 && $colcount==0?'colspan="'.$colspan.'"':''}} class="fixcol" data-fieldname="{{$col['FieldName']}}" style="{{$format['Style']}}">
                                    {{$col['Decimals']=="-1"?$row[$col['FieldName']]:($row[$col['FieldName']] != ''?number_format($row[$col['FieldName']],$col['Decimals']): '')}}
                                </td>
                            @endif
                            @define $colcount += 1
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ft_rwrapper widthW47F30001">
            <table class="ft_r widthW47F3000" style="left: 0px;">
                <thead>
                <tr>
                    @foreach($rsColLevel0 as $col0)
                        <th style="min-width: {{$col0['Length']}}px;max-width: {{$col0['Length']}}px;background-color: #0065B2;color: #ffffff;">{{$col0['Caption']}}</th>
                    @endforeach
                </tr>
                {{--<tr>
                    @foreach($rsColLevel1 as $col1)
                        <th style="min-width: {{$col1['Length']}}px;max-width: {{$col1['Length']}}px;background-color: #0065B2;color: #ffffff;">{{$col1['Caption']}}</th>
                    @endforeach
                </tr>--}}
                </thead>
            </table>
        </div>
        <div class="ft_scroller heightW47F3000" id="scrollW47F3000">
            <table id="tableW47F3000Main" class="widthW47F3000" style="border-right: solid 1px #DDDDDD">
                <thead>
                <tr>
                    @foreach($rsColLevel0 as $col0)
                        <th style="min-width: {{$col0['Length']}}px;min-width: {{$col0['Length']}}px;background-color: #0065B2;color: #ffffff;">{{$col0['Caption']}}</th>
                    @endforeach
                </tr>
                {{--<tr>
                    @foreach($rsColLevel1 as $col1)
                        <th style="min-width: {{$col1['Length']}}px;min-width: {{$col1['Length']}}px;background-color: #0065B2;color: #ffffff;">{{$col1['Caption']}}</th>
                    @endforeach
                </tr>--}}
                </thead>
                <tbody>

                @define $rowIndx = 0
                @foreach($rsData as $row)
                    @define $colcount = 0
                    @define $colspan = intval($row['Colspan'])
                    <tr class="ui-widget-content detail-row">

                        @foreach($rsColLevel0 as $col)
                            @if($colcount == 0 || $colcount >= $colspan)
                                @define $format =json_decode($row[$col['FieldName'].'_Format'],true)
                                @define $value = $col['Decimals']=="-1"?$row[$col['FieldName']]:($row[$col['FieldName']] != ''?number_format($row[$col['FieldName']],$col['Decimals']): '')
                                @define $valueCAmount = $col['Decimals']=="-1"?$row[$col['FieldName']]:($row[$col['FieldName'].'_QD'] != ''?number_format($row[$col['FieldName'].'_QD'],$col['Decimals']): '')
                                <td {{$colspan>0 && $colcount==0?'colspan="'.$colspan.'"':''}} class="fixcol" style="{{$format['Style']}}" data-fieldname="{{$col['FieldName']}}"
                                    data-contractNo="{{$row['ContractNo']}}" data-oAmount="{{$valueCAmount}}" data-scheduleDate="{{$col['Caption']}}" data-parameter="{{$row['Parameter']}}">
                                    @if ($format['IsHyperlink'] == 1)
                                        <a class="text-blue" onclick="showW47F3001(this);">{{$value}}</a>
                                    @else
                                        {{$value}}
                                    @endif
                                </td>
                            @endif
                            @define $colcount += 1
                        @endforeach
                        @define $rowIndx += 1
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="background-color: #EFF9FF;position: absolute;z-index: 1000;top: 74px;border: solid 1px #3C8DBC;" class="divSearchW47F3000 pd10 hide">
    <div class="input-group">
        <input id="txtSearchW47F3000" type="text" style="width: 100%" class="form-control">
        <span class="input-group-btn">
            <button type="button" class="btn btn-default btn-flat" style="padding: 2px 12px !important"><span class="fa fa-remove text-red"></span></button>
        </span>
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
            $('.divSearchW47F3000').addClass('hide');
        });

        //Bắt event trên cột fix và scroll
        $('#divContainerW47F3000{{$itemcode}} .ft_cwrapper.heightW47F3000').on('mousewheel', function (event) {
            var pos = $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").scrollTop();
            if (event.deltaY < 0) {
                $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").scrollTop(pos + 30);
            } else {
                $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").scrollTop(pos - 30);
            }
            $('.divSearchW47F3000').addClass('hide');
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
                    data: {itemcode: itemcode, array: arrayMasterW47F3000, level: level, parameter: parameter, isPlan: isPlan},
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

    //Xóa toàn bộ tab hiện tại và load lại
    $('.tabW47F3000').on('change', '#chkIsPlanW47F3000{{$itemcode}}', function () {
        var isPlan = $(this).is(':checked') ? 1 : 0;
        $("#modalW47F3000 .cube-loading").removeClass("hide");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {itemcode: '{{$itemcode}}', array: arrayMasterW47F3000, level: '{{$level}}', parameter: '{{$parameter}}', isPlan: isPlan, isShowPlan: '{{$isShowPlan}}', template: 1},
            success: function (data) {
                $("#tabChild_{{$itemcode}}").html(data);
                $("#modalW47F3000 .cube-loading").addClass("hide");
            }
        });
    });

    //Hiển thị modal Lập giả định - W47F3001
    var showW47F3001 = function (ahref) {
        console.log("test");
        var cell = $(ahref).parent();
        $("#modalW47F3001").find(".lblContractNo").html($(cell).attr('data-contractNo'));
        $("#modalW47F3001").find(".lblOAmount").html($(cell).attr('data-oAmount'));
        $("#modalW47F3001").find(".lblScheduleDate").html($(cell).attr('data-scheduleDate'));
        $("#modalW47F3001").find("#hdContractID").val($(cell).attr('data-contractID'));
        $("#modalW47F3001").find("#hdParameter").val($(cell).attr('data-parameter'));
        $("#modalW47F3001").find("#slMoneyUnitID").val('{{$unit}}');
        $('#modalW47F3001').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
    };

    $("#divContainerW47F3000{{$itemcode}}").on('click', '.btnSearchW47F3000', function () {
        if ($('.divSearchW47F3000').hasClass('hide')) {
            $('.divSearchW47F3000').removeClass('hide');
            var pos = $(this).closest('th').offset();
            $('.divSearchW47F3000').css({'left': (pos.left + 1) + 'px', 'top': '105px', 'width': ($(this).closest('th').width() + 8) + 'px'});//('left',pos.left);
            $('.divSearchW47F3000 input#txtSearchW47F3000').attr('data-fieldname', $(this).attr('data-fieldname'));
            $('.divSearchW47F3000 input#txtSearchW47F3000').focus();
        } else {
            $('.divSearchW47F3000').addClass('hide');
        }
    });

    //div search trên cột Số HĐ, chỉ dùng cho cột này
    $('.divSearchW47F3000').on('keypress', 'input#txtSearchW47F3000', function (e) {
        if (e.keyCode == 13) {
            return false; // prevent the button click from happening
        } else if (e.keyCode == 27) {
            $('.divSearchW47F3000').addClass('hide');
            return false; // prevent the button click from happening
        }
    });

    $('.divSearchW47F3000').on('click', 'button', function (e) {
        $('.divSearchW47F3000 input#txtSearchW47F3000').val('');
        $('.divSearchW47F3000 input#txtSearchW47F3000').trigger('keyup');
    });

    //div search trên cột Số HĐ, chỉ dùng cho cột này
    $('.divSearchW47F3000').on('keyup', 'input#txtSearchW47F3000', function (e) {
        var fname = $(this).attr('data-fieldname');
        var val = $(this).val();
        $('#divContainerW47F3000{{$itemcode}} .heightW47F3000 tbody tr').each(function () {
            var tr = $(this);
            if (tr.find('td[data-fieldname=' + fname + ']').text().indexOf(val)>-1) {
                tr.removeClass('hide');
            }else{
                tr.addClass('hide');
            }
        });
        $("#divContainerW47F3000{{$itemcode}} #scrollW47F3000").getNiceScroll().resize();
    });
</script>
<style>
    .nicescroll-cursors{
        z-index: 99999 !important;
    }
</style>