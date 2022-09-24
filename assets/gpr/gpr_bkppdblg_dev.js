/*
how to use : 
	<script type="text/javascript" src="https://web.bkppd-balangankab.info/assets/gpr/gpr_bkppdblg_dev.js"></script>
	<div id="widget-gpr-bkppdblg"></div>
*/
(function() {

// Localize jQuery variable
var jQuery;
var GPR_url = 'https://bkpsdm.balangankab.go.id/';
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
	jQuery.fn.hasAttr = function(name) {  
	   return this.attr(name) !== undefined;
	};
	// Modifikasi
	var container = jQuery('#widget-gpr-bkppdblg');
	if(container.hasAttr('gpr-theme') && container.attr('gpr-theme') != '') {container.attr('gpr-theme');} else {container.attr('gpr-theme', '#01877c');}
	if(container.hasAttr('gpr-height') && container.attr('gpr-height') != '') {container.attr('gpr-height');} else {container.attr('gpr-height', '500');}
	if(container.hasAttr('gpr-thumb') && container.attr('gpr-thumb') != '') {container.attr('gpr-thumb');} else {container.attr('gpr-thumb', 'default');}
	var theme =  container.attr('gpr-theme');
	var thumb =  container.attr('gpr-thumb');
	var maxHeight =  container.attr('gpr-height');

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
																			</div>`).css('background-color', theme);
  jQuery(document).ready(function($) {
  	
		var css_link = $("<link>", { 
			rel: "stylesheet",
			type: "text/css",
			href: GPR_url + "assets/gpr/gpr_bkppdblg_dev.css"
		});
		css_link.appendTo('head');
		//JSONP API 
		var jsonp_silka = GPR_url + 'frontend/v1/apiPublic/silka_jsonp';
    var jsonp_url = GPR_url + "frontend/v1/apiPublic/gpr";
    var $grap_silka = localStorage.getItem("result_silka");
    $.ajax({
        url: jsonp_url, 
        dataType: 'jsonp',
        jsonpCallback: 'grp_article',
        beforeSend: function() {
        	if($grap_silka === null) {
						$.get(jsonp_silka, function(response) {
							localStorage.setItem("result_silka", JSON.stringify(response));
						}, 'jsonp');
        	}
        },
        success: function(data) {
        var $asn = JSON.parse(localStorage.getItem("result_silka"));
        var $jml_asn = $grap_silka !== null ? $asn.jml_asn : '-';
        var $jml_pns = $grap_silka !== null ? $asn.jml_pns : '-';
        var $jml_nonpns = $grap_silka !== null ? $asn.jml_nonpns : '-';
				var myhtml='<div class="gpr_bkppdblg">';
								myhtml+='<div class="gpr_panel_head" style="background-color:'+theme+';">';
									myhtml+='<div class="gpr_panel_head_left">';
										myhtml+='<img class="gpr_panel_head_img" src="'+GPR_url+'/assets/images/logo.png"  style="background-color:'+theme+';">';
									myhtml+='</div>';
									myhtml+='<div class="gpr_panel_head_right">';
										myhtml+='<div class="gpr_panel_title">';
											myhtml+='<div class="gpr_panel_title_main"><strong>GPR</strong> - BKPSDM BLG </div>';
											myhtml+='<div class="gpr_panel_title_sub"><em>Government Public Relations</em></div>';
											myhtml+='<div class="gpr_panel_title_url"><a  rel="nofollow" href="https://bkpsdm.balangankab.go.id/beranda" target="_blank">bkpsdm.balangnakab.go.id</a></div>';
										myhtml+='</div>';
									myhtml+='</div>';			
								myhtml+='</div>';
								myhtml+='<div class="gpr_panel_silka">'; 
														myhtml+='<div><h3 class="gpr_panel_title_silka">'+$jml_asn+'</h3>ASN</div>';
														myhtml+='<div><h3 class="gpr_panel_title_silka">'+$jml_pns+'</h3>PNS + CPNS</div>';
														myhtml+='<div><h3 class="gpr_panel_title_silka">'+$jml_nonpns+'</h3>NON PNS</div>';
								myhtml+='</div>';
							myhtml+='<ul class="gpr_list" style="max-height:'+maxHeight+'px;">';
							var number = 1;
							jQuery.each(data, function(k, v) {
								myhtml+='<li class="gpr_item">';
									if(thumb != 'default'){
										myhtml+='<div class="gpr_panel_left">';
											if(thumb == 'image'){
												myhtml+='<img class="gpr_panel_img" src="'+v.img_article+'" style="background-color:'+theme+';">';
											}else if(thumb == 'icon') {
												myhtml+='<img class="gpr_panel_img" src="'+GPR_url+'assets/images/fitur/newspaper.svg">';
											} else {
												myhtml+='<div class="gpr_panel_number" style="color:'+theme+';"><span>'+number+'</span></div>';
											}
										myhtml+='</div>';
									}
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
								number++;
							});
							myhtml+='</ul>';
							myhtml+='<div class="gpr_footer" style="background-color:'+theme+';">';
								myhtml+='<span>&copy; BKPSDM Balangan</span>';
								myhtml+='<div>&bull; <a rel="nofollow" href="https://bkpsdm.balangankab.go.id/widget-gpr-bkppdblg" target="_blank">Pasang Widget</a><div>';
							myhtml+='</div>';
						myhtml+='</div>';
						jQuery('#widget-gpr-bkppdblg').html(myhtml).css('background-color', theme);          
        },
         error: function(xhr, status, msg) {
          console.log('Status: ' + status + "\n" + msg);
        }
      })
	});
}
})(); // We call our anonymous function immediately
