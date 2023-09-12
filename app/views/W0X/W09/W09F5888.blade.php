<section class="content" id="secW09F5888">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <form class="form-horizontal" id="frmW09F5888" method="post">
                <fieldset>
                    <legend class="legend"
                            style="text-align:left;margin-bottom:0px;">{{Helpers::getRS($g,"Thong_tin_loc")}}</legend>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-2 col-xs-2">
                            <div class="liketext">
                                <b><label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label></b>
                            </div>

                        </div>
                        <div class="col-md-5 col-xs-5">
                            {{ Form::select("cbDepartmentID", $Department ,0,["class" => "col-md-12 form-control", "id" => "cbDepartmentID"])}}
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <div class="row" >
                                <div class="col-md-5 col-xs-5">
                                    <div class="liketext">
                                        <b><label class="lbl-normal">{{Helpers::getRS($g,"Thoi_gian_het_han_HDLD")}}</label></b>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xs-7">
                                    <select class="form-control" name="cbRangeID" id="cbRangeID">
                                        @foreach($ListStatus as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-2 col-xs-2">
                            <div class="liketext">
                                <b><label class="lbl-normal">{{Helpers::getRS($g,"Hinh_thuc_lam_viec")}}</label></b>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <select class="form-control" name="cbWorkingStatusID" id="cbWorkingStatusID" >
                                @foreach($WorkingStatusID as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 col-xs-5" style="padding-right: 5px">
                            <button type="submit" id="btnFilter"
                                    class="btn btn-default smallbtn pull-right mgr10 confirmation-save"
                                    onclick=""><span
                                        class="glyphicon glyphicon-filter"></span>{{Helpers::getRS($g,"Loc")}}
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-md-12 col-xs-12" style="margin-top: 5px">
            <fieldset>
                <legend class="legend"
                        style="text-align:left;margin-bottom: 5px">{{Helpers::getRS($g,"Danh_sach_hop_dong_lao_dong")}}</legend>
                <section class="content" style="padding:5px;margin-left: -5px" id="tblContract"></section>
            </fieldset>
        </div>
    </div>
</section>
<script type="text/javascript">
    $("#secW09F5888").on('submit', '#frmW09F5888', function (e) {
        e.preventDefault();
        $(".l3loading").removeClass('hide');

        $.ajax({
            method: "POST",
            url: '{{url("/W09F5888/view/$pForm/$g/filter")}}',
            data: $("#frmW09F5888").serialize(),
            success: function (data) {
                //console.log(data);
                $(".l3loading").addClass('hide');
                $("#tblContract").html(data);
            }
        });

    });

    $('#frmW09F5888 #btnFilter').keydown(function(e) {
        if (e.keyCode == 13) {
            $("#frmW09F5888").find("#btnFilter").trigger('click');
        }
    });

    $('#frmW09F5888 select').keydown(function(e) {
        if (e.keyCode == 13) {
            $("#frmW09F5888").find("#btnFilter").trigger('click');
        }
    });
</script>




