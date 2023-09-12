@foreach($detail as $row)
  <div class="leftRowView">
      <input type="hidden" value="{{url("/W12F3004/detail/" . $row['PRID'])}}">
      <div class="width85pc">
          {{$row['DisplayDesc']}}
      </div>
    </div>
@endforeach

