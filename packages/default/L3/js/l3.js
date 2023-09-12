/**
 * Created by THANHHUYEN on 19/11/2015.
 */
//H�m ki?m tra nh?p s? (0123456789)
function inputNumber(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    var key = (e.which) ? e.which : e.keyCode;
    if ($.inArray(key, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A
        (key == 65 && e.ctrlKey === true) ||
        // Allow: Ctrl+C
        (key == 67 && e.ctrlKey === true) ||
        // Allow: Ctrl+X
        (key == 88 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (key >= 35 && key <= 39)) {
        // let it happen, don't do anything
        return true;
    }
    // Ensure that it is a number and stop the keypress
    if (key > 47 && key < 58) {
        return true;
    }
    return false;
}
Array.prototype.contains = function (obj) {
    var i = this.length;
    while (i--) {
        if (this[i] === obj) {
            return true;
        }
    }
    return false;
};

function isRightClick(e) {
    if (e.which) {
        return (e.which == 3);
    } else if (e.button) {
        return (e.button == 2);
    }
    return false;
}

String.prototype.paddingLeft = function (paddingValue) {
    return String(paddingValue + this).slice(-paddingValue.length);
};

function returnSFormat(num) {
    if (num==0)return "##,###";
    return "##,###." + "00000000".substr(8 - num);
}

var L3tableToArray = function (tab) {
    var d = [], a = [];
    b = $(tab).children("tbody").children("tr");
    var head = $(tab).children("thead").children("tr");
    var khead = head.length ? $(head[0]) : $();
    khead.children("th,td").each(function (g, t) {
        var b = $(t), tit = b.html(), w = b.width(), al = "left", mw = 50, dt="string", fo = "";
        var f = b.attr("align");
        al = f == undefined ? al : f;
        f = b.attr("minWidth");
        mw = f == undefined ? mw : f;
        f = b.attr("dataType");
        dt = f == undefined ? dt : f;
        f = b.attr("format");
        fo = f == undefined ? fo : f;
        d.push({title: tit, "width": w, dataType: dt, align: al, dataIndx: g, minWidth: mw, format: fo});
    });
    b.each(function (e, t) {
        // if (0 != e) {
        var b = [];
        $(t).children("td").each(function (e, g) {
            b.push($.trim($(g).html()))
        });
        a.push(b);
        // }
    });
    return {data: a, colModel: d}
};
