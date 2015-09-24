var gulp = require('gulp'),
    less = require('gulp-less'),
    path = require('path'),
    rename = require('gulp-rename'),
    rucksack = require('gulp-rucksack');

gulp.task('styles', function () {
    return gulp.src('./source/less/main.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less') ]
        }))
        .pipe(rucksack({
            autoprefixer: true,
            fallbacks: true
        }))
        .pipe(rename('styles.min.css'))
        .pipe(gulp.dest('./assets'));
});

gulp.task('watch', function() {
    gulp.watch('./source/less/**/*.less', ['styles']);
});

gulp.task('default', function() {
    gulp.start('watch');
});