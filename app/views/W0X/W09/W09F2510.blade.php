<div class="modal fade pd0" id="modalW09F2510" data-backdrop="static" role="dialog">
    <div class="modal-dialog  modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeadingApp($modalTitle,"W09F2510")}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 pdl25percent ">
                        <div class="row">
                            <div class="col-md-12" id="appInfo"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-xs-4 mgt5" style="margin-left: -15px">
                                <button class="btn btn-block btn-primary btn-xs hide" id="btnHistoryW09"
                                        onclick="showHistoryW09();">{{Helpers::getRS($g,"Lich_su")}}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="appHistoryW09" style="margin:0;padding: 0;display:none">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="leftFormDuyet">
                <div class="col-md-12 ">
                    <div class="row" id="lefthead_W09F2510">
                        <div class="col-md-12 ">
                            {{ Form::select("slduyet", $AppStatus ,0,["class" => "col-md-6", "id" => "slduyet"])}}
                            {{Form::select("sldate", $Time ,0,["class" => "col-md-5 pull-right pdl0 pdr0", "id" => "sldate"])}}

                        </div>
                    </div>
                    <div class="row mgt10">
                        <div class="col-md-12">
                            <div class="scrollable" id="tbW09F2510">


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
<script type="text/javascript">
    $(function(){
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
            height: $('#modalW09F2510').height() - 104
        });
        $('.listDuyet').slimScroll({
            height: 200,
            width: '100%'
        });
    }
    var index=-1;
    $("#lefthead_W09F2510").find("select").change(function () {
        index=-1;
        $("#modalW09F2510").find(".l3loading").removeClass("hide");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {isApproval: $("#slduyet").val(), FromTo: $("#sldate").val()},
            success: function (data) {
                $("#tbW09F2510").html(data);
                if($("#tbW09F2510").find("div").size()>0)
                    $("#tbW09F2510").find("div").eq(0).trigger("click");
                else {
                    $("#modalW09F2510").find("#appInfo").html("");
                    $("#modalW09F2510").find("#appHistoryW09").html("");
                }
                $("#modalW09F2510").find(".l3loading").addClass("hide");
            }
        });
    });
    var isClick=0;

    $("#modalW09F2510").find("#btnCollapse").click(function() {
        if(isClick==0) {
            isClick=1;
            $(".leftFormDuyet").hide();
            $(".pdl25percent").css("paddingLeft","30px");
        }
        else {
            $(".leftFormDuyet").show();
            isClick=0;
            $(".pdl25percent").css("paddingLeft","28%");
        }
        resizePqGridW09F2510();
    });
    $("#tbW09F2510").on('click','>div', function () {
        if(index!=$(this).index()) {
            $("#modalW09F2510").find(".l3loading").removeClass("hide");
            $("#tbW09F2510").find(">div").eq(index).removeClass('nm');
            $("#tbW09F2510").find(">div").eq(index).find(".width15pc").addClass('hide');
            index=$(this).index();
            $("#tbW09F2510").find('>div').removeClass('active');
            $(this).addClass("active");
            $(this).find('.width15pc').removeClass('hide');
            $.ajax({
                method: "GET",
                url: $(this).find("input").eq(0).val(),
                success: function (data) {
                    $("#modalW09F2510").find("#appInfo").html(data);
                    if($('#appHistoryW09').css('display') == 'none')
                        $("#modalW09F2510").find("#appHistoryW09").html("");
                    else
                        loadHistory();
                    $("#modalW09F2510").find(".l3loading").addClass('hide');
                    $("#btnHistoryW09").removeClass('hide');
                }
            });
        }
    });
    var refresh=function() {
        $("#slduyet").val($("#slduyet").val()).trigger('change');
    };
    $(document).ready(function () {
        $('#lefthead_W09F2510').find('#slduyet')
                .val($("#slduyet option:first").val())
                .trigger('change');

    });

    function showHistoryW09()
    {
        if ($('#appHistoryW09 > #tblhistoryW09F2510').length == 0)
            loadHistory();
        $("#appHistoryW09").animate({height: "toggle"});
    }

    function loadHistory()
    {
        var tran=$('.leftRowView.active').find('.transid').val();
        if (tran !=null && tran!="")
        {
            $.ajax({
                method: 'POST',
                url: '{{url("/W09F2510/history/")}}/'+tran,
                success: function (data) {
                    $("#appHistoryW09").html(data);
                }
            });
        }
    }
</script>

