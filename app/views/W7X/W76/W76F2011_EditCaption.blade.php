<div class="modal fade" id="popEditCaption" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:45%">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Cap_nhat_mo_ta"),"W76F2011", true, "popEditCaption")}}
            </div>

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW76F2011_EditCaption">
                    <div class="row">
                        <div class="col-md-10 col-xs-10" style="padding-right: 0px">
                            <input class="form-control" type="text" id="caption" name="caption" value="">
                            <input type="hidden" id="imageID" name="imageID" value="">
                        </div>
                        <div class="col-md-2 col-xs-2" style="padding-right: 5px">
                            <button type="button" id="btnSaveCaption" onclick="update_caption();"
                                    style="margin-left:-20px;margin-top:-1px;padding-top:2px;padding-bottom: 3px;"
                                    class="btn btn-default smallbtn pull-right mgr10 confirmation-save">
                                <span class="glyphicon glyphicon-floppy-saved mgr5"></span>{{Helpers::getRS($g,"Luu")}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->