@if(count($rs))
    <div class="detailW15">
        <div class="row ">
            <div class="col-md-11 hdDetail">
                <div class="liketext">
                    <label class="text-yellow"><b>{{$rs[0]['DivisionName']}}</b></label>
                </div>
            </div>
            <div class="col-md-1 hdDetail">
                <div class="liketext">
                    @if(floatval($rs[0]['CountFileAttachment'])>0)
                        <a class="fa fa-paperclip text-orange" onclick='$("#modalW91F4010").modal("show");'>
                            ({{$rs[0]['CountFileAttachment']}})
                        </a>
                    @else
                        <label></label>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 100px">{{Helpers::getRS($g,"So_phieu_YC")}}</label>
                    <label><b>{{$rs[0]['VoucherNo']}} </b></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="liketext">
                    <label style="width: 100px">{{Helpers::getRS($g,"Loai_tien")}}</label>
                    <label><b>{{isset($rs[0]['CurrencyID'])?$rs[0]['CurrencyID']:""}}</b></label>
                </div>

            </div>
            <div class="col-md-5">
                <div class="liketext">
                    <label style="width: 100px">{{Helpers::getRS($g,"Trang_thai")}}</label>
                    <label style="font-weight: bold" id="idStatusVoucher"></label>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="liketext">
                    <label style="width: 100px">{{Helpers::getRS($g,"Ngay_lap")}}</label>
                    <label><b>{{$rs[0]['CreateDate']}} </b></label>
                </div>
            </div>
            <div class="col-md-8">
                <div class="liketext">
                    <label style="width: 100px">{{Helpers::getRS($g,"Dien_giai")}}</label>
                    <label><b>{{isset($rs[0]['VoucherDesc'])?$rs[0]['VoucherDesc']:""}}</b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12 clsGridWidth">
                <div id="pqgrid_W01F9136" class="mg"></div>
                <table id="tblW01F9136">
                    <tr>
                        <th>{{Helpers::getRS($g,"So_Seri")}}</th>
                        <th>{{Helpers::getRS($g,'So_hoa_don')}}</th>
                        <th>{{Helpers::getRS($g,'Ngay_hoa_don')}}</th>
                        <th>{{Helpers::getRS($g,'TK_no')}}</th>
                        <th>{{Helpers::getRS($g,'TK_co')}}</th>
                        <th>{{Helpers::getRS($g,'So_tien_nguyen_te')}}</th>
                        <th>{{Helpers::getRS($g,'So_tien_quy_doi')}}</th>
                        <th>{{Helpers::getRS($g,'Loai_DT')}}</th>
                        <th>{{Helpers::getRS($g,'Doi_tuong')}}</th>
                        <th>{{Helpers::getRS($g,'Ten_doi_tuong')}}</th>
                        <th>{{Helpers::getRS($g,'Dia_chi_doi_tuong')}}</th>
                        <th>{{Helpers::getRS($g,'Ma_so_thue')}}</th>
                        <th>{{Helpers::getRS($g,'Ma_tai_khoan_ngan_hang')}}</th>
                        <th>{{Helpers::getRS($g,'So_tien_duyet_NT')}}</th>
                        <th>{{Helpers::getRS($g,'So_tien_duyet_QD')}}</th>
                    </tr>
                    @foreach($rsDetail as $row )
                        <tr>
                            <td minWidth="200">{{$row['Serial']}}</td>
                            <td minWidth="200">{{$row['RefNo']}}</td>
                            <td minWidth="80" align="center">{{$row['RefDate']}}</td>
                            <td minWidth="100">{{$row['DebitAccountID']}}</td>
                            <td minWidth="100">{{$row['CreditAccountID']}}</td>
                            <td minWidth="110" align="right">{{number_format($row['OAmount'],Session::get('W91P0000')['DecimalPlaces'])}}</td>
                            <td minWidth="110" align="right">{{number_format($row['CAmount'],Session::get('W91P0000')['D90_ConvertedDecimals'])}}</td>
                            <td minWidth="70" align="center">{{$row['ObjectTypeID']}}</td>
                            <td minWidth="110">{{$row['ObjectID']}}</td>
                            <td minWidth="200">{{$row['ObjName']}}</td>
                            <td minWidth="200">{{$row['ObjAddress']}}</td>
                            <td minWidth="110">{{$row['VATNo']}}</td>
                            <td minWidth="110">{{$row['BankAccountNo']}}</td>
                            <td minWidth="110" align="right">{{number_format($row['AcceptedOAmount'],Session::get('W91P0000')['DecimalPlaces'])}}</td>
                            <td minWidth="110" align="right">{{number_format($row['AcceptedCAmount'],Session::get('W91P0000')['D90_ConvertedDecimals'])}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @define $g=1;
    @define $mod="D01";
    @if(floatval($rs[0]['CountFileAttachment'])>0)
        @extends('W9X.W91.W91F4010')
    @endif
    <script type="text/javascript">
        $("#idStatusVoucher").html($('#slduyet option:selected').text());
        function resizeHeight() {
            $("#modalW01F9136").find(".detailW15").height($("#modalW01F9136").find(".modal-content").height() - $("#modalW01F9136").find(".empployeeW15").height() - 80);
            $("#pqgrid_W01F9136").pqGrid({height: $("#modalW01F9136").find(".detailW15").height() - 107});
            $("#pqgrid_W01F9136").pqGrid("refresh");
        }

        $(function () {
            $("#modalW01F9136").find(".rightContent").removeClass("hide");
            $("#modalW01F9136").find("#slEmployeeID").val("{{Session::get("W91P0000")['Creator']}}");
            $("#modalW01F9136").find("#slStatusID").val("1");
            $("#modalW01F9136").find("#txtDescription").val("");

            var tbl = $("table#tblW01F9136");
            var obj = $.paramquery.tableToArray(tbl);
            var newObj = { width: '100%', height: 300, showTitle: false, editable: false, numberCell: false ,collapsible: false, sortable: false};
            var summaryData = [{0:"", 1:"", 2:"", 3:"", 4:"", 5:"{{number_format(Helpers::sumFooter($rsDetail,"OAmount"),intval(Session::get('W91P0000')['DecimalPlaces']))}}",6:"{{number_format(Helpers::sumFooter($rsDetail,"CAmount"),intval(Session::get('W91P0000')['D90_ConvertedDecimals']))}}",7:"",8:"",9:"",10:"",11:"",12:"", 13:"{{number_format(Helpers::sumFooter($rsDetail,"AcceptedOAmount"),intval(Session::get('W91P0000')['DecimalPlaces']))}}",14:"{{number_format(Helpers::sumFooter($rsDetail,"AcceptedCAmount"),intval(Session::get('W91P0000')['D90_ConvertedDecimals']))}}"}];
            obj.colModel[0].minWidth = 140;
            obj.colModel[1].minWidth = 140;
            obj.colModel[2].minWidth = 100;
            obj.colModel[3].minWidth = 140;
            obj.colModel[4].minWidth = 140;
            obj.colModel[5].minWidth = 140;
            obj.colModel[6].minWidth = 140;
            obj.colModel[7].minWidth = 60;
            obj.colModel[8].minWidth = 200;
            obj.colModel[9].minWidth = 200;
            obj.colModel[10].minWidth = 200;
            obj.colModel[11].minWidth = 140;
            obj.colModel[12].minWidth = 160;
            obj.colModel[13].minWidth = 140;
            obj.colModel[14].minWidth = 140;
            newObj.dataModel = { data: obj.data };
            newObj.colModel = obj.colModel;
            newObj.pageModel = {rPP: 20, type: "local"};
            newObj.scrollModel={ horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none' }
            newObj.summaryData = summaryData;
            $("#pqgrid_W01F9136").pqGrid(newObj);
            tbl.css("display", "none");

            //unbind tất cả các event click trước đó của button
            $("#btnAppW01F9136").off("click");

            $("#btnAppW01F9136").on("click", function () {
                $.ajax({
                    method: "PUT",
                    url: "{{url('W01F9136/save/'.$rs[0]['VoucherID'])}}" ,
                    data: {
                        isaccept: $("#slStatusID").val(),
                        status: $("#slduyet").val()
                    },
                    success: function (data) {
                        if (data == 1) {
                            save_ok(function(){
                                $("#lefthead_W01F9136").find('#sldate').val(0).trigger('change');
                            });
                        }
                        else
                            save_not_ok();
                    }
                });
            });
        });
        resizeHeight();
    </script>
@endif

