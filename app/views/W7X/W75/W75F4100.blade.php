<div class="modal fade modal" id="modalW75F4100" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW75F4100" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F4100",true)}}
                </div>
                <div class="modal-body">

                    <div class="row form-group">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group" style="margin-top: 6px">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="col-md-12 active " id="txtDate" type="text" name="txtDate"
                                               readonly="true" value="{{date('01/m/Y').' - '.date('t/m/Y')}}"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Khoi")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" style="margin-top: 5px"
                                            id="BlockID" name="BlockID"
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
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ma_nhan_vien")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control" style="margin-top: 3px"
                                            id="EmployeeID" name="EmployeeID"
                                            placeholder="">
                                        @foreach($employee as $row)
                                            <option value="{{$row['EmployeeID']}}">{{$row['EmployeeName']}}</option>
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
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ca")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" style="margin-top: 5px"
                                            id="ShiftID" name="ShiftID"
                                            placeholder="">
                                        @foreach($shiftList as $row)
                                            <option value="{{$row['ShiftID']}}">{{$row['ShiftName']}}</option>
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
                                <div class="col-md-9">
                                    {{Form::select("slDepartmentID", $department , isset($rData['DepartmentID']) ? $rData['DepartmentID'] : 0,["class" => "col-md-12 form-control liketext", "id" => "slDepartmentID"])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span
                                                class="digi digi-filter"></span>
                                        &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tabW754100_1" onclick="loadtab1();"
                                                          data-toggle="tab">{{Helpers::getRS($g,"Phep")}}</a></li>
                                    <li><a href="#tabW754100_2" data-toggle="tab"
                                           onclick="loadtab2();">{{Helpers::getRS($g,"Tang_ca")}}</a></li>
                                    <li><a href="#tabW754100_3"
                                           onclick="loadtab3();"
                                           data-toggle="tab">{{Helpers::getRS($g,"Di_tre_ve_som")}}</a>
                                    </li>
                                    @if($flag[0]['NumValue'] != 1)
                                        <li><a href="#tabW754100_4"
                                               onclick="loadtab4();"
                                               data-toggle="tab">{{Helpers::getRS($g,"Cong_")}}</a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabW754100_1">
                                        <div class="row form-group">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-md-3 liketext">
                                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Loai_phep")}}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select class="form-control" style="margin-top: 5px"
                                                                id="LeaveTypeID" name="LeaveTypeID"

                                                                placeholder="">
                                                            <option value="%"><--Tất cả--></option>
                                                            @foreach($leaveType as $row)
                                                                <option leaveName="{{$row['LeaveTypeName']}}"
                                                                        value="{{$row['LeaveTypeID']}}">{{$row['LeaveTypeName']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-md-3 liketext">
                                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"So_luong")}}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="radio col-md-6 pdt5">
                                                            <label>
                                                                <input name="rdLeaveNumber"
                                                                       id="rdLeaveNumberMax"
                                                                       value="0"
                                                                       type="radio">
                                                                <=
                                                                <input name="LeaveNumberMax"
                                                                       onfocus="onClickFilter(false)"
                                                                       id="LeaveNumberMax"
                                                                       type="number">
                                                            </label>
                                                        </div>
                                                        <div class="radio col-md-6 pdt5">
                                                            <label>
                                                                <input name="rdLeaveNumber"
                                                                       id="rdLeaveNumberMin"
                                                                       value="1"
                                                                       type="radio">
                                                                >=
                                                                <input name="LeaveNumberMin"
                                                                       onfocus="onClickFilter(true)"
                                                                       id="LeaveNumberMin"
                                                                       type="number">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tabW754100_1_1"
                                                                              data-toggle="tab">{{Helpers::getRS($g,"Chi_tiet")}}</a>
                                                        </li>
                                                        <li><a href="#tabW754100_1_2" data-toggle="tab"
                                                               onclick="loadtab1_TH();">{{Helpers::getRS($g,"Tong_hop")}}</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tabW754100_1_1">
                                                            <div id="pqgrid_W75F4100_tab1_1"></div>
                                                        </div>
                                                        <div class="tab-pane" id="tabW754100_1_2">
                                                            <div id="pqgrid_W75F4100_tab1_2"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane " id="tabW754100_2">
                                        <div class="row form-group">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-3 liketext">
                                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"So_gio_tang_ca")}}</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="radio col-md-6 pdt5">
                                                            <label>
                                                                <input name="IsOT"
                                                                       id="rdOTNumberMax"
                                                                       value="0"
                                                                       type="radio">
                                                                <=
                                                                <input name="OTNumberMax"
                                                                       id="OTNumberMax"
                                                                       onfocus="onClickFiterOT(false)"
                                                                       type="number">
                                                            </label>
                                                        </div>
                                                        <div class="radio col-md-6 pdt5">
                                                            <label>
                                                                <input name="IsOT"
                                                                       id="rdOTNumberMin"
                                                                       value="1"
                                                                       type="radio">
                                                                >=
                                                                <input name="OTNumberMin"
                                                                       id="OTNumberMin"
                                                                       onfocus="onClickFiterOT(true)"
                                                                       type="number">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12 col-xs-12">
                                                <div id="pqgrid_W75F4100_tab2"></div>
                                            </div>
                                        </div>
                                        <div id="tbGeneral"></div>
                                    </div>
                                    <div class="tab-pane " id="tabW754100_3">
                                        <div class="row form-group">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="radio col-md-6 pdt5">
                                                        <input onclick="checkIsAsked()" type="checkbox"
                                                               id="IsAskedLeave"
                                                               name="IsAskedLeave">{{Helpers::getRS($g,"Co_xin_phep")}}
                                                    </div>
                                                    <div class="radio col-md-6 pdt5">
                                                        <input onclick="checkIsNotAsked()" type="checkbox"
                                                               id="IsNotAskedLeave"
                                                               name="IsNotAskedLeave"> {{Helpers::getRS($g,"Khong_xin_phep")}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-md-3 liketext">
                                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"so_phut_di_tre_ve_som")}}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="radio col-md-6 pdt5">
                                                            <label>
                                                                <input name="IsTimes"
                                                                       id="rdTimesMax"
                                                                       value="0"
                                                                       type="radio">
                                                                <=
                                                                <input name="TimesMax"
                                                                       onfocus="onClickFilterTab3(false)"
                                                                       id="TimesMax"
                                                                       type="number">
                                                            </label>
                                                        </div>
                                                        <div class="radio col-md-6 pdt5">
                                                            <label>
                                                                <input name="IsTimes"
                                                                       id="rdTimesMin"
                                                                       value="1"
                                                                       type="radio">
                                                                >=
                                                                <input name="TimesMin"
                                                                       onfocus="onClickFilterTab3(true)"
                                                                       id="TimesMin"
                                                                       type="number">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-12 col-xs-12">
                                                <div id="pqgrid_W75F4100_tab3"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane " id="tabW754100_4">
                                        <div class="row form-group">
                                            <div class="col-md-3 col-xs-3">
                                                <div id="pqgrid_W75F4100_tab4_1"></div>
                                            </div>
                                            <div class="col-md-9 col-xs-9">
                                                <div id="pqgrid_W75F4100_tab4_2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<section id="secDetailE09F0000"></section>
