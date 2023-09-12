<div id='calendarW76F4050' class="l3-calendar"></div>
<div class="l3-loading hide">
    <i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;Loading...
</div>
<script type="text/javascript">
    var viewmodeW76F4050 = "";
    $(document).ready(function () {
        var heiW76F4050 = documentHeight - 140;
        var bClickDel = false;
        $('#calendarW76F4050').fullCalendar({
            defaultView: 'agendaDay',
            defaultDate: '{{date('Y-m-d', strtotime(str_replace('/', '-', $requestDate)))}}',
            editable: true,
            contentHeight: 'auto',
            slotLabelFormat: "HH:mm",
            selectable: true,
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day',
                list: 'List'
            },
            timeFormat: 'HH:mm', // uppercase H for 24-hour clock
            eventLimit: false, // allow "more" link when too many events
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaDay,agendaWeek,month'
            },
            dayOfMonthFormat: 'ddd DD/MM',
            fixedWeekCount: false,
            textEscape: false,
            theme: true,
            minTime: '{{$bookingTimeFrom}}',
            maxTime: '{{$bookingTimeTo}}',
            firstDay: parseInt('{{$startOfWeek}}'),
            allDaySlot: false,
            resources: {{json_encode($rsCaption)}},
            events: {
                url: '{{url('W76F4050/calendar')}}',
                cache: false,
                method: 'post',
                data: function () { // a function that returns an object
                    return {
                        dynamic_value: Math.random(),
                        array: {{json_encode($all)}},
                        mode: 1,
                        faci: $('#slFacilityIDW76F4050').val(),
                        view: viewmodeW76F4050
                    };
                }
            },
            select: function (start, end, jsEvent, view, resource) {
                var res = resource ? resource.id : $('#slFacilityIDW76F4050').val();
                if (viewmodeW76F4050 != 'month') {
                    var date = moment(start).format("DD/MM/YYYY");
                    $('#frmW76F4050Booking').find('#txtRequestedDate').val(date);
                    $('#frmW76F4050Booking').find('#slFacilityNo').val(res);
                    $('#frmW76F4050Booking').find('#hdMode').val(0);
                    $('#frmW76F4050Booking').find('#txtDescription').val('');
                    $('#frmW76F4050Booking').find('#txtTimeFrom').val(moment(start).format("HH:mm"));
                    $('#frmW76F4050Booking').find('#txtTimeTo').val(moment(end).format("HH:mm"));
                    $("#modalW76F4050Booking").find(".alert-success").addClass('hide');
                    $("#modalW76F4050Booking").find(".alert-success").addClass('hide');
                    $("#modalW76F4050Booking").find("#frm_btnSave").removeAttr("disabled");
                    $("#modalW76F4050Booking").find("#frm_btnCancel").removeAttr("disabled");
                    $("#modalW76F4050Booking").find("#frm_btnDelete").addClass('hide');
                    $('#modalW76F4050Booking').modal('show');
                    $('#calendarW76F4050').fullCalendar('unselect');
                }
            },
            viewRender: function (view, element) {
                $('.l3loading').removeClass('hide');
                viewmodeW76F4050 = view.name;
                $('#calendarW76F4050').fullCalendar('removeEvents');
                if (viewmodeW76F4050 == "agendaDay") {
                    $('#slFacilityIDW76F4050').hide();
                } else {
                    $('#slFacilityIDW76F4050').show();
                }
                $('#calendarW76F4050').fullCalendar('refetchEvents');
            },
            eventRender: function (event, element, view) {
                if (event.StatusID == '2')
                    element.addClass('bg-blue-active');
                else if (event.StatusID == '3')
                    element.addClass('bg-gray text-black');
                else
                    element.addClass('bg-aqua-active');
                if (event.IsEdit == 0) {
                    event.editable = false;
                }
                //Gán tooltip cho các event
                element.qtip({
                    content: event.Tooltip,
                    show: {solo: true},
                    style: 'qtip-light',
                    position: {
                        target: 'mouse', // Track the mouse as the positioning target
                        adjust: {x: 5, y: 5} // Offset it slightly from under the mouse
                    }
                });
            },
            loading: function (isLoading, view) {
                if (!isLoading) {
                    $("#modalW76F4050 .l3-loading").addClass("hide");
                    $('.l3loading').addClass('hide');
                } else {
                    //Fix lỗi duplicate event khi thêm mới và change mode view
                    $('#calendarW76F4050').fullCalendar('removeEvents');
                }
            },
            eventResize: function (event, delta, revertFunc) {
                //Điều chỉnh booking resize
                var timefrom = moment(event.start).format("HH:mm");
                var timeto = moment(event.end).format("HH:mm");
                var date = moment(event.end).format("YYYY-MM-DD");
                calEventObjW76F4050 = event;
                editBookingW76F4050(event.id, event.resourceId, timefrom, timeto, 2, date);
            },
            eventDrop: function (event) {
                //Điều chỉnh booking drag & drop
                var timefrom = moment(event.start).format("HH:mm");
                var timeto = moment(event.end).format("HH:mm");
                var date = moment(event.end).format("YYYY-MM-DD");
                calEventObjW76F4050 = event;
                editBookingW76F4050(event.id, event.resourceId, timefrom, timeto, 2, date);
            },
            eventMouseover: function (event, domEvent) {
                bClickDel = false;
                if (event.IsDelete == 1) {
                    $(this).off("click", "#delbut" + event.id);
                    $(this).remove("#delbut" + event.id);
                    var layer = '<div id="events-layer" class="fc-transparent" style="position:absolute;width:100%; height:100%; top:-1px; text-align:right; z-index:100"><a><span class="fa fa-trash text-red" id="delbut' + event.id + '" border="0" style="padding-right:5px; padding-top:2px;" /></a></div>';
                    $(this).append(layer);
                    var delbut = $("#delbut" + event.id);
                    delbut.hide();
                    delbut.fadeIn(300);
                    $(this).on('click', "#delbut" + event.id, function () {
                        bClickDel = true;
                        ask_delete(function () {
                            $.ajax({
                                method: "POST",
                                url: "{{"W76F4050/add"}}",
                                data: {bookid: event.id, mode: 1},
                                success: function (data) {
                                    if (data == "1") {
                                        $('#calendarW76F4050').fullCalendar('removeEvents', event.id);
                                    }
                                }
                            });
                        });

                    });
                }
            },
            eventMouseout: function (event, jsEvent, view) {
                $(this).find("#delbut" + event.id).remove();
            }
        });

        var custom_buttons = '<select class="form-control" id="slFacilityIDW76F4050" style="width:170px !important;margin-top: 3px;display:none">{{$strFacility}}</select>';
        $('#calendarW76F4050').find('.fc-left').append(custom_buttons);

        $('#calendarW76F4050').on('change', '#slFacilityIDW76F4050', function () {
            $("#modalW76F4050 .l3-loading").removeClass("hide");
            $('#calendarW76F4050').fullCalendar('refetchEvents');

        });


    });


</script>


