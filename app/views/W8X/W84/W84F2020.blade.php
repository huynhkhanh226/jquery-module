<div class="modal fade pd0" id="modalW84F2020" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeadingApp($modalTitle,$cForm,"",$pForm,"W84F2020")}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 pdl25percent ">
                        <div class="row mgt10">
                            <div class="col-md-12 hdDetail duyetHH">

                            </div>
                        </div>
                        <div class="row mgt10" >
                            <div class="col-md-12 dtformduyet">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="leftFormDuyet">
                <div class="col-md-12 ">
                    <div class="row" id="lefthead_W84F2020">
                        <div class="col-md-12 ">
                            {{
                            Form::select("slduyet",
                            [0 =>Helpers::getRS($g,"Chua_duyetU"), 1 => Helpers::getRS($g,"Da_duyet") , 100 => Helpers::getRS($g,"Tu_choi" )], $ApprovalStatus ,
                            ["class" => "col-md-6", "id" => "slduyet"])
                            }}
                            {{
                            Form::select("sldate",
                            [0 =>Helpers::getRS($g,"Tat_ca_Web"), 1 => Helpers::getRS($g,"Tuan_nay") , 2 => Helpers::getRS($g,"Thang_nay" ), 3 => Helpers::getRS($g,"Nam_nay" )],0,
                            ["class" => "col-md-5 pull-right", "id" => "sldate"])
                            }}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mgt5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" class="form-control" id="txtfilter" name="txtfilter">
                                <span class="input-group-addon hide" onclick='$("#txtfilter").trigger({type: "keyup", which: 27});' id="cleartext" style="padding-left: 2px !important; padding-right: 2px !important; border: 1px #3c8dbc solid; border-left:none; border-right: 1px #ccc solid; cursor: pointer"><i class="glyphicon glyphicon-remove-2" style="font-size: 10px;"></i></span>
                                <span class="input-group-addon"><b id="sumRowLeft">0</b></span>
                            </div>

                        </div>
                    </div>
                    <div class="row mgt10">
                        <div class="col-md-12">
                            <div class="scrollable" id="tbListVoucherW84F2020">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="l3loading hide ">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="newmailPOP">
    @include('layout.sendmail')
