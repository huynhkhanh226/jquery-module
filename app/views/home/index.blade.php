@extends('layout.layout')
@section('content')
    <div id="divlabelBook" class="col-md-12 {{$ls1==""?"hide":""}}" style="display: inline-flex;margin-left: 43.5%">
        <h4 style="color: #87CEEB;" class="text-bold">Bookmarks</h4>

        <div class="mgl10">
            <span class="fa fa-edit text-orange edit-book hide" title="{{Helpers::getRS(0,"Sua")}}"></span>
            <span class="fa fa-remove text-red cancel-book hide" title="{{Helpers::getRS(0,"Huy_bo")}}"></span>
            <span class="fa fa-floppy-o text-blue save-book hide" title="{{Helpers::getRS(0,"Luu")}}"
                  style="margin-right: 0.5em;"></span>
        </div>
    </div>
    <div id="divListBookmark" class="col-md-12 pdr0">
        <ol id="olListBookmark" class="rounded-list">
            {{$ls1}}
        </ol>
    </div>
    <div id="divBinBookmark" class="hide" style="font-size: 25px;text-align: center"
         title="{{Helpers::getRS(0,"Keo_tha_bookmark_vao_day_de_xoa")}}">
        <span class="fa fa-trash" style="opacity: 0.2;cursor: default;"></span>
    </div>
    <div id="maintabs" class="hide">
        <ul id="headermaintabs" class="scroll_tabs_theme_light">

        </ul>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        var tabTemplate = "<li id='li#{id}' class='headertab' onclick='ActiveButton(this);' nametab='#{name}'>#{label}&nbsp;&nbsp;<a class='fa fa-info-circle btn-info-tab' data-toggle='tooltip' title='#{formactive}' onclick='ShowFormInfo(\"#{formactive}\",\"#{formtext}\",\"#{formpermission}\",\"#{formcall}\")'></a><span class='fa fa-times-circle btn-close-tab' onclick='removeTabmain(this);' title='{{Helpers::getRS($g,"Dongw")}}'></span></li>";
        var tabSet;
        var tabCount = 0;
        var docheight = $(window).height() - 110;
        var modeBookmark = 0;
        var countBookmark = {{$countBookmark}};
        $(function () {
            tabSet = $('#headermaintabs').scrollTabs();
        });

        $("#divListBookmark").hover(
            function () {
                if (modeBookmark == 0)
                    $(".edit-book").removeClass("hide");
            }, function () {
                $(".edit-book").addClass("hide");
            }
        );

        $("#divlabelBook").hover(
            function () {
                if (modeBookmark == 0)
                    $(".edit-book").removeClass("hide");
            }, function () {
                $(".edit-book").addClass("hide");
            }
        );

        var removeIntent = false;
        var arrRemove = [];

        function editBookmark(bEdit) {
            if (bEdit) {
                $("#olListBookmark").sortable({
                    dropOnEmpty: true,
                    over: function () {
                        removeIntent = false;
                        $("#divBinBookmark>span").removeClass("over");
                    },
                    out: function () {
                        $("#divBinBookmark>span").addClass("over");
                        removeIntent = true;
                    },
                    beforeStop: function (event, ui) {
                        if (removeIntent == true) {
                            var a = $(ui.item).find("a");
                            arrRemove.push([a.attr("formid"), a.attr("formactive")]);
                            ui.item.remove();
                        }
                        $("#divBinBookmark>span").removeClass("over");
                    },
                    stop: function (event, ui) {
                        $("#divBinBookmark>span").removeClass("over");
                    }
                });
                $("#olListBookmark").disableSelection();
            } else {
                $("#olListBookmark").sortable("destroy");
                $("#olListBookmark").enableSelection();
            }
        }

        $(".edit-book").on("click", function () {
            modeBookmark = 1;
            arrRemove = [];
            editBookmark(true);
            $(".edit-book").addClass("hide");
            $(".save-book").removeClass("hide");
            $(".cancel-book").removeClass("hide");
            $("#divBinBookmark").removeClass("hide");
            $("a").addClass('no-action');
        });

        $(".save-book").on("click", function () {
            var arr = [];
            $('.item-book').each(function (i, obj) {
                var itm = [$(obj).attr("formid"), $(obj).attr("formactive")];
                arr.push(itm);
            });
            $.ajax({
                method: "POST",
                url: "{{url("editbook")}}",
                data: {arr: arr, arrRemove: arrRemove},
                success: function (data) {
                    console.log(data);
                    if(Number(data) < 1){//nếu xóa hết bookmark
                        $("#idEss").trigger('click');//mở tab ESS
                    }
                    modeBookmark = 0;
                    arrRemove = [];
                    editBookmark(false);
                    $("a").removeClass('no-action');
                    $(".edit-book").removeClass("hide");
                    $(".save-book").addClass("hide");
                    $(".cancel-book").addClass("hide");
                    $("#divBinBookmark").addClass("hide");
                    innol = $("#olListBookmark").html();
                    var text = innol.replace(/hide|item-book/g, "");
                    $("#ulListBookmark").html(text)
                }
            });
        });

        var innol = "{{htmlentities($ls1)}}";
        $(".cancel-book").on("click", function () {
            $("a").removeClass('no-action');
            var decoded = $('<textarea/>').html(innol).text();
            $("#olListBookmark").html(decoded);
            editBookmark(false);
            modeBookmark = 0;
            $(".edit-book").removeClass("hide");
            $(".save-book").addClass("hide");
            $(".cancel-book").addClass("hide");
            $("#divBinBookmark").addClass("hide");
        });

        $(document).on("click", ".menuitem", function () {
            var formid = this.attributes["formid"].value;
            var formcall = this.attributes["FormCall"].value;
            var formactive = this.attributes["FormActive"].value;
            var id = formid + "_" + formactive + "_" + formcall;
            addTab(id, this.text, this.attributes["modulegroup"].value);
        });

        function ActiveButton(but, parenttab) {
            var id = $(but).attr("id");
            if (document.getElementById(id) !== null) {
                if (parenttab !== undefined) {
                    $("#" + parenttab + " .contenttab").addClass("hide");
                }
                else $(".contenttab").addClass("hide");
                $("#div" + $(but).attr('nametab')).removeClass("hide");
            }
        }

        function removeTabmain(id) {
            tabSet.removeTabs("li#" + $(id).parent().attr('id'));
            tabCount--;
            if (tabCount == 0) {
                $("#maintabs").addClass("hide");
                var count = $("#olListBookmark").children().length;
                if (count > 0) {
                    $("#divListBookmark").removeClass("hide");
                    $("#divlabelBook").removeClass("hide");
                }
            }
        }

        function addTab(sFormID, text, modgroup) {
            $("#maintabs").removeClass("hide");
            $("#divListBookmark").addClass("hide");
            $("#divlabelBook").addClass("hide");
            text = $.trim(text);
            var tabid = document.getElementById("li" + sFormID);
            var arr = sFormID.split("_");
            var sFormActive = arr[1];
            var sFormPer = arr[0];
            if (tabid == null) {
                var label = text,
                    li = tabTemplate.replace(/#\{id\}/g, sFormID).replace(/#\{label\}/g, label).replace(/#\{name\}/g, sFormID).replace(/#\{formactive\}/g, sFormActive).replace(/#\{formpermission\}/g, sFormPer).replace(/#\{formcall\}/g, sFormActive).replace(/#\{formtext\}/g, text);
                $(".contenttab").addClass("hide");
                tabSet.addTab(li);
                $("#maintabs").append("<div style='overflow: auto;display:block;height:" + docheight + "px' id='div" + sFormID + "' class='contenttab'><i class='fa fa-refresh fa-spin'></i></div>");
                $("#div" + sFormID).load('{{URL::to('/')}}' + '/' + sFormActive + '/' + "view/" + sFormPer + '/' + modgroup);
                tabCount++;
            }
            else {
                tabSet.selectTabs($(tabid));
            }
        }

        function ShowFormInfo(formcall, name, pform, factive) {
            $.ajax({
                method: "GET",
                url: "{{url("info")}}/" + formcall,
                data: {name: name, pform: pform, factive: factive},
                success: function (data) {
                    $("#modalFormInfo").html(data);
                    $("#mPopFormInfo").modal('show');
                }
            });
        }

        //script này được sinh ra khi gọi link từ mail
        {{isset($script) ?  $script : ""}}

        $(document).on("DOMSubtreeModified", "#myModal, #maintabs, #myModal02, #myModal03,#myModal04,#myModal05", function () {
            var elements = $(this).find("input:required, textarea:required, select:required");
            //console.log(elements);
            for (var i = 0; i < elements.length; i++) {
                if ($(elements[i]).hasClass('noUseValidHTML5') == false) {
                    //console.log(elements[i]);
                    elements[i].oninvalid = function (e) {
                        console.log(e.target);
                        if ($(e.target).val() == "") {
                            e.target.setCustomValidity("{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}");
                        } else {
                            e.target.setCustomValidity("");
                        }
                    };
                    elements[i].oninput = function (e) {
                        e.target.setCustomValidity("");
                    };
                    elements[i].onfocus = function (e) {
                        //e.target.setCustomValidity("");
                    };
                }
            }

            var elements_demo = $(this).find("select:required");
            for (var j = 0; j < elements_demo.length; j++) {
                if ($(elements_demo[j]).hasClass('noUseValidHTML5') == false) {
                    //console.log(elements_demo[j]);
                    elements_demo[j].oninvalid = function (e) {
                        if ($(e.target).val() == "" || $(e.target).val() == null) {
                            e.target.setCustomValidity("{{Helpers::getRS($g,"Ban_chua_chon_du_lieu")}}");
                        } else {
                            e.target.setCustomValidity("");
                        }
                    };
                    elements_demo[j].onchange = function (e) {
                        e.target.setCustomValidity("");
                    };
                }
            }
        });


        $(document).ready(function () {
            documentWidth = $(document).width();
            documentHeight = $(document).height();
            tabMainHeight = docheight;
                    @if(Config::get('app.checkLicense') != false)
            var interval = "{{Config::get('services.diginet.connect_interval')}}";
            setInterval(function () {
                $.ajax({
                    method: "POST",
                    url: '{{url('checklicence')}}',
                    success: function (data) {
                        if (data != '0') {
                            var msg = '';
                            switch (data) {
                                case '1' :
                                    msg = '{{Helpers::getRS(0,'May_chu_License_da_bi_khoi_dong_lai_Vui_long_dang_nhap_lai_ket_noi')}}';
                                    break;
                                case '2' :
                                    msg = '{{Helpers::getRS(0,'Nguoi_dung_nay_da_bi_yeu_cau_thoat_boi_Quan_tri_Lemon3_Vui_long_dang_nhap_lai_ket_noi')}}';
                                    break;
                                case '3' :
                                    msg = '{{Helpers::getRS(0,'Khong_the_ket_noi_duoc_may_chu_Licence._Vui_long_kiem_tra_lai_thong_tin_ket_noi')}}';
                                    break;
                                case '4':
                                    msg = '{{Helpers::getRS(0,'Nguoi_dung_nay_da_dang_nhap_o_noi_khac')}}';
                                    break;
                            }
                            alert_warning(msg, function () {
                                window.location = '{{url('/logout')}}';
                            });
                        }

                    }
                });
            }, Number(interval) * 1000);// tính theo Milisecond

            @endif
            //alert(interval);
            //get các error lỗi của ajax trên toàn site
            $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
                if (jqxhr.status === 401) {
                    window.location = '{{url('/login')}}';

                }
                else {
                    //console.log("Error: " + jqxhr.responseText);
                    //console.log(new Date());
                }
            });

            /*$(document).ajaxComplete(function () {
                var elements = $("#maintabs").find("input, textarea");
                ////console.log(elements);
                for (var i = 0; i < elements.length; i++) {
                    //console.log(elements[i]);
                    if ($(elements[i]).hasClass('noUseValidHTML5') == false) {//Khanh cheat
                        elements[i].oninvalid = function (e) {
                            if (!e.target.validity.valid) {
                                e.target.setCustomValidity("{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}");
                            }else{
                                e.target.setCustomValidity("");
                            }
                        };
                        elements[i].oninput = function (e) {
                            e.target.setCustomValidity("");
                        };
                        elements[i].onfocus = function (e) {
                            //e.target.setCustomValidity("");
                        };
                    }
                }

                var elements_demo = $("#maintabs").find("select");
                for (var j = 0; j < elements_demo.length; j++) {
                    //console.log(elements[j]);
                    if ($(elements_demo[j]).hasClass('noUseValidHTML5') == false) {
                        elements_demo[j].oninvalid = function (e) {
                            if (!e.target.validity.valid) {
                                e.target.setCustomValidity("{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}");
                            }else{
                                e.target.setCustomValidity("");
                            }
                        };
                        elements_demo[j].onchange = function (e) {
                            e.target.setCustomValidity("");
                        };
                    }

                }
            });*/


            //Điểu chỉnh scrollbar cho menu chính
            $(".main-sidebar").find(".sidebar").height(docheight + 60);
            @if (\Config::get("app.debug") == true)
                $(".main-sidebar").find(".sidebar").css('overflow-y','auto');
            @else
                $(".main-sidebar").find(".sidebar").mCustomScrollbar({
                    axis: "y",
                    scrollButtons: {enable: true},
                    theme: "minimal-dark",
                    //scrollbarPosition: "outside",
                    scrollInertia: 50
                });
            @endif

            setInterval(function () {
                $(".main-sidebar").find(".sidebar").height(docheight + 60);
            }, 300);
            //End
            console.log(countBookmark);
            if (countBookmark < 1) {//Nếu không có bookmark thì mặc định mở tab ESS
                $("#idEss").trigger('click');
            }
            //Nếu như left menu không có menu nào thì cho thu gọn menu đi
            if ($(".main-sidebar").find(".sidebar-menu li").length == 0) {//Nếu left sidebar không có menu thì thu gọn left sidebar
                $(".main-header").find(".sidebar-toggle").trigger('click');
            } else {
                //$("#idEss").trigger('click');
            }

            <?php //\Debugbar::enable(); ?>


            //Xóa file tạm
            setInterval(function () {
                $.ajax({
                    method: "POST",
                    url: '{{url('audit')}}',
                    success: function (data) {
                        //console.log(data);
                    }
                });
            }, Number(1800000));// tính theo Milisecond // 30 phút quét 1 lần


        });

        function addItemBookmark(li) {
            $('#olListBookmark').prepend(li);
            if (tabCount == 0)
                $("#divlabelBook").removeClass("hide");
        }

        function delItemBookmark(id) {
            $("#olListBookmark").find("#" + id).remove();
        }

    </script>
@stop

