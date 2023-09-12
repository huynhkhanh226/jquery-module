<div class="modal fade" id="modalW39F2031" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading("Đánh giá kết quả","W39F2031",true,"")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW39F2031">
                    <div class="row">
                        <div class="col-md-4 col-xs-4 col-lg-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ma_nhan_vien")}}</label>
                                </div>
                                <div class="col-md-8">
                                    <label class=" liketext">{{isset($valueGrid[0]['EmployeeID']) ? $valueGrid[0]['EmployeeID'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4 col-lg-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="liketext">{{isset($valueGrid[0]['DepartmentName']) ? $valueGrid[0]['DepartmentName'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4 col-lg-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="lbl-normal  liketext">{{Helpers::getRS($g,"Ket_qua_dat")}}(%)</label>
                                </div>
                                <div class="col-md-8">
                                    <label id="lblResultW39F2031"
                                           class="liketext">{{isset($valueGrid[0]['TotalResult']) ? number_format($valueGrid[0]['TotalResult'],2) : ''}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4 col-xs-4 col-lg-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="lbl-normal  liketext">{{Helpers::getRS($g,"Ten_nhan_vien")}}</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="liketext">{{isset($valueGrid[0]['EmployeeName']) ? $valueGrid[0]['EmployeeName'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4 col-lg-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="lbl-normal  liketext">{{Helpers::getRS($g,"To_nhom")}}</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="liketext">{{isset($valueGrid[0]['TeamName']) ? $valueGrid[0]['TeamName'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row form-group">
                    <div class="col-xs-12 col-lg-12 col-md-12">
                        <div id="gridW39F2031"></div>
                    </div>
                </div>
                @if($Mode == 1)
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12 ">
                            <button type="button" id="frm_btnSaveW39F2031"
                                    class="btn btn-default smallbtn pull-right"
                                    title="{{Helpers::getRS($g,"Luu")}}">
                                <span class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var mode = {{$Mode}};
    var err = 0; //biến báo lỗi lúc save
    $(document).ready(function () {
    });

    $("#frm_btnSaveW39F2031").click(function () {
        if (err == 0) {
            ask_save(function () {
                save()
            });
        }
    });

    var objGridW39F2031 = {
        width: '100%',
        height: $(document).height() - 230,
        editable: true,
        freezeCols: 3,
        selectionModel: {type: 'row', mode: 'single'},
        minWidth: 30,
        //pageModel: {type: "local", rPP: 20},
        //filterModel: {on: true, mode: "AND", header: true},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
        collapsible: false,
        postRenderInterval: -1,
        numberCell: {show: false},
        colModel: [
            {
                title: "IsUpdate",
                minWidth: 170,
                dataType: "string",
                dataIndx: "IsUpdate",
                hidden: true,
                isExport: false
            },
            {
                title: "{{Helpers::getRS($g,"Nhom")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "GroupID",
                editor: false,
                align: "left",
                /*render: function (ui) {
                    return {
                        cls: "readonly-status"
                    };
                },*/
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold' : '';
                    var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx] : '';
                    str = "<span class='" + cls + "'>" + val + "</span>";
                    return {
                        text: str,
                        cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                        style: rowData['Style']
                    };
                },
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Chi_tieu_danh_gia")}}",
                minWidth: 270,
                dataType: "string",
                dataIndx: "ElementName",
                editor: false,
                align: "left",
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold' : '';
                    var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx] : '';
                    str = "<span class='" + cls + "'>" + val + "</span>";
                    return {
                        text: str,
                        cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                        style: rowData['Style']
                    };
                },
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Dien_giai")}}",
                minWidth: 240,
                dataType: "string",
                dataIndx: "Content",
                editor: false,
                align: "left",
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold' : '';
                    var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx] : '';
                    str = "<span class='" + cls + "'>" + val + "</span>";
                    return {
                        text: str,
                        cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                        style: rowData['Style']
                    };
                },
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"QL_phan_bo")}}",
                minWidth: 90,
                dataType: "string",
                dataIndx: "IsDistribute",
                align: "center",
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData,
                        checked = rowData["IsDistribute"] == 1 ? 'checked' : ''
                    return {
                        cls: "readonly-status",
                        text: "<label><input type='checkbox' " + checked + " /></label>",
                        style: rowData['Style']
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,"Trong_so")}}(%)",
                minWidth: 100,
                dataType: "float",
                dataIndx: "Rate",
                editor: false,
                align: "center",
                /*render: function (ui) {
                    return {
                        text: ui.rowData.Rate + "%",
                        cls: "readonly-status"
                    };
                },*/
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold' : '';
                    var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx] : '';
                    str = "<span class='" + cls + "'>" + format2(val, '',2) + "</span>";
                    return {
                        text: str,
                        cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                        style: rowData['Style']
                    };
                },
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Cap_nhat")}}(%)",
                minWidth: 100,
                dataType: "float",
                dataIndx: "Confim",
                align: "center",
                editor: false,
                /*render: function (ui) {
                    return {
                        text: ui.rowData.Confim + "%",
                        cls: "readonly-status"
                    };
                },*/
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold' : '';
                    var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx] : '';
                    str = "<span class='" + cls + "'>" + format2(val, '',2) + "</span>";
                    return {
                        text: str,
                        cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                        style: rowData['Style']
                    };
                },
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Xac_nhan")}}(%)",
                minWidth: 100,
                dataType: "float",
                dataIndx: "Result",
                editor: {select: true},
                editModel: {keyUpDown: true},
                format: "#,###.00",
                align: "center",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                editable: function (ui) {
                    var rowData = ui.rowData;
                    return mode == 1 && rowData.IsEdit == 1 ? true : false;
                },
                /*render: function (ui) {
                    //console.log(ui.rowData);
                    var disabled = this.isEditableCell(ui) ? "" : "disabled";
                    return {
                        text: ui.rowData.Result + "%",
                        cls: (disabled ? "readonly-status" : "")
                    };
                }*/
                //editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold' : '';
                    var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx] : '';
                    str = "<span class='" + cls + "'>" + format2(val, '',2) + "</span>";
                    return {
                        text: str,
                        cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                        style: rowData['Style']
                    };
                },
            },
            {
                title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "NoteCriterion",
                editor: true,
                align: "left",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editable: true,
               /* editable: function (ui) {
                    var rowData = ui.rowData;
                    return mode == 1 && rowData.IsEdit == 1 ? true : false;
                },*/
                /*render: function (ui) {
                    //console.log(ui.rowData);
                    var disabled = this.isEditableCell(ui) ? "" : "disabled";
                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }*/
                //editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold' : '';
                    var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx] : '';
                    str = "<span class='" + cls + "'>" + val + "</span>";
                    return {
                        text: str,
                        cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                        style: rowData['Style']
                    };
                },
            }
            @foreach($caption as $row)
            , {
                title: "{{$row['RefCaption']}}",
                minWidth: 150,
                align: "left",
                dataType: "string",
                //format: "{{Helpers::getStringFormat(0)}}",//returnSFormat(0),
                dataIndx: "{{$row['RefID']}}",
                hidden: '{{$row["Disabled"] == 1 ? true:false}}',
                /*editable: function (ui) {
                    var rowData = ui.rowData;
                    //console.log(rowData);
                    return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && task != 'verify' && task != 'view' ? true : false;

                },*/
                editable: true,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '';
                    var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold':'';
                    var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx]: '';
                    str = "<span class='"+cls +"'>"+ val  +"</span>";
                    return {
                        text: str,
                        cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                        style: rowData['Style']
                    };
                }
            }
            @endforeach
        ],
        dataModel: {
            data: {{json_encode($valueGrid)}}
        },
        cellBeforeSave: function (event, ui) {
            var $gridW39F2031 = $("#gridW39F2031");
            var newVal = ui.newVal;
            var rowData = ui.rowData,
                dataIndx = ui.dataIndx,
                rowIndx = ui.rowIndx;
            var columnResult = $gridW39F2031.pqGrid( "getColumn",{ dataIndx: "Result" } );
            var msgConfirm = "{{Helpers::getRS($g,"KQ_danh_gia")}}" + " " + " {{Helpers::getRS($g, 'phai_nho_hon_hoac_bang')}} " + "100";
            if (dataIndx == 'Result') {
                err = 1;
                if (!isNullOrEmpty(rowData.Rate) && !isNullOrEmpty(rowData.Result) && ui.dataIndx == "Result") {
                    if (Number(newVal) < 0){
                        $gridW39F2031.pqGrid("quitEditMode");
                        $gridW39F2031.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                        var obj = $gridW39F2031.pqGrid("getEditCell");
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
                            + "{{Helpers::getRS($g,"KQ_danh_gia")}}" + " " + "{{Helpers::getRS($g,"phai_lon_hon")}}" + " " + "0"
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        //event.stopPropagation();
                        //event.preventDefault();
                        return false;
                    }

                    if (100 < Number(newVal)){
                        $gridW39F2031.pqGrid("quitEditMode");
                        $gridW39F2031.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                        var obj = $gridW39F2031.pqGrid("getEditCell");
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
                            + msgConfirm
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        //event.stopPropagation();
                        //event.preventDefault();
                        return false;
                    }

                }
            }
            if (ui.dataIndx == 'Result' && (Number(newVal) <= Number(rowData.Rate))) {
                ui.rowData[ui.dataIndx] = format2(newVal, '', 2);
            }
        },
        cellSave: function (event, ui) {
            console.log("cellSave");
            var rowData = ui.rowData;
            rowData.IsUpdate = 1;
            err = 0;
            if (rowData.Result == null) {
                rowData.Result = 0;
            }

            if (ui.dataIndx == 'Result') {
                rowData['Result'] = format2(rowData['Result'], '', 2);
                var data = $("#gridW39F2031").pqGrid('option', 'dataModel.data');
                updateParentData(rowData, data);
                var data = $("#gridW39F2031").pqGrid('option', 'dataModel.data');
                var filter = $.grep(data, function (row) {
                    return row.ParentID == "";
                })
                if (filter.length == 0) {
                    $("#lblResultW39F2031").html(format2(0, '', 2));
                } else {
                    var sum = sumArray(filter, "Result");
                    $("#lblResultW39F2031").html(format2(sum, '', 2));
                }
            }

            $("#gridW39F2031").pqGrid("refreshDataAndView");
        }
    };

    var $gridW39F2031 = $("#gridW39F2031").pqGrid(objGridW39F2031);
    $gridW39F2031.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW39F2031.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    setTimeout(function () {
        var $gridW39F2031 = $("#gridW39F2031");
        var data = reformatData($gridW39F2031.pqGrid("option", "dataModel.data"),$gridW39F2031);
        $gridW39F2031.pqGrid("option", "dataModel.data", data);
        $gridW39F2031.pqGrid("refreshDataAndView");
    }, 700)

    function save() {
        var data = $("#gridW39F2031").pqGrid("option", "dataModel.data");
        /*var dataSender = $.grep(data, function (d) {
            return Number(d.IsUpdate) == 1;
        });*/
        if (data.length > 0) {
            $.ajax({
                method: "POST",
                url: '{{url("/W39F2031/$pForm/$g/save")}}',
                data: {
                    dataSender: JSON.stringify(data)
                },
                success: function (data) {
                    console.log(data);
                    if (data.status == 1) {
                        $("#gridW39F2031").pqGrid("refreshDataAndView");
                        save_ok(function () {
                        });
                    } else {
                        save_not_ok();
                    }
                }
            });
        } else {
            alert_warning("Chưa có cập nhật nào mới");
        }
    }

    /*function updateParentData(data){
        for (var i=0; i < data.length; i++){
            if (data[i].IsEdit == 0 &&  data[i].IsUpdate == 0 && data[i].ParentID != ""){
                var parentID = data[i]["AppCriterionGroupID"];
                var filter = $.grep(data, function(row){
                    return row.ParentID == parentID;
                });
                data[i]["Result"] = sumArray(filter, "Result");
                data[i]["Result"] = format2(data[i]["Result"], '',2);
            }
        }

        for (var i=0; i < data.length; i++){
            if (data[i].IsEdit == 0 &&  data[i].IsUpdate == 0 && data[i].ParentID == ""){
                var parentID = data[i]["AppCriterionGroupID"];
                var filter = $.grep(data, function(row){
                    return row.ParentID == parentID;
                });
                data[i]["Result"] = sumArray(filter, "Result");
                data[i]["Result"] = format2( data[i]["Result"], '',2);
            }
        }
        $("#gridW39F2031").pqGrid("refreshDataAndView");
    }*/
    function updateParentData(rowData, data){
        //console.log(rowData);
        var rate = Number(rowData.Rate);
        var Result = Number(rowData.Result);
        var parentID = rowData.ParentID;
        if (parentID != ''){
            var parentRow = $.grep(data, function(row){// lọc ra dòng cha
                return row.AppCriterionGroupID == parentID;
            });
            var childList = $.grep(data, function(row){// lọc ra list dòng con
                return row.ParentID == parentID;
            });
            console.log(childList);

            if (parentRow.length > 0){
                if(rowData.IsEdit == 1 && rowData.IsUpdate == 1){//cấp con nhỏ nhất
                    rowData.calParentID = (rate * Result)/100;//lấy Trọng Số nhân Xác Nhận rồi gán vô trường tạm
                }else{//cấp cha
                    for(var i = 0; i < childList.length; i++){//duyệt lại các dòng con xem dòng nào là cấp con nhỏ nhất
                        if(childList[i]['IsEdit'] == 1 && childList[i]['IsUpdate'] == 1){// là cấp con nhỏ nhất
                            childList[i]['calParentID'] = (childList[i]['Rate'] * childList[i]['Result'])/100;
                        }else{//ko phải cấp con nhỏ nhất
                            childList[i]['calParentID'] = childList[i]["Result"];
                        }
                    }
                }
                parentRow[0]["Result"] = sumArray(childList, "calParentID");//sum trường tạm rồi gán vô trường confirm của cha
                updateParentData(parentRow[0], data);
            }else{
                $("#gridW39F2031").pqGrid("refreshDataAndView");
            }
        }else{
            $("#gridW39F2031").pqGrid("refreshDataAndView");
        }
    }
</script>
