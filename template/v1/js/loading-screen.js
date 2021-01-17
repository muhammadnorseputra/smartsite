document.onreadystatechange = function() { 
    if (document.readyState !== "complete") { 
        document.querySelector( 
          "html").style.visibility = "hidden"; 
        document.querySelector( 
          "#loader").style.visibility = "visible"; 
    } else { 
        document.querySelector( 
          "#loader").style.display = "none"; 
        document.querySelector( 
          "html").style.visibility = "visible"; 
    } 
}; 