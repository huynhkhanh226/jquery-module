<div class="modal fade pd0" id="modalW05F1602DT" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW05F1602_dt" method="post" action="" >
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"_Don_hang"),"W05F1602", false)}}
            </div>
            <div class="modal-body pdt5">

                <div style="padding: 0 8px">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="liketext">
                                    <label>{{Lang::get("message.Loai_phieu")}}</label>  <label><b>{{$master['VoucherTypeName']}}</b></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="liketext">
                                    <label class="mgr5">{{Lang::get("message.So_phieu")}}</label>    <label><b>{{$master['VoucherNum']}}</b></label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="liketext">
                                    <label class="mgr5">{{Lang::get("message.Ngay_phieu")}}</label>   <label><b>{{date('d-m-Y',strtotime($master['VoucherDate']))}}</b></label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="liketext">
                                    <label class="mgr5">{{Lang::get("message.Nguoi_lap")}}</label>  <label><b>{{$master['PreparedByName']}}</b></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="liketext">
                                        <label class="mgr5">{{Lang::get("message.Loai_tien")}}</label>   <label><b>{{$master['CurrencyID']}}</b></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="liketext">
                                        <label class="mgr5">{{Lang::get("message.Ty_gia")}}</label>     <label><b>{{number_format(floatval($master['ExchangeRate']),0, '.', ',')}}</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="liketext">
                                        <label class="mgr5">{{Lang::get("message.Trang_thai")}}</label>    <label><b>{{$master['StatusName']}}</b></label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="liketext">
                                        <label class="mgr5">{{Lang::get("message.NVKD")}}</label>  <label><b>{{$master['EmployeeName']}}</b></label>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="liketext">
                            <label class="mgr5">{{Lang::get("message.Khach_hang")}}</label>   <label><b>{{$master['ObjectID']}}</b></label> - <label><b>{{$master['ObjectTypeID']}}</b></label> - <label><b>{{$master['ObjectName']}}</b></label>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="liketext">
                            <label class="mgr5">{{Lang::get("message.Dien_giai")}}</label>  <label><b>{{$master['Description']}}</b></label>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12" style="position: relative">
                        <div id="grid_SO" style="margin:auto;"></div>

                    </div>
                </div>
                <div style="padding: 0 8px">
                    <div class="row so_sum">
                        <div class="col-md-9 pdt5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="flw10pc">
                                        <div class="liketext">
                                            <label>{{Helpers::getRS(0,'Tien_hang')}}</label>
                                        </div>
                                    </div>
                                    <div class="flw17pc mgr10">
                                        <input type="text" id="TotalOAmountTmp" name="TotalOAmountTmp" class="form-control" value="{{$TotalOAmountTmp}}" readonly>
                                    </div>
                                    <div class="flw17pc mgr10">
                                        <input type="text" id="TotalCAmountTmp" name="TotalCAmountTmp" class="form-control" value="{{$TotalCAmountTmp}}" readonly >
                                    </div>
                                    <div class="flw10pc">
                                        <div class="liketext">
                                            <label>{{Helpers::getRS(0,'Chiet_khau')}}</label>
                                        </div>
                                    </div>
                                    <div class="flw17pc">
                                        <input type="text" id="TotalOriginalReduce" name="TotalOriginalReduce" class="form-control" value="{{$TotalOriginalReduce}}" readonly >
                                    </div>
                                    <div class="flw17pc mgl10">
                                        <input type="text" id="TotalCReduce" name="TotalCReduce" class="form-control" value="{{$TotalCReduce}}" readonly >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="flw10pc">
                                        <div class="liketext">
                                            <label>  {{Helpers::getRS(0,'Thue_GTGT')}}</label>
                                        </div>
                                    </div>
                                    <div class="flw17pc mgr10">
                                        <input type="text" id="TotalOVAT" name="TotalOVAT" class="form-control" value="{{$TotalOVAT}}" readonly >
                                    </div>
                                    <div class="flw17pc mgr10">
                                        <input type="text" id="TotalCVAT" name="TotalCVAT" class="form-control" value="{{$TotalCVAT}}" readonly >
                                    </div>
                                    <div class="flw10pc">
                                        <div class="liketext">
                                            <label>{{Helpers::getRS(0,'Thanh_toan')}}</label>
                                        </div>
                                    </div>
                                    <div class="flw17pc">
                                        <input type="text" id="TotalAmount" name="TotalAmount" class="form-control" value="{{$TotalAmount}}" readonly >
                                    </div>
                                    <div class="flw17pc mgl10">
                                        <input type="text" id="TotalCAmount" name="TotalCAmount" value="{{$TotalCAmount}}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 pdt5">
                            <div class="row">
                                <div class="col-md-12">
                                    <select id="sof12" multiple="multiple" class="pull-left" >
                                        <option value="InventoryID">{{Helpers::getRS(0,'Ma_hang')}}</option>
                                        <option value="InventoryName">{{Helpers::getRS(0,'Ten_hang')}}</option>
                                        <option value="UnitID">{{Helpers::getRS(0,'DVT')}}</option>
                                        <option value="Quantity">{{Helpers::getRS(0,'So_luong')}}</option>
                                        <option value="UnitPrice">{{Helpers::getRS(0,'Don_gia')}}</option>
                                        <option value="OAmountTmp">{{Helpers::getRS(0,'Thanh_tien_NT')}}</option>
                                        <option value="CAmountTmp">{{Helpers::getRS(0,'Thanh_tien_QD')}}</option>
                                        <option value="RateReduce">{{Helpers::getRS(0,'Ty_le_CK_(%)')}}</option>
                                        <option value="OriginalReduce">{{Helpers::getRS(0,'Tien_CK_NT')}}</option>
                                        <option value="CReduce">{{Helpers::getRS(0,'Tien_CK_QD')}}</option>
                                        <option value="VATGroupID">{{Helpers::getRS(0,'Nhom_thue')}}</option>
                                        <option value="VATRate">{{Helpers::getRS(0,'Ty_le_thue')}}(%)</option>
                                        <option value="OVAT">{{Helpers::getRS(0,'Tien_thue_NTO')}}</option>
                                        <option value="CVAT">{{Helpers::getRS(0,'Tien_thue_QD')}}</option>
                                        <option value="Amount">{{Helpers::getRS(0,'Tong_tien_NT')}}</option>
                                        <option value="CAmount">{{Helpers::getRS(0,'Tong_tien_QD')}}</option>
                                    </select>
                                    <button type="submit" id="frm_btnSave" class="btn btn-default smallbtn pull-right"><span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS(0,"Luu")}}</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="l3loading hide">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    var so_rowidx=-1;
    var wd=[100,200,100,60,100,110,110,100,100,100,100,100,110,110,150,150];
    var colhide= {{json_encode($arrColHide)}};
    var isHiddenColumn = function(el) {
        return colhide.contains(el);
    };
    $(function() {

        var colM = [
            {
                title: "{{Helpers::getRS(0,'Ma_hang')}}", dataIndx: "InventoryID", width: 100,
                editable: false, hidden: isHiddenColumn('InventoryID')
            },
            {
                title: "{{Helpers::getRS(0,'Ten_hang')}}", width: 200, dataIndx: "InventoryName",
                editable: false, hidden: isHiddenColumn('InventoryName')
            },
            {
                title: "{{Helpers::getRS(0,'DVT')}}", dataIndx: "UnitID", width: 60, align: "center",
                editable: true, hidden: isHiddenColumn('UnitID')
            },
            {
                title: "{{Helpers::getRS(0,'So_luong')}}", dataIndx: "Quantity", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('Quantity')
            },

            {
                title: "{{Helpers::getRS(0,'Don_gia')}}", dataIndx: "UnitPrice", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('UnitPrice')
            },
            {
                title: "{{Helpers::getRS(0,'Thanh_tien_NT')}}", dataIndx: "OAmountTmp", dataType: "float", width: 110, align: "right",
                editable: false, hidden: isHiddenColumn('OAmountTmp')
            },
            {
                title: "{{Helpers::getRS(0,'Thanh_tien_QD')}}", dataIndx: "CAmountTmp", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('CAmountTmp')
            },
            {
                title: "{{Helpers::getRS(0,'Ty_le_CK')}} (%)", dataIndx: "RateReduce", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('RateReduce')
            },
            {
                title: "{{Helpers::getRS(0,'Tien_CK_NT')}}", dataIndx: "OriginalReduce", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('OriginalReduce')
            },
            {
                title: "{{Helpers::getRS(0,'Tien_CK_QD')}}", dataIndx: "CReduce", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('CReduce')
            },
            {
                title: "{{Helpers::getRS(0,'Nhom_thue')}}", dataIndx: "VATGroupID", width: 100,
                editable: false, hidden: isHiddenColumn('VATGroupID')
            },
            {
                title: "{{Helpers::getRS(0,'Ty_le_thue')}} (%)", dataIndx: "VATRate", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('VATRate')
            },
            {
                title: "{{Helpers::getRS(0,'Tien_thue_NTO')}}", dataIndx: "OVAT", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('OVAT')
            },
            {
                title: "{{Helpers::getRS(0,'Tien_thue_QD')}}", dataIndx: "CVAT", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('CVAT')
            },
            {
                title: "{{Helpers::getRS(0,'Tong_tien_NT')}}", dataIndx: "Amount", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('Amount')
            },
            {
                title: "{{Helpers::getRS(0,'Tong_tien_QD')}}", dataIndx: "CAmount", dataType: "float", width: 250, align: "right",
                editable: false, hidden: isHiddenColumn('CAmount')
            },
            {
                title: "ConversionFactor", dataIndx: "ConversionFactor", width: 140,
                editable: false, hidden: true
            },
            {
                title: "CQuanty", dataIndx: "CQuantity", dataType: "float", width: 120, align: "right",
                editable: false, hidden: true
            }
        ];
        var obj = {
            width: $("#modalW05F1602DT").width() * 0.90,
            height: 360,
            collapsible: false,
            showBottom: false,
            colModel: colM,
            sortable: false,
            hwrap: false,
            minWidth: 110,
            hoverMode: 'row',
            selectionModel: { type: 'cell', mode: 'block' },
            numberCell: {resizable: false, title: "#"},
            resizable: false,
            wrap: false
        };
        var data= {{$grid}};
        //console.log(data);
        obj.dataModel = { data: data };

        $grid1= $("div#grid_SO").pqGrid(obj);
    });
    $("#modalW05F1602DT").on('shown.bs.modal', function() {
        $("div#grid_SO").pqGrid("refresh");
        var colM=$("div#grid_SO").pqGrid( "option", "colModel" );

        $('#sof12').multiselect({
            includeSelectAllOption: true,
            selectAllValue: 0,
            maxHeight: 250,
            dropUp: true,
            onChange: function() {
                colhide=[];
                $('#sof12 option').each(function(index, brand) {
                    column = $("div#grid_SO").pqGrid( "getColumn",{ dataIndx: $(this).attr('value') } );
                    if($(this).is(':selected')) {

                        column.hidden=false;
                        column.width=wd[index];
                    }
                    else {
                        colhide.push($(this).attr('value'));
                        column.hidden=true;
                    }
                });

                $("div#grid_SO").pqGrid("option", "colModel", colM);
            },
            onSelectAll: function() {
                colhide=[];
                var colM=   $("div#grid_SO").pqGrid( "option", "colModel" );
                var hidden = $('#sof12 option:selected').length ==0 ? true : false;
                $('#sof12 option').each(function(index, brand) {
                    colM[index].hidden=hidden;
                    colM[index].width=wd[index];
                    if(hidden)
                        colhide.push($(this).attr('value'));
                });

                $("div#grid_SO").pqGrid("option", "colModel", colM);
            }
        });

        $('#sof12').multiselect('selectAll', false).multiselect('deselect', colhide).multiselect('updateButtonText');

    });

    $("#modalW05F1602DT").on('submit',"#frmW05F1602_dt", function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: {action: 'saveF12', arrHide: colhide} ,
            success: function (data) {
                if(data==1) {
                    save_ok(save_ok_calback);
                }
                else {
                    alert_warning(data);
                }
            }
        });
    });

    function save_ok_calback(){
        $("#modalW05F1602").modal('hide');
    }
</script>