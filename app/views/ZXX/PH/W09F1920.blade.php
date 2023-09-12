<section class="content" id="secW09F1920">
    <form class="form-horizontal" id="frmW09F1920" name="frmW09F1920">
        <div class="box-body">
            <div class="row" style="margin-bottom: -20px !important;">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-3 liketext lbl-normal pdl5">{{Helpers::getRS($g,"Trang_thai")}}</label>
                        <div class="col-sm-8">
                            <select id="slIsEmpWork" name="slIsEmpWork" class="form-control">
                                <option value="1">{{Helpers::getRS($g,"Nhan_vien_dang_lam_viecU")}}</option>
                                <option value="2">{{Helpers::getRS($g,"Nhan_vien_da_nghi_viecU")}}</option>
                                <option value="0">{{Helpers::getRS($g,"Tat_ca_Web")}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 liketext lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                        <div class="col-sm-9">
                            <select id="slDepartmentID" name="slDepartmentID"
                                    class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                    required>
                                @foreach($depart as $row)
                                    <option value="{{$row['DepartmentID']}}">{{$row['DepartmentName']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 pdr5">
                    <button type="submit" id="btnFilter"
                            class="btn btn-default smallbtn pull-right confirmation-save"><span
                                class="digi digi-filter"></span> {{Helpers::getRS($g,"Loc")}}
                    </button>
                </div>
            </div>
            <div class="form-group" style="padding-top: -10px !important;">
                <div class="col-md-6 col-xs-12 pdl5">
                    @if (Session::get($pForm) >= 2)
                        <a onclick="showFormDialog('{{url("/W09F1921/".$pForm."/add")}}','modalW09F1921')"
                           class="btn btn-default smallbtn">
                            <span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,'Them_moi1')}}
                        </a>
                    @endif
                </div>
                <div class="col-md-6 pdr5 text-right hide W09F1920F12">
                    <a class="btn btn-default smallbtn" onclick="W09F1920ExportExcel()">
                        <span class="fa fa-file-excel-o"></span>
                        &nbsp;{{Helpers::getRS($g,"Xuat_Excel_U")}}
                    </a>
                    <select id="W09F1920F12" multiple="multiple">
                        <option value="View" selected disabled>{{Helpers::getRS($g,'Lich_su_HDLD')}}</option>
                        <option value="EmployeeID" selected disabled>{{Helpers::getRS($g,'Ma_nhan_vien')}}</option>
                        <option value="EmployeeName" selected disabled>{{Helpers::getRS($g,'Ho_va_ten')}}</option>
                        <option value="SexName">{{Helpers::getRS($g,'Gioi_tinh')}}</option>
                        <option value="BirthDate">{{Helpers::getRS($g,'Ngay_sinh')}}</option>
                        <option value="DateJoined">{{Helpers::getRS($g,'Ngay_vao_lam')}}</option>
                        <option value="DepartmentID">{{Helpers::getRS($g,'Phong_ban')}}</option>
                        <option value="DepartmentName">{{Helpers::getRS($g,'Ten_phong_ban')}}</option>
                        <option value="DutyID">{{Helpers::getRS($g,'Chuc_vu')}}</option>
                        <option value="DutyName">{{Helpers::getRS($g,'Ten_chuc_vu')}}</option>
                        <option value="WorkID">{{Helpers::getRS($g,'Cong_viec')}}</option>
                        <option value="WorkName">{{Helpers::getRS($g,'Ten_cong_viec')}}</option>
                        <option value="DirectManagerName">{{Helpers::getRS($g,'Nguoi_quan_ly_truc_tiep')}}</option>
                        <option value="CountryName">{{Helpers::getRS($g,'Quoc_tich')}}</option>
                        <option value="Pager">{{Helpers::getRS($g,'Mobile')}}</option>
                        <option value="CompanyTelephone">{{Helpers::getRS($g,'So_noi_bo')}}</option>
                        <option value="UserID">{{Helpers::getRS($g,'Nguoi_dung')}}</option>
                        <option value="Disabled">{{Helpers::getRS($g,'Da_nghi_viec')}}</option>
                        <option value="DateLeft">{{Helpers::getRS($g,'Ngay_nghi_viec')}}</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <div class="l3-loading hide" style="background-color: #FFffff">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</section>
<div></div>
<section class="content" style="margin-top: -20px">
    <div class="row">
        <div class="col-md-12" id="gridW09F1920"></div>
    </div>
