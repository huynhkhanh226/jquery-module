@foreach($detail as $row)
  <div class="leftRowView">
      <input type="hidden" value="{{url("/W09F1500/detail/$field/" . $row['DataID'])}}">
            <label>{{$row['CountDataName']}}</label>
    </div>
@endforeach
