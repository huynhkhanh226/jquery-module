<div class="modal fade" id="modalW75F1066" data-backdrop="static" role="dialog">
    <div class="modal-dialog"  style="width: 70%">
        <div class="modal-content" style = "height: 540px">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading("Thông tin công tác","W75F1066")}}
            </div>

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW75F1066" method="POST">
                    <div id = "animation1W75F1066" class="row form-group">
                        <div class = "col-md-2">
                            <label class="lbl-normal">{{Helpers::getRS($g,"Dia_diem_cong_tac")}}</label>
                        </div>
                        <div class = "col-md-10">
                            <input class="form-control" type="text" id="txtBusinessLocationW75F1066"
                                   name="txtBusinessLocationW75F1066" value="" placeholder=""  required>
                        </div>
                    </div>

                    <div id = "animation2W75F1066" class="row form-group">
                        <div class = "col-md-2">
                            <label class="lbl-normal">{{Helpers::getRS($g,"Noi_dung_di_cong_tac")}}</label>
                        </div>
                        <div class = "col-md-10">
                            <textarea id="txtContentW75F1066" name="txtContentW75F1066" rows="3" style="width:100%" required></textarea>
                        </div>
                    </div>
                    <button type="submit" id="btnSave_submitW75F1066" class="hidden"></button>
                </form>

                <div id = "animation3W75F1066" class="row form-group">
                    <div class="col-md-12">
                        <div id="gridW75F1066"></div>
                    </div>
                </div>
                @if($action == "edit" || $action == "add" || $action == "viewApproved")
                <div id = "animation4W75F1066" class="row form-group">
                    <div class="col-md-12 col-xs-12">
                        <button type="button" id="btnSaveW09F4011" name="btnSaveW75F1066"
                                onclick="ask_save(function(){saveDataW75F1066()})"
                                class="btn btn-default smallbtn pull-right"><span
                                    class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                        </button>

                        <button type="button" id="btnNextW09F4011" name="btnNextW75F1066"
                                class="btn btn-default smallbtn pull-right mgr10 hide" disabled ><span
                                    class="fa fa-arrow-right text-orange mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var action = "{{$action}}";
    var TransIDW75F1066 = "";
    var LinkTransIDW75F1066 = "{{$TransID}}";
    var RecCostIDComboW75F1066 = {{json_encode($RecCostArray)}}; //nguồn combo reccosst
    $(document).ready(function () {
        $('#txtBusinessLocationW75F1066').val("{{isset($rsMaster[0]['BusinessLocation']) ? $rsMaster[0]['BusinessLocation']: ''}}");
        $('#txtContentW75F1066').val("{{isset($rsMaster[0]['Content']) ? $rsMaster[0]['Content']: ''}}");
        TransIDW75F1066 = "{{isset($rsMaster[0]['TransID']) ? $rsMaster[0]['TransID']: ''}}";

        @if($action == "approved" ||$action == "viewApproved")//view từ form duyệt W15F2170
        $('#txtBusinessLocationW75F1066').prop("disabled", true);
        $('#txtContentW75F1066').prop("disabled", true);
        TransIDW75F1066 = "{{isset($rsMaster[0]['TransID']) ? $rsMaster[0]['TransID']: ''}}";
        @endif

        //setTimeout($("#animation1W75F1066").animate({left:'0px'},1000),500);
        $(".modal-body").css('overflow', 'hidden');
    });

    var objGridW75F1066 = {
        width: '100%',
        //height: $(document).height() - 580,
        height: 330,
        editable: true,
        //freezeCols: 2,
        selectionModel: {type: 'row', mode: 'single'},
        minWidth: 30,
        pageModel: {type: "local", rPP: 20},
        filterModel: {on: false, mode: "AND", header: false},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
        collapsible: false,
        postRenderInterval: -1,
        editModel: {
            saveKey: $.ui.keyCode.ENTER,
            select: true,
            keyUpDown: false,
            cellBorderWidth: 0,
            clicksToEdit: 1
        },
        @if($action == "edit" || $action == "add")
        toolbar: {
            items: [
                {
                    type: 'button',
                    label: "{{Helpers::getRS($g,"Them_moi1")}}",
                    icon: 'ui-icon-plus',
                    listener: function () {
                        //RelativesID = RelativesID + 1; //tăng tự động RelativesID
                        //modeEditGrid2 = 0; //thêm mới
                        $grid = $("#gridW75F1066");
                        $grid.pqGrid("saveEditCell");
                        $grid.pqGrid("quitEditMode");
                        defaultValueOnGridW75F1066();
                        reloadRecCostIDComboW75F1066(RecCostIDComboW75F1066)
                    }
                }]
        },
        @endif
        colModel: [
            @if($action == "add" || $action == "edit")
            {
                title: "",
                editable: false,
                minWidth: 30,
                maxWidth: 30,
                dataIndx: "Action",
                sortable: false,
                align: "center",
                render: function (ui) {
                    return "<a class='glyphicon glyphicon-remove text-red' title='{{Helpers::getRS($g,"Xoa")}}' style='font-size: 115%'></a>";
                },
                postRender: function (ui) {
                    var grid = this,$cell = grid.getCell(ui);

                    //edit button
                    $cell.find("a.glyphicon-remove").bind("click", function (evt) {
                        update4ParamGrid($("#gridW75F1066"), null, 'delete');
                    });
                }
            },
            @endif
            {
                title: "{{Helpers::getRS($g,"Loai_chi_phi")}}",
                minWidth: 240,
                dataType: "string",
                dataIndx: "RecCostName",
                require: true,
                @if($action == "add" || $action == "edit")
                    editor: true,
                    editable: true,
                @else
                    editor: false,
                    editable: false,
                @endif
                editor: {
                    type: 'select',
                    valueIndx: "RecCostID",
                    labelIndx: "RecCostName",
                    mapIndices: {"RecCostID": "RecCostID", "RecCostName": "RecCostName"},
                    options: {{json_encode($RecCostArray)}}
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                },
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "RecCostID",
                minWidth: 100,
                dataType: "string",
                dataIndx: "RecCostID",
                editor: false,
                hidden: true,
                require: true,
                isExport: false
            },
            @if($action == "add" || $action == "edit")
            {
                title: "",
                editable: false,
                minWidth: 30,
                maxWidth: 30,
                dataIndx: "ActionAddCost",
                sortable: false,
                align: "center",
                render: function (ui) {
                    return "<a class='glyphicon glyphicon-plus text-blue' id = 'btnAddRecCost' title='{{Helpers::getRS($g,"Them_loai_chi_phi")}}' style='font-size: 115%'></a>";
                },
                postRender: function (ui) {
                    var grid = this,$cell = grid.getCell(ui);

                    //edit button
                    $cell.find("#btnAddRecCost").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W15F1020/$pForm/$g/")}}', "modalW15F1020",
                            {

                            },3);
                    });
                }
            },
            @endif
            {
                title: "{{Helpers::getRS($g,"Chi_phi_du_kien")}}",
                minWidth: 150,
                dataType: "float",
                dataIndx: "PlanCost",
                require: true,
                @if($action == "add" || $action == "edit")
                    editor: true,
                    editable: true,
                @else
                    editor: false,
                    editable: false,
                @endif
                align: "right",
                format: "{{Helpers::getStringFormat(2)}}",
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                },

            },
            {
                title: "{{Helpers::getRS($g,"Chi_phi_thuc_te")}}",
                minWidth: 150,
                dataType: "float",
                dataIndx: "Cost",
                @if($action == "add" || $action == "edit")
                    editor: false,
                    editable: false,
                @else
                    editor: true,
                    editable: true,
                @endif
                align: "right",
                format: "{{Helpers::getStringFormat(2)}}",
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                },
            }
        ],
        dataModel: {
            data: {{json_encode($valueGrid)}}
        },
        complete: function (event, ui) {
            var $grid = $("#gridW75F1066");
            var clRecCostID = $grid.pqGrid( "getColumn",{ dataIndx: "RecCostName" } );
            var PlanCost = $grid.pqGrid( "getColumn",{ dataIndx: "PlanCost" } );
            var Cost = $grid.pqGrid( "getColumn",{ dataIndx: "Cost" } );
            //var PlanCost = $grid.pqGrid( "getColumn",{ dataIndx: "PlanCost" } );
           /* if(action == "viewApproved"){//trường hợp mở từ lưới để xem
                clRecCostID.editable = false;
                PlanCost.editable = false;
                Cost.editor = true;
                Cost.editable = true;
                //Action.hidden = true;
            }*/
            if(action == "approved"){
                $grid.pqGrid("disable");
            }else{
                $grid.pqGrid("enable");
            }

        },
        rowClick: function (event, ui) {
            var $grid = $("#gridW75F1066");
            console.log(ui.rowData);
        }
    };
    var $gridW75F1066 = $("#gridW75F1066").pqGrid(objGridW75F1066);
    $gridW75F1066.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW75F1066.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    setTimeout(function () {
        $gridW75F1066.pqGrid("refreshDataAndView");
    }, 700)

    //load lai combo chi phi sau khi them
    function reloadRecCostIDComboW75F1066(data){
        RecCostIDComboW75F1066 = data;
        var $grid = $("#gridW75F1066");
        var clRecCostID = $grid.pqGrid( "getColumn",{ dataIndx: "RecCostName" } );
        clRecCostID.editor.options = data;
        $grid.pqGrid( "refreshDataAndView");
    }

    function defaultValueOnGridW75F1066(){
        //alert("ádsd");
        $grid = $("#gridW75F1066");
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
        var idx = $grid.pqGrid("addRow",
            {rowData: {
            }}
        );
        var rowData = $grid.pqGrid( "getRowData", {rowIndx: idx} );
        $grid.pqGrid("refreshDataAndView");
        $grid.pqGrid("setSelection", {rowIndx: idx, colIndx: 1});
    }

    function saveDataW75F1066() {
        //alert("da chay vao save");
        var txtBusinessLocationW75F1066 = $("#txtBusinessLocationW75F1066");
        var txtContentW75F1066 = $("#txtContentW75F1066");

        txtBusinessLocationW75F1066.get(0).setCustomValidity("");
        txtContentW75F1066.get(0).setCustomValidity("");


        if (txtBusinessLocationW75F1066.val() == "") {
            //alert("da chay");
            //console.log(slApprovalFlowIDW38F2041.val());
            txtBusinessLocationW75F1066.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Dia_diem_cong_tac')}}");
            $("#frmW75F1066").find('#btnSave_submitW75F1066').click();
            txtBusinessLocationW75F1066.focus();
            return false;
        }

        if (txtContentW75F1066.val() == "") {
            //alert("da chay");
            //console.log(txtYearW38F2041.val());
            txtContentW75F1066.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Noi_dung_di_cong_tac')}}");
            $("#frmW75F1066").find('#btnSave_submitW75F1066').click();
            txtContentW75F1066.focus();
            return false;
        }


      //kiểm tra lưới có DL hay chưa
        var dataGridW75F1066 = $("#gridW75F1066").pqGrid("option", "dataModel.data");
        /* if(dataGridW75F1066.length == 0){
           alert_warning('Dữ liệu trên lưới chưa được nhập');
           return false;
       }*/

        var $grid = $("#gridW75F1066");
        console.log("hihi");
        var obj = $grid.pqGrid("option", "dataModel.data");
        var colModel = $grid.pqGrid("option", "colModel");
        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        for (var i = 0; i < obj.length; i++) {
            for (var j = 0; j < colModel.length; j++) {
                var isEditCell = $grid.pqGrid("isEditableCell", {rowIndx: i, dataIndx: [colModel[j].dataIndx]})
                if (colModel[j].require && isNullOrEmpty(obj[i][colModel[j].dataIndx]) && isEditCell) {
                    $grid.pqGrid("setSelection", {
                        rowIndx: i,
                        colIndx: j
                    });
                    $grid.pqGrid("editCell", {rowIndx: i, dataIndx: colModel[j].dataIndx});
                    var cell = $grid.pqGrid("getEditCell");
                    var $editor = cell.$editor;
                    $($editor).confirmation({
                        btnOkLabel: '',
                        btnCancelLabel: '',
                        popout: true,
                        placement: "bottom",
                        singleton: true,
                        template:
                        '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                        + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                        + askMessage
                        + '</label></span></div>'
                        + '</div>'
                    });
                    $($editor).confirmation('show');
                    e.stopPropagation();
                    e.preventDefault();
                    return;
                }

            }
        }

        dataGridW75F1066 = reformatData(dataGridW75F1066, $("#gridW75F1066"));

        $.ajax({
            method: "POST",
            url: '{{url("/W75F1066/$pForm/$g/save")}}',
            data: {
                txtContentW75F1066: txtContentW75F1066.val(),
                txtBusinessLocationW75F1066: txtBusinessLocationW75F1066.val(),
                action: action,
                dataGrid: JSON.stringify(dataGridW75F1066),
                TransIDW75F1066: TransIDW75F1066,
                LinkTransIDW75F1066: LinkTransIDW75F1066
            },
            success: function (data) {
                var rs = JSON.parse(data);
                console.log(rs);
                switch (rs.status){
                    case "SUCCESS": //Gửi mail ngầm
                        updateTransIDfromW75F1066(rs.TransID); //update khóa chính của Công Tác để gởi sang màn hình W75F1065
                        save_ok(function(){
                            load_tableW75F1065_fromW75F1066();
                        });
                        break;
                    case "ERROR": //Lỗi khi run SQL
                        //save_not_ok();
                        alert_error(rs.message);
                        break;
                }
            }
        });
    }
</script>