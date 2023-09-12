<div class="modal fade draggable" id="modalW76F2051" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:75%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Cap_nhat_phong_hop"),"W76F2051",true,"closemodalW76F2051")}}
            </div>

            <?php

            if ($task == "edit" || $task == "view") {
                $FacilityID = $rsData["FacilityID"];
                $txtFacilityNo = $rsData["FacilityNo"];
                $chkDisabled = $rsData["Disabled"] == 1 ? "checked" : "";
                $txtFacilityName = $rsData["FacilityName"];
                $txtLocation = $rsData["Location"];
                $txtCapacityTo = $rsData["CapacityTo"];
                $txtDescription = $rsData["Description"];
                $imgThumnailW76F2051 = $rsData["Thumbnail"];
                $hdimgW76F2051 = $rsData["Image"];
                $hdimgThumbW76F2051 = $rsData["Thumbnail"];
                $chkIsBlackboard = $rsData["IsBlackboard"] == 1 ? "checked" : "";
                $chkIsProjector = $rsData["IsProjector"] == 1 ? "checked" : "";
                $chkIsEthernet = $rsData["IsEthernet"] == 1 ? "checked" : "";
                $chkIsMicrophone = $rsData["IsMicrophone"] == 1 ? "checked" : "";
                $chkIsPC = $rsData["IsPC"] == 1 ? "checked" : "";
                $chkIsTeleCon = $rsData["IsTeleCon"] == 1 ? "checked" : "";
                $chkIsVideoCon = $rsData["IsVideoCon"] == 1 ? "checked" : "";
                $chkIsWifi = $rsData["IsWifi"] == 1 ? "checked" : "";
                $imgW76F2051_IMG = $rsData["Thumbnail"];
            }
            if ($task == "add") {
                $FacilityID = "";
                $txtFacilityNo = "";
                $chkDisabled = "";
                $txtFacilityName = "";
                $txtLocation = "";
                $txtCapacityTo = "";
                $txtDescription = "";
                $imgThumnailW76F2051 = "";
                $hdimgW76F2051 = "";
                $hdimgThumbW76F2051 = "";
                $chkIsBlackboard = "";
                $chkIsProjector = "";
                $chkIsEthernet = "";
                $chkIsMicrophone = "";
                $chkIsPC = "";
                $chkIsTeleCon = "";
                $chkIsVideoCon = "";
                $chkIsWifi = "";
                $imgW76F2051_IMG = "";
            }

            ?>


            <div class="modal-body">
                <form class="form-horizontal" id="frmW76F2051">
                    <div class="box-body">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="col-sm-3">{{Helpers::getRS(4,"Phong_hopU")}}</label>
                                <div class="col-sm-6">
                                    <input type="text" id="txtFacilityNo" name="txtFacilityNo" class="form-control"
                                           value="{{$txtFacilityNo}}"
                                           required>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox pdt5 {{$id==""?"hide":""}}">
                                        <label>
                                            <input type="checkbox" id="chkDisabled"
                                                   name="chkDisabled" {{$chkDisabled}}>{{Helpers::getRS($g,"Khong_su_dung")}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">{{Helpers::getRS($g,"Ten_phong_hop")}}</label>

                                <div class="col-sm-9">
                                    <input type="text" id="txtFacilityName" name="txtFacilityName" class="form-control"
                                           value="{{$txtFacilityName}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">{{Helpers::getRS($g,"Dia_diem")}}</label>

                                <div class="col-sm-9">
                                    <input type="text" id="txtLocation" name="txtLocation" class="form-control"
                                           value="{{$txtLocation}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">{{Helpers::getRS($g,"So_cho_ngoi")}}</label>

                                <div class="col-sm-2">
                                    <input type="number" class="form-control text-right" id="txtCapacityTo"
                                           onkeypress="return inputNumber(event);"
                                           name="txtCapacityTo" min="0" step="1" value="{{$txtCapacityTo}}"
                                           required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">{{Helpers::getRS($g,"Ghi_chu")}}</label>

                                <div class="col-sm-9">
                                    <textarea class="form-control" id="txtDescription" name="txtDescription"
                                              style="height: 75px">{{$txtDescription}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3">

                                    <button id="btnShowPopIMGW76G2051" type="button"
                                            class="btn btn-default smallbtn"><span
                                                class="glyphicon glyphicon-folder-open mgr5"></span> {{Helpers::getRS($g,"Chon_anh")}}
                                        ...
                                    </button>

                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <input id="fileThumbnailW76F2051" type="file" name="fileThumbnailW76F2051"
                                           accept="image/*" multiple class="hide">
                                    <a>
                                        <div id="files" class="cls_thumbnail">
                                            <img id="imgThumnailW76F2051" name="imgThumnailW76F2051"
                                                 src="{{$imgThumnailW76F2051}}" alt=""
                                                 width="185px" height="100px" class="cls_thumbnail"/>
                                            <input type="hidden" id="hdimgW76F2051" name="hdimgW76F2051"
                                                   value="{{$hdimgW76F2051}}">
                                            <input type="hidden" id="hdimgThumbW76F2051" name="hdimgThumbW76F2051"
                                                   value="{{$hdimgThumbW76F2051}}">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <fieldset>
                                <legend class="legend mgb5">{{Helpers::getRS($g,"Tien_ich_cua_phong_hop")}}</legend>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox service-facility">
                                            <input type="checkbox" id="chkIsBlackboard" name="chkIsBlackboard"
                                                   class="hide" {{$chkIsBlackboard}}>
                                            <label><span class="digi digi-blackboard mgr5"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span><span
                                                            class="path4"></span><span
                                                            class="path5"></span></span> {{Helpers::getRS($g,"Bang_ghi")}}
                                            </label>
                                            {{--{{isset($rsData["IsBlackboard"]) && $rsData["IsBlackboard"]==1?"":"hide"}}--}}
                                            <span class="fa fa-check mgl5 {{$chkIsBlackboard}}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox service-facility">
                                            <input type="checkbox" name="chkIsProjector" class="hide"
                                                    {{$chkIsProjector}}>
                                            <label><span
                                                        class="digi digi-projector mgr5"></span> {{Helpers::getRS($g,"May_chieu")}}
                                            </label>
                                            <span class="fa fa-check mgl5 {{$chkIsProjector}}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox service-facility">
                                            <input type="checkbox" class="hide"
                                                   name="chkIsEthernet" {{$chkIsEthernet}}>
                                            <label><span class="digi digi-ethernet mgr5"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span></span> Ethernet</label>
                                            <span class="fa fa-check mgl5 {{$chkIsEthernet}}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox service-facility">
                                            <input type="checkbox" class="hide"
                                                   name="chkIsMicrophone" {{$chkIsMicrophone}}>
                                            <label><span class="fa fa-microphone mgr5"></span> Microphone</label>
                                            <span class="fa fa-check mgl5 {{$chkIsMicrophone}}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox service-facility">
                                            <input type="checkbox" class="hide"
                                                   name="chkIsPC" {{$chkIsPC}}>
                                            <label><span class="digi digi-PC mgr5"></span> PC</label>
                                            <span class="fa fa-check mgl5 {{$chkIsPC}}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox service-facility">
                                            <input type="checkbox" class="hide"
                                                   name="chkIsTeleCon" {{$chkIsTeleCon}}>
                                            <label><span class="digi digi-Tele-Conference mgr5"></span> Tele-Conference</label>
                                            <span class="fa fa-check mgl5 {{$chkIsTeleCon}}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox service-facility">
                                            <input type="checkbox" class="hide"
                                                   name="chkIsVideoCon" {{$chkIsVideoCon}}>
                                            <label><span class="digi digi-video_conference mgr5"></span>
                                                Video-Conference</label>
                                            <span class="fa fa-check mgl5 {{$chkIsVideoCon}}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox service-facility">
                                            <input type="checkbox" class="hide"
                                                   name="chkIsWifi" {{$chkIsWifi}}>
                                            <label><span class="fa fa-wifi mgr5"></span> Wifi</label>
                                            <span class="fa fa-check mgl5 {{$chkIsWifi}}"></span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <!-- /.box-body -->
                {{--@if($id!="")--}}
                {{--<button type="button" id="frm_btnCancel"--}}
                {{--class="btn btn-default smallbtn pull-right" disabled>--}}
                {{--<span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}--}}
                {{--</button>--}}
                {{--<button type="button" id="frm_btnSave"--}}
                {{--class="btn btn-default smallbtn pull-right mgr10" disabled><span--}}
                {{--class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}--}}
                {{--</button>--}}
                {{--<button type="button" id="frm_btnEdit" class="btn btn-default smallbtn pull-left mgr10 ">--}}
                {{--<span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}--}}
                {{--</button>--}}
                {{--@if(Session::get($pForm) >3)--}}
                {{--<button type="button" id="frm_btnDelete" onclick="deleteW76F2051();"--}}
                {{--class="btn btn-default smallbtn pull-left confirmation-Delete">--}}
                {{--<span class="glyphicon glyphicon-bin text-black mgr5"></span> {{Helpers::getRS($g,"Xoa")}}--}}
                {{--</button>--}}
                {{--@endif--}}
                {{--@else--}}
                {{--<button type="button" id="frm_btnNext" onclick="frmW76F2051Reset();"--}}
                {{--class="btn btn-default smallbtn pull-right" disabled>--}}
                {{--<span class="glyphicon glyphicon-more-items mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}--}}
                {{--</button>--}}
                {{--<button type="button" id="frm_btnSave"--}}
                {{--class="btn btn-default smallbtn pull-right mgr10"><span--}}
                {{--class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}--}}
                {{--</button>--}}
                {{--@endif--}}
                <!-- /.box-footer -->

                    <div class="box-footer">
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div id="toolbarW76F2051">
                                </div>
                            </div>
                        </div>
                    </div>
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
<div class="modal fade draggable" id="modalW76F2051_IMG" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">cls_thumbnail
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Them_anh"),"",false,"closePopW76F2051_IMG")}}
            </div>
            <div class="modal-body">
                <div class="row mgt5">
                    <div class="col-sm-12">
                        <div id="divUploadW76F2051" class="files upload-container upload-bg" style="height: 500px">
                        </div>
                        <img id="imgW76F2051_IMG" src="{{$imgW76F2051_IMG}}"
                             style="height: 500px;width: 100%" class="hide">
                        <input id="fuW76F2051" type="file" name="fuW76F2051" accept="image/*" class="hide">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 5px">

                <button class="btn btn-default smallbtn pull-left " type="button" id="btnSelectW76F2051"><span
                            class="glyphicon glyphicon-folder-open mgr5"></span>{{Helpers::getRS($g,"Chon_anh")}}...
                </button>
                <button class="btn btn-default smallbtn" type="button" id="btnOKW76F2051"><span
                            class="glyphicon glyphicon-ok mgr5"></span>{{Helpers::getRS($g,"Dong_y")}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    var fileW76F2051;
    @if ($task == "add" || $task == "edit")
    $("#frmW76F2051").on('click', '.service-facility', function () {
        var check = $(this).find("input[type=checkbox]").prop("checked");
        $(this).find("input[type=checkbox]").prop('checked', !check);
        if (check == true)
            $(this).find(".fa-check").addClass("hide");
        else
            $(this).find(".fa-check").removeClass("hide");
    });
    @endif


    {{--$("#frmW76F2051").on('click', '#frm_btnEdit', function () {--}}
        {{--$.ajax({--}}
            {{--method: "POST",--}}
            {{--url: "{{url("W76F2050/$id")}}/",--}}
            {{--success: function (data) {--}}
                {{--if (data == 1) {--}}
                    {{--$("#frm_btnCancel").removeAttr("disabled");--}}
                    {{--$("#frm_btnSave").removeAttr("disabled");--}}
                    {{--$("#frm_btnEdit").attr("disabled", "disabled");--}}
                    {{--$("#frm_btnDelete").attr("disabled", "disabled");--}}
                {{--} else {--}}
                    {{--alert_warning(data);--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}

    @if ($task == "add" || $task == "edit")
    $("#frmW76F2051").on('click', '#btnShowPopIMGW76G2051', function () {
        $("#modalW76F2051_IMG").modal("show");
        $('#imgW76F2051_IMG').attr('src', $('#hdimgW76F2051').val());
        checkShowIMG();
    });

    $("#frmW76F2051").on('click', '#files', function () {
        $("#modalW76F2051_IMG").modal("show");
        $('#imgW76F2051_IMG').attr('src', $('#hdimgW76F2051').val());
        checkShowIMG();
    });

    $("#modalW76F2051_IMG").on('click', '#btnOKW76F2051', function () {
        var reader = new FileReader();
        reader.readAsDataURL(fileW76F2051);
        reader.onload = function (event) {
            $('#hdimgW76F2051').val(event.target.result);
        };
        ImageTools.resize(fileW76F2051, {
            width: 185, // maximum width
            height: 100 // maximum height
        }, function (blob, didItResize) {
            reader.onload = function (event) {
                $('#imgThumnailW76F2051').attr('src', event.target.result);
                $('#hdimgThumbW76F2051').val(event.target.result);
            };
            reader.readAsDataURL(blob);
        });
        closePopW76F2051_IMG();
    });

    function previewIMG() {
        var reader = new FileReader();
        reader.readAsDataURL(fileW76F2051);
        reader.onload = function (event) {
            $('#divUploadW76F2051').addClass("hide");
            $('#imgW76F2051_IMG').removeClass("hide");
            $('#imgW76F2051_IMG').attr('src', event.target.result);
        }
    }

    function clear_image() {
        $('#imgThumnailW76F2051').attr('src', "");
        $('#hdimgThumbW76F2051').val("");
        $('#hdimgW76F2051').val("");
    }
    @endif

    function frmW76F2051Reset() {
        clear_image();
        $('#frmW76F2051')[0].reset();
        $("#txtFacilityNo").focus();
        $("#frmW76F2051").find(".fa-check").addClass("hide");
    }

    function frmW76F2051Save(btnName) {
        validationElements($('#frmW76F2051'), function () {
            var cafrom = $("#frmW76F2051").find("#txtCapacityFrom");
            var cato = $("#frmW76F2051").find("#txtCapacityTo");
            if (cafrom.val() > cato.val()) {
                $("#modalW76F2051").find(".alert-danger").html('{{Helpers::getRS($g,'So_cho_ngoi_den_phai_lon_hon_So_cho_ngoi_tu')}}');
                $("#modalW76F2051").find(".alert-danger").removeClass('hide');
                $("#modalW76F2051").find(".alert-success").addClass('hide');
            }
            $("#frmW76F2051").find("#hfrm_btnSave").click();
        });
    }

    $("#modalW76F2051").on('submit', '#frmW76F2051', function (e) {
        e.preventDefault();


        var url = "";
        var task = "{{$task}}";
        if (task == "add") {
            url = '{{url("/W76F2051/$pForm/$g")}}' + "/save";
        }
        if (task == "edit") {
            url = '{{url("/W76F2051/$pForm/$g")}}' + "/update";
        }
        $(".l3loading").removeClass("hide");
        $.ajax({
            method: "POST",
            url: url,
            data: $("#frmW76F2051").serialize() + "&txtFacilityNo=" + $("#txtFacilityNo").val() + "&id={{$FacilityID}}",
            success: function (data) {
                $(".l3loading").addClass("hide");
                var result = $.parseJSON(data);
                if (result.code == 0) {
                    //Thong bao luu thanh cong
                    save_ok(function () {
                        //Cap nhat cai dong vua luu len luoi
                        @if ($task == "add")
                        update4ParamGrid($("#pqgrid_W76F2050"), result, "add");
                        @endif
                        @if ($task == "edit")
                        update4ParamGrid($("#pqgrid_W76F2050"), result, "edit");
                                @endif

                        var focusButton = $("#toolbarW76F2051").data("digiMenu").getFocusButton();
                        switch (focusButton) {
                            case "frm_btnCancel":
                                $("#modalW76F2051").modal("hide");
                                break;
                            case "frm_btnSaveNext":
                                frmW76F2051Reset();
                                break;
                            case "frm_btnSave":
                                @if ($task == "add")
                                    enableControls("next");
                                @endif
                                    break;
                        }
                    });
                } else if (result.code == 1) {
                    alert_warning('{{Helpers::getRS($g,'Du_lieu_da_bi_trung_ban_khong_the_luu')}}', function () {
                        $("#txtFacilityNo").focus();
                    });
                }
                else {
                    alert_warning('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}');
                }
            }
        });

    });

    $(document).ready(function () {
        $("#toolbarW76F2051").digiMenu({
                showText: true,
                cls: 'none-border none-background',
                style: '',
                buttonList: [
                    {
                        ID: "frm_btnCancel",
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
                                frmW76F2051Save();
                            });
                        }
                    }
                    , {
                        ID: "frm_btnSaveNext",
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
                                frmW76F2051Save();
                            });
                        }
                    }
                    , {
                        ID: "frm_btnNext",
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
                                frmW76F2051Reset();
                            });
                        }
                    }
                    , {
                        ID: "frm_btnSave",
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
                                frmW76F2051Save();
                            });
                        }
                    }
                    , {
                        ID: "hfrm_btnSave",
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
        var holder = document.getElementById('divUploadW76F2051');
        holder.ondragover = function () {
            this.className = 'hover';
            return false;
        };
        holder.ondrop = function (e) {
            e.preventDefault();
            fileW76F2051 = e.dataTransfer.files[0];
            previewIMG();
        };

        enableControls('{{$task}}');

    });

    function checkShowIMG() {
        if ($('#hdimgThumbW76F2051').val() != "") {
            $('#divUploadW76F2051').addClass("hide");
            $('#imgW76F2051_IMG').removeClass("hide");
        } else {
            $('#divUploadW76F2051').removeClass("hide");
            $('#imgW76F2051_IMG').addClass("hide");
        }
    }

    function closePopW76F2051_IMG() {
        $("#modalW76F2051_IMG").modal("hide");
    }

    $("#divUploadW76F2051").on("click", function () {
        $("#fuW76F2051").trigger('click');
    });

    $("#btnSelectW76F2051").on("click", function () {
        $("#fuW76F2051").trigger('click');
    });

    $('#fuW76F2051').on("change", function (e) {
        if (!e.target.files) return;
        fileW76F2051 = e.target.files[0];
        previewIMG();
    });

    function closemodalW76F2051() {
        var task = "{{$task}}";
        if ((task == "add" || task =="edit") && $("#frm_btnNext").is(":visible") == false){ //hoi khi truong hop (them moi hoac sua) va ( nut next dang an)
            alert_custom(icon_ask, "{{Helpers::getRS($g,'Ban_co_muon_dong_man_hinh_nay_khong')}}", true, true, function(){
                $("#modalW76F2051").modal("hide");
            });
        }else{
            $("#modalW76F2051").modal("hide");
        }


    }


    function enableControls(task) {
        switch (task) {
            case "view": //trang thai xem
                $('#txtFacilityNo').prop('disabled', true);
                $('#chkDisabled').prop('disabled', true);
                $('#txtFacilityName').prop('disabled', true);
                $('#txtLocation').prop('disabled', true);
                $('#txtCapacityTo').prop('disabled', true);
                $('#fileThumbnailW76F2051').prop('disabled', true);
                $('#hdimgW76F2051').prop('disabled', true);
                $('#hdimgThumbW76F2051').prop('disabled', true);
                $('#txtDescription').prop('disabled', true);
                $('#btnShowPopIMGW76G2051').prop('disabled', true);
                $('#btnShowPopIMGW76G2051').prop('disabled', true);
                $('#chkIsBlackboard').prop('disabled', true);
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnSave');
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnSaveNext');
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnNext');
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnCancel');
                break;
            case "add"://trang thai them moi
                $("#toolbarW76F2051").data("digiMenu").show('frm_btnSave');
                $("#toolbarW76F2051").data("digiMenu").show('frm_btnSaveNext');
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnNext');
                $("#toolbarW76F2051").data("digiMenu").show('frm_btnCancel');
                break;
            case "edit"://trang thai sua
                $('#txtFacilityNo').prop('disabled', true);
                $('#chkDisabled').prop('disabled', false);
                $('#txtFacilityName').prop('disabled', false);
                $('#txtLocation').prop('disabled', false);
                $('#txtCapacityTo').prop('disabled', false);
                $('#fileThumbnailW76F2051').prop('disabled', false);
                $('#hdimgThumbW76F2051').prop('disabled', false);
                $('#hdimgW76F2051').prop('disabled', false);
                $('#txtDescription').prop('disabled', false);
                $('#btnShowPopIMGW76G2051').prop('disabled', false);
                $('#chkIsBlackboard').prop('disabled', false);
                $("#toolbarW76F2051").data("digiMenu").show('frm_btnSave');
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnSaveNext');
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnNext');
                $("#toolbarW76F2051").data("digiMenu").show('frm_btnCancel');
                break;
            case "next"://trang thai them moi
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnSave');
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnSaveNext');
                $("#toolbarW76F2051").data("digiMenu").show('frm_btnNext');
                $("#toolbarW76F2051").data("digiMenu").hide('frm_btnCancel');
                break;
        }
    }

</script>

