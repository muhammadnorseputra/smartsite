/*
how to use : 
	<script type="text/javascript" src="https://web.bkppd-balangankab.info/assets/gpr/gpr_bkppdblg_dev.js"></script>
	<div id="widget-gpr-bkppdblg"></div>
*/
(function() {

// Localize jQuery variable
var jQuery;
var GPR_url = 'https://web.bkppd-balangankab.info/';
// var GPR_url = 'http://localhost/smartsite/';

/******** Load jQuery if not present *********/
if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.12.4') {

    var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src","//code.jquery.com/jquery-1.12.4.js");
	
    if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
              scriptLoadHandler();
          }
      };
    } else { // Other browsers
      script_tag.onload = scriptLoadHandler;
    }
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);	
} else {
    // The jQuery version on the window is the one we want to use
    jQuery = window.jQuery;
    main();
}

/******** Called once jQuery has loaded ******/
function scriptLoadHandler() {
    // Restore $ and window.jQuery to their previous values and store the
    // new jQuery in our local jQuery variable
    jQuery = window.jQuery.noConflict(true);
    // Call our main function
    main(); 
}

/******** Our main function ********/
function main() { 
	// Init Load
	jQuery('#widget-gpr-bkppdblg').html(`<div class="sk-cube-grid">
																			  <div class="sk-cube sk-cube1"></div>
																			  <div class="sk-cube sk-cube2"></div>
																			  <div class="sk-cube sk-cube3"></div>
																			  <div class="sk-cube sk-cube4"></div>
																			  <div class="sk-cube sk-cube5"></div>
																			  <div class="sk-cube sk-cube6"></div>
																			  <div class="sk-cube sk-cube7"></div>
																			  <div class="sk-cube sk-cube8"></div>
																			  <div class="sk-cube sk-cube9"></div>
																			</div>`);
  jQuery(document).ready(function($) {
		var css_link = $("<link>", { 
			rel: "stylesheet",
			type: "text/css",
			href: GPR_url + "assets/gpr/gpr_bkppdblg_dev.css"
		});
		css_link.appendTo('head');
		jQuery.getJSON(`${GPR_url}/frontend/v1/api/silka_get_grap/asn`, function(response) {
			return $asn = response;
		});
		jQuery.getJSON(`${GPR_url}/frontend/v1/api/silka_get_grap/pns`, function(response) {
			return $pns = response;
		});
		jQuery.getJSON(`${GPR_url}/frontend/v1/api/silka_get_grap/nonpns`, function(response){
			return $nonpns = response;
		});

		//load 
    var jsonp_url = GPR_url + "frontend/v1/apiPublic/gpr";
	  jQuery.getJSON(jsonp_url, function(data) {
		
		var myhtml='<div class="gpr_bkppdblg">';
				myhtml+='<div class="gpr_panel_head">';
					myhtml+='<div class="gpr_panel_head_left">';
						myhtml+='<img class="gpr_panel_head_img" src="'+GPR_url+'/assets/images/logo.png">';
					myhtml+='</div>';
					myhtml+='<div class="gpr_panel_head_right">';
						myhtml+='<div class="gpr_panel_title">';
							myhtml+='<div class="gpr_panel_title_main"><strong>GPR</strong> - BKPPD BLG </div>';
							myhtml+='<div class="gpr_panel_title_sub"><em>Government Public Relations</em></div>';
							myhtml+='<div class="gpr_panel_title_url"><a  rel="nofollow" href="https://web.bkppd-balangankab.info/beranda" target="_blank">https://web.bkppd-balangankab.info/</a></div>';
						myhtml+='</div>';
					myhtml+='</div>';			
				myhtml+='</div>';
			myhtml+='<div class="gpr_panel_silka">'; 
									myhtml+='<div><h3>'+$asn+'</h3>ASN</div>';
									myhtml+='<div><h3>'+$pns+'</h3>PNS + CPNS</div>';
									myhtml+='<div><h3>'+$nonpns+'</h3>NON PNS</div>';
			myhtml+='</div>';
			myhtml+='<ul class="gpr_list">';
			jQuery.each(data, function(k, v) {
				myhtml+='<li class="gpr_item">';
					myhtml+='<div class="gpr_panel_left">';
						myhtml+='<img class="gpr_panel_img" src="'+v.img_article+'">';
					myhtml+='</div>';
					myhtml+='<div class="gpr_panel_right">';
						//myhtml+='<div class="gpr_panel_news_attr">';
							//diindonesiakan ?
							myhtml+='<div class="gpr_tgl">'+v.tgl_posting_article+' &bull; '+v.user_posting.user_nama+'</div>';
							// myhtml+='<div class="gpr_kategori">Berita Terbaru</div>';
						//myhtml+='</div>';
						myhtml+='<br />';
						
						myhtml+='<a class="gpr_panel_news_title" href="'+v.url_article+'" target="_blank">';
							myhtml+=v.jdl_article;
						myhtml+='</a>';
						
					myhtml+='</div>';
				myhtml+='</li>';
			});
			myhtml+='</ul>';
			myhtml+='<div class="gpr_footer">';
				myhtml+='<a rel="nofollow" href="https://web.bkppd-balangankab.info/beranda?type=all&sort=newest" target="_blank">More +</a>';
			myhtml+='</div>';
		myhtml+='</div>';
			
			jQuery('#widget-gpr-bkppdblg').html(myhtml);
			
    });

	});
}

})(); // We call our anonymous function immediately
