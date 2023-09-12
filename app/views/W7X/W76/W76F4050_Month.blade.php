@if (count($rsTime)>0)
    <div class="ft_container" id="divContainerW76F4050" style="width: 100%;">
        <div class="ft_rel_container">
            <table class="ft_rc" style="width: 49px;">
                <thead>
                <tr>
                    <th style="height: 29px;background-color: #357CA5;"><a onclick="showWFacilityDetail();">
                            <span class="digi digi-info text-white" title="Information"></span></a>
                    </th>
                </tr>
                </thead>
            </table>
            <div class="ft_cwrapper heightW76F4050M" style="width: 49px;">
                <table class="ft_c ca-booking-day" id="tabLeftW76F4050M" style="width: 49px; top: 0px;">
                    <thead>
                    <tr>
                        <th style="width: 30px;height: 29px;">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rsTime as $row)
                        <tr class="ui-widget-content">
                            <td class="hour" data-hour="{{number_format($row["Value"],1)}}">{{$row["Display"]}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="ft_rwrapper widthW76F4050M">
                <table class="ft_r widthW76F4050M" style="left: 0px;">
                    <thead>
                    {{$header}}
                    </thead>
                </table>
            </div>
            <div class="ft_scroller heightW76F4050M" id="scrollW76F4050M" style="border:solid 1px #ddd">
                <table id="tableW76F4050MMain" class="ca-booking-day" style="width: auto">
                    <thead>
                    {{$header}}
                    </thead>
                    <tbody>
                    @define $rowclass = "even"
                    @foreach($rsTime as $row)
                        <tr class="{{$rowclass}} ui-widget-content detail-row">
                            <td class="hour" data-hour="{{number_format($row["Value"],1)}}"
                                style="min-height: 25px">{{$row["Display"]}}</td>
                            @define $numdate = date('t', strtotime($requestDate));
                            @define $firstdate ='01-'.date('m-Y', strtotime($requestDate));
                            @for ($i=0;$i<$numdate;$i++)
                                @define $dateid = date('Ymd', strtotime($i.' day', strtotime($firstdate)));
                                <td class="book-data" data-order="{{$i}}"
                                    data-datedefault="{{date('d/m/Y', strtotime($i.' day', strtotime($firstdate)));}}"
                                    data-hour="{{number_format($row["Value"],1)}}" data-dateid="{{$dateid}}"
                                    style="min-width:110px;width:110px"></td>
                            @endfor
                        </tr>
                        @define $rowclass = ($rowclass == "even"?"odd":"even")
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        startTime = parseInt("{{$rsTime[0]["Value"]}}");
        endTime = parseInt("{{$rsTime[count($rsTime)-1]["Value"]}}");
        xMwidth = 4, hMrow = 23, oldPosition = 0, oldHPosition = 0, isWMouseDown = false;
        iMheightCalender = parseInt("{{count($rsTime)}}") * hMrow + 30;
        if (iMheightCalender > (documentHeight - 196))
            iMheightCalender = documentHeight - 196;
        $("#scrollW76F4050M").height(iMheightCalender);

        $("#scrollW76F4050M").niceScroll({
            autohidemode: true,
            cursorwidth: 8,
            cursorcolor: '#999999'
        });

        //Set position when scroll
        $("#scrollW76F4050M").scroll(function () {
            var scroll = $(this);
            $("#divContainerW76F4050 .ft_c").css('top', (scroll.scrollTop() * -1));
            $(".ft_r.widthW76F4050M").css('left', (scroll.scrollLeft() * -1));
            $("#divContainerW76F4050 .booking-area").each(function (index) {
                $(this).css("top", ($(this).position().top - (scroll.scrollTop() - oldPosition)) + "px");
                $(this).css("left", ($(this).position().left - (scroll.scrollLeft() - oldHPosition)) + "px");
            });
            oldPosition = scroll.scrollTop();
            oldHPosition = scroll.scrollLeft();
        });

        function AdjustPositionMonth() {
            var divbook = $('#divContainerW76F4050').find('.booking-area');
            divbook.removeClass('hide');
            $.each(divbook, function () {
                var dateid = $(this).attr("data-dateid");
                var cell = $("#tableW76F4050MMain").find("td[data-dateid=" + dateid + "]").first();
                var timefrom = format2($(this).attr("data-timefrom"), "", 1);
                var left = cell.position().left + 2;
                var top = $("#tableW76F4050MMain").find("td[data-hour='" + timefrom + "']").first().position().top + 2;
                $(this).css("top", Math.round(top));
                $(this).css("left", left);
            });
        }

        function addDivMW76F4050(obj) {
            if ($("#tabW76F4050_3").find("#slFacilityIDMonth").val() == obj.FacilityID) {
                var hfrom, hto, celldata, x, y, yheight, sstyle;//32 là height của header, row
                var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
                hfrom = format2(obj.TimeValueFrom, "", 1);
                hto = format2(obj.TimeValueTo, "", 1);
                celldata = $("#tableW76F4050MMain").find("td[data-dateid=" + obj.DateID + "]").first();
                var celly = $("#tableW76F4050MMain").find("td[data-hour='" + hfrom + "']").first();
                if (celldata != undefined && celly != undefined && celldata.length > 0 && celly.length > 0) {
                    //Chỉ lấy width lần đầu do các cột đều bằng nhau
                    if (xMwidth == 4) {
                        xMwidth += celldata.width() - 5;
                        if (isChrome) xMwidth += 1;
                    }
                    x = celldata.position().left + 2;
                    y = celly.position().top + 2;
                    yheight = hMrow * 2 * (hto - hfrom) - 5;//Tính chiều cao cho vùng booking
                    //Nếu trình duyệt là chrome thì + thêm 1px
                    if (isChrome) {
                        y += 1;
                        x += 1;
                        yheight += 1;
                    }
                    var id = "divW76F4050_M" + obj.BookingID;
                    sstyle = "display:none;width:" + xMwidth + "px;height:" + yheight + "px;top:" + Math.round(y) + "px;left:" + Math.round(x) + "px;background-color:" + obj.Color + ";";
                    //Tạo div cho vùng booking
                    var $elem = jQuery('<div/>', {
                        'class': "booking-area",
                        'id': id,
                        "data-dateid": obj.DateID,
                        "data-timefrom": obj.TimeValueFrom,
                        "data-timeto": obj.TimeValueTo,
                        "style": sstyle,
                        "title": obj.Tooltip,
                        "data-id": obj.BookingID
                    });
                    var $head = jQuery('<h2/>', {
                        "id": "head_" + obj.BookingID,
                        "class": "header",
                        "style": "background-color:" + obj.HeaderColor
                    });
                    if (obj.IsAllowEdit == 0)
                        $head.addClass("not-edit");
                    if (obj.IsAllowCancel == 1) {
                        $head.html('<div class="editbooking"><button class="remove"><span class="fa fa-remove"></span></button></div>' + obj.Header);
                    } else {
                        $head.html(obj.Header);
                    }
                    $elem.html("<h3 class='contentbooking' style='width:" + (xMwidth - 5) + "px'>" + obj.Notes + "</h3>");
                    $elem.prepend($head);
                    if (celldata.width() <= 30)
                        $elem.addClass("hide");
                    $("#scrollW76F4050M").append($elem);
                    $elem.slideDown(500);
                    //Set tooltip cho div
                    $("#" + id).qtip({
                        style: 'qtip-light',
                        position: {
                            my: 'bottom center', at: 'top center'
                        }
                    });
                    if (obj.IsAllowEdit == 1) {
                        //cho phép vùng booking draggable
                        $("#" + id).draggable({
                            axis: 'x,y',
                            opacity: 0.7,
                            grid: [xMwidth + 4, hMrow],
                            containment: '#tableW76F4050MMain',
                            handle: 'h2',
                            cancel: 'img',
                            stack: ".booking-area",
                            stop: function (e, ui) {
                                //Kiểm tra nếu vùng di chuyển không hợp lệ thì ko chuyển về server
                                var rev = ui.helper.draggable("option", "revert");
                                if (rev) {
                                    ui.helper.draggable('option', 'revert', false);
                                    return;
                                }
                                $("#" + id).qtip('hide');
                                collect_drops(ui);
                            },
                            start: function (e, ui) {
                            }
                        }).droppable({
                            greedy: true,
                            tolerance: 'touch',
                            drop: function (event, ui) {
                                ui.draggable.draggable('option', 'revert', true);
                            }
                        }).resizable({
                            minHeight: hMrow,
                            handles: 's',
                            grid: hMrow,
                            autoHide: true,
                            start: function (e, ui) {
                            },
                            stop: function (e, ui) {
                                //snap to room time rows height
                                var hei = Math.round($(this).height() / (hMrow - 4));
                                var book = $(ui.helper);
                                var id = book.attr('data-id');
                                var facility = $("#tabW76F4050_3").find("#slFacilityIDMonth").val();// book.attr('data-facility');
                                var timefrom = book.attr('data-timefrom');
                                var dateid = book.attr('data-dateid');
                                $("#" + id).qtip('hide');
                                editBookingW76F4050(id, facility, timefrom, hei, 2, book, dateid);
                            },
                            resize: function (event, ui) {
                                //Do khi resize div bị thiếu mất 6px
                                $(ui.helper).height($(ui.helper).height() + 6);
                            }
                        });
                    }
                }
            }
        }

        $(function () {
            var isWMouseDown = false;
            var colM = "";    // col to start a selection

            $("#divContainerW76F4050").find("td.book-data").mousedown(function (e) {
                if (isRightClick(e))
                    return false;
                isWMouseDown = true;
                colM = $(this).attr("data-dateid");
                $("td.highlighted").removeClass("highlighted"); // clear previous selection
                $(this).addClass("highlighted");
                return false; // prevent text selection
            }).mouseover(function () {
                if (isWMouseDown) {
                    if (isWMouseDown && (colM === $(this).attr("data-dateid"))) // doesn't work!!!
                        $(this).addClass("highlighted");
                }
            }).bind("selectstart", function () {
                return false;    // prevent text selction in IE
            });

            $(document).mouseup(function () {
                if (isWMouseDown) {
                    var sel = $("#divContainerW76F4050 td.book-data.highlighted");
                    if (sel.size() > 0) {
                        var ftime = $(sel[0]).attr("data-hour");
                        var ttime = parseFloat($(sel[sel.size() - 1]).attr("data-hour")) + 0.5;
                        var faci = $("#tabW76F4050_3").find("#slFacilityIDMonth").val();
                        var date = $(sel[0]).attr("data-datedefault");
                        showModalAddBooking(faci, ftime, ttime, date);
                    }
                }
                isWMouseDown = false;
            });
        });

        function AddWBookingM76F4050(but) {
            var faci = $("#tabW76F4050_3").find("#slFacilityIDMonth").val();
            var dateid = $(but).attr("data-datedefault");
            showModalAddBooking(faci, startTime, endTime, dateid);
        }
    </script>
@endif