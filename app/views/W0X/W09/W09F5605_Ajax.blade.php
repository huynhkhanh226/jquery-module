<style>
    input.filterValue {
        border: 1px solid #aaa;
        padding: 1px 5px;
        margin: 0px 5px;
    }

    div.pq-toolbar select {
        height: 24px;
    }
</style>
<div id="tblEmployeeIDW09F5605"></div>
<script type="text/javascript">
    $(function () {
        //state of the checkbox and row selection is being saved in state field.
        var data = {{$dataW09F5605}};
//        $.each(data, function (i, item) {
//            item.IsUsed = item.IsUsed == 1 ? true : false;
//        });
        var objW09F5605 = {
            width: '100%',
            height: documentHeight - 330,
            scrollModel: {autoFit: true},
            numberCell: {show: false},
            showTitle: false,
            filterModel: {header: true, on: true},
            pageModel: {type: "local", rPP: 10},
            collapsible: false,
            selectionModel: { type: null },
            colModel: [
                {
                    title: "<label><input type='checkbox'/></label>",
                    dataIndx: "IsUsed",
                    align: "center",
                    maxWidth: 40,
                    minWidth: 40,
                    type: 'checkbox',
                    cls: 'ui-state-default',
                    dataType: 'bool',
                    cb: { header: true, select: true, all: true, check: "1", uncheck: "0"},
                    render: function (ui) {
                        var cb = ui.column.cb,
                                cellData = ui.cellData,
                                checked = cb.check == cellData ? 'checked' : '';
                        return {
                            text: "<label><input type='checkbox' " + checked + " /></label>"
                        };
                    },
                    editor: false
                },
                {
                    title: "{{Helpers::getRS($g,"Ma_NV")}}",
                    minWidth: 110,
                    dataType: "string",
                    dataIndx: "EmployeeID",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ho_va_ten")}}",
                    minWidth: 150,
                    dataType: "string",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    dataIndx: "EmployeeName"
                },
                {
                    title: "{{Helpers::getRS($g,"Gioi_tinh")}}",
                    minWidth: 80,
                    dataType: "string",
                    align: "center",
                    dataIndx: "Sex"
                },
                {
                    title: "{{Helpers::getRS($g,"Phong_ban")}}",
                    minWidth: 150,
                    dataType: "string",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    dataIndx: "DepartmentName"
                },
                {
                    title: "{{Helpers::getRS($g,"To_nhom")}}",
                    minWidth: 150,
                    dataType: "string",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    dataIndx: "TeamName"
                },
                {
                    title: "{{Helpers::getRS($g,"Tham_nien")}}",
                    minWidth: 150,
                    dataType: "string",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    dataIndx: "Seniority"
                },
                {
                    title: "{{Helpers::getRS($g,"Chuc_vu")}}",
                    minWidth: 150,
                    dataType: "string",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    dataIndx: "DutyName"
                }

            ],
            dataModel: {data: data}
        };
        var $gridW09F5605 = $("#tblEmployeeIDW09F5605").pqGrid(objW09F5605);
        $gridW09F5605.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW09F5605.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW09F5605.pqGrid("refreshDataAndView");
    });

</script>




