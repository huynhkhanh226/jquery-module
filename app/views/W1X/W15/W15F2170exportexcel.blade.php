<div class="modal fade" id="modalexportEXCEL" role="dialog">
    <div class="modal-dialog" id="frmXuatExcel" style="width: 400px">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          {{Helpers::generateHeading(Helpers::getRS(4,'Xuat_du_lieu_dang_ky_nghi_phep'),"W15F2170")}}

        </div>
        <div class="modal-body">
        <div class="box-body">
         <div class="row form-group">
            <div class="col-md-3">
                <label class="lbl-normal pdr0 ">{{Helpers::getRS(4,"Tu_ngay")}}</label>
            </div>
            <div class="col-md-9">
                <div class="input-group" id ="hienLich">
                    <div id="dateW15F2170" class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input class="col-md-12 active" id="txtDateEX" type="text" name="txtDateEX" readonly="true" value="{{date('01/m/Y').' - '.date('t/m/Y')}}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="lbl-normal pdr0 ">{{Helpers::getRS(4,"Trang_thai")}}</label>
            </div>
            <div class="col-md-9">
                {{ Form::select("slduyetEX", $AppStatus ,0,["class" => "pecent-100", "id" => "slduyetEX"])}}
            </div>
        </div>
        </div>
        <div class="box-footer">
        <button type="button" class="btn btn-default smallbtn pull-right mgl10" onclick="xuatRaFile()"><span class="fa fa-file-excel-o mgr5"></span>{{Helpers::getRS(4,"Xuat_FileU")}}</button>

        </div>
        </div>
        <div class="modal-footer" >
             <div class="alert alert-success alert-dismissable hide">
             <i class="icon fa fa-check"></i> {{Helpers::getRS(4,"Du_lieu_da_duoc_xuat")}}
                      </div>
        <div id="gridxuatEX" class="hide" style="margin:auto;"></div>
      </div>

    </div>
  </div>

</div>

<script>
$("#dateW15F2170").click(function(){
    $('#txtDateEX').click();
});

$(document).ready(function() {
        $('#txtDateEX').daterangepicker({format: 'DD/MM/YYYY'});


        var obj = {
                                      width: "100%",
                                      height: 400,
                                       showBottom: false,
                                       showTitle: false
                                      , scrollModel: { autoFit: true },
                                        selectionModel: { type: 'cell' }
                                      ,postRenderInterval: -1,
                                      editable: false,
                                      filterModel: { on: true, mode: "AND", header: true },
                                      pageModel: { type: "local", rPP: 10 }
                                  };

                                  obj.colModel = [

                                      { title: "Mã NV", dataType: "string", dataIndx: "EmployeeID", minWidth: 50, resizable: true, align: "center"},
                                      { title: "Họ và Tên", dataType: "string", dataIndx: "EmployeeName", minWidth: 50, resizable: false, align: "center"},
                                      { title: "Chờ Duyệt", dataType: "integer", dataIndx: "Pendingforapproval", minWidth: 50, resizable: false, align: "center"},
                                      { title: "Đã Duyệt", dataType: "integer", dataIndx: "Approval", minWidth: 50, resizable: false, align: "center"},
                                      { title: "Từ Chối", dataType: "integer", dataIndx: "NotApproval", minWidth: 50, resizable: false, align: "center"},
                                      { title: "Hủy", dataType: "integer", dataIndx: "Cancel", minWidth: 50, resizable: false, align: "center"},
                                      { title: "Từ ngày", dataType: "date", dataIndx: "DateFrom", minWidth: 50, resizable: false, align: "center"},
                                      { title: "Đến ngày", dataType: "date", dataIndx: "DateTo", width: '38', align: "center"},
                                      { title: "Số lượng", dataType: "integer", align: "center", dataIndx: "Quantity", align: "center",
                                        format: "#,##0.00",
                                        render: function (ui) {
                                                var rowData = ui.rowData;
                                                return {
                                                    text: format2(rowData["Quantity"], '', 2)
                                                }
                                            }
                                      },
                                      { title: "Loại phép", dataType: "string", dataIndx: "LeaveTypeName", minWidth: 50, resizable: true, align: "center"},
                                      { title: "Lý do nghỉ phép", dataType: "string", dataIndx: "Reason", minWidth: 50, resizable: false, align: "center"},
                                      { title: "Ghi chú", dataType: "string", dataIndx: "Note", minWidth: 50, resizable: true, align: "center"},
                                      { title: "Ghi chú cáp duyệt", dataType: "string", dataIndx: "NoteApp", minWidth: 50, resizable: false, align: "center"}


                                  ];

                                  obj.dataModel = {

                                     data: [],
                                      location: "local",
                                      sorting: "local",
                                      sortDir: "down",
                                      scrollModel: { autoFit: true },
                                      virtualX: true
                                  };
                                  var $grid = $("#gridxuatEX").pqGrid(obj);
    });
function xuatRaFile(){
        var datef = $('#txtDateEX').data('daterangepicker').startDate.format('DD/MM/YYYY');
        var datet = $('#txtDateEX').data('daterangepicker').endDate.format('DD/MM/YYYY');
        var trangThai = $('#slduyetEX').val();
        $.ajax({
            method: "POST",
            url: '{{url("/W15F2170/xuatRaFileEX")}}',
            data: $("#frmXuatExcel").serialize() + '&datefrom='+datef+'&dateto='+datet +'&trangThai='+trangThai ,
            success: function (data) {
                console.log(data);
               $("#gridxuatEX").pqGrid( "option", "dataModel.data", JSON.parse(data) );
                W05F1621ExportExcel();
                $(".modal-footer").find(".alert-success").removeClass('hide');
            }
        });
}

var W05F1621ExportExcel = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridxuatEX"), _title, _dataIndx, _align, _format, _format);
        var _data = JSON.stringify($("#gridxuatEX").pqGrid("option", "dataModel.data"));

        $.ajax({
            method: "POST",
            data: {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    var row = getRowSelection($("#gridW75F3801_Course"));
                    var employeeID = '{{(Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID}}';
                    downloadLink.download = "Du_lieu_dang_ky_nghi_phep.xls";
                    downloadLink.innerHTML = "Download File";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };
</script>