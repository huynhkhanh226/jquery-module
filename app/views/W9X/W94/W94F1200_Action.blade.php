<div class="modal draggable fade modal" id="modalW94F1200" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content">
            <form class="form-horizontal" id="frmD94F1200" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,'Cap_nhat_thiet_lap_bao_cao_quan_tri'),"W94F1200")}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="nav-tabs-custom mgt10">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tabMainInfo"
                                                          data-toggle="tab">1. {{Helpers::getRS($g,"_Thong_tin_chinh")}}</a>
                                    </li>
                                    <li><a href="#tabPrivelege" data-toggle="tab"
                                           >2. {{Helpers::getRS($g,"Phan_quyen")}}</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabMainInfo">
                                        <div class="row">
                                            <!-- column -->
                                            <div class="col-md-12">
                                                <!-- form start -->
                                                <input type="hidden" value="{{$action}}" id="FormMode">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,'_Ma_bao_cao')}}</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control text-uppercase"
                                                                   name="txtMReportID"
                                                                   id="txtMReportID"
                                                                   value="{{ isset($row['MReportID']) ? $row['MReportID'] : '' }}"
                                                                   placeholder=""
                                                                   {{$action=='edit' ? 'disabled' : ''}} required>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="checkbox" style="margin-top: -4px">
                                                                <label class='{{count($row) >0 ? "" : "hide"}}'>
                                                                    <input type="checkbox" id='chDisable'
                                                                           {{ (count($row) >0 && $row['Disabled']==1) ? 'checked="checked"' : "" }} disabled="disabled"/>
                                                                    {{Helpers::getRS($g,'KSD')}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username"
                                                               class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,'Ten_bao_cao')}}</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="txtMReportNameU"
                                                                   name="txtMReportNameU"
                                                                   value="{{isset($row['MReportNameU']) ? $row['MReportNameU'] : ""}}"
                                                                   placeholder="" {{$cls}} required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-3">
                                                            <label class="control-label lbl-normal">{{Helpers::getRS($g,'Thu_tu_hien_thi')}}</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="number" min="0" class="form-control"
                                                                   id="txtDisplayOrder"
                                                                   value="{{isset($row['DisplayOrder']) ? $row['DisplayOrder'] : ''}}"
                                                                   name="txtDisplayOrder" placeholder=""
                                                                   {{$cls}} required
                                                            >
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="control-label pull-right lbl-normal">{{Helpers::getRS($g,'Thiet_bi')}}</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select class="form-control" id="cbbPlatformID"
                                                                    name="cbbPlatformID"
                                                                    placeholder="" {{$cls}} required>
                                                                @foreach($listPlatform as $rowPlat => $value)
                                                                    <option value="{{$rowPlat}}" {{isset($row['PlatformID']) && $row['PlatformID']== $rowPlat? "selected" : ''}}>{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="username"
                                                               class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,'Nhom_bao_cao')}}</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" id="cbbReportGroupID"
                                                                    name="cbbReportGroupID"
                                                                    placeholder="" {{$cls}} required>
                                                                <option value=""></option>
                                                                @foreach($regroup as $rowgroup)
                                                                    <option value="{{$rowgroup["ReportGroupID"]}}" {{isset($row['ReportGroupID']) && $row['ReportGroupID']== $rowgroup["ReportGroupID"]? "selected" : ''}}>{{$rowgroup['ReportGroupName']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-3">
                                                            <label class="control-label lbl-normal">{{Helpers::getRS($g,'Loai_bao_cao')}}</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select class="form-control" id="cboReportType"
                                                                    name="cboReportType"
                                                                    placeholder="" {{$cls}} required>
                                                                <option value=""></option>
                                                                @foreach($reportTypeList as $reportTypeRow)
                                                                    <option value="{{$reportTypeRow["ReportType"]}}" {{isset($row['ReportType']) && $row['ReportType']== $reportTypeRow["ReportType"]? "selected" : ''}}>{{$reportTypeRow["ReportType"]}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="username"
                                                               class="col-sm-3 control-label text-left lbl-normal lblReportTypeBirt {{isset($row['MReportID']) && ($row['ReportType'] == 'BIRT' || $row['ReportType'] == '') ? '': 'hide'}}">{{Helpers::getRS($g,'Mau_bao_cao')}}</label>
                                                        <label for="username"
                                                               class="col-sm-3 control-label text-left lbl-normal lblReportTypePowerBI {{isset($row['MReportID']) && $row['ReportType'] == 'EMBED' ? '': 'hide'}}">{{Helpers::getRS($g,'Link_bao_cao')}}</label>
                                                        <label for="username"
                                                               class="col-sm-3 control-label text-left lbl-normal lblReportTypeForm {{isset($row['MReportID']) && $row['ReportType'] == 'FORM' ? '': 'hide'}}">{{Helpers::getRS($g,'Mau_bao_cao')}}</label>
                                                        <div class="col-sm-9">
                                                            <?php
                                                            $reportlink = "";
                                                            if (isset($row['MReportID']) && ($row['ReportType'] == "BIRT" || $row['ReportType'] == ""))
                                                                $reportlink = $row['ReportFileName'];
                                                            if (isset($row['MReportID']) && ($row['ReportType'] == "EMBED"))
                                                                $reportlink = $row['EmbedCode'];
                                                            if (isset($row['MReportID']) && ($row['ReportType'] == "FORM"))
                                                                $reportlink = $row['ReportFileName'];
                                                            ?>
                                                            <input type="text" class="form-control"
                                                                   id="txtReportFileName"
                                                                   value="{{$reportlink}}"
                                                                   name="txtReportFileName" placeholder=""
                                                                   {{$cls}} required
                                                            >

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username" style="margin-top: 20px;"
                                                               class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>

                                                        <div class="col-sm-9">
                                        <textarea class="form-control" rows="2" id="txtRemarkU" name="txtRemarkU"
                                                  placeholder="" {{$cls}}>{{isset($row['RemarkU']) ? $row['RemarkU'] : ''}}</textarea>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username" style="margin-top: 50px;"
                                                               class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,"Anh_dai_dien")}}</label>
                                                        <div id="divImage" class="col-sm-9" style="display: inline;">
                                                        {{--<img class="hide" src="{{ (count($row) >0 && $row['Image'] != "" ? $row['Image'] : asset('/packages/default/L3/images/thumbnail.png'))}}"--}}
                                                        {{--longdesc="{{ (count($row) >0 && $row['Image'] != "" ? $row['Image'] : asset('/packages/default/L3/images/thumbnail.png'))}}"--}}
                                                        {{--style="background-color: beige;border-radius: 5px;border: 1px solid #ccc"  width="218px" height="140px" onclick="previewImage(this);" >--}}

                                                        <!--  //////////////////////////////  -->
                                                            <div class="img-container">
                                                                <img src="{{asset('images/companylogo-large.png')}}"
                                                                     class="mgt10 hide"
                                                                     style="margin-right: 10px; border: 1px solid #ccc; border-radius: 5px; max-width: 100%; min-height: 250px">

                                                                <img id="imgLogo"
                                                                     src="{{ (count($row) >0 && $row['Image'] != "" ? $row['Image'] : asset('/packages/default/L3/images/thumbnail.png'))}}"
                                                                     longdesc="{{ (count($row) >0 && $row['Image'] != "" ? $row['Image'] : asset('/packages/default/L3/images/thumbnail.png'))}}"
                                                                     style="background-color: beige;border-radius: 5px;border: 1px solid #ccc"
                                                                     onclick="previewImage(this);">
                                                            </div>
                                                            <!--  //////////////////////////////  -->


                                                        </div>

                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-9">
                                                            <button type="button" class="btn btn-default smallbtn"
                                                                    id="chooseW94F1200" {{$cls}} onclick="choosse();">
                                                                <span class="fa fa-folder-open"></span></button>
                                                            <button type="button" class="btn btn-default smallbtn"
                                                                    id="resetW94F1200" {{$cls}} onclick="resetImage();">
                                                                <span class="fa fa-trash"></span></button>
                                                            <button type="button" class="btn btn-default smallbtn"
                                                                    id="cropW94F1200" {{$cls}} onclick="cropImage();">
                                                                <span class="fa fa-crop"></span></button>

                                                            <input id="fileW94F1200" type="file" name="fileW94F1200"
                                                                   accept="image/*" style="display: none">
                                                            <input type="hidden" id="hdImageUrl" name="hdImageUrl"
                                                                   value=""/>
                                                            <input type="hidden" id="hdImageThumbNailUrl"
                                                                   name="hdImageThumbNailUrl" value=""/>
                                                            <img id="hiddenImg" src="" alt="" class="hide">


                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">

                                                    @if($action=="edit")
                                                        <button type="button" id="frm_btnCancel"
                                                                class="btn btn-default smallbtn pull-right {{$cls}}">
                                                            <span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                                        </button>
                                                        <button type="submit" id="frm_btnSave"
                                                                class="btn btn-default smallbtn pull-right mgr10 {{$cls}}"><span
                                                                    class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                                        </button>
                                                        <button type="button" id="frm_btnedit"
                                                                class="btn btn-default smallbtn pull-left mgr10 ">
                                                            <span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                                                        </button>
                                                        @if(Session::get($pForm) >3)
                                                            <button type="button" id="frm_btnDelete"
                                                                    class="btn btn-default smallbtn pull-left confirmation-Delete">
                                                                <span class="glyphicon glyphicon-remove mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button type="button" id="frm_btnNext"
                                                                onclick="frmD94F1200Reset();"
                                                                class="btn btn-default smallbtn pull-right {{$cls}} disabled">
                                                            <span class="glyphicon glyphicon-more-items mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                                        </button>
                                                        <button type="button" id="frm_btnSave"
                                                                class="btn btn-default smallbtn pull-right mgr10 {{$cls}}"><span
                                                                    class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                                        </button>
                                                        <button type="submit" id="hfrm_btnSave" class="hide">
                                                        </button>
                                                    @endif
                                                </div>

                                            </div>
                                            <!--/.col -->
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabPrivelege">
                                        <fieldset>
                                            <legend class="legend">{{Helpers::getRS($g,"Nhom_truy_cap_du_lieu")}}</legend>
                                            <div id="gridDataAccessW94F1200"></div>
                                        </fieldset>

                                        <fieldset>
                                            <legend class="legend">{{Helpers::getRS($g,"Vai_tro")}}</legend>
                                            <div id="gridRoleW94F1200"></div>
                                        </fieldset>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="chkIsSelectedW94F1200"
                                                               name="chkIsSelectedW94F1200"> {{Helpers::getRS($g,"Chi_hien_thi_du_lieu_da_chon")}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="alert alert-success alert-dismissable hide">
                        <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_duoc_luu_thanh_cong")}}
                    </div>
                    <div class="alert alert-danger alert-dismissable hide">
                        <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}
                            !</span>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@include('layout.previewImage')

