"use strict";

var gulp            = require('gulp');
var sass            = require('gulp-sass')(require('sass'));
var notify          = require('gulp-notify');
var autoprefixer    = require('gulp-autoprefixer');
var plumber         = require('gulp-plumber');
var sourcemaps      = require('gulp-sourcemaps');
var browserSync     = require('browser-sync').create();

var rename          = require('gulp-rename');
var cssnano         = require('gulp-cssnano');

var environments  = require('gulp-environments');
var development   = environments.development;
var production    = environments.production;

//environments.current(development); // Set current environment to DEVELOPMENT
environments.current(production); // Set current environment to PRODUCTION
var current_env = environments.current();


function handleErrors() {
  var args = Array.prototype.slice.call(arguments);

  // Send error to notification center with gulp-notify
  notify.onError({
    title: "Compile Error",
    message: "<%= error %>"
  }).apply(this, args);

  // Keep gulp from hanging on this task
  this.emit('end');
}

/**
 * Browsersync
 *******************************************************************************************************/
var site = 'denstetsenko.local'; // CHANGE IT FOR EVERY SITE

// see: https://www.browsersync.io/docs/options/
var browserSyncWatchFiles = [
  './assets/styles/css/*.css',
  './assets/js/custom.js',
  './**/*.php'
];

// see: https://www.browsersync.io/docs/options/
var browserSyncOptions = {
  logPrefix: site.toUpperCase(),
  proxy:     "https://" + site,
  host:      site,
  open:      false,
  notify:    false,
  ghost:     false,
  ui:        false,
  injectChanges: true,
  snippetOptions: {
    whitelist: ["/wp-admin/admin-ajax.php"], // whitelist checked first
    blacklist: ["/wp-admin/**"],
    ignorePaths: ["wp-admin/**"]
  },
  https: {
    key: "/Applications/MAMP/Library/OpenSSL/certs/"+ site +".key",
    cert: "/Applications/MAMP/Library/OpenSSL/certs/"+ site +".crt"
  }
};



/**
 * Define Base Paths
 *******************************************************************************************************/
var basePaths = {
  scss    : './assets/styles/scss/',
  css     : './assets/styles/css/',
};

// Add vendor prefixes to child styles
var dev_styles = [
  { src : basePaths.scss + 'base/_general.scss', dest : basePaths.scss + 'base/' },
  { src : basePaths.scss + 'layout/**.scss', dest : basePaths.scss + 'layout/' },
  { src : basePaths.scss + 'pages/**.scss', dest : basePaths.scss + 'pages/' },
  { src : basePaths.scss + 'sitewide-sections/**.scss', dest : basePaths.scss + 'sitewide-sections/' }
];

gulp.task('autoprefixes', function(cb) {
  dev_styles.map(function(file) {
    return gulp.src(file.src)
        .pipe(plumber().on('error', handleErrors))
        .pipe(autoprefixer({ cascade: false }).on('error', handleErrors))
        .pipe(gulp.dest(file.dest) )
  });
  cb();
});


gulp.task('sass', function () {
  return gulp.src(basePaths.scss + 'main.scss')
      .pipe(plumber())
      .pipe(development(sourcemaps.init({loadMaps: true, largeFile: true})))
      .pipe(sass().on('error', handleErrors))
      .pipe(production(autoprefixer({ cascade: false })))
      .pipe(development(sourcemaps.write()))
      .pipe(production(rename({basename: 'main', suffix: '.min'})))
      .pipe(production(cssnano({ discardComments: { removeAll: true }, reduceIdents: false })))
      .pipe(gulp.dest(basePaths.css))
      .pipe(development(browserSync.stream({ match: '**/*.css' })));
});

gulp.task('watch', function () {

  // Run browsersync only for DEV ENV
  if (current_env === development){
    browserSync.init(browserSyncWatchFiles, browserSyncOptions);
  }

  gulp.watch(basePaths.scss + '**/*.scss', gulp.series('sass'));

});

gulp.task('default', gulp.series('watch'));