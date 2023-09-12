<div class="modal draggable" id="modalW75F3010" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 85%">
        <div class="modal-content" style = "height: 400px">
            <div class="modal-header">
                {{Helpers::generateHeading($modalTitle,"W75F3010")}}
            </div>
            <div id="divScrollbarW75F3010">
                <div class="modal-body">
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-2 col-xs-4">
                            @if ($rsEmployee['EmployeePicture']!="")
                                <img src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen($rsEmployee['EmployeePicture']), $rsEmployee['EmployeePicture']))}}"
                                     class="user-image" alt="Employee Picture" style="height: 120px"/>
                            @else
                                <img src="{{asset('packages/default/L3/images/icon-user-default.png')}}" class="user-image imgborder" style="height: 120px;width: 100px"/>
                            @endif
                        </div>
                        <div class="col-md-10 col-xs-8">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <label>{{mb_strtoupper($rsEmployee["EmployeeName"])}}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="lbl-normal">{{Helpers::getRS($g,"Don_vi")}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label>{{$rsEmployee["DivisionName"]}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_QL_truc_tiep")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <label>{{mb_strtoupper($rsEmployee["DirectManagerName"])}}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="lbl-normal">{{Helpers::getRS($g,"Khoi")}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label>{{$rsEmployee["BlockName"]}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"DT_tinh_luong")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <label>{{mb_strtoupper($rsEmployee["SalaryObjectName"])}}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label>{{$rsEmployee["DepartmentName"]}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_vao_lam")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <label>{{mb_strtoupper($rsEmployee["DateJoined"])}}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="lbl-normal">{{Helpers::getRS($g,"To_nhom")}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label>{{$rsEmployee["TeamName"]}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Cong_viec")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <label>{{$rsEmployee["WorkName"]}}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="lbl-normal">{{Helpers::getRS($g,"Chuc_vu")}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label>{{$rsEmployee["DutyName"]}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <fieldset class="mgt5">
                        <legend class="legend">{{Helpers::getRS($g,"Giay_to_tuy_than_")}}</legend>
                        <div class="row  mgl0">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"So_CMND")}}</label>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label>{{$rData["NumIDCard"]}}</label>
                                <button id="btnTelephone"
                                        class="glyphicon glyphicon-edit text-orange no-border"
                                        onclick="loadW75F1010('NUMIDCARD')"></button>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal mgr10">{{Helpers::getRS($g,"Ngay_cap")}}</label>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label>{{$rData["NumIDCardDate"]}}</label>
                                <button id="btnTelephone"
                                        class="glyphicon glyphicon-edit text-orange no-border"
                                        onclick="loadW75F1010('NUMIDDATE')"></button>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal mgr10">{{Helpers::getRS($g,"Noi_cap")}}</label>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label>{{$rData["NumIDCardPlace"]}}</label>
                                <button id="btnTelephone"
                                        class="glyphicon glyphicon-edit text-orange no-border"
                                        onclick="loadW75F1010('NUMIDPLACE')"></button>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_lien_lac")}}</legend>
                        <div class="row  mgl0">
                            <div class="col-md-5 col-xs-5">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Dien_thoai")}}</label>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <label>{{$rData["Telephone"]}}</label>
                                    </div>
                                    <div class="col-md-2 col-xs-2 text-right">
                                        <button id="btnTelephone"
                                                class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('TEL')"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Dia_chi_lien_lac")}}</label>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <label>{{$rData["ContactAddress"]}}</label>
                                    </div>
                                    <div class="col-md-2 col-xs-2 text-right">
                                        <button id="btnContactAddress"
                                                class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('CONADDR')"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  mgl0">
                            <div class="col-md-5 col-xs-5">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"DTDD")}}</label>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <label>{{$rData["Pager"]}}</label>
                                    </div>
                                    <div class="col-md-2 col-xs-2 text-right">
                                        <button id="btnPager" class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('MOBILE')"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Dia_chi_tam_tru")}}</label>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <label>{{$rData["ProvisionalAddress"]}}</label>
                                    </div>
                                    <div class="col-md-2 col-xs-2 text-right">
                                        <button id="btnProvisionalAddress"
                                                class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('PROADDR')"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  mgl0">
                            <div class="col-md-5 col-xs-5">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <label class="lbl-normal">Email</label>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <label>{{$rData["Email"]}}</label>
                                    </div>
                                    <div class="col-md-2 col-xs-2 text-right">
                                        <button id="btnEmail" class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('EMAIL')"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Dia_chi_thuong_tru")}}</label>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <label>{{$rData["Address"]}}</label>
                                    </div>
                                    <div class="col-md-2 col-xs-2 text-right">
                                        <button id="btnAddress"
                                                class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('PERADDR')"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="mgb5">
                        <legend class="legend">{{Helpers::getRS($g,"Nguoi_lien_heU")}}</legend>
                        <div class="row  mgl0">
                            <div class="col-md-3 col-xs-3">
                                <div class="row">
                                    <div class="col-md-5 col-xs-6">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ten")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <label>{{$rData["EmContactName1"]}}</label>
                                        <button id="btnTelephone"
                                                class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('EMCONNAME1')"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <div class="row">
                                    <div class="col-md-5 col-xs-6">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Dien_thoai")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <label>{{$rData["EmContactPhone1"]}}</label>
                                        <button id="btnTelephone"
                                                class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('EMCONPHONE1')"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Dia_chi_lien_lac")}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <label>{{$rData["EmContactAddress1"]}}</label>
                                <button id="btnTelephone"
                                        class="glyphicon glyphicon-edit text-orange no-border"
                                        onclick="loadW75F1010('EMCONADD1')"></button>
                            </div>
                        </div>
                        <div class="row  mgl0" style="padding-bottom: 10px">
                            <div class="col-md-3 col-xs-3">
                                <div class="row">
                                    <div class="col-md-5 col-xs-6">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ten")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <label>{{$rData["EmContactName2"]}}</label>
                                        <button id="btnTelephone"
                                                class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('EMCONNAME2')"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <div class="row">
                                    <div class="col-md-5 col-xs-6">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Dien_thoai")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <label>{{$rData["EmContactPhone2"]}}</label>
                                        <button id="btnTelephone"
                                                class="glyphicon glyphicon-edit text-orange no-border"
                                                onclick="loadW75F1010('EMCONPHONE2')"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Dia_chi_lien_lac")}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <label>{{$rData["EmContactAddress2"]}}</label>
                                <button id="btnTelephone"
                                        class="glyphicon glyphicon-edit text-orange no-border"
                                        onclick="loadW75F1010('EMCONADD2')"></button>
                            </div>
                        </div>
                    </fieldset>
                </div>
                </div>
            </div>
            <div class="l3loading hide"></div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<section id="secW75F1010"></section>
