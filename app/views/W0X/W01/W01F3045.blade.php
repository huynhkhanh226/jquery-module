<section class="content" id="secW01F3045">
    <form id="frmW01F3045" name="frmW01F3045" method="post">
        <div class = "row">
            <div class="col-lg-4 col-xs-4 col-md-4">
                <div class = "row">
                    <div class="col-md-3 liketext">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                    </div>
                    <div class="col-md-9 liketext">
                        <select class="form-control selectpicker required" multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 5"
                                id="cbDivisionIDW01F3045" name="cbDivisionIDW01F3045"
                                placeholder="">
                            @foreach($cbDivisionIDW01F3045 as $row)
                                <option title="{{$row['Value']}}" value="{{$row['Value']}}">{{$row['Caption']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xs-5 col-md-5">
                <div class = "row">
                    <div class="col-md-3 liketext">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phan_khu")}}</label>
                    </div>
                    <div class="col-md-9 liketext">
                        <select class="form-control" multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 5"
                                id="cbSubDivisionIDW01F3045" name="cbSubDivisionIDW01F3045"
                                placeholder="">
                            @foreach($cbSubDivisionIDW01F3045 as $row)
                                <option title="{{$row['Value']}}" value="{{$row['Value']}}">{{$row['Caption']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-3 col-md-3">

            </div>
        </div>

        <div class = "row form-group">
            <div class="col-lg-4 col-xs-4 col-md-4">
                <div class = "row">
                    <div class="col-md-3 liketext">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Du_an")}}</label>
                    </div>
                    <div class="col-md-9 liketext">
                        <select class="form-control selectpicker required" multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 5"
                                id="cbProjectIDW01F3045" name="cbProjectIDW01F3045"
                                placeholder="">

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xs-5 col-md-5">
                <div class = "row">
                    <div class="col-md-3 liketext">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay")}}</label>
                    </div>
                    <div class="col-md-9 liketext">
                        <div id="divReportDateW01F3045" class="input-group date">
                            <input type="text" class="form-control" id="txtReportDateW01F3045"
                                   name="txtReportDateW01F3045" value="{{date('d/m/Y')}}" ><span
                                    class="input-group-addon"><i id="iconDateFrom" onclick="$('#txtReportDateW01F3045').datepicker('show');"
                                                                 class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-3 col-md-3">
                <button id = "btnFilterW01F3045" type = "button" class="btn btn-default smallbtn pull-right"><span class="digi digi-filter text-blue"></span>
                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
            </div>
        </div>
        <button type="submit" id="hdBtnSubmitW01F3045" class="hidden"></button>
    </form>
    <div class = "row">
        <div class="col-lg-12 col-xs-12 col-md-12">
            <div id="gridW01F3045"></div>
        </div>
    </div>
</section>
<script type="text/javascript">

    $("#cbDivisionIDW01F3045").on('changed.bs.select', function (e){
        loadCBProjectID();
    });

    $("#cbSubDivisionIDW01F3045").on('changed.bs.select', function (e){
        loadCBProjectID();
    });

    $("#btnFilterW01F3045").click(function () {
        var cbDivisionIDW01F3045 = $("#cbDivisionIDW01F3045");
        var cbProjectIDW01F3045 = $("#cbProjectIDW01F3045");

        cbDivisionIDW01F3045.get(0).setCustomValidity("");
        cbProjectIDW01F3045.get(0).setCustomValidity("");

        if (cbDivisionIDW01F3045.val() == null) {
            cbDivisionIDW01F3045.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Don_vi')}}");
            $("#frmW01F3045").find('#hdBtnSubmitW01F3045').click();
            cbDivisionIDW01F3045.focus();
            return false;
        }
        if (cbProjectIDW01F3045.val() == null) {
            cbProjectIDW01F3045.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Du_an')}}");
            $("#frmW01F3045").find('#hdBtnSubmitW01F3045').click();
            cbProjectIDW01F3045.focus();
            return false;
        }
        filter();
    });
    
    function filter() {
        var cbDivisionIDW01F3045 = $('#cbDivisionIDW01F3045').val();
        var cbSubDivisionIDW01F3045 = $('#cbSubDivisionIDW01F3045').val();
        var cbProjectIDW01F3045 = $('#cbProjectIDW01F3045').val();
        var txtReportDateW01F3045 = $('#txtReportDateW01F3045').val();
        $("#gridW01F3045").pqGrid("showLoading");
        $.ajax({
            method: 'POST',
            url: '{{url("/W01F3045/view/$pForm/$g/filter")}}',
            data: "&cbDivisionIDW01F3045=" + cbDivisionIDW01F3045 + "&cbSubDivisionIDW01F3045=" + cbSubDivisionIDW01F3045 + "&cbProjectIDW01F3045=" + cbProjectIDW01F3045
                + "&txtReportDateW01F3045=" + txtReportDateW01F3045,
            success: function (data) {
                $("#gridW01F3045").pqGrid("option", "dataModel.data", JSON.parse(data));
                defaultValueSumW01F3045();
                //$("#gridW01F3045").pqGrid("refreshDataAndView");
                $("#gridW01F3045").pqGrid("hideLoading");
            }
        });
    }
    
    function loadCBProjectID() {
        var cbDivisionIDW01F3045 = $('#cbDivisionIDW01F3045').val();
        var cbSubDivisionIDW01F3045 = $('#cbSubDivisionIDW01F3045').val();
        $.ajax({
            method: 'POST',
            url: '{{url("/W01F3045/view/$pForm/$g/loadCBProjectID")}}',
            data: {cbDivisionIDW01F3045: cbDivisionIDW01F3045, cbSubDivisionIDW01F3045: cbSubDivisionIDW01F3045} ,
            success: function (data) {
                $('#cbProjectIDW01F3045').html(data).selectpicker('refresh');
            }
        });
    }
    
    $(document).ready(function () {
        $('#txtReportDateW01F3045').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        //Initialize Select2 Elements
        $("#cbDivisionIDW01F3045").selectpicker("");
        $("#cbSubDivisionIDW01F3045").selectpicker("");
        $("#cbProjectIDW01F3045").selectpicker("");

        var objGridW01F3045 = {
            width: '100%',
            height: $(document).height() - 240,
            editable: true,
            //freezeCols: 2,
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            //pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: true},
            resizable: true,
            freezeCols: 2,
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: true,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            collapsible: false,
            postRenderInterval: -1,
            colModel: [
                {
                    title: "Style",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "Style",
                    hidden: true,
                    isExport: false
                },
                {
                    title: "{{Helpers::getRS($g,"Du_an")}}",
                    minWidth: 280,
                    dataType: "string",
                    dataIndx: "ProjectName",
                    editor: false,
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        if (rowData["Style"] != "") {
                            return '<label style = "' + rowData["Style"] + '">' + rowData["ProjectName"] + '</label>';
                        } else {
                            return '<label>' + rowData["ProjectName"] + '</label>';
                        }
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"ThuU")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "Receive",
                    align: "right",
                    editor: false,
                    filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        if (rowData["Style"] != "") {
                            return '<label style = "' + rowData["Style"] + '">' + rowData["Receive"] + '</label>';
                        } else {
                            return '<label>' + rowData["Receive"] + '</label>';
                        }
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Chi")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "Cost",
                    editor: false,
                    align: "right",
                    filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        if (rowData["Style"] != "") {
                            return '<label style = "' + rowData["Style"] + '">' + rowData["Cost"] + '</label>';
                        } else {
                            return '<label>' + rowData["Cost"] + '</label>';
                        }
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Chenh_lech")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "Different",
                    editor: false,
                    align: "right",
                    filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        if (rowData["Style"] != "") {
                            return '<label style = "' + rowData["Style"] + '">' + rowData["Different"] + '</label>';
                        } else {
                            return '<label>' + rowData["Different"] + '</label>';
                        }
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Con_phai_thu")}}</br>{{Helpers::getRS($g,"Theo_HD_da_ky")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "RemainReceive",
                    editor: false,
                    align: "right",
                    filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        if (rowData["Style"] != "") {
                            return '<label style = "' + rowData["Style"] + '">' + rowData["RemainReceive"] + '</label>';
                        } else {
                            return '<label>' + rowData["RemainReceive"] + '</label>';
                        }
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Tong_GT_ngan_sach_thuc_hien_theo_du_an")}}</br>{{Helpers::getRS($g,"Da_duyet()")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "Budget",
                    align: "right",
                    editor: false,
                    filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        if (rowData["Style"] != "") {
                            return '<label style = "' + rowData["Style"] + '">' + rowData["Budget"] + '</label>';
                        } else {
                            return '<label>' + rowData["Budget"] + '</label>';
                        }
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Con_phai_chi")}}</br>{{Helpers::getRS($g,"Theo_ngan_sach_thuc_hien_du_an_()")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "RemainCost",
                    editor: false,
                    align: "right",
                    filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        if (rowData["Style"] != "") {
                            return '<label style = "' + rowData["Style"] + '">' + rowData["RemainCost"] + '</label>';
                        } else {
                            return '<label>' + rowData["RemainCost"] + '</label>';
                        }
                    }
                },
                {
                    title: "IsSum",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "IsSum",
                    hidden: true,
                    isExport: false
                },
            ],
            dataModel: {
                data: {{json_encode([])}}
            }
        };
        var $gridW01F3045 = $("#gridW01F3045").pqGrid(objGridW01F3045);
        $gridW01F3045.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW01F3045.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        setTimeout(function () {
            $gridW01F3045.pqGrid("refreshDataAndView");
        }, 700)
    });


    function defaultValueSumW01F3045(){
        $grid = $("#gridW01F3045");
        $grid.pqGrid({
            summaryData : [
                {
                    ProjectName: '{{Helpers::getRS($g,"Tong_cong")}}',
                    Style: 'font-weight: bold',
                    Receive: calSumFooter("Receive"),
                    Cost: calSumFooter("Cost"),
                    Different: calSumFooter("Different"),
                    RemainReceive: calSumFooter("RemainReceive"),
                    Budget: calSumFooter("Budget"),
                    RemainCost: calSumFooter("RemainCost")
                },

            ]
        });
        $grid.pqGrid("refreshDataAndView");
    }
    
    function calSumFooter(index) {
        var data = $("#gridW01F3045").pqGrid("option", "dataModel.data");
        var dataSum = $.grep(data, function (d) {
            return Number(d.IsSum) == 1;
        });
        var sum = 0;
        for(var i = 0; i < dataSum.length ; i ++){
            var number = Number(dataSum[i][index].replace(/,/g,""));
            sum = number + sum;
        }
        return format2(sum, '',0);
    }
</script>