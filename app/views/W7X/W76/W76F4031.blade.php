<div class="modal fade modal" id="modalW76F4031" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:80%">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW76F4031" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W76F4031",true,"closePopW76F4031")}}
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if (count($rsList) > 0)
                                    <div id="sliderW76F4031" style="margin:0 auto;" class="html5gallery" data-skin="gallery" data-resizemode="fill">
                                        @foreach($rsList as $row)
                                            @if ($row['FileType']==0)
                                                @define preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=embed/)[^&\n]+|(?<=v=)[^&\‌​n]+|(?<=youtu.be/)[^&\n]+#", $row["LocationPath"], $matches);
                                                @define $youid = $matches[0]
                                                <a href="http://www.youtube.com/embed/{{$youid}}">
                                                    <img src="{{$row['ThumbNail']==""?"http://img.youtube.com/vi/".$youid."/0.jpg":$row['ThumbNail']}}" alt="{{$row["RemarkU"]}}">
                                                </a>
                                            @else
                                                @define $path = substr($row["LocationPath"],1);
                                                @define $path = ($path!=""?$path."/":"");
                                                @define $path = str_replace("\\","/","videos/".$path.$row["RemarkU"]);
                                                @define $path = str_replace("//","/",$path);
                                                @define $path = str_replace("+","%2B",$path);
                                                <a href="{{url($path)}}"><img src="{{$row['ThumbNail']==""?asset('packages/default/L3/images/no-img.png'):$row['ThumbNail']}}" alt="{{$row["RemarkU"]}}"></a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var hei = documentHeight - 265;
        var wid = documentWidth - 50;
        $("#modalW76F4031").find(".modal-dialog").width(wid);
        $("#sliderW76F4031").html5gallery({
            width:wid-56,
            height:hei
        });
    });

    $("#modalW76F4031").on('hidden.bs.modal', function () {
        $(this).data('bs.modal', null);
    });

    function closePopW76F4031(){
        $("#modalW76F4031").modal("hide");
        $("#modalW76F4031").html("");
    }

</script>
