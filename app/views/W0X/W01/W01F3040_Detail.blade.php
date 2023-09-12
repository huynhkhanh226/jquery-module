<div style="width: 700px;height: 320px">
    {{$strtable}}
    <a id="btnExExcelW01F3040" class="pull-right text-green" style="font-size: 120%" title="{{Helpers::getRS(6,"Xuat_Excel")}}" onclick="W01F3040ExportExcel();"><span class="fa fa-file-excel-o"></span></a>
</div>
<script>
    var summary = $.parseJSON('{{$summary}}');
    var tbl = $("table#W01F3040_Detail");
    var obj = L3tableToArray(tbl);
    var newObj = { width: '100%', height: 300, showTitle: false, collapsible: false, editable: false, minWidth:600};
    newObj.dataModel = { data: obj.data };
    newObj.colModel = obj.colModel;
    newObj.summaryData = [summary];
    newObj.pageModel = { rPP: 20, type: "local" };
    newObj.scrollModel =  {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'};
    $("#pgrid_W01F3040_Detail").pqGrid(newObj);
    tbl.css("display", "none");

    var W01F3040ExportExcel = function () {
        var blob = $("#pgrid_W01F3040_Detail").pqGrid("exportData", {format: 'xlsx',sheetName: "Data", render:false});
        if (typeof blob === "string") {
            blob = new Blob([blob]);
        }
        saveAs(blob, "W01F3040_Detail.xlsx");
    };
</script>
