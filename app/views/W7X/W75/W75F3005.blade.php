<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F3005" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F3005")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <form id="frmW75F3005" name="frmW75F3005" method="post">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div id="divDateFromW75F3005" class="input-group date">
                                                    <input type="text" class="form-control" id="txtDateFromW75F3005"
                                                           name="txtDateFromW75F3005" value="{{date(Helpers::beginDateOfPeriod())}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="divDateToW75F3005" class="input-group date">
                                                    <input type="text" class="form-control" id="txtDateToW75F3005"
                                                           name="txtDateToW75F3005" value="{{date(Helpers::endDateOfPeriod())}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Khoi")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbBlockIDW75F3005" name="cbBlockIDW75F3005"
                                                placeholder="">
                                            @foreach($block as $row)
                                                <option value="{{$row['BlockID']}}">{{$row['BlockName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"To_nhom")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbTeamIDW75F3005" name="cbTeamIDW75F3005"
                                                placeholder="">
                                            @foreach($team as $row)
                                                <option value="{{$row['TeamID']}}">{{$row['TeamName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Du_an")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbProjectIDW75F3005" name="cbProjectIDW75F3005"
                                                placeholder="">
                                            @foreach($projects as $row)
                                                <option value="{{$row['ProjectID']}}">{{$row['ProjectName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbDepartmentIDW75F3005" name="cbDepartmentIDW75F3005"
                                                placeholder="">
                                            @foreach($department as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Nhom_NV")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbEmpGroupIDW75F3005" name="cbEmpGroupIDW75F3005"
                                                placeholder="">
                                            @foreach($groupID as $row)
                                                <option value="{{$row['EmpGroupID']}}">{{$row['EmpGroupName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <button type="submit" id="frm_btnTK"
                                                class="btn btn-default smallbtn pull-right"
                                                title="{{Helpers::getRS($g,"Thong_ke")}}">
                                            <span class="fa fa-list-alt text-blue mgr5"></span> {{Helpers::getRS($g,"Thong_ke")}}
                                        </button>
                                        <button type="button" id="frm_btnTCTK"
                                                class="btn btn-default smallbtn pull-right mgr5"
                                                title="{{Helpers::getRS($g,"Tieu_chi_thong_ke")}}"
                                                onclick="loadW75F3006()">
                                            <span class="fa fa-star text-yellow mgr5"></span> {{Helpers::getRS($g,"Tieu_chi_thong_ke")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12">
                                <div id="pqgrid_W75F3005"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12">
                                <a class="lbl-normal pdr0 text-blue liketext" onclick="viewDetail()"> <span
                                            class="fa fa-caret-down text-blue mgr5"></span> {{Helpers::getRS($g,"Chi_tiet")}}
                                </a>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12">
                                <div class="hide" id="tb_pqgrid_W75F3005_2"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12 ">
                                <button type="button" id="frm_btnSave"
                                        class="btn btn-default smallbtn pull-right"
                                        title="{{Helpers::getRS($g,"Luu")}}"
                                        onclick="ask_save(function(){save()})">
                                    <span class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                                <button onclick="sendMail()" type="button" id="frm_btnSendmail"
                                        class="btn btn-default smallbtn pull-right mgr5 "
                                        title="{{Helpers::getRS($g,"Gui_mail")}}"><span
                                            class="fa fa-envelope-o mgr5 text-orange"></span> {{Helpers::getRS($g,"Gui_mail")}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="secW75F3006"></section>
<script type="text/javascript">
    toggle = false;
    var tranMonth = {{$tranMonth}};
    var tranYear = {{$tranYear}};
    captionGrid2 = [];
    saveOrNot = true;

    $('#txtDateFromW75F3005').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: '{{Session::get("locate")}}'
    });

    $('#txtDateToW75F3005').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: '{{Session::get("locate")}}'
    });

    function sendMail() {
        $.ajax({
            method: "POST",
            url: '{{url("/W75F3005/$pForm/$g/sendMail")}}',
            success: function (data) {
                var rs = JSON.parse(data);
                showEmailPopup(rs.rsvalue, []);
            }
        });
    }
    $("#cbBlockIDW75F3005").change(function (e) {
        e.preventDefault();
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W75F3005/$pForm/$g/blockChange")}}',
            data: 'teamID=' + $("#cbTeamIDW75F3005").val() + '&departmentID=' + $("#cbDepartmentIDW75F3005").val() + '&blockID=' + $("#cbBlockIDW75F3005").val(),
            success: function (data) {
                console.log(data);
                $("#cbDepartmentIDW75F3005").html(data.strDep);
                $("#cbTeamIDW75F3005").html(data.strTeam);
                //$("#cbEmpGroupIDW75F3005").html(data.strEm);
                $(".l3loading").addClass('hide');
            }
        });
    });

    $("#cbDepartmentIDW75F3005").change(function () {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W75F3005/$pForm/$g/departmentChange")}}',
            data: 'teamID=' + $("#cbTeamIDW75F3005").val() + '&departmentID=' + $("#cbDepartmentIDW75F3005").val() + '&blockID=' + $("#cbBlockIDW75F3005").val(),
            success: function (data) {
                console.log(data);
                $("#cbTeamIDW75F3005").html(data.strTeam);
                //$("#cbEmpGroupIDW75F3005").html(data.strEm);
                $(".l3loading").addClass('hide');
            }
        });
    });

    $("#cbTeamIDW75F3005").change(function () {
        /*$(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{--{{url("/W75F3005/$pForm/$g/teamChange")}}--}}',
            data: 'teamID=' + $("#cbTeamIDW75F3005").val() + '&departmentID=' + $("#cbDepartmentIDW75F3005").val() + '&blockID=' + $("#cbBlockIDW75F3005").val(),
            success: function (data) {
                console.log(data);
                $("#cbEmpGroupIDW75F3005").html(data.strEm);
                $(".l3loading").addClass('hide');
            }
        });*/
    });

    $(document).ready(function () {
        $('#txtDateW75F3005').daterangepicker({format: 'DD/MM/YYYY'});
        //$('#cbBlockIDW75F2130').val("%");
        //$('#cbEmployeeW75F2130').val("%");
        //$('#cbStatusIDW75F2130').val("0");
       /* var dayFrom = "01";
        var dayTo = "";
        //alert(tranMonth);
        if (tranMonth == 1 || tranMonth == 3 || tranMonth == 5 || tranMonth == 7 || tranMonth == 8 || tranMonth == 10 || tranMonth == 12) {
            dayTo = "31";
        }
        if (tranMonth == 4 || tranMonth == 6 || tranMonth == 9 || tranMonth == 11) {
            dayTo = "30";
        }
        if (tranMonth == 2) {
            dayTo = kiem_tra_nam_nhuan(tranYear);
        }
        if (Number(tranMonth) < 10) {
            tranMonth = '0' + tranMonth
        }*/
        //var dateFrom =  dayFrom + "/" + tranMonth + "/" + tranYear;
        //var dateTo = dayTo + "/" + tranMonth + "/" + tranYear;
        var dateFrom =  "{{Helpers::beginDateOfPeriod()}}"
        var dateTo = "{{Helpers::endDateOfPeriod()}}";
        //$('#txtDateW75F3005').data('daterangepicker').setStartDate(dateFrom);
        //$('#txtDateW75F3005').data('daterangepicker').setEndDate(dateTo);
        loadAtBegin();
    });

    /*function kiem_tra_nam_nhuan(nam) {
        // nếu năm chia hết cho 100
        // thì kiểm tra nó có chia hết cho 400 hay không
        if (nam % 100 == 0) {
            // nêu chia hết cho 400 thì là năm nhuận
            if (nam % 400 == 0) {
                return 29;
            }
            else { // ngược lại không phải năm nhuận
                return 28;
            }
        }
        else if (nam % 4 == 0) { // trường hợp chia hết cho 4 thì là năm nhuận
            return 29;
        }
        else { // cuối cùng trường hợp không phải năm nhuận
            return 28;
        }
    }*/

    var valueGrid1 = [];
    loadGrid();
    //loadGrid2();

    $("#frmW75F3005").on('submit', function (e) {
        e.preventDefault();
        //alert("da chay fillter");
        filterGridW75F3005();
    });

    function viewDetail() {

        var $grid1 = $("#pqgrid_W75F3005");
        var $grid2 = $('#tb_pqgrid_W75F3005_2');

        $grid2.toggleClass('hide');

        if ($grid2.hasClass("hide")){
            $grid1.pqGrid( "option", "height", $grid1.pqGrid( "option", "height") + 200);
        }else{
            $grid1.pqGrid( "option", "height", $grid1.pqGrid( "option", "height") - 200);
        }
        resizePqGrid();

    }

    function loadAtBegin() {
        //$("#pqgrid_W75F3005").pqGrid("showLoading");
        /*var datef = $('#txtDateW75F3005').data('daterangepicker').startDate.format('DD/MM/YYYY');
        var datet = $('#txtDateW75F3005').data('daterangepicker').endDate.format('DD/MM/YYYY');*/
        var datef =  "{{Helpers::beginDateOfPeriod()}}"
        var datet = "{{Helpers::endDateOfPeriod()}}";
        $.ajax({
            method: "POST",
            url: '{{url("/W75F3005/$pForm/$g/filter")}}',
            data: $("#frmW75F3005").serialize() + '&datefrom=' + datef + '&dateto=' + datet,
            success: function (data) {
                console.log(data);
                var rs = JSON.parse(data);
                $("#pqgrid_W75F3005").pqGrid("option", "dataModel.data", rs[1]);
                $("#pqgrid_W75F3005").pqGrid("refreshDataAndView");
                $("#pqgrid_W75F3005").pqGrid("hideLoading");
            }
        });
    }

    function filterGridW75F3005() {
        var $grid = $("#pqgrid_W75F3005");
        $grid.pqGrid("showLoading");
        var datef = $('#txtDateFromW75F3005').val();
        var datet = $('#txtDateToW75F3005').val();
        $.ajax({
            method: "POST",
            url: '{{url("/W75F3005/$pForm/$g/filter")}}',
            data: $("#frmW75F3005").serialize() + '&datefrom=' + datef + '&dateto=' + datet,
            success: function (data) {
                console.log(data);
                var rs = JSON.parse(data);
                console.log(rs[0]);
                var col = rs[0];
                //-----THAY ĐỔI SỐ LƯỢNG CỘT THEO NGÀY---------------------------------------------------------
                var colM = $grid.pqGrid( "option", "colModel" );//lấy ra colModel của lưới
                var newColM = [];//cột cần thay đổi
                for(var i = 0; i < rs[0].length; i++){//chạy vòng lặp để push cột mới
                    newColM.push({
                        title: col[i]['AttendanceDate'],
                        dataIndx: col[i]['AttendanceDate'],
                        minWidth: 20,
                        width: 80,
                        dataType: "string",
                        editor: false,
                        align: "center",
                        sortable: false
                    });
                }
                colM[2].colModel = newColM//thay đổi cột số lượng
                $grid.pqGrid( {colModel:colM} ); //set lại cột
                //----------------------------------------------------------------------------------------------

                $grid.pqGrid("option", "dataModel.data", rs[1]);
                $grid.pqGrid("refreshDataAndView");
                $grid.pqGrid("hideLoading");
            }
        });
    }

    function loadGrid() {
        //console.log(valueGrid);
        $(document).ready(function () {
            var iW75F2130_Height = $(document).height() - 280;

            var obj1 = {
                width: '100%',
                height: iW75F2130_Height,
                showTitle: false,
                collapsible: false,
                selectionModel: {type: 'row', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                freezeCols: 2,
                hwrap: false,
                wrap: false,
                sortable: false,
                /*editModel: {
                    saveKey: $.ui.keyCode.ENTER,
                    select: true,
                    keyUpDown: false,
                    cellBorderWidth: 0,
                    clicksToEdit: 1
                },*/
                colModel: [
                    {
                        title: 'IsUpdate',
                        minWidth: 90,
                        align: "left",
                        dataIndx: "IsUpdate",
                        isExport: false,
                        editor: false,
                        hidden: true
                    },
                    {
                        title: '{{Helpers::getRS($g,"Tieu_chi_thong_ke")}}',
                        minWidth: 350,
                        width: 400,
                        align: "left",
                        dataIndx: "CriteriaName",
                        isExport: true,
                        editor: false,
                        render: function (ui) {
                            var rowData = ui.rowData;
                            if (Number(rowData["GroupID"]) == 0) {
                                return '<label><strong>' + rowData["CriteriaName"] + '</strong></label>';
                            } else {
                                return '<label>' + rowData["CriteriaName"] + '</label>';
                            }
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"So_luong")}}',
                        minWidth: 20,
                        sortable: false,
                        dataIndx: "DayQuan",
                        colModel: [
                            @for($i=1; $i<=$days; $i++)
                            {
                                minWidth: 20,
                                width: 80,
                                dataType: "string",
                                editor: false,
                                align: "center",
                                sortable: false,

                                @if($i < 10 && intval($tranMonth) < 10)
                                dataIndx: "0{{$i}}/{{$tranMonth}}/{{$tranYear}}",
                                title: "0{{$i}}/{{$tranMonth}}/{{$tranYear}}",
                                @endif

                                @if($i >= 10 && intval($tranMonth) < 10)
                                dataIndx: "{{$i}}/{{$tranMonth}}/{{$tranYear}}",
                                title: "{{$i}}/{{$tranMonth}}/{{$tranYear}}",
                                @endif

                                @if($i >= 10 && intval($tranMonth) >= 10)
                                dataIndx: "{{$i}}/{{$tranMonth}}/{{$tranYear}}",
                                title: "{{$i}}/{{$tranMonth}}/{{$tranYear}}",
                                @endif

                                @if($i < 10 && intval($tranMonth) >= 10)
                                dataIndx: "0{{$i}}/{{$tranMonth}}/{{$tranYear}}",
                                title: "0{{$i}}/{{$tranMonth}}/{{$tranYear}}",
                                @endif
                            },
                            @endfor
                        ]
                    }
                ],
                dataModel: {
                    data: valueGrid1,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    //console.log('complete grid');
                    $("#pqgrid_W75F3005").pqGrid("setSelection", {rowIndx: 0});
                    var rowData = getRowSelection($("#pqgrid_W75F3005"));
                    console.log(rowData);
                    if(rowData != null){
                        viewDetailGrid2("01/{{$tranMonth}}/{{$tranYear}}", rowData.GroupID, rowData.CriteriaID, rowData.FormID);
                    }


                },
                rowClick: function (event, ui) {
                    //alert(saveOrNot);
                    /*var rowData = getRowSelection($("#pqgrid_W75F3005"));
                    var data = $("#pqgrid_W75F3005_2").pqGrid("option", "dataModel.data");
                    var dataSender = $.grep(data, function (d) {
                        return Number(d.IsUpdate) == 1 && Number(d.Check) == 1;
                    });
                    console.log(dataSender);
                    if(dataSender.length > 0){
                        if(saveOrNot == true){
                            ask_save(function(){
                                save(function () {
                                    //alert("sdfdsfds");
                                    viewDetailGrid2(ui.rowData.GroupID, ui.rowData.CriteriaID, ui.rowData.FormID);
                                });
                                saveOrNot = true;
                            },'','',function () {
                                if(rowData != null){
                                    viewDetailGrid2(rowData.GroupID, rowData.CriteriaID, rowData.FormID);
                                }
                            });
                        }else{
                            saveOrNot = true;
                            viewDetailGrid2(ui.rowData.GroupID, ui.rowData.CriteriaID, ui.rowData.FormID);
                        }
                    }else{
                        viewDetailGrid2(ui.rowData.GroupID, ui.rowData.CriteriaID, ui.rowData.FormID);
                    }*/
                },
                cellClick: function (event, ui) {
                    //alert(saveOrNot);

                    console.log(ui.rowData);
                    var dataIndx = ui.dataIndx;
                    console.log(dataIndx);
                    if(dataIndx != "CriteriaName"){
                        var rowData = getRowSelection($("#pqgrid_W75F3005"));
                        var data = $("#pqgrid_W75F3005_2").pqGrid("option", "dataModel.data");
                        var dataSender = $.grep(data, function (d) {
                            return Number(d.IsUpdate) == 1 && Number(d.Check) == 1;
                        });
                        console.log(dataSender);
                        if(dataSender.length > 0){
                            if(saveOrNot == true){
                                ask_save(function(){
                                    save(function () {
                                        //alert("sdfdsfds");
                                        viewDetailGrid2(dataIndx, ui.rowData.GroupID, ui.rowData.CriteriaID, ui.rowData.FormID);
                                    });
                                    saveOrNot = true;
                                },'','',function () {
                                    if(rowData != null){
                                        viewDetailGrid2(dataIndx, rowData.GroupID, rowData.CriteriaID, rowData.FormID);
                                    }
                                });
                            }else{
                                saveOrNot = true;
                                viewDetailGrid2(dataIndx, ui.rowData.GroupID, ui.rowData.CriteriaID, ui.rowData.FormID);
                            }
                        }else{
                            viewDetailGrid2(dataIndx, ui.rowData.GroupID, ui.rowData.CriteriaID, ui.rowData.FormID);
                        }
                    }
                },
                cellSave: function (event, ui) {
                    /* console.log("cellSave");
                     ui.rowData.IsUpdate = 1;
                     var rowData = ui.rowData;
                     //format before saveing
                     console.log(ui);
                     if (ui.column.dynamicColumn == true){
                         rowData[ui.dataIndx] = format2(rowData[ui.dataIndx], '', ui.column.decimals);
                     }
                     //End format
                     $("#pqgrid_W75F3005").pqGrid("refreshDataAndView");*/
                }
            };
            //obj1.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W75F3005").pqGrid(obj1);
            $("#pqgrid_W75F3005").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F3005").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F3005").pqGrid("refreshDataAndView");
            }, 300)
        });
    }
    function viewDetailGrid2(datefrom, groupID, criteriaID, formID) {
        console.log(groupID, criteriaID, formID);
        if(criteriaID == "1"){
            groupID = "1";
        }
        if(criteriaID == "50"){
            groupID = "50";
        }
        if(criteriaID == "100"){
            groupID = "100";
        }
        $("#pqgrid_W75F3005_2").pqGrid("showLoading");
        //var datef = $('#txtDateW75F3005').data('daterangepicker').startDate.format('DD/MM/YYYY');
        var datef = datefrom;
        var datet = $('#txtDateToW75F3005').val();
        $.ajax({
            method: "POST",
            url: '{{url("/W75F3005/$pForm/$g/loadGrid2")}}',
            data: $("#frmW75F3005").serialize() + '&datefrom=' + datef + '&dateto=' + datet + "&groupID=" + groupID + "&criteriaID=" + criteriaID+ "&formID=" + formID,
            success: function (data) {
                console.log(data);
                $("#tb_pqgrid_W75F3005_2").html(data);
                //setter
                $("#pqgrid_W75F3005_2").pqGrid("refreshDataAndView");
                $("#pqgrid_W75F3005_2").pqGrid("hideLoading");
                //loadData();
            }
        });
    }

    function loadW75F3006() {
        $("#modalW75F3005").find(".l3loading").removeClass("hide");
        $.ajax({
            method: 'GET',
            url: '{{url("/W75F3006/D75F3006/$g/")}}',
            success: function (data) {
                $("#secW75F3006").html(data);
                $("#modalW75F3006").modal("show");
                $("#modalW75F3005").find(".l3loading").addClass("hide");
            }
        });
    }

    function save(funcCal) {
        var callBack = typeof funcCal !== 'undefined' ? funcCal : null;
        saveOrNot = false;
        var data = $("#pqgrid_W75F3005_2").pqGrid("option", "dataModel.data");
        var dataSender = $.grep(data, function (d) {
            return Number(d.IsUpdate) == 1 && Number(d.Check) == 1;
        });
        //console.log(dataSender);
        if (dataSender.length > 0) {
            $.ajax({
                method: "POST",
                url: '{{url("/W75F3005/$pForm/$g/save")}}',
                data: {
                    dataSender: dataSender
                },
                success: function (data) {
                    console.log(data);
                    if (data.status == 1) {
                        //filterGrid();
                        save_ok(function () {
                            if (callBack!=null)callBack.call(null,null);
                        });
                    } else {
                        save_not_ok(function () {
                        });
                    }
                }
            });
        } else {
            alert_warning("Chưa có cập nhật nào mới");
        }
    }
</script>