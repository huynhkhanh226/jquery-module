/**
 * Created by THANHLUAN on 3/3/2016.
 */
(function ($) {
    $.fn.DigiNetComboGrid = function (options) {
        // Default options
        var settings = $.extend({
            topContain: "", // id của nơi chưa tóa bộ form như id modal form đơn hàng
            textID: "", // id của input text,
            dataBind: "",
            textValue: "", // gán giá trị cho input text,
            synElement: {},//Khanh add, chứa danh sách các element cần gán giá trị khi chọn combo
            required: "",
            position: "",
            textRequireMessage: "",
            iClass: "glyphicon glyphicon-search", // class của icon ngay cạnh input text
            gridID: "", // id của nhóm gird như customer, prebyread
            gridConfig: null, // config của param query
            request: {
                url: "",  // url để cập nhật tìm kiếm dữ liệu
                action: "" // tham số đi kèm ngoài giá trị của input text
            }
        }, options);

        //*********************************************************************************
        return this.each(function () {
            this.templates = '<div id="" class="input-group l3combo">' +
                '<input type="text" class="form-control"   id="' + settings.textID + '" name="' + settings.textID + '" value="' + settings.textValue + '" autocomplete="off" oninput="setCustomValidity(\'\')" oninvalid="setCustomValidity(\'' + settings.textRequireMessage + '\')"' + (settings.required == true ? "required" : "") + '> ' +
                '<span id="span' + settings.textID + '" class="input-group-addon pointer"><i id="i' + settings.textID + '" class="' + settings.iClass + '"></i></span></div>' +
                '<div style="position: absolute; z-index: 100; display:none;  " id="pgrid_' + settings.gridID + '">' +
                '<div id="grid_' + settings.gridID + '"></div>' +
                '</div>';

            $(this).append(this.templates);
            //console.log(settings.gridConfig.synElement);
            if (settings.gridConfig.synElement === undefined)
                settings.gridConfig.synElement = settings.synElement;
            //console.log(settings.gridConfig.synElement);
            this.obj = settings.gridConfig;
            this.obj.parentBound = $("#pgrid_" + settings.gridID);
            //Create by: Khanh Huynh
            //***********************************************************
            this.obj.cellKeyDown = function (event, ui) {
                if (event.keyCode == 27) { //combo close khi user nhan ESC
                    var els = $("#pgrid_" + settings.gridID)
                    $(els).css('display', 'none');
                    ////console.log(settings.textID);
                    $("#" + settings.textID).focus();
                }
            }
            this.obj.selectChange = function (event, ui) {
                if (event.keyCode == 27) { //combo close khi user nhan ESC
                    var els = $("#pgrid_" + settings.gridID)
                    $(els).css('display', 'none');
                    ////console.log(settings.textID);
                    that.oldsearch = ui.rowIndx;
                    $("#" + settings.textID).focus();
                }
            };
            //***********************************************************

            this.$grid = $("#grid_" + settings.gridID).pqGrid(this.obj);
            this.oldsearch = settings.textValue;
            //alert(this.oldsearch);
            this.oldIndx = 0;

            var that = this;


            $(this).on('keydown', '#' + settings.textID, function (ev) {
                $('#' + settings.textID).focus();
                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                // xử lý sự kiện enter trên input text
                if (keycode == '13') { //Tránh trường hợp shift + tab nên dùng !ev.shiftKey
                    console.log('Enter');
                    //set left top
                    if (settings.position == 'right') {
                        //alert($(this).offset().left);
                        $("#pgrid_" + settings.gridID).css({
                            "left": $(this).offsetParent()[0].offsetWidth - settings.gridConfig.width
                        });
                    }

                    if ((that.oldsearch != $(this).val()) || (that.oldsearch == $(this).val() && $(this).val() == '')) {
                        $(".l3loading").removeClass('hide');
                        that.oldsearch = $(this).val();
                        $.ajax({
                            method: "POST",
                            url: settings.request.url,
                            dataType: 'json',
                            async: true,
                            data: {do: settings.request.action, StrSearch: $(this).val()},
                            success: function (data) {
                                $(".l3loading").addClass('hide');
                                //////console.log(data);
                                that.$grid.pqGrid("option", "dataModel.data", data);
                                if (data.length > 0) {
                                    if (data.length > 1)
                                        that.obj.parentBound.show();
                                    else {
                                        var synEl = settings.synElement;
                                        if (synEl.length > 0) {
                                            for (i = 0; i < synEl.length; i++) {
                                                ////console.log("#" + synEl[i].elId);
                                                $("#" + synEl[i].elId).val(data[0][synEl[i].dataIndx]);
                                            }
                                        }
                                        $("#" + that.obj.focusElement).focus();
                                    }
                                    that.$grid.pqGrid('refreshDataAndView');
                                    that.$grid.pqGrid("setSelection", {rowIndx: 0});
                                } else {//Neu nhap ngoai ngan sach
                                    that.obj.parentBound.hide();
                                    $("#" + settings.textID).val('');
                                    //Xóa các textbox phụ thuộc
                                    var synEl = settings.synElement;
                                    if (synEl.length > 0) {
                                        for (i = 0; i < synEl.length; i++) {
                                            ////console.log("#" + synEl[i].elId);
                                            $("#" + synEl[i].elId).val("");
                                        }
                                    }
                                    $("#" + settings.textID).focus();
                                    that.oldIndx = 0;
                                    ev.stopPropagation();
                                    ev.preventDefault();
                                }


                            }
                        });

                    }
                    // nếu đã tìm chỉ hiển thị lại để tránh load lại dữ liệu
                    else {
                        var data = that.$grid.pqGrid("option", "dataModel.data");
                        ////console.log('legrid');
                        if (data.length > 0) {
                            if (data.length > 1)
                                that.obj.parentBound.show();
                            else {
                                var synEl = settings.synElement;
                                if (synEl.length > 0) {
                                    for (i = 0; i < synEl.length; i++) {
                                        ////console.log("#" + synEl[i].elId);
                                        $("#" + synEl[i].elId).val(data[0][synEl[i].dataIndx]);
                                    }
                                }
                                $("#" + that.obj.focusElement).focus();
                            }
                            //that.$grid.pqGrid("setSelection", 0);
                            that.$grid.pqGrid("setSelection", {rowIndx: that.oldIndx});
                            ev.stopPropagation();
                            ev.preventDefault();
                        } else {
                            var synEl = settings.synElement;
                            if (synEl.length > 0) {
                                for (i = 0; i < synEl.length; i++) {
                                    //console.log("#" + synEl[i].elId + "-" + synEl[i].value);
                                    $("#" + synEl[i].elId).val(synEl[i].value);
                                }
                            }
                            $("#" + that.obj.focusElement).focus();
                        }
                    }

                }
                // xóa dữ liệu trên textbox và reset lại select trên lưới
                if (keycode == '46') {
                    $(this).val('');
                    //Xóa các textbox phụ thuộc
                    var synEl = settings.synElement;
                    if (synEl.length > 0) {
                        for (i = 0; i < synEl.length; i++) {
                            ////console.log("#" + synEl[i].elId);
                            $("#" + synEl[i].elId).val("");
                        }
                    }
                    that.oldIndx = 0;
                }

                //Nếu nhấn nút back thì phải xóa đi các textbox phụ thuộc
                if (keycode == '8') {
                    var synEl = settings.synElement;
                    if (synEl.length > 0) {
                        for (i = 0; i < synEl.length; i++) {
                            ////console.log("#" + synEl[i].elId);
                            $("#" + synEl[i].elId).val("");
                        }
                    }
                }
            });

           /* $(this).on('blur', '#' + settings.textID, function (ev) {
                console.log(123);
                if ($(this).is(":visible")) {
                    var el = $(this);//$('#' + settings.textID);
                    var $grid = $("#grid_" + settings.gridID);
                    if (!$grid.is(':visible') && settings.textValue != el.val()) {
                        var dataObject = that.$grid.pqGrid("option", "dataModel.data");
                        var rs = $.grep(dataObject, function (data, index) {
                            //return data[settings.dataBind].toUpperCase().indexOf(el.val().toUpperCase()) >= 0;
                            return data[settings.dataBind].toUpperCase() == el.val().toUpperCase();
                        });
                        if (rs.length == 0) {
                            $(".l3loading").removeClass('hide');
                            that.oldsearch = $(this).val();
                            $.ajax({
                                method: "POST",
                                url: settings.request.url,
                                dataType: 'json',
                                async: true,
                                data: {do: settings.request.action, StrSearch: $(this).val()},
                                success: function (data) {
                                    $(".l3loading").addClass('hide');
                                    that.$grid.pqGrid("option", "dataModel.data", data);
                                    console.log('Check');
                                    if (data.length > 0)
                                        var dataFilter = $.grep(data, function (row, index) {
                                            return row[settings.dataBind].toUpperCase() == $('#' + settings.textID).val().toUpperCase();
                                        });
                                    if (dataFilter != undefined && dataFilter.length > 0) {
                                        var synEl = settings.synElement;
                                        if (synEl.length > 0) {
                                            for (i = 0; i < synEl.length; i++) {
                                                ////console.log("#" + synEl[i].elId);

                                                $("#" + synEl[i].elId).val(dataFilter[0][synEl[i].dataIndx]);
                                            }
                                        }
                                    } else {
                                        el.val('');
                                        var synEl = settings.synElement;
                                        if (synEl.length > 0) {
                                            for (i = 0; i < synEl.length; i++) {
                                                ////console.log("#" + synEl[i].elId);
                                                $("#" + synEl[i].elId).val("");
                                            }
                                        }
                                    }
                                }
                            });


                        } else {
                            var synEl = settings.synElement;
                            if (synEl.length > 0) {
                                for (i = 0; i < synEl.length; i++) {
                                    ////console.log("#" + synEl[i].elId);
                                    $("#" + synEl[i].elId).val(rs[0][synEl[i].dataIndx]);
                                }
                            }
                        }
                    }

                    if (settings.textValue == el.val()) {
                        var synEl = settings.synElement;
                        if (synEl.length > 0) {
                            for (i = 0; i < synEl.length; i++) {
                                //console.log("#" + synEl[i].elId + "-" + synEl[i].value);
                                $("#" + synEl[i].elId).val(synEl[i].value);
                            }
                        }
                    }
                }
            });

            //xử lý ẩn lưới
            $("#" + settings.topContain).click(function (e) {
                console.log('hide');
                if (e.target.id != settings.textID && e.target.id != 'span' + settings.textID && e.target.id != 'i' + settings.textID)
                    that.obj.parentBound.hide();
                //Check
                var el = $('#' + settings.textID);
                if (el.is(":visible")) {
                    if (settings.textValue != el.val()) {
                        var dataObject = that.$grid.pqGrid("option", "dataModel.data");
                        var rs = $.grep(dataObject, function (data, index) {
                            //return data[settings.dataBind].toUpperCase().indexOf(el.val().toUpperCase()) >= 0;
                            return data[settings.dataBind].toUpperCase() == el.val().toUpperCase();
                        });
                        if (rs.length == 0) {
                            el.val('');
                            var synEl = settings.synElement;
                            if (synEl.length > 0) {
                                for (i = 0; i < synEl.length; i++) {
                                    ////console.log("#" + synEl[i].elId);
                                    $("#" + synEl[i].elId).val("");
                                }
                            }
                        } else {
                            var synEl = settings.synElement;
                            if (synEl.length > 0) {
                                for (i = 0; i < synEl.length; i++) {
                                    ////console.log("#" + synEl[i].elId);
                                    $("#" + synEl[i].elId).val(rs[0][synEl[i].dataIndx]);
                                }
                            }
                        }
                    } else {
                        var synEl = settings.synElement;
                        if (synEl.length > 0) {
                            for (i = 0; i < synEl.length; i++) {
                                //console.log("#" + synEl[i].elId + "-" + synEl[i].value);
                                $("#" + synEl[i].elId).val(synEl[i].value);
                            }
                        }
                    }
                }

            });
            //// click dòng trên lưới
            this.$grid.on("pqgridrowclick", function (event, ui) {
                that.oldIndx = ui.rowIndx;

            });

            // xử lý sự kiện click vào icon bên cạnh input text
            $(this).on('click', '.pointer', function (ev) {
                var e = jQuery.Event('keydown', {which: $.ui.keyCode.ENTER});
                $(that).find('#' + settings.textID).trigger(e);
            });
*/
        });
    };
}(jQuery));