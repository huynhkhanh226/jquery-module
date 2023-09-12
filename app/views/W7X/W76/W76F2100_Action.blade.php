<div class="modal draggable fade modal" id="modalW76F2100" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 90%">

        <?php
        if ($task == 'add') {

        }

        ?>

        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,'Cap_nhat_cong_van_den'),"W76F2100",true,"")}}
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form id="frmW76F2100" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Don_vi")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                {{--<select class="col-sm-4" style="width: 100%; ">--}}
                                {{--<option>--</option>--}}
                                {{--<option>Đơn vị 1</option>--}}
                                {{--<option>Đơn vị 2</option>--}}
                                {{--<option>Đơn vị 3</option>--}}
                                {{--</select>--}}
                                <input type="text" class="form-control text-uppercase" name="txtDivisionIDW76F2100"
                                       readonly="true"
                                       id="txtDivisionIDW76F2100" value="{{$DivisionID}}" placeholder=""
                                       required="">

                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"So_cong_van")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtDocNoW76F2100"
                                       readonly="true"
                                       id="txtDocNoW76F2100" value="{{$DocNo}}" placeholder=""
                                       required="">
                            </div>

                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Nhom_van_ban")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtDocGroupIDW76F2100"
                                       readonly="true"
                                       id="txtDocGroupIDW76F2100" value="{{$DocGroupID}}" placeholder=""
                                       required="">
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Co_quan/To_chuc_gui")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase"
                                       name="txtReceiveSendOrganizationW76F2100"
                                       readonly="true"
                                       id="txtReceiveSendOrganizationW76F2100" value="{{$ReceiveSendOrganization}}"
                                       placeholder=""
                                       required="">
                            </div>

                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngay_nhan")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtReleaseDateW76F2100"
                                       readonly="true"
                                       id="txtReleaseDateW76F2100" value="{{$ReleaseDate}}" placeholder=""
                                       required="">
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Nguoi_ky")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtSignerW76F2100"
                                       readonly="true"
                                       id="txtSignerW76F2100" value="{{$Signer}}" placeholder=""
                                       required="">
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngay_phat_hanh")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtReleaseDateW76F2100"
                                       readonly="true"
                                       id="txtReleaseDateW76F2100" value="{{$ReleaseDate}}" placeholder=""
                                       required="">
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtEffectDateFromW76F2100"
                                       readonly="true"
                                       id="txtEffectDateFromW76F2100" value="{{$EffectDateFrom}}" placeholder=""
                                       required="">
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngay_het_hieu_luc")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtEffectDateToW76F2100"
                                       readonly="true"
                                       id="txtEffectDateToW76F2100" value="{{$EffectDateTo}}" placeholder=""
                                       required="">
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Do_khan_cap")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtEmergencyW76F2100"
                                       readonly="true"
                                       id="txtEmergencyW76F2100" value="{{$Emergency}}" placeholder=""
                                       required="">
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Do_bao_mat")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtSecurityW76F2100"
                                       readonly="true"
                                       id="txtSecurityW76F2100" value="{{$Security}}" placeholder=""
                                       required="">
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Dang_van_ban")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtDocTypeW76F2100"
                                       readonly="true"
                                       id="txtDocTypeW76F2100" value="" placeholder=""
                                       required="">
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"So_trang")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtQuanPageW76F2100"
                                       readonly="true"
                                       id="txtQuanPageW76F2100" value="" placeholder=""
                                       required="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <button id="frm_btnAttachment" type="button"
                                        class="btn btn-default smallbtn mgr10"><span
                                            class="fa fa-paperclip mgr5"></span> {{Helpers::getRS($g,"Dinh_kem")}}
                                </button>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <label class="control-label lbl-normal">Loại file: doc, pdf, ppt, docx</label>
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Trich_yeu")}}</label>
                            </div>
                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                <textarea style="height: 160px;" type="text" class="form-control text-uppercase"
                                          name="txtDocNoW76F2100"
                                          id="txtDocNoW76F2100" value="{{$DocNo}}" placeholder=""
                                          required=""></textarea>
                            </div>

                        </div>

                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"CV_den_lien_quan")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtDocNoW76F2100"
                                       readonly="true"
                                       id="txtDocNoW76F2100" value="{{$DocNo}}" placeholder=""
                                       required="">
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"CV_di_lien_quan")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtReleaseDateW76F2100"
                                       readonly="true"
                                       id="txtReleaseDateW76F2100" value="{{$ReleaseDate}}" placeholder=""
                                       required="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ke")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtDocNoW76F2100"
                                       readonly="true"
                                       id="txtDocNoW76F2100" value="{{$DocNo}}" placeholder=""
                                       required="">
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Tang")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtReleaseDateW76F2100"
                                       readonly="true"
                                       id="txtReleaseDateW76F2100" value="{{$ReleaseDate}}" placeholder=""
                                       required="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngan")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtDocNoW76F2100"
                                       readonly="true"
                                       id="txtDocNoW76F2100" value="{{$DocNo}}" placeholder=""
                                       required="">
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Thu_muc")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtReleaseDateW76F2100"
                                       readonly="true"
                                       id="txtReleaseDateW76F2100" value="{{$ReleaseDate}}" placeholder=""
                                       required="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <label class="control-label lbl-normal">{{Helpers::getRS($g,"Trang_thai")}}</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <input type="text" class="form-control text-uppercase" name="txtDocNoW76F2100"
                                       readonly="true"
                                       id="txtDocNoW76F2100" value="{{$DocNo}}" placeholder=""
                                       required="">
                            </div>

                        </div>

                    </form>
                    <div class="row">

                        <div class="col-md-12 mgt10">
                            <fieldset>
                                <legend class="text-bold" style="color: #00acd6;">Bộ phận liên quan</legend>
                                <div id="W76F2100Grid">
                                </div>
                            </fieldset>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var dataSource =  JSON.parse('{{$rsData}}');
    $(function () {

        {{--$grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);--}}
        {{--$grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);--}}
        {{--$grid.pqGrid("refreshDataAndView");--}}

    });
    $(document).ready(function () {
        iW76F2100Height = $(".contenttab").height() - 20;
        var obj = {
            //width: 100,
            height: iW76F2100Height,
            resizable: true,
            dataType: "JSON",
            editable: false,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showBottom: true,
            dragColumns: {enabled: false},
            pageModel: {type: 'local', rPP: 20},

            dataModel: {
                data: dataSource,

            },
        };

        obj.colModel = [

            {
                title: "",
                width: 100,
                dataType: "string",
                editable: true,
                editor: false,
                dataIndx: "View",
                editor: false,


            },
            {
                title: "{{Helpers::getRS($g, 'Don_vi')}}",
                dataType: "string",
                align: "left",
                width: 200,
                editable: true,
                editor: false,
                dataIndx: "DivisionID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Phong_ban')}}",
                dataType: "string",
                align: "left",
                width: 200,
                editable: true,
                editor: false,
                dataIndx: "DepartmentID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Nguoi_nhan')}}",
                dataType: "string",
                align: "left",
                width: 200,
                editable: true,
                editor: false,
                dataIndx: "EmployeeID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g, 'Ghi_chu')}}",
                dataType: "string",
                align: "left",
                width: 200,
                editable: true,
                editor: false,
                dataIndx: "Notes",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "IsEdit",
                width: 200,
                dataType: "string",
                align: "left",
                editable: true,
                editor: false,
                dataIndx: "",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "IsDelete",
                dataType: "string",
                align: "left",
                width: 200,

                editable: true,
                editor: false,
                dataIndx: "",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
        ];


        var $grid = $("#W76F2100Grid ")
        $grid.pqGrid(obj);
        setTimeout(function () {
            $grid.pqGrid('refreshDataAndView');
        }, 500);
    })
</script>