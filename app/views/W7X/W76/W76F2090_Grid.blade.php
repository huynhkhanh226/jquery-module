<div id="W76F2090_Grid"></div>
<script type="text/javascript">
    $(document).ready(function () {
        iW76F2090Height = $(".contenttab").height() - 120;
        var dataSource = {{$rsFilter}};
        var obj = {
            width: "100%",
            height: $("#divD76F2090_W76F2090_W76F2090").height() - 150,
            resizable: true,
            dataType: "JSON",
            editable: false,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
            showBottom: true,
            pageModel: {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]},
            hwrap: false,
            wrap: false,
            freezeCols: 1,
            dataModel: {
                data: dataSource,


            },
            postRenderInterval: -1, //Dung event postRender thi phai bat thuoc tinh nay len nha
        };

        obj.colModel = [

            {
                title: "",
                width: 75,
                dataType: "string",
                editable: true,
                editor: false,
                align: "center",
                dataIndx: "View",
                cls: "ovr_visible",
                editor: false,
                isExport: false,
                render: function (ui) {
                    var permission = Number("{{$permission}}");
                    //alert(permission);
                    //permission = 4;
                    var str = digiContextMenu({
                            showText: true,
                            buttonList: [
                                {
                                    ID: "btnViewW76F2090",
                                    icon: "fa fa-eye text-green",
                                    title: '{{Helpers::getRS($g,"Xem")}}',
                                    enable: function () {
                                        return permission >= 1;
                                    },
                                    hidden: function () {
                                        return !(permission >= 1);
                                    },
                                    type: "button",
                                },
                                {
                                    ID: "btnEditW76F2090",
                                    icon: "fa fa-edit text-yellow",
                                    title: '{{Helpers::getRS($g,"Sua")}}',
                                    enable: function () {
                                        return permission >= 3;
                                    },
                                    hidden: function () {
                                        return !(permission >= 3);
                                    },
                                    type: "button",
                                }
                                , {
                                    ID: "btnDeleteW76F2090",
                                    icon: "fa fa-trash text-red",
                                    title: '{{Helpers::getRS($g,"Xoa")}}',
                                    enable: function () {
                                        return permission >= 4;
                                    },
                                    hidden: function () {
                                        return !(permission >= 4);
                                    },
                                    type: "button"
                                }
                            ]
                        }
                    );




                    return str;
                },
                //====
                hidden: "{{$permission == 0 ? true : false}}",
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;


                    $cell.find(".btnViewW76F2090").bind("click", function (evt) {

                        showFormDialogPost("{{url('/W76F2091/'.$pForm.'/'.$g.'/view')}}", "modalW76F2091", {
                            ID: rowData['ID']


                        });
                    });
                    $cell.find(".btnEditW76F2090").bind("click", function (evt) {

                        showFormDialogPost("{{url('/W76F2091/'.$pForm.'/'.$g.'/edit')}}", "modalW76F2091", {
                            ID: rowData['ID']
                        });
                    });
                    $cell.find(".btnDeleteW76F2090").bind("click", function (evt) {
                        //alert("QUYEN Delete");
                        ask_delete(function () {
                            postMethod("{{url('/W76F2090/view/'.$pForm.'/'.$g.'/delete')}}", function (res) {
                                var data = JSON.parse(res);
                                switch (data.status) {
                                    case "SUC":
                                        var $grid = $("#W76F2090_Grid");
                                        delete_ok(function () {
                                            update4ParamGrid($grid, null, 'delete');
                                        });
                                        break;
                                    case "ERROR":
                                        alert_error(data.message);
                                        break;
                                }
                            }, {ID: rowData.ID})
                        });
                    });
                }
            },
            {
                title: "ID",
                width: 200,
                dataType: "string",
                hidden: true,
                editable: true,
                editor: false,
                dataIndx: "ID",
                isExport: false,
            },
            {
                title: "{{Helpers::getRS($g, 'So_cong_van')}}",
                width: 200,
                dataType: "string",
                align: "left",
                maxWidth: 110,
                editable: true,
                editor: false,
                dataIndx: "DocNo",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "",
                width: 200,
                dataType: "string",
                align: "left",
                hidden: true,
                maxWidth: 110,
                editable: true,
                editor: false,
                dataIndx: "ID",
                isExport: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Co_quan_gui')}}",
                width: 200,
                dataType: "string",
                align: "left",
                maxWidth: 300,
                editable: true,
                editor: false,
                dataIndx: "ReceiveSendOrganization",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Nguoi_ky')}}",
                width: 200,
                dataType: "string",
                align: "center",
                maxWidth: 300,
                editable: true,
                editor: false,
                dataIndx: "Signer",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Ngay_phat_hanh')}}",
                width: 200,
                dataType: "date",
                align: "center",
                maxWidth: 110,
                editable: true,
                exportRender: true,
                editor: false,
                dataIndx: "ReleaseDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g, 'Do_khan_cap')}}",
                width: 200,
                dataType: "string",
                align: "center",
                maxWidth: 110,
                editable: true,
                editor: false,
                dataIndx: "Emergency",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Do_bao_mat')}}",
                width: 200,
                dataType: "string",
                align: "center",
                maxWidth: 110,
                editable: true,
                editor: false,
                dataIndx: "Security",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Trang_thai_cv')}}",
                width: 160,
                dataType: "string",
                align: "center",
                editable: true,
                editor: false,
                dataIndx: "StatusID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Trich_yeu')}}",
                width: 200,
                dataType: "string",
                align: "left",
                maxWidth: 300,
                editable: true,
                editor: false,
                dataIndx: "Content",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Ngay_hieu_luc')}}",
                width: 110,
                dataType: "date",
                align: "center",
                editable: true,
                editor: false,
                dataIndx: "EffectDateFrom",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g, 'Ngay_het_hieu_luc')}}",
                width: 110,
                dataType: "date",
                align: "center",
                editable: true,
                editor: false,
                dataIndx: "EffectDateTo",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g, 'Nhom_van_ban')}}",
                width: 270,
                dataType: "string",
                align: "center",
                editable: true,
                editor: false,
                dataIndx: "DocGroupName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "IsEdit",
                width: 200,
                dataType: "string",
                align: "left",
                maxWidth: 110,
                editable: true,
                hidden: true,
                editor: false,
                isExport: false,
                dataIndx: "",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "IsDelete",
                width: 200,
                dataType: "string",
                align: "left",
                maxWidth: 110,
                hidden: true,
                editable: true,
                isExport: false,
                editor: false,
                dataIndx: "",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
        ];

        var $grid = $("#W76F2090_Grid").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });
</script>
