@foreach($detail as $row)
  <div class="leftRowView">
      <input type="hidden" value="{{url("/W15F2170/employInfo/" . $row['EmployeeID'] ."/" . $AppStatusID . "/" . $TimeID)}}">
      <input type="hidden" value="{{url("/W15F2170/listApproval/" . $row['EmployeeID'] ."/" . $AppStatusID . "/" . $TimeID)}}">
      <input type="hidden" value="{{url("/W15F2170/detail/" . $row['EmployeeID'] ."/" . $AppStatusID . "/" . $TimeID)}}">
            <label id="lb{{$row['EmployeeID']}}">{{$row['EmployeeName']}}</label>
    </div>
@endforeach
