document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        // document.querySelector("html").style.visibility = "hidden";
        document.querySelector(".page-slider").style.visibility = "visible";
    } else {
        document.querySelector(".page-slider").style.visibility = "hidden";
        // document.querySelector("html").style.visibility = "visible";
    }
};