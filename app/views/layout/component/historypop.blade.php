<div class="modal draggable fade" id="mPopUpHistory"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content" style=" background: #fff; width: 100%;">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Lich_su_duyet"),"",false,"closeHistoryPop")}}
            </div>
            <div class="modal-body"  style="float: left; background: #fff; padding: 10px; width: 100%;">
                <div class="row">
                    <div class="col-md-12">
                        @yield('pcontent')
                    </div>

                </div>
            </div>
        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var closeHistoryPop= function () {
        $("#mPopUpHistory").modal('hide');
    };
 </script>