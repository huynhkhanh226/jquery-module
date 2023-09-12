<div id="pqgrid_W09F5888" style="margin:auto;"></div>
<div id="idHistory"></div>
<div class="col-md-12 pdt5">
    <div class="row">
        <div class="col-md-12 pdl0">
            <select id="sof12" multiple="multiple">
                <option value="ViewHis" selected disabled>{{Helpers::getRS($g,'Lich_su_HDLD')}}</option>
                <option value="EmployeeID">{{Helpers::getRS($g,'Ma_NV')}}</option>
                <option value="EmployeeName">{{Helpers::getRS($g,'Ho_va_ten')}}</option>
                <option value="DutyName">{{Helpers::getRS($g,'Chuc_vu')}}</option>
                <option value="Seniority">{{Helpers::getRS($g,'Tham_nien')}}</option>
                <option value="ContractTypeName">{{Helpers::getRS($g,'Loai_HDLD')}}</option>
                <option value="EffContractBegin">{{Helpers::getRS($g,'Hieu_luc_tu')}}</option>
                <option value="EffContractEnd">{{Helpers::getRS($g,'Hieu_luc_den')}}</option>
                <option value="TimeLeftInContract">{{Helpers::getRS($g,'Thoi_gian_con_lai_HD')}}</option>
            </select>
        </div>
    </div>
</div>
<script type="text/javascript">
    var iW09F5888Height;
    var iW09F5888Width;
    var wd = [60, 100, 170, 180, 130, 240, 90, 90, 160];
    var colhide = {{json_encode($arrColHide)}};
    var oldVl="";
    var isHiddenColumn = function (el) {
        return colhide.contains(el);
    };
    var GetFilterSelect = function(vl) {
        oldVl=vl;
    };
    $(document).ready(function () {
        iW09F5888Width = $("#secW09F5888").width() - 5;
        iW09F5888Height = $(".contenttab").height() - 200;
        var obj = {
            width: '100%',
            height: iW09F5888Height,
            showTitle: false,
            collapsible: false,
            freezeCols: 3,
            editable: true,
            funcGetFilterSelect: GetFilterSelect,
            oldSelectFilter: '',
            filterModel: {on: true, mode: "AND", header: true}
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Lich_su_HDLD')}}",
                minWidth: 60,
                align: "center",
                dataIndx: "ViewHis",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<a><i class="glyphicon glyphicon-search text-yellow" onclick="callShowPopUp(\'' + rowData["EmployeeID"] + '\')"></i></a>';
                }
            },
            {
                title: "{{Helpers::getRS($g,'Ma_NV')}}",
                minWidth: 100,
                dataType: "string",
                dataIndx: "EmployeeID",
                hidden: isHiddenColumn('EmployeeID'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ho_va_ten')}}",
                minWidth: 180,
                dataType: "string",
                dataIndx: "EmployeeName",
                hidden: isHiddenColumn('EmployeeName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Chuc_vu')}}",
                minWidth: 170,
                dataType: "string",
                dataIndx: "DutyName",
                hidden: isHiddenColumn('DutyName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Tham_nien')}}",
                minWidth: 130,
                dataType: "string",
                dataIndx: "Seniority",
                hidden: isHiddenColumn('Seniority'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Loai_HDLD')}}",
                minWidth: 240,
                dataType: "string",
                dataIndx: "ContractTypeName",
                hidden: isHiddenColumn('ContractTypeName'),
                filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{Helpers::getRS($g,'Chon')}} --'},
                    valueIndx: "ContractTypeName",
                    labelIndx: "ContractTypeName",
                    listeners: ['change']
                }
            },
            {
                title: "{{Helpers::getRS($g,'Hieu_luc_tu')}}",
                minWidth: 90,
                dataType: "date",
                dataIndx: "EffContractBegin",
                hidden: isHiddenColumn('EffContractBegin'),
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Hieu_luc_den')}}",
                minWidth: 100,
                dataType: "date",
                dataIndx: "EffContractEnd",
                hidden: isHiddenColumn('EffContractEnd'),
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Thoi_gian_con_lai_HD')}}",
                minWidth: 160,
                dataIndx: "TimeLeftInContract",
                hidden: isHiddenColumn('TimeLeftInContract'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ];
        obj.dataModel = {
            data: {{json_encode($rs)}}

        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $grid = $("#pqgrid_W09F5888").pqGrid(obj);
        var column = $grid.pqGrid("getColumn", {dataIndx: "ContractTypeName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["ContractTypeName"]});
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
        $grid.on( "pqgridrefresh", function( event, ui ) {
            $("select[name='ContractTypeName'] option").each(function () {
                if($(this).text()==oldVl) {
                    $(this).prop('selected',true);
                }
            });
        } );

        $("#tblContract").find('#sof12').multiselect({
            includeSelectAllOption: true,
            selectAllValue: 0,
            maxHeight: 700,
            dropUp: true,
            onInitialized: function(select, container) {
                $(container).find('.multiselect-container').append('<li><button type="button" id="frm_btnSaveW09F5888" class="btn btn-default smallbtn pull-right"><span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS(0,"Luu")}}</button></li>');
            },
            onChange: function () {
                colhide = [];
                var colM = $grid.pqGrid("option", "colModel");
                $("#tblContract").find('#sof12 option').each(function (index, brand) {
                    column = $grid.pqGrid("getColumn", {dataIndx: $(this).attr('value')});
                    if ($(this).is(':selected')) {
                        column.hidden = false;
                        column.width = wd[index];
                    }
                    else {
                        colhide.push($(this).attr('value'));
                        column.hidden = true;
                    }
                });
                $grid.pqGrid("option", "colModel", colM);
            },
            onSelectAll: function (checked) {
                colhide = [];
                var colM = $grid.pqGrid("option", "colModel");
                $("#tblContract").find('#sof12 option').each(function (index, brand) {
                    colM[index].hidden = $(this)[0].disabled == true ? false : !checked;
                    colM[index].width = wd[index];
                    if (checked == false)
                        colhide.push($(this).attr('value'));
                });
                $grid.pqGrid("option", "colModel", colM);
            }
        });
        $("#tblContract").find('#sof12').multiselect('selectAll', false).multiselect('deselect', colhide).multiselect('updateButtonText');
    });

    function callShowPopUp(id) {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: "W09F5889/D09F5889/4/" + id,
            success: function (data) {
                $("#idHistory").html(data);
                $(".l3loading").addClass('hide');
                $("#modalW09F5889").modal('show');
            }
        });
    }
//    function refreshPQ() {
//        $("#pqgrid_W09F5888").pqGrid("refresh");
//    }
//    function resizePqGrid() {
//        var width = $("#pqgrid_W09F5888").pqGrid("option", "width");
//        if ($("body").hasClass('sidebar-collapse'))
//            $("#pqgrid_W09F5888").pqGrid({width: width + 200});
//        else
//            $("#pqgrid_W09F5888").pqGrid({width: width - 200});
//        refreshPQ();
//    }

    $("#frm_btnSaveW09F5888").on('click', function (e) {
        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: {action: 'saveF12', arrHide: colhide},
            success: function (data) {
                if (data == 1) {
                    save_ok()
                }
                else {
                    alert_error(data);
                }
            }
        });
    });
</script>	
