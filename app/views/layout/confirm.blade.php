<div class="modal fade" id="mPopUpConfirm"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,'Thong_baoU'),"",false,"",false)}}
            </div>
            <div class="modal-body">
                @section('Body-PConfirm')
                @show
            </div>
            <div class="modal-footer">

                <button  type="button" class="btn btn-primary footerMessage smallbtn">{{Helpers::getRS($g,'Dong_y')}}</button>
                <button  type="button" class="btn btn-primary footerMessage smallbtn">{{Helpers::getRS($g,'Huy')}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
