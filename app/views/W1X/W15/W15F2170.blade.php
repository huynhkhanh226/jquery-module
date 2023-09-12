<div class="modal fade pd0" id="modalW15F2170" data-backdrop="static" role="dialog">
    <div class="modal-dialog  modal-lg formduyet">
        <div class="modal-content" style="overflow-y: auto;overflow-x: hidden">
            <div class="modal-header">
                {{Helpers::generateHeadingApp($modalTitle,"W15F2170","",$pForm,"W15F2170")}}
            </div>
            <div class="modal-body" style="padding: 0px 3px">
                <div class="row" style="margin-left: 0px; margin-right: 0px;margin-top: 2px;">
                    <div id="leftMenu" class="col-md-3" style="padding: 0px 3px 0px 0px;">
                        <div class="row"
                             style="margin-left: 0px; margin-right: 0px;width:100%;background-color: #1c2d3f;border-radius: 4px">
                            <div class="col-md-12" style="padding-top: 5px;">
                                <div class="row" id="lefthead_W15F2170">
                                    <div class="col-md-6">
                                        {{ Form::select("slduyet", $AppStatus ,0,["class" => "pecent-100", "id" => "slduyet"])}}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::select("sldate", $Time ,0,["class" => "pecent-100 pull-right", "id" => "sldate"])}}
                                    </div>
                                </div>
                                <div class="row mgt10">
                                    <div class="col-md-12">
                                        <div class="scrollable" id="tbW15F2170">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="rightContent" class="col-md-9" style="padding-left:0px;padding-right: 0px">
                        <div class="row" style="margin-left: 0px; margin-right: 0px;">
                            <div class="col-md-12 ">
                                <div class="masterDuyet">
                                    <div class="row">
                                        <div class="col-md-12 empployeeW15 hide">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 3px;">
                                        <div class="col-md-12 listDuyetW15 hide">
                                        </div>

                                    </div>
                                </div>
                                 <div class="row" >
                                    <div class="col-md-12 pdr0">
                                    <button type="button" id="btnSaveW15F2170"
                                                class="btn btn-default smallbtn pull-right hide"
                                                onclick="approveMultiLeave()"
                                                ><span
                                                    class="glyphicon glyphicon-floppy-saved mgr5"></span>{{Helpers::getRS($g,"Luu")}}
                                        </button>
                                     <button type="button" id="btnExcelW15F2170" onclick="popupexcel()" style="margin-right: 4px" class="btn btn-default smallbtn pull-right mgl10"><span class="fa fa-file-excel-o"></span>
                                                                                                                &nbsp;{{Helpers::getRS($g,"Xuat_Excel_U")}}</button>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-12 dtformduyet pdl5 pdr5 hide">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal draggable fade" id="mPopUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @define $mPopUpTitle = Helpers::getRS($g,"Thong_baoU")
                {{Helpers::generateHeading($mPopUpTitle,"W15F2170",false,"closePop")}}
            </div>
            <div class="modal-body" style="background: #fff; float: left; width: 100%; padding-bottom: 5px;">
            </div>
        </div>
    </div>
</div>
<div id="emailPOP"></div>
<div id ="popupexcel"></div>