<script type="text/javascript">
    var currentObject;
    var disabled;

    function frmD94F1200Reset() {
        $('#frmD94F1200')[0].reset();
        $("#frm_btnSave").removeClass('disabled');
        $("#frm_btnNext").addClass('disabled');
        $("#txtMReportID").focus();
        $("#frmD94F1200").find(".alert-success").addClass('hide');
        $("#frmD94F1200").find(".alert-danger").addClass('hide');
        resetImage();
    }

    function resetImage() {
        $("#imgLogo").attr("src", "{{asset('/packages/default/L3/images/thumbnail.png')}}");
        $("#hdImageThumbNailUrl").val("");
        $("#fileW94F1200").val("");
        $("#hdImageUrl").val("");
        if (cropper != null) {
            cropper.destroy();
            cropper = null;
        }
    }


    $("#frm_btnSave").click(function (e) {
        frmSave();
    });

    function frmSave() {
        if (checktxtMReportID()) {
            $('#hfrm_btnSave').click()

            console.log("dfsfsd");
        }
    }

    $('.confirmation-Delete').confirmation({
        placement: 'right',
        title: "{{Helpers::getRS($g,"Ban_co_muon_xoa_du_lieu_nay_khong")}}",
        onConfirm: function () {
            $.ajax({
                method: "POST",
                url: "{{url("W94F1200/".$pForm."/delete")}}/" + $("#txtMReportID").val(),
                success: function (data) {
                    if (data == 1) {
                        $("#modalW94F1200").modal('hide');
                        update4ParamGrid($(document).find("#pqgrid_W94F1200"), null, 'delete');
                    }
                    else {
                        $("#frmD94F1200").find("#err").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}');
                        $("#frmD94F1200").find(".alert-danger").removeClass('hide');
                    }
                }
            });
        },
        onCancel: function () {
        }
    });

    $(document).ready(function () {
        $("#hdSaveOKW94F1200").val(0);
        currentObject ={{json_encode($row)}};
        console.log(currentObject);
        if (currentObject.Disabled == "0") {
            disabled = "";
        } else {
            disabled = "checked";
        }

        $("#frmD94F1200").on('click', '#frm_btnedit', function () {
            ActionMode();
        });

        $("#frmD94F1200").on('click', '#frm_btnCancel', function () {
            @if($action=="edit")  // nếu là edit
            NormalMode();
            setFormValue();
            @endif


        });

        $("#frmD94F1200").on('click', ".close", function () {
            NormalMode();
        });

        $("#modalW94F1200").on('submit', '#frmD94F1200', function (e) {
            e.preventDefault();
            cropImage();
            console.log("test");
            $(".l3loading").removeClass('hide');
            var roleList = $("#gridRoleW94F1200").pqGrid('option', 'dataModel.data');
            roleList = $.grep(roleList, function(row){
                return row.IsUsed == 1;
            });
            var dataList = $("#gridDataAccessW94F1200").pqGrid('option', 'dataModel.data');
            dataList = $.grep(dataList, function(row){
                return row.IsUsed == 1;
            });
            roleList = JSON.stringify(roleList);
            dataList = JSON.stringify(dataList);
            $.ajax({
                method: "POST",
                url: "{{url("W94F1200/".$pForm."/$action/" . (isset($row['MReportID']) ? $row['MReportID'] : ''))}}",
                data: $("#frmD94F1200").serialize() + '&chDisable=' + $("#chDisable").is(":checked") + "&roleList=" + roleList + "&dataList="+dataList ,
                success: function (data) {
                    @if($action=="edit") // chỉnh
                    $("#frmD94F1200").find(".alert-success").removeClass('hide');
                    $("#hdSaveOKW94F1200").val(1);
                    currentObject = $.parseJSON(data);
                    NormalMode();
                    setFormValue();
                    currentObject.ReportGroupName = $("#cbbReportGroupID").find(":selected").text();//
                    currentObject.PlatformName = $("#cbbPlatformID").find(":selected").text();//
                    update4ParamGrid($(document).find("#pqgrid_W94F1200"), currentObject, 'edit');
                    //   loadTable();//7416 - load W94F1200.blade.php
                    @else  //  thêm mới

                    if (data != -1 && data != 0) {
                        $("#frm_btnSave").addClass('disabled');
                        $("#frm_btnNext").removeClass('disabled');
                        $("#frmD94F1200").find(".alert-success").removeClass('hide');
                        $("#frmD94F1200").find(".alert-danger").addClass('hide');
                        currentObject = $.parseJSON(data);
                        currentObject.ReportGroupName = $("#cbbReportGroupID").find(":selected").text();//
                        currentObject.PlatformName = $("#cbbPlatformID").find(":selected").text();//
                        update4ParamGrid($(document).find("#pqgrid_W94F1200"), currentObject, 'add');
                    }
                    else {
                        if (data == -1) {
                            $("#frmD94F1200").find("#err").html('{{Helpers::getRS($g,'Ma_nay_da_ton_tai')}}');
                            $("#txtMReportID").focus();
                        }
                        if (data == 0) $("#frmD94F1200").find("#err").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}')
                        $("#frmD94F1200").find(".alert-success").addClass('hide');
                        $("#frmD94F1200").find(".alert-danger").removeClass('hide');
                    }
                    @endif
                    $(".l3loading").addClass('hide');
                }
            });
        });

        $("#frmD94F1200").find("#txtMReportID").blur(function () {
            checktxtMReportID();
        });

        $("#cboReportType").change(function () {
            onchangeReportType(this);
        });

        @if (!isset($row['MReportID']))
        onchangeReportType(this);
        @endif

        createGrid();

        $("#chkIsSelectedW94F1200").change(function(){
            var val = $(this).is(":checked") ? 1 : 0;
            $( "#gridRoleW94F1200" ).pqGrid( "filter", {
                oper: 'replace',
                data: [
                    { dataIndx: 'IsUsed', condition: 'equal', value: val }
                ]
            });

            $( "#gridDataAccessW94F1200" ).pqGrid( "filter", {
                oper: 'replace',
                data: [
                    { dataIndx: 'IsUsed', condition: 'equal', value: val }
                ]
            });
            if (val == 0){
                $( "#gridRoleW94F1200" ).pqGrid( "reset", { group: true, filter: true } );
                $( "#gridDataAccessW94F1200" ).pqGrid( "reset", { group: true, filter: true } );
            }
        });


    });

    function onchangeReportType(el) {
        if ($(el).val() == "BIRT" || $(el).val() == "") {
            $(".lblReportTypeBirt").removeClass("hide");
            $(".lblReportTypePowerBI").addClass("hide");
            $(".lblReportTypeForm").addClass("hide");
        }
        if ($(el).val() == "EMBED" || $(el).val() == "") {
            $(".lblReportTypePowerBI").removeClass("hide");
            $(".lblReportTypeBirt").addClass("hide");
            $(".lblReportTypeForm").addClass("hide");
        }
        else {
            $(".lblReportTypeForm").removeClass("hide");
            $(".lblReportTypeBirt").addClass("hide");
            $(".lblReportTypePowerBI").addClass("hide");
        }
        $("#txtReportFileName").val("");
    }

    function checktxtMReportID() {
        var str = $("#frmD94F1200").find("#txtMReportID").val();
        var regex = /[^\w]/gi;

        if (regex.test(str) == true) {
            $("#frmD94F1200").find("#err").html('{{Helpers::getRS($g,'Ma_co_ky_tu_khong_hop_le')}}');
            $("#frmD94F1200").find(".alert-danger").removeClass('hide');
            //Set timeout for Firefox and IE
            setTimeout(function () {
                $("#txtMReportID").focus();
            }, 10);
            return false;
        }
        $("#frmD94F1200").find(".alert-danger").addClass('hide');
        return true;
    }

    function setFormValue() {
        // $("#frmD94F1200").find("#chDisable").attr('checked', "");

        if (currentObject.Disabled == 0)
            $("#frmD94F1200").find("#chDisable").prop('checked', false);
        else
            $("#frmD94F1200").find("#chDisable").prop('checked', true);
        $("#frmD94F1200").find("#txtMReportNameU").val(currentObject.MReportNameU);
        $("#frmD94F1200").find("#txtDisplayOrder").val(currentObject.DisplayOrder);
        $("#frmD94F1200").find("#txtReportFileName").val(currentObject.ReportFileName);
        $("#frmD94F1200").find("#txtRemarkU").val(currentObject.RemarkU);
        $("#frmD94F1200").find("#cboReportType").val(currentObject.ReportType);
        //alert(currentObject.ReportType);
    }

    function ActionMode() {

        $("#frmD94F1200").find("#frm_btnedit").addClass('disabled');
        @if(Session::get($pForm)>3)
        $("#frmD94F1200").find("#frm_btnDelete").addClass('disabled');
        @endif
        $("#frmD94F1200").find("#frm_btnCancel").removeClass('disabled');
        $("#frmD94F1200").find("#frm_btnSave").removeClass('disabled');

        $("#frmD94F1200").find("#chDisable").removeAttr('disabled');
        $("#frmD94F1200").find("#txtMReportNameU").removeAttr('disabled');
        $("#frmD94F1200").find("#txtDisplayOrder").removeAttr('disabled');
        $("#frmD94F1200").find("#txtReportFileName").removeAttr('disabled');
        $("#frmD94F1200").find("#txtRemarkU").removeAttr('disabled');
        $("#frmD94F1200").find("#cbbReportGroupID").removeAttr('disabled');//6416
        $("#frmD94F1200").find("#cbbPlatformID").removeAttr('disabled');//6416
        $("#frmD94F1200").find(".alert-success").addClass('hide');
        $("#frmD94F1200").find(".alert-success").addClass('hide');
        $("#frmD94F1200").find("#chooseW94F1200").removeAttr('disabled');
        $("#frmD94F1200").find("#cropW94F1200").removeAttr('disabled');
        $("#frmD94F1200").find("#resetW94F1200").removeAttr('disabled');
        $("#frmD94F1200").find("#cboReportType").removeAttr('disabled');
        enableGrid($("#gridRoleW94F1200"), true);
        enableGrid($("#gridDataAccessW94F1200"), true);
    }

    function NormalMode() {
        $("#frmD94F1200").find("#frm_btnedit").removeClass('disabled');
        @if(Session::get($pForm)>3)
        $("#frmD94F1200").find("#frm_btnDelete").removeClass('disabled');
        @endif
        $("#frmD94F1200").find("#frm_btnCancel").addClass('disabled');
        $("#frmD94F1200").find("#frm_btnSave").addClass('disabled');

        $("#frmD94F1200").find("#chDisable").attr('disabled', 'disabled');
        $("#frmD94F1200").find("#txtMReportNameU").attr('disabled', 'disabled');
        $("#frmD94F1200").find("#txtDisplayOrder").attr('disabled', 'disabled');
        $("#frmD94F1200").find("#txtReportFileName").attr('disabled', 'disabled');
        $("#frmD94F1200").find("#txtRemarkU").attr('disabled', 'disabled');
        $("#frmD94F1200").find("#cbbReportGroupID").removeAttr('disabled');//6416
        $("#frmD94F1200").find("#cbbPlatformID").removeAttr('disabled');//6416
        $("#frmD94F1200").find("#chooseW94F1200").attr('disabled', 'disabled');
        $("#frmD94F1200").find("#cropW94F1200").attr('disabled', 'disabled');
        $("#frmD94F1200").find("#resetW94F1200").attr('disabled', 'disabled');
        $("#frmD94F1200").find("#cboReportType").attr('disabled', 'disabled');
        $("#frmD94F1200").find("#cbbReportGroupID").attr('disabled', 'disabled');
        enableGrid($("#gridRoleW94F1200"), false);
        enableGrid($("#gridDataAccessW94F1200"), false);

    }

    function choosse() {
        $("#fileW94F1200").val("");
        $("#fileW94F1200").trigger('click');
    }

    //
    //    function blobToDataURL(blob, callback) {
    //        var a = new FileReader();
    //        a.onload = function (e) {
    //            callback(e.target.result);
    //        }
    //        a.readAsDataURL(blob);
    //    }

    /*$('#fileW94F1200').on("change", function (e) {
        console.log("sdfsd");
        var file = e.target.files[0];
        var reader  = new FileReader();
        reader.addEventListener("load", function () {
            //$("#modalResizeImage").find("#urlImage").val(reader.result);
            //$("#modalResizeImage").modal('show');
            var newImg = $("#hiddenImg");
            newImg.attr("src", reader.result);
            setTimeout(function(){
                var newImg = $("#hiddenImg");
                var imageNaturalWidth = newImg.prop('naturalWidth');
                var imageNaturalHeight = newImg.prop('naturalHeight');
                if (e.target.files.length > 0){
                    if (imageNaturalWidth > imageNaturalHeight){
                        ImageTools.resize(file, {
                            width: 400,
                        }, function (blob, didItResize) {
                            blobToDataURL(blob, function (url) {
                                $("#divImage>img").attr("src", url);
                                $("#hdImageThumbNailUrl").val(url);
                            });
                        });
                    }else{
                        ImageTools.resize(file, {
                            height: 200,
                        }, function (blob, didItResize) {
                            blobToDataURL(blob, function (url) {
                                $("#divImage>img").attr("src", url);
                                $("#hdImageThumbNailUrl").val(url);
                            });
                        });
                    }


                    //=======================================================================
                    ImageTools.resize(file, {
                        //
                    }, function (blob, didItResize) {
                        blobToDataURL(blob, function (url) {
                            $("#divImage>img").attr("longdesc", url);
                            $("#hdImageUrl").val(url);
                        });
                    });
                }else{
                    $("#divImage>img").attr("src", "{{asset('/packages/default/L3/images/thumbnail.png')}}");
                }
            }, 600);


        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }


    });*/

    /* var holder = document.getElementById('divImage');
     holder.ondragover = function () {
         this.className = 'hover';
         return false;
     };
     holder.ondrop = function (e) {
         e.preventDefault();
         var file = e.dataTransfer.files[0];
         ImageTools.resize(file, {
             width: 218, // maximum width
         }, function (blob, didItResize) {
             blobToDataURL(blob, function (url) {
                 $("#divImage>img").attr("src", url);
                 $("#hdImageThumbNailUrl").val(url);
             });
         });
         ImageTools.resize(file, {
             //
         }, function (blob, didItResize) {
             blobToDataURL(blob, function (url) {
                 console.log("test1");
                 $("#divImage>img").attr("longdesc", url);
                 $("#hdImageUrl").val(url);
             });
         });

     };*/

    //===========================================================================================================
    var logo;
    var croppable = false;
    var cropper = null;

    function blobToDataURL(blob, callback) {
        var a = new FileReader();
        a.onload = function (e) {
            callback(e.target.result);
        }
        a.readAsDataURL(blob);
    }

    $('#fileW94F1200').on("change", function (e) {
        var file = e.target.files[0];
        logo = file;
        var reader = new FileReader();
        reader.addEventListener("load", function (e) {
            $("#imgLogo").prop('src', e.target.result);
            var image = document.getElementById('imgLogo');
            if (cropper != null) {
                cropper.destroy();
                cropper = null;
            }
            cropper = new Cropper(image, {
                autoCropArea: 1,
                aspectRatio: 16 / 9,
                viewMode: 1,
//                        data:{
//                            width: 100
//                        },
                cropBoxMovable: false,
                cropBoxResizable: false,
                dragMode: 'move',
                //autoCropArea: 1
                ready: function () {
                    // Strict mode: set crop box data first
                    croppable = true;
                }
            });
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    });

    function cropImage() {
        var image = document.getElementById('imgLogo');
        var croppedCanvas;
        var roundedImage;
        console.log(croppable);
        if (!croppable) {
            //$('#hdImageUrl').val("");
            //$('#hdImageThumbNailUrl').val("");
        } else {
            croppedCanvas = cropper.getCroppedCanvas();
            image.src = croppedCanvas.toDataURL();
            console.log(croppedCanvas.toDataURL());
            $('#hdImageUrl').val(croppedCanvas.toDataURL());
            $('#hdImageThumbNailUrl').val(croppedCanvas.toDataURL());
            cropper.destroy();
            cropper = null;
            croppable = false;
        }
    }


    function createGrid() {
        var obj = {
            width: '100%',
            height: 215,
            editable: true,
            freezeCols: 1,
            selectionModel: {type: 'cell'},
            minWidth: 30,
            //pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            colModel: [
                {
                    title: "{{Helpers::getRS($g,"Chon")}}",
                    minWidth: 50,
                    dataType: "string",
                    dataIndx: "IsUsed",
                    align: "center",
                    type: 'checkbox',
                    cb: {
                        all: false,
                        header: true,
                        check: 1,
                        uncheck: 0
                    },
                    editable: true,
                    editor:false,
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsUsed"] == 1 ? 'checked' : ''
                        var disabled = this.isEditableCell(ui) ? "" : "readonly";
                        console.log(disabled);
                        return {
                            text: "<label><input type='checkbox' " + checked + " " +disabled+ ""  + " /></label>",
                        };
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ma")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "CodeID",
                    editable: false,
                    editor: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ten")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "CodeName",
                    editable: false,
                    editor: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                }
            ],
            dataModel: {
                data: {{$rsDataList}}
            }
        };
        var $gridDataAccessW94F1200 = $("#gridDataAccessW94F1200").pqGrid(obj);
        $gridDataAccessW94F1200.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridDataAccessW94F1200.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridDataAccessW94F1200.pqGrid("refreshDataAndView");


        var objRole = {
            width: '100%',
            height: 215,
            editable: true,
            freezeCols: 1,
            selectionModel: {type: 'cell'},
            minWidth: 30,
            //pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            colModel: [
                {
                    title: "{{Helpers::getRS($g,"Chon")}}",
                    minWidth: 50,
                    dataType: "string",
                    dataIndx: "IsUsed",
                    align: "center",
                    type: 'checkbox',
                    cb: {
                        all: true,
                        header: true,
                        check: 1,
                        uncheck: 0
                    },
                    editable: true,
                    editor:false,
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsUsed"] == 1 ? 'checked' : ''
                        return {
                            text: "<label><input type='checkbox' " + checked + " /></label>",
                        };
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ma")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "CodeID",
                    editable: false,
                    editor: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ten")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "CodeName",
                    editable: false,
                    editor: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                }
            ],
            dataModel: {
                data: {{$rsRoleList}}
            }
        };
        var $gridRoleW94F1200 = $("#gridRoleW94F1200").pqGrid(objRole);
        $gridRoleW94F1200.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridRoleW94F1200.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridRoleW94F1200.pqGrid("refreshDataAndView");

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("id") // activated tab
            resizePqGrid();
        });
    }
</script>
<style>
    #imgLogo {
        width: 250px;
        height: calc(250px * 9 / 16);
    }

    .img-container {
        width: 250px;
        height: calc(250px * 9 / 16);
        margin: 0;
    }
</style>
