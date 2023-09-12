<div class="modal draggable fade pd0" id="modalW76F2010" data-backdrop="static" role="dialog">
    <div class="D76F2010_loading hide">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div id="test"  class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW76F2010" onsubmit="return load_album();" >
                <div class="modal-header logodg pdl0">
                    {{Helpers::generateHeading($caption,"W76F2010",true,"",true, $pFrom, "W76F2010")}}
                </div>
                <div class="modal-body" style="padding: 10px">
                    <div class="row" style="padding-right: 8px">
                        <div class="col-md-9" >
                            @if (Session::get($pFrom) > 1)
                            <button type="button" ID="btn_add" onclick="callShowPopUpW76F2010(-1,'');" class="btn btn-default smallbtn"><span
                                        class="glyphicon glyphicon-plus" style ="padding-right: 5px"></span>{{Helpers::getRS($g,"Them_moi1")}}</button>
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
                                <input type="checkbox" id="chkShowDisabledW76F2010" name="chkShowDisabledW76F2010" value="0"/>
                                {{Helpers::getRS($g,"Hien_thi_danh_muc_khong_su_dung")}}
                            </label>
                        </div>
                    </div>
                </div>
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
   function load_album() {
       $(".l3loading").removeClass('hide');
       $("#gridW76F2010").html("");
        $.ajax({
            method: "POST",
            url: "W76F2010/{{$pFrom}}/{{$g}}",
            data: $("#frmW76F2010").serialize(),
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#tbl_content").html(data);
            }
        });
        return false;
    }

   function reload_album() {
       $(".l3loading").removeClass('hide');
       $("#gridW76F2010").html("");
       $.ajax({
           method: "POST",
           url: "W76F2010/{{$pFrom}}/{{$g}}",
           data: $("#frmW76F2010").serialize(),
           success: function (data) {
               $(".l3loading").addClass('hide');
               $("#tbl_content").html(data);
           }
       });
       return false;
   }

    function callShowPopUpW76F2010(rowIndx, $grid){
        $(".l3loading").removeClass('hide');
        var pFrom = "{{$pFrom}}";
        if (rowIndx > -1 ){
            var rowData = $grid.pqGrid("getRowData", { rowIndx: rowIndx });
            var id = rowData['AlbumID'];
        }else{
            var id = -1;
        }
        $("#detail").html("");
        if (pFrom == "D76F2010"){
            $.ajax({
                method: "POST",
                url: "W76F2011/{{$pFrom}}/{{$g}}/detail/" + id,
                success: function (data) {
                    $("#detail").html(data);
                    $(".l3loading").addClass('hide');
                    $("#modalPictureDetail").modal('show'); //Album anh
                }
            });
        }else if (pFrom == "D76F2020"){
            $.ajax({
                method: "POST",
                url: "W76F2021/{{$pFrom}}/{{$g}}/detailalbumvideo/" + id,
                success: function (data) {
                    $("#detail").html(data);
                    $(".l3loading").addClass('hide');
                    $("#modalVideoDetail").modal('show'); //Album video
                }
            });
        }
    }

    function deleteAlbumW76F2010(rowIndx, $grid){
        var rowData = $grid.pqGrid("getRowData", { rowIndx: rowIndx });
        var id = rowData['AlbumID'];
        ask_delete(delete_action,id);
    }

    function delete_action(id){
        $.ajax({
            method: "POST",
            url: "W76F2010/{{$pFrom}}/{{$g}}/removealbum/"+id,
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.bSaveOK) {
                    $(".l3loading").addClass('hide');
                    delete_ok();
                    update4ParamGrid($("#gridW76F2010"),"","delete");
                }
            }
        });
    }

   $("#modalW76F2010").on('shown.bs.modal', function() {
       load_album();
   });

   $(document).ready(function () {
       $('#chkShowDisabledW76F2010').click(function () {
           filterDisabled("gridW76F2010", $("#chkShowDisabledW76F2010").is(":checked") ? "" : 0);
       });
   });
</script>

