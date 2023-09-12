<style>
    .ui-tabs .ui-tabs-nav {
        padding: 0;
    }
</style>
<div class="modal fade pd0" id="modalW05F1602" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW05F1602">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,"_Don_hang"),"W05F1602", true, 'closeW05F1602')}}
                </div>
                <div class="modal-body pdt5">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tabs" style="margin: 0 5px">
                                <ul>
                                    <li id="tabW05F1602_1"><a href="#tabs-1">{{Helpers::getRS($g,'Phieu')}}</a></li>
                                    <li id="tabW05F1602_2"><a href="#tabs-2">{{Helpers::getRS($g,'Dieu_khoan')}}</a></li>
                                    <li id="tabW05F1602_3"><a href="#tabs-3">{{Helpers::getRS($g,'Khac')}}</a></li>
                                </ul>
                                <div id="tabs-1" class="height136">
                                    <div style="padding: 8px">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="flw25pc">
                                                    <div class="liketext">
                                                        <label>{{Lang::get("message.Phieu")}}</label>
                                                    </div>
                                                </div>
                                                <div class="flw75pc">
                                                    <div class="flw60pc ">
                                                        <select class="form-control  combobox noUseValidHTML5"
                                                                {{count($master)>0 ? 'disabled' : "" }} id="slListVoucherType"
                                                                name="slListVoucherType"
                                                                onchange="setCustomValidity('');getVoucherNumber(this.value);"
                                                                oninvalid="setCustomValidity('{{ Helpers::getRS($g,'Ban_phai_chon') . " " .  strtolower(Helpers::getRS($g,'Loai_phieu'))}}')"
                                                                required>
                                                            <option value=""></option>
                                                            @foreach($ListVoucherType as $key => $value)
                                                                <option value="{{$key}}" {{ (count($master)>0&& $master['VoucherTypeID']==$key) ? "selected='selected'" : ""}}>{{$key}}- {{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="flw10pc text-center">
                                                        <i class="digi digi-uniE93A mgt5"></i>
                                                    </div>
                                                    <div class="flw30pc input-group">
                                                        <input type="text" class="form-control"
                                                               value="{{count($master)>0 ? $master['VoucherNum'] : "" }}"
                                                               id="txtVoucherNumber" name="txtVoucherNumber" disabled/>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-md-7">

                                                <div class="liketext flw13pc">
                                                    <label>{{Lang::get("message.Ngay_phieu")}}</label>
                                                </div>


                                                <div id="DateFromIcon" class="input-group date flw20pc ">
                                                    <input type="text" class="form-control noUseValidHTML5" id="voucherDate"
                                                           value="{{count($master)>0 ? date('d/m/Y',strtotime($master['VoucherDate']))  :date('d/m/Y')}}"
                                                           name="voucherDate" value="" required><span
                                                            class="input-group-addon"><i
                                                                class="glyphicon glyphicon-calendar"></i></span>
                                                </div>


                                                <div class="liketext flw12pc text-left" style="padding-left: 10px">
                                                    <label>{{Lang::get("message.Nguoi_lap")}}</label>
                                                </div>
                                                <div class="ps_relative flw25pc" id="digi_combogrid_preparedBy">

                                                </div>
                                                <div class="flw30pc pdl5">
                                                    <input type="text" class="form-control" id="txtnamePreparedBy"
                                                           value="{{count($master)>0 ? $master['PreparedByName'] : "" }}"
                                                           name="txtnamePreparedBy" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">

                                                <div class="flw25pc">
                                                    <div class="liketext">
                                                        <label>{{Lang::get("message.Khach_hang")}}</label>
                                                    </div>
                                                </div>
                                                <div class="flw75pc ps_relative" id="digi_combogrid_customer">


                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="flw33pc">
                                                    <input type="text" class="form-control flw98pc" id="txtObjectName"
                                                           name="txtObjectName" style="width:100%"
                                                           value="{{count($master)>0 ? $master['ObjectName'] : "" }}"
                                                           disabled/>
                                                </div>
                                                <div class="flw67pc pdl5">
                                                    <input type="text" class="form-control" id="txtObjectAddress"
                                                           name="txtObjectAddress"
                                                           value="{{count($master)>0 ? $master['ObjectAddress'] : "" }}"
                                                           disabled/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="flw25pc">
                                                    <div class="checkbox liketext" style="padding-top: 4px">
                                                        <label>
                                                            <input type="checkbox"
                                                                   id="chkIsFC" {{count($master)>0 && $master['IsForeignCurrency'] == 1 ? 'checked' : ''}} >{{Lang::get("message.Ngoai_te")}}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="flw75pc">
                                                    <div class="flw30pc">

                                                        <select class="form-control combobox noUseValidHTML5" id="slTypeCurrency"
                                                                name="slTypeCurrency"
                                                                disabled="disabled" required>
                                                            @foreach($ListCurrency as $currency)
                                                                <option value="{{$currency['CurrencyID']}}"
                                                                        {{ (count($master)>0 && $master['CurrencyID']==$currency['CurrencyID']) ? "selected='selected'" : ""}}  data-operator="{{$currency['Operator']}}"
                                                                        data-originaldecimal="{{$currency['OriginalDecimal']}}"
                                                                        data-unitpricedecimals="{{$currency['UnitPriceDecimals']}}">{{$currency['CurrencyID']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="flw15pc text-center">
                                                        <div class="liketext">
                                                            <label>{{Lang::get("message.TG")}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="flw55pc">
                                                        <input type="text" class="form-control"
                                                               style="text-align: right" id="txtExchangeRate"
                                                               value="{{count($master)>0 ? number_format($master['ExchangeRate'],Session::get('W91P0000')['ExchangeRateDecimals']) : "" }}"
                                                               name="txtExchangeRate" disabled/>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-md-7">

                                                <div class="liketext flw13pc">
                                                    <label>{{Lang::get("message.So_tham_chieu")}}</label>
                                                </div>

                                                <div class="flw20pc ">
                                                    <input type="text" class="form-control" id="voucherNo"
                                                           name="voucherNo"
                                                           value="{{count($master)>0 ? $master['VoucherNo'] : "" }}">
                                                </div>

                                                <div class="liketext flw12pc text-left" style="padding-left: 10px">
                                                    <label>{{Lang::get("message.NVKD")}}</label>
                                                </div>
                                                <div class="ps_relative flw25pc" id="digi_combogrid_employee">

                                                </div>
                                                <div class="flw30pc pdl5">
                                                    <input type="text" class="form-control"
                                                           value="{{count($master)>0 ? $master['EmployeeName'] : ""}}"
                                                           id="txtemployeenamebu" name="txtemployeenamebu" disabled/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="flw25pc">
                                                    <div class="liketext">
                                                        <label>{{Lang::get("message.Trang_thai")}}</label>
                                                    </div>
                                                </div>
                                                <div class="flw75pc">
                                                    <select class="form-control combobox" id="slstatus" name="slstatus" required>
                                                        @foreach($ListStatus as $key => $value)
                                                            <option value="{{$key}}" {{ (count($master)>0&& $master['StatusID']==$key) ? "selected='selected'" : ""}} >{{$value}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>
                                            <div class="col-md-7">

                                                <div class="liketext flw13pc">
                                                    <label>{{Lang::get("message.Dien_giai")}}</label>
                                                </div>

                                                <div class="flw87pc">
                                                    <input type="text" class="form-control"
                                                           value="{{count($master)>0 ? $master['Description'] : ""}}"
                                                           id="txtdescription" name="txtdescription"/>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-2" class="height136">

                                </div>
                                <div id="tabs-3" class="height136">

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row mgt5">
                        <div class="col-md-12" style="position: relative">
                            <div id="grid_SO" style="margin:auto; display: none;"></div>

                            <div id="divDropDownW05F1602">
                                <div style="position: absolute; z-index: 900000; top: 0; display: none; " id="pgrid_inventory" class="subGrid">
                                    <div id="grid_inventory"></div>
                                </div>
                                <div style="position: absolute; z-index: 900000; top: 0; display: none; " id="pgrid_UnitID" class="subGrid">
                                    <div id="grid_UnitID"></div>
                                </div>
                                <div style="position: absolute; z-index: 900000; top: 0; display: none;" id="pgrid_vatgroup" class="subGrid">
                                    <div id="grid_vatgroup"></div>
                                </div>
                            </div>

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
                                            <input type="text" id="TotalOAmountTmp" name="TotalOAmountTmp"
                                                   class="form-control" value="0" disabled>
                                        </div>
                                        <div class="flw17pc mgr10">
                                            <input type="text" id="TotalCAmountTmp" name="TotalCAmountTmp"
                                                   class="form-control" value="0" disabled>
                                        </div>
                                        <div class="flw10pc">
                                            <div class="liketext">
                                                <label>{{Helpers::getRS(0,'Chiet_khau')}}</label>
                                            </div>
                                        </div>
                                        <div class="flw17pc">
                                            <input type="text" id="TotalOriginalReduce" name="TotalOriginalReduce"
                                                   class="form-control" value="0" disabled>
                                        </div>
                                        <div class="flw17pc mgl10">
                                            <input type="text" id="TotalCReduce" name="TotalCReduce"
                                                   class="form-control" value="0" disabled>
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
                                            <input type="text" id="TotalOVAT" name="TotalOVAT" class="form-control"
                                                   value="0" disabled>
                                        </div>
                                        <div class="flw17pc mgr10">
                                            <input type="text" id="TotalCVAT" name="TotalCVAT" class="form-control"
                                                   value="0" disabled>
                                        </div>
                                        <div class="flw10pc">
                                            <div class="liketext">
                                                <label>{{Helpers::getRS(0,'Thanh_toan')}}</label>
                                            </div>
                                        </div>
                                        <div class="flw17pc">
                                            <input type="text" id="TotalAmount" name="TotalAmount" class="form-control"
                                                   value="0" disabled>
                                        </div>
                                        <div class="flw17pc mgl10">
                                            <input type="text" id="TotalCAmount" name="TotalCAmount" value="0"
                                                   class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 pdt5">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(count($master)==0)
                                            <button type="reset" id="frm_btnReset" title="{{Helpers::getRS($g,"Nhap_tiep")." "}}(CTRL+SHIFT+A)"
                                                    class="btn btn-default smallbtn pull-right mgt10 " disabled><span
                                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                            </button>
                                            <button type="button" id="frm_btnSave" title="{{Helpers::getRS($g,"Luu")." "}}(CTRL+SHIFT+S)"
                                                    class="btn btn-default smallbtn pull-right mgt10 mgr5 "><span
                                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                            </button>
                                        @else
                                            @define $p = Session::get($pForm)
                                            @if ($p>=4)
                                                <button type="button" id="frm_btnDelete" onclick="DeleteSO('{{$qid}}')" title="{{Helpers::getRS($g,"Xoa")." "}}"
                                                        class="btn btn-default smallbtn pull-right mgl5"><span
                                                            class="glyphicon glyphicon-remove"></span> {{Helpers::getRS($g,"Xoa")}}
                                                </button>
                                            @endif
                                            @if ($p>=2)
                                                <button type="button" id="frm_btnECancel" title="{{Helpers::getRS($g,"Khong_luu")." "}}(CTRL+SHIFT+C)"
                                                        class="btn btn-default smallbtn pull-right hide mgt10"
                                                        ><span
                                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                                </button>
                                                <button type="button" id="frm_btnSave" title="{{Helpers::getRS($g,"Luu")." "}}(CTRL+SHIFT+S)"
                                                        class="btn btn-default smallbtn pull-right mgt10 mgr5 hide "><span
                                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                                </button>

                                            @endif
                                            @if ($p>=3)
                                                <button type="button" id="frm_btnEdit" title="{{Helpers::getRS($g,"Sua")." "}}(CTRL+SHIFT+E)"
                                                        class="btn btn-default smallbtn pull-right mgr5 mgt10"
                                                        onclick="unlockForm();"><span
                                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                                                </button>
                                            @endif
                                            @if ($p>=1)
                                                <button type="button" id="frm_btnExport" title="{{Helpers::getRS($g,"Xuat_Excel_U")." "}}"
                                                        class="btn btn-default smallbtn pull-right mgr5 mgt10 hide"
                                                        onclick="exportTemplateExcel();"><span
                                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Xuat_Excel_U")}}
                                                </button>
                                            @endif
                                        @endif
                                            <input type="submit" class="hide" id="hdSaveW05F1602" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    var ListTitleSO = ["{{Helpers::getRS(0,'Ma_hang')}}",
        "{{Helpers::getRS(0,'Ten_hang')}}", "{{Helpers::getRS(0,'DVT') }}",
        "{{ Helpers::getRS(0,'So_luong') }}", "{{Helpers::getRS(0,'Don_gia')}}",
        "{{Helpers::getRS(0,'Thanh_tien')}}", "{{Helpers::getRS(0,'Thanh_tien_QD')}}",
        "{{ Helpers::getRS(0,'Ty_le_CK') . " (%)"}}", "{{Helpers::getRS(0,'Tien_CK')}}",
        "{{Helpers::getRS(0,'Tien_CK_QD')}}", "{{Helpers::getRS(0,'Nhom_thue')}}",
        "{{Helpers::getRS(0,'Ty_le_thue')}} (%)", "{{Helpers::getRS(0,'Tien_thue')}}",
        "{{Helpers::getRS(0,'Tien_thue_QD')}}", "{{Helpers::getRS(0,'Tong_tien')}}", "{{Helpers::getRS(0,'Tong_tien_QD')}}"
    ];
    var dataListVatGroup ={{$ListVATGroup}};
    var SOBaseUrl = '{{Request::url()}}';
    var sumText = '';
    var dataModel1602 = {{$grid}};

    var D07_QuantityDecimals = '{{$D07_QuantityDecimals}}';
    var UnitPriceDecimalPlaces = '{{$UnitPriceDecimalPlaces}}';
    var DecimalPlaces = '{{$DecimalPlaces}}';
    var D90_ConvertedDecimals = '{{$D90_ConvertedDecimals}}';
    var ExchangeRateDecimals = '{{$ExchangeRateDecimals}}';

    var quantityFormatString = "{{Helpers::getStringFormat($D07_QuantityDecimals)}}"
    var unitPriceFormatString = "{{Helpers::getStringFormat($UnitPriceDecimalPlaces)}}"
    var decimalFormatString = "{{Helpers::getStringFormat($DecimalPlaces)}}"
    var convertDecimalFormatString = "{{Helpers::getStringFormat($D90_ConvertedDecimals)}}"
    var exchangeRateFormatString = "{{Helpers::getStringFormat($ExchangeRateDecimals)}}"
    var messagW05F1602 = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
    var msgAdd = "{{Helpers::getRS($g,"Them_moi1")}}";
    //////////console.log("test");
</script>
{{HTML::script('packages/default/L3/js/combo_grid.js')}}
{{HTML::script('packages/default/L3/js/so.js')}}

<script type="text/javascript">
    $('#slListVoucherType').combobox({
        nextElement: 'voucherDate',
        appendId: 'Text'
    });
    $('#slTypeCurrency').combobox({
        nextElement: 'voucherNo',
        appendId: 'Text'
    });
    $('#slstatus').combobox({
        nextElement: 'txtdescription',
        appendId: 'Text'
    });
    // loai tien
    var vl_operator = 0;
    var vl_originaldecimal = 0;
    var vl_qd = '{{$fmqd}}';

    $("#slTypeCurrency").change(function () {
        ////console.log("slTypeCurrency");
        ////console.log($("#slTypeCurrency").val());
        vl_operator = $(this).find("option:selected").attr('data-operator');
        vl_originaldecimal = $(this).find("option:selected").attr('data-originaldecimal');
        getExchangeRateW05F1602();
        //$('.combobox').combobox('select');
        //$("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').change();
    });


    $('#chkIsFC').change(function () {
        var hidden = !$(this).is(":checked");
        if ($(this).is(":checked")) {
            //$("#slTypeCurrency").prop("disabled", false);
            $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').enable();
        }
        else {
            //$("#slTypeCurrency").prop("disabled", true).val('VND').change();

            $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').disable();
            //$("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").val('VND').change();
            $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').changeValue('VND');
        }
        showHideColumn(hidden);

    });


    showHideColumn({{count($master)>0 && $master['IsForeignCurrency'] == 1 ? false : true}});
    // tỷ giá
    var getExchangeRateW05F1602 = function () {
        ////console.log('getExchangeRateW05F1602');
        curDate = $("#voucherDate").val();
        if (curDate != '' && $("#modalW05F1602").find("#slTypeCurrency").val() != null) {
            curDate = changeFormat2($("#voucherDate").val());
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "POST",
                url: '{{Request::url()}}',
                data: {do: 'getExchaneRate', curDate: curDate, curencyID: $("#modalW05F1602 #slTypeCurrency").val()},
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    $("#modalW05F1602 #txtExchangeRate").val(format2(undefinedToZero(data),'',ExchangeRateDecimals));
                    updateSO();
                    //$("#voucherNo").focus();
                }
            });
        }else{
            $("#modalW05F1602 #txtExchangeRate").val(format2(0,'',ExchangeRateDecimals));
            updateSO();
        }
    };
    //ngày lập phiếu
    var curDate = '{{count($master)>0 ? date('m-d-Y',strtotime($master['VoucherDate']))  :""}}';
    ////////////console.log(curDate);
    /*$('.input-group.date').datepicker({
     format: 'dd/mm/yyyy',
     language: '{{Session::get("locate")}}',
     autoclose: true,
     showOnFocus: false
     }).on('changeDate', function (ev) {
     curDate = $(this).data('datepicker').getFormattedDate('mm-dd-yyyy');
     curDate = changeFormat2($("#voucherDate").val());
     vl_operator = $("#slTypeCurrency").find("option:selected").attr('data-operator');
     //////////console.log("vl_operator: " + vl_operator);
     vl_originaldecimal = $("#slTypeCurrency").find("option:selected").attr('data-originaldecimal');
     //////////console.log("vl_originaldecimal: " + vl_originaldecimal);
     getExchangeRateW05F1602();
     }).datepicker("setDate", '{{count($master)>0 ? date('d/m/Y',strtotime($master['VoucherDate']))  :date('d/m/Y')}}');
     // số phiếu*/


    $('#voucherDate').datepicker({
        format: 'dd/mm/yyyy',
        language: '{{Session::get("locate")}}',
        autoclose: true,
        showOnFocus: false,
        forceParse: false,
        allowDeselection: false,
    }).on('changeDate', function (ev) {

        curDate = $(this).data('datepicker').getFormattedDate('mm-dd-yyyy');
        curDate = changeFormat2($("#voucherDate").val());
        vl_operator = $("#slTypeCurrency").find("option:selected").attr('data-operator');
        //////////console.log("vl_operator: " + vl_operator);
        vl_originaldecimal = $("#slTypeCurrency").find("option:selected").attr('data-originaldecimal');
        //////////console.log("vl_originaldecimal: " + vl_originaldecimal);
        getExchangeRateW05F1602();
    });//.datepicker("setDate", '{{count($master)>0 ? date('d/m/Y',strtotime($master['VoucherDate']))  :date('d/m/Y')}}');



    $('#DateFromIcon').find(".glyphicon-calendar").on('click',function(){
        if ($('#voucherDate').is(':disabled') == false){
            $('#voucherDate').datepicker('show');
        }
    });

    //access sqlsvr to get voucherNo
    var getVoucherNumber = function (val) {
        $('#slListVoucherType').attr('title',$('#slListVoucherType option:selected').text());
        if (val != "") {
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "POST",
                url: '{{Request::url()}}',
                data: {do: 'getVoucherNumber', VoucherTypeID: val},
                async:true,
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    $("#modalW05F1602 #txtVoucherNumber").val(data);
                    $("#modalW05F1602 #txtVoucherNumber").attr('title',data);
                    $("#voucherDate").focus();
                }
            });
        }else{
            $("#modalW05F1602 #txtVoucherNumber").val('');
            $("#modalW05F1602 #txtVoucherNumber").attr('title','');

        }

    };

    // combo người lập
    $(function () {
        var obj1 = {
            width: 400, height: 290,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            selectionModel: {type: 'row', mode: 'single'},
            /*synElement: [
                {elId: "txtPreparedBy", dataIndx: "ObjectID"},
                {elId: "txtnamePreparedBy", dataIndx: "ObjectName"
            }],*/
            focusElement: "txtObjectID",
            colModel: [
                {title: "{{Helpers::getRS(0,'Ma_nguoi_lap')}}", width: 100, dataIndx: "ObjectID"},
                {title: "{{Helpers::getRS(0,'Ten_nguoi_lap')}}", width: 200, dataIndx: "ObjectName"}

            ],
            dataModel: {data: {}}

        };
        $("#digi_combogrid_preparedBy").DigiNetComboGrid({
            topContain: "modalW05F1602",
            textID: "txtPreparedBy",
            dataBind: "ObjectID",
            //synElement: [{elId: "txtnamePreparedBy"}],
            synElement: [
                {elId: "txtPreparedBy", dataIndx: "ObjectID", value: "{{count($master)>0 ? $master['PreparedBy'] : "" }}"},
                {elId: "txtnamePreparedBy", dataIndx: "ObjectName", value: "{{count($master)>0 ? $master['PreparedByName'] : "" }}"}
            ],
            textValue: "{{count($master)>0 ? $master['PreparedBy'] : "" }}",
            textRequireMessage: "{{Helpers::getRS($g,'Ban_phai_nhap') . " ". Helpers::getRS($g,'Nguoi_lap')}}",
            gridID: "PreparedBy",
            gridConfig: obj1,
            required: true,
            position: 'right',
            request: {
                url: '{{Request::url()}}',
                action: 'getListPreparedBy'
            }
        });

    });

    // combo khách hàng
    $(function () {
        var obj = {
            width: 500, height: 290,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            selectionModel: {type: 'row', mode: 'single'},
            /*synElement: [
                {elId: "txtObjectID", dataIndx: "ObjectID"},
                {elId: "txtObjectName", dataIndx: "ObjectName"},
                {elId: "txtObjectAddress", dataIndx: "ADDRESS"}
            ],*/

            focusElement: "voucherNo",
            colModel: [
                {title: "{{Helpers::getRS(0,'Ma_KH')}}", width: 150, dataIndx: "ObjectID"},
                {title: "{{Helpers::getRS(0,'Ten_KH')}}", width: 350, dataIndx: "ObjectName"},
                {title: "{{Helpers::getRS(0,'Loai_DT')}}", width: 80, dataIndx: "ObjectTypeID", hidden: true},
                {title: "{{Helpers::getRS(0,'Dia_chi')}}", width: 50, dataIndx: "ADDRESS", hidden: true}
            ],
            dataModel: {data: {}}
        };

        $("#digi_combogrid_customer").DigiNetComboGrid({
            topContain: "modalW05F1602",
            textID: "txtObjectID",
            /*synElement: [
                {elId: "txtObjectName"},
                {elId: "txtObjectAddress"}
            ],*/
            synElement: [
                {elId: "txtObjectID", dataIndx: "ObjectID", value: "{{count($master)>0 ? $master['ObjectID'] : "" }}"},
                {elId: "txtObjectName", dataIndx: "ObjectName", value: "{{count($master)>0 ? $master['ObjectName'] : "" }}"},
                {elId: "txtObjectAddress", dataIndx: "ADDRESS", value: "{{count($master)>0 ? $master['ObjectAddress'] : "" }}"}
            ],

            dataBind: "ObjectID",
            textValue: "{{count($master)>0 ? $master['ObjectID'] : "" }}",
            textRequireMessage: "{{Helpers::getRS($g,'Ban_phai_nhap') . " ". Helpers::getRS($g,'Khach_hang')}}",
            gridID: "array",
            gridConfig: obj,
            required: true,
            request: {
                url: '{{Request::url()}}',
                action: 'getListCustomer'
            }

        });

    });

    // lcombo nhân viên
    var isgrid_employeebu = false;
    $(function () {
        var obj2 = {
            width: 400, height: 290,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            selectionModel: {type: 'row', mode: 'single'},
            /*synElement:[
                {elId: "txtemployeebu", dataIndx: "ObjectID"},
                {elId: "txtemployeenamebu", dataIndx: "ObjectName"}
            ],*/
            focusElement: "slstatusText",
            colModel: [
                {title: "{{Helpers::getRS(0,'Ma_NV')}}", width: 100, dataIndx: "ObjectID"},
                {title: "{{Helpers::getRS(0,'Ten_NV')}}", width: 200, dataIndx: "ObjectName"}
            ],
            dataModel: {data: {}},

        };
        $("#digi_combogrid_employee").DigiNetComboGrid({
            topContain: "modalW05F1602",
            textID: "txtemployeebu",
            //synElement: [{elId: "txtemployeenamebu"}],
            synElement:[
                {elId: "txtemployeebu", dataIndx: "ObjectID", value: "{{count($master)>0 ? $master['EmployeeID'] : "" }}"},
                {elId: "txtemployeenamebu", dataIndx: "ObjectName", value: "{{count($master)>0 ? $master['EmployeeName'] : "" }}"}
            ],
            dataBind: "ObjectID",
            textValue: "{{count($master)>0 ? $master['EmployeeID'] : "" }}",
            textRequireMessage: "{{Helpers::getRS($g,'Ban_phai_nhap') . " ". Helpers::getRS($g,'NVKD')}}",
            gridID: "employeebu",
            gridConfig: obj2,
            position: 'right',
            request: {
                url: '{{Request::url()}}',
                action: 'getListEmployeeBu'
            }

        });

    });

    // xử lý khi modal show, refesh lưới
    $("#modalW05F1602").on('shown.bs.modal', function () {
        //$("#grid_vatgroup").pqGrid("refresh");
        $("#slListVoucherTypeText").focus();

        /*if ('{{$mode}}' == "edit") {
            //$("#slTypeCurrency").val($("#slTypeCurrency").val()).change();
            $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').changeValue($("#slTypeCurrency").val());
        } else {
            //$("#slTypeCurrency").val('VND').change();
            $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').changeValue('VND');

        }*/

        if ('{{$mode}}' == "add") {
            $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').changeValue('VND');
        }

        $("#tabs").tabs();
        $("div#grid_SO").pqGrid("option", "width", $("#modalW05F1602").find("#tabs").width());
        $("div#grid_SO").pqGrid("option", "height", $("#modalW05F1602").height() - 330);

        $("div#grid_SO").show();
        $("div#grid_SO").pqGrid("refresh");
        @if(count($master)>0)
          lockForm();
          updateTotalSO();
        @endif


    });

    $("#modalW05F1602").find('#frm_btnECancel').click(function(){
        ask_not_save(function(){
            /*lockForm();
            $('#frmW05F1602')[0].reset();*/
            $('#modalW05F1602').modal('hide');
        });
    });

    //Diable controls
    function lockForm() {
        $("#modalW05F1602").find("#tabs-1").find("select,input").attr("disabled", true);
        $('#slListVoucherType').data('combobox').disable()
        $("#modalW05F1602").find("#slTypeCurrency").attr("disabled", true);
        $("#modalW05F1602").find("#tabs-1").find(".l3combo>span").removeClass('pointer');//pointer class dùng để bắt sự kiện
        $("#modalW05F1602").find("#frm_btnSave").addClass('hide');
        $("#modalW05F1602").find("#frm_btnECancel").addClass('hide');
        $("#modalW05F1602").find("#frm_btnEdit").removeClass('hide');
        $("#modalW05F1602").find("#frm_btnEdit").removeClass('mgr5');
        //$("#modalW05F1602").find("#frm_btnExport").removeClass('hide');
        $("div#grid_SO").pqGrid( "option", "editable", false );
        @if (count($master) > 0)
            $("#modalW05F1602").find("#frm_btnEdit").focus();
        @endif
    }
    function unlockForm() {
        $("#modalW05F1602").find("#tabs-1").find("select,input").attr("disabled", false);

        //$("#modalW05F1602").find("#slTypeCurrency").attr("disabled", false);
        $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').enable();
        if ($("#chkIsFC").is(":checked")) {
            //$("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").attr("disabled", false);
            $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').enable();
        }
        else {
            //$("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").attr("disabled", true);
            $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').disable();

        }
        //$("#modalW05F1602").find("#tabs-1").find("#slListVoucherType").attr("disabled", true);
        $("#modalW05F1602").find("#tabs-1").find("#slListVoucherType").data('combobox').disable();

        $("#modalW05F1602").find("#tabs-1").find("#txtVoucherNumber,#voucherDate,#txtnamePreparedBy,#txtObjectName,#txtObjectAddress,#txtExchangeRate,#txtemployeenamebu").attr("disabled", true);

        $("#modalW05F1602").find("#tabs-1").find(".l3combo>span").addClass('pointer');
        $("div#grid_SO").pqGrid( "option", "editable", true );
        $("#modalW05F1602").find("#frm_btnSave").removeClass('hide');
        $("#modalW05F1602").find("#frm_btnECancel").removeClass('hide');
        $("#modalW05F1602").find("#frm_btnEdit").addClass('hide');
        $("#modalW05F1602").find("#frm_btnEdit").removeClass('mgr5');
        $("#modalW05F1602").find("#frm_btnExport").addClass('hide');
        //scrollColumn to Inventory
        $("div#grid_SO").pqGrid("scrollColumn", {dataIndx: "InventoryID"});
        $("#txtPreparedBy").focus();


    }
    //check before triggering save button
    $("#modalW05F1602").on('keydown', '#txtdescription', function (e) {
        //////console.log('dsfs');
        var code = e.keyCode || e.which;
        if (!e.shiftKey){
            if (code == 13 || code == 9) {
                e.stopPropagation();
                e.preventDefault();
                var rowCount = $("div#grid_SO").pqGrid("option", "dataModel.data");
                if (rowCount == null || rowCount.length == 0) {
                    $("div#grid_SO").pqGrid("addRow",
                            {rowData: {}}
                    );
                    $("div#grid_SO").pqGrid("refresh");
                    $("div#grid_SO").pqGrid("refreshView");
                    $("div#grid_SO").pqGrid("setSelection", {rowIndx: 0, colIndx: 0});
                } else {
                    $("div#grid_SO").pqGrid("saveEditCell");
                    $("div#grid_SO").pqGrid("quitEditMode");
                    $("div#grid_SO").pqGrid("setSelection", {rowIndx: 0, colIndx: 0});
                }
            }
        }

    });

    $("#modalW05F1602").on('keydown', '#voucherNo', function (e) {
        //////console.log('dsfs');
        var code = e.keyCode || e.which;
        if (!e.shiftKey){
            if (code == 13 || code == 9) {
                $('#txtemployeebu').focus();
                e.stopPropagation();
                e.preventDefault();
            }
        }

    });

