@if(isset($rs))
<div class="row ">
    <div class="col-sm-2">
        <label class="lbl-normal">{{Helpers::getRS(4,"Nhan_vien")}}</label>
    </div>
    <div class="col-sm-5 pdl0">
        <label class="nameEmployee" style="margin-bottom: 0px !important;"><a  onclick="showW09F4444W15('{{$rs['EmployeeID']}}')">{{$rs['EmployeeName']}}</a></label>  &nbsp;  - &nbsp;<label class="nameEmployee" style="margin-bottom: 0px"><a onclick="showW09F4444W15('{{$rs['EmployeeID']}}')">{{$rs['EmployeeID']}}</a> </label>
    </div>
    <div class="col-sm-2">
        <label class="lbl-normal">{{Helpers::getRS(4,"Phong_ban")}}</label>
    </div>
    <div class="col-sm-3 pdl0">
        <label id="idDepartmentName">{{$rs['DepartmentName']}}</label>
    </div>
</div>
@endif
<div id="secDetailE09F0000"></div>
<script>
    function showW09F4444W15(empid){
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "GET",
            url: "{{url("W09F4444/4")}}",
            data:{empid:empid},
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#secDetailE09F0000").html(data);
                $("#modalW09F4444").modal("show");
            }
        });
    }
</script>