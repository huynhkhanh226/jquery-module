<div class="modal draggable fade" id="mcChangeDivision" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="frmChangeDivision" method="post">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,"Chon_don_viU"),"",false,"closepopDivision")}}
                </div>
                <div class="box-body">
                    @if($product==0 || $product==1)
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 control-label text-left">{{Helpers::getRS($g,"Don_vi_Tai_chinh")}}</label>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <select aria-hidden="true" class="form-control select2 select2-hidden-accessible" style="width: 350px;" id="slFNDivisionID" name="slFNDivisionID">
                                @foreach($connection->Select("EXEC W91P0001 '".Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"])."', '".Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."','".Auth::user()->User()->UserID."','".Session::get("W91P0000")['DivisionID']."', '".Session::get("W91P0000")['HRDivisionID']."', 0, $product") as $row)
                                    <option value="{{$row["DivisionID"]}}" {{$row["DivisionID"]==Session::get("W91P0000")['DivisionID']?'selected="selected"':''}}>{{$row["DivisionName"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    @if($product==0 || $product==2)
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 control-label text-left">{{Helpers::getRS($g,"Don_vi_Nhan_su")}}</label>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <select aria-hidden="true" class="form-control select2 select2-hidden-accessible" style="width: 350px;" id="slHRDivisionID" name="slHRDivisionID">
                                @foreach($connection->Select("EXEC W91P0001  '". Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"])."', '".Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."','".Auth::user()->User()->UserID."','".Session::get("W91P0000")['DivisionID']."', '".Session::get("W91P0000")['HRDivisionID']."', 1, $product") as $row)
                                    <option value="{{$row["DivisionID"]}}" {{$row["DivisionID"]==Session::get("W91P0000")['HRDivisionID']?'selected="selected"':''}}>{{$row["DivisionName"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 control-label text-left">{{Helpers::getRS($g,"Ky")}}</label>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <select aria-hidden="true" class="form-control select2 select2-hidden-accessible" style="width: 150px;" id="slChangePeriod" name="slChangePeriod">
                                @foreach($connection->Select("EXEC W91P0001  '".Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"])."', '".Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."','".Auth::user()->User()->UserID."','".Session::get("W91P0000")['DivisionID']."', '".Session::get("W91P0000")['HRDivisionID']."', 2, $product") as $row)
                                    <option value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary smallbtn btnSaveNewDiv" onclick="validNavigation=true">{{Helpers::getRS($g,"Chon")}}</button>
                        <button type="button" class="btn btn-default smallbtn" id="btnCloseFormDivision">{{Helpers::getRS($g,"DongU1")}}</button>
                    </div>
                </div>
            </form>
            <div class="l3loading hide">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $("#slFNDivisionID, #slHRDivisionID").on("change",function(){
        $.ajax({
            method: "POST",
            url: '{{url("/loadperiod")}}',
            data: {div: $("#slFNDivisionID").val(),hrdiv: $("#slHRDivisionID").val()},
            success: function (data) {
                $("#slChangePeriod").html(data);
                $("#slChangePeriod").select2();
                if ($("#slChangePeriod").val() == '')
                    $(".btnSaveNewDiv").addClass("hide");
                else
                    $(".btnSaveNewDiv").removeClass("hide");
            }
        });
    });

    $("#btnCloseFormDivision").on("click",function(){
        closepopDivision();
    });

    function closepopDivision()
    {
        $("#mcChangeDivision").modal('hide');
    }

    //Initialize Select2 Elements
    $(".select2").select2();
</script>
