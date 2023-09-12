<?php
$lang = Session::get("locate");
?>
<style>
    .bs-invalid{
        z-index: 10;
    }
</style>
<div class="modal fade pd0" id="modalW76F2111" data-backdrop="static" role="dialog" style="position: absolute">
    <div id="test" class="modal-dialog modal-lg" style="width: 75%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W76F2111", true, "")}}
            </div>

            <?php
                if ($task == 'add'){
                    $lblAssigneeW76F2111 = Auth::user()->user()->UserID. " - ".(Auth::user()->user()->UserNameU);
                    $assigneeID = Auth::user()->user()->UserID;
                    $dtpExecuteFromW76F2111 = $dateFrom;
                    $dtpExecuteToW76F2111 = $dateTo;
                    $txtExecuteBeginTimeW76F2111 = "08:00";
                    $txtExecuteEndTimeW76F2111 = "17:00";
                    $txtLocationW76F2111 = "";
                    $cboTaskTypeW76F2111 = "";
                    $txtTaskTypeNameW76F2111 = "";
                    $txtTaskNotesW76F2111 = "";
                    $txtResultsW76F2111 = "";
                    $txtActEvaluationW76F2111 = "";
                    $txtNotesW76F2111 = "";
                    $txtD76CompanyIDW76F2111 = "";
                    $txtD17CompanyNameW76F2111 = "";
                    $taskID = ""; //Primary Key
                    $string = "";
                    $isReadOnly = false;
                    $completeStatus = 0;
                }



                if ($task == 'edit' || $task == 'view'){
                    $lblAssigneeW76F2111 = $rsData["Assignee"]. " - ".$rsData["AssigneeName"];
                    $assigneeID = $rsData["Assignee"];
                    $dtpExecuteFromW76F2111 = $rsData["ExecuteFrom"];
                    $dtpExecuteToW76F2111 = $rsData["ExecuteTo"];
                    $txtExecuteBeginTimeW76F2111 = $rsData["ExecuteBeginTime"];
                    $txtExecuteEndTimeW76F2111 = $rsData["ExecuteEndTime"];
                    $txtLocationW76F2111 = $rsData["Location"];
                    $cboTaskTypeW76F2111 = $rsData["TaskType"];
                    $txtTaskTypeNameW76F2111 = $rsData["TaskTypeName"];
                    $txtTaskNotesW76F2111 = $rsData["TaskNotes"];
                    $txtResultsW76F2111 = $rsData["Results"];
                    $txtActEvaluationW76F2111 = $rsData["ActEvaluation"];
                    $txtNotesW76F2111 = $rsData["Notes"];
                    $txtD76CompanyIDW76F2111 = $rsData["D17CompanyID"];
                    $txtD17CompanyNameW76F2111 = $rsData["D17CompanyName"];
                    $taskID = $rsData["TaskID"];
                    $isReadOnly = false ;// $rsData["IsReadOnly"] == 1 ? true: false;
                    $completeStatus = $rsData["CompleteStatus"];
                }
            ?>



            <div class="modal-body pd10">
                <form id="frmW76F2111" name="frmW76F2111" method="post">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal ">{{Helpers::getRS($g, "Nguoi_thuc_hien")}}</label>
                        </div>

                        <div class="col-md-4">
                            <label class="liketext" id="lblAssigneeW76F2111">{{$lblAssigneeW76F2111}}</label>
                        </div>
                        <div class="col-md-2">
                            <label class="liketext lbl-normal pull-right">{{Helpers::getRS($g,"Trang_thai")}}</label>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" id="cboStatusW76F2111" name="cboStatusW76F2111"
                                    {{$taskID== 0 || (isset($rsData) && $rsData["Assignee"]!=Auth::user()->user()->UserID ) ? "disabled":""}}
                                    required>
                                @foreach($statusList as $row)
                                    <option value="{{$row['ID']}}" {{$completeStatus==$row['ID']?'selected':''}}>{{$row['Name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal ">{{Helpers::getRS($g, "Ngay")}}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       id="dtpExecuteFromW76F2111"
                                       name="dtpExecuteFromW76F2111" value="{{$dtpExecuteFromW76F2111}}" required><span
                                        class="input-group-addon">
                                    <i id="calendar_from"class="glyphicon glyphicon-calendar"  onclick="$('#dtpExecuteFromW76F2111').datepicker('show');"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       id="dtpExecuteToW76F2111"
                                       name="dtpExecuteToW76F2111" value="{{$dtpExecuteToW76F2111}}" required><span
                                        class="input-group-addon">
                                    <i id="calendar_to" class="glyphicon glyphicon-calendar"  onclick="$('#dtpExecuteToW76F2111').datepicker('show');"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="liketext lbl-normal pull-right">{{Helpers::getRS($g, "Gio")}}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group bootstrap-timepicker">
                                <input type="text" class="form-control text-center"
                                       id="txtExecuteBeginTimeW76F2111"
                                       placeholder="00:00"
                                       name="txtExecuteBeginTimeW76F2111" value="{{$txtExecuteBeginTimeW76F2111}}" required
                                >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group bootstrap-timepicker">
                                <input type="text" class="form-control text-center"
                                       id="txtExecuteEndTimeW76F2111"
                                       placeholder="00:00"
                                       name="txtExecuteEndTimeW76F2111" value="{{$txtExecuteEndTimeW76F2111}}" required
                                >
                            </div>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal ">{{Helpers::getRS($g, "Dia_diem")}}</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                                   id="txtLocationW76F2111"
                                   placeholder=""
                                   name="txtLocationW76F2111" value="{{$txtLocationW76F2111}}"
                            >
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal ">{{Helpers::getRS($g, "Cong_viec")}}</label>
                        </div>

                        <div class="col-md-4">
                            <select id="cboTaskTypeW76F2111" name="cboTaskTypeW76F2111" class="form-control selectpicker required" multiple data-actions-box="true"  data-live-search="true"   required>
                                @foreach($workList as $rowWork)
                                    <option title="{{$rowWork["TaskType"]}}" value="{{$rowWork["TaskType"]}}" {{$cboTaskTypeW76F2111 == $rowWork["TaskType"] ? 'selected': ''}}  >{{$rowWork["TaskTypeName"]}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control"
                                   id="txtTaskTypeNameW76F2111"
                                   placeholder=""

                                   name="txtTaskTypeNameW76F2111" value="{{$txtTaskTypeNameW76F2111}}" readonly="true"  required
                            >
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal ">{{Helpers::getRS($g, "Noi_dung")}}</label>
                        </div>

                        <div class="col-md-10">
                            <textarea class="form-control" id="txtTaskNotesW76F2111"
                                      name="txtTaskNotesW76F2111" rows="3"> {{$txtTaskNotesW76F2111}}</textarea>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal ">{{Helpers::getRS($g, "Ket_qua")}}</label>
                        </div>

                        <div class="col-md-10">
                            <textarea class="form-control" id="txtResultsW76F2111"
                                      name="txtResultsW76F2111" rows="2">{{$txtResultsW76F2111}} </textarea>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal ">{{Helpers::getRS($g, "Danh_gia")}}</label>
                        </div>

                        <div class="col-md-10">
                            <textarea class="form-control" id="txtActEvaluationW76F2111"
                                      name="txtActEvaluationW76F2111" rows="2"> {{$txtActEvaluationW76F2111}}</textarea>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal ">{{Helpers::getRS($g, "Ghi_chu")}}</label>
                        </div>

                        <div class="col-md-10">
                            <textarea class="form-control" id="txtNotesW76F2111"
                                      name="txtNotesW76F2111" rows="2">{{$txtNotesW76F2111}} </textarea>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal ">{{Helpers::getRS($g, "To_chuc").'/'.Helpers::getRS($g, "Ca_nhan")}}</label>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="txtD76CompanyIDW76F2111" name="txtD76CompanyIDW76F2111" class="form-control" placeholder="" value="{{$txtD76CompanyIDW76F2111}}">
                                <a id="companySearchW76F2111{{$task == 'add' || ($task == 'edit' && $isReadOnly == false) ? '':'Disabled'}}" class="input-group-addon" placeholder=""><i class="fa fa-search text-yellow" placeholder=""></i></a>
                                <a id="callW17F1010" title="{{Helpers::getRS($g, 'Sua').' '.Helpers::getRS($g,'Thong_tin_cong_ty')}}"  class="input-group-addon {{$txtD76CompanyIDW76F2111 == '' ? 'disabled': '' }}" {{$txtD76CompanyIDW76F2111 == '' ? 'disabled': '' }} placeholder=""><i class="fa fa-edit {{$txtD76CompanyIDW76F2111 == ''? 'text-gray': 'text-yellow' }}" placeholder=""></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control"
                                   id="txtD17CompanyNameW76F2111"
                                   placeholder=""
                                   name="txtD17CompanyNameW76F2111" value="{{$txtD17CompanyNameW76F2111}}" readonly required
                            >
                        </div>
                    </div>
                    <div class = "row form-group">
                        <div class="col-md-2 col-xs-2">

                        </div>
                        <div class="col-md-4 col-xs-4">
                            @if (intval($perD76F2110) >= 1)
                                <button type="button" id="btnAttachmentW76F2111" name="btnAttachmentW76F2111"
                                        class="btn btn-default smallbtn pull-left {{$task == "add" ? "hide" : ""}}"><span
                                            class="fa fa-paperclip mgr5"></span> {{Helpers::getRS($g,"Dinh_kem")}}
                                </button>
                            @endif
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="pull-right">
                                <button type="button" id="btnSaveW76F2111" name="btnSaveW76F2111"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                                <button type="button" id="btnNotSaveW76F2111" name="btnNotSaveW76F2111"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-ban text-red"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                </button>
                                <button type="button" id="btnNextW76F2111" name="btnNextW76F2111"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-arrow-right text-blue mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                </button>

                                <input type="submit" id="hdBtnSubmitW76F2111" class="hide">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>

<script type="text/javascript">
    var task = "{{$task}}";
    var taskID = "{{$taskID}}";
    var txtD76CompanyIDW76F2111 = $('#txtD76CompanyIDW76F2111');


    $(document).ready(function(){

        enableControl(task);
        $('#dtpExecuteFromW76F2111').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        $('#dtpExecuteToW76F2111').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        $('input[name="txtExecuteBeginTimeW76F2111"]').inputmask({
            alias: "datetime",
            mask: "h:s",
            placeholder: "__:__"
        });

        $('input[name="txtExecuteEndTimeW76F2111"]').inputmask({
            alias: "datetime",
            mask: "h:s",
            placeholder: "__:__"
        });

        $("#cboTaskTypeW76F2111").selectpicker({
            elementName: "txtTaskTypeNameW76F2111"
        });

        $("#cboTaskTypeW76F2111").on('changed.bs.select', function (e) {
            var div = $(this).val();

            if (div != null && div.length == 1 && div[0] == '%') {
                $("#cboTaskTypeW76F2111").selectpicker('deselectAll');
                $("#cboTaskTypeW76F2111").selectpicker('val', '%');
                $("#cboTaskTypeW76F2111").find('[value!="%"]').prop('disabled', 'disabled');
                $("#cboTaskTypeW76F2111").selectpicker('refresh');
            } else {
                $("#cboTaskTypeW76F2111").find('[value="%"]').prop('selected', false);
                $("#cboTaskTypeW76F2111").find('[value!="%"]').prop('disabled', '');
                $("#cboTaskTypeW76F2111").selectpicker('refresh');
            }
            var text = $("#cboTaskTypeW76F2111").selectpicker("text");
            var textWrap = $("#cboTaskTypeW76F2111").selectpicker("wrapText");


            $("#txtTaskTypeNameW76F2111").val(text);
            $("#txtTaskNotesW76F2111").val(textWrap);


        });

        if (task == "edit"){
            var value = '{{$cboTaskTypeW76F2111}}';
            value = value.split(",");
            $("#cboTaskTypeW76F2111").selectpicker('val', value);
        }
    });

    $("#callW17F1010").on('click', function(){
        var arr = $("#txtD76CompanyIDW76F2111").val().split(";");
        var result = $.grep(arr, function(row){
            return row != "";
        });
        result = result.toString(",");
        //var test = $("#txtD76CompanyIDW76F2111").val().substring(0, $("#txtD76CompanyIDW76F2111").val().length -1).split(";").toString(",");
        //alert(result);
        showFormDialogPost("{{url('/W17F1010/D17F1010/'.$g)}}",'modalW17F1010', {companyIDW17F1010: result, assigneeID: '{{$assigneeID}}'}, 8);
    });

    $("#companySearchW76F2111").click(function(){
        showFormDialogPost("{{url('/W76F2111/'.$pForm.'/'.$g.'/company')}}", 'modalCompanySearch', {txtD76CompanyIDW76F2111: $("#txtD76CompanyIDW76F2111").val()}, 3, null, null, function(){
            if ($("#txtD76CompanyIDW76F2111").val() == ""){
                $("#callW17F1010").removeClass('disabled');
                $("#callW17F1010").addClass('disabled');
                $("#callW17F1010").find("i").removeClass('text-orange');
                $("#callW17F1010").find("i").removeClass('text-gray');
                $("#callW17F1010").find("i").addClass('text-gray');
            }else{
                $("#callW17F1010").removeClass('disabled');
                $("#callW17F1010").find("i").removeClass('text-orange');
                $("#callW17F1010").find("i").removeClass('text-gray');
                $("#callW17F1010").find("i").addClass('text-orange');
            }
        });
    });

    $("#btnSaveW76F2111").click(function(e){
        $("#txtD17CompanyNameW76F2111").val() == "" ? $("#txtD76CompanyIDW76F2111").val(""): "";
        ask_save(function(){
            validationElements($("#frmW76F2111"),function(){
               /* var wday = $("#cboTaskTypeW76F2111");
                wday.get(0).setCustomValidity("");
                */
                $("#hdBtnSubmitW76F2111").click();
            });

        });

    });

    $("#frmW76F2111").on("submit", function(e){
        e.preventDefault();

        var router = "";
        if (task == "add"){
            router = "{{url('/W76F2111/'.$pForm.'/'.$g.'/save')}}";
        }else{
            router = "{{url('/W76F2111/'.$pForm.'/'.$g.'/update')}}";
        }

        var taskType = $("#cboTaskTypeW76F2111").selectpicker('val').join(',');

        postMethod(router, function(res){
            var data = res;
            console.log(data);
            switch (data.status){
                case 'OKAY':
                    save_ok(function(){
                        reLoadGridW76F2110();
                        if (task == "add"){
                            task = "next";
                            enableControl(task);
                            taskID = data.data["StrTaskID"];
                            $("#btnAttachmentW76F2111").removeClass("hide");
                            //console.log($("#frmW76F4071").serialize());
                        }
                        if (task == "edit"){
                            $("#btnSaveW76F2111").prop("disabled", "disabled");
                            $("#btnNotSaveW76F2111").prop("disabled", "disabled");
                        }
                    });
                    break;
                case 'CHECKSTORE':
                   alert_warning(data.message);
                    break;
                case 'FAILED':
                    save_not_ok();
                    break;
            }
        }, $("#frmW76F2111").serialize() + "&taskID={{$taskID}}" + "&cboTaskTypeW76F2111=" + taskType+'&txtD76CompanyIDW76F2111='+txtD76CompanyIDW76F2111.val() + "&dtpExecuteFromW76F2111=" + $("#dtpExecuteFromW76F2111").val() + "&dtpExecuteToW76F2111=" + $("#dtpExecuteToW76F2111").val() + "&cboStatusW76F2111=" + $("#cboStatusW76F2111").val());
    });

    $("#txtD76CompanyIDW76F2111").keydown(function(e){
        e.preventDefault();
        e.stopPropagation();
    });

    function enableControl(task){
        switch (task){
            case 'add':
                $("#dtpExecuteFromW76F2111").prop("readonly", false);
                $("#dtpExecuteToW76F2111").prop("readonly", false);
                $("#txtExecuteBeginTimeW76F2111").prop("readonly", false);
                $("#txtExecuteEndTimeW76F2111").prop("readonly", false);
                $("#txtLocationW76F2111").prop("readonly", false);
                //$("#cboTaskTypeW76F2111").prop("readonly", false);
                $("#cboTaskTypeW76F2111").selectpicker('enable');
                $("#txtTaskNotesW76F2111").prop("readonly", false);
                $("#txtResultsW76F2111").prop("readonly", false);
                $("#txtActEvaluationW76F2111").prop("readonly", false);
                $("#txtNotesW76F2111").prop("readonly", false);
                $("#txtD76CompanyIDW76F2111").prop("readonly", false);

                $("#btnSaveW76F2111").prop("disabled", "");
                $("#btnNextW76F2111").prop("disabled", "disabled");
                $("#btnNotSaveW76F2111").prop("disabled", "");
                $("#btnAttachmentW76F2111").addClass("hide");
                $("#btnAttachmentW76F2111").prop("disabled", "disabled");
                break;
            case "next":
                $("#btnSaveW76F2111").prop("disabled", "disabled");
                $("#btnNextW76F2111").prop("disabled", "");
                $("#btnNotSaveW76F2111").prop("disabled", "disabled");
                $("#btnAttachmentW76F2111").prop("disabled", "");
                break;
            case 'view':
                $("#dtpExecuteFromW76F2111").prop("readonly", true);
                $("#dtpExecuteToW76F2111").prop("readonly", true);
                $("#txtExecuteBeginTimeW76F2111").prop("readonly", true);
                $("#txtExecuteEndTimeW76F2111").prop("readonly", true);
                $("#txtLocationW76F2111").prop("readonly", true);
                $("#cboTaskTypeW76F2111").selectpicker('disable');
                $("#txtTaskNotesW76F2111").prop("readonly", true);
                $("#txtResultsW76F2111").prop("readonly", true);
                $("#txtActEvaluationW76F2111").prop("readonly", true);
                $("#txtNotesW76F2111").prop("readonly", true);
                $("#txtD76CompanyIDW76F2111").prop("readonly", true);

                $("#btnSaveW76F2111").prop("disabled", "disabled");
                $("#btnNextW76F2111").prop("disabled", "disabled");
                $("#btnNextW76F2111").hide();
                $("#btnSaveW76F2111").hide();
                $("#btnNotSaveW76F2111").hide();
                $("#btnNotSaveW76F2111").prop("disabled", "disabled");
                $("#btnAttachmentW76F2111").prop("disabled", "");
                break;
            case 'edit':
                $("#dtpExecuteFromW76F2111").prop("readonly", true);
                $("#dtpExecuteFromW76F2111").prop("disabled", "disabled");
                $("#dtpExecuteToW76F2111").prop("readonly", true);
                $("#dtpExecuteToW76F2111").prop("disabled", "disabled");
                $("#txtExecuteBeginTimeW76F2111").prop("readonly", false);
                $("#calendar_from").unbind();
                $("#calendar_from").removeAttr("onclick");
                $("#calendar_to").unbind();
                $("#calendar_to").removeAttr("onclick");
                $("#txtExecuteEndTimeW76F2111").prop("readonly", false);
                $("#txtLocationW76F2111").prop("readonly", false);
                //$("#cboTaskTypeW76F2111").prop("readonly", true);
                //$("#cboTaskTypeW76F2111").selectpicker('disable'); 108242
                $("#txtTaskNotesW76F2111").prop("readonly", false);
                $("#txtResultsW76F2111").prop("readonly", false);
                $("#txtActEvaluationW76F2111").prop("readonly", false);
                $("#txtNotesW76F2111").prop("readonly", false);
                $("#txtD76CompanyIDW76F2111").prop("readonly", {{$isReadOnly}});

                $("#btnSaveW76F2111").prop("disabled", "");
                $("#btnNextW76F2111").prop("disabled", "disabled");
                $("#btnNextW76F2111").hide();
                $("#btnNotSaveW76F2111").prop("disabled", "");
                $("#btnAttachmentW76F2111").prop("disabled", "");
                break;
        }
    }

    function defaultValues(){
       var dateFrom = "{{$dateFrom}}";
       var dateTo = "{{$dateTo}}";
       $("#dtpExecuteFromW76F2111").val(dateFrom);
       $("#dtpExecuteToW76F2111").val(dateTo);

    }

    $("#btnNextW76F2111").click(function(){
        $('#frmW76F2111')[0].reset();
        $("#cboTaskTypeW76F2111").selectpicker('deselectAll');
        defaultValues();
        task = "add";
        taskID = "";
        enableControl(task);
    });
    $("#btnNotSaveW76F2111").click(function(){
        ask_not_save(function(){
            $("#modalW76F2111").modal('hide');
        });
    });

    $("#btnAttachmentW76F2111").click(function(){
        showFormDialogPost('{{url("/W09F4010/$pForm/$g")}}', "modalW09F4010",
            {
                formCall: "W76F2111",
                keyID: taskID, // có thể có 1 giá trị hoặc danh sách giá trị
                tableName: 'D76T2050',
                useParentPermission: 1
            },6, null, null, null);
    });
$('#modalW76F2111').on('hidden.bs.modal',function(){
    reLoadGridW76F2110();

})



</script>


