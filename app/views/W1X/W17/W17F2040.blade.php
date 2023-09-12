<section class="content" id="secW17F2040">
    <form class="form-horizontal" id="frmW17F2040" name="frmW17F2040">
        <div class="box-body">
            <div class="form-group mgb5">
                <div class="col-md-4 pdl5">
                    <div class="row">
                        <label class="col-md-4 liketext lbl-normal">{{Helpers::getRS($g,"Trang_thai")}}</label>
                        <div class="col-md-8">
                            <select id="slLeadStatusID" name="slLeadStatusID" class="form-control">
                                @foreach($status as $row)
                                    <option value="{{$row['ID']}}">{{$row['Name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="liketext lbl-normal">{{Helpers::getRS($g,"Tim_kiem")}}</label>
                        </div>
                        <div class="col-md-4">
                            <select id="slSearchFieldID" name="slSearchFieldID" class="form-control">
                                @foreach($search as $row)
                                    <option value="{{$row['SearchFieldID']}}">{{$row['SearchFieldName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="text" id="txtSearchFieldID" name="txtSearchFieldID" class="form-control">
                        </div>
                        <div class="col-md-1 text-right pdl5 pdr5">
                            <button type="submit" id="btnFilter" class="btn btn-default smallbtn"><span
                                        class="fa fa-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </form>
</section>
<section class="content" style="margin-top: -15px">
    <div class="row">
        <div class="col-md-12 detailW17F2040">
            <div id="pqgrid_W17F2040"></div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var colhideW17F2040 = {{json_encode($arrColHide)}};
    var wd = [50, 110, 170, 70, 80, 80, 110, 170, 110, 170, 110, 170, 170, 150, 100, 100, 90, 80, 90];
    var isHiddenColumn = function (el) {
        return colhideW17F2040.contains(el);
    };

    $(document).ready(function () {
        var obj = {
            width: '100%',
            height: documentHeight - 185,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none', flexContent: false},
            postRenderInterval: -1,
            create: function (evt, ui) {
                //disable LeadNo column.
                $(".W17F2040F12").find("option[value='LeadNo']").prop('disabled', true);
                $(".W17F2040F12").find("option[value='LeadNo']").prop('selected', true);

                $('.W17F2040F12').multiselect({
                    includeSelectAllOption: true,
                    selectedClass: 'bg-selected-chk',
                    selectAllValue: 0,
                    maxHeight: documentHeight - 200,
                    buttonContainer: '<div class="pull-right" style="display:block;height: 28px"/>',
                    buttonClass: 'ui-button ui-widget ui-state-default ui-corner-all hei100',
                    dropUp: false,
                    dropRight: false,
                    disabled: true,
                    displayText: "{{Helpers::getRS($g,"Hien_thi")}}",
                    selectAllText: '{{Helpers::getRS($g,"Tat_ca_Web")}}',
                    buttonWidth: '110px',
                    onInitialized: function (select, container) {
                        $(container).find('.multiselect-container').append('<li><button type="button" id="frm_btnSaveW17F2040" class="btn btn-default smallbtn pull-right mgr5"><span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS(0,"Luu")}}</button></li>');
                    }
                });
                $('.W17F2040F12').multiselect('selectAll', false).multiselect('deselect', colhideW17F2040).multiselect('updateButtonText');

            },
            toolbar: {
                items: [
                    {
                        type: 'button',
                        icon: 'ui-icon-plus',
                        label: '{{Helpers::getRS($g,'Them_moi1')}}',
                        listener: function () {
                            showFormDialog('{{url("/W17F2041/".$pForm."/$g")}}', 'modalW17F2041')
                        }
                    },
                    {
                        type: 'select',
                        attr: "multiple data-container='body'",
                        cls: 'pull-right W17F2040F12',
                        style: 'width:150px',
                        listener: function (evt) {
                            var arr = $(evt.target).val(),arrEx = ['LeadNo', 'LeadID','Action'],
                                CM = this.getColModel();
                            colhideW17F2040 = [];

                            for (var i = 0; i < CM.length; i++) {
                                var column = CM[i],
                                    dataIndx = column.dataIndx +"", hid=($.inArray(dataIndx, arr) == -1);
                                if ($.inArray(dataIndx, arrEx)==-1){
                                    column.hidden = hid;
                                    if (hid)colhideW17F2040.push(dataIndx);
                                }
                            }
                            this.option("colModel", this.option("colModel")); //refresh the colModel.
                            this.refresh();
                        },
                        options: [
                            {LeadNo: '{{Helpers::getRS($g,"Ma")}}'},
                            {LeadContactName: '{{Helpers::getRS($g,'Nguoi_lien_he')}}'},
                            {LeadCompanyName: '{{Helpers::getRS($g,'Cong_ty')}}'},
                            {LeadDate: '{{Helpers::getRS($g,'Ngay_tao')}}'},
                            {Telephone: '{{Helpers::getRS($g,'Dien_thoai')}}'},
                            {EmailContact: '{{Helpers::getRS($g,'Email')}}'},
                            {LeadStatusName: '{{Helpers::getRS($g,'Trang_thai')}}'},
                            {GroupSalesName: '{{Helpers::getRS($g,'Nhom_kinh_doanh')}}'},
                            {CreateUserName: '{{Helpers::getRS($g,'Nguoi_tao')}}'}
                            ]
                    },
                    {
                        type: 'button',
                        icon: 'ui-icon-arrowthickstop-1-s',
                        label: '{{Helpers::getRS($g,'Xuat_Excel_U')}}',
                        cls: 'pull-right',
                        listener: function () {
                            var blob = $("#pqgrid_W17F2040").pqGrid("exportData", {format: 'xlsx', sheetName: "Data"});
                            if (typeof blob === "string") {
                                blob = new Blob([blob]);
                            }
                            saveAs(blob, "Employee File.xlsx");
                        }
                    }
                ]
            }
        };
        obj.colModel = [
            @if ($per > 0)
            {
                title: "",
                minWidth: 50,
                maxWidth: 50,
                align: "center",
                dataIndx: "Action",
                render: function (ui) {
                    var str = '<a title="{{Helpers::getRS($g,"Xem")}}" class="viewW17F2041"><i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';
                    @if ($per > 3)
                        str += '<a title="{{Helpers::getRS($g,"Xoa")}}" class="delW17F2040"><i class="glyphicon glyphicon-bin text-black"></i></a>';
                    @endif
                        return str;
                },
                postRender: function (ui) {
                    var grid = this, $cell = grid.getCell(ui);
                    var rowData = ui.rowData;
                    var id = rowData['LeadID'];
                    //edit button
                    $cell.find("a.viewW17F2041").unbind("click").bind("click", function () {
                        callW17F2041(id);
                    });

                    $cell.find("a.delW17F2040").unbind("click").bind("click", function () {
                        deleteW17F2040(id);
                    });
                }
            },
                @endif
            {
                title: "{{Helpers::getRS($g,'Ma')}}",
                minWidth: 140,
                width: 140,
                dataType: "string",
                dataIndx: "LeadNo",
                editor: false,
                hidden: isHiddenColumn('LeadNo'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_lien_he')}}",
                minWidth: 170,
                width: 170,
                dataType: "string",
                editor: false,
                dataIndx: "LeadContactName",
                hidden: isHiddenColumn('LeadContactName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Cong_ty')}}",
                minWidth: 200,
                width: 200,
                dataType: "string",
                editor: false,
                dataIndx: "LeadCompanyName",
                hidden: isHiddenColumn('LeadCompanyName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_tao')}}",
                minWidth: 80,
                dataType: "date",
                align: "center",
                editor: false,
                dataIndx: "LeadDate",
                hidden: isHiddenColumn('LeadDate'),
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Dien_thoai')}}",
                minWidth: 110,
                width: 110,
                dataType: "string",
                editor: false,
                dataIndx: "Telephone",
                hidden: isHiddenColumn('Telephone'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Email')}}",
                minWidth: 200,
                width: 200,
                dataType: "string",
                editor: false,
                dataIndx: "EmailContact",
                hidden: isHiddenColumn('EmailContact'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Trang_thai')}}",
                minWidth: 110,
                width: 110,
                dataType: "string",
                editor: false,
                dataIndx: "LeadStatusName",
                hidden: isHiddenColumn('LeadStatusName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nhom_kinh_doanh')}}",
                minWidth: 170,
                width: 170,
                dataType: "string",
                editor: false,
                dataIndx: "GroupSalesName",
                hidden: isHiddenColumn('GroupSalesName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_tao')}}",
                minWidth: 150,
                width: 150,
                dataType: "string",
                editor: false,
                dataIndx: "CreateUserName",
                hidden: isHiddenColumn('CreateUserName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "LeadID",
                editor: false,
                dataIndx: "LeadID",
                hidden: true
            }
        ];
        obj.dataModel = {
            data: [],
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $gridW17F2040 = $("#pqgrid_W17F2040").pqGrid(obj);
        $gridW17F2040.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW17F2040.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW17F2040.pqGrid("refreshDataAndView");
    });

    var callW17F2041 = function (id) {
        $.ajax({
            method: "GET",
            url: '{{url("/W17F2041/$pForm/$g")}}',
            data: {id: id},
            success: function (data) {
                $("#myModal").html(data);
                $('#modalW17F2041').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });

            }
        });
    };


    $("#frm_btnSaveW17F2040").on('click', function (e) {
        console.log(colhideW17F2040);
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: {action: 'saveF12', arrHide: colhideW17F2040},
            success: function (data) {
                if (data == 1) {
                    save_ok();
                }
                else {
                    alert_error(data);
                }
            }
        });
    });

    function deleteW17F2040(id) {
        ask_delete(function () {
            $.ajax({
                method: "DELETE",
                url: "{{Request::url()}}",
                data: {id: id},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    if (obj.code == 1) {
                        update4ParamGrid($("#pqgrid_W17F2040"), null, 'delete');
                        $(document).find("#modalW17F2041").modal("hide");
                    }
                    else {
                        alert_error(obj.mess);
                    }
                }
            });
        });
    }
    ;

    var W17F2040ExportExcel = function () {
        var blob = $("#pqgrid_W17F2040").pqGrid("exportData", {format: 'xlsx', sheetName: "Data"});
        if (typeof blob === "string") {
            blob = new Blob([blob]);
        }
        saveAs(blob, "Employee File.xlsx");
    };


    $("#frmW17F2040").on('submit', function (e) {
        e.preventDefault();
        $("#pqgrid_W17F2040").pqGrid('showLoading');
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW17F2040").serialize(),
            success: function (data) {
                var obj = $.parseJSON(data);
                $("#pqgrid_W17F2040").pqGrid("option", "dataModel.data", obj);
                $("#pqgrid_W17F2040").pqGrid('refreshDataAndView');
                $("#pqgrid_W17F2040").pqGrid('hideLoading');
                $('#btnW17F2040ExportExcel').removeAttr('disabled');
            }
        });
    });
</script>
