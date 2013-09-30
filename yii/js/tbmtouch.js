(function (b) {

    b.fn.slideLayer = function (c) {
        var d = { direction: "X", wrapEl: ".wrap", slideEl: ".holder", childEl: "li", prev: ".prev", next: ".next", disable: "disabled", counter: ".counter", countStyle: "dot", effect: "both", current: 1, timer: 300, autoplay: 1, cycle: 1 }; if (c) { b.extend(d, c) } return b(this).each(function () {
            var q = b(this); var l = d.current; var u = 0, r = 0, h = 0, v = 0; var x = Math.ceil(q.find(d.childEl).length); var n = q.find(d.childEl); var o = q.find(d.slideEl); h = q.find(d.wrapEl).width(); v = q.find(d.wrapEl).height(); if (d.direction == "X") { for (var w = 0; w < n.size(); w++) { u += n.eq(w).width() } o.width(u) } else { for (var w = 0; w < n.size(); w++) { r += n.eq(w).height() } o.height(r) } if (d.direction == "X") { q.find(d.slideEl).css("left", -(h * (l - 1))) } else { q.find(d.slideEl).css("top", -(v * (l - 1))) } j(); switch (d.effect) { case "slide": e(); break; case "scroll": g(); break; case "both": e(); g() } function g() {
                if (d.direction == "X") { var A = -u + h } else { var A = -r + v } var y = 0; o[0].onmousedown = o[0].ontouchstart = z; function z(G) {
                    var F, D, C; if (d.autoplay == 1) { k.process() } var I = [o.position().left, o.position().top]; F = B(G); o[0].ontouchmove = o[0].onmousemove = E; function E(L) {
                        D = B(L); if (d.direction == "X") {
                            var J = (D[0] - F[0]) + I[0]; if (Math.abs(D[0] - F[0]) - Math.abs(D[1] - F[1]) > 0) {
                                L.preventDefault(); K(); o[0].ontouchend = document.onmouseup = H
                            } else {
                                return
                            }
                        } else {
                            var J = (D[1] - F[1]) + I[1];
                            L.preventDefault();
                            K();
                            o[0].ontouchend = document.onmouseup = H
                        } function K() { if (J <= y && J >= A) { if (d.direction == "X") { o[0].style.left = J + "px" } else { o[0].style.top = J + "px" } } else { } }
                    } function H(L) {
                        var M, J, K = B(L);
                        if (d.autoplay == 1) { k.process() } if (d.direction == "X") {
                            M = K[0] - F[0];
                    N(L) } else { M = K[1] - F[1]; N(L) } function N(O) { if (M < -5) { f.process(m) } else { if (M > 5) { f.process(p) } } } j(); o[0].ontouchmove = o[0].ontouchend = o[0].onmousemove = document.onmouseup = null }
                } function B(D) {
                    var C = new Array(); C[0] = D.changedTouches ? D.changedTouches[0].clientX : D.clientX;
                C[1] = D.changedTouches ? D.changedTouches[0].clientY : D.clientY; return C } 
            } var p = function () {
                if (d.autoplay == 1) { k.process() } if (d.cycle == 1) {
                    if (l != 1) { s(); return false } else {
                        s(); n.eq(x - 1).css("left", -(h * x));
                        n.eq(0).css("left", 0);
                        return false
                    } 
                } else {
                    if (l != 1) {
                        s();
                        return false
                    } 
                } 
            };
            var m = function () {
                if (d.autoplay == 1) { k.process() } if (d.cycle == 1) {
                    if (l != x) {
                        t();
                        return false
                    } else {
                        t(); n.eq(0).css("left", h * x);
                        q.find(d.wrapEl).css("left", 0); return false
                    } 
                } else { if (l != x) { t(); return false } } 
            };
            var f = { timerid: null, action: function (y) { y() }, process: function (y) { clearTimeout(f.timerid); f.timerid = setTimeout(function () { f.action(y) }, d.timer) } };
            function e() {
                q.find(d.prev).click(function (y) {
                    if (d.cycle == 1) { f.process(p) } else {
                        if (l != 1) {
                            f.process(p)
                        }
                    }
                  });
                q.find(d.next).click(function (y) {
                    if (d.cycle == 1) {
                        f.process(m)
                    } else {
                        if (l != x) {
                            f.process(m)
                        }
                    }
                })
            }
            function s() {
                if (d.direction == "X") {
                    h = q.find(d.wrapEl).width();
                    q.find(d.slideEl).animate({ left: -(h * (l - 2)) }, d.timer, function () {
                        j();
                        q.find(d.wrapEl).find("ul").css("left", -(h * (l - 1)));
                        n.eq(x - 1).css("left", 0)
                    })
                } else {
                    q.find(d.slideEl).animate({ top: -(v * (l - 2)) }, d.timer, function () { })
                } l == 1 ? l = x : l--
            } function t() {
                if (d.direction == "X") {
                    h = q.find(d.wrapEl).width(); q.find(d.slideEl).animate({ left: -(h * l) }, d.timer, function () {
                        j();
                        q.find(d.wrapEl).find("ul").css("left", -(h * (l - 1)));
                        n.eq(0).css("left", 0)
                    })
                } else {
                    q.find(d.slideEl).animate({ top: -(v * l) }, d.timer)
                } l == x ? l = 1 : l++
            }
            function j() {
                var A = "", y = q.find(d.counter);
                if (y.length > 0) {
                    if (d.countStyle == "dot") {
                        var z = 0; for (z = 1; z <= x; z++) { A += "<li>" + z + "</li>" } y.find("ul").html(A);
                        y.find("li").eq(l - 1).addClass("cur").siblings().removeClass("cur")
                    } else {
                        A = '<span class="cur">' + l + '</span> / <span class="total">' + x + "</span>";
                        y.html(A)
                    } n.eq(l - 1).addClass("cur").siblings().removeClass("cur")
                } if (d.cycle != 1) {
                    var C = q.find(d.prev), B = q.find(d.next);
                    C.removeClass(d.disable);
                    B.removeClass(d.disable);
                    if (l == 1) { C.addClass(d.disable) } else { if (l == x) { B.addClass(d.disable) } } 
                } 
            }
            var k = { timeoutId: null, performProcessing: function () { m() }, process: function () {
                clearInterval(k.timeoutId);
                k.timeoutId = setInterval(function () { k.performProcessing() }, 5000)
            }, dispose: function () {
                clearInterval(k.timeoutId);
                return 
            }
                    };
            if (d.autoplay == 1) {
                k.process()
            }
        })
    }

})(jQuery);