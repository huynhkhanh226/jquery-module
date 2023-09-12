<style>
    .cls_success {
        padding-top: 20%;
    }

    .modalW75F4070 .modal-open .modal {
        overflow-y: hidden;
    }

    [data-notify="progressbar"] {
        margin-bottom: 0px;
        position: absolute;
        bottom: 0px;
        left: 0px;
        width: 100%;
        height: 5px;
        z-index: 900000;
    }

    tr.pq-grid-oddRow > td.pq-state-select,
    tr.pq-grid-oddRow.pq-state-select,
    tr.pq-grid-oddRow > .pq-grid-cell-hover,
    tr.pq-grid-oddRow.pq-grid-row-hover {
        background: none;
    }

</style>
<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F4070" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F4070")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <form id="frmW75F4070">
                        <div class="row form-group">
                            <div class="col-md-1 col-xs-1">
                                <div class="checkbox" style="margin-top: -3px">
                                    <label>
                                        <input id="chkIsDate" type="checkbox" autofocus
                                               value="0"> {{Helpers::getRS($g,"Thoi_gian")}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <div id="idDateFrom" class="input-group date">
                                    <input type="text" class="form-control" id="txtDateFrom"
                                           name="txtDateFrom" value="" required><span
                                            class="input-group-addon"><i
                                                class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <div id="idDateTo" class="input-group date">
                                    <input type="text" class="form-control" id="txtDateTo"
                                           name="txtDateTo" value="" required><span
                                            class="input-group-addon"><i
                                                class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext1">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <input type="text" class="form-control"
                                       id="txtEmployeeIDW75F4070"
                                       name="txtEmployeeIDW75F4070" value=""
                                >
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext1">
                                    <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                </div>

                            </div>
                            <div class="col-md-2 col-xs-2">
                                <select class="form-control"
                                        id="cbStatusID" name="cbStatusID"
                                        placeholder="">
                                    @foreach($statusList as $rowStatus)
                                        <option value="{{$rowStatus['ID']}}" {{$rowStatus['ID'] == $isApproval ? 'selected':''}}>{{$rowStatus['Name']}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-1 col-xs-1">
                                <button type="button" id="btnFilterW75F4070"
                                        class="btn btn-default smallbtn  pull-right"><span
                                            class="digi digi-filter"></span>
                                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                <input type="submit" class="hide" id="hdBtnFilterW75F4070" name="hdBtnFilterW75F4070"/>
                            </div>
                        </div>

                    </form>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div id="divGridW75F4070"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12 ">
                            <button type="button" id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right"
                                    title="{{Helpers::getRS($g,"Luu")}}"
                            ><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popupMailW75F4070">
    <div class="modal draggable fade" id="mPopUp" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @define $mPopUpTitle = Helpers::getRS($g,"Thong_baoU")
                    {{Helpers::generateHeading($mPopUpTitle,"W75F4070",false,"closePopW75F4070")}}
                </div>
                <div class="modal-body" style="background: #fff; float: left; width: 100%; padding-bottom: 5px;">
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    var gbRowIndex = 0;
    var gbDataIndx = "";
    var gbInvalid = false;
    var currentDataIndx = "";
    var currentIndx = 0;
    $(document).ready(function () {
        //$('#txtDateFrom').daterangepicker({format: 'DD/MM/YYYY'}).focus();
        $('#txtDateFrom').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateTo').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateFrom').prop('disabled', !$(this).is(":checked"));
        $('#txtDateTo').prop('disabled', !$(this).is(":checked"));

        var tranMonth = {{Session::get("W91P0000")['HRTranMonth']}};
        var tranYear = {{Session::get("W91P0000")['HRTranYear']}};
        var daysInMonth = new Date(tranYear, tranMonth, 0).getDate();
        $('#chkIsDate').change(function () {
            $('#txtDateFrom').prop('disabled', !$(this).is(":checked"));
            $('#txtDateTo').prop('disabled', !$(this).is(":checked"));

            if ($(this).is(":checked")) {
                $('#txtDateFrom').datepicker('setDate', "01/" + tranMonth + "/" + tranYear + "");
                $('#txtDateTo').datepicker('setDate', daysInMonth + "/" + tranMonth + "/" + tranYear + "");
            } else {
                $('#txtDateFrom').val("");
                $('#txtDateTo').val("");
            }
        });
        $('#idDateFrom').find(".glyphicon-calendar").on('click', function () {
            if ($('#txtDateFrom').is(':disabled') == false) {
                $('#txtDateFrom').datepicker('show');
            }
        });
        $("#idDateTo").find(".glyphicon-calendar").on('click', function () {
            if ($('#txtDateTo').is(':disabled') == false) {
                $('#txtDateTo').datepicker('show');
            }
        });


        $("#frm_btnSave").click(function (event) {
            var soel = $("#gridShiftList");
            var obj = soel.pqGrid("getEditCell");
            var $editor = obj.$editor;
            if ($editor === undefined) {
                ask_save(function () {
                    allowSave();
                });
            }

        });

        $("#btnFilterW75F4070").click(function () {
            var wdayFrom = $("#txtDateFrom");
            var wdayTo = $("#txtDateTo");

            wdayFrom.get(0).setCustomValidity("");
            wdayTo.get(0).setCustomValidity("");

            if (wdayFrom.val() == "") {
                wdayFrom.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ngay')}}");
                $("#modalW75F4070").find('#hdBtnFilterW75F4070').click();
                wdayFrom.focus();
                return;
            }

            if (wdayTo.val() == "") {
                wdayTo.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ngay')}}");
                $("#modalW75F4070").find('#hdBtnFilterW75F4070').click();
                wdayTo.focus();
                return;
            }
            $("#modalW75F4070").find('#hdBtnFilterW75F4070').click();
        });


        function allowSave() {
            ////console.log('dfsd');
            var soel = $("#gridShiftList")
            //soel.pqGrid("saveEditCell");
            var dataObj = soel.pqGrid("option", "dataModel.data");

            var dataFilter = $.grep(dataObj, function (data, index) {
                return data.IsUpdate == 1;
            });


            //console.log(dataFilter);
            if (dataFilter.length > 0) {
                $(".l3loading").removeClass('hide');
                $.ajax({
                    method: "POST",
                    url: '{{url("/W75F4070/$pForm/$g/save")}}',
                    data: {
                        obj: dataFilter,
                        statusID: $("#cbStatusID").val()
                    },
                    success: function (data) {
                        $(".l3loading").addClass('hide');
                        console.log(data);
                        var rs = JSON.parse(data);
                        switch (rs.status){
                            case "BACKGROUND": //Gửi mail ngầm
                                save_ok(function(){
                                    alert_info("{{Helpers::getRS($g,'Email_da_duoc_gui_toi')}}" + ": <b><i>" + rs.name + "</i></b>");
                                    //callbackAfterSave(rs.data.TransID);
                                    reloadGridW();
                                });
                                break;
                            case "SHOWMAIL": //Hiển thị màn hình sendmail
                                save_ok(function(){
                                    showEmailPopup(rs.rsvalue,rs.data);
                                    //callbackAfterSave(rs.data.TransID);
                                    reloadGrid();
                                });
                                break;
                            case "NOSEND": //Không có gửi mail
                                save_ok(function(){
                                    //callbackAfterSave(rs.data.TransID);
                                    reloadGrid();
                                });
                                break;
                            case "ERROR": //Lỗi khi run SQL
                                save_not_ok();
                                console.log(rs.message);
                                //alert_error(rs.message);
                                break;
                            default:
                                alert_warning(rs.status);
                                break;
                        }
                        /*if (data.rowData.Status == 1) {
                            alert_warning(data.rowData.Message);//D? li?u l?u kh�ng h?p l?
                        } else {
                            setEmailValues("#popupMailW75F4070", data.rowData.EmailSenderAddress, data.rowData.EmailReceivedAddress, data.rowData.Subject, data.rowData.EmailContent, data.rowData.EmailCCAddress, data.rowData.EmailBCCAddress, 0);
                            $("#popupMailW75F4070").find("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4><i class='fa fa-chevron-circle-down' ></i>{{Helpers::getRS($g,"Phieu_chung_tu_da_duoc_duyet")}}</h4></div><div class='col-md-12 alert-success-approve' style='padding-top:5px;padding-bottom:5px'><button onclick='showEmail(\"#popupMailW75F4070\");'  type='button' class='btn btn-default smallbtn' ><i class='fa fa-envelope'></i>{{Helpers::getRS($g,"Gui_mail")}}</button></div>");
                            $("#popupMailW75F4070").find("#mPopUp").modal('show');
                        }*/
                    }
                });
            } else {
                alert_warning('{{Helpers::getRS(4,"Vui_long_chon_du_lieu_tren_luoi")}}');
            }

        }


        $("#modalW75F4070").on('submit', '#frmW75F4070', function (e) {
            e.preventDefault();

            reloadGrid();
        });

        $("#btnFilterW75F4070").trigger('click');
    });

    function reloadGrid(){
        $(".l3loading").removeClass('hide');
        enableControls();
        $.ajax({
            method: "POST",
            url: '{{url("/W75F4070/$pForm/$g/list")}}',
            data: $('#frmW75F4070').serialize(),
            success: function (data) {
                $(".l3loading").addClass('hide');
                console.log(data);
                $("#divGridW75F4070").html(data);
                //$("#gridShiftList").pqGrid("option", "dataModel.data", []);
                //$("#gridShiftList").pqGrid("option", "dataModel.data", data);
                //$("#gridShiftList").pqGrid("refreshDataAndView");
                //visibleColumns($("#cbStatusID").val());
                enableControls();
            }
        });
    }

    function enableControls(){
        if ($("#divGridW75F4070").html() == ""){
            $("#frm_btnSave").addClass("hide");
        }else{
            $("#frm_btnSave").removeClass("hide");
        }

        $("#frm_btnSave").prop("disabled", $("#cbStatusID").val() == "%");
    }


    /*function setBackColor($grid) {
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                if (obj[i].IsUpdate == 1) {
                    $grid.pqGrid("addClass", {rowIndx: i, cls: 'edit-status'});
                } else {
                    $grid.pqGrid("removeClass", {rowIndx: i, cls: 'edit-status'});
                }
            }
        }
    }*/

    var closePopW75F4070 = function () {
        $("#popupMailW75F4070").find("#mPopUp").modal('hide');
        $("#modalW75F4070").find('#hdBtnFilterW75F4070').click();
    };

    /*function checkHeadClick(obj, key) {
        var rs = $.grep(obj, function (data, index) {
            return data[key] == 1;
        });
        var rs1;
        if (key == "ApprovedPre" || key == "NotApprovedPre") {
            rs1 = $.grep(obj, function (data, index) {
                return isNullOrEmpty(data["OriPreOTFrom"]) == false;
            });
        }
        if (key == "ApprovedAfter" || key == "NotApprovedAfter") {
            rs1 = $.grep(obj, function (data, index) {
                return isNullOrEmpty(data["OriAfterOTFrom"]) == false;
            });
        }
        return rs.length >= rs1.length ? true : false;
    }


    function headClick(el) {
        $grid = $("#gridShiftList");
        $grid.pqGrid("quitEditMode");
        //$grid.pqGrid("saveEditCell")
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            var key = $(el).attr('id');
            var isHeadClick = checkHeadClick(obj, key); //Kiem tra cột hiện tại có headclick chưa, nếu rồi return true;
            setValueHeadClick($("#gridShiftList"), key, !isHeadClick);
        }

    }

    function setValueHeadClick($grid, currentKey, check) {
        var relative = '';
        if (currentKey == "ApprovedPre")
            relative = "NotApprovedPre";
        if (currentKey == "NotApprovedPre")
            relative = "ApprovedPre";
        if (currentKey == "ApprovedAfter")
            relative = "NotApprovedAfter";
        if (currentKey == "NotApprovedAfter")
            relative = "ApprovedAfter";

        var checkNum = (check == true ? 1 : 0);
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                if (((currentKey == "ApprovedPre" || currentKey == "NotApprovedPre") && isNullOrEmpty(obj[i]["OriPreOTFrom"]) == false) || ((currentKey == "ApprovedAfter" || currentKey == "NotApprovedAfter") && isNullOrEmpty(obj[i]["OriAfterOTFrom"]) == false)) {
                    console.log("test" + obj[i]["PreOTFrom"]);
                    obj[i][currentKey] = checkNum;
                    if (checkNum == 1 && obj[i][relative] == 1) {
                        obj[i][relative] = 0;
                    }
                    obj[i]["IsUpdate"] = 1;

                    if (currentKey == "ApprovedPre") {
                        updateRelativeCols(obj[i], 'ApprovedPre', check, i);
                    }
                    if (currentKey == "NotApprovedPre" && check) {
                        updateRelativeCols(obj[i], 'ApprovedPre', false, i);
                    }
                    if (currentKey == "ApprovedAfter") {
                        updateRelativeCols(obj[i], 'ApprovedAfter', check, i);
                    }
                    if (currentKey == "NotApprovedAfter" && check) {
                        updateRelativeCols(obj[i], 'ApprovedAfter', false, i);
                    }
                    calHours(obj[i], 1);
                    calHours(obj[i], 0);

                } else {
                    obj[i][currentKey] = 0;
                    obj[i][relative] = 0;
                }

            }
            $grid.pqGrid("option", "dataModel.data", obj);
            setBackColor($grid);
            $grid.pqGrid("refreshDataAndView");
            console.log(obj);
        }

    }

    function isNull(val) {
        return (val === null || val === "" || val === undefined || (!isNaN(val) && format2(val, '', 0) == format2(0, '', 0))) ? true : false;
    }

    function updateRelativeCols(rowData, field, checked, indx) {
        console.log('updateRelativeCols');
        $grid = $("#gridShiftList");
        console.log(rowData["PreOTHours"]);
        if (field == "ApprovedPre") {
            if (checked) {
                if (isNull(rowData["PreOTFrom"]))
                    rowData["PreOTFrom"] = rowData["OriPreOTFrom"]
                if (isNull(rowData["PreOTTo"]))
                    rowData["PreOTTo"] = rowData["OriPreOTTo"]
                if (isNull(rowData["PreOTHours"])) {
                    rowData["PreOTHours"] = rowData["OriPreOTHours"];
                }

                if (isNull(rowData["PreOTHoursSplit"])) {
                    rowData["PreOTHoursSplit"] = rowData["OriPreOTHoursSplit"];
                }
                if (isNull(rowData["PreOTLeave"])) {
                    rowData["PreOTLeave"] = rowData["OriPreOTLeave"];
                }
            } else {
                rowData["PreOTFrom"] = '';
                rowData["PreOTTo"] = '';
                rowData["PreOTHours"] = null;

                rowData["PreOTHoursSplit"] = null;
                rowData["PreOTLeave"] = null;

            }

        }

        if (field == "ApprovedAfter") {
            if (checked) {
                if (isNull(rowData["AfterOTFrom"]))
                    rowData["AfterOTFrom"] = rowData["OriAfterOTFrom"];
                if (isNull(rowData["AfterOTTo"]))
                    rowData["AfterOTTo"] = rowData["OriAfterOTTo"];
                console.log(rowData["AfterOTHours"]);
                if (isNull(rowData["AfterOTHours"])) {
                    rowData["AfterOTHours"] = rowData["OriAfterOTHours"];
                    console.log(rowData["OriAfterOTHours"]);
                }

                if (isNull(rowData["AfterOTHoursSplit"])) {
                    rowData["AfterOTHoursSplit"] = rowData["OriAfterOTHoursSplit"];
                }
                if (isNull(rowData["AfterOTLeave"])) {
                    rowData["AfterOTLeave"] = rowData["OriAfterOTLeave"];
                }

            } else {
                rowData["AfterOTFrom"] = '';
                rowData["AfterOTTo"] = '';
                rowData["AfterOTHours"] = null;

                rowData["AfterOTHoursSplit"] = null;
                rowData["AfterOTLeave"] = null;
            }
        }
        /!*$grid.pqGrid( "updateRow", {
            rowIndx: indx,
            newRow: rowData
        });*!/
    }

    function calHours(row, bFirst) {
        var valFrom;
        var valTo;
        var dataIndx = gbDataIndx;
        if (bFirst == 1) {
            valFrom = isNullOrEmpty(row["PreOTFrom"]) ? "" : (row["PreOTFrom"]).replace(/_/g, "0");
            valTo = isNullOrEmpty(row["PreOTTo"]) ? "" : (row["PreOTTo"]).replace(/_/g, "0");
            if (valFrom == '' || valTo == '') {
                //$('#lblFirstHourW75F4071').html("0.00");
                row["PreOTHours"] = null;
                return true;
            }
            var dFrom = new Date(2000, 0, 1, valFrom.substr(0, 2), valFrom.substr(3, 2))
            var dTo = new Date(2000, 0, 1, valTo.substr(0, 2), valTo.substr(3, 2))
            var diff = (dTo - dFrom) / 1000 / 60 / 60;
            console.log('diff before' + diff);
            if (isNaN(diff)) {
                row[dataIndx] = "";
            }
            else {
                if (diff >= 0) {
                    row["PreOTHours"] = diff.toFixed(2);
                }
                else {
                    row["PreOTHours"] = (24 + diff).toFixed(2)
                }
            }
        }
        else {
            valFrom = isNullOrEmpty(row["AfterOTFrom"]) ? "" : (row["AfterOTFrom"]).replace(/_/g, "0");
            valTo = isNullOrEmpty(row["AfterOTTo"]) ? "" : (row["AfterOTTo"]).replace(/_/g, "0");
            if (valFrom == '' || valTo == '') {
                row["AfterOTHours"] = null;
                return true;
            }
            var dFrom = new Date(2000, 0, 1, valFrom.substr(0, 2), valFrom.substr(3, 2))
            var dTo = new Date(2000, 0, 1, valTo.substr(0, 2), valTo.substr(3, 2))
            var diff = (dTo - dFrom) / 1000 / 60 / 60;
            console.log('diff after' + diff);
            if (diff >= 0) {
                row["AfterOTHours"] = diff.toFixed(2);
            }
            else {
                row["AfterOTHours"] = (24 + diff).toFixed(2)
            }
        }

    }*/

    function visibleColumns(cboStatus){
       /*console.log("dfs");
        var obj = [
            {status: "approve", dataIndx:  "ApprovedPre"},
            {status: "approve", dataIndx:  "NotApprovedPre"},
            {status: "approve", dataIndx:  "ApprovedAfter"},
            {status: "approve", dataIndx:  "NotApprovedAfter"},


            {status: "confirm", dataIndx:  "PreConfirm"},
            {status: "approve", dataIndx:  "PreNotConfirm"},
            {status: "approve", dataIndx:  "AfterConfirm"},
            {status: "approve", dataIndx:  "AfterNotConfirm"}
        ];
        $grid = $("#gridShiftList");
        var colModel = $grid.pqGrid( "getColModel" );
        console.log(colModel);
        for (var i=0;i<obj.length;i++){
            var row = obj[i];
            //alert(row["dataIndx"]);
            var index = $grid.pqGrid( "getColIndx",{ dataIndx: row["dataIndx"] } );
            console.log(index);
            if (row["status"] == "approve" && (cboStatus == 0 || cboStatus == 1  || cboStatus == 2 )){
                colModel[index].hidden = false;
            }else{
                colModel[index].hidden = true;
            }
            if (row["status"] == "confirm" && (cboStatus == 3 || cboStatus == 4  || cboStatus == 5 )){
                colModel[index].hidden = false;
            }else{
                colModel[index].hidden = true;
            }
            $grid.pqGrid( "option", "colModel", colModel );
            //$grid.pqGrid( "refreshDataAndView");
        }

        console.log(obj);
*/
    }

</script>

