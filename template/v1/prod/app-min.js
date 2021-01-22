"use strict";function like_toggle(e){e.classList.toggle("btn-like");var t=$(e).find("span.count_like").text(),a=parseInt(t)+1,n=parseInt(t)-1,o=$(e).attr("data-id-user"),i=$(e).attr("data-id-berita");0!=o?e.classList.contains("btn-like")?($(e).find("i").removeClass("far").addClass("fas text-danger"),$.post(_uri+"/frontend/v1/beranda/likes?type=like",{id_a:o,id_b:i,likes:a},function(t){1==t&&(notif({msg:'Postingan Disukai <i class="fas fa-thumbs-up ml-2"></i>',type:"success",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300}),$(e).find("span.count_like").text(a))},"json")):($(e).find("i").removeClass("fas text-danger").addClass("far"),$.post(_uri+"/frontend/v1/beranda/likes?type=dislike",{id_a:o,id_b:i,likes:n},function(t){1==t&&(notif({msg:'Postingan Tidak Disukai <i class="fas fa-thumbs-down ml-2"></i>',type:"error",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300}),$(e).find("span.count_like").text(n))},"json")):$("#noticeSigin").modal("show").modal("handleUpdate")}function bookmark_toggle(e){e.classList.toggle("btn-bookmark");var t=$(e).attr("data-id-user"),a=$(e).attr("data-id-berita");0!=t?e.classList.contains("btn-bookmark")?($(e).find("i").removeClass("far").addClass("fas text-primary"),$.post(_uri+"/frontend/v1/beranda/bookmark?type=on",{id_a:t,id_b:a,post:"on"},function(e){1==e&&notif({msg:'Postingan Disimpan  <i class="fas fa-check-circle ml-2"></i>',type:"success",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300})},"json")):($(e).find("i").removeClass("fas text-primary").addClass("far"),$.post(_uri+"/frontend/v1/beranda/bookmark?type=off",{id_a:t,id_b:a,post:"off"},function(e){1==e&&notif({msg:"Postingan Tidak Disimpan",type:"warning",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300})},"json")):$("#noticeSigin").modal("show").modal("handleUpdate")}function modeBaca(e){e.classList.toggle("btn-dark"),e.classList.contains("btn-dark")?Focusable.setFocus($(".card-post"),{fadeDuration:700,hideOnClick:!1,hideOnESC:!1,findOnResize:!0}):Focusable.hide()}function explore(){document.querySelector("section.content-home").scrollIntoView({behavior:"smooth",block:"start"})}if($(document).ready(function(){var e=$(".btn-backtop");e.hide(),$(window).on("scroll loaded",function(){$(this).scrollTop()>100?e.slideDown():e.fadeOut()}),e.on("click",function(e){$("html, body").animate({scrollTop:0},1e3)})}),$(document).ready(function(){$(document).on("click","#btn-share",function(){var e=$(this).attr("data-row-id");$.confirm({title:!1,content:"url:"+_uri+"/frontend/v1/beranda/share_artikel/"+e,columnClass:"medium",theme:"material",bgOpacity:.9,animateFromElement:!0,animationSpeed:800,buttons:!1,backgroundDismiss:!0,animation:"none",closeAnimation:"none"})})}),$(document).ready(function(){var e=$("#exampleFormControlTextarea1").emojioneArea({pickerPosition:"top",tonesStyle:"bullet",placeholder:"Masukan komentar kamu disini.",search:!1,filtersPosition:"top",recentEmojis:!1});function t(){$.getJSON("".concat(_uri,"/frontend/v1/post/displayKomentar/").concat(_uriSegment[7]),function(e){$(".tracking-list").html(e)})}$.cookie("ci_session")||"post"!=_uriSegment[3]||"detail"!=_uriSegment[4]?console.log("Komentar tidak ditampilkan dikarnakan anda belum login atau bukan halaman detail berita"):t(),$(document).on("click","#btn-reply-comment",function(){$(this).attr("data-id-parent"),$(this).attr("data-id-berita"),$(this).attr("data-id-user-comment");var e=$(this).attr("data-username");$(".emojionearea-editor").html('<span class="text-info">@'.concat(e.trim().toLowerCase()," </span>")).focus()}),$(document).on("click","#btn-delete-comment",function(){var e=$(this).attr("data-id");$.getJSON(_uri+"/frontend/v1/post/deleteComment",{id:e},function(e){1==e&&(t(),notif({msg:'Komentar dihapus <i class="fas fa-trash ml-3"></input>',type:"info",position:"bottom"}))})}),$(document).on("submit","form#f_komentar",function(a){a.preventDefault();var n=$(this),o=(n.attr("method"),n.attr("action")),i=n.attr("class"),s=e[0].emojioneArea.getText();""!=s?$.post(o,{id_b:i,isi:s},function(e){1==e&&($(".emojionearea-editor").html(""),$(".emojionearea-editor").removeClass("is-invalid").addClass("is-valid"),t())},"json"):$(".emojionearea-editor").addClass("is-invalid").focus()})}),$(function(){var e=(new Date).getHours(),t=(new Date).getMinutes();(new Date).getSeconds();e>3&&e<12&&$("span#halojs").text("Selamat Pagi,"),e>11&&e<16&&$("span#halojs").text("Selamat Siang,"),e>15&&e<18&&$("span#halojs").text("Selamat Sore,"),e>17&&e<24&&$("span#halojs").text("Selamat Malam,"),(e>23||e<4)&&$("span#halojs").text("Sekarang Jam  "+e+":"+t)}),$(document).ready(function(){var e=0,t="inactive";if(console.log(_uriSegment),"beranda"==_uriSegment[3]){var a=function(e){for(var t="",a=0;a<1;a++)t+='\n                <div class="card border border-light shadow-sm mb-3">\n                    <div class="card-header border-0 bg-white">\n                    <p>\n                    <span class="content-placeholder rounded-circle float-left mr-3" style="width:50px; height: 50px;">&nbsp;</span>\n\n                    <span class="content-placeholder rounded-lg float-left"\n                    style ="width:50%; height: 50px;"> &nbsp; </span>\n\n                    <span class ="content-placeholder rounded-circle float-right mt-1 mr-3"\n                    style ="width:40px; height: 40px;"> &nbsp; </span>\n                    </p> \n                    </div> \n                    <div class = "card-body p-0">\n                    <span class ="content-placeholder rounded-0" style = "width:100%; height: 300px;"> &nbsp; </span>\n                    <span class="content-placeholder rounded-lg my-2 mx-4"\n                    style ="width:90%; height: 30px;"> &nbsp; </span>\n                    <span class="content-placeholder rounded-lg my-2 mx-4"\n                    style ="width:90%; height: 50px;"> &nbsp; </span>\n                    </div> \n                    <div class ="card-footer text-muted p-3 bg-transparent" >\n                     <span class ="content-placeholder rounded-circle mr-2"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n                    <span class ="content-placeholder rounded-circle mr-2"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n                    <span class ="content-placeholder rounded-circle mr-2"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n                    <span class ="content-placeholder rounded-circle"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n\n                    <span class ="content-placeholder rounded-circle float-right"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n                    </div> \n                </div>\n            ';$("#load_data_message").html(t)},n=function(e,a){$.ajax({url:_uri+"/frontend/v1/beranda/get_all_berita",method:"POST",data:{limit:e,start:a},cache:!1,dataType:"json",success:function(e){""==e.html?($("#load_data_message").html('<div class="card border-0 bg-white shadow-sm mb-5">\n                            <div class="card-body text-danger text-center">\n                            <img src="'.concat(_uri,'/template/v1/img/humaaans-3.png" alt="croods" class="img-fluid rounded">\n                                <h5 class="card-title">Yahhh! abis</h5>  \n                                <p class="font-weight-light text-secondary"> Berita yang anda load mungkin telah berada di penghujung data.</p>\n                            </div>\n                        </div>')),$("button#load_more").hide(),t="active"):($("#load_data").append(e.html),$("#load_data_message").html(""),t="inactive",$(".lazy").lazy({beforeLoad:function(e){e.addClass("beforeLoaded")},afterLoad:function(e){e.addClass("isLoaded").removeClass("lazy beforeLoaded")}}),$(".rippler").rippler({effectClass:"rippler-effect"}),$('[data-toggle="tooltip"]').tooltip({delay:400,offset:"0,10px",padding:8}))},error:function(e){alert("Error dalam meload berita, created_by tidak ditemukan.")}})};a(),"inactive"==t&&(t="active",n(3,e)),$("button#load_more").on("click",function(o){o.preventDefault(),"inactive"==t&&(a(),t="active",e+=3,setTimeout(function(){n(3,e)},300))})}else console.log("Semua berita tidak ditampilkan, karna bukan halaman beranda");$("button#caripost").on("click",function(){$("#mpostseacrh").modal("show"),$("input[name='q']").focus()}),$("#mpostseacrh").on("hidden.bs.modal",function(e){$("input[name='q']").val(""),$("#form_post_search").submit()}),$("#form_post_search").on("submit",function(e){e.preventDefault();var t=$(this),a=t[0].q,n=$("#search-result");""==a.value&&n.html('<h5 class="mx-auto text-center text-secondary">Kata kunci belum kamu masukan?</h5>'),a.value.length>3&&$.ajax({url:t[0].action,method:"POST",data:{q:a.value},cache:!1,dataType:"html",beforeSend:function(){n.html('<div id="loader" class="mx-auto my-5"></div>')},timeout:1e3,success:function(e){n.html(e)},error:function(e){alert("error function")}})})}),$(function(){$.cookie("notice-accepted")||($("a#banner").click(),$.cookie("notice-accepted",1,{expires:60/1440,path:"/"}))}),$(function(){$("h3#count_jml").countTo()}),$(document).ready(function(){$(".lazy").lazy({threshold:0,beforeLoad:function(e){e.addClass("lazy")},afterLoad:function(e){e.addClass("isLoaded").removeClass("lazy")}})}),lightbox.option({resizeDuration:200,wrapAround:!0,fadeDuration:0,disableScrolling:!0}),document.onreadystatechange=function(){"complete"!==document.readyState?(document.querySelector("html").style.visibility="hidden",document.querySelector("#loader").style.visibility="visible"):(document.querySelector("#loader").style.display="none",document.querySelector("html").style.visibility="visible")},$(function(){var e=$(".grid").masonry({transitionDuration:"0.8s"});e.imagesLoaded().progress(function(){e.masonry("layout")})}),$(document).ready(function(){var e=$(".dropdown"),t=$(".dropdown-toggle"),a=$(".dropdown-menu");$(window).on("load resize",function(){this.matchMedia("(min-width: 768px)").matches?e.hover(function(){var e=$(this);e.addClass("show"),e.find(t).attr("aria-expanded","true"),e.find(a).addClass("show").addClass("animated none")},function(){var e=$(this);e.removeClass("show"),e.find(t).attr("aria-expanded","false"),e.find(a).removeClass("show").removeClass("animated none")}):e.off("mouseenter mouseleave")}),$(".navbar .dropdown-item").on("hover",function(e){var t=$(this).children(".dropdown-toggle"),a=t.offsetParent(".dropdown-menu");$(this).parent("li").toggleClass("open"),a.parent().hasClass("navbar-nav")||(a.hasClass("show")?(a.removeClass("show"),t.next().removeClass("show"),t.next().css({top:-999,left:-999})):(a.parent().find(".show").removeClass("show"),a.addClass("show"),t.next().addClass("show"),t.next().css({top:t[0].offsetTop,left:a.outerWidth()-4})),e.preventDefault(),e.stopPropagation())}),$(".navbar .dropdown").on("hidden.bs.dropdown",function(){$(this).find("li.dropdown").removeClass("show open"),$(this).find("ul.dropdown-menu").removeClass("show open")}),$(document).scroll(function(){$(document).scrollTop()>10?$("nav#navbar").css("transition",".1s ease-in").addClass("shadow-sm bg-white"):$("nav#navbar").removeClass("shadow-sm bg-white")})}),$(document).ready(function(){$(".rippler").rippler({effectClass:"rippler-effect",effectSize:16,addElement:"div",duration:400})}),0==window.location.protocol.indexOf("https")){var el=document.createElement("meta");el.setAttribute("http-equiv","Content-Security-Policy"),el.setAttribute("content","upgrade-insecure-requests"),document.head.append(el)}var _uri="".concat(window.location.origin),_uriSegment=window.location.pathname.split("/");function listdetail(){var e=this.getAttribute("idp"),t=this.getAttribute("urlpost"),a="";return $.ajax({url:t,type:"post",async:!1,delay:800,data:{id:e},beforeSend:function(){a='<img class="mx-auto text-center d-block p-5" src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/oval-white.svg">')},success:function(e){a=e},error:function(e){a=e.responseText}}),a}function readURL(e,t){if(e.files&&e.files[0]){var a=new FileReader;a.onload=function(e){$(t).attr("src",e.target.result)},a.readAsDataURL(e.files[0])}}$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip({offset:"0,10px",padding:10}),$("a#item-populer-post").tooltip({offset:"0,10px",padding:10,placement:"top",title:listdetail,html:!0,container:"body"})}),$(document).ready(function(){$.typeahead({input:".js-nipnama",minLength:12,maxLength:!1,order:"asc",maxItem:1,cache:!1,offset:!1,hint:!0,searchOnFocus:!0,dynamic:!0,delay:500,backdrop:{"background-color":"#000"},emptyTemplate:'Data PNS "<b>{{query}}</b>" tidak ditemukan ',debug:!0,template:function(e){return"<span class='mr-3 pull-left'><img class='img-rounded' src='{{photo}}' width='30' alt='{{nama}}'></span> {{nama}} - {{nip}}"},source:{pegawai:{display:["nip"],ajax:function(e){return{type:"POST",url:"http://silka.bkppd-balangankab.info/api/filternipnama",dataType:"json",data:{q:"{{query}}"}}}}}})}),$(document).ready(function(){$("a#module").on("click",function(e){e.preventDefault();var t=$(this).attr("href"),a=$("#containerModule");$.ajax({url:t,method:"post",dataType:"html",beforeSend:function(){a.html('<div id="loader" class="m-2"></div> ')},success:function(e){a.html(e)}})})}),$(document).ready(function(){function e(e,t){if(e.files&&e.files[0]){var a=new FileReader;a.onload=function(e){$(t).attr("src",e.target.result)},a.readAsDataURL(e.files[0])}}$("input[name='photo_pic']").change(function(){e(this,$("img.photo_pic"))}),$("input[name='photo_ktp']").change(function(){e(this,$("img.photo_ktp"))}),$(document).ready(function(){$('input[name="photo_pic"]').on("change",function(){var e=this.files[0].name,t=new FormData,a=e.split(".").pop().toLowerCase();-1==jQuery.inArray(a,["jpg","jpeg","png"])&&alert("Invalid Image File"),(new FileReader).readAsDataURL(this.files[0]);var n=this.files[0];(n.size||n.fileSize)>2e6?alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB"):(t.append("file",this.files[0]),$.ajax({url:"".concat(_uri,"/frontend/v1/users/upload_photo?jenis=pic&id=").concat(_uriSegment[6]),method:"POST",data:t,contentType:!1,cache:!1,dataType:"json",processData:!1,beforeSend:function(){$("small.msg-pic").html('Sedang Memperbaharui Gambar <img src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/vtree.svg">'))},success:function(e){$("small.msg-pic").html(e)}}))}),$('input[name="photo_ktp"]').on("change",function(){var e=this.files[0].name,t=new FormData,a=e.split(".").pop().toLowerCase();-1==jQuery.inArray(a,["jpg","jpeg","png"])&&notif({msg:"Invalid Image File",type:"error",position:"center"}),(new FileReader).readAsDataURL(this.files[0]);var n=this.files[0];(n.size||n.fileSize)>2e6?notif({msg:"Ukuran File Gambar Terlalu Besar Maksimal 2MB",type:"warning",position:"center"}):(t.append("file",this.files[0]),$.ajax({url:"".concat(_uri,"/frontend/v1/users/upload_photo?jenis=ktp&id=").concat(_uriSegment[6]),method:"POST",data:t,contentType:!1,cache:!1,dataType:"json",processData:!1,beforeSend:function(){$("small.msg-ktp").html('Sedang Memperbaharui Gambar <img src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/vtree.svg">'))},success:function(e){$("small.msg-ktp").html(e)}}))}),$.validate({form:"#form_edit",modules:"date, security, html5, sanitize",showErrorDialogs:!0,onError:function(e){notif({msg:"Validation of form "+e.attr("id")+" failed!",type:"error",offset:-10,position:"center"})},onSuccess:function(e){var t=e.attr("action"),a=e.attr("method"),n=e.serialize();return $.ajax({url:t,method:a,data:n,cache:!1,dataType:"json",beforeSend:function(){$("button#save").html('<img width="30" height="30" class="d-block mx-auto" src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/oval-datatable.svg">')).prop("disabled",!0)},success:function(e){1==e.valid&&$("button#save").html('<i class="fas fa-save"></i> Simpan Perubahan').prop("disabled",!1),notif({msg:e.msg,type:e.type,offset:-10,bgcolor:"#000",color:"#fff",timeout:3e3,position:"bottom"})},error:function(e){$("button#save").html('<i class="fas fa-save"></i> Simpan Perubahan').prop("disabled",!1),notif({msg:"<b>Error:</b> Terjadi kesalahan pada server",type:"error",position:"center",offset:-10})}}),!1},onModulesLoaded:function(){$("#alamat").restrictLength($("#maxlength"))}})})});