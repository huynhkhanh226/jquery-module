<div class="item {{$row["Creator"]==$userid?'right':''}}">
    @if($row["UserPicture"]!="")
        <img src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen($row["UserPicture"]), $row["UserPicture"]))}}"
             class="user-image" alt="User Image"/>
    @else
        <img src="{{asset('packages/default/L3/images/icon-user-default.png')}}">
    @endif
    <p class="message">
        <a href="#" class="name">
            {{$row["Creator"]}}&nbsp;&nbsp;&nbsp;<small class="text-muted"><i class="fa fa-clock-o"></i> {{date("d/m/Y H:i:s", strtotime($row["CreateDate"]))}}</small>
            <button class="btn no-border pdr5 mgr10 btnDelete" data-memoid="{{$row["MemoID"]}}"><span class="fa fa-trash"></span></button>
        </a>
        @if($row["Creator"]==$userid)
        @endif
        {{$row["MemoContent"]}}
    </p>
    @define $att = $connectionHR->select("SELECT * FROM D76T2052 WITH(NOLOCK) WHERE MemoID = ".$row["MemoID"]);
    @if (count($att) > 0)
    <div class="attachment">
        <h4>{{Helpers::getRS($g,"Dinh_kem")}}:</h4>
        @foreach($att as $attrow)
            <p class="filename">
                <a target="_blank"  href="{{url("/W76F4072/getfile/". Helpers::encryptData($attrow['FileID'])) }}">{{$attrow['FileName']}}</a>
            </p>
        @endforeach
    </div>
    @endif
    <!-- /.attachment -->
</div>
<script>
    function GetFileW76F4072(attID)
    {
        /* var link = document.createElement('a');
         link.href = '{{--{{url("/W76F4072/getfile")}}--}}/'+attID;
        link.target = "_blank";
        $("#iframeDown").html(link);
        link.click();*/

/*        $.ajax({
            method: "POST",
            {{--url: '{{url("/W76F4072/getfile")}}/'+attID ,--}}
            success: function (data) {
                //nothing
            }
        });*/
    }
</script>
