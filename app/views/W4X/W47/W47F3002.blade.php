<style>
    #modalW47F3002 .pdt3{
        padding-top: 3px !important;
    }
</style>
<div class="modal fade pd0" id="modalW47F3002" data-backdrop="static" role="dialog" style="position: absolute !important;">
    <div class="modal-dialog" style="width: 98%">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($title3002,"W47F3002",false,'closePopW47F3002')}}
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="frmW47F3002" name="frmW47F3002">
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <div class="checkbox pdt3">
                                            <label>
                                                <input type="checkbox" id="chkIsSendMail" name="chkIsSendMail"> {{Helpers::getRS($g,"Da_gui_mail")}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 pdl0 pdr0">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control pull-right" id="txtDateW47F3002" name="txtDateW47F3002" type="text" value="{{date('d/m/Y').' - '.date('d/m/Y')}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="row">
                                            <label class="control-label lbl-normal col-md-4 pdt3">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="slStatus" name="slStatus">
                                                    @foreach($status as $row)
                                                        <option value="{{$row['Value']}}">{{$row['Caption']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <label class="control-label lbl-normal col-md-4 pdt3">{{Helpers::getRS($g,"Loai_gia_dinh")}}</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="slPlanType" name="slPlanType">

                                                    @foreach($planType as $rowType)
                                                        <option value="{{$rowType['Value']}}">{{$rowType['Caption']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="submit" class="btn btn-default smallbtn pull-right"><span class="digi digi-filter"></span>
                                            &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label lbl-normal" style="font-style: italic">{{Helpers::getRS($g,"Don_vi_tinh")}}</label>: <label class="control-label"
                                                                                                                                                    style="font-style: italic">VND</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="divW47F3002"></div>
                        </div>
                        <input type="hidden" id="hdContractID" value="">
                        <input type="hidden" id="hdParameter" value="">
                    </div>
                    <div class="row mgt10">
                        <div class="col-md-6">
                            @if ($per3002>3)
                                <button id="frm_btnCancel" type="button" class="btn btn-default smallbtn"><span
                                            class="glyphicon glyphicon-circle-remove mgr5"></span> {{Helpers::getRS($g,"Huy_gia_dinh")}}</button>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <button id="frm_btnClose" type="button" class="btn btn-default smallbtn pull-right"><span class="fa fa-close mgr5"></span> {{Helpers::getRS($g,"DongU1")}}</button>
                            <button id="frm_btnSendMail" type="button" class="btn btn-default smallbtn pull-right mgr5"><span class="fa fa-envelope mgr5"></span> Send Mail</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<div class="modal draggable fade" id="mSendMailW47F3002" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="frmmSendMailW47F3002">
                <div class="modal-header">
                    {{Helpers::generateHeading( Helpers::getRS(-1,'Gui_mail'),"",false,"closePopSendMailW47F3002")}}
                </div>
                <div class="modal-body">
                    <div class="form-group mgt10">
                        <label for="txtto"
                               class="col-sm-1 control-label text-left">To</label>
                        <div class="col-sm-11">
                            <select class="form-control select2" id="slMailTo" name="slMailTo"
                                    multiple="multiple" style="width: 100%;" autofocus required>
                                    @foreach($resTo as $row)
                                        <option value="{{$row["UserID"]}}"
                                        data-mail="{{$row['Email']}}">{{$row["UserID"].' - '.$row["UserName"]}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtto"
                               class="col-sm-1 control-label text-left">CC</label>
                        <div class="col-sm-11">
                            <input class="form-control fa glyphicon glyphicon-message" id="txtEmailCCAddress" name="txtEmailCCAddress" placeholder="CC:" value="{{$rsMail['CCAddress'] or ''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtto"
                               class="col-sm-1 control-label text-left">BCC</label>
                        <div class="col-sm-11">
                            <input class="form-control" id="txtEmailBCCAddress" name="txtEmailBCCAddress" placeholder="BCC:" value="{{$rsMail['BCCAddress'] or ''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtto"
                               class="col-sm-1 control-label text-left">Subject</label>
                        <div class="col-sm-11">
                            <input class="form-control" id="txtEmailTitle" name="txtEmailTitle" placeholder="Subject:" value="{{$rsMail['Subject'] or '' }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea id="txtEmailContent" name="txtEmailContent" rows="10" cols="80">{{$rsMail['EmailContent'] or '' }}</textarea></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-flat smallbtn" disabled><span class="fa fa-paperclip"> (1)</span></button>
                                <button type="submit" class="btn btn-primary smallbtn btnSendMailW47F3002"><span class="fa fa fa-envelope-o mgr10"></span>{{Lang::get("message.Gui_di")}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alert alert-success alert-dismissable hide">
                        <i class="icon fa fa-check"></i> {{Lang::get("message.Gui_mail_thanh_cong")}}!.
                    </div>
                    <div class="alert alert-danger alert-dismissable hide">
                        <i class="icon fa fa-ban"></i> <span id="err">{{Lang::get("message.Co_loi_xay_ra_khi_gui_mail")}}!</span>
                    </div>

                </div>
            </form>
            <div class="l3loading hide">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    var subfixSendmail = new Date().getTime();
    $(document).ready(function () {
        $("#frm_btnSendMail").attr('id',("frm_btnSendMail"+ subfixSendmail));
        $("#frm_btnCancel").attr('id',("frm_btnCancel"+ subfixSendmail));
        $('#txtDateW47F3002').daterangepicker({
            format: 'DD/MM/YYYY',
            startDate: '{{date('d/m/Y')}}',
            endDate: '{{date('d/m/Y')}}',
            autoApply: true
        });

        $("#slMailTo").select2({
            separator: ";",
            templateResult: function (state) {
                if (!state.id) {
                    return state.text;
                }
                return $('<span>' + state.text + '</span>&nbsp;&nbsp;&nbsp;&nbsp;<small>(' + $(state.element).attr('data-mail') + ')</small>');
            }
        });

    });

    $("#modalW47F3002").on('shown.bs.modal', function () {
        $('#frmW47F3002').submit();
        //$("#pqGrid_W47F3002").pqGrid('refreshDataAndView');
    });

    var arrW47F3002 = [];
    var getSelectRowW47F3002 = function () {
        var dataObj = $("#pqGrid_W47F3002").pqGrid("option", "dataModel.data");
        var mailTo = [];
        arrW47F3002 = [];
        for (var i = 0; i < dataObj.length; i++) {
            var check = dataObj[i]['IsSelect'];
            if (check && check != 0) {
                arrW47F3002.push(dataObj[i]);
                var userid = dataObj[i]['UserID'].split(';');
                for (var k = 0; k < userid.length; k++) {
                    if (mailTo.indexOf(userid[k]) < 0)
                        mailTo.push(userid[k]);
                }

            }
        }
        return mailTo;
    };

    $('#divModalW47F3002').on('click', '#frm_btnSendMail' + subfixSendmail, function () {
        //console.log($('#divModalW47F3002').find('#frm_btnSendMail' + subfixSendmail));
        var mailto = getSelectRowW47F3002();
        if (arrW47F3002.length == 0){
            alert_warning('{{Helpers::getRS($g,"Ban_phai_chon_du_lieu_tren_luoi")}}');
        }else{
            $('#frmmSendMailW47F3002').find('#slMailTo').val(mailto).trigger("change");
            $('#mSendMailW47F3002').modal('show');
        }
    });

    $('#divModalW47F3002').on('click', '#frm_btnClose', function () {
           $("#modalW47F3002").modal('hide');
           $("#divModalW47F3002").empty();
    });

    $(function () {
        CKEDITOR.replace('txtEmailContent', {
            removeButtons: 'Source',
            removePlugins: 'save,print,preview,find,about,maximize,showblocks,elementspath,spellchecker',
            resize_enabled: false
            // The rest of options...
        });
    });

    var closePopSendMailW47F3002 = function () {
        $("#mSendMailW47F3002").modal('hide');
        $("#mSendMailW47F3002").find(".alert-danger").addClass('hide');
        $("#mSendMailW47F3002").find(".alert-success").addClass('hide');
    };

    var closePopW47F3002 = function () {
        $("#mSendMailW47F3002").modal('hide');
        $("#modalW47F3002").modal('hide');

        setTimeout(function(){
            $('#modalW47F3002').children().off();
            $('#modalW47F3002').off();
            $('#mSendMailW47F3002').children().off();
            $('#mSendMailW47F3002').off();
            $('#divModalW47F3002').empty();
        }, 2000);

    };

    $('#divModalW47F3002').on('submit', '#frmmSendMailW47F3002', function (e) {
        e.preventDefault();
        $('.btnSendMailW47F3002').prop('disabled','disabled');
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        var userid = $('#frmmSendMailW47F3002').find('#slMailTo').val().join(";");
        var opt = $('#frmmSendMailW47F3002').find('#slMailTo').find('option:selected');
        var mailto = [];
        for (var i = 0; i < opt.length;i++){
            mailto.push($(opt[i]).attr('data-mail'));
        }
        initExportExcell($("#pqGrid_W47F3002"), _title, _dataIndx, _align, _format, _format);
        $.ajax({
            method: "POST",
            url: "{{'W47F3002/mail'}}",
            data: $('#frmmSendMailW47F3002').serialize() + "&dataModal=" + JSON.stringify(arrW47F3002) + "&title=" + JSON.stringify(_title) + "&dataIndx=" + JSON.stringify(_dataIndx) + "&align=" + JSON.stringify(_align) + "&format=" + JSON.stringify(_format)+'&mailto='+JSON.stringify(mailto.join(";"))+'&userid='+userid,
            success: function (data) {
                var currentObject = $.parseJSON(data);
                $('.btnSendMailW47F3002').prop('disabled','');
                if (currentObject.code == 1) {
                    alert_info('{{Helpers::getRS($g,"Gui_mail_thanh_cong")}}. <br><span class="fa fa-paperclip text-blue"> ' + currentObject.filename + '</span>', function () {
                        closePopSendMailW47F3002();
                        $('#frmW47F3002').submit();
                    });
                } else {
                    alert_error(currentObject.mess);
                }
            }
        });
    });

    $('#divModalW47F3002').on('click', '#frm_btnCancel' + subfixSendmail, function (e) {
        getSelectRowW47F3002();
        if (arrW47F3002.length == 0){
            alert_warning('{{Helpers::getRS($g,"Ban_phai_chon_du_lieu_tren_luoi")}}');
        }else{
            ask_save(function () {
                $("#divModalW47F3002").find('#frm_btnCancel' + subfixSendmail).prop('disabled', 'disabled');
                $.ajax({
                    method: "POST",
                    url: "{{'W47F3002/2'}}",
                    data: {dataModal: JSON.stringify(arrW47F3002)},
                    success: function (data) {
                        $("#divModalW47F3002").find('#frm_btnCancel' + subfixSendmail).prop('disabled', '');
                        var currentObject = $.parseJSON(data);
                        if (currentObject.Status == "1")
                            alert_error(currentObject.Message);
                        else
                            alert_info(currentObject.Message);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $("#divModalW47F3002").find('#frm_btnCancel' + subfixSendmail).prop('disabled', '');
                    }
                });
            },null,"{{Helpers::getRS($g,"Ban_co_muon_Huy_gia_dinh_khong")}}");
        }
    });

    $('#frmW47F3002').on('submit', function (e) {
        e.preventDefault();
        onSubmit();
    });

    function onSubmit(){
                $("#pqGrid_W47F3002").pqGrid('showLoading');
                var datef = $('#frmW47F3002').find('#txtDateW47F3002').val() == "" ? "" : $('#frmW47F3002').find('#txtDateW47F3002').data('daterangepicker').startDate.format('DD/MM/YYYY');
                var datet = $('#frmW47F3002').find('#txtDateW47F3002').val() == "" ? "" : $('#frmW47F3002').find('#txtDateW47F3002').data('daterangepicker').endDate.format('DD/MM/YYYY');
                $.ajax({
                    method: "POST",
                    url: "{{'W47F3002/1'}}",
                    data: $('#frmW47F3002').serialize() + '&datef=' + datef + '&datet=' + datet + '&parameter=' + '{{$parameter}}' + '&isPlan={{$isPlan}}&unit={{$unit}}' + "&planType="+$("#modalW47F3002").find("#slPlanType").val(),
                    success: function (data) {
                        /*var currentObject = $.parseJSON(data);
                        $("#pqGrid_W47F3002").pqGrid("option", "dataModel.data", currentObject);
                        $("#pqGripqGrid_W47F3002d_W47F3002").pqGrid('hideLoading');
                        $("#pqGrid_W47F3002").pqGrid( "reset", {filter: true } );
                        $("#pqGrid_W47F3002").pqGrid('refreshDataAndView');
                        $("#pqGrid_W47F3002").pqGrid('refreshDataAndView');*/
                        $("#pqGrid_W47F3002").pqGrid('hideLoading');
                        $("#divW47F3002").html('');
                        $("#divW47F3002").html(data);
                        $("#pqGrid_W47F3002").pqGrid('refreshDataAndView');
                    }
                });
    }

    $('#frmW47F3002').on('change', '#chkIsSendMail', function () {
        if ($(this).is(":checked")) {
            $('#txtDateW47F3002').prop('disabled', '');
        } else {
            $('#txtDateW47F3002').prop('disabled', 'disabled');
        }
    });

    $("#modalW47F3002").find("#slPlanType").change(function(){
        //onSubmit();
    });

</script>

