/**
 * ============= REQUIRE ===================
 */
const gulp = require('gulp');
const plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer')
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var gulpCopy      = require('gulp-copy');

var browserSync = require('browser-sync');
var reload = browserSync.reload;

// iconfont
var iconfont = require('gulp-iconfont');
var iconfontCss = require('gulp-iconfont-css');
var runTimestamp = Math.round(Date.now()/1000);

// font gen
var webfont = require('gulp-webfont');
/**
 * =========================================
 */

var webfont_config = {
  types:'eot,woff2,woff,ttf,svg',
  ligatures: true
};

gulp.task('webfont', function () {
return gulp.src('./font/*.otf')
  .pipe(webfont(webfont_config))
  .pipe(gulp.dest('../assets/fonts'));
});

// icon fonts
var fontName = 'icons'; 
gulp.task('iconfont', function() {
  gulp.src(['../assets/images/icons/*.svg'])
    .pipe(iconfontCss({
      fontName: fontName,
      targetPath: '../../gulp/sass/_icons.scss',
      fontPath: '../fonts/'
    }))
    .pipe(iconfont({
      fontName: fontName,
      // Remove woff2 if you get an ext error on compile
      formats: ['svg', 'ttf', 'eot', 'woff', 'woff2'],
      normalize: true,
      fontHeight: 1001
    }))
    .pipe(gulp.dest('../assets/fonts/'))
});


/**
 * ================= TASKS =================
 */

//SASS + CONCAT CSS+SASS
gulp.task('sass-general', function(){
  gulp.src([
    'sass/head-comments/comments.css',
    'sass/main.sass'
    ])
  .pipe(plumber())
  .pipe(sass())
  .pipe(autoprefixer('last 5 versions'))
  .pipe(concat('style.css'))
  .pipe(gulp.dest('../assets/css/'))
})

//SASS + CONCAT CSS+SASS ie9
gulp.task('sass-ie9', function(){
  gulp.src([
    'sass/ie9.sass'
    ])
  .pipe(plumber())
  .pipe(sass())
  //.pipe(autoprefixer('last 5 versions'))
  .pipe(concat('style-ie9.css'))
  .pipe(gulp.dest('../assets/css/'))
})

//CONCAT JS
gulp.task('concat-js',function(){

  var srcJs = [
    './js/scripts.js',
    ]

  gulp.src(srcJs)
  .pipe(plumber())
  .pipe(uglify())
  .pipe(concat('scripts.min.js'))
  .pipe(gulp.dest('../assets/js'))
})

/**
 * =========================================
 */
 /**
  * ================ browserSync ================
  */
  gulp.task('browser-sync', function() {
    //watch files
    var files = [
      '../assets/js/*js',
      '../assets/css/*.css',
      '../**/*.php'
    ];

    //initialize browsersync
    browserSync.init(files, {
      //browsersync with a php server
      proxy: "localhost",
      notify: false
    });
  });

/**
 * ================ WATCH ================
 */

gulp.task('watch', function(){
    gulp.watch('sass/*.sass', ['sass-general','sass-ie9']);
    gulp.watch('sass/head-comments/comments.css', ['sass-general','sass-ie9']);
    gulp.watch('sass/**/*.sass', ['sass-general','sass-ie9']);
    gulp.watch('sass/**/*.scss', ['sass-general','sass-ie9']);
    gulp.watch('js/*.js', ['concat-js']);
    gulp.watch('../assets/images/icons/*.svg',['iconfont'])
})

/**
 * =========================================
 */



/**
 * ================ DEFAULT ================
 */

gulp.task('default', ['iconfont','sass-general','sass-ie9','concat-js','browser-sync','watch'])
gulp.task('build', ['iconfont','sass-general','sass-ie9','concat-js','browser-sync','watch'])

/**
 * =========================================
 */