<script type="text/javascript">
    function popupexcel(){
         $.ajax({
            method: "POST",
            url: "{{url("/W15F2170/loadpopupExcel")}}",
            data: {key: $},
            success: function(data){
                 $("#popupexcel").html('');
                 $("#popupexcel").html(data);
                 $("#modalexportEXCEL").modal('show');
            }
         });

    }
    $(function () {
        //$("#modalW15F2170").find(".modal-body").height(documentHeight - 60)
        scroll();
    });
    $(window).resize(function () {
        scroll();
    });
    /*    $(".pdl25percent").resize(function () {
     scroll();
     });*/
    function scroll() {
        $('.scrollable').slimScroll({
            //height:$("#modalW15F2170").find(".modal-body").height() - 46 //$('#modalW15F2170').find(".modal-content").height()
            //height: $(document).height() - 126
            height: $("#modalW15F2170").find(".modal-content").height() - 88
        });
    }



    var isClick = 0;
    /*    function resizePqGridW15F2170(addWidth,pggird) {
     var width = $(pggird).pqGrid("option", "width");
     $(pggird).pqGrid({width: addWidth});
     $(pggird).pqGrid("refresh");
     }*/
    $("#modalW15F2170").find("#btnCollapse").click(function () {
        if (isClick == 0) {
            isClick = 1;
            $("#modalW15F2170").find("#leftMenu").hide();
            $("#modalW15F2170").find("#leftMenu").removeClass("col-md-3");
            $("#modalW15F2170").find("#rightContent").removeClass("col-md-9");
            $("#modalW15F2170").find("#rightContent").addClass("col-md-12");
        }
        else {
            isClick = 0;
            $("#modalW15F2170").find("#leftMenu").show();
            $("#modalW15F2170").find("#leftMenu").addClass("col-md-3");
            $("#modalW15F2170").find("#rightContent").removeClass("col-md-12");
            $("#modalW15F2170").find("#rightContent").addClass("col-md-9");
        }

        /*resizePqGridW15F2170($("#rightContent").width()- 30,"#pgrid_tabW15F2170_1_") ;
         resizePqGridW15F2170($("#rightContent").width() - 30,"#pgrid_tabW15F2170_2_") ;
         resizePqGridW15F2170($("#rightContent").width()- 30,"#pgrid_tabW15F2170_3_") ;
         resizePqGridW15F2170($("#rightContent").width(),"#gridListApproval") ;*/

        setTimeout(function () {
            $("#gridListApproval").pqGrid("refresh");
            $("#pgrid_tabW15F2170_1_").pqGrid("refresh");
            $("#pgrid_tabW15F2170_2_").pqGrid("refresh");
            $("#pgrid_tabW15F2170_3_").pqGrid("refresh");
        }, 200);
    });
    $("#tbW15F2170").on('click', '>div', function () {
        if (index == $(this).index() && irefesh == 0) {

        }
        else {
            $("#modalW27F2240").find(".l3loading").removeClass('hide');
            $("#tbW15F2170").find(">div").eq(index).removeClass('nm');
            //$("#tbW15F2170").find(">div").eq(index).find(".width15pc").addClass('hide');
            index = $(this).index();
            $("#tbW15F2170").find('>div').removeClass('active');
            $(this).addClass("active");
            //$(this).find('.width15pc').removeClass('hide');
            $(".l3loading").removeClass('hide');
            visibleControls();

            $.ajax({
                method: "GET",
                url: $(this).find("input").eq(0).val(),
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    $("#modalW15F2170").find(".empployeeW15").html(data);
                    $("#modalW15F2170").find(".empployeeW15").removeClass('hide');
                    //$("#btnSaveW15F2170").removeClass('hide');
                }
            });
            $.ajax({
                method: "GET",
                url: $(this).find("input").eq(1).val(),
                success: function (data) {
                    //$(".l3loading").addClass('hide');

                    $("#modalW15F2170").find(".listDuyetW15").html(data);
                    $("#modalW15F2170").find(".listDuyetW15").removeClass('hide');


                }
            });

            $.ajax({
                method: "GET",
                url: $(this).find("input").eq(2).val(),
                success: function (data) {
                    console.log(data);
                    //$(".l3loading").addClass('hide');
                    $("#modalW15F2170").find(".dtformduyet").html(data);
                    $("#modalW15F2170").find(".modalW15F2170").removeClass('hide');
                }
            });
            $(this).addClass('nm');

        }

    });

    var index = -1;
    $("#lefthead_W15F2170").find("select").change(function () {
        if (irefesh == 0) index = -1;
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {isApproval: $("#slduyet").val(), FromTo: $("#sldate").val()},
            success: function (data) {
                $("#tbW15F2170").html(data);
                if ($("#tbW15F2170").find("div").size() > 0) {
                    if (index >= $("#tbW15F2170").find("div").size())
                        index = $("#tbW15F2170").find("div").size() - 1;
                    if (irefesh == 0) {
                        var id = "{{$id}}";
                        if (id == "") {
                            $("#tbW15F2170").find("div").eq(0).trigger("click");
                        }
                        else {
                            var idx = $("#tbW15F2170").find("label#lb" + "{{$id}}").parent().index();
                            $("#tbW15F2170").find("div").eq(idx).trigger("click");
                        }
                    }
                    else
                        $("#tbW15F2170").find("div").eq(index).trigger("click");
                    $("#modalW15F2170").find(".empployeeW15").removeClass('hide');
                }
                else {
                    $("#modalW15F2170").find(".empployeeW15").addClass('hide');
                    $("#modalW15F2170").find(".dtformduyet").html("");
                    $("#modalW15F2170").find(".listDuyetW15").html("");

                    visibleControls();
                }
                irefesh = 0;


            }
        });
    });


    function visibleControls() {
        if ($("#tbW15F2170").html() == "") { //tr??ng h?p ch?a có nhân vien nào ??ng ký ngh? phép
            //$('#modalW15F2170').find("#btnSave").addClass("hide");
            $('#modalW15F2170').find(".listDuyetW15").addClass("hide");
            $('#modalW15F2170').find(".dtformduyet").addClass("hide");
            //$("#modalW15F2170").find(".masterDuyet").hide();
            $("#btnSaveW15F2170").addClass('hide');
        } else {
            //$('#modalW15F2170').find("#btnSave").removeClass("hide");
            $('#modalW15F2170').find(".listDuyetW15").removeClass("hide");
            $('#modalW15F2170').find(".dtformduyet").removeClass("hide");
            $("#btnSaveW15F2170").removeClass('hide');
            //$("#modalW15F2170").find(".masterDuyet").show();
        }
        /*if ($("#slduyet").val() == 0 || $("#slduyet").val() == 5){//tr??ng h?p ch?a duy?t thì  sáng
         $('#modalW15F2170').find("#btnSave").removeClass("hide");
         }else{
         $('#modalW15F2170').find("#btnSave").addClass("hide");
         }*/
    }

    function approveMultiLeave() {
        $("#gridListApproval").pqGrid("saveEditCell");
        $("#gridListApproval").pqGrid("quitEditMode");
        console.log("get data");
        var obj = $("#gridListApproval").pqGrid("option", "dataModel.data");
        console.log(obj);
        //Không biết đoạn code này dùng để làm gì nên rem lại
        var bAllowSave = false;
        for (var i = 0; i < obj.length; i++) {
            if (Number(obj[i]["Approval"]) == 1 || Number(obj[i]["NotApproval"]) == 1)
                bAllowSave = true;
        }

        if (bAllowSave) {
            $(".l3loading").removeClass('hide');
            $.ajax({
                        method: "POST",
                        url: '{{url("/W15F2170/saveapprove")}}',
                        data: {
                            obj: obj
                        },
                        success: function (data) {
                            $(".l3loading").addClass('hide');
                            $("#mPopUpApprove").modal('hide');
                            $("#emailPOP").html("");
                            //--------------------------
                            var result = $.parseJSON(data);
                            console.log(result);
                            switch (result.Status) {
                                case 0: //Kiem tra tuoc khi luu khong thoa
                                    alert_warning(result.message);
                                    break;
                                case 1: //Gui mail ngam
                                    if (result.message != undefined && result.message != "")
                                        alert_error(result.message);
                                    else
                                        $("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4>  <i class='fa fa-chevron-circle-down' ></i> {{Helpers::getRS($g,"Phieu_chung_tu_da_duoc_duyet")}}</h4>");
                                    $("#mPopUp").modal('show');
                                    break;
                                case 2://Show man hinh sendmail
                                    $("#emailPOP").html(result.rsvalue);
                                    $("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4><i class='fa fa-chevron-circle-down' ></i>{{Helpers::getRS($g,"Phieu_chung_tu_da_duoc_duyet")}}</h4></div><div class='col-md-12 alert-success-approve'><button onclick='showPopupEmail();'  type='button' class='btn btn-default'' ><i class='fa fa-envelope'></i>{{Helpers::getRS($g,"Gui_mail")}}</button></div>");
                                    $("#mPopUp").modal("show");
                                    break;
                                case 3://Luu nhung khong gui mail
                                    $("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4>  <i class='fa fa-chevron-circle-down' ></i> {{Helpers::getRS($g,"Phieu_chung_tu_da_duoc_duyet")}}</h4>");
                                    $("#mPopUp").modal('show');
                                    break;
                                case 4:
                                    //alert_error(result.message);
                                    save_not_ok();
                                default :
                                //Do not nothing
                            }

                        }
                    }
            );
        } else {
            alert_warning('{{Helpers::getRS(4,"Vui_long_chon_du_lieu_tren_luoi")}}');
        }

    }


    var irefesh = 0;
    var refresh = function () {
        irefesh = 1;
        $("#slduyet").val($("#slduyet").val()).trigger('change');
    };
    $(document).ready(function () {
        $('#lefthead_W15F2170').find('#slduyet')
                .val({{$isApproval}})
                .trigger('change');
        //$wd= $("#modalW15F2170").width() * 0.25;

    });
    var showPopupEmail = function () {
        $("#emailPOP").find("#mPopUpSendMail").modal('show');
        //$("#mPopUp").modal('hide');
    };
    var closePop = function () {
        $("#mPopUp").modal('hide');
        $(".no-menu-alert").load("{{url("/alert")}}");
        refresh();
    };
</script>

