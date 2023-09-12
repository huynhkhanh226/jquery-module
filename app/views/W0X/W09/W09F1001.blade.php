<div class="modal draggable fade modal" id="modalW09F1001" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-header">
            {{Helpers::generateHeading($modalTitle,"W09F1001",true,"closePopupW09F1001")}}
        </div>

        <div class="modal-content pd10">
            <form id="frmW09F1001" class="form-horizontal">

                <div class="row form-group">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <label class="lbl-normal">{{Helpers::getRS($g, 'Cap_to_chuc')}}</label>
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        <input type="text" class="form-control" id="txtOrgLevelNameW09F1001"
                               name="txtOrgLevelNameW09F1001" required
                        >
                    </div>
                </div>

                <!--//////////////////////////////-->
                <div class="row form-group">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <label class="lbl-normal">{{Helpers::getRS($g, 'Thu_tu_hien_thi')}}</label>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <input type="number" min="0" step="1" class="form-control text-right" id="txtOrgLevelW09F1001"
                               value=""
                               name="txtOrgLevelW09F1001" placeholder="" required
                        >
                    </div>
                </div>

                <!--//////////////////////////////-->
                <div class="row form-group">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <label class="lbl-normal">{{Helpers::getRS($g, 'Ghi_chu')}}</label>
                    </div>
                    <div class="col-md-10 col-xs-10">
                        <textarea class="form-control" id="txtNotesW09F1001" rows="2"
                                  name="txtNotesW09F1001"></textarea>
                    </div>
                </div>

                <!--//////////////////////////////-->
                <div class="row form-group">
                    <div class="col-md-12 col-xs-12 ">
                        <button type="button" id="btnAddW09F1001" class="btn btn-default smallbtn pull-left mgr5"
                                title="{{Helpers::getRS($g, "Them_moi1")}}">
                            <span class="fa fa-plus text-blue"></span> {{Helpers::getRS($g, "Them_moi1")}}
                        </button>
                        <button type="button" id="btnChooseW09F1001" class="btn btn-default smallbtn pull-right mgr5"
                                title="{{Helpers::getRS($g, "Luu_va_chon")}}"
                                onclick="ask_save(function(){saveData('chose')})"><span
                                    class="glyphicon glyphicon-floppy-remove mgr5 text-red"></span>{{Helpers::getRS($g, "Luu_va_chon")}}
                        </button>
                        <button type="button" id="btnSaveNextW09F1001" class="btn btn-default smallbtn pull-right mgr5"
                                onclick="ask_save(function(){saveData('add')})"
                                title="{{Helpers::getRS($g, "Luu_va_nhap_tiep")}}"><span
                                    class="fa fa-arrow-right text-green mgr5"></span> {{Helpers::getRS($g, "Luu_va_nhap_tiep")}}
                        </button>
                        <button type="button" id="btnSaveW09F1001" class="btn btn-default smallbtn pull-right mgr5 "
                                onclick="ask_save(function(){saveData('view')})"
                                title="{{Helpers::getRS($g, "Luu")}}"><span
                                    class="glyphicon glyphicon-floppy-saved mgr5 text-blue"></span> {{Helpers::getRS($g, "Luu")}}
                        </button>
                        <input type="submit" id="hdSubmitW09F1001" class="hide"/>
                    </div>
                </div>

                <!--//////////////////////////////-->

            </form>

            <div class="row form-group">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="gridW09F1001" class="gridParam"></div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script type="text/javascript">
    var task = "view";
    var saveType = "";//phân biệt chế độ save
    var OrgLevelID = ""; //bien toan cuc cua OrgLevelID
    $(document).ready(function () {
        var obj = {
            width: '100%',
            height: $(document).height() - 320,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row'},
            editable: false,
            //freezeCols: 1,
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            postRenderInterval: -1, //

            //su kien load luoi hoan tat
            complete: function (event, ui) {
                if (task == "view") {
                    //lay du lieu dang co tren luoi
                    var data = $("#gridW09F1001").pqGrid("option", "dataModel.data");
                    console.log(data.length);
                    if (data.length > 0) { //luoi co du lieu
                        $("#gridW09F1001").pqGrid("setSelection", {rowIndx: 0});//set selection
                        setValueW09F1001('edit', data[0]);//gán giá trị dòng đầu tiên lên form
                        setModeW09F1001("view");
                        task = "view"
                    } else { //luoi rong
                        task = "add"
                        setModeW09F1001("add");
                    }
                }
            },

            rowClick: function (event, ui) {
                var rowData = ui.rowData;
                setValueW09F1001('edit', rowData);
            }
        };
        obj.colModel = [
            {
                title: "",
                minWidth: 40,
                width: 40,
                maxWidth: 40,
                align: "left",
                dataIndx: "View",
                isExport: false,
                editor: false,
                editable: false,
                sortable: false,

                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    var per = Number("{{$g}}");
                    str = '<div id = "btnGroupW09F1001" class="btn-group btnGroupLW4">';
                    str += '<button type="button" class="btn btn-default dropdown-toggle btnButtonLW4" data-toggle="dropdown">';
                    str += '<span class="fa fa-ellipsis-h" style="font-size: 200%; color: #367FA9"></span>';
                    str += '</button>';
                    str += '<ul class="dropdown-menu menuActionButton" style = "border-color: #367FA9">';
                    if (per >= 1) {
                        str += '<li><a title="{{Helpers::getRS($g,"Xem")}}" class="btnViewW09F1001"><i class="fa fa-eye text-green"></i>{{Helpers::getRS($g,"Xem")}}</a></li>';
                    }
                    if (per >= 3) {
                        str += '<li><a title="{{Helpers::getRS($g,"Sua")}}" class="btnEditW09F1001"><i class="glyphicon glyphicon-edit" style="color:orange"></i>{{Helpers::getRS($g,"Sua")}}</a></li>';
                    }

                    if (per >= 4) {
                        str += '<li><a title="{{Helpers::getRS($g,"Xoa")}}" class="btnDeleteW09F1001"><i class="fa fa-trash" style="color:#333"></i>{{Helpers::getRS($g,"Xoa")}}</a></li>';
                    }
                    str += '</div>';
                    str += '</ul>';
                    var str = digiContextMenu({
                            showText: true,
                            buttonList: [
                                {
                                    ID: "btnViewW09F1001",
                                    icon: "fa fa-eye text-green",
                                    title: '{{Helpers::getRS($g,"Xem")}}',
                                    enable: true,
                                    hidden: !(per >= 1),
                                    type: "button"

                                }
                                , {
                                    ID: "btnEditW09F1001",
                                    icon: "fa fa-edit text-orange",
                                    title: '{{Helpers::getRS($g,"Sua")}}',
                                    enable: true,
                                    hidden: !(per >= 3),
                                    type: "button",

                                }
                                , {
                                    ID: "btnDeleteW09F1001",
                                    icon: "fa fa-trash text-red",
                                    title: '{{Helpers::getRS($g,"Xoa")}}',
                                    enable: true,
                                    hidden: !(per >= 4),
                                    type: "button"
                                }
                            ]
                        }
                    );
                    return {
                        text: str,
                        cls: "overflow-visible"
                    };
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx;
                    var grid = this;
                    var $cell = grid.getCell(ui);
                    var rowData = ui.rowData;// du lieu cua 1 dong

                    //su kien click xem
                    $cell.find(".btnViewW09F1001").bind("click", function (evt) {
                        //alert("HELLO VIEW");
                        console.log(rowData);
                        setValueW09F1001('view', rowData); //set gia tri cho form

                    });
                    $cell.find(".btnEditW09F1001").bind("click", function (evt) {
//                        alert("HELLO EDIT");
                        task = "edit";
                        OrgLevelID = rowData['OrgLevelID'];
                        checkBeforeEdit(OrgLevelID, rowData);
                    });
                    $cell.find(".btnDeleteW09F1001").bind("click", function (evt) {
                        //alert("HELLO DELETE");
                        ask_delete(function () {
                            postMethod("{{url('/W09F1001/'.$pForm.'/'.$g.'/delete')}}", function (res) {
                                //var data = JSON.parse(res);
                                switch (res) {
                                    case "SUCCESS":
                                        var $grid = $("#gridW09F1001");
                                        delete_ok(function () {
                                            update4ParamGrid($grid, null, 'delete');
                                        });
                                        break;
                                    case "ERROR":
                                        alert_error(data.message);
                                        break;

                                    default:
                                        alert_warning(res);
                                        break;
                                }
                            }, {OrgLevelID: rowData['OrgLevelID']})
                        });
                    });
                }
            },
            {
                title: "{{Helpers::getRS($g,'Thu_tu_hien_thi')}}",
                minWidth: 50,
                width: 80,
                align: "center",
                dataType: "string",
                dataIndx: "OrgLevel",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ma_cap_to_chuc')}}",
                minWidth: 50,
                width: 80,
                hidden: true,
                align: "center",
                dataType: "string",
                dataIndx: "OrgLevelID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Cap_to_chuc')}}",
                minWidth: 200,
                width: 240,
                align: "left",
                dataType: "string",
                dataIndx: "OrgLevelName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                minWidth: 170,
                width: 270,
                align: "left",
                dataType: "string",
                dataIndx: "Notes",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
        ];
        obj.dataModel = {
            data: {{$rsData}},
            location: "local",
            sorting: "local",
            sortDir: "down",

        };

        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $grid = $("#gridW09F1001").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");

        setTimeout(function () {
            $grid.pqGrid("refreshDataAndView");
        }, 300)
    });

    function showW09F4444(empid) {
        $.ajax({
            method: "GET",
            url: "{{url("W09F4444/$g")}}",
            data: {empid: empid},
            success: function (data) {
                $("#secDetailE09F0000").html(data);
                $("#modalW09F4444").modal("show");
            }
        });
    }

    function checkBeforeEdit(OrgLevelID, rowData) {
        $.ajax({
            method: "GET",
            url: "{{url('/W09F1001/'.$pForm.'/'.$g.'/checkBeforeEdit')}}",
            data: {OrgLevelID: OrgLevelID},
            success: function (data) {
                switch (data) {
                    case "SUCCESS":
                        setValueW09F1001(task, rowData);
                        setModeW09F1001(task); //set gia tri disable cho task bang edit
                        break;
                    default:
                        alert_warning(data);
                        break;
                }
            }
        });
    }
    
    function saveData(mode) {
        validationElements($("#frmW09F1001"), function () { //Kiem tra bat buoc nhap
            //Kiem tra nhung truong hop khac
            $("#hdSubmitW09F1001").click();

            saveType = mode;
        });

    }

    $("#frmW09F1001").submit(function (e) {
        e.preventDefault();
        var url = "";
        console.log(task);
        if (task == "add")
            url = "{{url('/W09F1001/'.$pForm.'/'.$g.'/save')}}";
        if (task == "edit")
            url = "{{url('/W09F1001/'.$pForm.'/'.$g.'/update')}}";
        //console.log($("#frmW09F1001").serialize());
        //Thuc hien day du lieu di
        $.ajax({
            method: "POST",//phuong thuc truyen DL
            url: url,//duong dan de truyen DL
            data: $("#frmW09F1001").serialize() + "&OrgLevelID=" + OrgLevelID,//DL truyen di
            success: function (res) {
                console.log(res);
                var obj = JSON.parse(res);
                console.log(obj);
                var rowOrgLevelID = obj.rowData.OrgLevelID;
                console.log(rowOrgLevelID);
                switch (obj.status) {
                    case "SUCCESS":
                        save_ok(function () {
                            console.log(task);
                            if (task == "add")
                                update4ParamGrid($("#gridW09F1001"), obj.rowData, 'add');
                            if (task == "edit")
                                update4ParamGrid($("#gridW09F1001"), obj.rowData, 'edit');
                            console.log(saveType);
                            if(saveType == "chose"){//trường hợp lưu vào chọn
                                closePopupW09F1001(rowOrgLevelID);//truyen OrgLevelID để gán lên combo ở màn hình W09F1005
                            }else{
                                setModeW09F1001(saveType);
                                setValueW09F1001(saveType);
                            }
                        });
                        break;
                    case "ERROR":
                        alert_error(res);
                        break;

                    default://truong hop kq kiem tra có status = 1
                        //console.log(obj);
                        if(Number(obj.msgAsk) == 0){
                            alert_warning(obj.status);
                        }
                        if(Number(obj.msgAsk) == 1){
                            alert_confirm(confirmSave, '', obj.status);
                        }
                        break;
                }
            }
        });
    });

    function confirmSave() {
        $.ajax({
            method: "POST",//phuong thuc truyen DL
            url: "{{url('/W09F1001/'.$pForm.'/'.$g.'/confirmSave')}}",//duong dan de truyen DL
            data: $("#frmW09F1001").serialize() + "&OrgLevelID=" + OrgLevelID + "&action=" + task,//DL truyen di
            success: function (res) {
                console.log(res);
                var obj = JSON.parse(res);
                console.log(obj);
                var rowOrgLevelID = obj.rowData.OrgLevelID;
                console.log(rowOrgLevelID);
                switch (obj.status) {
                    case "SUCCESS":
                        save_ok(function () {
                            console.log(task);
                            if (task == "add")
                                update4ParamGrid($("#gridW09F1001"), obj.rowData, 'add');
                            if (task == "edit")
                                update4ParamGrid($("#gridW09F1001"), obj.rowData, 'edit');
                            //console.log(obj.rowData);
                            if(saveType == "chose"){//trường hợp lưu vào chọn
                                closePopupW09F1001(rowOrgLevelID);//truyen OrgLevelID để gán lên combo ở màn hình W09F1005
                            }else{
                                console.log("dkskds");
                                setModeW09F1001(saveType);
                                setValueW09F1001(saveType);
                            }
                        });
                        break;
                    case "ERROR":
                        alert_error(res);
                        break;
                }
            }
        });
    }

    //ham set lai du lieu
    function setValueW09F1001(mode, rowData) {
        var data = $("#gridW09F1001").pqGrid("option", "dataModel.data");
        console.log(rowData);
        if (mode == "add") {
            //Xoa du lieu
            clearForm();
            //set default value
            setDefaultValues(data.length + 1);
        }
        if (mode == "edit") {
            $('#txtOrgLevelNameW09F1001').val(rowData['OrgLevelName']);
            $('#txtOrgLevelW09F1001').val(rowData['OrgLevel']);
            $('#txtNotesW09F1001').val(rowData['Notes']);
        }
    }

    $("#btnAddW09F1001").click(function () {
        //Chuyen task = "add"
        task = "add";
        setModeW09F1001(task); //doi trang thai thanh trang thai them moi
        setValueW09F1001('add');
        //focus textbx dau tien
        $("#txtOrgLevelNameW09F1001").focus();

    });

    function clearForm() {
        $("#frmW09F1001").find("input, select, textarea").val('');
    }

    function setDefaultValues(level) {
        $("#txtOrgLevelW09F1001").val(level);
    }

    //set trang thai cho man hinh
    function setModeW09F1001(mode) {
        console.log(mode);
        switch (mode) {
            case "view": //trang thai xem
                $('#btnAddW09F1001').prop('disabled', false);
                $('#txtOrgLevelNameW09F1001').prop('disabled', true);
                $('#txtOrgLevelW09F1001').prop('disabled', true);
                $('#txtNotesW09F1001').prop('disabled', true);
                $('#btnSaveW09F1001').prop('disabled', true);
                $('#btnChooseW09F1001').prop('disabled', true);
                $('#btnSaveNextW09F1001').prop('disabled', true);
                $("#gridW09F1001").pqGrid("enable");
                break;

            case "add"://trang thai them moi
            case "edit"://trang thai sua
                $('#btnAddW09F1001').prop('disabled', true);
                $('#txtOrgLevelNameW09F1001').prop('disabled', false);
                $('#txtOrgLevelW09F1001').prop('disabled', false);
                $('#txtNotesW09F1001').prop('disabled', false);
                $('#btnSaveW09F1001').prop('disabled', false);
                $('#btnChooseW09F1001').prop('disabled', false);
                $('#btnSaveNextW09F1001').prop('disabled', false);
                $("#gridW09F1001").pqGrid("disable");
                break;
        }
    }

    function closePopupW09F1001(OrgLevelID) {
        console.log(OrgLevelID);
        $("#modalW09F1001").modal('hide');
        reloadComboOrgLevelW091005(OrgLevelID);// reload lại combo tổ chức ở màn hình W09F1005
    }
</script>



