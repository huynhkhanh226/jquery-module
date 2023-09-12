<div id="pqgrid_W09F1920"></div>
<script type="text/javascript">
    $(document).ready(function () {
        var obj = {
            width: '100%',
            height: documentHeight - 234,
            showTitle: false,
            collapsible: false,
            editable: false,
            selectionModel: { type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel:{ horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none', flexContent :false }
        };
        obj.colModel = [
            @if ($per > 0)
            {
                title: "",
                minWidth: 50,
                width: 50,
                align: "center",
                dataIndx: "View",
                hidden: isHiddenColumn('View'),
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '<a title="{{Helpers::getRS($g,"Xem")}}" onclick="callW09F1921(\'' + rowData["EmployeeID"] + '\')"><i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';
                    str += '<a title="{{Helpers::getRS($g,"Xoa")}}" onclick="deleteW09F1921(\''+rowData["EmployeeID"]+'\');"><i class="glyphicon glyphicon-bin text-black"></i></a>';
                    return str;
                }
            },
            @endif
            {
                title: "{{Helpers::getRS($g,'Ma_nhan_vien')}}",
                minWidth: 110,
                width: 110,
                dataType: "string",
                dataIndx: "EmployeeID",
                hidden: isHiddenColumn('EmployeeID'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ho_va_ten')}}",
                minWidth: 170,
                width: 170,
                dataType: "string",
                dataIndx: "EmployeeName",
                hidden: isHiddenColumn('EmployeeName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Gioi_tinh')}}",
                minWidth: 70,
                width: 70,
                dataType: "string",
                align: "center",
                dataIndx: "SexName",
                hidden: isHiddenColumn('SexName'),
                filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': ' '},
                    valueIndx: "SexName",
                    labelIndx: "SexName",
                    listeners: ['change']
                }
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_sinh')}}",
                minWidth: 80,
                dataType: "date",
                align: "center",
                dataIndx: "BirthDate",
                hidden: isHiddenColumn('BirthDate'),
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_vao_lam')}}",
                minWidth: 80,
                dataType: "date",
                align: "center",
                dataIndx: "DateJoined",
                hidden: isHiddenColumn('DateJoined'),
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Phong_ban')}}",
                minWidth: 110,
                width: 110,
                dataType: "string",
                dataIndx: "DepartmentID",
                hidden: isHiddenColumn('DepartmentID'),
                resizable: true,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ten_phong_ban')}}",
                minWidth: 170,
                width: 170,
                dataType: "string",
                dataIndx: "DepartmentName",
                hidden: isHiddenColumn('DepartmentName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Chuc_vu')}}",
                minWidth: 110,
                width: 110,
                dataType: "string",
                dataIndx: "DutyID",
                hidden: isHiddenColumn('DutyID'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ten_chuc_vu')}}",
                minWidth: 170,
                width: 170,
                dataType: "string",
                dataIndx: "DutyName",
                hidden: isHiddenColumn('DutyName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Cong_viec')}}",
                minWidth: 110,
                width: 110,
                dataType: "string",
                dataIndx: "WorkID",
                hidden: isHiddenColumn('WorkID'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ten_cong_viec')}}",
                minWidth: 170,
                width: 170,
                dataType: "string",
                dataIndx: "WorkName",
                hidden: isHiddenColumn('WorkName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_quan_ly_truc_tiep')}}",
                minWidth: 170,
                width: 170,
                dataType: "string",
                dataIndx: "DirectManagerName",
                hidden: isHiddenColumn('DirectManagerName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Quoc_tich')}}",
                minWidth: 150,
                width: 150,
                dataType: "string",
                dataIndx: "CountryName",
                hidden: isHiddenColumn('CountryName'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Mobile')}}",
                minWidth: 100,
                width: 100,
                dataType: "string",
                dataIndx: "Pager",
                hidden: isHiddenColumn('Pager'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'So_noi_bo')}}",
                minWidth: 100,
                width: 100,
                dataType: "string",
                dataIndx: "CompanyTelephone",
                hidden: isHiddenColumn('CompanyTelephone'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_dung')}}",
                minWidth: 90,
                width: 90,
                dataType: "string",
                dataIndx: "UserID",
                hidden: isHiddenColumn('UserID'),
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Da_nghi_viec')}}",
                minWidth: 80,
                width: 80,
                dataType: "string",
                align: "center",
                dataIndx: "Disabled",
                hidden: isHiddenColumn('Disabled'),
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input type="checkbox" disabled ' + (rowData["Disabled"] == 1 ? "checked" : "") + '>';
                }
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_nghi_viec')}}",
                minWidth: 90,
                dataType: "date",
                align: "center",
                dataIndx: "DateLeft",
                hidden: isHiddenColumn('DateLeft'),
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "LastName",
                dataIndx: "LastName",
                hidden: true
            },
            {
                title: "MiddleName",
                dataIndx: "MiddleName",
                hidden: true
            },
            {
                title: "FirstName",
                dataIndx: "FirstName",
                hidden: true
            },
            {
                title: "Sex",
                dataIndx: "Sex",
                hidden: true
            }
        ];
        obj.dataModel = {
            data: {{json_encode($rsData)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $gridW09F1920 = $("#pqgrid_W09F1920").pqGrid(obj);
        //Get datafilter for Source col
        $gridW09F1920.on("pqgridrefresh", function (event, ui) {
            var column = $gridW09F1920.pqGrid("getColumn", {dataIndx: "SexName"});
            var filter = column.filter;
            filter.cache = null;
            filter.options = $gridW09F1920.pqGrid("getData", {dataIndx: ["SexName"]});
            //=======================================================
        });
        var column = $gridW09F1920.pqGrid("getColumn", {dataIndx: "SexName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW09F1920.pqGrid("getData", {dataIndx: ["SexName"]});
        //=======================================================
        $gridW09F1920.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW09F1920.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW09F1920.pqGrid("refreshDataAndView");
    });

    var callW09F1921 = function (empid) {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "GET",
            url: '{{url("/W09F1921/".$pForm."/add")}}',
            data: {id: empid},
            success: function (data) {
                $("#myModal").html(data);
                $('#modalW09F1921').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });

                $(".l3loading").addClass('hide');
            }
        });
    };

</script>