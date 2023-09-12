@if (count($rsImageList)> 0)
    @foreach($rsImageList as $row )
        @define $id = $row["AlbumItemID"]
        @define $remark = $row["RemarkU"]
        @define $src = $row["ThumbNail"]
        <table style= 'float:left' cellpadding='0' cellspacing='0' style='margin-bottom:5px'>
        <tr>
        <td style='padding: 0px !important; ' colspan='2'><img src='{{$src}}' height='100px' style='margin:5px 0px 5px 5px;border-radius:3px'/></td>
        </tr>
        <tr style='height:25px'>
        <td style='padding: 0px !important;' ><i class='three_dot' title='{{$remark}}'>{{$remark}}</i></td>
        <td style='padding: 0px !important;text-align:right' ><i class='fa fa-edit mgr5 ' style='margin-left:10px;font-size:1em' onClick='callShowPopEditCaption("{{$id}}","{{$remark}}")'></i><i class='fa fa-remove mgr5 ' style='font-size:1.2em;padding-right:0px' onClick='remove_image("{{$id}}")' ></i></td>
        </tr>
        </table>
    @endforeach
@endif
<script>
    $(document).ready(function () {
        var imageListWidth = $("#imageList").width();
        var itemWith = imageListWidth / 5 - 10 + 'px';
        var itemHeight = itemWith - 10;
        $("#imageList img").each(function () {
            $(this).width(itemWith);
        });

        $("#modalPictureDetail").find("#imageList").mCustomScrollbar(
        {
            theme: "rounded-dots",
            scrollInertia: 400

        });
    });

</script>


