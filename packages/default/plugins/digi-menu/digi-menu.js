/* =============================================================
 * bootstrap-combobox.js v1.1.8
 * =============================================================
 * Copyright 2012 Daniel Farrell
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */
/*
 * Editor: Khanh Huynh */
(function ($) {

    "use strict";

    /* COMBOBOX PUBLIC CLASS DEFINITION
     * ================================ */

    var DigiMenu = function (element, options) {
        //console.log(options);
        this.options = $.extend({
            showText: false,
            style: "",
            clas: "",
            buttonList: [
                {
                    ID: "",
                    icon: "",
                    title: "",
                    enable: true,
                    hidden: false,
                    cls: "",
                    type: "button",
                    render: function (ui) {
                    },
                    postRender: function (ui) {
                    }
                }
            ],
            focusButton: ""
        }, options);

        this.$source = $(element);
        this.$container = this.setup();
        this.createPostRender();
        this.listen();
        this.enableContainer();
    };

    DigiMenu.prototype = {
        constructor: DigiMenu
        , template: function () { //khai bao template
            var list = this.options.buttonList;
            var cls = this.options.cls == undefined ? "" : this.options.cls;
            var style = this.options.style == undefined ? "" : this.options.style;


            var str = "<div class='toolbar-menu " + cls + "' style='display: inline-block;width: 100%; " + style + "'>";
            for (var i = 0; i < list.length; i++) {
                var id = list[i].ID;
                var icon = list[i].icon;
                var title = list[i].title;
                var cls = list[i].cls == undefined ? "" : list[i].cls;
                var placeHolder = list[i].title;
                //console.log(list[i]);
                if (this.options.showText == false) {
                    title = "";
                }
                if (typeof list[i].hidden == "function") {
                    var hidden = list[i].hidden();
                } else {
                    var hidden = list[i].hidden;
                }
                var render = list[i].render;
                var type = list[i].type
               // console.log(disable);
                if (typeof list[i].enable == "function") {
                    var disable = list[i].enable() ? '' : 'disabled';
                } else {
                    var disable = list[i].enable ? '' : 'disabled';
                }


                if (hidden == false) {
                    if (render(list[i]) != undefined) {
                        str += render(list[i]);
                    } else {
                        str += '<button type="' + type + '"  id="' + id + '" title="' + placeHolder + '" type="button" ' + disable + ' class="btn btn-default smallbtn mgr5 ' + cls + '"><span class="' + icon + ' mgr5"></span>' + title + '</button>';
                    }

                } else {
                    if (type == "submit") {
                        if (render(list[i]) != undefined) {
                            str += render(list[i]);
                        } else {
                            str += '<button type="' + type + '"  id="' + id + '" title="' + placeHolder + '" type="button" ' + disable + ' class="btn btn-default smallbtn mgr5 hide ' + cls + '"><span class="' + icon + ' mgr5"></span>' + title + '</button>';
                        }
                    }

                }


            }
            str += "</div>";
            return str;
        }
        , setup: function () {
            var template = $(this.template());
            this.$source.html(template);
            return template;
        }
        , createPostRender: function () {
            var list = this.options.buttonList;
            for (var i = 0; i < list.length; i++) {
                var btn = list[i];
                if (btn.postRender) {
                    var ui = list[i];
                    ui.$btn = this.$source.find("#" + ui.ID);
                    this.options.buttonList[i].$btn = this.$source.find("#" + ui.ID);
                    btn.postRender(ui);
                }
            }
        }
        , disable: function (id) {
            var $btn = this.$source.find("#" + id)
            $btn.attr("disabled", true);

        }
        , enable: function (id) {
            var $btn = this.$source.find("#" + id)
            $btn.removeAttr("disabled");

        }
        , getFocusButton: function () {
            return this.options.focusButton;
        }
        , hide: function (id) {
            var $btn = this.$source.find("#" + id)
            $btn.addClass('hide');
            this.enableContainer();
        }
        , show: function (id) {
            var $btn = this.$source.find("#" + id)
            $btn.removeClass('hide');
            this.enableContainer();
        }
        , listen: function () {
            for (var i = 0; i < this.options.buttonList.length; i++) {
                if (this.options.buttonList[i].type == "button") {
                    this.options.buttonList[i].$btn
                        .on('mouseover', $.proxy(this.click, [this.options, this.options.buttonList[i].$btn]));
                    //.on('blur', $.proxy(this.blur, this))
                    //.on('keypress', $.proxy(this.keypress, this))
                    //.on('keyup', $.proxy(this.keyup, this));
                }

            }

        }
        , click: function () {
            var id = this[1].attr("id");
            var option = this[0];
            option.focusButton = id;
            //console.log(option);
        }
        , enableContainer: function () {
            console.log("debug");
            var els = this.$source.find("button").filter("[type ='button']").length;
            var hides = this.$source.find("button").filter("[type ='button']").filter("[class~='hide']").length;
            if (els == hides) {
                this.$source.addClass("hide");
            } else {
                this.$source.removeClass("hide");
            }
        }

    };

    /* COMBOBOX PLUGIN DEFINITION
     * =========================== */
    $.fn.digiMenu = function (option) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('digiMenu')
                , options = typeof option == 'object' && option;
            if (!data) {
                $this.data('digiMenu', (data = new DigiMenu(this, options)));
            }
            if (typeof option == 'string') {
                data[option]();
            }
        });
    };

    //$.fn.combobox.Constructor = Combobox;

}(window.jQuery));
