<div class="modal draggable fade" id="modalCompanySearch" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 75%">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading($caption,"",true,"")}}
            </div>
            <div class="modal-body pd5">
                <div class="row form-group ">
                    <div class="col-md-12 col-xs-12">
                        <div id="gridCompanySearch">

                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12 col-xs-12">
                        <button type="button" id="btnSelectionCompanySearch" name="btnSelectionCompanySearch"
                                class="btn btn-default smallbtn pull-right "><span
                                    class="fa fa-check text-primary"></span> {{Helpers::getRS($g,"Chon")}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var rsData = {{json_encode($rsData)}};
    var $gridCompanySearch = $("#gridCompanySearch");
    $(document).ready(function () {
        initGridW76F2110(function(){
            setSelection();
        });

    });

    function initGridW76F2110(callback) {
        obj = {
            width: "100%",
            height: 420,
            scrollModel: {autoFit: true},
            numberCell: {show: false},
            showTitle: false,
            collapsible: false,
            selectionModel: {type: null},

            pasteModel: {on: false},
            //pageModel: { type: "local", rPP: 10 },
            filterModel: {on: true, mode: "AND", header: true},
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: "{{Helpers::getRS($g,"Them_moi1")}}",
                        icon: 'ui-icon-plus',
                        listener: function () {
                            //Xóa filter
                            $("#gridCompanySearch").pqGrid( "reset", { group: true, filter: true } );
                            //Uncheck all
                            $("#gridCompanySearch").pqGrid( "selection",
                                { type: 'row', method: 'removeAll' }
                            );
                            showFormDialogPost('{{url("/W17F1011/D17F1010/3/add")}}', 'modalW17F1011', {formCall: "W76F2110"},null, null, null, function(){
                                //sessionStorage.setItem("companyIDW17F1011", "");
                                var companyIDW17F1011 = localStorage.getItem("companyIDW17F1011");
                                postMethod("{{url('/W76F2111/'.$pForm.'/'.$g.'/reloadgrid')}}", function(data){
                                    var data = JSON.parse(data);
                                    $("#gridCompanySearch").pqGrid("option", "dataModel.data", data);
                                    $("#gridCompanySearch").pqGrid("refreshDataAndView");
                                    setSelection();
                                }, {txtD76CompanyIDW76F2111: companyIDW17F1011});
                            })
                        }
                    }]
            },
            colModel: [

                {
                    title: "<label><input type='checkbox'/></label>",
                    dataIndx: "IsSelected",
                    align: "center",
                    maxWidth: 40,
                    minWidth: 40,
                    type: 'checkbox',
                    cls: 'ui-state-default',
                    dataType: 'bool',
                    cb: {header: true, select: true, all: true, check: "1", uncheck: "0"},
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
                    title: "{{Helpers::getRS($g, 'Ma')}}",
                    dataIndx: "D17CompanyID",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                }
                , {
                    title: "{{Helpers::getRS($g, 'Ten')}}",
                    dataIndx: "D17CompanyName",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},

                }
                , {
                    title: "{{Helpers::getRS($g, 'Ten_tat')}}",
                    dataIndx: "CompanyShort",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},


                }
                , {
                    title: "{{Helpers::getRS($g, 'Nhom_cong_ty')}}",
                    dataIndx: "CompanyGroupID",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},

                }
            ],
            dataModel: {
                data: {{json_encode($rsData)}}

            },
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                onBlur: "save",
                clicksToEdit: 2
            }
        };
        $gridCompanySearch = $("#gridCompanySearch").pqGrid(obj);
        $gridCompanySearch.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridCompanySearch.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        setTimeout(function () {
            $gridCompanySearch.pqGrid("refreshDataAndView");
            callback.call(null, null);
        }, 300);

    }

    $("#btnSelectionCompanySearch").click(function () {
        //Get all row selections
        var selectionArray = $("#gridCompanySearch").pqGrid("selection",
            {type: 'row', method: 'getSelection'}
        );

        /*if (selectionArray.length ==0 ){
            alert_warning("{{Helpers::getRS($g,"Ban_chua_chon_du_lieu_tren_luoi")}}")
        }else{
            var id = "";
            var name = "";
            for(var i=0; i<selectionArray.length; i++){
                id +=  selectionArray[i].rowData.D17CompanyID + ";";
                name +=  selectionArray[i].rowData.D17CompanyName + ";";
            }
            $("#txtD76CompanyIDW76F2111").val(id);
            $("#txtD17CompanyNameW76F2111").val(name);
            $("#modalCompanySearch").modal('hide');
        }*/

        var id = "";
        var name = "";
        if (selectionArray.length > 20){
            alert_warning("{{Helpers::getRS($g, 'Ban_chi_duoc_chon_toi_da_hai_muoi_cong_ty')}}")
        }else{
            for(var i=0; i<selectionArray.length; i++){
                id +=  selectionArray[i].rowData.D17CompanyID + ";";
                name +=  selectionArray[i].rowData.D17CompanyName + ";";
            }
            $("#txtD76CompanyIDW76F2111").val(id);
            $("#txtD17CompanyNameW76F2111").val(name);
            $("#modalCompanySearch").modal('hide');
        }



    });

    function setSelection(){
        var data = $("#gridCompanySearch").pqGrid("option", "dataModel.data");
        for (var j=0; j<data.length; j++){
            if (data[j].IsSelected == true){
                $("#gridCompanySearch").pqGrid( "selection",
                    { type: 'row', method: 'add', rows: [ { rowIndx: j } ] }
                );
            }

        }

    }
</script>