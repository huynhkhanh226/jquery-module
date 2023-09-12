<div class="modal fade" id="modalW09F1102" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F1102,"W09F1102",true,"funcLoseModalW09F1102")}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="W09F1102_grid">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="checkbox">
                            <label><input id='chkAllW09F1102' type="checkbox"
                                          value="">{{Helpers::getRS($g,'Hien_thi_tat_ca')}}</label>
                            <button id='BtnSaveW09F1102' class="btn btn-default smallbtn pull-right"><i
                                        class="glyphicon glyphicon-floppy-saved mgr5 text-blue"></i> {{Helpers::getRS($g,'Luu')}}</button>

                        </div>
                        {{--
                        --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        loadGridW09F1102();
        var data = $('#W09F1102_grid').pqGrid("option", "dataModel").data;
        for (var i = 0; i < data.length; i++) {
            if (data[i].DutyManagerID != '') {
                data[i].pq_hidden = true;
            }
        }
        $('#W09F1102_grid').pqGrid("refreshView");

    });

    $('#BtnSaveW09F1102').click(function () {

        var data_grid_filter = $.grep($('#W09F1102_grid').pqGrid('option', 'dataModel.data'), function (n, i) {
            return n.IsUpdate == 1;
        })

        $.ajax({
            method: "POST",
            data: {data_grid_filter: data_grid_filter},
            url: "{{url("/W09F1102/".$pForm."/$g/save")}}",
            success: function (data) {
                var currentObject = $.parseJSON(data);
                if (currentObject.status == 'SUCCESS') {
                    save_ok(function () {
                        $('#W09F1102_grid').pqGrid('option', 'dataModel.data', currentObject.data);
                        $('#W09F1102_grid').pqGrid('refreshDataAndView');
                        toggle_row();

                    });


                }
                else
                    alert_error(currentObject.message);
            }
        });
    })


    function loadGridW09F1102() {
        var obj = {
            width: '100%',
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            height: $(document).height() - 150,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'false'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            pageModel: {type: 'local', rPP: 100, rPPOptions: [20, 30, 40, 50]},
            collapsible: false,
            postRenderInterval: -1,
            editable: true,
            filterModel: {on: true, mode: "AND", header: true},


            numberCell: {show: false},
            rowClick: function (event, ui) {
                var rowData = ui.rowData;
                console.log(rowData);
            },
            cellSave: function (event, ui) {
                var rowData = ui.rowData;
                if (rowData['DutyManagerID'] != '') {
                    rowData['IsUpdate'] = '1';

                }
                else {
                    rowData['IsUpdate'] = 0;
                }

                var dataIndx = ui.dataIndx;
                console.log('vinh', rowData);
                if (dataIndx == 'DutyManagerID' && rowData['DutyManagerID'] != '') {
                    var DutyManagerID = $('#W09F1102_grid').pqGrid("getColumn", {dataIndx: "DutyManagerID"});
                    var dataCombo = DutyManagerID.editor.options;
                    var rowEvaluation = $.grep(dataCombo, function (d) {
                        return d.DutyManagerID == rowData['DutyManagerID'];
                    });
                    rowData['DutyManagerName'] = rowEvaluation[0]['DutyManagerName'];
                    $('#W09F1102_grid').pqGrid("refreshDataAndView");
                }

            }

        };
        obj.colModel = [

            {

                title: "{{Helpers::getRS($g,'Ma_chuc_danh_cong_viec')}}",
                dataType: "string",
                dataIndx: "DutyID",
                minWidth: 100,
                width: 160,
                maxWidth: 200,
                editable: false,
                editor: false,
                align: "left",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {

                title: "IsUpdate",
                dataType: "string",
                dataIndx: "Update",
                minWidth: 45,
                width: 450,
                maxWidth: 450,
                align: "left",
                hidden: true,
            },
            {
                title: "{{Helpers::getRS($g,'Ten_chuc_danh_cong_viec')}}",
                dataType: "string",
                dataIndx: "DutyName",
                minWidth: 120,
                width: 450,
                maxWidth: 500,
                align: "left",
                editable: false,
                editor: false,
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ma_chuc_danh_quan_ly')}}",
                dataType: "string",
                editable: true,
                minWidth: 100,
                width: 160,
                maxWidth: 200,
                align: "left",
                hidden: false,
                dataIndx: 'DutyManagerID',
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editor: {
                    prepend: {'': ''},
                    options: {{$DutyCb}},
                    type: "select",
                    valueIndx: "DutyManagerID",
                    labelIndx: "DutyManagerName",
                    init: function (ui) {
                        ui.$cell.find("select").pqSelect({
                            singlePlaceholder: 'Chọn'
                        });
                        ui.$cell.find("select").change(function (evt) {
                            var rowData = ui.rowData;
                            rowData['IsUpdate'] = '1';
                            var dataIndx = ui.dataIndx;
                            var ID = $(this).val();
                            if (ID != '') {
                                var DutyManagerID = $('#W09F1102_grid').pqGrid("getColumn", {dataIndx: "DutyManagerID"});
                                var dataCombo = DutyManagerID.editor.options;
                                var rowEvaluation = $.grep(dataCombo, function (d) {
                                    return d.DutyManagerID == ID;
                                })

                                rowData['DutyManagerName'] = rowEvaluation[0]['DutyManagerName'];
                                $('#W09F1102_grid').pqGrid("refreshDataAndView");
                            }
                            else {
                                rowData['DutyManagerName'] = '';
                                $('#W09F1102_grid').pqGrid("refreshDataAndView");


                            }

                        });
                    }


                }

            },
            {
                title: "{{Helpers::getRS($g,'Ten_chuc_danh_quan_ly')}}",
                dataType: "string",
                dataIndx: "DutyManagerName",
                minWidth: 120,
                width: 450,
                maxWidth: 500,
                editable: false,
                editor: false,
                align: "center",
                hidden: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}

            },

        ];
        obj.dataModel = {
            data: {{$Duty_grid}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        obj.create = function (evt, ui) {
            //console.log('hello man');

        };

        $("#W09F1102_grid").pqGrid(obj);
        setTimeout(function () {
            $("#W09F1102_grid").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#W09F1102_grid").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            $("#W09F1102_grid").pqGrid("refreshDataAndView");
        }, 300)
    }

    $('#chkAllW09F1102').click(function () {

        toggle_row(1);

    });
    // hide row base on checkbox
    //mode 1 mean search all the grid hide  all row has DUtyID and Isupdate !=1, isupdate =1 when user edit the DutyID isupdate set to 1
    function toggle_row(mode) {

        if ($("#chkAllW09F1102").is(":checked")) {

            var data = $('#W09F1102_grid').pqGrid("option", "dataModel").data;

            for (var i = 0; i < data.length; i++) {
                if (mode != 1) {
                    if (data[i].DutyManagerID != '') {
                        data[i].pq_hidden = false;

                    }
                }
                else {
                    if (data[i].DutyManagerID != '' && data[i].IsUpdate != 1) {
                        data[i].pq_hidden = false;

                    }
                }


            }
            $('#W09F1102_grid').pqGrid("refreshView");

        }
        else {
            var data = $('#W09F1102_grid').pqGrid("option", "dataModel").data;

            for (var i = 0; i < data.length; i++) {
                if (mode != 1) {
                    if (data[i].DutyManagerID != '') {
                        data[i].pq_hidden = true;

                    }
                }
                else {
                    if (data[i].DutyManagerID != '' && data[i].IsUpdate != 1) {
                        data[i].pq_hidden = true;

                    }
                }

            }
            $('#W09F1102_grid').pqGrid("refreshView");


        }
    }

    // show alert if grid has edited
    function funcLoseModalW09F1102() {
        var Grid_W09F1102 = $('#W09F1102_grid').pqGrid('option', 'dataModel.data');
        var grid_filter = $.grep(Grid_W09F1102, function (a) {
            return a.IsUpdate == 1;
        });
        if (grid_filter != 0) {
            alert_custom(icon_ask, "{{Helpers::getRS($g, 'Ban_co_muon_dong_khong')}}", true, true, function () {
                $('#modalW09F1102').modal('hide');
            });

        }
        else {
            $('#modalW09F1102').modal('hide');

        }
    }
    $('#modalW09F1102').on('hidden.bs.modal', function (ui) {
        $.ajax({
            method: "POST",
            data: '',
            url: "{{url("/W09F1100/".$pForm."/$g/reloadGrid")}}",
            success: function (data) {
                $("#gridW09F1100").pqGrid("option", "dataModel.data", data);
                $("#gridW09F1100").pqGrid("refreshDataAndView");
                disableViewW09F1100();
                var data = $("#gridW09F1100").pqGrid('option', "dataModel.data");
                if (data.length > 0) {
                    $("#gridW09F1100").pqGrid("setSelection", {rowIndx: 0});
                    append_data(data[0].DutyID, data[0].DutyName);
                    Duty_id = data[0].DutyID;
                    Duty_name = data[0].DutyName;
                }


            }
        });

    })
</script>
