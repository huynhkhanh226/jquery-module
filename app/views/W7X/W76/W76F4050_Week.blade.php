@if (count($rsTime)>0)
    <table class="ca-booking-day">
        <thead>
        <th class="ca-booking-day-header text-center">
            <a onclick="showWFacilityDetail();"><span class="digi digi-info" title="Information"></span>&nbsp;</a>
        </th>
        @define $colwidth = 13.72
        @for($i=1;$i<=7;$i++)
            @define $dateid = date('Ymd', strtotime(($i - $day).' day', strtotime($requestDate)));
            @define $caption = date('D d/m/Y', strtotime(($i - $day).' day', strtotime($requestDate)));
            <th class="ca-booking-day-header faccol" data-dateid="{{$dateid}}" data-order="{{$i}}"
                style="width: {{$colwidth}}%">{{$caption}}
                <a class="pull-right" onclick="AddWBookingW76F4050(this);"
                   data-datedefault="{{date('d/m/Y', strtotime(($i - $day).' day', strtotime($requestDate)));}}"
                   data-dateid="{{$dateid}}" title="Booking Request"><span class="digi digi-add text-orange"></span>&nbsp;
                </a>
            </th>
        @endfor
        </thead>
    </table>
    <div id="divWCalenderBooking" style="border-bottom: solid 1px #dddddd">
        <table class="ca-booking-day" id="tabW76F4050Week">
            @define $rowclass = "even"
            @foreach($rsTime as $row)
                <tr class="{{$rowclass}}">
                    <td class="hour" data-hour="{{number_format($row["Value"],1)}}">{{$row["Display"]}}</td>
                    @for ($i=1;$i<=7;$i++)
                        @define $dateid = date('Ymd', strtotime(($i - $day).' day', strtotime($requestDate)));
                        <td class="book-data" data-order="{{$i}}"
                            data-datedefault="{{date('d/m/Y', strtotime(($i - $day).' day', strtotime($requestDate)));}}"
                            data-hour="{{number_format($row["Value"],1)}}" data-dateid="{{$dateid}}"
                            style="width: {{$colwidth}}%"></td>
                    @endfor
                </tr>
                @define $rowclass = ($rowclass == "even"?"odd":"even")
            @endforeach
        </table>
    </div>
    <script>
        startTime = parseInt("{{$rsTime[0]["Value"]}}");
        endTime = parseInt("{{$rsTime[count($rsTime)-1]["Value"]}}");
        xwwidth = 4, hWrow = 23, oldPosition = 0, isWMouseDown = false;
        iWheightCalender = parseInt("{{count($rsTime)}}") * hWrow + 35;
        if (iWheightCalender > (documentHeight - 196))
            iWheightCalender = documentHeight - 196;

        function addDivWW76F4050(obj) {
            if ($("#tabW76F4050_2").find("#slFacilityIDWeek").val() == obj.FacilityID) {
                var hfrom, hto, celldata, x, y, yheight, sstyle;//32 là height của header, row
                var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
                hfrom = format2(obj.TimeValueFrom, "", 1);
                hto = format2(obj.TimeValueTo, "", 1);
                celldata = $("#tabW76F4050Week").find("td[data-dateid=" + obj.DateID + "]").first();
                var celly = $("#tabW76F4050Week").find("td[data-hour='" + hfrom + "']").first();
                if (celldata != undefined && celly != undefined && celldata.length > 0 && celly.length > 0) {
                    //Chỉ lấy width lần đầu do các cột đều bằng nhau
                    if (xwwidth == 4) {
                        xwwidth += celldata.width() - 5;
                        if (isChrome) xwwidth += 1;
                    }
                    x = celldata.position().left + 2;
                    y = celly.position().top + 2;
                    yheight = hWrow * 2 * (hto - hfrom) - 5;//Tính chiều cao cho vùng booking
                    //Nếu trình duyệt là chrome thì + thêm 1px
                    if (isChrome) {
                        y += 1;
                        x += 1;
                        yheight += 1;
                    }
                    var id = "divW76F4050_W" + obj.BookingID;
                    sstyle = "display:none;width:" + xwwidth + "px;height:" + yheight + "px;top:" + Math.round(y) + "px;left:" + Math.round(x) + "px;background-color:" + obj.Color + ";";
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
                    $elem.html("<h3 class='contentbooking' style='max-width:100%'>" + obj.Notes + "</h3>");
                    $elem.prepend($head);
                    if (celldata.width() <= 30)
                        $elem.addClass("hide");
                    $("#divWCalenderBooking").append($elem);
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
                            grid: [xwwidth + 4, hWrow],
                            containment: '#tabW76F4050Week',
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
                            minHeight: hWrow,
                            handles: 's',
                            grid: hWrow,
                            autoHide: true,
                            start: function (e, ui) {
                            },
                            stop: function (e, ui) {
                                //snap to room time rows height
                                var hei = Math.round($(this).height() / (hWrow - 4));
                                var book = $(ui.helper);
                                var id = book.attr('data-id');
                                var facility = $("#tabW76F4050_2").find("#slFacilityIDWeek").val();// book.attr('data-facility');
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

        $("#divWCalenderBooking").slimScroll({
            height: (iWheightCalender - 35) + 'px'
        }).bind('slimscrolling', function (e, pos) {
            $("#divWCalenderBooking .booking-area").each(function (index) {
                $(this).css("top", ($(this).position().top - (pos - oldPosition)) + "px");
            });
            oldPosition = pos;
        });


        $(function () {
            var isWMouseDown = false;
            var colW = "";    // col to start a selection

            $("#tabW76F4050Week").find("td.book-data").mousedown(function (e) {
                if (isRightClick(e))
                    return false;
                isWMouseDown = true;
                colW = $(this).attr("data-dateid");
                $("td.highlighted").removeClass("highlighted"); // clear previous selection
                $(this).addClass("highlighted");
                return false; // prevent text selection
            }).mouseover(function () {
                if (isWMouseDown) {
                    if (isWMouseDown && (colW === $(this).attr("data-dateid"))) // doesn't work!!!
                        $(this).addClass("highlighted");
                }
            }).bind("selectstart", function () {
                return false;    // prevent text selction in IE
            });

            $(document).mouseup(function () {
                if (isWMouseDown) {
                    var sel = $("#tabW76F4050Week td.book-data.highlighted");
                    if (sel.size() > 0) {
                        var ftime = $(sel[0]).attr("data-hour");
                        var ttime = parseFloat($(sel[sel.size() - 1]).attr("data-hour")) + 0.5;
                        var faci = $("#tabW76F4050_2").find("#slFacilityIDWeek").val();
                        var date = $(sel[0]).attr("data-datedefault");
                        showModalAddBooking(faci, ftime, ttime, date);
                    }
                }
                isWMouseDown = false;
            });
        });

        function AdjustPositionWeek() {
            var divbook = $('#divW76F4050_Week').find('.booking-area');
            divbook.removeClass('hide');
            $.each(divbook, function () {
                var dateid = $(this).attr("data-dateid");
                var cell = $("#divW76F4050_Week").find("td[data-dateid=" + dateid + "]").first();
                var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
                xwwidth = cell.width() - 1;
                if (isChrome) xwwidth += 1;
                var timefrom = format2($(this).attr("data-timefrom"), "", 1);
                var left = cell.position().left + 2;
                var top = $("#divW76F4050_Week").find("td[data-hour='" + timefrom + "']").first().position().top + 2;
                $(this).css("top", Math.round(top));
                $(this).css("left", left);
                $(this).css("width", xwwidth);
            });
        }

        $("#slFacilityIDWeek").trigger("change");

        function showWFacilityDetail() {
            var faci = $("#tabW76F4050_2").find("#slFacilityIDWeek").val();
            showFacilityDetail(faci);
        }

        function AddWBookingW76F4050(but) {
            var faci = $("#tabW76F4050_2").find("#slFacilityIDWeek").val();
            var dateid = $(but).attr("data-datedefault");
            showModalAddBooking(faci, startTime, endTime, dateid);
        }
    </script>
@endif