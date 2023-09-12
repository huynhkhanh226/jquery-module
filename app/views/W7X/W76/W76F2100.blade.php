<section class="content">
    <div>
        <form id="frmW76F2100">
            <div class="row mgb5">
                <label class="col-md-2 lbl-normal">{{Helpers::getRS($g,"Ngay_gui")}}</label>
                <div class="col-md-4">
                    <div class="input-group">

                        <input type="text" class="form-control pull-right" id="txtReceiveSendDateW76F2100"
                               autocomplete="off"
                               name="txtReceiveSendDateW76F2100">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar pointer" onclick="$('#txtReceiveSendDateW76F2100').click()"></i>
                        </div>
                        <div class="input-group-addon">
                            <i class="fa fa-remove text-red pointer" id="removeReceiveSendDateW76F2100"></i>
                        </div>
                    </div>
                </div>
                <label class="col-md-2 lbl-normal">{{Helpers::getRS($g,"So_cong_van")}}</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txtDocNoW76F2100" name="txtDocNoW76F2100">
                </div>

            </div>
            <div class="row mgb5">
                <label class="col-md-2 lbl-normal">{{Helpers::getRS($g,"Nguoi_gui")}}</label>
                {{--<div class="col-sm-4">--}}
                    {{--<select style="width: 100%; " id="txtSenderIDW76F2100" name="txtSenderIDW76F2100">--}}
                        {{--<option value="">--</option>--}}
                        {{--@foreach($ListSender as $item)--}}
                            {{--<option value="{{$item=['ID']}}">{{$item = ['Name']}}</option>--}}
                        {{--@endforeach--}}

                    {{--</select>--}}
                {{--</div>--}}

                <div class="col-sm-4">
                    <select style="width: 100%; " id="txtSenderIDW76F2100"
                            name="txtSenderIDW76F2100">
                        <option value="">--</option>
                        @foreach(json_decode($ListSender) as $item)
                            <option value="{{$item->ID}}">{{$item->Name}}</option>
                        @endforeach

                    </select>
                </div>


                <label class="col-md-2 lbl-normal">{{Helpers::getRS($g,"Tu_khoa")}}</label>
                <div class="col-sm-4">
                    <input type="text" id="txtKeyWordW76F2100" class="form-control" name='txtKeyWordW76F2100'>
                </div>
            </div>
            <div class="row mgb5 collapse">
                <label class="col-md-2 lbl-normal">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
                <div class="col-md-4">
                    <div class="input-group">

                        <input type="text" class="form-control pull-right" id="txtEffectDateFromW76F2100"
                               autocomplete="off"
                               name="txtEffectDateFromW76F2100">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar pointer" onclick="$('#txtEffectDateFromW76F2100').click()"></i>
                        </div>
                        <div class="input-group-addon" onclick="">
                            <i class="fa fa-remove text-red" id="removeEffectDateFromW76F2100"></i>
                        </div>
                    </div>
                </div>
                <label class="col-md-2 lbl-normal">{{Helpers::getRS($g,"Ngay_het_hieu_luc")}}</label>
                <div class="col-md-4">
                    <div class="input-group">

                        <input type="text" class="form-control pull-right" autocomplete="off"
                               id="txtEffectDateToW76F2100"
                               name="txtEffectDateToW76F2100">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar pointer" onclick="$('#txtEffectDateToW76F2100').click()"></i>
                        </div>
                        <div class="input-group-addon" onclick="">
                            <i class="fa fa-remove text-red" id="removeEffectDateToW76F2100"></i>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mgb5 collapse">
                <label class="col-md-2 lbl-normal">{{Helpers::getRS($g,"Do_khan_cap")}}</label>
                <div class="col-sm-4">

                    <select style="width: 100%; " id="cbEmergencyW76F2100" name="cbEmergencyW76F2100">
                        @foreach($levelList as  $item)
                            <option value="{{$item['ID']}}">{{$item['Name']}}</option>
                        @endforeach

                    </select>
                </div>
                <label class="col-md-2 lbl-normal">{{Helpers::getRS($g,"Do_bao_mat")}}</label>
                <div class="col-sm-4">
                    <select style="width: 100%; " id="cbSecurityW76F2100" name="cbSecurityW76F2100">
                        @foreach($levelListSecurity as  $item)
                            <option value="{{$item['ID']}}">{{$item['Name']}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="row mgb5 collapse">
                <label class="col-md-2 lbl-normal">{{Helpers::getRS($g,"Nhom_van_ban")}}</label>
                <div class="col-sm-4">
                    <select id='txtDocGroupIDW76F2100' name='txtDocGroupIDW76F2100' style="width: 100%; ">
                        @foreach(json_decode($rsData) as  $item)
                            <option value="{{$item->DocGroupCode}}">{{$item->DocGroupName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mgb5">
                <div class="col-md-12 text-center">
                    <a id="W76F2100Btn_expand">
                                <span class="fa fa-angle-double-down"
                                      style="font-size: 200%; marin-bottom: -10px;"></span>
                    </a>
                </div>
            </div>
            <div class="row mgb5">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <button class='hide' id="W76F2100Btn_Submit"></button>
                    <div id="toolbarW76F2100">
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div id="gridW76F2100"></div>
            </div>
        </div>
    </div>
</section>
<script>

    $('#W76F2100Btn_expand').click(function (e) {
        e.preventDefault();
        $('.collapse').collapse('toggle');
        $('.collapse').toggleClass("hide");
        $(this).find("span").toggleClass('fa-angle-double-down');
        $(this).find("span").toggleClass('fa-angle-double-up');
        setTimeout(function () {
            resizePqGrid();
        }, 400);
    })

    $('#frmW76F2100').on('submit', function (e) {
        e.preventDefault();
        var dateFromReceiveSendDate = $('#txtReceiveSendDateW76F2100').data('daterangepicker').startDate.format('MM/DD/YYYY');
        var dateToReceiveSendDate = $('#txtReceiveSendDateW76F2100').data('daterangepicker').endDate.format('MM/DD/YYYY');
        if ($("#txtReceiveSendDateW76F2100").val() == '') {
            dateFromReceiveSendDate = '';
            dateToReceiveSendDate = '';
        }


        var dateFromEffectDateFrom = $('#txtEffectDateFromW76F2100').data('daterangepicker').startDate.format('MM/DD/YYYY');
        var dateToEffectDateFrom = $('#txtEffectDateFromW76F2100').data('daterangepicker').endDate.format('MM/DD/YYYY');

        if ($("#txtEffectDateFromW76F2100").val() == '') {
            dateFromEffectDateFrom = '';
            dateToEffectDateFrom = '';
        }


        var dateFromEffectDateTo = $('#txtEffectDateToW76F2100').data('daterangepicker').startDate.format('MM/DD/YYYY');
        var dateToEffectDateTo = $('#txtEffectDateToW76F2100').data('daterangepicker').endDate.format('MM/DD/YYYY');

        if ($("#txtEffectDateToW76F2100").val() == '') {
            dateFromEffectDateTo = '';
            dateToEffectDateTo = '';
        }

        $.ajax({
            method: "POST",
            url: '{{url("/W76F2100/view/$pForm/$g/filter")}}',
            data: $('#frmW76F2100').serialize() + "&dateFromReceiveSendDate=" + dateFromReceiveSendDate + "&dateToReceiveSendDate=" + dateToReceiveSendDate
                + "&dateFromEffectDateFrom=" + dateFromEffectDateFrom + "&dateToEffectDateFrom=" + dateToEffectDateFrom
                + "&dateFromEffectDateTo=" + dateFromEffectDateTo + "&dateToEffectDateTo=" + dateToEffectDateTo,
            success: function (data) {
                $('#gridW76F2100').html(data);
            }
        });
    })

    var exportW76F2100 = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#W76F2100_Grid"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#W76F2100_Grid").pqGrid("option", "dataModel.data"));
        var now = new Date();
        var d = new Date();
        var toDay = d.getTime();
        $.ajax({
            method: "POST",
            data: {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "Document_" + toDay + ".xls";
                    downloadLink.innerHTML = "Document File";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };

    $(document).ready(function () {
        $("#removeReceiveSendDateW76F2100").click(function () {
            var d = Date.now();
            var val = convertDateToString(d);
            $('#txtReceiveSendDateW76F2100').data('daterangepicker').setStartDate(val);
            $('#txtReceiveSendDateW76F2100').data('daterangepicker').setEndDate(val);
            $("#txtReceiveSendDateW76F2100").val('');
        });
        $("#removeEffectDateFromW76F2100").click(function () {
            var d = Date.now();
            var val = convertDateToString(d);
            $('#txtEffectDateFromW76F2100').data('daterangepicker').setStartDate(val);
            $('#txtEffectDateFromW76F2100').data('daterangepicker').setEndDate(val);
            $("#txtEffectDateFromW76F2100").val('');
        });
        $("#removeEffectDateToW76F2100").click(function () {
            var d = Date.now();
            var val = convertDateToString(d);
            $('#txtEffectDateToW76F2100').data('daterangepicker').setStartDate(val);
            $('#txtEffectDateToW76F2100').data('daterangepicker').setEndDate(val);
            $("#txtEffectDateToW76F2100").val('');
        });

        var permission = Number("{{$permission}}");
        $("#toolbarW76F2100").digiMenu({
                showText: true,
                buttonList: [
                    {
                        ID: "btnAddW76F2100",
                        icon: "fa fa-plus text-blue",
                        title: "{{Helpers::getRS($g,'Them_moi1')}}",
                        enable: function () {
                            return permission >= 2
                        },
                        hidden: function () {
                            return !(permission >= 2)
                        },
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            console.log(ui);
                            ui.$btn.click(function () {
                                showFormDialogPost('{{url("/W76F2101/$pForm/$g")}}' + "/add", 'modalW76F2101');
                            });
                        }
                    }
                    , {
                        ID: "btnExportW76F2100",
                        icon: "fa fa-file-excel-o text-red text-bold",
                        title: "{{Helpers::getRS($g,'Xuat_Excel_U')}}",
                        enable: function () {
                            return true;
                        },
                        hidden: false,
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                exportW76F2100()
                            });
                        }
                    }
                    , {
                        ID: "txtSearchValueW76F2100",
                        icon: "fa  fa-search text-yellow",
                        title: "{{Helpers::getRS($g, 'Tim_kiem')}}",
                        enable: true,
                        hidden: function () {
                            return false;
                        },
                        cls: "",
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                $('#btnSubmitW76F2100').click();
                            });
                        }
                    }
                    , {
                        ID: "btnSubmitW76F2100",
                        icon: "fa fa-file-excel-o text-red text-bold",
                        title: "submit",
                        enable: true,
                        hidden: true,
                        type: "submit",
                        cls: "pull-right",
                        render: function (ui) {
                        },
                        postRender: function (ui) {

                        }
                    }
                ]
            }
        );

        $('#txtReceiveSendDateW76F2100').daterangepicker({format: 'DD/MM/YYYY'});
        $('#txtEffectDateFromW76F2100').daterangepicker({format: 'DD/MM/YYYY'});
        $('#txtEffectDateToW76F2100').daterangepicker({format: 'DD/MM/YYYY'});


        $('#btnSubmitW76F2100').trigger('click');
    });


</script>