<script type="text/javascript">
    dataTab1_1 = [];
    dataTab1_2 = [];
    dataTab2 = [];
    dataTab3 = [];
    dataTab4_1 = [];
    dataTab4_2 = [];
    dataTab3Normal = [];
    leaveTypeValue = {{json_encode($leaveType)}};
    valueGridtab1_1 = [];
    recorTab2 = true; //nhan biet khi click tab2
    recorTab3 = true; //nhan biet khi click tab3
    recorTab4 = true; //nhan biet khi click tab4
    var tranMonth = {{$tranMonth}};
    var tranYear = {{$tranYear}};
    rDataRow = {};
    isGroupChange = true;
    loadtab1_detail();
    loadtab1_TH();
    $(document).ready(function () {
        $('#txtDate').daterangepicker({format: 'DD/MM/YYYY'});
        $('#BlockID').val("%");
        $('#ShiftID').val("%");
        $('#EmployeeID').val("%");
        ////console.log(dataTab2);
        var dayFrom = "01";
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
        }
        var dateFrom = dayFrom + "/" + tranMonth + "/" + tranYear;
        var dateTo = dayTo + "/" + tranMonth + "/" + tranYear;
        $('#txtDate').data('daterangepicker').setStartDate(dateFrom);
        $('#txtDate').data('daterangepicker').setEndDate(dateTo);
    });

    function kiem_tra_nam_nhuan(nam) {
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
    }

    //chon radio button khi click input
    function onClickFilterTab3(isMin) {
        //alert("da chay");
        if (isMin) {
            $('#rdTimesMin').click();
            $('#TimesMax').val("");
        } else {
            $('#rdTimesMax').click();
            $('#TimesMin').val("");
        }
    }

    function onClickFilter(isMin) {
        if (isMin) {
            $('#rdLeaveNumberMin').click();
            $('#LeaveNumberMax').val("");
        } else {
            $('#rdLeaveNumberMax').click();
            $('#LeaveNumberMin').val("");
        }
    }

    function onClickFiterOT(isMin) {
        if (isMin) {
            $('#rdOTNumberMin').click();
            $('#OTNumberMax').val("");
        } else {
            $('#rdOTNumberMax').click();
            $('#OTNumberMin').val("");
        }
    }

    //loc theo dieu kien tab 2
    $("#OTNumberMax").keyup(function () {
        //alert($("input[name='IsAsk']:checked").val());
        $("#pqgrid_W75F4100_tab2").pqGrid("showLoading");
        var data = dataTab2;
        var dataSender = $.grep(data, function (d) {
            return Number(d.sum) <= Number($('#OTNumberMax').val());
        });
        $("#pqgrid_W75F4100_tab2").pqGrid("option", "dataModel.data", dataSender);
        $("#pqgrid_W75F4100_tab2").pqGrid("refreshDataAndView");
        $("#pqgrid_W75F4100_tab2").pqGrid("hideLoading");
    });
    //loc theo dieu kien tab 2
    $("#OTNumberMin").keyup(function () {
        //alert($("input[name='IsAsk']:checked").val());
        $("#pqgrid_W75F4100_tab2").pqGrid("showLoading");
        var data = dataTab2;
        var dataSender = $.grep(data, function (d) {
            return Number(d.sum) >= Number($('#OTNumberMin').val());
        });
        console.log(dataSender);
        $("#pqgrid_W75F4100_tab2").pqGrid("option", "dataModel.data", dataSender);
        $("#pqgrid_W75F4100_tab2").pqGrid("refreshDataAndView");
        $("#pqgrid_W75F4100_tab2").pqGrid("hideLoading");
    });
    //loc theo dieu kien tab 3
    $("#TimesMax").keyup(function () {
        //alert($("input[name='IsAsk']:checked").val());
        $("#pqgrid_W75F4100_tab3").pqGrid("showLoading");
        var dataSender = [];
        var data = dataTab3Normal;
        var dataTemp = [];
        if ($("#IsAskedLeave").prop('checked') == true && $("#IsNotAskedLeave").prop('checked') == true) {//chon tat ca
            //alert("hello");
            dataSender = $.grep(data, function (d) {
                return Number(d.sumAll) <= Number($('#TimesMax').val());
            });
        }
        if ($("#IsAskedLeave").prop('checked') == false && $("#IsNotAskedLeave").prop('checked') == false) {//chon nv binh thuong
            dataSender = $.grep(dataTab3, function (d) {
                return Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) == 0 && Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) == 0;
            });
        }
        if ($("#IsAskedLeave").prop('checked') == true && $("#IsNotAskedLeave").prop('checked') == false) {//chon xin phep
            dataTemp = $.grep(data, function (d) {
                return (Number(d.IsAskedLeaveLM) == 1 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 1 && Number(d.EarlyAmount) != 0);
            });
            dataSender = $.grep(dataTemp, function (d) {
                return Number(d.sum) <= Number($('#TimesMax').val());
            });
        }
        if ($("#IsAskedLeave").prop('checked') == false && $("#IsNotAskedLeave").prop('checked') == true) {//chon ko xin phep
            dataTemp = $.grep(data, function (d) {
                return (Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) != 0);
            });
            dataSender = $.grep(dataTemp, function (d) {
                return Number(d.sum) <= Number($('#TimesMax').val());
            });
        }
        //console.log(dataSender);
        $("#pqgrid_W75F4100_tab3").pqGrid("option", "dataModel.data", dataSender);
        $("#pqgrid_W75F4100_tab3").pqGrid("refreshDataAndView");
        $("#pqgrid_W75F4100_tab3").pqGrid("hideLoading");
    });
    //loc theo dieu kien tab 3
    $("#TimesMin").keyup(function () {
        //alert($("input[name='IsAsk']:checked").val());
        $("#pqgrid_W75F4100_tab3").pqGrid("showLoading");
        var dataSender = [];
        var data = dataTab3Normal;
        var dataTemp = [];
        if ($("#IsAskedLeave").prop('checked') == true && $("#IsNotAskedLeave").prop('checked') == true) {
            dataSender = $.grep(data, function (d) {
                return Number(d.sumAll) >= Number($('#TimesMin').val());
            });
        }
        if ($("#IsAskedLeave").prop('checked') == false && $("#IsNotAskedLeave").prop('checked') == false) {
            dataSender = $.grep(dataTab3, function (d) {
                return Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) == 0 && Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) == 0;
            });
        }
        if ($("#IsAskedLeave").prop('checked') == true && $("#IsNotAskedLeave").prop('checked') == false) {
            dataTemp = $.grep(data, function (d) {
                return (Number(d.IsAskedLeaveLM) == 1 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 1 && Number(d.EarlyAmount) != 0);
            });
            dataSender = $.grep(dataTemp, function (d) {
                return Number(d.sum) >= Number($('#TimesMin').val());
            });
        }
        if ($("#IsAskedLeave").prop('checked') == false && $("#IsNotAskedLeave").prop('checked') == true) {
            dataTemp = $.grep(data, function (d) {
                return (Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) != 0);
            });
            dataSender = $.grep(dataTemp, function (d) {
                return Number(d.sum) >= Number($('#TimesMin').val());
            });
        }
        console.log(dataSender);
        $("#pqgrid_W75F4100_tab3").pqGrid("option", "dataModel.data", dataSender);
        $("#pqgrid_W75F4100_tab3").pqGrid("refreshDataAndView");
        $("#pqgrid_W75F4100_tab3").pqGrid("hideLoading");
    });

    //loc theo dieu kien tab 3
    function checkIsAsked() {
        ////console.log($("#IsAskedLeave").prop('checked'), $("#IsNotAskedLeave").prop('checked'));
        $("#pqgrid_W75F4100_tab3").pqGrid("showLoading");
        var data = dataTab3Normal;
        var dataSender = [];
        var dataTemp = [];
        if ($("#IsAskedLeave").prop('checked') == false && $("#IsNotAskedLeave").prop('checked') == true) {//chon ko xin phep
            if ($('#TimesMin').val() == "" && $('#TimesMax').val() == "") {
                //alert("da chay");
                dataSender = $.grep(data, function (d) {
                    return (Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) != 0);
                });
            } else {
                if ($('#TimesMax').val() != "") {
                    dataTemp = $.grep(data, function (d) {
                        return (Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) != 0);
                    });
                    dataSender = $.grep(dataTemp, function (d) {
                        return Number(d.sum) <= Number($('#TimesMax').val());
                    });
                }
                if ($('#TimesMin').val() != "") {
                    dataTemp = $.grep(data, function (d) {
                        return (Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) != 0);
                    });
                    dataSender = $.grep(dataTemp, function (d) {
                        return Number(d.sum) >= Number($('#TimesMin').val());
                    });
                }
            }
        }
        if ($("#IsAskedLeave").prop('checked') == true && $("#IsNotAskedLeave").prop('checked') == false) {// chon co xin phep
            if ($('#TimesMin').val() == "" && $('#TimesMax').val() == "") {
                //alert("da chay");
                dataSender = $.grep(data, function (d) {
                    return (Number(d.IsAskedLeaveLM) == 1 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 1 && Number(d.EarlyAmount) != 0);
                });
            } else {
                if ($('#TimesMax').val() != "") {
                    dataTemp = $.grep(data, function (d) {
                        return (Number(d.IsAskedLeaveLM) == 1 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 1 && Number(d.EarlyAmount) != 0);
                    });
                    dataSender = $.grep(dataTemp, function (d) {
                        return Number(d.sum) <= Number($('#TimesMax').val());
                    });
                }
                if ($('#TimesMin').val() != "") {
                    dataTemp = $.grep(data, function (d) {
                        return (Number(d.IsAskedLeaveLM) == 1 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 1 && Number(d.EarlyAmount) != 0);
                    });
                    dataSender = $.grep(dataTemp, function (d) {
                        return Number(d.sum) >= Number($('#TimesMin').val());
                    });
                }
            }
        }
        if ($("#IsAskedLeave").prop('checked') == false && $("#IsNotAskedLeave").prop('checked') == false) {// chon nv bthuong
            dataSender = $.grep(dataTab3, function (d) {
                return Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) == 0 && Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) == 0;
            });
        }
        if ($("#IsAskedLeave").prop('checked') == true && $("#IsNotAskedLeave").prop('checked') == true) {//
            if ($('#TimesMin').val() == "" && $('#TimesMax').val() == "") {
                dataSender = dataTab3Normal;
            } else {
                if ($('#TimesMax').val() != "") {
                    dataSender = $.grep(data, function (d) {
                        return Number(d.sumAll) <= Number($('#TimesMax').val());
                    });
                }
                if ($('#TimesMin').val() != "") {
                    dataSender = $.grep(data, function (d) {
                        return Number(d.sumAll) >= Number($('#TimesMin').val());
                    });
                }
            }
        }
        $("#pqgrid_W75F4100_tab3").pqGrid("option", "dataModel.data", dataSender);
        $("#pqgrid_W75F4100_tab3").pqGrid("refreshDataAndView");
        $("#pqgrid_W75F4100_tab3").pqGrid("hideLoading");
    }

    //loc theo dieu kien tab 3
    function checkIsNotAsked() {
        //alert($("#IsAskedLeave").prop('checked'));
        $("#pqgrid_W75F4100_tab3").pqGrid("showLoading");
        var data = dataTab3Normal;
        var dataSender = [];
        var dataTemp = [];
        if ($("#IsNotAskedLeave").prop('checked') == true && $("#IsAskedLeave").prop('checked') == false) {
            if ($('#TimesMin').val() == "" && $('#TimesMax').val() == "") {
                //alert("da chay");
                dataSender = $.grep(data, function (d) {
                    return (Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) != 0);
                });
            } else {
                if ($('#TimesMax').val() != "") {
                    dataTemp = $.grep(data, function (d) {
                        return (Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) != 0);
                    });
                    dataSender = $.grep(dataTemp, function (d) {
                        return Number(d.sum) <= Number($('#TimesMax').val());
                    });
                }
                if ($('#TimesMin').val() != "") {
                    dataTemp = $.grep(data, function (d) {
                        return (Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) != 0);
                    });
                    dataSender = $.grep(dataTemp, function (d) {
                        return Number(d.sum) >= Number($('#TimesMin').val());
                    });
                }
            }
        }
        if ($("#IsNotAskedLeave").prop('checked') == false && $("#IsAskedLeave").prop('checked') == true) {
            if ($('#TimesMin').val() == "" && $('#TimesMax').val() == "") {
                //alert("da chay");
                dataSender = $.grep(data, function (d) {
                    return (Number(d.IsAskedLeaveLM) == 1 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 1 && Number(d.EarlyAmount) != 0);
                });
            } else {
                if ($('#TimesMax').val() != "") {
                    dataTemp = $.grep(data, function (d) {
                        return (Number(d.IsAskedLeaveLM) == 1 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 1 && Number(d.EarlyAmount) != 0);
                    });
                    dataSender = $.grep(dataTemp, function (d) {
                        return Number(d.sum) <= Number($('#TimesMax').val());
                    });
                }
                if ($('#TimesMin').val() != "") {
                    dataTemp = $.grep(data, function (d) {
                        return (Number(d.IsAskedLeaveLM) == 1 && Number(d.LateAmount) != 0) || (Number(d.IsAskedLeaveEM) == 1 && Number(d.EarlyAmount) != 0);
                    });
                    dataSender = $.grep(dataTemp, function (d) {
                        return Number(d.sum) >= Number($('#TimesMin').val());
                    });
                }
            }
        }
        if ($("#IsAskedLeave").prop('checked') == false && $("#IsNotAskedLeave").prop('checked') == false) {
            dataSender = $.grep(dataTab3, function (d) {
                return Number(d.IsAskedLeaveLM) == 0 && Number(d.LateAmount) == 0 && Number(d.IsAskedLeaveEM) == 0 && Number(d.EarlyAmount) == 0;
            });
        }
        if ($("#IsAskedLeave").prop('checked') == true && $("#IsNotAskedLeave").prop('checked') == true) {
            if ($('#TimesMin').val() == "" && $('#TimesMax').val() == "") {
                dataSender = dataTab3Normal;
            } else {
                if ($('#TimesMax').val() != "") {
                    dataSender = $.grep(data, function (d) {
                        return Number(d.sum) <= Number($('#TimesMax').val());
                    });
                }
                if ($('#TimesMin').val() != "") {
                    dataSender = $.grep(data, function (d) {
                        return Number(d.sum) >= Number($('#TimesMin').val());
                    });
                }
            }
        }
        $("#pqgrid_W75F4100_tab3").pqGrid("option", "dataModel.data", dataSender);
        $("#pqgrid_W75F4100_tab3").pqGrid("refreshDataAndView");
        $("#pqgrid_W75F4100_tab3").pqGrid("hideLoading");
    }

    $("#frmW75F4100").on('submit', function (e) {
        e.preventDefault();
        ////console.log("da chay fillter");
        filterGrid();
    });
    //loc lai combo nhan vien sau khi chon combo phong ban
    $("#frmW75F4100").find("#slDepartmentID").change(function () {
        ////console.log("da chay slDepartmentID");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F4100/$pForm/$g/change")}}',
            data: {
                departmentID: $("#slDepartmentID").val(),
                blockID: $("#BlockID").val()
            },
            success: function (data) {
                ////console.log(data);
                $("#EmployeeID").html(data);
                $('#EmployeeID').val("%");
            }
        });
    });
    //loc lai combo nhan vien sau khi chon combo khoi
    $("#frmW75F4100").find("#BlockID").change(function () {
        ////console.log("da chay slDepartmentID");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F4100/$pForm/$g/change")}}',
            data: {
                departmentID: $("#slDepartmentID").val(),
                blockID: $("#BlockID").val()
            },
            success: function (data) {
                ////console.log(data);
                $("#EmployeeID").html(data);
                $('#EmployeeID').val("%");
            }
        });
    });

    //loc luoi tab1 sau khi chon loai phep
    $("#frmW75F4100").find("#LeaveTypeID").change(function () {
        filterChange($("#pqgrid_W75F4100_tab1_1"));

    });


    function filterChange($grid) {
        $grid.pqGrid("showLoading");
        var dataSender = [];
        var data = valueGridtab1_1;
        var leaveTypeID = $('#LeaveTypeID').val();
        var leaveTypeName = $('#LeaveTypeID option:selected').attr('leavename');
        console.log(Number($('#LeaveNumberMax').val()));
        if ($('#LeaveTypeID').val() == '%' && Number($('#LeaveNumberMax').val()) == 0 && Number($('#LeaveNumberMin').val()) == 0) {
            dataSender = valueGridtab1_1;
        }

        //Chọn Max
        if ($('#LeaveTypeID').val() == '%' && $('#LeaveNumberMax').val() != "" && Number($('#LeaveNumberMin').val()) == 0) {

            dataSender = $.grep(data, function (d) {
                return Number(d.sumPercent) <= Number($('#LeaveNumberMax').val());
            });
        }

        if ($('#LeaveTypeID').val() == '%' && Number($('#LeaveNumberMax').val()) == 0 && $('#LeaveNumberMin').val() != "") {
            dataSender = $.grep(data, function (d) {
                return Number(d.sumPercent) >= Number($('#LeaveNumberMin').val());
            });
        }

        if ($('#LeaveTypeID').val() != '%' && Number($('#LeaveNumberMax').val()) == 0 && Number($('#LeaveNumberMin').val()) == 0) {

            dataSender = $.grep(data, function (d) {
                return d.LeaveTypeName == leaveTypeName;
            });
        }

        if ($('#LeaveTypeID').val() != '%' && $('#LeaveNumberMax').val() != "" && Number($('#LeaveNumberMin').val()) == 0) {
            dataSender = $.grep(data, function (d) {
                return (Number(d.sum) <= Number($('#LeaveNumberMax').val())) && d.LeaveTypeName == leaveTypeName;
            });
        }

        if ($('#LeaveTypeID').val() != '%' && Number($('#LeaveNumberMax').val()) == 0 && $('#LeaveNumberMin').val() != "") {
            dataSender = $.grep(data, function (d) {
                return (Number(d.sum) >= Number($('#LeaveNumberMin').val())) && d.LeaveTypeName == leaveTypeName;
            });
        }
        $grid.pqGrid("option", "dataModel.data", dataSender);
        $grid.pqGrid("refreshDataAndView");
        $grid.pqGrid("hideLoading");
    }

    //loc lai luoi theo dieu kien tab1
    $("#LeaveNumberMax").keyup(function () {
        filterChange($("#pqgrid_W75F4100_tab1_1"));
    });
    //loc lai luoi theo dieu kien tab1
    $("#LeaveNumberMin").keyup(function () {
        filterChange($("#pqgrid_W75F4100_tab1_1"));
    });

    function uniqBy(a, key, func, leaveType) {
        //console.log(leaveType);
        var employeeIDList = [];
        var leaveTypeIDList = [];
        for (var i = 0; i < a.length; i++) {
            var obj = a[i];
            var employeeID = obj[key];

            if (employeeIDList.indexOf(employeeID) == -1) {
                employeeIDList.push(obj[key]);

            }
            if (leaveType != "") {
                var leaveTypeName = obj[leaveType];
                if (leaveTypeIDList.indexOf(leaveTypeName) == -1) {
                    leaveTypeIDList.push(leaveTypeName);
                }
            }
        }

        for (var h = 0; h < employeeIDList.length; h++) {
            var em = employeeIDList[h];
            var str = ""
            if (leaveType != "") {
                for (var g = 0; g < leaveTypeIDList.length; g++) {
                    var valPercent = func.call(null, a, em, key, leaveTypeIDList[g], true);
                    var val = func.call(null, a, em, key, leaveTypeIDList[g], false);
                    for (var j = 0; j < a.length; j++) {
                        if (a[j][key] == em && a[j][leaveType] == leaveTypeIDList[g]) {
                            a[j]["sum"] = val;
                            a[j]["sumPercent"] = valPercent;
                        }
                    }
                }
            } else {
                var val = func.call(null, a, em, key);
                for (var j = 0; j < a.length; j++) {
                    if (a[j][key] == em) {
                        a[j]["sum"] = val;
                    }
                }
            }
        }

        return a;
    }

    function uniqBy1(a, key, func, isAsk) {
        console.log(isAsk);
        var employeeIDList = [];
        var isAskList = [];
        for (var i = 0; i < a.length; i++) {
            var obj = a[i];
            var employeeID = obj[key];
            var isAskID = obj[isAsk];
            if (employeeIDList.indexOf(employeeID) == -1) {
                employeeIDList.push(employeeID);
            }
            if (isAskList.indexOf(isAskID) == -1) {
                isAskList.push(isAskID);
            }
        }
        console.log(isAskList);
        //console.log(isAskLMList);
        for (var h = 0; h < employeeIDList.length; h++) {
            var em = employeeIDList[h];
            for (var g = 0; g < isAskList.length; g++) {
                var valPercent = func.call(null, a, em, key, isAskList[g], true);
                var val = func.call(null, a, em, key, isAskList[g], false);
                for (var j = 0; j < a.length; j++) {
                    if (a[j][key] == em && a[j][isAsk] == isAskList[g]) {
                        a[j]["sum"] = val;
                        a[j]["sumAll"] = valPercent;
                    }
                }
            }
        }
        return a;
    }

    function sum(a, id, key, leaveType, isAll) {
        var listTemp = $.grep(a, function (data, index) {
            if (isAll) {
                return data[key] == id;
            } else {
                return data[key] == id && data["LeaveTypeName"] == leaveType;
            }

        });
        var sum = 0;
        for (var i = 0; i < listTemp.length; i++) {
            sum += Number(listTemp[i]["Quantity"]);
        }
        return sum;
    }

    function sum2(a, id, key) {
        var listTemp = $.grep(a, function (data, index) {
            return data[key] == id;
        });
        var sum = 0;
        for (var i = 0; i < listTemp.length; i++) {
            sum += Number(listTemp[i]["PreOTHours"]) + Number(listTemp[i]["AfterOTHours"]);
        }
        return sum;
    }

    function sum3(a, id, key, isAsk, isAll) {
        var listTemp = $.grep(a, function (data, index) {
            if (isAll) {
                return data[key] == id;
            } else {
                return data[key] == id && data["IsAsk"] == isAsk;
            }
        });
        var sum = 0;
        for (var i = 0; i < listTemp.length; i++) {
            sum += Number(listTemp[i]["EarlyAmount"]) + Number(listTemp[i]["LateAmount"]);
        }
        return sum;
    }

    function filterGrid() {
        //bo check khi click filter
        $("input[name='rdLeaveNumber']").removeAttr("checked");
        $("input[name='IsOT']").removeAttr("checked");
        $("input[name='IsAsk']").removeAttr("checked");
        $("input[name='IsTimes']").removeAttr("checked");
        $('#IsNotAskedLeave').prop('checked', true);
        $('#IsAskedLeave').prop('checked', true);
        //set trắng lại các giá trị
        $('#LeaveNumberMax').val("");
        $('#LeaveNumberMin').val("");
        $('#TimesMin').val("");
        $('#TimesMax').val("");
        $('#OTNumberMax').val("");
        $('#OTNumberMin').val("");

        $("#pqgrid_W75F4100_tab1_1").pqGrid("showLoading");
        $("#pqgrid_W75F4100_tab1_2").pqGrid("showLoading");
        if (recorTab2 == false) { //khi chon tab2 moi showloading
            $("#pqgrid_W75F4100_tab2").pqGrid("showLoading");
        }
        if (recorTab3 == false) { //khi chon tab3 moi showloading
            $("#pqgrid_W75F4100_tab3").pqGrid("showLoading");
        }
        if (recorTab4 == false) { //khi chon tab3 moi showloading
            $("#pqgrid_W75F4100_tab4_1").pqGrid("showLoading");
        }
        ////console.log( $('#EmployeeID').val());
        var datef = $('#txtDate').data('daterangepicker').startDate.format('DD/MM/YYYY');
        var datet = $('#txtDate').data('daterangepicker').endDate.format('DD/MM/YYYY');
        $.ajax({
            method: "POST",
            url: '{{url("/W75F4100/$pForm/$g/filter")}}',
            data: $("#frmW75F4100").serialize() + '&datefrom=' + datef + '&dateto=' + datet + '&EmployeeID=' + $('#EmployeeID').val(),
            success: function (data) {
                ////console.log(data.gridTab3);
                valueGridtab1_1 = data.gridTab1_CT;
                // var id = data.gridTab1_CT[0].EmployeeID;
                //var bigData = [];

                //var leaveName = $('#LeaveTypeID option:selected').attr('leavename');
                valueGridtab1_1 = uniqBy(valueGridtab1_1, "EmployeeID", sum, "LeaveTypeName");
                //console.log(valueGridtab1_1);

                $("#pqgrid_W75F4100_tab1_1").pqGrid("option", "dataModel.data", data.gridTab1_CT);
                $("#pqgrid_W75F4100_tab1_1").pqGrid("refreshDataAndView");
                $("#pqgrid_W75F4100_tab1_1").pqGrid("hideLoading");


                /* var column = $("#pqgrid_W75F4100_tab1_1").pqGrid("getColumn", {dataIndx: "LeaveTypeName"});
                 var filter = column.filter;
                 filter.cache = null;
                 filter.options = $("#pqgrid_W75F4100_tab1_1").pqGrid("getData", {dataIndx: ["LeaveTypeName"]});
                 $("#pqgrid_W75F4100_tab1_1").pqGrid("refreshDataAndView");*/


                dataTab1_2 = data.gridTab1_TH;
                $("#pqgrid_W75F4100_tab1_2").pqGrid("option", "dataModel.data", data.gridTab1_TH);
                $("#pqgrid_W75F4100_tab1_2").pqGrid("refreshDataAndView");
                $("#pqgrid_W75F4100_tab1_2").pqGrid("hideLoading");

                dataTab2 = data.gridTab2;
                dataTab2 = uniqBy(dataTab2, "EmployeeID", sum2, "");
                //console.log(dataTab2);
                if (recorTab2 == false) {
                    $("#pqgrid_W75F4100_tab2").pqGrid("option", "dataModel.data", data.gridTab2);
                    $("#pqgrid_W75F4100_tab2").pqGrid("refreshDataAndView");
                    $("#pqgrid_W75F4100_tab2").pqGrid("hideLoading");
                }
                dataTab3 = data.gridTab3;
                dataTab3Normal = $.grep(data.gridTab3, function (d) {
                    return Number(d.LateAmount) != 0 || Number(d.EarlyAmount) != 0;
                });
                for (var i = 0; i < dataTab3Normal.length; i++) {
                    if ((Number(dataTab3Normal[i].EarlyAmount) != 0 && (Number(dataTab3Normal[i].IsAskedLeaveEM) == 1))
                        || (Number(dataTab3Normal[i].LateAmount) != 0 && (Number(dataTab3Normal[i].IsAskedLeaveLM) == 1))) {
                        dataTab3Normal[i]["IsAsk"] = 1;
                    }
                    else if ((Number(dataTab3Normal[i].EarlyAmount) != 0 && (Number(dataTab3Normal[i].IsAskedLeaveEM) == 0))
                        || (Number(dataTab3Normal[i].LateAmount) != 0 && (Number(dataTab3Normal[i].IsAskedLeaveLM) == 0))) {
                        dataTab3Normal[i]["IsAsk"] = 0;
                    } else {
                        dataTab3Normal[i]["IsAsk"] = 2;
                    }
                }
                dataTab3Normal = uniqBy1(dataTab3Normal, "EmployeeID", sum3, "IsAsk");
                console.log(dataTab3Normal);
                if (recorTab3 == false) {
                    $("#pqgrid_W75F4100_tab3").pqGrid("option", "dataModel.data", dataTab3Normal);
                    $("#pqgrid_W75F4100_tab3").pqGrid("refreshDataAndView");
                    $("#pqgrid_W75F4100_tab3").pqGrid("hideLoading");
                }
                dataTab4_1 = data.gridTab4_1;
                if (recorTab4 == false) {
                    $("#pqgrid_W75F4100_tab4_1").pqGrid("option", "dataModel.data", dataTab4_1);
                    $("#pqgrid_W75F4100_tab4_1").pqGrid("refreshDataAndView");
                    $("#pqgrid_W75F4100_tab4_1").pqGrid("hideLoading");
                }
            }
        });
    }

    function loadtab1() {
        recorTab2 = true;
        recorTab3 = true;
        recorTab4 = true;
        $("input[name='rdLeaveNumber']").removeAttr("checked");//bo check khi chon lai tab1
        $('#LeaveNumberMax').val("");
        $('#LeaveNumberMin').val("");
    }

    function loadtab1_detail() {
        $(document).ready(function () {
            var tab1_W75F4100_1_Height = $(document).height() - 365;

            /* var agg = pq.aggregate;
             agg.getString = function(arr, col){
                 return agg.returnString(arr, col);
             }*/

            var obj1 = {
                width: '100%',
                height: tab1_W75F4100_1_Height,
                showTitle: false,
                collapsible: false,
                editable: false,
                selectionModel: {type: 'cell', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                //freezeCols: 2,
                hwrap: false,
                wrap: false,
                sortable: false,
                filterModel: {on: true, mode: "AND", header: true},
                groupModel: {
                    on: true,
                    //dataIndx: ['EmployeeID','EmployeeName'],
                    collapsed: [true],
                    merge: true,
                    showSummary: [true, false],
                    title: [
                        "{0}"
                    ],
                    summaryInTitleRowType: ""
                },
                summaryTitle: {
                    sum: "<b>{0}</b>"
                },
                toolbar: {
                    items: [
                        {
                            type: 'button',
                            label: "Export",
                            icon: 'ui-icon-arrowthickstop-1-s',
                            listener: function () {
                                var format = 'xls',
                                    blob = this.exportData({
                                        //url: "/pro/demos/exportData",
                                        format: format,
                                        render: false
                                    });

                                if (typeof blob === "string") {
                                    blob = new Blob([blob]);
                                }
                                saveAs(blob, "Chi_tiet_phep." + format);
                                //exportExcel();
                            }
                        }]
                },
                colModel: [
                    {
                        title: '{{Helpers::getRS($g,"Ma_NV")}}',
                        minWidth: 120,
                        align: "left",
                        dataIndx: "EmployeeID",
                        isExport: true,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        /* groupChange: function (val) {
                             console.log("g change");
                             isGroupChange = !isGroupChange;
                             //$('#EmployeeName').prop("hidden", true);
                         },
                         group: function( event, ui ) {
                             console.log("group change");
                         }*/


                    },
                    {
                        title: '{{Helpers::getRS($g,"Ho_va_ten")}}',
                        minWidth: 180,
                        dataType: "string",
                        dataIndx: "EmployeeName",
                        groupable: false,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        /*summary: {
                            type: "getString"
                        },*/
                        nodrag: true,
                        render: function (ui) {
                            var agg = pq.aggregate;
                            $grid = $("#pqgrid_W75F4100_tab1_1");
                            var option = $grid.pqGrid("option", "groupModel");
                            console.log(option);
                            rDataRow = ui.rowData;
                            var rowData = rDataRow;
                            if (ui.cellData != undefined) {
                                return '<a id = "EmployeeName" class="text-blue" title="{{Helpers::getRS($g,"Ho_va_ten")}}" onclick="showW09F4444(\'' + rowData["EmployeeID"] + '\')">' + rowData["EmployeeName"] + '</a>';
                            }
                        },
                        /*groupChange: function (val) {
                            console.log("g change");
                            return val;
                        }*/

                    },
                    {
                        title: '{{Helpers::getRS($g,"Phong_ban")}}',
                        minWidth: 200,
                        dataType: "string",
                        editor: false,
                        dataIndx: "DepartmentName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Chuc_vu")}}',
                        minWidth: 180,
                        dataType: "string",
                        editor: false,
                        dataIndx: "DutyName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_phep")}}',
                        minWidth: 120,
                        align: "center",
                        editor: false,
                        dataIndx: "LeaveDate",
                        dataType: "date",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Loai_phep")}}',
                        minWidth: 200,
                        editor: false,
                        dataIndx: "LeaveTypeName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}

                    },
                    {
                        title: '{{Helpers::getRS($g,"So_luong")}}',
                        minWidth: 80,
                        align: "right",
                        editor: false,
                        dataIndx: "Quantity",
                        dataType: "float",
                        filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                        format: "{{Helpers::getStringFormat($decimals)}}",
                        summary: {
                            type: "sum"
                        }
                    }
                ],
                dataModel: {
                    data: dataTab1_1,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    // //console.log('complete grid');

                },
                rowClick: function (event, ui) {

                },
                filter: function (event, ui) {
                    console.log(ui)
                }

            };
            obj1.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            var $grid = $("#pqgrid_W75F4100_tab1_1").pqGrid(obj1);
            $("#pqgrid_W75F4100_tab1_1").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F4100_tab1_1").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F4100_tab1_1").pqGrid("refreshDataAndView");
            }, 700)


            /*$grid.on("pqgridrefresh", function (event, ui) {
                var column = $grid.pqGrid("getColumn", {dataIndx: "LeaveTypeName"});
                var filter = column.filter;
                filter.cache = null;
                filter.options = $grid.pqGrid("getData", {dataIndx: ["LeaveTypeName"]});
                //=======================================================
            });
            var column = $grid.pqGrid("getColumn", {dataIndx: "LeaveTypeName"});
            var filter = column.filter;
            filter.cache = null;
            filter.options = $grid.pqGrid("getData", {dataIndx: ["LeaveTypeName"]});*/
        });
    }

    function loadtab1_TH() {
        // $(".l3loading").removeClass('hide');
        $(document).ready(function () {
            var tab1_W75F4100_2_Height = $(document).height() - 365;

            var obj2 = {
                width: '100%',
                height: tab1_W75F4100_2_Height,
                showTitle: false,
                collapsible: false,
                editable: false,
                //dataType: "JSON",
                selectionModel: {type: 'cell', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                freezeCols: 3,
                hwrap: false,
                wrap: false,
                sortable: false,
                filterModel: {on: true, mode: "AND", header: true},
                toolbar: {
                    items: [
                        {
                            type: 'button',
                            label: "Export",
                            icon: 'ui-icon-arrowthickstop-1-s',
                            listener: function () {
                                var format = 'xls',
                                    blob = this.exportData({
                                        //url: "/pro/demos/exportData",
                                        format: format,
                                        render: false
                                    });

                                if (typeof blob === "string") {
                                    blob = new Blob([blob]);
                                }
                                saveAs(blob, "Chi_tiet_phep." + format);
                                //exportExcel();
                            }
                        }]
                },
                colModel: [
                    {
                        title: '{{Helpers::getRS($g,"Ma_NV")}}',
                        minWidth: 120,
                        align: "left",
                        dataIndx: "EmployeeID",
                        isExport: true,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ho_va_ten")}}',
                        minWidth: 180,
                        dataType: "string",
                        dataIndx: "EmployeeName",
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        render: function (ui) {
                            var rowData = ui.rowData;
                            return '<a class="text-blue" title="{{Helpers::getRS($g,"Ho_va_ten")}}" onclick="showW09F4444(\'' + rowData["EmployeeID"] + '\')">' + rowData["EmployeeName"] + '</a>';
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Phong_ban")}}',
                        minWidth: 200,
                        dataType: "string",
                        editor: false,
                        dataIndx: "DepartmentName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    }
                    @foreach($captionTH as $row)
                    , {
                        title: "{{$row['Caption']}}",
                        minWidth: 220,
                        align: "right",
                        dataType: "float",
                        format: returnSFormat(4),
                        dataIndx: "{{$row['FieldName']}}",
                        filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                        render: function (ui) {
                            var rowData = ui.rowData;
                            return format2(rowData["{{$row['FieldName']}}"], '', {{$decimals}})
                        },
                    }
                    @endforeach
                    ,
                    {
                        title: '{{Helpers::getRS($g,"Da_quyet_toan_phep")}}',
                        minWidth: 150,
                        dataType: "string",
                        dataIndx: "IsLeaveBalanced",
                        editor: false,
                        align: "center",
                        render: function (ui) {
                            var rowData = ui.rowData;
                            return '<input type="checkbox" disabled ' + (rowData["IsLeaveBalanced"] == 1 ? "checked" : "") + '>';
                        }
                    }
                ],
                dataModel: {
                    data: dataTab1_2,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    // //console.log('complete grid tab 2-2');

                },
                rowClick: function (event, ui) {

                },
            };
            obj2.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W75F4100_tab1_2").pqGrid(obj2);
            $("#pqgrid_W75F4100_tab1_2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F4100_tab1_2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F4100_tab1_2").pqGrid("refreshDataAndView");
                // $(".l3loading").addClass('hide');
            }, 1)
        });
    }

    function loadtab2() {
        // $(".l3loading").removeClass('hide');
        $('#OTNumberMax').val("");
        $('#OTNumberMin').val("");
        $("input[name='IsOT']").removeAttr("checked");
        recorTab2 = false;
        recorTab3 = true;
        recorTab4 = true;
        $(document).ready(function () {
            var tab2_W75F4100Height = $(document).height() - 300;
            var obj3 = {
                width: '100%',
                height: tab2_W75F4100Height,
                showTitle: false,
                collapsible: false,
                editable: false,
                selectionModel: {type: 'cell', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                //freezeCols: 3,
                hwrap: false,
                wrap: false,
                sortable: false,
                filterModel: {on: true, mode: "AND", header: true},
                groupModel: {
                    on: true,
                    //dataIndx: ['EmployeeID','EmployeeName'],
                    collapsed: [true],
                    merge: true,
                    showSummary: [true, false],
                    title: [
                        "{0}"
                    ],
                    summaryInTitleRowType: ""
                },
                summaryTitle: {
                    sum: "<b>{0}</b>"
                },
                toolbar: {
                    items: [
                        {
                            type: 'button',
                            label: "Export",
                            icon: 'ui-icon-arrowthickstop-1-s',
                            listener: function () {
                                var format = 'xls',
                                    blob = this.exportData({
                                        //url: "/pro/demos/exportData",
                                        format: format,
                                        render: false
                                    });

                                if (typeof blob === "string") {
                                    blob = new Blob([blob]);
                                }
                                saveAs(blob, "Tang_ca." + format);
                                //exportExcel();
                            }
                        }]
                },
                colModel: [
                    {
                        title: '{{Helpers::getRS($g,"Ma_NV")}}',
                        minWidth: 120,
                        align: "left",
                        dataIndx: "EmployeeID",
                        isExport: true,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ho_va_ten")}}',
                        minWidth: 180,
                        dataType: "string",
                        dataIndx: "EmployeeName",
                        editor: false,
                        //groupableType: false,
                        nodrag: true,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        render: function (ui) {
                            var rowData = ui.rowData;
                            if (ui.cellData != undefined) {
                                return '<a id = "EmployeeName" class="text-blue" title="{{Helpers::getRS($g,"Ho_va_ten")}}" onclick="showW09F4444(\'' + rowData["EmployeeID"] + '\')">' + rowData["EmployeeName"] + '</a>';
                            }
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Phong_ban")}}',
                        minWidth: 180,
                        dataType: "string",
                        editor: false,
                        dataIndx: "DepartmentName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Chuc_vu")}}',
                        minWidth: 180,
                        dataType: "string",
                        editor: false,
                        hidden: true,
                        dataIndx: "DutyName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_cong")}}',
                        minWidth: 100,
                        editor: false,
                        align: "center",
                        dataIndx: "AttendanceDate",
                        dataType: "date",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Loai_ngay")}}',
                        minWidth: 180,
                        editor: false,
                        dataIndx: "AttendanceDateTypeName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ca")}}',
                        minWidth: 150,
                        editor: false,
                        dataIndx: "ShiftName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: 'TCT',
                        minWidth: 90,
                        editor: false,
                        align: "right",
                        dataIndx: "PreOTHours",
                        format: "#,###.00",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: 'TCS',
                        minWidth: 90,
                        align: "right",
                        editor: false,
                        dataIndx: "AfterOTHours",
                        format: "#,###.00",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: 'Tổng giờ TC',
                        minWidth: 90,
                        align: "right",
                        editor: false,
                        dataIndx: "OTHoursTotal",
                        format: "#,###.00",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        summary: {
                            type: "sum"
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Gio_vao")}}',
                        minWidth: 90,
                        align: "right",
                        editor: false,
                        dataIndx: "TimeOn",
                        filter: {type: "textbox", condition: "contain", listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Gio_ra")}}',
                        minWidth: 90,
                        align: "right",
                        editor: false,
                        dataIndx: "TimeOff",
                        filter: {type: "textbox", condition: "contain", listeners: ['keyup']}
                    },
                ],
                dataModel: {
                    data: dataTab2,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    // //console.log('complete grid tab 2-2');

                },
                rowClick: function (event, ui) {
                },
            };
            obj3.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W75F4100_tab2").pqGrid(obj3);
            $("#pqgrid_W75F4100_tab2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F4100_tab2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F4100_tab2").pqGrid("refreshDataAndView");
                // $(".l3loading").addClass('hide');
            }, 1)
        });
    }

    function loadtab3() {
        // $(".l3loading").removeClass('hide');
        $('#IsNotAskedLeave').prop('checked', true);
        $('#IsAskedLeave').prop('checked', true);
        $('#TimesMin').val("");
        $('#TimesMax').val("");
        //$("input[name='IsAsk']").removeAttr("checked");
        $("input[name='IsTimes']").removeAttr("checked");
        recorTab2 = true;
        recorTab3 = false;
        recorTab4 = true;
        $(document).ready(function () {
            var tab3_W75F4100Height = $(document).height() - 300;
            var obj4 = {
                width: '100%',
                height: tab3_W75F4100Height,
                showTitle: false,
                collapsible: false,
                editable: false,
                selectionModel: {type: 'cell', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                //freezeCols: 3,
                hwrap: false,
                wrap: false,
                sortable: false,
                groupModel: {
                    on: true,
                    //dataIndx: ['EmployeeID','EmployeeName'],
                    collapsed: [true],
                    merge: true,
                    showSummary: [true, false],
                    title: [
                        "{0}"
                    ],
                    summaryInTitleRowType: ""
                },
                summaryTitle: {
                    sum: "<b>{0}</b>"
                },
                filterModel: {on: true, mode: "AND", header: true},
                toolbar: {
                    items: [
                        {
                            type: 'button',
                            label: "Export",
                            icon: 'ui-icon-arrowthickstop-1-s',
                            listener: function () {
                                var format = 'xls',
                                    blob = this.exportData({
                                        //url: "/pro/demos/exportData",
                                        format: format,
                                        render: false
                                    });

                                if (typeof blob === "string") {
                                    blob = new Blob([blob]);
                                }
                                saveAs(blob, "Di_tre_ve_som." + format);
                                //exportExcel();
                            }
                        }]
                },
                colModel: [
                    {
                        title: '{{Helpers::getRS($g,"Ma_NV")}}',
                        minWidth: 120,
                        align: "left",
                        dataIndx: "EmployeeID",
                        isExport: true,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ho_va_ten")}}',
                        minWidth: 180,
                        dataType: "string",
                        dataIndx: "EmployeeName",
                        editor: false,
                        nodrag: true,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        render: function (ui) {
                            var rowData = ui.rowData;
                            if (ui.cellData != undefined) {
                                return '<a id = "EmployeeName" class="text-blue" title="{{Helpers::getRS($g,"Ho_va_ten")}}" onclick="showW09F4444(\'' + rowData["EmployeeID"] + '\')">' + rowData["EmployeeName"] + '</a>';
                            }
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Phong_ban")}}',
                        minWidth: 200,
                        dataType: "string",
                        editor: false,
                        dataIndx: "DepartmentName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Chuc_vu")}}',
                        minWidth: 180,
                        dataType: "string",
                        editor: false,
                        dataIndx: "DutyName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_cong")}}',
                        minWidth: 120,
                        editor: false,
                        align: "center",
                        dataIndx: "AttendanceDate",
                        dataType: "date",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Loai_ngay")}}',
                        minWidth: 200,
                        editor: false,
                        align: "center",
                        dataIndx: "AttendanceDateTypeName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ca")}}',
                        minWidth: 160,
                        editor: false,
                        dataIndx: "ShiftName",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Gio_vao")}}',
                        minWidth: 120,
                        editor: false,
                        align: "center",
                        dataIndx: "TimeOn",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Gio_ra")}}',
                        minWidth: 120,
                        editor: false,
                        align: "center",
                        dataIndx: "TimeOff",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Di_treU")}}',
                        minWidth: 80,
                        editor: false,
                        align: "center",
                        dataIndx: "IsAskedLeaveLM",
                        //filter: {type: "textbox", condition: "equal", listeners: ['change']},
                        render: function (ui) {
                            var rowData = ui.rowData;
                            return '<input type="checkbox" disabled ' + (rowData["IsAskedLeaveLM"] == 1 ? "checked" : "") + '>';
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ve_somU")}}',
                        minWidth: 80,
                        editor: false,
                        align: "center",
                        dataIndx: "IsAskedLeaveEM",
                        //filter: {type: "textbox", condition: "equal", listeners: ['change']},
                        render: function (ui) {
                            var rowData = ui.rowData;
                            return '<input type="checkbox" disabled ' + (rowData["IsAskedLeaveEM"] == 1 ? "checked" : "") + '>';
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"So_phut_di_tre")}}',
                        minWidth: 120,
                        editor: false,
                        align: "right",
                        dataIndx: "LateAmount",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"So_phut_ve_som")}}',
                        minWidth: 120,
                        editor: false,
                        align: "right",
                        dataIndx: "EarlyAmount",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Tong_so_phut_DT/VS")}}',
                        minWidth: 150,
                        align: "right",
                        editor: false,
                        dataIndx: "LateEarlyAmountTotal",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        summary: {
                            type: "sum"
                        }
                    },
                ],
                dataModel: {
                    data: dataTab3Normal,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    ////console.log('complete grid tab 2-2');

                },
                rowClick: function (event, ui) {
                },
            };
            obj4.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W75F4100_tab3").pqGrid(obj4);
            $("#pqgrid_W75F4100_tab3").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F4100_tab3").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F4100_tab3").pqGrid("refreshDataAndView");
                //$(".l3loading").addClass('hide');
            }, 1)
        });
    }

    function loadtab4() {
        recorTab2 = true;
        recorTab3 = true;
        recorTab4 = false;
        $(document).ready(function () {
            var tab4_W75F4100Height = $(document).height() - 260;
            var obj4 = {
                width: '100%',
                height: tab4_W75F4100Height,
                showTitle: false,
                collapsible: false,
                editable: false,
                selectionModel: {type: 'cell', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                //freezeCols: 3,
                hwrap: true,
                wrap: true,
                sortable: false,
                filterModel: {on: true, mode: "AND", header: true},
                colModel: [
                    {
                        title: '{{Helpers::getRS($g,"Ma_NV")}}',
                        minWidth: 120,
                        align: "left",
                        dataIndx: "EmployeeID",
                        isExport: false,
                        hidden: true
                        //editor: false,
                        //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ho_va_ten")}}',
                        /* minWidth: 300,
                         maxWidth: 800,
                         width: 200,*/
                        dataType: "string",
                        dataIndx: "EmployeeName",
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    }
                ],
                dataModel: {
                    data: dataTab4_1,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    if ($("#pqgrid_W75F4100_tab4_1").pqGrid("option", "dataModel.data").length > 0) {
                        sRowIndx = 0;
                        $("#pqgrid_W75F4100_tab4_1").pqGrid("setSelection", {rowIndx: 0});
                        var rowData = getRowSelection($("#pqgrid_W75F4100_tab4_1"));
                        // console.log(rowData.IsApproveCV);
                        viewDetail(rowData.EmployeeID);
                    } else {
                        $("#pqgrid_W75F4100_tab4_1").pqGrid("option", "dataModel.data", []);
                        $("#pqgrid_W75F4100_tab4_1").pqGrid("refreshDataAndView");
                    }

                },
                rowClick: function (event, ui) {
                    //console.log(ui.rowData.EmployeeID);
                    viewDetail(ui.rowData.EmployeeID);
                },
            };
            //obj4.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W75F4100_tab4_1").pqGrid(obj4);
            $("#pqgrid_W75F4100_tab4_1").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F4100_tab4_1").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F4100_tab4_1").pqGrid("refreshDataAndView");
            }, 1)

            var tab4_W75F4100Height_2 = $(document).height() - 260;
            var obj5 = {
                width: '100%',
                height: tab4_W75F4100Height_2,
                showTitle: false,
                collapsible: false,
                editable: false,
                selectionModel: {type: 'cell', mode: 'single'},
                //scrollModel: {horizontal: true,  autoFit: false, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                freezeCols: 2,
                hwrap: false,
                wrap: false,
                sortable: false,
                //filterModel: {on: true, mode: "AND", header: true},
                colModel: [
                    {
                        title: '',
                        minWidth: 20,
                        width: 60,
                        dataType: "string",
                        editor: false,
                        hidden: true,
                        align: "center",
                        sortable: false,
                        dataIndx: "DataID"
                    },
                    {
                        title: '{{Helpers::getRS($g,"Du_lieu")}}',
                        minWidth: 20,
                        width: 200,
                        dataType: "string",
                        editor: false,
                        align: "left",
                        sortable: false,
                        dataIndx: "Data"
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_cong")}}',
                        minWidth: 20,
                        sortable: false,
                        colModel: [
                                @for($i=1; $i<=$days; $i++)
                            {
                                title: '{{$i}}',
                                minWidth: 20,
                                width: 70,
                                dataType: "string",
                                editor: false,
                                align: "center",
                                sortable: false,
                                dataIndx: "{{$i}}"
                            },
                            @endfor
                        ]
                    }
                ],
                dataModel: {
                    data: dataTab4_2,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    ////console.log('complete grid tab 2-2');

                },
                rowClick: function (event, ui) {
                },
            };
            //obj4.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W75F4100_tab4_2").pqGrid(obj5);
            $("#pqgrid_W75F4100_tab4_2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F4100_tab4_2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F4100_tab4_2").pqGrid("refreshDataAndView");
            }, 1)
        });
    }

    function viewDetail(employeeID) {
        console.log(employeeID);
        $("#pqgrid_W75F4100_tab4_2").pqGrid("showLoading");
        var datef = $('#txtDate').data('daterangepicker').startDate.format('DD/MM/YYYY');
        var datet = $('#txtDate').data('daterangepicker').endDate.format('DD/MM/YYYY');
        // console.log(keyW25F3020);
        $.ajax({
            method: "POST",
            url: '{{url("/W75F4100/$pForm/$g/righgrid")}}',
            data: $("#frmW75F4100").serialize() + "&employeeID=" + employeeID + '&datefrom=' + datef + '&dateto=' + datet,
            success: function (data) {
                // console.log(data);
                //setter
                $("#pqgrid_W75F4100_tab4_2").pqGrid("option", "dataModel.data", data);
                $("#pqgrid_W75F4100_tab4_2").pqGrid("refreshDataAndView");
                $("#pqgrid_W75F4100_tab4_2").pqGrid("hideLoading");
                //loadData();
            }
        });
    }

    //refresh luoi khi chon dung tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).closest(".nav-tabs-custom").find(".tab-content");
        var target = $(target).find("div.active");
        var id = $(target).find(".pq-grid").attr("id")
        // //console.log(id);

        switch (id) {
            case "pqgrid_W75F4100_tab1_2":
                $("#pqgrid_W75F4100_tab1_2").pqGrid("option", "dataModel.data", dataTab1_2);
                $("#" + id).pqGrid("refreshDataAndView");
                break;
            case "pqgrid_W75F4100_tab1_1":
                $("#pqgrid_W75F4100_tab1_1").pqGrid("option", "dataModel.data", valueGridtab1_1);
                $("#" + id).pqGrid("refreshDataAndView");
                break;
            case "pqgrid_W75F4100_tab2":
                $("#pqgrid_W75F4100_tab2").pqGrid("option", "dataModel.data", dataTab2);
                $("#" + id).pqGrid("refreshDataAndView");
                break;
            case "pqgrid_W75F4100_tab3":
                $("#pqgrid_W75F4100_tab3").pqGrid("option", "dataModel.data", dataTab3Normal);
                $("#" + id).pqGrid("refreshDataAndView");
                break;
            case "pqgrid_W75F4100_tab4_1":
                $("#pqgrid_W75F4100_tab4_1").pqGrid("option", "dataModel.data", dataTab4);
                $("#" + id).pqGrid("refreshDataAndView");
                break;
        }
    });

    function showW09F4444(empid) {
        $.ajax({
            method: "GET",
            url: "{{url("W09F4444/$g")}}",
            data: {empid: empid},
            success: function (data) {
                $("#secDetailE09F0000").html(data);
                $("#modalW09F4444").modal("show");
            }
        });
    }
</script>