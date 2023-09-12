<div class="modal draggable fade" id="mPopFormInfo" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Thong_tin"),"",false,"closeFormInfoPop")}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9 mgt10 mgb5"><label>  {{$fcall}}  -  {{$fname}}</label></div>
                    @if ($pform!="" && $factive != "")
                        <div class="col-md-3 mgt10">
                            @if (count($connection->Select("Select top 1 FormCall From D91T8880 WITH(NOLOCK) Where FormID='$pform' and UserID='".Auth::user()->user()->UserID."'")) <= 0)
                                <button type="button" id="btnAddBookmark" onclick="addBook();" class="btn btn-default smallbtn pull-right">
                                    <span class="glyphicon glyphicon-star"></span>&nbsp;{{Helpers::getRS($g,"Them_vao_bookmark")}}
                                </button>
                                <button type="button" id="btnDelBookmark" onclick="delBook();"
                                        class="btn btn-default smallbtn pull-right hide"><span
                                            class="glyphicon glyphicon-bookmark"></span>&nbsp;{{Helpers::getRS($g,"Xoa_bookmark")}}
                                </button>
                            @else
                                <button type="button" id="btnAddBookmark" onclick="addBook();"
                                        class="btn btn-default smallbtn pull-right hide "><span
                                            class="glyphicon glyphicon-star"></span>&nbsp;{{Helpers::getRS($g,"Them_vao_bookmark")}}
                                </button>
                                <button type="button" id="btnDelBookmark" onclick="delBook();" class="btn btn-default smallbtn pull-right ">
                                    <span class="glyphicon glyphicon-bookmark"></span>&nbsp;{{Helpers::getRS($g,"Xoa_bookmark")}}
                                </button>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if ($fcall == "W05F1602")
                            @include("W0X/W05/W05F1602_Info")
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var closeFormInfoPop = function () {
        $("#mPopFormInfo").modal('hide');
    };

    var addBook = function () {
        $.ajax({
            method: "POST",
            url: "{{url('bookmark')}}",
            data: {pform: '{{$pform}}', fcall: '{{$fcall}}', factive: '{{$factive}}'},
            success: function (data) {
                $("#btnDelBookmark").removeClass("hide");
                $("#btnAddBookmark").addClass("hide");
                addItemBookmark(data);
                innol = $("#olListBookmark").html();
                var text = innol.replace(/hide|item-book/g , "");
                $("#ulListBookmark").html(text)
            }
        });
    };

    var delBook = function () {
        $.ajax({
            method: "DELETE",
            url: "{{url('bookmark')}}",
            data: {pform: '{{$pform}}', fcall: '{{$fcall}}', factive: '{{$factive}}'},
            success: function (data) {
                $("#btnDelBookmark").addClass("hide");
                $("#btnAddBookmark").removeClass("hide");
                delItemBookmark("li{{$pform}}");
                innol = $("#olListBookmark").html();
                var text = innol.replace(/hide|item-book/g , "");
                $("#ulListBookmark").html(text)
            }
        });
    };
</script>