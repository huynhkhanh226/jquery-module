@if (count($rsAlbumItem) > 0)
    @foreach($rsAlbumItem as $row )
        @define $src = $row['OriginalPhoto']
        @define $remark = $row['RemarkU']
        @define $id = $row['AlbumID']."_".$row['AlbumItemID']
        <div id="inner{{$id}}" class="item bg-black" style="width: 100%;height: 100%">
            <img src="{{$src}}" alt="No Image" style="display:inline;max-width:100%;height:100%;">
            <div class="carousel-caption">
                <h3 id="caption{{$id}}" style="display:none">{{$remark}}</h3>
            </div>
        </div>
    @endforeach
@endif