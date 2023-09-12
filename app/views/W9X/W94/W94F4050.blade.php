<div class="modal draggable fade modal" id="modalW94F4050" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW94F4050" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($title,"W94F4050")}}
                </div>
                <div class="modal-body pd10">
                    <form id="frmW94F4050">
                        <div class="row form-group">
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Ngan_sach")}}</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <select class="form-control noUseValidHTML5 select2 required" id="cboBudgetIDW94F4050"
                                        name="cboBudgetIDW94F4050" required>
                                    @foreach($rsBudgetList as $row)
                                        <option value="{{$row["BudgetID"]}}">{{$row["BudgetName"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Tu_ky")}}</label>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-3">
                                <select class="form-control noUseValidHTML5 select2" id="cboPeriodFromW94F4050"
                                        name="cboPeriodFromW94F4050" required>
                                </select>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Den_ky")}}</label>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-3">
                                <select class="form-control noUseValidHTML5 select2" id="cboPeriodToW94F4050"
                                        name="cboPeriodToW94F4050" required>

                                </select>
                            </div>
                            <div class="col-md-1">
                                <button id="btnFilterW94F4050" type="button"
                                        class="btn btn-default smallbtn pull-right mgr5"><span
                                            class="digi digi-filter"></span>
                                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                <input type="submit" class="hide" id="btnSubmitFilterW94F4050"/>
                            </div>
                        </div>

                    </form>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div id="gridW94F4050"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var obj = {
        width: '100%',
        height: $(document).height() - 115,
        editable: false,
        freezeCols: 1,
        minWidth: 30,
        pageModel: {type: "local", rPP: 20},
        filterModel: {on: true, mode: "AND", header: true},
        selectionModel: {type: 'cell', mode: 'single'},
        scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
        showTitle: false,
        dataType: "JSON",
        wrap: true,
        hwrap: false,
        collapsible: false,
        postRenderInterval: -1,
        colModel: [
            {
                title: "{{Helpers::getRS($g,"Ma_ngan_sach")}}",
                minWidth: 80,
                width: 110,
                sortable: false,
                dataType: "string",
                dataIndx: "BudgetItemID",
                align: "left",
                filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
            }
            , {
                title: "{{Helpers::getRS($g,"Ten_ngan_sach")}}",
                minWidth: 80,
                width: 270,
                sortable: false,
                dataType: "string",
                dataIndx: "BudgetItemName",
                align: "left",
                filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
            }
            , {
                title: function (ui) {
                    var title = '';
                    if ($("#cboPeriodFromW94F4050").val() == $("#cboPeriodToW94F4050").val()) {
                        title = "{{Helpers::getRS(0, 'Ky')}}" + " (" + $("#cboPeriodFromW94F4050").val() + ")";
                    } else {
                        title = "{{Helpers::getRS(0, 'Tu_ky')}}" + " (" + $("#cboPeriodFromW94F4050").val() + ") " + "{{Helpers::getRS(0, "Den_ky")}}" + " (" + $("#cboPeriodToW94F4050").val() + ")";
                    }
                    if ($("#cboPeriodFromW94F4050").val() == '' || $("#cboPeriodFromW94F4050").val() == null){
                        title = '';
                    }
                    return title;
                },
                minWidth: 80,
                dataIndx: "PeriodFromTo",
                sortable: false,

                colModel: [
                    {
                        title: "{{Helpers::getRS($g,"Gia_tri_ngan_sach")}}",
                        minWidth: 80,
                        width: 120,
                        sortable: false,
                        dataType: "float",
                        dataIndx: "BudgetAmount",
                        align: "right",
                        format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                        filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                        render: function(ui){
                            console.log(ui);
                            var rowData = ui.rowData;
                            var style = "";
                            var str = ui.formatVal == null || ui.formatVal == 0? "" : ui.formatVal;
                            var before = "";
                            var after = "";
                            var fontColor = rowData.FontColor+ ";";
                            var backgroundColor = rowData.BackgroundColor+ ";";
                            var fontStyle = rowData.FontStyle;

                            if (fontColor != '')
                                style+="color:" + fontColor;
                            if (backgroundColor != '')
                                style+="background-color:" + backgroundColor;
                            if (fontStyle != ''){
                                if (fontStyle.indexOf('B') != -1)
                                    before += "<B>";
                                if (fontStyle.indexOf('I') != -1)
                                    before += "<I>";
                                if (fontStyle.indexOf('U') != -1)
                                    before += "<U>";
                                if (fontStyle.indexOf('B') != -1)
                                    after += "</B>";
                                if (fontStyle.indexOf('I') != -1)
                                    after += "</I>";
                                if (fontStyle.indexOf('U') != -1)
                                    after += "</U>";
                            }
                            return {
                                text: "<SPAN style='"+style+"'>" + before + str + after+ "</SPAN>",
                                style: style
                            };
                        }
                    }
                    , {
                        title: "% {{Helpers::getRS($g,"Gia_tri_ngan_sach")}}",
                        minWidth: 80,
                        width: 130,
                        sortable: false,
                        dataType: "float",
                        dataIndx: "PerBudget",
                        align: "right",
                        format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D08_RatioDecimals'])}}",
                        filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                        render: function(ui){
                            var rowData = ui.rowData;
                            var style = "";
                            var str = ui.formatVal == null || ui.formatVal == 0? "" : ui.formatVal;
                            var before = "";
                            var after = "";
                            var fontColor = rowData.FontColor+ ";";
                            var backgroundColor = rowData.BackgroundColor+ ";";
                            var fontStyle = rowData.FontStyle;

                            if (fontColor != '')
                                style+="color:" + fontColor;
                            if (backgroundColor != '')
                                style+="background-color:" + backgroundColor;
                            if (fontStyle != ''){
                                if (fontStyle.indexOf('B') != -1)
                                    before += "<B>";
                                if (fontStyle.indexOf('I') != -1)
                                    before += "<I>";
                                if (fontStyle.indexOf('U') != -1)
                                    before += "<U>";
                                if (fontStyle.indexOf('B') != -1)
                                    after += "</B>";
                                if (fontStyle.indexOf('I') != -1)
                                    after += "</I>";
                                if (fontStyle.indexOf('U') != -1)
                                    after += "</U>";
                            }
                            return {
                                text: "<SPAN style='"+style+"'>" + before + str + after+ "</SPAN>",
                                style: style
                            };
                        }
                    }
                    , {
                        title: "{{Helpers::getRS($g,"Gia_tri_thuc_te")}}",
                        minWidth: 80,
                        width: 120,
                        sortable: false,
                        dataType: "float",
                        dataIndx: "ActualAmount",
                        align: "right",
                        format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                        filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                        render: function(ui){
                            var rowData = ui.rowData;
                            var style = "";
                            var str = ui.formatVal == null || ui.formatVal == 0? "" : ui.formatVal;
                            var before = "";
                            var after = "";
                            var fontColor = rowData.FontColor+ ";";
                            var backgroundColor = rowData.BackgroundColor+ ";";
                            var fontStyle = rowData.FontStyle;

                            if (fontColor != '')
                                style+="color:" + fontColor;
                            if (backgroundColor != '')
                                style+="background-color:" + backgroundColor;
                            if (fontStyle != ''){
                                if (fontStyle.indexOf('B') != -1)
                                    before += "<B>";
                                if (fontStyle.indexOf('I') != -1)
                                    before += "<I>";
                                if (fontStyle.indexOf('U') != -1)
                                    before += "<U>";
                                if (fontStyle.indexOf('B') != -1)
                                    after += "</B>";
                                if (fontStyle.indexOf('I') != -1)
                                    after += "</I>";
                                if (fontStyle.indexOf('U') != -1)
                                    after += "</U>";
                            }
                            return {
                                text: "<SPAN style='"+style+"'>" + before + str + after+ "</SPAN>",
                                style: style
                            };
                        }
                    }
                    , {
                        title: "% {{Helpers::getRS($g,"Gia_tri_thuc_te")}}",
                        minWidth: 80,
                        width: 120,
                        sortable: false,
                        dataType: "float",
                        dataIndx: "PerAmount",
                        align: "right",
                        format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D08_RatioDecimals'])}}",
                        filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                        render: function(ui){
                            var rowData = ui.rowData;
                            var style = "";
                            var str = ui.formatVal == null || ui.formatVal == 0? "" : ui.formatVal;
                            var before = "";
                            var after = "";
                            var fontColor = rowData.FontColor+ ";";
                            var backgroundColor = rowData.BackgroundColor+ ";";
                            var fontStyle = rowData.FontStyle;

                            if (fontColor != '')
                                style+="color:" + fontColor;
                            if (backgroundColor != '')
                                style+="background-color:" + backgroundColor;
                            if (fontStyle != ''){
                                if (fontStyle.indexOf('B') != -1)
                                    before += "<B>";
                                if (fontStyle.indexOf('I') != -1)
                                    before += "<I>";
                                if (fontStyle.indexOf('U') != -1)
                                    before += "<U>";
                                if (fontStyle.indexOf('B') != -1)
                                    after += "</B>";
                                if (fontStyle.indexOf('I') != -1)
                                    after += "</I>";
                                if (fontStyle.indexOf('U') != -1)
                                    after += "</U>";
                            }
                            return {
                                text: "<SPAN style='"+style+"'>" + before + str + after+ "</SPAN>",
                                style: style
                            };
                        }
                    }
                    , {
                        title: "{{Helpers::getRS($g,"So_sanh")}}",
                        minWidth: 80,
                        width: 120,
                        sortable: false,
                        dataType: "float",
                        dataIndx: "BudgetDifference",
                        align: "right",
                        format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                        filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                        render: function(ui){
                            var rowData = ui.rowData;
                            var style = "";
                            var str = ui.formatVal == null || ui.formatVal == 0? "" : ui.formatVal;
                            var before = "";
                            var after = "";
                            var fontColor = rowData.FontColor+ ";";
                            var backgroundColor = rowData.BackgroundColor+ ";";
                            var fontStyle = rowData.FontStyle;

                            if (fontColor != '')
                                style+="color:" + fontColor;
                            if (backgroundColor != '')
                                style+="background-color:" + backgroundColor;
                            if (fontStyle != ''){
                                if (fontStyle.indexOf('B') != -1)
                                    before += "<B>";
                                if (fontStyle.indexOf('I') != -1)
                                    before += "<I>";
                                if (fontStyle.indexOf('U') != -1)
                                    before += "<U>";
                                if (fontStyle.indexOf('B') != -1)
                                    after += "</B>";
                                if (fontStyle.indexOf('I') != -1)
                                    after += "</I>";
                                if (fontStyle.indexOf('U') != -1)
                                    after += "</U>";
                            }
                            return {
                                text: "<SPAN style='"+style+"'>" + before + str + after+ "</SPAN>",
                                style: style
                            };
                        }
                    }
                    , {
                        title: "% {{Helpers::getRS($g,"Ngan_sach")}}",
                        minWidth: 80,
                        width: 110,
                        sortable: false,
                        dataType: "float",
                        dataIndx: "BudgetPercent",
                        align: "right",
                        format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D08_RatioDecimals'])}}",
                        filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                        render: function(ui){
                            var rowData = ui.rowData;
                            var style = "";
                            var str = ui.formatVal == null || ui.formatVal == 0? "" : ui.formatVal;
                            var before = "";
                            var after = "";
                            var fontColor = rowData.FontColor+ ";";
                            var backgroundColor = rowData.BackgroundColor+ ";";
                            var fontStyle = rowData.FontStyle;

                            if (fontColor != '')
                                style+="color:" + fontColor;
                            if (backgroundColor != '')
                                style+="background-color:" + backgroundColor;
                            if (fontStyle != ''){
                                if (fontStyle.indexOf('B') != -1)
                                    before += "<B>";
                                if (fontStyle.indexOf('I') != -1)
                                    before += "<I>";
                                if (fontStyle.indexOf('U') != -1)
                                    before += "<U>";
                                if (fontStyle.indexOf('B') != -1)
                                    after += "</B>";
                                if (fontStyle.indexOf('I') != -1)
                                    after += "</I>";
                                if (fontStyle.indexOf('U') != -1)
                                    after += "</U>";
                            }
                            return {
                                text: "<SPAN style='"+style+"'>" + before + str + after+ "</SPAN>",
                                style: style
                            };
                        }
                    }
                ]
            }
        ],
        dataModel: {
            data: []
        }
    };
    $(document).ready(function () {
        var $gridW94F4050 = $("#gridW94F4050").pqGrid(obj);
        $gridW94F4050.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW94F4050.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW94F4050.pqGrid("refreshDataAndView");
        setTimeout(function () {
            resizePqGrid();
        }, 300);
        $("#cboBudgetIDW94F4050").val($("#cboBudgetIDW94F4050 option:first").val());
        $("#cboBudgetIDW94F4050").select2({
            containerCssClass : "required"
        });

        $("#cboBudgetIDW94F4050").change(function () {
            postMethod('{{url('/W94F4050/D94F4050/0/loadperiod')}}', function (res) {
                $("#cboPeriodFromW94F4050").html(res);
                $("#cboPeriodToW94F4050").html(res);
            }, {budgetID: $("#cboBudgetIDW94F4050").val()})
        });
        $("#cboBudgetIDW94F4050").trigger("change");
        $("#btnFilterW94F4050").click(function () {
            validationElements($("#frmW94F4050"), function () {
                var periodFrom = $("#cboPeriodFromW94F4050");
                var periodTo = $("#cboPeriodToW94F4050");
                var begin = convertStringToDate("01/" + periodFrom.val());
                var end = convertStringToDate("01/" + periodTo.val());

                if (daydiff(begin, end) < 0) {
                    periodFrom.val('');
                    periodFrom.get(0).setCustomValidity("{{Helpers::getRS($g,'Ky_tu_phai_nho_hon_ky_den')}}");
                }
                $("#btnSubmitFilterW94F4050").click();
            })
        });

        $("#frmW94F4050").on("submit", function (e) {
            e.preventDefault();

            $(".l3loading").removeClass('hide');
            postMethod('{{url('/W94F4050/D94F4050/0/filter')}}', function (res) {
                //res = reformatData(res,$("#gridW94F4050"));
                $("#gridW94F4050").pqGrid('option', 'dataModel.data', res);
                $("#gridW94F4050").pqGrid('refreshDataAndView');
                $(".l3loading").addClass('hide');
            }, $("#frmW94F4050").serialize());
        });
    });
</script>
