<div class="modal draggable fade" id="modalInfoW27F3000" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: #fff;width:500px">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Chi_tiet_can_ho"),"W27F3000",false,"closeInfoW27F3000Pop")}}
            </div>
            <div class="modal-body" style="background: #fff; float: left; width: 100%; padding-bottom: 5px;">
                <table class="table table-striped">
                    <tbody>
                    @foreach ($connection->select("EXEC W27P3002 '$div', '$officeno', '".Session::get('Lang')."'") as $row)
                        <tr>
                            <td>{{$row["Caption"]}}</td>
                            <td class="text-right">
                                @if($row["DataType"]=="N")
                                    <label>{{number_format($row["Value"],$row["NumberFormat"])}}</label>
                                @else
                                    <label>{{$row["Value"]}}</label>
                                @endif
                                <label style="width: 55px;margin-left: 2px" class="text-left">{{$row["Extend"]}}</label>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var closeInfoW27F3000Pop = function () {
        $("#modalInfoW27F3000").modal('hide');
    };
</script>