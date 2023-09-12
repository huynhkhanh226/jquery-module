<div class="modal fade" id="modalW15F1020" data-backdrop="static" role="dialog">
    <div class="modal-dialog"  style="width: 50%">
        <div class="modal-content" style = "height: 550px">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading("Danh mục loại chi phí","W15F1020",true,"closePopW15F1020")}}
            </div>

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW15F1020" method="POST">
                    <div class="row form-group">
                        <div class = "col-md-3">
                            <label class="lbl-normal">{{Helpers::getRS($g,"Loai_chi_phi")}}</label>
                        </div>
                        <div class = "col-md-9">
                            <input class="form-control" type="text" id="txtRecCostIDW15F1020"
                                   name="txtRecCostIDW15F1020" value="" placeholder=""  required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class = "col-md-3">
                            <label class="lbl-normal">{{Helpers::getRS($g,"Ten_loai_chi_phi")}}</label>
                        </div>
                        <div class = "col-md-9">
                            <input class="form-control" type="text" id="txtRecCostNameW15F1020"
                                   name="txtRecCostNameW15F1020" value="" placeholder=""  required>
                        </div>
                    </div>
                    <button type="submit" id="btnSave_submitW15F1020" class="hidden"></button>
                </form>
                <div class="row form-group">
                    <div class="col-md-12 col-xs-12">
                        <button type="button" id="frm_btnAddW15F1020"
                                class="btn btn-default smallbtn pull-left mgr5" title="{{Helpers::getRS($g,"Them_moi1")}}">
                            <span class="glyphicon glyphicon-plus text-blue"></span> {{Helpers::getRS($g,"Them_moi1")}}
                        </button>
                        <button type="button" id="btnNotSaveW15F1020"
                                class="btn btn-default smallbtn pull-right  confirmation-notsave"
                                onclick="not_save()"><span
                                    class="glyphicon glyphicon-floppy-remove text-red mgr5"></span>{{Helpers::getRS($g,"Khong_luu")}}
                        </button>
                        <button type="button" id="btnSaveW15F1020" name="btnSaveW15F1020"
                                onclick="ask_save(function(){saveDataW15F1020()})"
                                class="btn btn-default mgr10 smallbtn pull-right"><span
                                    class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                        </button>

                        <!--button type="button" id="btnNextW15F1020" name="btnNextW15F1020"
                                class="btn btn-default smallbtn pull-right mgr10" disabled ><span
                                    class="fa fa-arrow-right text-orange mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                        </button -->
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <div id="gridW15F1020"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var actionW15F1020 = "view";
    var RecCostIDTemp = "";
    var RecCostNameTemp = "";
    $(document).ready(function () {

    });
    var objGridW15F1020 = {
        width: '100%',
        height: $(document).height() - 530,
        editable: false,
        //freezeCols: 2,
        selectionModel: {type: 'row', mode: 'single'},
        minWidth: 30,
        //pageModel: {type: "local", rPP: 20},
        filterModel: {on: false, mode: "AND", header: false},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
        collapsible: false,
        postRenderInterval: -1,
        colModel: [
            {
                title: "", editable: false, minWidth: 30, sortable: false, align: "center", isExport: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW15F1020 mgr10'><i class='glyphicon glyphicon-edit text-orange' style='font-size: 115%'></i></a>";
                    str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW15F1020'><i class='fa fa-trash' style='color:#333;font-size: 115%'></i></a>";
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    //edit button
                    $cell.find(".btnEditW15F1020").bind("click", function (evt) {
                        console.log(rowData);
                        actionW15F1020 = "edit";
                        $('#txtRecCostIDW15F1020').val(rowData['RecCostID']).prop('readonly', true);
                        $('#txtRecCostNameW15F1020').val(rowData['RecCostName']);
                        RecCostIDTemp = rowData['RecCostID'];
                        RecCostNameTemp = rowData['RecCostName'];
                        loadFormW15F1020(actionW15F1020);
                       /* showFormDialogPost('{{url("/W15F1020/$pForm/$g/edit")}}', "modalW09F4011",
                            {

                            },3);*/
                    });
                    $cell.find(".btnDeleteW15F1020").bind("click", function (evt) {
                        console.log(rowData);
                        ask_delete(function () {
                            postMethod('{{url("/W15F1020/$pForm/$g/delete")}}', function (data) {
                                //console.log("test");
                                if (JSON.parse(data).status == "SUCCESS") {
                                    update4ParamGrid($("#gridW15F1020"), "", "delete");
                                    delete_ok(function () {
                                        //loadDataW38F2040();
                                    });
                                } else {
                                    console.log(data);
                                    var rs= JSON.parse(data);
                                    alert_error(rs.message);
                                }
                            }, {
                                RecCostID: rowData["RecCostID"],
                            });
                        });

                    });
                }
            },
            {
                title: "{{Helpers::getRS($g,"Loai_chi_phi")}}",
                minWidth: 230,
                dataType: "string",
                dataIndx: "RecCostID",
                //editor: true,
                align: "left",
            },
            {
                title: "{{Helpers::getRS($g,"Ten_loai_chi_phi")}}",
                minWidth: 230,
                dataType: "string",
                dataIndx: "RecCostName",
               // editor: false,
                align: "left"
            }
        ],
        dataModel: {
            data: {{json_encode($valueGrid)}}
        },
        complete: function (event, ui) {
            loadFormW15F1020('view');
            // console.log(checkAproveCV);
        },
        rowClick: function( event, ui ) {
            var rowData = ui.rowData;
            $('#txtRecCostIDW15F1020').val(rowData['RecCostID']);
            $('#txtRecCostNameW15F1020').val(rowData['RecCostName']);
        }
    };
    var $gridW15F1020 = $("#gridW15F1020").pqGrid(objGridW15F1020);
    $gridW15F1020.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW15F1020.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    setTimeout(function () {
        $gridW15F1020.pqGrid("refreshDataAndView");
    }, 700)


    $('#frm_btnAddW15F1020').click(function () {
        actionW15F1020 = "add";
        $('#txtRecCostIDW15F1020').prop('readonly', false);
        loadFormW15F1020(actionW15F1020);
    });

    function closePopW15F1020(){
        var $grid = $("#gridW15F1020");
        var dataGrid = $grid.pqGrid( "option" , "dataModel.data" );
        reloadRecCostIDComboW75F1066(dataGrid);
        $("#modalW15F1020").modal('hide');
    }

    function not_save() {//khong luu
        var $grid = $("#gridW15F1020");
        var dataGrid = $grid.pqGrid( "option" , "dataModel.data" );
        ask_not_save(function () {
            if(actionW15F1020 == "edit"){// truong hop adit
                $('#txtRecCostIDW15F1020').val(RecCostIDTemp).prop('disabled', true);
                $('#txtRecCostNameW15F1020').val(RecCostNameTemp).prop('disabled', true);
            }
            if(actionW15F1020 == "add"){//truong hop add
                $('#txtRecCostIDW15F1020').val(dataGrid[0].RecCostID).prop('disabled', true);
                $('#txtRecCostNameW15F1020').val(dataGrid[0].RecCostName).prop('disabled', true);
                $grid.pqGrid("setSelection", {rowIndx: 0});
            }
            $('#frm_btnAddW15F1020').prop('disabled', false);
            $('#btnSaveW15F1020').prop('disabled', true);
            $('#btnNotSaveW15F1020').prop('disabled', true);
            $grid.pqGrid("enable");
            //loadFormW15F1020('view');
        });
    }

    function saveDataW15F1020() {
        var txtRecCostIDW15F1020 = $("#txtRecCostIDW15F1020");
        var txtRecCostNameW15F1020 = $("#txtRecCostNameW15F1020");


        txtRecCostIDW15F1020.get(0).setCustomValidity("");
        txtRecCostNameW15F1020.get(0).setCustomValidity("");

        if (txtRecCostIDW15F1020.val() == "") {
            txtRecCostIDW15F1020.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW15F1020").find('#btnSave_submitW15F1020').click();
            txtRecCostIDW15F1020.focus();
            return false;
        }

        if (txtRecCostNameW15F1020.val() == "") {
            txtRecCostNameW15F1020.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW15F1020").find('#btnSave_submitW15F1020').click();
            txtRecCostNameW15F1020.focus();
            return false;
        }
        $.ajax({
            method: "POST",
            url: '{{url("/W15F1020/$pForm/$g/save")}}',
            data: $("#frmW15F1020").serialize() + "&actionW15F1020=" + actionW15F1020,
            success: function (data) {
                var rs = JSON.parse(data);
                switch (rs.status){
                    case "SUCCESS":
                        if(actionW15F1020 == "add"){
                            update4ParamGrid($("#gridW15F1020"), rs.data, 'add');
                        }else{
                            update4ParamGrid($("#gridW15F1020"), rs.data, 'edit');
                        }
                        save_ok(function(){
                            loadFormW15F1020('view');
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

    function loadFormW15F1020(mode){
        var $grid = $("#gridW15F1020");
        var dataGrid = $grid.pqGrid( "option" , "dataModel.data" );
        //$grid.pqGrid("setSelection", {rowIndx: 0});
        console.log(mode);
        switch(mode){
            case "view":
                if(dataGrid.length > 0){
                    if(actionW15F1020 == "edit"){
                        $('#txtRecCostIDW15F1020').prop('disabled', true);
                        $('#txtRecCostNameW15F1020').prop('disabled', true);
                    }else{
                        $('#txtRecCostIDW15F1020').prop('disabled', true).val(dataGrid[0].RecCostID);
                        $('#txtRecCostNameW15F1020').prop('disabled', true).val(dataGrid[0].RecCostName);
                    }
                    $('#frm_btnAddW15F1020').prop('disabled', false);
                    $('#btnSaveW15F1020').prop('disabled', true);
                    $('#btnNotSaveW15F1020').prop('disabled', true);
                    $grid.pqGrid("enable");

                }else{
                    actionW15F1020 = "add";
                    $('#frm_btnAddW15F1020').prop('disabled', true);
                    $('#btnSaveW15F1020').prop('disabled', false);
                    $('#btnNotSaveW15F1020').prop('disabled', false);
                    $('#txtRecCostIDW15F1020').prop('disabled', false);
                    $('#txtRecCostNameW15F1020').prop('disabled', false);
                    $grid.pqGrid("disable");
                }
                break;

            case "add":
                $('#frm_btnAddW15F1020').prop('disabled', true);
                $('#btnSaveW15F1020').prop('disabled', false);
                $('#btnNotSaveW15F1020').prop('disabled', false);
                $('#txtRecCostIDW15F1020').prop('disabled', false).val('');
                $('#txtRecCostNameW15F1020').prop('disabled', false).val('');
                $grid.pqGrid("disable");
                break;

            case "edit":
                $('#frm_btnAddW15F1020').prop('disabled', true);
                $('#btnSaveW15F1020').prop('disabled', false);
                $('#btnNotSaveW15F1020').prop('disabled', false);
                $('#txtRecCostIDW15F1020').prop('disabled', false);
                $('#txtRecCostNameW15F1020').prop('disabled', false);
                $grid.pqGrid("disable");
                break;
        }
    }

</script>