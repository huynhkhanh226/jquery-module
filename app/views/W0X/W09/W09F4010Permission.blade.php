<div class="modal fade" id="modalW09F4010" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 100%">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g, 'Danh_sach_dinh_kem'),"W09F4010-Permission")}}
            </div>

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW09F4010">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="gridW09F4010"></div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var keyW09F4011 = "{{$keyID}}";
    var keyW09F40112 = "{{$key2ID}}";
    var keyW09F40113 = "{{$key3ID}}";
    var keyW09F40114 = "{{$key4ID}}";
    var keyW09F40115 = "{{$key5ID}}";
    var tableName = "{{$tableName}}";
    var permission = Number("{{$permission}}");
    var objGridW09F4010 = {
        width: '100%',
        height: $(window).height() - 180,
        editable: true,
        //freezeCols: 2,
        selectionModel: {type: 'row', mode: 'single'},
        minWidth: 30,
        pageModel: {type: "local", rPP: 20},
        filterModel: {on: true, mode: "AND", header: true},
        showTitle: false,
        dataType: "JSON",
        wrap: true,
        hwrap: false,
        scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
        collapsible: false,
        postRenderInterval: -1,
        @if(intval($permission) >=2)
        toolbar: {
            items: [
                {
                    type: 'button',
                    label: "{{Helpers::getRS($g,"Them_moi1")}}",
                    icon: 'ui-icon-plus',
                    listener: function () {
                        //alert("da click");
                        showFormDialogPost('{{url("/W09F4011/$pForm/$g/add")}}', "modalW09F4011",
                            {
                                keyID: keyW09F4011,
                                key2ID: keyW09F40112,
                                key3ID: keyW09F40113,
                                key4ID: keyW09F40114,
                                key5ID: keyW09F40115,
                                tableName: tableName
                            },9);
                    }
                }]
        },
        @endif
        colModel: [
            {
                title: "", editable: false, minWidth: 80, sortable: false, align: "center", isExport: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    if (permission >=1){
                        str += "<a title='{{Helpers::getRS($g,"Xem")}}' class='btnViewW09F4010 mgr10'><i class='fa fa-eye text-yellow'></i></a>";
                    }else{
                        str += "<a title='{{Helpers::getRS($g,"Xem")}}' class='mgr10'><i class='fa fa-eye text-gray'></i></a>";
                    }

                    if (permission >=3){
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW09F4010 mgr10'><i class='glyphicon glyphicon-edit text-yellow'></i></a>";
                    }else{
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='mgr10'><i class='glyphicon glyphicon-edit text-gray'></i></a>";
                    }

                    if (permission >=4){
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW09F4010'><i class='fa fa-trash text-red'></i></a>";
                    }else{
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class=''><i class='fa fa-trash text-gray'></i></a>";
                    }

                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    //view button
                    $cell.find(".btnViewW09F4010").bind("click", function (evt) {
                        console.log(rowData);
                        showFormDialogPost('{{url("/W09F4011/$pForm/$g/view")}}', "modalW09F4011",
                            {
                                keyID: keyW09F4011,
                                key2ID: keyW09F40112,
                                key3ID: keyW09F40113,
                                key4ID: keyW09F40114,
                                key5ID: keyW09F40115,
                                data: rowData,
                                tableName: tableName
                            },9);
                    });

                    //edit button
                    $cell.find(".btnEditW09F4010").bind("click", function (evt) {
                        console.log(rowData);
                        showFormDialogPost('{{url("/W09F4011/$pForm/$g/edit")}}', "modalW09F4011",
                            {
                                keyID: keyW09F4011,
                                key2ID: keyW09F40112,
                                key3ID: keyW09F40113,
                                key4ID: keyW09F40114,
                                key5ID: keyW09F40115,
                                data: rowData,
                                tableName: tableName
                            },9);
                    });
                    $cell.find(".btnDeleteW09F4010").bind("click", function (evt) {
                        console.log(rowData);
                        ask_delete(function () {
                            postMethod('{{url("/W09F4010/$pForm/$g/delete")}}', function (data) {
                                //console.log("test");
                                if (JSON.parse(data).status == "SUCCESS") {
                                    delete_ok(function () {
                                        //loadDataW38F2040();
                                        update4ParamGrid($("#gridW09F4010"), "", "delete");
                                    });
                                } else {
                                    alert_error(data.message);
                                }
                            }, {
                                AttachmentID: rowData["AttachmentID"],
                                tableName: tableName
                            });
                        });

                    });
                }
            },
            {
                title: "AttachmentID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "AttachmentID",
                hidden: true,
                isExport: false
            },
            {
                title: "Content",
                minWidth: 170,
                dataType: "string",
                dataIndx: "Content",
                hidden: true,
                isExport: false
            },
            {
                title: "FileExt",
                minWidth: 170,
                dataType: "string",
                dataIndx: "FileExt",
                hidden: true,
                isExport: false
            },
            {
                title: "ContentArchive",
                minWidth: 170,
                dataType: "string",
                dataIndx: "ContentArchive",
                hidden: true,
                isExport: false
            },
            {
                title: "{{Helpers::getRS($g,"Ngay_tao")}}",
                minWidth: 100,
                dataType: "date",
                dataIndx: "CreateDate",
                align: "center",
                editor: false,
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,"Dien_giai")}}",
                minWidth: 240,
                dataType: "string",
                dataIndx: "Description",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Ten_tap_tin")}}",
                minWidth: 240,
                dataType: "string",
                dataIndx: "FileName",
                editor: false,
                align: "left",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Do_lon")}} (KB)",
                minWidth: 100,
                dataType: "string",
                dataIndx: "FileSize",
                align: "right",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Nguoi_tao")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "CreateUserName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Tai_xuong")}}",
                minWidth: 100,
                dataType: "string",
                dataIndx: "Download",
                align: "center",
                editor: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    console.log(rowData);
                    if (rowData.AttachmentID != "" && rowData.FileName != null) {
                        var array = rowData.AttachmentID.split(';');
                        var array_name = rowData.FileName.split(';');
                        rowData['TableName'] = 'D09T0211';
                        var str = "";
                        for (var i = 0; i < array_name.length; i++) {
                            if (array[i] != "") {
                                //str += '<a title="' + array_name[i] + '" id = "downloadFileW09F4010" href="{{url("attachment/D54/$g/")}}/\'+rowData.TableName+\'/\'+ encryptData(array[i])+\'"><span class="text-primary ' + iconFile(array_name[i]) + '"></span></a>&nbsp;';
                                str += '<a target="_blank" title="' + array_name[i] + '"   href="{{url("W09F4010/download/attachment/$g/$tableName")}}/'+ rowData.AttachmentID+'/'+ "{{$keyID}}"+'"><span class="text-primary ' + iconFile(array_name[i]) + '"></span></a>&nbsp;';
                            }
                        }
                        return str;
                    }
                }
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                minWidth: 240,
                dataType: "string",
                dataIndx: "Notes",
                align: "left",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ],
        dataModel: {
            data: {{$valueGrid}}
        }
    };
    var $gridW09F4010 = $("#gridW09F4010").pqGrid(objGridW09F4010);
    $gridW09F4010.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW09F4010.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    setTimeout(function () {
        $gridW09F4010.pqGrid("refreshDataAndView");
    }, 700)
    
    function downLoad() {
        //alert("anh bao");
    }

    function LoadDataW09F4011(keyW09F4011,keyW09F40112,keyW09F40113,keyW09F40114, keyW09F40115,tableName){
        $("#gridW09F4010").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W09F4010/$pForm/$g/reloadGridW09F4010")}}',
            data: {
                keyID: keyW09F4011,
                key2ID: keyW09F40112,
                key3ID: keyW09F40113,
                key4ID: keyW09F40114,
                key5ID: keyW09F40115,
                tableName: tableName
            },
            success: function (data) {
                console.log(data);
                $("#gridW09F4010").pqGrid("option", "dataModel.data", data);
                $("#gridW09F4010").pqGrid("refreshDataAndView");
                $("#gridW09F4010").pqGrid( "hideLoading" );
            }
        });
    }
</script>