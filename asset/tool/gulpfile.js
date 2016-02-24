var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');
 
gulp.task('less', function () {
  var minifyCSS = require('gulp-minify-css');
	return gulp.src('../less/*.less')
	  .pipe(less())
	  .pipe(minifyCSS())
	  .pipe(gulp.dest('../css'));
});

gulp.task('default', ['less']);

