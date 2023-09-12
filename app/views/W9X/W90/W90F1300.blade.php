<section class="content" id="secW90F1300">
    <form id="frmW90F1300" name="frmW90F1300" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                    </div>
                    <div class="col-md-10">
                        {{Form::select("slDivisionID",$div,Session::get("W91P0000")['DivisionID'],["class"=>"form-control","id"=>"slDivisionID"], ['required'])}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <label class="lbl-normal pdr0 liketext">Module</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control" id="slModuleID" name="slModuleID">
                            @foreach($module as $row)
                                <option value="{{$row["ModuleID"]}}">{{$row["ModuleName"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pdt5">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <div class="radio mgt5">
                            <label>
                                <input type="radio" value="1" id="optPeriod" name="optType" class="optType" checked="checked">
                                {{Helpers::getRS($g,"Ky")}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control disabled" id="slPeriodFrom" name="slPeriodFrom" required>
                            @foreach($period as $row)
                                <option value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" id="slPeriodTo" name="slPeriodTo" required>
                            @foreach($period as $row)
                                <option value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Loai_phieu")}}</label>
                    </div>
                    <div class="col-md-9">
                        {{Form::select("slVoucherTypeID",$voutype,0,["class"=>"form-control","id"=>"slVoucherTypeID"])}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <div class="radio mgt5">
                            <label>
                                <input type="radio" value="0" id="optDate" name="optType" class="optType">
                                {{Helpers::getRS($g,"Ngay")}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group date">
                            <input type="text" class="form-control" id="txtDateFrom" value="{{date("d/m/Y")}}" name="txtDateFrom" disabled required>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group date">
                            <input type="text" class="form-control" id="txtDateTo" value="{{date("d/m/Y")}}" name="txtDateTo" disabled required>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"So_phieu")}}</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" id="txtVoucherNo" name="txtVoucherNo" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span
                                    class="digi digi-filter"></span>
                            &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<div class="col-md-12 mgt10" id="divW90F1300">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="tabHW90F1300">
            <li class="active"><a data-toggle="tab" href="#tabW90F1300_1">{{Helpers::getRS($g,"Tong_hop_theo_ngay")}}</a></li>
            <li><a data-toggle="tab" href="#tabW90F1300_2">{{Helpers::getRS($g,"Tong_hop_theo_Module")}}</a></li>
            <li><a data-toggle="tab" href="#tabW90F1300_3">{{Helpers::getRS($g,"Tong_hop_theo_loai_phieu")}}</a></li>
        </ul>
        <div class="tab-content">
            <div id="tabW90F1300_1" class="tab-pane active">
            </div>
            <!-- /.tab-pane -->
            <div id="tabW90F1300_2" class="tab-pane">
            </div>
            <!-- /.tab-pane -->
            <div id="tabW90F1300_3" class="tab-pane">
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
</div>
<section id="secW90F1301"></section>
<script type="text/javascript">
    var iW90F1300Height = $(".contenttab").height() - 198;
    var iW90F1300Width;
    $("#frmW90F1300").on('submit', function (e) {
        e.preventDefault();
        iW90F1300Width = $("#secW90F1300").width() - 30;
        LoadDataW90F1300(1);
        LoadDataW90F1300(2);
        LoadDataW90F1300(3);
    });

    function LoadDataW90F1300(mode) {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW90F1300").serialize()+"&mode="+mode,
            success: function (data) {
                $("#tabW90F1300_"+mode).html(data);
            }
        });
    }

    $("#frmW90F1300").find("#slDivisionID").on("change", function (e) {
        $.ajax({
            method: "GET",
            url: '{{url("/loadperiod/D90")}}/' + $("#frmW90F1300").find("#slDivisionID").val(),
            success: function (data) {
                $("#frmW90F1300").find("#slPeriodFrom").html(data);
                $("#frmW90F1300").find("#slPeriodTo").html(data);
            }
        });
    });

    $("#frmW90F1300").on("change",".optType", function(){
        if (this.value == '0') {
            $("#frmW90F1300").find("#slPeriodFrom").attr("disabled","disabled");
            $("#frmW90F1300").find("#slPeriodTo").attr("disabled","disabled");
            $("#frmW90F1300").find("#txtDateFrom").removeAttr("disabled");
            $("#frmW90F1300").find("#txtDateTo").removeAttr("disabled");
        }
        else if (this.value == '1') {
            $("#frmW90F1300").find("#slPeriodFrom").removeAttr("disabled");
            $("#frmW90F1300").find("#slPeriodTo").removeAttr("disabled");
            $("#frmW90F1300").find("#txtDateFrom").attr("disabled","disabled");
            $("#frmW90F1300").find("#txtDateTo").attr("disabled","disabled");
        }
    });

    $(document).ready(function () {
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language:'vi'
        });

        console.log(0.2+0.1);
    });

    $('#tabHW90F1300 a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // activated tab
        $(target).find(".pq-grid").pqGrid("refreshDataAndView").pqGrid("refresh");
    });

    function callListVouchers(rIndx, $grid, mode){
        var rowData = $grid.pqGrid("getRowData", { rowIndx: rIndx });
        $.ajax({
            method: "POST",
            url: '{{url("W90F1301")}}/'+mode,
            data: {row: rowData},
            success: function (data) {
                $("#secW90F1301").html(data);
                $("#modalW90F1301").modal("show");
            }
        });
    }
</script>

