<div class="modal fade modal" id="modalW75F3801" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW75F3801" method="post" action="" lang="vi">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F3801")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="row">
                                <div class="col-md-3 col-xs-3">
                                    <div class="checkbox" style="margin-top: -3px">
                                        <label>
                                            <input id="chkIsDate" type="checkbox"
                                                   value="1"> {{Helpers::getRS($g,"Thoi_gian")}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3" style="padding-left: 0px">
                                    <div id="idDateFrom" class="input-group date">
                                        <input type="text" class="form-control" id="txtDateFrom"
                                               name="txtDateFrom" value="" required><span
                                                class="input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3" style="padding-right: 0px">
                                    <div id="idDateTo" class="input-group date">
                                        <input type="text" class="form-control" id="txtDateTo"
                                               name="txtDateTo" value="" required><span
                                                class="input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-2">
                                    <button type="button" id="btnFilterW75F3801" class="btn btn-default smallbtn"><span class="digi digi-filter"></span>
                                        &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6 col-xs-6" style="padding-right: 0px">
                            <div id="divCourse"></div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div id="divPurpose"></div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6 col-xs-6" style="padding-right: 0px">

                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="pull-right">
                                <a class="btn btn-default smallbtn" onclick="W05F1621ExportExcel()">
                                    <span class="fa fa-file-excel-o mgr5"></span>{{Helpers::getRS($g,'Xuat_Excel_U')}}
                                </a>
                            </div>

                            <div  id="divControl"  class="pull-right mgr5">
                                <a class="btn btn-default smallbtn" onclick="ask_save(allowSave)" style="margin-right: 2px;">
                                    <span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </a>
                                <a class="btn btn-default smallbtn" onclick="ask_not_save(afterNotSave)">
                                    <span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <input type="submit" id="frm_hbtnSave" class="hide"/>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        //khi load moi
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi'
        });
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi'
        });
        $('#txtDateFrom').prop('disabled', !$(this).is(":checked"));
        $('#txtDateTo').prop('disabled', !$(this).is(":checked"));
        $('#chkIsDate').change(function () {
            $('#txtDateFrom').prop('disabled', !$(this).is(":checked"));
            $('#txtDateTo').prop('disabled', !$(this).is(":checked"));
            if (!$(this).is(":checked")) {
                $('#txtDateFrom').val("");
                $('#txtDateTo').val("");
            }
        });
        //Load lan dau khi open man hinh
        loadGridCourse();
        $( "#txtDateFrom" ).change(function() {
            //$( "#txtDateTo").focus();
        });

        //autoSizeWindow();
    });

    function autoSizeWindow(){
        $("#modalW75F3801").find(".modal-dialog").height($(window).height());
    }
    function loadGridCourse() {
        console.log('loadGridCourse');
        $("#divCourse").html("");
        $.ajax({
            method: 'GET',
            url: '{{url("/W75F3801/$pForm/$g/loadgrid/left")}}',
            data: {
                isDate: $("#chkIsDate").is(":checked"),
                dateFrom: $("#txtDateFrom").val(),
                dateTo: $("#txtDateTo").val()
            },
            success: function (data) {
                //console.log(data);
                //$("#gridW75F3801_Course").pqGrid( "hideLoading" );
                $("#divCourse").html(data);
                /*loadGridPurpose(0,$("#gridW75F3801_Course"),false);
                $("#gridW75F3801_Course").pqGrid( "setSelection", {rowIndx:0} );*/
            }
        });
    }

    function reLoadGridCourse(){
        console.log('reLoadGridCourse');
        $(".l3loading").removeClass('hide');
        //$("#gridW75F3801_Course").pqGrid( "showLoading" );
        $.ajax({
            method: 'GET',
            url: '{{url("/W75F3801/$pForm/$g/loadgrid/reloadleft")}}',
            data: {
                isDate: $("#chkIsDate").is(":checked"),
                dateFrom: $("#txtDateFrom").val(),
                dateTo: $("#txtDateTo").val()
            },
                success: function (data) {
                    //$("#gridW75F3801_Course").pqGrid( "hideLoading" );
                    $(".l3loading").addClass('hide');
                    $("#gridW75F3801_Course").pqGrid("option", "dataModel.data", []);
                    $("#gridW75F3801_Course").pqGrid("option", "dataModel.data", data);
                    $("#gridW75F3801_Course").pqGrid("refreshDataAndView");
                    //S? ki?n complete c?a l??i gridW75F3801_Course s? load l??i Purpose
                    //reLoadGridPurpose(0,$("#gridW75F3801_Course"),false);
                    $("#gridW75F3801_Course").pqGrid( "setSelection", {rowIndx:0} );

                }
        });
    }

    function loadGridPurpose(rowIndx, $grid, bEdit) {
        var dataCourses = $("#gridW75F3801_Course").pqGrid("option", "dataModel.data");
        //console.log("test");
        if (dataCourses.length > 0){
            var rowData = $grid.pqGrid("getRowData", { rowIndx: rowIndx });
            var voucherID = rowData['VoucherID'];
            var trainingCourseID = rowData['TrainingCourseID'];
            var planTransID = rowData['PlanTransID'];
            var transID = rowData['TransID'];
        }else{
            var voucherID = "";
            var trainingCourseID = "";
            var planTransID = "";
            var transID = "";
        }
        $("#divPurpose").html("");
        $.ajax({
            method: 'POST',
            url: '{{url("/W75F3801/$pForm/$g/loadgrid/right")}}',
            data: {isDate: $("#chkIsDate").is(":checked"), dateFrom:$("#txtDateFrom").val(),dateTo:$("#txtDateTo").val(),trainingCourseID:trainingCourseID,voucherID:voucherID, planTransID:planTransID, transID:transID},
            success: function (data) {
                $("#divPurpose").html(data);
                console.log(data);
                if($("#gridW75F3801_Purpose").find('.pq-grid-row').length==0) {
                    $("#gridW75F3801_Purpose").pqGrid( "addRow", {rowData:{}});
                    $("#gridW75F3801_Purpose").pqGrid( "editFirstCellInRow", { rowIndx: 0 } );
                }
                enableEditGrid(bEdit);
            }
        });
    }

    function reLoadGridPurpose(rowIndx, $grid, bEdit) {
        //console.log("after saving");
        var rowData = $grid.pqGrid("getRowData", { rowIndx: rowIndx });
        var voucherID = rowData['VoucherID'];
        var trainingCourseID = rowData['TrainingCourseID'];
        var planTransID = rowData['PlanTransID'];
        var transID = rowData['TransID'];
        //$(".l3loading").removeClass('hide');
        $("#gridW75F3801_Purpose").pqGrid( "showLoading" );
        $.ajax({
            method: 'POST',
            url: '{{url("/W75F3801/$pForm/$g/loadgrid/reloadright")}}',
            data: {isDate: $("#chkIsDate").is(":checked"), dateFrom:$("#txtDateFrom").val(),dateTo:$("#txtDateTo").val(),trainingCourseID:trainingCourseID,voucherID:voucherID, planTransID:planTransID, transID:transID},
            success: function (data) {
                //$(".l3loading").addClass('hide');
                $("#gridW75F3801_Purpose").pqGrid( "hideLoading" );
                //////console.log(data);
                var currentObject = $.parseJSON(data);
                $("#gridW75F3801_Purpose").pqGrid("option", "dataModel.data", currentObject);
                $("#gridW75F3801_Purpose").pqGrid("hideLoading");
                $("#gridW75F3801_Purpose").pqGrid("refreshDataAndView");
                if (currentObject.length == 0){
                    $("#gridW75F3801_Purpose").pqGrid( "addRow", {rowData:{}});
                    $("#gridW75F3801_Purpose").pqGrid( "editFirstCellInRow", { rowIndx: 0 } );
                    //$("#gridW75F3801_Purpose").pqGrid("setSelection", {rowIndx: 0, colIndx: 0});
                }
                enableEditGrid(bEdit);
            }
        });
    }



    $("#btnFilterW75F3801").click(function () {
        validationElements($("#frmW75F3801"));
        $("#frm_hbtnSave").click();
    });

    $("#modalW75F3801").on('submit', '#frmW75F3801', function (e) {
        e.preventDefault();
        reLoadGridCourse();
    });

    function allowSave() {
        //console.log(gRowIndxCourse);
        $grid = $("div#gridW75F3801_Purpose");
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
        var rowCourse = $("#gridW75F3801_Course").pqGrid("getRowData", { rowIndx: gRowIndxCourse });
        var dataObj = $("#gridW75F3801_Purpose").pqGrid("option", "dataModel.data");
        console.log("save");
        for(var i=0;i<dataObj.length; i++) {
            /*//Kiem tra bat buoc nhap
            var validObj =$("div#gridW75F3801_Purpose").pqGrid( "isValid", { rowIndx: i } );
            if(validObj.valid ==false) {
                save_not_ok(function(){
                    $("div#gridW75F3801_Purpose").pqGrid("quitEditMode");
                    $("#gridW75F3801_Purpose").pqGrid("setSelection", {rowIndx: i, dataIndx: validObj.dataIndx});
                    $("#gridW75F3801_Purpose").pqGrid( "editCell", { rowIndx: i, dataIndx: validObj.dataIndx } );
                },null,"{{Helpers::getRS(0,'Ban_can_nhap_du_cac_thong_tin')}}");
                return false;
            }*/
            var colModel = $grid.pqGrid("option", "colModel" );
            for (var j=0;j<colModel.length;j++){
                if (colModel[j].required &&  isNullOrEmpty(dataObj[i][colModel[j].dataIndx])){
                    $grid.pqGrid("setSelection", {rowIndx: i, colIndx: colModel[j].dataIndx});
                    $grid.pqGrid("editCell", {rowIndx: i, dataIndx: colModel[j].dataIndx});
                    var obj = $grid.pqGrid( "getEditCell" );
                    var $editor = obj.$editor;
                    var msg = '{{Helpers::getRS($g,'Ban_phai_nhap')}}' + ' ' + colModel[j].title;
                    var wid = msg.length * 9;
                    $($editor).confirmation({
                        btnOkLabel: '',
                        btnCancelLabel: '',
                        popout: true,
                        placement: "top",
                        singleton: true,
                        template:
                        '<div class="popover" style="width: '+wid+'px;max-width: 600px;"><div class="arrow"></div>'
                        + '<div class="popover-content" style="text-align: center;padding:10px;width: auto"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i>'
                        + msg
                        + '</span></div>'
                        + '</div>'
                    });
                    $($editor).confirmation('show');
                    return false;
                }
            }

        }

        //Thuc hien luu
        var voucherID = rowCourse['VoucherID'];
        var planTransID = rowCourse['PlanTransID'];
        var transID = rowCourse['TransID'];
        var trainingCourseID = rowCourse['TrainingCourseID'];
        ////console.log($("#gridW75F3801_Purpose").pqGrid("option", "dataModel.data"));
        $.ajax({
            method: "POST",
            url: '{{url("/W75F3801/$pForm/$g/save")}}',
            data: {
                obj: $("#gridW75F3801_Purpose").pqGrid("option", "dataModel.data"),
                voucherID: voucherID,
                transID: transID,
                planTransID: planTransID,
                trainingCourseID: trainingCourseID
            },
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.bSaveOK) {
                    save_ok();
                    //reLoadGridPurpose(rowIndxCourse, $("#gridW75F3801_Purpose"),false);
                    enableEditGrid(false);
                    //reLoadGridPurpose(gRowIndxCourse, $("#gridW75F3801_Course"),false);
                } else {
                    save_not_ok();
                }
            }
        });
    }


</script>

