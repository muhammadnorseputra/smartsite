"use strict";function like_toggle(t){t.classList.toggle("btn-like");var e=$(t).find("span.count_like").text(),a=parseInt(e)+1,n=parseInt(e)-1,o=$(t).attr("data-id-user"),i=$(t).attr("data-id-berita");0!=o?t.classList.contains("btn-like")?($(t).find("i").removeClass("far").addClass("fas text-danger"),$.post(_uri+"/frontend/v1/beranda/likes?type=like",{id_a:o,id_b:i,likes:a},function(e){1==e&&(notif({msg:'Postingan Disukai <i class="fas fa-thumbs-up ml-2"></i>',type:"success",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300}),$(t).find("span.count_like").text(a))},"json")):($(t).find("i").removeClass("fas text-danger").addClass("far"),$.post(_uri+"/frontend/v1/beranda/likes?type=dislike",{id_a:o,id_b:i,likes:n},function(e){1==e&&(notif({msg:'Postingan Tidak Disukai <i class="fas fa-thumbs-down ml-2"></i>',type:"error",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300}),$(t).find("span.count_like").text(n))},"json")):$("#noticeSigin").modal("show").modal("handleUpdate")}function bookmark_toggle(t){t.classList.toggle("btn-bookmark");var e=$(t).attr("data-id-user"),a=$(t).attr("data-id-berita");0!=e?t.classList.contains("btn-bookmark")?($(t).find("i").removeClass("far").addClass("fas text-primary"),$.post(_uri+"/frontend/v1/beranda/bookmark?type=on",{id_a:e,id_b:a,post:"on"},function(t){1==t&&notif({msg:'Postingan Disimpan  <i class="fas fa-check-circle ml-2"></i>',type:"success",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300})},"json")):($(t).find("i").removeClass("fas text-primary").addClass("far"),$.post(_uri+"/frontend/v1/beranda/bookmark?type=off",{id_a:e,id_b:a,post:"off"},function(t){1==t&&notif({msg:"Postingan Tidak Disimpan",type:"warning",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300})},"json")):$("#noticeSigin").modal("show").modal("handleUpdate")}function modeBaca(t){t.classList.toggle("btn-dark"),t.classList.contains("btn-dark")?Focusable.setFocus($(".card-post"),{fadeDuration:700,hideOnClick:!1,hideOnESC:!1,findOnResize:!0}):Focusable.hide()}function batal(){$(".emojionearea-editor").html(""),$(".emojionearea-editor").removeClass("is-invalid").addClass("is-valid"),$(".reply_username").attr("id","").html("")}$(function(){var t=0,e="inactive";if("beranda"==($host?_uriSegment[2]:_uriSegment[1])){var a=function(){$("#load_data_message").html('<div class="card border-0 bg-transparent shadow-none mb-5">\n                        <div class="card-body text-danger text-center">\n                        <img src="'.concat(_uri,'/template/v1/img/humaaans-3.png" alt="croods" class="img-fluid rounded">\n                            <h5 class="card-title">Data Tidak Ditemukan</h5>  \n                            <p class="font-weight-light text-secondary"> Berita telah berakhir.</p>\n                        </div>\n                    </div>'))},n=function(t){for(var e="",a=0;a<1;a++)e+='\n                \n                <div class ="content-placeholder" style="width:30%; height: 14px; border-radius:50px;"> &nbsp; </div>\n                <br>\n                <div class ="content-placeholder" style="width:60%; height: 14px; border-radius:50px; margin-bottom: 10px"> &nbsp; </div>\n                <div class ="content-placeholder" style="width:80%; height: 14px; border-radius:50px;"> &nbsp; </div>\n            \n            ';$("#load_data_message").html(e),$("button#load_more").html('<div class="d-flex justify-content-center align-items-center">\n        <div class="loader_small" style="width:20px; height: 20px;"></div>\n      </div> ').prop("disabled",!0)},o=function(t,n){$.ajax({url:_uri+"/frontend/v1/beranda/get_all_berita",method:"POST",headers:{"X-Requested-With":"XMLHttpRequest"},data:{limit:t,start:n,type:urlParams.get("type"),sort:urlParams.get("sort")},cache:!0,dataType:"json",success:function(n){""==n.html?(a(),$("button#load_more").hide(),e="active"):(n.count<t?($("button#load_more").hide(),a()):$("#load_data_message").html(""),$("#load_data").append(n.html),$("button#load_more").html('<i class="fas fa-newspaper mr-2"></i> Berita Lainnya').prop("disabled",!1),e="inactive",$(".lazy").lazy({effect:"fadeIn",effectTime:250,threshold:1e3,enableThrottle:!0,combined:!0,delay:250,throttle:550,onFinishedAll:function(){this.config("autoDestroy")||this.destroy()},onError:function(t){t.data("src");t.attr("src","".concat(_uri,"/assets/images/noimage.gif"))}}),$(".rippler").rippler({effectClass:"rippler-effect"}),$('[data-toggle="tooltip"]').tooltip({delay:150,offset:"0, 12px",padding:15}))},error:function(t){alert("Error dalam meload berita, created_by tidak ditemukan.")}})};n(),"inactive"==e&&(e="active",o(8,t)),$("button#load_more").on("click",function(a){a.preventDefault(),$(window).scrollTop()+$(window).height()>$("#load_data").height()&&"inactive"==e&&(e="active",t+=8,n(),o(8,t))})}else console.log("Semua berita tidak ditampilkan, karna bukan halaman beranda")}),$(document).ready(function(){var t=$(".btn-backtop");t.hide(),$(window).on("scroll loaded",function(){$(this).scrollTop()>120?t.fadeIn():t.fadeOut()}),t.on("click",function(t){$("html, body").animate({scrollTop:0},300)})}),$(document).ready(function(){$(document).on("click","#btn-share",function(){var t=$(this).attr("data-row-id");$.confirm({title:!1,content:"url:"+_uri+"/frontend/v1/beranda/share_artikel/"+t,columnClass:"medium",theme:"supervan",bgOpacity:.9,animateFromElement:!0,animationSpeed:800,buttons:!1,backgroundDismiss:!0,animation:"none",closeAnimation:"none"})})}),$(".collapsible-link").click(function(){$(this).find("i").toggleClass("fas fa-folder fas fa-folder-open"),$(this).find("i").toggleClass("text-white text-warning")}),$(document).ready(function(){var t=$("#exampleFormControlTextarea1").emojioneArea({pickerPosition:"top",tonesStyle:"bullet",placeholder:"Masukan komentar kamu disini.",search:!0,filtersPosition:"top",recentEmojis:!0}),e=$("#tracking").attr("data-postid"),a="blog"==_uriSegment[1],n="blog"==_uriSegment[2];function o(){$.getJSON("".concat(_uri,"/frontend/v1/post/displayKomentar/").concat(e),function(t){$(".tracking-list").html(t)})}($host?n:a)?o():console.log("Komentar tidak ditampilkan dikarnakan anda belum login atau bukan halaman detail berita"),$(".tracking-list").html(' \n            <div class="d-flex justify-content-center align-items-center p-3 text-light">\n            <h3>Memuat Komentar ...</h3>\n        </div>\n    '),$(document).on("click","#btn-reply-comment",function(){$(this).attr("data-id-parent"),$(this).attr("data-id-berita"),$(this).attr("data-id-user-comment");var t=$(this).attr("data-username"),e=$(this).attr("data-id-comment");$(".reply_username").attr("id","".concat(e)).attr("username","@".concat(t.trim().toLowerCase())).html('Reply <span class="text-info">@'.concat(t.trim().toLowerCase(),'</span> <button onclick="batal()" class="btn btn-sm text-danger btn-default">x</button>')),$(".emojionearea-editor").html("@".concat(t.trim().toLowerCase())).focus()}),$(document).on("click","#btn-delete-comment",function(){var t=$(this).attr("data-id");$.getJSON(_uri+"/frontend/v1/post/deleteComment",{id:t},function(t){1==t&&(o(),notif({msg:'Komentar dihapus <i class="fas fa-trash ml-3"></input>',type:"info",position:"bottom"}))})}),$(document).on("submit","form#f_komentar",function(e){e.preventDefault();var a=$(this),n=(a.attr("method"),a.attr("action")),i=a.attr("class"),s=$(".reply_username").attr("id"),r=($(".reply_username").attr("username"),t[0].emojioneArea.getText()),l=a.find('input[name="xtoken"]').val();""!=r?$.post(n,{id_b:i,id_c:s,isi:r,xtoken:l},function(t){1==t&&(batal(),o())},"json"):$(".emojionearea-editor").addClass("is-invalid").focus()})});var CONTAINER=$("#countpeg_container"),URL="http://36.91.72.99";function Loading(t){if(t)return'<div class="col-6 col-md-3 p-2">\n                <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>\n                <span class="content-placeholder my-1" style="width: 100%; height: 60px;"></span>\n                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>\n            </div>\n            <div class="col-6 col-md-3 p-2">\n                <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>\n                <span class="content-placeholder my-1" style="width: 100%; height: 60px;"></span>\n                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>\n            </div>\n            <div class="col-6 col-md-3 p-2">\n                <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>\n                <span class="content-placeholder my-1" style="width: 100%; height: 60px;"></span>\n                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>\n            </div>\n            <div class="col-6 col-md-3 p-2">\n                <span class="content-placeholder rounded-circle mx-auto d-block" style="width:65px; height: 65px;">&nbsp;</span>\n                <span class="content-placeholder my-1" style="width: 100%; height: 60px;"></span>\n                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>\n            </div>'}function showLocation(t){var e=_uri,a=t.coords.latitude,n=t.coords.longitude;$.ajax({type:"POST",url:"".concat(e,"/frontend/v1/beranda/update_location_visitor"),data:{latitude:a,longitude:n},dataType:"json",success:function(t){t.status?console.log("Location :",t.pesan):console.log("Not Available")}})}CONTAINER.html(Loading(!0)),$.post("".concat(URL,"/services/statistik?callback=?"),{apiKey:"bkpsdm6811"}).done(function(t){Loading(!1),CONTAINER.html('\n      <div class="col-6 col-sm-6 col-md-3 rounded-left">\n          <div class="card bg-transparent border-0 rounded">\n              <div class="card-body text-center">\n                  <i class="fas fa-users pb-md-4 rounded fa-3x text-info"></i>\n                  <h1 id="count_jml" class="font-weight-bold" data-speed="3000">'.concat(t.asn,'</h1>\n                  <b class="text-secondary small">Jumlah ASN Kab. Balangan</b>\n              </div>\n          </div>\n      </div>\n      <div class="col-6 col-sm-6 col-md-3">\n          <div class="card bg-transparent border-0 rounded">\n              <div class="card-body text-center">\n                  <i class="fas fa-user-tie pb-md-4 fa-3x mx-auto text-success rounded"></i>\n                  <h1 id="count_jml" data-speed="3000" class="font-weight-bold">').concat(t.pns,'</h1>\n                  <b class="text-secondary small">Jumlah PNS + CPNS</b>\n              </div>\n          </div>\n      </div>\n      <div class="col-6 col-sm-6 col-md-3 rounded-right">\n          <div class="card bg-transparent rounded border-0">\n              <div class="card-body text-center">\n                  <i class="far pb-md-4 fa-user-circle fa-3x mx-auto text-warning rounded"></i>\n                  <h1 id="count_jml" data-speed="3000" class="font-weight-bold">').concat(t.nonpns,'</h1>\n                  <b class="text-secondary small">Jumlah NON PNS (Pendataan thn. 2018)</b>\n              </div>\n          </div>\n      </div>\n      <div class="col-6 col-sm-6 col-md-3 rounded-right">\n          <div class="card bg-transparent rounded border-0">\n              <div class="card-body text-center">\n                  <i class="fas pb-md-4 fa-home fa-3x mx-auto text-secondary rounded"></i>\n                  <h1 id="count_jml" data-speed="3000" class="font-weight-bold">').concat(t.pensiun,'</h1>\n                  <b class="text-secondary small">Jumlah PNS Pensiun</b>\n              </div>\n          </div>\n      </div>\n      '))},"jsonp").fail(function(t,e,a){var n=e+", "+a;console.log("Request Failed: "+n),Loading(!1),CONTAINER.html("")}),$(document).ready(function(){$(".controler-ticker").easyTicker({direction:"up",easing:"swing",speed:"slow",interval:2e3,height:"250px",visible:3,mousePause:!0,controls:{up:".btn-up",down:".btn-down",toggle:".btn-toggle",playText:'<i class="fas fa-play-circle"></i>',stopText:'<i class="fas fa-pause-circle"></i>'},callbacks:{before:!1,after:!1}})}),$(document).ready(function(){$.cookie("notice-geolocation")||(navigator.geolocation.getCurrentPosition(function(t){showLocation(t)},function(t){console.log("Geolocation tidak mendukung pada browser anda saat ini !")},{enableHighAccuracy:!0}),$.cookie("notice-geolocation",1,{expires:60/1440,path:"/"}))}),$(function(){var t=(new Date).getHours(),e=(new Date).getMinutes();(new Date).getSeconds();t>3&&t<12&&$("span#halojs").text("Selamat Pagi,"),t>11&&t<16&&$("span#halojs").text("Selamat Siang,"),t>15&&t<18&&$("span#halojs").text("Selamat Sore,"),t>17&&t<24&&$("span#halojs").text("Selamat Malam,"),(t>23||t<4)&&$("span#halojs").text("Sekarang Jam  "+t+":"+e)}),$(function(){$(document).scroll(function(){$(document).scrollTop()>100&&($.cookie("notice-accepted")||($("a#xbanner-1").click(),$.cookie("notice-accepted",1,{expires:60/1440,path:"/"})))})}),$(document).ready(function(){$.ajax({url:"https://www.instagram.com/bkpsdm.blg/?__a=1",type:"get",headers:{"Access-Control-Allow-Credentials":!0,"Access-Control-Allow-Origin":"*","Access-Control-Allow-Methods":"GET","Access-Control-Allow-Headers":"application/json"},dataType:"jsonp",success:function(t){console.log(t)}})}),$(document).ready(function(){$(".lazy").lazy({effect:"fadeIn",effectTime:100,threshold:0,combined:!0,delay:800,enableThrottle:!0,throttle:250,onFinishedAll:function(){this.config("lazy")||this.destroy()},onError:function(t){t.data("src");t.attr("src","".concat(_uri,"/assets/images/noimage.gif"))}})}),lightbox.option({resizeDuration:150,wrapAround:!1,fadeDuration:500,imageFadeDuration:800,disableScrolling:!1,albumLabel:"Story Web %1 dari %2"}),document.onreadystatechange=function(){var t=document.getElementsByTagName("BODY")[0];"complete"!==document.readyState?(document.querySelector(".page-slider").style.transition="0",document.querySelector(".page-slider").style.opacity=1,t.style.cursor="progress"):(t.style.cursor="auto",document.querySelector(".page-slider").style.transition="0.8s",document.querySelector(".page-slider").style.opacity=0,document.querySelector(".page-slider").style.visibility="hidden")},$(function(){var t=$(".grid").masonry({percentPosition:!0,transitionDuration:"0.8s"});t.imagesLoaded().progress(function(){t.masonry()})}),$(document).ready(function(){$(document).scroll(function(){$(document).scrollTop()>80?($("nav#navbar").removeClass("navbar-dark navbar-gradient").css("transition",".3s ease-in-out").addClass("bg-blur shadow navbar-light"),$("button#caripost").addClass("btn-outline-light")):($("button#caripost").removeClass("btn-outline-light"),$("nav#navbar").addClass("navbar-dark navbar-gradient").removeClass("bg-blur shadow"))})}),$(document).ready(function(){$(".rippler").rippler({effectClass:"rippler-effect",effectSize:16,addElement:"div",duration:400})});var $host="http://localhost"==window.location.origin;if($host)var _uri="".concat(window.location.origin,"/smartsite"),_silka="http://192.168.1.4";else _silka="http://silka.bkppd-balangankab.info",_uri="".concat(window.location.origin);var _uriSegment=window.location.pathname.split("/");console.log("Location Origin",_uri),console.log(_uriSegment);var queryString=window.location.search,urlParams=new URLSearchParams(queryString);function listdetail(){var t=this.getAttribute("idp"),e=this.getAttribute("urlpost"),a="";return $.ajax({url:e,type:"post",async:!1,delay:800,data:{id:t},beforeSend:function(){a='<img class="mx-auto text-center d-block p-5" src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/oval-white.svg">')},success:function(t){a=t},error:function(t){a=t.responseText}}),a}function readURL(t,e){if(t.files&&t.files[0]){var a=new FileReader;a.onload=function(t){$(e).attr("src",t.target.result)},a.readAsDataURL(t.files[0])}}function renderHtmlFromUrl(){var t=$("#snippet-link").attr("data-url");if(""!=t){var e=$("#snippet-link");'<div id="snippet-link" data-url="'.concat(t,'"></div>');$.getJSON("".concat(_uri,"/frontend/v1/post_list/render_html"),{url:t},function(a){var n=' \n        <div class="p-2 border my-2 mx-0 rounded shadow-sm">\n          <b class="text-danger">Baca juga :</b> <a href="'.concat(t,'">').concat(a.title,"</a>\n        </div>\n       ");e.html(n)})}}console.log("Params",queryString),$(function(){$("button.post-search").on("click",function(){$("#mpostseacrh").modal("show"),$("input[name='q']").focus()}),$("a.post-search").on("click",function(){$("#mpostseacrh").modal("show"),$("input[name='q']").focus()}),$("a#mobileMenuNav").on("click",function(){$("#mobileMenu").modal("show")}),$("#mpostseacrh").on("hidden.bs.modal",function(t){$("input[name='q']").val(""),$("#form_post_search").submit()}),$("#form_post_search").on("submit",function(t){t.preventDefault();var e=$(this),a=e[0].q,n=$("#search-result");function o(t,e){notif({msg:"<i class='fas fa-info-circle mr-2'></i> ".concat(t),type:e,offset:-10,position:"center",color:"#fff"})}""==a.value&&n.html('<div class="pl-3 pl-md-0 rounded d-flex justify-content-around align-items-center">\n\t\t            \t\t<div class="d-none d-md-block">\n\t\t            \t\t\t<i class="fas fa-search fa-2x"></i>\n\t\t            \t\t</div>\n\t\t            \t\t<div class="py-3">\n\t\t\t\t\t\t\t\t<h2>Silahkan masukan katakunci !</h2>\n\t\t\t\t            \t<p class="text-muted pl-3 border-left border-warning">\n\t\t\t\t            \t\tSilahkan masukan keywords pencarian, dengan memasukan judul atau label\n\t\t\t\t            \t</p>\n\t\t            \t\t</div>\n\t\t            \t</div>\n            '),a.value.length>3?$.ajax({url:e[0].action,method:"POST",data:{q:a.value},cache:!1,dataType:"json",beforeSend:function(){n.html('<div id="loader" class="mx-auto my-5"></div>')},timeout:1e3,success:function(t){n.html(t.data),"0"!=t.count&&o("".concat(t.count," data ditemukan"),"success")},error:function(t){o("error function","error")}}):o("Silahkan masukan min. 3 karakter.","warning")})}),$(document).ready(function(){$(".grafis-app-slick").slick({autoplay:!0,infinite:!0,dots:!0,autoplaySpeed:8e3,slidesToShow:4,slidesToScroll:1,zIndex:10,centerMode:!1,centerPadding:"10px",focusOnSelect:!1,arrows:!0,prevArrow:'<button class="slide-arrow prev-arrow btn bg-white btn-outline-none p-3 shadow ml-3"><i class="fas fa-chevron-left"></button>',nextArrow:'<button class="slide-arrow next-arrow btn bg-white btn-outline-none p-3 shadow mr-3"><i class="fas fa-chevron-right"></button>',pauseOnHover:!0,adaptiveHeight:!1,responsive:[{breakpoint:480,settings:{centerMode:!0,slidesToShow:1,arrows:!0,fade:!0,centerPadding:"40px"}}]}),$(".app-prev").click(function(){$(this).parent().find(".app-slick").slick("slickPrev")}),$(".app-next").click(function(t){t.preventDefault(),$(this).parent().find(".app-slick").slick("slickNext")})}),$(document).ready(function(){$(".scroll").click(function(t){t.preventDefault(),$("body,html").animate({scrollTop:$(this.hash).offset().top},300)})}),$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip({offset:"0,10px",padding:10}),$("a#item-populer-post").tooltip({offset:"0,10px",padding:10,placement:"top",title:listdetail,html:!0,container:"body"})}),$(document).ready(function(){$("a#module").unbind().bind("click",function(t){t.preventDefault();var e=$(this),a=e.attr("href"),n=$("#containerModule");$("a#module").removeClass("active"),$.ajax({url:a,method:"post",dataType:"html",beforeSend:function(){n.html('<div style="height:50vh;" class="d-flex justify-content-center align-items-center">\n                <div class="loader_small" style="width: 50px; height: 50px;"></div></div>')},success:function(t){n.html(t),e.addClass("active")}})})}),$(document).ready(function(){function t(t,e){if(t.files&&t.files[0]){var a=new FileReader;a.onload=function(t){$(e).attr("src",t.target.result)},a.readAsDataURL(t.files[0])}}$("input[name='photo_pic']").change(function(){t(this,$("img.photo_pic"))}),$("input[name='photo_ktp']").change(function(){t(this,$("img.photo_ktp"))}),$(document).ready(function(){$('input[name="photo_pic"]').on("change",function(){var t=this.files[0].name,e=new FormData,a=t.split(".").pop().toLowerCase();-1==jQuery.inArray(a,["jpg","jpeg","png"])&&alert("Invalid Image File"),(new FileReader).readAsDataURL(this.files[0]);var n=this.files[0];(n.size||n.fileSize)>2e6?alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB"):(e.append("file",this.files[0]),$.ajax({url:"".concat(_uri,"/frontend/v1/users/upload_photo?jenis=pic&id=").concat(_uriSegment[5]),method:"POST",data:e,contentType:!1,cache:!1,dataType:"json",processData:!1,beforeSend:function(){$("small.msg-pic").html('Sedang Memperbaharui Gambar <img src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/vtree.svg">'))},success:function(t){$("small.msg-pic").html(t),console.log(_uriSegment[5])}}))}),$('input[name="photo_ktp"]').on("change",function(){var t=this.files[0].name,e=new FormData,a=t.split(".").pop().toLowerCase();-1==jQuery.inArray(a,["jpg","jpeg","png"])&&notif({msg:"Invalid Image File",type:"error",position:"center"}),(new FileReader).readAsDataURL(this.files[0]);var n=this.files[0];(n.size||n.fileSize)>2e6?notif({msg:"Ukuran File Gambar Terlalu Besar Maksimal 2MB",type:"warning",position:"center"}):(e.append("file",this.files[0]),$.ajax({url:"".concat(_uri,"/frontend/v1/users/upload_photo?jenis=ktp&id=").concat(_uriSegment[5]),method:"POST",data:e,contentType:!1,cache:!1,dataType:"json",processData:!1,beforeSend:function(){$("small.msg-ktp").html('Sedang Memperbaharui Gambar <img src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/vtree.svg">'))},success:function(t){$("small.msg-ktp").html(t)}}))}),$.validate({form:"#form_edit",modules:"date, security, html5, sanitize",showErrorDialogs:!0,onError:function(t){notif({msg:"Validation of form "+t.attr("id")+" failed!",type:"error",offset:-10,position:"center"})},onSuccess:function(t){var e=t.attr("action"),a=t.attr("method"),n=t.serialize();return $.ajax({url:e,method:a,data:n,cache:!1,dataType:"json",beforeSend:function(){$("button#save").html('<img width="30" height="30" class="d-block mx-auto" src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/oval-datatable.svg">')).prop("disabled",!0)},success:function(t){1==t.valid&&$("button#save").html('<i class="fas fa-save"></i> Simpan Perubahan').prop("disabled",!1),notif({msg:t.msg,type:t.type,offset:-10,bgcolor:"#000",color:"#fff",timeout:3e3,position:"bottom"})},error:function(t){$("button#save").html('<i class="fas fa-save"></i> Simpan Perubahan').prop("disabled",!1),notif({msg:"<b>Error:</b> Terjadi kesalahan pada server",type:"error",position:"center",offset:-10})}}),!1},onModulesLoaded:function(){$("#alamat").restrictLength($("#maxlength"))}})})}),$(document).ready(function(){$(document).on("click","a#btn-view-video",function(t){t.preventDefault();var e=$(this).attr("href"),a=$(this).attr("title");$.confirm({title:a,content:"url:"+_uri+"/frontend/v1/beranda/yt_view_video/"+e,columnClass:"col-md-10",theme:"supervan",bgOpacity:.9,animateFromElement:!0,animationSpeed:800,buttons:!1,backgroundDismiss:!0,animation:"none",closeAnimation:"opacity"})})}),renderHtmlFromUrl();