<div class="modal draggable fade modal" id="modalW76F1000" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog">

        <?php
        if ($task == 'add') {
            $DocGroupCode = '';
            $DocGroupName = '';
            $DisplayOrder = '';
            $Note = '';
            $Disable = 0;
        }

        ?>

        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,'Cap_nhat_nhom_van_ban'),"W76F1000",true,"")}}
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form id="frmW76F1000" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Nhom_van_ban")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtDocGroupCodeW76F1000"
                                       readonly="true"
                                       id="txtDocGroupCodeW76F1000" value="{{$DocGroupCode}}" placeholder=""
                                       required="">
                                <span id="errorW76F1000" class="hide text-red">{{Helpers::getRS($g,"Ma_co_ky_tu_khong_hop_le")}}</span>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="checkbox pdt5">
                                    <label id="divDisabled">
                                        <input type="checkbox" id="chDisableW76F1000" name="chDisableW76F1000"
                                               value="1" {{$Disable==1?'checked':''}}
                                        >{{Helpers::getRS($g,"KSD")}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ten_nhom_van_ban")}}</label>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="txtDocGroupNameW76F1000" readonly="true"
                                       name="txtDocGroupNameW76F1000" value="{{$DocGroupName}}" placeholder=""
                                       required="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" name="txtNoteW76F1000" id="txtNoteW76F1000"
                                       readonly="true" value="{{$Note}}" placeholder="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Thu_tu_hien_thi")}}</label>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="txtDisplayOrderW76F1000" autocomplete="off"
                                       value="{{$DisplayOrder}}"
                                       name="txtDisplayOrderW76F1000" placeholder="" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12">
                                <div class="pull-right action">
                                    <button type="button" id="btnSaveW76F1000" name="btnSaveW76F1000"
                                            class="btn btn-default smallbtn"><span
                                                class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                                    </button>
                                    <button type="button" id="btnNotSaveW76F1000" name="btnNotSaveW76F1000"
                                            class="btn btn-default smallbtn"><span
                                                class="fa fa-ban text-red"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                    </button>
                                    <button type="button" id="btnNextW76F1000" name="btnNextW76F1000"
                                            class="btn btn-default smallbtn"><span
                                                class="fa fa-arrow-right text-blue mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                    </button>

                                    <input type="submit" id="hdSubmitW76F1000" class="hide"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var id = '{{$ID or ''}}';
    $(document).ready(function () {
        enableControls("{{$task}}");

        $("#txtDocGroupCodeW76F1000").keyup(function(){
            $("#errorW76F1000").addClass('hide');
            if (checkID($("#txtDocGroupCodeW76F1000")) == false){
                $("#errorW76F1000").removeClass('hide');
            }
        });

        $('#txtDisplayOrderW76F1000').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 0,
            autoGroup: true,
            rightAlign: true,
            min: 0
        });
    });
    $("#btnSaveW76F1000").click(function () {
        ask_save(function () {
            validationElements($("#frmW76F1000"), function () {
                checkID($("#txtDocGroupCodeW76F1000"));
                $("#hdSubmitW76F1000").click();
            });

        });
    });

    $("#modalW76F1000").on('submit', '#frmW76F1000', function (e) {
        e.preventDefault();
        var $grid = $("#gridW76F1000");
        //Đay du lieu qua controller save
        var task = "{{$task}}";
        var url = "";
        if (task == "add")
            url = "{{url('/W76F1000/view/'.$pForm.'/'.$g.'/save')}}";
        if (task == "edit") {
            url = "{{url('/W76F1000/view/'.$pForm.'/'.$g.'/update')}}";

        }
        $.ajax({
            method: "POST",
            url: url,

            data: $("#frmW76F1000").serialize() + '&ID=' + id,
            success: function (res) {
                var data = JSON.parse(res);
                var dtGrid = data.dataGrid;

                switch (data.status) {
                    case "EXIST":
                        alert_error("{{Helpers::getRS($g, 'Ma_nay_da_ton_tai')}}");
                        break;
                    case "SUC":
                        var $grid = $("#gridW76F1000");
                        $('#btnSaveW76F1000').prop('disabled', true);
                        $('#btnNextW76F1000').prop('disabled', false);

                        save_ok(function () {
                            if (task == "add") {
                                update4ParamGrid($grid, data.dataGrid, 'add');
                                $('#btnNextW76F1000').removeClass('hide');

                            }
                            if (task == "edit") {
                                update4ParamGrid($grid, dtGrid, 'edit');
                                task = "view";
                            }


                        });
                        break;
                    case "ERROR":
                        alert_error(data.message);
                        break;
                }
            }
        });
    });


    function enableControls(task) {
        switch (task) {
            case "add":
                //$(".divDisabled").addClass("hide");
                $('#txtDocGroupCodeW76F1000').prop('readonly', false);
                $('#txtDocGroupNameW76F1000').prop('readonly', false);
                $('#txtNoteW76F1000').prop('readonly', false);
                $('#btnNextW76F1000').addClass('hide');
                $('#divDisabled').addClass('hide');
                break;
            case "edit":
                $('#txtIDW76F1000').prop('disabled', true);
                $("#btnNextW76F1000").addClass("hide");
                $('#txtDocGroupNameW76F1000').prop('readonly', false);
                $('#txtDocGroupCodeW76F1000').prop('readonly', true);
                $('#txtNoteW76F1000').prop('readonly', false);
                $('#divDisabled').removeClass('hide');
                $('#btnNextW76F1000').addClass('hide');


                break;
            case 'view':
                $('#txtIDW76F1000').prop('disabled', true);
                $('#txtDocGroupCodeW76F1000').prop('disabled', true);
                $('#cboDocGroupNameW76F1000').prop('disabled', true);
                $('#txtDisplayOrderW76F1000').prop('disabled', true);
                $('#chDisableW76F1000').prop('disabled', true);
                $(".action").html("");
                break;
        }
    }

    $("#btnNotSaveW76F1000").click(function () {
        ask_not_save(function () {
            $("#modalW76F1000").modal("hide");
        });
    });

    $("#btnNextW76F1000").click(function () {
        $('#txtDocGroupCodeW76F1000').val('');
        $('#txtDocGroupNameW76F1000').val('');
        $('#txtNoteW76F1000').val('');
        $('#txtDisplayOrderW76F1000').val('');
        /*
                $('#txtDocGroupNameW76F1000').focus();
        */
        $(this).prop('disabled', true);
        $('#btnSaveW76F1000').prop('disabled', false);
    });

</script>

