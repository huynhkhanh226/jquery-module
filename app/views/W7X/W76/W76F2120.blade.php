<section class="content sectionW76F2120">
    <form id="frmW76F2120" name="frmW76F2120" method="post" class=" pd5 mgb5 filter-panel">
        <div class="row mgb5">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 ">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"So_cong_van")}}</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="txtDocNo" name="txtDocNo" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 ">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Nhom_van_ban")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select name="cboDocGroupID" id="cboDocGroupID" style="width: 100%; ">
                            <option value="">--</option>
                            @foreach($docGroupList as  $docGroupItem)
                                <option value="{{$docGroupItem['DocGroupCode']}}">{{$docGroupItem['DocGroupName']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mgb5 collapse">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 ">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Tu_khoa")}}</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="txtSearchValue" name="txtSearchValue" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 ">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ngay_phat_hanh")}}</label>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group ">
                            <input type="text" class="form-control" id="dtpReleaseDate1" name="dtpReleaseDate1" value="" autocomplete="off">
                            <span class="input-group-addon"><i onclick="$('#dtpReleaseDate1').datepicker('show')" class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="dtpReleaseDate2" name="dtpReleaseDate2" value="" autocomplete="off">
                            <span class="input-group-addon"><i onclick="$('#dtpReleaseDate2').datepicker('show')" class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mgb5 collapse">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 ">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group ">
                            <input type="text" class="form-control" id="dtpEffectDateFrom1" name="dtpEffectDateFrom1" value="" autocomplete="off">
                            <span class="input-group-addon"><i onclick="$('#dtpEffectDateFrom1').datepicker('show')" class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="dtpEffectDateFrom2" name="dtpEffectDateFrom2" value="" autocomplete="off">
                            <span class="input-group-addon"><i onclick="$('#dtpEffectDateFrom2').datepicker('show')" class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 ">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ngay_het_hieu_luc")}}</label>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group ">
                            <input type="text" class="form-control" id="dtpEffectDateTo1" name="dtpEffectDateTo1" value="" autocomplete="off">
                            <span class="input-group-addon"><i onclick="$('#dtpEffectDateTo1').datepicker('show')" class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="dtpEffectDateTo2" name="dtpEffectDateTo2" value="" autocomplete="off">
                            <span class="input-group-addon"><i onclick="$('#dtpEffectDateTo2').datepicker('show')" class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mgb5 collapse">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 ">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Do_khan_cap")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select style="width: 100%; " id="cbEmergency" name="cbEmergency">
                            <option value="">--</option>
                            @foreach($emergencyList as  $emergencyListitem)
                                <option value="{{$emergencyListitem['ID']}}">{{$emergencyListitem['Name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 ">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Do_bao_mat")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select style="width: 100%; " id="cbSecurity" name="cbSecurity">
                            <option value="">--</option>
                            @foreach($securityList as  $securityListitem)
                                <option value="{{$securityListitem['ID']}}">{{$securityListitem['Name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12 text-center">
                <a id="W76F2120Btn_expand">
                    <span class="fa fa-angle-double-down" style="font-size: 200%; marin-bottom: -10px;"></span>
                </a>
            </div>
        </div>
    </form>
    <div class="row mgb5 ">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="toolbarW76F2120">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="gridW76F2120"></div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $('#dtpEffectDateFrom1').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpEffectDateFrom2').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpEffectDateTo1').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpEffectDateTo2').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpReleaseDate1').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#dtpReleaseDate2').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        {{--var permission = "{{Session::get($pForm)}}";--}}
        var permission = Number("{{Session::get($pForm)}}");
            //permission = 1;
        $("#toolbarW76F2120").digiMenu({
                showText: true,
                buttonList: [
                    {
                        ID: "btnAddW76F2120",
                        icon: "fa fa-plus text-blue",
                        title: "{{Helpers::getRS($g,'Them_moi1')}}",
                        enable: true,
                        hidden: function(){
                            return !(permission >=2);
                        },
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            console.log(ui);
                            ui.$btn.click(function () {
                                showFormDialogPost('{{url("/W76F2121/$pForm/$g")}}' + "/add", 'modalW76F2121');
                            });
                        }
                    }
                    , {
                        ID: "btnExportW76F2120",
                        icon: "fa fa-file-excel-o text-red text-bold",
                        title: "{{Helpers::getRS($g,'Xuat_Excel_U')}}",
                        enable: function () {
                            return true;
                        },
                        hidden: false,
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                exportW76F2120();
                            });
                        }
                    }
                    , {
                        ID: "txtSearchValueW76F2120",
                        icon: "fa  fa-search text-yellow",
                        title: "{{Helpers::getRS($g, 'Tim_kiem')}}",
                        enable: true,
                        hidden: function () {
                            return false;
                        },
                        cls: "",
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                loadDataW76F2120();
                            });
//                            ui.$btn.click(function () {
//                                $('#btnSubmitW76F2090').click();
//                            });
                        }
                    }
                ]
            }
        );

        $("#slSearchFieldID").on("change", function (e) {
            $("#txtSearchValueW76F2120").val("");
        })

        var obj = {
            width: '100%',
            height: $(document).height() - 270,
            freezeCols: 2,
            numberCell: {show: false},
            selectionModel: {type: 'row', mode: 'single'},
            pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true,autoFit: false, lastColumn: 'none'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            complete: function (event, ui) {
            }
        };
        obj.colModel = [
            {
                title: "",
                width: 35,
                align: "center",
                dataIndx: "View",
                isExport: false,
                editor: false,
                render: function (ui) {
                    var permission = Number("{{Session::get($pForm)}}");
                    var str = digiContextMenu({
                            showText: true,
                            buttonList: [
                                {
                                    ID: "btnViewW76F2120",
                                    icon: "fa fa-eye text-green",
                                    title: '{{Helpers::getRS($g,"Xem")}}',
                                    enable: function () {
                                        return permission >= 1;
                                    },
                                    hidden: function () {
                                        return !(permission >= 1);
                                    },
                                    type: "button",
                                },
                                {
                                    ID: "btnEditW76F2120",
                                    icon: "fa fa-edit text-yellow",
                                    title: '{{Helpers::getRS($g,"Sua")}}',
                                    enable: function () {
                                        return permission >= 3;
                                    },
                                    hidden: function () {
                                        return !(permission >= 3);
                                    },
                                    type: "button",
                                }
                                , {
                                    ID: "btnDeleteW76F2120",
                                    icon: "fa fa-trash text-red",
                                    title: '{{Helpers::getRS($g,"Xoa")}}',
                                    enable: function () {
                                        return permission >= 4;
                                    },
                                    hidden: function () {
                                        return !(permission >= 4);
                                    },
                                    type: "button"
                                }
                            ]
                        }
                    );
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;
                    $cell.find(".btnViewW76F2120").bind("click", function (evt) {
                        showFormDialogPost("{{url('/W76F2121/'.$pForm.'/'.$g.'/view')}}", "modalW76F2121", {
                            ID: rowData['ID']
                        });
                    });
                    $cell.find(".btnEditW76F2120").bind("click", function (evt) {
                        showFormDialogPost("{{url('/W76F2121/'.$pForm.'/'.$g.'/edit')}}", "modalW76F2121", {
                            ID: rowData['ID']
                        });
                    });
                    $cell.find(".btnDeleteW76F2120").bind("click", function (evt) {
                        ask_delete(function () {
                            postMethod("{{url('/W76F2120/view/'.$pForm.'/'.$g.'/delete')}}", function (res) {
                                var data = JSON.parse(res);
                                switch (data.status) {
                                    case "SUC":
                                        var $grid = $("#gridW76F2120");
                                        delete_ok(function () {
                                            console.log("da xoa thanh cong");
                                            update4ParamGrid($grid, null, 'delete');
                                        });
                                        break;
                                    case "ERROR":
                                        alert_error(data.message);
                                        break;
                                    case "CHECKSTORE":
                                        alert_error(data.message);
                                        break;
                                }
                            }, {ID: rowData.ID})
                        });
                    });
                }
            }
            , {
                title: "{{Helpers::getRS($g,'So_cong_van')}}",
                width: 170,
                align: "left",
                dataIndx: "DocNo",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
            },
            {
                title: "{{Helpers::getRS($g,'Nhom_van_ban')}}",
                width: 220,
                dataType: "string",
                editor: false,
                hidden: false,
                align: "center",
                dataIndx: "DocGroupName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_ky')}}",
                width: 150,
                dataType: "string",
                editor: false,
                dataIndx: "Signer",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_phat_hanh')}}",
                width: 110,
                dataType: "date",
                editor: false,
                align: "center",
                dataIndx: "ReleaseDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Trich_yeu')}}",
                width: 230,
                dataType: "string",
                editor: false,
                dataIndx: "Content",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_hieu_luc')}}",
                width: 110,
                dataType: "date",
                editor: false,
                align: "center",
                dataIndx: "EffectDateFrom",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_het_hieu_luc')}}",
                width: 110,
                align: "center",
                dataType: "date",
                editor: false,
                dataIndx: "EffectDateTo",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Dang_van_ban')}}",
                width: 110,
                align: "center",
                dataType: "string",
                editor: false,
                dataIndx: "DocTypeName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Do_khan_cap')}}",
                width: 140,
                align: "center",
                dataType: "string",
                editor: false,
                dataIndx: "EmergencyName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Do_bao_mat')." (%)"}}",
                width: 140,
                align: "center",
                dataType: "string",
                editor: false,
                dataIndx: "SecurityName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Cong_khai')}}",
                width: 80,
                dataType: "string",
                editor: false,
                align: "center",
                dataIndx: "IsPublic",
                render: function(ui){
                    var rowData = ui.rowData;
                    var isCheck = rowData.IsPublic == 1 ? 'checked' : '';
                    return '<input type="checkbox" '+isCheck+' disabled />';
                },
            }
        ];
        obj.dataModel = {
            data: [],
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        $("#gridW76F2120").pqGrid(obj);
        $("#gridW76F2120").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#gridW76F2120").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $("#gridW76F2120").pqGrid("refreshDataAndView");
        setTimeout(function () {
            loadDataW76F2120();
            resizePqGrid();
        }, 300);
    });

    $('#W76F2120Btn_expand').click(function (e) {
        e.preventDefault();
        $('.collapse').collapse('toggle');
        $('.collapse').toggleClass("hide");
        $(this).find("span").toggleClass('fa-angle-double-down');
        $(this).find("span").toggleClass('fa-angle-double-up');
        setTimeout(function () {
            resizePqGrid();
        }, 400);
    })

    var exportW76F2120 = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW76F2120"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#gridW76F2120").pqGrid("option", "dataModel.data"));
        var now = new Date();
        var d = new Date();
        var toDay = d.getTime();
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
                    downloadLink.download = "Document_" + toDay + ".xls";
                    downloadLink.innerHTML = "Document File";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };

    $("#frmW76F2120").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: '{{url("/W76F2090/view/$pForm/$g/filter")}}',
            data: $('#frmW76F2090').serialize() + "&dateFromReceiveSendDate=" + dateFromReceiveSendDate + "&dateToReceiveSendDate=" + dateToReceiveSendDate
            + "&dateFromEffectDateFrom=" + dateFromEffectDateFrom + "&dateToEffectDateFrom=" + dateToEffectDateFrom
            + "&dateFromEffectDateTo=" + dateFromEffectDateTo + "&dateToEffectDateTo=" + dateToEffectDateTo,
            success: function (data) {
                $('#gridW76F2090').html(data);
            }
        });
        loadDataW76F2120();
    });

    function loadDataW76F2120() {
        $("#gridW76F2120").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W76F2120/view/$pForm/$g/filter")}}',
            data: $("#frmW76F2120").serialize(),
            success: function (res) {
                $("#gridW76F2120").pqGrid("hideLoading");
                switch (res.status) {
                    case "OKAY":
                        var temp = reformatData(res.data, $("#gridW76F2120"));
                        $("#gridW76F2120").pqGrid("option", "dataModel.data",temp);
                        $("#gridW76F2120").pqGrid("refreshDataAndView");
                        break;
                    case "ERROR":
                        alert_error(res.message);
                        break;
                }
            }
        });
    }

</script>