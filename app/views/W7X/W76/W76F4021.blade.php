<div class="modal fade pd0" id="modalW76F4021" data-backdrop="static" role="dialog">
    <div id="test" class="modal-dialog formduyet">
        <div class="l3loadingCus hide">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <div class="modal-content bg-black">
            <!-- form start -->
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($modalTitle,"W76F4021",true,"closePopW76F4021")}}
            </div>
            <div class="modal-body bg-black">
                @include('W7X.W76.W76F4021_Slider')
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<script type="text/javascript">
    function thumb_next() {
        var div = $("#srollerThumbnail").find("div.active").next();
        loadItem(div);
    }

    function loadItem(div){
        if ($(div).index() >= 0) {
            $("#idIndex").html($(div).index() + 1 + "/" + $("#idTotal").val());
            if (div != "") {
                var albumID = $(div).find("input[type='hidden']").eq(0).val();
                var albumItemID = $(div).find("input[type='hidden']").eq(1).val();
                var idindicators = "#indicators" + albumID + "_" + albumItemID;
                var idinner = "#inner" + albumID + "_" + albumItemID;
                var idCaption = "#caption" + albumID + "_" + albumItemID;
                if (albumID != "") {
                    if ($(idinner).length == 0) {
                        var height = $(".carousel-inner").height();
                        $(".loadimage").css("height", height);
                        $(".loadimage").css("paddingTop", height / 2 - 20);
                        $(".loadimage").removeClass('hide');
                        $(".carousel-inner").addClass('hide');
                        $(".carousel-inner").css("height", height);
                        $.ajax({
                            method: 'POST',
                            url: "W76F4021/show",
                            data:{albumID:albumID, albumItemID:albumItemID},
                            success: function (data) {
                                $(".loadimage").addClass('hide');
                                $(".carousel-inner").removeClass('hide');
                                $(".carousel-inner").append(data);

                                //Focus thumbnail
                                $("div").each(function () {
                                    $(this).find("img").eq(0).removeClass("thumbnail_active");
                                    $(this).removeClass("active");
                                });
                                $(div).find("img").eq(0).addClass("thumbnail_active");
                                $("#srollerThumbnail").find("div").each(function () {
                                    $(this).removeClass("active");
                                });
                                $(div).addClass("active");

                                //Focus indicator
//                                $(".carousel-indicators").find("li").each(function () {
//                                    $(this).removeClass("active");
//                                });
//                                $(idindicators).addClass("active");

                                //Focus image
                                $(".carousel-inner").find("div").each(function () {
                                    $(this).removeClass("active");
                                });
                                $(idinner).addClass("active");
                                $("#idCaption").html($(idCaption).html());
                            }

                        });
                    } else {
                        //Focus thumbnail
                        $("div").each(function () {
                            $(this).find("img").eq(0).removeClass("thumbnail_active");
                        });
                        $(div).find("img").eq(0).addClass("thumbnail_active");
                        $("#srollerThumbnail").find("div").each(function () {
                            $(this).removeClass("active");
                        });
                        $(div).addClass("active");

                        //Focus indicator
                        $(".carousel-indicators").find("li").each(function () {
                            $(this).removeClass("active");
                        });
                        $(idindicators).addClass("active");
                        //Focus image
                        $(".carousel-inner").find("div").each(function () {
                            $(this).removeClass("active");
                        });
                        $(idinner).addClass("active");
                        $("#idCaption").html($(idCaption).html());
                    }
                }
            }
        }
    }

    function thumb_prev() {
        var div = $("#srollerThumbnail").find("div.active").prev();
        loadItem(div);
    }

    $(document).ready(function () {
        $("#modalW76F4021").find(".carousel-inner").height(documentHeight-165);
        $("#modalW76F4021").find(".carousel-control").height(documentHeight-165);
        $("#modalW76F4021").find("#srollerThumbnail").width(documentWidth-40);
        var div = $("#srollerThumbnail>div").first();
        loadItem(div);
        $("#srollerThumbnail").niceScroll();
    });

    function closePopW76F4021(){
        $("#modalW76F4021").modal("hide");
        $("#modalW76F4021").html("");
    }

</script>


