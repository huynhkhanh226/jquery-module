<style type="text/css">
    .box {
        border-top: 0;
        margin-bottom: 0
    }

    .box-header {
        padding: 0px
    }

    .nav-tabs-custom > .nav-tabs > li > a, .nav-tabs-custom > .nav-tabs > li > a:hover {
        background: transparent;
        margin: 0;
        font-weight: 900;
    }

    .nav-tabs-custom {
         margin-bottom: 0px;
         box-shadow: 0 0px 0px rgba(0, 0, 0, 0.1);
    }
    :disabled {
         background-color: #eee !important;
        /* background-color: #ddd !important; */
    }

    .panel-title > a, .panel-title > small, .panel-title > .small, .panel-title > small > a, .panel-title > .small > a {
        color: #3c8dbc;
        font-weight: 600;
    }
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #d2d6de;
        border-radius: 0px;
    }
    .dx-texteditor {
        background: #fff;
        border: 1px solid #d2d6de;
        border-radius: 0px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 25px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 24px;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid #d2d6de;
        height: 26px;
        line-height: 25px;
    }

    .select2-container .select2-selection--single {
        height: 26px;
        padding: 6px 0 0 0;
    }

    .pq-select-text>.pq-select-item {
        padding: 2px 0 2px 3px;
        margin: 1px;
        line-height: 10px;
        display: inline-block;
        font-size: 90%;
        font-weight: 400;
    }
    .pq-grid .pq-editor-focus {
        height: 91%;
    }
