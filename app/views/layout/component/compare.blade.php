<div class="modal draggable fade" id="mPopUpCompareSC"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style=" background: #fff; width: 900px; margin-left: -100px;">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"So_sanh_LTT"),"",false,"closemPopUpCompareSC")}}
            </div>
            <div class="modal-body"  style="float: left; background: #fff; padding: 10px; width: 100%;">
                @yield('PCSCContent')
            </div>
        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var closemPopUpCompareSC= function () {
        $("#mPopUpCompareSC").modal('hide');
    };
 </script>