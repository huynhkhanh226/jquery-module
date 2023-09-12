@if(count($rs))
    <div class="detailW05">
        <div class="row ">
            <div class="col-md-11 hdDetail">
                <div class="liketext">
                    <label class="text-yellow"><b>{{$rs[0]['DivisionName'] or ''}}</b></label>
                </div>
            </div>
            <div class="col-md-1 hdDetail">
                <div class="liketext">
                    @if(floatval($rs[0]['CountFileAttachment'])>0)
                        <a class="fa fa-paperclip text-orange" onclick='$("#modalW91F4010").modal("show");'>
                            ({{$rs[0]['CountFileAttachment']}})
                        </a>
                    @else
                        <label></label>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 80px">{{Helpers::getRS($g,"Loai_phieu")}}</label>
                    <label><b>{{$rs[0]['VoucherTypeName']}} </b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 80px">{{Helpers::getRS($g,"So_phieu")}}</label>
                    <label><b>{{$rs[0]['VoucherNum']}} </b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 110px">{{Helpers::getRS($g,"Ngay_phieu")}}</label>
                    <label><b>{{$rs[0]['VoucherDate']}} </b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 80px">{{Helpers::getRS($g,"Loai_tien")}}</label>
                    <label><b>{{$rs[0]['CurrencyID']}} </b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 80px">{{Helpers::getRS($g,"Ty_gia")}}</label>
                    <label><b>{{number_format($rs[0]['ExchangeRate'],Session::get("W91P0000")['ExchangeRateDecimals'])}} </b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 110px">{{Helpers::getRS($g,"So_tham_chieu")}}</label>
                    <label><b>{{$rs[0]['VoucherNo']}} </b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 80px">{{Helpers::getRS($g,"Nguoi_lap")}}</label>
                    <label><b>{{$rs[0]['PreparedByName']}} </b></label>
                </div>
            </div>
            <div class="col-md-8">
                <div class="liketext">
                    <label style="width: 80px">{{Helpers::getRS($g,"NVKD")}}</label>
                    <label><b>{{$rs[0]['EmployeeName']}} </b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="liketext">
                    <label style="width: 80px">{{Helpers::getRS($g,"Khach_hang")}}</label>
                    <label><b>{{$rs[0]['ObjectName']}} </b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 110px">{{Helpers::getRS($g,"Trang_thai_DH")}}</label>
                    <label><b>{{$rs[0]['StatusName']}} </b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="liketext">
                    <label style="width: 80px">{{Helpers::getRS($g,"Dien_giai")}}</label>
                    <label><b>{{$rs[0]['Description']}} </b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 110px">{{Helpers::getRS($g,"Trang_thai_duyet")}}</label>
                    <label><b>{{$rs[0]['AStatusName']}} </b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div id="pqgrid_W05F1631"></div>
            </div>
        </div>
        @define $TotalOAmountTmp=0;$TotalCAmountTmp=0;$TotalOReduce=0;$TotalCReduce=0;$TotalOVAT=0;$TotalCVAT=0;$TotalAmount=0;$TotalCAmount=0;$SumAdjOAmount=0;$SumAdjCAmount=0;
        @if (count($rsDetail)>0)
            @define $TotalOAmountTmp = $rsDetail[0]['TotalOAmountTmp']
            @define $TotalCAmountTmp = $rsDetail[0]['TotalCAmountTmp']
            @define $TotalOReduce = $rsDetail[0]['TotalOReduce']
            @define $TotalCReduce = $rsDetail[0]['TotalCReduce']
            @define $TotalOVAT = $rsDetail[0]['TotalOVAT']
            @define $TotalCVAT = $rsDetail[0]['TotalCVAT']
            @define $TotalAmount = $rsDetail[0]['TotalAmount']
            @define $TotalCAmount = $rsDetail[0]['TotalCAmount']
            @define $SumAdjOAmount = $rsDetail[0]['SumAdjOAmount']
            @define $SumAdjCAmount = $rsDetail[0]['SumAdjCAmount']
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 110px">{{Helpers::getRS($g,"Tien_hang_NT")}}</label>
                    <label class="pull-right"><b>{{number_format(($TotalOAmountTmp + $SumAdjOAmount),Session::get('W91P0000')['DecimalPlaces'])}}</b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 110px">{{Helpers::getRS($g,"Tien_hang_QD")}}</label>
                    <label class="pull-right"><b>{{number_format(($TotalCAmountTmp + $SumAdjCAmount),Session::get('W91P0000')['D90_ConvertedDecimals'])}} </b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 110px">{{Helpers::getRS($g,"Chiet_khau_NT")}}</label>
                    <label class="pull-right"><b>{{number_format($TotalOReduce,Session::get('W91P0000')['DecimalPlaces'])}}</b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 110px">{{Helpers::getRS($g,"Chiet_khau_QD")}}</label>
                    <label class="pull-right"><b>{{number_format($TotalCReduce,Session::get('W91P0000')['D90_ConvertedDecimals'])}}</b></label>
                </div>
            </div>
        </div>
    </div>
    @define $g=1;
    @define $mod="D05";
    @if(floatval($rs[0]['CountFileAttachment'])>0)
        @extends('W9X.W91.W91F4010')
    @endif
    <script type="text/javascript">
        @if ($rs[0]['IsDisabled'] == 1)
           $("#modalW05F1631").find('#slStatusID').attr('disabled','disabled');
        $("#modalW05F1631").find('#btnAppW05F1631').attr('disabled','disabled');
        @else
            $("#modalW05F1631").find('#slStatusID').prop("disabled", false);
        $("#modalW05F1631").find('#btnAppW05F1631').prop("disabled", false);
        @endif
        function resizeHeight() {
            $("#modalW05F1631").find(".detailW05").height($("#modalW05F1631").find(".modal-content").height() - $("#modalW05F1631").find(".empployeeW15").height() - 80);
            $("#pqgrid_W05F1631").pqGrid({height: $("#modalW05F1631").find(".detailW05").height() - 250});
            $("#pqgrid_W05F1631").pqGrid("refresh");
        }

        $(function () {
            $("#modalW05F1631").find(".rightContent").removeClass("hide");
            $("#modalW05F1631").find("#slEmployeeID").val("{{Session::get("W91P0000")['Creator']}}");
            $("#modalW05F1631").find("#slStatusID").val("1");
            $("#modalW05F1631").find("#txtDescription").val("");

            var obj = {
                width: '100%',
                height: 200,
                showTitle: false,
                collapsible: false,
                editable: false,
                scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'}
            };
            obj.colModel = [
                {
                    title: '{{Helpers::getRS(0,'Ma_hang')}}', dataIndx: "InventoryID", width: 180,
                    editable: false, minWidth: 110
                },
                {
                    title: "{{Helpers::getRS(0,'Ten_hang')}}",
                    width: 250,
                    dataIndx: "InventoryName",
                    editable: false, minWidth: 200
                },

                {
                    title: "{{Helpers::getRS(0,'DVT') }}",
                    dataIndx: "UnitID",
                    width: 60,
                    minWidth: 60,
                    align: "center",
                    editable: false
                },
                {
                    title: "{{ Helpers::getRS(0,'So_luong') }}",
                    dataIndx: "Quantity",
                    dataType: "float",
                    width: 180,
                    minWidth: 110,
                    align: "right",
                    editable: false,
                    format: returnSFormat({{Session::get("W91P0000")['D07_QuantityDecimals']}})
                },
                {
                    title: "{{Helpers::getRS(0,'Don_gia')}}", dataIndx: "UnitPrice", dataType: "float", width: 180, align: "right"
                    ,format: returnSFormat({{Session::get("W91P0000")['UnitPriceDecimalPlaces']}}),editable: false, minWidth: 110

                },
                {
                    title: "{{Helpers::getRS(0,'Thanh_tien_NT')}}", dataIndx: "OAmountTmp", dataType: "float", width: 180, align: "right",
                    editable: false, format: returnSFormat({{Session::get("W91P0000")['DecimalPlaces']}}), minWidth: 110

                },
                {
                    title: "{{Helpers::getRS(0,'Thanh_tien_QD')}}", dataIndx: "CAmountTmp", dataType: "float", width: 200, align: "right",
                    editable: false, format: returnSFormat({{Session::get("W91P0000")['D90_ConvertedDecimals']}}), minWidth: 140
                },
                {
                    title: "{{Helpers::getRS(0,'Tong_dieu_chinh_NT')}}", dataIndx: "TotalAdjOAmount", dataType: "float", width: 200, align: "right",
                    editable: false, format: returnSFormat({{Session::get("W91P0000")['DecimalPlaces']}}), minWidth: 140
                },
                {
                    title: "{{Helpers::getRS(0,'Tong_dieu_chinh_QD')}}", dataIndx: "TotalAdjCAmount", dataType: "float", width: 200, align: "right",
                    editable: false, format: returnSFormat({{Session::get("W91P0000")['D90_ConvertedDecimals']}}), minWidth: 140
                },
                {
                    title: "{{ Helpers::getRS(0,'Ty_le_CK') . " (%)"}}", dataIndx: "RateReduce", dataType: "float", width: 180, align: "right",
                    format: returnSFormat(2),editable: false, minWidth: 110
                },
                {
                    title: "{{Helpers::getRS(0,'Tien_CK_NT')}}", dataIndx: "OriginalReduce", dataType: "float", width: 180, align: "right",
                    editable: false, format: returnSFormat({{Session::get("W91P0000")['DecimalPlaces']}}), minWidth: 110
                },
                {
                    title: "{{Helpers::getRS(0,'Tien_CK_QD')}}", dataIndx: "CReduce", dataType: "float", width: 180, align: "right",
                    editable: false, format: returnSFormat({{Session::get("W91P0000")['D90_ConvertedDecimals']}}), minWidth: 110

                },
                {
                    title: "{{Helpers::getRS(0,'Nhom_thue')}}", dataIndx: "VATGroupID", width: 100,editable: false, minWidth: 110
                },
                {
                    title: "{{Helpers::getRS(0,'Ty_le_thue')}} (%)", dataIndx: "VATRate", dataType: "float", width: 180, align: "right",
                    editable: false, format: returnSFormat(2), minWidth: 110

                },
                {
                    title: "{{Helpers::getRS(0,'Tien_thue_NTO')}}", dataIndx: "OVAT", dataType: "float", width: 180, align: "right",
                    editable: false,format: returnSFormat({{Session::get("W91P0000")['DecimalPlaces']}}), minWidth: 110

                },
                {
                    title: "{{Helpers::getRS(0,'Tien_thue_QD')}}", dataIndx: "CVAT", dataType: "float", width: 180, align: "right",
                    editable: false, format: returnSFormat({{Session::get("W91P0000")['D90_ConvertedDecimals']}}), minWidth: 110

                },
                {
                    title: "{{Helpers::getRS(0,'Tong_tien_NT')}}", dataIndx: "Amount", dataType: "float", width: 180, align: "right",
                    editable: false,format: returnSFormat({{Session::get("W91P0000")['DecimalPlaces']}}), minWidth: 110

                },
                {
                    title: "{{Helpers::getRS(0,'Tong_tien_QD')}}", dataIndx: "CAmount", dataType: "float", width: 180, align: "right",
                    editable: false, format: returnSFormat({{Session::get("W91P0000")['D90_ConvertedDecimals']}}), minWidth: 110

                }
            ];
            obj.dataModel = {
                data: {{json_encode($rsDetail)}},
                location: "local",
                sorting: "local",
                sortDir: "down"
            };
            obj.summaryData =[{OAmountTmp:'{{$TotalOAmountTmp}}', CAmountTmp:'{{$TotalCAmountTmp}}', OriginalReduce:'{{$TotalOReduce}}', CReduce:'{{$TotalCReduce}}', OVAT:'{{$TotalOVAT}}', CVAT:'{{$TotalCVAT}}', Amount:'{{$TotalAmount}}',CAmount:'{{$TotalCAmount}}',TotalAdjOAmount:'{{$SumAdjOAmount}}',TotalAdjCAmount:'{{$SumAdjCAmount}}'}];
            var $grid = $("#pqgrid_W05F1631").pqGrid(obj);
            $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $grid.pqGrid("refreshDataAndView");

            //unbind tất cả các event click trước đó của button
            $("#btnAppW05F1631").off("click");

            $("#btnAppW05F1631").on("click", function () {
                ask_save(function () {
                    $.ajax({
                        method: "PUT",
                        url: "{{url('W05F1631/save/'.$rs[0]['VoucherID'])}}",
                        data: {
                            status: $("#slStatusID").val()
                        },
                        success: function (data) {
                            var currentObject = $.parseJSON(data);
                            if (currentObject.Status == 0) {
                                save_ok(function () {
                                    $("#lefthead_W05F1631").find('#sldate').val(0).trigger('change');
                                });
                            }
                            else
                                alert_error(currentObject.Message);
                        }
                    });
                });
            });
        });
        resizeHeight();
    </script>
@endif

