const gulp = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

gulp.task('scripts', function() {
    return gulp.src('public/assets/js/admin/*.js')
      .pipe(concat('app.min.js'))
      .pipe(uglify())
      .pipe(gulp.dest('public/assets/js/admin/'));
  });
  
  // Define a default task
  gulp.task('default', gulp.series('scripts'));