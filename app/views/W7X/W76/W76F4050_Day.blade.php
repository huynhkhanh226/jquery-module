@define $colcount = count($rsCaption)
@if ($colcount >0 && count($rsTime)>0)
    <table class="ca-booking-day">
        <thead>
        <th class="ca-booking-day-header"></th>
        @define $colwidth = $colcount>8?"12":round(96/$colcount,2)
        @define $count = 1
        @foreach($rsCaption as $row)
            <th class="ca-booking-day-header faccol {{$count>8?"hide":""}}" data-facility="{{$row["FieldName"]}}" data-order="{{$count}}" style="width: {{$colwidth}}%">{{$row["Caption"]}}
                <a class="pull-right" onclick="showFacilityDetail('{{$row["FieldName"]}}');"><span class="digi digi-info" title="Information"></span>&nbsp;</a>
                <a class="pull-right" onclick="AddBookingW76F4050(this);" data-facility="{{$row["FieldName"]}}" title="Booking Request"><span class="digi digi-add text-orange"></span>&nbsp;</a>
            </th>
            @define $count += 1
        @endforeach
        </thead>
    </table>
    <div id="divDCalenderBooking" style="border-bottom: solid 1px #dddddd">
        <table class="ca-booking-day" id="tabW76F4050Day">
            @define $rowclass = "even"
            @foreach($rsTime as $row)
                <tr class="{{$rowclass}}">
                    <td class="hour" data-hour="{{number_format($row["Value"],1)}}">{{$row["Display"]}}</td>
                    @define $count = 1
                    @for ($i=0;$i<$colcount;$i++)
                        <td class="book-data {{$count>8?"hide":""}}" data-order="{{$count}}" data-hour="{{number_format($row["Value"],1)}}" data-facility="{{$rsCaption[$i]["FieldName"]}}"
                            style="width: {{$colwidth}}%"></td>
                        @define $count += 1
                    @endfor
                </tr>
                @define $rowclass = ($rowclass == "even"?"odd":"even")
            @endforeach
        </table>
        <input type="hidden" id="hdW76F4050DateID" value="{{$requestDate}}">
    </div>
    <script>
        totalCol = parseInt("{{$colcount}}");
        startTime = parseInt("{{$rsTime[0]["Value"]}}");
        endTime = parseInt("{{$rsTime[count($rsTime)-1]["Value"]}}");
        currFacility = null, xdwidth = 4, hrow = 23, oldPosition = 0, isMouseDown = false;
        iheightCalender = parseInt("{{count($rsTime)}}") * hrow;
        if (iheightCalender > (documentHeight - 196))
            iheightCalender = documentHeight - 196;


        function addBooking() {
            var arrData = {{json_encode($rsData)}};
            $.each(arrData, function (idx, obj) {
                addDivDW76F4050(obj);
            });
        }

        function addDivDW76F4050(obj) {
            var d1 = '{{$requestDate}}'.split('/');
            if (obj.DateID!= d1[2] + d1[1] + d1[0])return;//Chặn không cho add booking khác ngày
            var hfrom, hto, celldata, x, y, yheight, sstyle;//32 là height của header, row
            var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
            hfrom = format2(obj.TimeValueFrom, "", 1);
            hto = format2(obj.TimeValueTo, "", 1);
            celldata = $("#tabW76F4050Day").find("td[data-facility=" + obj.FacilityID + "]").first();
            var celly = $("#tabW76F4050Day").find("td[data-hour='" + hfrom + "']").first();
            if (celldata != undefined && celly != undefined && celldata.length > 0 && celly.length > 0) {
                //Chỉ lấy width lần đầu do các cột đều bằng nhau
                if (xdwidth == 4) {
                    xdwidth += celldata.width() - 5;
                    if (isChrome)xdwidth += 1;
                }
                x = celldata.position().left + 2;
                y = celly.position().top + 2;
                yheight = hrow * 2 * (hto - hfrom) - 5;//Tính chiều cao cho vùng booking
                //Nếu trình duyệt là chrome thì + thêm 1px
                if (isChrome) {
                    y += 1;
                    x += 1;
                    yheight += 1;
                }
                var id = "divW76F4050_D" + obj.BookingID;
                sstyle = "width:" + xdwidth + "px;height:" + yheight + "px;top:" + Math.round(y) + "px;left:" + Math.round(x) + "px;background-color:" + obj.Color + ";";
                //Tạo div cho vùng booking
                var $elem = jQuery('<div/>', {
                    'class': "booking-area",
                    'id': id,
                    "data-facility": obj.FacilityID,
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
                $elem.html("<h3 class='contentbooking' style='width:" + (xdwidth - 5) + "px'>" + obj.Notes + "</h3>");
                $elem.prepend($head);
                if (celldata.width() <= 30)
                    $elem.addClass("hide");
                $("#divDCalenderBooking").append($elem);
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
                        grid: [xdwidth + 4, hrow],
                        containment: '#tabW76F4050Day',
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
                        minHeight: hrow,
                        handles: 's',
                        grid: hrow,
                        autoHide: true,
                        start: function (e, ui) {
                        },
                        stop: function (e, ui) {
                            //snap to room time rows height
                            var hei = Math.round($(this).height() / (hrow - 4));
                            var book = $(ui.helper);
                            var id = book.attr('data-id');
                            var facility = book.attr('data-facility');
                            var timefrom = book.attr('data-timefrom');
                            editBookingW76F4050(id, facility, timefrom, hei, 2, book, '');
                        },
                        resize: function (event, ui) {
                            //Do khi resize div bị thiếu mất 6px
                            $(ui.helper).height($(ui.helper).height() + 6);
                        }
                    });
                }
            }
        }

        $("#divDCalenderBooking").slimScroll({
            height: iheightCalender + 'px'
        }).bind('slimscrolling', function (e, pos) {
            $("#divDCalenderBooking .booking-area").each(function (index) {
                $(this).css("top", ($(this).position().top - (pos - oldPosition)) + "px");
            });
            oldPosition = pos;
        });

        addBooking();

        $(".btnPrevW76F4050").on("click", function () {
            var curCol = $('th.ca-booking-day-header.faccol:visible').first();
            var indx = parseInt(curCol.attr("data-order"));
            var showindex = indx - 1;
            var hideindex = indx + 7;
            //Lấy facility cột hiện lên
            currFacility = $('td.book-data[data-order=' + showindex + ']').first().attr("data-facility");
            var facility = $('td.book-data[data-order=' + hideindex + ']').first().attr("data-facility");
            //Ẩn và hiện vùng booking
            $("#divDCalenderBooking").find("[data-facility='" + facility + "']").addClass("hide");
            $("#divDCalenderBooking").find("[data-facility='" + currFacility + "']").removeClass("hide");
            $(".ca-booking-day").find("[data-facility='" + currFacility + "']").removeClass("hide");
            //ẩn cột đầu tiên
            $(".ca-booking-day").find("[data-facility='" + facility + "']").addClass("hide");

            $(".btnNextW76F4050").removeAttr("disabled");
            if (indx == 2) {
                $(".btnPrevW76F4050").attr("disabled", "disabled");
            }
            AdjustPositionDay();
        });

        $(".btnNextW76F4050").on("click", function () {
            var curCol = $('th.ca-booking-day-header:visible').last();
            var indx = parseInt(curCol.attr("data-order"));
            //Lấy facility cột hiện lên
            currFacility = $('td.book-data[data-order=' + (indx + 1) + ']').first().attr("data-facility");
            var facility = $('td.book-data[data-order=' + (indx - 7) + ']').first().attr("data-facility");
            //Ẩn và hiện vùng booking
            $("#divDCalenderBooking").find("[data-facility='" + facility + "']").addClass("hide");
            $("#divDCalenderBooking").find("[data-facility='" + currFacility + "']").removeClass("hide");
            $(".ca-booking-day").find("[data-facility='" + currFacility + "']").removeClass("hide");
            $(".ca-booking-day").find("[data-facility='" + facility + "']").addClass("hide");

            $(".btnPrevW76F4050").removeAttr("disabled");
            if (totalCol == (indx + 1)) {
                $(".btnNextW76F4050").attr("disabled", "disabled");
            }
            AdjustPositionDay();
        });

        function AdjustPositionDay() {
            var showCol = $('th.ca-booking-day-header.faccol:visible');
            $.each(showCol, function () {
                var facility = $(this).attr("data-facility");
                // var left = $(this).offset().left - 21;
                var celldata = $("#tabW76F4050Day").find("td[data-facility=" + facility + "]").first();
                var left = celldata.position().left + 2;
                //Set lại top và left toàn bộ các div có facility tương ứng
                var div = $("div.booking-area[data-facility='" + facility + "']");
                div.removeClass('hide');
                $.each(div, function (idx, element) {
                    var timefrom = format2($(element).attr("data-timefrom"), "", 1);
                    var timeto = format2($(element).attr("data-timeto"), "", 1);
                    y = $("#tabW76F4050Day").find("td[data-hour='" + timefrom + "']").first().position().top + 2;
                    $(element).css("top", Math.round(y));
                    $(element).css("left", left);
                });
            });
        }

        $(function () {
            var isMouseDown = false;
            var col = "";    // col to start a selection

            $("#tabW76F4050Day td.book-data").mousedown(function (e) {
                if (isRightClick(e))
                    return false;
                isMouseDown = true;
                col = $(this).attr("data-facility");
                $("td.highlighted").removeClass("highlighted"); // clear previous selection
                $(this).addClass("highlighted");
                return false; // prevent text selection
            }).mouseover(function () {
                if (isMouseDown) {
                    if (isMouseDown && (col === $(this).attr("data-facility"))) // doesn't work!!!
                        $(this).addClass("highlighted");
                }
            }).bind("selectstart", function () {
                return false;    // prevent text selction in IE
            });

            $(document).mouseup(function () {
                if (isMouseDown) {
                    var sel = $("#tabW76F4050Day td.book-data.highlighted");
                    if (sel.size() > 0) {
                        var ftime = $(sel[0]).attr("data-hour");
                        var ttime = parseFloat($(sel[sel.size() - 1]).attr("data-hour")) + 0.5;
                        var faci = $(sel[0]).attr("data-facility");
                        showModalAddBooking(faci, ftime, ttime, '{{$requestDate}}');
                    }
                }
                isMouseDown = false;
            });
        });

        function isRightClick(e) {
            if (e.which) {
                return (e.which == 3);
            } else if (e.button) {
                return (e.button == 2);
            }
            return false;
        }


    </script>
@endif