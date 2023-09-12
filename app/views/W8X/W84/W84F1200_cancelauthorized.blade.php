<div class="row" >
    <div class="col-md-6">
        <label class="mgr15"><i class="fa fa-calendar mgr5"></i><b>{{date('d/m/Y H:i',strtotime($rs['ValidTimeTo']))}} </b></label>
    </div>

    <div class="col-md-6">
        <label class="mgr15" style="font-weight: normal  !important;">{{Helpers::getRS($g,"Nguoi_thuc_hien")}}</label>
        <label class="mgr"><b>{{$rs['CancelUserName']}}</b></label>
    </div>
    <div class="col-md-2">
        <label  style="font-weight: normal  !important;">{{Helpers::getRS($g,"Ly_do_huy")}}</label>

    </div>
    <div class="col-md-10">
        <textarea class="form-control" rows="2" id="CancelNotesU">{{$rs['CancelNotesU']}}</textarea>
    </div>

    @if($mod==0)
    <div class="col-md-12 mgt10">
        <button type="button" id="frm_btnCancelCancelAuthorize"  class="btn btn-default smallbtn pull-right confirmation-NotCancelAuthorize"><span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}</button>
        <button type="button"   id="frm_btnSave" class="btn btn-default smallbtn pull-right mgr10 confirmation-SaveCancelAuthorize"><span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}</button>

    </div>
    @endif
    <div class="col-md-12 mgt10">
     </div>

</div>
<script type="text/javascript">
    $('.confirmation-SaveCancelAuthorize').confirmation({
        placement : 'left',
        btnOkLabel : '{{Helpers::getRS($g,'Dong_y')}}',
        btnCancelLabel : '{{Helpers::getRS($g,'Huy')}}',
        title: "{{Helpers::getRS($g,"Ban_co_muon_luu_huy_uy_quyen_duyet")}}",
        onConfirm: function() { ShowMaster(oldvouid) ;
            SaveCancelAuthorize();
        },
        onCancel: function() { }
    });
    $('.confirmation-NotCancelAuthorize').confirmation({
        placement : 'left',
        btnOkLabel : '{{Helpers::getRS($g,'Dong_y')}}',
        btnCancelLabel : '{{Helpers::getRS($g,'Huy')}}',
        title: "{{Helpers::getRS($g,"Ban_co_muon_khong_luu_du_lieu_nay_khong")}}",
        onConfirm: function() { ShowMaster(oldvouid) ;
            closeCancelAuthorize();
        },
        onCancel: function() { }
    });
    var SaveCancelAuthorize= function() {
        $("#mPopUpCancelAuthorize .l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}" ,
            data: {ValidTimeTo: '{{date('m/d/Y h:i:s',strtotime($rs['ValidTimeTo']))}}', CancelNotesU: $("#CancelNotesU").val(), CancelUserID: '{{$rs['CancelUserID']}}'},
            success: function (result) {
                $("#mPopUpCancelAuthorize .l3loading").addClass('hide');
                if(result==1) {
                    save_ok(null,null,"{{Helpers::getRS($g,"Huy_uy_quyen_thanh_cong")}}");
                    //alert_custom(icon_success,"{{Helpers::getRS($g,"Huy_uy_quyen_thanh_cong")}}",true,no,null,null,null);
                    $("#modalW84F1200 #frm_btadd").removeClass('disabled');
                    $("#modalW84F1200 #frm_Save").addClass('disabled');
                    $("#modalW84F1200 #frm_btnCancel").addClass('disabled');
                    $("#btnNUQ").addClass('hide');
                    $("#btnNDUQ").addClass('hide');
                    $("#Transaction").prop("disabled", true);
                    $("#modalW84F1200 #txtreason").prop("readonly", true);

                    addTableW84F1200();
                    closeCancelAuthorize();
                    $(".no-menu-alert").load("{{url("/alert")}}");
                }
                else {
                    alert_warning(msg);
                }

            }
        });


    };
</script>