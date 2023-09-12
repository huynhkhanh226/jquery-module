<style>
    #preview {
        position: absolute;
        border: 1px solid #ccc;
        background: #333;
        padding: 5px;
        display: none;
        color: #fff;
    }
</style>

<div class="modal draggable fade modal" id="modalW09F5889" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:65%;">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW75F1065" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,"Lich_su_hop_dong_lao_dong"),"W09F5889")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    @if (count($rs) > 0)

                        <div class="row">
                            <div class="col-md-2 col-xs-2" style="padding-right: 0px">
                                @if($rs[0]['EmployeePicture']!="")
                                    <img class="preview"
                                         src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen($rs[0]['EmployeePicture']),$rs[0]['EmployeePicture']))}}"
                                         data-thumbnail-src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen($rs[0]['EmployeePicture']),$rs[0]['EmployeePicture']))}}"
                                         class="user-image imgborder" alt="User Image" width="100"/>
                                    <img id="preview" src="">
                                @else
                                    <img src="{{asset('packages/default/L3/images/icon-user-default.png')}}"
                                         class="user-image imgborder" alt="User Image" width="120"/>
                                @endif
                            </div>
                            <div class="col-md-10 col-xs-10">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6" style="padding-left: 0px">
                                        <label>{{$rs[0]['EmployeeName']}}</label>
                                    </div>

                                    <div class="col-md-6 col-xs-6">
                                        <label>{{$rs[0]['EmployeeID']}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-6" style="padding-left: 0px">
                                        <label>{{$rs[0]['DepartmentName']}}</label>
                                    </div>

                                    <div class="col-md-6 col-xs-6">
                                        <label>{{$rs[0]['DutyName']}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-xs-3" style="padding-left: 0px">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_vao_lam")}}</label>
                                    </div>
                                    <div class="col-md-3 col-xs-3" style="padding-left: 0px">
                                        <label>{{$rs[0]['DateJoined']}}</label>
                                    </div>
                                    <div class="col-md-2 col-xs-2">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Tham_nien")}}</label>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <label>{{$rs[0]['Seniority']}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-xs-3" style="padding-left: 0px">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Trang_thai_lam_viec_hien_tai")}}</label>

                                    </div>
                                    <div class="col-md-3 col-xs-3" style="padding-left: 0px">
                                        <label>{{$rs[0]['StatusName']}}</label>
                                    </div>
                                    <div class="col-md-2 col-xs-2">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"HDLD_hien_tai")}}</label>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <label>{{$rs[0]['TimeLeftInContract']}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12 col-xs-12">
                            <table id="tblHistory" class="tblHH table-striped" cellspacing="0" width="100%">
                                <thead class="l3_thead_blue">
                                <tr style="">
                                    <th>{{Helpers::getRS($g,"Lan_ky")}}</th>
                                    <th>{{Helpers::getRS($g,"Loai_HDLD")}}</th>
                                    <th>{{Helpers::getRS($g,"Ngay_ky_HDLD")}}</th>
                                    </th>
                                    <th>{{Helpers::getRS($g,"So_HDLD")}}</th>
                                    <th>{{Helpers::getRS($g,"Nguoi_ky_HDLD")}}</th>
                                    <th>{{Helpers::getRS($g,"Hieu_luc_tu")}}</th>
                                    <th>{{Helpers::getRS($g,"Hieu_luc_den")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($rsGrid) > 0)
                                    @foreach($rsGrid as $row )
                                        <tr>
                                            <td align="center">{{$row['Times']}}</td>
                                            <td>{{$row['ContractTypeName']}}</td>
                                            <td align="center">{{$row['SignedDate']}}</td>
                                            <td>{{$row['SerialBook']}}</td>
                                            <td>{{$row['SignerName']}}</td>
                                            <td align="center">{{$row['EffContractBegin']}}</td>
                                            <td align="center">{{$row['EffContractEnd']}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
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
    function load_table(mod) {
        /*$("#frmW75F1065").find(".spinD75F1065").removeClass('hide');
         if (mod == 0) {

         $.ajax({
         method: 'POST',
         url: '
        {{url("/W75F1065/view/$pForm/$g/0")}}',
         success: function (data) {
         $("#tbHistory").html(data);
         //$("#frmW75F1065").find(".spinD75F1065").addClass('hide');
         }
         });
         }*/

    }

    $(function () {
        var $preview = $("#preview");

        $("img").hover(function () {
            $preview.attr("src", $(this).attr("data-thumbnail-src"));
        }, function () {
            $preview.attr("src", "");
        });
    });

</script>

