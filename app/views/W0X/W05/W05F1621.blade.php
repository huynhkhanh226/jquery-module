<section class="content" id="secW05F1621">
    <form class="form-horizontal" id="frmW05F1621">
        <div class="box-body ctrlNM">
            <div class="form-group">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label lbl-normal">{{Helpers::getRS($g,"Thoi_gian")}}</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" name="slTime" id="slTime">
                                @foreach($listTime as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="control-label lbl-normal">{{Helpers::getRS($g,"Trang_thai_don_hang")}}</label>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="slStatus" id="slStatus">
                        @foreach($listStatus as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label lbl-normal">{{Helpers::getRS($g,"Tim_kiem")}}</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" name="slSearch" id="slSearch">
                                @foreach($listSearch as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="txtSearch" id="txtSearch">
                </div>
                <div class="col-md-1 pdl0">
                    <button type="button" onclick="W05F1621Search()" class="pull-left"><i
                                class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </form>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            @if (Session::get($pForm) >= 2)
                <a onclick="showFormDialog('{{url("W05F1602/view/D05F1602/3")}}','modalW05F1602')"
                   class="btn btn-default smallbtn">
                    <span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,'Them_moi1')}}
                </a>
            @endif
            @if (Session::get($pForm) >= 1)
                <a class="btn btn-default smallbtn" onclick="W05F1621ExportExcel()">
                    <span class="fa fa-file-excel-o"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                </a>
            @endif
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12" id="gridW05F1621">
            <div id="pqgrid_W05F1621">

            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var $titleSO = ['#', '{{Helpers::getRS($g,'Ngay_don_hang')}}', '{{Helpers::getRS($g,'So_don_hang')}}', '{{Helpers::getRS($g,'Ten_khach_hang')}}',
        '{{Helpers::getRS($g,'Loai_tien')}}', '{{Helpers::getRS($g,'Tong_tien')}}', '{{Helpers::getRS($g,'Trang_thai')}}', '{{Helpers::getRS($g,'Ghi_chu')}}'];
    var _data = {};
    var _dataIndx = ['QuotationID', "VoucherDate", "VoucherNum", "ObjectName", "CurrencyID", "TotalAmount", "StatusName", "Description"];
    var _align = ['left', 'center', 'center', 'left', 'center', 'right', 'center', 'left'];
    $(function () {
        var data = {};
        var obj = {
            width: $("#secW05F1621").width(),
            height: $("#divD05F1621_W05F1621_W05F1621").height() - 150,
            numberCell: {resizable: true, title: "#"},
            selectionModel: {type: 'row', mode: 'single'},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            //hwrap: false,
            //wrap: false,
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'}

        };
        obj.colModel = [
            {
                title: "", align: "center", width: 10, dataIndx: "QuotationID", isExport: false, render: function (ui) {
                return '<div title="{{Helpers::getRS($g,'Xem')}}/{{Helpers::getRS($g,'Sua')}}/{{Helpers::getRS($g,'Xoa')}}" style="padding-top: 5px;"><a onclick="showFormDialog(\'{{url("W05F1602/view/$pForm/3")}}/' + ui.cellData + '\' ,\'modalW05F1602\')"><i class="glyphicon glyphicon-search text-yellow"></i></a></div>';
            }
            },
            {
                title: $titleSO[1],
                align: "center",
                width: 120,
                dataIndx: "VoucherDate",
                dattaType: "date",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: $titleSO[2], width: 160, dataIndx: "VoucherNum",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: $titleSO[3], width: 200, dataIndx: "ObjectName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: $titleSO[4], width: 80, dataIndx: "CurrencyID", align: "center", cls: 'text-center',
                filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "CurrencyID",
                    labelIndx: "CurrencyID",
                    listeners: ['change']
                }
            },

            {
                title: $titleSO[5],
                minWidth: 140,
                dataIndx: "TotalAmount",
                align: "right",
                cls: 'text-right',
                dataType: "float",
                render: function (ui) {
                    var rowData = ui.rowData;
                    var num = '{{Session::get('W91P0000')['DecimalPlaces']}}';
                    return format2(rowData["TotalAmount"], '', parseInt(num));
                },
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },

            {
                title: $titleSO[6], width: 140, dataIndx: "StatusName", align: "center",
                filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "StatusName",
                    labelIndx: "StatusName",
                    listeners: ['change']
                }
            },
            {
                title: $titleSO[7],
                minWidth: 200,
                dataIndx: "Description",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ];

        obj.complete = function(){
            $("#pqgrid_W05F1621").pqGrid( "setSelection", {rowIndx:0} );
        };
        obj.dataModel = {data: data};
        $("#pqgrid_W05F1621").pqGrid(obj);

    });
    var W05F1621ExportExcel = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#pqgrid_W05F1621"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#pqgrid_W05F1621").pqGrid("option", "dataModel.data"));

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
                    downloadLink.download = "so_" + new Date().getTime() + ".xls";
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
    var W05F1621Search = function () {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            dataType: 'json',
            url: "{{Request::url()}}",
            data: $("#frmW05F1621").serialize(),
            success: function (data) {
                $(".l3loading").addClass('hide');
                _data = data;
                $("#pqgrid_W05F1621").pqGrid("option", "dataModel.data", data);

                var column = $("#pqgrid_W05F1621").pqGrid("getColumn", {dataIndx: "StatusName"});
                var filter = column.filter;
                filter.cache = null;
                filter.options = $("#pqgrid_W05F1621").pqGrid("getData", {dataIndx: ["StatusName"]});

                column = $("#pqgrid_W05F1621").pqGrid("getColumn", {dataIndx: "CurrencyID"});
                filter = column.filter;
                filter.cache = null;
                filter.options = $("#pqgrid_W05F1621").pqGrid("getData", {dataIndx: ["CurrencyID"]});

                $("#pqgrid_W05F1621").pqGrid('refreshDataAndView');
               //An cot dau tien neu per < 1
                @if (Session::get($pForm) < 1)
                    var colM = $("#pqgrid_W05F1621").pqGrid("option", "colModel");
                    colM[0].hidden = true;
                    $("#pqgrid_W05F1621").pqGrid("option", "colModel", colM);
                @endif
            }
        });

    };

    function resizePqGrid() {
        var width = $("#pqgrid_W05F1621").pqGrid("option", "width");
        if ($("body").hasClass('sidebar-collapse'))
            $("#pqgrid_W05F1621").pqGrid({width: width + 200});
        else
            $("#pqgrid_W05F1621").pqGrid({width: width - 200});
        $("#pqgrid_W05F1621").pqGrid('refreshDataAndView');
    }
</script>
