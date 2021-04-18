"use strict";function like_toggle(t){t.classList.toggle("btn-like");var e=$(t).find("span.count_like").text(),a=parseInt(e)+1,n=parseInt(e)-1,o=$(t).attr("data-id-user"),i=$(t).attr("data-id-berita");0!=o?t.classList.contains("btn-like")?($(t).find("i").removeClass("far").addClass("fas text-danger"),$.post(_uri+"/frontend/v1/beranda/likes?type=like",{id_a:o,id_b:i,likes:a},function(e){1==e&&(notif({msg:'Postingan Disukai <i class="fas fa-thumbs-up ml-2"></i>',type:"success",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300}),$(t).find("span.count_like").text(a))},"json")):($(t).find("i").removeClass("fas text-danger").addClass("far"),$.post(_uri+"/frontend/v1/beranda/likes?type=dislike",{id_a:o,id_b:i,likes:n},function(e){1==e&&(notif({msg:'Postingan Tidak Disukai <i class="fas fa-thumbs-down ml-2"></i>',type:"error",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300}),$(t).find("span.count_like").text(n))},"json")):$("#noticeSigin").modal("show").modal("handleUpdate")}function bookmark_toggle(t){t.classList.toggle("btn-bookmark");var e=$(t).attr("data-id-user"),a=$(t).attr("data-id-berita");0!=e?t.classList.contains("btn-bookmark")?($(t).find("i").removeClass("far").addClass("fas text-primary"),$.post(_uri+"/frontend/v1/beranda/bookmark?type=on",{id_a:e,id_b:a,post:"on"},function(t){1==t&&notif({msg:'Postingan Disimpan  <i class="fas fa-check-circle ml-2"></i>',type:"success",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300})},"json")):($(t).find("i").removeClass("fas text-primary").addClass("far"),$.post(_uri+"/frontend/v1/beranda/bookmark?type=off",{id_a:e,id_b:a,post:"off"},function(t){1==t&&notif({msg:"Postingan Tidak Disimpan",type:"warning",offset:0,position:"bottom",bgcolor:"#333",color:"#eee",timeout:1e3,width:300})},"json")):$("#noticeSigin").modal("show").modal("handleUpdate")}function modeBaca(t){t.classList.toggle("btn-dark"),t.classList.contains("btn-dark")?Focusable.setFocus($(".card-post"),{fadeDuration:700,hideOnClick:!1,hideOnESC:!1,findOnResize:!0}):Focusable.hide()}function batal(){$(".emojionearea-editor").html(""),$(".emojionearea-editor").removeClass("is-invalid").addClass("is-valid"),$(".reply_username").attr("id","").html("")}function explore(){document.querySelector("section.content-home").scrollIntoView({behavior:"smooth",block:"start"})}$(document).ready(function(){AOS.init()}),$(document).ready(function(){var t=$(".btn-backtop");t.hide(),$(window).on("scroll loaded",function(){$(this).scrollTop()>120?t.fadeIn():t.fadeOut()}),t.on("click",function(t){$("html, body").animate({scrollTop:0},800)})}),$(document).ready(function(){$(document).on("click","#btn-share",function(){var t=$(this).attr("data-row-id");$.confirm({title:!1,content:"url:"+_uri+"/frontend/v1/beranda/share_artikel/"+t,columnClass:"medium",theme:"material",bgOpacity:.9,animateFromElement:!0,animationSpeed:800,buttons:!1,backgroundDismiss:!0,animation:"none",closeAnimation:"none"})})}),$(document).ready(function(){var t=$("#exampleFormControlTextarea1").emojioneArea({pickerPosition:"top",tonesStyle:"bullet",placeholder:"Masukan komentar kamu disini.",search:!1,filtersPosition:"top",recentEmojis:!1}),e="post"==_uriSegment[1],a="post"==_uriSegment[2];function n(){$.getJSON("".concat(_uri,"/frontend/v1/post/displayKomentar/").concat($host?_uriSegment[4]:_uriSegment[3]),function(t){$(".tracking-list").html(t)})}($host?a:e)?n():console.log("Komentar tidak ditampilkan dikarnakan anda belum login atau bukan halaman detail berita"),$(document).on("click","#btn-reply-comment",function(){$(this).attr("data-id-parent"),$(this).attr("data-id-berita"),$(this).attr("data-id-user-comment");var t=$(this).attr("data-username"),e=$(this).attr("data-id-comment");$(".reply_username").attr("id","".concat(e)).attr("username","@".concat(t.trim().toLowerCase())).html('Reply <span class="text-info">@'.concat(t.trim().toLowerCase(),'</span> <button onclick="batal()" class="btn btn-sm text-danger btn-default">x</button>')),$(".emojionearea-editor").html("@".concat(t.trim().toLowerCase())).focus()}),$(document).on("click","#btn-delete-comment",function(){var t=$(this).attr("data-id");$.getJSON(_uri+"/frontend/v1/post/deleteComment",{id:t},function(t){1==t&&(n(),notif({msg:'Komentar dihapus <i class="fas fa-trash ml-3"></input>',type:"info",position:"bottom"}))})}),$(document).on("submit","form#f_komentar",function(e){e.preventDefault();var a=$(this),o=(a.attr("method"),a.attr("action")),i=a.attr("class"),s=$(".reply_username").attr("id"),r=($(".reply_username").attr("username"),t[0].emojioneArea.getText());""!=r?$.post(o,{id_b:i,id_c:s,isi:r},function(t){1==t&&(batal(),n())},"json"):$(".emojionearea-editor").addClass("is-invalid").focus()})}),$(function(){var t=(new Date).getHours(),e=(new Date).getMinutes();(new Date).getSeconds();t>3&&t<12&&$("span#halojs").text("Selamat Pagi,"),t>11&&t<16&&$("span#halojs").text("Selamat Siang,"),t>15&&t<18&&$("span#halojs").text("Selamat Sore,"),t>17&&t<24&&$("span#halojs").text("Selamat Malam,"),(t>23||t<4)&&$("span#halojs").text("Sekarang Jam  "+t+":"+e)}),$(document).ready(function(){var t=0,e="inactive";if(console.log(_uriSegment),"beranda"==($host?_uriSegment[2]:_uriSegment[1])){var a=function(t){for(var e="",a=0;a<1;a++)e+='\n                <div class="card border border-light bg-white shadow-sm mb-3" style="border-radius:10px;">\n                    <div class="card-header border-0 bg-white" style="border-radius:10px;">\n                    <p>\n                    <span class="content-placeholder rounded-circle float-left mr-3" style="width:50px; height: 50px;">&nbsp;</span>\n\n                    <span class="content-placeholder rounded-lg float-left"\n                    style ="width:50%; height: 50px;"> &nbsp; </span>\n\n                    <span class ="content-placeholder rounded-circle float-right mt-1 mr-3"\n                    style ="width:40px; height: 40px;"> &nbsp; </span>\n                    </p> \n                    </div> \n                    <div class = "card-body p-0">\n                    <span class ="content-placeholder rounded-0" style = "width:100%; height: 300px;"> &nbsp; </span>\n                    <span class="content-placeholder rounded-lg my-2 mx-4"\n                    style ="width:90%; height: 30px;"> &nbsp; </span>\n                    <span class="content-placeholder rounded-lg my-2 mx-4"\n                    style ="width:90%; height: 50px;"> &nbsp; </span>\n                    </div> \n                    <div class ="card-footer text-muted p-3 bg-transparent" >\n                     <span class ="content-placeholder rounded-circle mr-2"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n                    <span class ="content-placeholder rounded-circle mr-2"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n                    <span class ="content-placeholder rounded-circle mr-2"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n                    <span class ="content-placeholder rounded-circle"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n\n                    <span class ="content-placeholder rounded-circle float-right"\n                    style ="width:45px; height: 45px;"> &nbsp; </span>\n                    </div> \n                </div>\n            ';$("#load_data_message").html(e),$("button#load_more").text("Loading...").prop("disabled",!0)},n=function(t,a){$.ajax({url:_uri+"/frontend/v1/beranda/get_all_berita",method:"POST",data:{limit:t,start:a},cache:!1,dataType:"json",success:function(t){""==t.html?($("#load_data_message").html('<div class="card border-0 bg-transparent shadow-none mb-5">\n                                <div class="card-body text-danger text-center">\n                                <img src="'.concat(_uri,'/template/v1/img/humaaans-3.png" alt="croods" class="img-fluid rounded">\n                                    <h5 class="card-title">Yahhh! abis</h5>  \n                                    <p class="font-weight-light text-secondary"> Berita yang anda load mungkin telah berakhir.</p>\n                                </div>\n                            </div>')),$("button#load_more").hide(),e="active"):($("#load_data").append(t.html),$("#load_data_message").html(""),$("button#load_more").html('<i class="fas fa-newspaper mr-2"></i> Load more berita').prop("disabled",!1),e="inactive",$(".lazy").lazy({beforeLoad:function(t){t.addClass("beforeLoaded")},afterLoad:function(t){t.addClass("isLoaded").removeClass("lazy beforeLoaded")}}),$(".rippler").rippler({effectClass:"rippler-effect"}),$('[data-toggle="tooltip"]').tooltip({delay:300,offset:"0,10px",padding:8}))},error:function(t){alert("Error dalam meload berita, created_by tidak ditemukan.")}})};a(),"inactive"==e&&(e="active",n(3,t)),$("button#load_more").on("click",function(o){o.preventDefault(),"inactive"==e&&(a(),e="active",t+=3,setTimeout(function(){n(3,t)},300))})}else console.log("Semua berita tidak ditampilkan, karna bukan halaman beranda");$("button#caripost").on("click",function(){$("#mpostseacrh").modal("show"),$("input[name='q']").focus()}),$("#mpostseacrh").on("hidden.bs.modal",function(t){$("input[name='q']").val(""),$("#form_post_search").submit()}),$("#form_post_search").on("submit",function(t){t.preventDefault();var e=$(this),a=e[0].q,n=$("#search-result");""==a.value&&n.html('<h5 class="mx-auto text-center text-secondary">Kata kunci belum kamu masukan?</h5>'),a.value.length>3&&$.ajax({url:e[0].action,method:"POST",data:{q:a.value},cache:!1,dataType:"html",beforeSend:function(){n.html('<div id="loader" class="mx-auto my-5"></div>')},timeout:1e3,success:function(t){n.html(t)},error:function(t){alert("error function")}})})}),$(function(){$("h3#count_jml").countTo()}),$(document).ready(function(){$(".lazy").lazy({threshold:300,beforeLoad:function(t){t.addClass("lazy")},afterLoad:function(t){t.addClass("isLoaded").removeClass("lazy")}})}),lightbox.option({resizeDuration:300,wrapAround:!1,fadeDuration:400,imageFadeDuration:400,disableScrolling:!0,albumLabel:"Gambar %1 dari %2"}),document.onreadystatechange=function(){"complete"!==document.readyState?(document.querySelector(".page-slider").style.transition="0",document.querySelector(".page-slider").style.opacity=1):(document.querySelector(".page-slider").style.transition="0.5s",document.querySelector(".page-slider").style.opacity=0,document.querySelector(".page-slider").style.visibility="hidden")},$(function(){var t=$(".grid").masonry({transitionDuration:"0.8s"});t.imagesLoaded().progress(function(){t.masonry("layout")})}),$(document).ready(function(){$(document).scroll(function(){$(document).scrollTop()>10?($("nav#navbar").css("transition",".1s ease-in").addClass("bg-white shadow-sm"),$("button#caripost").addClass("btn-outline-light")):($("button#caripost").removeClass("btn-outline-light"),$("nav#navbar").removeClass("bg-white shadow-sm"))});var t=window.pageYOffset;window.onscroll=function(){var e=window.pageYOffset;document.getElementById("navbar").style.top=t>e?"0":"-80px",t=e}}),$(document).ready(function(){$(".rippler").rippler({effectClass:"rippler-effect",effectSize:16,addElement:"div",duration:400})});var $host="http://localhost"==window.location.origin;if($host)var _uri="".concat(window.location.origin,"/smartsite");else _uri="".concat(window.location.origin);var _uriSegment=window.location.pathname.split("/");function listdetail(){var t=this.getAttribute("idp"),e=this.getAttribute("urlpost"),a="";return $.ajax({url:e,type:"post",async:!1,delay:800,data:{id:t},beforeSend:function(){a='<img class="mx-auto text-center d-block p-5" src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/oval-white.svg">')},success:function(t){a=t},error:function(t){a=t.responseText}}),a}function readURL(t,e){if(t.files&&t.files[0]){var a=new FileReader;a.onload=function(t){$(e).attr("src",t.target.result)},a.readAsDataURL(t.files[0])}}console.log(_uri),$(document).ready(function(){$(window).width()<320?$(".sidebar").on("sticky-bottom-unreached",function(){console.log("Bottom unreached")}):$(".sidebar").sticky({topSpacing:30,bottomSpacing:100})}),$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip({offset:"0,10px",padding:10}),$("a#item-populer-post").tooltip({offset:"0,10px",padding:10,placement:"top",title:listdetail,html:!0,container:"body"})}),$(document).ready(function(){$.typeahead({input:".js-nipnama",minLength:12,maxLength:!1,order:"asc",maxItem:1,cache:!1,offset:!1,hint:!0,searchOnFocus:!0,dynamic:!0,delay:500,backdrop:{"background-color":"#000"},emptyTemplate:'Data PNS "<b>{{query}}</b>" tidak ditemukan ',debug:!0,template:function(t){return"<span class='mr-3 pull-left'><img class='img-rounded' src='{{photo}}' width='30' alt='{{nama}}'></span> {{nama}} - {{nip}}"},href:"".concat(_uri,"/frontend/v1/pegawai/detail?filter[query]={{nip}}"),source:{pegawai:{display:["nip"],ajax:function(t){return{type:"POST",url:"http://silka.bkppd-balangankab.info/api/filternipnama",dataType:"json",data:{q:"{{query}}"}}}}},callback:{onClickAfter:function(t,e,a,n){n.preventDefault(),window.open(a.href,"_self")}}})}),$(document).ready(function(){$("a#module").on("click",function(t){t.preventDefault();var e=$(this),a=e.attr("href"),n=$("#containerModule");$("a#module").removeClass("active"),$.ajax({url:a,method:"post",dataType:"html",beforeSend:function(){n.html('<div class="slider"><div class="line"></div> <div class="subline inc"></div> \n                <div class="subline dec"></div></div>')},success:function(t){n.html(t),e.addClass("active")}})})}),$(document).ready(function(){function t(t,e){if(t.files&&t.files[0]){var a=new FileReader;a.onload=function(t){$(e).attr("src",t.target.result)},a.readAsDataURL(t.files[0])}}$("input[name='photo_pic']").change(function(){t(this,$("img.photo_pic"))}),$("input[name='photo_ktp']").change(function(){t(this,$("img.photo_ktp"))}),$(document).ready(function(){$('input[name="photo_pic"]').on("change",function(){var t=this.files[0].name,e=new FormData,a=t.split(".").pop().toLowerCase();-1==jQuery.inArray(a,["jpg","jpeg","png"])&&alert("Invalid Image File"),(new FileReader).readAsDataURL(this.files[0]);var n=this.files[0];(n.size||n.fileSize)>2e6?alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB"):(e.append("file",this.files[0]),$.ajax({url:"".concat(_uri,"/frontend/v1/users/upload_photo?jenis=pic&id=").concat(_uriSegment[6]),method:"POST",data:e,contentType:!1,cache:!1,dataType:"json",processData:!1,beforeSend:function(){$("small.msg-pic").html('Sedang Memperbaharui Gambar <img src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/vtree.svg">'))},success:function(t){$("small.msg-pic").html(t)}}))}),$('input[name="photo_ktp"]').on("change",function(){var t=this.files[0].name,e=new FormData,a=t.split(".").pop().toLowerCase();-1==jQuery.inArray(a,["jpg","jpeg","png"])&&notif({msg:"Invalid Image File",type:"error",position:"center"}),(new FileReader).readAsDataURL(this.files[0]);var n=this.files[0];(n.size||n.fileSize)>2e6?notif({msg:"Ukuran File Gambar Terlalu Besar Maksimal 2MB",type:"warning",position:"center"}):(e.append("file",this.files[0]),$.ajax({url:"".concat(_uri,"/frontend/v1/users/upload_photo?jenis=ktp&id=").concat(_uriSegment[6]),method:"POST",data:e,contentType:!1,cache:!1,dataType:"json",processData:!1,beforeSend:function(){$("small.msg-ktp").html('Sedang Memperbaharui Gambar <img src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/vtree.svg">'))},success:function(t){$("small.msg-ktp").html(t)}}))}),$.validate({form:"#form_edit",modules:"date, security, html5, sanitize",showErrorDialogs:!0,onError:function(t){notif({msg:"Validation of form "+t.attr("id")+" failed!",type:"error",offset:-10,position:"center"})},onSuccess:function(t){var e=t.attr("action"),a=t.attr("method"),n=t.serialize();return $.ajax({url:e,method:a,data:n,cache:!1,dataType:"json",beforeSend:function(){$("button#save").html('<img width="30" height="30" class="d-block mx-auto" src="'.concat(_uri,'/bower_components/SVG-Loaders/svg-loaders/oval-datatable.svg">')).prop("disabled",!0)},success:function(t){1==t.valid&&$("button#save").html('<i class="fas fa-save"></i> Simpan Perubahan').prop("disabled",!1),notif({msg:t.msg,type:t.type,offset:-10,bgcolor:"#000",color:"#fff",timeout:3e3,position:"bottom"})},error:function(t){$("button#save").html('<i class="fas fa-save"></i> Simpan Perubahan').prop("disabled",!1),notif({msg:"<b>Error:</b> Terjadi kesalahan pada server",type:"error",position:"center",offset:-10})}}),!1},onModulesLoaded:function(){$("#alamat").restrictLength($("#maxlength"))}})})});