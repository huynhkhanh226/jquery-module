@if (isset($detail[0]["DataTitle"]))
    <div class="row text-center">
        <label class="col-md-12 text-orange text-bold">{{$detail[0]["DataTitle"]}}</label>
    </div>
@endif
<div class="row">
    <div class="col-md-12 col-xs-12 pdl0 mgl0 pdr0 mgr0">
        <div id="pqgrid_W09F1500" style="margin:auto;"></div>
    </div>
</div>
<section id="secDetailE09F0000"></section>
<script type="text/javascript">
    $(document).ready(function () {
        var obj = {
            width: '100%',
            height: $('#modalW09F1500').height() - 80,
            showTitle: false,
            collapsible: false,
            editable: false,
            freezeCols: 1,
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel:{ horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none' }
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Ma_NV')}}",
                minWidth: 120,
                dataType: "string",
                dataIndx: "EmployeeID",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<a class="text-blue" title="{{Helpers::getRS($g,"Xem")}}" onclick="showW09F4444(\'' + rowData["EmployeeID"] + '\')">' + rowData["EmployeeID"] + '</a>';
                },
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ho_va_ten')}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "EmployeeName",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<a class="text-blue" title="{{Helpers::getRS($g,"Xem")}}" onclick="showW09F4444(\'' + rowData["EmployeeID"] + '\')">' + rowData["EmployeeName"] + '</a>';
                },
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Chuc_vu')}}",
                minWidth: 170,
                dataType: "string",
                dataIndx: "DutyName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Do_tuoi')}}",
                minWidth: 80,
                dataType: "string",
                dataIndx: "Age",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                align: "center"
            },
            {
                title: "{{Helpers::getRS($g,'Tham_nien')}}",
                minWidth: 140,
                dataType: "string",
                dataIndx: "Seniority",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Mobile')}}",
                minWidth: 110,
                dataType: "string",
                dataIndx: "Pager",
                filter: {type: "textbox", condition: "contain", listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Dien_thoai_ban')}}",
                minWidth: 110,
                dataType: "string",
                dataIndx: "CompanyTelephone",
                filter: {type: "textbox", condition: "contain", listeners: ['keyup']}
            },
            {
                title: "Email",
                minWidth: 190,
                dataIndx: "Email",
                dataType: "string",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ];
        obj.dataModel = {
            data: {{json_encode($detail)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $grid = $("#pqgrid_W09F1500").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

    function showW09F4444(empid){
        {{--$.ajax({--}}
            {{--method: "GET",--}}
            {{--url: "{{url("W09F4444/$g")}}",--}}
            {{--data:{empid:empid},--}}
            {{--success: function (data) {--}}
                {{--$("#secDetailE09F0000").html(data);--}}
                {{--$("#modalW09F4444").modal("show");--}}
            {{--}--}}
        {{--});--}}

        showFormDialogGet("{{url("W09F4444/$g")}}", "modalW09F4444", {empid:empid});
    }
</script>