<div class="modal fade" id="modalW09F1005" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" style="height: 100%">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F1005,"W09F1005",true,"closePopupW09F1005")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW09F1005">
                    <div class="row form-group">
                        <div class = "col-md-2 col-xs-2">
                            <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ma_don_vi")}}</label>
                        </div>
                        <div class = "col-md-10 col-xs-10">
                            <div class = "row">
                                <div class = "col-md-9 col-xs-9">
                                    <input style="border-radius: 4px !important; text-transform: uppercase;" type="text" class="form-control" id="txtOrgChartIDW09F1005" name="txtOrgChartIDW09F1005" required>
                                </div>
                                <div class = "col-md-3 col-xs-3">
                                    <div class="checkbox pull-right">
                                        <label>
                                            <input type="checkbox" id="chkDisabledW09F1005"
                                                   name="chkDisabledW09F1005"> {{Helpers::getRS($g,"Khong_su_dung")}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class = "col-md-2 col-xs-2">
                            <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ten_don_vi")}}</label>
                        </div>
                        <div class = "col-md-10 col-xs-10">
                            <div class = "row">
                                <div class = "col-md-12 col-xs-12">
                                    <input style="border-radius: 4px !important;" type="text" class="form-control" id="txtOrgChartNameW09F1005" name="txtOrgChartNameW09F1005" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class = "col-md-2 col-xs-2">
                            <label class="lbl-normal liketext">{{Helpers::getRS($g,"Thuoc_don_vi")}}</label>
                        </div>
                        <div class = "col-md-10 col-xs-10">
                            <div class = "row">
                                <div class = "col-md-12 col-xs-12">
                                    <div id="slOrgChartParentIDW09F1005" style="height: 26px" class = "required"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class = "col-md-2 col-xs-2">
                            <label class="lbl-normal liketext">{{Helpers::getRS($g,"Dia_chi")}}</label>
                        </div>
                        <div class = "col-md-10 col-xs-10">
                            <div class = "row">
                                <div class = "col-md-12 col-xs-12">
                                    <input style="border-radius: 4px !important;" type="text" class="form-control" id="txtOrgAddressW09F1005" name="txtOrgAddressW09F1005">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class = "col-md-2 col-xs-2">
                            <label class="lbl-normal liketext">{{Helpers::getRS($g,"Cap_to_chuc")}}</label>
                        </div>
                        <div class = "col-md-10 col-xs-10">
                            <div class = "row">
                                <div class = "col-md-12 col-xs-12">
                                    <div class = "input-group">
                                        <select style="border-radius: 4px !important;" id="slOrgLevelIDW09F1005" name="slOrgLevelIDW09F1005"
                                                class="form-control" required>
                                            <option value=""></option>
                                            @foreach($rsOrgLevelID as $row)
                                                <option value="{{$row['OrgLevelID']}}" >{{$row['OrgLevelName']}}</option>
                                            @endforeach
                                        </select>
                                        <span style="border-radius: 4px !important;" id = "btnShowFormW1001" class="input-group-addon"><i class="fa fa-ellipsis-v "></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($actionFromW09F1010 == "add" || $actionFromW09F1010 == "edit")
                    <div class = "row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div class="pull-right">
                                <button type="button" id="btnSaveW09F1005" name="btnSaveW09F1005"
                                        onclick="ask_save(function(){saveData('viewAfterSave')})"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                                <button type="button" id="btnNextW09F1005" name="btnNextW09F1005"
                                        onclick="setFormW09F1005('add')"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-arrow-right mgr5 text-blue"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                </button>
                                <button type="button" id="btnSaveNextW09F1005" name="btnSaveNextW09F1005"
                                        onclick="ask_save(function(){saveData('add')})"
                                            class="btn btn-default smallbtn"><span
                                                class="fa fa-arrow-right text-green mgr5"></span> {{Helpers::getRS($g,"Luu&nhap_tiep")}}
                                </button>
                                <button type="button" id="btnSaveCloseW09F1005" name="btnSaveCloseW09F1005"
                                        onclick="ask_save(function(){saveData('close')})"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-ban text-red"></span> {{Helpers::getRS($g,"Luu&dong")}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="hdBtnSaveW09F1005" class="hidden"></button>
                    @endif
                </form>

            </div>
        </div>
    </div>
</div>

<div id="popupinfo">
    <p>
        <p><i class = "fa fa-warning mgr5 text-orange"></i>Mã không được chứa ký tự đặc biệt</p>
    </p>
</div>

<style>
    .popover {
        width: 260px !important;
        font-family: Source Sans pro,Arial, Helvetica Neue, sans-serif !important;
    }

    .popover-content {
        padding: 0px 14px !important;
    }

    .fade.in {
        opacity: 10 !important;
    }
</style>

<script type="text/javascript">
    var action = "{{$actionFromW09F1010}}";//biến action nhận thừ màn hình W09F1010
    var rowDataFromW09F1010 = {{json_encode($rowDataFromW09F1010)}}; //Dữ liệu dòng lấy từ màn hình W09F1010 trong trường hợp edit và view
    var modeFromW09F1010 = "{{$modeFromW09F1010}}";

    var dataCombo = {{json_encode($rsOrgChartParentID)}};
    console.log(dataCombo);

    $('#slOrgChartParentIDW09F1005').dxDropDownBox()
        .dxDropDownBoxTreeLoad({
            sValueMember: "OrgChartID",
            sDisplayMember: "OrgName",
            dataSource: dataCombo
        })
        .dxDropDownBoxTreeTemplateSingleSelect("OrgChartParentID");

    $('#txtOrgChartIDW09F1005').popover({
        placement: "bottom",
        trigger: "manual",
        html: true,
        //width: 1500,
        content: function() {
            return $('#popupinfo').html();
        }
    });

    $('#txtOrgChartIDW09F1005').keyup(function () {//kiểm tra nhập ký tự đặc biệt
        var txtOrgChartIDW09F1005 = $('#txtOrgChartIDW09F1005').val();
        if(txtOrgChartIDW09F1005.search(/[!@#$%^&*<>_+|.'";,{}*?()]/g) != -1){//tồn tại ký tự đặc biệt
            var newText = txtOrgChartIDW09F1005.replace(/[!@#$%^&*<>_+|.'";,{}*?()]/g, "");//replace ký tự đặc biệt bằng khoản trắng
            $('#txtOrgChartIDW09F1005').popover('show');
            $('#txtOrgChartIDW09F1005').val(newText);//gắn chuỗi mới vào input
        }else{
            setTimeout(function () {//không tồn tại ký tự đặc biệt
                $('#txtOrgChartIDW09F1005').popover('hide');//ẩn popover
            },3000);
        }
    });

    $(document).ready(function () {
        console.log(rowDataFromW09F1010);
        setFormW09F1005(action, rowDataFromW09F1010);//set gia tri form dua vao action
        if(action == "add"){// truong hop them moi gan OrgChartID vao combo thuoc don vi
            $("#slOrgChartParentIDW09F1005").val(rowDataFromW09F1010['OrgChartID']);
        }

    });

    $('#btnShowFormW1001').click(function () {//chỉ cho click nút gọi màn hình W09F1001 lúc thêm mới và edit
        if(action == "view" || (action == "add" && rowDataFromW09F1010 != [] && Number(rowDataFromW09F1010['MinChild']) == 0)
            || (action == "edit" && rowDataFromW09F1010 != [] && Number(rowDataFromW09F1010['MinChild']) == 0)
        ){
            //e.preventDefault();
            return;
        }
        showFormDialogPost('{{url("/W09F1001/$pForm/$g")}}', "modalW09F1001",
            {

            },null);
    });

    $("#slOrgChartParentIDW09F1005").dxDropDownBox("instance")
        .on('valueChanged', function (e) {
            var value = "";
            if(e.value != null){
                value = e.value[0];
            }
            //console.log(value);
            reloadComboOrgLevelW091005('');
        });

    function saveData(actionAfterSave) {
        //alert("da chay vao save");
        var txtOrgChartIDW09F1005 = $("#txtOrgChartIDW09F1005");
        var txtOrgChartNameW09F1005 = $("#txtOrgChartNameW09F1005");
        var slOrgChartParentIDW09F1005 = $('#slOrgChartParentIDW09F1005').find('.dx-texteditor-input');
        var slOrgLevelIDW09F1005 = $("#slOrgLevelIDW09F1005");

        txtOrgChartIDW09F1005.get(0).setCustomValidity("");
        txtOrgChartNameW09F1005.get(0).setCustomValidity("");
        slOrgChartParentIDW09F1005.get(0).setCustomValidity("");
        slOrgLevelIDW09F1005.get(0).setCustomValidity("");

        if (txtOrgChartIDW09F1005.val() == "") {
            txtOrgChartIDW09F1005.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ma_don_vi')}}");
            $("#frmW09F1005").find('#hdBtnSaveW09F1005').click();
            txtOrgChartIDW09F1005.focus();
            return false;
        }

        if (txtOrgChartNameW09F1005.val() == "") {
            txtOrgChartNameW09F1005.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ten_don_vi')}}");
            $("#frmW09F1005").find('#hdBtnSaveW09F1005').click();
            txtOrgChartNameW09F1005.focus();
            return false;
        }

        if (slOrgChartParentIDW09F1005.val() == "") {
            slOrgChartParentIDW09F1005.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Thuoc_don_vi')}}");
            //$("#frmW09F1005").find('#hdBtnSaveW09F1005').click();
            //slOrgChartParentIDW09F1005.focus();
            alert_warning("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Thuoc_don_vi')}}",function () {
                $("#slOrgChartParentIDW09F1005").dxDropDownBox('instance').open();
            });
            return false;

        }

        if (slOrgLevelIDW09F1005.val() == "") {
            slOrgLevelIDW09F1005.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Cap_to_chuc')}}");
            $("#frmW09F1005").find('#hdBtnSaveW09F1005').click();
            slOrgLevelIDW09F1005.focus();
            return false;
        }

        var chkDisabledW09F1005 = 0;
        //console.log($("#chkDisabledW09F1005").is(':checked'));
        if($("#chkDisabledW09F1005").is(':checked')){//kiem tra checkbok disble// check = 1; uncheck = 0;
            chkDisabledW09F1005 = 1;
        }else{
            chkDisabledW09F1005 = 0;
        }

        //console.log($('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeGetValue());
        $.ajax({
            method: "POST",
            url: '{{url("/W09F1005/$pForm/$g/save")}}',
            data: {
                txtOrgChartIDW09F1005: $("#txtOrgChartIDW09F1005").val(),
                txtOrgChartNameW09F1005: $("#txtOrgChartNameW09F1005").val(),
                slOrgChartParentIDW09F1005: $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeGetValue(),
                slOrgLevelIDW09F1005: $("#slOrgLevelIDW09F1005").val(),
                txtOrgAddressW09F1005: $("#txtOrgAddressW09F1005").val(),
                chkDisabledW09F1005: chkDisabledW09F1005,
                task: action
            },
            success: function (data) {
                var rs = JSON.parse(data);
                console.log(rs);
                switch (rs.status){
                    case "SUCCESS":
                        //console.log(rowDataFromW09F1010);
                        save_ok(function () {
                            setFormW09F1005(actionAfterSave, rowDataFromW09F1010);//set lại trạng thái form sau khi save
                        });
                        break;
                    case "ERROR":
                        save_not_ok();
                        break;
                    default:
                        //trường hợp kết quả của câu kiểm tra trước khi lưu có status = 1
                        if(Number(rs.msgAsk) == 0){
                            alert_warning(rs.status);
                        }
                        if(Number(rs.msgAsk) == 1){
                            alert_confirm(confirmSave, '', rs.status);
                        }
                        break;
                }
            }
        });
    }

    //hàm save sau khi đã kiểm tra trường hợp status = 1
    function saveConfirmed() {
        console.log("da chay");
        $.ajax({
            method: "POST",
            url: '{{url("/W09F1005/$pForm/$g/saveConfirm")}}',
            data: {
                actionSave: action
            },
            success: function (data) {
                if(data == "SUCCESS"){
                    save_ok(function () {
                        setFormW09F1005(actionAfterSave, rowDataFromW09F1010);//set lại trạng thái form sau khi save
                    });
                }
                if(data == "FAILED"){
                    save_not_ok();
                }
            }
        });
    }
    
    function setFormW09F1005(mode, arr) {//hàm set ẩn hiện các control trên form
        console.log(arr);
        switch (mode){
            case "view"://trạng thái view
                $("#txtOrgChartIDW09F1005").prop('disabled', true).val(arr['OrgChartID']);
                $("#txtOrgChartNameW09F1005").prop('disabled', true).val(arr['OrgName']);
                //xử lý dropdown
                $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeDisable(true);//disable
                $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeSelectValue(arr['OrgChartParentID']);//gán giá trị
                $("#slOrgLevelIDW09F1005").prop('disabled', true).val(arr['OrgLevelID']);
                $("#txtOrgAddressW09F1005").prop('disabled', true).val(arr['OrgAddress']);
                $("#chkDisabledW09F1005").prop('disabled', true).attr('checked', Number(arr['Disabled']) ==0?false:true);

                $("#btnSaveW09F1005").prop('disabled', true);
                $("#btnNextW09F1005").prop('disabled', true);
                $("#btnSaveNextW09F1005").prop('disabled', true);
                $("#btnSaveCloseW09F1005").prop('disabled', true);
            break;
            case "add"://trạng thái thêm mới
                $("#txtOrgChartIDW09F1005").prop('disabled', false).val('');
                $("#txtOrgChartNameW09F1005").prop('disabled', false).val('');
//                //xử lý dropdown
//                if(Number(rowDataFromW09F1010['MinChild']) == 0 && rowDataFromW09F1010 != []) {
//                    $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeDisable(true);//disable
//                    $("#slOrgLevelIDW09F1005").prop('disabled', true).val('');
//                }else{
//                    $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeDisable(false);//disable
//                    $("#slOrgLevelIDW09F1005").prop('disabled', false).val('');
//                }
                $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeDisable(false);//disable
                $("#slOrgLevelIDW09F1005").prop('disabled', false).val('');
                $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeSelectValue(rowDataFromW09F1010['OrgChartID']);//gán giá trị
                $("#txtOrgAddressW09F1005").prop('disabled', false).val('');
                $("#chkDisabledW09F1005").prop('disabled', false).val('');

                $("#btnSaveW09F1005").prop('disabled', false);
                $("#btnNextW09F1005").prop('disabled', true);
                $("#btnSaveNextW09F1005").prop('disabled', false);
                $("#btnSaveCloseW09F1005").prop('disabled', false);
                action = 'add';
            break;

            case "edit"://trạng thái edit
                $("#txtOrgChartIDW09F1005").prop('disabled', true).val(arr['OrgChartID']);
                $("#txtOrgChartNameW09F1005").prop('disabled', false).val(arr['OrgName']);
                //xử lý dropdown
                if(Number(rowDataFromW09F1010['MinChild']) == 0 && rowDataFromW09F1010 != []) {
                    $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeDisable(true);//disable
                    $("#slOrgLevelIDW09F1005").prop('disabled', true).val(arr['OrgLevelID']);
                }else{
                    $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeDisable(false);//disable
                    $("#slOrgLevelIDW09F1005").prop('disabled', false).val(arr['OrgLevelID']);
                }
                $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeSelectValue(arr['OrgChartParentID']);//gán giá trị
                $("#txtOrgAddressW09F1005").prop('disabled', false).val(arr['OrgAddress']);
                $("#chkDisabledW09F1005").prop('disabled', false).attr('checked', Number(arr['Disabled']) ==0?false:true);

                $("#btnSaveW09F1005").prop('disabled', false);
                $("#btnNextW09F1005").prop('disabled', true);
                $("#btnSaveNextW09F1005").prop('disabled', false);
                $("#btnSaveCloseW09F1005").prop('disabled', false);
            break;

            case "viewAfterSave"://view sau khi save
                $("#txtOrgChartIDW09F1005").prop('disabled', true);
                $("#txtOrgChartNameW09F1005").prop('disabled', true);
                $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeDisable(true);//disable
                $("#slOrgLevelIDW09F1005").prop('disabled', true);
                $("#txtOrgAddressW09F1005").prop('disabled', true);
                $("#chkDisabledW09F1005").prop('disabled', true);

                $("#btnSaveW09F1005").prop('disabled', true);
                $("#btnNextW09F1005").prop('disabled', false);
                $("#btnSaveNextW09F1005").prop('disabled', true);
                $("#btnSaveCloseW09F1005").prop('disabled', true);
                break;

            case "close"://trạng thái sau khi lưu và đóng
                $("#modalW09F1005").modal('hide');
                reloadGridW09F1010();
                break;
        }
    }
    
    function closePopupW09F1005() {
        $("#modalW09F1005").modal('hide');
        reloadGridW09F1010();
    }
    
    function reloadComboOrgLevelW091005(OrgLevelID) {
        console.log(OrgLevelID);
        $.ajax({
            method: "POST",
            url: '{{url("/W09F1005/$pForm/$g/reloadComboOrgLevel")}}',
            data: {OrgChartParentID: $('#slOrgChartParentIDW09F1005').dxDropDownBoxTreeGetValue(),
                mode: modeFromW09F1010,
                OrgChartID: $('#txtOrgChartIDW09F1005').val().toUpperCase()},
            success: function (data) {
                $('#slOrgLevelIDW09F1005').html(data);//đổ lại combo
                $('#slOrgLevelIDW09F1005').val(OrgLevelID);//gán giá trị combo từ màn hình W09F1001
            }
        });
    }
</script>