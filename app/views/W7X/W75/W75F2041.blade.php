<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F2041" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle["FormDesc"],"W75F2041")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <form id="frmW75F2041" name="frmW75F2041" method="post">
                        @if($perW75F2041 == 4)
                        <div class = "row form-group">
                            <div class = "col-xs-4 col-lg-4 col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Khoi")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbBlockIDW75F2041" name="cbBlockIDW75F2041"
                                                placeholder="">
                                            @foreach($block as $row)
                                                <option value="{{$row['BlockID']}}">{{$row['BlockName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-xs-4 col-lg-4 col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"To_nhom")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbTeamIDW75F2041" name="cbTeamIDW75F2041"
                                                placeholder="">
                                            @foreach($team as $row)
                                                <option value="{{$row['TeamID']}}">{{$row['TeamName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-xs-4 col-lg-4 col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Chinh_sach")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbBenefitIDW75F2041" name="cbBenefitIDW75F2041"
                                                placeholder="">
                                            @foreach($cbBenefit as $row)
                                                <option value="{{$row['BenefitID']}}">{{$row['BenefitName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "row form-group">
                            <div class = "col-xs-4 col-lg-4 col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbDepartmentIDW75F2041" name="cbDepartmentIDW75F2041"
                                                placeholder="">
                                            @foreach($department as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-xs-4 col-lg-4 col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ma_NV")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <input type="text" class="form-control" id="txtEmployeeIDW75F2041" name="txtEmployeeIDW75F2041">
                                    </div>
                                </div>
                            </div>
                            <div class = "col-xs-4 col-lg-4 col-md-4">
                                <div class = "row">
                                    <div class = "col-xs-12 col-lg-12 col-md-12 liketext">
                                        <button type="button" id="frm_btnFilterW75F2041"
                                                class="btn btn-default smallbtn pull-right"
                                                title="{{Helpers::getRS($g,"Loc")}}"><span class="digi digi-filter text-blue"></span>{{Helpers::getRS($g,"Loc")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                            @if($perW75F2041 != 4)
                                <div class = "row form-group">
                                    <div class = "col-xs-4 col-lg-4 col-md-4">
                                        <div class="row">
                                            <div class="col-md-3 liketext">
                                                <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ma_chinh_sach")}}</label>
                                            </div>
                                            <div class="col-md-9 liketext">
                                                <select class="form-control"
                                                        id="cbBenefitIDW75F2041" name="cbBenefitIDW75F2041"
                                                        placeholder="">
                                                    @foreach($cbBenefit as $row)
                                                        <option value="{{$row['BenefitID']}}">{{$row['BenefitName']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-xs-4 col-lg-4 col-md-4">

                                    </div>
                                    <div class = "col-xs-4 col-lg-4 col-md-4">
                                        <div class = "row">
                                            <div class = "col-xs-12 col-lg-12 col-md-12 liketext">
                                                <button type="button" id="frm_btnFilterW75F2041"
                                                        class="btn btn-default smallbtn pull-right"
                                                        title="{{Helpers::getRS($g,"Loc")}}"><span class="digi digi-filter text-blue"></span>{{Helpers::getRS($g,"Loc")}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "row form-group">
                                    <div class = "col-xs-5 col-lg-5 col-md-5">
                                        <label> </label>
                                    </div>
                                </div>
                            @endif

                    </form>
                    <div class = "row form-group">
                        <div class = "col-xs-6 col-lg-6 col-md-6">
                            <div id="tb_gridW75F2041_1"></div>
                        </div>
                        <div class = "col-xs-6 col-lg-6 col-md-6">
                            <div id="tb_gridW75F2041_2"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12 ">
                            <button type="button" id="frm_btnSaveW75F2040"
                                    class="btn btn-default smallbtn pull-right hide"
                                    title="{{Helpers::getRS($g,"Luu")}}"
                                    onclick="ask_save(function(){save()})">
                                <span class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type  = "text/javascript">
    $(document).ready(function () {
        @if(intval($mode) == 1)
            $('#txtEmployeeIDW75F2041').val("{{$EmployeeID1st}}").prop('readonly', true);
            $('#cbBenefitIDW75F2041').val("{{$BenefitID1st}}").prop('disabled', true);
            filterGridW75F2041();
        @endif
    });
    $("#frm_btnFilterW75F2041").click(function () {
        filterGridW75F2041();
    });

    function filterGridW75F2041() {
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2041/$pForm/$g/filtter")}}',
            data: $("#frmW75F2041").serialize() + "&cbBenefitIDW75F2041=" + $('#cbBenefitIDW75F2041').val() + "&mode=" + {{$mode}} + "&cbBlockIDW75F2041=" + $('#cbBlockIDW75F2041').val()
            + "&cbDepartmentIDW75F2041=" + $('#cbDepartmentIDW75F2041').val()+ "&cbTeamIDW75F2041=" + $('#cbTeamIDW75F2041').val()+ "&txtEmployeeIDW75F2041=" + $('#txtEmployeeIDW75F2041').val(),
            success: function (data) {
                //console.log(data);
                $("#tb_gridW75F2041_1").html(data);
                $("#frm_btnSaveW75F2040").removeClass('hide');
                //$("#tb_gridW75F2041_2").addClass('hide');
            }
        });
    }

    $("#cbBlockIDW75F2041").change(function () {
        //alert("da change");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2040/$pForm/$g/BlockIDChange")}}',
            data: '&blockID=' + $("#cbBlockIDW75F2041").val(),
            success: function (data) {
                $('#cbDepartmentIDW75F2041').html(data);
                $("#cbDepartmentIDW75F2041").trigger("change");
            }
        });
    });

    $("#cbDepartmentIDW75F2041").change(function () {
        //alert("da change");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2040/$pForm/$g/DepartmentIDChange")}}',
            data: '&DepartmentID=' + $("#cbDepartmentIDW75F2041").val(),
            success: function (data) {
                $('#cbTeamIDW75F2041').html(data);
            }
        });
    });

    function save() {
        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        $grid = $("#gridW75F2041_2");
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
        var obj = $grid.pqGrid("option", "dataModel.data");
        var colModel = $grid.pqGrid("option", "colModel" );
        //alert(obj.length);
        if (Number(obj.length) != 0 ){
            //alert("sdsd");
            //console.log("dfsdfs");
            for (var i=0;i<obj.length;i++){
                for (var j=0;j<colModel.length;j++){
                    if (colModel[j].required && isNullOrEmpty(obj[i][colModel[j].dataIndx])){
                        $grid.pqGrid("setSelection", {
                            rowIndx: i,
                            colIndx: j
                        });
                        $grid.pqGrid( "editCell", { rowIndx: i, dataIndx: colModel[j].dataIndx } );
                        var cell = $grid.pqGrid( "getEditCell" );
                        var $editor = cell.$editor;
                        $($editor).confirmation({
                            btnOkLabel: '',
                            btnCancelLabel: '',
                            popout: true,
                            placement: "bottom",
                            singleton: true,
                            template:
                            '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                            + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                            + askMessage
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        //e.stopPropagation();
                        //e.preventDefault();
                        return;
                    }
                }
            }
        }

        var data1 = $("#gridW75F2041_1").pqGrid("option", "dataModel.data");
        var data2 = $("#gridW75F2041_2").pqGrid("option", "dataModel.data");
        var BenefitID = "";
        var EmployeeID = "";
        if(data2.length > 0){
            var BenefitID = data2[0].BenefitID;
            var EmployeeID = data2[0].EmployeeID;
        }

        console.log(data2);
        var dataSender1 = $.grep(data1, function (d) {
            return (Number(d.IsUpdate) == 1 && Number(d.Participation) == 1) || (Number(d.IsUpdate) == 1 && Number(d.NotParticipation) == 1);
        });
      /*  var dataSender2 = $.grep(data2, function (d) {
            return Number(d.IsUpdate) == 1;
        });*/
        console.log(dataSender1);
        if (dataSender1.length > 0 || data2.length > 0) {
            $.ajax({
                method: "POST",
                url: '{{url("/W75F2041/$pForm/$g/save")}}',
                data: {
                    dataSender1: JSON.stringify(dataSender1),
                    dataSender2: JSON.stringify(data2),
                    BenefitID: BenefitID,
                    EmployeeID: EmployeeID,
                    mode: {{$mode}}
                },
                success: function (data) {
                    console.log(data);
                    if (data.status == 1) {
                        //filterGrid();
                        filterGridW75F2041();
                      /*  $("#gridW75F2041_2").pqGrid("option", "dataModel.data", []);
                        $("#gridW75F2041_2").pqGrid("refreshDataAndView");*/
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
</script>