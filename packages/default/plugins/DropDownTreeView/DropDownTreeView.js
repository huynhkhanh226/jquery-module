(function ($) {

    $.fn.dxDropDownBoxTreeLoad = function (options) {
        var ob = this.dxDropDownBox("instance");
        var defaults = {
            sValueMember: "",
            sDisplayMember: "",
            dataSource: null
        };

        var settings = $.extend(defaults, options);

        ob.option("dataSource", new DevExpress.data.CustomStore({
            loadMode: "raw",
            key: settings.sValueMember,
            load: function () { return settings.dataSource; }
        }));
        ob.option("valueExpr", settings.sValueMember);
        ob.option("displayExpr", settings.sDisplayMember);
        ob.option("showClearButton", true);
        return this;
    }

    $.fn.dxDropDownBoxTreeTemplateMultiSelect = function (sParentId) {
        var ob = this.dxDropDownBox("instance");
        var sID = this.attr('id') + "contentTemplate";
        ob.option("contentTemplate", function (e) {
            var value = e.component.option("value"),
                $treeView = $("<div>").attr('id', sID).dxTreeView({
                    dataSource: e.component.option("dataSource"),
                    searchEnabled: true,
                    dataStructure: "plain",    // mảng cấu trúc đơn giản chứa trường parentId
                    keyExpr: ob.option("valueExpr"),
                    parentIdExpr: sParentId,
                    selectionMode: "multiple",
                    displayExpr: ob.option("displayExpr"),
                    selectByClick: true,

                    onContentReady: function (args) {
                        syncTreeViewSelection(args.component, value);
                    },
                    selectNodesRecursive: false,
                    showCheckBoxesMode: "selectAll",   //normal, selectAll
                    onItemSelectionChanged: function (args) {
                        var value = args.component.getSelectedNodesKeys();

                        e.component.option("value", value);
                    }
                })

            treeView = $treeView.dxTreeView("instance");

            e.component.on("valueChanged", function (args) {
                var value = args.value;
                syncTreeViewSelection(treeView, value);
            });

            return $treeView;
        });
    }

    $.fn.dxDropDownBoxTreeDisable = function (bool) {
        var ob = this.dxDropDownBox("instance");
        ob.option("disabled", bool);
    }

    // Get giá trị
    $.fn.dxDropDownBoxTreeGetValue = function () {
        var ob = this.dxDropDownBox("instance").option("value");
        //console.log(typeof(ob));
        if(typeof(ob) != 'object'){//nếu ko phải obj convert qua obj
            ob = [ob];
        }
        //console.log(ob);
        if(ob == null){
            return '';
        }else{
            return ob[0];
        }
    }

    // Set giá trị
    $.fn.dxDropDownBoxTreeSelectValue = function (arrSelects) {
        var ob = this.dxDropDownBox("instance");
        ob.option("value", arrSelects);
        return this;
    }

    $.fn.dxDropDownBoxTreeTemplateSingleSelect = function (sParentId) {
        var ob = this.dxDropDownBox("instance");
        var sID = this.attr('id') + "contentTemplate";
        ob.option("contentTemplate", function (e) {
            var value = e.component.option("value"),
                $treeView = $("<div>").attr('id', sID).dxTreeView({
                    dataSource: e.component.option("dataSource"),
                    searchEnabled: true,
                    dataStructure: "plain",    // mảng cấu trúc đơn giản chứa trường parentId
                    keyExpr: ob.option("valueExpr"),
                    parentIdExpr: sParentId,
                    selectionMode: "single",
                    displayExpr: ob.option("displayExpr"),
                    selectByClick: true,
                    onContentReady: function (args) {
                        syncTreeViewSelection(args.component, value);
                    },
                    selectNodesRecursive: false,
                    showCheckBoxesMode: "none",
                    onItemSelectionChanged: function (args) {
                        var value = args.component.getSelectedNodesKeys();

                        if (value.length != 0) {
                            e.component.option("value", value);
                        }
                    }
                })

            treeView = $treeView.dxTreeView("instance");

            e.component.on("valueChanged", function (args) {
                var value = args.value;
                syncTreeViewSelection(treeView, value);
                ob.close();//đóng dropdown sao khi chọn
                //alert('sdsd');
            });

            return $treeView;
        });
    }

    


    var syncTreeViewSelection = function (treeView, value) {
        //console.log(value, typeof(value));
        if(typeof(value) != 'object'){
            value = [value];
        }
        //console.log(value, typeof(value));
        if (!value) {
            treeView.unselectAll();
            return;
        }

        value.forEach(function (key) {
            treeView.selectItem(key);
        });
    };

}(jQuery))

