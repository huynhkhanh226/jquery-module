<div class="modal draggable fade" id="modalBookingW27F3000" data-backdrop="static"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Phieu_giu_cho"),"W27F3000",false,"closeBookingW27F3000Pop")}}
            </div>
            <div class="modal-body" style="background: #fff; float: left; width: 100%; padding-bottom: 5px;">
                <form id="frmBooking" method="post" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>{{Helpers::getRS($g,"Can_ho")}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="lbl-normal">{{$row["OfficeID"]}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>{{Helpers::getRS($g,"Nhan_vien_kinh_doanh")}}</label>
                            </div>
                            <div class="col-md-8">
                                <select name ='optSalesPersonID' id ='optSalesPersonID' style="width: 300px" required>
                                    <option name='EmployeeID' value =''></option>
                                    @foreach ($connection->select("SELECT Object.ObjectID as EmployeeID, Object.ObjectNameU as EmployeeName FROM Object WHERE Disabled = 0 And Object.ObjectTypeID = 'NV' And ( DAG ='' Or DAG In (Select DAGroupID From LemonSys.dbo.D00V0080 Where UserID= '".Auth::user()->user()->UserID. "' ) Or 'LEMONADMIN' = '".Auth::user()->user()->UserID."' ) ORDER BY ObjectID") as $erow)
                                        @if ($row["ObjectID"]== $erow['EmployeeID'])
                                            <option name='EmployeeID' value ='{{$erow['EmployeeID']}}' selected >{{$erow['EmployeeName']}}</option>
                                        @else
                                            <option name='EmployeeID' value ='{{$erow['EmployeeID']}}'>{{$erow['EmployeeName']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>{{Helpers::getRS($g,"Phieu_giu_cho")}}</label>
                            </div>
                            <div class="col-md-8">
                                <select name ='optVoucherNo' id ='optVoucherNo' style="width: 300px" required>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>{{Helpers::getRS($g,"Tien_giu_cho")}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="hdSpin text-right" style="width: 150px; padding-right: 5px;" id="txtOAmount" name="txtOAmount" value="" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>{{Helpers::getRS($g,"Muc_uu_tien")}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="hdSpin text-right" style="width: 150px; padding-right: 5px;" id="txtPriorityLevel" name="txtPriorityLevel" value="{{$row["PriorityLevel"]}}"  readonly="true" />
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="frm_btnSave" onclick="return allow_save();" class="btn btn-default smallbtn pull-right  mgr20"><span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}</button>
                    </div><!-- /.box-footer -->
                </form>
                <div class="row">
                    <div class="col-md-12 mgt10">
                        <div class="alert alert-success alert-dismissable hide">
                            <i class="icon fa fa-check"></i>   {{Helpers::getRS($g,"Du_lieu_da_luu_thanh_cong")}}!.
                        </div>
                        <div class="alert alert-danger alert-dismissable hide">
                            <i class="icon fa fa-ban"></i>  <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">

    function allow_save(){
        var oAmount = $("#frmBooking").find("#txtOAmount");
        if (oAmount.val() == "") {
            oAmount.get(0).setCustomValidity("{{Lang::get("Bạn chưa nhập tiền giữ chỗ")}}");
        }
        else {
            oAmount.get(0).setCustomValidity("");
        }
        return true;
    }

    $(document).ready( function () {
        $("#txtOAmount").inputmask('999,999,999,999,999', { numericInput: true });

        $("#optSalesPersonID").change(function() {
            var pro='{{$pro}}';
            var sales= $("#optSalesPersonID").val();
            $.ajax({
                method: "POST",
                url: '{{url("/W27F3000/show/3")}}',
                data: {offno:"", proid:pro, sales:sales, div:'{{$div}}'},
                success: function (response) {
                    $("#optVoucherNo").html(response);
                }
            });
        });
        $("#modalBookingW27F3000").find("#optSalesPersonID").trigger("change");
        $("#modalBookingW27F3000").on('submit','#frmBooking',function (e) {
            e.preventDefault();
            var amo=$("#txtOAmount").inputmask('unmaskedvalue');
            $.ajax({
                method: "POST",
                url: "{{url('W27F3000/update')}}",
                data:  $("#frmBooking").serialize()+'&amo='+amo+'&off={{$row["OfficeID"]}}'+'&div={{$div}}' ,
                success: function (data) {
                    if(data=="1") {
                        $("#modalBookingW27F3000").find(".alert-success").removeClass('hide');
                        $("#modalBookingW27F3000").find(".alert-danger").addClass('hide');
                    }
                    else {
                        $("#modalBookingW27F3000").find(".alert-success").addClass('hide');
                        $("#modalBookingW27F3000").find(".alert-danger").removeClass('hide');
                        if(data!="1")
                        {
                            alert_warning(data);
                        }
                    }
                }
            });
        });
    });
</script>