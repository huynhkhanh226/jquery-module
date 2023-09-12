<div id="gridW09F2920"></div>
<style>

    div.pq-grid tr td.disabled {
        text-shadow: 0 1px 0 #fff;
        background: #e0e0e0;
    }

    tr td.beige {
        background: #e0e0e0;
    }
</style>
<script type="text/javascript">
    var objTimeSheet;
    var $gridW09F2920;
    var dsTimeSheet;
    var gbRowidx = 0;
    $(function () {
        function disableTextRenderer(ui) {
            var //grid = $(this).pqGrid('getInstance').grid,
                    grid = this,
                    rowData = ui.rowData,
                    rowIndx = ui.rowIndx,
                    dataIndx = ui.dataIndx;

            if (grid.isEditableCell({rowIndx: rowIndx, dataIndx: dataIndx}) == false) {
                //if (grid.pqGrid( "isEditableCell", { rowIndx: rowIndx, dataIndx: dataIndx } ) == false) {
                //inject disabled class into read only cells.
                grid.addClass({rowIndx: rowIndx, dataIndx: dataIndx, cls: 'disabled'});
            }
            else {
                grid.removeClass({rowIndx: rowIndx, dataIndx: dataIndx, cls: 'disabled'});
            }
        };

        var gbDropDownTop = 0;
        var gbDropDownLeft = 0;
        var gbDataIndx = "";
        var gbColIndx = 0;
        var dsTimeSheet = {};
        objTimeSheet = {
            width: $("#modalW09F2920").find(".modal-body").width(),
            height: $(document).height() - 310,
            editable: true,
            dataType: "JSON",
            //numberCell: { resizable: true, title: "#", align: "center" },
            minWidth: 30,
            selectionModel: {type: 'cell'},
            //scrollModel: {autoFit: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            /*toolbar: {
             items: [{
             type: 'button',
             icon: 'ui-icon-plus',
             label: 'Thêm',
             listener: function () {
             var idx = $("#gridW09F2920").pqGrid("addRow",
             {
             rowData: {
             IsDelete: 0,
             ProjectID: "",
             ProjectName: "",
             WorkID: "",
             WorkName: "",
             Mon: format2(0, "", 2),
             IsApproveMon: 0,
             Tue: format2(0, "", 2),
             IsApproveTue: 0,
             Wed: format2(0, "", 2),
             IsApproveWed: 0,
             Thu: format2(0, "", 2),
             IsApproveThu: 0,
             Fri: format2(0, "", 2),
             IsApproveFri: 0,
             Sat: format2(0, "", 2),
             IsApproveSat: 0,
             Sun: format2(0, "", 2),
             IsApproveSun: 0,
             SumWeek: format2(0, "", 2),
             IsApproveAll: 0
             }
             }
             );

             //$("#gridW09F2920").goToPage({ rowIndx: idx });
             $("#gridW09F2920").editFirstCellInRow({ rowIndx: idx });
             }
             }]
             },*/
            colModel: [
                {
                    title: "", editable: false, minWidth: 60, align: "center", sortable: false, render: function (ui) {
                    var str = "";
                    var per = Number("{{Session::get($pForm)}}");
                    //if (per > 2)
                    if (per >= 2) {
                        str += "<a title='{{Helpers::getRS($g,"Them")}}' onclick='' id='btnAddW09F2920'><i class='glyphicon glyphicon-plus' style='color:orange;padding-right:5px'></i></a>";
                    }

                    if (per >= 4) {
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW09F2920'><i class='fa fa-trash'></i></a> ";
                    }
                    //str += " <i class='fa fa-lock text-red' style='font-size: 110%;'></i> ";
                    return str;
                },
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                                $gridW09F2920 = this,
                                $cell = $gridW09F2920.getCell(ui);


                        //add button
                        $cell.find("a#btnAddW09F2920")
                                .unbind("click")
                                .bind("click", function (evt) {
                                    $gridW09F2920 = $("#gridW09F2920")
                                    addNewW09F2920($gridW09F2920);
                                });

                        //delete button
                        $cell.find("a#btnDeleteW09F2920")
                                .unbind("click")
                                .bind("click", function (evt) {
                                    $gridW09F2920 = $("#gridW09F2920")
                                    ////console.log("delete");
                                    var numrow = $gridW09F2920.pqGrid("option", "dataModel.data").length;
                                    var $tr = $(this).closest("tr"),
                                            rowIndx = $gridW09F2920.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                    if (numrow > 0) {
                                        var rowData = $("#gridW09F2920").pqGrid("getRowData", {rowIndxPage: rowIndx});
                                        ask_delete(function () {
                                            if (Number(rowData["IsDelete"]) == 1 && Number(rowData["IsApproveAll"]) > 0) {
                                                alert_warning("{{Helpers::getRS($g,"Ton_tai_du_lieu_da_duoc_duyet")." ".Helpers::getRS($g,"Ban_khong_duoc_quyen_xoa")}}");
                                            } else if (rowData["IsDelete"] == 1) {
                                                $(".l3loading").removeClass('hide');
                                                $.ajax({
                                                    method: "POST",
                                                    url: "W09F2920/{{$pForm}}/{{$g}}/delete",
                                                    data: {
                                                        dateFrom: $("#frmW09F2920").find("#lblDateFrom").html(),
                                                        dateTo: $("#frmW09F2920").find("#lblDateTo").html(),
                                                        weekNo: $("#txtWeekNo").val(),
                                                        ProjectID: rowData["ProjectID"],
                                                        WorkID: rowData["WorkID"]
                                                    },
                                                    success: function (data) {
                                                        $(".l3loading").addClass('hide');
                                                        if (data == 1) {
                                                            delete_ok(function () {
                                                                $gridW09F2920.pqGrid("deleteRow", {rowIndx: rowIndx});
                                                                if (rowIndx == 0) {
                                                                    if (numrow >= 2) {
                                                                        $gridW09F2920.pqGrid("setSelection", {
                                                                            rowIndx: rowIndx,
                                                                            colIndx: 0
                                                                        });
                                                                        $gridW09F2920.pqGrid("editFirstCellInRow", {rowIndx: rowIndx});
                                                                    } else {
                                                                        $gridW09F2920 = $("#gridW09F2920")
                                                                        addNewW09F2920($gridW09F2920);
                                                                        $gridW09F2920.pqGrid("editCell", {
                                                                            rowIndx: 0,
                                                                            dataIndx: "ProjectName"
                                                                        });
                                                                    }
                                                                }
                                                                if (rowIndx > 0) {
                                                                    $gridW09F2920.pqGrid("setSelection", {
                                                                        rowIndx: rowIndx - 1,
                                                                        colIndx: 0
                                                                    });
                                                                    $gridW09F2920.pqGrid("editFirstCellInRow", {rowIndx: rowIndx - 1});
                                                                }
                                                            });
                                                            editedGrid = false;
                                                        } else {
                                                            alert_warning("Xóa không thành công");
                                                        }

                                                    }
                                                });
                                            } else if (rowData["IsDelete"] == 0) {
                                                $gridW09F2920.pqGrid("deleteRow", {rowIndx: rowIndx});
                                                if (rowIndx == 0) {
                                                    if (numrow >= 2) {
                                                        $gridW09F2920.pqGrid("setSelection", {
                                                            rowIndx: rowIndx,
                                                            colIndx: 0
                                                        });
                                                        $gridW09F2920.pqGrid("editFirstCellInRow", {rowIndx: rowIndx});
                                                    } else {
                                                        $gridW09F2920 = $("#gridW09F2920")
                                                        addNewW09F2920($gridW09F2920);
                                                        $gridW09F2920.pqGrid("editCell", {
                                                            rowIndx: 0,
                                                            dataIndx: "ProjectName"
                                                        });
                                                    }
                                                }
                                                if (rowIndx > 0) {
                                                    $gridW09F2920.pqGrid("setSelection", {
                                                        rowIndx: rowIndx - 1,
                                                        colIndx: 0
                                                    });
                                                    $gridW09F2920.pqGrid("editFirstCellInRow", {rowIndx: rowIndx - 1});

                                                }
                                            }
                                        });


                                    }
                                });
                    }
                },
                {
                    title: "ProjectID",
                    dataIndx: "ProjectID",
                    //minWidth: 210,
                    editor: {type: 'textbox'},
                    showGrid: true,
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Du_an")}}",
                    dataIndx: "ProjectName",
                    minWidth: 140,
                    //width: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: function (ui) {
                        if (ui.rowIndx === undefined) {
                            return true;
                        } else {
                            if (ui.rowData['IsDelete'] == 1) {
                                return false;
                            }
                            else {
                                return true;
                            }
                        }

                    },

                    render: disableTextRenderer
                },
                {
                    title: "WorkID",
                    dataIndx: "WorkID",
                    minWidth: 80,
                    //width: 140,
                    editor: {type: 'textbox'},
                    showGrid: true,
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Cong_viec")}}",
                    dataIndx: "WorkName",
                    minWidth: 140,
                    //width: 140,
                    editor: {select: true},
                    showGrid: true,

                    editable: function (ui) {
                        if (ui.rowIndx === undefined) {
                            return true;
                        } else {
                            if (ui.rowData['IsDelete'] == 1) {
                                return false;
                            }
                            else {
                                return true;
                            }
                        }
                    },
                    render: disableTextRenderer
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                    dataIndx: "Note",
                    minWidth: 140,
                    //width: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable:true,
                    render: disableTextRenderer
                },
                {
                    title: "{{Helpers::getRS($g,"Thu_2")}}",
                    dataIndx: "Mon",
                    dataType: "float",
                    format: "#,###.00",
                    minWidth: 70,
                    align: "right",
                    editor: {select: true},
                    editable: function (ui) {
                        if (ui.rowIndx === undefined) {
                            return true;
                        } else {
                            if (ui.rowData['IsApproveMon'] == 1) {
                                return false;
                            }
                            else {
                                return true;
                            }
                        }
                    },
                    /*formula: function(ui){
                     var rd = ui.rowData;
                     return rd.Mon +  rd.Tue + rd.Wed + rd.Thu + rd.Fri + rd.Sat + rd.Sun ;
                     },*/
                    render: disableTextRenderer
                },
                {
                    title: "IsApproveMon",
                    dataIndx: "IsApproveMon",
                    dataType: "integer",
                    minWidth: 70,
                    hidden: true,
                    editor: {select: true}

                },
                {
                    title: "{{Helpers::getRS($g,"Thu_3")}}",
                    dataIndx: "Tue",
                    dataType: "float",
                    format: "#,###.00",
                    minWidth: 70,
                    align: "right",
                    editor: {select: true},
                    editable: function (ui) {
                        if (ui.rowIndx === undefined) {
                            return true;
                        } else {
                            if (ui.rowData['IsApproveTue'] == 1) {
                                return false;
                            }
                            else {
                                return true;
                            }
                        }
                    },
                    /* formula: function(ui){
                     var rd = ui.rowData;
                     return rd.Mon +  rd.Tue + rd.Wed + rd.Thu + rd.Fri + rd.Sat + rd.Sun ;
                     },*/
                    render: disableTextRenderer
                },
                {
                    title: "IsApproveTue",
                    dataIndx: "IsApproveTue",
                    dataType: "integer",
                    minWidth: 70,
                    hidden: true,
                    editor: {select: true},
                },
                {
                    title: "{{Helpers::getRS($g,"Thu_4")}}",
                    dataIndx: "Wed",
                    dataType: "float",
                    format: "#,###.00",
                    minWidth: 70,
                    align: "right",
                    editor: {select: true},
                    editable: function (ui) {
                        if (ui.rowIndx === undefined) {
                            return true;
                        } else {
                            if (ui.rowData['IsApproveWed'] == 1) {
                                return false;
                            }
                            else {
                                return true;
                            }
                        }
                    },
                    /*formula: function(ui){
                     var rd = ui.rowData;
                     return rd.Mon +  rd.Tue + rd.Wed + rd.Thu + rd.Fri + rd.Sat + rd.Sun ;
                     },*/
                    render: disableTextRenderer
                },
                {
                    title: "IsApproveWed",
                    dataIndx: "IsApproveWed",
                    dataType: "integer",
                    minWidth: 70,
                    hidden: true,
                    editor: {select: true},
                },
                {
                    title: "{{Helpers::getRS($g,"Thu_5")}}",
                    dataIndx: "Thu",
                    dataType: "float",
                    format: "#,###.00",
                    minWidth: 70,
                    align: "right",
                    editor: {select: true},
                    editable: function (ui) {
                        if (ui.rowIndx === undefined) {
                            return true;
                        } else {
                            if (ui.rowData['IsApproveThu'] == 1) {
                                return false;
                            }
                            else {
                                return true;
                            }
                        }
                    },
                    /*formula: function(ui){
                     var rd = ui.rowData;
                     return rd.Mon +  rd.Tue + rd.Wed + rd.Thu + rd.Fri + rd.Sat + rd.Sun ;
                     },*/
                    render: disableTextRenderer
                },
                {
                    title: "IsApproveThu",
                    dataIndx: "IsApproveThu",
                    dataType: "integer",
                    minWidth: 70,
                    hidden: true,
                    editor: {select: true},
                },
                {
                    title: "{{Helpers::getRS($g,"Thu_6")}}",
                    dataIndx: "Fri",
                    dataType: "float",
                    format: "#,###.00",
                    minWidth: 70,
                    align: "right",
                    editor: {select: true},
                    editable: function (ui) {
                        if (ui.rowIndx === undefined) {
                            return true;
                        } else {
                            if (ui.rowData['IsApproveFri'] == 1) {
                                return false;
                            }
                            else {
                                return true;
                            }
                        }
                    },
                    /*formula: function(ui){
                     var rd = ui.rowData;
                     return rd.Mon +  rd.Tue + rd.Wed + rd.Thu + rd.Fri + rd.Sat + rd.Sun ;
                     },*/
                    render: disableTextRenderer
                },
                {
                    title: "IsApproveFri",
                    dataIndx: "IsApproveFri",
                    dataType: "integer",
                    minWidth: 70,
                    hidden: true,
                    editor: {select: true},
                },
                {
                    title: "{{Helpers::getRS($g,"Thu_7")}}",
                    dataIndx: "Sat",
                    dataType: "float",
                    format: "#,###.00",
                    minWidth: 70,
                    align: "right",
                    editor: {select: true},
                    editable: function (ui) {
                        if (ui.rowIndx === undefined) {
                            return true;
                        } else {
                            if (ui.rowData['IsApproveSat'] == 1) {
                                return false;
                            }
                            else {
                                return true;
                            }
                        }
                    },
                    /*formula: function(ui){
                     var rd = ui.rowData;
                     return rd.Mon +  rd.Tue + rd.Wed + rd.Thu + rd.Fri + rd.Sat + rd.Sun ;
                     },*/
                    render: disableTextRenderer
                },
                {
                    title: "IsApproveSat",
                    dataIndx: "IsApproveSat",
                    dataType: "integer",
                    minWidth: 70,
                    hidden: true,
                    editor: {select: true},
                },
                {
                    title: "{{Helpers::getRS($g,"Chu_nhat")}}",
                    dataIndx: "Sun",
                    dataType: "float",
                    format: "#,###.00",
                    minWidth: 75,
                    align: "right",
                    editor: {select: true},
                    editable: function (ui) {
                        if (ui.rowIndx === undefined) {
                            return true;
                        } else {
                            if (ui.rowData['IsApproveSun'] == 1) {
                                return false;
                            }
                            else {
                                return true;
                            }
                        }
                    },
                    /*formula: function(ui){
                     var rd = ui.rowData;
                     return rd.Mon +  rd.Tue + rd.Wed + rd.Thu + rd.Fri + rd.Sat + rd.Sun ;
                     },*/
                    render: disableTextRenderer
                },
                {
                    title: "IsApproveSun",
                    dataIndx: "IsApproveSun",
                    dataType: "integer",
                    minWidth: 70,
                    hidden: true,
                    editor: {select: true},
                },
                {
                    title: "{{Helpers::getRS($g,"Tong")}}",
                    dataIndx: "SumWeek",
                    dataType: "float",
                    format: "#,###.00",
                    minWidth: 70,
                    align: "right",
                    editable: false,
                    cls: 'gridColReadonly',
                    formula: function (ui) {
                        var rd = ui.rowData;
                        //console.log(rd);
                        var mon = rd.Mon == null ? 0 : rd.Mon;
                        var tue = rd.Tue == null ? 0 : rd.Tue;
                        var wed = rd.Wed == null ? 0 : rd.Wed;
                        var thu = rd.Thu == null ? 0 : rd.Thu;
                        var fri = rd.Fri == null ? 0 : rd.Fri;
                        var sat = rd.Sat == null ? 0 : rd.Sat;
                        var sun = rd.Sun == null ? 0 : rd.Sun;
                        ////console.log(mon +  tue + wed + thu + fri + sat + sun);
                        return Number(mon) + Number(tue) + Number(wed) + Number(thu) + Number(fri) + Number(sat) + Number(sun);
                    }
                },
                {
                    title: "IsApproveAll",
                    dataIndx: "IsApproveAll",
                    dataType: "integer",
                    minWidth: 70,
                    hidden: true,
                    editor: {type: 'textbox'}
                },

            ],
            dataModel: {
                data: dsTimeSheet

            },
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                onBlur: "save",
                clicksToEdit: 1
            },
            cellBeforeSave: function (event, ui) {
                //console.log("cellBeforeSave");
            },
            editorBegin: function (event, ui) {
                //console.log("editorBegin");

            },
            editorFocus: function (event, ui) {
                //console.log("editorFocus");
                gbDropDownTop = Number(ui.$cell.offset().top);
                gbDropDownLeft = Number(ui.$cell.offset().left);
                gbDataIndx = ui.dataIndx;
                gbColIndx = ui.colIndx;
            },
            cellKeyDown: function (event, ui) {
                //console.log("cellKeyDown");
                if (event.keyCode == 27) {
                    console.log("test");
                    var $gridW09F2920 = $("#gridW09F2920");
                    $gridW09F2920.pqGrid("setSelection", {rowIndx: gbRowidx, colIndx: gbColIndx});
                }

            },
            change: function (event, ui) {
                //console.log("change");

            },
            editorKeyUp: function (event, ui) {
                //console.log("editorKeyUp");
            },

            editorKeyDown: function (event, ui) {
                var $gridW09F2920 = $("#gridW09F2920");
                editedGrid = true;
                //console.log("cellEditKeyDown");
                var obj = $("#gridW09F2920").pqGrid("option", "dataModel.data");
                console.log("cellEditKeyDown");
                if (event.keyCode == 27) {
                    console.log("cellEditKeyDown");
                    //$gridW09F2920.pqGrid("refresh");
                    $("#divDropDown").css("display", "none");
                    $gridW09F2920.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: gbColIndx});
                    /*if($('#divDropDown').css('display') == 'block')
                     {
                     $("#divDropDown").css("display", "none");
                     $gridW09F2920.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: gbColIndx});
                     }
                     event.stopPropagation();
                     event.preventDefault();*/
                    event.preventDefault()
                }

                // key (insert) - to insert a row
                if (event.keyCode == 45) {
                    $gridW09F2920 = $("#gridW09F2920")
                    addNewW09F2920($gridW09F2920);
                }

                // key (ctrl + delete) - to delete a row
                if (event.keyCode == 46 && event.ctrlKey) {
                    event.stopPropagation();
                    event.preventDefault();
                    var numrow = $gridW09F2920.pqGrid("option", "dataModel.data").length;
                    var rowIndx = ui.rowIndx;
                    if (numrow > 0) {
                        var rowData = $("#gridW09F2920").pqGrid("getRowData", {rowIndxPage: rowIndx});
                        ask_delete(function () {
                            if (Number(rowData["IsDelete"]) == 1 && Number(rowData["IsApproveAll"]) > 0) {
                                alert_warning("{{Helpers::getRS($g,"Ton_tai_du_lieu_da_duoc_duyet")." ".Helpers::getRS($g,"Ban_khong_duoc_quyen_xoa")}}");
                            } else if (rowData["IsDelete"] == 1) {
                                $(".l3loading").removeClass('hide');
                                $.ajax({
                                    method: "POST",
                                    url: "W09F2920/{{$pForm}}/{{$g}}/delete",
                                    data: {
                                        dateFrom: $("#frmW09F2920").find("#lblDateFrom").html(),
                                        dateTo: $("#frmW09F2920").find("#lblDateTo").html(),
                                        weekNo: $("#txtWeekNo").val(),
                                        ProjectID: rowData["ProjectID"],
                                        WorkID: rowData["WorkID"]
                                    },
                                    success: function (data) {
                                        $(".l3loading").addClass('hide');
                                        if (data == 1) {
                                            delete_ok(function () {
                                                $gridW09F2920.pqGrid("deleteRow", {rowIndx: rowIndx});
                                                if (rowIndx == 0) {
                                                    if (numrow >= 2) {
                                                        $gridW09F2920.pqGrid("setSelection", {
                                                            rowIndx: rowIndx,
                                                            colIndx: 0
                                                        });
                                                        $gridW09F2920.pqGrid("editFirstCellInRow", {rowIndx: rowIndx});
                                                    } else {
                                                        $gridW09F2920 = $("#gridW09F2920")
                                                        addNewW09F2920($gridW09F2920);
                                                    }
                                                }
                                                if (rowIndx > 0) {
                                                    $gridW09F2920.pqGrid("setSelection", {
                                                        rowIndx: rowIndx - 1,
                                                        colIndx: 0
                                                    });
                                                    $gridW09F2920.pqGrid("editFirstCellInRow", {rowIndx: rowIndx - 1});
                                                }
                                            });
                                            editedGrid = false;
                                        } else {
                                            alert_warning("Xóa không thành công");
                                        }

                                    }
                                });
                            } else if (rowData["IsDelete"] == 0) {
                                $gridW09F2920.pqGrid("deleteRow", {rowIndx: rowIndx});
                                if (rowIndx == 0) {
                                    if (numrow >= 2) {
                                        $gridW09F2920.pqGrid("setSelection", {rowIndx: rowIndx, colIndx: 0});
                                        $gridW09F2920.pqGrid("editFirstCellInRow", {rowIndx: rowIndx});
                                    } else {
                                        $gridW09F2920 = $("#gridW09F2920")
                                        addNewW09F2920($gridW09F2920);
                                    }
                                }
                                if (rowIndx > 0) {
                                    $gridW09F2920.pqGrid("setSelection", {rowIndx: rowIndx - 1, colIndx: 0});
                                    $gridW09F2920.pqGrid("editFirstCellInRow", {rowIndx: rowIndx - 1});

                                }
                            }
                        });


                    }

                }

                if ((event.keyCode == 13 || event.keyCode == 9) && !ui.column.showGrid) {
                    $gridW09F2920.pqGrid('refreshDataAndView');
                }

                //Truong hop enter va co show grid con
                if (event.keyCode == 13 && ui.column.showGrid) {
                    //event.stopPropagation();
                    //event.preventDefault();
                    ////console.log("Show Grid");
                    $("#divDropDown").css("display", "block");
                    gbRowidx = ui.rowIndx;
                    //console.log("getPosition");

                    var sTr = $(ui.$cell[0]).find("input,select").val();//ui.$cell[0].textContent;
                    var $td = $gridW09F2920.pqGrid("getCell", {rowIndx: ui.rowIndx, colIndx: ui.colIndx});

                    var top = ui.$cell.offset().top;
                    var left = ui.$cell.offset().left;// parseInt($(ui.$cell[0]).offset().left);
                    //console.log($(ui.$cell[0]).offset());
                    //console.log("top :" + top);
                    //console.log("left :" + left);
                    //console.log($td);

                    if (ui.colIndx == $gridW09F2920.pqGrid("getColIndx", {dataIndx: "ProjectName"})) {
                        //$(".l3loading").removeClass('hide');
                        //console.log("Filter client");
                        // var projectIDS = $("#pgridProjectID").pqGrid("option", "dataModel.data");
                        var dataTemp;

                        /*if (sTr != ""){
                         dataTemp = filter2($dataProjectID,
                         {
                         //ProjectID: sTr,
                         ProjectName: sTr
                         });
                         }else{
                         dataTemp = $dataProjectID
                         }

                         var el = $("#gridProjectID");
                         el.pqGrid("option", "height", 200);
                         $gridW09F2920.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: gbColIndx});
                         //$gridW09F2920.pqGrid( "editCell", { rowIndx: ui.rowIndx, dataIndx: "ProjectName" } );
                         $("#pgridProjectID").css({
                         "top": gbDropDownTop + 32,
                         "left": gbDropDownLeft
                         }); // 97 là do height text edit (31)+ header height (40) + top height (22) ;
                         el.parent().show();
                         el.pqGrid("option", "dataModel", {data: dataTemp});
                         el.pqGrid('refreshDataAndView');
                         el.pqGrid("setSelection", {rowIndx: 0});
                         console.log("Filter");
                         if (dataTemp.length > 0) {
                         el.pqGrid("setSelection", {rowIndx: 0});
                         } else {
                         //$(ui.$cell[0]).find("input,select").val("");
                         $gridW09F2920.pqGrid("updateRow", {
                         rowIndx: ui.rowIndx,
                         newRow: { 'ProjectID': '', 'ProjectName': '' }
                         }
                         );
                         $gridW09F2920.pqGrid('refreshDataAndView');
                         }*/

                        $(".l3loading").removeClass('hide');
                        $.ajax({
                            method: "POST",
                            data: {strSearch: sTr},
                            url: "W09F2920/{{$pForm}} /{{$g}}/reloadprojectid",
                            success: function (data) {
                                $(".l3loading").addClass('hide');
                                dataTemp = data;
                                var el = $("#gridProjectID");
                                el.pqGrid("option", "height", 200);
                                $gridW09F2920.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: gbColIndx});
                                //$gridW09F2920.pqGrid( "editCell", { rowIndx: ui.rowIndx, dataIndx: "ProjectName" } );
                                $("#pgridProjectID").css({
                                    "top": gbDropDownTop + 32,
                                    "left": gbDropDownLeft
                                }); // 97 là do height text edit (31)+ header height (40) + top height (22) ;
                                el.parent().show();
                                el.pqGrid("option", "dataModel", {data: dataTemp});
                                el.pqGrid('refreshDataAndView');
                                el.pqGrid("setSelection", {rowIndx: 0});
                                console.log("Filter");
                                if (dataTemp.length > 0) {
                                    el.pqGrid("setSelection", {rowIndx: 0});
                                } else {
                                    //$(ui.$cell[0]).find("input,select").val("");
                                    $gridW09F2920.pqGrid("updateRow", {
                                                rowIndx: ui.rowIndx,
                                                newRow: {'ProjectID': '', 'ProjectName': ''}
                                            }
                                    );
                                    $gridW09F2920.pqGrid('refreshDataAndView');
                                }
                            }
                        });

                        event.stopPropagation();
                        event.preventDefault();

                        /*$.ajax({
                         method: "POST",
                         data: {strSearch: sTr},
                         url: "W09F2920/
                        {{$pForm}}/
                        {{$g}}/loadproject",
                         success: function (dataProject) {
                         //$(".l3loading").addClass('hide');
                         var el = $("#gridProjectID");
                         //el.pqGrid("option", "dataModel.data", data);
                         el.pqGrid("option", "height", 200);
                         $gridW09F2920.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: gbColIndx});
                         $("#pgridProjectID").css({
                         "top": gbDropDownTop + 32,
                         "left": gbDropDownLeft
                         }); // 97 là do height text edit (31)+ header height (40) + top height (22) ;

                         el.parent().show();
                         //el.pqGrid( "option", "dataModel.dataType", "JSON" );
                         //dataProject = "[{ProjectName:'a', ProjectName:'b'}]"
                         el.pqGrid("option", "dataModel", {data: dataProject});
                         el.pqGrid('refreshDataAndView');
                         //el.pqGrid( "refresh" );
                         ////console.log("setSelection");

                         if (dataProject.length > 0) {
                         el.pqGrid("setSelection", {rowIndx: 0});
                         } else {
                         $(ui.$cell[0]).find("input,select").val("");
                         }

                         }

                         });*/
                    }
                    //--------
                    if (ui.colIndx == $gridW09F2920.pqGrid("getColIndx", {dataIndx: "WorkName"})) {
                        //$(".l3loading").addClass('hide');
                        //console.log("WorkdName");
                        var dataTemp;
                        /*if (sTr != ""){
                         dataTemp = filter2($dataWorkID,
                         {
                         WorkName: sTr
                         });
                         }else{
                         dataTemp = $dataWorkID;
                         }

                         var el = $("#gridWorkID");
                         //el.pqGrid("option", "dataModel.data", data);
                         el.pqGrid("option", "height", 200);
                         var left = parseInt($(ui.$cell[0]).offset().left - 30);
                         $gridW09F2920.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: gbColIndx});
                         $("#pgridWorkID").css({
                         "top": gbDropDownTop + 32,
                         "left": gbDropDownLeft
                         }); // 97 là do height text edit (31)+ header height (40) + top height (22) ;
                         el.parent().show();
                         //el.pqGrid( "option", "dataModel.dataType", "JSON" );
                         //dataProject = "[{ProjectName:'a', ProjectName:'b'}]"
                         el.pqGrid("option", "dataModel", {data: dataTemp});
                         el.pqGrid('refreshDataAndView');
                         el.pqGrid("setSelection", {rowIndx: 0});
                         event.stopPropagation();
                         event.preventDefault();
                         //el.pqGrid( "refresh" );
                         if (dataTemp.length > 0) {
                         el.pqGrid("setSelection", {rowIndx: 0});
                         } else {
                         //$(ui.$cell[0]).find("input,select").val("");
                         $gridW09F2920.pqGrid("updateRow", {
                         rowIndx: ui.rowIndx,
                         newRow: { 'WorkID': '', 'WorkName': '' }
                         }
                         );
                         $gridW09F2920.pqGrid('refreshDataAndView');
                         }*/
                        $(".l3loading").removeClass('hide');
                        $.ajax({
                            method: "POST",
                            data: {strSearch: sTr},
                            url: "W09F2920/{{$pForm}} /{{$g}}/reloadworkid",
                            success: function (data) {
                                $(".l3loading").addClass('hide');
                                dataTemp = data;
                                var el = $("#gridWorkID");
                                //el.pqGrid("option", "dataModel.data", data);
                                el.pqGrid("option", "height", 200);
                                var left = parseInt($(ui.$cell[0]).offset().left - 30);
                                $gridW09F2920.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: gbColIndx});
                                $("#pgridWorkID").css({
                                    "top": gbDropDownTop + 32,
                                    "left": gbDropDownLeft
                                }); // 97 là do height text edit (31)+ header height (40) + top height (22) ;
                                el.parent().show();
                                //el.pqGrid( "option", "dataModel.dataType", "JSON" );
                                //dataProject = "[{ProjectName:'a', ProjectName:'b'}]"
                                el.pqGrid("option", "dataModel", {data: dataTemp});
                                el.pqGrid('refreshDataAndView');
                                el.pqGrid("setSelection", {rowIndx: 0});
                                event.stopPropagation();
                                event.preventDefault();
                                //el.pqGrid( "refresh" );
                                if (dataTemp.length > 0) {
                                    el.pqGrid("setSelection", {rowIndx: 0});
                                } else {
                                    //$(ui.$cell[0]).find("input,select").val("");
                                    $gridW09F2920.pqGrid("updateRow", {
                                                rowIndx: ui.rowIndx,
                                                newRow: {'WorkID': '', 'WorkName': ''}
                                            }
                                    );
                                    $gridW09F2920.pqGrid('refreshDataAndView');
                                }
                            }
                        });
                    }

                }
                /*//Shift + tab
                 if (event.keyCode == 9 && event.shiftKey) {
                 var colM = $gridW09F2920.pqGrid("option", "colModel");
                 var obj = ui.rowData;
                 gbRowidx = ui.rowIndx;

                 }*/
                //event.stopPropagation();
                //event.preventDefault();
            },
            cellClick: function (event, ui) {
                $("#pgridProjectID").hide();
                $("#pgridWorkID").hide();
                //$("#divDropDown").css("display", "none");
            },
            quitEditMode: function (event, ui) {
                //updateTotalSO()
            }
        };
        $gridW09F2920 = $("#gridW09F2920").pqGrid(objTimeSheet);
        $gridW09F2920.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW09F2920.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW09F2920.pqGrid("refreshDataAndView");
    })
    ;

    function countProperties(obj) {
        var count = 0;

        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                ++count;
        }

        return count;
    }

    function addNewW09F2920($gridW09F2920) {
        var rowIndex = $gridW09F2920.pqGrid("addRow",
                {
                    rowData: {
                        IsDelete: 0,
                        ProjectID: "",
                        ProjectName: "",
                        WorkID: "",
                        WorkName: "",
                        //Mon: format2(0, "", 2),
                        IsApproveMon: 0,
                        //Tue: format2(0, "", 2),
                        IsApproveTue: 0,
                        //Wed: format2(0, "", 2),
                        IsApproveWed: 0,
                        //Thu: format2(0, "", 2),
                        IsApproveThu: 0,
                        //Fri: format2(0, "", 2),
                        IsApproveFri: 0,
                        //Sat: format2(0, "", 2),
                        IsApproveSat: 0,
                        //Sun: format2(0, "", 2),
                        IsApproveSun: 0,
                        //SumWeek: format2(0, "", 2),
                        IsApproveAll: 0
                    }
                }
        );
        //$gridW09F2920.pqGrid("saveEditCell");
        //$gridW09F2920.pqGrid("editFirstCellInRow", {rowIndx: rowIndex});
        var colIndx = $gridW09F2920.pqGrid("getColIndx", {dataIndx: "ProjectName"});
        $gridW09F2920.pqGrid("setSelection", {
            rowIndx: rowIndex,
            colIndx: colIndx
        });
    }


</script>

