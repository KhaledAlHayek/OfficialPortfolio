const gulp     = require("gulp"),
      concat   = require("gulp-concat"),
      prefixer = require("gulp-autoprefixer"),
      sass     = require("gulp-sass")(require("sass")),
      minify   = require("gulp-minify"),
      srcmaps  = require("gulp-sourcemaps"),
      zip      = require("gulp-zip");

gulp.task("cssTask", () => {
  return gulp.src("./layout/sass/*.sass")
  .pipe(srcmaps.init())
  .pipe(sass({outputStyle: "compressed"}).on("error", sass.logError))
  .pipe(prefixer("last 2 versions"))
  .pipe(concat("main.css"))
  .pipe(srcmaps.write("."))
  .pipe(gulp.dest("./layout/dist/css/"))
})

gulp.task("jsTask", () => {
  return gulp.src(["./layout/js/index.js", "./layout/js/app.js"])
  .pipe(minify({noSource: true}))
  .pipe(gulp.dest("./layout/dist/js/"))
});

gulp.task("adminCSSTask", () => {
  return gulp.src("./admin/layout/sass/*.sass")
  .pipe(srcmaps.init())
  .pipe(sass({outputStyle: "compressed"}).on("error", sass.logError))
  .pipe(prefixer("last 2 versions"))
  .pipe(concat("main.css"))
  .pipe(srcmaps.write("."))
  .pipe(gulp.dest("./admin/layout/dist/css/"))
})

gulp.task("allJS", () => {
  return gulp.src("./admin/layout/js/*.js")
  .pipe(minify({noSource: true}))
  .pipe(gulp.dest("./admin/layout/dist/js/"))
})

gulp.task("watchTasks", () => {
  gulp.watch("./layout/sass/*.sass", gulp.series("cssTask"));
  gulp.watch("./admin/layout/sass/*.sass", gulp.series("adminCSSTask"));
  gulp.watch("./admin/layout/js/*.js", gulp.series("allJS"));
  gulp.watch(["./layout/js/index.js", "./layout/js/app.js"], gulp.series("jsTask"));
})