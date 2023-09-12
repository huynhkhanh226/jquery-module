<div class="modal draggable fade modal" id="modalW94F4001" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading($title,"W94F4001")}}
            </div>
            <div class="modal-body pd10">
                <form id="frmW94F4001">
                    <div class="row form-group">
                        <div class="col-md-1">
                            <div class="radio mgt5">
                                <label>
                                    <input name="optIsPeriodW94F4001" id="optIsPeriodW94F4001_1" value="1" checked autocomplete="off"
                                           type="radio">
                                    {{Helpers::getRS($g,"Ky")}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <select id="cboPeriodFromW94F4001"
                                    name="cboPeriodFromW94F4001"
                                    class="form-control required" autocomplete="off"
                                    required>
                                @foreach($rsPeriod as $row)
                                    <option title="{{$row["Period"]}}"
                                            value="{{$row["Period"]}}">{{$row["Period"]}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <select id="cboPeriodToW94F4001" autocomplete="off"
                                    name="cboPeriodToW94F4001"
                                    class="form-control required"
                                    required>
                                @foreach($rsPeriod as $row)
                                    <option title="{{$row["Period"]}}"
                                            value="{{$row["Period"]}}">{{$row["Period"]}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Khach_hang")}}</label>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <select id="cboCustomerW94F4001"
                                    name="cboCustomerW94F4001" autocomplete="off"
                                    class="form-control selectpicker required" multiple data-actions-box="true"
                                    data-live-search="true" multiple data-max-options="20"
                                    required>
                                @foreach($rsCustomers as $row)
                                    <option title="{{$row["CustomerID"]}}"
                                            value="{{$row["CustomerID"]}}">{{$row["CustomerName"]}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button id="btnFilterW94F4001" type="button"
                                    class="btn btn-default smallbtn pull-left mgr5"><span
                                        class="digi digi-filter"></span>
                                &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                            <input type="submit" class="hide" id="btnSubmitFilterW94F4001"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-1">
                            <div class="radio mgt5">
                                <label>
                                    <input name="optIsPeriodW94F4001" id="optIsPeriodW94F4001_0" value="0" autocomplete="off"
                                           type="radio">
                                    {{Helpers::getRS($g,"Ngay")}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" class="form-control" id="txtDateFromW94F4001" autocomplete="off"
                                       name="txtDateFromW94F4001" value="" required><span
                                        class="input-group-addon"><i
                                            onclick="showDateFrom()"
                                            class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" class="form-control" id="txtDateToW94F4001" autocomplete="off"
                                       name="txtDateToW94F4001" value="" required><span
                                        class="input-group-addon"><i
                                            onclick="showDateTo()"
                                            class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"San_pham")}}</label>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <select id="cboProductW94F4001"
                                    name="cboProductW94F4001" autocomplete="off"
                                    class="form-control selectpicker required" multiple data-actions-box="true"
                                    data-live-search="true" multiple data-max-options="10"
                                    required>
                                @foreach($rsProducts as $row)
                                    <option title="{{$row["InventoryID"]}}"
                                            value="{{$row["InventoryID"]}}">{{$row["InventoryName"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                <div class="row form-group">
                    <div class="col-md-12 col-xs-12">
                        @include('W9X.W94.W94F4001_Grid')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showDateFrom() {
        if ($("#optIsPeriodW94F4001_0").is(":checked")) {
            $('#txtDateFromW94F4001').datepicker('show');
        }
    }

    function showDateTo() {
        if ($("#optIsPeriodW94F4001_0").is(":checked")) {
            $('#txtDateToW94F4001').datepicker('show');
        }

    }

    $(document).ready(function () {
        $("#modalW94F4001").find(".modal-content").height($(document).height() - 20);
        $('#txtDateFromW94F4001').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateToW94F4001').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $("#cboCustomerW94F4001").val($("#cboCustomerW94F4001 option:first").val());
        $("#cboProductW94F4001").val($("#cboProductW94F4001 option:first").val());
        $("#cboCustomerW94F4001").selectpicker({
            maxOptions: 20,
            maxOptionsText: "{{Helpers::getRS(0,'Ban_chi_duoc_chon_toi_da').' 20 '. Helpers::getRS(0,'Khach_hang')}}"
        });
        $("#cboProductW94F4001").selectpicker({
            decreaseHeight: 40,
            maxOptions: 20,
            maxOptionsText: "{{Helpers::getRS(0,'Ban_chi_duoc_chon_toi_da').' 20 '. Helpers::getRS(0,'San_pham')}}"
        });
        $("#optIsPeriodW94F4001_1").change(function () {
            console.log("optIsPeriodW94F4001_1");
            if ($(this).is(":checked")) {
                $("#cboPeriodFromW94F4001").prop("disabled", "");
                $("#cboPeriodToW94F4001").prop("disabled", "");
                $("#txtDateFromW94F4001").prop("disabled", "disabled");
                $("#txtDateToW94F4001").prop("disabled", "disabled");
                $("#txtDateFromW94F4001").val("");
                $("#txtDateToW94F4001").val("");
            } else {
                $("#cboPeriodFromW94F4001").prop("disabled", "disabled");
                $("#cboPeriodToW94F4001").prop("disabled", "disabled");
                $("#txtDateFromW94F4001").prop("disabled", "");
                $("#txtDateToW94F4001").prop("disabled", "");
                $("#txtDateFromW94F4001").val("{{date('d/m/Y')}}");
                $("#txtDateToW94F4001").val("{{date('d/m/Y')}}");
            }
        });
        $("#optIsPeriodW94F4001_0").change(function () {
            console.log("optIsPeriodW94F4001_0");
            if ($(this).is(":checked")) {
                $("#cboPeriodFromW94F4001").prop("disabled", "disabled");
                $("#cboPeriodToW94F4001").prop("disabled", "disabled");
                $("#txtDateFromW94F4001").prop("disabled", "");
                $("#txtDateToW94F4001").prop("disabled", "");
                $("#txtDateFromW94F4001").val("{{date('d/m/Y')}}");
                $("#txtDateToW94F4001").val("{{date('d/m/Y')}}");

            } else {
                $("#cboPeriodFromW94F4001").prop("disabled", "");
                $("#cboPeriodToW94F4001").prop("disabled", "");
                $("#txtDateFromW94F4001").prop("disabled", "disabled");
                $("#txtDateToW94F4001").prop("disabled", "disabled");
                $("#txtDateFromW94F4001").val("");
                $("#txtDateToW94F4001").val("");
            }
        });
        $("#optIsPeriodW94F4001_1").trigger('change');
        //$('#cboCustomerW94F4001').selectpicker('hideAllButons');
        $('#cboCustomerW94F4001').on('changed.bs.select', function (e) {
            var subdiv = $(this).val();
            if (subdiv != null) {
                if (subdiv[0] == '%') {
                    $('#cboCustomerW94F4001').selectpicker('deselectAll');
                    $('#cboCustomerW94F4001').selectpicker('val', '%');
                    $('#cboCustomerW94F4001').find('[value!="%"]').prop('disabled', 'disabled');
                    $('#cboCustomerW94F4001').selectpicker('refresh');
                } else {
                    $('#cboCustomerW94F4001').find('[value="%"]').prop('disabled', 'disabled');
                    $('#cboCustomerW94F4001').selectpicker('refresh');
                }

            } else {
                $('#cboCustomerW94F4001').find('[value!="%"]').prop('disabled', '');
                $('#cboCustomerW94F4001').find('[value="%"]').prop('disabled', '');
                $('#cboCustomerW94F4001').selectpicker('refresh');
            }
        });

        //$('#cboProductW94F4001').selectpicker('hideAllButons');

        $('#cboProductW94F4001').on('changed.bs.select', function (e) {
            console.log("test");
            var subdiv = $(this).val();

            if (subdiv != null) {
                if (subdiv[0] == '%') {
                    $('#cboProductW94F4001').selectpicker('deselectAll');
                    $('#cboProductW94F4001').selectpicker('val', '%');
                    $('#cboProductW94F4001').find('[value!="%"]').prop('disabled', 'disabled');
                    $('#cboProductW94F4001').selectpicker('refresh');

                } else {
                    $('#cboProductW94F4001').find('[value="%"]').prop('disabled', 'disabled');
                    $('#cboProductW94F4001').selectpicker('refresh');

                }
            } else {
                $('#cboProductW94F4001').find('[value!="%"]').prop('disabled', '');
                $('#cboProductW94F4001').find('[value="%"]').prop('disabled', '');
                $('#cboProductW94F4001').selectpicker('refresh');
            }
        });

        $("#btnFilterW94F4001").click(function () {
            validationElements($("#frmW94F4001"), function () {
                if ($("#optIsPeriodW94F4001").is(":checked")){
                    var periodFrom = $("#cboPeriodFromW94F4001");
                    var periodTo = $("#cboPeriodToW94F4001");
                    var begin = convertStringToDate("01/" + periodFrom.val());
                    var end = convertStringToDate("01/" + periodTo.val());

                    if (daydiff(begin, end) < 0) {
                        periodFrom.val('');
                        periodFrom.get(0).setCustomValidity("{{Helpers::getRS($g,'Ky_tu_phai_nho_hon_ky_den')}}");
                    }
                }else{
                    var txtDateFromW94F4001 = $("#txtDateFromW94F4001");
                    var txtDateToW94F4001 = $("#txtDateToW94F4001");
                    var begin = convertStringToDate( txtDateFromW94F4001.val());
                    var end = convertStringToDate(txtDateToW94F4001.val());
                    if (daydiff(begin, end) < 0) {
                        txtDateFromW94F4001.val('');
                        txtDateFromW94F4001.get(0).setCustomValidity("{{Helpers::getRS($g,'Ngay_tu_phai_nho_hon_ngay_den')}}");
                    }
                }



                $("#btnSubmitFilterW94F4001").click();
            });
        });

        $("#frmW94F4001").submit(function (e) {
            e.preventDefault();
            var customer = $('#cboCustomerW94F4001').selectpicker('val').join(";");
            var product = $('#cboProductW94F4001').selectpicker('val').join(";");
            postMethod('{{url('/W94F4001/D94F4001/0/loadgrid')}}', function (res) {
                var data = reformatData( JSON.parse(res), $("#gridW94F4001"));
                $("#gridW94F4001").pqGrid('option', 'dataModel.data', data);
                resizePqGrid();
                $("#gridW94F4001").find(".pq-group-menu").addClass("hide");
            }, $("#frmW94F4001").serialize() + "&customer=" + customer + "&product=" + product)
        });
    });


</script>
