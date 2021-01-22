document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        document.querySelector(
            "html").style.visibility = "hidden";
        document.querySelector(
            ".slider").style.visibility = "visible";
    } else {
        document.querySelector(
            ".slider").style.visibility = "hidden";
        document.querySelector(
            "html").style.visibility = "visible";
    }
};