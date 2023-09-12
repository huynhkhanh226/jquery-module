<div id="gridW75F2041_2"></div>
<script type="text/javascript">
    //var iW75F2130_Height = $(document).height() - 630;
    var RelativesID = 0;
    var modeEditGrid2 = 1; // biến phân biệt edit lưới 2 //0: thêm mới 1: sửa
    var obj = {
        width: '100%',
        height: $(document).height() - 230,
        editable: true,
        freezeCols: 2,
        selectionModel: {type: 'row'},
        minWidth: 30,
        // pageModel: {type: "local", rPP: 20},
        //filterModel: {on: true, mode: "AND", header: true},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
        collapsible: false,
        postRenderInterval: -1,
        @if(intval($Participation) == 0)
        editable: false,
        @else
        editable: true,
        @endif
        editModel: {
            saveKey: $.ui.keyCode.ENTER,
            select: true,
            keyUpDown: false,
            cellBorderWidth: 0,
            clicksToEdit: 1
        },
        @if(intval($Participation) == 1)
        toolbar: {
            items: [
                {
                    type: 'button',
                    label: "{{Helpers::getRS($g,"Them_moi1")}}",
                    icon: 'ui-icon-plus',
                    listener: function () {
                        //RelativesID = RelativesID + 1; //tăng tự động RelativesID
                        modeEditGrid2 = 0; //thêm mới
                        $grid = $("#gridW75F2041_2");
                        $grid.pqGrid("saveEditCell");
                        $grid.pqGrid("quitEditMode");
                        defaultValueOnGridW75F2041_2();
                    }
                }]
        },
        @endif
        colModel: [
            {
                title: "", editable: false, minWidth: 50, sortable: false, align: "center", isExport: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW75F2041'><i class='fa fa-trash' style='color:#333'></i></a>";
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    $cell.find(".btnDeleteW75F2041").bind("click", function (evt) {
                        console.log(rowData);
                        ask_delete(function () {
                            //$("#gridW75F2041_2").pqGrid( "deleteRow", { rowIndx: rowIndx} );
                            $.ajax({
                                method: "POST",
                                url: '{{url("/W75F2041/$pForm/$g/deleteRow")}}',
                                data: {
                                    BenefitID: rowData.BenefitID,
                                    EmployeeID: rowData.EmployeeID,
                                    RelativesID: rowData.RelativesID
                                },
                                success: function (data) {
                                    if (JSON.parse(data).status == "SUCCESS") {
                                        delete_ok(function () {
                                            //loadDataW38F2040();
                                            $("#gridW75F2041_2").pqGrid( "deleteRow", { rowIndx: rowIndx} );
                                        });
                                    } else {
                                        alert_error(data.message);
                                    }
                                }
                            });

                        });
                    });
                }
            },
            {
                title: "EmployeeID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "EmployeeID",
                hidden: true,
                isExport: false
            },
            {
                title: "EmployeeID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "EmployeeID",
                hidden: true,
                isExport: false
            },
            {
                title: "BenefitID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "BenefitID",
                hidden: true,
                isExport: false
            },
            {
                title: "RelativesID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "RelativesID",
                hidden: true,
                isExport: false
            },
            {
                title: "Sex",
                minWidth: 170,
                dataType: "integer",
                dataIndx: "Sex",
                hidden: true
            },
            {
                title: "{{Helpers::getRS($g,"Ho_ten_")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "RelativesName",
                editor: true,
                editable: true,
                required: true
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Ngay_sinh")}}",
                minWidth: 100,
                dataType: "date",
                dataIndx: "Birthdate",
                editor: true,
                editable: true,
                align: "center",
                required: true,
                editor: {
                    //type: dateEditor
                    type: 'textbox',
                    init: dateEditor,
                    getData: getCustomData,
                }
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"So_CMND")}}",
                minWidth: 100,
                dataType: "string",
                dataIndx: "NumIDCard",
                editor: true,
                editable: true,
                align: "center"
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Gioi_tinh")}}",
                minWidth: 100,
                dataType: "string",
                dataIndx: "SexName",
                editor: true,
                editable: true,
                required: true,
                editor: {
                    type: 'select',
                    valueIndx: "Sex",
                    labelIndx: "SexName",
                    mapIndices: {"Sex": "Sex", "SexName": "SexName"},
                    options: {{json_encode($cbSex)}}
                }
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"So_dien_thoai")}}",
                minWidth: 100,
                dataType: "string",
                dataIndx: "Tel",
                editor: true,
                editable: true,
                align: "center"
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Quan_he")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "Relationship",
                editor: true,
                editable: true
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "Notes",
                editor: true,
                editable: true
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }

        ],
        dataModel: {
            data: {{json_encode($valueGrid2)}}
        },
        rowClick: function(event,ui){
            console.log(ui.rowData);
        },
        cellSave: function (event, ui) {
            console.log("cellSave");
            ui.rowData.IsUpdate = 1;
            $("#gridW75F2041_2").pqGrid("refreshDataAndView");
        },
        complete: function (event, ui) {
            //console.log('complete grid 1');
            var gird2value = $("#gridW75F2041_2").pqGrid("option", "dataModel.data");
            if (gird2value.length > 0) {
                console.log(gird2value.length);
                RelativesID = gird2value.length + 1;
                //$("#gridW75F2041_1").pqGrid("setSelection", {rowIndx: 0});
                //var rowData = getRowSelection($("#gridW75F2041_1"));
            }
        },
        cellBeforeSave: function( event, ui ) {
            var $gridW75F2041_2 = $("#gridW75F2041_2");
            var newVal = ui.newVal;
            var rowData = ui.rowData,
                dataIndx = ui.dataIndx,
                rowIndx = ui.rowIndx;
            //alert(dataIndx);
            if((dataIndx == 'NumIDCard' && newVal.length > 12) || (dataIndx == 'Tel' && newVal.length > 12)){
                var msg = "{{Helpers::getRS($g,"Gia_tri_nhap_vuot_qua_so_ky_tu_cho_phep")}}";
                $gridW75F2041_2.pqGrid("quitEditMode");
                $gridW75F2041_2.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                var obj = $gridW75F2041_2.pqGrid("getEditCell");
                var $editor = obj.$editor;
                $($editor).val(newVal);
                $($editor).confirmation({
                    btnOkLabel: '',
                    btnCancelLabel: '',
                    popout: true,
                    placement: "bottom",
                    singleton: true,
                    template:
                    '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                    + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                    + msg
                    + '</label></span></div>'
                    + '</div>'
                });
                $($editor).confirmation('show');
                return false;
            }
        },
    };
    var $gridW75F2041_2 = $("#gridW75F2041_2").pqGrid(obj);
    $gridW75F2041_2.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW75F2041_2.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    setTimeout(function () {
        $gridW75F2041_2.pqGrid("refreshDataAndView");
    }, 700)

    function defaultValueOnGridW75F2041_2(){
        $grid = $("#gridW75F2041_2");
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
       /* var rowList = $.grep(fixData, function(data, i){
            return data["DepartmentID"] == $("#cboDepartmentIDW25F2081").val() && data["TeamID"] == "" && data["DutyID"] == "" && data["WorkID"] == "" ;
        });
        if (rowList.length > 0){
            var NormQuan = rowList[0]["NormQuan"];
            var PresentQuan = rowList[0]["PresentQuan"];

        }else{
            var NormQuan = null;
            var PresentQuan = null;
        }*/
        var idx = $grid.pqGrid("addRow",
            {rowData: {
                EmployeeID: "{{$EmployeeID}}",
                BenefitID: "{{$BenefitID}}",
                RelativesID: RelativesID
            }}
        );
        var rowData = $grid.pqGrid( "getRowData", {rowIndx: idx} );
        //rowData["NormQuan"] = NormQuan;
        //rowData["PresentQuan"] = PresentQuan;
        $grid.pqGrid("refreshDataAndView");
        $grid.pqGrid("setSelection", {rowIndx: idx, colIndx: 1});
    }

    var newDate = null;
    var dateEditor = function (ui) {
        var $inp = ui.$cell.find("input"),
            grid = this;
        //initialize the editor
        $inp.datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi',
            todayHighlight: true,
            showOnFocus: true,
            toggleActive: true,
            allowDeselection: false,
            defaultViewDate: '',
            isDateGrid: true
        }).on('changeDate', function (d) {
            var da = (new Date(d.date)).toString('dd/MM/yyyy');
            //alert(da);
            newDate = da;
        });
    }

    var getCustomData = function (ui) {
        return newDate;
    }
</script>