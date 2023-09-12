<div class="modal draggable fade pd0" id="modalW09F2921" data-backdrop="static" role="dialog">
    <div id="divW09F2921" class="modal-dialog formduyet">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW09F2921">
                <div class="modal-header logodg pdl0">
                    {{Helpers::generateHeading($caption,"W09F2921",true,"",true, $pForm, "W09F2921")}}
                    @define $pW09F2921 = Session::get($pForm)
                </div>
                <div class="modal-body" style="padding: 10px">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend class="legend"
                                        style="margin-bottom:10px">{{Helpers::getRS($g,"Dieu_kien_loc")}}</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="radio pdt0 mgt5">
                                            <label>
                                                <input type="radio" checked value="0" id="optIsFilter0" name="optIsFilter">{{Helpers::getRS($g,"Tat_ca1")}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="radio" style="padding-top: 5px !important;">
                                                    <label>
                                                        <input type="radio"  value="0" id="optDate" name="optType" class="optType"  checked="checked">
                                                        {{Helpers::getRS($g,"Theo_ngay")}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div id="dateFromW09F2921" class="input-group date">
                                                    <input type="text" class="form-control" id="txtDateFrom" value="{{date("d/m/Y")}}" name="txtDateFrom"  required>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div id="dateToW09F2921" class="input-group date">
                                                    <input type="text" class="form-control" id="txtDateTo" value="{{date("d/m/Y")}}" name="txtDateTo"  required>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-3 liketext">
                                                <b><label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label></b>
                                            </div>
                                            <div class="col-md-9 col-xs-9">
                                                <div class="ps_relative flw25pc" style="width: 35%" id="digiCboDepartmentW09F2921">
                                                </div>
                                                <div class="flw30pc pdl5" style="width: 65%">
                                                    <input type="text" class="form-control" id="txtDepartmentNameW29F2921"

                                                           value=""
                                                           name="txtDepartmentNameW29F2921" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="radio pdt0 mgt5">
                                            <label>
                                                <input type="radio"  value="1" id="optIsFilter1" name="optIsFilter">{{Helpers::getRS($g,"Du_lieu_chua_duyet")}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="radio" style="padding-top: 5px !important;">
                                                    <label>
                                                        <input type="radio"  value="1" id="optPeriod" name="optType" class="optType">
                                                        {{Helpers::getRS($g,"Theo_thang")}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" id="slPeriodFrom" name="slPeriodFrom" required disabled>
                                                    @foreach($period as $row)
                                                        <option value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" id="slPeriodTo" name="slPeriodTo" required disabled>
                                                    @foreach($period as $row)
                                                        <option value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-3 liketext">
                                                <b><label class="lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label></b>
                                            </div>
                                            <div class="col-md-9 col-xs-9">
                                                <div class="ps_relative flw25pc" style="width: 35%" id="digiCboEmployeeW09F2921">
                                                </div>
                                                <div class="flw30pc pdl5" style="width: 65%">
                                                    <input type="text" class="form-control" id="txtEmployeeNameW29F2921"
                                                           value=""
                                                           name="txtEmployeeNameW29F2921" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="radio pdt0 mgt5">
                                            <label>
                                                <input type="radio"  value="2" id="optIsFilter2" name="optIsFilter">{{Helpers::getRS($g,"Du_lieu_da_duyet")}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($pW09F2921 >= 1)
                                            <button class="btn btn-default smallbtn pull-right" style="padding-top: 3px"><span class="digi digi-filter"></span>&nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                        @endif
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="divGridW09F2921"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="divDropDown">
    <div style="position: absolute; z-index: 100000; top: 0; display: none; " id="pgridDutytID">
        <div id="gridDutytID"></div>
    </div>
</div>

{{HTML::script('packages/default/L3/js/combo_grid.js')}}
<script type="text/javascript">
    var $dataDutyID ;
    $(document).ready(function () {
        $.ajax({
            method: "POST",
            //data: {strSearch: sTr},
            url: "W09F2921/{{$pForm}} /{{$g}}/loaddutyid",
            success: function (dataDutyID) {
                $dataDutyID = dataDutyID
            }
        });

        var startOfWeek = moment().startOf('isoweek').toDate().toString("dd/MM/yyyy");
        var endOfWeek   = moment().endOf('isoweek').toDate().toString("dd/MM/yyyy");
        $('#dateFromW09F2921').datepicker({
            todayHighlight: true,
            autoclose: true,
            weekStart: 1,
            format: "dd/mm/yyyy",
            language:'vi'
        }).datepicker("setDate", startOfWeek);;
        $('#dateToW09F2921').datepicker({
            todayHighlight: true,
            autoclose: true,
            weekStart: 1,
            format: "dd/mm/yyyy",
            language:'vi'
        }).datepicker("setDate", endOfWeek);;



        $(".select2").select2();
        $('select option:first-child').attr("selected", "selected");
        $("#frmW09F2921").on("change",".optType", function(){
            if (this.value == '0') {
                $("#frmW09F2921").find("#slPeriodFrom").attr("disabled","disabled");
                $("#frmW09F2921").find("#slPeriodTo").attr("disabled","disabled");
                $("#frmW09F2921").find("#txtDateFrom").removeAttr("disabled");
                $("#frmW09F2921").find("#txtDateTo").removeAttr("disabled");
                //$("#frmW09F2921").find("#dateFromW09F2921").addClass("input-group date");
                //$("#frmW09F2921").find("#dateToW09F2921").addClass("input-group date");

            }
            else if (this.value == '1') {
                $("#frmW09F2921").find("#slPeriodFrom").removeAttr("disabled");
                $("#frmW09F2921").find("#slPeriodTo").removeAttr("disabled");
                $("#frmW09F2921").find("#txtDateFrom").attr("disabled","disabled");
                $("#frmW09F2921").find("#txtDateTo").attr("disabled","disabled");
                //$("#frmW09F2921").find("#dateFromW09F2921").removeClass("input-group date");
                //$("#frmW09F2921").find("#dateToW09F2921").removeClass("input-group date");

            }
        });
        loadGridW09F2921();

        $("#frmW09F2921").on('submit', function (e) {
            e.preventDefault();
            reloadGridW09F2921()
        });



        // luoi chuc vu
        var isgridDutyID = false;
        var data = {};
        var obj = {
            width: 550, height: 300,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            //filterModel: {on: true, mode: "AND", header: true},
            parentBound: $("#pgridDutytID"),
            funcUpdate: updateRowGridDutyID,
            selectionModel: {type: 'row', fireSelectChange: true},
            swipeModel: {on: false},
            synElement: {},
            rowSelect: function (event, ui) {
                isgridDutyID = true;
            }
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS(0,'Ma')}}",
                width: 150,
                dataIndx: "DutyID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS(0,'Ten')}}",
                width: 350,
                dataIndx: "DutyName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ];
        obj.dataModel = {data: data};
        $("#gridDutytID").pqGrid(obj);


        var objDepartmentW09F2921 = {
            width: 365, height: 300,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            synElement: [{elId: "txtDepartmentW09F2921", dataIndx: "DepartmentID"}, {
                elId: "txtDepartmentNameW29F2921",
                dataIndx: "DepartmentName"
            }],
            focusElement: "txtEmployeeW09F2921",
            colModel: [

                {title: "{{Helpers::getRS(0,'Ma')}}", width: 50, dataIndx: "DepartmentID"},
                {title: "{{Helpers::getRS(0,'Ten')}}", width: 140, dataIndx: "DepartmentName"}

            ],
            dataModel: {data: {}},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}

        };
        $("#digiCboDepartmentW09F2921").DigiNetComboGrid({
            topContain: "modalW09F2921",
            textID: "txtDepartmentW09F2921",
            synElement: [{elId: "txtDepartmentNameW29F2921"}],
            required: false,
            textValue: "",
            gridID: "gridDepartmentW09F2921",
            gridConfig: objDepartmentW09F2921,
            request: {
                url: "W09F2921/{{$pForm}}/{{$g}}/reloaddepartment"
            }
        });

        var objEmployeeW09F2921 = {
            width: 365, height: 300,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            synElement: [{elId: "txtEmployeeW09F2921", dataIndx: "EmployeeID"}, {
                elId: "txtEmployeeNameW29F2921",
                dataIndx: "EmployeeName"
            }],
            focusElement: "txtEmployeeW09F2921",
            colModel: [

                {title: "{{Helpers::getRS(0,'Ma')}}", width: 50, dataIndx: "EmployeeID"},
                {title: "{{Helpers::getRS(0,'Ten')}}", width: 140, dataIndx: "EmployeeName"}

            ],
            dataModel: {data: {}},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}

        };
        $("#digiCboEmployeeW09F2921").DigiNetComboGrid({
            topContain: "modalW09F2921",
            textID: "txtEmployeeW09F2921",
            synElement: [{elId: "txtEmployeeNameW29F2921"}],
            required: false,
            textValue: "",
            gridID: "gridEmployeeW09F2921",
            gridConfig: objEmployeeW09F2921,
            request: {
                url: "W09F2921/{{$pForm}}/{{$g}}/reloademployee"
            }
        });


    });

    function reloadGridW09F2921(){
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: "W09F2921/{{$pForm}}/{{$g}}/reloadgrid",
            data: $("#frmW09F2921").serialize(),
            success: function (data) {
                $(".l3loading").addClass('hide');
                //console.log(data);
                var result = $.parseJSON(data);
                $("#gridW09F2921").pqGrid("option", "dataModel", {data: result.dataW09F2921});
                $("#gridW09F2921").pqGrid("refreshDataAndView");
            }
        });
    }

    //update khi du an
    function updateRowGridDutyID(rowdt) {
        var obj = {
            "DutyID": rowdt.DutyID,
            'NNormalHours': rowdt.NNormalHours,
            'NormalAmount': Number(rowdt.NormalHours) + Number(rowdt.NNormalHours)
        };
        updateCurrentRow(gbRowidx, obj, "NNormalHours");
        //var colIndex = $gridW09F2920.pqGrid("getColIndx", {dataIndx: "WorkID"});
        //$("#gridProjectID").pqGrid("setSelection", {rowIndx: gbRowidx, colIndx: colIndex});
        //$("#gridProjectID").pqGrid("editCell", {rowIndx: gbRowidx, dataIndx: "WorkID"});
        $("#divDropDown").css("display", "none");
    }

    // xủ lý cập nhật dòng trên lưới
    function updateCurrentRow(idx, obj, focus) {
        console.log("update");
        var $gridW09F2921 = $("#gridW09F2921");
        $gridW09F2921.pqGrid("quitEditMode");
        //edit cell in 3rd row and 4th column.
        $gridW09F2921.pqGrid( "editCell", { rowIndx: idx, dataIndx: "NormalAmount" } );
        $gridW09F2921.pqGrid("updateRow",
                {rowIndx: idx, row: obj}
        );
        $gridW09F2921.pqGrid('refreshDataAndView');
        $gridW09F2921.pqGrid("scrollColumn", {dataIndx: focus});
        var obj = $("#gridW09F2921").pqGrid("option", "dataModel.data");
        console.log(obj);
        if (focus != "nextrow") {
            var colIndx = $gridW09F2921.pqGrid( "getColIndx", { dataIndx: focus } );
            $gridW09F2921.pqGrid("setSelection", {rowIndx: idx, colIndx: colIndx});
        }
    }

    function loadGridW09F2921() {
        $(".l3loading").removeClass('hide');
        //$("#gridW09F2920").html("");
        //$( "#gridW09F2920" ).pqGrid( "option", "dataModel", { data: []} );
        $.ajax({
            method: "POST",
            url: "W09F2921/{{$pForm}}/{{$g}}/loadgrid",
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#divGridW09F2921").html(data);
            }
        });
    }


</script>