/*    $("#modalW05F1602").on('keydown', '#slListVoucherTypeText', function (e) {
        ////console.log('slstatusText  ');
        var code = e.keyCode || e.which;
        if (!e.shiftKey){
            if (code == 13 || code == 9) {
                $('#voucherDate').focus();
                e.stopPropagation();
                e.preventDefault();
            }
        }

    });*/

    /*$("#modalW05F1602").on('keydown', '#slstatusText', function (e) {
        ////console.log('slstatusText  ');
        var code = e.keyCode || e.which;
        if (!e.shiftKey){
            if (code == 13 || code == 9) {
                $('#txtdescription').focus();
                e.stopPropagation();
                e.preventDefault();
            }
        }

    });*/

    $("#modalW05F1602").on('keydown', '#voucherDate', function (e) {
        //////console.log('dsfs');
        var code = e.keyCode || e.which;
        if (!e.shiftKey){
            if (code == 13 || code == 9) {
                $('#txtPreparedBy').focus();
                e.stopPropagation();
                e.preventDefault();
            }
        }

    });

    // dropdown Mã hàng
    var isgrid_inventory = false;
    $(function () {
        var data = {};
        var obj = {
            width: 700, height: 203,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            selectionModel: {type: 'row', mode: 'single'},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            parentBound: $("#pgrid_inventory"),
            funcUpdate: updateRowGridSO,
            synElement: {},
            rowSelect: function (event, ui) {
                /*isShow = false;
                 //////console.log('rowSelect');
                 soel.pqGrid("saveEditCell");
                 soel.pqGrid("quitEditMode");
                 soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});*/
            },
            cellKeyDown: function (event, ui) {
                if (event.keyCode == 27) {
                    var els = $("#divDropDownW05F1602").find('.subGrid');
                    for (var i=0;i<els.length;i++){
                        $(els[i]).css('display', 'none');
                    }
                    isShow = false;
                    soel.pqGrid("quitEditMode");
                    soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});
                }
                if (event.keyCode == 13) {
                    isShow = false;
                    //////console.log('rowSelect');
                    soel.pqGrid("saveEditCell");
                    soel.pqGrid("quitEditMode");
                    //soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});
                }
            },
        };
        obj.colModel = [
            {title: "{{Helpers::getRS(0,'Ma_hang')}}", width: 150, dataIndx: "InventoryID"},
            {title: "{{Helpers::getRS(0,'Ten_hang')}}", width: 450, dataIndx: "InventoryName"},
            {title: "{{Helpers::getRS(0,'DVT')}}", width: 50, dataIndx: "UnitID"},
            {title: "ConversionFactor", width: 50, dataIndx: "ConversionFactor", hidden: true},
            {title: "IsService", width: 50, dataIndx: "IsService", hidden: true},
            {title: "IsKit", width: 50, dataIndx: "IsKit", hidden: true}
        ];
        obj.dataModel = {data: data};

        $("#grid_inventory").pqGrid(obj);

    });

    // dropdown Đơn vị tính
    var isgrid_UnitID = false;
    $(function () {
        var data = {};
        var obj = {
            width: 230, height: 203,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            selectionModel: {type: 'row', mode: 'single'},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            parentBound: $("#pgrid_UnitID"),
            funcUpdate: updateUnitID,
            synElement: {},
            rowSelect: function (event, ui) {
                /*isShow = false;
                 soel.pqGrid("saveEditCell");
                 soel.pqGrid("quitEditMode");
                 soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});*/
            },
            cellKeyDown: function (event, ui) {
                if (event.keyCode == 27) {
                    var els = $("#divDropDownW05F1602").find('.subGrid');
                    for (var i=0;i<els.length;i++){
                        $(els[i]).css('display', 'none');
                    }
                    isShow = false;
                    soel.pqGrid("quitEditMode");
                    soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});
                }
                if (event.keyCode == 13) {
                    isShow = false;
                    //////console.log('rowSelect');
                    soel.pqGrid("saveEditCell");
                    soel.pqGrid("quitEditMode");
                    //soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});
                }
            },
        };
        obj.colModel = [

            {title: "{{Helpers::getRS(0,'Ma')}}", width: 80, dataIndx: "UnitID"},
            {title: "{{Helpers::getRS(0,'Ten')}}", width: 150, dataIndx: "UnitName"},
        ];
        obj.dataModel = {data: data};

        $("#grid_UnitID").pqGrid(obj);

    });

    var isgrid_vatgroup = false;
    // dropdown Nhóm thuế
    $(function () {
        var data = {};
        var obj = {
            width: 550, height: 203,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            showHeader: true,
            resizable: false,
            selectionModel: {type: 'row', mode: 'single'},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            parentBound: $("#pgrid_vatgroup"),
            funcUpdate: updateRowGridSOFromListVAT,
            synElement: {},
            rowSelect: function (event, ui) {
                /*isShow = false;
                 soel.pqGrid("saveEditCell");
                 soel.pqGrid("quitEditMode");
                 soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});*/
            },
            cellKeyDown: function (event, ui) {
                if (event.keyCode == 27) {
                    var els = $("#divDropDownW05F1602").find('.subGrid');
                    for (var i=0;i<els.length;i++){
                        $(els[i]).css('display', 'none');
                    }
                    isShow = false;
                    soel.pqGrid("quitEditMode");
                    soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});
                }
                if (event.keyCode == 13) {
                    isShow = false;
                    //////console.log('rowSelect');
                    soel.pqGrid("saveEditCell");
                    soel.pqGrid("quitEditMode");
                    //soel.pqGrid("setSelection", {rowIndx: gbRowIndx, colIndx: gbColIndx});
                }
            },
        };
        obj.colModel = [

            {title: "{{Helpers::getRS(0,'Ma')}}", width: 100, dataIndx: "VATGroupID"},
            {title: "{{Helpers::getRS(0,'Ten')}}", width: 350, dataIndx: "VATGroupName"},
            {title: "Rate", width: 50, dataIndx: "VATRate"}
        ];
        obj.dataModel = {data: data};
        $("#grid_vatgroup").pqGrid(obj);

    });

    /*$(document).find("#modalW05F1602").keypress(function (event) {
        if (event.charCode === 83 && event.shiftKey && event.ctrlKey && $("#modalW05F1602").find("#frm_btnSave").is(":visible") && !$("#modalW05F1602").find("#frm_btnSave").is(":disabled")) { // shift + s
            $("#frmW05F1602").find("#frm_btnSave").trigger('click');
        }
    });*/


    $("#frm_btnSave").on('click',function(e){
        //$("div#grid_SO").pqGrid("saveEditCell");
        //$("div#grid_SO").pqGrid("quitEditMode");
        //if (isChecking)
        //    return;
        console.log('save');
        //e.stopPropagation();
        //e.preventDefault();
        ask_save(function(){

            var slListVoucherType = $("#slListVoucherTypeText");
            var voucherDate  = $("#voucherDate");
            var slTypeCurrency = $("#slTypeCurrencyText");
            var txtPreparedBy = $("#txtPreparedBy");
            var txtObjectID = $("#txtObjectID");
            var slstatus = $("#slstatusText");



            slListVoucherType.get(0).setCustomValidity("");
            voucherDate.get(0).setCustomValidity("");
            slTypeCurrency.get(0).setCustomValidity("");
            txtPreparedBy.get(0).setCustomValidity("");
            txtObjectID.get(0).setCustomValidity("");
            slstatus.get(0).setCustomValidity("");

            //alert('sdfasf');

            if (slListVoucherType.val() == "") {
                slListVoucherType.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Phieu')}}");
                $("#frmW05F1602").find('#hdSaveW05F1602').click();
                slListVoucherType.focus();
                return;
            }

            if (voucherDate.val() == "") {
                voucherDate.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ngay')}}");
                $("#frmW05F1602").find('#hdSaveW05F1602').click();
                voucherDate.focus();
                return;
            }

            if (txtPreparedBy.val() == "") {
                txtPreparedBy.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Nguoi_lap')}}");
                $("#frmW05F1602").find('#hdSaveW05F1602').click();
                txtPreparedBy.focus();
                return;
            }

            if (txtObjectID.val() == "") {
                txtObjectID.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Khach_hang')}}");
                $("#frmW05F1602").find('#hdSaveW05F1602').click();
                txtObjectID.focus();
                return;
            }

            if ( slTypeCurrency.val() == "") {
                slTypeCurrency.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ngoai_te')}}");
                $("#frmW05F1602").find('#hdSaveW05F1602').click();
                slTypeCurrency.focus();
                return;
            }

            if ( slstatus.val() == "") {
                slstatus.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Trang_thai')}}");
                $("#frmW05F1602").find('#hdSaveW05F1602').click();
                slstatus.focus();
                return;
            }

            var obj = $("div#grid_SO").pqGrid("option", "dataModel.data");


            if ( obj.length == 0) {
                alert_error('{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu_tren_luoi')}}');
                e.stopPropagation();
                e.preventDefault();
                return;
            }

            var colModel = $("div#grid_SO").pqGrid("option", "colModel" );
            for (var i=0;i<obj.length;i++){
                for (var j=0;j<colModel.length;j++){
                    //console.log('save');
                    if (colModel[j].required && isNullOrEmpty(obj[i][colModel[j].dataIndx])){
                        soel.pqGrid("setSelection", {
                            rowIndx: i,
                            colIndx: j
                        });
                        soel.pqGrid( "editCell", { rowIndx: i, dataIndx: colModel[j].dataIndx } );
                        var cell = soel.pqGrid( "getEditCell" );
                        var $editor = cell.$editor;
                        $($editor).confirmation({
                            btnOkLabel: '',
                            btnCancelLabel: '',
                            popout: true,
                            placement: "bottom",
                            singleton: true,
                            template:
                            '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                            + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                            + messagW05F1602
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        e.stopPropagation();
                        e.preventDefault();
                        return;
                    }
                }
            }
            $("#frmW05F1602").find('#hdSaveW05F1602').click();
        });


    });

    // xử lý lưu lâp đơn hàng
    $("#modalW05F1602").on('submit', '#frmW05F1602', function (e) {
        e.preventDefault();
        //alert("Form submit");
        updateSO();
        var check = checkDataSO();
        $("div#grid_SO").pqGrid('refreshDataAndView');
        if (check == true) {
            //Modify by Khanh - start
            /*var obj=[];
             var length=$("div#grid_SO").find(".pq-grid-inner").find(".pq-grid-row").length;
             for(i=0;i<$("div#grid_SO").find(".pq-grid-inner").find(".pq-grid-row").length; i++) {
             var rowData = $("div#grid_SO").pqGrid("getRowData", {rowIndx: i});
             obj.push(rowData);
             }*/
            var obj = $("div#grid_SO").pqGrid("option", "dataModel.data");
            //////////////console.log("getData" + obj);
            //Modify by Khanh - end
            $(".l3loading").removeClass('hide');
            $.ajax({
                        method: "POST",
                        url: '{{Request::url()}}',
                        data: $(this).serialize()
                        + '&do=saveSO'
                        + "&slstatus=" + $("#slstatus").val()
                        + "&slTypeCurrency=" + $("#slTypeCurrency").val()
                        + "&voucherDate=" + curDate
                        + "&" + $.param({obj: obj})
                        + '&txtExchangeRate='+ $("#txtExchangeRate").val()
                        + '&txtObjectTypeID=KH'
                        + '&txtObjectName='+ $("#txtObjectName").val()
                        + '&txtObjectAddress='+ $("#txtObjectAddress").val(),

                        success: function (data) {
                            $(".l3loading").addClass('hide');
                            if (data == 0) {
                                save_not_ok();
                            }
                            else {
                                save_ok(save_ok_callback);
                            }

                        }
                    }
            );
        }
        else {

            alert_warning("{{Helpers::getRS(0,'Ban_can_nhap_du_cac_thong_tin')}}", focusEditWhenError, check);
        }


    });

    function save_ok_callback() {
        // $("#modalW05F1602").modal('hide');
        @if(count($master)>0)// sửa
                lockForm();

        @else //thêm mới
            $("#modalW05F1602").find("#frm_btnSave").addClass('disabled');
            //$("#modalW05F1602").find("#frm_btnReset").removeClass('disabled');
            $("#modalW05F1602").find("#frm_btnReset").prop('disabled',false);
            $("#modalW05F1602").find("#frm_btnReset").focus();

        @endif
        //W05F1621Search();
    }

    function closeW05F1602(){
        $("#modalW05F1602").modal('hide');
        W05F1621Search();
    }

    // xử lý phần nhập tiếp
    $("#modalW05F1602").find("#frm_btnReset").click(function (e) {
        //Giu 2 combo nay lai. Minh ko reset no
        var currencyOld = $("#slTypeCurrencyText").val();
        var statusOld = $("#slstatusText").val();

        $('#frmW05F1602')[0].reset();
        $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').clearValue();
        $("#modalW05F1602").find("#tabs-1").find("#slstatus").data('combobox').clearValue();
        $("#modalW05F1602").find("#tabs-1").find("#slListVoucherType").data('combobox').clearValue();

        $("#modalW05F1602").find("#frm_btnSave").removeClass('disabled');
        $("#modalW05F1602").find("#frm_btnReset").prop('disabled',true);

        //set lai gia tri default
        $('#voucherDate').datepicker("setDate", '{{date('d/m/Y')}}');
        $("#modalW05F1602").find("#tabs-1").find("#slTypeCurrency").data('combobox').changeValue(currencyOld);
        $("#modalW05F1602").find("#tabs-1").find("#slstatus").data('combobox').changeValue(statusOld);

        //Delete value tren luoi
        clearGrid();
        $("#modalW05F1602").find("#slListVoucherTypeText").focus();
        e.stopPropagation();
        e.preventDefault();
    });

    function DeleteSO(qid){
        ask_delete(function(){
            $(".l3loading").removeClass('hide');
            $.ajax({
                        method: "POST",
                        url: '{{url("/W05F1602/view/$pForm/$g/delete")}}' + "/" + qid,
                        data: {
                            VoucherNum: '{{count($master) > 0 ? $master["VoucherNum"] : ""}}',
                        },
                        success: function (data) {
                            ////////console.log(Boolean(data));
                            $(".l3loading").addClass('hide');
                            if (Boolean(data)) {
                                delete_ok(function(){
                                    W05F1621Search();
                                    $("#modalW05F1602").modal("hide");
                                });
                            }
                            else {

                            }

                        }
                    }
            );
        });

    }

    var exportTemplateExcel = function () {
        var detail = $("div#grid_SO").pqGrid("option", "dataModel.data");
        ////////console.log("test");
        var formats = getFormat4ExcelTemplate($("div#grid_SO"));
        $.ajax({
            method: "POST",
            data: {master: '{{json_encode($master)}}', detail:JSON.stringify(detail), formats: JSON.stringify(formats)},
            url: "{{url('/templateexcel')}}",
            success: function (data) {
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "ExcelTemplate_" + new Date().getTime() + ".xls";
                    downloadLink.innerHTML = "Download File";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };

    //Cap nhat value to title
    var els = $("#modalW05F1602").find('input[type="text"]');
    for (var i=0;i<els.length;i++){
        ////console.log($(els[i]).val());
        $(els[i]).attr('title',$(els[i]).val());
    }

</script>
