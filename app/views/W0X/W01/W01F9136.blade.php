<div class="modal fade pd0" id="modalW01F9136" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeadingApp($modalTitle,"W01F9136","",$pForm,"W01F9136")}}
            </div>
            <div class="modal-body">
                <div class="row bodyApp">
                    <div id="leftMenu" class="col-md-3 leftListApp">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row" id="lefthead_W01F9136">
                                    <div class="col-md-7">
                                        {{Form::select("slduyet", $sfilter, 0 , ["class" => "form-control", "id" => "slduyet"])}}
                                    </div>
                                    <div class="col-md-5 pdl0">
                                        {{
                                        Form::select("sldate",
                                        [0 =>Helpers::getRS($g,"Tat_ca_Web"), 1 => Helpers::getRS($g,"Tuan_nay") , 2 => Helpers::getRS($g,"Thang_nay" ), 3 => Helpers::getRS($g,"Nam_nay" )],0,
                                        ["class" => "form-control", "id" => "sldate"])
                                        }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mgt5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                            <input type="text" class="form-control" id="txtfilter" name="txtfilter">
                                            <span class="input-group-addon hide" onclick='$("#txtfilter").trigger({type: "keyup", which: 27});' id="cleartext"
                                                style="padding-left: 2px !important; padding-right: 2px !important; border: 1px #3c8dbc solid; border-left:none; border-right: 1px #ccc solid; cursor: pointer"><i
                                            class="glyphicon glyphicon-remove-2" style="font-size: 10px;"></i></span>
                                            <span class="input-group-addon"><b id="sumRowLeft">0</b></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="row mgt10">
                                    <div class="col-md-12">
                                        <div class="scrollable" id="tbW01F9136">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="rightContent" class="col-md-9">
                        <div class="row rightContent hide">
                            <div class="col-md-12">
                                <div class="row empployeeW15">
                                    <div class="col-md-12">
                                        <div class="row mgt5">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Trang_thai_duyet")}}</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select id="slStatusID" name="slStatusID" class="form-control">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAppW01F9136" class="btn smallbtn bg-orange"><span class="glyphicon glyphicon-ok mgr10"></span>
                                                    {{Helpers::getRS($g,"Duyet")}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mgt10">
                                    <div class="col-md-12 dtformduyet">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="l3loading hide">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $(function () {
        $("#modalW01F9136").find(".modal-body").height($(document).height() - 85)
        scroll();
    });

    $(window).resize(function () {
        scroll();
    });



    $(".pdl25percent").resize(function () {
        scroll();
    });
    function scroll() {
        $('.scrollable').slimScroll({
            height: $("#modalW01F9136").find(".modal-body").height() - 52
        });
    }

    var index = -1;
    var $wd;
    $("#lefthead_W01F9136").find("select").change(function () {
        $("#modalW01F9136").find(".rightContent").addClass("hide");
        if (irefesh == 0)index = -1;
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {status: $("#slduyet").val(), FromTo: $("#sldate").val()},
            success: function (data) {
                $("#tbW01F9136").html(data);
                var count = $("#tbW01F9136").find(">div").size();
                $("#modalW01F9136").find("#sumRowLeft").text(count);
                if ($("#tbW01F9136").find("div").size() > 0) {
                    if (index >= $("#tbW01F9136").find("div").size())
                        index = $("#tbW01F9136").find("div").size() - 1;
                    if (irefesh == 0) {
                            $("#tbW01F9136").find("div").eq(0).trigger("click");
                    }
                    else
                        $("#tbW01F9136").find("di5v").eq(index).trigger("click");
                }
                else {
                    $("#modalW01F9136").find(".dtformduyet").html("");
                    $("#modalW01F9136").find(".listDuyetW15").html("");
                }
                irefesh = 0;
            }
        });
    });
    var isClick = 0;
    $("#modalW01F9136").find("#btnCollapse").click(function () {
        if (isClick == 0) {
            isClick = 1;
            $("#modalW01F9136").find("#rightContent").removeClass("col-md-9");
            $("#modalW01F9136").find("#rightContent").addClass("col-md-12");
            $("#modalW01F9136").find("#leftMenu").hide();
            $("#modalW01F9136").find("#leftMenu").removeClass("col-md-3");
        }
        else {
            isClick = 0;
            $("#modalW01F9136").find("#rightContent").removeClass("col-md-12");
            $("#modalW01F9136").find("#rightContent").addClass("col-md-9");
            $("#modalW01F9136").find("#leftMenu").show();
            $("#modalW01F9136").find("#leftMenu").addClass("col-md-3");
        }
        $("#pqgrid_W01F9136").pqGrid({width: $('.clsGridWidth').width()});
        $("#pqgrid_W01F9136").pqGrid({width: $('.clsGridWidth').width()});//phải set 2 lần do .clsGridWidth lấy ko kịp width
        $("#pqgrid_W01F9136").pqGrid('refresh');
    });

//    function resizePqGrid(mode) {
//        var width = $("#pqgrid_W01F9136").pqGrid("option", "width");
//        if (mode == 0)
//            $("#pqgrid_W01F9136").pqGrid({width: width + 320});
//        else
//            $("#pqgrid_W01F9136").pqGrid({width: width - 320});
//    }

    $("#tbW01F9136").on('click', '>div', function () {
        if (index == $(this).index() && irefesh == 0) {
        }
        else {
            $("#modalW01F9136").find(".l3loading").removeClass('hide');
            $("#tbW01F9136").find(">div").eq(index).removeClass('nm');
            $("#tbW01F9136").find(">div").eq(index).find(".width15pc").addClass('hide');
            index = $(this).index();
            $("#tbW01F9136").find('>div').removeClass('active');
            $(this).addClass("active");
            $(this).find('.width15pc').removeClass('hide');
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "GET",
                url: $(this).find("input").eq(0).val(),
                success: function (data) {
                    $("#modalW01F9136").find(".dtformduyet").html(data);
                    $(".l3loading").addClass('hide');
                }
            });
            $(this).addClass('nm');
        }

    });

    $("#modalW01F9136").on('keyup', "#txtfilter", function (e) {
        var code = e.keyCode || e.which;
        var firstClick = false;
        if (code == 13)
            firstClick = true;
        if (code == 27) {
            $(this).val('');
        }
        var vl = $(this).val();
        sum = 0;
        if (vl == '') {
            $(".leftRowView").show();
            sum = $(".leftRowView").length;
            $(this).css('borderRight', '1px #ccc solid');
            $("#cleartext").addClass('hide');
            $(this).focus();
        }
        else {
            $(this).css('borderRight', '0px #ccc solid');

            $("#cleartext").removeClass('hide');
            $(".leftRowView").each(function () {
                var desc = $(this).find('.width85pc').text();
                var descbodau = locdau(desc);
                var vlbodau = locdau(vl);
                if (desc.toLowerCase().indexOf(vl.toLowerCase()) > 0 || descbodau.indexOf(vlbodau) > 0) {
                    $(this).show();
                    if (firstClick) {
                        $(this).trigger('click');
                        firstClick = false;
                    }
                    sum++;
                }

                else $(this).hide();
            });
        }
        $("#sumRowLeft").text(sum);
        //}
    });

    var irefesh = 0;
    var refresh = function () {
        irefesh = 1;
        $("#slduyet").val($("#slduyet").val()).trigger('change');
    };

    $(document).ready(function () {
        $("#lefthead_W01F9136").find('#sldate').val(0).trigger('change');
        $wd = $("#modalW01F9136").width() * 0.25;
    });

</script>

