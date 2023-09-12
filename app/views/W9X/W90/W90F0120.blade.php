<section class="content" id="secW90F0120">
    <form id="frmW90F0120" name="frmW90F0120">
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-2">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                    </div>
                    <div class="col-md-10">
                        {{Form::select("slDivisionID",$div,Session::get("W91P0000")['DivisionID'],["class"=>"form-control","id"=>"slDivisionID"])}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mgt5">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-2">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Tai_khoan")}}</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control" id="slAccountID" name="slAccountID">
                            @foreach($rsAcc as $row)
                                <option value="{{$row["AccountID"]}}">{{$row["AccountID"]." - ".$row["AccountName"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-2">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ky")}}</label>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" id="slPeriodFrom" name="slPeriodFrom">
                            @foreach($period as $row)
                                <option value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="hdPFromW90F0120" value="">
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" id="slPeriodTo" name="slPeriodTo">
                            @foreach($period as $row)
                                <option value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="hdPToW90F0120" value="">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span class="digi digi-filter"></span>
                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
            </div>
        </div>
    </form>
</section>
<div class="col-md-12 mgt10" id="divW90F0120">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="tabHW90F0120">
            <li class="active"><a data-toggle="tab" href="#tabW90F0120_1">{{Helpers::getRS($g,"Tong_hop")}}</a></li>
            <li><a data-toggle="tab" href="#tabW90F0120_2">{{Helpers::getRS($g,"TK_doi_ung")}}</a></li>
            <li><a data-toggle="tab" href="#tabW90F0120_3">{{Helpers::getRS($g,"Ngay_phieu")}}</a></li>
            <li><a data-toggle="tab" href="#tabW90F0120_4">Module</a></li>
            <li><a data-toggle="tab" href="#tabW90F0120_5">{{Helpers::getRS($g,"But_toan")}}</a></li>
            <li><a data-toggle="tab" href="#tabW90F0120_6">{{Helpers::getRS($g,"Phieu")}}</a></li>
        </ul>
        <div class="tab-content">
            <div id="tabW90F0120_1" class="tab-pane active">
            </div>
            <!-- /.tab-pane -->
            <div id="tabW90F0120_2" class="tab-pane">
            </div>
            <!-- /.tab-pane -->
            <div id="tabW90F0120_3" class="tab-pane">
            </div>
            <!-- /.tab-pane -->
            <div id="tabW90F0120_4" class="tab-pane">
            </div>
            <!-- /.tab-pane -->
            <div id="tabW90F0120_5" class="tab-pane">
            </div>
            <!-- /.tab-pane -->
            <div id="tabW90F0120_6" class="tab-pane">
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
</div>

<script type="text/javascript">
    var iW90F0120Height = $(".contenttab").height() - 160;
    var iW90F0120Width;

    $("#secW90F0120").find("#frmW90F0120").on('submit', function (e) {
        e.preventDefault();
        LoadDataW90F0120();
    });

    $('#tabHW90F0120 a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // activated tab
        $(target).find(".pq-grid").pqGrid("refreshDataAndView");
    });

    function LoadDataW90F0120() {
        LoadpqGridW90F0120_1();
        LoadpqGridW90F0120_2();
        LoadpqGridW90F0120_3();
        LoadpqGridW90F0120_4();
        LoadpqGridW90F0120_5();
        LoadpqGridW90F0120_6();
    }

    function LoadpqGridW90F0120_1() {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW90F0120").serialize()+"&mode=0",
            success: function (data) {
                $("#tabW90F0120_1").html(data);
            }
        });
    }

    function LoadpqGridW90F0120_2() {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW90F0120").serialize()+"&mode=1",
            success: function (data) {
                $("#tabW90F0120_2").html(data);
            }
        });
    }

    function LoadpqGridW90F0120_3() {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW90F0120").serialize()+"&mode=2",
            success: function (data) {
                $("#tabW90F0120_3").html(data);
            }
        });
    }

    function LoadpqGridW90F0120_4() {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW90F0120").serialize()+"&mode=3",
            success: function (data) {
                $("#tabW90F0120_4").html(data);
            }
        });
    }

    function LoadpqGridW90F0120_5() {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW90F0120").serialize()+"&mode=4",
            success: function (data) {
                $("#tabW90F0120_5").html(data);
            }
        });
    }

    function LoadpqGridW90F0120_6() {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW90F0120").serialize()+"&mode=5",
            success: function (data) {
                $("#tabW90F0120_6").html(data);
            }
        });
    }

    $("#frmW90F0120").find("#slDivisionID").on("change",function(e){
        $.ajax({
            method: "GET",
            url: '{{url("/loadperiod/D90")}}/'+$("#frmW90F0120").find("#slDivisionID").val(),
            success: function (data) {
                $("#frmW90F0120").find("#slPeriodFrom").html(data);
                $("#frmW90F0120").find("#slPeriodTo").html(data);
                if ($("#frmW90F0120").find("#hdPFromW90F0120").val() != ""){
                    $("#frmW90F0120").find("#slPeriodFrom").val($("#frmW90F0120").find("#hdPFromW90F0120").val());
                    $("#frmW90F0120").find("#slPeriodTo").val($("#frmW90F0120").find("#hdPToW90F0120").val());
                    iW90F0120Height = documentHeight - 245;
                    iW90F0120Width = $("#modalW90F0120").find(".tab-content").width() - 10;
                    $("#modalW90F0120").find("#frmW90F0120").submit();
                    $("#frmW90F0120").find("#hdPFromW90F0120").val("");
                    $("#frmW90F0120").find("#hdPToW90F0120").val("");
                }
            }
        });
    });

    $(document).ready(function () {
        iW90F0120Width = $("#secW90F0120").width() - 30;
    });
</script>

