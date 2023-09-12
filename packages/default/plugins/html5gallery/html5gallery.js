/** HTML5 Gallery - jQuery Image and Video Gallery Plugin
 * Copyright 2014 Magic Hills Pty Ltd All Rights Reserved
 * Website: http://html5box.com
 * Version 7.5
 */
(function () {
    for (var s = document.getElementsByTagName("script"), w = "", m = 0; m < s.length; m++)s[m].src && s[m].src.match(/html5gallery\.js/i) && (w = s[m].src.substr(0, s[m].src.lastIndexOf("/") + 1));
    s = !1;
    if ("undefined" == typeof jQuery)s = !0; else if (m = jQuery.fn.jquery.split("."), 1 > m[0] || 1 == m[0] && 6 > m[1])s = !0;
    if (s) {
        var s = document.getElementsByTagName("head")[0], v = document.createElement("script");
        v.setAttribute("type", "text/javascript");
        v.readyState ? v.onreadystatechange = function () {
            if ("loaded" == v.readyState || "complete" ==
                v.readyState)v.onreadystatechange = null, loadHtml5Gallery(w)
        } : v.onload = function () {
            loadHtml5Gallery(w)
        };
        v.setAttribute("src", w + "jquery.js");
        s.appendChild(v)
    } else loadHtml5Gallery(w)
})();
function loadHtml5Gallery(s) {
    jQuery.easing.jswing = jQuery.easing.swing;
    jQuery.extend(jQuery.easing, {
        def: "easeOutQuad", swing: function (b, e, a, c, d) {
            return jQuery.easing[jQuery.easing.def](b, e, a, c, d)
        }, easeInQuad: function (b, e, a, c, d) {
            return c * (e /= d) * e + a
        }, easeOutQuad: function (b, e, a, c, d) {
            return -c * (e /= d) * (e - 2) + a
        }, easeInOutQuad: function (b, e, a, c, d) {
            return 1 > (e /= d / 2) ? c / 2 * e * e + a : -c / 2 * (--e * (e - 2) - 1) + a
        }, easeInCubic: function (b, e, a, c, d) {
            return c * (e /= d) * e * e + a
        }, easeOutCubic: function (b, e, a, c, d) {
            return c * ((e = e / d - 1) * e * e + 1) +
                a
        }, easeInOutCubic: function (b, e, a, c, d) {
            return 1 > (e /= d / 2) ? c / 2 * e * e * e + a : c / 2 * ((e -= 2) * e * e + 2) + a
        }, easeInQuart: function (b, e, a, c, d) {
            return c * (e /= d) * e * e * e + a
        }, easeOutQuart: function (b, e, a, c, d) {
            return -c * ((e = e / d - 1) * e * e * e - 1) + a
        }, easeInOutQuart: function (b, e, a, c, d) {
            return 1 > (e /= d / 2) ? c / 2 * e * e * e * e + a : -c / 2 * ((e -= 2) * e * e * e - 2) + a
        }, easeInQuint: function (b, e, a, c, d) {
            return c * (e /= d) * e * e * e * e + a
        }, easeOutQuint: function (b, e, a, c, d) {
            return c * ((e = e / d - 1) * e * e * e * e + 1) + a
        }, easeInOutQuint: function (b, e, a, c, d) {
            return 1 > (e /= d / 2) ? c / 2 * e * e * e * e * e + a : c /
            2 * ((e -= 2) * e * e * e * e + 2) + a
        }, easeInSine: function (b, e, a, c, d) {
            return -c * Math.cos(e / d * (Math.PI / 2)) + c + a
        }, easeOutSine: function (b, e, a, c, d) {
            return c * Math.sin(e / d * (Math.PI / 2)) + a
        }, easeInOutSine: function (b, e, a, c, d) {
            return -c / 2 * (Math.cos(Math.PI * e / d) - 1) + a
        }, easeInExpo: function (b, e, a, c, d) {
            return 0 == e ? a : c * Math.pow(2, 10 * (e / d - 1)) + a
        }, easeOutExpo: function (b, e, a, c, d) {
            return e == d ? a + c : c * (-Math.pow(2, -10 * e / d) + 1) + a
        }, easeInOutExpo: function (b, e, a, c, d) {
            return 0 == e ? a : e == d ? a + c : 1 > (e /= d / 2) ? c / 2 * Math.pow(2, 10 * (e - 1)) + a : c / 2 * (-Math.pow(2,
                -10 * --e) + 2) + a
        }, easeInCirc: function (b, e, a, c, d) {
            return -c * (Math.sqrt(1 - (e /= d) * e) - 1) + a
        }, easeOutCirc: function (b, e, a, c, d) {
            return c * Math.sqrt(1 - (e = e / d - 1) * e) + a
        }, easeInOutCirc: function (b, e, a, c, d) {
            return 1 > (e /= d / 2) ? -c / 2 * (Math.sqrt(1 - e * e) - 1) + a : c / 2 * (Math.sqrt(1 - (e -= 2) * e) + 1) + a
        }, easeInElastic: function (b, e, a, c, d) {
            b = 1.70158;
            var k = 0, f = c;
            if (0 == e)return a;
            if (1 == (e /= d))return a + c;
            k || (k = 0.3 * d);
            f < Math.abs(c) ? (f = c, b = k / 4) : b = k / (2 * Math.PI) * Math.asin(c / f);
            return -(f * Math.pow(2, 10 * (e -= 1)) * Math.sin((e * d - b) * 2 * Math.PI / k)) + a
        }, easeOutElastic: function (b,
                                     e, a, c, d) {
            b = 1.70158;
            var k = 0, f = c;
            if (0 == e)return a;
            if (1 == (e /= d))return a + c;
            k || (k = 0.3 * d);
            f < Math.abs(c) ? (f = c, b = k / 4) : b = k / (2 * Math.PI) * Math.asin(c / f);
            return f * Math.pow(2, -10 * e) * Math.sin((e * d - b) * 2 * Math.PI / k) + c + a
        }, easeInOutElastic: function (b, e, a, c, d) {
            b = 1.70158;
            var k = 0, f = c;
            if (0 == e)return a;
            if (2 == (e /= d / 2))return a + c;
            k || (k = d * 0.3 * 1.5);
            f < Math.abs(c) ? (f = c, b = k / 4) : b = k / (2 * Math.PI) * Math.asin(c / f);
            return 1 > e ? -0.5 * f * Math.pow(2, 10 * (e -= 1)) * Math.sin((e * d - b) * 2 * Math.PI / k) + a : 0.5 * f * Math.pow(2, -10 * (e -= 1)) * Math.sin((e * d - b) * 2 * Math.PI /
                k) + c + a
        }, easeInBack: function (b, e, a, c, d, k) {
            void 0 == k && (k = 1.70158);
            return c * (e /= d) * e * ((k + 1) * e - k) + a
        }, easeOutBack: function (b, e, a, c, d, k) {
            void 0 == k && (k = 1.70158);
            return c * ((e = e / d - 1) * e * ((k + 1) * e + k) + 1) + a
        }, easeInOutBack: function (b, e, a, c, d, k) {
            void 0 == k && (k = 1.70158);
            return 1 > (e /= d / 2) ? c / 2 * e * e * (((k *= 1.525) + 1) * e - k) + a : c / 2 * ((e -= 2) * e * (((k *= 1.525) + 1) * e + k) + 2) + a
        }, easeInBounce: function (b, e, a, c, d) {
            return c - jQuery.easing.easeOutBounce(b, d - e, 0, c, d) + a
        }, easeOutBounce: function (b, e, a, c, d) {
            return (e /= d) < 1 / 2.75 ? c * 7.5625 * e * e + a : e < 2 /
            2.75 ? c * (7.5625 * (e -= 1.5 / 2.75) * e + 0.75) + a : e < 2.5 / 2.75 ? c * (7.5625 * (e -= 2.25 / 2.75) * e + 0.9375) + a : c * (7.5625 * (e -= 2.625 / 2.75) * e + 0.984375) + a
        }, easeInOutBounce: function (b, e, a, c, d) {
            return e < d / 2 ? 0.5 * jQuery.easing.easeInBounce(b, 2 * e, 0, c, d) + a : 0.5 * jQuery.easing.easeOutBounce(b, 2 * e - d, 0, c, d) + 0.5 * c + a
        }
    });
    var w = jQuery;
    w.fn.touchSwipe = function (b) {
        var e = {preventWebBrowser: !1, swipeLeft: null, swipeRight: null, swipeTop: null, swipeBottom: null};
        b && w.extend(e, b);
        return this.each(function () {
            function a(a) {
                var b = a.originalEvent;
                1 <= b.targetTouches.length ?
                    (f = b.targetTouches[0].pageX, h = b.targetTouches[0].pageY) : k(a)
            }

            function b(a) {
                e.preventWebBrowser && a.preventDefault();
                var d = a.originalEvent;
                1 <= d.targetTouches.length ? (j = d.targetTouches[0].pageX, g = d.targetTouches[0].pageY) : k(a)
            }

            function d(a) {
                if (0 < j || 0 < g)100 < Math.abs(j - f) && (j > f ? e.swipeRight && e.swipeRight.call() : e.swipeLeft && e.swipeLeft.call()), 100 < Math.abs(g - h) && (g > h ? e.swipeBottom && e.swipeBottom.call() : e.swipeTop && e.swipeTop.call());
                k(a)
            }

            function k() {
                g = j = h = f = -1
            }

            var f = -1, h = -1, j = -1, g = -1;
            try {
                w(this).bind("touchstart",
                    a), w(this).bind("touchmove", b), w(this).bind("touchend", d), w(this).bind("touchcancel", k)
            } catch (S) {
            }
        })
    };
    var m = jQuery;
    m.fn.drag = function (b, e, a) {
        var c = "string" == typeof b ? b : "", d = m.isFunction(b) ? b : m.isFunction(e) ? e : null;
        0 !== c.indexOf("drag") && (c = "drag" + c);
        a = (b == d ? e : a) || {};
        return d ? this.bind(c, a, d) : this.trigger(c)
    };
    var v = m.event, x = v.special, q = null, q = x.drag = {
        defaults: {which: 1, distance: 0, not: ":input", handle: null, relative: !1, drop: !0, click: !1},
        datakey: "dragdata",
        livekey: "livedrag",
        add: function (b) {
            var e = m.data(this,
                q.datakey), a = b.data || {};
            e.related += 1;
            !e.live && b.selector && (e.live = !0, v.add(this, "draginit." + q.livekey, q.delegate));
            m.each(q.defaults, function (b) {
                void 0 !== a[b] && (e[b] = a[b])
            })
        },
        remove: function () {
            m.data(this, q.datakey).related -= 1
        },
        setup: function () {
            if (!m.data(this, q.datakey)) {
                var b = m.extend({related: 0}, q.defaults);
                m.data(this, q.datakey, b);
                v.add(this, "mousedown", q.init, b);
                this.attachEvent && this.attachEvent("ondragstart", q.dontstart)
            }
        },
        teardown: function () {
            m.data(this, q.datakey).related || (m.removeData(this,
                q.datakey), v.remove(this, "mousedown", q.init), v.remove(this, "draginit", q.delegate), q.textselect(!0), this.detachEvent && this.detachEvent("ondragstart", q.dontstart))
        },
        init: function (b) {
            var e = b.data, a;
            if (!(0 < e.which && b.which != e.which) && !m(b.target).is(e.not) && (!e.handle || m(b.target).closest(e.handle, b.currentTarget).length))if (e.propagates = 1, e.interactions = [q.interaction(this, e)], e.target = b.target, e.pageX = b.pageX, e.pageY = b.pageY, e.dragging = null, a = q.hijack(b, "draginit", e), e.propagates) {
                if ((a = q.flatten(a)) &&
                    a.length)e.interactions = [], m.each(a, function () {
                    e.interactions.push(q.interaction(this, e))
                });
                e.propagates = e.interactions.length;
                !1 !== e.drop && x.drop && x.drop.handler(b, e);
                q.textselect(!1);
                v.add(document, "mousemove mouseup", q.handler, e);
                return !1
            }
        },
        interaction: function (b, e) {
            return {
                drag: b,
                callback: new q.callback,
                droppable: [],
                offset: m(b)[e.relative ? "position" : "offset"]() || {top: 0, left: 0}
            }
        },
        handler: function (b) {
            var e = b.data;
            switch (b.type) {
                case !e.dragging && "mousemove":
                    if (Math.pow(b.pageX - e.pageX, 2) + Math.pow(b.pageY -
                            e.pageY, 2) < Math.pow(e.distance, 2))break;
                    b.target = e.target;
                    q.hijack(b, "dragstart", e);
                    e.propagates && (e.dragging = !0);
                case "mousemove":
                    if (e.dragging) {
                        q.hijack(b, "drag", e);
                        if (e.propagates) {
                            !1 !== e.drop && x.drop && x.drop.handler(b, e);
                            break
                        }
                        b.type = "mouseup"
                    }
                case "mouseup":
                    v.remove(document, "mousemove mouseup", q.handler), e.dragging && (!1 !== e.drop && x.drop && x.drop.handler(b, e), q.hijack(b, "dragend", e)), q.textselect(!0), !1 === e.click && e.dragging && (jQuery.event.triggered = !0, setTimeout(function () {
                        jQuery.event.triggered = !1
                    }, 20), e.dragging = !1)
            }
        },
        delegate: function (b) {
            var e = [], a, c = m.data(this, "events") || {};
            m.each(c.live || [], function (d, c) {
                if (0 === c.preType.indexOf("drag") && (a = m(b.target).closest(c.selector, b.currentTarget)[0]))v.add(a, c.origType + "." + q.livekey, c.origHandler, c.data), 0 > m.inArray(a, e) && e.push(a)
            });
            return !e.length ? !1 : m(e).bind("dragend." + q.livekey, function () {
                v.remove(this, "." + q.livekey)
            })
        },
        hijack: function (b, e, a, c, d) {
            if (a) {
                var k = b.originalEvent, f = b.type, h = e.indexOf("drop") ? "drag" : "drop", j, g = c || 0, t, p;
                c = !isNaN(c) ?
                    c : a.interactions.length;
                b.type = e;
                b.originalEvent = null;
                a.results = [];
                do if ((t = a.interactions[g]) && !("dragend" !== e && t.cancelled))p = q.properties(b, a, t), t.results = [], m(d || t[h] || a.droppable).each(function (d, c) {
                    p.target = c;
                    j = v.handle ? c ? v.handle.call(c, b, p) : null : c ? v.dispatch.call(c, b, p) : null;
                    !1 === j ? ("drag" == h && (t.cancelled = !0, a.propagates -= 1), "drop" == e && (t[h][d] = null)) : "dropinit" == e && t.droppable.push(q.element(j) || c);
                    "dragstart" == e && (t.proxy = m(q.element(j) || t.drag)[0]);
                    t.results.push(j);
                    delete b.result;
                    if ("dropinit" !==
                        e)return j
                }), a.results[g] = q.flatten(t.results), "dropinit" == e && (t.droppable = q.flatten(t.droppable)), "dragstart" == e && !t.cancelled && p.update(); while (++g < c);
                b.type = f;
                b.originalEvent = k;
                return q.flatten(a.results)
            }
        },
        properties: function (b, e, a) {
            var c = a.callback;
            c.drag = a.drag;
            c.proxy = a.proxy || a.drag;
            c.startX = e.pageX;
            c.startY = e.pageY;
            c.deltaX = b.pageX - e.pageX;
            c.deltaY = b.pageY - e.pageY;
            c.originalX = a.offset.left;
            c.originalY = a.offset.top;
            c.offsetX = b.pageX - (e.pageX - c.originalX);
            c.offsetY = b.pageY - (e.pageY - c.originalY);
            c.drop = q.flatten((a.drop || []).slice());
            c.available = q.flatten((a.droppable || []).slice());
            return c
        },
        element: function (b) {
            if (b && (b.jquery || 1 == b.nodeType))return b
        },
        flatten: function (b) {
            return m.map(b, function (b) {
                return b && b.jquery ? m.makeArray(b) : b && b.length ? q.flatten(b) : b
            })
        },
        textselect: function (b) {
            m(document)[b ? "unbind" : "bind"]("selectstart", q.dontstart).attr("unselectable", b ? "off" : "on").css("MozUserSelect", b ? "" : "none")
        },
        dontstart: function () {
            return !1
        },
        callback: function () {
        }
    };
    q.callback.prototype = {
        update: function () {
            x.drop &&
            this.available.length && m.each(this.available, function (b) {
                x.drop.locate(this, b)
            })
        }
    };
    x.draginit = x.dragstart = x.dragend = q;
    var B = jQuery;
    B.fn.html5boxTransition = function (b, e, a, c, d) {
        $parent = this;
        b = c.effect;
        var k = c.easing, f = c.duration, h = c.direction, j = null;
        b && (b = b.split(","), j = b[Math.floor(Math.random() * b.length)], j = B.trim(j.toLowerCase()));
        j && c[j] && ("duration"in c[j] && (f = c[j].duration), c[j].easing && (k = c[j].easing));
        "fade" == j || "fadein" == j ? (a.hide(), e.insertBefore(a), a.fadeIn(f, k, function () {
            e.remove();
            d()
        })) :
            "fadeout" == j ? (a.show(), e.fadeOut(f, k, function () {
                e.remove();
                d()
            })) : "fadeinout" == j ? (a.hide(), e.insertBefore(a), e.fadeOut(f, k), a.fadeIn(f, k, function () {
                e.remove();
                d()
            })) : "crossfade" == j ? (a.hide(), e.fadeOut(f / 2, k, function () {
                a.fadeIn(f / 2, k, function () {
                    e.remove();
                    d()
                })
            })) : "slide" == j ? ($parent.css({overflow: "hidden"}), h ? (a.css({left: "100%"}), a.animate({left: "0%"}, f, k), e.animate({left: "-100%"}, f, k, function () {
                e.remove();
                d()
            })) : (a.css({left: "-100%"}), a.animate({left: "0%"}, f, k), e.animate({left: "100%"}, f, k, function () {
                e.remove();
                d()
            }))) : (a.show(), e.remove(), d())
    };
    var l = jQuery;
    l.fn.addHTML5VideoControls = function (b, e, a) {
        var c = "ontouchstart"in window, d = c ? "touchstart" : "mousedown", k = c ? "touchmove" : "mousemove", f = c ? "touchcancel" : "mouseup", h = c ? 48 : 36, j = null, g = null, t = !1, p = !0, q = null != navigator.userAgent.match(/iPod/i) || null != navigator.userAgent.match(/iPhone/i), m = l(this).data("ishd"), s = l(this).data("hd"), v = l(this).data("src"), n = l(this);
        n.get(0).removeAttribute("controls");
        if (q) {
            var w = n.height() - h;
            n.css({height: w})
        }
        var x = l("<div class='html5boxVideoPlay'></div>");
        q || (n.after(x), x.css({
            position: "absolute",
            top: "50%",
            left: "50%",
            display: "block",
            cursor: "pointer",
            width: 64,
            height: 64,
            "margin-left": -32,
            "margin-top": -32,
            "background-image": "url('" + b + "html5boxplayer_playvideo.png')",
            "background-position": "center center",
            "background-repeat": "no-repeat"
        }).bind("click", function () {
            n.get(0).play()
        }));
        var J = l("<div class='html5boxVideoFullscreenBg'></div>"), u = l("<div class='html5boxVideoControls'><div class='html5boxVideoControlsBg'></div><div class='html5boxPlayPause'><div class='html5boxPlay'></div><div class='html5boxPause'></div></div><div class='html5boxTimeCurrent'>--:--</div><div class='html5boxFullscreen'></div><div class='html5boxHD'></div><div class='html5boxVolume'><div class='html5boxVolumeButton'></div><div class='html5boxVolumeBar'><div class='html5boxVolumeBarBg'><div class='html5boxVolumeBarActive'></div></div></div></div><div class='html5boxTimeTotal'>--:--</div><div class='html5boxSeeker'><div class='html5boxSeekerBuffer'></div><div class='html5boxSeekerPlay'></div><div class='html5boxSeekerHandler'></div></div><div style='clear:both;'></div></div>");
        n.after(u);
        n.after(J);
        J.css({display: "none", position: "fixed", left: 0, top: 0, bottom: 0, right: 0, "z-index": 2147483647});
        u.css({display: "block", position: "absolute", width: "100%", height: h, left: 0, bottom: 0});
        var Q = function () {
            p = !0
        };
        n.bind("click", function () {
            p = !0
        }).hover(function () {
            p = !0
        }, function () {
            p = !1
        });
        setInterval(function () {
            p && (u.show(), p = !1, clearTimeout(j), j = setTimeout(function () {
                n.get(0).paused || u.fadeOut()
            }, 5E3))
        }, 250);
        l(".html5boxVideoControlsBg", u).css({
            display: "block", position: "absolute", width: "100%",
            height: "100%", left: 0, top: 0, "background-color": "#000000", opacity: 0.7, filter: "alpha(opacity=70)"
        });
        l(".html5boxPlayPause", u).css({
            display: "block",
            position: "relative",
            width: "32px",
            height: "32px",
            margin: Math.floor((h - 32) / 2),
            "float": "left"
        });
        var z = l(".html5boxPlay", u), D = l(".html5boxPause", u);
        z.css({
            display: "block",
            position: "absolute",
            top: 0,
            left: 0,
            width: "32px",
            height: "32px",
            cursor: "pointer",
            "background-image": "url('" + b + "html5boxplayer_playpause.png')",
            "background-position": "top left"
        }).hover(function () {
                l(this).css({"background-position": "bottom left"})
            },
            function () {
                l(this).css({"background-position": "top left"})
            }).bind("click", function () {
                n.get(0).play()
            });
        D.css({
            display: "none",
            position: "absolute",
            top: 0,
            left: 0,
            width: "32px",
            height: "32px",
            cursor: "pointer",
            "background-image": "url('" + b + "html5boxplayer_playpause.png')",
            "background-position": "top right"
        }).hover(function () {
            l(this).css({"background-position": "bottom right"})
        }, function () {
            l(this).css({"background-position": "top right"})
        }).bind("click", function () {
            n.get(0).pause()
        });
        var A = l(".html5boxTimeCurrent",
            u), B = l(".html5boxTimeTotal", u), C = l(".html5boxSeeker", u), r = l(".html5boxSeekerPlay", u), G = l(".html5boxSeekerBuffer", u), K = l(".html5boxSeekerHandler", u);
        A.css({
            display: "block",
            position: "relative",
            "float": "left",
            "line-height": h + "px",
            "font-weight": "normal",
            "font-size": "12px",
            margin: "0 8px",
            "font-family": "Arial, Helvetica, sans-serif",
            color: "#fff"
        });
        B.css({
            display: "block",
            position: "relative",
            "float": "right",
            "line-height": h + "px",
            "font-weight": "normal",
            "font-size": "12px",
            margin: "0 8px",
            "font-family": "Arial, Helvetica, sans-serif",
            color: "#fff"
        });
        C.css({
            display: "block",
            cursor: "pointer",
            overflow: "hidden",
            position: "relative",
            height: "10px",
            "background-color": "#222",
            margin: Math.floor((h - 10) / 2) + "px 4px"
        }).bind(d, function (a) {
            a = (c ? a.originalEvent.touches[0] : a).pageX - C.offset().left;
            r.css({width: a});
            n.get(0).currentTime = a * n.get(0).duration / C.width();
            C.bind(k, function (a) {
                a = (c ? a.originalEvent.touches[0] : a).pageX - C.offset().left;
                r.css({width: a});
                n.get(0).currentTime = a * n.get(0).duration / C.width()
            })
        }).bind(f, function () {
            C.unbind(k)
        });
        G.css({
            display: "block",
            position: "absolute", left: 0, top: 0, height: "100%", "background-color": "#444"
        });
        r.css({display: "block", position: "absolute", left: 0, top: 0, height: "100%", "background-color": "#fcc500"});
        if (!q && (n.get(0).requestFullscreen || n.get(0).webkitRequestFullScreen || n.get(0).mozRequestFullScreen || n.get(0).webkitEnterFullScreen || n.get(0).msRequestFullscreen)) {
            var E = function (a) {
                u.css({position: a ? "fixed" : "absolute"});
                var b = N.css("background-position") ? N.css("background-position").split(" ")[1] : N.css("background-position-y");
                N.css({"background-position": (a ? "right" : "left") + " " + b});
                J.css({display: a ? "block" : "none"});
                a ? (l(document).bind("mousemove", Q), u.css({"z-index": 2147483647})) : (l(document).unbind("mousemove", Q), u.css({"z-index": ""}))
            };
            document.addEventListener("fullscreenchange", function () {
                t = document.fullscreen;
                E(document.fullscreen)
            }, !1);
            document.addEventListener("mozfullscreenchange", function () {
                t = document.mozFullScreen;
                E(document.mozFullScreen)
            }, !1);
            document.addEventListener("webkitfullscreenchange", function () {
                t = document.webkitIsFullScreen;
                E(document.webkitIsFullScreen)
            }, !1);
            n.get(0).addEventListener("webkitbeginfullscreen", function () {
                t = !0
            }, !1);
            n.get(0).addEventListener("webkitendfullscreen", function () {
                t = !1
            }, !1);
            l("head").append("<style type='text/css'>#" + a + "::-webkit-media-controls { display:none !important; }</style>");
            var N = l(".html5boxFullscreen", u);
            N.css({
                display: "block",
                position: "relative",
                "float": "right",
                width: "32px",
                height: "32px",
                margin: Math.floor((h - 32) / 2),
                cursor: "pointer",
                "background-image": "url('" + b + "html5boxplayer_fullscreen.png')",
                "background-position": "left top"
            }).hover(function () {
                var a = l(this).css("background-position") ? l(this).css("background-position").split(" ")[0] : l(this).css("background-position-x");
                l(this).css({"background-position": a + " bottom"})
            }, function () {
                var a = l(this).css("background-position") ? l(this).css("background-position").split(" ")[0] : l(this).css("background-position-x");
                l(this).css({"background-position": a + " top"})
            }).bind("click", function () {
                (t = !t) ? (n.get(0).requestFullscreen ? n.get(0).requestFullscreen() :
                    n.get(0).webkitRequestFullScreen ? n.get(0).webkitRequestFullScreen() : n.get(0).mozRequestFullScreen ? n.get(0).mozRequestFullScreen() : n.get(0).webkitEnterFullScreen && n.get(0).webkitEnterFullScreen(), n.get(0).msRequestFullscreen && n.get(0).msRequestFullscreen()) : document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen ? document.webkitCancelFullScreen() : document.webkitExitFullscreen ? document.webkitExitFullscreen() : document.msExitFullscreen &&
                document.msExitFullscreen()
            })
        }
        s && l(".html5boxHD", u).css({
            display: "block",
            position: "relative",
            "float": "right",
            width: "32px",
            height: "32px",
            margin: Math.floor((h - 32) / 2),
            cursor: "pointer",
            "background-image": "url('" + b + "html5boxplayer_hd.png')",
            "background-position": (m ? "right" : "left") + " center"
        }).bind("click", function () {
            m = !m;
            l(this).css({"background-position": (m ? "right" : "left") + " center"});
            e.isHd = m;
            var a = n.get(0).isPaused;
            n.get(0).setAttribute("src", (m ? s : v) + "#t=" + n.get(0).currentTime);
            a ? q || n.get(0).pause() :
                n.get(0).play()
        });
        a = n.get(0).volume;
        n.get(0).volume = a / 2 + 0.1;
        if (n.get(0).volume === a / 2 + 0.1) {
            n.get(0).volume = a;
            a = l(".html5boxVolume", u);
            var L = l(".html5boxVolumeButton", u), F = l(".html5boxVolumeBar", u), y = l(".html5boxVolumeBarBg", u), M = l(".html5boxVolumeBarActive", u);
            a.css({
                display: "block",
                position: "relative",
                "float": "right",
                width: "32px",
                height: "32px",
                margin: Math.floor((h - 32) / 2)
            }).hover(function () {
                clearTimeout(g);
                var a = n.get(0).volume;
                M.css({height: Math.round(100 * a) + "%"});
                F.show()
            }, function () {
                clearTimeout(g);
                g = setTimeout(function () {
                    F.hide()
                }, 1E3)
            });
            L.css({
                display: "block",
                position: "absolute",
                top: 0,
                left: 0,
                width: "32px",
                height: "32px",
                cursor: "pointer",
                "background-image": "url('" + b + "html5boxplayer_volume.png')",
                "background-position": "top left"
            }).hover(function () {
                var a = l(this).css("background-position") ? l(this).css("background-position").split(" ")[0] : l(this).css("background-position-x");
                l(this).css({"background-position": a + " bottom"})
            }, function () {
                var a = l(this).css("background-position") ? l(this).css("background-position").split(" ")[0] :
                    l(this).css("background-position-x");
                l(this).css({"background-position": a + " top"})
            }).bind("click", function () {
                var a = n.get(0).volume;
                0 < a ? (volumeSaved = a, a = 0) : a = volumeSaved;
                var b = l(this).css("background-position") ? l(this).css("background-position").split(" ")[1] : l(this).css("background-position-y");
                L.css({"background-position": (0 < a ? "left" : "right") + " " + b});
                n.get(0).volume = a;
                M.css({height: Math.round(100 * a) + "%"})
            });
            F.css({
                display: "none",
                position: "absolute",
                left: 4,
                bottom: "100%",
                width: 24,
                height: 80,
                "margin-bottom": Math.floor((h -
                    32) / 2),
                "background-color": "#000000",
                opacity: 0.7,
                filter: "alpha(opacity=70)"
            });
            y.css({
                display: "block",
                position: "relative",
                width: 10,
                height: 68,
                margin: 7,
                cursor: "pointer",
                "background-color": "#222"
            });
            M.css({
                display: "block",
                position: "absolute",
                bottom: 0,
                left: 0,
                width: "100%",
                height: "100%",
                "background-color": "#fcc500"
            });
            y.bind(d, function (a) {
                a = 1 - ((c ? a.originalEvent.touches[0] : a).pageY - y.offset().top) / y.height();
                a = 1 < a ? 1 : 0 > a ? 0 : a;
                M.css({height: Math.round(100 * a) + "%"});
                L.css({
                    "background-position": "left " + (0 < a ? "top" :
                        "bottom")
                });
                n.get(0).volume = a;
                y.bind(k, function (a) {
                    a = 1 - ((c ? a.originalEvent.touches[0] : a).pageY - y.offset().top) / y.height();
                    a = 1 < a ? 1 : 0 > a ? 0 : a;
                    M.css({height: Math.round(100 * a) + "%"});
                    L.css({"background-position": "left " + (0 < a ? "top" : "bottom")});
                    n.get(0).volume = a
                })
            }).bind(f, function () {
                y.unbind(k)
            })
        }
        var U = function (a) {
            var b = Math.floor(a / 3600), d = Math.floor((a - 3600 * b) / 60);
            a = Math.floor(a - (3600 * b + 60 * d));
            d = (10 > d ? "0" + d : d) + ":" + (10 > a ? "0" + a : a);
            0 < b && (d = (10 > b ? "0" + b : b) + ":" + d);
            return d
        };
        b = function () {
            u.show();
            clearTimeout(j);
            x.show();
            z.show();
            D.hide()
        };
        d = function () {
            var a = n.get(0).currentTime;
            if (a) {
                A.text(U(a));
                var b = n.get(0).duration;
                if (b) {
                    B.text(U(b));
                    var d = C.width(), a = Math.round(d * a / b);
                    r.css({width: a});
                    K.css({left: a})
                }
            }
        };
        f = function () {
            if (n.get(0).buffered && 0 < n.get(0).buffered.length && !isNaN(n.get(0).buffered.end(0)) && !isNaN(n.get(0).duration)) {
                var a = C.width();
                G.css({width: Math.round(a * n.get(0).buffered.end(0) / n.get(0).duration)})
            }
        };
        try {
            n.bind("play", function () {
                x.hide();
                z.hide();
                D.show()
            }), n.bind("pause", b), n.bind("ended",
                b), n.bind("timeupdate", d), n.bind("progress", f)
        } catch (X) {
        }
    };
    var b = jQuery, G = 0;
    b.fn.html5gallery = function (l) {
        var e = function (a, c, d) {
            this.container = a;
            this.options = c;
            this.id = d;
            this.options.flashInstalled = !1;
            try {
                new ActiveXObject("ShockwaveFlash.ShockwaveFlash") && (this.options.flashInstalled = !0)
            } catch (e) {
                navigator.mimeTypes["application/x-shockwave-flash"] && (this.options.flashInstalled = !0)
            }
            this.options.html5VideoSupported = !!document.createElement("video").canPlayType;
            this.options.isChrome = null != navigator.userAgent.match(/Chrome/i);
            this.options.isFirefox = null != navigator.userAgent.match(/Firefox/i);
            this.options.isOpera = null != navigator.userAgent.match(/Opera/i) || null != navigator.userAgent.match(/OPR\//i);
            this.options.isSafari = null != navigator.userAgent.match(/Safari/i);
            this.options.isIE11 = null != navigator.userAgent.match(/Trident\/7/) && null != navigator.userAgent.match(/rv:11/);
            this.options.isIE = null != navigator.userAgent.match(/MSIE/i) && !this.options.isOpera;
            this.options.isIE10 = null != navigator.userAgent.match(/MSIE 10/i) && !this.options.isOpera;
            this.options.isIE9 = null != navigator.userAgent.match(/MSIE 9/i) && !this.options.isOpera;
            this.options.isIE8 = null != navigator.userAgent.match(/MSIE 8/i) && !this.options.isOpera;
            this.options.isIE7 = null != navigator.userAgent.match(/MSIE 7/i) && !this.options.isOpera;
            this.options.isIE6 = null != navigator.userAgent.match(/MSIE 6/i) && !this.options.isOpera;
            this.options.isIE678 = this.options.isIE6 || this.options.isIE7 || this.options.isIE8;
            this.options.isIE6789 = this.options.isIE6 || this.options.isIE7 || this.options.isIE8 ||
                this.options.isIE9;
            this.options.isAndroid = null != navigator.userAgent.match(/Android/i);
            this.options.isIPad = null != navigator.userAgent.match(/iPad/i);
            this.options.isIPhone = null != navigator.userAgent.match(/iPod/i) || null != navigator.userAgent.match(/iPhone/i);
            this.options.isIOS = this.options.isIPad || this.options.isIPhone;
            this.options.isMobile = this.options.isAndroid || this.options.isIPad || this.options.isIPhone;
            this.options.isIOSLess5 = this.options.isIPad && this.options.isIPhone && (null != navigator.userAgent.match(/OS 4/i) ||
                null != navigator.userAgent.match(/OS 3/i));
            this.options.supportCSSPositionFixed = !this.options.isIE6 && !this.options.isIOSLess5;
            this.eStart = (this.isTouch = "ontouchstart"in window) ? "touchstart" : "mousedown";
            this.eMove = this.isTouch ? "touchmove" : "mousemove";
            this.eCancel = this.isTouch ? "touchcancel" : "mouseup";
            this.eClick = "click";
            this.slideTimer = this.slideshowTimeout = null;
            this.looptimes = this.slideTimerCount = 0;
            this.updateCarouselTimeout = null;
            this.disableupdatecarousel = !1;
            this.hideToolboxTimeout = this.hideTitleTimeout =
                null;
            this.isHd = this.options.hddefault;
            this.isHTML5 = !1;
            this.elemArray = [];
            b(".html5gallery-loading").hide();
            this.container.children().hide();
            this.container.css({display: "block", position: "relative"});
            this.options.googlefonts && 0 < this.options.googlefonts.length && (a = "https://fonts.googleapis.com/css?family=" + this.options.googlefonts, c = document.createElement("link"), c.setAttribute("rel", "stylesheet"), c.setAttribute("type", "text/css"), c.setAttribute("href", a), document.getElementsByTagName("head")[0].appendChild(c));
            this.initData(this.processElemArray)
        };
        e.prototype = {
            getParams: function () {
                for (var a = {}, b = window.location.search.substring(1).split("&"), d = 0; d < b.length; d++) {
                    var e = b[d].split("=");
                    e && 2 == e.length && (a[e[0].toLowerCase()] = unescape(e[1]))
                }
                return a
            }, init: function (a) {
                if (a.options.random)for (var c = a.elemArray.length - 1; 0 < c; c--) {
                    var d = Math.floor(Math.random() * c), e = a.elemArray[c];
                    a.elemArray[c] = a.elemArray[d];
                    a.elemArray[d] = e
                }
                a.initYoutubeApi();
                a.options.showcarousel = (1 < a.elemArray.length || a.options.showcarouselforsingle) &&
                    a.options.showcarousel;
                a.options.watermarkcode = "";
                //a.options.fv ? a.options.watermarkcode = "<a style='text-decoration:none;' target='_blank' href='" + a.options.freelink + "' >" : 0 < a.options.watermarklink.length && (a.options.watermarkcode = "<a style='text-decoration:none;' target='_blank' href='" + a.options.watermarklink + "' >");
                //a.options.watermarkcode += "<div " + (a.options.fv ? "" : "class='html5gallery-watermark-" + a.id + "' ") + "style='" + (a.options.fv ? "display:block;visibility:hidden;position:absolute;top:10px;left:10px;width:170px;height:18px;line-height:18px;text-align:center;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;background-color:#fff;color:#333;font-size:12px;font-family:Arial,Helvetica,sans-serif;" :
                //        0 < a.options.watermark.length ? "display:block;position:absolute;top:0px;left:0px;" : "display:none;") + "' >";
                //a.options.fv ? a.options.watermarkcode += a.options.fvm : 0 < a.options.watermark.length && (a.options.watermarkcode += "<img src='" + a.options.watermark + "' />");
                //a.options.watermarkcode += "</div>";
                //if (a.options.fv || 0 < a.options.watermarklink.length)a.options.watermarkcode += "</a>";
                a.createStyle();
                a.createMarkup();
                a.createImageToolbox();
                0 >= a.elemArray.length || (a.createEvents(), a.loadCarousel(), a.savedElem = -1, a.curElem = -1, a.nextElem = -1, a.prevElem = -1, a.isPaused = !a.options.autoslide, a.isFullscreen = !1, a.showingPoster = !1, a.disableTouchSwipe = !1, c = a.getParams(), a.slideRun(c.html5galleryid && c.html5galleryid in a.elemArray ? c.html5galleryid : 0), a.options.responsive && (a.resizeGallery(), b(window).resize(function () {
                    a.resizeGallery()
                })))
            }, resizeGallery: function () {
                switch (this.options.skin) {
                    case "vertical":
                    case "showcase":
                        this.resizeStyleVertical();
                        break;
                    default:
                        this.resizeStyleDefault()
                }
                this.resizeImageToolbox()
            }, checkMK: function () {
                if (this.options.fv) {
                    var a =
                        b(".html5gallery-elem-" + this.id, this.container), c = b('a[href="' + this.options.freelink + '"]', a);
                    if (0 > a.text().indexOf(this.options.fvm) || 0 > c.length)a.append("<a style='text-decoration:none;' target='_blank' href='" + this.options.freelink + "' ><div style='display:block;visibility:hidden;position:absolute;top:10px;left:10px;width:170px;height:18px;line-height:18px;text-align:center;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;background-color:#fff;color:#333;font-size:12px;font-family:Arial,Helvetica,sans-serif;'>" +
                        this.options.fvm + "</div></a>"); else if (a = c.find("div"), "none" == c.css("display") || "hidden" == c.css("visibility") || 8 > parseInt(c.css("font-size")) || "none" == a.css("display") || "hidden" == a.css("visibility") || 8 > parseInt(a.css("font-size")))c.attr({style: (c.attr("style") || "") + "display:block!important;visibility:visible!important;font-size:12px!important;"}), a.attr({style: a.attr("style") + "display:block!important;visibility:visible!important;font-size:12px!important;"})
                }
            }, initData: function (a) {
                this.elemArray =
                    [];
                if (this.options.src && 0 < this.options.src.length) {
                    var c = this.options.mediatype ? this.options.mediatype : this.checkType(this.options.src);
                    this.elemArray.push([0, "", this.options.src, this.options.webm, this.options.ogg, "", "", this.options.title ? this.options.title : "", this.options.title ? this.options.title : "", c, this.options.width, this.options.height, this.options.poster, this.options.hd, this.options.hdogg, this.options.hdwebm]);
                    this.readTags();
                    a(this)
                } else if (this.options.xml && 0 < this.options.xml.length) {
                    this.options.xmlnocache &&
                    (this.options.xml += 0 > this.options.xml.indexOf("?") ? "?" : "&", this.options.xml += Math.random());
                    var d = this;
                    b.ajax({
                        type: "GET", url: this.options.xml, dataType: "xml", success: function (c) {
                            b(c).find("slide").each(function (a) {
                                var c = b(this).find("title").text(), e = b(this).find("description").text() ? b(this).find("description").text() : b(this).find("information").text();
                                c || (c = "");
                                e || (e = "");
                                var k = b(this).find("mediatype").text() ? b(this).find("mediatype").text() : d.checkType(b(this).find("file").text());
                                d.elemArray.push([b(this).find("id").length ?
                                    b(this).find("id").text() : a, b(this).find("thumbnail").text(), b(this).find("file").text(), b(this).find("file-ogg").text(), b(this).find("file-webm").text(), b(this).find("link").text(), b(this).find("linktarget").text(), c, e, k, b(this).find("width").length && !isNaN(parseInt(b(this).find("width").text())) ? parseInt(b(this).find("width").text()) : d.options.width, b(this).find("height").length && !isNaN(parseInt(b(this).find("height").text())) ? parseInt(b(this).find("height").text()) : d.options.height, b(this).find("poster").text(),
                                    b(this).find("hd").text(), b(this).find("hdogg").text(), b(this).find("hdwebm").text(), b(this).find("duration").text(), b(this).find("lightboxwidth").text(), b(this).find("lightboxheight").text(), b(this).find("youtubeapikey").text(), b(this).find("youtubeplaylistid").text(), b(this).find("youtubeplaylistmaxresults").text(), "true" == b(this).find("lightbox").text().toLowerCase()])
                            });
                            d.readTags();
                            a(d)
                        }
                    })
                } else this.options.remote && 0 < this.options.remote.length ? (d = this, b.getJSON(this.options.remote, function (b) {
                    for (var c =
                        0; c < b.length; c++) {
                        var e = b[c].mediatype ? b[c].mediatype : d.checkType(b[c].file);
                        d.elemArray.push([c, b[c].thumbnail, b[c].file, b[c].fileogg, b[c].filewebm, b[c].link, b[c].linktarget, b[c].title, b[c].description, e, b[c].width && !isNaN(parseInt(b[c].width)) ? parseInt(b[c].width) : d.options.width, b[c].height && !isNaN(parseInt(b[c].height)) ? parseInt(b[c].height) : d.options.height, b[c].poster, b[c].hd, b[c].hdogg, b[c].hdwebm, b[c].duration, b[c].lightboxwidth, b[c].lightboxheight, b[c].youtubeapikey, b[c].youtubeplaylistid,
                            b[c].youtubeplaylistmaxresults, b[c].lightbox])
                    }
                    d.readTags();
                    a(d)
                })) : this.options.youtubechannel ? (c = {
                    alt: "json",
                    v: 2,
                    orderby: this.options.youtubechannel.orderby ? this.options.youtubechannel.orderby : "published",
                    "start-index": this.options.youtubechannel["start-index"] ? this.options.youtubechannel["start-index"] : 1,
                    "max-results": this.options.youtubechannel["max-results"] ? this.options.youtubechannel["max-results"] : 10
                }, this.options.youtubechannel.author ? c.author = this.options.youtubechannel.author : this.options.youtubechannel.q &&
                (c.q = this.options.youtubechannel.q), c = "https://gdata.youtube.com/feeds/api/videos?" + b.param(c), d = this, b.getJSON(c, function (b) {
                    if (b && b.feed && b.feed.entry)for (var c = 1; c < b.feed.entry.length; c++)d.elemArray.push([c, "https://img.youtube.com/vi/" + b.feed.entry[c].media$group.yt$videoid.$t + "/0.jpg", b.feed.entry[c].media$group.media$player.url, null, null, null, null, b.feed.entry[c].media$group.media$title.$t, b.feed.entry[c].media$group.media$description.$t, 9, 640, 480, "https://img.youtube.com/vi/" + b.feed.entry[c].media$group.yt$videoid.$t +
                    "/0.jpg", null, null, null, null]);
                    d.readTags();
                    a(d)
                })) : this.options.youtubeapikey && this.options.youtubeplaylistid ? (d = this, this.getYouTubePlaylist(this.options.youtubeapikey, this.options.youtubeplaylistid, this.options.youtubeplaylistmaxresults, -1, function () {
                    d.readTags();
                    a(d)
                }, this, null)) : (this.readTags(), a(this))
            }, readTags: function () {
                var a = this;
                (b("img.html5galleryimg", this.container).length ? b("img.html5galleryimg", this.container) : b("img", this.container)).each(function () {
                    var c = b(this).data("lazy-src") ?
                        b(this).data("lazy-src") : b(this).data("lazyload-src") ? b(this).data("lazyload-src") : b(this).attr("src"), d = c, e = b(this).attr("alt"), f = b(this).data("description") ? b(this).data("description") : b(this).data("information");
                    e || (e = "");
                    f || (f = "");
                    var h = a.options.width, j = a.options.height, g = b(this).data("duration") ? b(this).data("duration") : 0, t = null, p = null, l = null, q = null, m = null, s = null, n = null, v = null, w = null, x = null, u = null, B = null, z = null, D = !1;
                    b(this).parent().is("a") && (d = b(this).parent().attr("href"), t = b(this).parent().data("ogg"),
                        p = b(this).parent().data("webm"), l = b(this).parent().data("link"), q = b(this).parent().data("linktarget"), m = b(this).parent().data("poster"), isNaN(b(this).parent().data("width")) || (h = b(this).parent().data("width")), isNaN(b(this).parent().data("height")) || (j = b(this).parent().data("height")), s = b(this).parent().data("hd"), n = b(this).parent().data("hdogg"), v = b(this).parent().data("hdwebm"), w = b(this).parent().data("lightboxwidth"), x = b(this).parent().data("lightboxheight"), u = b(this).parent().data("youtubeapikey"),
                        B = b(this).parent().data("youtubeplaylistid"), z = b(this).parent().data("youtubeplaylistmaxresults"), D = b(this).parent().hasClass("html5gallerylightbox"));
                    var A = b(this).parent().data("mediatype") ? b(this).parent().data("mediatype") : a.checkType(d);
                    a.elemArray.push([a.elemArray.length, c, d, t, p, l, q, e, f, A, h, j, m, s, n, v, g, w, x, u, B, z, D])
                })
            }, getYouTubePlaylist: function (a, c, d, e, f, h, j) {
                0 <= e && h.elemArray.splice(e, 1);
                var g = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=" + c + "&key=" + a;
                d &&
                (g = 50 < d ? g + "&maxResults=50" : g + ("&maxResults=" + d));
                j && (g += "&pageToken=" + j);
                var t = !0;
                b.getJSON(g, function (b) {
                    if (b && b.items)for (var g = 0; g < b.items.length; g++) {
                        var j = b.items[g].snippet.resourceId.videoId, l = "https://img.youtube.com/vi/" + j + "/0.jpg";
                        h.options.youtubeplaylistusemaxres && (b.items[g].snippet.thumbnails && b.items[g].snippet.thumbnails.maxres) && (l = b.items[g].snippet.thumbnails.maxres.url);
                        j = [g, "https://img.youtube.com/vi/" + j + "/0.jpg", "https://www.youtube.com/embed/" + j, null, null, null, null, b.items[g].snippet.title,
                            b.items[g].snippet.description, 9, 640, 480, l, null, null, null, null];
                        0 <= e ? (h.elemArray.splice(e, 0, j), e++) : h.elemArray.push(j)
                    }
                    b && (b.nextPageToken && d && 50 < d) && (t = !1, h.getYouTubePlaylist(a, c, d - 50, e, f, h, b.nextPageToken))
                }).always(function () {
                    t && f(h)
                })
            }, processElemArray: function (a) {
                for (var b = !1, d = 0; d < a.elemArray.length; d++)if (13 == a.elemArray[d][9] && a.elemArray[d][19] && a.elemArray[d][20]) {
                    b = !0;
                    break
                }
                b ? a.getYouTubePlaylist(a.elemArray[d][19], a.elemArray[d][20], a.elemArray[d][21], d, a.processElemArray, a, null) : a.init(a)
            },
            createMarkup: function () {
                this.$gallery = jQuery("<div class='html5gallery-container-" + this.id + "'><div class='html5gallery-box-" + this.id + "'><div class='html5gallery-elem-" + this.id + "'></div><div class='html5gallery-title-" + this.id + "'></div><div class='html5gallery-timer-" + this.id + "'></div><div class='html5gallery-viral-" + this.id + "'></div><div class='html5gallery-toolbox-" + this.id + "'><div class='html5gallery-toolbox-bg-" + this.id + "'></div><div class='html5gallery-toolbox-buttons-" + this.id + "'><div class='html5gallery-play-" +
                    this.id + "'></div><div class='html5gallery-pause-" + this.id + "'></div><div class='html5gallery-left-" + this.id + "'></div><div class='html5gallery-right-" + this.id + "'></div><div class='html5gallery-lightbox-" + this.id + "'></div></div></div></div><div class='html5gallery-car-" + this.id + "'><div class='html5gallery-car-list-" + this.id + "'><div class='html5gallery-car-mask-" + this.id + "'><div class='html5gallery-thumbs-" + this.id + "'></div></div><div class='html5gallery-car-slider-bar-" + this.id + "'><div class='html5gallery-car-slider-bar-top-" +
                    this.id + "'></div><div class='html5gallery-car-slider-bar-middle-" + this.id + "'></div><div class='html5gallery-car-slider-bar-bottom-" + this.id + "'></div></div><div class='html5gallery-car-left-" + this.id + "'></div><div class='html5gallery-car-right-" + this.id + "'></div><div class='html5gallery-car-slider-" + this.id + "'></div></div></div></div>");
                this.$gallery.appendTo(this.container);
                this.options.socialurlforeach || this.createSocialMedia();
                this.options.googleanalyticsaccount && !window._gaq && (window._gaq = window._gaq ||
                    [], window._gaq.push(["_setAccount", this.options.googleanalyticsaccount]), window._gaq.push(["_trackPageview"]), b.getScript("https://ssl.google-analytics.com/ga.js"))
            }, createSocialMedia: function () {
                b(".html5gallery-viral-" + this.id, this.$gallery).empty();
                var a = window.location.href;
                this.options.socialurlforeach && (a += (0 > window.location.href.indexOf("?") ? "?" : "&") + "html5galleryid=" + this.elemArray[this.curElem][0]);
                if (this.options.showsocialmedia && this.options.showfacebooklike) {
                    var c = "<div style='display:block; float:left; width:110px; height:21px;'><iframe src='https://www.facebook.com/plugins/like.php?href=",
                        c = this.options.facebooklikeurl && 0 < this.options.facebooklikeurl.length ? c + encodeURIComponent(this.options.facebooklikeurl) : c + a;
                    b(".html5gallery-viral-" + this.id, this.$gallery).append(c + "&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21' scrolling='no' frameborder='0' style='border:none;;overflow:hidden; width:110px; height:21px;' allowTransparency='true'></iframe></div>")
                }
                this.options.showsocialmedia && this.options.showtwitter &&
                (c = "<div style='display:block; float:left; width:110px; height:21px;'><a href='https://twitter.com/share' class='twitter-share-button'", c = this.options.twitterurl && 0 < this.options.twitterurl.length ? c + (" data-url='" + this.options.twitterurl + "'") : c + (" data-url='" + a + "'"), this.options.twitterusername && 0 < this.options.twitterusername.length && (c += " data-via='" + this.options.twittervia + "' data-related='" + this.options.twitterusername + "'"), b(".html5gallery-viral-" + this.id, this.$gallery).append(c + ">Tweet</a></div>"),
                    b.getScript("https://platform.twitter.com/widgets.js"));
                this.options.showsocialmedia && this.options.showgoogleplus && (c = "<div style='display:block; float:left; width:100px; height:21px;'><div class='g-plusone' data-size='medium'", c = this.options.googleplusurl && 0 < this.options.googleplusurl.length ? c + (" data-href='" + this.options.googleplusurl + "'") : c + (" data-href='" + a + "'"), b(".html5gallery-viral-" + this.id, this.$gallery).append(c + "></div></div>"), b.getScript("https://apis.google.com/js/plusone.js"))
            }, playGallery: function () {
                var a =
                    this;
                b(".html5gallery-play-" + a.id, a.$gallery).hide();
                b(".html5gallery-pause-" + a.id, a.$gallery).show();
                a.isPaused = !1;
                a.slideshowTimeout = setTimeout(function () {
                    a.slideRun(-1)
                }, a.elemArray[a.curElem][16] ? a.elemArray[a.curElem][16] : a.options.slideshowinterval);
                b(".html5gallery-timer-" + a.id, a.$gallery).css({width: 0});
                a.slideTimerCount = 0;
                a.options.showtimer && (a.slideTimer = setInterval(function () {
                    a.showSlideTimer()
                }, 50))
            }, pauseGallery: function () {
                b(".html5gallery-play-" + this.id, this.$gallery).show();
                b(".html5gallery-pause-" +
                    this.id, this.$gallery).hide();
                this.isPaused = !0;
                clearTimeout(this.slideshowTimeout);
                b(".html5gallery-timer-" + this.id, this.$gallery).css({width: 0});
                clearInterval(this.slideTimer);
                this.slideTimerCount = 0
            }, createEvents: function () {
                var a = this;
                b(".html5gallery-play-" + this.id, this.$gallery).click(function () {
                    a.playGallery()
                });
                b(".html5gallery-pause-" + this.id, this.$gallery).click(function () {
                    a.pauseGallery()
                });
                b(".html5gallery-lightbox-" + this.id, this.$gallery).click(function () {
                    a.goFullscreen()
                });
                b(".html5gallery-left-" +
                    this.id, this.$gallery).click(function () {
                    a.slideRun(-2, !0)
                });
                b(".html5gallery-right-" + this.id, this.$gallery).click(function () {
                    a.slideRun(-1, !0)
                });
                if (a.options.enabletouchswipe) {
                    var c = a.options.isAndroid && a.options.enabletouchswipeonandroid ? !0 : !1;
                    b(".html5gallery-box-" + this.id, this.$gallery).touchSwipe({
                        preventWebBrowser: c,
                        swipeLeft: function () {
                            a.disableTouchSwipe || a.slideRun(-1, !0)
                        },
                        swipeRight: function () {
                            a.disableTouchSwipe || a.slideRun(-2, !0)
                        }
                    })
                }
                b(".html5gallery-box-" + this.id, this.$gallery).mousemove(function () {
                    if ("mouseover" ==
                        a.options.imagetoolboxmode) {
                        var b = a.elemArray[a.curElem][9];
                        ("always" == a.options.showimagetoolbox || "image" == a.options.showimagetoolbox && 1 == b) && a.showimagetoolbox(b, !0)
                    }
                });
                b(".html5gallery-box-" + this.id, this.$gallery).hover(function () {
                    a.onSlideshowOver();
                    if ("mouseover" == a.options.imagetoolboxmode) {
                        var b = a.elemArray[a.curElem][9];
                        ("always" == a.options.showimagetoolbox || "image" == a.options.showimagetoolbox && 1 == b) && a.showimagetoolbox(b)
                    }
                }, function () {
                    "mouseover" == a.options.imagetoolboxmode && a.hideimagetoolbox()
                });
                b(".html5gallery-container-" + this.id).mousemove(function () {
                    a.options.titleoverlay && a.options.titleautohide && (b(".html5gallery-title-" + a.id, a.$gallery).show(), clearTimeout(a.hideTitleTimeout), a.hideTitleTimeout = setTimeout(function () {
                        b(".html5gallery-title-" + a.id, a.$gallery).fadeOut()
                    }, 3E3))
                });
                b(".html5gallery-container-" + this.id).hover(function () {
                    a.options.titleoverlay && a.options.titleautohide && (b(".html5gallery-title-" + a.id, a.$gallery).fadeIn(), clearTimeout(a.hideTitleTimeout), a.hideTitleTimeout =
                        setTimeout(function () {
                            b(".html5gallery-title-" + a.id, a.$gallery).fadeOut()
                        }, 3E3))
                }, function () {
                    a.options.titleoverlay && a.options.titleautohide && (b(".html5gallery-title-" + a.id, a.$gallery).fadeOut(), clearTimeout(a.hideTitleTimeout))
                });
                b(".html5gallery-car-left-" + this.id, this.$gallery).css({
                    "background-position": "-" + String(2 * this.options.carouselarrowwidth) + "px 0px",
                    cursor: ""
                });
                b(".html5gallery-car-left-" + this.id, this.$gallery).data("disabled", !0);
                b(".html5gallery-car-right-" + this.id, this.$gallery).css({"background-position": "0px 0px"});
                b(".html5gallery-car-left-" + this.id, this.$gallery).click(function () {
                    b(this).data("disabled") || (a.disableupdatecarousel = !0, a.updateCarouselTimeout = setTimeout(function () {
                        a.enableUpdateCarousel()
                    }, a.options.updatecarouselinterval), a.carouselPrev())
                });
                b(".html5gallery-car-right-" + this.id, this.$gallery).click(function () {
                    b(this).data("disabled") || (a.disableupdatecarousel = !0, a.updateCarouselTimeout = setTimeout(function () {
                        a.enableUpdateCarousel()
                    }, a.options.updatecarouselinterval), a.carouselNext())
                });
                b(".html5gallery-car-slider-" +
                    this.id, this.$gallery).bind("drag", function (b, c) {
                    a.disableupdatecarousel = !0;
                    a.updateCarouselTimeout = setTimeout(function () {
                        a.enableUpdateCarousel()
                    }, a.options.updatecarouselinterval);
                    a.carouselSliderDrag(b, c)
                });
                b(".html5gallery-car-slider-bar-" + this.id, this.$gallery).click(function (b) {
                    a.disableupdatecarousel = !0;
                    a.updateCarouselTimeout = setTimeout(function () {
                        a.enableUpdateCarousel()
                    }, a.options.updatecarouselinterval);
                    a.carouselBarClicked(b)
                });
                b(".html5gallery-car-left-" + this.id, this.$gallery).hover(function () {
                    b(this).data("disabled") ||
                    b(this).css({"background-position": "-" + a.options.carouselarrowwidth + "px 0px"})
                }, function () {
                    b(this).data("disabled") || b(this).css({"background-position": "0px 0px"})
                });
                b(".html5gallery-car-right-" + this.id, this.$gallery).hover(function () {
                    b(this).data("disabled") || b(this).css({"background-position": "-" + a.options.carouselarrowwidth + "px 0px"})
                }, function () {
                    b(this).data("disabled") || b(this).css({"background-position": "0px 0px"})
                })
            }, createStyle: function () {
                switch (this.options.skin) {
                    case "vertical":
                    case "showcase":
                        this.createStyleVertical();
                        break;
                    default:
                        this.createStyleDefault()
                }
            }, resizeStyleVertical: function () {
                if (this.container.parent() && this.container.parent().width()) {
                    this.options.containerWidth = this.container.parent().width();
                    this.options.totalWidth = this.options.containerWidth;
                    this.options.showcarousel && (this.options.carouselWidth = "bottom" == this.options.carouselposition ? this.options.width : this.options.thumbwidth);
                    "bottom" == this.options.carouselposition ? this.options.width = this.options.totalWidth - 2 * this.options.padding : (this.options.width =
                        this.options.totalWidth - 2 * this.options.padding, 0 < this.options.carouselWidth + this.options.carouselmargin && (this.options.width -= this.options.carouselWidth + this.options.carouselmargin));
                    this.options.responsivefullscreen && 0 < this.container.parent().height() ? (this.options.containerHeight = this.container.parent().height(), this.options.totalHeight = this.options.containerHeight, this.options.height = "bottom" == this.options.carouselposition ? this.options.totalHeight - (this.options.headerHeight + 2 * this.options.padding +
                    this.options.carouselheight) : this.options.totalHeight - (this.options.headerHeight + 2 * this.options.padding)) : (this.options.height = Math.round(this.options.width * this.options.originalHeight / this.options.originalWidth), this.options.totalHeight = "bottom" == this.options.carouselposition ? this.options.height + this.options.headerHeight + 2 * this.options.padding + this.options.carouselmargin + this.options.carouselHeight : this.options.height + this.options.headerHeight + 2 * this.options.padding, this.options.containerHeight =
                        this.options.totalHeight);
                    this.container.css({width: this.options.containerWidth, height: this.options.containerHeight});
                    this.options.boxWidth = this.options.width;
                    this.options.boxHeight = this.options.height + this.options.headerHeight;
                    this.options.slideshadow && (this.options.boxWidth += 8);
                    if (this.options.showcarousel)if ("bottom" == this.options.carouselposition) {
                        this.options.carouselWidth = this.options.width;
                        this.options.carouselHeight = this.options.carouselheight;
                        this.options.carouselLeft = this.options.padding;
                        this.options.carouselTop = this.options.height + this.options.headerHeight + 2 * this.options.padding;
                        this.options.carAreaLength = this.options.carouselHeight;
                        this.options.carouselSlider = Math.floor(this.options.carAreaLength / (this.options.thumbheight + this.options.thumbgap)) < this.elemArray.length;
                        this.options.thumbwidth = this.options.width;
                        this.options.carouselSlider && (this.options.thumbwidth -= 20);
                        b(".html5gallery-car-mask-" + this.id).css({width: this.options.thumbwidth + "px"});
                        b(".html5gallery-tn-" + this.id).css({
                            width: this.options.thumbwidth +
                            "px"
                        });
                        b(".html5gallery-tn-selected-" + this.id).css({width: this.options.thumbwidth + "px"});
                        b(".html5gallery-car-slider-bar-" + this.id).css({left: String(this.options.thumbwidth + 6) + "px"});
                        this.options.isMobile ? (b(".html5gallery-car-left-" + this.id).css({left: String(this.options.thumbwidth + 5) + "px"}), b(".html5gallery-car-right-" + this.id).css({left: String(this.options.thumbwidth + 5) + "px"})) : b(".html5gallery-car-slider-" + this.id).css({left: String(this.options.thumbwidth + 5) + "px"});
                        var a = this.options.thumbwidth -
                            3 * this.options.thumbmargin;
                        this.options.thumbshowimage && (a -= this.options.thumbimagewidth + 2 * this.options.thumbimageborder);
                        this.options.thumbshowtitle && b("head").append("<style type='text/css' data-creator='html5gallery'>.html5gallery-tn-title-" + this.id + " {width: " + a + "px;}</style>")
                    } else this.options.carouselWidth = this.options.thumbwidth, this.options.carouselHeight = this.options.height + this.options.headerHeight, this.options.carTop = 0, this.options.carBottom = 0, this.options.carAreaLength = this.options.carouselHeight -
                        this.options.carTop - this.options.carBottom, this.options.carouselSlider = Math.floor(this.options.carAreaLength / (this.options.thumbheight + this.options.thumbgap)) < this.elemArray.length, this.options.carouselSlider && (this.options.carouselWidth += 20, this.options.width -= 20, this.options.boxWidth = this.options.width, this.options.slideshadow && (this.options.boxWidth += 8)), "left" == this.options.carouselposition ? (this.options.boxLeft = this.options.padding + this.options.carouselWidth + this.options.carouselmargin, this.options.carouselLeft =
                        this.options.padding) : this.options.carouselLeft = this.options.padding + this.options.width + this.options.carouselmargin, this.options.carouselTop = this.options.padding;
                    b(".html5gallery-container-" + this.id).css({
                        width: this.options.totalWidth + "px",
                        height: this.options.totalHeight + "px"
                    });
                    b(".html5gallery-box-" + this.id).css({
                        width: this.options.boxWidth + "px",
                        height: this.options.boxHeight + "px"
                    });
                    a = this.elemArray[this.curElem][9];
                    if (1 == a || this.showingPoster) {
                        var c = this.elemArray[this.curElem][10], a = this.elemArray[this.curElem][11],
                            d;
                        if (this.isFullscreen) {
                            var e = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : this.fullscreenWidth;
                            d = this.elemArray[this.curElem][18] ? Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : this.fullscreenHeight;
                            d = Math.min(e / c, d / a);
                            d = 1 < d ? 1 : d
                        } else d = "fill" == this.options.resizemode ? Math.max(this.options.width / c, this.options.height / a) : Math.min(this.options.width / c, this.options.height / a);
                        e = Math.round(d * c);
                        c = Math.round(d * a);
                        a = this.isFullscreen ?
                            e : this.options.width;
                        d = this.isFullscreen ? c : this.options.height;
                        var f = Math.round(a / 2 - e / 2), h = Math.round(d / 2 - c / 2);
                        this.isFullscreen && this.adjustFullscreen(a, d, !0);
                        b(".html5gallery-elem-" + this.id).css({width: a + "px", height: d + "px"});
                        b(".html5gallery-elem-img-" + this.id).css({width: a + "px", height: d + "px"});
                        b(".html5gallery-elem-image-" + this.id).css({
                            width: e + "px",
                            height: c + "px",
                            top: h + "px",
                            left: f + "px"
                        })
                    } else if (5 == a || 6 == a || 7 == a || 8 == a || 9 == a || 10 == a || 11 == a)a = this.elemArray[this.curElem][10], c = this.elemArray[this.curElem][11],
                        this.isFullscreen ? (e = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : this.fullscreenWidth, d = this.elemArray[this.curElem][18] ? Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : this.fullscreenHeight, d = Math.min(e / a, d / c), d = 1 < d ? 1 : d, a = Math.round(d * a), d = Math.round(d * c), this.adjustFullscreen(a, d, !0)) : (a = this.options.width, d = this.options.height), b(".html5gallery-elem-" + this.id).css({
                        width: a + "px",
                        height: d + "px"
                    }), b(".html5gallery-elem-video-" + this.id).css({
                        width: a +
                        "px", height: d + "px"
                    }), b(".html5gallery-elem-video-container-" + this.id).css({
                        width: a + "px",
                        height: d + "px"
                    }), e = this.options.isIPhone ? d - 48 : d, b(".html5gallery-elem-video-container-" + this.id).find("video").css({
                        width: a + "px",
                        height: e + "px"
                    }), b("#html5gallery-elem-video-" + this.id).css({
                        width: a + "px",
                        height: d + "px"
                    }), b("#html5gallery-elem-video-" + this.id).attr("width", a), b("#html5gallery-elem-video-" + this.id).attr("height", d), b(".html5gallery-elem-video-" + this.id).find("iframe").attr("width", a), b(".html5gallery-elem-video-" +
                        this.id).find("iframe").attr("height", d), b("#html5gallery-elem-video-" + this.id).find("iframe").attr("width", a), b("#html5gallery-elem-video-" + this.id).find("iframe").attr("height", d);
                    d = e = 0;
                    "bottom" == this.options.headerpos && (e = this.options.titleoverlay ? this.options.height - this.options.titleheight : this.options.height, d = this.options.titleoverlay ? this.options.height : this.options.height + this.options.titleheight);
                    a = this.options.slideshadow ? this.options.boxWidth - 8 : this.options.boxWidth;
                    b(".html5gallery-title-" +
                        this.id).css({width: a + "px"});
                    this.options.titleoverlay || b(".html5gallery-title-" + this.id).css({top: e + "px"});
                    b(".html5gallery-viral-" + this.id).css({top: d + "px"});
                    b(".html5gallery-timer-" + this.id).css({top: String(this.options.elemTop + this.options.height - 2) + "px"});
                    this.options.showcarousel && (b(".html5gallery-car-" + this.id).css({
                        width: this.options.carouselWidth + "px",
                        height: this.options.carouselHeight + "px",
                        top: this.options.carouselTop + "px",
                        left: this.options.carouselLeft + "px",
                        top: this.options.carouselTop +
                        "px"
                    }), b(".html5gallery-car-list-" + this.id).css({
                        top: this.options.carTop + "px",
                        height: String(this.options.carAreaLength) + "px",
                        width: this.options.carouselWidth + "px"
                    }), this.options.thumbShowNum = Math.floor(this.options.carAreaLength / (this.options.thumbheight + this.options.thumbgap)), 1 > this.options.thumbShowNum && (this.options.thumbShowNum = 1), this.options.thumbMaskHeight = this.options.thumbShowNum * this.options.thumbheight + (this.options.thumbShowNum - 1) * this.options.thumbgap, this.options.thumbTotalHeight = this.elemArray.length *
                        this.options.thumbheight + (this.elemArray.length - 1) * this.options.thumbgap, this.options.carouselSlider && (this.options.carouselSliderMin = 0, this.options.carouselSliderMax = this.options.thumbMaskHeight - 54, b(".html5gallery-car-slider-bar-" + this.id).css({height: this.options.thumbMaskHeight + "px"}), b(".html5gallery-car-slider-bar-middle-" + this.id).css({height: String(this.options.thumbMaskHeight - 32) + "px"}), this.options.isMobile && b(".html5gallery-car-right-" + this.id).css({
                        top: String(this.options.thumbMaskHeight -
                            35) + "px"
                    }), b(".html5gallery-car-slider-bar-" + this.id).css({display: "block"}), b(".html5gallery-car-left-" + this.id).css({display: "block"}), b(".html5gallery-car-right-" + this.id).css({display: "block"}), b(".html5gallery-car-slider-" + this.id).css({display: "block"})), a = 0, this.options.carouselNavButton && (a = Math.round(this.options.carAreaLength / 2 - this.options.thumbMaskHeight / 2)), b(".html5gallery-car-mask-" + this.id).css({
                        top: a + "px",
                        height: this.options.thumbMaskHeight + "px"
                    }), this.carouselHighlight(this.curElem))
                }
            },
            createStyleVertical: function () {
                this.options.thumbimagewidth = this.options.thumbshowtitle ? this.options.thumbheight - 2 * this.options.thumbimageborder - 4 : this.options.thumbwidth - 2 * this.options.thumbimageborder - 4;
                this.options.thumbimageheight = this.options.thumbheight - 2 * this.options.thumbimageborder - 4;
                this.options.showtitle || (this.options.titleheight = 0);
                if (!this.options.showsocialmedia || !this.options.showfacebooklike && !this.options.showtwitter && !this.options.showgoogleplus)this.options.socialheight = 0;
                this.options.headerHeight =
                    this.options.titleoverlay ? this.options.socialheight : this.options.titleheight + this.options.socialheight;
                this.options.boxWidth = this.options.width;
                this.options.boxHeight = this.options.height + this.options.headerHeight;
                this.options.boxLeft = this.options.padding;
                this.options.boxTop = this.options.padding;
                this.options.slideshadow && (this.options.boxWidth += 8);
                this.options.showcarousel ? "bottom" == this.options.carouselposition ? (this.options.carouselWidth = this.options.width, this.options.carouselHeight = this.options.carouselheight,
                    this.options.carouselLeft = this.options.padding, this.options.carouselTop = this.options.height + this.options.headerHeight + 2 * this.options.padding, this.options.carAreaLength = this.options.carouselHeight, this.options.carouselSlider = Math.floor(this.options.carAreaLength / (this.options.thumbheight + this.options.thumbgap)) < this.elemArray.length, this.options.thumbwidth = this.options.width, this.options.carouselSlider && (this.options.thumbwidth -= 20)) : (this.options.carouselWidth = this.options.thumbwidth, this.options.carouselHeight =
                    this.options.height + this.options.headerHeight, this.options.carTop = 0, this.options.carBottom = 0, this.options.carAreaLength = this.options.carouselHeight - this.options.carTop - this.options.carBottom, this.options.carouselSlider = Math.floor(this.options.carAreaLength / (this.options.thumbheight + this.options.thumbgap)) < this.elemArray.length, this.options.carouselSlider && (this.options.carouselWidth += 20), "left" == this.options.carouselposition ? (this.options.boxLeft = this.options.padding + this.options.carouselWidth + this.options.carouselmargin,
                    this.options.carouselLeft = this.options.padding) : this.options.carouselLeft = this.options.padding + this.options.width + this.options.carouselmargin, this.options.carouselTop = this.options.padding) : (this.options.carouselWidth = 0, this.options.carouselHeight = 0, this.options.carouselLeft = 0, this.options.carouselTop = 0, this.options.carouselmargin = 0);
                "bottom" == this.options.carouselposition ? (this.options.totalWidth = this.options.width + 2 * this.options.padding, this.options.totalHeight = this.options.height + this.options.headerHeight +
                    2 * this.options.padding + this.options.carouselmargin + this.options.carouselHeight) : (this.options.totalWidth = this.options.width + this.options.carouselWidth + this.options.carouselmargin + 2 * this.options.padding, this.options.totalHeight = this.options.height + this.options.headerHeight + 2 * this.options.padding);
                this.options.containerWidth = this.options.totalWidth;
                this.options.containerHeight = this.options.totalHeight;
                this.options.responsive ? (this.options.originalWidth = this.options.width, this.options.originalHeight =
                    this.options.height, this.container.css({"max-width": "100%"})) : this.container.css({
                    width: this.options.containerWidth,
                    height: this.options.containerHeight
                });
                var a = 0, c = 0;
                this.options.elemTop = 0;
                "top" == this.options.headerpos ? (c = 0, a = this.options.socialheight, this.options.elemTop = this.options.headerHeight) : "bottom" == this.options.headerpos && (this.options.elemTop = 0, a = this.options.titleoverlay ? this.options.height - this.options.titleheight : this.options.height, c = this.options.titleoverlay ? this.options.height : this.options.height +
                this.options.titleheight);
                var d = " .html5gallery-container-" + this.id + " { display:block; position:absolute; left:0px; top:0px; width:" + this.options.totalWidth + "px; height:" + this.options.totalHeight + "px; " + (!this.options.bgimage ? "" : "background:url('" + this.options.bgimage + "') center top;") + " background-color:" + this.options.bgcolor + ";}";
                this.options.galleryshadow && (d += " .html5gallery-container-" + this.id + " { -moz-box-shadow: 0px 2px 5px #aaa; -webkit-box-shadow: 0px 2px 5px #aaa; box-shadow: 0px 2px 5px #aaa;}");
                var d = d + (" .html5gallery-box-" + this.id + " {display:block; position:absolute; text-align:center; left:" + this.options.boxLeft + "px; top:" + this.options.boxTop + "px; width:" + this.options.boxWidth + "px; height:" + this.options.boxHeight + "px; }"), e = Math.round(this.options.socialheight / 2 - 12), d = d + (" .html5gallery-title-text-" + this.id + " " + this.options.titlecss + " .html5gallery-title-text-" + this.id + " " + this.options.titlecsslink + " .html5gallery-error-" + this.id + " " + this.options.errorcss), d = d + (" .html5gallery-description-text-" +
                    this.id + " " + this.options.descriptioncss + " .html5gallery-description-text-" + this.id + " " + this.options.descriptioncsslink), d = d + (" .html5gallery-fullscreen-title-" + this.id + "" + this.options.lightboxtitlecss + " .html5gallery-fullscreen-title-" + this.id + "" + this.options.lightboxtitlelinkcss), d = d + (" .html5gallery-fullscreen-description-" + this.id + "" + this.options.lightboxdescriptioncss + " .html5gallery-fullscreen-description-" + this.id + "" + this.options.lightboxdescriptionlinkcss), d = d + (" .html5gallery-viral-" + this.id +
                    " {display:block; overflow:hidden; position:absolute; text-align:left; top:" + c + "px; left:0px; width:" + this.options.boxWidth + "px; height:" + this.options.socialheight + "px; padding-top:" + e + "px;}"), d = d + (" .html5gallery-title-" + this.id + " {display:" + (this.options.titleoverlay && this.options.titleautohide ? "none" : "block") + "; overflow:hidden; position:absolute; left:0px; width:" + this.options.boxWidth + "px; "), d = this.options.titleoverlay ? "top" == this.options.headerpos ? d + "top:0px; height:auto; }" : d + "bottom:0px; height:auto; }" :
                d + ("top:" + a + "px; height:" + this.options.titleheight + "px; }"), d = d + (" .html5gallery-timer-" + this.id + " {display:block; position:absolute; top:" + String(this.options.elemTop + this.options.height - 2) + "px; left:0px; width:0px; height:2px; background-color:#ccc; filter:alpha(opacity=60); opacity:0.6; }"), d = d + (" .html5gallery-elem-" + this.id + " {display:block; overflow:hidden; position:absolute; top:" + this.options.elemTop + "px; left:0px; width:" + this.options.boxWidth + "px; height:" + this.options.height + "px;}");
                this.options.isIE7 ||
                this.options.isIE6 ? (d += " .html5gallery-loading-" + this.id + " {display:none; }", d += " .html5gallery-loading-center-" + this.id + " {display:none; }") : (d += " .html5gallery-loading-" + this.id + " {display:block; position:absolute; top:4px; right:4px; width:100%; height:100%; background:url('" + this.options.skinfolder + "loading.gif') no-repeat top right;}", d += " .html5gallery-loading-center-" + this.id + " {display:block; position:absolute; top:0px; left:0px; width:100%; height:100%; background:url('" + this.options.skinfolder +
                    "loading_center.gif') no-repeat center center;}");
                0 < this.options.borderradius && (d += " .html5gallery-elem-" + this.id + " { overflow:hidden; border-radius:" + this.options.borderradius + "px; -moz-border-radius:" + this.options.borderradius + "px; -webkit-border-radius:" + this.options.borderradius + "px;}");
                this.options.slideshadow && (d += " .html5gallery-title-" + this.id + " { padding:4px;}", d += " .html5gallery-timer-" + this.id + " { margin:4px;}", d += " .html5gallery-elem-" + this.id + " { overflow:hidden; padding:4px; -moz-box-shadow: 0px 2px 5px #aaa; -webkit-box-shadow: 0px 2px 5px #aaa; box-shadow: 0px 2px 5px #aaa;}");
                this.options.showcarousel ? (d += " .html5gallery-car-" + this.id + " { position:absolute; display:block; overflow:hidden; width:" + this.options.carouselWidth + "px; height:" + this.options.carouselHeight + "px; left:" + this.options.carouselLeft + "px; top:" + this.options.carouselTop + "px; }", d += " .html5gallery-car-list-" + this.id + " { position:absolute; display:block; overflow:hidden; top:" + this.options.carTop + "px; height:" + String(this.options.carAreaLength) + "px; left:0px; width:" + this.options.carouselWidth + "px; }", d +=
                    ".html5gallery-thumbs-" + this.id + " {margin-top:0px; height:" + String(this.elemArray.length * (this.options.thumbheight + this.options.thumbgap)) + "px;}", this.options.thumbShowNum = Math.floor(this.options.carAreaLength / (this.options.thumbheight + this.options.thumbgap)), 1 > this.options.thumbShowNum && (this.options.thumbShowNum = 1), this.options.thumbMaskHeight = this.options.thumbShowNum * this.options.thumbheight + (this.options.thumbShowNum - 1) * this.options.thumbgap, this.options.thumbTotalHeight = this.elemArray.length *
                    this.options.thumbheight + (this.elemArray.length - 1) * this.options.thumbgap, this.options.carouselSliderMin = 0, this.options.carouselSliderMax = this.options.thumbMaskHeight - 54, d += " .html5gallery-car-slider-bar-" + this.id + " { position:absolute; display:" + (this.options.carouselSlider ? "block" : "none") + "; overflow:hidden; top:0px; height:" + this.options.thumbMaskHeight + "px; left:" + String(this.options.thumbwidth + 6) + "px; width:14px;}", d += " .html5gallery-car-slider-bar-top-" + this.id + " { position:absolute; display:block; top:0px; left:0px; width:14px; height:16px; background:url('" +
                    this.options.skinfolder + "bartop.png')}", d += " .html5gallery-car-slider-bar-middle-" + this.id + " { position:absolute; display:block; top:16px; left:0px; width:14px; height:" + String(this.options.thumbMaskHeight - 32) + "px; background:url('" + this.options.skinfolder + "bar.png')}", d += " .html5gallery-car-slider-bar-bottom-" + this.id + " { position:absolute; display:block; bottom:0px; left:0px; width:14px; height:16px; background:url('" + this.options.skinfolder + "barbottom.png')}", d = this.options.isMobile ? d + (" .html5gallery-car-left-" +
                this.id + " { position:absolute; display:" + (this.options.carouselSlider ? "block" : "none") + "; cursor:pointer; overflow:hidden; width:16px; height:35px; left:" + String(this.options.thumbwidth + 5) + "px; top:0px; background:url('" + this.options.skinfolder + "slidertop.png')}  .html5gallery-car-right-" + this.id + " { position:absolute; display:" + (this.options.carouselSlider ? "block" : "none") + "; cursor:pointer; overflow:hidden; width:16px; height:35px; left:" + String(this.options.thumbwidth + 5) + "px; top:" + String(this.options.thumbMaskHeight -
                    35) + "px; background:url('" + this.options.skinfolder + "sliderbottom.png')} ") : d + (" .html5gallery-car-slider-" + this.id + " { position:absolute; display:" + (this.options.carouselSlider ? "block" : "none") + "; overflow:hidden; cursor:pointer; top:0px; height:54px; left:" + String(this.options.thumbwidth + 5) + "px; width:16px; background:url('" + this.options.skinfolder + "slider.png');}"), a = 0, this.options.carouselNavButton && (a = Math.round(this.options.carAreaLength / 2 - this.options.thumbMaskHeight / 2)), d += " .html5gallery-car-mask-" +
                    this.id + " { position:absolute; display:block; overflow:hidden; top:" + a + "px; height:" + this.options.thumbMaskHeight + "px; left:0px; width:" + this.options.thumbwidth + "px;} ", a = this.options.thumbheight, this.options.isIE || (a = this.options.thumbheight - 2), d += " .html5gallery-tn-" + this.id + " { display:block; margin-bottom:" + this.options.thumbgap + "px; text-align:center; cursor:pointer; width:" + this.options.thumbwidth + "px;height:" + a + "px;overflow:hidden;", this.options.carouselbgtransparent ? d += "background-color:transparent;" :
                    (this.options.isIE || (d += "border-top:1px solid " + this.options.carouseltopborder + "; border-bottom:1px solid " + this.options.carouselbottomborder + ";"), d += "background-color: " + this.options.carouselbgcolorend + "; background: " + this.options.carouselbgcolorend + " -webkit-gradient(linear, left top, left bottom, from(" + this.options.carouselbgcolorstart + "), to(" + this.options.carouselbgcolorend + ")) no-repeat; background: " + this.options.carouselbgcolorend + " -moz-linear-gradient(top, " + this.options.carouselbgcolorstart +
                        ", " + this.options.carouselbgcolorend + ") no-repeat; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=" + this.options.carouselbgcolorstart + ", endColorstr=" + this.options.carouselbgcolorend + ") no-repeat; -ms-filter: 'progid:DXImageTransform.Microsoft.gradient(startColorstr=" + this.options.carouselbgcolorstart + ", endColorstr=" + this.options.carouselbgcolorend + ")' no-repeat;"), this.options.carouselbgimage && (d += "background:url('" + this.options.skinfolder + this.options.carouselbgimage + "') center top;"),
                    d = d + "}" + (" .html5gallery-tn-selected-" + this.id + " { display:block; margin-bottom:" + this.options.thumbgap + "px;text-align:center; cursor:pointer; width:" + this.options.thumbwidth + "px;height:" + a + "px;overflow:hidden;"), this.options.carouselbgtransparent ? d += "background-color:transparent;" : (this.options.isIE || (d += "border-top:1px solid " + this.options.carouselhighlighttopborder + "; border-bottom:1px solid " + this.options.carouselhighlightbottomborder + ";"), d += "background-color: " + this.options.carouselhighlightbgcolorend +
                    "; background: " + this.options.carouselhighlightbgcolorend + " -webkit-gradient(linear, left top, left bottom, from(" + this.options.carouselhighlightbgcolorstart + "), to(" + this.options.carouselhighlightbgcolorend + ")) no-repeat; background: " + this.options.carouselhighlightbgcolorend + " -moz-linear-gradient(top, " + this.options.carouselhighlightbgcolorstart + ", " + this.options.carouselhighlightbgcolorend + ") no-repeat; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=" + this.options.carouselhighlightbgcolorstart +
                    ", endColorstr=" + this.options.carouselhighlightbgcolorend + ") no-repeat; -ms-filter: 'progid:DXImageTransform.Microsoft.gradient(startColorstr=" + this.options.carouselhighlightbgcolorstart + ", endColorstr=" + this.options.carouselhighlightbgcolorend + ")' no-repeat;"), this.options.carouselbgimage && (d += "background:url('" + this.options.skinfolder + this.options.carouselbgimage + "') center top;"), d += "}", d += " .html5gallery-tn-selected-" + this.id + " .html5gallery-tn-img-" + this.id + " {background-color:" + this.options.thumbimagebordercolor +
                    ";} .html5gallery-tn-" + this.id + " { filter:alpha(opacity=" + Math.round(100 * this.options.thumbopacity) + "); opacity:" + this.options.thumbopacity + "; }  .html5gallery-tn-selected-" + this.id + " { filter:alpha(opacity=100); opacity:1; } ", a = this.options.thumbwidth - 3 * this.options.thumbmargin, this.options.thumbshowimage ? (a -= this.options.thumbimagewidth + 2 * this.options.thumbimageborder, c = this.options.thumbshowtitle ? this.options.thumbmargin : this.options.thumbwidth / 2 - (this.options.thumbimagewidth + 2 * this.options.thumbimageborder) /
                2, e = Math.round((this.options.thumbheight - 2) / 2 - (this.options.thumbimageheight + 2 * this.options.thumbimageborder) / 2), d += " .html5gallery-tn-img-" + this.id + " {display:block; overflow:hidden; float:left; margin-top:" + e + "px; margin-left:" + c + "px; width:" + String(this.options.thumbimagewidth + 2 * this.options.thumbimageborder) + "px;height:" + String(this.options.thumbimageheight + 2 * this.options.thumbimageborder) + "px;}") : d += " .html5gallery-tn-img-" + this.id + " {display:none;}", this.options.thumbshowtitle ? (d += " .html5gallery-tn-title-" +
                    this.id + " {display:block; overflow:hidden; float:left; margin-top:0px; margin-left:" + this.options.thumbmargin + "px; width:" + a + "px;height:" + String(this.options.thumbheight - 2) + "px;" + (this.options.thumbshowdescription ? "" : "line-height:" + String(this.options.thumbheight - 2) + "px;") + "}", d += " .html5gallery-tn-title-" + this.id + this.options.thumbtitlecss, d += " .html5gallery-tn-description-" + this.id + this.options.thumbdescriptioncss) : (d += " .html5gallery-tn-title-" + this.id + " {display:none;}", d += " .html5gallery-tn-description-" +
                    this.id + " {display:none;}"), this.carouselHighlight = function (a) {
                    b("#html5gallery-tn-" + this.id + "-" + a, this.$gallery).removeClass("html5gallery-tn-" + this.id).addClass("html5gallery-tn-selected-" + this.id);
                    if (!(this.options.thumbShowNum >= this.elemArray.length)) {
                        a = Math.floor(a / this.options.thumbShowNum) * this.options.thumbShowNum * (this.options.thumbheight + this.options.thumbgap);
                        a >= this.options.thumbTotalHeight - this.options.thumbMaskHeight && (a = this.options.thumbTotalHeight - this.options.thumbMaskHeight);
                        var c =
                            a / (this.elemArray.length * (this.options.thumbheight + this.options.thumbgap) - this.options.thumbMaskHeight), c = c * (this.options.carouselSliderMax - this.options.carouselSliderMin);
                        b(".html5gallery-car-slider-" + this.id, this.$gallery).stop(!0).animate({top: c}, 300);
                        b(".html5gallery-thumbs-" + this.id, this.$gallery).stop(!0).animate({marginTop: -1 * a}, 300);
                        this.updateCarouseButtons(-a)
                    }
                }, this.carouselBarClicked = function (a) {
                    var c = b(".html5gallery-thumbs-" + this.id, this.$gallery);
                    a.pageY > b(".html5gallery-car-slider-" +
                        this.id, this.$gallery).offset().top ? (a = -1 * parseInt(c.css("margin-top")) + this.options.thumbShowNum * (this.options.thumbheight + this.options.thumbgap), a >= this.options.thumbTotalHeight - this.options.thumbMaskHeight && (a = this.options.thumbTotalHeight - this.options.thumbMaskHeight)) : (a = -1 * parseInt(c.css("margin-top")) - this.options.thumbShowNum * (this.options.thumbheight + this.options.thumbgap), 0 > a && (a = 0));
                    c.stop(!0).animate({marginTop: -a}, 500);
                    this.updateCarouseButtons(-a);
                    a = a * (this.options.carouselSliderMax -
                        this.options.carouselSliderMin) / (this.elemArray.length * (this.options.thumbheight + this.options.thumbgap) - this.options.thumbMaskHeight);
                    a < this.options.carouselSliderMin && (a = this.options.carouselSliderMin);
                    a > this.options.carouselSliderMax && (a = this.options.carouselSliderMax);
                    b(".html5gallery-car-slider-" + this.id, this.$gallery).stop(!0).animate({top: a}, 500)
                }, this.carouselSliderDrag = function (a, c) {
                    var d = c.offsetY - b(".html5gallery-car-slider-bar-" + this.id, this.$gallery).offset().top;
                    d < this.options.carouselSliderMin &&
                    (d = this.options.carouselSliderMin);
                    d > this.options.carouselSliderMax && (d = this.options.carouselSliderMax);
                    b(".html5gallery-car-slider-" + this.id, this.$gallery).css({top: d});
                    var e = this.elemArray.length * (this.options.thumbheight + this.options.thumbgap) - this.options.thumbMaskHeight, e = e * d / (this.options.carouselSliderMax - this.options.carouselSliderMin), e = Math.round(e / (this.options.thumbheight + this.options.thumbgap)), e = -1 * e * (this.options.thumbheight + this.options.thumbgap);
                    b(".html5gallery-thumbs-" + this.id,
                        this.$gallery).stop(!0).animate({marginTop: e}, 300)
                }, this.carouselPrev = function () {
                    var a = b(".html5gallery-thumbs-" + this.id, this.$gallery);
                    if (0 != parseInt(a.css("margin-top"))) {
                        var c = -1 * parseInt(a.css("margin-top")) - this.options.thumbShowNum * (this.options.thumbheight + this.options.thumbgap);
                        0 > c && (c = 0);
                        a.animate({marginTop: -c}, 500, this.options.carouseleasing);
                        this.updateCarouseButtons(-c)
                    }
                }, this.carouselNext = function () {
                    var a = b(".html5gallery-thumbs-" + this.id, this.$gallery);
                    if (parseInt(a.css("margin-top")) != -(this.options.thumbTotalHeight - this.options.thumbMaskHeight)) {
                        var c = -1 * parseInt(a.css("margin-top")) + this.options.thumbShowNum * (this.options.thumbheight + this.options.thumbgap);
                        c >= this.options.thumbTotalHeight - this.options.thumbMaskHeight && (c = this.options.thumbTotalHeight - this.options.thumbMaskHeight);
                        a.animate({marginTop: -c}, 500, this.options.carouseleasing);
                        this.updateCarouseButtons(-c)
                    }
                }, this.updateCarouseButtons = function (a) {
                    var c = b(".html5gallery-car-left-" + this.id, this.$gallery), d = b(".html5gallery-car-right-" +
                        this.id, this.$gallery), e = -1 * (this.options.thumbTotalHeight - this.options.thumbMaskHeight);
                    0 == a ? (c.css({
                        "background-position": "-" + String(2 * this.options.carouselarrowwidth) + "px 0px",
                        cursor: ""
                    }), c.data("disabled", !0)) : c.data("disabled") && (c.css({
                        "background-position": "0px 0px",
                        cursor: "pointer"
                    }), c.data("disabled", !1));
                    a == e ? (d.css({
                        "background-position": "-" + String(2 * this.options.carouselarrowwidth) + "px 0px",
                        cursor: ""
                    }), d.data("disabled", !0)) : d.data("disabled") && (d.css({
                        "background-position": "0px 0px",
                        cursor: "pointer"
                    }), d.data("disabled", !1))
                }) : d += " .html5gallery-car-" + this.id + " { display:none; }";
                d += ".html5gallery-container-" + this.id + " div {box-sizing:content-box;}";
                b("head").append("<style type='text/css' data-creator='html5gallery'>" + d + "</style>")
            }, resizeImageToolbox: function () {
                if ("center" != this.options.imagetoolboxstyle) {
                    var a = Math.round(("bottom" == this.options.headerpos ? 0 : this.options.headerHeight) + this.options.height / 2 - 24), c = a + Math.round(this.options.height / 2) - 32, d = this.options.boxWidth -
                        48, e = this.options.showfullscreenbutton ? d - 48 : d;
                    b(".html5gallery-play-" + this.id).css({top: c + "px", left: e + "px"});
                    b(".html5gallery-pause-" + this.id).css({top: c + "px", left: e + "px"});
                    b(".html5gallery-left-" + this.id).css({top: a + "px"});
                    b(".html5gallery-right-" + this.id).css({top: a + "px", left: d + "px"});
                    b(".html5gallery-lightbox-" + this.id).css({top: c + "px", left: d + "px"})
                }
            }, createImageToolbox: function () {
                1 >= this.elemArray.length && (this.options.showplaybutton = this.options.showprevbutton = this.options.shownextbutton = !1);
                if ("never" != this.options.showimagetoolbox) {
                    var a;
                    if ("center" == this.options.imagetoolboxstyle)a = " .html5gallery-toolbox-" + this.id + " {display:" + ("show" == this.options.imagetoolboxmode ? "block" : "none") + "; overflow:hidden; position:relative; margin:0px auto; text-align:center; height:40px;}", a += " .html5gallery-toolbox-bg-" + this.id + " {display:block; left:0px; top:0px; width:100%; height:100%; position:absolute; filter:alpha(opacity=60); opacity:0.6; background-color:#222222; }", a += " .html5gallery-toolbox-buttons-" +
                        this.id + " {display:block; margin:0px auto; height:100%;}", a += " .html5gallery-play-" + this.id + " { position:relative; float:left; display:" + ("show" == this.options.imagetoolboxmode ? "block" : "none") + "; cursor:pointer; overflow:hidden; width:32px; height:32px; margin-left:2px; margin-right:2px; margin-top:" + Math.round(4) + "px; background:url('" + this.options.skinfolder + "play.png') no-repeat top left; } ", a += " .html5gallery-pause-" + this.id + " { position:relative; float:left; display:" + ("show" == this.options.imagetoolboxmode ?
                            "block" : "none") + "; cursor:pointer; overflow:hidden; width:32px; height:32px; margin-left:2px; margin-right:2px; margin-top:" + Math.round(4) + "px; background:url('" + this.options.skinfolder + "pause.png') no-repeat top left; } ", a += " .html5gallery-left-" + this.id + " { position:relative; float:left; display:" + ("show" == this.options.imagetoolboxmode ? "block" : "none") + "; cursor:pointer; overflow:hidden; width:32px; height:32px; margin-left:2px; margin-right:2px; margin-top:" + Math.round(4) + "px; background:url('" +
                        this.options.skinfolder + "prev.png') no-repeat top left; } ", a += " .html5gallery-right-" + this.id + " { position:relative; float:left; display:" + ("show" == this.options.imagetoolboxmode ? "block" : "none") + "; cursor:pointer; overflow:hidden; width:32px; height:32px; margin-left:2px; margin-right:2px; margin-top:" + Math.round(4) + "px; background:url('" + this.options.skinfolder + "next.png') no-repeat top left; } ", a += " .html5gallery-lightbox-" + this.id + " {position:relative; float:left; display:" + ("show" == this.options.imagetoolboxmode ?
                            "block" : "none") + "; cursor:pointer; overflow:hidden; width:32px; height:32px; margin-left:2px; margin-right:2px; margin-top:" + Math.round(4) + "px; background:url('" + this.options.skinfolder + "lightbox.png') no-repeat top left; } "; else {
                        var c = Math.round(("bottom" == this.options.headerpos ? 0 : this.options.headerHeight) + this.options.height / 2 - 24), d = c + Math.round(this.options.height / 2) - 32, e = this.options.width - 54, f = this.options.showfullscreenbutton ? e - 48 : e;
                        a = " .html5gallery-toolbox-" + this.id + " {display:" + ("show" ==
                            this.options.imagetoolboxmode ? "block" : "none") + ";}";
                        a += " .html5gallery-toolbox-bg-" + this.id + " {display:none;}";
                        a += " .html5gallery-toolbox-buttons-" + this.id + " {display:block;}";
                        a += " .html5gallery-play-" + this.id + " { position:absolute; display:" + ("show" == this.options.imagetoolboxmode ? "block" : "none") + "; cursor:pointer; top:" + d + "px; left:" + f + "px; width:48px; height:48px; background:url('" + this.options.skinfolder + "side_play.png') no-repeat top left;} ";
                        a += " .html5gallery-pause-" + this.id + " { position:absolute; display:" +
                            ("show" == this.options.imagetoolboxmode ? "block" : "none") + "; cursor:pointer; top:" + d + "px; left:" + f + "px; width:48px; height:48px; background:url('" + this.options.skinfolder + "side_pause.png') no-repeat top left;} ";
                        a += " .html5gallery-left-" + this.id + " { position:absolute; display:" + ("show" == this.options.imagetoolboxmode ? "block" : "none") + "; cursor:pointer; top:" + c + "px; left:0px; width:48px; height:48px; background:transparent;} ";
                        a += " .html5gallery-right-" +
                            this.id + " { position:absolute; display:" + ("show" == this.options.imagetoolboxmode ? "block" : "none") + "; cursor:pointer; top:" + c + "px; left:" + e + "px; width:48px; height:48px; background:transparent;} ";
                        a += " .html5gallery-lightbox-" + this.id + " {position:absolute; display:" + ("show" == this.options.imagetoolboxmode ? "block" : "none") + "; cursor:pointer; top:" + d + "px; left:" + e + "px; width:48px; height:48px; background:url('" + this.options.skinfolder + "side_lightbox.png') no-repeat top left;} "
                    }
                    //b(".html5gallery-play-" +
                    //    this.id, this.$gallery).hover(function () {
                    //    b(this).css({"background-position": "right top"})
                    //}, function () {
                    //    b(this).css({"background-position": "left top"})
                    //});
                    //b(".html5gallery-pause-" + this.id, this.$gallery).hover(function () {
                    //    b(this).css({"background-position": "right top"})
                    //}, function () {
                    //    b(this).css({"background-position": "left top"})
                    //});
                    //b(".html5gallery-left-" + this.id, this.$gallery).hover(function () {
                    //   // b(this).css({"background-position": "right top"})
                    //}, function () {
                    //    b(this).css({"background-position": "left top"})
                    //});
                    //b(".html5gallery-right-" + this.id, this.$gallery).hover(function () {
                    //   // b(this).css({"background-position": "right top"})
                    //}, function () {
                    //    b(this).css({"background-position": "left top"})
                    //});
                    //b(".html5gallery-lightbox-" + this.id, this.$gallery).hover(function () {
                    //    b(this).css({"background-position": "right top"})
                    //}, function () {
                    //    b(this).css({"background-position": "left top"})
                    //});
                    b("head").append("<style type='text/css' data-creator='html5gallery'>" + a + "</style>")
                }
                this.showimagetoolbox = function (a, c) {
                    if (this.options.showplaybutton ||
                        this.options.showprevbutton || this.options.shownextbutton || this.options.showfullscreenbutton) {
                        var d = this;
                        clearTimeout(d.hideToolboxTimeout);
                        d.hideToolboxTimeout = setTimeout(function () {
                            d.hideimagetoolbox()
                        }, 3E3);
                        if ("center" == this.options.imagetoolboxstyle) {
                            var e = Math.round(("bottom" == this.options.headerpos ? 0 : this.options.headerHeight) + this.options.height / 2);
                            if (6 == a || 7 == a || 8 == a || 9 == a || 10 == a || 11 == a)e += 45;
                            b(".html5gallery-toolbox-" + this.id, this.$gallery).css({top: e});
                            e = 0;
                            this.options.showplaybutton && 1 ==
                            a ? (e += 36, this.isPaused ? (b(".html5gallery-play-" + this.id, this.$gallery).show(), b(".html5gallery-pause-" + this.id, this.$gallery).hide()) : (b(".html5gallery-play-" + this.id, this.$gallery).hide(), b(".html5gallery-pause-" + this.id, this.$gallery).show())) : (b(".html5gallery-play-" + this.id, this.$gallery).hide(), b(".html5gallery-pause-" + this.id, this.$gallery).hide());
                            this.options.showprevbutton ? (e += 36, b(".html5gallery-left-" + this.id, this.$gallery).show()) : b(".html5gallery-left-" + this.id, this.$gallery).hide();
                            this.options.shownextbutton ? (e += 36, b(".html5gallery-right-" + this.id, this.$gallery).show()) : b(".html5gallery-right-" + this.id, this.$gallery).hide();
                            this.options.showfullscreenbutton && 1 == a ? (e += 36, b(".html5gallery-lightbox-" + this.id, this.$gallery).show()) : b(".html5gallery-lightbox-" + this.id, this.$gallery).hide();
                            b(".html5gallery-toolbox-" + this.id, this.$gallery).css({width: e + 16});
                            b(".html5gallery-toolbox-buttons-" + this.id, this.$gallery).css({width: e})
                        } else this.options.showplaybutton && 1 == a ? this.isPaused ?
                            (b(".html5gallery-play-" + this.id, this.$gallery).show(), b(".html5gallery-pause-" + this.id, this.$gallery).hide()) : (b(".html5gallery-play-" + this.id, this.$gallery).hide(), b(".html5gallery-pause-" + this.id, this.$gallery).show()) : (b(".html5gallery-play-" + this.id, this.$gallery).hide(), b(".html5gallery-pause-" + this.id, this.$gallery).hide()), this.options.showprevbutton ? b(".html5gallery-left-" + this.id, this.$gallery).show() : b(".html5gallery-left-" + this.id, this.$gallery).hide(), this.options.shownextbutton ? b(".html5gallery-right-" +
                            this.id, this.$gallery).show() : b(".html5gallery-right-" + this.id, this.$gallery).hide(), this.options.showfullscreenbutton && 1 == a ? b(".html5gallery-lightbox-" + this.id, this.$gallery).show() : b(".html5gallery-lightbox-" + this.id, this.$gallery).hide();
                        this.options.isIE678 || c ? b(".html5gallery-toolbox-" + this.id, this.$gallery).show() : b(".html5gallery-toolbox-" + this.id, this.$gallery).fadeIn()
                    }
                };
                this.hideimagetoolbox = function () {
                    "show" != this.options.imagetoolboxmode && (clearTimeout(this.hideToolboxTimeout), this.options.isIE678 ?
                        b(".html5gallery-toolbox-" + this.id, this.$gallery).hide() : b(".html5gallery-toolbox-" + this.id, this.$gallery).fadeOut())
                }
            }, resizeStyleDefault: function () {
                if (this.container.parent() && this.container.parent().width()) {
                    this.options.containerWidth = this.container.parent().width();
                    this.options.totalWidth = this.options.containerWidth;
                    this.options.width = this.options.totalWidth - 2 * this.options.padding;
                    if (this.options.titlesmallscreen) {
                        var a = b(window).width();
                        this.options.titleheight = a < this.options.titlesmallscreenwidth ?
                            this.options.titleheightsmallscreen : this.options.titleheightlargescreen;
                        this.options.headerHeight = this.options.titleoverlay ? this.options.socialheight : this.options.titleheight + this.options.socialheight
                    }
                    this.options.showcarousel && (this.options.carouselHeight = this.options.thumbheight + 2 * this.options.thumbmargin, this.options.carouselmultirows ? ("samecolumn" == this.options.thumbresponsive ? (this.options.carouselcolumn = this.options.thumbcolumns, this.options.thumbcolumnsresponsive && (a = b(window).width(), a < this.options.thumbsmallsize ?
                        this.options.carouselcolumn = this.options.thumbsmallcolumns : a < this.options.thumbmediumsize && (this.options.carouselcolumn = this.options.thumbmediumcolumns)), this.options.thumbwidth = Math.min((this.options.width - this.options.thumbgap * (this.options.carouselcolumn - 1)) / this.options.carouselcolumn), this.options.thumbheight = this.options.thumbwidth * this.options.thumboriginalheight / this.options.thumboriginalwidth, this.options.thumbimagewidth = this.options.thumbwidth - 2 * this.options.thumbimageborder, this.options.thumbimageheight =
                        this.options.thumbheight - 2 * this.options.thumbimageborder, this.options.thumbshowtitle && (this.options.thumbheight += this.options.thumbtitleheight)) : (this.options.thumbcolumnsresponsive && (a = b(window).width(), a < this.options.thumbsmallsize ? (this.options.thumbwidth = this.options.thumbsmallwidth, this.options.thumbheight = this.options.thumbsmallheight) : a < this.options.thumbmediumsize ? (this.options.thumbwidth = this.options.thumbmediumwidth, this.options.thumbheight = this.options.thumbmediumheight) : (this.options.thumbwidth =
                        this.options.thumboriginalwidth, this.options.thumbheight = this.options.thumboriginalheight), this.options.thumbimagewidth = this.options.thumbwidth - 2 * this.options.thumbimageborder, this.options.thumbimageheight = this.options.thumbheight - 2 * this.options.thumbimageborder, this.options.thumbshowtitle && (this.options.thumbheight += this.options.thumbtitleheight)), this.options.carouselcolumn = Math.floor(this.options.width / (this.options.thumbwidth + this.options.thumbgap)), 1 > this.options.carouselcolumn && (this.options.carouselcolumn =
                        1)), this.options.carouselHeight = Math.ceil(this.elemArray.length / this.options.carouselcolumn) * (this.options.thumbheight + this.options.thumbrowgap)) : this.options.thumbcolumnsresponsive && (a = b(window).width(), a < this.options.thumbsmallsize ? (this.options.thumbwidth = this.options.thumbsmallwidth, this.options.thumbheight = this.options.thumbsmallheight) : a < this.options.thumbmediumsize ? (this.options.thumbwidth = this.options.thumbmediumwidth, this.options.thumbheight = this.options.thumbmediumheight) : (this.options.thumbwidth =
                        this.options.thumboriginalwidth, this.options.thumbheight = this.options.thumboriginalheight), this.options.thumbimagewidth = this.options.thumbwidth - 2 * this.options.thumbimageborder, this.options.thumbimageheight = this.options.thumbheight - 2 * this.options.thumbimageborder, this.options.thumbshowtitle && (this.options.thumbheight += this.options.thumbtitleheight)));
                    this.options.responsivefullscreen && 0 < this.container.parent().height() ? (this.options.containerHeight = this.container.parent().height(), this.options.totalHeight =
                        this.options.containerHeight, this.options.height = this.options.totalHeight - (this.options.headerHeight + 2 * this.options.padding), 0 < this.options.carouselHeight + this.options.carouselmargin && (this.options.height -= this.options.carouselHeight + this.options.carouselmargin)) : (this.options.height = Math.round(this.options.width * this.options.originalHeight / this.options.originalWidth), this.options.totalHeight = this.options.height + this.options.carouselHeight + this.options.carouselmargin + this.options.headerHeight + 2 * this.options.padding,
                        this.options.containerHeight = this.options.totalHeight);
                    this.container.css({width: this.options.containerWidth, height: this.options.containerHeight});
                    this.options.boxWidth = this.options.width;
                    this.options.boxHeight = this.options.height + this.options.headerHeight;
                    this.options.slideshadow && (this.options.boxWidth += 8);
                    this.options.showcarousel && (this.options.carouselWidth = this.options.width, this.options.carouselLeft = this.options.padding, this.options.carouselTop = this.options.padding + this.options.boxHeight + this.options.carouselmargin);
                    b(".html5gallery-container-" + this.id).css({
                        width: this.options.totalWidth + "px",
                        height: this.options.totalHeight + "px"
                    });
                    b(".html5gallery-box-" + this.id).css({
                        width: this.options.boxWidth + "px",
                        height: this.options.boxHeight + "px"
                    });
                    a = this.elemArray[this.curElem][9];
                    if (1 == a || this.showingPoster) {
                        var c = this.elemArray[this.curElem][10], d = this.elemArray[this.curElem][11], e;
                        if (this.isFullscreen) {
                            var a = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : this.fullscreenWidth,
                                f = this.elemArray[this.curElem][18] ? Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : this.fullscreenHeight;
                            e = Math.min(a / c, f / d);
                            e = 1 < e ? 1 : e
                        } else e = "fill" == this.options.resizemode ? Math.max(this.options.width / c, this.options.height / d) : Math.min(this.options.width / c, this.options.height / d);
                        f = Math.round(e * c);
                        d = Math.round(e * d);
                        a = this.isFullscreen ? f : this.options.width;
                        e = this.isFullscreen ? d : this.options.height;
                        var c = Math.round(a / 2 - f / 2), h = Math.round(e / 2 - d / 2);
                        this.isFullscreen && this.adjustFullscreen(a,
                            e, !0);
                        b(".html5gallery-elem-" + this.id).css({width: a + "px", height: e + "px"});
                        b(".html5gallery-elem-img-" + this.id).css({width: a + "px", height: e + "px"});
                        b(".html5gallery-elem-image-" + this.id).css({
                            width: f + "px",
                            height: d + "px",
                            top: h + "px",
                            left: c + "px"
                        })
                    } else if (5 == a || 6 == a || 7 == a || 8 == a || 9 == a || 10 == a || 11 == a)c = this.elemArray[this.curElem][10], d = this.elemArray[this.curElem][11], this.isFullscreen ? (a = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : this.fullscreenWidth, f =
                        this.elemArray[this.curElem][18] ? Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : this.fullscreenHeight, e = Math.min(a / c, f / d), e = 1 < e ? 1 : e, a = Math.round(e * c), e = Math.round(e * d), this.adjustFullscreen(a, e, !0)) : (a = this.options.width, e = this.options.height), b(".html5gallery-elem-" + this.id).css({
                        width: a + "px",
                        height: e + "px"
                    }), b(".html5gallery-elem-video-" + this.id).css({
                        width: a + "px",
                        height: e + "px"
                    }), b(".html5gallery-elem-video-container-" + this.id).css({
                        width: a + "px",
                        height: e + "px"
                    }), f = this.options.isIPhone ?
                    e - 48 : e, b(".html5gallery-elem-video-container-" + this.id).find("video").css({
                        width: a + "px",
                        height: f + "px"
                    }), b("#html5gallery-elem-video-" + this.id).css({
                        width: a + "px",
                        height: e + "px"
                    }), b("#html5gallery-elem-video-" + this.id).attr("width", a), b("#html5gallery-elem-video-" + this.id).attr("height", e), b(".html5gallery-elem-video-" + this.id).find("iframe").attr("width", a), b(".html5gallery-elem-video-" + this.id).find("iframe").attr("height", e), b("#html5gallery-elem-video-" + this.id).find("iframe").attr("width", a), b("#html5gallery-elem-video-" +
                        this.id).find("iframe").attr("height", e);
                    f = a = 0;
                    "bottom" == this.options.headerpos && (a = this.options.titleoverlay ? this.options.height - this.options.titleheight : this.options.height, f = this.options.titleoverlay ? this.options.height : this.options.height + this.options.titleheight);
                    e = this.options.slideshadow ? this.options.boxWidth - 8 : this.options.boxWidth;
                    b(".html5gallery-title-" + this.id).css({width: e + "px"});
                    this.options.titleoverlay || b(".html5gallery-title-" + this.id).css({top: a + "px"});
                    b(".html5gallery-viral-" + this.id).css({
                        top: f +
                        "px"
                    });
                    b(".html5gallery-timer-" + this.id).css({top: String(this.options.elemTop + this.options.height - 2) + "px"});
                    this.options.showcarousel && (b(".html5gallery-car-" + this.id).css({
                        width: this.options.width + "px",
                        top: this.options.carouselTop + "px"
                    }), b(".html5gallery-car-list-" + this.id).css({width: String(this.options.width - 4 - 4) + "px"}), this.options.carouselNavButton = !1, Math.floor((this.options.width - 4 - 4) / (this.options.thumbwidth + this.options.thumbgap)) < this.elemArray.length && (this.options.carouselNavButton = !0),
                        a = this.options.carouselNavButton ? 2 * this.options.carouselarrowwidth + 8 : 0, b(".html5gallery-car-left-" + this.id).css({display: this.options.carouselNavButton ? "block" : "none"}), b(".html5gallery-car-right-" + this.id).css({display: this.options.carouselNavButton ? "block" : "none"}), this.options.thumbShowNum = Math.floor((this.options.width - 4 - 4 - a) / (this.options.thumbwidth + this.options.thumbgap)), 1 > this.options.thumbShowNum && (this.options.thumbShowNum = 1), this.options.thumbMaskWidth = this.options.thumbShowNum * this.options.thumbwidth +
                        this.options.thumbShowNum * this.options.thumbgap, this.options.thumbTotalWidth = this.elemArray.length * this.options.thumbwidth + (this.elemArray.length - 1) * this.options.thumbgap, f = 0, this.options.carouselmultirows ? "samecolumn" == this.options.thumbresponsive ? (b(".html5gallery-thumbs-" + this.id).css({
                        "margin-left": "0px",
                        width: String((this.options.thumbwidth + this.options.thumbgap) * this.options.carouselcolumn) + "px"
                    }), b(".html5gallery-tn-" + this.id).css({
                        width: this.options.thumbwidth + "px", height: this.options.thumbheight +
                        "px"
                    }), b(".html5gallery-tn-selected-" + this.id).css({
                        width: this.options.thumbwidth + "px",
                        height: this.options.thumbheight + "px"
                    }), b(".html5gallery-tn-img-" + this.id).css({
                        width: String(this.options.thumbimagewidth + 2 * this.options.thumbimageborder) + "px",
                        height: String(this.options.thumbimageheight + 2 * this.options.thumbimageborder) + "px"
                    }), b(".html5gallery-tn-image-" + this.id).parent().css({
                        width: this.options.thumbimagewidth + "px",
                        height: this.options.thumbimageheight + "px"
                    }), b(".html5gallery-tn-image-" + this.id).css({
                        width: "100%",
                        height: "100%"
                    }), this.options.thumbshowtitle && b(".html5gallery-tn-title-" + this.id).css({width: String(this.options.thumbwidth - 2) + "px"})) : (a = Math.floor(this.options.width / (this.options.thumbwidth + this.options.thumbgap)), 1 > a && (a = 1), f = (this.options.width - a * this.options.thumbwidth - (a - 1) * this.options.thumbgap) / 2, b(".html5gallery-thumbs-" + this.id).css({
                        "margin-left": f + "px",
                        width: this.options.width + "px"
                    }), b(".html5gallery-tn-" + this.id).css({
                        width: this.options.thumbwidth + "px", height: this.options.thumbheight +
                        "px"
                    }), b(".html5gallery-tn-selected-" + this.id).css({
                        width: this.options.thumbwidth + "px",
                        height: this.options.thumbheight + "px"
                    }), b(".html5gallery-tn-img-" + this.id).css({
                        width: String(this.options.thumbimagewidth + 2 * this.options.thumbimageborder) + "px",
                        height: String(this.options.thumbimageheight + 2 * this.options.thumbimageborder) + "px"
                    }), b(".html5gallery-tn-image-" + this.id).parent().css({
                        width: this.options.thumbimagewidth + "px",
                        height: this.options.thumbimageheight + "px"
                    }), b(".html5gallery-tn-image-" + this.id).css({
                        width: "100%",
                        height: "100%"
                    }), b(".html5gallery-tn-title-" + this.id).css({width: String(this.options.thumbwidth - 2) + "px"})) : (this.options.thumbShowNum = Math.floor((this.options.width - 4 - 4 - a) / (this.options.thumbwidth + this.options.thumbgap)), 1 > this.options.thumbShowNum && (this.options.thumbShowNum = 1), this.options.thumbMaskWidth = this.options.thumbShowNum * this.options.thumbwidth + this.options.thumbShowNum * this.options.thumbgap, this.options.thumbTotalWidth = this.elemArray.length * this.options.thumbwidth + (this.elemArray.length -
                        1) * this.options.thumbgap, f = 0, this.options.thumbMaskWidth > this.options.thumbTotalWidth && (f = this.options.thumbMaskWidth / 2 - this.options.thumbTotalWidth / 2 - this.options.thumbgap / 2), b(".html5gallery-car-" + this.id).css({height: this.options.carouselHeight + "px"}), b(".html5gallery-car-list-" + this.id).css({height: this.options.carouselHeight + "px"}), b(".html5gallery-car-left-" + this.id).css({top: String(this.options.carouselHeight / 2 - this.options.carouselarrowheight / 2) + "px"}), b(".html5gallery-car-right-" + this.id).css({
                        top: String(this.options.carouselHeight /
                            2 - this.options.carouselarrowheight / 2) + "px"
                    }), b(".html5gallery-tn-title-" + this.id).css({width: String(this.options.thumbwidth - 2) + "px"}), b(".html5gallery-tn-" + this.id).css({
                        width: this.options.thumbwidth + "px",
                        height: this.options.thumbheight + "px"
                    }), b(".html5gallery-tn-selected-" + this.id).css({
                        width: this.options.thumbwidth + "px",
                        height: this.options.thumbheight + "px"
                    }), b(".html5gallery-tn-img-" + this.id).css({
                        width: String(this.options.thumbimagewidth + 2 * this.options.thumbimageborder) + "px",
                        height: String(this.options.thumbimageheight +
                            2 * this.options.thumbimageborder) + "px"
                    }), b(".html5gallery-tn-image-" + this.id).parent().css({
                        width: this.options.thumbimagewidth + "px",
                        height: this.options.thumbimageheight + "px"
                    }), b(".html5gallery-tn-image-" + this.id).css({
                        width: "100%",
                        height: "100%"
                    }), b(".html5gallery-thumbs-" + this.id).css({
                        "margin-left": f + "px",
                        width: String(this.elemArray.length * (this.options.thumbwidth + this.options.thumbgap)) + "px"
                    })), a = Math.round((this.options.width - 4 - 4) / 2 - this.options.thumbMaskWidth / 2), b(".html5gallery-car-mask-" + this.id).css({
                        left: a +
                        "px", width: this.options.thumbMaskWidth + "px", height: this.options.carouselHeight + "px"
                    }), this.carouselHighlight(this.curElem, !0))
                }
            }, createStyleDefault: function () {
                this.options.thumboriginalwidth = this.options.thumbwidth;
                this.options.thumboriginalheight = this.options.thumbheight;
                if ("samecolumn" == this.options.thumbresponsive) {
                    this.options.carouselcolumn = this.options.thumbcolumns;
                    if (this.options.thumbcolumnsresponsive) {
                        var a = b(window).width();
                        a < this.options.thumbsmallsize ? this.options.carouselcolumn = this.options.thumbsmallcolumns :
                        a < this.options.thumbmediumsize && (this.options.carouselcolumn = this.options.thumbmediumcolumns)
                    }
                    this.options.thumbwidth = Math.min((this.options.width - this.options.thumbgap * (this.options.carouselcolumn - 1)) / this.options.carouselcolumn);
                    this.options.thumbheight = this.options.thumbwidth * this.options.thumboriginalheight / this.options.thumboriginalwidth
                } else this.options.thumbcolumnsresponsive && (a = b(window).width(), a < this.options.thumbsmallsize ? (this.options.thumbwidth = this.options.thumbsmallwidth, this.options.thumbheight =
                    this.options.thumbsmallheight) : a < this.options.thumbmediumsize && (this.options.thumbwidth = this.options.thumbmediumwidth, this.options.thumbheight = this.options.thumbmediumheight));
                this.options.thumbimagewidth = this.options.thumbwidth - 2 * this.options.thumbimageborder;
                this.options.thumbimageheight = this.options.thumbheight - 2 * this.options.thumbimageborder;
                this.options.thumbshowtitle && (this.options.thumbheight += this.options.thumbtitleheight);
                this.options.showtitle || (this.options.titleheight = 0);
                if (!this.options.showsocialmedia ||
                    !this.options.showfacebooklike && !this.options.showtwitter && !this.options.showgoogleplus)this.options.socialheight = 0;
                this.options.headerHeight = this.options.titleoverlay ? this.options.socialheight : this.options.titleheight + this.options.socialheight;
                this.options.boxWidth = this.options.width;
                this.options.boxHeight = this.options.height + this.options.headerHeight;
                this.options.boxLeft = this.options.padding;
                this.options.boxTop = this.options.padding;
                this.options.slideshadow && (this.options.boxWidth += 8, this.options.boxLeft -=
                    4, this.options.boxTop -= 4);
                this.options.showcarousel ? (this.options.carouselWidth = this.options.width, this.options.carouselHeight = this.options.thumbheight + 2 * this.options.thumbmargin, this.options.carouselLeft = this.options.padding, this.options.carouselTop = this.options.padding + this.options.boxHeight + this.options.carouselmargin, this.options.carouselmultirows && ("samecolumn" == this.options.thumbresponsive ? (this.options.carouselcolumn = this.options.thumbcolumns, this.options.thumbcolumnsresponsive && (a = b(window).width(),
                    a < this.options.thumbsmallsize ? this.options.carouselcolumn = this.options.thumbsmallcolumns : a < this.options.thumbmediumsize && (this.options.carouselcolumn = this.options.thumbmediumcolumns)), this.options.thumbwidth = Math.min((this.options.width - this.options.thumbgap * (this.options.carouselcolumn - 1)) / this.options.carouselcolumn), this.options.thumbheight = this.options.thumbwidth * this.options.thumboriginalheight / this.options.thumboriginalwidth, this.options.thumbimagewidth = this.options.thumbwidth - 2 * this.options.thumbimageborder,
                    this.options.thumbimageheight = this.options.thumbheight - 2 * this.options.thumbimageborder, this.options.thumbshowtitle && (this.options.thumbheight += this.options.thumbtitleheight)) : (this.options.carouselcolumn = Math.floor(this.options.width / (this.options.thumbwidth + this.options.thumbgap)), 1 > this.options.carouselcolumn && (this.options.carouselcolumn = 1)), this.options.carouselHeight = Math.ceil(this.elemArray.length / this.options.carouselcolumn) * (this.options.thumbheight + this.options.thumbrowgap))) : (this.options.carouselWidth =
                    0, this.options.carouselHeight = 0, this.options.carouselLeft = 0, this.options.carouselTop = 0, this.options.carouselmargin = 0);
                this.options.totalWidth = this.options.width + 2 * this.options.padding;
                this.options.totalHeight = this.options.height + this.options.carouselHeight + this.options.carouselmargin + this.options.headerHeight + 2 * this.options.padding;
                this.options.containerWidth = this.options.totalWidth;
                this.options.containerHeight = this.options.totalHeight;
                this.options.responsive ? (this.options.originalWidth = this.options.width,
                    this.options.originalHeight = this.options.height, this.container.css({"max-width": "100%"})) : this.container.css({
                    width: this.options.containerWidth,
                    height: this.options.containerHeight
                });
                var c = 0, d = 0;
                this.options.elemTop = 0;
                "top" == this.options.headerpos ? (d = 0, c = this.options.socialheight, this.options.elemTop = this.options.headerHeight) : "bottom" == this.options.headerpos && (this.options.elemTop = 0, c = this.options.titleoverlay ? this.options.height - this.options.titleheight : this.options.height, d = this.options.titleoverlay ?
                    this.options.height : this.options.height + this.options.titleheight);
                a = " .html5gallery-container-" + this.id + " { display:block; position:absolute; left:0px; top:0px; width:" + this.options.totalWidth + "px; height:" + this.options.totalHeight + "px; " + (!this.options.bgimage ? "" : "background:url('" + this.options.bgimage + "') center top;") + " background-color:" + this.options.bgcolor + ";}";
                this.options.galleryshadow && (a += " .html5gallery-container-" + this.id + " { -moz-box-shadow: 0px 2px 5px #aaa; -webkit-box-shadow: 0px 2px 5px #aaa; box-shadow: 0px 2px 5px #aaa;}");
                var a = a + (" .html5gallery-box-" + this.id + " {display:block; position:absolute; text-align:center; left:" + this.options.boxLeft + "px; top:" + this.options.boxTop + "px; width:" + this.options.boxWidth + "px; height:" + this.options.boxHeight + "px;}"), e = Math.round(this.options.socialheight / 2 - 12), a = a + (" .html5gallery-title-text-" + this.id + " " + this.options.titlecss + " .html5gallery-title-text-" + this.id + " " + this.options.titlecsslink + " .html5gallery-error-" + this.id + " " + this.options.errorcss), a = a + (" .html5gallery-description-text-" +
                    this.id + " " + this.options.descriptioncss + " .html5gallery-description-text-" + this.id + " " + this.options.descriptioncsslink), a = a + (" .html5gallery-fullscreen-title-" + this.id + "" + this.options.lightboxtitlecss + " .html5gallery-fullscreen-title-" + this.id + "" + this.options.lightboxtitlelinkcss), a = a + (" .html5gallery-fullscreen-description-" + this.id + "" + this.options.lightboxdescriptioncss + " .html5gallery-fullscreen-description-" + this.id + "" + this.options.lightboxdescriptionlinkcss), a = a + (" .html5gallery-viral-" + this.id +
                    " {display:block; overflow:hidden; position:absolute; text-align:left; top:" + d + "px; left:0px; width:" + this.options.boxWidth + "px; height:" + this.options.socialheight + "px; padding-top:" + e + "px;}"), a = a + (" .html5gallery-title-" + this.id + " {display:" + (this.options.titleoverlay && this.options.titleautohide ? "none" : "block") + "; overflow:hidden; position:absolute; left:0px; width:" + this.options.boxWidth + "px; ");
                this.options.titleoverlay ? a = "top" == this.options.headerpos ? a + "top:0px; height:auto; }" : a + "bottom:0px; height:auto; }" :
                    (a += "top:" + c + "px; height:" + this.options.titleheight + "px; }", this.options.titlesmallscreen && (a += " @media (max-width: " + this.options.titlesmallscreenwidth + "px) { .html5gallery-title-" + this.id + " {height:" + this.options.titleheightsmallscreen + "px; }}"));
                a += " .html5gallery-timer-" + this.id + " {display:block; position:absolute; top:" + String(this.options.elemTop + this.options.height - 2) + "px; left:0px; width:0px; height:2px; background-color:#ccc; filter:alpha(opacity=60); opacity:0.6; }";
                a += " .html5gallery-elem-" +
                    this.id + " {display:block; overflow:hidden; position:absolute; top:" + this.options.elemTop + "px; left:0px; width:" + this.options.width + "px; height:" + this.options.height + "px;}";
                this.options.isIE7 || this.options.isIE6 ? (a += " .html5gallery-loading-" + this.id + " {display:none; }", a += " .html5gallery-loading-center-" + this.id + " {display:none; }") : (a += " .html5gallery-loading-" + this.id + " {display:block; position:absolute; top:4px; right:4px; width:100%; height:100%; background:url('" + this.options.skinfolder + "loading.gif') no-repeat top right;}",
                    a += " .html5gallery-loading-center-" + this.id + " {display:block; position:absolute; top:0px; left:0px; width:100%; height:100%; background:url('" + this.options.skinfolder + "loading_center.gif') no-repeat center center;}");
                0 < this.options.borderradius && (a += " .html5gallery-elem-" + this.id + " {overflow:hidden; border-radius:" + this.options.borderradius + "px; -moz-border-radius:" + this.options.borderradius + "px; -webkit-border-radius:" + this.options.borderradius + "px;}");
                this.options.slideshadow && (a += " .html5gallery-title-" +
                    this.id + " { padding:4px;}", a += " .html5gallery-timer-" + this.id + " { margin:4px;}", a += " .html5gallery-elem-" + this.id + " { overflow:hidden; padding:4px; -moz-box-shadow: 0px 2px 5px #aaa; -webkit-box-shadow: 0px 2px 5px #aaa; box-shadow: 0px 2px 5px #aaa;}");
                this.options.showcarousel && this.options.carouselmultirows ? (a += " .html5gallery-car-" + this.id + " { position:absolute; display:block; overflow:hidden; left:" + this.options.carouselLeft + "px; top:" + this.options.carouselTop + "px; width:" + this.options.width +
                    "px;", a = this.options.carouselbgtransparent ? a + "background-color:transparent;" : a + ("border-top:1px solid " + this.options.carouseltopborder + ";border-bottom:1px solid " + this.options.carouselbottomborder + ";background-color: " + this.options.carouselbgcolorend + "; background: " + this.options.carouselbgcolorend + " -webkit-gradient(linear, left top, left bottom, from(" + this.options.carouselbgcolorstart + "), to(" + this.options.carouselbgcolorend + ")) no-repeat; background: " + this.options.carouselbgcolorend + " -moz-linear-gradient(top, " +
                this.options.carouselbgcolorstart + ", " + this.options.carouselbgcolorend + ") no-repeat; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=" + this.options.carouselbgcolorstart + ", endColorstr=" + this.options.carouselbgcolorend + ") no-repeat; -ms-filter: 'progid:DXImageTransform.Microsoft.gradient(startColorstr=" + this.options.carouselbgcolorstart + ", endColorstr=" + this.options.carouselbgcolorend + ")' no-repeat;"), this.options.carouselbgimage && (a += "background:url('" + this.options.skinfolder + this.options.carouselbgimage +
                    "') center top;"), c = Math.floor(this.options.width / (this.options.thumbwidth + this.options.thumbgap)), 1 > c && (c = 1), c = (this.options.width - c * this.options.thumbwidth - (c - 1) * this.options.thumbgap) / 2, a = a + "}" + (".html5gallery-thumbs-" + this.id + " { position:relative; display:block; margin-left:" + c + "px; width:" + ("samecolumn" == this.options.thumbresponsive ? (this.options.thumbwidth + this.options.thumbgap) * this.options.carouselcolumn : this.options.width) + "px; top:0px; }"), a += " .html5gallery-tn-" + this.id + " { display:block; float:left; margin-left:0px; margin-right:" +
                    this.options.thumbgap + "px; margin-bottom:" + this.options.thumbrowgap + "px; text-align:center; cursor:pointer; width:" + this.options.thumbwidth + "px;height:" + this.options.thumbheight + "px;overflow:hidden;}", this.options.thumbshadow && (a += " .html5gallery-tn-" + this.id + " { -moz-box-shadow: 0px 2px 5px #aaa; -webkit-box-shadow: 0px 2px 5px #aaa; box-shadow: 0px 2px 5px #aaa;}"), a += " .html5gallery-tn-selected-" + this.id + " { display:block; float:left; margin-left:0px; margin-right:" + this.options.thumbgap + "px; margin-bottom:" +
                    this.options.thumbrowgap + "px; text-align:center; cursor:pointer; width:" + this.options.thumbwidth + "px;height:" + this.options.thumbheight + "px;overflow:hidden;}", this.options.thumbshadow && (a += " .html5gallery-tn-selected-" + this.id + " { -moz-box-shadow: 0px 2px 5px #aaa; -webkit-box-shadow: 0px 2px 5px #aaa; box-shadow: 0px 2px 5px #aaa;}"), a += " .html5gallery-tn-" + this.id + " {background-color:" + this.options.thumbimagebordercolor + ";} .html5gallery-tn-" + this.id + " { filter:alpha(opacity=" + Math.round(100 * this.options.thumbopacity) +
                    "); opacity:" + this.options.thumbopacity + "; }  .html5gallery-tn-selected-" + this.id + " { filter:alpha(opacity=100); opacity:1; } ", a += " .html5gallery-tn-img-" + this.id + " {display:block; overflow:hidden; width:" + String(this.options.thumbimagewidth + 2 * this.options.thumbimageborder) + "px;height:" + String(this.options.thumbimageheight + 2 * this.options.thumbimageborder) + "px;}", this.options.thumbunselectedimagebordercolor && (a += " .html5gallery-tn-selected-" + this.id + " {background-color:" + this.options.thumbunselectedimagebordercolor +
                    ";}"), this.options.thumbshowtitle ? (a += " .html5gallery-tn-title-" + this.id + " {display:block; overflow:hidden; float:top; height:" + this.options.thumbtitleheight + "px;width:" + String(this.options.thumbwidth - 2) + "px;line-height:" + this.options.thumbtitleheight + "px;}", a += " .html5gallery-tn-title-" + this.id + this.options.thumbtitlecss) : a += " .html5gallery-tn-title-" + this.id + " {display:none;}", this.carouselHighlight = function () {
                }) : this.options.showcarousel ? (a += " .html5gallery-car-" + this.id + " { position:absolute; display:block; overflow:hidden; left:" +
                    this.options.carouselLeft + "px; top:" + this.options.carouselTop + "px; width:" + this.options.width + "px; height:" + this.options.carouselHeight + "px;", a = this.options.carouselbgtransparent ? a + "background-color:transparent;" : a + ("border-top:1px solid " + this.options.carouseltopborder + ";border-bottom:1px solid " + this.options.carouselbottomborder + ";background-color: " + this.options.carouselbgcolorend + "; background: " + this.options.carouselbgcolorend + " -webkit-gradient(linear, left top, left bottom, from(" + this.options.carouselbgcolorstart +
                "), to(" + this.options.carouselbgcolorend + ")) no-repeat; background: " + this.options.carouselbgcolorend + " -moz-linear-gradient(top, " + this.options.carouselbgcolorstart + ", " + this.options.carouselbgcolorend + ") no-repeat; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=" + this.options.carouselbgcolorstart + ", endColorstr=" + this.options.carouselbgcolorend + ") no-repeat; -ms-filter: 'progid:DXImageTransform.Microsoft.gradient(startColorstr=" + this.options.carouselbgcolorstart + ", endColorstr=" +
                this.options.carouselbgcolorend + ")' no-repeat;"), this.options.carouselbgimage && (a += "background:url('" + this.options.skinfolder + this.options.carouselbgimage + "') center top;"), a += "}", a += " .html5gallery-car-list-" + this.id + " { position:absolute; display:block; overflow:hidden; left:4px; width:" + String(this.options.width - 4 - 4) + "px; top:0px; height:" + this.options.carouselHeight + "px; }", this.options.carouselNavButton = !1, Math.floor((this.options.width - 4 - 4) / (this.options.thumbwidth + this.options.thumbgap)) < this.elemArray.length &&
                (this.options.carouselNavButton = !0), a += " .html5gallery-car-left-" + this.id + " { position:absolute; overflow:hidden; width:" + this.options.carouselarrowwidth + "px; height:" + this.options.carouselarrowheight + "px; left:0px; top:" + String(this.options.carouselHeight / 2 - this.options.carouselarrowheight / 2) + "px; background:url('" + this.options.skinfolder + "carousel_left.png') no-repeat 0px 0px;}  .html5gallery-car-right-" + this.id + " { position:absolute; overflow:hidden; width:" + this.options.carouselarrowwidth + "px; height:" +
                    this.options.carouselarrowheight + "px; right:0px; top:" + String(this.options.carouselHeight / 2 - this.options.carouselarrowheight / 2) + "px; background:url('" + this.options.skinfolder + "carousel_right.png') no-repeat 0px 0px;} ", c = this.options.carouselNavButton ? 2 * this.options.carouselarrowwidth + 8 : 0, b(".html5gallery-car-left-" + this.id).css({display: this.options.carouselNavButton ? "block" : "none"}), b(".html5gallery-car-right-" + this.id).css({display: this.options.carouselNavButton ? "block" : "none"}), this.options.thumbShowNum =
                    Math.floor((this.options.width - 4 - 4 - c) / (this.options.thumbwidth + this.options.thumbgap)), 1 > this.options.thumbShowNum && (this.options.thumbShowNum = 1), this.options.thumbMaskWidth = this.options.thumbShowNum * this.options.thumbwidth + this.options.thumbShowNum * this.options.thumbgap, this.options.thumbTotalWidth = this.elemArray.length * this.options.thumbwidth + (this.elemArray.length - 1) * this.options.thumbgap, c = 0, this.options.thumbMaskWidth > this.options.thumbTotalWidth && (c = this.options.thumbMaskWidth / 2 - this.options.thumbTotalWidth /
                    2 - this.options.thumbgap / 2), a += ".html5gallery-thumbs-" + this.id + " { position:relative; display:block; margin-left:" + c + "px; width:" + String(this.elemArray.length * (this.options.thumbwidth + this.options.thumbgap)) + "px; top:" + Math.round(this.options.carouselHeight / 2 - this.options.thumbheight / 2) + "px; }", c = Math.round((this.options.width - 4 - 4) / 2 - this.options.thumbMaskWidth / 2), a += " .html5gallery-car-mask-" + this.id + " { position:absolute; display:block; text-align:left; overflow:hidden; left:" + c + "px; width:" + this.options.thumbMaskWidth +
                    "px; top:0px; height:" + this.options.carouselHeight + "px;} ", a += " .html5gallery-tn-" + this.id + " { display:block; float:left; margin-left:" + Math.floor(this.options.thumbgap / 2) + "px; margin-right:" + Math.floor(this.options.thumbgap / 2) + "px; text-align:center; cursor:pointer; width:" + this.options.thumbwidth + "px;height:" + this.options.thumbheight + "px;overflow:hidden;}", this.options.thumbshadow && (a += " .html5gallery-tn-" + this.id + " { -moz-box-shadow: 0px 2px 5px #aaa; -webkit-box-shadow: 0px 2px 5px #aaa; box-shadow: 0px 2px 5px #aaa;}"),
                    a += " .html5gallery-tn-selected-" + this.id + " { display:block; float:left; margin-left:" + Math.floor(this.options.thumbgap / 2) + "px; margin-right:" + Math.floor(this.options.thumbgap / 2) + "px;text-align:center; cursor:pointer; width:" + this.options.thumbwidth + "px;height:" + this.options.thumbheight + "px;overflow:hidden;}", this.options.thumbshadow && (a += " .html5gallery-tn-selected-" + this.id + " { -moz-box-shadow: 0px 2px 5px #aaa; -webkit-box-shadow: 0px 2px 5px #aaa; box-shadow: 0px 2px 5px #aaa;}"), a += " .html5gallery-tn-" +
                    this.id + " {background-color:" + this.options.thumbimagebordercolor + ";} .html5gallery-tn-" + this.id + " { filter:alpha(opacity=" + Math.round(100 * this.options.thumbopacity) + "); opacity:" + this.options.thumbopacity + "; }  .html5gallery-tn-selected-" + this.id + " { filter:alpha(opacity=100); opacity:1; } ", a += " .html5gallery-tn-img-" + this.id + " {display:block; overflow:hidden; width:" + String(this.options.thumbimagewidth + 2 * this.options.thumbimageborder) + "px;height:" + String(this.options.thumbimageheight + 2 * this.options.thumbimageborder) +
                    "px;}", this.options.thumbunselectedimagebordercolor && (a += " .html5gallery-tn-selected-" + this.id + " {background-color:" + this.options.thumbunselectedimagebordercolor + ";}"), this.options.thumbshowtitle ? (a += " .html5gallery-tn-title-" + this.id + " {display:block; overflow:hidden; float:top; height:" + this.options.thumbtitleheight + "px;width:" + String(this.options.thumbwidth - 2) + "px;line-height:" + this.options.thumbtitleheight + "px;}", a += " .html5gallery-tn-title-" + this.id + this.options.thumbtitlecss) : a += " .html5gallery-tn-title-" +
                    this.id + " {display:none;}", this.carouselHighlight = function (a, c) {
                    b("#html5gallery-tn-" + this.id + "-" + a, this.$gallery).removeClass("html5gallery-tn-" + this.id).addClass("html5gallery-tn-selected-" + this.id);
                    if (this.options.thumbShowNum >= this.elemArray.length)b(".html5gallery-car-left-" + this.id, this.$gallery).css({
                        "background-position": "-" + String(2 * this.options.carouselarrowwidth) + "px 0px",
                        cursor: ""
                    }), b(".html5gallery-car-left-" + this.id, this.$gallery).data("disabled", !0), b(".html5gallery-car-right-" + this.id,
                        this.$gallery).css({
                            "background-position": "-" + String(2 * this.options.carouselarrowwidth) + "px 0px",
                            cursor: ""
                        }), b(".html5gallery-car-right-" + this.id, this.$gallery).data("disabled", !0); else {
                        var d = Math.floor(a / this.options.thumbShowNum) * this.options.thumbShowNum * (this.options.thumbwidth + this.options.thumbgap);
                        d >= this.options.thumbTotalWidth - this.options.thumbMaskWidth + this.options.thumbgap && (d = this.options.thumbTotalWidth - this.options.thumbMaskWidth + this.options.thumbgap);
                        d = -d;
                        c ? b(".html5gallery-thumbs-" +
                            this.id, this.$gallery).css({marginLeft: d}) : b(".html5gallery-thumbs-" + this.id, this.$gallery).animate({marginLeft: d}, 500);
                        this.updateCarouseButtons(d)
                    }
                }, this.carouselPrev = function () {
                    var a = b(".html5gallery-thumbs-" + this.id, this.$gallery);
                    if (0 != parseInt(a.css("margin-left"))) {
                        var c = -1 * parseInt(a.css("margin-left")) - this.options.thumbShowNum * (this.options.thumbwidth + this.options.thumbgap);
                        0 > c && (c = 0);
                        a.animate({marginLeft: -c}, 500, this.options.carouseleasing);
                        this.updateCarouseButtons(-c)
                    }
                }, this.carouselNext =
                    function () {
                        var a = b(".html5gallery-thumbs-" + this.id, this.$gallery);
                        if (parseInt(a.css("margin-left")) != -(this.options.thumbTotalWidth - this.options.thumbMaskWidth + this.options.thumbgap)) {
                            var c = -1 * parseInt(a.css("margin-left")) + this.options.thumbShowNum * (this.options.thumbwidth + this.options.thumbgap);
                            c >= this.options.thumbTotalWidth - this.options.thumbMaskWidth + this.options.thumbgap && (c = this.options.thumbTotalWidth - this.options.thumbMaskWidth + this.options.thumbgap);
                            a.animate({marginLeft: -c}, 500, this.options.carouseleasing);
                            this.updateCarouseButtons(-c)
                        }
                    }, this.updateCarouseButtons = function (a) {
                    var c = b(".html5gallery-car-left-" + this.id, this.$gallery), d = b(".html5gallery-car-right-" + this.id, this.$gallery), e = -1 * (this.options.thumbTotalWidth - this.options.thumbMaskWidth + this.options.thumbgap);
                    0 == a ? (c.css({
                        "background-position": "-" + String(2 * this.options.carouselarrowwidth) + "px 0px",
                        cursor: ""
                    }), c.data("disabled", !0)) : c.data("disabled") && (c.css({
                        "background-position": "0px 0px",
                        cursor: "pointer"
                    }), c.data("disabled", !1));
                    a == e ? (d.css({
                        "background-position": "-" +
                        String(2 * this.options.carouselarrowwidth) + "px 0px", cursor: ""
                    }), d.data("disabled", !0)) : d.data("disabled") && (d.css({
                        "background-position": "0px 0px",
                        cursor: "pointer"
                    }), d.data("disabled", !1))
                }) : a += " .html5gallery-car-" + this.id + " { display:none; }";
                a += ".html5gallery-container-" + this.id + " div {box-sizing:content-box;}";
                b("head").append("<style type='text/css' data-creator='html5gallery'>" + a + "</style>")
            }, loadCarousel: function () {
                var a = this, c = b(".html5gallery-thumbs-" + this.id, this.$gallery);
                c.empty();
                for (var d =
                    0; d < this.elemArray.length; d++) {
                    var e = b("<div id='html5gallery-tn-" + this.id + "-" + d + "' class='html5gallery-tn-" + this.id + "' data-index=" + d + " ></div>");
                    e.appendTo(c);
                    this.options.thumblinkintitle || e.unbind("click").click(function () {
                        a.onThumbClick(b(this).data("index"));
                        a.slideRun(b(this).data("index"), !0, !0)
                    });
                    e.hover(function () {
                        a.onThumbOver(b(this).data("index"));
                        b(this).removeClass("html5gallery-tn-" + a.id).addClass("html5gallery-tn-selected-" + a.id)
                    }, function () {
                        b(this).data("index") !== a.curElem && b(this).removeClass("html5gallery-tn-selected-" +
                            a.id).addClass("html5gallery-tn-" + a.id)
                    });
                    e = new Image;
                    e.data = d;
                    b(e).load(function () {
                        var d = Math.max(a.options.thumbimagewidth / this.width, a.options.thumbimageheight / this.height), e = Math.round(d * this.width), d = Math.round(d * this.height), k = a.options.thumbshowplayonvideo && 1 != a.elemArray[this.data][9] ? "<div class='html5gallery-tn-img-play-" + a.id + "' style='display:block; overflow:hidden; position:absolute; width:100%;height:100%; top:" + a.options.thumbimageborder + "px; left:" + a.options.thumbimageborder + 'px;background:url("' +
                        a.options.skinfolder + "playvideo.png\") no-repeat center center;'></div>" : "";
                        a.options.carouselmultirows && "samecolumn" == a.options.thumbresponsive ? b("#html5gallery-tn-" + a.id + "-" + this.data, c).append("<div class='html5gallery-tn-img-" + a.id + "' style='position:relative;width:" + String(a.options.thumbimagewidth + 2 * a.options.thumbimageborder) + "px;height:" + String(a.options.thumbimageheight + 2 * a.options.thumbimageborder) + "px;'><div style='display:block; overflow:hidden; position:absolute; width:" + a.options.thumbimagewidth +
                            "px;height:" + a.options.thumbimageheight + "px; top:" + a.options.thumbimageborder + "px; left:" + a.options.thumbimageborder + "px;'><img class='html5gallery-tn-image-" + a.id + "' style='border:none; padding:0px; margin:0px; max-width:100%; max-height:none; width:" + e + "px; height:" + d + "px;' src='" + a.elemArray[this.data][1] + "' /></div>" + k + "</div><div class='html5gallery-tn-title-" + a.id + "' style='width:" + String(a.options.thumbwidth - 2) + "px;'>" + a.elemArray[this.data][7] + (a.options.thumbshowdescription ? "<br /><span class='html5gallery-tn-description-" +
                            a.id + "'>" + a.elemArray[this.data][8] + "</span>" : "") + "</div>") : b("#html5gallery-tn-" + a.id + "-" + this.data, c).append("<div class='html5gallery-tn-img-" + a.id + "' style='position:relative;'><div style='display:block; overflow:hidden; position:absolute; width:" + a.options.thumbimagewidth + "px;height:" + a.options.thumbimageheight + "px; top:" + a.options.thumbimageborder + "px; left:" + a.options.thumbimageborder + "px;'><img class='html5gallery-tn-image-" + a.id + "' style='border:none; padding:0px; margin:0px; max-width:100%; max-height:none; width:" +
                            e + "px; height:" + d + "px;' src='" + a.elemArray[this.data][1] + "' /></div>" + k + "</div><div class='html5gallery-tn-title-" + a.id + "'>" + a.elemArray[this.data][7] + (a.options.thumbshowdescription ? "<br /><span class='html5gallery-tn-description-" + a.id + "'>" + a.elemArray[this.data][8] + "</span>" : "") + "</div>");
                        a.options.thumblinkintitle && b(".html5gallery-tn-img-" + a.id, c).unbind("click").click(function () {
                            a.onThumbClick(b(this).parent().data("index"));
                            a.slideRun(b(this).parent().data("index"), !0, !0)
                        })
                    });
                    e.src = this.elemArray[d][1]
                }
                this.options.carouselmultirows &&
                c.append("<div style='clear:both;'></div>")
            }, goNormal: function () {
                clearTimeout(this.slideshowTimeout);
                b(document).unbind("keyup.html5gallery");
                b(".html5gallery-timer-" + this.id, this.$gallery).css({width: 0});
                clearInterval(this.slideTimer);
                this.slideTimerCount = 0;
                this.isFullscreen = !1;
                var a = b(".html5gallery-elem-" + this.id, this.$fullscreen).empty().css({top: this.options.elemTop});
                b(".html5gallery-box-" + this.id, this.$gallery).prepend(a);
                this.slideRun(this.curElem);
                this.$fullscreen.remove();
                "show" == this.options.imagetoolboxmode ?
                    this.showimagetoolbox(this.elemArray[this.curElem][9]) : this.hideimagetoolbox()
            }, goFullscreen: function () {
                this.hideimagetoolbox();
                clearTimeout(this.slideshowTimeout);
                b(".html5gallery-fullscreen-timer-" + this.id, this.$fullscreen).css({width: 0});
                clearInterval(this.slideTimer);
                this.slideTimerCount = 0;
                this.isFullscreen = !0;
                this.fullscreenInitial = 20;
                this.fullscreenMargin = this.options.lightboxborder;
                this.fullscreenBarH = this.options.lightboxtextheight;
                this.fullscreenOutsideMargin = this.options.lightboxmargin;
                var a = b(window).width(), c = this.elemArray[this.curElem][10], d = this.elemArray[this.curElem][11];
                this.fullscreenWidth = a - 2 * this.fullscreenMargin - 2 * this.fullscreenOutsideMargin;
                var e = window.innerHeight ? window.innerHeight : b(window).height();
                this.fullscreenHeight = e - 2 * this.fullscreenMargin - this.fullscreenBarH - 2 * this.fullscreenOutsideMargin;
                var f = Math.max(e, b(document).height()), h = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : this.fullscreenWidth, j = this.elemArray[this.curElem][18] ?
                    Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : this.fullscreenHeight, h = Math.min(h / c, j / d);
                1 > h && (c *= h, d *= h);
                e = b(window).scrollTop() + Math.round((e - (d + 2 * this.fullscreenMargin + this.fullscreenBarH)) / 2);
                this.$fullscreen = b("<div class='html5gallery-fullscreen-" + this.id + "' style='position:absolute;top:0px;left:0px;width:" + a + "px;height:" + f + "px;text-align:center;z-index:99999;'><div class='html5gallery-fullscreen-overlay-" + this.id + "' style='display:block;position:absolute;top:0px;left:0px;width:100%;height:100%;background-color:#000000;opacity:0.9;filter:alpha(opacity=80);'></div><div class='html5gallery-fullscreen-box-" +
                    this.id + "' style='display:block;overflow:hidden;position:relative;margin:0px auto;top:" + e + "px;width:" + this.fullscreenInitial + "px;height:" + this.fullscreenInitial + "px;'><div class='html5gallery-fullscreen-elem-" + this.id + "' style='display:block;position:relative;overflow:hidden;width:" + String(c + 2 * this.fullscreenMargin) + "px;height:" + String(d + 2 * this.fullscreenMargin) + "px;background-color:" + this.options.lightboxbgcolor + ";'><div class='html5gallery-fullscreen-elem-wrapper-" + this.id + "' style='display:block;position:relative;overflow:hidden;margin:" +
                    this.fullscreenMargin + "px;'><div class='html5gallery-fullscreen-timer-" + this.id + "' style='display:block; position:absolute; top:" + String(d - 4) + "px; left:0px; width:0px; height:4px; background-color:#666; filter:alpha(opacity=60); opacity:0.6;'></div></div></div><div class='html5gallery-fullscreen-bar-" + this.id + "' style='display:block;position:relative;width:" + String(c + 2 * this.fullscreenMargin) + "px;height:auto;min-height:36px;background-color:" + this.options.lightboxbgcolor + ";'><div class='html5gallery-fullscreen-bar-wrapper-" +
                    this.id + "' style='display:block;position:relative;padding:0px " + this.fullscreenMargin + "px " + this.fullscreenMargin + "px " + this.fullscreenMargin + "px;'><div class='html5gallery-fullscreen-close-" + this.id + "' style='display:block;position:relative;float:right;cursor:pointer;width:32px;height:32px;top:0px;background-image:url(\"" + this.options.skinfolder + "lightbox_close.png\");'></div><div class='html5gallery-fullscreen-play-" + this.id + "' style='display:" + (this.isPaused && 1 < this.elemArray.length && 1 == this.elemArray[this.curElem][9] ?
                        "block" : "none") + ';position:relative;float:right;cursor:pointer;width:32px;height:32px;top:0px;background-image:url("' + this.options.skinfolder + "lightbox_play.png\");'></div><div class='html5gallery-fullscreen-pause-" + this.id + "' style='display:" + (this.isPaused || 1 >= this.elemArray.length || 1 != this.elemArray[this.curElem][9] ? "none" : "block") + ';position:relative;float:right;cursor:pointer;width:32px;height:32px;top:0px;background-image:url("' + this.options.skinfolder + "lightbox_pause.png\");'></div><div class='html5gallery-fullscreen-title-" +
                    this.id + "' style='display:block;position:relative;float:left;width:" + String(c - 2 * this.fullscreenMargin - 72) + "px;height:auto;top:0px;left:0px;text-align:left;'></div><div style='clear:both;'></div></div></div><div class='html5gallery-fullscreen-next-" + this.id + "' style='display:none;position:absolute;cursor:pointer;width:48px;height:48px;right:" + this.fullscreenMargin + "px;top:" + Math.round(d / 2) + 'px;background-image:url("' + this.options.skinfolder + "lightbox_next.png\");'></div><div class='html5gallery-fullscreen-prev-" +
                    this.id + "' style='display:none;position:absolute;cursor:pointer;width:48px;height:48px;left:" + this.fullscreenMargin + "px;top:" + Math.round(d / 2) + 'px;background-image:url("' + this.options.skinfolder + "lightbox_prev.png\");'></div></div></div>");
                this.$fullscreen.appendTo("body");
                var g = this;
                b(window).scroll(function () {
                    var a = b(".html5gallery-fullscreen-box-" + g.id, g.$fullscreen), c = window.innerHeight ? window.innerHeight : b(window).height(), c = b(window).scrollTop() + Math.round((c - a.height()) / 2);
                    a.css({top: c})
                });
                var l = b(".html5gallery-elem-" + this.id, this.$gallery).empty().css({top: 0, position: "relative"});
                b(".html5gallery-fullscreen-box-" + this.id, this.$fullscreen).animate({height: d + 2 * this.fullscreenMargin}, "slow", function () {
                    b(this).animate({width: c + 2 * g.fullscreenMargin}, "slow", function () {
                        b(this).animate({height: "+=" + g.fullscreenBarH}, "slow", function () {
                            b(".html5gallery-fullscreen-elem-wrapper-" + g.id, g.$fullscreen).prepend(l);
                            g.slideRun(g.curElem)
                        })
                    })
                });
                b(".html5gallery-fullscreen-overlay-" + this.id, this.$fullscreen).click(function () {
                    g.goNormal()
                });
                b(".html5gallery-fullscreen-box-" + this.id, this.$fullscreen).hover(function () {
                    1 < g.elemArray.length && (b(".html5gallery-fullscreen-next-" + g.id, g.$fullscreen).fadeIn(), b(".html5gallery-fullscreen-prev-" + g.id, g.$fullscreen).fadeIn())
                }, function () {
                    b(".html5gallery-fullscreen-next-" + g.id, g.$fullscreen).fadeOut();
                    b(".html5gallery-fullscreen-prev-" + g.id, g.$fullscreen).fadeOut()
                });
                b(".html5gallery-fullscreen-box-" + this.id, this.$fullscreen).touchSwipe({
                    preventWebBrowser: !0, swipeLeft: function () {
                        g.disableTouchSwipe ||
                        g.slideRun(-1)
                    }, swipeRight: function () {
                        g.disableTouchSwipe || g.slideRun(-2)
                    }
                });
                b(".html5gallery-fullscreen-close-" + this.id, this.$fullscreen).click(function () {
                    g.goNormal()
                });
                b(".html5gallery-fullscreen-next-" + this.id, this.$fullscreen).click(function () {
                    g.slideRun(-1)
                });
                b(".html5gallery-fullscreen-prev-" + this.id, this.$fullscreen).click(function () {
                    g.slideRun(-2)
                });
                b(".html5gallery-fullscreen-play-" + this.id, this.$fullscreen).click(function () {
                    b(".html5gallery-fullscreen-play-" + g.id, g.$fullscreen).hide();
                    b(".html5gallery-fullscreen-pause-" + g.id, g.$fullscreen).show();
                    g.isPaused = !1;
                    g.slideshowTimeout = setTimeout(function () {
                        g.slideRun(-1)
                    }, g.elemArray[g.curElem][16] ? g.elemArray[g.curElem][16] : g.options.slideshowinterval);
                    b(".html5gallery-fullscreen-timer-" + g.id, g.$fullscreen).css({width: 0});
                    g.slideTimerCount = 0;
                    g.options.showtimer && (g.slideTimer = setInterval(function () {
                        g.showSlideTimer()
                    }, 50))
                });
                b(".html5gallery-fullscreen-pause-" + this.id, this.$fullscreen).click(function () {
                    b(".html5gallery-fullscreen-play-" +
                        g.id, g.$fullscreen).show();
                    b(".html5gallery-fullscreen-pause-" + g.id, g.$fullscreen).hide();
                    g.isPaused = !0;
                    clearTimeout(g.slideshowTimeout);
                    b(".html5gallery-fullscreen-timer-" + g.id, g.$fullscreen).css({width: 0});
                    clearInterval(g.slideTimer);
                    g.slideTimerCount = 0
                });
                b(document).bind("keyup.html5gallery", function (a) {
                    27 == a.keyCode ? g.goNormal() : 39 == a.keyCode ? g.slideRun(-1) : 37 == a.keyCode && g.slideRun(-2)
                })
            }, calcIndex: function (a) {
                this.savedElem = this.curElem;
                -2 == a ? (this.nextElem = this.curElem, this.curElem = this.prevElem,
                    this.prevElem = 0 > this.curElem - 1 ? this.elemArray.length - 1 : this.curElem - 1) : -1 == a ? (this.prevElem = this.curElem, this.curElem = this.nextElem, this.nextElem = this.curElem + 1 >= this.elemArray.length ? 0 : this.curElem + 1) : 0 <= a && (this.curElem = a, this.prevElem = 0 > this.curElem - 1 ? this.elemArray.length - 1 : this.curElem - 1, this.nextElem = this.curElem + 1 >= this.elemArray.length ? 0 : this.curElem + 1)
            }, showSlideTimer: function () {
                var a = this.elemArray[this.curElem][16] ? this.elemArray[this.curElem][16] : this.options.slideshowinterval;
                this.slideTimerCount++;
                this.isFullscreen ? b(".html5gallery-fullscreen-timer-" + this.id, this.$fullscreen).width(Math.round(50 * b(".html5gallery-fullscreen-elem-wrapper-" + this.id, this.$fullscreen).width() * (this.slideTimerCount + 1) / a)) : b(".html5gallery-timer-" + this.id, this.$gallery).width(Math.round(50 * this.options.boxWidth * (this.slideTimerCount + 1) / a))
            }, setHd: function (a, b) {
                var d = this.elemArray[this.curElem][9], d = this.isHd != a && b && (5 == d || 6 == d || 7 == d || 8 == d);
                this.isHd = a;
                d && this.slideRun(this.curElem, !1, !1, !0)
            }, enableUpdateCarousel: function () {
                this.disableupdatecarousel = !1
            }, slideRun: function (a, c, d, e) {
                clearTimeout(this.slideshowTimeout);
                this.isFullscreen ? b(".html5gallery-fullscreen-timer-" + this.id, this.$fullscreen).css({width: 0}) : b(".html5gallery-timer-" + this.id, this.$gallery).css({width: 0});
                clearInterval(this.slideTimer);
                this.slideTimerCount = 0;
                this.options.showcarousel && 0 <= this.curElem && b("#html5gallery-tn-" + this.id + "-" + this.curElem, this.$gallery).removeClass("html5gallery-tn-selected-" + this.id).addClass("html5gallery-tn-" + this.id);
                this.calcIndex(a);
                this.options.socialurlforeach &&
                this.createSocialMedia();
                !this.isFullscreen && this.options.showcarousel && (b("#html5gallery-tn-" + this.id + "-" + this.curElem, this.$gallery).removeClass("html5gallery-tn-" + this.id).addClass("html5gallery-tn-selected-" + this.id), !this.options.notupdatecarousel && !this.disableupdatecarousel && this.carouselHighlight(this.curElem));
                if (this.options.showtitle || this.options.lightboxshowtitle || this.options.lightboxshowdescription) {
                    a = this.elemArray[this.curElem][7];
                    var f = this.elemArray[this.curElem][8];
                    this.options.shownumbering &&
                    (a = this.options.numberingformat.replace("%NUM", this.curElem + 1).replace("%TOTAL", this.elemArray.length) + " " + a);
                    if (this.isFullscreen) {
                        var h = "";
                        this.options.lightboxshowtitle && a && (h += a);
                        this.options.lightboxshowdescription && f && (h += "<div class='html5gallery-fullscreen-description-" + this.id + "'>" + f + "</div>");
                        b(".html5gallery-fullscreen-title-" + this.id, this.$fullscreen).html(h)
                    } else this.options.showtitle && (h = "", a && (h += "<div class='html5gallery-title-text-" + this.id + "'>" + a + "</div>"), this.options.showdescription &&
                    f && (h += "<div class='html5gallery-description-text-" + this.id + "'>" + f + "</div>"), b(".html5gallery-title-" + this.id, this.$gallery).html(h))
                }
                a = this.elemArray[this.curElem][9];
                if (!(0 > a)) {
                    !this.isFullscreen && c ? "always" == this.options.showimagetoolbox ? ("mouseover" == this.options.imagetoolboxmode || "show" == this.options.imagetoolboxmode) && this.showimagetoolbox(a) : "image" == this.options.showimagetoolbox && 1 != a && this.hideimagetoolbox() : "show" == this.options.imagetoolboxmode ? this.showimagetoolbox(a) : this.hideimagetoolbox();
                    this.onChange();
                    c = b(".html5gallery-elem-" + this.id, j);
                    c.find("iframe").each(function () {
                        b(this).attr("src", "")
                    });
                    c.find("video").each(function () {
                        b(this).attr("src", "")
                    });
                    this.disableTouchSwipe = !1;
                    d = this.options.autoplayvideo || this.options.playvideoonclick && d || e;
                    var j = this.isFullscreen ? this.$fullscreen : this.$gallery;
                    this.showingPoster = !1;
                    (5 == a || 6 == a || 7 == a || 8 == a || 9 == a || 10 == a || 11 == a) && !d && this.elemArray[this.curElem][12] ? (this.showingPoster = !0, this.showPoster()) : (b(".html5gallery-video-play-" + this.id,
                        j).length && b(".html5gallery-video-play-" + this.id, j).remove(), 1 == a ? this.showImage() : 5 == a || 6 == a || 7 == a || 8 == a ? this.showVideo(d, e) : 9 == a ? this.showYoutube(d) : 10 == a ? this.showVimeo(d) : 11 == a ? this.showEmbedVideo(d) : 2 == a ? this.showSWF() : 12 == a && this.showIframe());
                    this.checkMK();
                    this.prevElem in this.elemArray && 1 == this.elemArray[this.prevElem][9] && ((new Image).src = this.elemArray[this.prevElem][2]);
                    this.nextElem in this.elemArray && 1 == this.elemArray[this.nextElem][9] && ((new Image).src = this.elemArray[this.nextElem][2]);
                    this.prevElem in this.elemArray && (!this.options.autoplayvideo && this.elemArray[this.prevElem][12]) && ((new Image).src = this.elemArray[this.prevElem][12]);
                    this.nextElem in this.elemArray && (!this.options.autoplayvideo && this.elemArray[this.nextElem][12]) && ((new Image).src = this.elemArray[this.nextElem][12]);
                    this.curElem == this.elemArray.length - 1 && this.looptimes++;
                    var g = this;
                    if ((1 == a || this.showingPoster) && !this.isPaused && 1 < this.elemArray.length && (!this.options.loop || this.looptimes < this.options.loop))this.slideshowTimeout =
                        setTimeout(function () {
                            g.slideRun(-1)
                        }, this.elemArray[this.curElem][16] ? this.elemArray[this.curElem][16] : this.options.slideshowinterval), this.isFullscreen ? b(".html5gallery-fullscreen-timer-" + this.id, this.$fullscreen).css({width: 0}) : b(".html5gallery-timer-" + this.id, this.$gallery).css({width: 0}), this.slideTimerCount = 0, this.options.showtimer && (this.slideTimer = setInterval(function () {
                        g.showSlideTimer()
                    }, 50));
                    this.options.loop && this.looptimes >= this.options.loop && (this.looptimes = 0, this.pauseGallery());
                    this.elemArray[this.curElem][5] ||
                    (this.options.lightbox || this.elemArray[this.curElem][22]) && !this.isFullscreen ? (c.css({cursor: "pointer"}), c.unbind("click").bind("click", function () {
                        (g.options.lightbox || g.elemArray[g.curElem][22]) && !g.isFullscreen ? g.goFullscreen() : g.elemArray[g.curElem][5] && (g.elemArray[g.curElem][6] ? window.open(g.elemArray[g.curElem][5], g.elemArray[g.curElem][6]) : window.open(g.elemArray[g.curElem][5]))
                    })) : (c.css({cursor: ""}), c.unbind("click"))
                }
            }, showImage: function () {
                var a = b(".html5gallery-elem-" + this.id, this.isFullscreen ?
                    this.$fullscreen : this.$gallery);
                $preloading = "" === a.html() ? b("<div class='html5gallery-loading-center-" + this.id + "'></div>").appendTo(a) : b("<div class='html5gallery-loading-" + this.id + "'></div>").appendTo(a);
                var c = this, d = new Image;
                b(d).load(function () {
                    $preloading.remove();
                    c.elemArray[c.curElem][10] = this.width;
                    c.elemArray[c.curElem][11] = this.height;
                    var d;
                    if (c.isFullscreen) {
                        var e = c.elemArray[c.curElem][17] ? Math.min(c.elemArray[c.curElem][17], c.fullscreenWidth) : c.fullscreenWidth;
                        d = c.elemArray[c.curElem][18] ?
                            Math.min(c.elemArray[c.curElem][18], c.fullscreenHeight) : c.fullscreenHeight;
                        d = Math.min(e / this.width, d / this.height);
                        d = 1 < d ? 1 : d
                    } else d = "fill" == c.options.resizemode ? Math.max(c.options.width / this.width, c.options.height / this.height) : Math.min(c.options.width / this.width, c.options.height / this.height);
                    e = Math.round(d * this.width);
                    d = Math.round(d * this.height);
                    var h = c.isFullscreen ? e : c.options.width, j = c.isFullscreen ? d : c.options.height, g = Math.round(h / 2 - e / 2), l = Math.round(j / 2 - d / 2);
                    c.isFullscreen && c.adjustFullscreen(h,
                        j);
                    a.css({width: h, height: j});
                    e = b("<div class='html5gallery-elem-img-" + c.id + "' style='display:block; position:absolute; overflow:hidden; width:" + h + "px; height:" + j + "px; left:0px; margin-left:" + (c.options.slideshadow && !c.isFullscreen ? 4 : 0) + "px; top:0px; margin-top:" + (c.options.slideshadow && !c.isFullscreen ? 4 : 0) + "px;'><img class='html5gallery-elem-image-" + c.id + "' style='border:none; position:absolute; opacity:inherit; filter:inherit; padding:0px; margin:0px; left:" + g + "px; top:" + l + "px; max-width:none; max-height:none; width:" +
                        e + "px; height:" + d + "px;' src='" + c.elemArray[c.curElem][2] + "' />" + c.options.watermarkcode + "</div>");
                    d = b(".html5gallery-elem-img-" + c.id, a);
                    d.length ? (a.prepend(e), a.html5boxTransition(c.id, d, e, {
                        effect: c.options.effect,
                        easing: c.options.easing,
                        duration: c.options.duration,
                        direction: c.curElem >= c.savedElem,
                        slide: c.options.slide
                    }, function () {
                    })) : a.html(e);
                    c.options.googleanalyticsaccount && window._gaq && window._gaq.push(["_trackEvent", "Image", "Play", c.elemArray[c.curElem][2]]);
                    c.checkMK()
                });
                b(d).error(function () {
                    $preloading.remove();
                    c.isFullscreen && c.adjustFullscreen(c.options.width, c.options.height);
                    a.html("<div class='html5gallery-elem-error-" + c.id + "' style='display:block; position:absolute; overflow:hidden; text-align:center; width:" + c.options.width + "px; left:0px; top:" + Math.round(c.options.height / 2 - 10) + "px; margin:4px;'><div class='html5gallery-error-" + c.id + "'>The requested content cannot be found</div>");
                    c.options.googleanalyticsaccount && window._gaq && window._gaq.push(["_trackEvent", "Image", "Error", c.elemArray[c.curElem][2]])
                });
                d.src = this.elemArray[this.curElem][2]
            }, adjustFullscreen: function (a, c, d) {
                var e = b(window).width();
                this.fullscreenWidth = e - 2 * this.fullscreenMargin - 2 * this.fullscreenOutsideMargin;
                var f = window.innerHeight ? window.innerHeight : b(window).height();
                this.fullscreenHeight = f - 2 * this.fullscreenMargin - this.fullscreenBarH - 2 * this.fullscreenOutsideMargin;
                var h = Math.max(f, b(document).height()), j = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : this.fullscreenWidth, g = this.elemArray[this.curElem][18] ?
                    Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : this.fullscreenHeight, j = Math.min(j / a, g / c);
                1 > j && (a *= j, c *= j);
                f = b(window).scrollTop() + Math.round((f - (c + 2 * this.fullscreenMargin + this.fullscreenBarH)) / 2);
                b(".html5gallery-fullscreen-" + this.id).css({width: e + "px", height: h + "px"});
                b(".html5gallery-fullscreen-title-" + this.id, this.$fullscreen).css({width: a - 2 * this.fullscreenMargin - 72});
                d ? (b(".html5gallery-fullscreen-box-" + this.id, this.$fullscreen).css({
                    width: a + 2 * this.fullscreenMargin, height: c + 2 *
                    this.fullscreenMargin + this.fullscreenBarH, top: f
                }), b(".html5gallery-fullscreen-elem-" + this.id, this.$fullscreen).css({
                    width: a + 2 * this.fullscreenMargin,
                    height: c + 2 * this.fullscreenMargin
                }), b(".html5gallery-fullscreen-elem-wrapper-" + this.id, this.$fullscreen).css({
                    width: a,
                    height: c
                }), b(".html5gallery-fullscreen-bar-" + this.id, this.$fullscreen).css({width: a + 2 * this.fullscreenMargin})) : (b(".html5gallery-fullscreen-box-" + this.id, this.$fullscreen).animate({
                    width: a + 2 * this.fullscreenMargin, height: c + 2 * this.fullscreenMargin +
                    this.fullscreenBarH, top: f
                }, "slow"), b(".html5gallery-fullscreen-elem-" + this.id, this.$fullscreen).animate({
                    width: a + 2 * this.fullscreenMargin,
                    height: c + 2 * this.fullscreenMargin
                }, "slow"), b(".html5gallery-fullscreen-elem-wrapper-" + this.id, this.$fullscreen).animate({
                    width: a,
                    height: c
                }, "slow"), b(".html5gallery-fullscreen-bar-" + this.id, this.$fullscreen).animate({width: a + 2 * this.fullscreenMargin}, "slow"));
                b(".html5gallery-fullscreen-next-" + this.id, this.$fullscreen).css({top: Math.round(c / 2)});
                b(".html5gallery-fullscreen-prev-" +
                    this.id, this.$fullscreen).css({top: Math.round(c / 2)});
                b(".html5gallery-fullscreen-play-" + this.id, this.$fullscreen).css("display", this.isPaused && 1 < this.elemArray.length && 1 == this.elemArray[this.curElem][9] ? "block" : "none");
                b(".html5gallery-fullscreen-pause-" + this.id, this.$fullscreen).css("display", this.isPaused || 1 >= this.elemArray.length || 1 != this.elemArray[this.curElem][9] ? "none" : "block");
                b(".html5gallery-elem-" + this.id, this.$fullscreen).css({width: a, height: c});
                b(".html5gallery-fullscreen-timer-" + this.id,
                    this.$fullscreen).css({top: String(c - 4) + "px"});
                b(".html5gallery-elem-video-" + this.id, this.$fullscreen).css({width: a + "px", height: c + "px"});
                b(".html5gallery-elem-video-container-" + this.id, this.$fullscreen).css({
                    width: a + "px",
                    height: c + "px"
                });
                d = this.options.isIPhone ? c - 48 : c;
                b(".html5gallery-elem-video-container-" + this.id, this.$fullscreen).find("video").css({
                    width: a + "px",
                    height: d + "px"
                });
                b("#html5gallery-elem-video-" + this.id, this.$fullscreen).css({width: a + "px", height: c + "px"});
                b("#html5gallery-elem-video-" +
                    this.id, this.$fullscreen).attr("width", a);
                b("#html5gallery-elem-video-" + this.id, this.$fullscreen).attr("height", c);
                b(".html5gallery-elem-video-" + this.id, this.$fullscreen).find("iframe").attr("width", a);
                b(".html5gallery-elem-video-" + this.id, this.$fullscreen).find("iframe").attr("height", c);
                b("#html5gallery-elem-video-" + this.id, this.$fullscreen).find("iframe").attr("width", a);
                b("#html5gallery-elem-video-" + this.id, this.$fullscreen).find("iframe").attr("height", c)
            }, showPoster: function () {
                var a = this.isFullscreen ?
                    this.$fullscreen : this.$gallery, c = b(".html5gallery-elem-" + this.id, a);
                $preloading = "" === c.html() ? b("<div class='html5gallery-loading-center-" + this.id + "'></div>").appendTo(c) : b("<div class='html5gallery-loading-" + this.id + "'></div>").appendTo(c);
                var d = this, e = this.elemArray[this.curElem][10], f = this.elemArray[this.curElem][11], h = new Image;
                b(h).load(function () {
                    $preloading.remove();
                    var h, g, l;
                    d.isFullscreen ? (g = d.elemArray[d.curElem][17] ? Math.min(d.elemArray[d.curElem][17], d.fullscreenWidth) : Math.min(e, d.fullscreenWidth),
                        l = d.elemArray[d.curElem][18] ? Math.min(d.elemArray[d.curElem][18], d.fullscreenHeight) : Math.min(f, d.fullscreenHeight), h = Math.max(g / this.width, l / this.height), h = 1 < h ? 1 : h) : (h = "fill" == d.options.resizemode ? Math.max(d.options.width / this.width, d.options.height / this.height) : Math.min(d.options.width / this.width, d.options.height / this.height), g = d.options.width, l = d.options.height);
                    var p = Math.round(h * this.width);
                    h = Math.round(h * this.height);
                    var q = Math.round(g / 2 - p / 2), m = Math.round(l / 2 - h / 2);
                    d.isFullscreen && d.adjustFullscreen(g,
                        l);
                    c.css({width: g, height: l});
                    g = b("<div class='html5gallery-elem-img-" + d.id + "' style='display:block; position:absolute; overflow:hidden; width:" + g + "px; height:" + l + "px; left:0px; margin-left:" + (d.options.slideshadow && !d.isFullscreen ? 4 : 0) + "px; top:0px; margin-top:" + (d.options.slideshadow && !d.isFullscreen ? 4 : 0) + "px;'><img class='html5gallery-elem-image-" + d.id + "' style='border:none; position:absolute; opacity:inherit; filter:inherit; padding:0px; margin:0px; left:" + q + "px; top:" + m + "px; max-width:none; max-height:none; width:" +
                        p + "px; height:" + h + "px;' src='" + d.elemArray[d.curElem][12] + "' />" + d.options.watermarkcode + "</div>");
                    l = b(".html5gallery-elem-img-" + d.id, c);
                    l.length ? (c.prepend(g), c.html5boxTransition(d.id, l, g, {
                        effect: d.options.effect,
                        easing: d.options.easing,
                        duration: d.options.duration,
                        direction: d.curElem >= d.savedElem,
                        slide: d.options.slide
                    }, function () {
                    })) : c.html(g);
                    b(".html5gallery-video-play-" + d.id, a).length || b("<div class='html5gallery-video-play-" + d.id + "' style='position:absolute;display:block;cursor:pointer;top:50%;left:50%;width:64px;height:64px;margin-left:-32px;margin-top:-32px;background:url(\"" +
                        d.options.skinfolder + "playvideo_64.png\") no-repeat center center;'></div>").appendTo(c).unbind(d.eClick).bind(d.eClick, function () {
                        b(this).remove();
                        clearTimeout(d.slideshowTimeout);
                        b(".html5gallery-timer-" + d.id, d.$gallery).css({width: 0});
                        clearInterval(d.slideTimer);
                        d.slideTimerCount = 0;
                        d.showingPoster = !1;
                        var a = d.elemArray[d.curElem][9];
                        5 == a || 6 == a || 7 == a || 8 == a ? d.showVideo(!0) : 9 == a ? d.showYoutube(!0) : 10 == a ? d.showVimeo(!0) : 11 == a && d.showEmbedVideo(!0);
                        d.checkMK()
                    });
                    d.checkMK()
                });
                b(h).error(function () {
                    $preloading.remove();
                    d.isFullscreen && d.adjustFullscreen(d.options.width, d.options.height);
                    c.html("<div class='html5gallery-elem-error-" + d.id + "' style='display:block; position:absolute; overflow:hidden; text-align:center; width:" + d.options.width + "px; left:0px; top:" + Math.round(d.options.height / 2 - 10) + "px; margin:4px;'><div class='html5gallery-error-" + d.id + "'>The requested content cannot be found</div>");
                    d.options.googleanalyticsaccount && window._gaq && window._gaq.push(["_trackEvent", "Image", "Error", d.elemArray[d.curElem][12]])
                });
                h.src = this.elemArray[this.curElem][12]
            }, getFlashMovieObject: function (a) {
                if (window.document[a])return window.document[a];
                if (-1 == navigator.appName.indexOf("Microsoft Internet")) {
                    if (document.embeds && document.embeds[a])return document.embeds[a]
                } else return document.getElementById(a)
            }, playVideo: function () {
                var a = this.elemArray[this.curElem][9];
                if (5 == a || 6 == a || 7 == a || 8 == a)this.isHTML5 && 0 < b("#html5gallery-elem-html5-video-" + this.id).length ? b("#html5gallery-elem-html5-video-" + this.id, this.container).get(0).play() :
                (a = this.getFlashMovieObject("html5gallery-elem-video-flash-" + this.id)) && "function" === typeof a.playVideo && a.playVideo()
            }, pauseVideo: function () {
                var a = this.elemArray[this.curElem][9];
                if (5 == a || 6 == a || 7 == a || 8 == a)this.isHTML5 && 0 < b("#html5gallery-elem-html5-video-" + this.id).length ? b("#html5gallery-elem-html5-video-" + this.id, this.container).get(0).pause() : (a = this.getFlashMovieObject("html5gallery-elem-video-flash-" + this.id)) && "function" === typeof a.pauseVideo && a.pauseVideo()
            }, showVideo: function (a, c) {
                a && this.options.autoslideandplayafterfirstplayed &&
                (this.options.autoplayvideo = !0, this.isPaused = !1);
                this.disableTouchSwipe = !0;
                var d = this.isFullscreen ? this.$fullscreen : this.$gallery, e = this.elemArray[this.curElem][10], f = this.elemArray[this.curElem][11];
                if (this.isFullscreen) {
                    var e = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : Math.min(e, this.fullscreenWidth), h = this.elemArray[this.curElem][18] ? Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : Math.min(f, this.fullscreenHeight);
                    this.adjustFullscreen(e,
                        h);
                    f = e;
                    e = h
                } else b(".html5gallery-elem-" + this.id, this.$gallery).css({
                    width: this.options.width,
                    height: this.options.height
                }), f = this.options.width, e = this.options.height;
                h = -1;
                c && b(".html5gallery-elem-" + this.id, d).find("video").length && (h = b(".html5gallery-elem-" + this.id, d).find("video:first").get(0).currentTime);
                b(".html5gallery-elem-" + this.id, d).html("<div class='html5gallery-loading-center-" + this.id + "'></div><div class='html5gallery-elem-video-" + this.id + "' style='display:block;position:absolute;overflow:hidden;top:" +
                    (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;left:" + (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;width:" + f + "px;height:" + e + "px;'></div>" + this.options.watermarkcode);
                this.isHTML5 = !1;
                if (this.options.isIE678 || this.options.isIE9 && this.options.useflashonie9 || this.options.isIE10 && this.options.useflashonie10 || this.options.isIE11 && this.options.useflashonie11)this.isHTML5 = !1; else if (this.options.isMobile)this.isHTML5 = !0; else if ((this.options.html5player || !this.options.flashInstalled) && this.options.html5VideoSupported)if (!this.options.isFirefox && !this.options.isOpera || (this.options.isFirefox || this.options.isOpera) && (this.elemArray[this.curElem][3] || this.elemArray[this.curElem][4]))this.isHTML5 = !0;
                if (this.isHTML5) {
                    var j = this.elemArray[this.curElem][2], g = this.elemArray[this.curElem][13];
                    if (this.options.isFirefox || this.options.isOpera || !j)j = this.elemArray[this.curElem][4] ? this.elemArray[this.curElem][4] : this.elemArray[this.curElem][3], g = this.elemArray[this.curElem][15] ? this.elemArray[this.curElem][15] : this.elemArray[this.curElem][14];
                    this.embedHTML5Video(b(".html5gallery-elem-video-" +
                        this.id, d), f, e, j, g, a, h, c)
                } else h = this.elemArray[this.curElem][2], "/" != h.charAt(0) && ("http:" != h.substring(0, 5) && "https:" != h.substring(0, 6)) && (h = this.options.htmlfolder + h), j = "", this.elemArray[this.curElem][13] && (j = this.elemArray[this.curElem][13], "/" != j.charAt(0) && ("http:" != j.substring(0, 5) && "https:" != j.substring(0, 6)) && (j = this.options.htmlfolder + j)), this.embedFlash(b(".html5gallery-elem-video-" + this.id, d), "100%", "100%", this.options.jsfolder + "html5boxplayer.swf", "transparent", {
                    width: f,
                    height: e,
                    hidecontrols: this.options.videohidecontrols ?
                        "1" : "0",
                    hideplaybutton: "0",
                    videofile: h,
                    hdfile: j,
                    ishd: this.isHd ? "1" : "0",
                    autoplay: a ? "1" : "0",
                    errorcss: ".html5box-error" + this.options.errorcss,
                    id: this.id
                }, "html5gallery-elem-video-flash-" + this.id);
                this.options.googleanalyticsaccount && window._gaq && window._gaq.push(["_trackEvent", "Video", "Play", this.elemArray[this.curElem][2]])
            }, showSWF: function () {
                var a = this.isFullscreen ? this.$fullscreen : this.$gallery, c = this.elemArray[this.curElem][10], d = this.elemArray[this.curElem][11];
                this.isFullscreen ? this.adjustFullscreen(c,
                    d) : b(".html5gallery-elem-" + this.id, this.$gallery).css({
                    width: this.options.width,
                    height: this.options.height
                });
                var e = this.isFullscreen ? 0 : Math.round((this.options.height - d) / 2) + (this.options.slideshadow ? 4 : 0), f = this.isFullscreen ? 0 : Math.round((this.options.width - c) / 2) + (this.options.slideshadow ? 4 : 0);
                b(".html5gallery-elem-" + this.id, a).html("<div class='html5gallery-elem-flash-" + this.id + "' style='display:block;position:absolute;overflow:hidden;top:" + e + "px;left:" + f + "px;width:" + c + "px;height:" + d + "px;'></div>" +
                    this.options.watermarkcode);
                this.embedFlash(b(".html5gallery-elem-flash-" + this.id, a), c, d, this.elemArray[this.curElem][2], "window", {}, "html5gallery-elem-flash-object-" + this.id);
                this.options.googleanalyticsaccount && window._gaq && window._gaq.push(["_trackEvent", "Flash", "Play", this.elemArray[this.curElem][2]])
            }, prepareYoutubeHref: function (a) {
                var b = "https://www.youtube.com/embed/" + a.match(/(\?v=|\/\d\/|\/embed\/|\/v\/|\.be\/)([a-zA-Z0-9\-\_]+)/)[2];
                a = this.getYoutubeParams(a);
                var d = !0, e;
                for (e in a)d ? (b +=
                    "?", d = !1) : b += "&", b += e + "=" + a[e];
                return b
            }, getYoutubeParams: function (a) {
                var b = {};
                if (0 > a.indexOf("?"))return b;
                a = a.substring(a.indexOf("?") + 1).split("&");
                for (var d = 0; d < a.length; d++) {
                    var e = a[d].split("=");
                    e && (2 == e.length && "v" != e[0].toLowerCase()) && (b[e[0].toLowerCase()] = e[1])
                }
                return b
            }, initYoutubeApi: function () {
                var a, b = !1, d = !1;
                for (a = 0; a < this.elemArray.length; a++)9 == this.elemArray[a][9] ? b = !0 : 10 == this.elemArray[a][9] && (d = !0);
                b && (a = document.createElement("script"), a.src = "https://www.youtube.com/iframe_api",
                    b = document.getElementsByTagName("script")[0], b.parentNode.insertBefore(a, b));
                d && (a = document.createElement("script"), a.src = this.options.jsfolder + "froogaloop2.min.js", b = document.getElementsByTagName("script")[0], b.parentNode.insertBefore(a, b))
            }, showEmbedVideo: function (a) {
                a && this.options.autoslideandplayafterfirstplayed && (this.options.autoplayvideo = !0, this.isPaused = !1);
                var c = this.isFullscreen ? this.$fullscreen : this.$gallery, d = this.elemArray[this.curElem][10], e = this.elemArray[this.curElem][11];
                if (this.isFullscreen) {
                    var d =
                        this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : Math.min(d, this.fullscreenWidth), f = this.elemArray[this.curElem][18] ? Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : Math.min(e, this.fullscreenHeight);
                    this.adjustFullscreen(d, f);
                    e = d;
                    d = f
                } else b(".html5gallery-elem-" + this.id, this.$gallery).css({
                    width: this.options.width,
                    height: this.options.height
                }), e = this.options.width, d = this.options.height;
                f = this.elemArray[this.curElem][2];
                b(".html5gallery-elem-" +
                    this.id, c).html("<div class='html5gallery-loading-center-" + this.id + "'></div><div id='html5gallery-elem-video-" + this.id + "' style='display:block;position:absolute;overflow:hidden;top:" + (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;left:" + (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;width:" + e + "px;height:" + d + "px;'></div>" + this.options.watermarkcode);
                f.match(/\:\/\/.*(dai\.ly)/i) && (f = "https://www.dailymotion.com/embed/video/" + f.match(/(dai\.ly\/)([a-zA-Z0-9\-\_]+)/)[2]);
                a && (f = 0 > f.indexOf("?") ?
                f + "?autoplay=1" : f + "&autoplay=1");
                b("#html5gallery-elem-video-" + this.id, c).html("<iframe width='" + e + "' height='" + d + "' src='" + f + "' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
                this.options.googleanalyticsaccount && window._gaq && window._gaq.push(["_trackEvent", "Video", "Play", this.elemArray[this.curElem][2]])
            }, showYoutube: function (a) {
                a && this.options.autoslideandplayafterfirstplayed && (this.options.autoplayvideo = !0, this.isPaused = !1);
                var c = this.isFullscreen ? this.$fullscreen :
                    this.$gallery, d = this.elemArray[this.curElem][10], e = this.elemArray[this.curElem][11];
                if (this.isFullscreen) {
                    var d = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : Math.min(d, this.fullscreenWidth), f = this.elemArray[this.curElem][18] ? Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : Math.min(e, this.fullscreenHeight);
                    this.adjustFullscreen(d, f);
                    e = d;
                    d = f
                } else b(".html5gallery-elem-" + this.id, this.$gallery).css({
                    width: this.options.width,
                    height: this.options.height
                }),
                    e = this.options.width, d = this.options.height;
                f = this.elemArray[this.curElem][2];
                b(".html5gallery-elem-" + this.id, c).html("<div class='html5gallery-loading-center-" + this.id + "'></div><div id='html5gallery-elem-video-" + this.id + "' style='display:block;position:absolute;overflow:hidden;top:" + (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;left:" + (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;width:" + e + "px;height:" + d + "px;'></div>" + this.options.watermarkcode);
                var h = this;
                if (!ASYouTubeIframeAPIReady &&
                    (ASYouTubeTimeout += 100, 3E3 > ASYouTubeTimeout)) {
                    setTimeout(function () {
                        h.showYoutube(a)
                    }, 100);
                    return
                }
                if (ASYouTubeIframeAPIReady && !this.options.isMobile && !this.options.isIE6 && !this.options.isIE7) {
                    c = this.elemArray[this.curElem][2].match(/(\?v=|\/\d\/|\/embed\/|\/v\/|\.be\/)([a-zA-Z0-9\-\_]+)/)[2];
                    f = null;
                    a && (f = function (a) {
                        a.target.playVideo()
                    });
                    var j = this.getYoutubeParams(this.elemArray[this.curElem][2]), j = b.extend({
                        html5: 1,
                        controls: h.options.videohidecontrols ? "0" : "1",
                        showinfo: h.options.videohidecontrols ?
                            "0" : "1",
                        autoplay: a ? 1 : 0,
                        rel: 0,
                        wmode: "transparent"
                    }, j);
                    new YT.Player("html5gallery-elem-video-" + this.id, {
                        width: e,
                        height: d,
                        videoId: c,
                        playerVars: j,
                        events: {
                            onReady: f, onStateChange: function (a) {
                                a.data == YT.PlayerState.ENDED && (h.onVideoEnd(), h.isPaused || h.slideRun(-1))
                            }
                        }
                    })
                } else f = this.prepareYoutubeHref(f), a && (f = 0 > f.indexOf("?") ? f + "?autoplay=1" : f + "&autoplay=1"), f = 0 > f.indexOf("?") ? f + "?wmode=transparent&rel=0" : f + "&wmode=transparent&rel=0", h.options.videohidecontrols && (f += "&controls=0&showinfo=0"), b("#html5gallery-elem-video-" +
                    this.id, c).html("<iframe width='" + e + "' height='" + d + "' src='" + f + "' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
                this.options.googleanalyticsaccount && window._gaq && window._gaq.push(["_trackEvent", "Video", "Play", this.elemArray[this.curElem][2]])
            }, showVimeo: function (a) {
                a && this.options.autoslideandplayafterfirstplayed && (this.options.autoplayvideo = !0, this.isPaused = !1);
                var c = this;
                if ("function" !== typeof $f && (ASVimeoTimeout += 100, 3E3 > ASVimeoTimeout)) {
                    setTimeout(function () {
                            c.showVimeo(a)
                        },
                        100);
                    return
                }
                var d = this.isFullscreen ? this.$fullscreen : this.$gallery, e = this.elemArray[this.curElem][10], f = this.elemArray[this.curElem][11];
                if (this.isFullscreen) {
                    var e = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17], this.fullscreenWidth) : Math.min(e, this.fullscreenWidth), h = this.elemArray[this.curElem][18] ? Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : Math.min(f, this.fullscreenHeight);
                    this.adjustFullscreen(e, h);
                    f = e;
                    e = h
                } else b(".html5gallery-elem-" + this.id,
                    this.$gallery).css({
                        width: this.options.width,
                        height: this.options.height
                    }), f = this.options.width, e = this.options.height;
                h = this.elemArray[this.curElem][2];
                h = 0 > h.indexOf("?") ? h + "?" : h + "&";
                h = a && !this.options.isAndroid ? h + "autoplay=1" : h + "autoplay=0";
                h += "&api=1&player_id=html5gallery_vimeo_" + this.id;
                b(".html5gallery-elem-" + this.id, d).html("<div class='html5gallery-loading-center-" + this.id + "'></div><div class='html5gallery-elem-video-" + this.id + "' style='display:block;position:absolute;overflow:hidden;top:" +
                    (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;left:" + (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;width:" + f + "px;height:" + e + "px;'></div>" + this.options.watermarkcode);
                b(".html5gallery-elem-video-" + this.id, d).html("<iframe id='html5gallery_vimeo_" + this.id + "' width='" + f + "' height='" + e + "' src='" + h + "' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
                if ("function" === typeof $f && a && !this.options.isAndroid) {
                    var d = b("#html5gallery_vimeo_" + this.id)[0], j =
                        $f(d), c = this;
                    j.addEvent("ready", function () {
                        j.addEvent("finish", function () {
                            c.onVideoEnd();
                            c.isPaused || c.slideRun(-1)
                        })
                    })
                }
                this.options.googleanalyticsaccount && window._gaq && window._gaq.push(["_trackEvent", "Video", "Play", this.elemArray[this.curElem][2]])
            }, showIframe: function () {
                var a = this.isFullscreen ? this.$fullscreen : this.$gallery, c = this.elemArray[this.curElem][10], d = this.elemArray[this.curElem][11];
                if (this.isFullscreen) {
                    var c = this.elemArray[this.curElem][17] ? Math.min(this.elemArray[this.curElem][17],
                        this.fullscreenWidth) : Math.min(c, this.fullscreenWidth), e = this.elemArray[this.curElem][18] ? Math.min(this.elemArray[this.curElem][18], this.fullscreenHeight) : Math.min(d, this.fullscreenHeight);
                    this.adjustFullscreen(c, e);
                    d = c;
                    c = e
                } else b(".html5gallery-elem-" + this.id, this.$gallery).css({
                    width: this.options.width,
                    height: this.options.height
                }), d = this.options.width, c = this.options.height;
                e = this.elemArray[this.curElem][2];
                b(".html5gallery-elem-" + this.id, a).html("<div class='html5gallery-loading-center-" + this.id +
                    "'></div><div class='html5gallery-elem-iframe-" + this.id + "' style='display:block;position:absolute;overflow:hidden;top:" + (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;left:" + (this.options.slideshadow && !this.isFullscreen ? 4 : 0) + "px;width:" + d + "px;height:" + c + "px;'></div>" + this.options.watermarkcode);
                b(".html5gallery-elem-iframe-" + this.id, a).html("<iframe id='html5gallery-iframe-" + this.id + "' width='" + d + "' height='" + c + "' src='" + e + "' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
                this.options.googleanalyticsaccount && window._gaq && window._gaq.push(["_trackEvent", "Iframe", "Play", this.elemArray[this.curElem][2]])
            }, checkType: function (a) {
                return !a ? -1 : a.match(/\.(jpg|gif|png|bmp|jpeg)(.*)?$/i) ? 1 : a.match(/[^\.]\.(swf)\s*$/i) ? 2 : a.match(/[^\.]\.(mp3)\s*$/i) ? 3 : a.match(/[^\.]\.(pdf)\s*$/i) ? 4 : a.match(/\.(flv)(.*)?$/i) ? 5 : a.match(/\.(mp4|m4v)(.*)?$/i) ? 6 : a.match(/\.(ogv|ogg)(.*)?$/i) ? 7 : a.match(/\.(webm)(.*)?$/i) ? 8 : a.match(/\:\/\/.*(youtube\.com)/i) || a.match(/\:\/\/.*(youtu\.be)/i) ? 9 : a.match(/\:\/\/.*(vimeo\.com)/i) ?
                    10 : a.match(/\:\/\/.*(dailymotion\.com)/i) || a.match(/\:\/\/.*(dai\.ly)/i) ? 11 : 1
            }, onChange: function () {
                if (this.options.onchange && window[this.options.onchange] && "function" == typeof window[this.options.onchange])window[this.options.onchange](this.elemArray[this.curElem].concat([this.id]))
            }, onSlideshowOver: function () {
                if (this.options.onslideshowover && window[this.options.onslideshowover] && "function" == typeof window[this.options.onslideshowover])window[this.options.onslideshowover](this.elemArray[this.curElem])
            },
            onThumbOver: function (a) {
                if (this.options.onthumbover && window[this.options.onthumbover] && "function" == typeof window[this.options.onthumbover])window[this.options.onthumbover](this.elemArray[a])
            }, onThumbClick: function (a) {
                if (this.options.onthumbclick && window[this.options.onthumbclick] && "function" == typeof window[this.options.onthumbclick])window[this.options.onthumbclick](this.elemArray[a].concat([this.id]));
                this.options.thumbjumptotop && (this.options.thumbjumpanchor && 0 < this.options.thumbjumpanchor.length &&
                0 < b("#" + this.options.thumbjumpanchor).length ? (a = b("#" + this.options.thumbjumpanchor).offset().top, b(window).scrollTop(a)) : 0 <= this.options.thumbjumpposition ? b(window).scrollTop(this.options.thumbjumpposition) : (a = this.container.offset().top, a < b(window).scrollTop() && b(window).scrollTop(a)))
            }, onVideoEnd: function () {
                if (this.options.onvideoend && window[this.options.onvideoend] && "function" == typeof window[this.options.onvideoend])window[this.options.onvideoend](this.elemArray[this.curElem])
            }, embedHTML5Video: function (a,
                                          c, d, e, f, h, j, g) {
                a.html("<div class='html5gallery-elem-video-container-" + this.id + "' style='position:relative;display:block;background-color:#000;width:" + c + "px;height:" + d + "px;'><video id='html5gallery-elem-html5-video-" + this.id + "' width='" + c + "px' height='" + d + "px'" + (this.options.nativehtml5controls && !this.options.videohidecontrols ? " controls" : "") + "></div>");
                b("video", a).get(0).setAttribute("src", (f && this.isHd ? f : e) + (0 < j ? "#t=" + j : ""));
                !this.options.nativehtml5controls && !this.options.videohidecontrols && (b("video",
                    a).data("src", e), b("video", a).data("hd", f), b("video", a).data("ishd", this.isHd), b("video", a).addHTML5VideoControls(this.options.skinfolder, this, "html5gallery-elem-html5-video-" + this.id));
                (h || g) && b("video", a).get(0).play();
                var l = this;
                b("video", a).unbind("ended").bind("ended", function () {
                    l.onVideoEnd();
                    l.isPaused || l.slideRun(-1)
                })
            }, embedFlash: function (a, b, d, e, f, h, j) {
                if (this.options.flashInstalled) {
                    var g = {
                        pluginspage: "http://www.adobe.com/go/getflashplayer",
                        quality: "high",
                        allowFullScreen: "true",
                        allowScriptAccess: "always",
                        type: "application/x-shockwave-flash"
                    };
                    g.width = b;
                    g.height = d;
                    g.src = e;
                    g.wmode = f;
                    a.append('<div id="' + j + '"></div>');
                    window.HTML5GallerySWFObject = HTML5GallerySWFObjectFunc();
                    window.HTML5GallerySWFObject.embedSWF(e, j, b, d, "9.0.0", !1, h, g, {})
                } else a.html("<div class='html5gallery-elem-error-" + this.id + "' style='display:block; position:absolute; text-align:center; width:" + this.options.width + "px; left:0px; top:" + Math.round(this.options.height / 2 - 10) + "px;'><div class='html5gallery-error-" + this.id + "'><div>The required Adobe Flash Player plugin is not installed</div><div style='display:block;position:relative;text-align:center;width:112px;height:33px;margin:0px auto;'><a href='http://www.adobe.com/go/getflashplayer'><img src='http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' width='112' height='33'></img></a></div></div>")
            }
        };
        this.each(function () {
            var a = b(this);
            l = l || {};
            for (var c in l)c.toLowerCase() !== c && (l[c.toLowerCase()] = l[c], delete l[c]);
            if ((!b(this).data("donotinit") || l && l.forceinit) && !b(this).data("inited")) {
                b(this).data("inited", 1);
                this.options = b.extend({}, l);
                var d = this;
                b.each(a.data(), function (a, b) {
                    d.options[a.toLowerCase()] = b
                });
                "skin"in this.options && (this.options.skin = this.options.skin.toLowerCase());
                c = {
                    skinfolder: "skins/horizontal/",
                    padding: 6,
                    bgcolor: "#ffffff",
                    bgimage: "",
                    galleryshadow: !0,
                    slideshadow: !1,
                    showsocialmedia: !1,
                    headerpos: "top",
                    showdescription: !0,
                    titleoverlay: !0,
                    titleautohide: !0,
                    titlecss: " {color:#ffffff; font-size:14px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; padding:10px 0px 10px 10px; background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
                    titlecsslink: " a {color:#ffffff;}",
                    descriptioncss: " {color:#ffffff; font-size:13px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; padding:0px 0px 10px 10px; background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
                    descriptioncsslink: " a {color:#ffffff;}",
                    showcarousel: !0,
                    carouselmargin: 0,
                    carouselbgtransparent: !1,
                    carouselbgcolorstart: "#494f54",
                    carouselbgcolorend: "#292c31",
                    carouseltopborder: "#666666",
                    carouselbottomborder: "#111111",
                    thumbwidth: 64,
                    thumbheight: 48,
                    thumbgap: 4,
                    thumbmargin: 6,
                    thumbunselectedimagebordercolor: "#ffffff",
                    thumbimageborder: 1,
                    thumbimagebordercolor: "",
                    thumbshowplayonvideo: !0,
                    thumbshadow: !1,
                    thumbopacity: 0.8
                };
                var k = {
                    padding: 12,
                    skinfolder: "skins/light/",
                    bgcolor: "",
                    bgimage: "",
                    galleryshadow: !1,
                    slideshadow: !0,
                    showsocialmedia: !1,
                    headerpos: "top",
                    showdescription: !0,
                    titleoverlay: !0,
                    titleautohide: !0,
                    titlecss: " {color:#ffffff; font-size:14px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:10px 0px 10px 10px;  background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
                    titlecsslink: " a {color:#ffffff;}",
                    descriptioncss: " {color:#ffffff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:0px 0px 10px 10px;  background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
                    descriptioncsslink: " a {color:#ffffff;}",
                    showcarousel: !0,
                    carouselmargin: 10,
                    carouselbgtransparent: !0,
                    thumbwidth: 48,
                    thumbheight: 48,
                    thumbgap: 8,
                    thumbmargin: 12,
                    thumbunselectedimagebordercolor: "#fff",
                    thumbimageborder: 2,
                    thumbimagebordercolor: "#fff",
                    thumbshowplayonvideo: !0,
                    thumbshadow: !0,
                    thumbopacity: 0.8
                }, f = {
                    padding: 0,
                    skinfolder: "skins/mediapage/",
                    bgcolor: "",
                    bgimage: "",
                    galleryshadow: !1,
                    slideshadow: !1,
                    showsocialmedia: !1,
                    headerpos: "top",
                    showdescription: !0,
                    titleoverlay: !0,
                    titleautohide: !0,
                    titlecss: " {color:#ffffff; font-size:14px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:10px 0px 10px 10px;  background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
                    titlecsslink: " a {color:#ffffff;}",
                    descriptioncss: " {color:#ffffff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:0px 0px 10px 10px;  background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
                    descriptioncsslink: " a {color:#ffffff;}",
                    showcarousel: !0,
                    carouselmargin: 24,
                    carouselmultirows: !0,
                    thumbrowgap: 16,
                    carouselbgtransparent: !0,
                    thumbwidth: 120,
                    thumbheight: 60,
                    thumbgap: 10,
                    thumbmargin: 12,
                    thumbunselectedimagebordercolor: "#fff",
                    thumbimageborder: 0,
                    thumbimagebordercolor: "#fff",
                    thumbshowplayonvideo: !0,
                    thumbshadow: !1,
                    thumbopacity: 0.8,
                    thumbjumptotop: !0,
                    thumbshowtitle: !0,
                    thumbtitlecss: "{text-align:center; color:#000; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden;}",
                    thumbtitleheight: 24
                }, h = {
                    padding: 12,
                    skinfolder: "skins/gallery/",
                    bgcolor: "",
                    bgimage: "",
                    galleryshadow: !1,
                    slideshadow: !0,
                    showsocialmedia: !1,
                    headerpos: "top",
                    showdescription: !0,
                    titleoverlay: !0,
                    titleautohide: !0,
                    titlecss: " {color:#ffffff; font-size:14px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:10px 0px 10px 10px;  background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
                    titlecsslink: " a {color:#ffffff;}",
                    descriptioncss: " {color:#ffffff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:0px 0px 10px 10px;  background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
                    descriptioncsslink: " a {color:#ffffff;}",
                    showcarousel: !0,
                    carouselmargin: 10,
                    carouselbgtransparent: !0,
                    thumbwidth: 120,
                    thumbheight: 60,
                    thumbgap: 8,
                    thumbmargin: 12,
                    thumbunselectedimagebordercolor: "#fff",
                    thumbimageborder: 2,
                    thumbimagebordercolor: "#fff",
                    thumbshowplayonvideo: !0,
                    thumbshadow: !0,
                    thumbopacity: 0.8,
                    thumbshowtitle: !0,
                    thumbtitlecss: "{text-align:center; color:#000; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:nowrap;}",
                    thumbtitleheight: 18
                }, j = {
                    padding: 12,
                    skinfolder: "skins/gallery/",
                    bgcolor: "",
                    bgimage: "",
                    galleryshadow: !1,
                    slideshadow: !0,
                    showsocialmedia: !1,
                    headerpos: "bottom",
                    showdescription: !0,
                    titleoverlay: !1,
                    titleheight: 72,
                    titleautohide: !0,
                    titlecss: "{color:#333;font-size:14px;font-family:Arial,Helvetica,sans-serif;overflow:hidden;text-align:center;padding:16px 8px 4px 8px;}",
                    titlecsslink: "a{color:#333;}",
                    descriptioncss: "{color:#333;font-size:12px;font-family:Arial,Helvetica,sans-serif;overflow:hidden;text-align:center;padding:4px 8px; }",
                    descriptioncsslink: "a{color:#333;}",
                    titlesmallscreen: !0,
                    showcarousel: !0,
                    carouselmargin: 10,
                    carouselbgtransparent: !0,
                    thumbwidth: 120,
                    thumbheight: 60,
                    thumbgap: 8,
                    thumbmargin: 12,
                    thumbunselectedimagebordercolor: "#fff",
                    thumbimageborder: 2,
                    thumbimagebordercolor: "#fff",
                    thumbshowplayonvideo: !0,
                    thumbshadow: !0,
                    thumbopacity: 0.8,
                    thumbshowtitle: !1,
                    thumbtitlecss: "{text-align:center; color:#000; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:nowrap;}",
                    thumbtitleheight: 18
                }, g = {
                    skinfolder: "skins/darkness/",
                    padding: 12,
                    bgcolor: "#444444",
                    bgimage: "background.jpg",
                    galleryshadow: !1,
                    slideshadow: !1,
                    headerpos: "bottom",
                    showdescription: !1,
                    titleoverlay: !1,
                    titleautohide: !1,
                    titlecss: " {color:#ffffff; font-size:16px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:10px 0px;}",
                    titlecsslink: " a {color:#ffffff;}",
                    descriptioncss: " {color:#ffffff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:0px 0px 10px 0px;}",
                    descriptioncsslink: " a {color:#ffffff;}",
                    showcarousel: !0,
                    carouselmargin: 8,
                    carouselbgtransparent: !1,
                    carouselbgcolorstart: "#494f54",
                    carouselbgcolorend: "#292c31",
                    carouseltopborder: "#666666",
                    carouselbottomborder: "#111111",
                    thumbwidth: 64,
                    thumbheight: 48,
                    thumbgap: 4,
                    thumbmargin: 6,
                    thumbunselectedimagebordercolor: "#ffffff",
                    thumbimageborder: 1,
                    thumbimagebordercolor: "",
                    thumbshowplayonvideo: !0,
                    thumbshadow: !1,
                    thumbopacity: 0.8
                }, q = {
                    skinfolder: "skins/vertical/",
                    padding: 12,
                    bgcolor: "#444444",
                    bgimage: "background.jpg",
                    galleryshadow: !1,
                    slideshadow: !1,
                    headerpos: "bottom",
                    showdescription: !1,
                    titleoverlay: !1,
                    titleautohide: !1,
                    titlecss: " {color:#ffffff; font-size:16px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:10px 0px;}",
                    titlecsslink: " a {color:#ffffff;}",
                    descriptioncss: " {color:#ffffff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:0px 0px 10px 0px;}",
                    descriptioncsslink: " a {color:#ffffff;}",
                    showcarousel: !0,
                    carouselmargin: 8,
                    carouselposition: "right",
                    carouselbgtransparent: !1,
                    carouselbgcolorstart: "#494f54",
                    carouselbgcolorend: "#292c31",
                    carouseltopborder: "#666666",
                    carouselbottomborder: "#111111",
                    carouselhighlightbgcolorstart: "#999999",
                    carouselhighlightbgcolorend: "#666666",
                    carouselhighlighttopborder: "#cccccc",
                    carouselhighlightbottomborder: "#444444",
                    carouselhighlightbgimage: "",
                    thumbwidth: 148,
                    thumbheight: 48,
                    thumbgap: 2,
                    thumbmargin: 6,
                    thumbunselectedimagebordercolor: "",
                    thumbimageborder: 1,
                    thumbimagebordercolor: "#cccccc",
                    thumbshowplayonvideo: !0,
                    thumbshadow: !1,
                    thumbopacity: 0.8,
                    thumbshowimage: !0,
                    thumbshowtitle: !0,
                    thumbtitlecss: "{text-align:center; color:#ffffff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:nowrap;}"
                }, p = {
                    skinfolder: "skins/showcase/",
                    padding: 12,
                    bgcolor: "#444444",
                    bgimage: "background.jpg",
                    galleryshadow: !1,
                    slideshadow: !1,
                    showsocialmedia: !1,
                    headerpos: "bottom",
                    showdescription: !1,
                    titleoverlay: !1,
                    titleautohide: !1,
                    titlecss: " {color:#ffffff; font-size:16px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:10px 0px;}",
                    titlecsslink: " a {color:#ffffff;}",
                    descriptioncss: " {color:#ffffff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; text-align:left; padding:0px 0px 10px 0px;}",
                    descriptioncsslink: " a {color:#ffffff;}",
                    showcarousel: !0,
                    carouselmargin: 8,
                    carouselposition: "bottom",
                    carouselheight: 210,
                    carouselbgtransparent: !1,
                    carouselbgcolorstart: "#494f54",
                    carouselbgcolorend: "#292c31",
                    carouseltopborder: "#666666",
                    carouselbottomborder: "#111111",
                    carouselhighlightbgcolorstart: "#999999",
                    carouselhighlightbgcolorend: "#666666",
                    carouselhighlighttopborder: "#cccccc",
                    carouselhighlightbottomborder: "#444444",
                    carouselhighlightbgimage: "",
                    thumbwidth: 148,
                    thumbheight: 60,
                    thumbgap: 2,
                    thumbmargin: 6,
                    thumbunselectedimagebordercolor: "",
                    thumbimageborder: 1,
                    thumbimagebordercolor: "#cccccc",
                    thumbshowplayonvideo: !0,
                    thumbshadow: !1,
                    thumbopacity: 0.8,
                    thumbshowimage: !0,
                    thumbshowtitle: !0,
                    thumbtitlecss: "{text-align:left; color:#ffffff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; padding: 6px 0;}",
                    thumbshowdescription: !0,
                    thumbdescriptioncss: "{font-size:10px;}"
                }, m = {
                    freelink: "http://html5box.com/html5gallery/watermark.php",
                    watermark: "",
                    watermarklink: "",
                    skin: "horizontal",
                    googlefonts: "",
                    enabletouchswipe: !0,
                    enabletouchswipeonandroid: !0,
                    responsive: !1,
                    responsivefullscreen: !1,
                    screenquery: {},
                    src: "",
                    xml: "",
                    xmlnocache: !0,
                    lightbox: !1,
                    autoslide: !1,
                    slideshowinterval: 6E3,
                    random: !1,
                    borderradius: 0,
                    loop: 0,
                    notupdatecarousel: !1,
                    updatecarouselinterval: 6E4,
                    autoplayvideo: !1,
                    html5player: !0,
                    playvideoonclick: !0,
                    videohidecontrols: !1,
                    nativehtml5controls: !1,
                    hddefault: !1,
                    useflashonie9: !0,
                    useflashonie10: !1,
                    useflashonie11: !1,
                    autoslideandplayafterfirstplayed: !1,
                    lightboxborder: 8,
                    lightboxtextheight: 72,
                    lightboxmargin: 12,
                    lightboxbgcolor: "#fff",
                    lightboxshowtitle: !0,
                    lightboxtitlecss: " {color:#333333; font:bold 12px Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; line-height:18px;}",
                    lightboxtitlelinkcss: " a {color:#333333;}",
                    lightboxshowdescription: !0,
                    lightboxdescriptioncss: " {color:#333333; font:normal 12px Arial,Helvetica,sans-serif; overflow:hidden; white-space:normal; line-height:14px;}",
                    lightboxdescriptionlinkcss: " a {color:#333333;}",
                    effect: "fade",
                    easing: "easeOutCubic",
                    duration: 1500,
                    slide: {duration: 1E3, easing: "easeOutExpo"},
                    width: 480,
                    height: 270,
                    showtimer: !0,
                    resizemode: "fit",
                    showtitle: !0,
                    titleheight: 45,
                    errorcss: " {text-align:center; color:#ff0000; font-size:14px; font-family:Arial, sans-serif;}",
                    shownumbering: !1,
                    numberingformat: "%NUM / %TOTAL",
                    googleanalyticsaccount: "",
                    showsocialmedia: !1,
                    socialheight: 30,
                    socialurlforeach: !1,
                    showfacebooklike: !0,
                    facebooklikeurl: "",
                    showtwitter: !0,
                    twitterurl: "",
                    twitterusername: "",
                    twittervia: "html5box",
                    showgoogleplus: !0,
                    googleplusurl: "",
                    showimagetoolbox: "always",
                    imagetoolboxstyle: "side",
                    imagetoolboxmode: "mouseover",
                    showplaybutton: !0,
                    showprevbutton: !0,
                    shownextbutton: !0,
                    showfullscreenbutton: !0,
                    showcarouselforsingle: !1,
                    carouselbgtransparent: !0,
                    carouselbgcolorstart: "#ffffff",
                    carouselbgcolorend: "#ffffff",
                    carouseltopborder: "#ffffff",
                    carouselbottomborder: "#ffffff",
                    carouselbgimage: "",
                    carouseleasing: "easeOutCirc",
                    carouselarrowwidth: 32,
                    carouselarrowheight: 32,
                    thumbresponsive: "samesize",
                    thumbcolumns: 5,
                    thumbcolumnsresponsive: !1,
                    thumbmediumcolumns: 3,
                    thumbmediumsize: 800,
                    thumbsmallcolumns: 2,
                    thumbsmallsize: 480,
                    thumbmediumwidth: 64,
                    thumbmediumheight: 64,
                    thumbsmallwidth: 48,
                    thumbsmallheight: 48,
                    carouselmultirows: !1,
                    thumbrowgap: 16,
                    thumblinkintitle: !1,
                    thumbjumptotop: !1,
                    thumbjumpposition: -1,
                    thumbjumpanchor: "",
                    youtubeapikey: "",
                    youtubeplaylistid: "",
                    youtubeplaylistmaxresults: "",
                    youtubeplaylistusemaxres: !0,
                    titlesmallscreen: !1,
                    titlesmallscreenwidth: 640,
                    titleheightsmallscreen: 148,
                    version: "3.6",
                    fv: !0,
                    fm: "72,84,77,76,53,32,71,97,108,108,101,114,121,32,70,114,101,101,32,86,101,114,115,105,111,110"
                }, m = "vertical" == this.options.skin ? b.extend(m, q) : "showcase" == this.options.skin ? b.extend(m, p) : "light" == this.options.skin ? b.extend(m, k) : "gallery" == this.options.skin ? b.extend(m, h) : "gallerywithtext" == this.options.skin ? b.extend(m, j) : "horizontal" == this.options.skin ? b.extend(m, c) : "darkness" == this.options.skin ? b.extend(m, g) : "mediapage" == this.options.skin ? b.extend(m, f) : b.extend(m, c);
                this.options = b.extend(m, this.options);
                this.options.titleheightlargescreen = this.options.titleheight;
                this.options.lightbox && (this.options.showfullscreenbutton = !1);
                "slideduration"in this.options && (this.options.slide.duration = this.options.slideduration);
                this.options.htmlfolder = window.location.href.substr(0, window.location.href.lastIndexOf("/") + 1);
                if (!this.options.jsfolder || !this.options.jsfolder.length)this.options.jsfolder = s;
                "/" != this.options.skinfolder.charAt(0) && ("http:" != this.options.skinfolder.substring(0, 5) && "https:" != this.options.skinfolder.substring(0,
                    6)) && (this.options.skinfolder = this.options.jsfolder + this.options.skinfolder);
                this.options.bgimage && (0 < this.options.bgimage.length && "http://" != this.options.bgimage.substring(0, 7).toLowerCase() && "https://" != this.options.bgimage.substring(0, 8).toLowerCase()) && (this.options.bgimage = this.options.skinfolder + this.options.bgimage);
                k = "";
                f = this.options.fm.split(",");
                for (c = 0; c < f.length; c++)k += String.fromCharCode(f[c]);
                this.options.fvm = k;
                f = "hmtamgli5cboxh.iclolms";
                for (c = 1; 5 >= c; c++)f = f.slice(0, c) + f.slice(c + 1);
                k = f.length;
                for (c = 0; 5 > c; c++)f = f.slice(0, k - 9 + c) + f.slice(k - 8 + c);
                -1 != this.options.htmlfolder.indexOf(f) && (this.options.fv = !1);
                k = b(window).width();
                if (this.options.screenquery)for (c in this.options.screenquery)k <= this.options.screenquery[c].screenwidth && (this.options.screenquery[c].gallerywidth && (this.options.width = this.options.screenquery[c].gallerywidth), this.options.screenquery[c].galleryheight && (this.options.height = this.options.screenquery[c].galleryheight), this.options.screenquery[c].thumbwidth && (this.options.thumbwidth =
                    this.options.screenquery[c].thumbwidth), this.options.screenquery[c].thumbheight && (this.options.thumbheight = this.options.screenquery[c].thumbheight));
                "galleryid"in this.options ? c = this.options.galleryid : (c = G, G++);
                k = new e(a, this.options, c);
                a.data("html5galleryobject", k);
                a.data("html5galleryid", c);
                html5GalleryObjects.addObject(k)
            }
        });
        return this
    };
    jQuery(document).ready(function () {
        jQuery(".html5gallery").html5gallery()
    })
}
function HTML5GallerySWFObjectFunc() {
    function s() {
        if (!z) {
            try {
                var a = p.getElementsByTagName("body")[0].appendChild(p.createElement("span"));
                a.parentNode.removeChild(a)
            } catch (b) {
                return
            }
            z = !0;
            for (var a = R.length, d = 0; d < a; d++)R[d]()
        }
    }

    function w(a) {
        z ? a() : R[R.length] = a
    }

    function m(a) {
        if (typeof t.addEventListener != f)t.addEventListener("load", a, !1); else if (typeof p.addEventListener != f)p.addEventListener("load", a, !1); else if (typeof t.attachEvent != f) {
            var b = t;
            b.attachEvent("onload", a);
            O[O.length] = [b, "onload", a]
        } else if ("function" == typeof t.onload) {
            var d = t.onload;
            t.onload = function () {
                d();
                a()
            }
        } else t.onload = a
    }

    function v() {
        var b = I.length;
        if (0 < b)for (var c = 0; c < b; c++) {
            var g = I[c].id, h = I[c].callbackFn, j = {success: !1, id: g};
            if (0 < r.pv[0]) {
                var k = e(g);
                if (k)if (a(I[c].swfVersion) && !(r.wk && 312 > r.wk))d(g, !0), h && (j.success = !0, j.ref = x(g), h(j)); else if (I[c].expressInstall && q()) {
                    j = {};
                    j.data = I[c].expressInstall;
                    j.width = k.getAttribute("width") || "0";
                    j.height = k.getAttribute("height") || "0";
                    k.getAttribute("class") && (j.styleclass = k.getAttribute("class"));
                    k.getAttribute("align") && (j.align = k.getAttribute("align"));
                    for (var m = {}, k = k.getElementsByTagName("param"), n = k.length, p = 0; p < n; p++)"movie" != k[p].getAttribute("name").toLowerCase() && (m[k[p].getAttribute("name")] = k[p].getAttribute("value"));
                    B(j, m, g, h)
                } else l(k), h && h(j)
            } else if (d(g, !0), h) {
                if ((g = x(g)) && typeof g.SetVariable != f)j.success = !0, j.ref = g;
                h(j)
            }
        }
    }

    function x(a) {
        var b = null;
        if ((a = e(a)) && "OBJECT" == a.nodeName)typeof a.SetVariable != f ? b = a : (a = a.getElementsByTagName(h)[0]) && (b = a);
        return b
    }

    function q() {
        return !D &&
            a("6.0.65") && (r.win || r.mac) && !(r.wk && 312 > r.wk)
    }

    function B(a, d, c, h) {
        D = !0;
        u = h || null;
        Q = {success: !1, id: c};
        var j = e(c);
        if (j) {
            "OBJECT" == j.nodeName ? (P = b(j), J = null) : (P = j, J = c);
            a.id = g;
            if (typeof a.width == f || !/%$/.test(a.width) && 310 > parseInt(a.width, 10))a.width = "310";
            if (typeof a.height == f || !/%$/.test(a.height) && 137 > parseInt(a.height, 10))a.height = "137";
            p.title = p.title.slice(0, 47) + " - Flash Player Installation";
            h = r.ie && r.win ? "ActiveX" : "PlugIn";
            h = "MMredirectURL=" + t.location.toString().replace(/&/g, "%26") + "&MMplayerType=" +
                h + "&MMdoctitle=" + p.title;
            d.flashvars = typeof d.flashvars != f ? d.flashvars + ("&" + h) : h;
            r.ie && (r.win && 4 != j.readyState) && (h = p.createElement("div"), c += "SWFObjectNew", h.setAttribute("id", c), j.parentNode.insertBefore(h, j), j.style.display = "none", function () {
                4 == j.readyState ? j.parentNode.removeChild(j) : setTimeout(arguments.callee, 10)
            }());
            G(a, d, c)
        }
    }

    function l(a) {
        if (r.ie && r.win && 4 != a.readyState) {
            var c = p.createElement("div");
            a.parentNode.insertBefore(c, a);
            c.parentNode.replaceChild(b(a), c);
            a.style.display = "none";
            (function () {
                4 ==
                a.readyState ? a.parentNode.removeChild(a) : setTimeout(arguments.callee, 10)
            })()
        } else a.parentNode.replaceChild(b(a), a)
    }

    function b(a) {
        var b = p.createElement("div");
        if (r.win && r.ie)b.innerHTML = a.innerHTML; else if (a = a.getElementsByTagName(h)[0])if (a = a.childNodes)for (var c = a.length, d = 0; d < c; d++)!(1 == a[d].nodeType && "PARAM" == a[d].nodeName) && 8 != a[d].nodeType && b.appendChild(a[d].cloneNode(!0));
        return b
    }

    function G(a, b, c) {
        var d, g = e(c);
        if (r.wk && 312 > r.wk)return d;
        if (g)if (typeof a.id == f && (a.id = c), r.ie && r.win) {
            var k =
                "", l;
            for (l in a)a[l] != Object.prototype[l] && ("data" == l.toLowerCase() ? b.movie = a[l] : "styleclass" == l.toLowerCase() ? k += ' class="' + a[l] + '"' : "classid" != l.toLowerCase() && (k += " " + l + '="' + a[l] + '"'));
            l = "";
            for (var m in b)b[m] != Object.prototype[m] && (l += '<param name="' + m + '" value="' + b[m] + '" />');
            g.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + k + ">" + l + "</object>";
            n[n.length] = a.id;
            d = e(a.id)
        } else {
            m = p.createElement(h);
            m.setAttribute("type", j);
            for (var q in a)a[q] != Object.prototype[q] && ("styleclass" ==
            q.toLowerCase() ? m.setAttribute("class", a[q]) : "classid" != q.toLowerCase() && m.setAttribute(q, a[q]));
            for (k in b)b[k] != Object.prototype[k] && "movie" != k.toLowerCase() && (a = m, l = k, q = b[k], c = p.createElement("param"), c.setAttribute("name", l), c.setAttribute("value", q), a.appendChild(c));
            g.parentNode.replaceChild(m, g);
            d = m
        }
        return d
    }

    function S(a) {
        var b = e(a);
        b && "OBJECT" == b.nodeName && (r.ie && r.win ? (b.style.display = "none", function () {
            if (4 == b.readyState) {
                var c = e(a);
                if (c) {
                    for (var d in c)"function" == typeof c[d] && (c[d] = null);
                    c.parentNode.removeChild(c)
                }
            } else setTimeout(arguments.callee, 10)
        }()) : b.parentNode.removeChild(b))
    }

    function e(a) {
        var b = null;
        try {
            b = p.getElementById(a)
        } catch (c) {
        }
        return b
    }

    function a(a) {
        var b = r.pv;
        a = a.split(".");
        a[0] = parseInt(a[0], 10);
        a[1] = parseInt(a[1], 10) || 0;
        a[2] = parseInt(a[2], 10) || 0;
        return b[0] > a[0] || b[0] == a[0] && b[1] > a[1] || b[0] == a[0] && b[1] == a[1] && b[2] >= a[2] ? !0 : !1
    }

    function c(a, b, c, d) {
        if (!r.ie || !r.mac) {
            var e = p.getElementsByTagName("head")[0];
            if (e) {
                c = c && "string" == typeof c ? c : "screen";
                d && (T = A = null);
                if (!A ||
                    T != c)d = p.createElement("style"), d.setAttribute("type", "text/css"), d.setAttribute("media", c), A = e.appendChild(d), r.ie && (r.win && typeof p.styleSheets != f && 0 < p.styleSheets.length) && (A = p.styleSheets[p.styleSheets.length - 1]), T = c;
                r.ie && r.win ? A && typeof A.addRule == h && A.addRule(a, b) : A && typeof p.createTextNode != f && A.appendChild(p.createTextNode(a + " {" + b + "}"))
            }
        }
    }

    function d(a, b) {
        if (C) {
            var d = b ? "visible" : "hidden";
            z && e(a) ? e(a).style.visibility = d : c("#" + a, "visibility:" + d)
        }
    }

    function k(a) {
        return null != /[\\\"<>\.;]/.exec(a) &&
        typeof encodeURIComponent != f ? encodeURIComponent(a) : a
    }

    var f = "undefined", h = "object", j = "application/x-shockwave-flash", g = "SWFObjectExprInst", t = window, p = document, H = navigator, V = !1, R = [function () {
        if (V) {
            var a = p.getElementsByTagName("body")[0], b = p.createElement(h);
            b.setAttribute("type", j);
            var c = a.appendChild(b);
            if (c) {
                var d = 0;
                (function () {
                    if (typeof c.GetVariable != f) {
                        var e = c.GetVariable("$version");
                        e && (e = e.split(" ")[1].split(","), r.pv = [parseInt(e[0], 10), parseInt(e[1], 10), parseInt(e[2], 10)])
                    } else if (10 > d) {
                        d++;
                        setTimeout(arguments.callee, 10);
                        return
                    }
                    a.removeChild(b);
                    c = null;
                    v()
                })()
            } else v()
        } else v()
    }], I = [], n = [], O = [], P, J, u, Q, z = !1, D = !1, A, T, C = !0, r, W = typeof p.getElementById != f && typeof p.getElementsByTagName != f && typeof p.createElement != f, K = H.userAgent.toLowerCase(), E = H.platform.toLowerCase(), N = E ? /win/.test(E) : /win/.test(K), E = E ? /mac/.test(E) : /mac/.test(K), K = /webkit/.test(K) ? parseFloat(K.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : !1, L = !+"\v1", F = [0, 0, 0], y = null;
    if (typeof H.plugins != f && typeof H.plugins["Shockwave Flash"] ==
        h) {
        if ((y = H.plugins["Shockwave Flash"].description) && !(typeof H.mimeTypes != f && H.mimeTypes[j] && !H.mimeTypes[j].enabledPlugin))V = !0, L = !1, y = y.replace(/^.*\s+(\S+\s+\S+$)/, "$1"), F[0] = parseInt(y.replace(/^(.*)\..*$/, "$1"), 10), F[1] = parseInt(y.replace(/^.*\.(.*)\s.*$/, "$1"), 10), F[2] = /[a-zA-Z]/.test(y) ? parseInt(y.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0
    } else if (typeof t.ActiveXObject != f)try {
        var M = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
        if (M && (y = M.GetVariable("$version")))L = !0, y = y.split(" ")[1].split(","),
            F = [parseInt(y[0], 10), parseInt(y[1], 10), parseInt(y[2], 10)]
    } catch (U) {
    }
    r = {w3: W, pv: F, wk: K, ie: L, win: N, mac: E};
    r.w3 && ((typeof p.readyState != f && "complete" == p.readyState || typeof p.readyState == f && (p.getElementsByTagName("body")[0] || p.body)) && s(), z || (typeof p.addEventListener != f && p.addEventListener("DOMContentLoaded", s, !1), r.ie && r.win && (p.attachEvent("onreadystatechange", function () {
        "complete" == p.readyState && (p.detachEvent("onreadystatechange", arguments.callee), s())
    }), t == top && function () {
        if (!z) {
            try {
                p.documentElement.doScroll("left")
            } catch (a) {
                setTimeout(arguments.callee,
                    0);
                return
            }
            s()
        }
    }()), r.wk && function () {
        z || (/loaded|complete/.test(p.readyState) ? s() : setTimeout(arguments.callee, 0))
    }(), m(s)));
    r.ie && r.win && window.attachEvent("onunload", function () {
        for (var a = O.length, b = 0; b < a; b++)O[b][0].detachEvent(O[b][1], O[b][2]);
        a = n.length;
        for (b = 0; b < a; b++)S(n[b]);
        for (var c in r)r[c] = null;
        r = null;
        if (window.AmazingSWFObject) {
            for (var d in window.AmazingSWFObject)window.AmazingSWFObject[d] = null;
            window.AmazingSWFObject = null
        }
    });
    return {
        registerObject: function (a, b, c, e) {
            if (r.w3 && a && b) {
                var f =
                {};
                f.id = a;
                f.swfVersion = b;
                f.expressInstall = c;
                f.callbackFn = e;
                I[I.length] = f;
                d(a, !1)
            } else e && e({success: !1, id: a})
        }, getObjectById: function (a) {
            if (r.w3)return x(a)
        }, embedSWF: function (b, c, e, g, j, k, l, m, n, p) {
            var t = {success: !1, id: c};
            r.w3 && !(r.wk && 312 > r.wk) && b && c && e && g && j ? (d(c, !1), w(function () {
                e += "";
                g += "";
                var r = {};
                if (n && typeof n === h)for (var s in n)r[s] = n[s];
                r.data = b;
                r.width = e;
                r.height = g;
                s = {};
                if (m && typeof m === h)for (var u in m)s[u] = m[u];
                if (l && typeof l === h)for (var v in l)s.flashvars = typeof s.flashvars != f ? s.flashvars +
                ("&" + v + "=" + l[v]) : v + "=" + l[v];
                if (a(j))u = G(r, s, c), r.id == c && d(c, !0), t.success = !0, t.ref = u; else {
                    if (k && q()) {
                        r.data = k;
                        B(r, s, c, p);
                        return
                    }
                    d(c, !0)
                }
                p && p(t)
            })) : p && p(t)
        }, switchOffAutoHideShow: function () {
            C = !1
        }, ua: r, getFlashPlayerVersion: function () {
            return {major: r.pv[0], minor: r.pv[1], release: r.pv[2]}
        }, hasFlashPlayerVersion: a, createSWF: function (a, b, c) {
            if (r.w3)return G(a, b, c)
        }, showExpressInstall: function (a, b, c, d) {
            r.w3 && q() && B(a, b, c, d)
        }, removeSWF: function (a) {
            r.w3 && S(a)
        }, createCSS: function (a, b, d, e) {
            r.w3 && c(a, b, d, e)
        },
        addDomLoadEvent: w, addLoadEvent: m, getQueryParamValue: function (a) {
            var b = p.location.search || p.location.hash;
            if (b) {
                /\?/.test(b) && (b = b.split("?")[1]);
                if (null == a)return k(b);
                for (var b = b.split("&"), c = 0; c < b.length; c++)if (b[c].substring(0, b[c].indexOf("=")) == a)return k(b[c].substring(b[c].indexOf("=") + 1))
            }
            return ""
        }, expressInstallCallback: function () {
            if (D) {
                var a = e(g);
                a && P && (a.parentNode.replaceChild(P, a), J && (d(J, !0), r.ie && r.win && (P.style.display = "block")), u && u(Q));
                D = !1
            }
        }
    }
}
var html5GalleryObjects = new function () {
    this.objects = [];
    this.addObject = function (s) {
        this.objects.push(s)
    };
    this.loadNext = function (s) {
        this.objects[s].onVideoEnd();
        this.objects[s].isPaused || this.objects[s].slideRun(-1)
    };
    this.setHd = function (s, w, m) {
        this.objects[s].setHd(w, m)
    };
    this.gotoSlide = function (s, w) {
        "undefined" === typeof w && (w = 0);
        this.objects[w] && this.objects[w].slideRun(s)
    }
};
if ("undefined" === typeof ASYouTubeIframeAPIReady)var ASYouTubeIframeAPIReady = !1, ASYouTubeTimeout = 0, onYouTubeIframeAPIReady = function () {
    ASYouTubeIframeAPIReady = !0
};
var ASVimeoTimeout = 0;
