<div class="modal fade pd0" id="modalW09F4550" data-backdrop="static" role="dialog">
    <div class="modal-dialog  modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading($modalTitle,"W09F4550")}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 pdl25percent ">
                        <div class="row mgt10">
                            <div class="col-md-12 imgBirthday" style="padding: 0px !important;">
                                <img src="{{asset('packages/default/L3/images/W09F4550.jpg')}}" width="100%">
                            </div>
                        </div>
                        <div class="row mgt10">
                            <div class="col-md-12 empployee">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="leftFormDuyet">
                <div class="col-md-12 ">
                    <div class="row" id="lefthead_W09F4550">
                        <div class="col-md-7">
                            {{ Form::select("slDepartmentID", $department ,0,["class" => "col-md-12 form-control", "id" => "slDepartmentID"])}}
                        </div>
                        <div class="col-md-5">
                            <input type="button" id="btnFilterW09F4550" value="{{Helpers::getRS($g,"Loc")}}" class="form-control btn btn-block smallbtn">
                        </div>
                    </div>
                    <div class="row mgt10">
                        <div class="col-md-12">
                            <div class="scrollable" id="tbW09F4550">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="l3loading hide ">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    //Cancel all request of ajax
    var xhrPool = [];
    var abortAll = function () {
        $(xhrPool).each(function (idx, jqXHR) {
            jqXHR.abort();
        });
        xhrPool = [];
    };

    $.ajaxSetup({
        beforeSend: function (jqXHR) {
            xhrPool.push(jqXHR);
        },
        complete: function (jqXHR) {
            var index = xhrPool.indexOf(jqXHR);
            if (index > -1) {
                xhrPool.splice(index, 1);
            }
        }
    });
    //===============================

    $(function () {
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
            height: $('#modalW09F4550').height() - 106
        });
        $('.empployee').slimScroll({
            height: $('#modalW09F4550').height() - 308,
            width: '100%'
        });
    }

    $("#btnFilterW09F4550").click(function () {
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {dep: $("#slDepartmentID").val()},
            success: function (data) {
                $("#tbW09F4550").html(data);
                if ($("#tbW09F4550").find("div").size() > 0) {
                    $("#tbW09F4550").find("div").eq(0).trigger("click");
                }
                else {
                    $("#modalW09F4550").find(".dtformduyet").html("");
                    $("#modalW09F4550").find(".listDuyet").html("");
                }
            }
        });
        index = -1;
    });
    var index = -1;
    $("#tbW09F4550").on('click', '>div', function () {
        if (index != $(this).index()) {
            $("#modalW09F4550").find(".l3loading").removeClass('hide');
            $("#tbW09F4550").find(">div").eq(index).removeClass('nm');
            $("#tbW09F4550").find(">div").eq(index).find(".width15pc").addClass('hide');
            index = $(this).index();
            $("#tbW09F4550").find('>div').removeClass('active');
            $(this).addClass("active");
            $(this).find('.width15pc').removeClass('hide');
            $.ajax({
                method: "GET",
                url: $(this).find("input").eq(0).val(),
                success: function (data) {
                    $("#modalW09F4550").find(".empployee").html(data);
                    $("#modalW09F4550").find(".l3loading").addClass('hide');
                    $(".listEmpPic").each(function () {
                        var divpic = $(this);
                        reajax = $.ajax({
                            method: "POST",
                            url: '{{url("/W09F4550/getEmpPic")}}',
                            data: {id: divpic.attr("empid")},
                            success: function (result) {
                                divpic.html(result);
                            }
                        });
                    });
                }
            });
            $(this).addClass('nm');
        }
    });
    //    var isClick=0;
    //    $("#modalW09F4550").find("#btnCollapse").click(function() {
    //        if(isClick==0) {
    //            isClick=1;
    //            $(".leftFormDuyet").hide();
    //            $(".pdl25percent").css("paddingLeft","30px");
    //        }
    //        else {
    //            $(".leftFormDuyet").show();
    //            isClick=0;
    //            $(".pdl25percent").css("paddingLeft","28%");
    //        }
    //    });
</script>

