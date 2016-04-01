// IMPORTANT
// Run 'npm install' where this file is located before you do anything
var gulp = require('gulp'),
    sass = require('gulp-sass'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    browserSync = require('browser-sync'),
    reload = browserSync.reload;

var path = 'assets'
var paths = {
  src : {
    styles : path + '/sass/**/*.sass',
    scripts : path + '/js/src/*.js',
    vendor : path + '/js/vendor/*.js',
    html : './'
  },
  dist : {
    styles : path + '/css/',
    scripts : path + '/js/min/'
  }
}

var config = {
  // If you want a static server use
  // server : {}
  //
  // If you want to connect to a site in MAMP use
  // proxy : 'site.local'
  files : paths.dist.styles + '**/*.css',
  proxy : 'site.local'
}

/*
  SASS
  compile SASS
*/
gulp.task('sass', function () {
  return gulp.src(paths.src.styles)
  .pipe(sass().on('error', sass.logError))
  .pipe(gulp.dest(paths.dist.styles))
  .pipe(browserSync.stream());
});

/*
  JS
  compile JS
*/
gulp.task('scripts', function() {
  return gulp.src(paths.src.scripts)
  .pipe(uglify())
  .pipe(rename({
    suffix : '.min'
  }))
  .pipe(gulp.dest(paths.dist.scripts))
  .pipe(browserSync.stream());
});

/*
  JS
  concat vendor JS
*/
gulp.task('concat', function() {
  return gulp.src(paths.src.vendor)
    .pipe(concat('all.js'))
    .pipe(gulp.dest('./assets/js/'));
});

/*
  HTML
  watch HTML files and reload when changed
*/
gulp.task('html', function() {
  return gulp.src(paths.src.html)
    .pipe(browserSync.reload({ stream : true, once : true}));
});

/*
  Browser Sync
  sync browser to local code changes
*/
gulp.task('browser-sync', function() {
  browserSync(config);
});

gulp.task('default', ['browser-sync', 'concat'], function(){
  gulp.watch(paths.src.styles, ['sass']);
  gulp.watch(paths.src.scripts, ['scripts']);
  gulp.watch(paths.src.html + '**/*.php', ['html']);
});