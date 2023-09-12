<section class="content" id="secW15F3030">
    <form id="frmW15F3030" name="frmW15F3030" method="post">
        <div class="row">
            <div class="col-sm-1 pdr0">
                <div class="liketext">
                    <b><label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label></b>
                </div>
            </div>
            <div class="col-sm-3">
                <select class="form-control select2" id="cboDepartmentIDW15F3030"
                        name="cboDepartmentIDW15F3030" >
                    @foreach($department as $key=>$value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-1 pdl0 pdr0">
                <div class="liketext">
                    <b><label class="lbl-normal">{{Helpers::getRS($g,"To_nhom")}}</label></b>
                </div>
            </div>
            <div class="col-sm-3">
                <select class="form-control select2" id="cboTeamIDW15F3030"
                        name="cboTeamIDW15F3030" >

                    @foreach($teams as $rs)
                        <option value="{{$rs["TeamID"]}}">{{$rs["TeamName"]}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-1 pdl0 pdr0">
                <div class="liketext">
                    <b><label class="lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label></b>
                </div>
            </div>
            <div class="col-sm-3">
                <select class="form-control select2" id="cboEmployeeIDW15F3030" name="cboEmployeeIDW15F3030" >
                    @foreach($employees as $rs)
                        <option value="{{$rs["EmployeeID"]}}">{{$rs["EmployeeName"]}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="margin-top: 5px;">
                <button  id="btnFilterW15F3030" onclick="return allow_filter();" class="btn btn-default smallbtn pull-right"><span class="digi digi-filter"></span> {{Helpers::getRS($g,"Loc")}} </button>
            </div>
        </div>
        <div class="row pdl0 pdr0" style="margin-top: 10px;">
            <section class="content" id="tbW15F3030"></section>
        </div>
    </form>
</section>

<section class="content" id="tbW15F3031"></section>
<script type="text/javascript">
    $(document).ready(function() {
        LoadDataW15F3030();
    });
    $("#frmW15F3030").find("#cboDepartmentIDW15F3030").change(function () {
        $.ajax({
            method: "POST",
            url: '{{url("/W15F3030/view/".$pForm."/".$g."/loadcombo/team")}}',
            data: {cboDepartmentID: $("#cboDepartmentIDW15F3030").val()},
            success: function (data) {
                $("#cboTeamIDW15F3030").html(data);
                $.ajax({
                    method: "POST",
                    url: '{{url("/W15F3030/view/".$pForm."/".$g."/loadcombo/employee")}}',
                    data: {cboDepartmentID: $("#cboDepartmentIDW15F3030").val(),cboTeamID: $("#cboTeamIDW15F3030").val()},
                    success: function (data) {
                        $("#cboEmployeeIDW15F3030").html(data);
                    }
                });
            }
        });
    });

    $("#frmW15F3030").find("#cboTeamIDW15F3030").change(function () {
        $.ajax({
            method: "POST",
            url: '{{url("/W15F3030/view/".$pForm."/".$g."/loadcombo/employee")}}',
            data: {cboDepartmentID: $("#cboDepartmentIDW15F3030").val(),cboTeamID: $("#cboTeamIDW15F3030").val()},
            success: function (data) {
                $("#cboEmployeeIDW15F3030").html(data);
            }
        });
    });

    function allow_filter(){
        $("#frmW15F3030").find("#btnFilterW15F3030").click();
    }

    $("#frmW15F3030").on('submit', function (e) {
        e.preventDefault();
        LoadDataW15F3030();
    });

    function LoadDataW15F3030(){
        //$(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W15F3030/view/$pForm/$g/filter")}}',
            data: $("#frmW15F3030").serialize(),
            success: function (data) {
                //.log(data);
                //$(".l3loading").addClass('hide');
                $("#tbW15F3030").html(data);
            }
        });
    }


</script>

