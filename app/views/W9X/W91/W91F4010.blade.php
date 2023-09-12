<div class="modal draggable fade" id="modalW91F4010"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style=" background: #fff;width:750px">
            <div class="modal-header">
                {{Helpers::generateHeading(' &nbsp;',"W91F4010",false,"closeW91F4010Pop")}}
            </div>
            <div class="modal-body"  style="float: left; background: #fff; padding: 10px; width: 100%;">
                <div id="pgrid_W91F4010"></div>
                <table id="tblW91F4010" width="100%">
                    <tr>
                        <td width="50" align="center">{{Helpers::getRS($g,'STT')}}</td>
                        <td width="100">{{Helpers::getRS($g,'Ngay')}}</td>
                        <td width="140">{{Helpers::getRS($g,'Nguoi_dinh_kem')}}</td>
                        <td width="230">{{Helpers::getRS($g,'Ten_tap_tin')}}</td>
                        <td width="227">{{Helpers::getRS($g,'Dien_giai')}}</td>
                    </tr>
                    @define $name_con=$g==4 ? "sqlsrvHR" : "CONDEFAULT"
                    @define $name_company=$g==4 ? Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) : Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"])
                    @foreach(DB::connection($name_con)->select("EXEC W91P1013 '".(isset($divisionID)?$divisionID: Session::get("W91P0000")['DivisionID'])."', '$mod', '".(isset($tablename)?$tablename:$rs[0]['TableName'])."', '$name_company', 1, '".(isset($voucherID)?$voucherID:$rs[0]['VoucherID'])."', '".(isset($key02ID)?$key02ID:'')."', '', '', ''") as $row )
                        <tr>
                            <td>{{$row['OrderNo']}}</td>
                            <td>{{$row['CreateDate']}}</td>
                            <td>{{$row['CreateUserName']}}</td>
                            <td><a href="{{url("W91F4010/attachment/$mod/$g/".(isset($rs[0]['TableName'])?$rs[0]['TableName']:$tablename).'/'.$row['AttachmentID'])}}" class="text-blue fa {{Helpers::geticonfile($row['FileExt'])}}">&nbsp;{{$row['FileName']}}</a></td>
                            <td>{{$row['Description']}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div id="iframeDown" class="hide"></div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var closeW91F4010Pop= function () {
        $("#modalW91F4010").modal('hide');
    };

    $(function() {
        var newObj = {
            width: $("#modalW91F4010").find('.modal-content').width()-20,
            flexHeight: true,
            showTitle: false,
            collapsible: false,
            editable: false,
            numberCell: {show: false},
            flexWidth: false
        };
        change2grid('#tblW91F4010', '#pgrid_W91F4010', newObj, {
            0:{"align":"center"},
            3:{"cls":"text-yellow"}
        }, null);
    });
    $('#modalW91F4010').on('shown.bs.modal', function () {
        $("#pgrid_W91F4010").pqGrid('refreshDataAndView');
    });

</script>