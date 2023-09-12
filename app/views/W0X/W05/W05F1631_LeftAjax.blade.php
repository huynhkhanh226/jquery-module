@foreach($detail as $row)
  <div class="leftRowView">
      <input type="hidden" value="{{url("/W05F1631/detail/" . $row['VoucherID'])}}">
      <div class="width85pc">
          {{$row['DisplayDesc']}}
      </div>
    </div>
@endforeach
<script>
    $(".empployeeW15").find("#slStatusID").html("{{$cbStatus}}");
</script>

