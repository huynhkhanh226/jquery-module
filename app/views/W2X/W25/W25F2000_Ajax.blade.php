<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W25F2000" style="margin:auto;"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var iW25F2000Height = $(".contenttab").height() - 125;
        var obj = {
            width: '100%',
            height: iW25F2000Height,
            showTitle: false,
            collapsible: false,
            editable: true,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            postRenderInterval: -1,
            freezeCols: 1,
        };
        obj.colModel = [
            {
                title: "",
                minWidth: 60,
                align: "center",
                dataIndx: "View",
                isExport: false,
                editor: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    //console.log(rowData);
                    return '<a title="{{Helpers::getRS($g,"Xem")}}" onclick="showFormDialogPost(\'{{url("/W25F2010/".$pForm."/view/")}}/' + rowData["TransID"] + '/' + rowData["AppStatusID"] + '\',\'modalW25F2010\')"><i class="glyphicon glyphicon-search text-yellow"></i></a>';
                }
            },
            {
                title: "{{Helpers::getRS($g,'Trang_thai')}}",
                minWidth: 120,
                //dataType: "string",
                dataIndx: "AppStatusName",
                editor: false,
                filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{Helpers::getRS($g,'Chon')}} --'},
                    valueIndx: "AppStatusName",
                    labelIndx: "AppStatusName",
                    listeners: ['change']
                },
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    str += "<a title='{{Helpers::getRS($g,"Lich_su_duyet")}}' class='btnViewHistoryW25F2080 mgr10 text-blue'>" + rowData["AppStatusName"] + "</a>";
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var row = ui.rowData;
                    //edit button
                    $cell.find(".btnViewHistoryW25F2080").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: row["TransID"]},2);
                    });

                }
            },
            {
                title: "{{Helpers::getRS($g,'Ke_hoach_tong_the')}}",
                minWidth: 140,
                dataType: "string",
                dataIndx: "PlanTransName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
               /* filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{--{{Helpers::getRS($g,'Chon')}}--}} --'},
                    valueIndx: "PlanTransName",
                    labelIndx: "PlanTransName",
                    listeners: ['change']
                }*/
            },

            {
                title: "{{Helpers::getRS($g,'Phong_ban')}}",
                minWidth: 170,
                dataType: "string",
                editor: false,
                dataIndx: "DepartmentName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                /*filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{--{{Helpers::getRS($g,'Chon')}}--}} --'},
                    valueIndx: "DepartmentName",
                    labelIndx: "DepartmentName",
                    listeners: ['change']
                }*/
            },
            {
                title: "{{Helpers::getRS($g,'To_nhom')}}",
                minWidth: 130,
                dataType: "string",
                editor: false,
                dataIndx: "TeamName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                /*filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{--{{Helpers::getRS($g,'Chon')}}--}} --'},
                    valueIndx: "TeamName",
                    labelIndx: "TeamName",
                    listeners: ['change']
                }*/
            },
            {
                title: "{{Helpers::getRS($g,'Vi_tri_tuyen_dung')}}",
                minWidth: 160,
                editor: false,
                dataType: "string",
                dataIndx: "RecPositionName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                /*filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{--{{Helpers::getRS($g,'Chon')}}--}} --'},
                    valueIndx: "RecPositionName",
                    labelIndx: "RecPositionName",
                    listeners: ['change']
                }*/
            },
            {
                title: "{{Helpers::getRS($g,'So_luong')}}",
                minWidth: 100,
                dataType: "integer",
                editor: false,
                dataIndx: "ProNumber",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                align: 'right'
            },
            {
                title: "{{Helpers::getRS($g,'Tu_ngay')}}",
                minWidth: 90,
                dataType: "date",
                editor: false,
                dataIndx: "DateFrom",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Den_ngay')}}",
                minWidth: 90,
                dataType: "date",
                editor: false,
                dataIndx: "DateTo",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Hinh_thuc_lam_viec')}}",
                minWidth: 160,
                editor: false,
                dataIndx: "WorkingStatusName",
                dataType: "string",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                /*filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{--{{Helpers::getRS($g,'Chon')}}--}} --'},
                    valueIndx: "WorkingStatusName",
                    labelIndx: "WorkingStatusName",
                    listeners: ['change']
                }*/
            },

            {
                title: "{{Helpers::getRS($g,'Loai_hop_dong')}}",
                minWidth: 140,
                dataType: "string",
                dataIndx: "ContractTypeName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                /*filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{--{{Helpers::getRS($g,'Chon')}}--}} --'},
                    valueIndx: "ContractTypeName",
                    labelIndx: "ContractTypeName",
                    listeners: ['change']
                }*/
            },
            {
                title: "{{Helpers::getRS($g,'Dia_diem_lam_viec')}}",
                minWidth: 200,
                editor: false,
                dataType: "string",
                dataIndx: "WorkPlace",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Muc_luong_tu')}}",
                minWidth: 110,
                dataType: "float",
                editor: false,
                dataIndx: "SalaryFrom",
                format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                align: 'right',
                format: '{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}'
            },

            {
                title: "{{Helpers::getRS($g,'Muc_luong_den')}}",
                minWidth: 110,
                dataType: "float",
                editor: false,
                dataIndx: "SalaryTo",
                format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                align: 'right',
                format: '{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}'
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_nhan_su_can_nguoi')}}",
                minWidth: 90,
                dataType: "date",
                editor: false,
                dataIndx: "DateJoined",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },

            {
                title: "{{Helpers::getRS($g,'Ly_do_can_tuyen')}}",
                minWidth: 200,
                editor: false,
                dataType: "string",
                dataIndx: "ReasonRequest",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ];
        obj.dataModel = {
            data: {{json_encode($rs)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $grid = $("#pqgrid_W25F2000").pqGrid(obj);


        var column = $grid.pqGrid("getColumn", {dataIndx: "AppStatusName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["AppStatusName"]});
        /*
                var column = $grid.pqGrid("getColumn", {dataIndx: "PlanName"});
                var filter = column.filter;
                filter.cache = null;
                filter.options = $grid.pqGrid("getData", {dataIndx: ["PlanName"]});

                var column = $grid.pqGrid("getColumn", {dataIndx: "WorkingStatusName"});
                var filter = column.filter;
                filter.cache = null;
                filter.options = $grid.pqGrid("getData", {dataIndx: ["WorkingStatusName"]});

                var column = $grid.pqGrid("getColumn", {dataIndx: "ContractTypeName"});
                var filter = column.filter;
                filter.cache = null;
                filter.options = $grid.pqGrid("getData", {dataIndx: ["ContractTypeName"]});

                var column = $grid.pqGrid("getColumn", {dataIndx: "DepartmentName"});
                var filter = column.filter;
                filter.cache = null;
                filter.options = $grid.pqGrid("getData", {dataIndx: ["DepartmentName"]});

                var column = $grid.pqGrid("getColumn", {dataIndx: "TeamName"});
                var filter = column.filter;
                filter.cache = null;
                filter.options = $grid.pqGrid("getData", {dataIndx: ["TeamName"]});

                var column = $grid.pqGrid("getColumn", {dataIndx: "RecPositionName"});
                var filter = column.filter;
                filter.cache = null;
                filter.options = $grid.pqGrid("getData", {dataIndx: ["RecPositionName"]});*/

        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });
</script>