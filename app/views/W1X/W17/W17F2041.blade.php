<div class="modal fade draggable" id="modalW17F2041" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:96%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Cap_nhat_tiem_nang"),"W17F2041")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW17F2041" name="frmW17F2041">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-5">
                                <div class="row">
                                    <label class="col-sm-3 liketext lbl-normal">{{Helpers::getRS($g,"Ma_so")}}</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="txtLeadNo" name="txtLeadNo"
                                               class="form-control text-uppercase" value="{{$rsData["LeadNo"] or ''}}"
                                               {{$id!=""?"readonly":""}} required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Ngay_tao")}}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="txtLeadDate" name="txtLeadDate"
                                                   value="{{$rsData["LeadDate"] or date("d/m/Y")}}" required>
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Nguon_goc")}}</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="slLeadSourceID" name="slLeadSourceID">
                                            <option value=""></option>
                                            @foreach($leadsource as $row)
                                                <option value="{{$row['LeadSourceID']}}" {{isset($rsData["LeadSourceID"]) && $rsData["LeadSourceID"]==$row['LeadSourceID']?'selected':''}}>{{$row['LeadSourceName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <div class="row">
                                    <label class="col-sm-3 liketext lbl-normal">{{Helpers::getRS($g,"Cong_ty")}}</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="txtLeadCompanyName" name="txtLeadCompanyName"
                                               class="form-control" value="{{$rsData["LeadCompanyName"] or ''}}"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Nguoi_lien_he")}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="txtLeadContactName" name="txtLeadContactName"
                                               class="form-control" value="{{$rsData["LeadContactName"] or ''}}"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="slLeadStatusID" name="slLeadStatusID" required>
                                            @define $sta = isset($rsData["LeadStatusID"])? $rsData["LeadStatusID"] :'0001'
                                            @foreach($status as $row)
                                                <option value="{{$row['ID']}}" {{$sta==$row['ID']?'selected':''}}>{{$row['Name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <fieldset>
                            <legend class="legend">{{Helpers::getRS($g,"Thong_tin_cong_ty")}}</legend>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <label class="col-sm-3 liketext lbl-normal">{{Helpers::getRS($g,"Doanh_thu_namU")}}</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="slLeadRevenueID" name="slLeadRevenueID">
                                                <option value=""></option>
                                                @foreach($revenue as $row)
                                                    <option value="{{$row['LeadRevenueID']}}" {{isset($rsData["LeadRevenueID"]) && $rsData["LeadRevenueID"]==$row['LeadRevenueID']?'selected':''}}>{{$row['LeadRevenueName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Quy_mo_cong_tyU")}}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="slLeadCompanySizeID"
                                                    name="slLeadCompanySizeID">
                                                <option value=""></option>
                                                @foreach($comsize as $row)
                                                    <option value="{{$row['LeadCompanySizeID']}}" {{isset($rsData["LeadCompanySizeID"]) && $rsData["LeadCompanySizeID"]==$row['LeadCompanySizeID']?'selected':''}}>{{$row['LeadCompanySizeName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Dien_thoai")}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtTelephone" name="txtTelephone"
                                                   class="form-control" value="{{$rsData["Telephone"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-3 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,"Nhom_nganh_nghe")}}</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="slLeadIndustryGroupID"
                                                    name="slLeadIndustryGroupID">
                                                <option value=""></option>
                                                @foreach($industry as $row)
                                                    <option value="{{$row['LeadIndustryGroupID']}}" {{isset($rsData["LeadIndustryGroupID"]) && $rsData["LeadIndustryGroupID"]==$row['LeadIndustryGroupID']?'selected':''}}>{{$row['LeadIndustryGroupName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Nhom_cong_ty")}}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="slCompanyGroupID" name="slCompanyGroupID">
                                                <option value=""></option>
                                                @foreach($comgroup as $row)
                                                    <option value="{{$row['CompanyGroupID']}}" {{isset($rsData["CompanyGroupID"]) && $rsData["CompanyGroupID"]==$row['CompanyGroupID']?'selected':''}}>{{$row['CompanyGroupName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">Fax</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtFax" name="txtFax"
                                                   class="form-control" value="{{$rsData["FaxNo"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-3 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" style="height: 60px;" id="txtNotes"
                                                      name="txtNotes">{{$rsData["Notes"] or ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Dia_chi")}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtAddress" name="txtAddress"
                                                   class="form-control" value="{{$rsData["Address"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">Website</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtWebsite" name="txtWebsite"
                                                   class="form-control" value="{{$rsData["Website"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="legend">{{Helpers::getRS($g,"Thong_tin_nguoi_lien_he")}}</legend>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-3 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,"Gioi_tinh")}}</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="radio">
                                                <label>
                                                    <input name="optSex" id="optSex0" value="0" type="radio" {{isset($rsData["Sex"]) == false || $rsData["Sex"]==0?'checked':''}}>
                                                    {{Helpers::getRS($g,"NamU")}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="radio">
                                                <label>
                                                    <input name="optSex" id="optSex1" value="1" type="radio" {{isset($rsData["Sex"]) && $rsData["Sex"]==1?'checked':''}}>
                                                    {{Helpers::getRS($g,"Nu_U")}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Chuc_vu")}}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="slLeadPositionID" name="slLeadPositionID">
                                                <option value=""></option>
                                                @foreach($position as $row)
                                                    <option value="{{$row['LeadPositionID']}}" {{isset($rsData["LeadPositionID"]) && $rsData["LeadPositionID"]==$row['LeadPositionID']?'selected':''}}>{{$row['LeadPositionName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Dien_thoai")}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtTelephoneContact" name="txtTelephoneContact"
                                                   class="form-control" value="{{$rsData["TelephoneContact"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-3 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,"Xung_ho")}}</label>
                                        </div>
                                        <div class="col-sm-2 pdr0">
                                            <select class="form-control" id="slCallID" name="slCallID">
                                                <option value=""></option>
                                                @foreach($call as $row)
                                                    <option value="{{$row['ID']}}" {{isset($rsData["CallID"]) && $rsData["CallID"]==$row['ID']?'selected':''}}>{{$row['Name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="row">
                                                <div class="col-sm-4 pdr0">
                                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Ngay_sinh")}}</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" id="txtBirthday"
                                                               name="txtBirthday"
                                                               value="{{$rsData["Birthday"] or ''}}">
                                                        <span class="input-group-addon"><i
                                                                    class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtDepartment" name="txtDepartment"
                                                   class="form-control" value="{{$rsData["Department"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">Fax</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtFaxContact" name="txtFaxContact"
                                                   class="form-control" value="{{$rsData["FaxContact"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <label class="col-sm-3 liketext lbl-normal">{{Helpers::getRS($g,"Mobile")}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="txtMobileContact" name="txtMobileContact"
                                                   class="form-control" value="{{$rsData["MobileContact"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Dia_chi")}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtAddressContactPerson"
                                                   name="txtAddressContactPerson"
                                                   class="form-control"
                                                   value="{{$rsData["AddressContactPerson"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Email")}}</label>
                                        <div class="col-sm-8">
                                            <input type="email" id="txtEmailContact" name="txtEmailContact"
                                                   class="form-control" value="{{$rsData["EmailContact"] or ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="legend">{{Helpers::getRS($g,"Phan_bo_tiem_nang")}}</legend>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-3 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,"Nhom_kinh_doanh")}}</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select id="slGroupSalesID" name="slGroupSalesID" class="form-control">
                                                <option value=""></option>
                                                @foreach($sales as $row)
                                                    <option value="{{$row["GroupSalesID"]}}" {{isset($rsData["GroupSalesID"]) && $rsData["GroupSalesID"]==$row['GroupSalesID']?'selected':''}}>{{$row["GroupSalesName"]}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS($g,"Nhom_KD_bo_sung")}}</label>
                                        <div class="col-sm-8">
                                            <select id="slAddSalesGroupID" name="slAddSalesGroupID" class="form-control selectpicker"
                                                    multiple data-actions-box="true" data-selected-text-format="count > 1">
                                                @foreach($sales as $row)
                                                    <option title="{{$row["GroupSalesName"]}}" value="{{$row["GroupSalesID"]}}">{{$row["GroupSalesName"]}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <input type="hidden" name="hdCreateUserID" value="{{$rsData["CreateUserID"] or ''}}">
                        <input type="hidden" name="hdCreateDate" value="{{$rsData["CreateDate"] or ''}}">
                        <input type="hidden" name="hdLeadID" value="{{$id}}">
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @if($id!="")
                            @if(isset($rsCheck['Status']) && $rsCheck['Status']==0)
                                <button type="button" id="frm_btnCancel"
                                        class="btn btn-default smallbtn pull-right" disabled>
                                    <span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                </button>
                                <button id="frm_btnSave"
                                        class="btn btn-default smallbtn pull-right mgr10" disabled><span
                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                            @endif
                            <button type="button" id="frm_btnEdit" class="btn btn-default smallbtn pull-left mgr10 ">
                                <span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                            </button>
                            @if($permission >3)
                                <button type="button" id="frm_btnDelete" onclick="deleteW17F2040('{{$id}}');"
                                        class="btn btn-default smallbtn pull-left confirmation-Delete">
                                    <span class="glyphicon glyphicon-bin text-black mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                                </button>
                            @endif
                        @else
                            <button type="button" id="frm_btnNext" onclick="frmW17F2041Reset();"
                                    class="btn btn-default smallbtn pull-right" disabled>
                                <span class="glyphicon glyphicon-more-items mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                            </button>
                            <button id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right mgr10"><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        @endif
                    </div>
                    <!-- /.box-footer -->
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
<script>
    $("#frmW17F2041").on('click', '#frm_btnEdit', function () {
        @if(isset($rsCheck['Status']) && $rsCheck['Status']!=0)
            $("#modalW17F2041").find("#err").html('{{$rsCheck['Message']}}');
        $("#modalW17F2041").find(".alert-danger").removeClass('hide');
        @else
            $("#frmW17F2041").find("#frm_btnCancel").removeAttr("disabled");
        $("#frmW17F2041").find("#frm_btnSave").removeAttr("disabled");
        $("#frmW17F2041").find("#frm_btnEdit").attr("disabled", "disabled");
        $("#frmW17F2041").find("#frm_btnDelete").attr("disabled", "disabled");
        $("#modalW17F2041").find(".alert-danger").addClass('hide');
        $("#modalW17F2041").find(".alert-success").addClass('hide');
        @endif
    });

    $("#frmW17F2041").on('click', '#frm_btnCancel', function () {
        normalMode();
    });

    function normalMode() {
        $("#frmW17F2041").find("#frm_btnCancel").attr("disabled", "disabled");
        $("#frmW17F2041").find("#frm_btnSave").attr("disabled", "disabled");
        $("#frmW17F2041").find("#frm_btnEdit").removeAttr("disabled");
        $("#frmW17F2041").find("#frm_btnDelete").removeAttr("disabled");
    }

    function frmW17F2041Reset() {
        $('#frmW17F2041')[0].reset();
        $("#frm_btnSave").removeAttr("disabled");
        $("#frm_btnNext").attr("disabled", "disabled");
        $("#txtLeadNo").focus();
        $("#modalW17F2041").find(".alert-success").addClass('hide');
        $("#modalW17F2041").find(".alert-danger").addClass('hide');
        $("#frmW17F2041").find(".fa-check").addClass("hide");
        $('#slAddSalesGroupID option').attr("selected",false);
        $('#slAddSalesGroupID').selectpicker('refresh');

    }
    @if(isset($rsCheck['Status'])==false || $rsCheck['Status']==0)
    $("#modalW17F2041").on('submit', '#frmW17F2041', function (e) {
        e.preventDefault();
        $("#frmW17F2041").find("#frm_btnSave").attr("disabled", "disabled");
        $("#frmW17F2041").find("#frm_btnCancel").attr("disabled", "disabled");
        var add = $("#frmW17F2041").find('#slAddSalesGroupID').val();
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW17F2041").serialize() + "&add=" + add,
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.code == 1) {
                    $("#modalW17F2041").find(".alert-danger").addClass('hide');
                    $("#modalW17F2041").find(".alert-success").removeClass('hide');
                    @if ($id == "")
                        update4ParamGrid($("#pqgrid_W17F2040"), result, "add");
                    $("#frm_btnNext").removeAttr("disabled");
                    @else
                        update4ParamGrid($("#pqgrid_W17F2040"), result, "edit");
                    normalMode();
                    @endif
                } else if (result.code == 0) {
                    $("#modalW17F2041").find(".alert-danger").html(result.mess);
                    $("#modalW17F2041").find(".alert-danger").removeClass('hide');
                    $("#modalW17F2041").find(".alert-success").addClass('hide');
                    $("#frm_btnSave").removeAttr("disabled");
                    $("#frm_btnCancel").removeAttr("disabled");
                    $("#txtLeadNo").focus();
                }
            }
        });
    });
    @endif
        $(document).ready(function () {
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi'
        });
        $(".selectpicker").selectpicker();
        var add = "{{$rsData["AddSalesGroupID"] or ''}}";
        var arr = add.split(";");
        $(".selectpicker").selectpicker('val', arr);

        $("#frmW17F2041").find("#txtLeadNo").blur(function () {
            checktxtLeadNo();
        });
        $("#frmW17F2041").find("#txtLeadNo").focus();
    });

    function checktxtLeadNo() {
        var str = $("#frmW17F2041").find("#txtLeadNo").val();
        var regex = /[^\w]/gi;

        if (regex.test(str) == true) {
            $("#modalW17F2041").find("#err").html('{{Helpers::getRS($g,'Ma_co_ky_tu_khong_hop_le')}}');
            $("#modalW17F2041").find(".alert-danger").removeClass('hide');
            //Set timeout for Firefox and IE
            setTimeout(function () {
                $("#txtLeadNo").focus();
            }, 10);
            return false;
        }
        $("#modalW17F2041").find(".alert-danger").addClass('hide');
        return true;
    }

</script>

