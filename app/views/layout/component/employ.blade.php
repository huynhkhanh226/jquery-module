@if(isset($rs))
<div class="row ">
    <div class="col-md-2 text-center">
        @if($rs['EmployeePicture']!="")
            <img src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen($rs['EmployeePicture']),$rs['EmployeePicture']))}}"
                 class="user-image" alt="User Image" width="60" height="70" />
        @else
            <img src="{{asset('packages/default/L3/images/icon-user-default.png')}}"
                 class="user-image" alt="User Image" width="70" height="70" />
        @endif
    </div>
    <div class="col-md-7">
        <label class="nameEmployee">{{$rs['EmployeeName']}}</label>  &nbsp;  <label class="nameEmployee">{{$rs['EmployeeID']}} </label> <br>
        <label>{{$rs['DepartmentName']}}</label> <br>
        <label>{{$rs['DutyName']}}</label>
    </div>
</div>
@endif