<div id="pqgrid_W75F1010" style="margin:auto;"></div>
<script type="text/javascript">
    $(document).ready(function () {
        iW75F1010Height = $(".nav-tabs-custom").height() - 70;
        var obj = {
            //width: 765,
            height: 220,
            showTitle: false,
            collapsible: false,
            editable: false,
            scrollModel:{ horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none' },
            postRenderInterval: -1,
            selectionModel: {type: 'row', mode: 'single'},
            rowClick : function(event, ui) {
                console.log('rowSelect');
                var rowData =  ui.rowData;
                if (sIDload != ui.rowData["TransID"])
                {
                    /*$("#frmW75F1010").find("#hdW75F1010_TransID").val(ui.rowData["TransID"]);
                    $("#frmW75F1010").find("#slPropertyID").val(ui.rowData["PropertyID"]);
                    $("#frmW75F1010").find("#txtW75F1010_Val").val(ui.rowData["PropertyValueU"]);
                    $("#frmW75F1010").find("#txtW75F1010_Note").val(ui.rowData["Notes"]);
                    $("#txtW75F1010_CurVal").val($('#slPropertyID option:selected').attr('prevalue'));
                    sIDload = ui.rowData["TransID"];*/
                    console.log(rowData);
                        //alert($('#slProvinceIDW75F1010').val());
                    $.ajax({
                        method: "POST",
                        url: '{{url("/W75F1010/ProvinceChange")}}',
                        data: "&slProvinceID=" + rowData.ProvinceID,
                        success: function (data) {
                            $('#slDistrictIDW75F1010').html(data);
                            console.log(rowData.DistrictID);
                            if(rowData.DistrictID != ""){
                                $('#slDistrictIDW75F1010').val(rowData.DistrictID);
                            }
                        }
                    });
                    $.ajax({
                        method: "POST",
                        url: '{{url("/W75F1010/DistrictChange")}}',
                        data: "&slDistrictID=" + rowData.DistrictID,
                        success: function (data) {
                            $('#slWardIDW75F1010').html(data);
                            if(rowData.WardID != ""){
                                $('#slWardIDW75F1010').val(rowData.WardID);
                            }
                        }
                    });
                    setData(rowData);
                }

            },
            complete: function(event, ui){
                console.log('complete');
                if ($("#pqgrid_W75F1010").pqGrid("option", "dataModel.data").length > 0) {
                    $("#pqgrid_W75F1010").pqGrid("setSelection", {rowIndx: 0});
                    var rowData = getRowSelection($("#pqgrid_W75F1010"));
                    setData(rowData);
                    NormalMode();
                } else {
                    $("#frmW75F1010").find("#frm_btnAdd").trigger('click');
                }
            }
        };

        function setData(rowData){
            console.log(rowData);
            $("#frmW75F1010").find("#hdW75F1010_TransID").val(rowData["TransID"]);
            $("#frmW75F1010").find("#slPropertyID").val(rowData["PropertyID"]);
            $("#frmW75F1010").find("#txtW75F1010_Val").val(rowData["PropertyValueU"]);
            $("#frmW75F1010").find("#txtW75F1010_Note").val(rowData["Notes"]);
            $("#frmW75F1010").find("#slProvinceIDW75F1010").val(rowData["ProvinceID"]);
            console.log(rowData["DistrictID"]);
            $("#frmW75F1010").find("#slDistrictIDW75F1010").val(rowData["DistrictID"]);
            //$("#frmW75F1010").find("#slDistrictIDW75F1010").trigger('change');
            console.log(rowData["WardID"]);
            $("#frmW75F1010").find("#slWardIDW75F1010").val(rowData["WardID"]);

            $("#frmW75F1010").find("#slLabelProvinceW75F1010").val(rowData["LabelProvince"]);
            $("#frmW75F1010").find("#slLabelDistrictW75F1010").val(rowData["LabelDistrict"]);
            $("#frmW75F1010").find("#slLabelWardW75F1010").val(rowData["LabelWard"]);

            $("#frmW75F1010").find("#slAddressNameW75F1010").val(rowData["AddressName"]);
            $("#txtW75F1010_CurVal").val($('#slPropertyID option:selected').attr('prevalue'));
            sIDload = rowData["TransID"];
        }
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'TransID')}}",
                dataType: "string",
                align: "center",
                dataIndx: "TransID",
                hidden:true
            },
            {
                title: "{{Helpers::getRS($g,'PropertyID')}}",
                dataType: "string",
                align: "center",
                dataIndx: "PropertyID",
                hidden:true
            },
            {
                title: "",
                minWidth: 40,
                dataType: "string",
                dataIndx: "Edit",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (rowData["Approved"]==0)
                        return " <a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW75F1010'><i class='glyphicon glyphicon-edit text-orange no-border'></i></a> " +
                                " <a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW75F1010'><i class='fa fa-trash' style='padding-right:5px'></i></a>";
                    else
                        return '<i class="fa fa-lock disabled text-red"></i>';
                },
                postRender: function (ui) {
                    if (this.isEditableCell(ui) == true) {
                        var rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);

                        $cell.find("a#btnEditW75F1010")
                                .unbind("click")
                                .bind("click", function (evt) {
                                    $gridW75F1010 = $("#pqgrid_W75F1010")
                                    var obj = $gridW75F1010.pqGrid( "getEditCell" );
                                    var $editor = obj.$editor;
                                    var $tr = $(this).closest("tr"),
                                    rowIndx = $gridW75F1010.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                    var rowData = $gridW75F1010.pqGrid("getRowData", {rowIndx: rowIndx});
                                    edit_W75F1010(rowIndx, $gridW75F1010);
                                });
                        $cell.find("a#btnDeleteW75F1010")
                                .unbind("click")
                                .bind("click", function (evt) {
                                    $gridW75F1010 = $("#pqgrid_W75F1010")
                                    var obj = $gridW75F1010.pqGrid( "getEditCell" );
                                    var $editor = obj.$editor;
                                    var $tr = $(this).closest("tr"),
                                    rowIndx = $gridW75F1010.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                    var rowData = $gridW75F1010.pqGrid("getRowData", {rowIndx: rowIndx});
                                    delete_W75F1010(rowIndx, $gridW75F1010);
                                });
                    }

                }
            },
            {
                title: "{{Helpers::getRS($g,'Ngay')}}",
                minWidth: 60,
                dataType: "string",
                dataIndx: "TransDate",
                align: "center"
            },
            {
                title: "{{Helpers::getRS($g,'Thong_tin')}}",
                minWidth: 110,
                dataType: "string",
                dataIndx: "PropertyName"
            },
            {
                title: "{{Helpers::getRS($g,'Gia_tri_de_xuat')}}",
                minWidth: 110,
                dataType: "string",
                dataIndx: "PropertyValueU"
            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                minWidth: 100,
                dataType: "string",
                dataIndx: "Notes"
            },
            {
                title: "{{Helpers::getRS($g,'Da_duyet')}}",
                width: 50,
                minWidth: 50,
                dataType: "string",
                dataIndx: "Approved",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input type="checkbox" disabled ' + (rowData["Approved"] == 1?"checked":"") + '>';
                }
            }
        ];
        obj.dataModel = {
            data: {{json_encode($rs)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        obj.create = function (evt, ui) {
            var val = $("#chkShowLock").is(":checked") ? "" : 0;
            $("#pqgrid_W75F1010").pqGrid("filter", {
                oper: 'replace',
                data: [
                    {dataIndx: 'Approved', condition: 'equal', value: val}
                ]
            });
            console.log(bSelect);
            if (bSelect==1)
                $("#pqgrid_W75F1010").pqGrid("setSelection", {rowIndx: 0});
        };

        var $grid = $("#pqgrid_W75F1010").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
        setTimeout(function(){
            $grid.pqGrid("refreshDataAndView");
        },1000);
    });

    function ModeEdit() {
        console.log('ModeEdit');
        mod = "edit";
        ActionMode();
        //$("#frmW75F1010").find("#hdActionW75F1010").val('edit');
        $("#frmW75F1010").find("#slPropertyID").attr('disabled','disabled');
    }

    function delete_W75F1010(rowIndx, $grid) {
        $("#frmW75F1010").find(".alert-success").addClass('hide');
        $("#frmW75F1010").find(".alert-danger").addClass('hide');
        ask_delete(function(){
            callurl = '{{url("/W75F1010/del")}}';
            $.ajax({
                method: "POST",
                url: callurl,
                data: {hdW75F1010_TransID: $("#hdW75F1010_TransID").val()},
                success: function (data) {
                    if (data != "0" && data != "") {
                        $("#pqgrid_W75F1010").pqGrid("deleteRow", {rowIndx: rowIndx});
                        $("#pqgrid_W75F1010").pqGrid("setSelection", {rowIndx:0});
                        $("#pqgrid_W75F1010").pqGrid("refreshDataAndView");
                        NormalMode();
                    }
                    else {
                        if (data == 0) $("#frmW75F1010").find("#err").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}')
                        $("#frmW75F1010").find(".alert-success").addClass('hide');
                        $("#frmW75F1010").find(".alert-danger").removeClass('hide');
                    }
                }
            });
        },rowIndx);
    }

    function edit_W75F1010(rowIndx, $grid) {
        ModeEdit();
    }

</script>