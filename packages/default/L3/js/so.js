/**
 * Created by HUYNH KHANH
 */
// ẩn hiện cột khi thay đổi nội ngoại tệ
var soel = $("div#grid_SO");
var isChecking = false;
function showHideColumn(hidden) {
    soel.pqGrid("getColumn", {dataIndx: "CAmountTmp"}).hidden = hidden;
    soel.pqGrid("getColumn", {dataIndx: "CReduce"}).hidden = hidden;
    soel.pqGrid("getColumn", {dataIndx: "CVAT"}).hidden = hidden;
    soel.pqGrid("getColumn", {dataIndx: "CAmount"}).hidden = hidden;
    var colM = soel.pqGrid("option", "colModel");
    soel.pqGrid("option", "colModel", colM);
    soel.pqGrid("refresh");
}
// xủ lý cập nhật dòng trên lưới
function updateCurrentRow(idx, obj, nextDataIndx) {
    var rowData = soel.pqGrid("getRowData", {rowIndx: idx});
    for (var key in obj) {
        rowData[key] = obj[key];
        soel.pqGrid("refreshCell", {rowIndx: idx, dataIndx: key});
    }
    soel.pqGrid("scrollColumn", {dataIndx: nextDataIndx});
    if (nextDataIndx != "") {
        //soel.pqGrid("saveEditCell");//Kích hoạt sự kiện change
        soel.pqGrid("quitEditMode");
        soel.pqGrid("setSelection", {rowIndx: idx, colIndx: soel.pqGrid("getColIndx", {dataIndx: nextDataIndx})});
    }
}
//update khi chon ma hang
function updateRowGridSO(rowdt) {
    var obj = {
        "InventoryID": rowdt.InventoryID,
        'InventoryName': rowdt.InventoryName,
        'UnitID': rowdt.UnitID,
        "ConversionFactor": rowdt.ConversionFactor,
        "IsService": rowdt.IsService,
        "IsKit": rowdt.IsKit,
    };
    updateCurrentRow(gbRowIndx, obj, "Quantity");
    //Trường hợp cột có dropdown thì sẽ không chạy event change value được. Nên phải tự update ở đây
    updateRelationColums(gbRowIndx);//Tinh toan lai toan bo  row va sum,
}
//update khi chon ma hang
function updateUnitID(rowdt) {
    var obj = {
        'UnitID': rowdt.UnitID
    };
    updateCurrentRow(gbRowIndx, obj, "Quantity");
    updateRelationColums(gbRowIndx);//Tinh toan lai toan bo  row va sum,
}
// xử lý cập nhật dòng khi thay đổi loại thuế
function updateRowGridSOFromListVAT(rowdt) {
    var obj = {
        "VATGroupID": rowdt.VATGroupID,
        "VATRate": rowdt.VATRate * 100
    };
    updateCurrentRow(gbRowIndx, obj, "VATGroupID"); // thoát edit cell, nhưng không focus đâu hết
    updateRelationColums(gbRowIndx);//Tinh toan lai toan bo  row va sum,
}
// xử lý cập nhật toàn bộ khi thay đổi tỷ giá
function updateSO() {
    var gridData = soel.pqGrid("option", "dataModel.data");
    var rows = gridData == null ? 0 : gridData.length;
    for (i = 0; i < rows; i++) {
        updateRelationColums(i);
    }
}
// xử lý cập nhật toàn bộ khi thay đổi tỷ giá
function updateRelationColums(gbRowIndx) {
    //////console.log('updateRelationColums');
    var ExchangeRate = correctNumber($("#txtExchangeRate").val());
    var rowData = soel.pqGrid("getRowData", {rowIndx: gbRowIndx});
    //if (!isNullOrEmpty(rowData.InventoryID)) {
    //Đơn giá
    var UnitPrice = correctNumber(undefinedToZero(rowData.UnitPrice, rowData));
    //Số lượng
    var Quantity = correctNumber(undefinedToZero(rowData.Quantity, rowData))
    //Thành tiền
    var OAmountTmp = correctNumber(UnitPrice) * correctNumber(Quantity);
    //Tỉ lệ chiết khấu
    var RateReduce = correctNumber(undefinedToZero(rowData.RateReduce, rowData));
    //Tiền chiết khấu
    var OriginalReduce = RateReduce * OAmountTmp / 100;
    //Tiền chiết khấu quy đổi
    var CQuantity, CReduce, CAmountTmp, CVAT, Amount, CAmount;
    //Tiền thuế nguyên tệ
    var OVAT = OAmountTmp * correctNumber(undefinedToZero(rowData.VATRate, rowData)) / 100;
    //Tổng tiền nguyên Tệ
    Amount = OAmountTmp - OriginalReduce + OVAT;
    if (vl_operator == 0) {
        CQuantity = Quantity * correctNumber(undefinedToZero(rowData.ConversionFactor));
        CAmountTmp = OAmountTmp * ExchangeRate; //Thành tiền quy đổi
        CReduce = OriginalReduce * ExchangeRate;//Chiết khấu quy đổi
        CVAT = OVAT * ExchangeRate; //Tiền thuế quy đổi
        CAmount = Amount * ExchangeRate //Tổng tiền quy đổi
    }
    else {
        if (ExchangeRate == 0)
            ExchangeRate = 1;
        CQuantity = Quantity / ExchangeRate;
        CAmountTmp = OAmountTmp / ExchangeRate;
        CReduce = OriginalReduce / ExchangeRate;
        CVAT = OVAT / ExchangeRate;
        CAmount = Amount / ExchangeRate
    }
    var obj = {
        "CQuantity": CQuantity,
        "OAmountTmp": OAmountTmp,
        "CAmountTmp": CAmountTmp,
        "OriginalReduce": OriginalReduce,
        "CReduce": CReduce,
        "OVAT": OVAT,
        "CVAT": CVAT,
        "Amount": Amount,
        "CAmount": CAmount
    };

    updateCurrentRow(gbRowIndx, obj, "");
    //}
    updateTotalSO();
}
// alt+G => xuống lưới nhập liệu
/*$(document).on("keydown", '#modalW05F1602', function (e) {
    //alert('Keydown');
    var code = e.keyCode || e.which;
    if (e.altKey && code == 71) {
        //////console.log('altKey123');
        master = false;
        var rowCount = soel.pqGrid("option", "dataModel.data");
        if (rowCount == null || rowCount.length == 0) {
            soel.pqGrid("addRow",
                {rowData: {}}
            );
            soel.pqGrid("setSelection", {rowIndx: 0, colIndx: 0});
        }
        else {
            $("div#grid_SO").pqGrid("saveEditCell");
            $("div#grid_SO").pqGrid("quitEditMode");
            $("div#grid_SO").pqGrid("setSelection", {rowIndx: 0, colIndx: 0});
        }
    }

    //Ctrl + shift + L to save
    if (e.ctrlKey && e.shiftKey && code == 76 && $("#frmW05F1602").find('#frm_btnSave').is(":disabled") == false){
        console.log('Save');
        $("#frmW05F1602").find('#frm_btnSave').click();
    }
    //Ctrl + shift + L to save
    if (e.ctrlKey && e.shiftKey && code == 78 && $("#frmW05F1602").find('#frm_btnReset').is(":disabled") == false){
        console.log('Next');
        $("#frmW05F1602").find('#frm_btnReset').click();
    }
    //Ctrl + shift + L to save
    if (e.ctrlKey && e.shiftKey && code == 83 && $("#frmW05F1602").find('#frm_btnEdit').is(":disabled") == false){
        console.log('Edit');
        $("#frmW05F1602").find('#frm_btnEdit').click();
    }
    //Ctrl + shift + L to save
    if (e.ctrlKey && e.shiftKey && code == 75 && $("#frmW05F1602").find('#frm_btnECancel').is(":disabled") == false){
        console.log('Not Save');
        $("#frmW05F1602").find('#frm_btnECancel').click();
    }
});*/
$("#modalW05F1602").keydown(function (e) {
    //alert('Keydown');
    var code = e.keyCode || e.which;
    if (e.altKey && code == 71) {
        //////console.log('altKey123');
        master = false;
        var rowCount = soel.pqGrid("option", "dataModel.data");
        if (rowCount == null || rowCount.length == 0) {
            soel.pqGrid("addRow",
                {rowData: {}}
            );
            soel.pqGrid("setSelection", {rowIndx: 0, colIndx: 0});
        }
        else {
            $("div#grid_SO").pqGrid("saveEditCell");
            $("div#grid_SO").pqGrid("quitEditMode");
            $("div#grid_SO").pqGrid("setSelection", {rowIndx: 0, colIndx: 0});
        }
    }

    //Ctrl + shift + S to save
    if (e.ctrlKey && e.shiftKey && code == 83 && $("#frmW05F1602").find('#frm_btnSave').is(":disabled") == false){
        console.log('Save');
        $("#frmW05F1602").find('#frm_btnSave').click();
    }
    //Ctrl + shift + A to Next
    if (e.ctrlKey && e.shiftKey && code == 65 && $("#frmW05F1602").find('#frm_btnReset').is(":disabled") == false){
        console.log('Next');
        $("#frmW05F1602").find('#frm_btnReset').click();
    }
    //Ctrl + shift + E to Edit
    if (e.ctrlKey && e.shiftKey && code == 69 && $("#frmW05F1602").find('#frm_btnEdit').is(":disabled") == false){
        console.log('Edit');
        $("#frmW05F1602").find('#frm_btnEdit').click();
    }
    //Ctrl + shift + C to Cancel
    if (e.ctrlKey && e.shiftKey && code == 67 && $("#frmW05F1602").find('#frm_btnECancel').is(":disabled") == false){
        console.log('Not Save');
        $("#frmW05F1602").find('#frm_btnECancel').click();
    }
});
function searchInJson($jsonobject, $str) {
    var rs = [];
    //Luan viet code cui bap. Khanh sua lai. Hehe
    /*$.each($jsonobject, function (i, v) {
     if (v.VATGroupID.toLowerCase().indexOf(locdau($str.trim())) >= 0) {
     rs.push(v);
     }
     });*/

    var rs = $.grep($jsonobject, function (data, index) {
        //console.log(data);
        return data.VATGroupID.toUpperCase().indexOf($str.trim().toUpperCase()) >= 0;
    });

    return rs;
}
// xóa toàn bộ dữ liệu trên lưới
function clearGrid() {
    soel.pqGrid('option', 'dataModel.data', []);
    soel.pqGrid('refreshView');
    updateTotalSO();
}
// kiểm tra dữ liệu đã nhập đầy đủ hay chưa
function checkDataSO() {
    return true;
}
// lưới nhập liêu
var gbRowIndx = -1;
var gbElement = null;
var colM = [
    //Reuire
    {
        title: ListTitleSO[0],
        dataIndx: "InventoryID", width: 180,
        dataType: "string",
        showGrid: true,
        required: true,
        //cls: "gridColRequire",
        //validations: [{type: 'minLen', value: 1, msg: 'Required'}]
        render: function (ui) {
            return {
                cls: 'gridColRequire'
            };
        },

    },
    {
        title: ListTitleSO[1], width: 250,
        dataIndx: "InventoryName",
        dataType: "string",
        editable: false,
        editor: {select: true},
        editModel: {keyUpDown: true},
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
    },

    {
        title: ListTitleSO[2],
        dataIndx: "UnitID",
        dataType: "string",
        width: 60,
        align: "center",
        showGrid: true,
        required: true,
        render: function (ui) {
            return {
                cls: 'gridColRequire'
            };
        },
        //validations: [{type: 'minLen', value: 1, msg: 'Required'}]
    },

    {
        title: ListTitleSO[3],
        dataIndx: "Quantity",
        dataType: "float",
        width: 80,
        align: "right",
        required: true,
        render: function (ui) {
            return {
                cls: 'gridColRequire'
            };
        },
        //validations: [{type: 'minLen', value: 1, msg: 'Required'}],
        numberFormat: D07_QuantityDecimals,
        format: quantityFormatString,

    },

    {
        title: ListTitleSO[4],
        dataIndx: "UnitPrice",
        dataType: "float",
        width: 110,
        align: "right",
        required: true,
        render: function (ui) {
            return {
                cls: 'gridColRequire'
            };
        },
        numberFormat: UnitPriceDecimalPlaces,
        format: unitPriceFormatString

    },
    {
        title: ListTitleSO[5],
        dataIndx: "OAmountTmp",
        dataType: "float",
        width: 140,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        numberFormat: DecimalPlaces,
        format: decimalFormatString

    },
    {
        title: ListTitleSO[6],
        dataIndx: "CAmountTmp",
        dataType: "float",
        width: 140,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        hidden: true,
        numberFormat: D90_ConvertedDecimals,
        format: convertDecimalFormatString

    },
    {
        title: ListTitleSO[7],
        dataIndx: "RateReduce",
        dataType: "float",
        width: 90,
        align: "right", //Khanh chuyển sang màu bắt buộc nhập
        numberFormat: ExchangeRateDecimals,
        format: '##,###.00'
    },
    {
        title: ListTitleSO[8],
        dataIndx: "OriginalReduce",
        dataType: "float",
        width: 140,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        numberFormat: DecimalPlaces,
        format: decimalFormatString
    },
    {
        title: ListTitleSO[9],
        dataIndx: "CReduce",
        dataType: "float",
        width: 140,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        hidden: true,
        numberFormat: D90_ConvertedDecimals,
        format: convertDecimalFormatString

    },
    {
        title: ListTitleSO[10],
        dataIndx: "VATGroupID",
        width: 100,
        showGrid: true,
        required: true,
        align: "center",
        render: function (ui) {
            return {
                cls: 'gridColRequire'
            };
        },
        //validations: [{type: 'minLen', value: 1, msg: 'Required'}]
    },
    {
        title: ListTitleSO[11],
        dataIndx: "VATRate",
        dataType: "float",
        width: 100, align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        numberFormat: ExchangeRateDecimals,
        format: '##,###.00'
    },
    {
        title: ListTitleSO[12],
        dataIndx: "OVAT",
        dataType: "float",
        width: 140,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        numberFormat: DecimalPlaces,
        format: decimalFormatString
    },
    {
        title: ListTitleSO[13],
        dataIndx: "CVAT",
        dataType: "float",
        width: 140,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        hidden: true,
        //cls: 'gridColReadonly',
        numberFormat: D90_ConvertedDecimals,
        format: convertDecimalFormatString
    },
    {
        title: ListTitleSO[14],
        dataIndx: "Amount",
        dataType: "float",
        width: 140,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        numberFormat: DecimalPlaces,
        format: decimalFormatString
    },
    {
        title: ListTitleSO[15],
        dataIndx: "CAmount",
        dataType: "float",
        width: 140,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        hidden: true,
        numberFormat: D90_ConvertedDecimals,
        format: convertDecimalFormatString
    },
    {
        title: "ConversionFactor",
        dataIndx: "ConversionFactor",
        width: 140,
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        hidden: true,
        cls: 'gridColReadonly'
    },
    {
        title: "IsService",
        dataIndx: "IsService",
        width: 180,
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        hidden: true,
        cls: 'gridColReadonly'
    },
    {
        title: "IsKit",
        dataIndx: "IsKit",
        width: 180,
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        hidden: true,
        cls: 'gridColReadonly'
    },
    {
        title: "CQuanty",
        dataIndx: "CQuantity",
        dataType: "float",
        width: 180,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        hidden: true,
        numberFormat: D90_ConvertedDecimals,
        format: convertDecimalFormatString

    },
    {
        title: "QuotationItemID",
        dataIndx: "QuotationItemID",
        dataType: "float",
        width: 180,
        align: "right",
        editable: false,
        render: function (ui) {
            var disabled = this.isEditableCell(ui) ? "" : "disabled";
            return {
                cls: (disabled ? "readonly-status" : "")
            };
        },
        hidden: true,
    }

];
var summaryData = "";
var gbDataIndx = "";
var gbColIndx = 0;
var gbRowIndx = 0;
var isShow = false;
var obj = {
    height: $(document).height() - 360,
    collapsible: false,
    dataModel: {data: dataModel1602},
    colModel: colM,
    sortable: false,
    hwrap: false,
    scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
    //hoverMode: 'cell',
    freezeCols: 1,
    numberCell: {resizable: true, title: "#"},
    resizable: false,
    wrap: false,
    showTitle: false,
    showTop:true,
    showBottom: true,
    selectionModel:
    {
        type: 'cell',
        column: true,
        row: true
    },
    postRenderInterval: -1,
    editModel: {
        saveKey: $.ui.keyCode.ENTER,
        select: true,
        keyUpDown: false,
        cellBorderWidth: 0,
        clicksToEdit: 0
    },

    toolbar: {
        cls: 'pq-toolbar-crud',
        items: [
            {
                type: 'button',
                label: '<div class="fa fa-plus" title="'+msgAdd+' (Insert)">&nbsp;'+msgAdd+'</div>',
                //icon: 'ui-icon-plus',
                title:'dsfasf',
                listener: function () {
                    /////console.log(this);
                    soel.pqGrid("saveEditCell");
                    soel.pqGrid("quitEditMode");
                    var idx = soel.pqGrid("addRow",
                        {rowData: {}}
                    );
                    soel.pqGrid("setSelection", {rowIndx: idx, colIndx: 0});
                }
            },
            /*{
                type: 'button',
                label: '<div class="fa fa-trash" title="Delete"></div>',
                //icon: 'ui-icon-plus',
                listener: function (event,ui) {
                    //console.log('listen');
                    var rowIndx = getRowIndx(soel);
                    if (rowIndx != null){
                        var numrow = soel.pqGrid("option", "dataModel.data").length;
                        var rowIndx = ui.rowIndx;
                        soel.pqGrid("deleteRow", {rowIndx: rowIndx});
                        //Bình thường grid sẽ xóa dòng hiện tại, và di chuyển trỏ xuống dòng dưới.
                        //Đoạn code này xử lý nếu xóa dòng hiện tại, mà ở dưới không có dòng để focus thì nó focus dòng ỏ kế trên
                        if (rowIndx > 0) {
                            if (rowIndx < numrow - 1) {
                                soel.pqGrid("setSelection", {
                                    rowIndx: rowIndx,
                                    colIndx: gbColIndx
                                });
                            } else {
                                soel.pqGrid("setSelection", {
                                    rowIndx: rowIndx - 1,
                                    colIndx: gbColIndx
                                });
                            }

                        }
                    }else{
                        alert_warning('No selected row.');
                    }

                }
            },*/
        ]
    },

    cellKeyDown: function (event, ui) {
        //console.log('cellKeyDown');
        // esc
        gbDataIndx = ui.dataIndx;
        gbColIndx = soel.pqGrid("getColIndx", {dataIndx: gbDataIndx});
        gbRowIndx = ui.rowIndx;

        var editable = $("div#grid_SO").pqGrid("option", "editable");
        if (editable) {
            var a = $("#grid_SO").find('.pq-state-select');
            //////console.log(a);
            if (event.shiftKey && event.keyCode == 9 && gbColIndx == 0 && gbRowIndx == 0) {
                //////console.log('altKey');
                $("#txtdescription").focus();
            }

            if (event.keyCode == 27) {
                setHideAllDropdown();
                isShow = false;
            }
            // insert key
            if (event.keyCode == 45) { // insert key event
                soel.pqGrid("saveEditCell");//Có ý nghĩa là phải lưu cell hiện tại trước đã rồi mới thêm dòng mới
                soel.pqGrid("quitEditMode");
                var idx = soel.pqGrid("addRow",
                    {rowData: {}}
                );
                soel.pqGrid("setSelection", {rowIndx: idx, colIndx: 0});
                event.stopPropagation();
                event.preventDefault();
            }
            //delete row ctrl + delete
            if (event.keyCode == 46 && event.ctrlKey) {
                event.stopPropagation();
                event.preventDefault();
                var numrow = soel.pqGrid("option", "dataModel.data").length;
                var rowIndx = ui.rowIndx;
                soel.pqGrid("deleteRow", {rowIndx: rowIndx});
                //Bình thường grid sẽ xóa dòng hiện tại, và di chuyển trỏ xuống dòng dưới.
                //Đoạn code này xử lý nếu xóa dòng hiện tại, mà ở dưới không có dòng để focus thì nó focus dòng ỏ kế trên
                if (rowIndx > 0) {
                    if (rowIndx < numrow - 1) {
                        soel.pqGrid("setSelection", {
                            rowIndx: rowIndx,
                            colIndx: ui.colIndx
                        });
                    } else {
                        soel.pqGrid("setSelection", {
                            rowIndx: rowIndx - 1,
                            colIndx: ui.colIndx
                        });
                    }

                }

            }
            //delete
            if (event.keyCode == 46 && (ui.column.editable === undefined || ui.column.editable)) {
                var rowData = ui.rowData;
                rowData[ui.dataIndx] = null;
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: ui.dataIndx});
                if (gbDataIndx == 'InventoryID') {
                    var rowData = ui.rowData;
                    rowData["InventoryName"] = '';
                    rowData["UnitID"] = '';
                    rowData["ConversionFactor"] = '';
                    rowData["IsService"] = '';
                    rowData["IsKit"] = '';
                    soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "InventoryName"});
                    soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "UnitID"});
                    soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "ConversionFactor"});
                    soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "IsService"});
                    soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "IsKit"});
                }
                if (gbDataIndx == 'VATGroupID') {
                    var rowData = ui.rowData;
                    rowData["VATRate"] = null;
                    soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "VATRate"});
                }
                if (gbDataIndx == 'UnitID') {
                    var rowData = ui.rowData;
                    rowData["UnitID"] = null;
                    soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "UnitID"});
                }
                updateRelationColums(gbRowIndx);
            }
        }


        //Ctrl + shift + S to Save
        if (event.ctrlKey && event.shiftKey && event.keyCode == 83 && $("#frmW05F1602").find('#frm_btnSave').is(":disabled") == false){
            console.log('grid event');
            $("#frmW05F1602").find('#frm_btnSave').click();
        }

        //Ctrl + shift + A to Next
        if (event.ctrlKey && event.shiftKey && event.keyCode == 65 && $("#frmW05F1602").find('#frm_btnReset').is(":disabled") == false){
            console.log('Next');
            $("#frmW05F1602").find('#frm_btnReset').click();
        }
        //Ctrl + shift + E to Edit
        if (event.ctrlKey && event.shiftKey && event.keyCode == 69 && $("#frmW05F1602").find('#frm_btnEdit').is(":disabled") == false){
            console.log('Edit');
            $("#frmW05F1602").find('#frm_btnEdit').click();
        }
        //Ctrl + shift + C to Cancel
        if (event.ctrlKey && event.shiftKey && event.keyCode == 75 && $("#frmW05F1602").find('#frm_btnECancel').is(":disabled") == false){
            console.log('Not Save');
            $("#frmW05F1602").find('#frm_btnECancel').click();
        }

    },
    cellClick: function (event, ui) {

        //console.log('cellClick');
        gbDataIndx = ui.dataIndx;
        gbColIndx = soel.pqGrid("getColIndx", {dataIndx: gbDataIndx});
        gbRowIndx = ui.rowIndx;
        setHideAllDropdown();
        //soel.pqGrid("saveEditCell");//Có ý nghĩa là phải lưu cell hiện tại trước đã rồi mới thêm dòng mới
        soel.pqGrid("quitEditMode");
        /*var obj = soel.pqGrid( "getEditCell" );
        var $editor = obj.$editor;
        if ($editor != undefined){
            event.preventDefault();
            event.stopPropagation()
            soel.pqGrid("editCell", {rowIndx: gbRowIndx, dataIndx: gbDataIndx});
            soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});
        }else{

        }*/
        //soel.pqGrid("saveEditCell");//Có ý nghĩa là phải lưu cell hiện tại trước đã rồi mới thêm dòng mới
        //soel.pqGrid("quitEditMode");
    },
    cellSave: function (event, ui) {
        //console.log('cellSave');
        var $grid_SO = $("#grid_SO");
        updateRelationColums(gbRowIndx);
        $grid_SO.pqGrid("refreshDataAndView");
        //event.stopPropagation();
        //event.preventDefault();
    },
    selectChange: function( event, ui ) {
        /*//console.log('selectChange');
        if (ui.selection._areas[0].c2){

        }   */
       /* //console.log('selectChange');
        /!*var column = soel.pqGrid( "getColumn",{ dataIndx: gb } );
        if (ui.column.editable == false){
            soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: ui.colIndx + 1});
        }*!/
        if (gbDataIndx == "UnitPrice") { // xử ký chỗ nhập đơn giá
            soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: soel.pqGrid("getColIndx", {dataIndx: "RateReduce"})});
        }

        if (gbDataIndx == "RateReduce") { // xử ký chỗ ty le chiet khau
            soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: soel.pqGrid("getColIndx", {dataIndx: "VATGroupID"})});
        }*/
    },

    /*change: function (event, ui) {
        //console.log('change');
        var $grid_SO = $("#grid_SO");
        updateRelationColums(gbRowIndx);
        $grid_SO.pqGrid("refreshDataAndView");
        ////console.log("saveCELL");

    },*/
    editorFocus: function (event, ui) {
        //console.log('editorFocus');
        setHideAllDropdown();
        gbDataIndx = ui.dataIndx;
        gbColIndx = soel.pqGrid("getColIndx", {dataIndx: gbDataIndx});
        gbRowIndx = ui.rowIndx;

        //////console.log('editorFocus');
        var $editor = ui.$editor;
    },
    editorKeyDown: function (event, ui) {
        //console.log('editorKeyDown');
        var obj = soel.pqGrid("getEditCell");

        var $td = obj.$td; //table cell
        isShow = false;
        //var $td = ui.$td;
        var $cell = ui.$cell;
        var $editor = ui.$editor; //editor.
        var rowData = ui.rowData;
        var colIndx = ui.colIndx;
        var cellValue = $editor.val();
        var txtexchangerate = correctNumber($("#txtExchangeRate").val());
        //--------------------
        // esc
        if (event.keyCode == 27) {
            setHideAllDropdown();
        }
        //delete
        if (event.keyCode == 46) {
            $(ui.$cell[0]).find("input").val(null);//Đây là delete giá trị tạm thời nên không tính lại value
        }

        //delete row ctrl + delete
        if (event.keyCode == 46 && event.ctrlKey) {
            event.stopPropagation();
            event.preventDefault();
            var numrow = soel.pqGrid("option", "dataModel.data").length;
            var rowIndx = ui.rowIndx;
            soel.pqGrid("deleteRow", {rowIndx: rowIndx});

            //Bình thường grid sẽ xóa dòng hiện tại, và di chuyển trỏ xuống dòng dưới.
            //Đoạn code này xử lý nếu xóa dòng hiện tại, mà ở dưới không có dòng để focus thì nó focus dòng ỏ kế trên
            if (rowIndx > 0) {
                if (rowIndx < numrow - 1) {
                    soel.pqGrid("setSelection", {
                        rowIndx: rowIndx,
                        colIndx: ui.colIndx
                    });
                } else {
                    soel.pqGrid("setSelection", {
                        rowIndx: rowIndx - 1,
                        colIndx: ui.colIndx
                    });
                }

            }

        }
        // insert key
        if (event.keyCode == 45) { // insert key event
            soel.pqGrid("saveEditCell");//Có ý nghĩa là phải lưu cell hiện tại trước đã rồi mới thêm dòng mới
            soel.pqGrid("quitEditMode");
            var idx = soel.pqGrid("addRow",
                {rowData: {}}
            );
            soel.pqGrid("setSelection", {rowIndx: idx, colIndx: 0});
            event.stopPropagation();
            event.preventDefault();
        }

        if ((event.keyCode == 13 || event.keyCode == 9)) {
            //////console.log('Quantity');
            if (colIndx == soel.pqGrid("getColIndx", {dataIndx: "Quantity"})) { // xử ký chỗ nhập so luong
                /* var Quantity = isNullOrEmpty(cellValue) ? null : correctNumber(cellValue);
                 /!* var OAmountTmp, CAmountTmp;
                 OAmountTmp = correctNumber(undefinedToZero(rowData.UnitPrice, rowData)) * correctNumber(Quantity);
                 if (vl_operator == 0) {
                 CAmountTmp = OAmountTmp * correctNumber(txtexchangerate);
                 }
                 else {
                 CAmountTmp = OAmountTmp * correctNumber(txtexchangerate);
                 }*!/
                 updateCurrentRow(gbRowIndx, {
                 /!* OAmountTmp: format2(OAmountTmp, "", DecimalPlaces),
                 CAmountTmp: format2(CAmountTmp, "", D90_ConvertedDecimals),*!/
                 Quantity: Quantity
                 //Quantity: format2(Quantity, "", DecimalPlaces)
                 }, "UnitPrice");
                 updateRelationColums(gbRowIndx);//Tinh toan lai toan bo  row va sum,*/
            } else if (colIndx == soel.pqGrid("getColIndx", {dataIndx: "UnitPrice"})) { // xử ký chỗ nhập đơn giá
                /*/!* event.stopPropagation();
                 event.preventDefault();*!/
                 var UnitPrice = isNullOrEmpty(cellValue) ? 0 : correctNumber(cellValue);
                 /!*var OAmountTmp, CAmountTmp;
                 OAmountTmp = correctNumber(undefinedToZero(rowData.Quantity, rowData)) * correctNumber(UnitPrice);
                 if (vl_operator == 0) {
                 CAmountTmp = OAmountTmp * correctNumber(txtexchangerate);
                 }
                 else {
                 CAmountTmp = OAmountTmp / correctNumber(txtexchangerate);
                 }*!/
                 updateCurrentRow(gbRowIndx, {
                 /!*OAmountTmp: format2(OAmountTmp, "", DecimalPlaces),
                 CAmountTmp: format2(CAmountTmp, "", D90_ConvertedDecimals),*!/
                 UnitPrice: UnitPrice
                 //UnitPrice: format2(UnitPrice, "", DecimalPlaces)
                 }, "RateReduce");

                 updateRelationColums(gbRowIndx);//Tinh toan lai toan bo  row va sum,*/


            } else if (colIndx == soel.pqGrid("getColIndx", {dataIndx: "RateReduce"})) { // xử ký chỗ ty le chiet khau
                /*/!* event.stopPropagation();
                 event.preventDefault();*!/
                 ////////////console.log("RateReduce");
                 var RateReduce = isNullOrEmpty(cellValue) ? 0 : correctNumber(cellValue);

                 /!* var OriginalReduce = RateReduce * correctNumber(rowData.OAmountTmp) / 100;
                 var CReduce;
                 if (vl_operator == 0) {
                 CReduce = OriginalReduce * correctNumber(txtexchangerate);
                 }
                 else {
                 CReduce = OriginalReduce / correctNumber(txtexchangerate);
                 }
                 soel.pqGrid("scrollColumn", {dataIndx: "CAmount"});*!/

                 updateCurrentRow(gbRowIndx, {
                 //RateReduce: format2(RateReduce, "", DecimalPlaces)
                 RateReduce: RateReduce
                 /!* OriginalReduce: format2(OriginalReduce, "", DecimalPlaces),
                 CReduce: format2(CReduce, "", D90_ConvertedDecimals)*!/
                 }, "VATGroupID");
                 updateRelationColums(gbRowIndx);//Tinh toan lai toan bo  row va sum,*/

            }


        }

        // enter và có hiển thị lưới con (Khong cho nhap ngoai danh sach nen event.keyCode == 9
        if ((event.keyCode == 13) && ui.column.showGrid) {
            isShow = true;
            if (colIndx == soel.pqGrid("getColIndx", {dataIndx: "InventoryID"})) {
                $(".l3loading").removeClass('hide');
                isgrid_inventory = false;
                $("#grid_inventory").removeClass('pq-disable-select');
                $.ajax({
                    method: "POST",
                    url: SOBaseUrl,
                    dataType: 'json',
                    async: true,
                    data: {do: 'getListInventory', StrSearch: cellValue},
                    success: function (data) {
                        console.log('check one row');
                        $(".l3loading").addClass('hide');
                        if (data.length == 1){//Nếu enter mà có 1 dòng dữ liệu thì gán luôn. và không show dropdown
                            updateRowGridSO(data[0]);
                        }else{ //Nếu enter mà nhiều dòng dữ liệu hoặc không có dữ liệu thì sẽ dhow dropdown
                            var el = $("#grid_inventory");
                            gbElement = el;
                            el.pqGrid("option", "dataModel.data", data);
                            var topLef = new getTopLeft("grid_SO", "grid_inventory");
                            el.parent().css({
                                "top": topLef.marginTop,
                                "left": topLef.marginLeft
                            });
                            el.parent().show();
                            el.pqGrid('refreshDataAndView');
                            el.pqGrid("setSelection", {rowIndx: 0});
                            el.pqGrid("setSelection", {rowIndx: 0});
                        }
                    }
                });
            }
            if (colIndx == soel.pqGrid("getColIndx", {dataIndx: "UnitID"})) {
                $(".l3loading").removeClass('hide');
                $.ajax({
                    method: "POST",
                    url: SOBaseUrl,
                    dataType: 'json',
                    async: true,
                    data: {do: 'getListUnitID', StrSearch: cellValue, InventoryID: rowData["InventoryID"]},
                    success: function (data) {
                        $(".l3loading").addClass('hide');
                        if (data.length == 1){//Nếu enter mà có 1 dòng dữ liệu thì gán luôn. và không show dropdown
                            updateUnitID(data[0]);
                        }else{ //Nếu enter mà nhiều dòng dữ liệu hoặc không có dữ liệu thì sẽ dhow dropdown
                            var el = $("#grid_UnitID");
                            gbElement = el;
                            el.pqGrid("option", "dataModel.data", data);
                            var topLef = new getTopLeft("grid_SO", "grid_UnitID");

                            el.parent().css({
                                "top": topLef.marginTop,
                                "left": topLef.marginLeft
                            });

                            el.parent().show();
                            el.pqGrid('refreshDataAndView');
                            //Không rõ vì sao chạy 2 lần thì mới có tác dụng
                            el.pqGrid("setSelection", {rowIndx: 0});
                            el.pqGrid("setSelection", {rowIndx: 0});
                        }

                    }
                });
            }
            if (colIndx == soel.pqGrid("getColIndx", {dataIndx: "VATGroupID"})) {
                //console.log('VATGroupID');
                var data = dataListVatGroup;
                var newData = searchInJson(data, cellValue);

                if (newData.length == 1){//Nếu enter mà có 1 dòng dữ liệu thì gán luôn. và không show dropdown
                    updateRowGridSOFromListVAT(newData[0]);
                }else{ //Nếu enter mà nhiều dòng dữ liệu hoặc không có dữ liệu thì sẽ dhow dropdown
                    var el = $("#grid_vatgroup");
                    gbElement = el;
                    el.pqGrid("option", "dataModel.data", []);
                    el.pqGrid("option", "dataModel.data", newData);
                    var topLef = new getTopLeft("grid_SO", "grid_vatgroup");

                    el.parent().css({
                        "top": topLef.marginTop,
                        "left": topLef.marginLeft
                    }); // 97 là do height text edit (31)+ header height (40) + top height (22) ;
                    el.parent().show();
                    el.pqGrid('refreshDataAndView');
                    if (data.length > 0) {
                        el.pqGrid("setSelection", {rowIndx: 0});
                    }
                    el.pqGrid("setSelection", {rowIndx: 0});
                    el.pqGrid("setSelection", {rowIndx: 0});
                }


            }

        }
        /*if ((event.keyCode == 9) && ui.column.showGrid) {
            if (colIndx == soel.pqGrid("getColIndx", {dataIndx: "InventoryID"})) {
                var el = $("#grid_inventory");
                var dataObject = el.pqGrid("option", "dataModel.data");
                var rs = $.grep(dataObject, function (data, index) {
                    //return data[settings.dataBind].toUpperCase().indexOf(el.val().toUpperCase()) >= 0;
                    return data[gbDataIndx].toUpperCase() == ui.cellData.toUpperCase();
                });
            }
        }*/
    },
    cellBeforeSave: function (event, ui) {
        //console.log('cellBeforeSave');
        var obj = soel.pqGrid("getEditCell");
        var $editor = obj.$editor;

        var rowData = ui.rowData,
            dataIndx = ui.dataIndx,
            newVal = ui.newVal,
            oldVal = ui.oldVal,
            rowIndx = ui.rowIndx,
            gbDataIndx = ui.dataIndx;

        //rowData[dataIndx] =  newVal;
        var colIndx = ui.colIndx;
        if (isShow) {
            event.stopPropagation();
            event.preventDefault();
            return false;
        }

        //Kiem tra rong
        if (ui.column.required && isNullOrEmpty(ui.newVal)) {
            event.stopPropagation();
            event.preventDefault();
            if (isNullOrEmpty(ui.newVal)) {
                $($editor).confirmation({
                    btnOkLabel: '',
                    btnCancelLabel: '',
                    popout: true,
                    placement: "bottom",
                    singleton: true,
                    template: '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                    + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                    + messagW05F1602
                    + '</label></span></div>'
                    + '</div>'
                });
                $($editor).parent().find('.confirmContent').html(messagW05F1602);
                $($editor).confirmation('show');
            }
            return false;
        }

        if ((gbDataIndx == "Quantity" || gbDataIndx == "UnitPrice") && correctNumber(undefinedToZero(ui.newVal))<=0){
            event.stopPropagation();
            event.preventDefault();
            $($editor).confirmation({
                btnOkLabel: '',
                btnCancelLabel: '',
                popout: true,
                placement: "bottom",
                singleton: true,
                template: '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                + ui.column.title + ' >0'
                + '</label></span></div>'
                + '</div>'
            });
            $($editor).parent().find('.confirmContent').html(ui.column.title + ' >0');
            $($editor).confirmation('show');
            return false;
        }

        //Kiem tra dieu kien khac
        if (gbDataIndx == "RateReduce" && !isNullOrEmpty(ui.newVal) && (correctNumber(undefinedToZero(ui.newVal)) > 100 || correctNumber(undefinedToZero(ui.newVal))<=0)){
            event.stopPropagation();
            event.preventDefault();
            $($editor).confirmation({
                btnOkLabel: '',
                btnCancelLabel: '',
                popout: true,
                placement: "bottom",
                singleton: true,
                template: '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                + '0< '+ui.column.title+' <=100'
                + '</label></span></div>'
                + '</div>'
            });
            $($editor).parent().find('.confirmContent').html('0< '+ui.column.title+' <=100');
            //$($editor).val(newVal);
            $($editor).confirmation('show');

            return false;
        }

        if (gbDataIndx == 'InventoryID' || gbDataIndx == 'UnitID'){
            if (event.keyCode == 13 || event.keyCode == 9){
                event.stopPropagation();
                event.preventDefault();
            }
            //Khi tab sẽ kiểm tra ở tập client, nêu không có sẽ kiểm tra tập ở server
            //Nếu thấy có dữ liệu thì set value cho bản thân và cột liên quan
            //Nếu không có dữ liệu thì sẽ set trắng và nhảy sang cột liên quan
            //Tab là kiểm tra bằng.
            //Enter là search theo kiểu like, tức là trả ra tập giá trị.
            //if (event.keyCode == 9){
                console.log('checkTab');
                var el;
                var task;
                switch (gbDataIndx){
                    case 'InventoryID':
                        el = $("#grid_inventory");
                        task = 'getListInventory';
                        break;
                    case 'UnitID':
                        el = $("#grid_UnitID");
                        task = 'getListUnitID';
                        break;
                    /*case 'VATGroupID':
                        el = $("#grid_inventory");
                        task = 'getListInventory';
                        break;*/
                }

                var dataObject = el.pqGrid("option", "dataModel.data");
                var rs = $.grep(dataObject, function (data, index) {
                    return data[gbDataIndx].toUpperCase() == ui.newVal.toUpperCase();
                });
                if (rs.length == 0){
                    //$(".l3loading").removeClass('hide');
                    soel.pqGrid( "showLoading" );
                    $.ajax({
                        method: "POST",
                        url: SOBaseUrl,
                        dataType: 'json',
                        async: true,
                        //data: {do: task, StrSearch: ui.newVal},
                        data: {do: task, StrSearch: ui.newVal, InventoryID: rowData["InventoryID"]},
                        success: function (data) {
                            //$(".l3loading").addClass('hide');
                            soel.pqGrid( "hideLoading" );
                            el.pqGrid("option", "dataModel.data",data);
                            if (data.length == 1){
                                reUpdateRelationCols(data[0],gbDataIndx);
                                //updateRowGridSO(data[0]);
                            }
                            if (data.length == 0 || data.length > 1){
                                if (event.keyCode == 13 || event.keyCode == 9){
                                    if (event.keyCode == 9){
                                        setHideAllDropdown();
                                        var dataFilter = $.grep(data, function (row, index) {
                                            return row[gbDataIndx].toUpperCase() == ui.newVal.toUpperCase();
                                        });
                                        if (dataFilter.length == 1)
                                            updateRowGridSO(dataFilter[0]);
                                        else
                                            return false;
                                    }
                                    if (event.keyCode == 13){
                                        return false;
                                    }
                                }else{
                                    var dataFilter = $.grep(data, function (row, index) {
                                        return row[gbDataIndx].toUpperCase() == ui.newVal.toUpperCase();
                                    });
                                    if (dataFilter.length == 1)
                                        reUpdateRelationCols(dataFilter[0],gbDataIndx);
                                        //updateRowGridSO(dataFilter[0]);
                                    else{
                                        /*rowData["InventoryID"] = '';
                                        rowData["InventoryName"] = '';
                                        rowData["UnitID"] = '';
                                        rowData["ConversionFactor"] = '';
                                        rowData["IsService"] = '';
                                        rowData["IsKit"] = '';
                                        soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "InventoryID"});
                                        soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "InventoryName"});
                                        soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "UnitID"});
                                        soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "ConversionFactor"});
                                        soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "IsService"});
                                        soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "IsKit"});*/
                                        resetRelationCols(rowData, gbDataIndx);
                                    }

                                }

                            }
                        }
                    });
                }else{
                    reUpdateRelationCols(rs[0],gbDataIndx);
                    //updateRowGridSO(rs[0]);
                }
                setHideAllDropdown();
        }
        if (gbDataIndx == "VATGroupID"){
            console.log('VATGroupID');
            var data = dataListVatGroup;
            var newData = searchInJson(data, ui.newVal);
            if (newData.length == 0 || newData.length > 1){
                if (event.keyCode == 13 || event.keyCode == 9){
                    //resetRelationCols(rowData, gbDataIndx);
                    setHideAllDropdown();
                    event.stopPropagation();
                    event.preventDefault();
                    return false;
                }
                event.stopPropagation();
                event.preventDefault();
                resetRelationCols(ui.rowData, gbDataIndx);
                //ui.rowData['VATGroupID'] = '';
                //soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "VATGroupID"});
                /*ui.newVal = '';
                ui.value ='';
                ui.oldVal = '';*/
            }
            if (newData.length == 1){
                reUpdateRelationCols(newData[0],gbDataIndx);
            }

        }

    },
    refresh: function(event, ui){
        console.log('refresh');
    },
    complete: function(event, ui){
        console.log('complete');
    },
};
var grid1 = $("div#grid_SO").pqGrid(obj);

