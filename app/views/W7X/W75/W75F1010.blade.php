<div class="modal draggable fade modal" id="modalW75F1010" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 1250px">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW75F1010" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,"Dieu_chinh_ho_so_nhan_vien"),"W75F1010")}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- column -->
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="col-md-2 col-xs-3">
                                        <label>{{Helpers::getRS($g,"Thong_tin")}}</label>
                                    </div>
                                    <div class="col-md-8 col-xs-7">
                                        <select class="form-control text-blue" id="slPropertyID" name="slPropertyID" disabled>
                                            @foreach($connectionHR->select("EXEC W75P1010 '".Session::get('Lang')."', '".$employeeid."'") as $row)
                                                <option value="{{$row['PropertyID']}}"
                                                        prevalue="{{$row['Value']}}">{{$row['PropertyName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2 col-xs-3">
                                        <label>{{Helpers::getRS($g,"Gia_tri_hien_tai")}}</label>
                                    </div>
                                    <div class="col-md-10 col-xs-9">
                                        <input class="form-control" type="text" id="txtW75F1010_CurVal" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2 col-xs-3">
                                        <label>{{Helpers::getRS($g,"Gia_tri_de_xuat")}}</label>
                                    </div>
                                    <div class="col-md-10 col-xs-9">
                                        @if($pro != 'NUMIDPLACE')
                                            <input class="form-control " type="text" id="txtW75F1010_Val" value=""
                                                   name="txtW75F1010_Val"
                                                   @if($pro == "PERADDR" || $pro == "PROADDR" || $pro == "EMCONADD1" || $pro == "EMCONADD2" || $pro == "CONADDR")disabled @endif
                                                   required/>
                                        @endif
                                        @if($pro == 'NUMIDPLACE')
                                                <select class="form-control text-blue" id="txtW75F1010_Val" name="txtW75F1010_Val" required>
                                                    <option value=""></option>
                                                    @foreach($cbNumIDPlace as $row)
                                                        <option value="{{$row['ProvinceID']}}">{{$row['PropertyName']}}</option>
                                                    @endforeach
                                                </select>
                                        @endif
                                    </div>
                                </div>

                                @if($pro == "PERADDR" || $pro == "PROADDR" || $pro == "EMCONADD1" || $pro == "EMCONADD2" || $pro == "CONADDR")
                                    <div class="form-group">
                                        <div class="col-md-4 col-xs-4">
                                            <div class = "row">
                                                <div class="col-md-5 col-xs-5">
                                                    <select class="form-control text-blue" id="slLabelProvinceW75F1010" name="slLabelProvinceW75F1010" required>
                                                        <option value=""></option>
                                                        @foreach($cbLabelProvince as $row)
                                                            <option LabelProvince = "{{$row['Name']}}" value="{{$row['Code']}}">{{$row['Name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <select class="form-control text-blue" id="slProvinceIDW75F1010" name="slProvinceIDW75F1010" required>
                                                        <option value=""></option>
                                                        @foreach($rsProvince as $row)
                                                            <option ProvinceName = "{{$row['Name']}}" value="{{$row['Code']}}">{{$row['Name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-3">
                                            <div class = "row">
                                                <div class="col-md-5 col-xs-5">
                                                    <select class="form-control text-blue" id="slLabelDistrictW75F1010" name="slLabelDistrictW75F1010" required>
                                                        <option value=""></option>
                                                        @foreach($cbLabelDistrict as $row)
                                                            <option LabelDistrict = "{{$row['Name']}}" value="{{$row['Code']}}">{{$row['Name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <select class="form-control text-blue" id="slDistrictIDW75F1010" name="slDistrictIDW75F1010" required>
                                                        @foreach($rsDistrict as $row)
                                                            <option DistrictName = "{{$row['Name']}}" value="{{$row['Code']}}">{{$row['Name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-3">
                                            <div class = "row">
                                                <div class="col-md-5 col-xs-5">
                                                    <select class="form-control text-blue" id="slLabelWardW75F1010" name="slLabelWardW75F1010" required>
                                                        <option value=""></option>
                                                        @foreach($cbLabelWard as $row)
                                                            <option LabelWard = "{{$row['Name']}}" value="{{$row['Code']}}">{{$row['Name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <select class="form-control text-blue" id="slWardIDW75F1010" name="slWardIDW75F1010" required>
                                                        @foreach($rsWard as $row)
                                                            <option  WardName = "{{$row['Name']}}" value="{{$row['Code']}}">{{$row['Name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-2">
                                            <input class="form-control" type="text" id="slAddressNameW75F1010" value=""
                                                   name="slAddressNameW75F1010">
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div class="col-md-2 col-xs-3">
                                        <label>{{Helpers::getRS($g,"Ghi_chu")}}</label>
                                    </div>
                                    <div class="col-md-10 col-xs-9">
                                        <input class="form-control" type="text" id="txtW75F1010_Note"
                                               name="txtW75F1010_Note">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2 col-xs-3">
                                        <button type="button" id="frm_btnAdd"
                                                class="btn btn-default smallbtn pull-left"><span
                                                    class="glyphicon glyphicon-plus mgr5"></span> {{Helpers::getRS($g,"Them_moi1")}}
                                        </button>
                                    </div>
                                    <div class="col-md-10 col-xs-9">
                                        <button type="button" id="frm_btnCancel"
                                                class="btn btn-default smallbtn pull-right confirmation-notSave"><span
                                                    class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                        </button>
                                        <button type="button" id="frm_btnSave"
                                                class="btn btn-default smallbtn pull-right mgr10 confirmation-Save"><span
                                                    class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                        </button>
                                    </div>

                                    <button type="button" id="frm_btnedit"
                                            class="btn btn-default smallbtn pull-left mgr10 disabled hide"><span
                                                class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                                    </button>
                                    <button type="submit" id="frm_hbtnSave" class="hidden" name="frm_hbtnSave"/>
                                    <input type="hidden" id="hdActionW75F1010" value="add">
                                    <input type="hidden" id="hdW75F1010_TransID" name="hdW75F1010_TransID" value="">
                                </div>
                                <fieldset>
                                    <legend class="legend">{{Helpers::getRS($g,"Lich_su")}}</legend>
                                    <div id="tbW75F1010"></div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="chkShowLock" name="chkShowLock"> {{Helpers::getRS($g,"Hien_thi_tat_ca")}}
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <!--/.col -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alert alert-success alert-dismissable hide">
                        <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_luu_thanh_cong")}}
                    </div>
                    <div class="alert alert-danger alert-dismissable hide">
                        <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}!</span>
                    </div>

                </div>
            </form>
            <!-- /.end form  -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    var bSelect = 0;
    var sIDload = "";
    var mod = 'view';
    var DistrictID = "";
    var WardID = "";
    var cbWard = {{json_encode($rsWard)}};
    $(document).ready(function () {
        console.log(cbWard);
        @if ($pro == "NUMIDDATE")
            $('#txtW75F1010_Val').datepicker({
                todayHighlight: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                language: '{{Session::get("locate")}}'
            });
        @endif

        loadTable();
        $("#slPropertyID").val("{{$pro}}");
        $("#txtW75F1010_CurVal").val($('#slPropertyID option:selected').attr('prevalue'));

        function ValidW75F1010() {
            if ($("#frmW75F1010").find("#txtW75F1010_Val").val() != "") {
                $("#frmW75F1010").find("#txtW75F1010_Val").get(0).setCustomValidity("");
            }
            else {
                $("#frmW75F1010").find("#txtW75F1010_Val").get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}");
            }
            $("#frmW75F1010").find("#frm_hbtnSave").click();
        }

        $('#slPropertyID').on('change', function () {
            $("#txtW75F1010_CurVal").val(this.options[this.selectedIndex].getAttribute('prevalue'));
            $("#txtW75F1010_Note").val("");
            $("#txtW75F1010_Val").val("");
        });

        $('#slLabelProvinceW75F1010').on('change', function () {
            //alert($('#slProvinceIDW75F1010').val());
           /* var LabelProvince = $('#slLabelProvinceW75F1010 option:selected').attr('LabelProvince');
            var ProvinceName =  $('#slProvinceIDW75F1010 option:selected').attr('ProvinceName');
            var LabelDistrict = $('#slLabelDistrictW75F1010 option:selected').attr('LabelDistrict');
            var DistrictName =  $('#slDistrictIDW75F1010 option:selected').attr('DistrictName');
            var LabelWard = $('#slLabelWardW75F1010 option:selected').attr('LabelWard');
            var WardName =  $('#slWardIDW75F1010 option:selected').attr('WardName');
            var AddressName =  $('#slAddressNameW75F1010').val();
            sumString(LabelProvince, ProvinceName, LabelDistrict, DistrictName, LabelWard, WardName, AddressName);*/
        });

        $('#slProvinceIDW75F1010').on('change', function () {
            //alert($('#slProvinceIDW75F1010').val());
            $.ajax({
                method: "POST",
                url: '{{url("/W75F1010/ProvinceChange")}}',
                data: "&slProvinceID=" + $('#slProvinceIDW75F1010').val(),
                success: function (data) {
                    $('#slDistrictIDW75F1010').html(data);
                    console.log(DistrictID);
                    if(DistrictID != ""){
                        $('#slDistrictIDW75F1010').val(DistrictID);
                    }
                    //DistrictID = "";
                }
            });
          /*  var LabelProvince = $('#slLabelProvinceW75F1010 option:selected').attr('LabelProvince');
            var ProvinceName =  $('#slProvinceIDW75F1010 option:selected').attr('ProvinceName');
            var LabelDistrict = $('#slLabelDistrictW75F1010 option:selected').attr('LabelDistrict');
            var DistrictName =  $('#slDistrictIDW75F1010 option:selected').attr('DistrictName');
            var LabelWard = $('#slLabelWardW75F1010 option:selected').attr('LabelWard');
            var WardName =  $('#slWardIDW75F1010 option:selected').attr('WardName');
            var AddressName =  $('#slAddressNameW75F1010').val();
            sumString(LabelProvince, ProvinceName, LabelDistrict, DistrictName, LabelWard, WardName, AddressName);*/
        });

        $('#slLabelDistrictW75F1010').on('change', function () {
            //alert($('#slProvinceIDW75F1010').val());
          /*  var LabelProvince = $('#slLabelProvinceW75F1010 option:selected').attr('LabelProvince');
            var ProvinceName =  $('#slProvinceIDW75F1010 option:selected').attr('ProvinceName');
            var LabelDistrict = $('#slLabelDistrictW75F1010 option:selected').attr('LabelDistrict');
            var DistrictName =  $('#slDistrictIDW75F1010 option:selected').attr('DistrictName');
            var LabelWard = $('#slLabelWardW75F1010 option:selected').attr('LabelWard');
            var WardName =  $('#slWardIDW75F1010 option:selected').attr('WardName');
            var AddressName =  $('#slAddressNameW75F1010').val();
            sumString(LabelProvince, ProvinceName, LabelDistrict, DistrictName, LabelWard, WardName, AddressName);*/
        });

        $('#slDistrictIDW75F1010').on('change', function () {
            //alert($('#slDistrictIDW75F1010').val());
             if($('#slDistrictIDW75F1010').val() != null){
                DistrictID = $('#slDistrictIDW75F1010').val();
            }
            $.ajax({
                method: "POST",
                url: '{{url("/W75F1010/DistrictChange")}}',
                data: "&slDistrictID=" + DistrictID,
                success: function (data) {
                    $('#slWardIDW75F1010').html(data);
                    if(WardID != ""){
                        $('#slWardIDW75F1010').val(WardID);
                        WardID = "";
                    }
                }
            });
            DistrictID = "";
           /* var LabelProvince = $('#slLabelProvinceW75F1010 option:selected').attr('LabelProvince');
            var ProvinceName =  $('#slProvinceIDW75F1010 option:selected').attr('ProvinceName');
            var LabelDistrict = $('#slLabelDistrictW75F1010 option:selected').attr('LabelDistrict');
            var DistrictName =  $('#slDistrictIDW75F1010 option:selected').attr('DistrictName');
            var LabelWard = $('#slLabelWardW75F1010 option:selected').attr('LabelWard');
            var WardName =  $('#slWardIDW75F1010 option:selected').attr('WardName');
            var AddressName =  $('#slAddressNameW75F1010').val();
            sumString(LabelProvince, ProvinceName, LabelDistrict, DistrictName, LabelWard, WardName, AddressName);*/
        });

        $('#slLabelWardW75F1010').on('change', function () {
            //alert($('#slLabelWardW75F1010 option:selected').attr('LabelWard'));
          /*  var LabelProvince = $('#slLabelProvinceW75F1010 option:selected').attr('LabelProvince');
            var ProvinceName =  $('#slProvinceIDW75F1010 option:selected').attr('ProvinceName');
            var LabelDistrict = $('#slLabelDistrictW75F1010 option:selected').attr('LabelDistrict');
            var DistrictName =  $('#slDistrictIDW75F1010 option:selected').attr('DistrictName');
            var LabelWard = $('#slLabelWardW75F1010 option:selected').attr('LabelWard');
            var WardName =  $('#slWardIDW75F1010 option:selected').attr('WardName');
            var AddressName =  $('#slAddressNameW75F1010').val();
            sumString(LabelProvince, ProvinceName, LabelDistrict, DistrictName, LabelWard, WardName, AddressName);*/
        });

        $('#slWardIDW75F1010').on('change', function () {
            //alert("da chay");
         /*   var LabelProvince = $('#slLabelProvinceW75F1010 option:selected').attr('LabelProvince');
            var ProvinceName =  $('#slProvinceIDW75F1010 option:selected').attr('ProvinceName');
            var LabelDistrict = $('#slLabelDistrictW75F1010 option:selected').attr('LabelDistrict');
            var DistrictName =  $('#slDistrictIDW75F1010 option:selected').attr('DistrictName');
            var LabelWard = $('#slLabelWardW75F1010 option:selected').attr('LabelWard');
            var WardName =  $('#slWardIDW75F1010 option:selected').attr('WardName');
            var AddressName =  $('#slAddressNameW75F1010').val();
            sumString(LabelProvince, ProvinceName, LabelDistrict, DistrictName, LabelWard, WardName, AddressName);*/
        });

        $('#slAddressNameW75F1010').on('keyup', function () {
            //alert($('#slProvinceIDW75F1010').val());
          /*  var LabelProvince = $('#slLabelProvinceW75F1010 option:selected').attr('LabelProvince');
            var ProvinceName =  $('#slProvinceIDW75F1010 option:selected').attr('ProvinceName');
            var LabelDistrict = $('#slLabelDistrictW75F1010 option:selected').attr('LabelDistrict');
            var DistrictName =  $('#slDistrictIDW75F1010 option:selected').attr('DistrictName');
            var LabelWard = $('#slLabelWardW75F1010 option:selected').attr('LabelWard');
            var WardName =  $('#slWardIDW75F1010 option:selected').attr('WardName');
            var AddressName =  $('#slAddressNameW75F1010').val();
            sumString(LabelProvince, ProvinceName, LabelDistrict, DistrictName, LabelWard, WardName, AddressName);*/
        });

        $('#slAddressNameW75F1010').on('change', function () {
            //alert($('#slProvinceIDW75F1010').val());
         /*   var LabelProvince = $('#slLabelProvinceW75F1010 option:selected').attr('LabelProvince');
            var ProvinceName =  $('#slProvinceIDW75F1010 option:selected').attr('ProvinceName');
            var LabelDistrict = $('#slLabelDistrictW75F1010 option:selected').attr('LabelDistrict');
            var DistrictName =  $('#slDistrictIDW75F1010 option:selected').attr('DistrictName');
            var LabelWard = $('#slLabelWardW75F1010 option:selected').attr('LabelWard');
            var WardName =  $('#slWardIDW75F1010 option:selected').attr('WardName');
            var AddressName =  $('#slAddressNameW75F1010').val();
            sumString(LabelProvince, ProvinceName, LabelDistrict, DistrictName, LabelWard, WardName, AddressName);*/
        });

        function sumString(LabelProvince, ProvinceID, LabelDistrict, DistrictID, LabelWard, WardID, AddressName) {
            var sum = "";
            if(LabelProvince == undefined){
                LabelProvince = "";
            }
            if(ProvinceID == undefined){
                ProvinceID = "";
            }
            if(LabelDistrict == undefined){
                LabelDistrict = "";
            }
            if(DistrictID == undefined){
                DistrictID = "";
            }
            if(LabelWard == undefined){
                LabelWard = "";
            }
            if(WardID == undefined){
                WardID = "";
            }
            if(AddressName == ""){
                sum = LabelWard + " " + WardID + ", " + LabelDistrict + " " + DistrictID + ", " + LabelProvince + " " + ProvinceID;
            }else{
                sum = AddressName + ", " + LabelWard + " " + WardID + ", " + LabelDistrict + " " + DistrictID + ", " + LabelProvince + " " + ProvinceID;
            }
            $("#txtW75F1010_Val").val(sum);
        }
        
        $('.confirmation-Save').on('click', function () {
            //console.log("da chay save");

                    @if($pro == "PERADDR" || $pro == "PROADDR" || $pro == "EMCONADD1" || $pro == "EMCONADD2" || $pro == "CONADDR")
            var LabelProvince = $('#slLabelProvinceW75F1010 option:selected').attr('LabelProvince');
            var ProvinceName =  $('#slProvinceIDW75F1010 option:selected').attr('ProvinceName');
            var LabelDistrict = $('#slLabelDistrictW75F1010 option:selected').attr('LabelDistrict');
            var DistrictName =  $('#slDistrictIDW75F1010 option:selected').attr('DistrictName');
            var LabelWard = $('#slLabelWardW75F1010 option:selected').attr('LabelWard');
            var WardName =  $('#slWardIDW75F1010 option:selected').attr('WardName');
            var AddressName =  $('#slAddressNameW75F1010').val();
            sumString(LabelProvince, ProvinceName, LabelDistrict, DistrictName, LabelWard, WardName, AddressName);
            @endif

            ask_save(ValidW75F1010);
        });

        $('.confirmation-notSave').on('click', function () {
            ask_not_save(function(){
                if ($("#pqgrid_W75F1010").pqGrid("option", "dataModel.data").length > 0) {
                    var rowData = getRowSelection($("#pqgrid_W75F1010"));
                    if (rowData.length == 0){
                        $("#pqgrid_W75F1010").pqGrid("setSelection", {rowIndx: 0});
                        rowData = getRowSelection($("#pqgrid_W75F1010"));
                    }
                    console.log(rowData);
                    $("#frmW75F1010").find("#hdW75F1010_TransID").val(rowData["TransID"]);
                    $("#frmW75F1010").find("#slPropertyID").val(rowData["PropertyID"]);
                    $("#frmW75F1010").find("#txtW75F1010_Val").val(rowData["PropertyValueU"]);
                    $("#frmW75F1010").find("#txtW75F1010_Note").val(rowData["Notes"]);
                    $("#frmW75F1010").find("#slProvinceIDW75F1010").val(rowData["ProvinceID"]);
                    $("#frmW75F1010").find("#slProvinceIDW75F1010").trigger('change');
                    DistrictID = rowData["DistrictID"];
                    $("#frmW75F1010").find("#slDistrictIDW75F1010").val(rowData["DistrictID"]);
                    $("#frmW75F1010").find("#slDistrictIDW75F1010").trigger('change');
                    WardID = rowData["WardID"];
                    $("#frmW75F1010").find("#slWardIDW75F1010").val(rowData["WardID"]);
                    $("#frmW75F1010").find("#slAddressNameW75F1010").val(rowData["AddressName"]);

                    $("#frmW75F1010").find("#slLabelProvinceW75F1010").val(rowData["LabelProvince"]);
                    $("#frmW75F1010").find("#slLabelDistrictW75F1010").val(rowData["LabelDistrict"]);
                    $("#frmW75F1010").find("#slLabelWardW75F1010").val(rowData["LabelWard"]);

                    $("#txtW75F1010_CurVal").val($('#slPropertyID option:selected').attr('prevalue'));
                    sIDload = rowData["TransID"];
                } else {
                    //$("#frmW75F1010").find("#slPropertyID").val('');
                    $("#frmW75F1010").find("#txtW75F1010_Val").val('');
                    $("#frmW75F1010").find("#txtW75F1010_Note").val('');
                    $("#frmW75F1010").find("#slProvinceIDW75F1010").val('');
                    $("#frmW75F1010").find("#slDistrictIDW75F1010").val('');
                    $("#frmW75F1010").find("#slWardIDW75F1010").val('');
                    $("#frmW75F1010").find("#slAddressNameW75F1010").val('');
                    $("#frmW75F1010").find("#slLabelProvinceW75F1010").val('');
                    $("#frmW75F1010").find("#slLabelDistrictW75F1010").val('');
                    $("#frmW75F1010").find("#slLabelWardW75F1010").val('');
                }
                mod = "view";
                NormalMode()
            });
        });

        $("#modalW75F1010").on('submit', '#frmW75F1010', function (e) {
            e.preventDefault();
            //alert("da chay submit");
            //var mode = $("#hdActionW75F1010").val();
            var callurl = '{{url("/W75F1010/add/$pro")}}';
            //alert(mod);
            if (mod == "edit")
                callurl = '{{url("/W75F1010/edit/$pro")}}';


            var slPropertyID = $("#slPropertyID").val()
             if ( slPropertyID == "NUMIDCARD"){
                 $.ajax({
                     method: "POST",
                     url: '{{url("/W75F1010/checkStore/$pro")}}',
                     data: $("#frmW75F1010").serialize() + "&slPropertyID=" + slPropertyID + "&txtW75F1010_Val=" + $("#txtW75F1010_Val").val(),
                     success: function (data) {
                         console.log(data);
                         if (data.length > 0){
                             if (data[0].Status == 0){
                                 saveData(callurl);
                             }else{
                                 alert_warning(data[0].Message);
                             }
                         }

                     }
                 });
             }else{
                 saveData(callurl);
             }



        });

        function saveData(callurl){
            //alert("da chay savedata");
            $.ajax({
                method: "POST",
                url: callurl,
                data: $("#frmW75F1010").serialize() + "&slPropertyID="+ $("#slPropertyID").val()+ "&txtW75F1010_Val=" + $("#txtW75F1010_Val").val(),
                success: function (data) {
                    bSelect=1;

                    console.log(data);
                    if (data != "0" && data != "") {
                        $("#frmW75F1010").find(".alert-success").removeClass('hide');
                        $("#frmW75F1010").find(".alert-danger").addClass('hide');
                        NormalMode();
                        /*if (mod == "add"){
                            update4ParamGrid($(document).find("#pqgrid_W75F1010"), JSON.parse(JSON.stringify(data)), 'add');
                        }
                        if (mod == "edit"){
                            update4ParamGrid($(document).find("#pqgrid_W75F1010"), JSON.parse(JSON.stringify(data)), 'edit');
                        }*/
                        mod = "view";
                        loadTable();
                    }
                    else {

                        if (data == 0) $("#frmW75F1010").find("#err").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}')
                        $("#frmW75F1010").find(".alert-success").addClass('hide');
                        $("#frmW75F1010").find(".alert-danger").removeClass('hide');
                    }
                }
            });
        }

        $("#frmW75F1010").on('click', '#frm_btnAdd', function () {
            //alert("da chay vao");
            ActionMode();
            //$("#frmW75F1010").find("#hdActionW75F1010").val('add');
            mod = 'add';
            $("#txtW75F1010_Note").val("");
            $("#txtW75F1010_Val").val("");
            var propID = $("#slPropertyID").val();
            //alert(propID);
            if(propID == "PERADDR" || propID == "PROADDR" || propID == "EMCONADD1" || propID == "EMCONADD2" || propID == "CONADDR"){
                $("#txtW75F1010_Val").prop("disabled",true);
                $("#slProvinceIDW75F1010").val('');
                $("#slDistrictIDW75F1010").val('');
                $("#slWardIDW75F1010").val('');
                $("#slAddressNameW75F1010").val('');
                $("#slLabelProvinceW75F1010").val('');
                $("#slLabelDistrictW75F1010").val('');
                $("#slLabelWardW75F1010").val('');
            }else{
                $("#txtW75F1010_Val").prop("disabled",false);
            }
            $("#txtW75F1010_Val").focus();
        });

        $('#chkShowLock').click(function () {
            var val = $("#chkShowLock").is(":checked") ? "" : 0;
            $("#pqgrid_W75F1010").pqGrid("filter", {
                oper: 'replace',
                data: [
                    {dataIndx: 'Approved', condition: 'equal', value: val}
                ]
            }).pqGrid("refreshDataAndView");
        });

        $("#txtW75F1010_Val").keyup(function() {
            if ($("#txtW75F1010_Val").val() != "" && ($("#frmW75F1010").find("#frm_btnSave").is(':enabled')))
                $("#pqgrid_W75F1010").pqGrid("disable");
        });
    });

    function loadTable() {
        $.ajax({
            method: 'GET',
            url: '{{url("/W75F1010/table/$pro")}}',
            success: function (data) {
                $("#tbW75F1010").html(data);
            }
        });
    }

    function ActionMode() {
        /*$("#frmW75F1010").find("#frm_btnedit").addClass('disabled');
        $("#frmW75F1010").find("#frm_btnAdd").addClass('disabled');
        $("#frmW75F1010").find("#frm_btnCancel").removeClass('disabled');
        $("#frmW75F1010").find("#frm_btnSave").removeClass('disabled');
        $("#frmW75F1010").find("#slPropertyID").removeAttr('disabled');
        $("#frmW75F1010").find(".alert-danger").addClass('hide');
        $("#frmW75F1010").find(".alert-success").addClass('hide');
        $("#frmW75F1010").find(".linkedit").addClass('disabled');*/

        $("#frmW75F1010").find("#frm_btnedit").attr('disabled','disabled');
        $("#frmW75F1010").find("#frm_btnAdd").attr('disabled','disabled');
        $("#frmW75F1010").find("#frm_btnCancel").removeAttr('disabled');
        $("#frmW75F1010").find("#frm_btnSave").removeAttr('disabled');
        //$("#frmW75F1010").find("#slPropertyID").removeAttr('disabled');
        //$("#frmW75F1010").find("#txtW75F1010_Val").removeAttr('disabled');

        @if($pro == "PERADDR" || $pro == "PROADDR" || $pro == "EMCONADD1" || $pro == "EMCONADD2" || $pro == "CONADDR")
        $("#frmW75F1010").find("#slProvinceIDW75F1010").removeAttr('disabled');
        $("#frmW75F1010").find("#slDistrictIDW75F1010").removeAttr('disabled');
        $("#frmW75F1010").find("#slWardIDW75F1010").removeAttr('disabled');
        $("#frmW75F1010").find("#slAddressNameW75F1010").removeAttr('disabled');
        $("#frmW75F1010").find("#slLabelProvinceW75F1010").removeAttr('disabled');
        $("#frmW75F1010").find("#slLabelDistrictW75F1010").removeAttr('disabled');
        $("#frmW75F1010").find("#slLabelWardW75F1010").removeAttr('disabled');
        @else
        $("#frmW75F1010").find("#txtW75F1010_Val").removeAttr('disabled');
        @endif

        $("#frmW75F1010").find("#txtW75F1010_Note").removeAttr('disabled');
        $("#frmW75F1010").find(".alert-danger").addClass('hide');
        $("#frmW75F1010").find(".alert-success").addClass('hide');
        $("#frmW75F1010").find(".linkedit").attr('disabled','disabled');
        $("#pqgrid_W75F1010").pqGrid("disable");
    }

    function NormalMode() {
        /*$("#frmW75F1010").find("#frm_btnedit").removeClass('disabled');
        $("#frmW75F1010").find("#frm_btnAdd").removeClass('disabled');
        $("#frmW75F1010").find("#frm_btnCancel").addClass('disabled');
        $("#frmW75F1010").find("#frm_btnSave").addClass('disabled');
        $("#frmW75F1010").find("#slPropertyID").attr('disabled', 'disabled');
        $("#frmW75F1010").find(".linkedit").removeClass('disabled');*/
        $("#frmW75F1010").find("#frm_btnedit").removeAttr('disabled');
        $("#frmW75F1010").find("#frm_btnAdd").removeAttr('disabled');
        $("#frmW75F1010").find("#frm_btnCancel").attr('disabled','disabled');
        $("#frmW75F1010").find("#frm_btnSave").attr('disabled','disabled');
        $("#frmW75F1010").find("#slPropertyID").attr('disabled', 'disabled');
        $("#frmW75F1010").find("#txtW75F1010_Val").attr('disabled', 'disabled');

        @if($pro == "PERADDR" || $pro == "PROADDR" || $pro == "EMCONADD1" || $pro == "EMCONADD2" || $pro == "CONADDR")
        $("#frmW75F1010").find("#slProvinceIDW75F1010").attr('disabled', 'disabled');
        $("#frmW75F1010").find("#slDistrictIDW75F1010").attr('disabled', 'disabled');
        $("#frmW75F1010").find("#slWardIDW75F1010").attr('disabled', 'disabled');
        $("#frmW75F1010").find("#slAddressNameW75F1010").attr('disabled', 'disabled');
        $("#frmW75F1010").find("#slLabelProvinceW75F1010").attr('disabled', 'disabled');
        $("#frmW75F1010").find("#slLabelDistrictW75F1010").attr('disabled', 'disabled');
        $("#frmW75F1010").find("#slLabelWardW75F1010").attr('disabled', 'disabled');
        @endif

        $("#frmW75F1010").find("#txtW75F1010_Note").attr('disabled', 'disabled');
        $("#frmW75F1010").find(".linkedit").removeAttr('disabled');
        $("#pqgrid_W75F1010").pqGrid("enable");
    }
</script>