@extends('weblink.layouts.layout')
@section('content')
    <div id="divContainer"></div>
    <div id="maintabs">
        <ul id="headermaintabs" class="scroll_tabs_theme_light" >

        </ul>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        var tabTemplate = "<li id='li#{id}' class='headertab' onclick='ActiveButton(this);' nametab='#{name}'>#{label}&nbsp;&nbsp;<a class='fa fa-info-circle btn-info-tab' data-toggle='tooltip' title='#{formactive}' onclick='ShowFormInfo(\"#{formactive}\",\"#{formtext}\",\"#{formpermission}\",\"#{formcall}\")'></a><span class='fa fa-times-circle btn-close-tab' onclick='removeTabmain(this);' title='{{Helpers::getRS($g,"Dongw")}}'></span></li>";
        var tabSet;
        var tabCount = 0;
        var docheight = $(window).height() - 60;
        $(function () {
            tabSet = $('#headermaintabs').scrollTabs();

            //script này được sinh ra khi gọi link từ mail
            var formType = "{{$formType}}";
            console.log(formType);
            switch (formType){
                case 'tab':
                    addTab('{{$formID}}', '{{$formActive}}', '{{$caption}}', '{{$moduleGroup}}');
                    break;
                case 'modal':
                        {{isset($script) ?  $script : ""}}
                        break;
                case 'approval':
                    {{isset($script) ?  $script : ""}}
                        break;
            }

            setInterval(function(){
                $("#myModal").find(".header-icon-close").addClass('hide');
                $("#myModal").find(".fa-info-circle").addClass('mgr5');
                $("#myModal").find(".btn-close-tab").addClass('hide');

            }, 500);
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





        $(document).ready(function () {
            documentWidth = $(document).width();
            documentHeight = $(document).height();

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

        function addTab(sFormID, sFormActive, text, modgroup) {
            $("#maintabs").removeClass("hide");
            $("#divListBookmark").addClass("hide");
            $("#divlabelBook").addClass("hide");
            text = $.trim(text);
            var tabid = document.getElementById("li" + sFormID);
            if (tabid == null) {
                var label = text,
                    li = tabTemplate.replace(/#\{id\}/g, sFormID).replace(/#\{label\}/g, label).replace(/#\{name\}/g, sFormID).replace(/#\{formactive\}/g, sFormActive).replace(/#\{formpermission\}/g, sFormID).replace(/#\{formcall\}/g, sFormActive).replace(/#\{formtext\}/g, text);
                $(".contenttab").addClass("hide");
                tabSet.addTab(li);
                $("#maintabs").append("<div style='overflow: auto;display:block;height:" + docheight + "px' id='div" + sFormID + "' class='contenttab'><i class='fa fa-refresh fa-spin'></i></div>");
                $("#div" + sFormID).load('{{URL::to('/')}}' + '/' + sFormActive + '/' + "view/" + sFormID + '/' + modgroup);
                tabCount++;
            }
            else {
                tabSet.selectTabs($(tabid));
            }
        }
    </script>
    @stop

<style>
    .content-wrapper, .right-side, .main-footer {
        margin-left: 0px !important;
    }
</style>

