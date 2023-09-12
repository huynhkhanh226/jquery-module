@foreach($detail as $row)
  <div class="leftRowView">
      <input type="hidden" value="{{url("/W09F4550/detail/".urlencode($dep)."/" . $row['FieldID'])}}">
            <label>{{$row['FieldName']}}</label><br>
            <label>{{$row['DateFromTo']}}</label>
    </div>
@endforeach
