var gulp = require("gulp");
var bulkSass = require("gulp-sass-bulk-import");
const sass = require('gulp-sass')(require('sass'));
var plumber = require("gulp-plumber");
var notify = require("gulp-notify");
var uglify = require("gulp-uglify");
var rename = require("gulp-rename");
var concat = require("gulp-concat");
// New Module
var newer = require("gulp-newer");
var imagemin = require("gulp-imagemin");
var mozjpeg = require("imagemin-mozjpeg");
// New Module for Install Wordpress
var fs = require("fs");
var clean = require("gulp-clean");
var unzip = require("gulp-unzip");
var download = require("gulp-download2");
var wait = require("gulp-wait");
//New connect
var browserSync = require("browser-sync");
var gulpRanInThisFolder = process.cwd();
var res = gulpRanInThisFolder.split("/");
var ProjectName = res[res.length - 1];
url = "" + ProjectName + ".test";
var sourcemaps = require("gulp-sourcemaps");
// :nested
// :compact
// :expanded
// :compressed

// Common Settings
// ---------------------------------------------------------------------------
var srcDir = "src/";
var distDir = "dist/";
var wordpressVersion = "latest";
var plugins = [
  "https://alive:alive335@pro.alive-web.vn/template-plugins/acf-latest.zip",
  "https://downloads.wordpress.org/plugin/akismet.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/categories-in-hierarchical-order.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/duplicate-post.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/ninjafirewall.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/simple-custom-post-order.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/tinymce-advanced.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/wp-multibyte-patch.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/wp-pagenavi.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/ninjascanner.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/siteguard.latest-stable.zip",
  "https://downloads.wordpress.org/plugin/webp-express.latest-stable.zip",
];

gulp.task("downloadWP", function (done) {
  if (!fs.existsSync(distDir + "wp/wp-admin/index.php")) {
    return download("https://wordpress.org/" + wordpressVersion + ".zip").pipe(
      gulp.dest(distDir)
    );
  } else console.log("-- [Checked] Exists Wordpress!");
  done();
});

gulp.task("downloadPlugin", ["downloadWP"], function (done) {
  return download(plugins).pipe(gulp.dest(distDir + "wp/wp-content/plugins/"));
  done();
});

gulp.task("unzipPlugins", ["downloadPlugin"], function (done) {
  fs.readdir(distDir + "wp/wp-content/plugins/", function (err, files) {
    files.forEach(function (file) {
      if (file.indexOf(".zip") !== -1) {
        gulp
          .src(distDir + "wp/wp-content/plugins/" + file)
          .pipe(unzip())
          .pipe(gulp.dest(distDir + "wp/wp-content/plugins/"));
      }
    });
  });
  return done();
});

gulp.task("deletePluginZips", ["unzipPlugins"], function (done) {
  fs.readdir(distDir + "wp/wp-content/plugins/", function (err, files) {
    files.forEach(function (file) {
      if (file.indexOf(".zip") !== -1) {
        gulp
          .src(distDir + "wp/wp-content/plugins/" + file, { read: false })
          .pipe(clean({ force: true }));
      }
    });
  });
  return done();
});

gulp.task("unzipWP", ["deletePluginZips"], function (done) {
  if (!fs.existsSync(distDir + "wp/wp-admin/index.php")) {
    return gulp
      .src(distDir + wordpressVersion + ".zip")
      .pipe(unzip())
      .pipe(gulp.dest(distDir));
  } else console.log("-- [Checked] Exists Wordpress!");
  return done();
});

gulp.task("renameWP", ["unzipWP"], function (done) {
  if (
    !fs.existsSync(distDir + "_wp/") &&
    fs.existsSync(distDir + "wordpress/")
  ) {
    fs.rename(distDir + "wp", distDir + "_wp", function (err) {
      if (err) throw err;
      console.log("-- [Renamed] wp > _wp successfully");
      if (fs.existsSync(distDir + "wordpress/")) {
        fs.rename(distDir + "wordpress", distDir + "wp", function (err) {
          if (err) throw err;
          console.log("-- [Renamed] wordpress > wp successfully");
          done();
          return;
        });
      }
    });
  } else {
    console.log("-- [Checked] Exists Wordpress!");
    done();
  }
});

gulp.task("deleteWPDefaultTheme", ["renameWP"], function (done) {
  if (fs.existsSync(distDir + "wp/wp-content/themes/")) {
    gulp
      .src(["dist/wp/wp-content/themes/**/*"], { read: false })
      .pipe(wait(9999))
      .pipe(clean({ force: true }));
    console.log("-- [Remove] Default themes successfully");
  }
  done();
});

gulp.task("copyWP", ["deleteWPDefaultTheme"], function (done) {
  if (fs.existsSync(distDir + "_wp/")) {
    gulp
      .src(distDir + "_wp/wp-content/themes/**/*")
      .pipe(gulp.dest(distDir + "wp/wp-content/themes/"));
    console.log("-- [Copy] Template successfully");
    return gulp
      .src(distDir + "_wp/wp-content/plugins/**/*")
      .pipe(gulp.dest(distDir + "wp/wp-content/plugins"));
    console.log("-- [Copy] Plugins successfully");
  } else {
    console.log("-- [Checked] Exists Wordpress!");
    done();
  }
});

gulp.task("delWPTemp", ["copyWP"], function (done) {
  if (fs.existsSync(distDir + "_wp/")) {
    gulp
      .src(distDir + "_wp/", { read: false })
      .pipe(wait(9999))
      .pipe(clean({ force: true }));
    console.log("-- [Remove] _wp directory successfully");
  }
  if (fs.existsSync(distDir + wordpressVersion + ".zip")) {
    gulp
      .src(distDir + wordpressVersion + ".zip", { read: false })
      .pipe(wait(9999))
      .pipe(clean({ force: true }));
    console.log("-- [Remove] " + wordpressVersion + ".zip successfully");
  }
  done();
});

