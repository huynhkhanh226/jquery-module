<div id="gridW09F2022"></div>
<div id="secW09F4444"></div>
<script type="text/javascript">
    var obj = {
        width: '100%',
        height: $(document).height() - 230,
        editable: true,
        freezeCols: 2,
        selectionModel: {type: 'cell'},
        minWidth: 30,
        //pageModel: {type: "local", rPP: 20},
        filterModel: {on: true, mode: "AND", header: false},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        collapsible: false,
        postRenderInterval: -1,
        colModel: [
            {
                title: "TransID",
                minWidth: 240,
                dataType: "string",
                align: "center",
                hidden: true,
                dataIndx: "TransID"
            },
            {
                title: '{{Helpers::getRS($g,"Chon")}}',
                minWidth: 50,
                width: 50,
                align: "center",
                dataType: "integer",
                dataIndx: "IsUsed",
                editor: false,
                sortable: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: true,

                render: function (ui) {
                    var row = ui.rowData,
                        checked = row["IsUsed"] == 1 ? 'checked' : '',
                        disabled = this.isEditableCell(ui) ? "" : "disabled";
                    return {
                        text: "<label><input type='checkbox' " + checked + " /></label>",
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },

            {
                title: "{{Helpers::getRS($g,"Ma_NV")}}",
                minWidth: 140,
                dataType: "string",
                align: "left",
                dataIndx: "EmployeeID",
                editor: false
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
            },

            {
                title: "{{Helpers::getRS($g,"Ten_NV")}}",
                minWidth: 230,
                dataType: "string",
                align: "left",
                dataIndx: "EmployeeName",
                editor: false,
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    str += "<a title='{{Helpers::getRS($g,"Nhan_vien")}}' class='btnViewEmployeeID mgr10 text-blue'>"+rowData["EmployeeName"]+"</a>";
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var row = ui.rowData;
                    //edit button
                    $cell.find(".btnViewEmployeeID").bind("click", function (evt) {
                        showW09F4444W15(row["EmployeeID"]);
                    });

                }
            }
            @foreach($rsColumns as $row)
            , {
                title: '{{$row["RefCaption"]}}',
                minWidth: 50,
                width: 170,
                align: "center",
                dataType: "integer",
                dataIndx: "{{$row["RefID"]}}",
                editor: false,
                sortable: false,
                type: 'checkbox',
                dynamicCol: true,
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                //editable: true,
                editable: function (ui) {
                    var rowData = ui.rowData
                    return "{{$row["Status"] == 1 ? true:false}}" && rowData["IsUsed"] == 1 ;
                },

                render: function (ui) {
                    var row = ui.rowData,
                        checked = row["{{$row["RefID"]}}"] == 1 ? 'checked' : '',
                        disabled = this.isEditableCell(ui) ? "" : "disabled";
                    return {
                        text: "<label><input type='checkbox' " + checked + " /></label>",
                        cls: (disabled ? "readonly-status" : "")
                    };
                },
                hidden: "{{$row['Disabled'] == 1 ? true: false}}"
            }
            @endforeach

        ],
        dataModel: {
            data: {{json_encode($rsData)}}
        },
        cellClick: function(event, ui){
            if (this.isEditableCell(ui) == false){
                event.stopPropagation();
                event.preventDefault();
            }
        }
    };
    var $gridW09F2022 = $("#gridW09F2022").pqGrid(obj);
    //$gridW09F2022.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    //$gridW09F2022.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $("#gridW09F2022").pqGrid("refreshDataAndView");

    function showW09F4444W15(empid){
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "GET",
            url: "{{url("W09F4444/4")}}",
            data:{empid:empid},
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#secW09F4444").html(data);
                $("#modalW09F4444").modal("show");
            }
        });
    }
</script>