</style>
<div class="modal fade" id="modalW09F1100" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F1100,"W09F1100",true,"funcLoseModalW09F1100")}}
            </div>


            <div class="modal-body" style="padding: 10px;">
                <div class="row form-group">
                    <div class="col-md-12">
                        <div id="toolbarW09F1100">
                        </div>
                    </div>
                </div>
                <div class="divContentW09F1100">
                    <div class="box box-success">
                        <div class="box-header with-border hide">
                            <div class="box-tools pull-right">
                                <button id='BtnDiv1_collapse' type="button" class="btn btn-box-tool hide"
                                        data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool hide" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="divMasterW09F1100">

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <div id="gridW09F1100" class="gridParam"></div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" id="chkAllW09F1100"
                                                       name="chkAllW09F1100">{{Helpers::getRS($g,'Hien_thi_danh_muc_khong_su_dung')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="box box-success">
                        <div class="box-header " style="text-align: center;">
                            <h3 class="box-title"><span id="expandMasterW09F1100" class="fa fa-chevron-up text-blue"></span>
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="divDetailW09F1100">
                                <form id="FrmW09F1100">

                                    <div class="row form-group">
                                        <div class="col-sm-12">
                                            <div class="nav-tabs-custom" style = "box-shadow: 0 0px 0px rgba(0, 0, 0, 0.1);">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a data-toggle="tab"
                                                                          href="#menu1">{{Helpers::getRS($g,'Yeu_cau_chung')}}</a>
                                                    </li>
                                                    <li class=""><a data-toggle="tab"
                                                                    href="#menu2">{{Helpers::getRS($g,'Yeu_cau_cong_viec')}}</a>
                                                    </li>
                                                    <li class=""><a data-toggle="tab"
                                                                    href="#menu3">{{Helpers::getRS($g,'Mo_ta_cong_viec')}}</a>
                                                    </li>
                                                    <li class=""><a data-toggle="tab"
                                                                    href="#menu4">{{Helpers::getRS($g,'Bo_chi_tieu')}}</a>
                                                    </li>
                                                    <li class=""><a id='Coef_tab' data-toggle="tab"
                                                                    href="#menu5">{{Helpers::getRS($g,'He_so')}}</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" style="padding-bottom: 0px;">

                                                    <div id="menu1" class="tab-pane active">
                                                        <div class="row form-group " style="height: 0px">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Gioi_tinh')}}
                                                            </label>
                                                            <div class='col-sm-4'>
                                                                <div class="row form-group">

                                                                    <div class="col-sm-3 pdr0">
                                                                        <select id="txtSexNameW09F1100"
                                                                                name='txtSexNameW09F1100'
                                                                                class="form-control">
                                                                            @foreach($cbGender as $item)
                                                                                <option value="{{$item['Sex']}}">{{$item['SexName']}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class='col-sm-2'>

                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="row form-group">
                                                                    <label style=""
                                                                           class="control-label col-sm-3">
                                                                        {{Helpers::getRS($g,'Tuoi')}}
                                                                    </label>
                                                                    <div class="col-sm-3  pdr0">
                                                                        <input id='txtFromAgeW09F1100'
                                                                               name='txtFromAgeW09F1100'
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="col-sm-1">-</div>

                                                                    <div class="col-sm-3 pdl0 ">
                                                                        <input id='txtToAgeW09F1100'
                                                                               name='txtToAgeW09F1100'
                                                                               class="form-control">

                                                                    </div>
                                                                    <label class="control-label col-sm-2">
                                                                        {{Helpers::getRS($g,'(tuoi)')}}
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row form-group" style="height: 0px;">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Chieu_cao')}}
                                                            </label>
                                                            <div class='col-sm-4'>
                                                                <div class="row form-group">

                                                                    <div class="col-sm-3 pdr0">
                                                                        <input id="txtFromHeightW09F1100"
                                                                               name="txtFromHeightW09F1100"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="col-sm-1">-</div>

                                                                    <div class="col-sm-3 pdl0">
                                                                        <input id="txtToHeightW09F1100"
                                                                               name="txtToHeightW09F1100"
                                                                               class="form-control">

                                                                    </div>
                                                                    <label class="control-label col-sm-2">
                                                                        {{Helpers::getRS($g,'(met)')}}
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class='col-sm-2'>

                                                            </div>
                                                            <div class="col-sm-4 ">
                                                                <div class="row form-group">
                                                                    <label style=''
                                                                           class="control-label col-sm-3">
                                                                        {{Helpers::getRS($g,'Can_nang')}}
                                                                    </label>
                                                                    <div class="col-sm-3 pdr0">
                                                                        <input id='txtFromWeightW09F1100'
                                                                               name='txtFromWeightW09F1100'
                                                                               class="form-control ">
                                                                    </div>
                                                                    <div class="col-sm-1">-</div>

                                                                    <div class="col-sm-3 pdl0">
                                                                        <input id='txtToWeightW09F1100'
                                                                               name='txtToWeightW09F1100'
                                                                               class="form-control">

                                                                    </div>
                                                                    <label class="control-label col-sm-2">
                                                                        (kg)
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Suc_khoe')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <input id="txtHealthW09F1100" name="txtHealthW09F1100"
                                                                       class="form-control">

                                                            </div>
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Ngoai_hinh')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <input id="txtAppearanceW09F1100"
                                                                       name="txtAppearanceW09F1100"
                                                                       class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Tinh_trang_hon_nhan')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="cboMaritalStatusW09F1100"
                                                                        name="cboMaritalStatusW09F1100"
                                                                        class="form-control">
                                                                    <option value=""></option>
                                                                    @foreach( $MaritalStatus as $item)
                                                                        <option value="{{$item['MaritalStatusID']}}">{{$item['MaritalStatusName']}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Ho_khau')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="cboPopulationW09F1100"
                                                                        name="cboPopulationW09F1100"
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>
                                                                    @foreach($Population as $item)
                                                                        <option value="{{$item['Code']}}">{{$item['Name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Ton_giao')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id='cboReligionW09F1100'
                                                                        name='cboReligionW09F1100'
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>

                                                                    @foreach($Religion as $item)
                                                                        <option value="{{$item['ReligionID']}}">{{$item['ReligionName']}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Quoc_tich')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="cboNationalityW09F1100"
                                                                        name='cboNationalityW09F1100'
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>

                                                                    @foreach($Nationality  as $item)
                                                                        <option value="{{$item['NationalityID']}}">{{$item['NationalityName']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div id="menu2" class="tab-pane ">
                                                        <fieldset>
                                                            <div class="row form-group">
                                                                <label class="control-label col-sm-2">
                                                                    {{Helpers::getRS($g,'Trinh_do_van_hoaU')}}
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <select id="txtEducationLevelW09F1100"
                                                                            name='txtEducationLevelW09F1100'
                                                                            class="form-control select2 normal">
                                                                        <option value=""></option>

                                                                        @foreach($cbEducation  as $item)
                                                                            <option value="{{$item['EducationLevelID']}}">{{$item['EducationLevelName']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <label class="control-label col-sm-2">
                                                                    {{Helpers::getRS($g,'Trinh_do_chuyen_mon_U')}}
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <select id="txtProfessionalLevelW09F1100"
                                                                            name='txtProfessionalLevelW09F1100'
                                                                            class="form-control select2 normal">
                                                                        <option value=""></option>

                                                                        @foreach($cbProfess  as $item)
                                                                            <option value="{{$item['ProfessionalLevelID']}}">{{$item['ProfessionalLevelName']}}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="control-label col-sm-2">
                                                                    {{Helpers::getRS($g,'Trinh_do_ngoai_ngu')}}
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <select id="txtLanguageLevelW09F1100"
                                                                            name='txtLanguageLevelW09F1100'
                                                                            class="form-control select2 normal">
                                                                        <option value=""></option>

                                                                        @foreach($cbForeignLang  as $item)
                                                                            <option value="{{$item['LanguageLevelID']}}">{{$item['LanguageLevelName']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <label class="control-label col-sm-2">
                                                                    {{Helpers::getRS($g,'Trinh_do_tin_hoc')}}
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <select id="txtComputingLevelW09F1100"
                                                                            name='txtComputingLevelW09F1100'
                                                                            class="form-control select2 normal">
                                                                        <option value=""></option>

                                                                        @foreach($cbComputerLvl  as $item)
                                                                            <option value="{{$item['ComputingLevelID']}}">{{$item['ComputingLevelName']}}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="row form-group">
                                                                <label class="control-label col-sm-2">
                                                                    {{Helpers::getRS($g,'Kinh_nghiem')}}
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <input id="txtExperienceW09F1100"
                                                                           name="txtExperienceW09F1100"
                                                                           class="form-control">


                                                                </div>
                                                                <label class="control-label col-sm-2">
                                                                    {{Helpers::getRS($g,'Muc_luong')}}
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <div class="row form-group">

                                                                        <div class="col-sm-4">
                                                                            <input id="txtSalaryFromW09F1100"
                                                                                   name="txtSalaryFromW09F1100"
                                                                                   class="form-control">
                                                                        </div>
                                                                        <div style='text-align: center'
                                                                             class="col-sm-1">-
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <input id='txtSalaryToW09F1100'
                                                                                   name='txtSalaryToW09F1100'
                                                                                   class="form-control">

                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <select id="cboCurrencyW09F1100"
                                                                                    name='cboCurrencyW09F1100'
                                                                                    class="form-control select2 normal">
                                                                                <option value=""></option>
                                                                                @foreach($Currency as $item)
                                                                                    <option value="{{$item['CurrencyID']}}">{{$item['CurrencyID']}}</option>
                                                                                @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            {{--<div class="row form-group">
                                                                <label class="control-label col-sm-2">
                                                                    {{Helpers::getRS($g,'Nghiep_vu_khac')}}
                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <input id="txtOtherTransactionW09F1100"
                                                                           name="txtOtherTransactionW09F1100"
                                                                           class="form-control">

                                                                </div>
                                                            </div>--}}
                                                            {{--<div class="row form-group">--}}
                                                                {{--<label class="control-label col-sm-2">--}}
                                                                    {{--{{Helpers::getRS($g,'Kinh_nghiem')}}--}}
                                                                {{--</label>--}}
                                                                {{--<div class="col-sm-10">--}}
                                                                    {{--<input id="txtExperienceW09F1100"--}}
                                                                           {{--name="txtExperienceW09F1100"--}}
                                                                           {{--class="form-control">--}}

                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="row form-group" style="height: 27px;">--}}
                                                                {{--<label class="control-label col-sm-2">--}}
                                                                    {{--{{Helpers::getRS($g,'Muc_luong')}}--}}
                                                                {{--</label>--}}
                                                                {{--<div class="col-sm-6">--}}
                                                                    {{--<div class="row form-group">--}}

                                                                        {{--<div class="col-sm-3 pdr0">--}}
                                                                            {{--<input id="txtSalaryFromW09F1100"--}}
                                                                                   {{--name="txtSalaryFromW09F1100"--}}
                                                                                   {{--class="form-control">--}}
                                                                        {{--</div>--}}
                                                                        {{--<div style='text-align: center;width:35px;'--}}
                                                                             {{--class="col-sm-1">---}}
                                                                        {{--</div>--}}

                                                                        {{--<div class="col-sm-3 pdl0">--}}
                                                                            {{--<input id='txtSalaryToW09F1100'--}}
                                                                                   {{--name='txtSalaryToW09F1100'--}}
                                                                                   {{--class="form-control">--}}

                                                                        {{--</div>--}}
                                                                        {{--<div class="col-sm-3">--}}
                                                                            {{--<select id="cboCurrencyW09F1100"--}}
                                                                                    {{--name='cboCurrencyW09F1100'--}}
                                                                                    {{--class="form-control">--}}
                                                                                {{--<option value=""></option>--}}
                                                                                {{--@foreach($Currency as $item)--}}
                                                                                    {{--<option value="{{$item['CurrencyID']}}">{{$item['CurrencyID']}}</option>--}}
                                                                                {{--@endforeach--}}

                                                                            {{--</select>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}

                                                                {{--<div class="col-sm-2">--}}

                                                                {{--</div>--}}


                                                            {{--</div>--}}
                                                            <div class="row form-group">
                                                                <label class="control-label col-sm-2">
                                                                    {{Helpers::getRS($g,'Yeu_cau_khac')}}
                                                                </label>
                                                                <div class="col-sm-10">
                                                <textarea id="txtOtherRequirementW09F1100"
                                                          name="txtOtherRequirementW09F1100"
                                                          class="form-control" rows="5" id="comment"></textarea>

                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div id="menu3" class="tab-pane ">
                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Mo_ta')}}
                                                            </label>
                                                            <div class="col-sm-10">
                                                <textarea id='txtJobDescriptionW09F1100'
                                                          name='txtJobDescriptionW09F1100' class="form-control"
                                                          rows="5" id="comment"></textarea>

                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Ghi_chu')}}
                                                            </label>
                                                            <div class="col-sm-10">
                                                <textarea id="txtNoteW09F1100" name="txtNoteW09F1100"
                                                          class="form-control" rows="5"
                                                          id="comment"></textarea>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="menu4" class="tab-pane ">
                                                        <div class="row form-group">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="nav-tabs-custom">
                                                                    <ul class="nav nav-tabs">
                                                                        <li class="active"><a href="#tab_4_1" data-toggle="tab">{{Helpers::getRS($g,"Tuyen_dung")}}</a></li>
                                                                        <li><a href="#tab_4_2" data-toggle="tab">{{Helpers::getRS($g,"Danh_gia_nhan_vien_sau_thoi_gian_thu_viec")}}</a></li>
                                                                        <li><a href="#tab_4_3" data-toggle="tab">{{Helpers::getRS($g,"Danh_gia_nhan_vien_tai_ky_HDLD")}}</a></li>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active" id="tab_4_1">
                                                                            <div class="row form-group">
                                                                                <div class='col-sm-12'>
                                                                                    <div id="grid2W09F1100">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab_4_2">
                                                                            <div class="row form-group">
                                                                                <div class='col-sm-12'>
                                                                                    <div id="grid2W09F1100_2">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab_4_3">
                                                                            <div class="row form-group">
                                                                                <div class='col-sm-12'>
                                                                                    <div id="grid2W09F1100_3">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="menu5" class="tab-pane ">
                                                        <div class="mgt10">
                                                            <script>
                                                                var count_all = 0;
                                                                var count_disabled = 0;
                                                                var count_enabled = 0;
                                                            </script>
                                                            <?php  $count_e = 0; ?>
                                                            @foreach($Coefficient as $item)
                                                                <script>
                                                                    count_all += 1;
                                                                </script>
                                                                @if($item['Disabled']==0)
                                                                    <?php
                                                                    $count_e += 1
                                                                    ?>
                                                                    <div class="col-sm-4  mgb5">
                                                                        <div class="row">
                                                                            <div>
                                                                                <label class="col-sm-5">
                                                                                    {{$item['ShortU']}}
                                                                                </label>
                                                                                <div class="col-sm-7 pd0">

                                                                                    <input class='CoefficientW09F1100 form-control'
                                                                                           style="width:100%"
                                                                                           round_number="{{$item['Decimals']}}"
                                                                                           id="Coefficient{{$count_e}}"
                                                                                           name="Coefficient{{$count_e}}">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else

                                                                    <script>
                                                                        count_disabled += 1;

                                                                    </script>



                                                                @endif




                                                            @endforeach
                                                            <script>
                                                                if (count_all == count_disabled) {
                                                                    $('#Coef_tab').addClass('disabled');

                                                                }
                                                            </script>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group" style = 'margin-top: -7px'>
                                        <div class="col-sm-12">
                                            <div class="pull-right">
                                                <button style = 'margin-right: 10px;' id="BtnEditW09F1100" type="button"
                                                        class="btn btn-default smallbtn  "><span
                                                            class="glyphicon glyphicon-edit  text-orange mgr5"></span>{{Helpers::getRS($g,'Sua')}}
                                                </button>
                                                <button id='BtnSaveW09F1100' type="button"
                                                        class="btn btn-default smallbtn  hide"><span
                                                            class="glyphicon glyphicon-floppy-saved mgr5 text-blue"></span>{{Helpers::getRS($g,'Luu')}}
                                                </button>
                                                <button style = 'margin-right: 10px;' id='BtnNotSaveW09F1100' type="button"
                                                        class="btn btn-default smallbtn  hide"><span
                                                            class=" glyphicon glyphicon-floppy-remove  mgr5 text-red"></span>{{Helpers::getRS($g,'Khong_luu')}}
                                                </button>
                                            </div>


                                        </div>
                                    </div>

                                    <button id="BtnSubmitW09F1100" type="submit" class="btn btn-default smallbtn hide">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var toggle_var = 0;
    var permission = '{{$permission}}';
    var Duty_id = '';
    var Duty_name = '';
    var mode = 0;//mode để phân biệt tab con
    var gridID = '#grid2W09F1100';//gridID để phân biệt đang ở grid nào

    var flagTab1 = 0;//biến nhận biết tab 1 có đc thêm mới nào chưa
    var flagTab2 = 0;//biến nhận biết tab 2 có đc thêm mới nào chưa
    var flagTab3 = 0;//biến nhận biết tab 3 có đc thêm mới nào chưa

    $("#FrmW09F1100").find(".select2.required").select2({
        containerCssClass : "required"
    });

    $("#FrmW09F1100").find(".select2.normal").select2();

    $('#expandMasterW09F1100').click(function () {
        $('#BtnDiv1_collapse').click();
        if ($(this).hasClass('fa fa-chevron-up')) {
            $(this).removeClass('fa fa-chevron-up')
            $(this).addClass('fa fa-chevron-down');

        }
        else if ($(this).hasClass('fa fa-chevron-down')) {
            $(this).removeClass('fa fa-chevron-down')
            $(this).addClass('fa fa-chevron-up');
        }

    })

    $('#BtnSaveW09F1100').click(function () {
        ask_save(function () {
            $('#BtnSubmitW09F1100').click();
        })
    })
    $('#BtnNotSaveW09F1100').click(function () {
        append_data(Duty_id, Duty_name);
        disableViewW09F1100();
    })

    $('#FrmW09F1100').on('submit', function (e) {
        e.preventDefault();
        var grid2W09F1100_data = $("#grid2W09F1100").pqGrid("option", "dataModel.data");
        var grid2W09F1100_data_2 = $("#grid2W09F1100_2").pqGrid("option", "dataModel.data");
        var grid2W09F1100_data_3 = $("#grid2W09F1100_3").pqGrid("option", "dataModel.data");
        console.log(grid2W09F1100_data_2);
        //console.log(JSON.stringify($("#grid2W09F1100").pqGrid("option", "dataModel.data")));
        console.log($('#FrmW09F1100').serialize());
        $.ajax({
            method: "POST",
            url: "{{url("/W09F1100/".$pForm."/$g/save")}}",
            data: $('#FrmW09F1100').serialize() + '&Duty_id=' + Duty_id + '&Duty_name=' + Duty_name
            + "&Grid2W09F1100=" + JSON.stringify(grid2W09F1100_data)
            + "&Grid2W09F1100_2=" + JSON.stringify(grid2W09F1100_data_2)
            + "&Grid2W09F1100_3=" + JSON.stringify(grid2W09F1100_data_3),
            success: function (data) {
                var currentObject = $.parseJSON(data);
                if (currentObject.status == 'SUCCESS') {

                    save_ok(function () {
                        disableViewW09F1100();
                    });
                }
                else
                    alert_error(currentObject.message);
            }
        });
    });
    $(document).ready(function () {

        setTimeout(function () {
            //setter
            loadGridW09F1100();
        }, 300);

        loadGrid2W09F1100();
        loadGrid2W09F1100_2();
        loadGrid2W09F1100_3();
        toggle_controlW09F1100(true);
        var input1 = $('.CoefficientW09F1100');
        $.each(input1, function (key, item) {
            $(item).inputmask("numeric", {
                radixPoint: ".",
                groupSeparator: ",",
                digits: $(item).attr('round_number'),
                min: 0,
                autoGroup: true,
                rightAlign: true
            });
        });

        $('#txtFromAgeW09F1100, #txtToAgeW09F1100').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 0,
            min: 0,
            max: 150,
            autoGroup: true,
            rightAlign: true
        });

        $('#txtSalaryFromW09F1100, #txtSalaryToW09F1100, #txtFromWeightW09F1100, #txtToWeightW09F1100, #txtFromHeightW09F1100, #txtToHeightW09F1100').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            min: 0,
            autoGroup: true,
            rightAlign: true
        });

        $("#toolbarW09F1100").digiMenu({
                showText: true,
                buttonList: [
                    {
                        ID: "btnAddNewW09F1100",
                        icon: "fa fa-plus text-blue",
                        title: "{{Helpers::getRS($g,'Them')}}",
                        enable: true,
                        hidden: !(permission >= 2),
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            //console.log(ui);
                            ui.$btn.click(function () {
                                showFormDialogPost('{{url("/W09F1101/$pForm/$g")}}', "modalW09F1101", {
                                    action: 'add',
                                });
                            });
                        },
                    },
                    {
                        ID: "btnDeleteAllW09F1100",
                        icon: "fa fa-trash",
                        title: "{{Helpers::getRS($g,'Xoa_tat_caU')}}",
                        enable: true,
                        hidden: !(permission > 3),
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            //console.log(ui);
                            ui.$btn.click(function () {
                                ask_delete(function () {
                                    var gridW09F1100_data = JSON.stringify($("#gridW09F1100").pqGrid("option", "dataModel.data"));

                                    $.ajax({
                                        method: "POST",
                                        data: {gridW09F1100_data: gridW09F1100_data},
                                        url: "{{url("/W09F1100/".$pForm."/$g/delete_all")}}",
                                        success: function (data) {
                                            var currentObject = $.parseJSON(data);
                                            if (currentObject.status == 'SUCCESS') {
                                                delete_ok(function () {
                                                });
                                            }
                                            else
                                                alert_error(currentObject.message);
                                        }
                                    });
                                })
                            });
                        },
                    },
                    {
                        ID: "btnExcelW09F1100",
                        icon: "fa fa-file-excel-o text-green",
                        title: "{{Helpers::getRS($g,'Xuat_Excel_U')}}",
                        enable: true,
                        hidden: !(permission >= 1),
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            //console.log(ui);
                            ui.$btn.click(function () {
                                var title = [];
                                var dataIndx = [];
                                var align = [];
                                var format = [];
                                initExportExcell($("#gridW09F1100"), title, dataIndx, align, format);
                                var data = JSON.stringify($("#gridW09F1100").pqGrid("option", "dataModel.data"));
                                var now = new Date();
                                var toDay = convertDate(now.toLocaleDateString());
                                $.ajax({
                                    method: "POST",
                                    data: {title: title, data: data, dataIndx: dataIndx, align: align, format: format},
                                    url: "{{url('/Export')}}",
                                    success: function (data) {
                                        if (data == 0) {
                                            alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                                        }
                                        else {
                                            var downloadLink = document.createElement("a");
                                            downloadLink.download = "{{$titleW09F1100}}" + toDay + ".xls";
                                            downloadLink.innerHTML = "Document File";
                                            downloadLink.href = data;
                                            downloadLink.onclick = destroyClickedElement;
                                            downloadLink.style.display = "none";
                                            document.body.appendChild(downloadLink);
                                            downloadLink.click();
                                        }
                                    }
                                });
                            });
                        },
                    },
                    {
                        ID: "btnUpdateW09F1100",
                        icon: "glyphicon glyphicon-edit text-orange",
                        title: "{{Helpers::getRS($g,'Cap_nhat_chuc_danh_quan_ly')}}",
                        enable: true,
                        hidden: !(permission >= 2),
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            //console.log(ui);
                            ui.$btn.click(function () {
                                showFormDialogPost('{{url("/W09F1102/$pForm/$g")}}', "modalW09F1102");
                            });
                        },
                    },


                ]
            }
        );

        $.AdminLTE.boxWidget.activate();
        var height = $(window).height() - 130;
        $("#modalW09F1100").find(".divContentW09F1100").height(height);
        $("#modalW09F1100").find(".divContentW09F1100").css('overflow-y', 'auto');
        $("#modalW09F1100").find(".divContentW09F1100").css('overflow-x', 'hidden');
    });

    function toggle_controlW09F1100(toggle_OnOFF) {
        $('#txtSexNameW09F1100').prop('disabled', toggle_OnOFF);
        $('#txtFromAgeW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtFromHeightW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtToHeightW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtFromWeightW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtToAgeW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtHealthW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtToWeightW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtAppearanceW09F1100').prop('readonly', toggle_OnOFF);
        $('#cboReligionW09F1100').prop('readonly', toggle_OnOFF);
        $('#cboPopulationW09F1100').prop('disabled', toggle_OnOFF);
        $('#cboMaritalStatusW09F1100').prop('disabled', toggle_OnOFF);
        $('#cboNationalityW09F1100').prop('disabled', toggle_OnOFF);
        $('#txtEducationLevelW09F1100').prop('disabled', toggle_OnOFF);
        $('#txtProfessionalLevelW09F1100').prop('disabled', toggle_OnOFF);
        $('#txtLanguageLevelW09F1100').prop('disabled', toggle_OnOFF);
        $('#txtComputingLevelW09F1100').prop('disabled', toggle_OnOFF);
        $('#txtOtherTransactionW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtExperienceW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtSalaryFromW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtSalaryToW09F1100').prop('readonly', toggle_OnOFF);
        $('#cboCurrencyW09F1100').prop('disabled', toggle_OnOFF);
        $('#txtOtherRequirementW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtJobDescriptionW09F1100').prop('readonly', toggle_OnOFF);
        $('#txtNoteW09F1100').prop('readonly', toggle_OnOFF);
        $('#cboReligionW09F1100').prop('disabled', toggle_OnOFF);
        $('.CoefficientW09F1100').prop('disabled', toggle_OnOFF);
        $('#cboReligionW09F1100').prop('selected', toggle_OnOFF);
        $('#cboPopulationW09F1100').prop('selected', toggle_OnOFF);
        $('#cboMaritalStatusW09F1100').prop('disabled', toggle_OnOFF);
        $('#cboNationalityW09F1100').prop('selected', toggle_OnOFF);
        $('#cboReligionW09F1100').prop('selected', toggle_OnOFF);
        $('#cboCurrencyW09F1100').prop('selected', toggle_OnOFF);
    }

    $('#BtnEditW09F1100').click(function () {
        flagTab1 = 1;
        toggle_controlW09F1100(false);
        $(this).addClass('hide');
        $('#BtnSaveW09F1100').removeClass('hide');
        $('#BtnNotSaveW09F1100').removeClass('hide');

        //grid 1
        $("#grid2W09F1100").pqGrid("option", "showToolbar", true);
        $("#grid2W09F1100").pqGrid("option", "editable", true);
        $("#grid2W09F1100").pqGrid("option", "showToolbar", true);
        var colM = $('#grid2W09F1100').pqGrid("option", "colModel");
        var colIndx = $('#grid2W09F1100').pqGrid("getColIndx", {dataIndx: "View"});
        var colModel = colM[colIndx];
        colModel.hidden = false;
        $('#grid2W09F1100').pqGrid("option", "colModel", colM);
        $("#grid2W09F1100").pqGrid('refreshDataAndView');

        //grid 2
        $("#grid2W09F1100_2").pqGrid("option", "showToolbar", true);
        $("#grid2W09F1100_2").pqGrid("option", "editable", true);
        $("#grid2W09F1100_2").pqGrid("option", "showToolbar", true);

        var colM2 = $('#grid2W09F1100_2').pqGrid("option", "colModel");
        var colIndx2 = $('#grid2W09F1100_2').pqGrid("getColIndx", {dataIndx: "View"});
        var colModel2 = colM2[colIndx2];
        colModel2.hidden = false;
        $('#grid2W09F1100_2').pqGrid("option", "colModel", colM2);
        $("#grid2W09F1100_2").pqGrid('refreshDataAndView');

        //grid 3
        $("#grid2W09F1100_3").pqGrid("option", "showToolbar", true);
        $("#grid2W09F1100_3").pqGrid("option", "editable", true);
        $("#grid2W09F1100_3").pqGrid("option", "showToolbar", true);

        var colM3 = $('#grid2W09F1100_3').pqGrid("option", "colModel");
        var colIndx3 = $('#grid2W09F1100_3').pqGrid("getColIndx", {dataIndx: "View"});
        var colModel3 = colM3[colIndx3];
        colModel3.hidden = false;
        $('#grid2W09F1100_3').pqGrid("option", "colModel", colM3);
        $("#grid2W09F1100_3").pqGrid('refreshDataAndView');

    });


    $('#chkAllW09F1100').click(function () {//lọc lưới theo Disabled// uncheck: hiển thị Disabled = 0 // check: hiển thị all
        var val = $("#chkAllW09F1100").is(":checked") ? "" : "0";
        $("#gridW09F1100").pqGrid("filter", {
            oper: 'replace',
            data: [
                {dataIndx: 'Disabled', condition: 'equal', value: val}
            ]
        }).pqGrid("refreshDataAndView");
        var data = $("#gridW09F1100").pqGrid('option', "dataModel.data");
        if (data.length > 0) {
            $("#gridW09F1100").pqGrid("setSelection", {rowIndx: 0});
            append_data(data[0].DutyID, data[0].DutyName);
        }
        Duty_id = data[0].DutyID;
        Duty_name = data[0].DutyName;
    });

    function append_data(ID, NAME) {
        $.ajax({
            method: "POST",
            data: {
                Duty_ID: ID,
                Duty_NAME: NAME,
                mode: mode,
            },
            url: "{{url("/W09F1100/$pForm/$g/filter")}}",
            success: function (data) {
                data = $.parseJSON(data);
                console.log(data);
                Duty_id = data.Duty_ID;
                Duty_name = data.Duty_Name;
                $("#grid2W09F1100").pqGrid("option", "dataModel.data", data.Tab_Grid);
                $("#grid2W09F1100").pqGrid("refreshDataAndView");

                $("#grid2W09F1100_2").pqGrid("option", "dataModel.data", data.Tab_Grid2);
                $("#grid2W09F1100_2").pqGrid("refreshDataAndView");

                $("#grid2W09F1100_3").pqGrid("option", "dataModel.data", data.Tab_Grid3);
                $("#grid2W09F1100_3").pqGrid("refreshDataAndView");

                //-----Form Tab 1------
                $('#txtSexNameW09F1100').val(data.Tab[0].Sex);
                $('#txtFromHeightW09F1100').val(data.Tab[0].FromHeight);
                $('#txtToHeightW09F1100').val(format2(data.Tab[0].ToHeight, '', 2));
                $('#txtFromWeightW09F1100').val(format2(data.Tab[0].FromWeight, '', 2));
                $('#txtToWeightW09F1100').val(format2(data.Tab[0].ToWeight, '', 2));
                $('#txtHealthW09F1100').val(data.Tab[0].Health);
                $('#txtAppearanceW09F1100').val(data.Tab[0].Appearance);
                var MaritalStatus_val = data.Tab[0].MaritalStatusID;
                $('#cboMaritalStatusW09F1100').val(MaritalStatus_val);
                var Population_var = data.Tab[0].PopulationID;
                setSelect2Value($("#cboPopulationW09F1100"),Population_var);
                var Religion_val = data.Tab[0].ReligionID;
                setSelect2Value($("#cboReligionW09F1100"),Religion_val);
                var Nationality = data.Tab[0].NationalityID;
                setSelect2Value($("#cboNationalityW09F1100"),Nationality);

                setSelect2Value($("#txtEducationLevelW09F1100"),data.Tab[0].EducationLevelID);
                setSelect2Value($("#txtProfessionalLevelW09F1100"),data.Tab[0].ProfessionalLevelID);
                setSelect2Value($("#txtLanguageLevelW09F1100"),data.Tab[0].LanguageLevelID);
                setSelect2Value($("#txtComputingLevelW09F1100"),data.Tab[0].ComputingLevelID);

                $('#txtOtherTransactionW09F1100').val(data.Tab[0].OtherTransaction);
                $('#txtExperienceW09F1100').val(data.Tab[0].Experience);
                $('#txtSalaryFromW09F1100').val(format2(data.Tab[0].SalaryFrom, '', 2));
                $('#txtSalaryToW09F1100').val(format2(data.Tab[0].SalaryTo, '', 2));
                var Currency_val = data.Tab[0].CurrencyID;
                setSelect2Value($("#cboCurrencyW09F1100"),Currency_val);
                $('#txtOtherRequirementW09F1100').val(data.Tab[0].OtherRequirement);
                $('#txtJobDescriptionW09F1100').val(data.Tab[0].JobDescription);
                $('#txtNoteW09F1100').val(data.Tab[0].Note);
                $('#txtFromAgeW09F1100').val(format2(data.Tab[0].FromAge, '', 0));
                $('#txtToAgeW09F1100').val(format2(data.Tab[0].ToAge, '', 0));


                //---End Form Tab 1---


                //--Tab2 Thông tin hệ số---


                $('#Coefficient1').val(format2(data.Tab2[0].Coefficient01, '', $('#Coefficient1').attr('round_number')));
                $('#Coefficient2').val(format2(data.Tab2[0].Coefficient02, '', $('#Coefficient2').attr('round_number')));
                $('#Coefficient3').val(format2(data.Tab2[0].Coefficient03, '', $('#Coefficient3').attr('round_number')));
                $('#Coefficient4').val(format2(data.Tab2[0].Coefficient04, '', $('#Coefficient4').attr('round_number')));
                $('#Coefficient5').val(format2(data.Tab2[0].Coefficient05, '', $('#Coefficient5').attr('round_number')));
                $('#Coefficient6').val(format2(data.Tab2[0].Coefficient06, '', $('#Coefficient6').attr('round_number')));
                $('#Coefficient7').val(format2(data.Tab2[0].Coefficient07, '', $('#Coefficient7').attr('round_number')));
                $('#Coefficient8').val(format2(data.Tab2[0].Coefficient08, '', $('#Coefficient8').attr('round_number')));
                $('#Coefficient9').val(format2(data.Tab2[0].Coefficient09, '', $('#Coefficient9').attr('round_number')));
                $('#Coefficient10').val(format2(data.Tab2[0].Coefficient10, '', $('#Coefficient10').attr('round_number')));
                $('#Coefficient11').val(format2(data.Tab2[0].Coefficient11, '', $('#Coefficient11').attr('round_number')));
                $('#Coefficient12').val(format2(data.Tab2[0].Coefficient12, '', $('#Coefficient12').attr('round_number')));
                $('#Coefficient13').val(format2(data.Tab2[0].Coefficient13, '', $('#Coefficient13').attr('round_number')));
                $('#Coefficient14').val(format2(data.Tab2[0].Coefficient14, '', $('#Coefficient14').attr('round_number')));
                $('#Coefficient15').val(format2(data.Tab2[0].Coefficient15, '', $('#Coefficient15').attr('round_number')));
                $('#Coefficient16').val(format2(data.Tab2[0].Coefficient16, '', $('#Coefficient16').attr('round_number')));
                $('#Coefficient17').val(format2(data.Tab2[0].Coefficient17, '', $('#Coefficient17').attr('round_number')));
                $('#Coefficient18').val(format2(data.Tab2[0].Coefficient18, '', $('#Coefficient18').attr('round_number')));
                $('#Coefficient19').val(format2(data.Tab2[0].Coefficient19, '', $('#Coefficient19').attr('round_number')));
                $('#Coefficient20').val(format2(data.Tab2[0].Coefficient20, '', $('#Coefficient20').attr('round_number')));
                $('#Coefficient21').val(format2(data.Tab2[0].Coefficient21, '', $('#Coefficient21').attr('round_number')));
                $('#Coefficient22').val(format2(data.Tab2[0].Coefficient22, '', $('#Coefficient22').attr('round_number')));
                $('#Coefficient23').val(format2(data.Tab2[0].Coefficient23, '', $('#Coefficient23').attr('round_number')));
                $('#Coefficient24').val(format2(data.Tab2[0].Coefficient24, '', $('#Coefficient24').attr('round_number')));
                $('#Coefficient25').val(format2(data.Tab2[0].Coefficient25, '', $('#Coefficient25').attr('round_number')));
                $('#Coefficient26').val(format2(data.Tab2[0].Coefficient26, '', $('#Coefficient26').attr('round_number')));
                $('#Coefficient27').val(format2(data.Tab2[0].Coefficient27, '', $('#Coefficient27').attr('round_number')));
                $('#Coefficient28').val(format2(data.Tab2[0].Coefficient28, '', $('#Coefficient28').attr('round_number')));
                $('#Coefficient29').val(format2(data.Tab2[0].Coefficient29, '', $('#Coefficient29').attr('round_number')));
                $('#Coefficient30').val(format2(data.Tab2[0].Coefficient30, '', $('#Coefficient30').attr('round_number')));


                //--End Tab 2


            }
        });
    }

    function loadGridW09F1100() {
        var obj = {
            width: '100%',
            height: 350,
            //freezeCols: 5,
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'auto'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            editable: false,
            filterModel: {on: true, mode: "AND", header: true},
            pageModel: {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]},
            numberCell: {show: false},
            rowClick: function (event, ui) {
                var rowData = ui.rowData;
                var colIndx = ui.colIndx;
                var dataIndx = ui.dataIndx;
                if (dataIndx != 'View') {
                    flagTab1 = 0;
                    append_data(rowData['DutyID'], rowData['DutyName']);
                    disableViewW09F1100();
                }


            },
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Xu_ly')}}",
                minWidth: 60,
                width: 60,
                maxWidth: 60,
                align: "left",
                dataIndx: "View",
                cls: "pq-grid-btnAction",
                isExport: false,
                editor: false,
                editable: false,
                sortable: false,
                render: function (ui) {


                    var str = digiContextMenu({
                            showText: true,
                            buttonList: [
                                {
                                    ID: "btnViewW09F1100",
                                    icon: "fa fa-eye text-green",
                                    title: '{{Helpers::getRS($g,"Xem")}}',
                                    enable: function () {
                                        return permission >= 1;
                                    },
                                    hidden: function () {
                                        return !(permission >= 1);
                                    },
                                    type: "button",
                                },
                                {
                                    ID: "btnEditW09F1100",
                                    icon: "fa fa-edit text-yellow",
                                    title: '{{Helpers::getRS($g,"Sua")}}',
                                    enable: function () {
                                        return permission >= 3;
                                    },
                                    hidden: function () {
                                        return !(permission >= 3);
                                    },
                                    type: "button",
                                }
                                , {
                                    ID: "btnDeleteW09F1100",
                                    icon: "fa fa-trash text-red",
                                    title: '{{Helpers::getRS($g,"Xoa")}}',
                                    enable: function () {
                                        return permission >= 4;
                                    },
                                    hidden: function () {
                                        return !(permission >= 4);
                                    },
                                    type: "button"
                                }
                            ]
                        }
                    );
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    $cell.find(".btnViewW09F1100").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F1101/$pForm/$g")}}', "modalW09F1101",
                            {
                                action: 'view',
                                DutyID: rowData['DutyID']

                            }, null);
                    });

                    $cell.find(".btnEditW09F1100").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F1101/$pForm/$g")}}', "modalW09F1101",
                            {
                                action: 'edit',
                                DutyID: rowData['DutyID']
                            }, null);
                    });

                    $cell.find(" .btnDeleteW09F1100").bind("click", function (evt) {
                        ask_delete(function () {

                            $.ajax({
                                method: "POST",
                                data: {rowW09F1100: rowData},
                                url: "{{url("/W09F1100/".$pForm."/$g/delete")}}",
                                success: function (data) {
                                    var currentObject2 = $.parseJSON(data);
                                    console.log(currentObject2);
                                    if (currentObject2.status == 'SUCCESS') {
                                        delete_ok(function () {
                                            $('#gridW09F1100').pqGrid("deleteRow", {rowIndx: rowIndx});
                                        });
                                    }
                                    else
                                        alert_error(currentObject2.message);
                                }
                            });
                        })

                    });
                },
            },
            {

                title: "{{Helpers::getRS($g,'Ma_chuc_danh_cong_viec')}}",
                dataType: "string",
                dataIndx: "DutyID",
                minWidth: 100,
                width: 160,
                maxWidth: 200,
                align: "left",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
            },
            {
                title: "{{Helpers::getRS($g,'Ten_tieng_Viet')}}",
                dataType: "string",
                dataIndx: "DutyName",
                minWidth: 200,
                width: 300,
                maxWidth: 400,
                align: "left",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
            },
            {
                title: "{{Helpers::getRS($g,'Ten_tieng_Anh')}}",
                dataType: "string",
                dataIndx: "DutyName01",
                minWidth: 200,
                width: 300,
                maxWidth: 400,
                align: "left",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ma_chuc_danh_quan_ly')}}",
                dataType: "string",
                dataIndx: "DutyManagerID",
                minWidth: 100,
                width: 160,
                maxWidth: 200,
                align: "center",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},

            },
            {
                title: "{{Helpers::getRS($g,'Ten_chuc_danh_quan_ly')}}",
                dataType: "string",
                dataIndx: "DutyManagerName",
                minWidth: 200,
                width: 300,
                maxWidth: 400,
                align: "left",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
            },
            {
                title: "{{Helpers::getRS($g,'Co_cau_to_chuc')}}",
                dataType: "string",
                dataIndx: "OrgChartName",
                minWidth: 200,
                width: 300,
                maxWidth: 400,
                align: "left",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nhom_chuc_danh_cong_viec')}}",
                dataType: "string",
                dataIndx: "DutyGroupName",
                minWidth: 200,
                width: 300,
                maxWidth: 400,
                align: "left",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Quan_ly')}}",
                dataType: "string",
                dataIndx: "IsManager",
                minWidth: 80,
                width: 80,
                maxWidth: 80,
                align: "center",
                hidden: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input type="checkbox" class = "minimal"' + (rowData["IsManager"] == 1 ? "checked" : "") + '>';
                }
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                dataType: "string",
                dataIndx: "Description",
                minWidth: 200,
                width: 300,
                maxWidth: 400,
                align: "left",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Chuc_danh_quan_ly_cao_nhat')}}",
                dataType: "string",
                dataIndx: "IsMaxDutyManager",
                minWidth: 200,
                width: 200,
                maxWidth: 200,
                align: "center",
                hidden: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input type="checkbox" class = "minimal"' + (rowData["IsMaxDutyManager"] == 1 ? "checked" : "") + '>';
                }
            },
            {
                title: "{{Helpers::getRS($g,'Thu_tu_hien_thi')}}",
                dataType: "string",
                dataIndx: "DutyDisplayOrder",
                minWidth: 100,
                width: 130,
                maxWidth: 200,
                align: "center",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Khong_su_dung')}}",
                dataType: "string",
                dataIndx: "Disabled",
                minWidth: 120,
                width: 120,
                maxWidth: 120,
                align: "center",
                hidden: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: true,
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input type="checkbox" class = "minimal"' + (rowData["Disabled"] == 1 ? "checked" : "") + '>';
                }
            },

        ];
        obj.dataModel = {
            data: {{$Grid1}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };


        $("#gridW09F1100").pqGrid(obj);
        setTimeout(function () {
            //setter
            $("#gridW09F1100").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#gridW09F1100").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            $("#gridW09F1100").pqGrid("refreshDataAndView");
        }, 300);

        var val = $("#chkAllW09F1005").is(":checked") ? "" : "0";
        $("#gridW09F1100").pqGrid("filter", {
            oper: 'replace',
            data: [
                {dataIndx: 'Disabled', condition: 'equal', value: val}
            ]
        });


    }
    function disableViewW09F1100(){
        flagTab1 = 0;
        toggle_controlW09F1100(true);
        $('#BtnSaveW09F1100').addClass('hide');
        $('#BtnNotSaveW09F1100').addClass('hide');
        $('#BtnEditW09F1100').removeClass('hide');

        //grid 1
        $("#grid2W09F1100").pqGrid("option", "showToolbar", false);
        $("#grid2W09F1100").pqGrid("option", "editable", false);
        var colM = $('#grid2W09F1100').pqGrid("option", "colModel");
        var colIndx = $('#grid2W09F1100').pqGrid("getColIndx", {dataIndx: "View"});
        var colModel = colM[colIndx];
        colModel.hidden = true;
        $('#grid2W09F1100').pqGrid("option", "colModel", colM);
        $("#grid2W09F1100").pqGrid('refreshDataAndView');

        //grid 2
        $("#grid2W09F1100_2").pqGrid("option", "showToolbar", false);
        $("#grid2W09F1100_2").pqGrid("option", "editable", false);
        var colM2 = $('#grid2W09F1100_2').pqGrid("option", "colModel");
        var colIndx2 = $('#grid2W09F1100_2').pqGrid("getColIndx", {dataIndx: "View"});
        var colModel2 = colM2[colIndx2];
        colModel2.hidden = true;
        $('#grid2W09F1100_2').pqGrid("option", "colModel", colM2);
        $("#grid2W09F1100_2").pqGrid('refreshDataAndView');

        //grid 3
        $("#grid2W09F1100_3").pqGrid("option", "showToolbar", false);
        $("#grid2W09F1100_3").pqGrid("option", "editable", false);
        var colM3 = $('#grid2W09F1100_3').pqGrid("option", "colModel");
        var colIndx3 = $('#grid2W09F1100_3').pqGrid("getColIndx", {dataIndx: "View"});
        var colModel3 = colM3[colIndx3];
        colModel3.hidden = true;
        $('#grid2W09F1100_3').pqGrid("option", "colModel", colM3);
        $("#grid2W09F1100_3").pqGrid('refreshDataAndView');

    }

    function loadGrid2W09F1100() {
        var obj2 = {
            width: '100%',
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            flexHeight: true,
            pageModel: {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'auto'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            editable: false,
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: '{{Helpers::getRS($g,'Them')}}',
                        icon: 'ui-icon-plus',
                        listener: function (ui) {
                            rowIndx = ui.rowIndx;
                            var grid_lenght = $("#grid2W09F1100").pqGrid('option', "dataModel.data").length;
                            $("#grid2W09F1100").pqGrid('addRow', {
                                newRow: {OrderNo: grid_lenght + 1},
                                rowIndx: grid_lenght + 1
                            });
                        }
                    },
                ]
            },
            showToolbar: false,
            numberCell: {show: false},
            cellClick: function (event, ui) {
                ColIndx = ui.colIndx;
            }
        };

        obj2.colModel = [
            {

                title: "{{Helpers::getRS($g,'Xu_ly')}}",
                dataType: "string",
                dataIndx: "View",
                minWidth: 50,
                width: 50,
                maxWidth: 150,
                isExport: false,
                align: "center",
                editable: false,
                editor: false,
                hidden: true,
                render: function (ui) {
                    var str = "";
                    var rowData = ui.rowData;
                    if (permission > 3) {

                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteRowGrid2W09F1100 '><i class='fa fa-trash' style='color:#333'></i></a>";
                    }
                    return str;
                }
                ,
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;
                    $cell.find(".btnDeleteRowGrid2W09F1100").bind("click", function (ui) {
                        var count = 0;
                        $("#grid2W09F1100").pqGrid("deleteRow", {rowIndx: rowIndx});

                        var grid2W09F1100_data = $("#grid2W09F1100").pqGrid("option", "dataModel.data");
                        for (i = 0; i < grid2W09F1100_data.length; i++) {
                            count += 1;
                            grid2W09F1100_data[i].OrderNo = count;


                        }

                        $("#grid2W09F1100").pqGrid("option", "dataModel.data", grid2W09F1100_data);
                        $("#grid2W09F1100").pqGrid('refreshDataAndView');


                    });
                },


            },

            {

                title: "{{Helpers::getRS($g,'STT')}}",
                dataType: "string",
                dataIndx: "OrderNo",
                minWidth: 50,
                width: 100,
                maxWidth: 150,
                align: "center",
                editable: true,
                hidden: false,
                editor: false,


            },
            {
                title: "{{Helpers::getRS($g,'Ma')}}",
                dataType: "string",
                dataIndx: "EvaluationElementID",
                minWidth: 200,
                width: 145,
                maxWidth: 500,
                align: "left",
                editable: true,
                hidden: false,
                editor: {
                    options: {{$Evaluation}},
                    type: "select",
                    valueIndx: "EvaluationElementID",
                    labelIndx: "EvaluationElementName",
                    init: function (ui) {
                        var rowdata = ui.rowData;
                        var rowIndx = ui.rowIndx;
                        var dataIndx = ui.dataIndx;
                        ui.$cell.find("select").pqSelect({
                            singlePlaceholder: 'Chọn'
                        });
                        ui.$cell.find("select").change(function (evt) {
                            var ID = $(this).val();
                            if (ID != '') {

                                var EvaluationElementID = $('#grid2W09F1100').pqGrid("getColumn", {dataIndx: "EvaluationElementID"});
                                var dataCombo = EvaluationElementID.editor.options;
                                var rowEvaluation = $.grep(dataCombo, function (d) {
                                    return d.EvaluationElementID == ID;
                                });
                                rowdata['EvaluationElementName'] = rowEvaluation[0]['EvaluationElementName'];
                                $('#grid2W09F1100').pqGrid("refreshDataAndView");
                            }
                            else {
                                rowdata['EvaluationElementName'] = "";
                                $('#grid2W09F1100').pqGrid("refreshDataAndView");

                            }
                        });
                    }


                },
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                dataType: "string",
                dataIndx: "EvaluationElementName",
                minWidth: 200,
                maxWidth: 500,
                width: 500,
                editable: false,
                editor: false,
                align: "left",
                hidden: false,

            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                dataType: "string",
                dataIndx: "Note",
                minWidth: 400,
                width: 170,
                maxWidth: 800,
                editable: true,
                align: "left",
                hidden: false,

            }


        ];
        obj2.dataModel = {
            data: '',
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        obj2.create = function (evt, ui) {

        };

        $("#grid2W09F1100").pqGrid(obj2);
        setTimeout(function () {
            $("#grid2W09F1100").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#grid2W09F1100").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            $("#grid2W09F1100").pqGrid("refreshDataAndView");
        }, 1000)


    }

    function loadGrid2W09F1100_2() {
        var obj2 = {
            width: '100%',
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            flexHeight: true,
            pageModel: {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'auto'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            editable: false,
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: '{{Helpers::getRS($g,'Them')}}',
                        icon: 'ui-icon-plus',
                        listener: function (ui) {
                            rowIndx = ui.rowIndx;
                            var grid_lenght = $("#grid2W09F1100_2").pqGrid('option', "dataModel.data").length;
                            $("#grid2W09F1100_2").pqGrid('addRow', {
                                newRow: {OrderNo: grid_lenght + 1},
                                rowIndx: grid_lenght + 1
                            });
                        }
                    },
                ]
            },
            showToolbar: false,
            numberCell: {show: false},
            cellClick: function (event, ui) {
                ColIndx = ui.colIndx;
            }
        };

        obj2.colModel = [
            {

                title: "{{Helpers::getRS($g,'Xu_ly')}}",
                dataType: "string",
                dataIndx: "View",
                minWidth: 50,
                width: 50,
                maxWidth: 150,
                isExport: false,
                align: "center",
                editable: false,
                editor: false,
                hidden: true,
                render: function (ui) {
                    var str = "";
                    var rowData = ui.rowData;
                    if (permission > 3) {

                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteRowGrid2W09F1100 '><i class='fa fa-trash' style='color:#333'></i></a>";
                    }
                    return str;
                }
                ,
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;
                    $cell.find(".btnDeleteRowGrid2W09F1100").bind("click", function (ui) {
                        var count = 0;
                        $("#grid2W09F1100_2").pqGrid("deleteRow", {rowIndx: rowIndx});

                        var grid2W09F1100_data = $("#grid2W09F1100_2").pqGrid("option", "dataModel.data");
                        for (i = 0; i < grid2W09F1100_data.length; i++) {
                            count += 1;
                            grid2W09F1100_data[i].OrderNo = count;


                        }

                        $("#grid2W09F1100_2").pqGrid("option", "dataModel.data", grid2W09F1100_data);
                        $("#grid2W09F1100_2").pqGrid('refreshDataAndView');


                    });
                },


            },

            {

                title: "{{Helpers::getRS($g,'STT')}}",
                dataType: "string",
                dataIndx: "OrderNo",
                minWidth: 50,
                width: 100,
                maxWidth: 150,
                align: "center",
                editable: true,
                hidden: false,
                editor: false,


            },
            {
                title: "{{Helpers::getRS($g,'Ma')}}",
                dataType: "string",
                dataIndx: "EvaluationElementID",
                minWidth: 200,
                width: 145,
                maxWidth: 500,
                align: "left",
                editable: true,
                hidden: false,
                editor: {
                    options: {{$Evaluation}},
                    type: "select",
                    valueIndx: "EvaluationElementID",
                    labelIndx: "EvaluationElementName",
                    init: function (ui) {
                        var rowdata = ui.rowData;
                        var rowIndx = ui.rowIndx;
                        var dataIndx = ui.dataIndx;
                        ui.$cell.find("select").pqSelect({
                            singlePlaceholder: 'Chọn'
                        });
                        ui.$cell.find("select").change(function (evt) {
                            var ID = $(this).val();
                            if (ID != '') {

                                var EvaluationElementID = $('#grid2W09F1100_2').pqGrid("getColumn", {dataIndx: "EvaluationElementID"});
                                var dataCombo = EvaluationElementID.editor.options;
                                var rowEvaluation = $.grep(dataCombo, function (d) {
                                    return d.EvaluationElementID == ID;
                                });
                                rowdata['EvaluationElementName'] = rowEvaluation[0]['EvaluationElementName'];
                                $('#grid2W09F1100_2').pqGrid("refreshDataAndView");
                            }
                            else {
                                rowdata['EvaluationElementName'] = "";
                                $('#grid2W09F1100_2').pqGrid("refreshDataAndView");

                            }
                        });
                    }


                },
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                dataType: "string",
                dataIndx: "EvaluationElementName",
                minWidth: 200,
                maxWidth: 500,
                width: 500,
                editable: false,
                editor: false,
                align: "left",
                hidden: false,

            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                dataType: "string",
                dataIndx: "Note",
                minWidth: 400,
                width: 170,
                maxWidth: 800,
                editable: true,
                align: "left",
                hidden: false,

            }


        ];
        obj2.dataModel = {
            data: '',
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        obj2.create = function (evt, ui) {

        };

        $("#grid2W09F1100_2").pqGrid(obj2);
        setTimeout(function () {
            $("#grid2W09F1100_2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#grid2W09F1100_2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            $("#grid2W09F1100_2").pqGrid("refreshDataAndView");
        }, 1000)


    }

    function loadGrid2W09F1100_3() {
        var obj2 = {
            width: '100%',
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            flexHeight: true,
            pageModel: {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'auto'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            editable: false,
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: '{{Helpers::getRS($g,'Them')}}',
                        icon: 'ui-icon-plus',
                        listener: function (ui) {
                            rowIndx = ui.rowIndx;
                            var grid_lenght = $("#grid2W09F1100_3").pqGrid('option', "dataModel.data").length;
                            $("#grid2W09F1100_3").pqGrid('addRow', {
                                newRow: {OrderNo: grid_lenght + 1},
                                rowIndx: grid_lenght + 1
                            });
                        }
                    },
                ]
            },
            showToolbar: false,
            numberCell: {show: false},
            cellClick: function (event, ui) {
                ColIndx = ui.colIndx;
            }
        };

        obj2.colModel = [
            {

                title: "{{Helpers::getRS($g,'Xu_ly')}}",
                dataType: "string",
                dataIndx: "View",
                minWidth: 50,
                width: 50,
                maxWidth: 150,
                isExport: false,
                align: "center",
                editable: false,
                editor: false,
                hidden: true,
                render: function (ui) {
                    var str = "";
                    var rowData = ui.rowData;
                    if (permission > 3) {

                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteRowGrid2W09F1100 '><i class='fa fa-trash' style='color:#333'></i></a>";
                    }
                    return str;
                }
                ,
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;
                    $cell.find(".btnDeleteRowGrid2W09F1100").bind("click", function (ui) {
                        var count = 0;
                        $("#grid2W09F1100_3").pqGrid("deleteRow", {rowIndx: rowIndx});

                        var grid2W09F1100_data = $("#grid2W09F1100_3").pqGrid("option", "dataModel.data");
                        for (i = 0; i < grid2W09F1100_data.length; i++) {
                            count += 1;
                            grid2W09F1100_data[i].OrderNo = count;


                        }

                        $("#grid2W09F1100_3").pqGrid("option", "dataModel.data", grid2W09F1100_data);
                        $("#grid2W09F1100_3").pqGrid('refreshDataAndView');


                    });
                },


            },

            {

                title: "{{Helpers::getRS($g,'STT')}}",
                dataType: "string",
                dataIndx: "OrderNo",
                minWidth: 50,
                width: 100,
                maxWidth: 150,
                align: "center",
                editable: true,
                hidden: false,
                editor: false,


            },
            {
                title: "{{Helpers::getRS($g,'Ma')}}",
                dataType: "string",
                dataIndx: "EvaluationElementID",
                minWidth: 200,
                width: 145,
                maxWidth: 500,
                align: "left",
                editable: true,
                hidden: false,
                editor: {
                    options: {{$Evaluation}},
                    type: "select",
                    valueIndx: "EvaluationElementID",
                    labelIndx: "EvaluationElementName",
                    init: function (ui) {
                        var rowdata = ui.rowData;
                        var rowIndx = ui.rowIndx;
                        var dataIndx = ui.dataIndx;
                        ui.$cell.find("select").pqSelect({
                            singlePlaceholder: 'Chọn'
                        });
                        ui.$cell.find("select").change(function (evt) {
                            var ID = $(this).val();
                            if (ID != '') {

                                var EvaluationElementID = $('#grid2W09F1100_3').pqGrid("getColumn", {dataIndx: "EvaluationElementID"});
                                var dataCombo = EvaluationElementID.editor.options;
                                var rowEvaluation = $.grep(dataCombo, function (d) {
                                    return d.EvaluationElementID == ID;
                                });
                                rowdata['EvaluationElementName'] = rowEvaluation[0]['EvaluationElementName'];
                                $('#grid2W09F1100_3').pqGrid("refreshDataAndView");
                            }
                            else {
                                rowdata['EvaluationElementName'] = "";
                                $('#grid2W09F1100_3').pqGrid("refreshDataAndView");

                            }
                        });
                    }


                },
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                dataType: "string",
                dataIndx: "EvaluationElementName",
                minWidth: 200,
                maxWidth: 500,
                width: 500,
                editable: false,
                editor: false,
                align: "left",
                hidden: false,

            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                dataType: "string",
                dataIndx: "Note",
                minWidth: 400,
                width: 170,
                maxWidth: 800,
                editable: true,
                align: "left",
                hidden: false,

            }


        ];
        obj2.dataModel = {
            data: '',
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        obj2.create = function (evt, ui) {

        };

        $("#grid2W09F1100_3").pqGrid(obj2);
        setTimeout(function () {
            $("#grid2W09F1100_3").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#grid2W09F1100_3").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            $("#grid2W09F1100_3").pqGrid("refreshDataAndView");
        }, 1000)


    }

    function convertDate(day) {
        var arr = day.split("/");
        var rsDay = arr[1] + "_" + arr[0] + "_" + arr[2];
        return rsDay;
    }

    function funcLoseModalW09F1100() {
        console.log('close');
        if ($('#BtnEditW09F1100').hasClass('hide')) {
            alert_custom(icon_ask, "{{Helpers::getRS($g, 'Ban_co_muon_dong_khong')}}", true, true, function () {
                $('#modalW09F1100').modal('hide');
            });

        }
        else {
            $('#modalW09F1100').modal('hide');

        }
    }


        // when view W09F1100 is open, disable the controls, set selection to 1st row and append the data to the form
     $('#modalW09F1100').on('shown.bs.modal', function (ui) {
         disableViewW09F1100();
         var data = $("#gridW09F1100").pqGrid('option', "dataModel.data");
         if (data.length > 0) {
             $("#gridW09F1100").pqGrid("setSelection", {rowIndx: 0});
             append_data(data[0].DutyID, data[0].DutyName);
         }
         Duty_id = data[0].DutyID;
         Duty_name = data[0].DutyName;
        })

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {//refresh luoi khi chon dung tab
        var target = $(e.target).closest(".nav-tabs-custom").find(".tab-content");
        var target = $(target).find("div.active");
        var id = $(target).attr("id");
        var rowData = [];
        var data = $("#gridW09F1100").pqGrid('option', "dataModel.data");
        if (data.length > 0) {
            rowData = getRowSelection($("#gridW09F1100"));
        }
        console.log(id);

        switch (id) {
            case "tab_4_1":
                mode = 0;
                gridID = '#grid2W09F1100';
                if(flagTab1 == 0){
                    //append_data(rowData['DutyID'], rowData['Duty_name']);
                }
                break;
            case "tab_4_2":
                mode = 3;
                gridID = '#grid2W09F1100_2';
                if(flagTab1 == 0){
                   //append_data(rowData['DutyID'], rowData['Duty_name']);
                }
                break;
            case "tab_4_3":
                mode = 4;
                gridID = '#grid2W09F1100_3';
                if(flagTab1 == 0){
                    //append_data(rowData['DutyID'], rowData['Duty_name']);
                }
                break;
            case "menu4":
                break;
        }
        $(gridID).pqGrid("refreshDataAndView");
    });
</script>