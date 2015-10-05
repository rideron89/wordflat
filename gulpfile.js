var gulp = require('gulp'),
    less = require('gulp-less'),
    nano = require('gulp-cssnano'),
    path = require('path'),
    postcss = require('gulp-postcss'),
    rename = require('gulp-rename'),
    rucksack = require('gulp-rucksack');

gulp.task('styles', function () {
    return gulp.src('./source/less/main.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less') ]
        }))
        .pipe(postcss([
        ]))
        .pipe(rucksack({
            autoprefixer: true,
            fallbacks: true
        }))
        .pipe(nano())
        .pipe(rename('styles.min.css'))
        .pipe(gulp.dest('./assets'));
});

gulp.task('minify-styles', function() {
    return gulp.src('./assets/styles.css')
        .pipe(nano())
        .pipe(rename('styles.min.css'))
        .pipe(gulp.dest('./assets'));
});

gulp.task('watch', function() {
    gulp.watch('./source/less/**/*.less', ['styles']);
});

gulp.task('default', function() {
    gulp.start('watch');
});