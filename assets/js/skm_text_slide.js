window.onload = function() {
    function m() {
        setTimeout(function() {
            e.innerHTML = data[tx_conf.stayIn].text, f.innerHTML = ""
        }, tx_conf.timer + 300), clearInterval(l)
    }

    function n() {
        clearInterval(l)
    }
    var b = (document.getElementById("tx").childNodes, document.getElementById("tx")),
        c = document.createElement("DIV");
    c.setAttribute("id", "tx_slide_main"), b.appendChild(c);
    var d = document.createElement("DIV");
    d.setAttribute("id", "second"), b.appendChild(d);
    var i, e = document.getElementById("tx_slide_main"),
        f = document.getElementById("second"),
        g = 0,
        h = data.length;
    if ("effect" in tx_conf || (tx_conf.effect = "down"), "dir" in tx_conf && (document.getElementById("tx").style.direction = "rtl"), "timer" in tx_conf && (tx_conf.timer = 4), "infinit" in tx_conf && "stayIn" in tx_conf) throw "Tx_slide error: you cann't use (infinit) and (stayIn) togheter";
    tx_conf.timer *= 1e3, "down" == tx_conf.effect && (i = "#tx_slide2 {opacity: .7;transition: 1s; -webkit-transition: 1s; margin-top: 20px; color: darkturquoise}"), "press" == tx_conf.effect && (i = "#tx_slide2 {opacity: .7;transition: 1s; -webkit-transition: 1s; letter-spacing:-7px; color: darkturquoise}"), "flash" == tx_conf.effect && (i = " #tx_slide2 {opacity: .7;transition: .1s; -webkit-transition: .1s; -webkit-transform: skewX(360deg);color: darkturquoise}"), "left" == tx_conf.effect && (i = " #tx_slide2 {opacity: .7;transition: .1s; -webkit-transition: .1s; -webkit-transform: translateX(-400px); -ms-transform: translateX(-400px); transform: translateX(-400px);color: darkturquoise}"), "top" == tx_conf.effect && (i = " #tx_slide2 {opacity: .7;transition: .1s;-webkit-transform: translate(20px,-100px); -ms-transform: translate(20px,-100px); transform: translate(20px,-100px);color: darkturquoise}"), "rotate" == tx_conf.effect && (i = " #tx_slide2 {opacity: .7;transition: 1s;  -webkit-transform:rotateX(290deg); transform:rotateX(290deg);color: darkturquoise}"), "rotate2" == tx_conf.effect && (i = " #tx_slide2 {opacity: .7; -webkit-transform:rotateY(280deg); transition: .7s;transform:rotateY(280deg);color: darkturquoise}"), i += "#tx div {color: black;text-decoration: none;display: block;position: absolute;} #tx_slide3 {opacity: .4s; webkit-transition: 1s; transition: 1s;margin-top: 0px;}";
    var j = document.head || document.getElementsByTagName("head")[0],
        k = document.createElement("style");
    k.type = "text/css", k.styleSheet ? k.styleSheet.cssText = i : k.appendChild(document.createTextNode(i)), j.appendChild(k), f.innerHTML = data[0].text, f.setAttribute("id", "tx_slide3"), setTimeout(function() {
        f.setAttribute("id", "tx_slide2")
    }, 84 * tx_conf.timer / 100);
    var l = setInterval(function() {
        g += 1, f.innerHTML = data[g].text, f.setAttribute("id", "tx_slide3"), f.style.color = data[0].color, g == h - 1 ? tx_conf.infinit || tx_conf.stayIn || n() : setTimeout(function() {
            f.setAttribute("id", "tx_slide2")
        }, 83 * tx_conf.timer / 100), g == h - 1 && (1 == tx_conf.infinit ? (g = -1, setTimeout(function() {
            f.innerHTML = data[0].text
        }, tx_conf.timer)) : tx_conf.stayIn && m())
    }, tx_conf.timer)
};

var data = [{
    text: "Assalamualaikum Wr. Wb..."
}, {
    text: "Terimakasih atas partisipasi pian barataan."
}, {
    text: "Mudahan hasil IKM ini menjadikan unit pelayanan kami menjadi lebih baik."
}, {
    text: "Umpati tarus tiap periode penilaian"
}, {
    text: "Mudahan kita sabarataan dalam keadaan sehat"
}, {
    text: "Terimakasih!"
}];

var tx_conf = {
    infinit: true,
    effect: "press",
    timer: 3
        //dir : "rtl"
        //stayIn: 1
}