<div class="modal draggable fade" id="mPopUpApprove"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style=" background: #fff; width: 600px;">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Phe_duyet"),"",false,"closeApprovePop")}}
            </div>
            <div class="modal-body"  style="float: left; background: #fff; padding: 10px; width: 100%;">
                <div class="row">

                        @yield('apcontent')

                </div>
            </div>
        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var closeApprovePop= function () {
        $("#mPopUpApprove").modal('hide');
    };
 </script>