<section class="content">
    <form class="form-horizontal" id="frmW76F2080" name="frmW76F2080">
        <div class="row pdt10" style="margin-left: 2px !important;">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ngay")}}</label>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group date">
                            <input type="text" class="form-control" id="txtRequestedDate" name="txtRequestedDate" value="{{date("d/m/Y")}}" required>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="col-md-5">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                    </div>
                    <div class="col-md-7">
                        <select id="slStatusID" name="slStatusID" class="form-control">
                            @foreach($rsStatus as $row)
                                <option value="{{$row["StatusID"]}}">{{$row["StatusName"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Phong_hopU")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select id="slFacilityID" name="slFacilityID" class="form-control">
                            @foreach($rsFacilityID as $row)
                                <option value="{{$row["FacilityID"]}}">{{$row["FacilityNo"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <button id="btnSubmit" class="btn btn-default smallbtn pull-right"><span class="fa fa-search"></span>
                    &nbsp;{{Helpers::getRS($g,"Tim_kiem")}}</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div id="pqgrid_W76F2080" style="margin:auto;"></div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var sttW76F2080 = 1;
    $(document).ready(function () {
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi'
        });

        var iW76F2080Width = $("#maintabs").width() - 32;
        var iW76F2080Height = tabMainHeight - 85;
        var obj = {
            width: iW76F2080Width,
            height: iW76F2080Height,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Nguoi_yeu_cau')}}",
                minWidth: 110,
                dataType: "string",
                dataIndx: "RequestUserID",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay')}}",
                minWidth: 70,
                width: 80,
                dataType: "date",
                align: "center",
                editor: false,
                dataIndx: "BookingDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Gio_tu')}}",
                minWidth: 40,
                width: 50,
                dataType: "string",
                align: "center",
                editor: false,
                dataIndx: "TimeValueFrom",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Gio_den')}}",
                minWidth: 40,
                width: 50,
                dataType: "string",
                dataIndx: "TimeValueTo",
                editor: false,
                align: "center",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Phong_hopU')}}",
                minWidth: 70,
                width: 80,
                dataType: "string",
                editor: false,
                dataIndx: "RoomID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ten_phong_hop')}}",
                minWidth: 100,
                width: 110,
                dataType: "string",
                editor: false,
                dataIndx: "RoomName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                minWidth: 220,
                width: 250,
                dataType: "string",
                editor: false,
                dataIndx: "Description",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Trang_thai')}}",
                minWidth: 80,
                dataType: "string",
                editor: false,
                dataIndx: "StatusName",
                align: "center"
            },
            {
                title: "",
                minWidth: 80,
                dataType: "string",
                editor: false,
                dataIndx: "StatusID",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    var status = rowData["StatusID"];
                    var str = "";
                    if (status==1){//Chờ duyệt
                        str = "<button class='btn btn-xs btn-primary btnW76F2080App' type='button' data-id='"+rowData["BookingID"]+"' style='width:30px' title='{{Helpers::getRS($g,"Duyet")}}'><span class='fa fa-check'></span></button>&nbsp;";
                        str += "<button class='btn btn-xs btn-danger btnW76F2080Deny' type='button' data-id='"+rowData["BookingID"]+"' style='width:30px' title='{{Helpers::getRS($g,"Tu_choi")}}'><span class='fa fa-close'></span></button>";
                    }else if(status==2){
                        str = "<button class='btn btn-xs disabled' type='button' style='width:30px' title='{{Helpers::getRS($g,"Duyet")}}'><span class='fa fa-check'></span></button>&nbsp;";
                        str += "<button class='btn btn-xs btn-danger btnW76F2080Deny' type='button' data-id='"+rowData["BookingID"]+"' style='width:30px' title='{{Helpers::getRS($g,"Tu_choi")}}'><span class='fa fa-close'></span></button>";
                    }else{
                        str = "<button class='btn btn-xs btn-primary btnW76F2080App' type='button' data-id='"+rowData["BookingID"]+"' style='width:30px' title='{{Helpers::getRS($g,"Duyet")}}'><span class='fa fa-check'></span></button>&nbsp;";
                        str += "<button class='btn btn-xs disabled' type='button' style='width:30px' title='{{Helpers::getRS($g,"Tu_choi")}}'><span class='fa fa-close'></span></button>";
                    }
                    return str;
                }
            }
        ];
        obj.dataModel = {
            data: "",
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $grid = $("#pqgrid_W76F2080").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

    setTimeout(function () {
        $("#frmW76F2080").submit();
    }, 10);

    //button Duyệt
    $("#pqgrid_W76F2080").on("click",".btnW76F2080App", function(){
        $("#pqgrid_W76F2080").pqGrid("showLoading");
        var book = $(this).attr("data-id");
        $.ajax({
            method: "POST",
            url: '{{url("W76F2080/changeStatus")}}',
            data: {id: book, app: 2},
            success: function (data) {
                var currentObject = $.parseJSON(data);
                update4ParamGrid($("#pqgrid_W76F2080"),currentObject,"edit");
                $("#pqgrid_W76F2080").pqGrid("hideLoading");
            }
        });
    });
    //button Từ chối
    $("#pqgrid_W76F2080").on("click",".btnW76F2080Deny", function(){
        $("#pqgrid_W76F2080").pqGrid("showLoading");
        var book = $(this).attr("data-id");
        $.ajax({
            method: "POST",
            url: '{{url("W76F2080/changeStatus")}}',
            data: {id: book, app: 3},
            success: function (data) {
                var currentObject = $.parseJSON(data);
                update4ParamGrid($("#pqgrid_W76F2080"),currentObject,"edit");
                $("#pqgrid_W76F2080").pqGrid("hideLoading");
            }
        });
    });

    $("#frmW76F2080").on('submit', function (e) {
        e.preventDefault();
        $("#pqgrid_W76F2080").pqGrid("showLoading");
        sttW76F2080 = parseInt($("#frmW76F2080").find("#slStatusID").val());
        var colM= $("#pqgrid_W76F2080").pqGrid( "option", "colModel" );
        colM[7].hidden = (sttW76F2080!=0);
        $("#pqgrid_W76F2080").pqGrid( "option", "colModel", colM );
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW76F2080").serialize(),
            success: function (data) {
                var currentObject = $.parseJSON(data);
                $("#pqgrid_W76F2080").pqGrid("option", "dataModel.data", currentObject).pqGrid("refreshDataAndView").pqGrid("refresh");
                $("#pqgrid_W76F2080").pqGrid("hideLoading");
            }
        });
    });
</script>
