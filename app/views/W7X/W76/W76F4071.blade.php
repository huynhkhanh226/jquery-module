<div class="modal fade draggable" id="modalW76F4071" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:750px;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Cap_nhat_cong_viec"),"W76F4071")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW76F4071" name="frmW76F4071">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 liketext lbl-normal"
                                   style="width: 20%;">{{Helpers::getRS($g,"Tieu_de")}}</label>
                            <div class="col-sm-9" style="width: 80%;">
                                <input type="text" id="txtTaskName" name="txtTaskName"
                                       class="form-control" value="{{$rsData["TaskName"] or ''}}"
                                       {{$mode==1 || ($id!='' && $rsData["Assigner"]!=Auth::user()->user()->UserID)?'readonly':''}} required
                                       autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 liketext lbl-normal"
                                   style="width: 20%;">{{Helpers::getRS($g,"Thoi_gian_thuc_hien")}}</label>
                            <div class="col-sm-9" style="width: 80%;">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" id="txtExecuteDate"
                                                   name="txtExecuteDate"
                                                   value="{{isset($rsData["ExecuteFrom"])? $rsData["ExecuteFrom"].' - '.$rsData["ExecuteTo"] : ''}}"
                                                   {{$mode==1 || ($id!='' && $rsData["Assigner"]!=Auth::user()->user()->UserID)?'readonly':''}} required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group bootstrap-timepicker">
                                            <input type="text" id="txtExecuteEndTime" name="txtExecuteEndTime"
                                                   class="form-control timepickerW76F4071" maxlength="5"
                                                   value="{{$rsData["ExecuteEndTime"] or ''}}"
                                                   {{$mode==1 || ($id!='' && $rsData["Assigner"]!=Auth::user()->user()->UserID)?'readonly':''}} required/>
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 liketext lbl-normal"
                                   style="width: 20%;">{{Helpers::getRS($g,"Trang_thai")}}</label>
                            <div class="col-sm-3" style="width: 35%;">
                                <select class="form-control" id="slTaskStatus" name="slTaskStatus"
                                        <?php $taskID = $id ?>
                                        {{$taskID== 0 || $mode==1 || $rsData["Assignee"]!=Auth::user()->user()->UserID?"disabled":""}} required>
                                    @define $statusid = isset($rsData['CompleteStatus'])?$rsData['CompleteStatus']:'0'
                                    @foreach($status as $row)
                                        <option value="{{$row['ID']}}" {{$statusid==$row['ID']?'selected':''}}>{{$row['Name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 liketext lbl-normal"
                                   style="width: 14%;">{{Helpers::getRS($g,"Uu_tien")}}</label>
                            <div class="col-sm-4" style="width: 31%;">
                                <select class="form-control" id="slTaskPriority" name="slTaskPriority"
                                        {{$mode==1 || ($id!='' && $rsData["Assigner"]!=Auth::user()->user()->UserID)?'disabled':''}} required>
                                    @define $prio = isset($rsData['TaskPriority'])?$rsData['TaskPriority']:'1'
                                    @foreach($priority as $row)
                                        <option value="{{$row['ID']}}" {{$prio==$row['ID']?'selected':''}}>{{$row['Name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 liketext lbl-normal" style="width: 20%;"></label>
                            <div class="col-sm-10" style="width: 80%;">
                                <div class="checkbox pdt0">
                                    <label for="chkIsMyTask">
                                        <input type="checkbox" id="chkIsMyTask"
                                               name="chkIsMyTask" {{!isset($rsData["Assignee"]) || (isset($rsData["Assignee"]) && $rsData["Assigner"]==$rsData["Assignee"]) ?'checked':''}} > {{Helpers::getRS($g,"Cong_viec_cua_toi")}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 liketext lbl-normal"
                                   style="width: 20%;">{{Helpers::getRS($g,"Nguoi_thuc_hien")}}</label>
                            <div class="col-sm-4" style="width: 35%;">

                                <div class="ps_relative"
                                     value="{{$assignees["UserID"] or Auth::user()->user()->UserID}}"
                                     id="digi_combogrid_Assignee">

                                </div>

                                <select id="cboAssignee" name="cboAssignee" class="form-control selectpicker required"
                                        multiple data-actions-box="true" data-live-search="true" required>
                                    @foreach($assignees as $row)
                                        <option dutyname="{{$row["DutyName"]}}" title="{{$row["UserID"]}}"
                                                value="{{$row["UserID"]}}">{{$row["UserName"]}}</option>
                                    @endforeach
                                </select>
                                {{--@if ($id == '')
                                    <div class="ps_relative hide" id="digi_combogrid_Assignee">
                                    </div>
                                @endif--}}
                                {{-- <input type="text" class="form-control" id="txtAssignee" name="txtAssignee" value="{{$rsData["Assignee"] or Auth::user()->user()->UserID}}" readonly>--}}

                            </div>
                            <div class="col-sm-3 pdl0" style="width: 45%;">
                                <input type="text" class="form-control" id="txtAssigneeName"
                                       value="{{$rsData["AssigneeName"] or Auth::user()->user()->UserID}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 liketext lbl-normal"
                                   style="width: 20%;">{{Helpers::getRS($g,"Chuc_vu")}}</label>
                            <div class="col-sm-3" style="width: 80%;">
                                <input type="text" class="form-control" id="txtDutyName"
                                       value="{{$rsData["DutyName"] or Auth::user()->user()->UserDutyNameU}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 liketext lbl-normal"
                                   style="width: 20%;">{{Helpers::getRS($g,"Noi_dung")}}</label>
                            <div class="col-sm-9" style="width: 80%;">
                                <textarea class="form-control" id="txtTaskNotes"
                                          name="txtTaskNotes" {{$mode==1?'readonly':''}}>{{$rsData["TaskNotes"] or ''}}</textarea>
                            </div>
                        </div>

                        <?php
                        // Neu la nguoi dc giao viec va da hoan thanh thi show len
                        $show = isset($rsData) &&  $rsData["Assigner"] != Auth::user()->user()->UserID && $rsData["CompleteStatus"] == 1 ? true : false


                        ?>

                        @if( ($id!='' && $mode==1) || $show) <!--mode danh gia-->

                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Danh_gia_cong_viec")}}</legend>
                                <div class="form-group">
                                    <label class="col-sm-3 liketext lbl-normal"
                                           style="width: 20%;">{{Helpers::getRS($g,"Hoan_thanh")}}</label>
                                    <div class="col-md-2">
                                        <div class="checkbox pdt5">
                                            <label>
                                                <input type="radio" name="optAssessRate" id="optAssessRate1"
                                                       value="1" {{isset($rsData["AssessRate"]) && $rsData["AssessRate"]==1?'checked':''}}> {{Helpers::getRS($g,"Chua_tot")}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox pdt5">
                                            <label>
                                                <input type="radio" name="optAssessRate" id="optAssessRate2"
                                                       value="2" {{isset($rsData["AssessRate"])==false || $rsData["AssessRate"]==2?'checked':''}}> {{Helpers::getRS($g,"Tot")}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox pdt5">
                                            <label>
                                                <input type="radio" name="optAssessRate" id="optAssessRate3"
                                                       value="3" {{isset($rsData["AssessRate"]) && $rsData["AssessRate"]==3?'checked':''}}> {{Helpers::getRS($g,"Xuat_sac")}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 liketext lbl-normal"
                                           style="width: 20%;">{{Helpers::getRS($g,"Danh_gia")}}</label>
                                    <div class="col-sm-9" style="width: 80%;">
                                        <textarea class="form-control" id="txtAssessNotes"
                                                  name="txtAssessNotes">{{$rsData["AssessNotes"] or ''}}</textarea>
                                    </div>
                                </div>
                            </fieldset>
                        @endif
                        <input type="hidden" name="hdTaskID" value="{{$id}}">
                        <input type="hidden" name="hdAssigner" value="{{$rsData["Assigner"] or ''}}">
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @if($id!="")
                            <button type="button" id="frm_btnMemo" class="btn btn-default smallbtn pull-left mgr10">
                                <span class="glyphicon glyphicon-comments mgr5"></span> Memo
                            </button>
                            <button type="button" id="frm_btnCancel"
                                    class="btn btn-default smallbtn pull-right" {{intval($mode)==2 ?'disabled':''}}>
                                <span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                            </button>
                            <button id="frm_btnSave" type="button"
                                    class="btn btn-default smallbtn pull-right mgr10" {{intval($mode)==2 ?'disabled':''}}}}><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                            {{--@if ($mode == 0)--}}
                                {{--<button type="button" id="frm_btnEdit"--}}
                                        {{--class="btn btn-default smallbtn pull-left mgr10 ">--}}
                                    {{--<span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}--}}
                                {{--</button>--}}
                                {{--<button type="button" id="frm_btnDelete" onclick="deleteW76F4070('{{$id}}');"--}}
                                        {{--class="btn btn-default smallbtn pull-left confirmation-Delete">--}}
                                    {{--<span class="glyphicon glyphicon-bin text-black mgr5"></span> {{Helpers::getRS($g,"Xoa")}}--}}
                                {{--</button>--}}
                            {{--@endif--}}
                        @else
                            <button type="button" id="frm_btnMemo" class="btn btn-default smallbtn pull-left mgr10 hide">
                                <span class="glyphicon glyphicon-comments mgr5"></span> Memo
                            </button>
                            <button type="button" id="frm_btnNext" onclick="frmW76F4071Reset();"
                                    class="btn btn-default smallbtn pull-right" disabled>
                                <span class="glyphicon glyphicon-more-items mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                            </button>
                            <button id="frm_btnSave" type="button"
                                    class="btn btn-default smallbtn pull-right mgr10"><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        @endif
                    </div>
                    <!-- /.box-footer -->
                    <button type="submit" id="hdBtnSaveW76F4071" class="hidden"></button>
                </form>
            </div>

            <div class="modal-footer">
                <div class="alert alert-success alert-dismissable hide">
                    <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_duoc_luu_thanh_cong")}}
                </div>
                <div class="alert alert-danger alert-dismissable hide">
                    <i class="icon fa fa-ban"></i> <span
                            id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="secW76F4072"></section>
<script>
    var mode = "{{$mode}}";
    var id = "{{$id}}";
    $("#frmW76F4071").on('click', '#frm_btnEdit', function () {
        $("#frmW76F4071").find("#frm_btnCancel").removeAttr("disabled");
        $("#frmW76F4071").find("#frm_btnSave").removeAttr("disabled");
//        $("#frmW76F4071").find("#frm_btnEdit").attr("disabled", "disabled");
//        $("#frmW76F4071").find("#frm_btnDelete").attr("disabled", "disabled");
        $("#modalW76F4071").find(".alert-danger").addClass('hide');
        $("#modalW76F4071").find(".alert-success").addClass('hide');
    });

    $("#frmW76F4071").on('click', '#frm_btnCancel', function () {
        //normalMode();
    });

    function normalMode() {
        //$("#frmW76F4071").find("#frm_btnCancel").attr("disabled", "disabled");
        //$("#frmW76F4071").find("#frm_btnSave").attr("disabled", "disabled");
//        $("#frmW76F4071").find("#frm_btnEdit").removeAttr("disabled");
//        $("#frmW76F4071").find("#frm_btnDelete").removeAttr("disabled");
    }

    function frmW76F4071Reset() {
        $('#frmW76F4071')[0].reset();
        $("#frm_btnSave").removeAttr("disabled");
        $("#frm_btnNext").attr("disabled", "disabled");
        $("#txtLeadNo").focus();
        $("#modalW76F4071").find(".alert-success").addClass('hide');
        $("#modalW76F4071").find(".alert-danger").addClass('hide');
        $("#frmW76F4071").find(".fa-check").addClass("hide");
        $('#slAddSalesGroupID option').attr("selected", false);
        $('#slAddSalesGroupID').selectpicker('refresh');
        $('#modalW76F4071').find('#cboAssignee').selectpicker('deselectAll');
        $("#chkIsMyTask").trigger('change');

    }

    $("#frm_btnSave").click(function () {
        ask_save(function () {
            saveData();
        });
    });

    function saveData() {
        //alert("hello");

        var txtTaskName = $("#txtTaskName");
        var txtExecuteDate = $("#txtExecuteDate");
        var slTaskStatus = $("#slTaskStatus");
        var txtExecuteEndTime = $("#txtExecuteEndTime");
        var slTaskPriority = $("#slTaskPriority");
        var cboAssignee = $("#cboAssignee");


        txtTaskName.get(0).setCustomValidity("");
        txtExecuteDate.get(0).setCustomValidity("");
        slTaskStatus.get(0).setCustomValidity("");
        txtExecuteEndTime.get(0).setCustomValidity("");
        slTaskPriority.get(0).setCustomValidity("");
        cboAssignee.get(0).setCustomValidity("");

        if (txtTaskName.val() == "") {


            //txtTaskName.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Tieu_de')}}");
            $('#hdBtnSaveW76F4071').click();
            txtTaskName.focus();
            return false;
        }

        if (txtExecuteDate.val() == "") {


            //txtExecuteDate.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Tieu_de')}}");
            $('#hdBtnSaveW76F4071').click();
            txtExecuteDate.focus();
            return false;
        }

        if (slTaskStatus.val() == "") {


            //slTaskStatus.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Tieu_de')}}");
            $('#hdBtnSaveW76F4071').click();
            slTaskStatus.focus();
            return false;
        }

        if (txtExecuteEndTime.val() == "") {

            //console.log(txtTaskName.val());
            //txtExecuteEndTime.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Tieu_de')}}");
            $('#hdBtnSaveW76F4071').click();
            txtExecuteEndTime.focus();
            return false;
        }

        if (slTaskPriority.val() == "") {

            //console.log(txtTaskName.val());
            //slTaskPriority.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Tieu_de')}}");
            $('#hdBtnSaveW76F4071').click();
            slTaskPriority.focus();
            return false;
        }

        if (cboAssignee.val() == "") {

            //console.log(txtTaskName.val());
            //cboAssignee.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Tieu_de')}}");
            $('#hdBtnSaveW76F4071').click();
            cboAssignee.focus();
            return false;
        }
        var chkIsMyTask = $("#chkIsMyTask").is(":checked");

        //$("#frmW76F4071").find("#frm_btnSave").attr("disabled", "disabled");
        //$("#frmW76F4071").find("#frm_btnCancel").attr("disabled", "disabled");
        var datef = '', datet = '';
        @if($id=='' || ($mode==0 && $rsData["Assigner"]==Auth::user()->user()->UserID))
            datef = $('#frmW76F4071 #txtExecuteDate').data('daterangepicker').startDate.format('MM/DD/YYYY');
        datet = $('#frmW76F4071 #txtExecuteDate').data('daterangepicker').endDate.format('MM/DD/YYYY');

        @endif
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW76F4071").serialize() + "&datef=" + datef + '&datet=' + datet + '&mode={{$mode}}' + '&chkIsMyTask=' + chkIsMyTask + '&cboAssignee=' + cboAssignee.val() + "&txtTaskName=" + $("#txtTaskName").val(),
            success: function (data) {
                var result = $.parseJSON(data);
                id = result.id;
                if (result.code == 1) {
                    $("#modalW76F4071").find(".alert-danger").addClass('hide');
                    $("#modalW76F4071").find(".alert-success").removeClass('hide');
                    @if ($id == "")
                    $("#frm_btnNext").removeAttr("disabled");
	                $("#frm_btnSave").attr("disabled","disabled");
                    rowIndxW76F4071 = 0;
                    @else
                        rowIndxW76F4071 = getRowIndx($("#pqgrid_W76F4070"));
                    normalMode();
                    @endif
                } else if (result.code == 0) {
                    $("#modalW76F4071").find(".alert-danger").html(result.mess);
                    $("#modalW76F4071").find(".alert-danger").removeClass('hide');
                    $("#modalW76F4071").find(".alert-success").addClass('hide');
                    $("#frm_btnSave").removeAttr("disabled");
                    $("#frm_btnCancel").removeAttr("disabled");
                    $("#txtTaskName").focus();
                }
                $('#frm_btnMemo').removeClass('hide');
            }
        });

    }


    $(document).ready(function () {
        loadCheckBox();

        $("#cboAssignee").selectpicker({
            elementName: "txtAssigneeName",
            elementName: "txtDutyName"
        });

        $("#cboAssignee").on('changed.bs.select', function (e) {

            var div = $(this).val();
            if (div != null && div.length == 1 && div[0] == '%') {
                $("#cboAssignee").selectpicker('deselectAll');
                $("#cboAssignee").selectpicker('val', '%');
                $("#cboAssignee").find('[value!="%"]').prop('disabled', 'disabled');
                $("#cboAssignee").selectpicker('refresh');
            } else {
                $("#cboAssignee").find('[value="%"]').prop('selected', false);
                $("#cboAssignee").find('[value!="%"]').prop('disabled', '');
                $("#cboAssignee").selectpicker('refresh');
            }
            var text = $("#cboAssignee").selectpicker("text");
            var dutyList = $("#cboAssignee").selectpicker("getAttr", 'dutyname');
            $("#txtAssigneeName").val(text);
            $("#txtDutyName").val(dutyList);

        });

        @if($id=='' || ($mode==0 && $rsData["Assigner"]==Auth::user()->user()->UserID))
        $('#txtExecuteDate').daterangepicker({format: 'DD/MM/YYYY'});

        $('#txtExecuteDate').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });

        $(".timepickerW76F4071").timepicker({
            upArrowStyle: 'fa fa-chevron-up',
            downArrowStyle: 'fa fa-chevron-down',
            showMeridian: false,
            minuteStep: 30
        });

        @endif
        $('#txtExecuteDate').keydown(function (e) {
            if (e.keyCode != 46) {
                e.preventDefault();
                return false;
            }
        });
        $('#txtExecuteDate').keyup(function (e) {
            if (e.keyCode != 46) {
                e.preventDefault();
                return false;
            }
        });

        var obj1 = {
            width: 400, height: 300,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            focusElement: "txtAssignee",
            selectionModel: {type: 'row', mode: 'single'},
            colModel: [
                {title: "{{Helpers::getRS(0,'Ma')}}", width: 100, dataIndx: "UserID"},
                {title: "{{Helpers::getRS(0,'Ten')}}", width: 200, dataIndx: "UserName"},
                {title: "{{Helpers::getRS(0,'Chuc_vu')}}", hidden: true, dataIndx: "DutyName"}
            ],
            dataModel: {data: {}},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}

        };

        $("#digi_combogrid_Assignee").DigiNetComboGrid({
            topContain: "modalW76F4071",
            textID: "txtAssignee",
            dataBind: "UserID",
            synElement: [
                {elId: "txtAssignee", dataIndx: "UserID", value: "{{$rsData["Assignee"] or ''}}"},
                {elId: "txtAssigneeName", dataIndx: "UserName", value: "{{$rsData["AssigneeName"] or ''}}"},
                {elId: "txtDutyName", dataIndx: "DutyName", value: "{{$rsData["DutyName"] or ''}}"}
            ],
            textValue: "{{$rsData["Assignee"]  or Auth::user()->user()->UserID}}",
            textRequireMessage: "{{Helpers::getRS($g,'Ban_phai_nhap') . " ". Helpers::getRS($g,'Nguoi_thuc_hien')}}",
            gridID: "Assignee",
            gridConfig: obj1,
            request: {
                url: '{{Request::url()}}',
                action: 'getListAssignee'
            }
        });

        checkmode();

        $('#chkIsMyTask').change(function () {
            if ($('#chkIsMyTask').is(":checked")) {//khong check chon 1
                $('#modalW76F4071').find('#digi_combogrid_Assignee').removeClass('hide');
                $('#modalW76F4071').find('#txtAssignee').removeClass('hide');
                $('#modalW76F4071').find('#cboAssignee').selectpicker('deselectAll');
                $('#modalW76F4071').find('#cboAssignee').selectpicker('hide');
                $('#txtAssignee').prop("readonly", true);
                $('#txtAssignee').val("{{$rsData["Assignee"]  or Auth::user()->user()->UserID}}");
                $('#modalW76F4071').find('#txtAssigneeName').val('{{$rsData["AssigneeName"]  or Auth::user()->user()->UserNameU}}');
                $('#txtDutyName').val('');


            }
            else if (!$('#chkIsMyTask').is(':checked')) {//check hien chon nhieu
                $('#modalW76F4071').find('#digi_combogrid_Assignee').addClass('hide');
                $('#modalW76F4071').find('#txtAssignee').addClass('hide');
                $('#modalW76F4071').find('#cboAssignee').removeClass('hide');
                $('#modalW76F4071').find('#cboAssignee').selectpicker('deselectAll');
                $('#modalW76F4071').find('#cboAssignee').selectpicker('show');
                $('#txtAssignee').prop("readonly", false);
                $('#txtAssignee').val("{{$rsData["Assignee"]  or Auth::user()->user()->UserID}}");
                $('#txtDutyName').val('');
                $('#modalW76F4071').find('#txtAssigneeName').val('');

            }
        });

    });

    function checkmode() {
        if (Number("{{intval($id)}}") == 0) //truong hop add
        {
            //alert(Number("{{intval($id)}}"))
            $("#txtAssignee").prop("readonly", true);
            $('#chkIsMyTask').trigger('change');

        } else {
            //alert(Number("{{intval($id)}}"))
            var login_user = '{{Auth::user()->user()->UserID}}';
            $("#chkIsMyTask").prop("disabled", "disabled");
            $("#txtAssignee").prop("readonly", true);
            var divList = "{{$rsData["Assignee"]  or Auth::user()->user()->UserID}}";
            var assigner_user = "{{$rsData["Assigner"]  or Auth::user()->user()->UserID}}";
            var arrDiv = divList.split(";");
            $("#cboAssignee").selectpicker("val", arrDiv);
            $('#cboAssignee').prop('disabled', true);
            $('#cboAssignee').selectpicker('refresh');

            @if ( isset($rsData) && ($rsData["Assignee"] == Auth::user()->user()->UserID) && $rsData["Assigner"] != Auth::user()->user()->UserID)
            $("#frmW76F4071").find('input, select, textarea').prop("disabled", "disabled");
            $("#frmW76F4071").find('#slTaskStatus').prop("disabled", "");
            @endif



            if (mode == 2){ //la mode view
                //disabled tat ca control
	            $("#frmW76F4071").find('input, select, textarea').prop("disabled", "disabled");
	            $("#frmW76F4071").find('#slTaskStatus').prop("disabled", "disabled");
	            $("#frmW76F4071").find("#frm_btnCancel").addClass("hide");
	            $("#frmW76F4071").find("#frm_btnSave").addClass("hide");
            }
        }
    }

    function loadCheckBox() {
        if ($('#chkIsMyTask').is(":checked")) {//khong check chon 1
            $('#modalW76F4071').find('#digi_combogrid_Assignee').removeClass('hide');
            $('#modalW76F4071').find('#txtAssignee').removeClass('hide');
            $('#modalW76F4071').find('#cboAssignee').selectpicker('deselectAll');
            $('#modalW76F4071').find('#cboAssignee').selectpicker('hide');
            $('#txtAssignee').prop("readonly", true);
            $('#txtAssignee').val("{{$rsData["Assignee"]  or Auth::user()->user()->UserID}}");
            $('#modalW76F4071').find('#txtAssigneeName').val('{{$rsData["AssigneeName"]  or Auth::user()->user()->UserNameU}}');

        }
        else if (!$('#chkIsMyTask').is(':checked')) {//check hien chon nhieu
            $('#modalW76F4071').find('#digi_combogrid_Assignee').addClass('hide');
            $('#modalW76F4071').find('#txtAssignee').addClass('hide');
            $('#modalW76F4071').find('#cboAssignee').removeClass('hide');
            $('#modalW76F4071').find('#cboAssignee').selectpicker('deselectAll');
            $('#modalW76F4071').find('#cboAssignee').selectpicker('show');
            $('#txtAssignee').prop("readonly", false);
            $('#txtAssignee').val("{{$rsData["Assignee"]  or Auth::user()->user()->UserID}}");

        }
    }

    $("#modalW76F4071").on('hide.bs.modal', function () {
            $('#frmW76F4070').submit();
    });

    $('#modalW76F4071').find('#frm_btnMemo').on('click', function () {
        $.ajax({
            method: "GET",
            url: "{{url("W76F4072/".$g)}}/",
            data: {id: id},
            success: function (data) {
                $('#secW76F4072').html(data);
                $('#modalW76F4072').modal('show');
            }
        });
    });



</script>

