<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W25F3020" style="margin:auto;height: 300px;"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var iW25F2000Height = $(document).height() - 125;
        console.log($(document).height());
        var data = {{json_encode($rs2)}};
        var obj = {
            width: '100%',
            height: 750,
            showTitle: false,
            collapsible: false,
            editable: true,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},

        };
        obj.colModel = [
            {
                title: "Lịch PV",
                minWidth: 60,
                align: "center",
                dataIndx: "Description",
                isExport: false,
                editor:false

            },
            {
                title: "Duyệt CV ",
                minWidth: 120,
                dataType: "string",
                dataIndx: "IsApproveCV",
                editor:false
            },
            {
                title: "Vòng PV",
                minWidth: 170,
                dataType: "string",
                editor:false,
                dataIndx: "InterviewLevel"
            },
            {
                title: "Ngày lập",
                minWidth: 130,
                dataType: "string",
                editor:false,
                dataIndx: "VoucherDate"
            },
            {
                title: "Người lập",
                minWidth: 160,
                editor:false,
                dataIndx: "CreatorName"
            },
            {
                title: "Ngày tuyển (từ)",
                minWidth: 100,
                dataType: "integer",
                editor:false,
                dataIndx: "FromDate",
                align:'right'
            },
            {
                title: "Ngày tuyển (đến)",
                minWidth: 90,
                dataType: "string",
                editor:false,
                dataIndx: "ToDate"
            },
            {
                title: "Đợt",
                minWidth: 90,
                dataType: "string",
                editor:false,
                dataIndx: "RecruitPhaseNo"
            },
            {
                title: "Địa điểm",
                minWidth: 160,
                editor:false,
                dataIndx: "InterviewPlace"
            },
            {
                title: "Nhóm phỏng vấn",
                minWidth: 200,
                editor:false,
                dataIndx: "GroupInterviewer"
            },
            {
                title: "Trạng thái",
                minWidth: 200,
                editor:false,
                dataIndx: "StatusName"
            }
        ];
        obj.dataModel = {
            data: data,
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        $("#pqgrid_W25F3020").pqGrid(obj);
        $("#pqgrid_W25F3020").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#pqgrid_W25F3020").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $("#pqgrid_W25F3020").pqGrid("refreshDataAndView");

        $("#pqgrid_W25F3020").pqGrid({
            complete: function( event, ui ) {
                $( "#pqgrid_W25F3020" ).pqGrid( "option", "height", iW25F2000Height );
            }
        });
    });
</script>