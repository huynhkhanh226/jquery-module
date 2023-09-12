<div class="modal draggable fade" id="mPopUpSendMail"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="frmmPopUpSendMail"   action="">
            <div class="modal-header">
                {{Helpers::generateHeading( Helpers::getRS(-1,'Gui_mail'),"",false,"closePopSendMail")}}
            </div>
            <div class="modal-body">
                <input type="hidden" id="hdFrom" name="hdFrom" value="{{isset($rs['EmailSenderAddress']) ? $rs['EmailSenderAddress'] : "" }}">
                <div class="form-group mgt10">
                    <label for="txtto"
                           class="col-sm-1 control-label text-left">To</label>
                    <div class="col-sm-11">
                    <input class="form-control" id="txtEmailReceivedAddress" name="txtEmailReceivedAddress"  placeholder="To:" value="{{ isset($rs['EmailReceivedAddress']) ? $rs['EmailReceivedAddress'] : ""}}" required>
                     </div>
                </div>
                <div class="form-group">
                    <label for="txtto"
                           class="col-sm-1 control-label text-left">CC</label>
                    <div class="col-sm-11">
                    <input class="form-control fa glyphicon glyphicon-message" id="txtEmailCCAddress" name="txtEmailCCAddress" placeholder="CC:" value="{{ isset($rs['EmailCCAddress']) ? $rs['EmailCCAddress'] : "" }}">
                        </div>
                </div>
                <div class="form-group">
                    <label for="txtto"
                           class="col-sm-1 control-label text-left">BCC</label>
                    <div class="col-sm-11">
                    <input class="form-control" id="txtEmailBCCAddress" name="txtEmailBCCAddress"  placeholder="BCC:" value="{{ isset($rs['EmailBCCAddress']) ? $rs['EmailBCCAddress'] : ""}}">
                     </div>
                </div>
                <div class="form-group">
                    <label for="txtto"
                           class="col-sm-1 control-label text-left">Subject</label>
                    <div class="col-sm-11">
                    <input class="form-control" id="txtEmailTitle" name="txtEmailTitle" placeholder="Subject:" value="{{ isset($rs['Subject']) ? $rs['Subject'] : "" }}" required>
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                    <textarea id="txtEmailContent" name="txtEmailContent" rows="10" cols="80">
                               {{ isset($rs['EmailContent']) ? $rs['EmailContent'] : ""}}
                    </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit"  class="btn btn-primary smallbtn pull-right"><span class="fa fa fa-envelope-o mgr10"></span>{{Lang::get("message.Gui_di")}}</button>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <div class="alert alert-success alert-dismissable hide">
                        <i class="icon fa fa-check"></i>   {{Lang::get("message.Gui_mail_thanh_cong")}}!.
                    </div>
                    <div class="alert alert-danger alert-dismissable hide">
                        <i class="icon fa fa-ban"></i>  <span id="err">{{Lang::get("message.Co_loi_xay_ra_khi_gui_mail")}}!</span>
                    </div>

                </div>
                </form>
            <div class="l3loading hide">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="errEmail"></div>
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('txtEmailContent' ,{
            removeButtons: 'Source',
            removePlugins:'save,print,preview,find,about,maximize,showblocks,elementspath,spellchecker',
            resize_enabled: false
            // The rest of options...
        } );
    });

    $("#mPopUpSendMail").on('submit','#frmmPopUpSendMail', function (e) {
        e.preventDefault();
        $("#mPopUpSendMail").find(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: "{{url("SendMail")}}",
            data : $("#frmmPopUpSendMail").serialize(),
            success: function (data) {
                $("#mPopUpSendMail").find(".l3loading").addClass('hide');
                if(data==1) {
                    closePopSendMail();
                }
                else {
                    $("#mPopUpSendMail").find(".alert-success").addClass('hide');
                    $("#errEmail").html(data);
                    console.log(data);
                    $("#errEmail").find("#mPopUp").modal('show');
                }
            }
        });
    });
    var closePopSendMail= function () {
        $("#mPopUpSendMail").modal('hide');
        //$("#mPopUpSendMail").parent().html("");
        $("#mPopUpSendMail").find(".alert-danger").addClass('hide');
        $("#mPopUpSendMail").find(".alert-success").addClass('hide');
    };
</script>