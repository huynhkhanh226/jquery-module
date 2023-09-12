@foreach($detail as $row)

  <div class="leftRowView">
      <input type="hidden" value="{{url("/W09F2510/employInfo/" . $row['TransID'])}}">
      <input type="hidden" class="transid" value="{{$row['TransID']}}">
      <label>{{$row['TransDate']}}</label>
      <label class="pull-right">{{$row['EmployeeName']}}</label>
      <br><label>{{$row['PropertyName']}}</label>
    </div>
@endforeach
