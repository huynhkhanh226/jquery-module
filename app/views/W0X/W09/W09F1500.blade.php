<div class="modal fade pd0" id="modalW09F1500" data-backdrop="static" role="dialog">
    <div class="modal-dialog  modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeadingApp($modalTitle,"W09F1500")}}
            </div>
            <div class="modal-body">
                <div class="row" style="margin-left: -20px">
                    <div class="col-md-12 pdl25percent pdr5">
                        <section id="secDetailW09F1500"></section>
                    </div>
                </div>
            </div>
            <div class="leftFormDuyet">
                <div class="col-md-12 ">
                    <div class="row" id="lefthead_W09F1500">
                        <div class="col-md-7">
                            {{ Form::select("slFieldName", $search ,0,["class" => "col-md-12 form-control", "id" => "slFieldName"])}}
                        </div>
                        <div class="col-md-5">
                            <input type="button" id="btnFilterW09F1500" value="{{Helpers::getRS($g,"Loc")}}" class="col-md-12 btn btn-block smallbtn">
                        </div>
                    </div>
                    <div class="row mgt10">
                        <div class="col-md-12">
                            <div class="scrollable" id="tbW09F1500">


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
    var index=-1;
    var urlload = "";
    $(window).resize(function () {
        scroll();
    });
    $(".pdl25percent").resize(function () {
        scroll();
    });
    function scroll() {
        $('.scrollable').slimScroll({
            height: $('#modalW09F1500').height() - 106
        });
    }

    $("#btnFilterW09F1500").click(function () {
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {field: $("#slFieldName").val()},
            success: function (data) {
                $("#tbW09F1500").html(data);
                if ($("#tbW09F1500").find("div").size() > 0) {
                    $("#tbW09F1500").find("div").eq(0).trigger("click");
                }
                else {
                    $("#modalW09F1500").find(".dtformduyet").html("");
                    $("#modalW09F1500").find(".listDuyet").html("");
                }
            }
        });
        index=-1;
    });
    $("#tbW09F1500").on('click','>div', function () {
        if(index!=$(this).index()) {
            var urlload = $(this).find("input").eq(0).val();
            $("#modalW09F1500").find(".l3loading").removeClass('hide');
            $("#tbW09F1500").find(">div").eq(index).removeClass('nm');
            $("#tbW09F1500").find(">div").eq(index).find(".width15pc").addClass('hide');
            index=$(this).index();
            $("#tbW09F1500").find('>div').removeClass('active');
            $(this).addClass("active");
            $(this).find('.width15pc').removeClass('hide');
            $.ajax({
                method: "GET",
                url: urlload,
                success: function (data) {
                    $("#modalW09F1500").find("#secDetailW09F1500").html(data);
                    $("#modalW09F1500").find(".l3loading").addClass('hide');
                }
            });
            $(this).addClass('nm');
        }
    });

    var isClick=0;
    $("#modalW09F1500").find("#btnCollapse").click(function() {
        if(isClick==0) {
            isClick=1;
            $(".leftFormDuyet").hide();
            $(".pdl25percent").css("paddingLeft","36px");
        }
        else {
            $(".leftFormDuyet").show();
            isClick=0;
            $(".pdl25percent").css("paddingLeft","28%");
        }
        $("#pqgrid_W09F1500").pqGrid("refreshDataAndView");
    });

    $(function(){
        scroll();
        $("#btnFilterW09F1500").trigger("click");
    });
</script>

