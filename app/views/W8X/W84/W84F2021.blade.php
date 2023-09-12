@if(isset($rs))
    @extends('layout.component.historypop')
    @extends('layout.component.approvalpop')
    <form class="form-horizontal" id="frmduyet" style="width: 100%">
        <div class="form-group">
            <div class="col-md-4 pdr0">
                    @define $approvalLevel = $rs['ApprovalLevel']
                    <a onclick="showHistory('{{$vou}}', '{{$approvalLevel}}')" style="padding: 5px 10px 5px 13px; background: #0072b1; color:#fff; text-decoration: underline ">
                        <b id="idApprovalLevelW84F2021">{{$rs['ApprovalLevel']}}</b></a>
                @if($rs['ApprovalStatusID']=='P')
                    <b class="clsPending">{{$rs['ApprovalStatus']}}</b>
                @elseif($rs['ApprovalStatusID']=='A')
                    <b class="clsApprove">{{$rs['ApprovalStatus']}}</b>
                @else
                    <b class="clsReject">{{$rs['ApprovalStatus']}}</b>
                @endif
                <a onclick="showHistory('{{$vou}}', '{{$approvalLevel}}')" style="padding: 5px 10px 5px 13px; background: #0072b1; color:#fff; text-decoration: underline ">
                    <b id="idApprovalLevelW84F2021">{{Helpers::getRS($g, 'Lich_su_duyet')}}</b></a>

            </div>
            <div class="col-md-2">
                <i class="fa fa-calendar"></i> <b>{{$rs['ApproveDate']}}</b>
            </div>
            <div class="col-md-4">
                <i class="fa fa-file-text mgt10"></i>
                <b>{{mb_substr($rs['ApproveNotes'],0,50)}} {{strlen($rs['ApproveNotes'])>60 ? "..." : ""}}</b>
            </div>
            <div class="col-md-2">
                <button type="button"
                        @if($rs['ApprovalDisplay']==0 && $rs['NotApprovalDisplay']==0)
                        class="btn smallbtn bg-orange pull-right disabled">
                        @else
                            onclick='$("#mPopUpApprove").modal("show");'
                            class="btn smallbtn bg-orange pull-right">
                        @endif
                    <span class="glyphicon glyphicon-ok mgr10"></span>
                    {{Helpers::getRS($g,"Phe_duyet")}}</button>

            </div>
        </div>
    </form>
