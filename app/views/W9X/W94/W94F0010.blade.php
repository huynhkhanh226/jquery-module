<section class="content" id="secW94F0010">
    <div class="row">
        <div class="col-md-8 col-xs-8">
            <div class="box box-primary bdr0 box-solid">
                <div class="box-header with-border" style="padding: 5px 10px">
                    <h3 class="box-title" style="font-size: 15px;">
                        {{Helpers::getRS($g,"Thong_tin_may_chu_bao_cao")}}
                    </h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" id="frmW94F0010">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>{{Helpers::getRS($g,"Dia_chi")}}</label>
                                    <input name="ReportViewerURL" type="text" class="form-control" placeholder="Nhập.."
                                           value="{{D94T0000::first()->ReportViewerURL}}" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="frm_btnSave" class="btn btn-default smallbtn pull-right"><span
                                                class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                    </button>

                                </div>


                            </form>
                        </div>
                    </div>
                    <div class="row mgt10">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissable hide ">

                                <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_luu_thanh_cong")}}
                            </div>
                            <div class="alert alert-danger alert-dismissable hide">
                                <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}
                                    !</span>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $("#secW94F0010").on('submit', "#frmW94F0010", function (e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: '{{url("/W94F0010/Save/$pFrom/$g/")}}',
                data: $("#frmW94F0010").serialize(),
                success: function (data) {
                    if (data == 1) {
                        $("#secW94F0010").find(".alert-success").removeClass('hide');
                        $("#secW94F0010").find(".alert-danger").addClass('hide');
                        setTimeout(function () {
                            $("#secW94F0010").find(".alert-success").addClass('hide');
                        }, 2000);
                    }
                    else {
                        $("#secW94F0010").find(".alert-success").addClass('hide');
                        $("#secW94F0010").find(".alert-danger").removeClass('hide');
                        setTimeout(function () {
                            $("#secW94F0010").find(".alert-danger").addClass('hide');
                        }, 2000);
                    }

                }
            });
        });
    });
</script>