var $hori = grid1.find(".pq-sb-horiz");

function resetRelationCols(rowData, dataIndx){
    switch (dataIndx){
        case 'InventoryID':
            rowData["InventoryID"] = '';
            rowData["InventoryName"] = '';
            rowData["UnitID"] = '';
            rowData["ConversionFactor"] = '';
            rowData["IsService"] = '';
            rowData["IsKit"] = '';
            /*soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "InventoryID"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "InventoryName"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "UnitID"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "ConversionFactor"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "IsService"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "IsKit"});*/
            updateRowGridSO(rowData);
            break;
        case 'UnitID':
            rowData["UnitID"] = '';
            //soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "UnitID"});
            updateUnitID(rowData);
            break;
        case 'VATGroupID':
            //var obj = soel.pqGrid( "getEditCell" );
            //var $editor = obj.$editor;
            //$editor.val('');
            rowData["VATGroupID"] = '';
            rowData["VATRate"] = '';
            updateRowGridSOFromListVAT(rowData);
            /*soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "VATGroupID"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndx, dataIndx: "VATRate"});*/
            break;
    }
}

function reUpdateRelationCols(rowData, dataIndx){
    switch (dataIndx){
        case 'InventoryID':
            updateRowGridSO(rowData);
            break;
        case 'UnitID':
            updateUnitID(rowData);
            break;
        case "VATGroupID":
            updateRowGridSOFromListVAT(rowData);
         break;
    }
}

