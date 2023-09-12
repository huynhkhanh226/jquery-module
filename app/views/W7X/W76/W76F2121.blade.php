<div class="modal draggable fade modal" id="modalW76F2121" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 90%">
        <?php
        if ($task == 'add') {
            $ID = '';
            $ReceiveSendOrganization = '';
            $cbDocGroupIDW76F2121 = '';
            $cbDivisionIDW76F2121 = '';
            $txtDocNoW76F2121 = '';
            $txtSignerW76F2121 = '';
            $dtpReleaseDate1W76F2121 = '';
            $txtKeyWordW76F2121 = '';
            $txtContentW76F2121 = '';
            $status = '';
            $txtRefReceiveDocNoW76F2121 = '';
            $txtRefSentDocNoW76F2121 = '';
            $dtpEffectDateFrom1W76F2121 = '';
            $dtpEffectDateTo1W76F2121 = '';
            $txtSheftNoW76F2121 = '';
            $txtFloorNoW76F2121 = '';
            $txtPartitionNoW76F2121 = '';
            $txtFolderNoW76F2121 = '';
            $cbEmergencyW76F2121 = '';
            $cbSecurityW76F2121 = '';
            $cbDocTypeW76F2121 = '';
            $txtQuanPageW76F2121 = '';
            $chkIsPublicW76F2121 = 1;
            $hdAttFileNameW76F2121 = '';
        } else if ($task == 'view' || $task == 'edit') {
            $ID = $rsData["ID"];
            $txtDocNoW76F2121=$rsData['DocNo'];
            $cbDocGroupIDW76F2121=$rsData['DocGroupID'];
            $cbDivisionIDW76F2121= $rsData['DivisionID'];
            $txtSignerW76F2121=$rsData['Signer'];
            $dtpReleaseDate1W76F2121=$rsData['ReleaseDate'];
            $txtKeyWordW76F2121=$rsData['KeyWords'];
            $txtContentW76F2121=$rsData['Content'];
            $txtRefReceiveDocNoW76F2121=$rsData['RefReceiveDocNo'];
            $txtRefSentDocNoW76F2121=$rsData['RefSentDocNo'];
            $dtpEffectDateFrom1W76F2121=$rsData['EffectDateFrom'];
            $dtpEffectDateTo1W76F2121=$rsData['EffectDateTo'];
            $txtSheftNoW76F2121=$rsData['SheftNo'];
            $txtFloorNoW76F2121=$rsData['FloorNo'];
            $txtPartitionNoW76F2121=$rsData['PartitionNo'];
            $txtFolderNoW76F2121=$rsData['FolderNo'];
            $cbEmergencyW76F2121=$rsData['Emergency'];
            $cbSecurityW76F2121=$rsData['Security'];
            $cbDocTypeW76F2121=$rsData['DocType'];
            $txtQuanPageW76F2121=$rsData['QuanPage'];
            $chkIsPublicW76F2121=$rsData["IsPublic"];
        }
        ?>

        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading($modalTitle,"W76F2121",true,"")}}
            </div>
            <div class="modal-body pd5">
                <form id="frmW76F2121" class="form-horizontal">
                    <div id="divW76F2121Scrollbar" style="overflow-y: auto; overflow-x: hidden">
                        <div class="box-body">
                            <div class="row form-group">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Don_vi")}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" required id="cbDivisionIDW76F2121" name="cbDivisionIDW76F2121">
                                        <option value="">--</option>
                                        @foreach(json_decode($divisionList) as $divisionListitem)
                                            <option value="{{$divisionListitem->ID}}"  {{$cbDivisionIDW76F2121 == $divisionListitem->ID ? 'selected': ''}}>
                                                {{$divisionListitem->Name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"So_cong_van")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <input name="txtDocNoW76F2121" maxlength="50" class="form-control"
                                           id="txtDocNoW76F2121" value="{{$txtDocNoW76F2121}}" placeholder=""
                                           required="">
                                    <span id="docNoErrorW76F2121" class="text-red text-italic"></span>
                                </div>
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Nhom_van_ban")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" id="cbDocGroupIDW76F2121"
                                            name="cbDocGroupIDW76F2121" required="">
                                        <option value="">--</option>
                                        @foreach($docGroupList as $docGroupItem)
                                            <option value="{{$docGroupItem['DocGroupCode']}}" {{$cbDocGroupIDW76F2121 == $docGroupItem['DocGroupCode'] ? 'selected': ''}}>
                                                {{$docGroupItem['DocGroupName']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Nguoi_ky")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" maxlength="250" name="txtSignerW76F2121" class="form-control" id="txtSignerW76F2121" value="{{$txtSignerW76F2121}}" placeholder="">
                                </div>
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Ngay_phat_hanh")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group ">
                                        <input type="text" class="form-control" id="dtpReleaseDate1W76F2121" name="dtpReleaseDate1W76F2121" value="{{$dtpReleaseDate1W76F2121}}" autocomplete="off" required="">
                                        <span class="input-group-addon"><i onclick="setCalendarIconEvent($('#dtpReleaseDate1W76F2121'))" class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group ">
                                        <input type="text" class="form-control" id="dtpEffectDateFrom1W76F2121" required name="dtpEffectDateFrom1W76F2121" value="{{$dtpEffectDateFrom1W76F2121}}" autocomplete="off">
                                        <span class="input-group-addon"><i onclick="setCalendarIconEvent($('#dtpEffectDateFrom1W76F2121'))" class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Ngay_het_hieu_luc")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group ">
                                        <input type="text" class="form-control" id="dtpEffectDateTo1W76F2121" name="dtpEffectDateTo1W76F2121" value="{{$dtpEffectDateTo1W76F2121}}" autocomplete="off">
                                        <span class="input-group-addon"><i onclick="setCalendarIconEvent($('#dtpEffectDateTo1W76F2121'))" class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Do_khan_cap")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" id="cbEmergencyW76F2121" name="cbEmergencyW76F2121">
                                        <option value="">--</option>
                                        @foreach($emergencyList as $emergencyListitem)
                                            <option value="{{$emergencyListitem['ID']}}" {{$cbEmergencyW76F2121 == $emergencyListitem['ID'] ?'selected': '' }}>
                                                {{$emergencyListitem['Name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Do_bao_mat")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" id="cbSecurityW76F2121" name="cbSecurityW76F2121">
                                        <option value="">--</option>
                                        @foreach($securityList as $securityListitem)
                                            <option value="{{$securityListitem['ID']}}" {{$cbSecurityW76F2121 == $securityListitem['ID'] ? 'selected': ''}}>
                                                {{$securityListitem['Name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                    </select>
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Dang_van_ban")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" id="cbDocTypeW76F2121" name="cbDocTypeW76F2121">
                                        <option value="">--</option>
                                        @foreach($docTyeList as $docTyeListitem)
                                            <option value="{{$docTyeListitem['ID']}}" {{$cbDocTypeW76F2121 == $docTyeListitem['ID'] ? 'selected':''}}>
                                                {{$docTyeListitem['Name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"So_trang")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="number" class="form-control" name="txtQuanPageW76F2121" maxlength="6" onkeypress="return inputNumber(event);" min="1" step="1"
                                           id="txtQuanPageW76F2121" value="{{$txtQuanPageW76F2121}}" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 ">
                                    <button id="btnAttachmentW76F2121" type="button" class="btn btn-default smallbtn mgr10"><span class="fa fa-paperclip mgr5"></span> {{Helpers::getRS($g,"Dinh_kem")}}
                                    </button>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-control pdt0 pdl0 pdb0 div-att" id="divAttachmentW76F2121">
                                    </div>
                                    <input type="file" id="fileAttW76F2121" class="hide" accept="{{implode(',',$arrFileType)}}" multiple>
                                    <input type="hidden" id="hdAttFileNameW76F2121" name="hdAttFileNameW76F2121" value="">
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-10">
                                    <span style="font-size: 11px">{{Helpers::getRS($g, 'Loai_tap_tin_ho_tro')}}: </span>
                                    @foreach($arrFileType as $key=>$value)
                                        <span style="font-size: 11px" class="text-red">&nbsp;{{$value}}</span>
                                    @endforeach
                                    <span style="font-size: 11px">({{Helpers::getRS($g, 'Kich_co_toi_da')}}:</span>
                                    <span style="font-size: 11px" class="text-red">&nbsp;{{Config::get('attachment.fileSize')}} KB)</span>
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <label class="control-label  lbl-normal">{{Helpers::getRS($g,"Tu_khoa")}}</label>
                                </div>
                                <div class="col-md-10 ">
                                    <input name="txtKeyWordW76F2121" maxlength="2000" id="txtKeyWordW76F2121" value="{{$txtKeyWordW76F2121}}" class="form-control">
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <label class="control-label  lbl-normal">{{Helpers::getRS($g,"Trich_yeu")}}</label>
                                </div>
                                <div class="col-md-10 ">
                                    <textarea name="txtContentW76F2121" maxlength="2000" id="txtContentW76F2121" class="form-control" style="height: 80px">{{$txtContentW76F2121}}</textarea>
                                </div>
                            </div>
                            <div class="row mgb5 mgt10">
                                <div class="col-md-2 ">
                                    <label class=" pdt5 liketext  lbl-normal">{{Helpers::getRS($g,"CV_den_lien_quan")}}</label>
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" maxlength="50" name="txtRefReceiveDocNoW76F2121" class="form-control" id="txtRefReceiveDocNoW76F2121" value="{{$txtRefReceiveDocNoW76F2121}}" placeholder="">
                                </div>
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"CV_di_lien_quan")}}</label>
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" maxlength="50" name="txtRefSentDocNoW76F2121" class="form-control" id="txtRefSentDocNoW76F2121" value="{{$txtRefSentDocNoW76F2121}}">
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Ke")}}</label>
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" maxlength="250" name="txtSheftNoW76F2121" class="form-control" id="txtSheftNoW76F2121" value="{{$txtSheftNoW76F2121}}" placeholder="">
                                </div>
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Tang_VN")}}</label>
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" maxlength="250" name="txtFloorNoW76F2121" class="form-control" id="txtFloorNoW76F2121" value="{{$txtFloorNoW76F2121}}" placeholder="">
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Ngan_U")}}</label>
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" maxlength="250" name="txtPartitionNoW76F2121" class="form-control" id="txtPartitionNoW76F2121" value="{{$txtPartitionNoW76F2121}}" placeholder="">
                                </div>
                                <div class="col-md-2 ">
                                    <label class=" pdr0 liketext  lbl-normal">{{Helpers::getRS($g,"Thu_muc")}}</label>
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" maxlength="250" name="txtFolderNoW76F2121" class="form-control" id="txtFolderNoW76F2121" value="{{$txtFolderNoW76F2121}}" placeholder="">
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div class="col-md-2 ">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="chkIsPublicW76F2121" value="1" {{$chkIsPublicW76F2121 == 1 ? 'checked': ''}} name="chkIsPublicW76F2121"> {{Helpers::getRS($g,"Cong_khai")}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-10 ">
                                </div>
                            </div>
                            <div class="row mgb5">
                                <div id="detailPublicW76F2121" class="{{$chkIsPublicW76F2121 == 1 ? 'hide': ''}}">
                                    <div class="col-md-12 mgt10">
                                        <fieldset>
                                            <legend class="text-bold" style="color: #00acd6">{{Helpers::getRS($g, 'Bo_phan_lien_quan')}}</legend>
                                            <div id="W76F2121Grid">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer mgt5">
                        <div class="row ">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div id="toolbarW76F2121">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var employeeList =  {{$employeeList}};
    var divisionList = {{$divisionList}};
    var departmentList = {{$departmentList}};

    /*begin -- for attachment*/
    $("#btnAttachmentW76F2121").on("click", function (e) {
        $("#frmW76F2121").find("#fileAttW76F2121").click();
    });

    var validatedFiles = {};
    $("#fileAttW76F2121").on("change", function (event) {
        var arrFile = this.files;
        var sizeLimit = "{{Config::get('attachment.fileSize')}}";
        console.log(Number(sizeLimit));
        for (var i = 0; i < arrFile.length; i++) {
            if ((arrFile[i].size / 1024) > Number(sizeLimit)) {
                alert_warning('Dung lượng File không được lớn hơn ' + sizeLimit + ' KB');
            } else if (checkFileType(arrFile[i].name, '{{json_encode($arrFileType)}}') == false) {
                alert_warning('Định dạng file không hợp lệ');
            }
            else {
                var dtime = new Date().getTime() + i;
                validatedFiles[dtime] = arrFile[i];
                var li = '<button type="button" class="btn btn-xs btn-default file-att" onclick="removeFile(this,\'' + dtime + '\');">' + arrFile[i].name + ' <span class="select2-selection__choice__remove" role="presentation">×</span></button>';
                $('#divAttachmentW76F2121').append(li);
            }
        }
    });

    function removeFile(li, id) {
        $(li).remove();
        delete validatedFiles[id];
    }
    /*end -- for attachment*/

    $(document).ready(function () {
        var height = $(window).height() - 140;
        $("#modalW76F2121").find("#divW76F2121Scrollbar").height(height);
        $("#chkIsPublicW76F2121").change(function(){
            var val = $("#chkIsPublicW76F2121").is(':checked') ? 1: 0;
            $("#chkIsPublicW76F2121").val(val);
            if ($("#chkIsPublicW76F2121").val() == 1){
                var task = '{{$task}}';
                //hide grid
                $("#detailPublicW76F2121").addClass('hide');
                //clear data
                //$("#W76F2121Grid").pqGrid("option", "dataModel.data", []);
                $("#W76F2121Grid").pqGrid('refreshDataAndView');
            }else{
                $("#detailPublicW76F2121").removeClass('hide');
            }
            setTimeout(function () {
                $("#W76F2121Grid").pqGrid('refreshDataAndView');
            }, 300)
        });
        $('#dtpEffectDateFrom1W76F2121').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpEffectDateFrom2W76F2121').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpEffectDateTo1W76F2121').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpEffectDateTo2W76F2121').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpReleaseDate1W76F2121').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpReleaseDate2W76F2121').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtQuanPageW76F2121').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 0,
            autoGroup: true,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: true
        });
        $("#txtDocNoW76F2121").keyup(function () {
            if (checkID($("#txtDocNoW76F2121"))) {
                $("#docNoErrorW76F2121").html('');
            } else {
                $("#docNoErrorW76F2121").html('{{Helpers::getRS(0,"Ma_co_ky_tu_khong_hop_le")}}');
            }
        });

        $("#toolbarW76F2121").digiMenu({
                showText: true,
                cls: '',
                style: '',
                buttonList: [
                    {
                        ID: "btnSaveCloseW76F2121",
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
                                frmW76F2121Save();
                            });
                        }
                    }
                    , {
                        ID: "btnSaveNextW76F2121",
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
                                frmW76F2121Save();
                            });
                        }
                    }
                    , {
                        ID: "btnNextW76F2121",
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
                                frmW76F2121Reset();
                            });
                        }
                    }
                    , {
                        ID: "btnSaveW76F2121",
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
                                frmW76F2121Save();
                            });
                        }
                    }
                    , {
                        ID: "btnSubmitW76F2121",
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
        createGridW76F2121();
        enableControls('{{$task}}');
    });

    function createGridW76F2121() {
        var obj = {
            width: '100%',
            height: $(document).height() - 500,
            resizable: true,
            dataType: "JSON",
            editable: true,
            showTitle: false,
            collapsible: false,
            showToolbar: '{{$task == "add" || $task == "edit" ? true: false}}',
            selectionModel: {type: 'cell', mode: 'single'},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showBottom: true,
            dragColumns: {enabled: false},
            postRenderInterval: -1,
            hwrap: false,
            wrap: false,
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                clicksToEdit: 2
            },
            dataModel: {
                data: {{$rsDetail}},
            },
            toolbar: {
                items: [
                    {
                        ID: "btnAddW76F2121",
                        type: 'button',
                        icon: 'ui-icon-plus',
                        label: '{{Helpers::getRS($g,"Them_moi1")}}',
                        listener: function () {
                            addRowW76F2121();
                        }
                    }
                ]
            },
            colModel: [
                @if ($task == "add" || $task == "edit")
                {
                    title: "",
                    width: 25,
                    dataType: "string",
                    editable: true,
                    editor: false,
                    dataIndx: "View",
                    align: "center",
                    render: function (ui) {
                        var str = '<a id="btnDeleteW76F2121" title="{{Helpers::getRS($g,"Xoa")}}"><i class="glyphicon glyphicon-bin text-red"></i></a>';
                        return str;
                    },
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);
                        var rowData = ui.rowData;
                        //edit button
                        $cell.find("#btnDeleteW76F2121").bind("click", function (evt) {
                            deleteRowW76F2121(rowIndx, rowData);
                        });
                    }
                },
                @endif
                {
                    title: "DivisionID",
                    dataType: "string",
                    align: "left",
                    width: 180,
                    editable: true,
                    dataIndx: "DivisionID",
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g, 'Don_vi')}}",
                    dataType: "string",
                    align: "left",
                    width: 180,
                    editable: function(ui){
                        if (ui.rowData != undefined){
                            var rowData = ui.rowData;
                            var task = '{{$task}}';
                            return task == "add" || (task == "edit" && rowData.ID == '') ? true:false;
                        }else{
                            return true;
                        }
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    dataIndx: "DivisionName",
                    editor: {
                        type: 'select',
                        valueIndx: "ID",
                        labelIndx: "Name",
                        prepend: {"": "--"},
                        mapIndices: {"ID": "DivisionID", "Name": "DivisionName"},
                        options: function () {
                            console.log(this);
                            return divisionList;
                        }
                    },
                },
                {
                    title: "DepartmentID",
                    dataType: "string",
                    align: "left",
                    width: 180,
                    editable: true,
                    dataIndx: "DepartmentID",
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g, 'Phong_ban')}}",
                    dataType: "string",
                    align: "left",
                    width: 180,
                    editable: function(ui){
                        if (ui.rowData != undefined){
                            var rowData = ui.rowData;
                            var task = '{{$task}}';
                            return task == "add" || (task == "edit" && rowData.ID == '') ? true:false;
                        }else{
                            return true;
                        }
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    dataIndx: "DepartmentName",
                    editor: {
                        type: 'select',
                        valueIndx: "ID",
                        labelIndx: "Name",
                        prepend: {"": "--"},
                        mapIndices: {"ID": "DepartmentID", "Name": "DepartmentName"},
                        options: function (ui) {
                            var divisionID = ui.rowData.DivisionID;
                            var data = $.grep(departmentList, function (row) {
                                return row.FilterID == divisionID;
                            });
                            console.log("test");
                            console.log(data);
                            return data;
                        }
                    },
                },
                {
                    title: "EmployeeID",
                    dataType: "string",
                    align: "left",
                    width: 180,
                    editable: true,
                    dataIndx: "EmployeeID",
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g, 'Nhan_vien')}}",
                    dataType: "string",
                    align: "left",
                    width: 250,
                    editable: function(ui){
                        if (ui.rowData != undefined){
                            var rowData = ui.rowData;
                            var task = '{{$task}}';
                            return task == "add" || (task == "edit" && rowData.ID == '') ? true:false;
                        }else{
                            return true;
                        }
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    dataIndx: "EmployeeName",
                    editor: {
                        type: 'select',
                        valueIndx: "ID",
                        labelIndx: "Name",
                        prepend: {"": "--"},
                        mapIndices: {"ID": "EmployeeID", "Name": "EmployeeName"},
                        options: function (ui) {
                            var departmentID = ui.rowData.DepartmentID;
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
                    align: "left",
                    width: 300,
                    editable: function(ui){
                        if (ui.rowData != undefined){
                            var rowData = ui.rowData;
                            var task = '{{$task}}';
                            return task == "add" || (task == "edit" && rowData.IsEditNotes == 1) ? true:false;
                        }else{
                            return true;
                        }
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    editor: true,
                    dataIndx: "Notes",
                },
                {
                    title: "ID",
                    dataType: "string",
                    align: "left",
                    width: 180,
                    editable: true,
                    dataIndx: "ID",
                    hidden: true
                },
                {
                    title: "DocID",
                    dataType: "string",
                    align: "left",
                    width: 180,
                    editable: true,
                    dataIndx: "DocID",
                    hidden: true
                },
                {
                    title: "IsUpdate",
                    dataType: "string",
                    align: "left",
                    width: 180,
                    editable: true,
                    dataIndx: "IsUpdate",
                    hidden: true
                },
                {
                    title: "IsEditNotes",
                    dataType: "string",
                    align: "left",
                    width: 180,
                    editable: true,
                    dataIndx: "IsEditNotes",
                    hidden: true
                },
            ],
            cellKeyDown: function (event, ui) {
                console.log('cellKeyDown');
                var rowData = ui.rowData;
                if (event.keyCode == 45) {
                    event.preventDefault();
                    addRowW76F2121();
                }
                if (event.keyCode == 46 && event.ctrlKey) { //ctrl + delete
                    //deleteRowW76F2121(ui.rowIndx, rowData);
                }
            },
            editorKeyDown: function (event, ui) {
                var rowData = ui.rowData;
                if (event.keyCode == 45) {
                    event.preventDefault();
                    addRowW76F2121();
                }
                if (event.keyCode == 46 && event.ctrlKey) { //ctrl + delete
                    //deleteRowW76F2121(ui.rowIndx, rowData);
                }
            }
            ,cellSave: function (ev, ui) {
                var rowData = ui.rowData;
                rowData['IsUpdate'] = 1;
            },
        };
        var $grid = $("#W76F2121Grid")
        $grid.pqGrid(obj);
        setTimeout(function () {
            $grid.pqGrid('refreshDataAndView');
        }, 500);
    }

    function addRowW76F2121() {
        var $grid = $("#W76F2121Grid");
        $grid.pqGrid("quitEditMode");
        var idx = $grid.pqGrid("addRow",
            {
                rowData: {
                    ID: '',
                    DocID: '',
                    DivisionID: '',
                    DepartmentID: '',
                    EmployeeID: '',
                    Notes: '',
                    IsUpdate: 1,
                    IsEditNotes: 1
                }
            }
        );
        $grid.pqGrid("refreshDataAndView");
        $grid.pqGrid("setSelection", {rowIndx: idx, colIndx: 2});
    }

    function deleteRowW76F2121(rowIndx, rowData) {
        if (rowData.ID != ""){//old row
            ask_delete(function(){
                postMethod('{{url("/W76F2121/$pForm/$g")}}' + "/delete", function(res){
                    var data = JSON.parse(res);
                    switch (data.status){
                        case "SUC":
                            delete_ok(function(){
                                removeRow(rowIndx);
                            });
                            break;
                        case 'ERROR':
                            alert_error(data.message);
                            break;
                    }
                }, {detailID: rowData.ID})
            });
        }else{
            removeRow(rowIndx);
        }
    }

    function removeRow(rowIndx){
        var $grid = $("#W76F2121Grid");
        $grid.pqGrid("deleteRow", {rowIndx: rowIndx});
        $grid.pqGrid("refreshDataAndView");
        if (rowIndx > 0) {
            $grid.pqGrid("setSelection", {rowIndx: rowIndx - 1});
        } else {
            var length = $grid.pqGrid("option", "dataModel.data").length;
            if (rowIndx < length) {
                $grid.pqGrid("setSelection", {rowIndx: rowIndx});
            }
        }
    }

    function frmW76F2121Save() {
        {{--validationElements($('#frmW76F2121'), function () {--}}
            {{--checkID($("#txtDocNoW76F2121"));--}}
            {{--var cafrom = $("#dtpEffectDateFrom1W76F2121");--}}
            {{--var cato = $("#dtpEffectDateTo1W76F2121");--}}
            {{--$("#dtpEffectDateTo1W76F2121").get(0).setCustomValidity("");--}}
            {{--if (cato.val() < cafrom.val()) {--}}
                {{--cato.get(0).setCustomValidity('{{Helpers::getRS($g,"Ngay_het_hieu_luc")." ".Helpers::getRS($g,"phai_lon_hon")." ".Helpers::getRS($g,"Ngay_hieu_luc")}}');--}}
            {{--} else {--}}
                {{--cato.get(0).setCustomValidity('');--}}
            {{--}--}}
            {{--$("#frmW76F2121").find("#btnSubmitW76F2121").click();--}}
        {{--});--}}
        validationElements($("#frmW76F2121"), function () {
            //Kiem tra nhung truong hop khac
            checkID($("#txtDocNoW76F2121"));
            var end = convertStringToDate($("#dtpEffectDateTo1W76F2121").val());
            var begin = convertStringToDate($("#dtpEffectDateFrom1W76F2121").val());
            $("#dtpEffectDateTo1W76F2121").get(0).setCustomValidity("");
            if (daydiff(begin, end) <= 0 && $("#dtpEffectDateFrom1W76F2121").val() != '' && $("#dtpEffectDateTo1W76F2121").val()) {
                $("#dtpEffectDateTo1W76F2121").val('');
                //Ngay_tu_phai_nho_hon_ngay_den
                $("#dtpEffectDateTo1W76F2121").get(0).setCustomValidity('{{Helpers::getRS($g,"Ngay_het_hieu_luc")." ".Helpers::getRS($g,"phai_lon_hon")." ".Helpers::getRS($g,"Ngay_hieu_luc")}}');
            }
            $("#frmW76F2121").find("#btnSubmitW76F2121").click();
        });
    }

    $("#modalW76F2121").on('submit', '#frmW76F2121', function (e) {
        e.preventDefault();
        //get all values of this form
        var formData = new FormData($('#frmW76F2121')[0]);

        //get all attachment files
        $.each(validatedFiles, function (key, value) {
            formData.append('file[]', value);
        });

        //get detail
        var $grid = $("#W76F2121Grid");
        var detail = $grid.pqGrid("option", "dataModel.data");
        detail = $.grep(detail, function(row){
            return row.IsUpdate == 1;
        });
        formData.append('detail', JSON.stringify(detail));
        formData.append('ID', '{{$ID}}');

        var url = "";
        var task = "{{$task}}";
        if (task == "add") {
            url = '{{url("/W76F2121/$pForm/$g")}}' + "/save";
        }
        if (task == "edit") {
            url = '{{url("/W76F2121/$pForm/$g")}}' + "/update";
        }
        //$(".l3loading").removeClass("hide");
        $.ajax({
            enctype: 'multipart/form-data',
            method: "POST",
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                console.log(res);
                var result = JSON.parse(res);
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
                            @if ($task == "add")
                            update4ParamGrid($("#gridW76F2120"), dataGrid, "add");
                            @endif
                            @if ($task == "edit")
                            update4ParamGrid($("#gridW76F2120"), dataGrid, "edit");
                            @endif

                            var $gridDetail = $("#W76F2121Grid");
                            $gridDetail.pqGrid("option", "dataModel.data",result.detail);
                            $gridDetail.pqGrid("refreshDataAndView");

                            //cho biet la dang nhan vao button nao, save, saveclose, savenext
                            var focusButton = $("#toolbarW76F2121").data("digiMenu").getFocusButton();
                            switch (focusButton) {
                                case "btnSaveCloseW76F2121":
                                    $("#modalW76F2121").modal("hide");
                                    break;
                                case "btnSaveNextW76F2121":
                                    //reset du lieu
                                    frmW76F2121Reset();
                                    break;
                                case "btnSaveW76F2121":
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
                $(".divDisabled").addClass("hide");
                $('#cbDivisionIDW76F2121').prop('readonly', false);
                $('#txtDocNoW76F2121').prop('readonly', false);
                $('#cbDocGroupIDW76F2121').prop('readonly', false);
                $('#txtSignerW76F2121').prop('readonly', false);
                $('#dtpReleaseDate1W76F2121').prop('readonly', false);
                $('#dtpEffectDateFrom1W76F2121').prop('readonly', false);
                $('#dtpEffectDateTo1W76F2121').prop('readonly', false);
                $('#cbEmergencyW76F2121').prop('readonly', false);
                $('#cbSecurityW76F2121').prop('readonly', false);
                $('#cbDocTypeW76F2121').prop('readonly', false);
                $('#txtQuanPageW76F2121').prop('readonly', false);
                $('#hdAttFileNameW76F2121').prop('readonly', false);
                $('#txtSecurityW76F2121').prop('readonly', false);
                $('#txtDocTypeW76F2121').prop('readonly', false);
                $('#txtQuanPageW76F2121').prop('readonly', false);
                $('#txtContentW76F2121').prop('readonly', false);
                $('#txtRefReceiveDocNoW76F2121').prop('readonly', false);
                $('#txtRefSentDocNoW76F2121').prop('readonly', false);
                $('#txtSheftNoW76F2121').prop('readonly', false);
                $('#txtFloorNoW76F2121').prop('readonly', false);
                $('#txtPartitionNoW76F2121').prop('readonly', false);
                $('#txtFolderNoW76F2121').prop('readonly', false);
                $('#chkIsPublicW76F2121').prop('readonly', false);
                $('#txtKeyWordsW76F2121').prop('readonly', false);
                $("#toolbarW76F2121").data("digiMenu").show('btnSaveW76F2121');
                $("#toolbarW76F2121").data("digiMenu").show('btnSaveNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").hide('btnNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").show('btnSaveCloseW76F2121');
                //$('#btnNextW76F2121').addClass('hide');
                break;
            case "edit":
//                $(".divDisabled").addClass("hide");
                $('#cbDivisionIDW76F2121').prop('readonly', true);
                $('#txtDocNoW76F2121').prop('readonly', true);
                $('#cbDocGroupIDW76F2121').prop('readonly', false);
                $('#txtSignerW76F2121').prop('readonly', false);
                $('#dtpReleaseDate1W76F2121').prop('readonly', false);
                $('#dtpEffectDateFrom1W76F2121').prop('readonly', false);
                $('#dtpEffectDateTo1W76F2121').prop('readonly', false);
                $('#cbEmergencyW76F2121').prop('readonly', false);
                $('#cbSecurityW76F2121').prop('readonly', false);
                $('#cbDocTypeW76F2121').prop('readonly', false);
                $('#txtQuanPageW76F2121').prop('readonly', false);
                $('#hdAttFileNameW76F2121').prop('readonly', false);
                $('#txtSecurityW76F2121').prop('readonly', false);
                $('#txtDocTypeW76F2121').prop('readonly', false);
                $('#txtQuanPageW76F2121').prop('readonly', false);
                $('#txtContentW76F2121').prop('readonly', false);
                $('#txtRefReceiveDocNoW76F2121').prop('readonly', false);
                $('#txtRefSentDocNoW76F2121').prop('readonly', false);
                $('#txtSheftNoW76F2121').prop('readonly', false);
                $('#txtFloorNoW76F2121').prop('readonly', false);
                $('#txtPartitionNoW76F2121').prop('readonly', false);
                $('#txtFolderNoW76F2121').prop('readonly', false);
                $('#chkIsPublicW76F2121').prop('readonly', false);
                $('#txtKeyWordsW76F2121').prop('readonly', false);
                $("#toolbarW76F2121").data("digiMenu").show('btnSaveW76F2121');
                $("#toolbarW76F2121").data("digiMenu").show('btnSaveNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").hide('btnNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").show('btnSaveCloseW76F2121');
                $('#btnNextW76F2121').addClass('hide');
                $("#toolbarW76F2121").data("digiMenu").show('btnSaveW76F2121');
                $("#toolbarW76F2121").data("digiMenu").hide('btnSaveNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").hide('btnNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").show('btnSaveCloseW76F2121');
                break;
            case 'view':
//                $('#txtIDW76F1000').prop('disabled', true);
//               $('#cbDivisionIDW76F2121').prop('readonly', true);
                $('#txtDocNoW76F2121').prop('disabled', true);
                $('#cbDivisionIDW76F2121').prop('disabled', true);
                $('#cbDocGroupIDW76F2121').prop('disabled', true);
                $('#txtSignerW76F2121').prop('disabled', true);
                $('#dtpReleaseDate1W76F2121').prop('disabled', true);
                $('#dtpEffectDateFrom1W76F2121').prop('disabled', true);
                $('#dtpEffectDateTo1W76F2121').prop('disabled', true);
                $('#cbEmergencyW76F2121').prop('disabled', true);
                $('#cbSecurityW76F2121').prop('disabled', true);
                $('#cbDocTypeW76F2121').prop('disabled', true);
                $('#txtQuanPageW76F2121').prop('disabled', true);
                $('#hdAttFileNameW76F2121').prop('disabled', true);
                $('#txtSecurityW76F2121').prop('disabled', true);
                $('#txtDocTypeW76F2121').prop('disabled', true);
                $('#txtQuanPageW76F2121').prop('disabled', true);
                $('#txtContentW76F2121').prop('disabled', true);
                $('#txtRefReceiveDocNoW76F2121').prop('disabled', true);
                $('#txtRefSentDocNoW76F2121').prop('disabled', true);
                $('#txtSheftNoW76F2121').prop('disabled', true);
                $('#txtFloorNoW76F2121').prop('disabled', true);
                $('#txtPartitionNoW76F2121').prop('disabled', true);
                $('#txtFolderNoW76F2121').prop('disabled', true);
                $('#chkIsPublicW76F2121').prop('disabled', true);
                $('#txtKeyWordsW76F2121').prop('disabled', true);
                $('#btnAttachmentW76F2121').prop('disabled', true);
                $('#txtKeyWordW76F2121').prop('disabled', true);
                $(".action").html("");
                $("#toolbarW76F2121").data("digiMenu").hide('btnSaveW76F2121');
                $("#toolbarW76F2121").data("digiMenu").hide('btnSaveNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").hide('btnNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").hide('btnSaveCloseW76F2121');
                break;
            case "next"://trang thai them moi
                $("#toolbarW76F2121").data("digiMenu").hide('btnSaveW76F2121');
                $("#toolbarW76F2121").data("digiMenu").hide('btnSaveNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").show('btnNextW76F2121');
                $("#toolbarW76F2121").data("digiMenu").hide('btnSaveCloseW76F2121');
                break;
        }
    }

    function frmW76F2121Reset() {
        $('#frmW76F2121')[0].reset();
        $('#W76F2121Grid').pqGrid('option', 'dataModel.data', []);
        $('#W76F2121Grid').pqGrid('refreshDataAndView');
        $("#cbDivisionIDW76F2121").focus();
    }

</script>