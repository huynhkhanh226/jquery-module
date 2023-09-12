<div class="row">
    <div class="col-md-12">
        @if (count($rsImageList) > 0)
            <div id="slider1_container" style="position: relative; top: 0; left: 0;">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="border-radius: 8px !important;">
                    <div class="loadimage hide text-center" style="background-color: #000">
                        <i class="fa fa-refresh fa-spin white-text" style="font-size: 200%;"></i>
                    </div>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox" style="text-align: center;vertical-align: middle;">
                    </div>
                </div>
                <!-- Thumbnail -->
                <div id="myCaption" class="carousel slide bg-black text-white" data-ride="carousel"
                     style="height: 25px;">
                    <div class="row">
                        <div class="col-sm-10">
                            <p id="idCaption"></p>
                        </div>
                        <div class="col-sm-2">
                            <span class="pull-right"><div id="idIndex"></div></span>
                            <input type="hidden" id="idTotal" value="{{count($rsThumbnailList)}}"/>
                        </div>

                    </div>
                </div>
                <!-- Thumbnail -->
                <div id="myThumbnail" class="carousel slide pdl5 pdt5" data-ride="carousel"
                     style="height: 75px;border-radius: 8px;border:1px solid">
                    <div id="srollerThumbnail" style="overflow-x: auto;display: inline-flex">
                        @define $i = 0
                        @foreach($rsThumbnailList as $row )
                            @define $thumb = $row['ThumbNail']
                            @define $albumID = $row['AlbumID']
                            @define $albumItemID = $row['AlbumItemID']
                            @define $idItem = $row['AlbumID']."_".$row['AlbumItemID']
                            @if ($i == 0)
                                <div id="thumbs{{$idItem}}" class="active pdl5 pull-left first-img" onclick="loadItem(this)">
                                    <img src="{{$thumb}}" alt="No Image" width="80px" height="60px" style="padding: 5px;" class="thumbnail_active">
                                    <input type="hidden" id="AlbumID{{$albumID}}" value="{{$albumID}}"/>
                                    <input type="hidden" id="AlbumItemID{{$albumItemID}}" value="{{$albumItemID}}"/>
                                </div>
                            @else
                                <div id="thumbs{{$idItem}}" class="pull-left" onclick="loadItem(this)">
                                    <img src="{{$thumb}}" alt="No Image" width="80px" height="60px" class="pointer" style="padding: 5px">
                                    <input type="hidden" id="AlbumID{{$albumID}}" value="{{$albumID}}"/>
                                    <input type="hidden" id="AlbumItemID{{$albumItemID}}" value="{{$albumItemID}}"/>
                                </div>
                            @endif
                            @define $i = $i + 1
                        @endforeach
                    </div>
                </div>
                <!-- Left and right controls for image -->
                <a class="left carousel-control" onclick="thumb_prev()">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" onclick="thumb_next()">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        @endif
    </div>
</div>