<section class="content affectW76F0000" id="secW76F0000">
    <div class="row">
        <div class="col-md-3 col-xs-6 mgt10 text-center eoffice">
            <figure onclick="showFormDialog('{{asset("W76F4020/W76F4020/4")}}','modalW76F4020')">
                <div>
                    <img src="{{url("packages/default/L3/images/photo-library.png")}}">
                </div>
                <figcaption>{{Helpers::getRS($g,"Thu_vien_anh")}}</figcaption>
            </figure>
        </div>
        <div class="col-md-3 col-xs-6 mgt10 text-center eoffice">
            <figure onclick="showFormDialog('{{asset("W76F4030/W76F4030/4")}}','modalW76F4030')">
                <div>
                    <img src="{{url("packages/default/L3/images/video-playlist.png")}}">
                </div>
                <figcaption>{{Helpers::getRS($g,"Thu_vien_video")}}</figcaption>
            </figure>
        </div>
        <div class="col-md-3 col-xs-6 mgt10 text-center eoffice">
            <figure onclick="showFormDialog('{{asset("W76F4040/W76F4040/4")}}','modalW76F4040')">
                <div>
                    <img src="{{url("packages/default/L3/images/audio-playlist.png")}}">
                </div>
                <figcaption>{{Helpers::getRS($g,"Thu_vien_audio")}}</figcaption>
            </figure>
        </div>
        <div class="col-md-3 col-xs-6 mgt10 text-center eoffice">
            <figure onclick="showFormDialog('{{asset("W76F4010/W76F4010/4")}}','modalW76F4010')">
                <div>
                    <img src="{{url("packages/default/L3/images/phonebook.png")}}">
                </div>
                <figcaption>{{Helpers::getRS($g,"Danh_ba_dien_thoaiU")}}</figcaption>
            </figure>
        </div>
    </div>
    <div class="row pdt10">
        <div class="col-md-3 col-xs-6 mgt10 text-center eoffice">
            <figure onclick="showFormDialog('{{asset("W76F4050/4")}}','modalW76F4050')">
                <div>
                    <img src="{{url("packages/default/L3/images/meeting-book.png")}}">
                </div>
                <figcaption>{{Helpers::getRS($g,"Booking_phong_hop")}}</figcaption>
            </figure>
        </div>
        <div class="col-md-3 col-xs-6 mgt10 text-center eoffice">
            <figure onclick="showFormDialog('{{asset("W76F4060/W76F4060/4")}}','modalW76F4060')">
                <div>
                    <img src="{{url("packages/default/L3/images/documents.png")}}">
                </div>
                <figcaption>{{Helpers::getRS($g,"He_thong_tai_lieu")}}</figcaption>
            </figure>
        </div>
        <div class="col-md-3 col-xs-6 mgt10 text-center eoffice">
            <figure onclick="showFormDialog('{{asset("W76F4070/D76F4070/4")}}','modalW76F4070')">
                <div>
                    <img src="{{url("packages/default/L3/images/tasks-icon.png")}}">
                </div>
                <figcaption>{{Helpers::getRS($g,"Quan_ly_cong_viec")}}</figcaption>
            </figure>
        </div>
        <div class="col-md-3 col-xs-6 mgt10 text-center eoffice">
            <figure onclick="showFormDialog('{{asset("W76F2110/D76F2110/4")}}','modalW76F2110')">
                <div>
                    <img src="{{url("packages/default/L3/images/w76-plan.jpg")}}">
                </div>
                <figcaption>{{Helpers::getRS($g,"Ke_hoach_lam_viec")}}</figcaption>
            </figure>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        AnimateLeft();
        //$(".eoffice").animate({left:'0px'},500);
    });

    function AnimateLeft() {
        var parent = $('.affectW76F0000').parent();
        console.log(parent);
        var rows = $(parent).find('.row');
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