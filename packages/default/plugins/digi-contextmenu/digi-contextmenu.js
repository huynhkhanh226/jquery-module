function digiContextMenu(options) {
    this.options = $.extend({
        showText: false,
        buttonList: [
            {
                ID: "",
                icon: "",
                title: "",
                enable: true,
                hidden: false,
                type: "button",
            }
        ]
    }, options);

    var list = this.options.buttonList;
    var str = "";
    str = '<div class="btn-group btnGroupLW4">';
    str += '<button type="button" onclick="showMenuAction(this);" class="btn btn-default dropdown-toggle btnButtonLW4" data-toggle="dropdown">';
    str += '<span class="fa fa-ellipsis-h" style="font-size: 200%; color: #367FA9"></span>';
    str += '</button>';
    str += '<ul class="dropdown-menu menuActionButton">';
    for (var i = 0; i < list.length; i++) {
        var id = list[i].ID;
        var icon = list[i].icon;
        var title = list[i].title;
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

        var type = list[i].type

        if (typeof list[i].enable == "function") {
            var disable = list[i].enable() ? '' : 'disabled';
        } else {
            var disable = list[i].enable ? '' : 'disabled';
        }


        /*if (hidden == false) {
            if (render(list[i]) != undefined) {
                str += render(list[i]);
            } else {
                str += '<button id="' + id + '" title="' + placeHolder + '" type="button" ' + disable + ' class="btn btn-default smallbtn mgr5"><span class="' + icon + ' mgr5"></span>' + title + '</button>';
            }
        }*/
        if (hidden == false) {
            str += '<li><a type="button" title="' + title + '" id="' + id + '" class="' + id + ' pull-left " ' + disable + '  ><i class="' + icon + ' pull-left pdt5"></i><span>' + title + '</span></a></li>';
        }


    }
    str += '</ul>';
    str += '</div>';

    return {
        text: str,
        cls: "overflow-visible"
    };

};

//set heght cho menu
function showMenuAction(el) {
    var height = $(el).parents('.pq-grid').height();

    var topParent = $(el).parents('.pq-grid').offset().top;
    var topChild = $(el).offset().top;
    var top = topChild - topParent;
    var menu = $(el).parents('.btnGroupLW4').find('.menuActionButton');
    if ((height - top) < 163) {
        menu.css('top', 'auto');
        menu.css('bottom', '100%');
    } else {
        menu.attr('style', '');
    }

    //get id grid
    // var id = $(el).closest('.pq-grid').attr('id');
    // var $grid = $("#" + id);
    //
    // var $td = $(el).closest('td');
    // console.log($td);
    // var top = $td.offset().top;

    // var bottom = $grid.pqGrid('option', 'height') - top;
    //
    // var right = $(window).width() - left;
    // var height = $(el).parents('.btnGroupLW4').find('.menuActionButton').height()
    // if (bottom < height) {
    //     top = parseInt(top - height - $td.outerHeight());
    // }
    // var width = $(el).parents('.btnGroupLW4').find('.menuActionButton').width()
    // if (right < width) {
    //     left = left - width + $td.width() + 15;
    // } else {
    //     left = left + 2;
    // }

    // this.marginTop = top;
    // this.marginLeft = left;
    // var menu = $(el).parents('.btnGroupLW4').find('.menuActionButton');
    // var bottom = $grid.pqGrid('option', 'height') - top;
    // var height = $(el).parents('.btnGroupLW4').find('.menuActionButton').height()
    // if (bottom < height) {
    //     top = parseInt(top - height);
    // }
    //menu.css('top', top);

}

function getTopLeft(grid, subGrid) {
    var $grid = $("#" + grid);
    var $subGrid = $("#" + subGrid);
    var obj = $grid.pqGrid("getEditCell");
    var $td = obj.$td;

    var top = parseInt($td.offset().top - $grid.offset().top) + $td.outerHeight();
    var left = parseInt($td.offset().left);

    var bottom = $grid.pqGrid('option', 'height') - top;
    var right = $(window).width() - left;

    if (bottom < $subGrid.pqGrid('option', 'height')) {
        top = parseInt(top - $subGrid.pqGrid('option', 'height') - $td.outerHeight());
    }

    if (right < $subGrid.pqGrid('option', 'width')) {
        left = left - $subGrid.pqGrid('option', 'width') + $td.width() + 15;
    } else {
        left = left + 2;
    }

    this.marginTop = top;
    this.marginLeft = left;
}

