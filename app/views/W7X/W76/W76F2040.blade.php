<div class="modal draggable fade pd0" id="modalW76F2040" data-backdrop="static" role="dialog">
    <div class="W76F2040_loading hide">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div id="test" class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW76F2040">
                <div class="modal-header logodg pdl0">
                    {{Helpers::generateHeading($caption,"W76F2040",true,"",true,"D76F2040","W76F2040")}}
                </div>
                <div class="modal-body" style="padding: 10px">
                    <div class="row" style="padding-right: 8px">
                        <div class="col-md-9">
                            @if (Session::get($pFrom) > 1)
                                <button type="button" ID="btn_add" onclick="showW76F2040('');"
                                        class="btn btn-default smallbtn"><span class="glyphicon glyphicon-plus"
                                            style="padding-right: 5px"></span>{{Helpers::getRS($g,"Them_moi1")}}
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div id="tbl_content">

                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 0px;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkShowDisabledW76F2040" name="chkShowDisabledW76F2040" value="0"/>
                                {{Helpers::getRS($g,"Hien_thi_danh_muc_khong_su_dung")}}
                            </label>
                        </div>
                    </div>
                </div>
                <input type="submit" id="btn_submit" class="hidden"/>
            </form>
            <!-- /.end form  -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- div nay danh cho form D76F2011 -->
<div id="detail"></div>
<script type="text/javascript">
    $("#frmW76F2040").on("submit", function (e) {
        e.preventDefault();
        $(".W76F2040_loading").removeClass('hide');
        $("#gridW76F2040").html("");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW76F2040").serialize(),
            success: function (data) {
                $(".W76F2040_loading").addClass('hide');
                $("#tbl_content").html(data);
            }
        });
    });

    $("#frmW76F2040").on("change","#chkShowDisabledW76F2040", function (e) {
        filterDisabled("gridW76F2040", $("#chkShowDisabledW76F2040").is(":checked") ? "" : 0);
    });

    function showW76F2040(id) {
        $(".l3loading").removeClass('hide');
        $("#detail").html("");
        $.ajax({
            method: "GET",
            url: "W76F2041/{{$pFrom}}/{{$g}}/" + id,
            success: function (data) {
                $("#detail").html(data);
                $(".l3loading").addClass('hide');
                $("#modalAudioDetail").modal('show'); //Album anh
            }
        });
    }

    function deleteW76F2040(id) {
        ask_delete(function(){
            $("#gridW76F2040").pqGrid("showLoading");
            $.ajax({
                method: "DELETE",
                url: "{{Request::url()}}",
                data: {id:id},
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.bSaveOK) {
                        update4ParamGrid($("#gridW76F2040"), "", "delete");
                        $("#gridW76F2040").pqGrid("hideLoading");
                    }
                }
            });
        });
    }

    $("#modalW76F2040").on('shown.bs.modal', function() {
        $("#frmW76F2040").submit();
    });

</script>

