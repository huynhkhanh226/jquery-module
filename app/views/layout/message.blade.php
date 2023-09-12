<div class="modal fade" id="mPopUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS(0,'Thong_baoU'),"",false,"",false)}}
            </div>
            <div class="modal-body">
                <div class="row mgt5 mgb5">
                    <div class="col-md-12">
                        <label class="lbl-normal">{{$content}}</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="closePop()" type="button" class="btn btn-primary smallbtn footerMessage">OK</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    var closePop = function () {
        $("#mPopUp").modal('hide');
        $("#mPopUp").parent().html("");
    };
</script>