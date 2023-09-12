<style>
    ::-webkit-validation-bubble { position: static !important;}
</style>
<section class="content" id="secW01F3050">
    <form id="frmW01F3050" name="frmW01F3050">
        <div class="row">
            <div class="col-md-1 col-xs-1 pdr0">
                <div class="liketext">
                    <label class="lbl-normal">{{Helpers::getRS($g,"Don_vi")}}</label>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <select class="form-control select2 " id="cboLeaveTypeID" title=""
                        name="cboLeaveTypeFrom" required>
                    @foreach($divisionList as $key => $value )
                        <option name='LeaveTypeIDFrom'
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 col-xs-4">
                <select class="form-control select2 " id="cboLeaveTypeID" title=""
                        name="cboLeaveTypeTo" required>
                    @foreach($divisionList as $key => $value )
                        <option name='LeaveTypeIDTo'
                                value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 col-xs-1">
                <div class="liketext">
                    <label class="lbl-normal">{{Helpers::getRS($g,"Ngay")}}</label>
                </div>
            </div>
            <div class="col-md-2 col-xs-2">
                <div id="divDataW01F3050" class="input-group date">
                    <input type="text" class="form-control" id="txtDataW01F3050"
                           name="txtDataW01F3050" value="" required><span
                            class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>

        </div>
        <div class="row mgt5">
            <div class="col-md-1 col-xs-1">
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="checkbox" style="margin-top: 3px;margin-left:20px">
                    <input type="checkbox" id="chkIsViewMoreDivOut" name="chkIsViewMoreDivOut">{{Helpers::getRS($g,"Xem_them_cac_don_vi_ngoai_he_thong")}}
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="checkbox" style="margin-top: 3px;margin-left:20px">
                    <input type="checkbox" id="chkIsOnlyViewDivOut" name="chkIsOnlyViewDivOut">{{Helpers::getRS($g,"Chi_xem_cac_don_vi_ngoai_he_thong")}}
                </div>
            </div>
            <div class="col-md-3 col-xs-3">
                <button  type="button" id="btnFilterW01F3050" class="btn btn-default smallbtn pull-right" style="padding-top: 3px"><span class="digi digi-filter"></span>&nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                <input type="submit" class="hide" id="hdBtnFilterW01F3050" name="hdBtnFilterW01F3050"/>
            </div>
        </div>
    </form>
    <div class="row mgt5">
        <div class="col-md-12 col-xs-12 gridMasterW01F2050">
        </div>
    </div>
    <div class="row mgt5">
        <div class="col-md-12 col-xs-12 gridDetailW01F2050">
        </div>
    </div>
    <div class="l3-loading hide" style="background-color: #FFffff">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        /*var elements = document.getElementsByTagName("input");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function(e) {
                e.target.setCustomValidity("");
                console.log('sdfdsfsd');
                if (!e.target.validity.valid) {
                    e.target.align = 'left';
                    e.target.setCustomValidity("This field cannot be left blank");
                }
            };
            elements[i].oninput = function(e) {
                e.target.setCustomValidity("");
            };
        }*/

        $('#txtDataW01F3050').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDataW01F3050').datepicker('setDate', '{{date("d/m/Y")}}')

        $('#divDataW01F3050').find(".glyphicon-calendar").on('click',function(){
            if ($('#txtDataW01F3050').is(':disabled') == false){
                $('#txtDataW01F3050').datepicker('show');
            }
        });

    });

    $("#btnFilterW01F3050").click(function(){
        var date = $("#txtDataW01F3050");
        date.get(0).setCustomValidity("");
        console.log('dsfdsf');
        if (date.val() == "") {
            date.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ngay')}}");
            $("#secW01F3050").find('#hdBtnFilterW01F3050').click();
            //date.focus();
            return;
        }
        $("#secW01F3050").find('#hdBtnFilterW01F3050').click();
    });


    $("#secW01F3050").on('submit', '#frmW01F3050', function (e) {
        e.preventDefault();
        createGrid();
    });

    function createGrid(){
        $(".l3loading").removeClass('hide');
        var isViewMoreDivOut = $("#chkIsViewMoreDivOut").is(':checked') ? 1:0;
        var isOnlyViewDivOut = $("#chkIsOnlyViewDivOut").is(':checked') ? 1:0;

        $.ajax({
            method: "POST",
            url: '{{url("/W01F3050/$pForm/$g/action/filter")}}',
            data: $('#frmW01F3050').serialize() + '&isViewMoreDivOut='+isViewMoreDivOut+'&isOnlyViewDivOut='+isOnlyViewDivOut ,
            success: function (data) {
                $(".l3loading").addClass('hide');
                $(".gridMasterW01F2050").html(data);
            }
        });
    }

</script>

