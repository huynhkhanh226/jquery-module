<div class="modal fade pd0" id="modalW76F4070" data-backdrop="static" role="dialog" style="position: absolute">
    <div id="test" class="modal-dialog modal-lg" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W76F4070")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW76F4070" name="frmW76F4070" method="post">
                    <div class="form-group mgt10">
                        <label class="col-md-1 lbl-normal liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                        <div class="col-md-5">
                            <select class="form-control" id="slTaskStatus" name="slTaskStatus">
                                @foreach($status as $row)
                                    <option value="{{$row['ID']}}" {{$row['ID']==1?'selected':''}}>{{$row['Name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-md-2 lbl-normal liketext">{{Helpers::getRS($g,"Thoi_gian_thuc_hien")}}</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="txtTimeW76F4070"
                                       name="txtTimeW76F4070">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1 lbl-normal liketext">{{Helpers::getRS($g,"Hien_thi")}}</label>
                        <div class="col-md-1">
                            <div class="checkbox pdt5">
                                <label>
                                    <input type="radio" name="optViewMode" id="optViewMode0" value="0"
                                           checked> {{Helpers::getRS($g,"Tat_ca1")}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="checkbox pdt5">
                                <label>
                                    <input type="radio" name="optViewMode" id="optViewMode1"
                                           value="1"> {{Helpers::getRS($g,"Cong_viec_cua_toi")}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="checkbox pdt5">
                                <label>
                                    <input type="radio" name="optViewMode" id="optViewMode2"
                                           value="2"> {{Helpers::getRS($g,"Cong_viec_duoc_giao")}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox pdt5">
                                <label>
                                    <input type="radio" name="optViewMode" id="optViewMode3"
                                           value="3"> {{Helpers::getRS($g,"Cong_viec_giao_cho_nguoi_khac_thuc_hien")}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox pdt5">
                                <label>
                                    <input type="radio" name="optViewMode" id="optViewMode4" value="4"> {{Helpers::getRS($g,"Cong_viec_tre_deadline")}}
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mgb5">
                    <div class="col-md-12" id="divW76F4070">
                        <div id="pqgrid_W76F4070" class="mgb5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<div class="divModalW76F4071"></div>
{{HTML::script('packages/default/L3/js/combo_grid.js')}}
<script type="text/javascript">
    var rowIndxW76F4071 = -1;

    $(document).ready(function () {
        $('#txtTimeW76F4070').daterangepicker({format: 'DD/MM/YYYY'});
    });

    $("#modalW76F4070").on('shown.bs.modal', function () {
        var obj = {
            width: '100%',
            height: $(window).height() - 190,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none', flexContent: false},
            postRenderInterval: -1,
            freezeCols: 1,
            toolbar: {
                items: [
                    {
                        type: 'button',
                        icon: 'ui-icon-plus',
                        label: '{{Helpers::getRS($g,'Them_moi1')}}',
                        listener: function () {
                            showFormW76F4071('', '');
                        }
                    }
                ]
            },
            complete: function (evt, ui) {
                if (rowIndxW76F4071 > -1) {
                    var grid = this;
                    grid.setSelection({rowIndx: rowIndxW76F4071, focus: true});
                }
            }
        };
        obj.colModel = [
            {
                title: "",
                width: 90,
                align: "center",
                editor: false,
                dataIndx: "Action",
                render: function (ui) {
                    var str;
                    var rowData = ui.rowData;
                    if (rowData['Assigner'] == '{{Auth::user()->user()->UserID}}') { //Nguoi giao viec
                        if (Number(rowData['CompleteStatus']) == 1)
                            str = '<a title="{{Helpers::getRS($g,"Danh_gia")}}" class="evalueW76F4071"><i class="fa fa-star-half-o text-primary" style="padding-right: 5px"></i></a>';
                        else
                            str = '<a title="{{Helpers::getRS($g,"Danh_gia")}}"><i class="fa fa-lock text-gray" style="padding-right: 5px"></i></a>';
                        str += '<a title="{{Helpers::getRS($g,"Xem")}}" class="viewW76F4071"><i class="glyphicon glyphicon-search text-yellow pdr5" style="font-size: 95%"></i></a>';
                        if (Number(rowData['CompleteStatus']) == 1){
                            str += '<a title="{{Helpers::getRS($g,"Sua")}}" class="editW76F4071Disabled"><i class="glyphicon glyphicon-edit text-gray" style="padding-right: 5px"></i></a>';
                        }else{
                            str += '<a title="{{Helpers::getRS($g,"Sua")}}" class="editW76F4071"><i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';
                        }
                        str += '<a title="{{Helpers::getRS($g,"Xoa")}}" class="delW76F4070"><i class="glyphicon glyphicon-bin text-red"></i></a>';
                    }
                    else {
                        str = '<a title="{{Helpers::getRS($g,"Danh_gia")}}"><i class="fa fa-lock text-gray" style="padding-right: 5px"></i></a>';
                        {{--str += '<a title="{{Helpers::getRS($g,"Xem")."/".Helpers::getRS($g,"Sua")}}" class="viewW76F4071"><i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';--}}
                            str += '<a title="{{Helpers::getRS($g,"Xem")}}" class="viewW76F4071"><i class="glyphicon glyphicon-search text-yellow pdr5" style="font-size: 95%"></i></a>';

                        if (Number(rowData['CompleteStatus']) == 1){
                            str += '<a title="{{Helpers::getRS($g,"Sua")}}" class="editW76F4071Disabled"><i class="glyphicon glyphicon-edit text-gray" style="padding-right: 5px"></i></a>';
                        }else{
                            str += '<a title="{{Helpers::getRS($g,"Sua")}}" class="editW76F4071"><i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';
                        }

                        str += '<a title="{{Helpers::getRS($g,"Xoa")}}"><i class="glyphicon glyphicon-bin text-gray"></i></a>';
                    }
                    return str;
                },
                postRender: function (ui) {
                    var grid = this, $cell = grid.getCell(ui);
                    var rowData = ui.rowData;
                    var id = rowData['TaskID'];
                    //xem button
                    $cell.find("a.viewW76F4071").unbind("click").bind("click", function () {

                        //showFormW76F4071(id,0);
                        showFormW76F4071(id,2); //mode = 2 la mode view
                    });
                    $cell.find("a.evalueW76F4071").unbind("click").bind("click", function () {
                        showFormW76F4071(id, 1);
                    });
                    $cell.find("a.editW76F4071").unbind("click").bind("click", function () {
                        showFormW76F4071(id,0);
                    });

                    $cell.find("a.delW76F4070").unbind("click").bind("click", function () {
                        deleteW76F4070(id);
                    });
                }
            },
            {
                title: "{{Helpers::getRS($g,'Uu_tien')}}",
                minWidth: 90,
                width: 110,
                dataType: "string",
                dataIndx: "TaskPriority",
                align: 'center',
                editor: false,
                render: function (ui) {
                    var rowData = ui.rowData, dataIndx = ui.dataIndx;
                    rowData.pq_cellcls = rowData.pq_cellcls || {};
                    if (rowData["TaskPriority"] == 1)
                        rowData.pq_cellcls[dataIndx] = 'bg-gray';
                    else if (rowData[dataIndx] == 2)
                        rowData.pq_cellcls[dataIndx] = 'bg-green-custom';
                    else if (rowData["TaskPriority"] == 3)
                        rowData.pq_cellcls[dataIndx] = 'bg-red-custom';
                    return rowData["PriorityName"];
                }
            },
            {
                title: "{{Helpers::getRS($g,'Cong_viec')}}",
                minWidth: 200,
                width: 250,
                dataType: "string",
                dataIndx: "TaskName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_giaoU')}}",
                minWidth: 170,
                width: 170,
                dataType: "string",
                editor: false,
                dataIndx: "AssignerName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_thuc_hienU')}}",
                minWidth: 150,
                width: 200,
                dataType: "string",
                editor: false,
                dataIndx: "AssigneeName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_tao')}}",
                minWidth: 80,
                dataType: "date",
                align: "center",
                editor: false,
                dataIndx: "CreateDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "Deadline",
                minWidth: 100,
                dataType: "string",
                align: "center",
                editor: false,
                dataIndx: "ExecuteTo",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                render: function (ui) {
                    var rowData = ui.rowData, dataIndx = ui.dataIndx;
                    rowData.pq_cellcls = rowData.pq_cellcls || {};
                    var lDate = new Date(changeFormat(rowData['ExecuteTo'])).setHours(0, 0, 0, 0);
                    var currDate = new Date().setHours(0, 0, 0, 0);
                    if (lDate <= currDate)
                        rowData.pq_cellcls[dataIndx] = 'bg-red-custom';
                    return rowData["ExecuteTo"];
                }
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_hoan_thanh')}}",
                minWidth: 90,
                dataType: "string",
                align: "center",
                editor: false,
                dataIndx: "CompleteDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Trang_thai')}}",
                minWidth: 110,
                width: 110,
                dataType: "string",
                editor: false,
                align: 'center',
                dataIndx: "StatusName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Danh_gia')}}",
                minWidth: 70,
                width: 110,
                editor: false,
                align: 'center',
                dataIndx: "AssessRate",
            },
            {
                title: "{{Helpers::getRS($g,'Dinh_kem')}}",
                minWidth: 70,
                width: 110,
                editor: false,
                align: 'center',
                dataIndx: "IsAttached",

                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNullOrEmpty(rowData[ui.dataIndx]) || Number(rowData[ui.dataIndx])  == 0){
                        return "";
                    }else{
                        return "<a taskID='"+rowData.TaskID+"' style='color: #3c8dbc !important' onclick='showAttachment(this)'><span class='fa fa-paperclip mgr5 '></span>("+ rowData[ui.dataIndx] + ")</a>";
                    }

                }
            },
            {
                title: "TaskID",
                editor: false,
                dataIndx: "TaskID",
                hidden: true
            },
            {
                title: "Assigner",
                editor: false,
                dataIndx: "Assigner",
                hidden: true
            },
            {
                title: "Assignee",
                editor: false,
                dataIndx: "Assignee",
                hidden: true
            },
            {
                title: "PriorityName",
                editor: false,
                dataIndx: "PriorityName",
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
        var $gridW76F4070 = $("#pqgrid_W76F4070").pqGrid(obj);
        $gridW76F4070.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW76F4070.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW76F4070.pqGrid("refreshDataAndView");

        $('#frmW76F4070').submit();
    });


    function showAttachment(el){
        showFormDialogGet("{{url("W76F4072/".$g)}}/", "modalW76F4072",{id: $(el).attr('taskID')});

    }

    $('#frmW76F4070').on('submit', function (e) {
        e.preventDefault();
        console.log($("#frmW76F4070").serialize());
        rowIndxW76F4071 = -1;
        $("#pqgrid_W76F4070").pqGrid('showLoading');
        var datef = '', datet = '';
        if ($('#txtTimeW76F4070').val() != '') {
            datef = $('#txtTimeW76F4070').data('daterangepicker').startDate.format('DD/MM/YYYY');
            datet = $('#txtTimeW76F4070').data('daterangepicker').endDate.format('DD/MM/YYYY');
        }
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}" + "/post",
            data: $("#frmW76F4070").serialize() + "&datef=" + datef + "&datet=" + datet,
            success: function (data) {
                var result = $.parseJSON(data);
                $("#pqgrid_W76F4070").pqGrid("option", "dataModel.data", result);
                $("#pqgrid_W76F4070").pqGrid('refreshDataAndView');
                $("#pqgrid_W76F4070").pqGrid('hideLoading');
            }
        });
    });



    $('#frmW76F4070').find('#slTaskStatus').on('change', function () {
        $('#frmW76F4070').submit();
    });

    $('#frmW76F4070').find('#txtTimeW76F4070').on('change', function () {
        $('#frmW76F4070').submit();
    });

    $('#frmW76F4070').find('input[name=optViewMode]:radio').on('change', function () {
        $('#frmW76F4070').submit();
    });

    var showFormW76F4071 = function (id, mode) {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "GET",
            url: "{{url("W76F4071/".$g)}}/" + id,
            data: {mode: mode},
            success: function (data) {
                $(".l3loading").addClass('hide');
                $('.divModalW76F4071').html(data);
                $('#modalW76F4071').modal('show');
            }
        });
    };

    var deleteW76F4070 = function (id) {
        ask_delete(function (id) {
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "POST",
                url: "{{url("W76F4070/".$pForm.'/'.$g)}}/delete",
                data: {id: id},
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    var result = $.parseJSON(data);
                    if (result.Status == 0) {
                        delete_ok(function () {
                            $('#modalW76F4070').find('#modalW76F4071').modal('hide');
                            update4ParamGrid($("#pqgrid_W76F4070"), null, "delete");
                        });
                    } else {
                        alert_warning(result.Message);
                    }
                }
            });
        }, id);

    };


</script>


