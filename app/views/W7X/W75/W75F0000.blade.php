<section class="content" id="secW75F1005">
    <div class="row mgt5" >
        <div class="col-md-12">
            <section class="content affectW75F0000" id="secW76F0000" style="margin-top: 50px">
                @if (isset($menuList))
                    @define $col = 1;
                    @foreach($menuList as $menuItem)
                        @if ($col == 4)
                            @define $col = 1;
                        @endif
                        @if ($col == 1)
                                <div class="row" style="margin-bottom: 20px;">
                        @endif
                                <div class="col-md-4 mgt10 text-center eoffice">
                                    @if ($menuItem["FormIDIcon"] == "")
                                        @define $srcImage = asset("packages/default/L3/images/no-image-circle.png");
                                    @else
                                        @define $srcImage = asset("packages/default/L3/images/".$menuItem["FormIDIcon"]);
                                    @endif

                                        @if ($menuItem['FormActive'] == $menuItem['FormCall'])
                                            <figure id = "iconAnimationESS" onclick="showFormDialog('{{url("/".$menuItem["FormActive"]."/".$menuItem["FormID"]."/4")}}','modal{{$menuItem["FormActive"]}}')">
                                                <div>
                                                    <img style="border-radius: 5px" alt="No Image" src="{{$srcImage}}">
                                                </div>
                                                <figcaption>{{$menuItem["FormDesc"]}}</figcaption>
                                            </figure>
                                        @else
                                            <!-- Day la truong hop duyet -->
                                            <figure id = "iconAnimationMSS" onclick="showFormDialog('{{url( $menuItem['FormActive'] . "/" . $menuItem['FormID']. "/" . $menuItem['FormCall'] . "/" .  $menuItem['ModuleGroup'].'/'.$menuItem['ModuleID'])}}','modalW84F2020')">
                                                <div>
                                                    <img style="border-radius: 5px" alt="No Image" src="{{$srcImage}}">
                                                </div>
                                                <figcaption>{{$menuItem["FormDesc"]}}</figcaption>
                                            </figure>
                                        @endif
                                </div>
                         @if ($col == 3)
                                </div>
                         @endif
                         @define $col = $col + 1;
                    @endforeach
                @endif
            </section>
        </div>
    </div>


</section>
<script type="text/javascript">
    $(document).ready(function () {
        AnimateLeft();
        //$(".eoffice").animate({left:'0px'},500);
    });

    function AnimateLeft() {
        var parent = $('.affectW75F0000').parent();
        console.log(parent);
        var rows = $(parent).find('.row');
        $(parent).find('.affectW75F0000').removeClass("affectW75F0000");
        //reset(rows);
        var i = 0;
        console.log(rows);
        $.each(rows, function (key, value) {
            console.log(value);
            setTimeout(function () {
                $(value).animate({left:'0px'},500,function(){
                    //reset the transform property
                    //alert("sdsd");
                });
            },i);
            i = i + 100;
        });
    }
</script>