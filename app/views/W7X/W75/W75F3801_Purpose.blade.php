<div id="gridW75F3801_Purpose"></div>
<script type="text/javascript">
    $grid = $("#gridW75F3801_Purpose");
    $(function () {
        /*var dateEditor = function (ui) {
         //var row = $("#gridW75F3801_Course").pqGrid("getRowData", {rowIndx: gRowIndxCourse});
         //var row = $("#gridW75F3801_Purpose").pqGrid("getRowData", {rowIndx: gRowIndxCourse});
         var $cell = ui.$cell,
         rowData = ui.rowData,
         dataIndx = ui.dataIndx,
         cls = ui.cls,
         dc = $.trim(rowData[dataIndx]);
         $cell.css('padding', '0');
         var $inp = $("<input type='text' name='" + dataIndx + "' class='" + cls + " pq-date-editor' />")
         .appendTo($cell)
         .val(dc).datepicker({
         changeMonth: true,
         changeYear: true,
         autoclose: true,
         format: "dd/mm/yyyy",
         language: '{{$lang}}',
         todayHighlight: true,
         showOnFocus: true,
         toggleActive: false,
         allowDeselection: false,
         });
         }
*/
        var newDate = null;
        var dateEditor = function(ui){
            var $inp = ui.$cell.find("input"),
                    grid = this;
            //initialize the editor
            $inp.datepicker({
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                language: '{{$lang}}',
                todayHighlight: true,
                showOnFocus: true,
                toggleActive: true,
                allowDeselection: false,
                defaultViewDate : '',
                isDateGrid: true
            }).on('changeDate', function (d) {
                var da = (new Date(d.date)).toString('dd/MM/yyyy');
                //alert(da);
                newDate = da;
            });
        }

        var getCustomData = function (ui){
            return newDate;
        }

/*
        var validate = function (ui) {
            ////console.log("validate")
            var $inp = ui.$cell.find("input");
            var grid = $("#gridW75F3801_Purpose");
            var valid = grid.pqGrid("isValid", {
                rowIndx: ui.rowIndx,
                dataIndx: ui.dataIndx,
                value: $inp.val()
            }).valid;
            if (!valid) {
                $(ui.$cell[0]).addClass("pq-cell-red-tr");//");//.css('borderColor', 'red');
                grid.pqGrid("editCell", {rowIndx: ui.rowIndx, dataIndx: ui.dataIndx});
                return false;
            }
            return true;

        }
*/


        var dsPurpose = {{json_encode($dsPurpose)}};
        var objPurpose = {
            width: $("#divPurpose").width(),
            height: $("#modalW75F3801").find(".modal-content").height() - 150,
            editable: false,
            freezeCols: 1,
            title: "<b>{{Helpers::getRS($g,'Muc_tieu')}}</b>",
            //selectionModel: { type: 'none', subtype:'incr', cbHeader:true, cbAll:true},

            minWidth: 30,
            //pageModel: {type:"local", rPP:10 },
            //selectionModel: { type: 'cell', mode: 'single' },
            //filterModel: {on: true, mode: "AND", header: true},
            selectionModel: {type: 'cell'},
            editor: {type: 'textbox', select: true, style: 'outline:none;'},
            trackModel: {on: true},
            showTitle: true,
            wrap: false,
            hwrap: false,
            collapsible: false,
            scrollModel: {autoFit: true},
            //numberCell: {show:false},
            //flexHeight: true,
            colModel: [
                {
                    title: "{{Helpers::getRS($g,"Muc_tieu")}}",
                    dataIndx: "ActTarget",
                    minWidth: 170,
                    editor: {type: 'textbox'},
                    required: true,
                    //validations: [{type: 'minLen', value: 1, msg: 'Required'}],
                    //cls: 'gridColRequire'
                    render: function (ui) {
                        return {
                            cls: 'gridColRequire'
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Thoi_gian_hoan_thanh")}}", width: "140",
                    dataType: "date",
                    dataIndx: "CompletedDate",
                    align: "center",
                    required: true,
                    editor: {
                        //type: dateEditor
                        type: 'textbox',
                        init: dateEditor,
                        getData: getCustomData,
                    },
                    //format: "dd/mm/yyyy",

                    /*validations: [
                        {type: 'regexp', value: '[0-9]{2}/[0-9]{2}/[0-9]{4}', msg: 'Required'}
                    ],*/
                    //cls: 'gridColRequire'
                    render: function (ui) {
                        return {
                            cls: 'gridColRequire'
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "Notes",
                    editor: {type: 'textbox'}
                }
            ],
            dataModel: {
                data: dsPurpose

            },


      /*      editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                //onBlur: "save",
                clicksToEdit: 0
            },*/
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                //filterKeys: false,
                keyUpDown: false,
                cellBorderWidth: 0,
                clicksToEdit: 2
            },
            cellClick: function (event, ui) {
                $("#gridW75F3801_Purpose").pqGrid("saveEditCell");
                $("#gridW75F3801_Purpose").pqGrid("quitEditMode");
            },
            cellKeyDown: function (event, ui) {
                if ($("#gridW75F3801_Purpose").pqGrid("option", "editable") == true) {
                    var obj = $("#gridW75F3801_Purpose").pqGrid("option", "dataModel.data");
                    // key (esc) - back to the first cell
                    var $gridPurpose = $("#gridW75F3801_Purpose");
                    // key (ctrl + delete) - to delete a row
                    if (event.keyCode == 46 && event.ctrlKey) {
                        event.stopPropagation();
                        event.preventDefault();
                        var numrow = $gridPurpose.pqGrid("option", "dataModel.data").length;
                        var rowIndx = ui.rowIndx;
                        ////console.log(rowIndx);
                        $gridPurpose.pqGrid("deleteRow", {rowIndx: rowIndx});

                        if (rowIndx == 0) {
                            if (numrow >= 2) {
                                $gridPurpose.pqGrid("setSelection", {
                                    rowIndx: rowIndx,
                                    colIndx: 0
                                });
                            } else {
                                var idx = $gridPurpose.pqGrid("addRow", {rowData: {}});
                                $gridPurpose.pqGrid("setSelection", {
                                    rowIndx: idx,
                                    colIndx: 0
                                });
                            }
                        }

                        if (rowIndx > 0) {
                            if (rowIndx < numrow - 1) {
                                $gridPurpose.pqGrid("setSelection", {
                                    rowIndx: rowIndx,
                                    colIndx: ui.colIndx
                                });
                            } else {
                                $gridPurpose.pqGrid("setSelection", {
                                    rowIndx: rowIndx - 1,
                                    colIndx: ui.colIndx
                                });
                            }

                        }

                    }
                    // key (insert) - to insert a row
                    if (event.keyCode == 45) {
                        event.stopPropagation();
                        event.preventDefault();
                        var idx = $gridPurpose.pqGrid("addRow",
                                {rowData: {}}
                        );
                        $gridPurpose.pqGrid("quitEditMode");
                        $gridPurpose.pqGrid("setSelection", {rowIndx: idx, colIndx: 0});
                    }
                }

            },
            editorKeyDown: function (event, ui) {
                var obj = $("#gridW75F3801_Purpose").pqGrid("getEditCell");
                var $td = obj.$td;
                var $cell = ui.$cell;
                var $editor = ui.$editor;
                var rowData = ui.rowData;
                var colIndx = ui.colIndx;
                var cellValue = $editor.val();

                //console.log(ui);
                var obj = $("#gridW75F3801_Purpose").pqGrid("option", "dataModel.data");
                // key (esc) - back to the first cell
                var $gridPurpose = $("#gridW75F3801_Purpose");

                //ESC
                if (event.keyCode == 27) {
                    $(".l3DateGrid").hide();
                }


                //key (delete) - to delete cell
                if (event.keyCode == 46) {
                    //ui.rowData[ui.dataIndx] = ""
                    $editor.val("");
                    /*var col = $gridPurpose.pqGrid("getColumn", {dataIndx: ui.dataIndx});
                    if (col.cls == "gridColRequire") {//Bat buoc nhap
                        validate(ui);
                    }*/
                }


                // key (ctrl + delete) - to delete a row
                if (event.keyCode == 46 && event.ctrlKey) {
                    event.stopPropagation();
                    event.preventDefault();
                    $(".l3DateGrid").hide();
                    var numrow = $gridPurpose.pqGrid("option", "dataModel.data").length;
                    var rowIndx = ui.rowIndx;
                    $gridPurpose.pqGrid("deleteRow", {rowIndx: rowIndx});

                    if (rowIndx == 0) {
                        if (numrow >= 2) {
                            $gridPurpose.pqGrid("setSelection", {
                                rowIndx: rowIndx,
                                colIndx: 0
                            });
                        } else {
                            var idx = $gridPurpose.pqGrid("addRow", {rowData: {}});
                            $gridPurpose.pqGrid("setSelection", {
                                rowIndx: idx,
                                colIndx: 0
                            });
                        }
                    }

                    if (rowIndx > 0) {
                        if (rowIndx < numrow - 1) {
                            $gridPurpose.pqGrid("setSelection", {
                                rowIndx: rowIndx,
                                colIndx: ui.colIndx
                            });
                        } else {
                            $gridPurpose.pqGrid("setSelection", {
                                rowIndx: rowIndx - 1,
                                colIndx: ui.colIndx
                            });
                        }

                    }

                }


                // key (insert) - to insert a row
                if (event.keyCode == 45) {
                    event.stopPropagation();
                    event.preventDefault();
                    $(".l3DateGrid").hide();
                    var idx = $gridPurpose.pqGrid("addRow",
                            {rowData: {}}
                    );
                    ////console.log(idx);
                    $gridPurpose.pqGrid("quitEditMode");
                    //$gridPurpose.pqGrid("editFirstCellInRow", {rowIndx: idx});
                    $gridPurpose.pqGrid("setSelection", {rowIndx: idx, colIndx: 0});
                }

                if (event.keyCode == 13 || event.keyCode == 9) {
                   /* var col = $gridPurpose.pqGrid("getColumn", {dataIndx: ui.dataIndx});
                    ////console.log(ui.rowData);
                    if (col.cls == "gridColRequire") {//Bat buoc nhap
                        validate(ui);
                    }
*/

                }
            },
            cellBeforeSave: function( event, ui ) {
                console.log('cellBeforeSave');
                /*if (ui.dataIndx == 'CompletedDate'){
                 if (event.keyCode != 13){
                 $("#gridW75F3801_Purpose").pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: ui.dataIndx});
                 return false;
                 }
                 }*/
                /*if (dateOpen){
                    //$("#gridW75F3801_Purpose").pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: ui.dataIndx});
                    return false;
                }*/

                //return false;

                var obj = $grid.pqGrid("getEditCell");
                var $editor = obj.$editor;

                var rowData = ui.rowData,
                        dataIndx = ui.dataIndx,
                        newVal = ui.newVal,
                        oldVal = ui.oldVal,
                        rowIndx = ui.rowIndx

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
                            + "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}"
                            + '</label></span></div>'
                            + '</div>'
                        });
                        //$($editor).parent().find('.confirmContent').html(messagW05F1602);
                        $($editor).confirmation('show');
                    }
                    return false;
                }
            },
            editorFocus: function( event, ui ) {
                $grid = $("#gridW75F3801_Purpose");
                /*if (ui.dataIndx == "CompletedDate"){
                    dateEditor(ui);
                }*/


                /*var obj = $grid.pqGrid( "getEditCell" );
                var $editor = obj.$editor; //editor.
                var $td = obj.$td; //editor.

                $td.datepicker({
                    changeMonth: true,
                    changeYear: true,
                    autoclose: true,
                    format: "dd/mm/yyyy",
                    language: '{{$lang}}',
                    todayHighlight: true,
                    showOnFocus: true,
                    toggleActive: true,
                    allowDeselection: false,
                }).on('changeDate',function(e){
                           console.log('sdfdsf');
                    curDate = $(this).data('datepicker').getFormattedDate();
                    console.log(curDate);

                    $editor.val(curDate);
                });
                $td.datepicker('show');*/

            },
            editorBlur: function (event, ui){
                /*if (dateOpen){
                    event.stopPropagation();
                    event.preventDefault();
                }*/
            },

            complete: function (event, ui){
                /*var idx = $("#gridW75F3801_Purpose").pqGrid("addRow", {rowData: {}});
                $("#gridW75F3801_Purpose").pqGrid("setSelection", {
                    rowIndx: idx,
                    colIndx: ui.colIndx
                });
                $("#gridW75F3801_Purpose").pqGrid( {editable:true} );*/
            }
        };
        var gridW75F3801_Purpose = $("#gridW75F3801_Purpose").pqGrid(objPurpose);
        gridW75F3801_Purpose.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        gridW75F3801_Purpose.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        gridW75F3801_Purpose.pqGrid("refreshDataAndView");
    });


    var W05F1621ExportExcel = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW75F3801_Purpose"), _title, _dataIndx, _align, _format, _format);
        var _data = JSON.stringify($("#gridW75F3801_Purpose").pqGrid("option", "dataModel.data"));

        $.ajax({
            method: "POST",
            data: {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    var row = getRowSelection($("#gridW75F3801_Course"));
                    var employeeID = '{{(Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID}}';
                    downloadLink.download = employeeID + "_" + utf8_to_ascii(row["TrainingCourseName"]) + ".xls";
                    downloadLink.innerHTML = "Download File";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };
</script>
