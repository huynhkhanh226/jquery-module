
<div class="nav-tabs-custom" style="margin-top: 5px">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabHotKey" data-toggle="tab" aria-expanded="true">Phím tắt</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tabHotKey">
            <span style="color: blue;font-weight: bold">{{Helpers::getRS($g,"Phim_tat_tren_master")}}</span></br>
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Enter</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Hien_thi_danh_sach_combo")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Tab/Enter</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Chuyen_toi_control_ke_tiep")}}
                </div>
            </div>
           {{-- <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Shift + Tab</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Tro_ve_control_truoc")}}
                </div>
            </div>--}}
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Alt + G</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Chuyen_toi_luoi")}}
                </div>
            </div>

            {{--<div class="row">--}}
                {{--<div class="col-sm-3">--}}
                    {{--<span style="font-weight: bold">Shift + S</span>:--}}
                {{--</div>--}}
                {{--<div class="col-sm-9">--}}
                    {{--{{Helpers::getRS($g,"Luu")}}--}}
                {{--</div>--}}
            {{--</div>--}}

            <span style="color: blue;font-weight: bold">{{Helpers::getRS($g,"Phim_tat_tren_luoi")}}</span></br>
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Delete</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Xoa_cell")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Ctrl + Delete</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Xoa_dong")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Tab/Enter</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Chuyen_toi_cot_ke_tiep")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Shift + Tab</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Chuyen_ve_cot_truoc")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Insert</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Them_dong_moi")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">Ctrl + Shift + L</span>:
                </div>
                <div class="col-sm-9">
                    Save
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span class="fa fa-long-arrow-up"></span>
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Tro_ve_dau_chuoi_trong_cell")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span class="fa fa-long-arrow-down"></span>
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Di_chuyen_toi_cuoi_chuoi_trong_cell")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span class="fa fa-long-arrow-left text-bold"></span>
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Tro_ve_truoc_mot_ki_tu_trong_cell")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span class="fa fa-long-arrow-right text-bold"></span>
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"Chuyen_toi_mot_ki_tu_trong_cell")}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span style="font-weight: bold">ESC</span>:
                </div>
                <div class="col-sm-9">
                    {{Helpers::getRS($g,"DongU1")}} Drodown Popup
                </div>
            </div>
        </div>
    </div>
</div>