@section('pcontent')
    <div id="gridHistoryW84F2021" style="height: 400px;width: 80%;"></div>
    <table class="hide" cellspacing="5" cellpadding="5" width="100%" class="lineheight20 tbl">
        <thead class="l3_thead_gray">
        <tr>
            <th class="classTT text-center">{{Helpers::getRS($g,'Cap_duyet')}}</th>
            <th class="str_level2 text-center">{{Helpers::getRS($g,'Vai_tro')}}</th>
            <th class="str_level3 text-center">{{Helpers::getRS($g,'Nguoi_duyet')}}</th>
            <th class="str_level1 text-center">{{Helpers::getRS($g,'Duoc_uy_quyen')}}</th>
            <th class="str_level1 text-center">{{Helpers::getRS($g,'Trang_thai')}}</th>
            <th class="str_level1 text-center">{{Helpers::getRS($g,'Thuc_hien')}}</th>
            <th class="str_level1_large text-center">{{Helpers::getRS($g,'Ngay_duyet')}}</th>
            <th class="text-center">{{Helpers::getRS($g,'Ghi_chu')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rsHistory as $row )
            <tr>
                <td class="text-center" style="width: 85px">
                    @if($row['IsUser'] == 1)
                        <i class="fa fa-user" style="margin-left: -25px;padding-right: 13px; "></i>{{$row['Priority']}}
                    @else
                        {{$row['Priority']}}
                    @endif
                </td>
                <td class="str_level2 ">{{$row['RoleName']}}</td>
                <td class="str_level3 ">{{$row['ApproverName']}}</td>
                <td class="text-center" style="width: 105px;">
                    @if(isset($row['IsAuthorize']) && $row['IsAuthorize']==1)
                        {{Form::checkbox("", $row['IsAuthorize'], true, ['disabled' => 'disabled'] )}}
                    @else
                        {{Form::checkbox("", 0, false, ['disabled' => 'disabled'] )}}
                    @endif
                </td>
                <td class="str_level1_large text-center
                   @if($row['ApprovalStatusID']==0)
                        clsPending
                     @elseif($row['ApprovalStatusID']==1)
                        clsApprove
                     @else
                        clsReject
                     @endif
                        ">
                    <b>{{$row['ApprovalStatusName']}}</b>
                </td>
                <td class="text-center" style="width: 75px;">
                    @if(isset($row['IsActualAction']) && $row['IsActualAction']==1)
                        {{Form::checkbox("", $row['IsActualAction'], true, ['disabled' => 'disabled'] )}}
                    @else
                        {{Form::checkbox("", 0, false, ['disabled' => 'disabled'] )}}
                    @endif
                </td>
                <td class="str_level1_large text-center">{{$row['ApproverDate']}}</td>
                <td>{{$row['ApproveNotes']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
@section('apcontent')
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-2 pdl0">
                {{Helpers::getRS($g,"Ghi_chu")}}
            </div>
            <div class="col-sm-10">
                <textarea id="txtAppNotes" name="txtAppNotes" class="form-control" rows="2" placeholder=""></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-2 pdl0">
            </div>
            <div class="col-sm-10">
                @if($rs['ApprovalDisplay']==1)
                    <button type="button" class="btn btn-default smallbtn mgr10 mgt10 confirmation-Approval"><span
                                class="glyphicon glyphicon-ok mgr10"></span>{{Helpers::getRS($g,"Duyet")}}</button>
                @endif
                @if($rs['NotApprovalDisplay'])
                    <button type="button" class="btn btn-default smallbtn mgt10 confirmation-NotApproval"><span
                                class="glyphicon glyphicon-remove mgr10"></span>{{Helpers::getRS($g,"Khong_duyet")}}
                    </button>
                @endif
            </div>
        </div>
    </div>
@stop
<div class="modal draggable fade" id="mPopUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Thong_baoU"),"",false,"closePop")}}
            </div>
            <div class="modal-body" style="background: #fff; float: left; width: 100%; padding-bottom: 5px;">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var closePop = function () {
        $("#mPopUp").modal('hide');
        $(".no-menu-alert").load("{{url("/alert")}}");
        refresh();
    };
    $(document).ready(function () {
        $('.input-group.date').datepicker({
            todayHighlight: true
        });
        loadHistoryGrid();
    });

    $('.confirmation-Approval').confirmation({
        placement: 'right',
        btnOkLabel: 'Yes',
        btnCancelLabel: 'No',
        title: "{{Helpers::getRS($g,"Ban_co_muon_duyet_phieu_nay_khong")}}",
        onConfirm: function () {
            Approval(1)
        },
        onCancel: function () {
        }
    });
    $('.confirmation-NotApproval').confirmation({
        placement: 'right',
        btnOkLabel: 'Yes',
        btnCancelLabel: 'No',
        title: "{{Helpers::getRS($g,"Ban_co_muon_khong_duyet_chung_tu_nay_khong")}}",
        onConfirm: function () {
            Approval(100)
        },
        onCancel: function () {
        }
    });
    var Approval = function (mod) {
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {IsApproval: mod, txtAppNotes: $("#txtAppNotes").val(), approvalLevel: '{{$rs['ApprovalLevel']}}'},
            success: function (data) {
                // $("#messagePOP").html(data);
                //$("#messagePOP").find("#mPopUp").modal('show');
                $("#mPopUpApprove").modal('hide');
                result = $.parseJSON(data);
                if (result.rs == 10)//Lỗi
                {
                    alert_error(result.name);
                    return;
                }
                if (mod == 100) {
                    if (result.rs == 1) {
                        $("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4>  <i class='fa fa-chevron-circle-down' ></i> {{Helpers::getRS($g,"Phieu_chung_tu_khong_duoc_duyet")}}</h4><div class='col-md-12 alert-success-approve'>{{Helpers::getRS($g,'Mail_da_duoc_gui_toi')}} &nbsp;<b>" + result.name + "</b></div>");
                    }
                    else if (result.rs == 2) {
                        //$("#emailPOP").html(result.rsvalue);
                        leftshowsendmail(result.EmailSenderAddress, result.EmailReceivedAddress, result.Subject, result.EmailContent, result.EmailCCAddress,result.EmailBCCAddress, 0 );
                        $("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4><i class='fa fa-chevron-circle-down' ></i>{{Helpers::getRS($g,"Phieu_chung_tu_khong_duoc_duyet")}}</h4></div><div class='col-md-12 alert-success-approve'> {{Helpers::getRS($g,'Nguoi_nhan_tiep_theo_')}} &nbsp;<b>" + result.name + "</b> <button onclick='showsendmail();'  type='button' class='btn btn-default smallbtn' ><i class='fa fa-envelope'></i>{{Helpers::getRS($g,"Gui_mail")}}</button></div>");
                    }
                    else {
                        $("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4><i class='fa fa-chevron-circle-down' ></i>{{Helpers::getRS($g,"Phieu_chung_tu_khong_duoc_duyet")}}</h4></div>");
                    }
                }
                //
                else {
                    if (result.rs == 1) {
                        $("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4>  <i class='fa fa-chevron-circle-down' ></i> {{Helpers::getRS($g,"Phieu_chung_tu_da_duoc_duyet")}}</h4><div class='col-md-12 alert-success-approve'>{{Helpers::getRS($g,'Mail_da_duoc_gui_toi_nguoi_duyet_tiep_theo')}} &nbsp;<b>" + result.name + "</b></div>");
                    }
                    else if (result.rs == 2) {
                       // $("#emailPOP").html(result.rsvalue);
                        leftshowsendmail(result.EmailSenderAddress, result.EmailReceivedAddress, result.Subject, result.EmailContent, result.EmailCCAddress,result.EmailBCCAddress,0 );
                        $("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4><i class='fa fa-chevron-circle-down' ></i>{{Helpers::getRS($g,"Phieu_chung_tu_da_duoc_duyet")}}</h4></div><div class='col-md-12 alert-success-approve'> {{Helpers::getRS($g,'Nguoi_nhan_tiep_theo_')}} &nbsp;<b>" + result.name + "</b> <button onclick='showsendmail();'  type='button' class='btn btn-default smallbtn' ><i class='fa fa-envelope'></i>{{Helpers::getRS($g,"Gui_mail")}}</button></div>");
                    }
                    else {
                        $("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4><i class='fa fa-chevron-circle-down' ></i>{{Helpers::getRS($g,"Phieu_chung_tu_da_duoc_duyet")}}</h4></div>");
                    }
                }
                $("#mPopUp").modal('show');
            }
        });

    };
    var ExecApproval = function (mod) {
    };
    var showHistory = function (vou, approvalLevel) {
        @if ($isCallW09F3030 == 1)
            showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: "{{$vou}}", approvalLevel: approvalLevel},2);
        @else
            $("#mPopUpHistory").modal('show');
            setTimeout(function(){
                resizePqGrid();
            }, 300);

        @endif

    };
    var showsendmail = function () {
        closePop();
        $("#newmailPOP").find("#mPopUpSendMail").modal('show');
        //$("#emailPOP").find("#mPopUpSendMail").modal('show');
    };

    function loadHistoryGrid(){
        var obj = {
            width: '100%',
            height: '100%',
            editable: true,
            freezeCols: 1,
            selectionModel: {type: 'row'},
            minWidth: 30,
            pageModel: {type: "local", rPP: 20},
            filterModel: {on: false, mode: "AND", header: false},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showTitle: false,
            dataType: "JSON",
            numberCell: {show: false},
            wrap: true,
            hwrap: true,
            collapsible: false,
            postRenderInterval: -1,
            colModel: [
                {
                    title: "{{Helpers::getRS($g,"Cap_duyet")}}",
                    minWidth: 80,
                    dataType: "string",
                    align: "center",
                    dataIndx: "Priority",
                    editor: false,
                    editable: false,
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsAuthorize"] == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        var str = '';
                        if (row.IsUser == 1) {
                            str += '<i class="fa fa-user" style="margin-left: -25px;padding-right: 13px; "></i>' + row.Priority;
                        } else {
                            str += row.Priority;
                        }
                        return {
                            text: str,
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }


                },
                {
                    title: "{{Helpers::getRS($g,"Vai_tro")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "RoleName",
                    editor: false,
                    editable: function (ui) {
                        var row = ui.rowData
                        return false;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsAuthorize"] == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Nguoi_duyet")}}",
                    minWidth: 230,
                    dataType: "string",
                    align: "left",
                    dataIndx: "ApproverName",
                    editor: false,
                    editable: function (ui) {
                        var row = ui.rowData
                        return false;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsAuthorize"] == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Duoc_uy_quyen")}}",
                    minWidth: 110,
                    dataType: "string",
                    align: "center",
                    dataIndx: "IsAuthorize",
                    editor: false,
                    type: 'checkbox',
                    cb: {
                        all: false,
                        header: true,
                        check: "1",
                        uncheck: "0"
                    },
                    editable: function (ui) {
                        var row = ui.rowData
                        return false;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsAuthorize"] == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            text: "<label><input type='checkbox' " + checked + " /></label>",
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },

                },
                {
                    title: "{{Helpers::getRS($g,"Trang_thai")}}",
                    minWidth: 110,
                    dataType: "string",
                    align: "center",
                    dataIndx: "ApprovalStatusName",
                    editor: false,
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsActualAction"] == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        var cls = '';
                        if (row.ApprovalStatusID == 0)
                            cls = 'clsPending';
                        else if (row.ApprovalStatusID == 1)
                            cls = 'clsApprove';
                        else
                            cls = 'clsReject';
                        return {
                            text: row.ApprovalStatusName,
                            cls: cls
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Thuc_hien")}}",
                    minWidth: 80,
                    dataType: "string",
                    align: "center",
                    dataIndx: "IsActualAction",
                    editor: false,
                    type: 'checkbox',
                    cb: {
                        all: false,
                        header: true,
                        check: "1",
                        uncheck: "0"
                    },
                    editable: function (ui) {
                        var row = ui.rowData
                        return false;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsActualAction"] == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            text: "<label><input type='checkbox' " + checked + " /></label>",
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Ngay_duyet")}}",
                    minWidth: 110,
                    dataType: "string",
                    align: "center",
                    dataIndx: "ApproverDate",
                    editor: false,
                    editable: function (ui) {
                        var row = ui.rowData
                        return false;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsAuthorize"] == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                    minWidth: 240,
                    dataType: "string",
                    dataIndx: "ApproveNotes",
                    editor: false,
                    editable: function (ui) {
                        var row = ui.rowData
                        return false;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsAuthorize"] == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                }

            ],
            dataModel: {
                data: {{json_encode($rsHistory)}}
            }
        };
        var $gridHistoryW84F2021 = $("#gridHistoryW84F2021").pqGrid(obj);
        $gridHistoryW84F2021.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridHistoryW84F2021.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridHistoryW84F2021.pqGrid("refreshDataAndView");


    }


</script>
@endif