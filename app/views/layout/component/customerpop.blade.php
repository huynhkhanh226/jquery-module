<div class="modal draggable fade" id="mPopUpCustomer"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style=" background: #fff; width: 840px;">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Thong_tin_khach_hang_chi_tiet"),"",false,"closePopUpCustomer")}}
            </div>
            <div class="modal-body"  style="float: left; background: #fff; padding: 10px; width: 100%;">

                  @foreach($rs as $key=>$row)
                    <div style="border-radius: 4px; border: 1px #ccc solid; margin-bottom: 5px;">
                    <div class="row mglr0 bg-gray">
                        <div class="col-md-{{$key==0 ? "7" : "12"}}">
                            <div class="liketext">
                                <label> <b>{{$row['ObjectName']}}</b></label>
                            </div>
                        </div>
                         @if($key==0)
                        <div class="col-md-5">
                            <div class="liketext">
                                <label class="mgr5" >  {{ Helpers::getRS($g,"Nguoi_dai_dien")}}</label>
                                <label> <b>{{$row['LegalPerson']}}</b></label>
                            </div>
                        </div>
                        @endif
                    </div>
                      <div class="row mglr0">
                          <div class="col-md-3">
                              <div class="liketext">
                                  <label class="mgr5" >  {{ Helpers::getRS($g,"MST_CMND_PP")}}</label>
                                  <label> <b>{{$row['TaxCode']=='' ? $row['IDCardNo'] : $row['TaxCode']}}</b></label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="liketext">
                                  <label class="mgr5" >  {{ Helpers::getRS($g,"Cap_ngay")}}</label>
                                  <label> <b>{{$row['IDCardIssueDate']}}</b></label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="liketext">
                                  <label class="mgr5" >  {{ Helpers::getRS($g,"Tai")}}</label>
                                  <label> <b>{{$row['IDCardIssuePlace']}}</b></label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="liketext">
                                  <label class="mgr5" >  {{ Helpers::getRS($g,"Ngay_sinh")}}</label>
                                  <label> <b>{{$row['BirthDate']}}</b></label>
                              </div>
                          </div>
                      </div>
                    <div class="row mglr0">
                        <div class="col-md-3">
                            <div class="liketext">
                                <label class="mgr" >  {{ Helpers::getRS($g,"Dia_chi_thuong_tru")}}</label>

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="liketext">

                                <label> <b>{{$row['PermanentAddress']}}</b></label>
                            </div>
                        </div>

                    </div>
                    <div class="row mglr0">
                        <div class="col-md-3">
                            <div class="liketext">
                                <label  >  {{ Helpers::getRS($g,"Dia_chi_lien_he")}}</label>

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="liketext">

                                <label> <b>{{$row['TemporaryAddress']}}</b></label>
                            </div>
                        </div>
                    </div>
                    <div class="row mglr0">
                        <div class="col-md-3">
                            <div class="liketext">

                                <label><i class="digi digi-telephone mgr5"></i> <b>{{$row['TelNo']}}</b></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="liketext">

                                <label><i class="digi digi-fax mgr5"></i> <b>{{$row['FaxNo']}}</b></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="liketext">

                                <label> <i class="digi digi-e-mail mgr5"></i><b>{{$row['Email']}}</b></label>
                            </div>
                        </div>
                    </div>
                    </div>
                  @endforeach

            </div>
        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var closePopUpCustomer= function () {
        $("#mPopUpCustomer").modal('hide');
    };
 </script>