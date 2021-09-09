<footer>
<section class="bg-white">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center pb-5 mb-5 mb-md-0 py-3 pb-md-3 d-flex align-items-center justify-content-between flex-lg-row flex-column">
				<div class="text-left text-muted">
					<div class="small">Hak Cipta &copy; <?php echo date('Y') ?> Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan.</div>
				</div>
				<!-- <div class="text-right text-white d-none d-md-block d-lg-block">
					
				</div> -->
			</div>
		</div>
	</div> 
</section>
</footer>
<!-- jQuery -->
<script defer="defer" src="<?= base_url('template/v1/prod/vendor-min.js'); ?>" crossorigin="anonymous"></script>
<script defer="defer" src="<?= base_url('template/v1/prod/app-min.js'); ?>" crossorigin="anonymous"></script>
<script>
    /*! loadCSS. [c]2017 Filament Group, Inc. MIT License */
    !function(a){"use strict";var b=function(b,c,d){function j(a){if(e.body)return a();setTimeout(function(){j(a)})}function l(){f.addEventListener&&f.removeEventListener("load",l),f.media=d||"all"}var g,e=a.document,f=e.createElement("link");if(c)g=c;else{var h=(e.body||e.getElementsByTagName("head")[0]).childNodes;g=h[h.length-1]}var i=e.styleSheets;f.rel="stylesheet",f.href=b,f.media="only x",j(function(){g.parentNode.insertBefore(f,c?g:g.nextSibling)});var k=function(a){for(var b=f.href,c=i.length;c--;)if(i[c].href===b)return a();setTimeout(function(){k(a)})};return f.addEventListener&&f.addEventListener("load",l),f.onloadcssdefined=k,k(l),f};"undefined"!=typeof exports?exports.loadCSS=b:a.loadCSS=b}("undefined"!=typeof global?global:this);
    /*! loadCSS rel=preload polyfill. [c]2017 Filament Group, Inc. MIT License */
    !function(a){if(a.loadCSS){var b=loadCSS.relpreload={};if(b.support=function(){try{return a.document.createElement("link").relList.supports("preload")}catch(a){return!1}},b.poly=function(){for(var b=a.document.getElementsByTagName("link"),c=0;c<b.length;c++){var d=b[c];"preload"===d.rel&&"style"===d.getAttribute("as")&&(a.loadCSS(d.href,d,d.getAttribute("media")),d.rel=null)}},!b.support()){b.poly();var c=a.setInterval(b.poly,300);a.addEventListener&&a.addEventListener("load",function(){b.poly(),a.clearInterval(c)}),a.attachEvent&&a.attachEvent("onload",function(){a.clearInterval(c)})}}}(this);
  </script>

<script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),p.appendChild(s);})(document.createElement('script'),'https://iclickcdn.com/tag.min.js',4509058,document.body||document.documentElement)</script>
</body>
</html>