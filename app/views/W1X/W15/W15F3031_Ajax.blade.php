<div id = "gridW15F3031"></div>
<script type="text/javascript">
    var dsDetail = {{json_encode($dsDetail)}};
    var objDetail = {
        width: $('#modalW15F3031').find("#gridW15F3031").width(),
        height:documentHeight-237,
        editable: false,
        minWidth: 30,
        pageModel: {type:"local", rPP:20 },
        //filterModel: {on: true, mode: "AND", header: true},
        showTitle: false,
        wrap: true,
        hwrap: true,
        collapsible:false,
        scrollModel:{ horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none' },
        colModel:
                [
                    {
                        title: "{{Helpers::getRS($g,"Ngay_nghi_phep")}}",
                        minWidth: 110,
                        dataType: "string",
                        dataIndx: "LeaveDate",
                        align: "center"
                    },
                    {
                        title: "{{Helpers::getRS($g,"Loai_phep")}}",
                        minWidth: 300,
                        dataType: "string",
                        dataIndx: "LeaveTypeName",
                        align: "left"
                    },
                    {
                        title: "{{Helpers::getRS($g,"So_luong")}}",
                        minWidth: 110,
                        align: "right",
                        render: function (ui) {
                            var rowData = ui.rowData;
                            return format2(rowData["Quantity"], '',rowData["LeaveQtyDecimals"] );
                        }
                    },
                    {
                        title: "{{Helpers::getRS($g,"Ly_do_nghi_phep")}}",
                        minWidth: 300,
                        dataType: "string",
                        dataIndx: "Reason",
                        align: "left",
                    },

                    {
                        title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                        minWidth: 300,
                        dataType: "string",
                        dataIndx: "Note",
                        align: "left",
                    }
                ],
        dataModel: {
            data: dsDetail

        }
    };
    var $gridW15F3031= $("#gridW15F3031").pqGrid(objDetail);
    $gridW15F3031.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW15F3031.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $gridW15F3031.pqGrid("refreshDataAndView");

    $("#modalW15F3031").on('shown.bs.modal', function() {
        $("#gridW15F3031").pqGrid( "refresh" );

    });

</script>
