<section class="content" id="secW90F0110">
    <form id="frmW90F0110" name="frmW90F0110">
        <div class="row">
            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-1">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                    </div>
                    <div class="col-md-7">
                        {{Form::select("slDivisionID",$div,Session::get("W91P0000")['DivisionID'],["class"=>"form-control","id"=>"slDivisionID"])}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row pdt5">
            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-1">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ky")}}</label>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6 pdr0">
                                <select class="form-control" id="slPeriodFrom" name="slPeriodFrom">
                                    @foreach($period as $row)
                                        <option value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 pdr0">
                                <select class="form-control" id="slPeriodTo" name="slPeriodTo">
                                    @foreach($period as $row)
                                        <option value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 pdr0">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Tai_khoan")}}</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" id="txtAccountID" name="txtAccountID" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="radio pdt0 mgt5">
                                    <label>
                                        <input type="radio" checked value="0" id="optMode0"
                                               name="optMode">{{Helpers::getRS($g,"TK_trong_bang")}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="radio pdt0 mgt5">
                                    <label>
                                        <input type="radio" value="1" id="optMode1"
                                               name="optMode">{{Helpers::getRS($g,"TK_ngoai_bang")}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span
                            class="digi digi-filter"></span>
                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
            </div>
        </div>
    </form>
</section>
<div class="modal draggable fade" id="modalW90F0120" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"So_cai"),"W90F0120")}}
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<section class="content" id="tbW90F0110">
</section>
<script type="text/javascript">
    $("#secW90F0110").find("#frmW90F0110").on('submit', function (e) {
        e.preventDefault();
        LoadDataW90F0110();
    });

    function LoadDataW90F0110() {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW90F0110").serialize(),
            success: function (data) {
                $("#tbW90F0110").html(data);
            }
        });
    }

    function showW90F0120(acc, div, pefrom, peto) {
        $.ajax({
            method: "GET",
            url: '{{url("W90F0120/view/D90F0120/1")}}',
            success: function (data) {
                $("#modalW90F0120").find(".modal-body").html(data);
                $("#modalW90F0120").modal("show");
                $("#modalW90F0120").find("#slDivisionID").val(div);
                $("#modalW90F0120").find("#hdPFromW90F0120").val(pefrom);
                $("#modalW90F0120").find("#hdPToW90F0120").val(peto);
                $("#modalW90F0120").find("#slDivisionID").trigger("change");
                $("#modalW90F0120").find("#slAccountID").val(acc);
            }
        });
    }

    $("#frmW90F0110").find("#slDivisionID").on("change",function(e){
        $.ajax({
            method: "GET",
            url: '{{url("/loadperiod/D90")}}/'+$("#frmW90F0110").find("#slDivisionID").val(),
            success: function (data) {
                $("#frmW90F0110").find("#slPeriodFrom").html(data);
                $("#frmW90F0110").find("#slPeriodTo").html(data);
            }
        });
    });

    $("#modalW90F0120").on('hidden.bs.modal', function() {
        $("#modalW90F0120").find(".modal-body").html('');
    });
</script>

