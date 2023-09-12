<div class="modal draggable fade modal" id="modalW76F2101" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 90%">

        <?php
        if ($task == 'add') {
            $ID = "";
            $DivisionID = '';
            $DocNo = '';
            $DocGroupID = '';
            $ReceiveSendOrganization = '';
            $ReleaseDate = '';
            $Signer = '';
            $ReleaseDate = '';
            $EffectDateFrom = '';
            $EffectDateTo = '';
            $Emergency = '';
            $Security = '';
            $StatusID = '';
            $DocType = '';
            $QuanPage = '';
            $KeyWords = '';
            $Content = '';
            $RefReceiveDocNo = '';
            $RefSentDocNo = '';
            $StatusID = '';
            $SheftNo = '';
            $FloorNo = '';
            $PartitionNo = '';
            $FolderNo = '';
            $ReceiveSendDate = '';
            $SenderID = '';
        } else if ($task == 'view' || 'edit') {
            $ID = $rsData["ID"];
            $DivisionID = $rsData['DivisionID'];
            $DocNo = $rsData['DocNo'];
            $DocGroupID = $rsData['DocGroupID'];
            $ReceiveSendOrganization = $rsData['ReceiveSendOrganization'];
            $ReleaseDate = (date("d/m/Y", strtotime($rsData['ReleaseDate'])));
            $Signer = $rsData['Signer'];
            $EffectDateFrom = (date("d/m/Y", strtotime($rsData['EffectDateFrom'])));
            $EffectDateTo = (isset($rsData['EffectDateTo']) ? date("d/m/Y", strtotime($rsData['EffectDateTo'])) : '');
            $SheftNo = $rsData['SheftNo'];
            $FloorNo = $rsData['FloorNo'];
            $PartitionNo = $rsData['PartitionNo'];
            $FolderNo = $rsData['FolderNo'];
            $StatusID = $rsData['StatusID'];
            $DocType = $rsData['DocType'];
            $Emergency = $rsData['Emergency'];
            $Security = $rsData['Security'];
            $QuanPage = $rsData['QuanPage'];
            $KeyWords = $rsData['KeyWords'];
            $Content = $rsData['Content'];
            $RefReceiveDocNo = $rsData['RefReceiveDocNo'];
            $RefSentDocNo = $rsData['RefSentDocNo'];
            $ReceiveSendDate = (isset($rsData['ReceiveSendDate']) ? date("d/m/Y", strtotime($rsData['ReceiveSendDate'])) : '');
            $SenderID = $rsData['SenderID'];
        }

        ?>

        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,'Cap_nhat_cong_van_di'),"W76F2101",true,"")}}
            </div>
            <div class="modal-body">
                <div class="pdt5">
                    <form id="frmW76F2101" class="form-horizontal">
                        <div class="divW76F2101Scrollbar" style="overflow-y: auto; overflow-x: hidden">
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Don_vi")}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <select style="width: 100%; padding-left: 8px; " id="cbDivisionID"
                                            name="cbDivisionID" disabled
                                            required>
                                        <option value="">--</option>
                                        @foreach(json_decode($ListDivision)  as  $item)
                                            <option {{$item->ID==$DivisionID?'selected':''}} value="{{$item->ID}}">{{$item->Name}}</option>
                                        @endforeach

                                    </select>
                                </div>


                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"So_cong_van")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control" name="txtDocNoW76F2101" maxlength="50"
                                           id="txtDocNoW76F2101" required=""
                                           value="{{$DocNo}}" placeholder="" readonly>
                                    <span id="errorW76F2101"
                                          class="hide text-red">{{Helpers::getRS($g,"Ma_co_ky_tu_khong_hop_le")}}</span>
                                </div>

                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Nhom_van_ban")}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <select style="width: 100%; padding-left: 8px;" class="form-control"
                                            id="txtDocGroupIDW76F2101"
                                            required
                                            name="txtDocGroupIDW76F2101" disabled>
                                        <option value="">--</option>
                                        @foreach(json_decode($ListDocGroup) as  $item)
                                            <option {{$item->DocGroupCode==$DocGroupID?'selected':''}}
                                                    value="{{$item->DocGroupCode}}">{{$item->DocGroupName}}
                                            </option>

                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Co_quan_nhan")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control"
                                           name="txtReceiveSendOrganizationW76F2101" maxlength="250"
                                           readonly="true"
                                           id="txtReceiveSendOrganizationW76F2101" value="{{$ReceiveSendOrganization}}"
                                           placeholder="">
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngay_phat_hanh")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">

                                        <input type="text" class="form-control pull-right" autocomplete="off" required
                                               name="txtReleaseDateW76F2101"
                                               readonly="true" disabled
                                               id="txtReleaseDateW76F2101" value="{{$ReleaseDate}}" placeholder=""
                                        >
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"
                                               onclick=" if ('{{$task}}' != 'view') $('#txtReleaseDateW76F2101').datepicker('show')"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Nguoi_ky")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control" name="txtSignerW76F2101" maxlength="250"
                                           readonly="true"
                                           id="txtSignerW76F2101" value="{{$Signer}}" placeholder="">
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"So_trang")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input style="width: 60%;" type="number" class="form-control"
                                           name="txtQuanPageW76F2101" maxlength="6"
                                           readonly="true" onkeypress="return inputNumber(event);" min="1" step="1"
                                           id="txtQuanPageW76F2101" value="{{$QuanPage}}" placeholder="">
                                </div>

                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">

                                        <input type="text" class="form-control pull-right" autocomplete="off"
                                               name="txtEffectDateFromW76F2101" disabled required
                                               id="txtEffectDateFromW76F2101" value="{{$EffectDateFrom}}" placeholder=""
                                        >
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"
                                               onclick=" if ('{{$task}}' != 'view') $('#txtEffectDateFromW76F2101').datepicker('show')"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngay_het_hieu_luc")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">

                                        <input type="text" class="form-control pull-right" autocomplete="off"
                                               name="txtEffectDateToW76F2101" readonly="true" disabled
                                               id="txtEffectDateToW76F2101" value="{{$EffectDateTo}}" placeholder="">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"
                                               onclick=" if ('{{$task}}' != 'view') $('#txtEffectDateToW76F2101').datepicker('show')"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Do_khan_cap")}}</label>
                                </div>
                                <div class="col-sm-4">

                                    <select style="width: 100%; padding-left: 8px;" id="cbEmergencyW76F2101"
                                            name="cbEmergencyW76F2101">
                                        <option value="">--</option>
                                        @foreach($levelList as  $item)
                                            <option {{$item['ID']==$Emergency?'selected':''}} value="{{$item['ID']}}">{{$item['Name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Do_bao_mat")}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <select style="width: 100%; padding-left: 8px;" id="cbSecurityW76F2101"
                                            name="cbSecurityW76F2101">
                                        <option value="">--</option>
                                        @foreach($levelListSecurity as  $item)
                                            <option {{$item['ID']==$Security?'selected':''}} value="{{$item['ID']}}">{{$item['Name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Dang_van_ban")}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <select style="width: 100%; padding-left: 8px;" id="cbDocTypeW76F2101"
                                            name="cbDocTypeW76F2101"
                                            disabled
                                            readonly="true">
                                        <option value="">--</option>
                                        @foreach(json_decode($ListDocType)  as  $item)
                                            <option {{$item->ID==$DocType?'selected':''}} value="{{$item->ID}}">{{$item->Name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <select style="width: 100%; padding-left: 8px;" id="cbStatusID"
                                            value="{{$StatusID}}"
                                            name="cbStatusID"
                                            readonly="true" DISABLED>

                                        <option value="">--</option>
                                        @foreach($ListStutus as  $item)
                                            <option {{$item['ID']==$StatusID?'selected':''}} value="{{$item['ID']}}">{{$item['Name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Tu_khoa")}}</label>
                                </div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <input type="text" class="form-control" name="txtKeyWordsW76F2101" maxlength="2000"
                                           readonly="true"
                                           id="txtKeyWordsW76F2101" value="{{$KeyWords}}" placeholder=""
                                    >
                                </div>

                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <button id="btnAttachmentW76F2101" type="button"
                                            class="btn btn-default smallbtn mgr10"><span
                                                class="fa fa-paperclip mgr5"></span> {{Helpers::getRS($g,"Dinh_kem")}}
                                    </button>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-control pdt0 pdl0 pdb0 div-att" id="divAttachmentW76F2101">
                                    </div>
                                    <input type="file" id="fileAttW76F2101" class="hide"
                                           accept="{{implode(',',$arrFileType)}}"
                                           multiple>
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Trich_yeu")}}</label>
                                </div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                <textarea style="height: 100px;" type="text" class="form-control" maxlength="2000"
                                          name="txtContentW76F2101"
                                          readonly="true"
                                          id="txtContentW76F2101" placeholder=""
                                >{{$Content}}</textarea>
                                </div>

                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"CV_den_lien_quan")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control" name="txtRefReceiveDocNoW76F2101"
                                           maxlength="50"
                                           readonly="true"
                                           id="txtRefReceiveDocNoW76F2101" value="{{$RefReceiveDocNo}}" placeholder="">
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"CV_di_lien_quan")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control" name="txtRefSentDocNoW76F2101"
                                           maxlength="50"
                                           readonly="true"
                                           id="txtRefSentDocNoW76F2101" value="{{$RefSentDocNo}}" placeholder="">
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ke_U")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control" name="txtSheftNoW76F2101" maxlength="250"
                                           readonly="true"
                                           id="txtSheftNoW76F2101" value="{{$SheftNo}}" placeholder="">
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Tang_VN")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control" name="txtFloorNoW76F2101"
                                           readonly="true" maxlength="250"
                                           id="txtFloorNoW76F2101" value="{{$FloorNo}}" placeholder="">
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngan_U")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control" name="txtPartitionNoW76F2101"
                                           readonly="true" maxlength="250"
                                           id="txtPartitionNoW76F2101" value="{{$PartitionNo}}" placeholder="">
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Thu_muc")}}</label>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control" name="txtFolderNoW76F2101"
                                           readonly="true" maxlength="250"
                                           id="txtFolderNoW76F2101" value="{{$FolderNo}}" placeholder="">
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Nguoi_gui")}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <select style="width: 100%; padding-left: 8px;" id="cbSenderID"
                                            name="cbSenderID"
                                            readonly="true" DISABLED>
                                        <option value="">--</option>
                                        @foreach(json_decode($ListSender) as $item)
                                            <option {{$item->ID==$SenderID?'selected':''}} value="{{$item->ID}}">{{$item->Name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngay_gui")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control pull-right" autocomplete="off"
                                               name="txtReceiveSendDateW76F2101"
                                               readonly="true" disabled
                                               id="txtReceiveSendDateW76F2101" value="{{$ReceiveSendDate}}"
                                        >
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"
                                               onclick=" if ('{{$task}}' != 'view') $('#txtReceiveSendDateW76F2101').datepicker('show')"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 mgt10">
                                    <div id="W76F2101Grid">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="box-footer mgt5">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pdl5 pdr5">
                                    <div id="toolbarW76F2101">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function frmW76F2101Reset() {
        $('#frmW76F2101')[0].reset();
        $('#W76F2101Grid').pqGrid('option', 'dataModel.data', []);
        $('#W76F2101Grid').pqGrid('refreshDataAndView');
        $("#cbDivisionID").focus();
    }

    dataSource = JSON.parse('{{$rsDetail}}');
    var permission = '{{$permission}}';

    $(document).ready(function () {
        $("select#cbStatusID").get(0).selectedIndex = 1;


        $('#txtQuanPageW76F2101').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 0,
            autoGroup: true,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: true
        });

        //bat event kiem tra bat buoc nhap
        $("#txtDocNoW76F2101").keyup(function () {
            $("#errorW76F2101").addClass('hide');
            if (checkID($("#txtDocNoW76F2101")) == false) {
                $("#errorW76F2101").removeClass('hide');
            }
        });

        $('#txtEffectDateFromW76F2101').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'

        }).on("changeDate", function (e) {
            var dateFrom = $(this).val().split('/');
            var dateF = parseInt(dateFrom[0]) + 1;
            var monthF = dateFrom[1];
            var YearF = dateFrom[2];
            var LimitDate = dateF.toString() + '/' + monthF + '/' + YearF;
            console.log(LimitDate);

            $('#txtEffectDateToW76F2101').datepicker('setStartDate', LimitDate);
        });
        $('#txtEffectDateToW76F2101').datepicker({
            todayHighlight: true,
            allowEmpty: true,
            defaultDate: null,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        }).on("changeDate", function (e) {
            //var to = $(this).val();
            var dateFrom = $(this).val().split('/');
            var dateF = parseInt(dateFrom[0]) - 1;
            var monthF = dateFrom[1];
            var YearF = dateFrom[2];
            var LimitDate = dateF.toString() + '/' + monthF + '/' + YearF;


            $('#txtEffectDateFromW76F2101').datepicker('setEndDate', LimitDate);
        });
        $('#txtReceiveSendDateW76F2101').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        $('#txtReleaseDateW76F2101').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        //tinh chieu cao cho popup
        var height = $(window).height();
        $("#modalW76F2101").find(".modal-body").height(height - 130);
        var task = '{{$task}}';
        if (task == 'view') {
            $(".divW76F2101Scrollbar").height($("#modalW76F2101").find(".modal-body").height() - 35);
        } else {
            $(".divW76F2101Scrollbar").height($("#modalW76F2101").find(".modal-body").height() - 75);
        }

        $("#toolbarW76F2101").digiMenu({
                showText: true,
                cls: '',
                style: '',
                buttonList: [
                    {
                        ID: "btnSaveCloseW76F2101",
                        icon: "fa fa-save text-red",
                        title: '{{Helpers::getRS($g,"Luu_va_dongU")}}',
                        enable: true,
                        hidden: false,
                        type: "button",
                        cls: "pull-right",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                frmW76F2101Save();
                            });
                        }
                    }
                    , {
                        ID: "btnSaveNextW76F2101",
                        icon: "fa fa-save text-yellow",
                        title: "{{Helpers::getRS($g, 'Luu_va_nhap_tiep')}}",
                        enable: true,
                        hidden: function () {
                            return false;
                        },
                        cls: "pull-right",
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                frmW76F2101Save();
                            });
                        }
                    }
                    , {
                        ID: "btnNextW76F2101",
                        icon: "fa fa-save text-green",
                        title: "{{Helpers::getRS($g, 'Nhap_tiep')}}",
                        enable: true,
                        hidden: function () {
                            return false;
                        },
                        cls: "pull-right",
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                enableControls("add");
                                frmW76F2101Reset();
                            });
                        }
                    }
                    , {
                        ID: "btnSaveW76F2101",
                        icon: "fa fa-save text-blue",
                        title: "{{Helpers::getRS($g,'Luu')}}",
                        enable: function () {
                            return true;
                        },
                        hidden: false,
                        type: "button",
                        cls: "pull-right",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                frmW76F2101Save();
                            });
                        }
                    }
                    , {
                        ID: "btnSubmitW76F2101",
                        icon: "fa fa-file-excel-o text-red text-bold",
                        title: "submit",
                        enable: true,
                        hidden: true,
                        type: "submit",
                        cls: "pull-right",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                            });
                        }
                    }
                ]
            }
        );

        var obj = {
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: '{{Helpers::getRS($g,'Them')}}',
                        icon: 'ui-icon-plus',
                        listener: function (ui) {
                            addRowW76F22101();
                        }
                    },
                ]
            },
            height: 180,
            resizable: true,
            dataType: "JSON",
            editable: true,
            title: "{{Helpers::getRS($g, 'Bo_phan_lien_quan')}}",
            showTitle: true,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showBottom: true,
            @if($task=='view')
            showToolbar: false,
            @elseif($task=='edit')
            showToolbar: true,
            @endif
            dragColumns: {enabled: false},

            dataModel: {
                data: dataSource,
            },
            postRenderInterval: -1,
            cellSave: function (ev, ui) {
                rowData = ui.rowData;
                rowData['IsUpdate'] = 1;
            },
            rowClick: function (ev, ui) {
                rowData = ui.rowData;
            },
            cellKeyDown: function (event, ui) {
                console.log('cellKeyDown');
                if (event.keyCode == 45) {
                    addRowW76F22101();
                }
                if (event.keyCode == 46 && event.ctrlKey) { //ctrl + delete
                    deleteRowW76F2101(ui.rowIndx);
                }

            },
            editorKeyDown: function (event, ui) {
                if (event.keyCode == 45) {
                    addRowW76F22101();
                }
                if (event.keyCode == 46 && event.ctrlKey) { //ctrl + delete
                    deleteRowW76F2101(ui.rowIndx);
                }
            },
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                clicksToEdit: 2
            },
            colModel: [
                    @if($task == 'add' || $task == 'edit')
                {
                    title: "",
                    width: 75,
                    dataIndx: "View",
                    maxWidth: 70,
                    editor: false,
                    editable: true,
                    align: 'center',
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var str = '';
                        if (permission >= 4 && ('{{$task}}' == 'edit' || '{{$task}}' == 'add')) {
                            str += '<a id="btnDelete" title="{{Helpers::getRS($g,"Xoa")}}"><i class="glyphicon glyphicon-bin text-red"></i></a>';
                        }
                        return str;
                    },

                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);
                        var rowData = ui.rowData;

                        $cell.find("#btnDelete").bind("click", function (evt) {
                            deleteRowW76F2101(rowIndx, rowData);

                        });
                    }
                },
                    @endif
                {
                    title: "DivisionID",
                    dataType: "string",
                    align: "left",
                    width: 200,
                    hidden: true,
                    editable: true,
                    editor: false,
                    dataIndx: "DivisionID"
                },
                {
                    title: "{{Helpers::getRS($g, 'Don_vi')}}",
                    dataType: "string",
                    align: "center",
                    width: 200,
                    dataIndx: "DivisionName",
                    render: function (ui) {
                        var row = ui.rowData;
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    editable: function (ui) {
                        if (ui.rowData != undefined) {
                            var rowData = ui.rowData;
                            if ('{{$task}}' == 'add' || ('{{$task}}' == 'edit' && rowData.ID == "")) {
                                return true;
                            } else {
                                return false;
                            }

                        }
                        return true;
                    },
                    editor: {
                        type: 'select',
                        valueIndx: "ID",
                        labelIndx: "Name",
                        prepend: {"": "--"},
                        mapIndices: {"ID": "DivisionID", "Name": "DivisionName"},
                        options: function () {
                            console.log(this);
                            return {{$ListDivision}};
                        }

                    },

                },
                {
                    title: "DepartmentID",
                    dataType: "string",
                    align: "left",
                    width: 200,
                    hidden: true,
                    editable: true,
                    editor: false,
                    dataIndx: "DepartmentID"
                },
                {
                    title: "{{Helpers::getRS($g, 'Phong_ban')}}",
                    dataType: "string",
                    align: "center",
                    width: 200,
                    dataIndx: "DepartmentName",
                    render: function (ui) {
                        var row = ui.rowData;
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    editable: function (ui) {
                        if (ui.rowData != undefined) {
                            var rowData = ui.rowData;
                            if ('{{$task}}' == 'add' || ('{{$task}}' == 'edit' && rowData.ID == "")) {
                                return true;
                            } else {
                                return false;
                            }

                        }
                        return true;
                    },
                    editor: {
                        type: 'select',
                        valueIndx: "ID",
                        labelIndx: "Name",
                        prepend: {"": "--"},
                        mapIndices: {"ID": "DepartmentID", "Name": "DepartmentName"},
                        options: function (ui) {
                            var divisionID = ui.rowData.DivisionID;
                            var departmentList = {{$ListDepartment}};
                            var data = $.grep(departmentList, function (row) {
                                return row.FilterID == divisionID;
                            });
                            return data;
                        }
                    },
                },
                {
                    title: "EmployeeID",
                    dataType: "string",
                    align: "left",
                    width: 200,
                    hidden: true,
                    editable: true,
                    editor: false,
                    dataIndx: "EmployeeID"
                },
                {
                    title: "{{Helpers::getRS($g, 'Nguoi_nhan')}}",
                    dataType: "string",
                    align: "center",
                    width: 200,
                    dataIndx: "EmployeeName",
                    render: function (ui) {
                        var row = ui.rowData;
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    editable: function (ui) {
                        if (ui.rowData != undefined) {
                            var rowData = ui.rowData;
                            if ('{{$task}}' == 'add' || ('{{$task}}' == 'edit' && rowData.ID == "")) {
                                return true;
                            } else {
                                return false;
                            }

                        }
                        return true;
                    },
                    editor: {
                        type: 'select',
                        valueIndx: "ID",
                        labelIndx: "Name",
                        prepend: {"": "--"},
                        mapIndices: {"ID": "EmployeeID", "Name": "EmployeeName"},
                        options: function (ui) {
                            var departmentID = ui.rowData.DepartmentID;
                            var employeeList = {{$ListEmployee}};
                            var data = $.grep(employeeList, function (row) {
                                return row.FilterID == departmentID;
                            });
                            return data;
                        }
                    },

                },
                {
                    title: "{{Helpers::getRS($g, 'Ghi_chu')}}",
                    dataType: "string",
                    align: "center",
                    width: 200,
                    editable: function (ui) {
                        if (ui.rowData != undefined) {
                            var rowData = ui.rowData;
                            if ('{{$task}}' == 'add' || ('{{$task}}' == 'edit' && rowData.IsEditNotes == 1)) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                        return true;

                    },
                    render: function (ui) {
                        var row = ui.rowData;
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    dataIndx: "Notes"
                },
                {
                    title: "ID",
                    width: 200,
                    dataType: "string",
                    align: "left",
                    editable: true,
                    hidden: true,
                    editor: false,
                    dataIndx: "ID"
                },
                {
                    title: "DocID",
                    width: 200,
                    dataType: "string",
                    align: "left",
                    editable: true,
                    hidden: true,
                    editor: false,
                    dataIndx: "DocID"
                },
                {
                    title: "IsUpdate",
                    width: 200,
                    dataType: "string",
                    align: "left",
                    editable: true,
                    hidden: true,
                    editor: false,
                    dataIndx: "IsUpdate"
                },
                {
                    title: "IsEditNotes",
                    dataType: "string",
                    align: "left",
                    width: 200,
                    hidden: true,
                    editable: true,
                    editor: false,
                    dataIndx: "IsEditNotes"
                }
            ]
        };

        var $grid = $("#W76F2101Grid")
        $grid.pqGrid(obj);
        setTimeout(function () {
            $grid.pqGrid('refreshDataAndView');
        }, 500);

        //Sang mo control tren man hinh
        enableControls('{{$task}}');
    });

    function frmW76F2101Save() {
        validationElements($("#frmW76F2101"), function () {
            //Kiem tra nhung truong hop khac
            checkID($("#txtDocNoW76F2101"));
            var end = convertStringToDate($("#txtEffectDateToW76F2101").val());
            var begin = convertStringToDate($("#txtEffectDateFromW76F2101").val());
            $("#txtEffectDateToW76F2101").get(0).setCustomValidity("");
            if (daydiff(begin, end) <= 0 && $("#txtEffectDateFromW76F2101").val() != '' && $("#txtEffectDateToW76F2101").val()) {
                $("#txtEffectDateToW76F2101").val('');
                //Ngay_tu_phai_nho_hon_ngay_den
                $("#txtEffectDateToW76F2101").get(0).setCustomValidity("{{Helpers::getRS($g,'Ngay_het_hieu_luc_phai_lon_hon_ngay_hieu_luc')}}");
            }
            $("#frmW76F2101").find("#btnSubmitW76F2101").click();
        });
    }

    $("#frmW76F2101").on('submit', function (e) {
        e.preventDefault();
        //lay danh sach gia tri tren form
        var formData = new FormData($('#frmW76F2101')[0]);
        //lay danh sach dinh kem
        $.each(validatedFiles, function (key, value) {
            formData.append('file[]', value);
        });
        //lay danh sach du lieu tren luoi
        var data_grid_filter = $.grep($('#W76F2101Grid').pqGrid('option', 'dataModel.data'), function (row, i) {
            return row.IsUpdate == 1;
        })
        formData.append('rowList', JSON.stringify(data_grid_filter));
        formData.append('ID', '{{$ID}}');//truong hop them moi la rong, sua la co gia tri


        //Đay du lieu qua controller save
        var task = "{{$task}}";
        var url = "";
        if (task == "add")
            url = "{{url('/W76F2101/'.$pForm.'/'.$g.'/save')}}";
        if (task == "edit") {
            url = "{{url('/W76F2101/'.$pForm.'/'.$g.'/update')}}";
        }

        $.ajax({
            method: "POST",
            url: url,
            enctype: 'multipart/form-data',
            processData: false, // Don't process the files
            contentType: false,
            data: formData,
            success: function (res) {
                console.log(res);
                var result = $.parseJSON(res);
                switch (result.status) {
                    case 'EXIST':
                        alert_error(result.message);
                        break;
                    case 'SUC':
                        save_ok(function () {
                            //Cap nhat cai dong vua luu len luoi
                            var dataGrid = [];
                            if (result.data.length > 0) {
                                dataGrid = result.data[0];
                            }
                            console.log("debug");
                            @if ($task == "add")
                            update4ParamGrid($("#W76F2100_Grid"), dataGrid, "add");
                            @endif
                            @if ($task == "edit")
                            update4ParamGrid($("#W76F2100_Grid"), dataGrid, "edit");
                            @endif

                            //cho biet la dang nhan vao button nao, save, saveclose, savenext
                            var focusButton = $("#toolbarW76F2101").data("digiMenu").getFocusButton();

                            switch (focusButton) {
                                case "btnSaveCloseW76F2101":
                                    $("#modalW76F2101").modal("hide");
                                    break;
                                case "btnSaveNextW76F2101":
                                    //reset du lieu
                                    frmW76F2101Reset();
                                    break;
                                case "btnSaveW76F2101":
                                    @if ($task == "add")
                                    enableControls("next");
                                    @endif
                                        break;
                            }
                        });
                        break;
                    case 'ERROR':
                        alert_error(result.message);
                        break;
                }


            }

        });
    });

    function enableControls(task) {
        switch (task) {
            case "add":
                $('#txtDivisionIDW76F2101').prop('readonly', false);
                $('#txtDocNoW76F2101').prop('readonly', false);
                $('#txtDocGroupNameW76F1000').prop('readonly', false);
                $('#txtReceiveSendOrganizationW76F2101').prop('readonly', false);
                $('#txtDocGroupIDW76F2101').prop('readonly', false);
                $('#txtReceiveSendOrganizationW76F2101').prop('readonly', false);
                $('#txtSignerW76F2101').prop('readonly', false);
                $('#txtReleaseDateW76F2101').prop('readonly', false);
                $('#txtEffectDateFromW76F2101').prop('readonly', false);
                $('#txtEffectDateToW76F2101').prop('readonly', false);
                $('#txtEmergencyW76F2101').prop('readonly', false);
                $('#txtSecurityW76F2101').prop('readonly', false);
                $('#txtDocTypeW76F2101').prop('readonly', false);
                $('#txtQuanPageW76F2101').prop('readonly', false);
                $('#txtContentW76F2101').prop('readonly', false);
                $('#txtSheftNoW76F2101W76F2101').prop('readonly', false);
                $('#txtFloorNoW76F2101').prop('readonly', false);
                $('#txtPartitionNoW76F2101').prop('readonly', false);
                $('#txtFolderNoW76F2101').prop('readonly', false);
                $('#txtSheftNoW76F2101').prop('readonly', false);
                $('#txtRefReceiveDocNoW76F2101').prop('readonly', false);
                $('#txtRefSentDocNoW76F2101').prop('readonly', false);
                $('#txtEffectDateFromW76F2101').prop('disabled', false);
                $('#txtReleaseDateW76F2101').prop('disabled', false);
                $('#txtEffectDateToW76F2101').prop('disabled', false);
                $('#cbDocTypeW76F2101').prop('readonly', false);
                $('#cbDivisionID').prop('readonly', false);
                $('#cbDocTypeW76F2101').prop('disabled', false);
                $('#cbDivisionID').prop('disabled', false);
                $('#txtDocGroupIDW76F2101').prop('disabled', false);
                $('#txtDocGroupIDW76F2101').prop('readonly', false);
                $('#txtKeyWordsW76F2101').prop('readonly', false);
                $("#btnSaveCloseW76F2101").prop('disabled', false);
                $("#txtReceiveSendDateW76F2101").prop('disabled', false);
                $("#txtReceiveSendDateW76F2101").prop('readonly', false);
                $("#cbStatusID").prop('readonly', false);
                $("#cbStatusID").prop('disabled', false);
                $("#cbSenderID").prop('readonly', false);
                $("#cbSenderID").prop('disabled', false)

                $("#toolbarW76F2101").data("digiMenu").show('btnSaveW76F2101');
                $("#toolbarW76F2101").data("digiMenu").show('btnSaveNextW76F2101');
                $("#toolbarW76F2101").data("digiMenu").hide('btnNextW76F2101');
                $("#toolbarW76F2101").data("digiMenu").show('btnSaveCloseW76F2101');

                //$('#btnNextW76F2101').addClass('hide');
                break;
            case "edit":
                $('#txtDivisionIDW76F2101').prop('readonly', false);
                $('#txtDocNoW76F2101').prop('readonly', true);
                $('#txtDocGroupNameW76F1000').prop('readonly', false);
                $('#txtReceiveSendOrganizationW76F2101').prop('readonly', false);
                $('#txtDocGroupIDW76F2101').prop('readonly', false);
                $('#txtReceiveSendOrganizationW76F2101').prop('readonly', false);
                $('#txtReceiveSendDateW76F2101').prop('readonly', false);
                $('#txtSignerW76F2101').prop('readonly', false);
                $('#txtReleaseDateW76F2101').prop('readonly', false);
                $('#txtEffectDateFromW76F2101').prop('readonly', false);
                $('#txtEffectDateToW76F2101').prop('readonly', false);
                $('#txtEmergencyW76F2101').prop('readonly', false);
                $('#txtSecurityW76F2101').prop('readonly', false);
                $('#txtDocTypeW76F2101').prop('readonly', false);
                $('#txtQuanPageW76F2101').prop('readonly', false);
                $('#txtContentW76F2101').prop('readonly', false);
                $('#txtSheftNoW76F2101W76F2101').prop('readonly', false);
                $('#txtFloorNoW76F2101').prop('readonly', false);
                $('#txtPartitionNoW76F2101').prop('readonly', false);
                $('#txtFolderNoW76F2101').prop('readonly', false);
                $('#txtSheftNoW76F2101').prop('readonly', false);
                $('#txtRefReceiveDocNoW76F2101').prop('readonly', false);
                $('#txtRefSentDocNoW76F2101').prop('readonly', false);
                $('#txtEffectDateFromW76F2101').prop('disabled', false);
                $('#txtReceiveSendDateW76F2101').prop('disabled', false);
                $('#txtReleaseDateW76F2101').prop('disabled', false);
                $('#txtEffectDateToW76F2101').prop('disabled', false);
                $('#btnNextW76F1000').addClass('hide');
                $('#cbDivisionID').prop('disabled', false);
                $('#cbDocTypeW76F2101').prop('disabled', false);
                $('#txtKeyWordsW76F2101').prop('readonly', false);
                $('#txtDocGroupIDW76F2101').prop('disabled', false);
                $('#cbStatusID').prop('disabled', false);
                $("#cbSenderID").prop('readonly', false);
                $("#cbSenderID").prop('disabled', false)
                $('#btnNextW76F2101').addClass('hide');

                $("#toolbarW76F2101").data("digiMenu").show('btnSaveW76F2101');
                $("#toolbarW76F2101").data("digiMenu").hide('btnSaveNextW76F2101');
                $("#toolbarW76F2101").data("digiMenu").hide('btnNextW76F2101');
                $("#toolbarW76F2101").data("digiMenu").show('btnSaveCloseW76F2101');
                break;
            case 'view':
                $('#txtIDW76F1000').prop('disabled', true);
                $('#txtDocGroupCodeW76F1000').prop('disabled', true);
                $('#cboDocGroupNameW76F1000').prop('disabled', true);
                $('#txtDisplayOrderW76F1000').prop('disabled', true);
                $('#chDisableW76F1000').prop('disabled', true);
                $('#txtDocNoW76F2101').prop('readonly', true);

                $('#cbEmergencyW76F2101').prop('disabled', true);
                $('#cbSecurityW76F2101').prop('disabled', true);
                $("#btnSaveCloseW76F2101").prop('disabled', true);

                $(".action").html("");

                $("#toolbarW76F2101").data("digiMenu").hide('btnSaveW76F2101');
                $("#toolbarW76F2101").data("digiMenu").hide('btnSaveNextW76F2101');
                $("#toolbarW76F2101").data("digiMenu").hide('btnNextW76F2101');
                $("#toolbarW76F2101").data("digiMenu").hide('btnSaveCloseW76F2101');
                break;
            case "next"://trang thai them moi
                $("#toolbarW76F2101").data("digiMenu").hide('btnSaveW76F2101');
                $("#toolbarW76F2101").data("digiMenu").hide('btnSaveNextW76F2101');
                $("#toolbarW76F2101").data("digiMenu").show('btnNextW76F2101');
                $("#toolbarW76F2101").data("digiMenu").hide('btnSaveCloseW76F2101');
                break;
        }
    }

    function addRowW76F22101() {
        $grid = $("#W76F2101Grid");
        var idx = $grid.pqGrid("addRow",
            {
                rowData: { //Em phai khai bao toan bo attribute
                    // ID: '',
                    // DocID: '',
                    // DivisionID: '',
                    // DepartmentID: '',
                    // EmployeeID: '',
                    // Notes: ''
                    IsUpdate: 1,
                    IsEditNotes: 1
                }
            } //Neu
        );
        $grid.pqGrid("refreshDataAndView");
        $grid.pqGrid("setSelection", {rowIndx: idx, colIndx: 2});
    }

    function deleteRowW76F2101(rowIndx, rowData) {
        if (rowData.ID != "") {
            ask_delete(function () {
                postMethod("{{url('/W76F2101/'.$pForm.'/'.$g.'/delete')}}", function (res) {
                    var data = JSON.parse(res);
                    switch (data.status) {
                        case 'SUC':
                            save_ok(function () {
                                removeRow(rowIndx);
                            });
                            break;
                        case 'ERROR':
                            alert_error(data.message);
                    }

                }, {detailID: rowData.ID});
            });
        } else {
            removeRow(rowIndx);
        }
    }

    function removeRow(rowIndx) {
        var $grid = $("#W76F2101Grid");
        $grid.pqGrid("deleteRow", {rowIndx: rowIndx});
        $grid.pqGrid("refreshDataAndView");
        if (rowIndx > 0) {
            $grid.pqGrid("setSelection", {rowIndx: rowIndx - 1});
        } else {
            var length = $grid.pqGrid("option", "dataModel.data").length;
            if (rowIndx < length) {
                $grid.pqGrid("setSelection", {rowIndx: rowIndx, colIndx: 1});
            }
        }
    }

    /*Phan dinh kem*/
    $("#btnAttachmentW76F2101").on("click", function (e) {
        $("#frmW76F2101").find("#fileAttW76F2101").click();
    });

    var validatedFiles = {};
    $("#fileAttW76F2101").on("change", function (event) {
        var arrFile = this.files; //Lay danh sach files
        var sizeLimit = "{{Config::get('attachment.fileSize')}}";
        for (var i = 0; i < arrFile.length; i++) {
            if ((arrFile[i].size / 1024) > Number(sizeLimit)) {
                alert_warning('Dung lượng File không được lớn hơn ' + sizeLimit + ' KB');
            } else if (checkFileType(arrFile[i].name, '{{json_encode($arrFileType)}}') == false) {
                alert_warning('Định dạng file không hợp lệ');
            }
            else { //truong hop hop le
                var id = new Date().getTime() + i;
                validatedFiles[id] = arrFile[i];
                var li = '<button type="button" class="btn btn-xs btn-default file-att" onclick="removeFile(this,\'' + id + '\');">' + arrFile[i].name + ' <span class="select2-selection__choice__remove" role="presentation">×</span></button>';
                $('#divAttachmentW76F2101').append(li);
            }
        }
    });

    function removeFile(li, id) {
        $(li).remove();
        delete validatedFiles[id];
    }

    /*--------------*/

</script>