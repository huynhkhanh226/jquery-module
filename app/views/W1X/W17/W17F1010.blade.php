<div class="modal fade" id="modalW17F1010" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading($title,"W17F1010",true,"")}}
            </div>
            <div class="modal-body">
                <section class="content" id="secW17F1010">
                    <form class="form-horizontal" id="frmW17F1010" name="frmW17F1010">
                        <div class="box-body">
                            <div class="form-group mgb5">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,"Tim_kiem")}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="cboStrSearchW17F1010" name="cboStrSearchW17F1010" class="form-control">
                                                @foreach($dsSearch as $row)
                                                    <option value="{{$row['SearchFieldID']}}">{{$row['SearchFieldName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="txtStrSearchW17F1010" name="txtStrSearchW17F1010"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-1 text-right pdl5 pdr5">
                                            <button type="submit" id="btnFilterW17F1010" class="btn btn-default smallbtn"><span
                                                        class="fa fa-search"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </form>
                </section>
                <section class="content" style="margin-top: -15px">
                    <div class="row">
                        <div class="col-md-12 detailW17F1010">
                            <div id="gridW17F1010"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function () {
        var obj = {
            width: '100%',
            height: $(document).height() - 155,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none', flexContent: false},
            postRenderInterval: -1,
            dataType: "JSON",
            freezeCols: 1,
            toolbar: {
                items: [
                    @if ($perD17F1010 >=2)
                    {
                        type: 'button',
                        icon: 'ui-icon-plus',
                        label: '{{Helpers::getRS($g,'Them_moi1')}}',
                        listener: function () {
                            showFormDialogPost('{{url("/W17F1011/".$pForm."/$g/add")}}', 'modalW17F1011', {formCall: "W17F1010"},9)
                        }
                    },
                    @else{
                        type: 'button',
                        cls: "ui-disabled-btn",
                        label: "{{Helpers::getRS($g,'Them_moi1')}}",
                        listener: function () {

                        }
                    },
                    @endif

                    {
                        type: 'button',
                        icon: 'ui-icon-arrowthickstop-1-s',
                        label: '{{Helpers::getRS($g,'Xuat_Excel_U')}}',
                        cls: 'pull-right',
                        listener: function () {
                            var blob = $("#gridW17F1010").pqGrid("exportData", {format: 'xlsx', sheetName: "Data"});
                            if (typeof blob === "string") {
                                blob = new Blob([blob]);
                            }
                            saveAs(blob, "CompanyList.xlsx");
                        }
                    }
                ]
            }
        };
        obj.colModel = getColModels({{ json_encode($dsFields) }});
        {{--obj.colModel = [--}}
            {{--{--}}
                {{--title: "",--}}
                {{--minWidth: 80,--}}
                {{--align: "center",--}}
                {{--dataIndx: "View",--}}
                {{--isExport: false,--}}
                {{--editor: false,--}}
                {{--render: function (ui) {--}}
                    {{--var str = "";--}}
                    {{--var rowData = ui.rowData;--}}

                    {{--@if ($perD17F1010 >=1)--}}
                        {{--str += "<a title='{{Helpers::getRS($g,"Xem")}}' class='btnViewW17F1010 mgr10'><i class='fa fa-eye' style='color:orange'></i></a>";--}}
                    {{--@else--}}
                        {{--str += "<a title='{{Helpers::getRS($g,"Xem")}}' class=' mgr10'><i class='fa fa-eye' style='color:#ccc'></i></a>";--}}
                    {{--@endif--}}
                    {{--@if ($perD17F1010 >=3)--}}
                        {{--str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW17F1010 mgr10'><i class='glyphicon glyphicon-edit' style='color:orange'></i></a>";--}}
                    {{--@else--}}
                        {{--str += "<a title='{{Helpers::getRS($g,"Sua")}}' class=' mgr10'><i class='glyphicon glyphicon-edit' style='color:#ccc'></i></a>";--}}
                    {{--@endif--}}
                    {{--@if ($perD17F1010 >=4)--}}
                        {{--str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW17F1010'><i class='fa fa-trash' style='color:#333'></i></a>";--}}
                    {{--@else--}}
                        {{--str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class=''><i class='fa fa-trash' style='color:#ccc'></i></a>";--}}
                    {{--@endif--}}
                        {{--return str;--}}
                {{--},--}}
                {{--postRender: function (ui) {--}}
                    {{--var rowIndx = ui.rowIndx,--}}
                        {{--grid = this,--}}
                        {{--$cell = grid.getCell(ui);--}}
                    {{--var row = ui.rowData;--}}
                    {{--$cell.find(".btnViewW17F1010").bind("click", function (evt) {--}}
                        {{--showFormDialogPost('{{url("/W17F1011/".$pForm."/".$g)."/view"}}', 'modalW17F1011', {companyID: row.CompanyID, formCall: "W17F1010"}, 2);--}}
                    {{--});--}}
                    {{--$cell.find(".btnEditW17F1010").bind("click", function (evt) {--}}
                        {{--showFormDialogPost('{{url("/W17F1011/".$pForm."/".$g)."/edit"}}', 'modalW17F1011', {companyID: row.CompanyID, formCall: "W17F1010"}, 2);--}}
                    {{--});--}}
                    {{--//edit button--}}
                    {{--$cell.find(".btnDeleteW17F1010").bind("click", function (evt) {--}}
                        {{--ask_delete(function () {--}}
                            {{--var url = '{{url("/W17F1010/".$pForm."/$g/delete")}}';--}}
                            {{--postMethod(url, function (data) {--}}
                                {{--var rs = JSON.parse(data);--}}
                                {{--switch (rs.status) {--}}
                                    {{--case 'OKAY':--}}
                                        {{--var $grid = $("#gridW17F1010");--}}
                                        {{--delete_ok(function () {--}}
                                            {{--update4ParamGrid($grid, null, 'delete');--}}
                                        {{--});--}}
                                        {{--break;--}}
                                    {{--case 'ERROR':--}}
                                        {{--alert_warning(rs.message);--}}
                                        {{--break;--}}
                                    {{--case 'CHECKSTORE':--}}
                                        {{--alert_warning(rs.message);--}}
                                        {{--break;--}}
                                {{--}--}}

                            {{--}, {companyID: row["CompanyID"]});--}}
                        {{--});--}}


                    {{--});--}}


                {{--}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'Ma')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 140,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "CompanyID",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'Ten')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 240,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "CompanyName",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'Ten_tat')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 140,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "CompanyShort",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'Dia_chi')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 240,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "AddressLine",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'SDT')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 140,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "TelNo",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'Nhom_cong_ty')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 240,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "CompanyGroupName",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'Phan_loai')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 240,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "CompanyKindName",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'Trang_thai')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 140,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "Description",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'Nhan_vien')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 240,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "SalesPersonName",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'Nhom_kinh_doanh')}}",--}}
                {{--minWidth: 140,--}}
                {{--width: 240,--}}
                {{--dataType: "string",--}}
                {{--dataIndx: "GroupSalesName",--}}
                {{--editor: false,--}}
                {{--filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}--}}
            {{--},--}}
            {{--{--}}
                {{--title: "{{Helpers::getRS($g,'KSD')}}",--}}
                {{--cb: {--}}
                    {{--all: false,--}}
                    {{--header: true,--}}
                    {{--check: "1",--}}
                    {{--uncheck: "0"--}}
                {{--},--}}
                {{--dataIndx: "Disabled",--}}
                {{--align: "center",--}}
                {{--width: 90,--}}
                {{--type: 'checkbox',--}}
                {{--dataType: 'string',--}}
                {{--editor: false,--}}
                {{--editable: false,--}}
            {{--}--}}
        {{--];--}}
        obj.dataModel = {
            data: [],
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $gridW17F1010 = $("#gridW17F1010").pqGrid(obj);
        $gridW17F1010.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW17F1010.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW17F1010.pqGrid("refreshDataAndView");
        setTimeout(function(){
            $gridW17F1010.pqGrid("refreshDataAndView");
            postMethod("{{url('/W17F1010/'.$pForm.'/'.$g.'/filter')}}", function (data) {
                // var obj = $.parseJSON(data);
                var colModels = getColModels(data.dsFields);
                console.log(colModels);
                $("#gridW17F1010").pqGrid("option", "colModel", colModels);
                $("#gridW17F1010").pqGrid("option", "dataModel.data", data.dsData);
                $("#gridW17F1010").pqGrid('refreshDataAndView');
                $("#gridW17F1010").pqGrid('hideLoading');
                $('#btnW17F1010ExportExcel').removeAttr('disabled');
            }, $("#frmW17F1010").serialize() + "&companyIDW17F1010={{$companyIDW17F1010}}" + '&assigneeID={{$assigneeID}}' );
        }, 300);
    });
    
    function getColModels(dsFields) {
        var obj = [
            {
                title: "",
                minWidth: 80,
                align: "center",
                dataIndx: "View",
                isExport: false,
                editor: false,
                render: function (ui) {
                    var str = "";
                    var rowData = ui.rowData;

                    @if ($perD17F1010 >=1)
                        str += "<a title='{{Helpers::getRS($g,"Xem")}}' class='btnViewW17F1010 mgr10'><i class='fa fa-eye' style='color:orange'></i></a>";
                    @else
                        str += "<a title='{{Helpers::getRS($g,"Xem")}}' class=' mgr10'><i class='fa fa-eye' style='color:#ccc'></i></a>";
                    @endif
                            @if ($perD17F1010 >=3)
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW17F1010 mgr10'><i class='glyphicon glyphicon-edit' style='color:orange'></i></a>";
                    @else
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class=' mgr10'><i class='glyphicon glyphicon-edit' style='color:#ccc'></i></a>";
                    @endif
                            @if ($perD17F1010 >=4)
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW17F1010'><i class='fa fa-trash' style='color:#333'></i></a>";
                    @else
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class=''><i class='fa fa-trash' style='color:#ccc'></i></a>";
                    @endif
                        return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var row = ui.rowData;
                    $cell.find(".btnViewW17F1010").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W17F1011/".$pForm."/".$g)."/view"}}', 'modalW17F1011', {companyID: row.CompanyID, formCall: "W17F1010"}, 2);
                    });
                    $cell.find(".btnEditW17F1010").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W17F1011/".$pForm."/".$g)."/edit"}}', 'modalW17F1011', {companyID: row.CompanyID, formCall: "W17F1010"}, 2);
                    });
                    //edit button
                    $cell.find(".btnDeleteW17F1010").bind("click", function (evt) {
                        ask_delete(function () {
                            var url = '{{url("/W17F1010/".$pForm."/$g/delete")}}';
                            postMethod(url, function (data) {
                                var rs = JSON.parse(data);
                                switch (rs.status) {
                                    case 'OKAY':
                                        var $grid = $("#gridW17F1010");
                                        delete_ok(function () {
                                            update4ParamGrid($grid, null, 'delete');
                                        });
                                        break;
                                    case 'ERROR':
                                        alert_warning(rs.message);
                                        break;
                                    case 'CHECKSTORE':
                                        alert_warning(rs.message);
                                        break;
                                }

                            }, {companyID: row["CompanyID"]});
                        });


                    });


                }
            }
        ];

        //Set dynamic columns...
        $.each(dsFields, function(i, f) {
            var dataType = '';
            switch (f.DataType) {
                case "N":
                    dataType = 'integer';
                    break;
                case "S":
                    dataType = 'string';
                    break;
                default:
                    dataType = 'string';
                    break;
            }
            if (f.IsCheckbox == 0) {
                var col = {
                    title: f.Caption,
                    minWidth: f.Width,
                    width: f.Width,
                    dataType: dataType,
                    dataIndx: f.FieldName,
                    editor: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                };
            } else {
                var col = {
                    title: f.Caption,
                    cb: {
                        all: false,
                        header: true,
                        check: "1",
                        uncheck: "0"
                    },
                    dataIndx: f.FieldName,
                    align: "center",
                    width: f.Width,
                    type: 'checkbox',
                    dataType: "string",
                    editor: false,
                    editable: false,
                    render: function(ui) {
                        var val = ui.rowData[f.FieldName] == 1 ? 'checked' : '';
                        return "<input type='checkbox' " + val + " disabled/>";
                    }
                }
            }
            obj.push(col);
        });

        return obj;
    }

    var w17F1010ExportExcel = function () {
        var blob = $("#gridW17F1010").pqGrid("exportData", {format: 'xlsx', sheetName: "Data"});
        if (typeof blob === "string") {
            blob = new Blob([blob]);
        }
        saveAs(blob, "Employee File.xlsx");
    };


    $("#frmW17F1010").on('submit', function (e) {
        e.preventDefault();
        $("#gridW17F1010").pqGrid('showLoading');
        postMethod("{{url('/W17F1010/'.$pForm.'/'.$g.'/filter')}}", function (data) {
            //var obj = $.parseJSON(data);
            var colModels = getColModels(data.dsFields);
            $("#gridW17F1010").pqGrid("option", "colModel", colModels);
            $("#gridW17F1010").pqGrid("option", "dataModel.data", data.dsData);
            $("#gridW17F1010").pqGrid('refreshDataAndView');
            $("#gridW17F1010").pqGrid('hideLoading');
            $('#btnW17F1010ExportExcel').removeAttr('disabled');
        }, $("#frmW17F1010").serialize());
    });


</script>