$hori.click(function () {
    setHideAllDropdown();
});
/*$hori.drag(function(){
 setHideAllDropdown();
 });*/
$(".pq-hscroll").find('.pq-sb-slider').drag(function () {
    setHideAllDropdown();
});

$(".ui-icon-triangle-1-w").click(function () {
    setHideAllDropdown();
});

$(".ui-icon-triangle-1-e").click(function () {
    setHideAllDropdown();
});

var $verti = grid1.find(".pq-sb-vert");
$verti.click(function () {
    setHideAllDropdown();
});

/*$verti.drag(function(){
 setHideAllDropdown();
 });*/

$(".pq-vscroll").find('.pq-sb-slider').drag(function () {
    setHideAllDropdown();
});

$(".ui-icon-triangle-1-n").click(function () {
    setHideAllDropdown();
});

$(".ui-icon-triangle-1-s").click(function () {
    setHideAllDropdown();
});

function setHideAllDropdown() {
    var els = $("#divDropDownW05F1602").find('.subGrid');
    for (var i = 0; i < els.length; i++) {
        $(els[i]).css('display', 'none');
    }
}

setTimeout(function () {
    //$("div#grid_SO").pqGrid("refresh");
    $("div#grid_SO").pqGrid({
        summaryData: summaryData
    });
    $("div#grid_SO").pqGrid("refresh");
    $("div#grid_SO").pqGrid('refreshView');
    //$("div#grid_SO").pqGrid("refreshDataAndView");
}, 500);
//update total info so
var updateTotalSO = function () {
    //////console.log('updateTotalSO');
    $("#grid_SO").find(".pq-grid-summary>table>tbody>tr>td").addClass("text-right");
    //////console.log($("#grid_SO").find(".pq-grid-summary>table>tbody>tr>td"));
    var TotalOAmountTmp = 0, TotalCAmountTmp = 0, TotalRateReduce = 0, TotalOriginalReduce = 0, TotalCReduce = 0, TotalOVAT = 0, TotalCVAT = 0, TotalAmount = 0, TotalCAmount = 0;
    var gridData = soel.pqGrid("option", "dataModel.data");
    var rows = gridData == null ? 0 : gridData.length;
    for (i = 0; i < rows; i++) {
        var rowData = soel.pqGrid("getRowData", {rowIndx: i});
        TotalOAmountTmp += correctNumber(undefinedToZero(rowData.OAmountTmp));
        TotalCAmountTmp += correctNumber(undefinedToZero(rowData.CAmountTmp));
        TotalRateReduce += correctNumber(undefinedToZero(rowData.RateReduce));
        TotalOriginalReduce += correctNumber(undefinedToZero(rowData.OriginalReduce));
        TotalCReduce += correctNumber(undefinedToZero(rowData.CReduce));
        TotalOVAT += correctNumber(undefinedToZero(rowData.OVAT));
        TotalCVAT += correctNumber(undefinedToZero(rowData.CVAT));
        TotalAmount += correctNumber(undefinedToZero(rowData.Amount));
        TotalCAmount += correctNumber(undefinedToZero(rowData.CAmount));

    }

    $("#TotalOAmountTmp").val(format2(TotalOAmountTmp, "", DecimalPlaces));
    $("#TotalCAmountTmp").val(format2(TotalCAmountTmp, "", D90_ConvertedDecimals));
    $("#TotalRateReduce").val(format2(TotalRateReduce, "", DecimalPlaces));
    $("#TotalOriginalReduce").val(format2(TotalOriginalReduce, "", DecimalPlaces));
    $("#TotalCReduce").val(format2(TotalCReduce, "", D90_ConvertedDecimals));
    $("#TotalOVAT").val(format2(TotalOVAT, "", DecimalPlaces));
    $("#TotalCVAT").val(format2(TotalCVAT, "", D90_ConvertedDecimals));
    $("#TotalAmount").val(format2(TotalAmount, "", DecimalPlaces));
    $("#TotalCAmount").val(format2(TotalCAmount, "", D90_ConvertedDecimals));

    summaryData = [{
        InventoryID: footerTotalFormat(rows, 'center'),
        OAmountTmp: TotalOAmountTmp,
        CAmountTmp: TotalCAmountTmp,
        OriginalReduce: TotalOriginalReduce,
        CReduce: TotalCReduce,
        OVAT: TotalOVAT,
        CVAT: TotalCVAT,
        Amount: TotalAmount,
        CAmount: TotalCAmount,
    }];

    $("div#grid_SO").pqGrid({
        summaryData: summaryData
    });
    $("div#grid_SO").pqGrid('refreshView');

//Cap nhat value to title
    var els = $("#modalW05F1602").find('input[type="text"]');
    for (var i = 0; i < els.length; i++) {
        //////console.log($(els[i]).val());
        $(els[i]).attr('title', $(els[i]).val());
    }
};


/*//xử lý ẩn lưới
$("#modalW05F1602").click(function (e) {
    console.log('dsfafdsfaf');
    if ($(e.target).hasClass('pq-grid-cell')==false){
        $("div#grid_SO").pqGrid("saveEditCell");
        $("div#grid_SO").pqGrid("quitEditMode");
    }
});*/

