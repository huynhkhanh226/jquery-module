<div class="modal fade" id="modalW09F3030" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F3030,"W09F3030",true,"closeW09F3030",true)}}
            </div>

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW09F3020">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="gridW09F3030"></div>
                        </div>
                    </div>
                    <button type="submit" id="frm_hbtnSave" class="hidden"></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function closeW09F3030(){
        $("#modalW09F3030").modal("hide");
    }
    $(document).ready(function (e) {
        setTimeout(function () {
            $gridW09F3030.pqGrid("refreshDataAndView");
        }, 500)
    });
    var obj = {
        width: '100%',
        height: $(document).height() - 75,
        editable: false,
        freezeCols: 2,
        selectionModel: {type: 'row'},
        minWidth: 30,
        pageModel: {type: "local", rPP: 20},
        filterModel: {on: true, mode: "AND", header: false},
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        collapsible: false,
        postRenderInterval: -1,
        colModel: [
            {
                title: "{{Helpers::getRS($g,"Cap_duyet")}}",
                minWidth: 80,
                width:  80,
                dataType: "string",
                dataIndx: "ApprovalLevel",
                align: "center"
            },
            {
                title: "{{Helpers::getRS($g,"Trang_thai")}}",
                minWidth: 80,
                width:  110,
                dataType: "string",
                dataIndx: "AppStatusName",
                align: "center"
            },

            {
                title: "AppStatusID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "AppStatusID",
                hidden: true
            },


            {
                title: "{{Helpers::getRS($g,"Nguoi_duyet")}}",
                minWidth: 80,
                width: 240,
                dataType: "string",
                dataIndx: "ApproverName",
                align: "left"
            },

            {
                title: "{{Helpers::getRS($g,"Ngay_duyet")}}",
                minWidth: 80,
                width: 110,
                dataType: "date",
                dataIndx: "ApprovalDate",
                align: "center"
            },

            {
                title: "{{Helpers::getRS($g,"Duoc_uy_quyen")}}",
                minWidth: 80,
                width: 110,
                dataType: "integer",
                dataIndx: "IsAuthorize",
                align: "center",
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
            },

            {
                title: "{{Helpers::getRS($g,"Phong_ban")}}",
                minWidth: 80,
                width: 170,
                dataType: "string",
                dataIndx: "DeparmentName",
                align: "left"
            },

            {
                title: "{{Helpers::getRS($g,"Chuc_vu")}}",
                minWidth: 80,
                width: 170,
                dataType: "string",
                dataIndx: "DutyName",
                align: "left"
            }
            @foreach($rsColumns as $row)
            , {
                title: "{{$row['FieldDesc'.$lang]}}",
                minWidth: 80,
                width: {{$row['Lengh']}},
                @if ($row["DataType"] == "N")
                    dataType: "float",
                    align: "right",
                    format: returnSFormat({{$row['Decimals']}}),
                @elseif ($row["DataType"] == "S")
                    dataType: "float",
                    align: "left",
                @else
                    dataType: "date",
                    align: "center",
                @endif
                dataIndx: "{{$row['FieldName']}}"
            }
            @endforeach
            ,{
                title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                minWidth: 80,
                width: 270,
                dataType: "string",
                dataIndx: "Notes",
                align: "left"
            }
        ],
        dataModel: {
            data: {{json_encode($rsData)}}
        }
    };

    var $gridW09F3030 = $("#gridW09F3030").pqGrid(obj);
    $gridW09F3030.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW09F3030.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $gridW09F3030.pqGrid("refreshDataAndView");

</script>