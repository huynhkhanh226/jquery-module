<div class="modal fade pd0" id="modalW76F4020" data-backdrop="static" role="dialog">
    <div id="test" class="modal-dialog" style="width:80%;">
        <div class="l3loadingCus hide">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW76F4020">
                <div class="modal-header logodg pdl0">
                    {{Helpers::generateHeading($caption,"W76F4020")}}
                </div>
                <div class="modal-body" style="height:450px;">
                    <div class="row" style="margin-right: -8px !important;">
                        <div class="col-md-7"></div>
                        <div class="col-md-5 mgt10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" class="form-control" id="txtfilter" name="txtfilter">
                            <span class="input-group-addon hide" onclick='$("#txtfilter").trigger({type: "keyup", which: 27});' id="cleartext"
                                  style="padding-left: 2px !important; padding-right: 2px !important; border: 1px #3c8dbc solid; border-left:none; border-right: 1px #ccc solid; cursor: pointer"><i
                                        class="glyphicon glyphicon-remove-2" style="font-size: 10px;"></i></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="iCount" value="{{count($rsListAlbum)}}">
                    @if (count($rsListAlbum)>0)
                        <div id="list_album" class="pdt10">
                            <div class="listalbum">
                                @define $index = 1
                                @foreach($rsListAlbum as $row)
                                    @define $id = $row['AlbumID']
                                    @define $albumName = $row['AlbumName']
                                    @define $image_count = $row['Quantity']
                                    @define (mb_strlen($albumName)>55)? $alname = mb_substr($albumName,0,55)."...":$alname=$albumName;
                                    @if ($image_count == 0)
                                        <a style="cursor: default" class="thumb-album">
                                            <figure>
                                                <div>
                                                    <img src="{{$row['Thumbnail']==""?asset('packages/default/L3/images/no-img.png'):$row['Thumbnail']}}"
                                                         alt="{{$albumName}}">
                                                </div>
                                                <figcaption title="{{$albumName}}">{{$alname}}</figcaption>
                                            </figure>
                                        </a>
                                    @else
                                        <a onclick="callShowImageList({{$id.',\''.$albumName.'\''}})" class="thumb-album">
                                            <figure>
                                                <div>
                                                    <img src="{{$row['Thumbnail']==""?asset('packages/default/L3/images/no-img.png'):$row['Thumbnail']}}"
                                                         alt="{{$albumName}}">
                                                </div>
                                                <figcaption title="{{$albumName}}">{{$alname}}</figcaption>
                                            </figure>
                                        </a>
                                    @endif
                                    @define $index += 1
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <div align="center">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Chua_co_album_nao_duoc_tao")}}</label>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row" style="bottom:-10px;position: absolute;right: 13px">
                        <div class="col-md-12">
                            <div id="pagW76F4020" class="pull-right"></div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.end form  -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<section id="secViewW76F4021">
</section>
<script type="text/javascript">
    var indxPaging = 1;
    function callShowImageList(id, albumName) {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: "W76F4021",
            data:{id:id,name:albumName},
            success: function (data) {
                $("#secViewW76F4021").html(data);
                $(".l3loading").addClass('hide');
                $("#modalW76F4021").modal("show");
            }
        });
    }

    var bNewW76F4020 = false;
    $(document).ready(function () {
        filterPaging($("#modalW76F4020").find("#txtfilter").val());
        bNewW76F4020 = true;
    });

    $("#modalW76F4020").on('keyup', "#txtfilter", function (e) {
        bNewW76F4020 = false;
        var code = e.keyCode || e.which;
        var firstClick = false;
        if (code == 13)
            firstClick = true;
        if (code == 27) {
            $(this).val('');
        }
        var vl = $(this).val();
        indxPaging = 1;
        filterPaging(vl);
        bNewW76F4020 = true;
    });

    function filterPaging(sfilter) {
        var list = $('.listalbum').find('.thumb-album');
        list.addClass("hide");
        var pg = Math.ceil(list.length / 10);
        if (sfilter == '') {
            list.attr("data-display", "show");
            for (var i = 0; i < 10; i++) {
                var idx = (indxPaging - 1) * 10 + i;
                $(list[idx]).removeClass('hide');
            }
        }
        else {
            list.each(function () {
                var desc = $(this).find('figcaption').text();
                var descbodau = locdau(desc);
                var vlbodau = locdau(sfilter);
                if (desc.toLowerCase().indexOf(sfilter.toLowerCase()) > -1 || descbodau.indexOf(vlbodau) > -1) {
                    $(this).attr("data-display", "show");
                }
                else {
                    $(this).removeAttr("data-display");
                }
            });
            var rlist = $('.listalbum').find('.thumb-album[data-display=show]');
            pg = Math.ceil(rlist.length / 10);
            for (var i = 0; i < 10; i++) {
                var idx = (indxPaging - 1) * 10 + i;
                $(rlist[idx]).removeClass('hide');
            }
        }
        if (pg > 1) {
            $('#pagW76F4020').removeClass('hide');
            if ($('#pagW76F4020').data("twbs-pagination"))
                $('#pagW76F4020').twbsPagination('destroy');
            $('#pagW76F4020').twbsPagination({
                totalPages: pg,
                visiblePages: 8,
                startPage: indxPaging,
                initiateStartPageClick: false,
                onPageClick: function (event, page) {
                    indxPaging = page;
                    if (bNewW76F4020)
                        filterPaging($("#modalW76F4020").find("#txtfilter").val());
                },
                first: 'Trang đầu',
                prev: 'Trước',
                next: 'Sau',
                last: 'Trang cuối'
            });
        } else {
            $('#pagW76F4020').addClass('hide');
        }
    }
</script>


