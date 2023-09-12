<div class="modal draggable fade modal" id="modalW09F4444" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW09F4444" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,"Thong_tin_nhan_vien"),"W09F4444",true,'closeW09F4444')}}
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <fieldset>
                            <legend class="legend">{{Helpers::getRS($g,"To_chuc")}}</legend>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Nhan_vien')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["EmployeeName_ID"]}}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Chuc_vu')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["DutyName"]}}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Don_vi')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["DivisionName"]}}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Cong_viec')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["WorkName"]}}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Khoi')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["BlockName"]}}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Ngay_vao_lam')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["DateJoined"]}}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Phong_ban')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["DepartmentName"]}}</label>
                                        </div>
                                        <div class="col-md-2 pdr0">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Nguoi_QL_truc_tiep')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["DirectManagerName"]}}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'To_nhom')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["TeamName"]}}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'DT_tinh_luong')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{$rsData["SalaryLevelName"]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    @if ($rsData['EmployeePicture']!="")
                                        <img src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen($rsData['EmployeePicture']), $rsData['EmployeePicture']))}}"
                                             class="user-image" alt="Employee Picture" style="height: 120px"/>
                                    @else
                                        <img src="{{asset('packages/default/L3/images/icon-user-default.png')}}"
                                             class="user-image imgborder" style="height: 120px;width: 100px"/>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="legend">{{Helpers::getRS($g,"Ca_nhan")}}</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'So_CMND')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <label>{{$rsData["NumIDCard"]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Ngay_cap')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <label>{{$rsData["NumIDCardDate"]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Noi_cap')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$rsData["NumIDCardPlace"]}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Ngay_sinh')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <label>{{$rsData["BirthDate"]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Gioi_tinh')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <label>{{$rsData["Sex"]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Ma_so_thue')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$rsData["IncomeTaxCode"]}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Dien_thoai')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <label>{{$rsData["Telephone"]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Di_dong')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <label>{{$rsData["Pager"]}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="lbl-normal">Email</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$rsData["Email"]}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 colcustom" style="width: 13.88%">
                                    <label class="lbl-normal">{{Helpers::getRS($g,'Dia_chi_lien_lac')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <label>{{$rsData["ContactAddress"]}}</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function closeW09F4444() {
        $("#modalW09F4444").modal("hide");
    }
</script>
