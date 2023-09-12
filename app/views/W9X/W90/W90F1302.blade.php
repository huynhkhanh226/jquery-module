<div class="modal fade pd0" id="modalW90F1302" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Chi_tiet_phieu"),"W90F1302")}}
            </div>
            <div class="modal-body">
                <fieldset>
                    <legend class="legend mgt5">{{Helpers::getRS($g,"Thong_tin_phieu")}}</legend>
                    <div class="row mgl5 mgr5">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Loai_phieu")}}</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="liketext">{{$rs1[0]["VoucherTypeID"]}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"So_phieu")}}</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="liketext">{{$rs1[0]["VoucherID"]}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Ngay_phieu")}}</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="liketext">{{$rs1[0]["VoucherDate"]}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Nguoi_lap")}}</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="liketext">{{$rs1[0]["EmployeeName"]}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mgt5 mgl5 mgr5">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="liketext lbl-normal">Module</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="liketext">{{$rs1[0]["ModuleName"]}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-2" style="width: 11.11%;">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Dien_giai")}}</label>
                                </div>
                                <div class="col-md-9" style="width: 88.89%;">
                                    <label class="liketext">{{$rs1[0]["Notes"]}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="col-md-12 mgt10 pdl5 pdr5" id="divW90F1302">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" id="tabHW90F1302">
                            <li class="active"><a data-toggle="tab" href="#tabW90F1302_1">{{Helpers::getRS($g,"But_toan_kep")}}</a></li>
                            <li><a data-toggle="tab" href="#tabW90F1302_2">{{Helpers::getRS($g,"But_toan_don")}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tabW90F1302_1" class="tab-pane active">
                                @include("W9X.W90.W90F1302_Ajax1")
                            </div>
                            <!-- /.tab-pane -->
                            <div id="tabW90F1302_2" class="tab-pane">
                                @include("W9X.W90.W90F1302_Ajax2")
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.end form  -->
</div>
<script>
    $("#modalW90F1302").on('shown.bs.modal', function() {
        $("#pqgrid_W90F1302_1").pqGrid("refreshDataAndView");
        $("#pqgrid_W90F1302_2").pqGrid("refreshDataAndView");
    });

    $('#tabHW90F1302 a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // activated tab
        $(target).find(".pq-grid").pqGrid("refreshDataAndView").pqGrid("refresh");
    });
</script>