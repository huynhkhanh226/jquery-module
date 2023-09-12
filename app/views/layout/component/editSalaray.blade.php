<div class="modal draggable fade" id="mPopUpEditSalary"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style=" background: #fff; width: 670px;">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Dieu_chinh_luong_HQ_cong_viec"),"",false,"clsmPopUpEditSalary")}}
            </div>
            <div class="modal-body"  style="float: left; background: #fff; padding: 10px; width: 670px;">
               @yield('edlContetn')

            </div>
        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var clsmPopUpEditSalary= function () {
        $("#mPopUpEditSalary").modal('hide');
    };
 </script>