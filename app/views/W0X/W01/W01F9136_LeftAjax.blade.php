@foreach($detail as $row)
  <div class="leftRowView">
      <input type="hidden" value="{{url("/W01F9136/detail/" . $row['VoucherID'])}}">
      <div class="width85pc">
          {{$row['DisplayDesc']}}
      </div>
    </div>
@endforeach
<script>
    $(".empployeeW15").find("#slStatusID").html("{{$cbStatus}}");
</script>

