<section class="content" id="secW09F4292">
    <form class="form-horizontal" id="frmW09F4292" name="frmW09F4292" method="post">
        <div class="row">
            <div class="col-md-5">
                <div class="radio pdt5">
                    <label>
                        <input name="optIsValid" id="optIsValid0" value="1" checked type="radio">
                        {{Helpers::getRS($g,"Hien_thi_tat_ca_du_an_con_hieu_luc")}}
                    </label>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-sm-2">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Du_an")}}</label>
                    </div>
                    <div class="col-sm-4">
                        <select id="slProjectID" name="slProjectID" class="form-control" required>
                            @foreach($pro as $row)
                                <option value="{{$row['ProjectID']}}" data-name="{{$row['ProjectName']}}"
                                        data-comid="{{$row['CompanyID']}}"
                                        data-comname="{{$row['CompanyName']}}">{{$row['ProjectID']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 pdl0">
                        <input type="text" class="form-control" id="txtProjectName" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pdt5">
            <div class="col-md-5">
                <div class="radio pdt5">
                    <label>
                        <input name="optIsValid" id="optIsValid1" value="2" type="radio">
                        {{Helpers::getRS($g,"Hien_thi_tat_ca_du_an_het_hieu_luc")}}
                    </label>
                </div>
            </div>
            <div class="col-md-7">
               <div class="row">
                   <div class="col-sm-4">
                       <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ty_gia")}}</label>
                   </div>
                   <div class="col-sm-2">
                       <label class="liketext">{{$exchangeRate}}</label>
                   </div>
               </div>
            </div>
        </div>
        <div class="row pdt5">
            <div class="col-md-2">
                <div class="radio pdt5">
                    <label>
                        <input name="optIsValid" id="optIsValid2" value="0" type="radio">
                        {{Helpers::getRS($g,"Thoi_gian_hieu_luc")}}
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="txtDateValid" name="txtDateValid" disabled>
                </div>
            </div>
        </div>
        <div class="row pdt5">
            <div class="col-md-3">
                <div class="radio pdt5">
                    <label>
                        <input name="optIsValid" id="optIsValid3" value="3" type="radio">
                        {{Helpers::getRS($g,"Thoi_gian_phat_sinh_chi_phi_luong")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="txtDate" name="txtDate" value="{{date('d/m/Y')}}" disabled>
                </div>
            </div>
            <div class="col-md-7">
                <button type="button" id="btnExcelW09F4292" class="btn btn-default smallbtn pull-right" disabled>
                    <span class="fa fa-file-excel-o"></span> {{Helpers::getRS($g,"Xuat_Excel_U")}}</button>
                @if($perD09F4292>=2)
                <button type="button" id="btnCreateVoucherW09F4292" class="btn btn-default smallbtn pull-right mgr5" disabled>
                    <span class="fa fa-plus"></span> {{Helpers::getRS($g,"Tao_phieu")}}</button>
                @endif
                <button type="submit" class="btn btn-default smallbtn pull-right mgr5"><span
                            class="digi digi-filter"></span>
                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>


            </div>
        </div>
    </form>
    <div class="l3-loading hide" style="background-color: #FFffff">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
    <section id="divDetailW09F4292" style="margin-left: 0px;margin-right: 0px;margin-top: 10px">
    </section>
    @if($perD09F4292>=2)
    <div class="modal draggable fade" id="mCreateVoucherW09F4292" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="frmCreateVoucherW09F4292" name="frmCreateVoucherW09F4292">
                    <div class="modal-header">
                        {{Helpers::generateHeading(Helpers::getRS($g,"Tao_phieu"),"",false)}}
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_phieu")}}</legend>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Loai_phieu")}}</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <select id="slVoucherTypeID" name="slVoucherTypeID"
                                                                class="form-control"
                                                                required>
                                                            <option></option>
                                                            @foreach($vouchertype as $key => $value)
                                                                <option value="{{$key}}">{{$key.' - '.$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"So_phieu")}}</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="txtVoucherID" name="txtVoucherID"
                                                               class="form-control" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pdt5">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Nguoi_lap")}}</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="ps_relative" style="width: 100%;" id="dcomboEmployeeID" required></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pdl0">
                                                <input type="text" id="txtEmployeeName" name="txtEmployeeName" value="{{Session::get("W91P0000")['CreatorNameHR']}}"
                                                       class="form-control" required readonly>
                                            </div>
                                        </div>
                                        <div class="row pdt5">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Dien_giai")}}</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" id="txtNotes" name="txtNotes" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <input type="hidden" id="hdDateW09F4292" name="hdDateW09F4292" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default smallbtn btnSaveW09F4292"
                                    onclick="validNavigation=true"><span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}</button>
                            <button type="button" class="btn btn-default smallbtn"
                                    id="btnCreateVoucherW09F4292W09F4292">{{Helpers::getRS($g,"DongU1")}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endif
</section>
{{HTML::script('packages/default/L3/js/combo_grid.js')}}
<script type="text/javascript">
    var bchangeW09F4292 = 1;

    $("#frmW09F4292").on('change', '#slProjectID', function () {
        $("#frmW09F4292").find('#btnCreateVoucherW09F4292').prop('disabled', true);
        $('#hdDateW09F4292').val('');
        $("#frmW09F4292").find('#txtProjectName').val($(this).find('option:selected').attr('data-name'));
        $("#frmW09F4292").find('#txtCompanyID').val($(this).find('option:selected').attr('data-comid') + ' - ' + $(this).find('option:selected').attr('data-comname'));
    });

    $("#frmW09F4292").find('#slProjectID').trigger('change');

    $("#frmW09F4292").on('change', 'input:radio[name="optIsValid"]', function () {
        $("#frmW09F4292").find('#btnCreateVoucherW09F4292').prop('disabled', true);
        $('#hdDateW09F4292').val('');
        if ($(this).val() == 0) {
            $("#frmW09F4292").find('#txtDateValid').prop('disabled', false);
            $("#frmW09F4292").find('#txtDateValid').prop('required', true);
        } else {
            $("#frmW09F4292").find('#txtDateValid').val('');
            $("#frmW09F4292").find('#txtDateValid').prop('disabled', true);
            $("#frmW09F4292").find('#txtDateValid').prop('required', false);
        }
        if ($(this).val() == 3) {
            $("#frmW09F4292").find('#txtDate').prop('disabled', false);
            $("#frmW09F4292").find('#txtDate').prop('required', true);
        } else {
            $("#frmW09F4292").find('#txtDate').val('');
            $("#frmW09F4292").find('#txtDate').prop('disabled', true);
            $("#frmW09F4292").find('#txtDate').prop('required', false);
        }
    });

    var dataW09F4292;
    $("#frmW09F4292").on('submit', function (e) {
        e.preventDefault();
        if (bchangeW09F4292 == 1)
            $("#secW09F4292 .l3-loading").removeClass("hide");
        else
            $("#pqgrid_W09F4292").pqGrid("showLoading");
        var datef = $("#frmW09F4292").find('#txtDateValid').data('daterangepicker').startDate.format('DD/MM/YYYY');
        var datet = $("#frmW09F4292").find('#txtDateValid').data('daterangepicker').endDate.format('DD/MM/YYYY');
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW09F4292").serialize() + "&change=" + bchangeW09F4292 + '&datef=' + datef + '&datet=' + datet,
            success: function (data) {
                var currentObject = $.parseJSON(data);
                dataW09F4292 = currentObject.data[0];
                if (bchangeW09F4292 == 1)
                    $("#divDetailW09F4292").html(currentObject.view);
                else {
                    $("#pqgrid_W09F4292").pqGrid("option", "dataModel", {data: currentObject.data});
                    $("#pqgrid_W09F4292").pqGrid("hideLoading");
                    $("#pqgrid_W09F4292").pqGrid("refreshDataAndView");
                }
                $("#secW09F4292 .l3-loading").addClass("hide");
                $("#btnExcelW09F4292").removeAttr("disabled");
                var allow = dataW09F4292['IsCreateVoucherNo'];
                if (allow==1){
                    $('#btnCreateVoucherW09F4292').prop('disabled', false);
                    $('#hdDateW09F4292').val($("#frmW09F4292").find('#txtDate').val());
                }else{
                    $("#frmW09F4292").find('#btnCreateVoucherW09F4292').prop('disabled', true);
                    $('#hdDateW09F4292').val('');
                }
                bchangeW09F4292 = 0;
            }
        });
    });

    $("#btnExcelW09F4292").on("click", function () {
        W09F4292ExportExcel();
    });

    var W09F4292ExportExcel = function () {
        var blob = $("#pqgrid_W09F4292").pqGrid("exportData", {format: 'xlsx', render: true, sheetName: "Data"});
        if (typeof blob === "string") {
            blob = new Blob([blob]);
        }
        saveAs(blob, "W09F4292.xlsx");
    };

    $("#frmW09F4292").find("#slProjectID").select2();

    $("#frmW09F4292").find('#txtDateValid').daterangepicker({format: 'DD/MM/YYYY'});
    $("#frmW09F4292").find('#txtDate').datepicker({
        format: 'dd/mm/yyyy',
        language: 'vi',
        autoclose: true,
        showOnFocus: false
    });

    @if($perD09F4292>=2)//Có quyền tạo phiếu
    $('#frmCreateVoucherW09F4292').on('change', '#slVoucherTypeID', function () {
        $('#frmCreateVoucherW09F4292').find('#txtVoucherID').val('');
        var type = $(this).val();
        if (type == "")
            $('#frmCreateVoucherW09F4292').find('#txtVoucherID').val('');
        else {
            $.ajax({
                method: "POST",
                url: '{{Request::url()}}',
                data: {do: 'getVoucherNumber', type: type},
                success: function (data) {
                    $("#frmCreateVoucherW09F4292 #txtVoucherID").val(data);
                },
                error: function (jqXHR, exception) {
                    var obj = jQuery.parseJSON(jqXHR.responseText);
                    alert_error(obj.error.message, function () {
                        $("#frmCreateVoucherW09F4292 #txtVoucherID").val('');
                    });
                }
            });
        }
    });

    $("#frmCreateVoucherW09F4292").on('submit', function (e) {
        e.preventDefault();
        var vouno = $('#frmCreateVoucherW09F4292').find('#txtVoucherID').val();
        if (vouno != "") {
            $.ajax({
                method: "POST",
                url: "{{Request::url()}}",
                data: $("#frmCreateVoucherW09F4292").serialize() + "&do=saveno&gdata="+JSON.stringify(dataW09F4292),
                success: function (data) {
                     var currentObject = $.parseJSON(data);
                     if (currentObject.code==0)
                         alert_info(currentObject.mess);
                     else{
                         save_ok(function () {
                             $('#mCreateVoucherW09F4292').modal('hide');
                             $('#frmCreateVoucherW09F4292').find('#txtVoucherID').val('');
                             $('#frmCreateVoucherW09F4292').find('#slVoucherTypeID').val('');
                             $('#frmCreateVoucherW09F4292').find('#txtNotes').val('');
                         },null,'{{Helpers::getRS($g,"Du_lieu_da_duoc_luu_thanh_cong")}}');
                     }
                }
            });
        }
    });

    $('#btnCreateVoucherW09F4292').on('click', function () {
        $('#frmCreateVoucherW09F4292').find('#txtVoucherID').val('');
        $('#frmCreateVoucherW09F4292').find('#slVoucherTypeID').val('');
        $('#frmCreateVoucherW09F4292').find('#txtNotes').val('');
        $('#mCreateVoucherW09F4292').modal('show');
    });

    $("#frmCreateVoucherW09F4292").find("#dcomboEmployeeID").DigiNetComboGrid({
        topContain: "mCreateVoucherW09F4292",
        textID: "txtEmployeeID",
        synElement: [{elId: "txtEmployeeName"}],
        textValue: "{{Session::get("W91P0000")['CreatorHR']}}",
        textRequireMessage: "{{Helpers::getRS($g,'Ban_phai_nhap') . " ". Helpers::getRS($g,'Nguoi_lap')}}",
        gridID: "gridEmployeeIDW09F4292",
        gridConfig: {
            width: 400, height: 300,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            synElement: [{elId: "txtEmployeeID", dataIndx: "ObjectID"}, {
                elId: "txtEmployeeName",
                dataIndx: "ObjectName"
            }],
            focusElement: "txtEmployeeID",
            colModel: [

                {title: "{{Helpers::getRS(0,'Ma_nguoi_lap')}}", width: 100, dataIndx: "ObjectID"},
                {title: "{{Helpers::getRS(0,'Ten_nguoi_lap')}}", width: 200, dataIndx: "ObjectName"}

            ],
            dataModel: {data: {}},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
        },
        request: {
            url: '{{Request::url()}}',
            action: 'getListPreparedBy'
        },
        required: true
    });
    @endif
</script>

