<div class="modal draggable fade pd0" id="modalW76F4010" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW76F4010" method="post" action="">
                <div class="modal-header logodg pdl0">
                    {{Helpers::generateHeading($caption,"W76F4010")}}
                </div>

                <div class="modal-body">
                    <div class="row mgt10">
                        <div class="col-md-4" style="padding-right: 0px">
                            <select class="form-control select2" id="cboSearchFieldID"
                                    name="cboSearchFieldID" >
                                @foreach($rsField as $key=>$value )
                                    <option name='SearchFieldID'
                                            value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6" style="padding-right: 0px">
                            <input type="text"  class="form-control" id="keySearch" name="keySearch"
                                   value="" placeholder="{{Helpers::getRS($g,"Nhap_thong_tin_tim_kiem")}}"  required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" ID="frm_btnSearch" onclick="return allow_save();" >{{Helpers::getRS($g,"Tim_kiem")}}</button>
                        </div>
                    </div>
                    <div class="row  mglr0">
                        <div class="col-md-12 mgt10 pdt10 bdt"  id="telContent"></div>
                    </div>

                    <div class="l3loading hide ">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                <div class="modal-footer">

                    <div class="row  bg-gray" style="margin: 0 -5px; padding: 5px 0px">
                        <div class="col-md-6 text-left" id="searchCount">

                        </div>
                        <div class="col-md-6 text-right">
                            Hiển thị tối đa 50 người.
                        </div>
                    </div>

                </div>
                <button type="submit" id="frm_hbtnSearch" class="hidden">
                </button>
            </form>   <!-- /.end form  -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    $("#modalW76F4010").on('submit', '#frmW76F4010', function (e) {
        e.preventDefault();

        $.ajax({
            method: "POST",

            url: "{{Request::url()}}",

            data: $("#frmW76F4010").serialize(),
            success: function (data) {
                $("#frmW76F4010").find("#telContent").html(data);
                $("#frmW76F4010").find(".l3loading").addClass('hide');
            }
        });


    });
    /*$("#frmW76F4010").on('click', '#frm_btnSearch', function () {
        $("#frmW76F4010").find("#frm_hbtnSearch").trigger('click');
        $("#frmW76F4010").find(".l3loading").removeClass('hide');
    });*/
    $('#frmW76F4010 input').keydown(function(e) {
        if (e.keyCode == 13) {
            $("#frmW76F4010").find("#frm_hbtnSearch").trigger('click');
            $("#frmW76F4010").find(".l3loading").removeClass('hide');
        }
    });
    $('#frmW76F4010 #frm_btnSearch').keydown(function(e) {
        if (e.keyCode == 13) {
            $("#frmW76F4010").find("#frm_hbtnSearch").trigger('click');
            $("#frmW76F4010").find(".l3loading").removeClass('hide');
        }
    });
    $(document).ready(function () {

        $("#telContent").css({"height" : $(window).height()*92/100 - 130, 'overflowX' : 'auto' });

    });

    function allow_save(){
        var key = $("#frmW76F4010").find("#keySearch");
        if (key.val() == "") {
            key.get(0).setCustomValidity("{{Helpers::getRS($g,"Vui_long_nhap_thong_tin_tim_kiem")}}");
            $("#frmW76F4010").find("#frm_hbtnSearch").click();
            return false;
        }
        else {
            key.get(0).setCustomValidity("");
        }
        $("#frmW76F4010").find("#frm_hbtnSearch").trigger('click');
        $("#frmW76F4010").find(".l3loading").removeClass('hide');
    }
</script>

