<div id="gridDetailW90F4718" class=""></div>

<script type="text/javascript">
    $gridDetail = $("#gridDetailW90F4718");
    $(document).ready(function(){
        var objDetail = {
            width: '100%',
            height: $(document).height() - 290,
            editable: false,
            freezeCols: 1,
            minWidth: 30,
            selectionModel: {type: 'row', mode: 'single'},
            //filterModel: {mode: 'OR'},
            filterModel: {on: false, mode: "AND", header: false},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'},
            postRenderInterval: -1,
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: "{{Helpers::getRS($g,'Xuat_Excel_U')}}",
                        icon: 'ui-icon-arrowthickstop-1-s',
                        listener: function () {
                            //w90F4718ExportExcel();
                            var format = "xls",
                                blob = this.exportData({
                                    format: format,
                                    render: true
                                });
                            if(typeof blob === "string"){
                                blob = new Blob([blob]);
                            }
                            var now = new Date();
                            var toDay = createNameString(now.toLocaleDateString());
                            saveAs(blob, "Ket_qua_phan_tich_chi_so_tai_chinh_" + toDay+".xls");
                        }
                    }]
            },
            colModel: [
                @foreach($rsColumns as $row)
                {
                    title: "{{$row['Caption']}}",
                    minWidth: 80,
                    width: {{$row['Length']}},
                    @if ($row["DataType"] == "N")
                        dataType: "float",
                        align: "right",
                        format: returnSFormat({{str_replace("N", "",$row['DataFormat'] )}}),
                        decimal: {{str_replace("N", "",$row['DataFormat'] )}},
                    @elseif ($row["DataType"] == "S")
                        dataType: "float",
                        align: "left",
                    @else
                        dataType: "date",
                        align: "center",
                    @endif
                    dataIndx: "{{$row['FieldName']}}",
                    hidden: '{{intval($row['IsHide']) == 1 ? true: false}}',
                    isExport: '{{intval($row['IsHide']) == 1 ? false: true}}',
                    render: function (ui) {
                        console.log(ui);
                        var rowData = ui.rowData;
                        var str = "";
                        var cls = "";
                        //console.log(rowData);
                        var arr = rowData.StyleExcel.toString().split(',');
                        if (arr[0] != '' && arr.length > 0){
                            if (arr[0].toString().includes('B')){
                                cls += "text-bold ";
                            }
                            if (arr[0].toString().includes('I')){
                                cls += "text-italic ";
                            }
                            if (arr[0].toString().includes('U')){
                                cls += "text-decoration ";
                            }
                        }
                        if (ui.column.dataType == "integer" || ui.column.dataType == "float"){
                            if (Number(rowData["{{$row['FieldName']}}"]) == 0){
                                rowData["{{$row['FieldName']}}"] = '';
                            }else{
                                str += "<span class='"+cls+"'>"+ ui["formatVal"]  +"</span>";
                            }
                        }else{
                            str += "<span class='"+cls+"'>"+ rowData[ui.dataIndx]  +"</span>";
                        }


                        return str;
                    },
                },
                @endforeach
            ],
            dataModel: {
                data: {{json_encode($rsDataDetail)}}
            },
            complete: function (event, ui) {
                /*var data = $("#gridDetailW90F4718").pqGrid("option", "dataModel.data");
                if (data.length > 0) {
                    $("#gridDetailW90F4718").pqGrid("setSelection", {rowIndx: 0});
                } else {

                }*/
            },
            selectChange: function (event, ui) {
                //alert("change");
            }
        };
        $("#gridDetailW90F4718").pqGrid(objDetail);
        $("#gridDetailW90F4718").pqGrid("refreshDataAndView");
    });

    var w90F4718ExportExcel=function() {
        var _title = [];
        var _dataIndx =[];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridDetailW90F4718"),_title,_dataIndx,_align,_format);
        var _data = JSON.stringify($("#gridDetailW90F4718").pqGrid("option", "dataModel.data"));
        var now = new Date();
        var toDay = createNameString(now.toLocaleDateString());
        $.ajax({
            method: "POST",
            data: {title: _title, data:_data, dataIndx: _dataIndx, align:_align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if(data==0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "Ket_qua_phan_tich_chi_so_tai_chinh_" + toDay+".xls";
                    downloadLink.innerHTML = "Ket_qua_phan_tich_chi_so_tai_chinh_";
                    downloadLink.href =data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };

    function createNameString(day) {
        var arr = day.split("/");
        var rsDay = arr[1] + "_" + arr[0] + "_" + arr[2];
        return rsDay;
    }
</script>