</section>
<script type="text/javascript">
    var colhideW09F1920 = {{json_encode($arrColHide)}};
    var wd = [50, 110, 170, 70, 80, 80, 110, 170, 110, 170, 110, 170, 170, 150, 100, 100, 90, 80, 90];
    var isHiddenColumn = function (el) {
        return colhideW09F1920.contains(el);
    };
    $("#frmW09F1920").on('submit', function (e) {
        e.preventDefault();
        var bReload = ($("#gridW09F1920").html() != '');
        if (bReload)
            $("#pqgrid_W09F1920").pqGrid('showLoading');
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW09F1920").serialize() + '&reload=' + bReload,
            success: function (data) {
                if (!bReload) {
                    $('.W09F1920F12').removeClass('hide');
                    $("#gridW09F1920").html(data);
                } else {
                    var obj = $.parseJSON(data);
                    $("#pqgrid_W09F1920").pqGrid("option", "dataModel.data", obj);
                    $("#pqgrid_W09F1920").pqGrid('refreshDataAndView');
                    $("#pqgrid_W09F1920").pqGrid('hideLoading');
                }

                $('#btnW09F1920ExportExcel').removeAttr('disabled');
            }
        });
    });

    $(document).ready(function () {
        $("#frmW09F1920").find("#slDepartmentID").select2();

        $("#secW09F1920").find('#W09F1920F12').multiselect({
            includeSelectAllOption: true,
            selectAllValue: 0,
            maxHeight: documentHeight - 200,
            dropUp: false,
            dropRight: false,
            disabled: true,
            displayText: "{{Helpers::getRS($g,"Hien_thi")}}",
            selectAllText: '{{Helpers::getRS($g,"Tat_ca_Web")}}',
            buttonWidth: '170px',
            onInitialized: function (select, container) {
                $(container).find('.multiselect-container').append('<li><button type="button" id="frm_btnSaveW09F1920" class="btn btn-default smallbtn pull-right"><span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS(0,"Luu")}}</button></li>');
            },
            onChange: function () {
                colhideW09F1920 = [];
                var colM = $("#pqgrid_W09F1920").pqGrid("option", "colModel");
                $("#secW09F1920").find('#W09F1920F12 option').each(function (index, brand) {
                    column = $("#pqgrid_W09F1920").pqGrid("getColumn", {dataIndx: $(this).attr('value')});
                    if ($(this).is(':selected')) {
                        column.hidden = false;
                        column.width = wd[index];
                    }
                    else {
                        colhideW09F1920.push($(this).attr('value'));
                        column.hidden = true;
                    }
                });
                $("#pqgrid_W09F1920").pqGrid("option", "colModel", colM);
                $("#pqgrid_W09F1920").pqGrid("refreshDataAndView");
            },
            onSelectAll: function (checked) {
                colhideW09F1920 = [];
                var colM = $("#pqgrid_W09F1920").pqGrid("option", "colModel");
                if (colM.length > 0) {
                    $("#secW09F1920").find('#W09F1920F12 option').each(function (index, brand) {
                        colM[index].hidden = $(this)[0].disabled == true ? false : !checked;
                        colM[index].width = wd[index];
                        if (checked == false)
                            colhideW09F1920.push($(this).attr('value'));
                    });
                    $("#pqgrid_W09F1920").pqGrid("option", "colModel", colM);
                    $("#pqgrid_W09F1920").pqGrid("refreshDataAndView");
                }

            }
        });
        $("#secW09F1920").find('#W09F1920F12').multiselect('selectAll', false).multiselect('deselect', colhideW09F1920).multiselect('updateButtonText');
    });

    $("#frm_btnSaveW09F1920").on('click', function (e) {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: {action: 'saveF12', arrHide: colhideW09F1920},
            success: function (data) {
                if (data == 1) {
                    save_ok();
                }
                else {
                    alert_error(data);
                }
            }
        });
    });

    function deleteW09F1921(id) {
        ask_delete(function () {
            $.ajax({
                method: "DELETE",
                url: "{{Request::url()}}",
                data: {id: id},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    if (obj.code == 1) {
                        update4ParamGrid($(document).find("#pqgrid_W09F1920"), null, 'delete');
                        $("#modalW09F1921").modal("hide");
                    }
                    else {
                        alert_error(obj.mess);
                    }
                }
            });
        });
    }
    ;

    var W09F1920ExportExcel = function () {
        var blob = $("#pqgrid_W09F1920").pqGrid("exportData", {format: 'xlsx', sheetName: "Data"});
        if (typeof blob === "string") {
            blob = new Blob([blob]);
        }
        saveAs(blob, "Employee File.xlsx");

    };
</script>
