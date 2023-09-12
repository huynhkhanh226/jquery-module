<div class="modal fade pd0" id="modalW12F3004" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeadingApp($modalTitle,"W12F3004","",$pForm,"W12F3004")}}
            </div>
            <div class="modal-body">
                <div class="row bodyApp">
                    <div id="leftMenu" class="col-md-3 leftListApp">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row" id="lefthead_W12F3004">
                                    <div class="col-md-7">
                                        <select id="slStatus" class="form-control">
                                            @foreach($status as $row)
                                                <option value="{{$row["StatusID"]}}">{{$row["Description"]}}</option>
                                            @endforeach
                                        </select>
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
                                        <div class="scrollable" id="tbW12F3004">
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_duyet_yeu_cau")}}</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{Form::select("slEmployeeID",$employee,Session::get("W91P0000")['Creator'],["class"=>"form-control","id"=>"slEmployeeID"])}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Dien_giai")}}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" id="txtDescription" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mgt5">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Trang_thai_duyet")}}</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select id="slStatusID" class="form-control">
                                                            @foreach($status as $row)
                                                                <option value="{{$row["StatusID"]}}" {{$row["StatusID"]=="40"?"selected":""}}>{{$row["Description"]}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAppW12F3004" class="btn smallbtn bg-orange"><span class="glyphicon glyphicon-ok mgr10"></span>
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
        $("#modalW12F3004").find(".modal-body").height(documentHeight - 85)
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
            height: $("#modalW12F3004").find(".modal-body").height() - 52
        });
    }

    var index = -1;
    var $wd;
    $("#lefthead_W12F3004").find("select").change(function () {
        $("#modalW12F3004").find(".rightContent").addClass("hide");
        if (irefesh == 0)index = -1;
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {status: $("#slStatus").val(), FromTo: $("#sldate").val()},
            success: function (data) {
                $("#tbW12F3004").html(data);
                var count = $("#tbW12F3004").find(">div").size();
                $("#modalW12F3004").find("#sumRowLeft").text(count);
                if ($("#tbW12F3004").find("div").size() > 0) {
                    if (index >= $("#tbW12F3004").find("div").size())
                        index = $("#tbW12F3004").find("div").size() - 1;
                    if (irefesh == 0) {
                            $("#tbW12F3004").find("div").eq(0).trigger("click");
                    }
                    else
                        $("#tbW12F3004").find("di5v").eq(index).trigger("click");
                }
                else {
                    $("#modalW12F3004").find(".dtformduyet").html("");
                    $("#modalW12F3004").find(".listDuyetW15").html("");
                }
                irefesh = 0;
            }
        });
    });
    var isClick = 0;
    $("#modalW12F3004").find("#btnCollapse").click(function () {
        if (isClick == 0) {
            isClick = 1;
            $("#modalW12F3004").find("#rightContent").removeClass("col-md-9");
            $("#modalW12F3004").find("#rightContent").addClass("col-md-12");
            $("#modalW12F3004").find("#leftMenu").hide();
            $("#modalW12F3004").find("#leftMenu").removeClass("col-md-3");
        }
        else {
            isClick = 0;
            $("#modalW12F3004").find("#rightContent").removeClass("col-md-12");
            $("#modalW12F3004").find("#rightContent").addClass("col-md-9");
            $("#modalW12F3004").find("#leftMenu").show();
            $("#modalW12F3004").find("#leftMenu").addClass("col-md-3");
        }
        $("#pqgrid_W12F3004").pqGrid('refreshDataAndView');
    });

    $("#tbW12F3004").on('click', '>div', function () {
        if (index == $(this).index() && irefesh == 0) {
        }
        else {
            $("#modalW12F3004").find(".l3loading").removeClass('hide');
            $("#tbW12F3004").find(">div").eq(index).removeClass('nm');
            $("#tbW12F3004").find(">div").eq(index).find(".width15pc").addClass('hide');
            index = $(this).index();
            $("#tbW12F3004").find('>div').removeClass('active');
            $(this).addClass("active");
            $(this).find('.width15pc').removeClass('hide');
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "GET",
                url: $(this).find("input").eq(0).val(),
                success: function (data) {
                    $("#modalW12F3004").find(".dtformduyet").html(data);
                    $(".l3loading").addClass('hide');
                }
            });
            $(this).addClass('nm');
        }

    });

    $("#modalW12F3004").on('keyup', "#txtfilter", function (e) {
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
        $("#lefthead_W12F3004").find('#sldate').val(0).trigger('change');
        $wd = $("#modalW12F3004").width() * 0.25;
    });

</script>

