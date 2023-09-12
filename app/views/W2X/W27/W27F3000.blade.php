<div class="modal fade pd0" id="modalW27F3000" data-backdrop="static" role="dialog">
    <div class="modal-dialog  modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeadingApp($modalTitle,"W27F3000","","D27F3000", "W27F3000")}}
            </div>
            <div class="modal-body">
                <div class="row" style="margin-left: -20px;margin-right: -25px !important;">
                    <div class="col-md-12 pdl25percent">
                        <div class="row" id="divStatusW27F3000" style="margin-top: 3px">
                        </div>
                        <div id="divTopDiagramW27F3000" class="row mgt10 text-bold text-white hide"
                             style="background-color: #808080;"></div>
                        <div class="row" id="divDiagramW27F3000">
                        </div>
                    </div>
                </div>
            </div>
            <div class="leftFormDuyet">
                <div class="col-md-12 ">
                    <div class="row">
                        <label class="col-md-4 text-white text-center text-bold">{{Helpers::getRS($g,"Don_vi")}}</label>

                        <div class="col-md-8 pdl0">
                            <select id="slDivisionID" name="slDivisionID" class="col-md-12">
                                @foreach($div as $row)
                                    <option value="{{$row["DivisionID"]}}">{{$row["DivisionID"]}}
                                        - {{$row["DivisionName"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row hide" id="lefthead_W27F3000">
                        <div class="col-md-12 text-white text-center text-bold">
                            {{Helpers::getRS($g,"Du_an")}}
                        </div>
                    </div>
                    <div class="row mgt10">
                        <div class="col-md-12">
                            <div class="scrollable" id="tbW27F3000">
                                <div id="treeW27F3000">

                                </div>
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
<div id="divInfoW27F3000"></div>
<div id="divBookingW27F3000"></div>
<script type="text/javascript">
    $("#modalW27F3000").find("#slDivisionID").change(function (e) {
        $("#modalW27F3000").find("#divTopDiagramW27F3000").addClass("hide");
        $.ajax({
            method: "POST",
            url: '{{url("/W27F3000/".$pForm.'/'.$g)}}',
            data: {div: $("#slDivisionID").val()},
            success: function (response) {
                var json = response;
                {{--var json =''; '{{json_encode(array_values($tree))}}';--}}
                var tree = $('#treeW27F3000').treeview({
                    expandIcon: "fa fa-angle-left",
                    collapseIcon: "fa fa-angle-down",
                    data: json,
                    onNodeSelected: function (event, data) {
                        $("#modalW27F3000").find(".l3loading").removeClass("hide");
                        // Your logic goes here
                        $.ajax({
                            method: "POST",
                            url: '{{url("/W27F3000/status")}}' + '/' + $("#slDivisionID").val(),
                            data: data,
                            success: function (response) {
                                $("#divStatusW27F3000").html(response);
                            }
                        });
                        loadDiagram(data);
                    }
                });
            }
        });
    });

    $(function () {
        scroll();
        $("#modalW27F3000").find("#slDivisionID").trigger('change');
    });

    function loadDiagram(data) {
        //console.log(data);
        $.ajax({
            method: "POST",
            url: '{{url("/W27F3000/diagram")}}' + '/' + $("#slDivisionID").val(),
            data: data,
            success: function (response) {
                $("#divDiagramW27F3000").css("height", $("#tbW27F3000").height() - $("#divStatusW27F3000").height());
                if (response.indexOf("headerDiagram") != -1) {
                    $("#modalW27F3000").find("#divTopDiagramW27F3000").removeClass("hide");
                }
                $("#divDiagramW27F3000").html(response);
                $("#modalW27F3000").find(".l3loading").addClass("hide");
            }
        });
    }
    $(window).resize(function () {
        scroll();
    });
    $(".pdl25percent").resize(function () {
        scroll();
    });
    function scroll() {
        $('.scrollable').slimScroll({
            height: $('#modalW27F3000').height() - 105
        });
    }
    var isClick = 0;
    $(document).ready(function () {
        $("#modalW27F3000").find("#btnCollapse").click(function () {
            if (isClick == 0) {
                isClick = 1;
                $(".leftFormDuyet").hide();
                $(".pdl25percent").css("paddingLeft", "35px");
            }
            else {
                $(".leftFormDuyet").show();
                isClick = 0;
                $(".pdl25percent").css("paddingLeft", "28%");
            }
        });
    });

    $("#divDiagramW27F3000").on("click", ".office>a", function () {
        $("#modalW27F3000").find(".l3loading").removeClass("hide");
        var mode = $(this).attr("mode");
        var offno = $(this).attr("offno");
        var pro = $(this).attr("proid");
        if (mode == "0") {
            $.ajax({
                method: "POST",
                url: '{{url("/W27F3000/show/0")}}',
                data: {offno: offno, proid: pro, div: +$("#slDivisionID").val()},
                success: function (response) {
                    $("#divInfoW27F3000").html(response);
                    $("#modalInfoW27F3000").modal("show");
                    $("#modalW27F3000").find(".l3loading").addClass("hide");
                }
            });
        }
        else if (mode == 1) {
            $.ajax({
                method: "POST",
                url: '{{url("/W27F3000/show/2")}}',
                data: {offno: offno, proid: pro},
                success: function (response) {
                    if (response == "0") {
                        $.ajax({
                            method: "POST",
                            url: '{{url("/W27F3000/show/1")}}',
                            data: {offno: offno, proid: pro, div: +$("#slDivisionID").val()},
                            success: function (response) {
                                $("#divBookingW27F3000").html(response);
                                $("#modalBookingW27F3000").modal("show");
                                $("#modalW27F3000").find(".l3loading").addClass("hide");
                            }
                        });
                    }
                    else {
                        $("#modalW27F3000").find(".l3loading").addClass("hide");
                        alert_warning(response);
                    }
                }
            });
        }
    });

    var closeBookingW27F3000Pop = function () {
        $("#modalBookingW27F3000").modal('hide');
        var node = $('#treeW27F3000').treeview('getSelected');
        if (node.length > 0) {
            loadDiagram(node[0]);
        }
    };

</script>

