<style>
    .menu-icon-custom{
        width: 26px !important;
        height: 26px !important;
        line-height: 29px !important;
    }
    .right-bar{
        background-color: #185571 !important;
        border-radius: 0px 0px 0px 10px;
        border: 1px solid #c9cccf;
    }
</style>
<aside class="control-sidebar control-sidebar-dark right-bar">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class=""><a href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="false"><i
                        class="fa fa-wrench"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading" style="padding:0px">Hiển Thị</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a onclick="loadReportTypeLst('0')">
                        <i class="menu-icon fa fa-th-list bg-olive menu-icon-custom"></i>

                        <div class="menu-info" style="margin-top: 9px;">
                            <h4 class="control-sidebar-subheading">Danh sách</h4>
                        </div>
                    </a>
                </li>
                <li>
                    <a onclick="loadReportTypeLst('1')">
                        <i class="menu-icon fa fa-th-large bg-olive menu-icon-custom"></i>

                        <div class="menu-info" style="margin-top: 9px;">
                            <h4 class="control-sidebar-subheading">Hình ảnh</h4>
                        </div>
                    </a>
                </li>
                <li>
                    <a onclick="thuGon();">
                        <i class="menu-icon fa fa-compress bg-olive menu-icon-custom"></i>

                        <div class="menu-info" style="margin-top: 9px;">
                            <h4 class="control-sidebar-subheading">Thu gọn</h4>
                        </div>
                    </a>
                </li>
                <li>
                    <a onclick="detail()">
                        <i class="menu-icon fa fa-expand bg-olive menu-icon-custom"></i>

                        <div class="menu-info" style="margin-top: 9px;">
                            <h4 class="control-sidebar-subheading">Mở rộng</h4>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
<script>
    function thuGon(){
        console.log("thu gon");
        //$('.list-item').addClass('hide');
        $('aside').removeClass('control-sidebar-open');
        $(".report-header").each(function( index ) {
            if ($(this).hasClass("fa-minus-square-o")){
                console.log(index);
                $(this).trigger('click');
            }

        });
        $('.cls-display').toggleClass('show')
    }

    function detail(){
        //console.log("chi tiet");
        //$('.list-item').removeClass('hide');
        $('aside').removeClass('control-sidebar-open');
        $(".report-header").each(function( index ) {
            if ($(this).hasClass("fa-plus-square-o")){
                $(this).trigger('click');
            }
        });
        $('.cls-display').toggleClass('show')
    }
</script>