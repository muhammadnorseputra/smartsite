var gulp = require("gulp");

var concat = require("gulp-concat");
var babel = require('gulp-babel');
var minify = require("gulp-minify");
var sass = require('gulp-sass')(require('sass'));
const hash = require('gulp-hash-filename');
const javascriptObfuscator = require('gulp-javascript-obfuscator');


// sass.compiler = require('node-sass');
gulp.task('sass', function() {
    return gulp.src('template/v1/scss/app.scss')
        .pipe(sass({
            outputStyle: 'compressed',
            quietDeps: true
        }).on('error', sass.logError))
        .pipe(minify())
        .pipe(gulp.dest('template/v1/prod/'));
});

gulp.task('CSSHash', function() {
    return gulp.src(['template/v1/prod/app.css'])
        .pipe(hash({
            "format": "{name}.{hash}.{size}{ext}"
        }))
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(gulp.dest('template/v1/prod/'));
});

gulp.task("js", function() {
    return gulp
        .src("template/v1/js/*.js")
        .pipe(
            babel({
                presets: ["@babel/env"],
            })
        )
        // .pipe(javascriptObfuscator({
        //     compact: true
        // }))
        .pipe(concat("app.js"))
        .pipe(minify())
        .pipe(gulp.dest("template/v1/prod/"));
});

gulp.task("vendor", function() {
    return gulp
        .src([
            "bower_components/jquery/dist/jquery.min.js",
            "bower_components/jssocials/dist/jssocials.js",
            "bower_components/lightbox2/dist/js/lightbox.min.js",
            "bower_components/masonry-layout/dist/masonry.pkgd.min.js",
            "bower_components/imagesloaded/imagesloaded.pkgd.min.js",
            "bower_components/emojionearea/js/emojionearea.min.js",
            // "bower_components/jquery-typeahead/dist/jquery.typeahead.min.js",
            "template/v1/plugin/slick/slick/slick.min.js",
            // "template/v1/plugin/popmodal/popModal.min.js",
            "template/v1/plugin/lazyload/jquery.lazy.min.js",
            "template/v1/plugin/lazyload/jquery.lazy.plugins.min.js",
            // "bower_components/antimoderate/antimoderate.min.js",
            // "template/v1/plugin/focus-element/app/focus-element-overlay.js",
            // "template/v1/plugin/nav-autohide/bootstrap-autohide-navbar.min.js",
            "template/v1/plugin/notifIt/js/notifIt.min.js",
            // "template/v1/plugin/rellax/rellax.min.js",
            "template/v1/plugin/rippler/dist/js/jquery.rippler.min.js",
            // "template/v1/plugin/camera/scripts/jquery.easing.1.3.js",
            // "template/v1/plugin/camera/scripts/camera.min.js",
            // "template/v1/plugin/dark-mode/dark-mode-switch.js",
            "assets/plugins/jquery-cookie/jquery.cookie.js",
            // "assets/plugins/jquery-countto/jquery.countTo.js",
            "assets/plugins/jquery-confirm/jquery-confirm.min.js",
            "bower_components/bootstrap/dist/js/bootstrap.bundle.min.js",
            // "bower_components/typed.js/lib/typed.min.js",
            // "bower_components/jquery-mask-plugin/dist/jquery.mask.min.js",
            "bower_components/jquery-form-validator/form-validator/jquery.form-validator.min.js",
            "bower_components/easyticker-jquery/dist/jquery.easy-ticker.min.js",
            // "bower_components/aos/dist/aos.js",
            // "assets/plugins/pace/pace.min.js",
            // "assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js",
            // "assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",
            // "bower_components/jquery.scrollTo/jquery.scrollTo.min.js",
            // "bower_components/hc-sticky/dist/hc-sticky.js"
        ])
        // .pipe(javascriptObfuscator({
        //     compact: true
        // }))
        .pipe(concat("vendor.js"))
        .pipe(minify())
        .pipe(gulp.dest("template/v1/prod/"));
});
// gulp.task('prod', gulp.parallel('sass', 'js', 'vendor'));
gulp.task('watch', function() {
    gulp.watch('template/v1/scss/*.scss', gulp.series(['sass']));
    gulp.watch('template/v1/js/*.js', gulp.series(['js']));
    // Other watchers
})