gulp.task("sass", ["sass_common", "sass_pages", "sass_libs"]);
gulp.task("sass_common", function () {
  return gulp
    .src([srcDir + "scss/style.scss"])
    .pipe(bulkSass())
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        outputStyle: "compressed",
        errLogToConsole: false,
        includePaths: [srcDir, "mod/"],
      })
    )
    .on("error", function (err) {
      notify().write(err);
      this.emit("end");
    })
    .pipe(rename({ suffix: ".min" }))
    .pipe(sourcemaps.write("/maps"))
    .pipe(gulp.dest(distDir + "assets/css"))
    .pipe(
      browserSync.reload({
        stream: true,
      })
    );
});
gulp.task("sass_pages", function () {
  return gulp
    .src([srcDir + "scss/page/*"])
    .pipe(bulkSass())
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        outputStyle: "compressed",
        errLogToConsole: false,
        includePaths: [srcDir, "mod/"],
      })
    )
    .on("error", function (err) {
      notify().write(err);
      this.emit("end");
    })
    .pipe(rename({ suffix: ".min" }))
    .pipe(sourcemaps.write("/maps"))
    .pipe(gulp.dest(distDir + "assets/css/page"))
    .pipe(
      browserSync.reload({
        stream: true,
      })
    );
});
gulp.task("sass_libs", function () {
  return gulp
    .src([srcDir + "scss/lib/*"])
    .pipe(bulkSass())
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        outputStyle: "compressed",
        errLogToConsole: false,
        includePaths: [srcDir, "mod/"],
      })
    )
    .on("error", function (err) {
      notify().write(err);
      this.emit("end");
    })
    .pipe(rename({ suffix: ".min" }))
    .pipe(sourcemaps.write("/maps"))
    .pipe(gulp.dest(distDir + "assets/css/lib"))
    .pipe(
      browserSync.reload({
        stream: true,
      })
    );
});

// js Task Settings
gulp.task("js", ["js_common", "js_pages", "js_libs"]);
gulp.task("js_common", function () {
  return (
    gulp
      .src([
        "src/js/common/jquery-3.6.0.js", // concat in order jquery first, remove if use CDN
        "src/js/common/**/*.js",
        "src/js/*.js",
      ])
      .pipe(plumber())
      .pipe(concat("common.js")) //file join
      //.pipe(rename('app.js'))  // file rename
      .pipe(
        uglify({
          //minfy
          // preserveComments: 'some' // comment options
        })
      )
      .pipe(rename({ suffix: ".min" }))
      .pipe(gulp.dest(distDir + "assets/js"))
  ); // file dir
  //.pipe(notify('js task finished')); // message
});
gulp.task("js_pages", function () {
  return (
    gulp
      .src("src/js/page/*.js")
      .pipe(plumber())
      // .pipe(concat('common.js')) //file join
      //.pipe(rename('app.js'))  // file rename
      .pipe(
        uglify({
          //minfy
          // preserveComments: 'some' // comment options
        })
      )
      .pipe(rename({ suffix: ".min" }))
      .pipe(gulp.dest(distDir + "assets/js/page"))
  ); // file dir
  //.pipe(notify('js task finished')); // message
});
gulp.task("js_libs", function () {
  return (
    gulp
      .src("src/js/lib/*.js")
      .pipe(plumber())
      // .pipe(concat('common.js')) //file join
      //.pipe(rename('app.js'))  // file rename
      .pipe(
        uglify({
          //minfy
          // preserveComments: 'some' // comment options
        })
      )
      .pipe(rename({ suffix: ".min" }))
      .pipe(gulp.dest(distDir + "assets/js/lib"))
  ); // file dir
  //.pipe(notify('js task finished')); // message
});

// Images
gulp.task("images", function () {
  var imageDir = distDir + "assets/img/";
  return gulp
    .src([srcDir + "img/**/*"])
    .pipe(newer(imageDir))
    .pipe(
      imagemin([
        mozjpeg({
          quality: 90,
          progressive: true,
        }),
        imagemin.svgo(),
        imagemin.optipng(),
        imagemin.gifsicle(),
      ])
    )
    .pipe(gulp.dest(imageDir));
  // .pipe(notify('Image Copy & Minify Done.'));
});

gulp.task("reload", function () {
  browserSync.reload();
});
gulp.task("reload_stream", function () {
  browserSync.reload({
    stream: true,
  });
});

gulp.task("browser-sync", function () {
  var files = ["**/*.php", "**/*.{png,jpg,gif}"];
  browserSync.init(files, {
    // Read here http://www.browsersync.io/docs/options/
    host: url,
    proxy: url,
    port: 10001,
    notify: false,
    open: "external",
    // Inject CSS changes
    injectChanges: true,
    // Open the site in Chrome
  });
});

gulp.task("build", ["sass", "js", "images"]);

gulp.task("watch", function () {
  gulp.watch(srcDir + "scss/**/*.scss", ["sass"]); //run compass
  gulp.watch(srcDir + "js/**/*.js", ["js"]); //run compass
  gulp.watch(["**/*.css"], ["reload_stream"]);
  gulp.watch(["**/*.php"], ["reload"]);
  gulp.watch(srcDir + "img/**/*", ["images"]);
});

gulp.task("default", ["build", "watch", "browser-sync"]);
gulp.task("wp", [
  "downloadWP",
  "downloadPlugin",
  "unzipPlugins",
  "deletePluginZips",
  "unzipWP",
  "renameWP",
  "deleteWPDefaultTheme",
  "copyWP",
  "delWPTemp",
]);
