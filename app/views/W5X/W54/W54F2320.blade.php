<section class="content" id="secW54F2320">
    <form class="form-horizontal" id="frmW54F2320">
        <div class="row">
            <div class="col-md-6 pdt10">
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                    </div>
                    <div class="col-md-10">
                       <select id="cbDivisionW54F2320" name="cbDivisionW54F2320" class="form-control selectpicker required" multiple data-actions-box="true"  data-live-search="true"  required>
                           @foreach($divisions as $rowDivision)
                               <option title="{{$rowDivision["DivisionID"]}}" value="{{$rowDivision["DivisionID"]}}">{{$rowDivision["DivisionName"]}}</option>
                           @endforeach
                       </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pdt10">
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Du_an")}}</label>
                    </div>
                    <div class="col-md-10">
                        <select id="cbProjectW54F2320" name="cbProjectW54F2320" class="form-control selectpicker required" multiple data-actions-box="true" data-live-search="true"  required>
                           @foreach($projects as $rowProject)
                               <option title="{{$rowProject["ProjectID"]}}" value="{{$rowProject["ProjectID"]}}">{{$rowProject["ProjectName"]}}</option>
                           @endforeach
                       </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2-->
        <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                         <div class="col-md-2">
                            <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ky")}}</label>
                        </div>
                        <div class="col-md-5">
                           <select id="cbPeriodFromW54F2320" name="cbPeriodFromW54F2320" class="form-control" required>
                               <option value=""></option>
                           </select>
                        </div>
                        <div class="col-md-5">
                           <select id="cbPeriodToW54F2320" name="cbPeriodToW54F2320" class="form-control" required>
                               <option value=""></option>
                           </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <button type="button" id="btnFilterW54F2320" class="btn btn-default smallbtn pull-right mgr15"><span class="digi digi-filter"></span>
                            &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                        <input type="submit" id="hdFilterW54F2320" class="hide">
                    </div>
                </div>
        </div>
    </form>
    <div>
        <div id="gridW54F2320"></div>
    </div>