</div>
<script type="text/javascript">
    $(window).resize(function () {
        scroll();
    });
    $(".pdl25percent").resize(function () {
        scroll();
    });
    function scroll() {
        $('.scrollable').slimScroll({
            height: $("#modalW84F2020 .modal-content").height() - 117
        });
    }
    $("#modalW84F2020").on('keyup',"#txtfilter", function (e) {
        var code = e.keyCode || e.which;
        var firstClick=false;
        if(code==13)
            firstClick=true;
        if(code==27) {
            $(this).val('');
        }
        var vl=$(this).val();
        sum=0;
        if(vl=='') {
            $(".leftRowView").show();
            sum=$(".leftRowView").length;
            $(this).css('borderRight','1px #ccc solid');
            $("#cleartext").addClass('hide');
            $(this).focus();
        }
        else {
            $(this).css('borderRight','0px #ccc solid');

            $("#cleartext").removeClass('hide');
            $(".leftRowView").each(function () {
                var desc= $(this).find('.width85pc').text();
                var descbodau= locdau(desc);
                var vlbodau= locdau(vl);
                if(desc.toLowerCase().indexOf(vl.toLowerCase())>0 || descbodau.indexOf(vlbodau) > 0) {
                    $(this).show();
                    if(firstClick) {
                        $(this).trigger('click');
                        firstClick=false;
                    }
                    sum++;
                }

                else $(this).hide();
            });
        }
        $("#sumRowLeft").text(sum);
        //}
    });
    var index=-1;
    $("#lefthead_W84F2020").find("select").change(function (e) {
        index=-1;
		console.log("{{Request::url()}}");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {isApproval: $("#slduyet").val(), FromTo: $("#sldate").val()},
            success: function (data) {
                $("#tbListVoucherW84F2020").html(data);
                var count= $("#tbListVoucherW84F2020").find(">div").size();

                $("#modalW84F2020").find("#sumRowLeft").text(count);
                $("#modalW84F2020").find("#txtfilter").val('').css('borderRight','1px #ccc solid').focus();
                $("#cleartext").addClass('hide');
                if(count>0)
                    @if($key1!=null)
                        $("#tbListVoucherW84F2020").find('div#vid{{$key1}}').trigger("click");
                        @else
                         $("#tbListVoucherW84F2020").find("div").eq(0).trigger("click");
                        @endif
                    else {
                        $("#modalW84F2020").find(".dtformduyet").html("");
                        $("#modalW84F2020").find(".duyetHH").html("");
                }
            }
        });
    });
    var isClick=0;
    var $wd;

    $("#modalW84F2020").find("#btnCollapse").click(function() {
        if(isClick==0) {
            isClick=1;
            $(".leftFormDuyet").hide();
            $(".pdl25percent").css("paddingLeft","33px");
        }
        else {
            $(".leftFormDuyet").show();
            isClick=0;
            $(".pdl25percent").css("paddingLeft","28%");
        }
        $("#pqgrid_{{$cForm}}").pqGrid("refreshDataAndView");
    });

    $("#tbListVoucherW84F2020").on('click','>div', function () {
        if(index==$(this).index()) {

        }
        else {
            $("#modalW84F2020 .dtformduyet").getNiceScroll().remove();
            $("#modalW84F2020").find(".l3loading").removeClass('hide');
            $("#tbListVoucherW84F2020").find(">div").eq(index).removeClass('nm');
            $("#tbListVoucherW84F2020").find(">div").eq(index).find(".width15pc").addClass('hide');
            index=$(this).index();
            $("#tbListVoucherW84F2020").find('>div').removeClass('active');
            $(this).addClass("active");
            $(this).find('.width15pc').removeClass('hide');
            //Goi store chi tiet
            //getCurrentVoucherID được viết bên listvoucher.blade.php
            ////getCurrentVoucherID dùng để lấy voucher hiện được click
            $.ajax({
                method: "post",
                url: $(this).find("input").eq(0).val(),
                data: $.param(getCurrentVoucherID()),
                success: function (data) {
                    $("#modalW84F2020").find(".dtformduyet").html(data);
                    $("#modalW84F2020 .dtformduyet").niceScroll({
                        autohidemode: true,
                        cursorwidth: "7px"
                    });
                }
            });
            $.ajax({
                method: "GET",
                url: $(this).find("input").eq(1).val(),
                success: function (data) {
                    $("#modalW84F2020").find(".duyetHH").html(data);
                    $("#modalW84F2020").find(".l3loading").addClass('hide');
                }
            });
            $(this).addClass('nm');
        }
    });
    var refresh=function() {
        $("#slduyet").val($("#slduyet").val()).trigger('change');
    };

    $(document).ready(function () {
        $("#lefthead_W84F2020").find('#sldate').val(0).trigger('change');
        $("#modalW84F2020 .dtformduyet").css("height", $("#modalW84F2020 .modal-content").height()- 110);
        scroll();
        $wd= $("#modalW84F2020").width() * 0.25;
    });

    $("#modalW84F2020").on('hide.bs.modal', function() {
        $("#modalW84F2020 .dtformduyet").getNiceScroll().remove();
    });

    var leftshowsendmail=function(from,to,title,body,cc,bcc,isshow) {
        $("#mPopUpSendMail").find("#hdFrom").val(from);
        $("#mPopUpSendMail").find("#txtEmailReceivedAddress").val(to);
        $("#mPopUpSendMail").find("#txtEmailTitle").val(title);
        $("#mPopUpSendMail").find("#txtEmailCCAddress").val(cc);
        $("#mPopUpSendMail").find("#txtEmailBCCAddress").val(bcc);
        $("#mPopUpSendMail").find("#txtEmailContent").html(body);
        CKEDITOR.instances.txtEmailContent.setData(body);
        if (isshow!=0)
            $("#newmailPOP").find("#mPopUpSendMail").modal('show');
    };

</script>