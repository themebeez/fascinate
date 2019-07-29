'use strict';


// include all necessary plugins in gulp file

var gulp = require('gulp');

var wpPot = require('gulp-wp-pot');

// var concat = require('gulp-concat');

// var uglify = require('gulp-uglify');

// var rename = require('gulp-rename');

// var cache = require('gulp-cache');





// Task defined for java scripts bundling and minifying

// gulp.task('scripts', function() {


//     return gulp.src([

//             'assets/src/js/jquery/*.js',
//             'assets/src/js/vendor/*.js',
//             'assets/src/js/libraries/*.js',
//             'assets/src/js/custom/*.js',
//         ])

//         .pipe(concat('bundle.js'))

//         .pipe(rename({ suffix: '.min' }))

//         .pipe(uglify())

//         .pipe(gulp.dest('assets/dist/js/'));


// });


// Task watch

// gulp.task('watch', function() {

//     // Watch .js files

//     gulp.watch('assets/src/js/**/**.js', ['scripts']);


// });

gulp.task( 'makepot', function() {

    return gulp.src(['**/*.php'])
        .pipe(wpPot( {
        	team: 'themebeez <themebeez@gmail.com>',
            domain: 'universal-google-adsense-and-ads-manager',
            package: 'Universal Google AdSense And Ads Manager'
        } ))
        .pipe(gulp.dest('languages/universal-google-adsense-and-ads-manager.pot'));
} );


// declaring final task and command tasker

// just hit the command "gulp" it will run the following tasks...


gulp.task('default', gulp.series('makepot'));