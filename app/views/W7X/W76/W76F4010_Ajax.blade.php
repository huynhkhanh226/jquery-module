@foreach($result as $row)
        <div class="row mgb5">
            <div class="col-md-2 text-left pdl10">
                @if($row['EmployeePicture']!="")
                <img src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen($row['EmployeePicture']),$row['EmployeePicture']))}}"
                     class="user-image imgborder" alt="User Image" width="60" height="70" />
                @else
                    <img src="{{asset('packages/default/L3/images/icon-user-default.png')}}"
                         class="user-image imgborder" alt="User Image" width="60" height="70" />
                @endif
            </div>
            <div class="col-md-9">
                <div class="row"> <label class="nameEmployee">{{$row['EmployeeName']}}</label>  &nbsp;  <label class="nameEmployee">{{$row['EmployeeID']}} </label>  &nbsp; {{$row['DepartmentName']}} &nbsp; {{$row['DutyName']}} </div>

                <div class="row"><label class="mgr15"><i class="glyphicon glyphicon-iphone"></i> <b>{{$row['Pager']}}</b></label> &nbsp; <label><i class="glyphicon glyphicon-phone-alt"></i> <b>{{$row['CompanyTelephone']}}</b></label></div>
                <div class="row"> <label><i class="digi digi-e-mail "></i> <b>{{$row['Email']}}</b></label></div>
            </div>
        </div>

@endforeach

<script type="text/javascript">
    $("#searchCount").text("Tổng số kết quả tìm được: {{count($result)}}")
</script>