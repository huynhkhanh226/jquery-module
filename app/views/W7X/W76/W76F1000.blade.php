<section class="content">
    <div class="row form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="btn-group">
                @if($permission >= 2)
                    <a onclick='showFormDialogPost("{{url('/W76F1000/view/'.$pForm.'/'.$g.'/add')}}","modalW76F1000")'
                       class="btn btn-default smallbtn" title="Thêm mới">
                        <span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,"Them_moi1")}}
                    </a>
                @endif
            </div>
        </div>
    </div>
    <input type="hidden" id="hdSaveOKW76F1000" value="0">
    <div class="row form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="gridW76F1000">
                GRID
            </div>
        </div>
    </div>
</section>

<section class="content" id="tbW76F1000">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div style="margin:auto;">
                <input type="checkbox" id="chkShowDisabledW76F1000" name="chkShowDisabledW76F1000"
                       style="float: left;"/>

                <p style="float: left;padding-left: 10px;">{{Helpers::getRS($g,'Hien_thi_danh_muc_khong_su_dung')}}</p>
            </div>
        </div>
    </div>
</section>


<script>
    var iW76F1000Height;
    var dataSource =  JSON.parse('{{$rsData}}');
    $(function () {
        iW76F1000Height = $(".contenttab").height() - 100;
        var obj = {
            width: "100%",
            height: iW76F1000Height,
            resizable: true,
            title: "{{$caption}}",
            dataType: "JSON",
            editable: false,
            // freezeCols: 1,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showBottom: true,
            pageModel: {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]},
            cellClick:function(event,ui){
                vinh=ui.rowData;
                vi=ui.colIndx;
                console.log('rowData la',vinh   ,'rowIndx la',vi);
            },

            dataModel: {
                data: dataSource,



            },
            postRenderInterval: -1, //Dung event postRender thi phai bat thuoc tinh nay len nha
        };

        obj.colModel = [
            {
                title: "",
                width: 75,
                align: "center",
                dataIndx: "View",
                maxWidth: 70,
                editor: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    @if($permission >=1)
                        str += '<a id="btnViewW76F1000" title="{{Helpers::getRS($g,"Xem")}}"><i class="fa fa-eye text-yellow" style="padding-right: 5px"></i></a>';
                    @endif
                            @if($permission >=3)
                        str += '<a id="btnEditW76F1000" title="{{Helpers::getRS($g,"Sua")}}"><i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';
                    @endif
                            @if($permission >=4)
                        str += '<a id="btnDeleteW76F1000" title="{{Helpers::getRS($g,"Xoa")}}"><i class="glyphicon glyphicon-bin text-black"></i></a>';
                    @endif
                        return str;
                },
                hidden: "{{$permission == 0 ? true : false}}",
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    //edit button
                    $cell.find("#btnViewW76F1000").bind("click", function (evt) {
                        //alert("HELLO VIEW");
                        showFormDialogPost("{{url('/W76F1000/view/'.$pForm.'/'.$g.'/view')}}", "modalW76F1000", {
                            DocGroupCode: rowData['DocGroupCode'],
                            Disable_cb: rowData['Disabled'],
                            DocGroupName: rowData['DocGroupName'],
                            Note: rowData['Note'],
                            DisplayOrder: rowData['DisplayOrder']
                        });
                    });
                    $cell.find("#btnEditW76F1000").bind("click", function (evt) {
                        //alert("HELLO EDIT");
                        showFormDialogPost("{{url('/W76F1000/view/'.$pForm.'/'.$g.'/edit')}}", "modalW76F1000", {
                            ID: rowData['ID'],
                            DocGroupCode: rowData['DocGroupCode'],
                            Disable_cb: rowData['Disabled'],
                            DocGroupName: rowData['DocGroupName'],
                            Note: rowData['Note'],
                            DisplayOrder: rowData['DisplayOrder']
                        });
                    });
                    $cell.find("#btnDeleteW76F1000").bind("click", function (evt) {
                        ask_delete(function () {
                            postMethod("{{url('/W76F1000/view/'.$pForm.'/'.$g.'/delete')}}", function (res) {
                                var data = JSON.parse(res);
                                switch (data.status) {
                                    case "SUC":
                                        var $grid = $("#gridW76F1000");
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
                title: "",
                width: 200,
                dataType: "string",

                hidden: true,

                editable: true,
                editor: false,
                dataIndx: "ID",
            },
            {
                title: "{{Helpers::getRS($g, 'Nhom_van_ban')}}",
                width: 300,
                dataType: "string",
                align: "left",
                maxWidth: 300,
                editable: true,
                editor: false,
                dataIndx: "DocGroupCode",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Ten_nhom_van_ban')}}",
                width: 200,
                dataType: "string",
                align: "left",
                dataIndx: "DocGroupName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Ghi_chu')}}",
                dataType: "string",
                align: "left",
                dataIndx: "Note",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Thu_tu_hien_thi')}}",
                width: 200,
                dataType: "int",
                align: "center",
                maxWidth:100,
                dataIndx: "DisplayOrder",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
            },
            {
                title: "{{Helpers::getRS($g, 'KSD')}}",
                width: 200,
                dataType: "string",
                maxWidth: 75,
                dataIndx: "Disabled",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    var chekced = rowData.Disabled == 1 ? "checked" : "";
                    return '<input type="checkbox" value="' + rowData.Disabled + '" ' + chekced + ' disabled>';
                }
            }
        ];

        obj.create = function (evt, ui) {
            filterDisabled("gridW76F1000", $("#chkShowDisabledW76F1000").is(":checked") ? "" : "0");
        }
        var $grid = $("#gridW76F1000").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");

    });
    $(document).ready(function () {
        $('#chkShowDisabledW76F1000').click(function () {
            //alert("sdfsdfds");
            filterDisabled("gridW76F1000", $("#chkShowDisabledW76F1000").is(":checked") ? "" : "0");
        });
    });
</script>