<script>
    function loadW75F1010(id){
        $("#modalW75F3010").find(".l3loading").removeClass("hide");
        $.ajax({
            method: 'GET',
            url: '{{url("W75F1010/addnew")}}/'+id,
            success: function (data) {
                var d = new Date();
                var suffix = d.getTime();
                var divParent = "divModalChild_" + suffix.toString();
                var parentNode = document.createElement("div");
                parentNode.id = divParent;
                $("#divModalContainer").append(parentNode);

                $("#" + divParent).html(data);

//                setTimeout(function(){
//                    $("#modalW75F1010").find(".header-icon-close").removeClass('hide');
//                    $(".fa-info-circle").removeClass('mgr5');
//                }, 1000);

                $("#modalW75F1010").modal("show");
                $("#modalW75F3010").find(".l3loading").addClass("hide");

            }
        });

    }

    $(document).ready(function () {
        //$("#divScrollbarW75F3010").height($(document).height() - 510);
        $("#divScrollbarW75F3010").height(350);
        $("#divScrollbarW75F3010").mCustomScrollbar({
            axis: "y",
            theme: "rounded-dark",
            scrollButtons: {enable: true},
            autoExpandScrollbar: true,
            advanced: {autoExpandHorizontalScroll: true},
            scrollInertia: 100,
            //scrollbarPosition:"outside"
        });
    });
</script>