</section>
<script>
        //Initialize Select2 Elements
        //$("#cbDivisionW54F2320").selectpicker();
        //$("#cbProjectW54F2320").selectpicker();
        //Chặn chỉ cho chọn 1 trong 2 (% hay Đơn vị)
        $('#frmW54F2320').find('#cbDivisionW54F2320').on('changed.bs.select', function (e) {
            var div = $(this).val();
            console.log(div);
            if (div != null && div.length == 1 && div[0] == '%') {
                $('#frmW54F2320').find('#cbDivisionW54F2320').selectpicker('deselectAll');
                $('#frmW54F2320').find('#cbDivisionW54F2320').selectpicker('val', '%');
                $('#frmW54F2320').find('#cbDivisionW54F2320').find('[value!="%"]').prop('disabled', 'disabled');
                $('#frmW54F2320').find('#cbDivisionW54F2320').selectpicker('refresh');
            } else {
                $('#frmW54F2320').find('#cbDivisionW54F2320').find('[value="%"]').prop('selected', false);
                $('#frmW54F2320').find('#cbDivisionW54F2320').find('[value!="%"]').prop('disabled', '');
                $('#frmW54F2320').find('#cbDivisionW54F2320').selectpicker('refresh');
            }
            $.ajax({
               method: "GET",
               url: '{{url("/W54F2320/D54F2320/6/project")}}',
               data:"divisionID=" +  div,
               success: function (data) {
                    $("#cbProjectW54F2320").html(data);
                     $("#cbProjectW54F2320").selectpicker();
                   $('#frmW54F2320').find('#cbProjectW54F2320').selectpicker('refresh');
               }
           });
           changePeriod(div);
        });

        $('#frmW54F2320').find('#cbProjectW54F2320').on('changed.bs.select', function (e) {
            var div = $(this).val();
            console.log(div);
            if (div != null && div.length == 1 && div[0] == '%') {
                $('#frmW54F2320').find('#cbProjectW54F2320').selectpicker('deselectAll');
                $('#frmW54F2320').find('#cbProjectW54F2320').selectpicker('val', '%');
                $('#frmW54F2320').find('#cbProjectW54F2320').find('[value!="%"]').prop('disabled', 'disabled');
                $('#frmW54F2320').find('#cbProjectW54F2320').selectpicker('refresh');
            } else {
                $('#frmW54F2320').find('#cbProjectW54F2320').find('[value="%"]').prop('selected', false);
                $('#frmW54F2320').find('#cbProjectW54F2320').find('[value!="%"]').prop('disabled', '');
                $('#frmW54F2320').find('#cbProjectW54F2320').selectpicker('refresh');
            }
        });
        var period = {{json_encode($periods)}};

        function changePeriod(divisionString){
             var rows = $.grep(period, function (data) {
                  return divisionString.contains(data["DivisionID"]);
              });
              var options = '<option value=""></option>';
              for (var i=0;i<rows.length;i++){
                    options += '<option divisionid="'+rows[i].DivisionID+'" value="'+rows[i].Period+'">'+rows[i].Period+'</option>'
              }
              $("#cbPeriodFromW54F2320").html(options);
              $("#cbPeriodToW54F2320").html(options);
        }

        var obj = {
            width: '100%',
            height: $("#divD54F2320_W54F2320_W54F2320").height() - 120,
            editable: false,
            showTitle : false,
            //freezeCols: 1,
            selectionModel:{type: 'row'},
            minWidth: 30,
            pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: true},
            //showTitle: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            wrap: false,
            hwrap: false,
            collapsible: false,
            //postRenderInterval: -1,
            colModel: [
                {
                    title: "{{Helpers::getRS($g,"Don_vi")}}",
                    minWidth: 110,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "DivisionID",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                 {
                    title: "{{Helpers::getRS($g,"Ten_don_vi")}}",
                    minWidth: 230,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "DivisionName",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Du_an")}}",
                    minWidth: 110,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "ProjectID",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_du_an")}}",
                    minWidth: 140,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "ProjectName",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_bao_cao")}}",
                    minWidth: 140,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "ReportNo",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}

                },
                {
                    title: "{{Helpers::getRS($g,"Ky_bao_cao_tu")}}",
                    minWidth: 110,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "ReportPeriodFrom",
                    align: "center",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ky_bao_cao_den")}}",
                    minWidth: 110,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "ReportPeriodTo",
                    align: "center",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "View Online",
                    minWidth: 170,
                    width: 30,
                    maxWidth: 110,
                    dataType: "string",
                    editor: false,
                    align: "center",
                    //dataIndx: "attachments",
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        console.log(rowData);
                        if (rowData.AttachmentID != "" && rowData.FileName != null) {
                            var array = rowData.AttachmentID.split(';');
                            var array_name = rowData.FileName.split(';');
                            var array_fileExt = rowData.FileExt.split(';');
                            var str = "";
                            for (var i = 0; i < array_name.length; i++) {
                                if (array[i] != ""  && (array_fileExt[i] == "xlsx" ||  array_fileExt[i] == "xls")) {
                                    str += '<a title="'+array_name[i]+'" onclick="readZipFile(\''+rowData.TableName+'\',\''+encryptData(array[i])+'\')"><span class="text-primary ' + iconFile(array_name[i]) + '"></span></a>&nbsp;';
                                }
                            }
                            return str;
                        }
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Dinh_kem")}}",
                    minWidth: 170,
                    width: 30,
                    maxWidth: 110,
                    dataType: "string",
                    editor: false,
                    align: "center",
                    //dataIndx: "attachments",
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        if (rowData.AttachmentID != "" && rowData.FileName != null) {
                            var array = rowData.AttachmentID.split(';');
                            var array_name = rowData.FileName.split(';');
                            var str = "";
                            for (var i = 0; i < array_name.length; i++) {
                                if (array[i] != "") {
                                    str += '<a title="' + array_name[i] + '"   href="{{url("attachment/D54/$g/")}}/'+rowData.TableName+'/'+ encryptData(array[i])+'"><span class="text-primary ' + iconFile(array_name[i]) + '"></span></a>&nbsp;';
                                }
                            }
                            return str;
                        }
                    }
                }
            ],
            dataModel: {
                data: []
            }
        };
        var $gridW54F2320 = $("#gridW54F2320").pqGrid(obj);
        $gridW54F2320.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW54F2320.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW54F2320.pqGrid("refreshDataAndView");

        function readZipFile(tableName,id){
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "GET",
                url: '{{url("unzip/D54/$g")}}'+'/'+tableName+'/'+id,
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    switch (data){
                        case 'UNICODE':
                            alert_error("{{Helpers::getRS($g, "Vui_long_dinh_kem_lai_tap_tin_voi_ten_khong_dau")}}");
                            break;
                        case 'NOCONTENT':
                            alert_error("{{Helpers::getRS($g, "Tap_tin_nay_chua_co_noi_dung_xem_truc_tuyen")}}");
                            break;
                        case 'ERROR':
                            alert_error("{{Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_tap_tin")}}");
                            break;
                        default:
                            window.open((data) );
                            break;
                    }
                }
            });
        }
				
        function filterW54F2320(){
            $.ajax({
                method: "POST",
                url: '{{url("/W54F2320/D54F2320/6/filter")}}',
                data: $("#frmW54F2320").serialize() + "&divisionIDs="+$('#frmW54F2320').find('#cbDivisionW54F2320').val()+"&projectIDs="+$('#frmW54F2320').find('#cbProjectW54F2320').val(),
                success: function (data) {
                    $("#gridW54F2320").pqGrid("option", "dataModel.data", []);
                    $("#gridW54F2320").pqGrid("option", "dataModel.data", data);
                    $("#gridW54F2320").pqGrid("refreshDataAndView");
                }
            });
        }

        $("#secW54F2320").on('submit', '#frmW54F2320', function (e) {
            e.preventDefault();
            filterW54F2320();
        });

        $("#cbDivisionW54F2320").selectpicker();
        $("#cbProjectW54F2320").selectpicker();

        $("#btnFilterW54F2320").click(function(e){
           $("#frmW54F2320").find('#hdFilterW54F2320').click();
        });



    </script>
    <style>
        #frmW54F2320 .inner{
            max-height: 200px !important;
        }
    </style>

<!-- Modal -->
<div id="viewExcelModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



