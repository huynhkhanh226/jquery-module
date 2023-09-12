<div id = "tblW15F3030"></div>
<script type="text/javascript">
    $(function () {
        var dsData = {{json_encode($dsData)}};
        var format = {{$dsFormat[0]['LeaveQtyDecimals']}};
        var obj = {
            width: $("#tbW15F3030").width(),
            height: $("#maintabs").height() - 136,
            editable: false,
            freezeCols: 1,
            minWidth: 30,
            pageModel: {type:"local", rPP:10 },
            filterModel: {on: true, mode: "AND", header: true},
            showTitle: false,
            wrap: true,
            hwrap: true,
            collapsible:false,
            colModel:
                    [
                        { title: "{{Helpers::getRS($g,"Ma_NV")}}", minWidth: 110,  dataType: "string",dataIndx:"EmployeeID",align:"left" , filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},render: function (ui) {
                            var rowData = ui.rowData;
                            return '<a class="text-blue" title="{{Helpers::getRS($g,"Xem")}}" onclick="callShowPopUpW15F3031(\''+rowData['EmployeeID']+'\')">'+rowData["EmployeeID"]+'</a>';

                        }},
                        { title: "{{Helpers::getRS($g,"Ho_va_ten")}}", minWidth: 200,  dataType: "string",dataIndx:"EmployeeName",align:"left" , filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}},
                        { title: "{{Helpers::getRS($g,"Phong_ban")}}", minWidth: 200,  dataType: "string",dataIndx:"DepartmentName",align:"left" , filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}},

                        @foreach($dsCaption as $rowCaption)
                            { title: "{{$rowCaption['Caption']}}", minWidth: 140, align:"right" ,dataIndx:"{{$rowCaption['FieldName']}}",dataType: 'float', filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}, render: function (ui) {
                                var rowData = ui.rowData;
                                return format2(rowData["{{$rowCaption['FieldName']}}"], '', format);

                            }},
                        @endforeach

                        { title: "{{Helpers::getRS($g,"Da_quyet_toan_phep")}}",  minWidth: 110,align: "center", sortable: false, render: function (ui) {
                            var rowData = ui.rowData;
                            return '<input type="checkbox" disabled ' + (rowData["IsLeaveBalanced"] == 1 ? "checked" : "") + '>';

                        }}
                    ],
            dataModel: {
                data: dsData

            }
        };
        var $gridW15F3030= $("#tblW15F3030").pqGrid(obj);
        $gridW15F3030.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW15F3030.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW15F3030.pqGrid("refreshDataAndView");

    });

//    function resizePqGrid() {
//        var width = $("#tblW15F3030").pqGrid("option", "width");
//        if ($("body").hasClass('sidebar-collapse'))
//            $("#tblW15F3030").pqGrid({width: width + 200});
//        else
//            $("#tblW15F3030").pqGrid({width: width - 200});
//        $("#pqgrid_W09F5888").pqGrid("refresh");
//    }

    function callShowPopUpW15F3031(employeeid){
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W15F3031/view/".$pForm."/".$g."/detail")}}/' + employeeid,
            success: function (data) {
                $("#tbW15F3031").html(data);
                $(".l3loading").addClass('hide');
                $("#modalW15F3031").modal('show');
            }
        });
    }

</script>
