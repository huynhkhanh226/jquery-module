<div class="modal fade" id="modalW09F2022" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F2022,"W09F2022",true,"")}}
            </div>

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW09F2022">
                    <div class="row form-group">
                        <div class="col-md-2 liketext">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Khoi")}}</label>
                        </div>
                        <div class="col-md-4 liketext">
                            <select class="form-control"
                                    id="cboBlockIDW09F2022" name="cboBlockIDW09F2022"
                                    placeholder="">
                                @foreach($blocks as $rowBlock)
                                    <option value="{{$rowBlock['BlockID']}}">{{$rowBlock['BlockName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label class="liketext lbl-normal">{{Helpers::getRS(4,"Phong_ban")}}</label>
                        </div>
                        <div class="col-sm-4">
                            <select id="cboDepartmentW09F2022" name="cboDepartmentW09F2022" class="form-control select2 required" style="width: 100%"  tabindex="11" >
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-2">
                            <div class="liketext">
                                <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ngay_nghi_viec")}}</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div id="divDateFromW25F2080" class="input-group date">
                                <input type="text" class="form-control noUseValidHTML5" id="txtDateFromW09F2022"
                                       name="txtDateFromW09F2022" value="{{date('01/m/Y')}}" required><span
                                        class="input-group-addon"><i id="iconDateFrom" onclick="$('#txtDateFromW09F2022').datepicker('show');"
                                                                     class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div id="divDateToW25F2080" class="input-group date">
                                <input type="text" class="form-control noUseValidHTML5" id="txtDateToW09F2022"
                                       name="txtDateToW09F2022" value="{{date('t/m/Y')}}" required><span
                                        class="input-group-addon"><i  onclick="$('#txtDateToW09F2022').datepicker('show');"
                                                                      class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="lbl-normal">{{Helpers::getRS($g,'To_nhom')}}</label>
                        </div>
                        <div class="col-md-4">
                            <select id="cboTeamIDW09F2022" name="cboTeamIDW09F2022" class="col-md-12 form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="btnFilterW09F2022" class="btn btn-default smallbtn pull-right"><span class="digi digi-filter text-blue"></span>
                                &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                        </div>
                    </div>
                    <button type="submit" id="hdBtnSubmitW09F2022" class="hidden"></button>
                </form>
                <div class="row mgt10">
                    <div class="col-md-12">
                        <div id="divW09F2022"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkIsSelectedW09F2022" name="chkIsSelectedW09F2022" > {{Helpers::getRS($g,"Chi_hien_thi_du_lieu_da_chon")}}
                            </label>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="checkbox">
                            <button type="button" id="btnSaveW09F2022" {{$perD09F2022 <2 ? "disabled":""}}
                                    class="btn btn-default smallbtn pull-right   "
                                    title="{{Helpers::getRS($g,"Luu")}}"
                            ><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>

                            <button type="button" id="btnSendmailW09F2022"
                                    class="btn btn-default smallbtn pull-right mgr5 "
                                    title="{{Helpers::getRS($g,"Gui_mail")}}"
                            ><span
                                        class="fa fa-envelope-o mgr5 text-primary"></span> {{Helpers::getRS($g,"Gui_mail")}}
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


    $(document).ready(function (e) {
        setTimeout(function () {
            //$gridW09F2022.pqGrid("refreshDataAndView");
            $("#cboBlockIDW09F2022").val("%").trigger("change");
        }, 300)
        $("#cboBlockIDW09F2022").change(function(){
            var blockID = $(this).val();
            $.ajax({
                method: "POST",
                data: {blockID: blockID},
                url: '{{url("/W09F2022/$pForm/$g/loaddepartment")}}',
                async: true,
                success: function (data) {
                    $("#cboDepartmentW09F2022").html(data);
                    $("#cboDepartmentW09F2022").trigger("change");
                }
            });
        });

        $("#cboDepartmentW09F2022").change(function(){
            var blockID = $("#cboBlockIDW09F2022").val();
            var departmentID = $(this).val();
            $.ajax({
                method: "POST",
                data: {blockID: blockID, departmentID: departmentID},
                url: '{{url("/W09F2022/$pForm/$g/loadteam")}}',
                async: true,
                success: function (data) {
                    $("#cboTeamIDW09F2022").html(data);
                    //$("#btnFilterW09F2022").click()
                }
            });
        });
        setTimeout(function () {
            //$gridW09F2022.pqGrid("refreshDataAndView");
            $("#btnFilterW09F2022").click()
        }, 300)

        $('#txtDateFromW09F2022').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateToW09F2022').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });





    });

    $("#btnFilterW09F2022").click(function(){
        var txtDateFromW09F2022 = $("#txtDateFromW09F2022");
        var txtDateToW09F2022 = $("#txtDateToW09F2022");

        txtDateFromW09F2022.get(0).setCustomValidity("");
        txtDateToW09F2022.get(0).setCustomValidity("");


        if (txtDateFromW09F2022.val() == "") {
            txtDateFromW09F2022.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_ngay_tu")}}");
            $("#frmW09F2022").find("#hdBtnSubmitW09F2022").click();
            return false;
        }

        if (txtDateToW09F2022.val() == "") {
            txtDateToW09F2022.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_ngay_tu")}}");
            $("#frmW09F2022").find("#hdBtnSubmitW09F2022").click();
            return false;
        }

        $("#frmW09F2022").find('#hdBtnSubmitW09F2022').click();
    });

    $("#frmW09F2022").on('submit', function (e) {
        e.preventDefault();
        loadDataW09F2022();
    })
    function loadDataW09F2022() {
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2022/$pForm/$g/filter")}}',
            data: $("#frmW09F2022").serialize(),
            success: function (data) {
                $("#divW09F2022").html(data);
            }
        });
    }

    $("#btnSaveW09F2022").click(function(){
        ask_save(function(){
            saveData();
        });
    });

    function saveData() {

        //var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        var $grid = $("#gridW09F2022")
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
        var obj = $grid.pqGrid("option", "dataModel.data");
        var senderObj = $.grep(obj, function(data){
            return data["IsUsed"] == 1;
        });

        console.log(senderObj);
        if (senderObj.length > 0){
            $.ajax({
                method: "POST",
                url: '{{url("/W09F2022/$pForm/$g/save")}}',
                data: {
                    data: senderObj
                },
                success: function (data) {
                    var rs = JSON.parse(data);
                    console.log(rs);
                    switch (rs.status) {
                        case "SUCC": //Gửi mail ngầm BACKGROUND
                            save_ok(function () {
                                callbackAfterSaveW09F2022();
                            });
                            break;

                        case "ERROR": //Lỗi khi run SQL
                            save_not_ok(function(){
                                console.log(rs.message);
                            });
                            //alert_error(rs.message);
                            break;
                    }
                }
            });
        }else{
            alert_warning("{{Helpers::getRS($g,"Ban_chua_chon_du_lieu_tren_luoi")}}")
        }

    }

    function callbackAfterSaveW09F2022(){
        loadDataW09F2022();


    }
    $("#chkIsSelectedW09F2022").click(function(){
        console.log(this);
        if ($(this).is(":checked")){
            $("#gridW09F2022").pqGrid( "filter", {
                oper: 'replace',
                data: [
                    { dataIndx: 'IsUsed', condition: 'equal', value: 1 }
                ]
            });
        }else{
            $("#gridW09F2022").pqGrid( "reset", { filter: true } );
        }
    });

    $("#btnSendmailW09F2022").click(function(){
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2022/$pForm/$g/getmail")}}',
            success: function (layout) {
                showEmailPopup(layout,{});
            }
        });
    });


</script>