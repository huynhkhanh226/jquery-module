(function ($) {
    "use strict";
    var DigiCombo = function (element, options) {
        this.options = $.extend({
            topContain: "", // id c?a n?i ch?a t�a b? form nh? id modal form ??n h�ng
            textID: "", // id c?a input text,
            dataBind: "",
            textValue: "", // g�n gi� tr? cho input text,
            synElement: {},//Khanh add, ch?a danh s�ch c�c element c?n g�n gi� tr? khi ch?n combo
            required: "",
            position: "left",
            textRequireMessage: "",
            iClass: "glyphicon glyphicon-search", // class c?a icon ngay c?nh input text
            //gridID: "", // id c?a nh�m gird nh? customer, prebyread
            gridConfig: null, // config c?a param query
            request: {
                local: false,
                restful: false,
                url: "",  // url ?? c?p nh?t t�m ki?m d? li?u
                action: "", // tham s? ?i k�m ngo�i gi� tr? c?a input text
                encodedata: null
            }
        }, options);
        this.template = this.template();
        this.$container = $(element);
        this.$mainContainer = $("#"+this.options.topContain);
        this.create();

        this.$input = $(this.$container.find("#" + this.options.textID));
        this.$iCon = $(this.$container.find('#iCon' + this.options.textID).parent());
        this.$grid = $(this.$container.find("#grid_" + this.options.gridConfig.gridID));
        this.$parentBound = $(this.$container.find("#pgrid_" + this.options.gridConfig.gridID));
        this.obj = {
            width: this.options.gridConfig.width,
            height: this.options.gridConfig.height,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            selectionModel: {type: 'row', mode: 'single'},
            focusElement: this.options.gridConfig.focusElement,
            colModel: this.options.gridConfig.colModel,
            dataModel: this.options.gridConfig.dataModel,
            synElement: this.options.synElement,
            parentBound: this.$parentBound
        };
        this.oldsearch = this.options.textValue;
        //this.oldIndx = 0;
        this.$gridObject = null;
        this.gridEvent();
        this.listen();
    };

    DigiCombo.prototype = {
        constructor: DigiCombo
        , template: function () {
            return '<div id="" class="input-group l3combo">' +
                '<input type="text" class="form-control"   id="' + this.options.textID + '" name="' + this.options.textID + '" value="' + this.options.textValue + '" autocomplete="off" oninput="setCustomValidity(\'\')" oninvalid="setCustomValidity(\'' + this.options.textRequireMessage + '\')"' + (this.options.required == true ? "required" : "") + '> ' +
                '<span id="span' + this.options.textID + '" class="input-group-addon pointer"><i id="iCon' + this.options.textID + '" class="' + this.options.iClass + '"></i></span></div>' +
                '<div style="position: absolute; z-index: 10000; display:none;  " id="pgrid_' + this.options.gridConfig.gridID + '">' +
                '<div id="grid_' + this.options.gridConfig.gridID + '"></div>' +
                '</div>';
        }
        , create: function () {
            this.$container.append($(this.template));
            if (this.options.position == 'right') {
                this.$grid.css({
                    "left": $(this).offsetParent()[0].offsetWidth - this.options.gridConfig.width
                });
            } else {

            }

        }
        , gridEvent: function () {
            var that = this;
            this.obj.cellKeyDown = function (event, ui) {
                if (event.keyCode == 27) { //combo close khi user nhan ESC
                    that.$parentBound.hide();
                    that.$input.focus();
                }
            }

            this.obj.rowDblClick = function (event, ui) {
                if (event.keyCode == 27) { //combo close khi user nhan ESC
                    that.$parentBound.hide();
                    that.$input.focus();
                }
            }

            this.obj.selectChange = function (event, ui) {
                /* if (event.keyCode == 27) { //combo close khi user nhan ESC
                 that.$parentBound.hide();
                 that.oldIndx = ui.rowIndx;
                 that.$input.focus();
                 }*/
            }
            this.obj.rowClick = function (event, ui) {
                /* if (event.keyCode == 27) { //combo close khi user nhan ESC
                 that.$parentBound.hide();
                 that.oldIndx = ui.rowIndx;
                 that.$input.focus();
                 }*/
                //that.oldIndx = ui.rowIndx;
            }
            this.$grid.pqGrid(this.obj);
            /*this.$gridObject = this.$grid.pqGrid(this.obj);
             this.$gridObject.on("pqgridrowclick", function (event, ui) {
             that.oldIndx = ui.rowIndx;
             });*/
        }
        , listen: function () {
            //var that = this;
            this.$input.on('keydown', $.proxy(this.keydown, this));
            this.$input.on('change', $.proxy(this.change, this));
            this.$input.on('blur', $.proxy(this.blur, this));
            this.$iCon.on('click', $.proxy(this.search, this));//this.$iCon.on('click', $.proxy(this.change, this));
            this.$mainContainer.on('click', $.proxy(this.triggerContainer, this));
        }
        , change: function () {
            /*console.log('change');
            if (this.$input.val() == '') {
                this.clear(true);
            } else {
                this.search();
            }*/
        }
        , keydown: function (ev) {
            console.log('keydown');
            this.$input.focus();
            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            // x? l� s? ki?n enter tr�n input text
            if (keycode == '13') { //Tr�nh tr??ng h?p shift + tab n�n d�ng !ev.shiftKey
                console.log('Enter');
                //set left top
                this.search();

            }
            // x�a d? li?u tr�n textbox v� reset l?i select tr�n l??i
            //Delete
            if (keycode == '46') {
                this.clear(true);
            }

            //N?u nh?n n�t back th� ph?i x�a ?i c�c textbox ph? thu?c
            //Back, xóa từng kí tự
            if (keycode == '8') {
                this.clear(false);
            }
        }
        , blur: function(ev){
            console.log('blur');
            if (this.$input.is(":visible")){
                if (!this.$grid.is(':visible') && this.options.textValue != this.$input.val()){
                    var dataObject = this.$grid.pqGrid("option", "dataModel.data");
                    var that = this;
                    var rs = $.grep(dataObject, function (data, index) {
                        //return data[settings.dataBind].toUpperCase().indexOf(el.val().toUpperCase()) >= 0;
                        return data[that.options.dataBind].toUpperCase() == that.$input.val().toUpperCase();
                    });
                    if (rs.length == 0){
                        console.log("blur");
                        //$(".l3loading").removeClass('hide');
                        this.oldsearch = this.$input.val();
                        if (this.options.request.local == true){

                            var that =this;
                            console.log(this.options.gridConfig.dataModel);
                            var temp = this.options.gridConfig.dataModel.data;
                            var data = $.grep(temp, function (row, index) {
                                return row[that.options.dataBind].toUpperCase().indexOf(that.$input.val().toUpperCase()) != -1;
                            });

                            that.$grid.pqGrid("option", "dataModel.data", data);
                            //var data = JSON.parse(data);
                            if (data.length > 0) {
                                if (data.length > 1) {
                                    that.$parentBound.fadeIn("slow", function () {});
                                }
                                else {
                                    that.setValue(data);
                                }
                                that.$grid.pqGrid('refreshDataAndView');
                                that.$grid.pqGrid("setSelection", {rowIndx: 0});
                            } else {//Neu nhap ngoai ngan sach
                                that.$parentBound.hide();
                                that.$input.val('');
                                //X�a c�c textbox ph? thu?c
                                var synEl = that.options.synElement;
                                if (synEl.length > 0) {
                                    for (i = 0; i < synEl.length; i++) {
                                        $("#" + synEl[i].elId).val("");
                                    }
                                }
                                that.$input.focus();
                                //that.oldIndx = 0;
                                ev.stopPropagation();
                                ev.preventDefault();
                            }

                        }else{
                            if (this.options.request.restful){
                                var that = this;
                                $.post( this.options.request.url, this.options.request.encodedata.replace('?',this.$input.val()), function(data) {
                                    //$(".l3loading").addClass('hide');
                                    that.$grid.pqGrid("option", "dataModel.data",JSON.parse(data));
                                    console.log('Check');
                                    var data = JSON.parse(data);
                                    if (data.length > 0)
                                        var dataFilter = $.grep(data, function (row, index) {
                                            return row[that.options.dataBind].toUpperCase() == that.$input.val().toUpperCase();
                                        });
                                    if (dataFilter != undefined && dataFilter.length > 0){
                                        that.setValue(dataFilter);
                                    }else{
                                        that.clear(true);
                                    }
                                });
                            }else{
                                var that = this;
                                $.ajax({
                                    method: "POST",
                                    url: this.options.request.url,
                                    dataType: 'json',
                                    async: true,
                                    data: {do: this.options.request.action, StrSearch: this.$input.val()},
                                    success: function (data) {
                                        //$(".l3loading").addClass('hide');
                                        that.$grid.pqGrid("option", "dataModel.data",data);
                                        console.log('Check');
                                        //var data = JSON.parse(data);
                                        if (data.length > 0)
                                            var dataFilter = $.grep(data, function (row, index) {
                                                return row[that.options.dataBind].toUpperCase() == that.$input.val().toUpperCase();
                                            });
                                        if (dataFilter != undefined && dataFilter.length > 0){
                                            that.setValue(dataFilter);
                                        }else{
                                            that.clear(true);
                                        }
                                    }
                                });
                            }
                        }


                    }else{
                        this.setValue(rs);
                    }
                }

                if (this.$grid.is(':visible') && this.$input.val() != ''){
                    this.clear(true);
                }

                if (this.options.textValue == this.$input.val()){
                    var synEl = this.options.synElement;
                    if (synEl.length > 0) {
                        for (var i = 0; i < synEl.length; i++) {
                            $("#" + synEl[i].elId).val(synEl[i].value);
                        }
                    }
                }
            }

        }
        , search: function (ev) {
            console.log('search');
            if ((this.oldsearch != this.$input.val()) || (this.oldsearch == this.$input.val() && this.$input.val() == '')) {
                //$(".l3loading").removeClass('hide');
                this.oldsearch = this.$input.val();
                if (this.options.request.local == true){
                    console.log(this.options.gridConfig.dataModel);
                    var temp = this.options.gridConfig.dataModel.data;
                    var that = this;
                    var data = $.grep(temp, function (row, index) {
                        return row[that.options.dataBind].toUpperCase().indexOf(that.$input.val().toUpperCase()) != -1;
                    });

                    that.$grid.pqGrid("option", "dataModel.data", data);
                    //var data = JSON.parse(data);
                    if (data.length > 0) {
                        if (data.length > 1) {
                            console.log("go here");
                            that.$parentBound.fadeIn("slow", function () {});
                        }
                        else {
                            that.setValue(data);
                        }
                        that.$grid.pqGrid('refreshDataAndView');
                        that.$grid.pqGrid("setSelection", {rowIndx: 0});
                    } else {//Neu nhap ngoai ngan sach
                        that.$parentBound.hide();
                        that.$input.val('');
                        //X�a c�c textbox ph? thu?c
                        var synEl = that.options.synElement;
                        if (synEl.length > 0) {
                            for (i = 0; i < synEl.length; i++) {
                                $("#" + synEl[i].elId).val("");
                            }
                        }
                        that.$input.focus();
                        //that.oldIndx = 0;
                        ev.stopPropagation();
                        ev.preventDefault();
                    }
                }else{
                    if (this.options.request.restful) {
                        var that = this;
                        console.log(this.$grid);
                        $.post(this.options.request.url, this.options.request.encodedata.replace('?', this.$input.val()), function (data) {
                            $(".l3loading").addClass('hide');
                            console.log("post");
                            that.$grid.pqGrid("option", "dataModel.data", JSON.parse(data));
                            var data = JSON.parse(data);
                            if (data.length > 0) {
                                if (data.length > 1) {
                                    that.$parentBound.fadeIn("slow", function () {
                                        //that.$parentBound.show();
                                    });
                                }

                                else {
                                    that.setValue(data);
                                }
                                that.$grid.pqGrid('refreshDataAndView');
                                that.$grid.pqGrid("setSelection", {rowIndx: 0});
                            } else {//Neu nhap ngoai ngan sach
                                that.$parentBound.hide();
                                that.$input.val('');
                                //X�a c�c textbox ph? thu?c
                                var synEl = that.options.synElement;
                                if (synEl.length > 0) {
                                    for (i = 0; i < synEl.length; i++) {
                                        $("#" + synEl[i].elId).val("");
                                    }
                                }
                                that.$input.focus();
                                //that.oldIndx = 0;
                                ev.stopPropagation();
                                ev.preventDefault();
                            }
                        });
                    }else{
                        var that = this;
                        $.ajax({
                            method: "POST",
                            url: this.options.request.url,
                            dataType: 'json',
                            async: true,
                            data: {do: this.options.request.action, StrSearch: this.$input.val()},
                            success: function (data) {
                                //$(".l3loading").addClass('hide');
                                console.log("post");
                                that.$grid.pqGrid("option", "dataModel.data", data);
                                //var data = JSON.parse(data);
                                if (data.length > 0) {
                                    if (data.length > 1) {
                                        that.$parentBound.fadeIn("slow", function () {});
                                    }
                                    else {
                                        that.setValue(data);
                                    }
                                    that.$grid.pqGrid('refreshDataAndView');
                                    that.$grid.pqGrid("setSelection", {rowIndx: 0});
                                } else {//Neu nhap ngoai ngan sach
                                    that.$parentBound.hide();
                                    that.$input.val('');
                                    //X�a c�c textbox ph? thu?c
                                    var synEl = that.options.synElement;
                                    if (synEl.length > 0) {
                                        for (i = 0; i < synEl.length; i++) {
                                            $("#" + synEl[i].elId).val("");
                                        }
                                    }
                                    that.$input.focus();
                                    //that.oldIndx = 0;
                                    ev.stopPropagation();
                                    ev.preventDefault();
                                }
                            }
                        });
                    }
                }

            }
            // n?u ?� t�m ch? hi?n th? l?i ?? tr�nh load l?i d? li?u
            else {
                //Trường hợp này là đã có search 1 lần rồi, nên giờ không search nữa
                var data = this.$grid.pqGrid("option", "dataModel.data");
                ////console.log('legrid');
                if (data.length > 0) {
                    if (data.length > 1)
                        //this.$parentBound.show();
                        this.$parentBound.fadeIn("slow", function () {
                            //that.$parentBound.show();
                        });
                    else {
                 /*       var synEl = this.options.synElement;
                        if (synEl.length > 0) {
                            for (var i = 0; i < synEl.length; i++) {
                                $("#" + synEl[i].elId).val(data[0][synEl[i].dataIndx]);
                            }
                        }
                        $("#" + this.options.gridConfig.focusElement).focus();*/
                        this.setValue(data);
                    }
                    this.$grid.pqGrid("setSelection", {rowIndx: 0});
                } else {//Nếu giá trị tìm trùng với giá trị ở trường hợp sửa màn hình.
                    var synEl = this.options.synElement;
                    if (synEl.length > 0) {
                        for (var i = 0; i < synEl.length; i++) {
                            $("#" + synEl[i].elId).val(synEl[i].value);
                        }
                    }
                    $("#" + this.options.gridConfig.focusElement).focus();
                }
            }
        }
        , clear: function (all) {
            var synEl = this.options.synElement;
            if (synEl.length > 0) {
                for (var i = 0; i < synEl.length; i++) {
                    if (all == false && this.$input.attr('id') == synEl[i].elId) {
                        //trường hợp all = true thì mới xóa luôn cái khóa,
                        // ngược lại chỉ xóa các trường phụ thuộc thôi
                    } else {
                        $("#" + synEl[i].elId).val("");
                    }

                }
            }
            //this.oldIndx = 0;
        }
        , setValue: function(data){
            var synEl = this.options.synElement;
            if (synEl.length > 0) {
                for (var i = 0; i < synEl.length; i++) {
                    $("#" + synEl[i].elId).val(data[0][synEl[i].dataIndx]);
                }
            }
            $("#" + this.options.gridConfig.focusElement).focus();
        }
        , triggerSearch: function () {
            var e = jQuery.Event('keydown', {which: $.ui.keyCode.ENTER}); //Đoạn code này khá hay
            this.$input.trigger(e);
        }
        , triggerContainer: function (e) {
            console.log('triggerContainer');
            if (e.target.id != this.options.textID && e.target.id != 'span' + this.options.textID && e.target.id != 'iCon' + this.options.textID)
                this.$parentBound.hide();
            //Check
            /*if (this.options.textValue != this.$input.val()){
                var dataObject = this.$grid.pqGrid("option", "dataModel.data");
                var rs = $.grep(dataObject, function (data, index) {
                    //return data[settings.dataBind].toUpperCase().indexOf(el.val().toUpperCase()) >= 0;
                    return data[this.options.dataBind].toUpperCase() == this.$input.val().toUpperCase();
                });
                if (rs.length == 0){
                    this.clear(true);
                }else{
                    /!*var synEl = this.options.synElement;
                    if (synEl.length > 0) {
                        for (var i = 0; i < synEl.length; i++) {
                            $("#" + synEl[i].elId).val(rs[0][synEl[i].dataIndx]);
                        }
                    }*!/
                    this.setValue(rs);
                }
            }else{
                var synEl = this.options.synElement;
                if (synEl.length > 0) {
                    for (var i = 0; i < synEl.length; i++) {
                        //console.log("#" + synEl[i].elId + "-" + synEl[i].value);
                        $("#" + synEl[i].elId).val(synEl[i].value);
                    }
                }
            }*/
        }
    };
    $.fn.digiCombo = function (option) {
        console.log('digiCombo');
        var func = this.each(function () {
            var $this = $(this)
                , data = $this.data('digiCombo')
                , options = typeof option == 'object' && option;
            if (!data) {
                $this.data('digiCombo', (data = new DigiCombo(this, option)));
                console.log($this.data('digiCombo'));
            }
            if (typeof option == 'string') {
                console.log('string');
                data[option]();
            }
        });
        //console.log(func);
        return func;
    };
    //$.fn.digiCombo.Constructor = DigiCombo;
}(jQuery));