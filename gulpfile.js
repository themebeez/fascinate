
const gulp = require('gulp');
const zip = require('gulp-zip');
const wpPot = require('gulp-wp-pot');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const rtlcss = require('gulp-rtlcss');
const rename = require('gulp-rename');
const shell = require('gulp-shell');

/*
*
# npm update
# npm init
# npm install gulp@4.0.2 gulp-zip gulp-wp-pot gulp-sourcemaps gulp-sass sass gulp-concat gulp-uglify gulp-postcss autoprefixer cssnano gulp-replace gulp-notify gulp-plumber gulp-rtlcss gulp-rename --save-dev
*
*/


/*
####################
=
= Var 1: varibales to ZIP production files
=
####################
*/

// #1.1 project name 

const output_filename = 'fascinate.zip';

// #1.2 files & folders to zip
const files_folders = {

    filefolders_src: [

        './*',
        './*/**',

        '!./node_modules/**',
        '!./assets/src/**',
        '!./gulpfile.js',
        '!./.gitignore',
        '!./package.json',
        '!./package-lock.json',
        '!./composer.json',
        '!./composer.lock',
        '!./README.md',
        '!./sftp-config.json'
    ],

    production_zip_file_path: "./",
}

/*
####################
=
= Var 2: varibales to make WP POT file
=
####################
*/

// #2.1 path of php files to generate WordPress POT file

const php_files = {

    php_files_path: [

        './**/*.php',
        '!./inc/plugin-recommendation.php',
        '!./third-party/class-tgm-plugin-activation.php',
    ],
}

// #2.2 project text domain

const project_name = 'Fascinate';
const project_text_domain = 'fascinate';

/*
####################
=
= Var 3: varibales for facinate static resources 
=
####################
*/

// #3.1 Script files path
const facinateScriptsPath = {

    facinate_scripts_path: [

        './assets/src/js/libraries/*.js',
        './assets/src/js/custom/*.js',
        '!./assets/src/js/conditional/**'
    ],

    facinate_script_dist: "./assets/dist/js/",
}
const facinate_build_js_file_name = "bundle.js"; // what would you like to name your minified bundled js file


// #3.2 Conditional scripts
const facinateConditionalScriptsPath = {

    facinate_con_scripts_src: [

        './assets/src/js/conditional/*/**.js',
    ],

    facinate_con_scripts_dist: "./assets/dist/js/conditional/",
}


// #3.3 SASS/SCSS file path
const facinateSassPath = {

    facinate_sass_src: ["./assets/src/scss/**/*.scss", "!./assets/src/scss/conditional/**"],
    facinate_sass_dist: "./assets/dist/css/",
}
const facinate_compiled_sass_css_file_name = "main.css"; // what would you like to name your compiled CSS file


// #3.4 Conditional SASS/SCSS file path 
const facinateConditionalSassPath = {

    facinate_cond_sass_src: "./assets/src/scss/conditional/**/*.scss",
    facinate_cond_sass_dist: "./assets/dist/css/conditional/",
}

// #3.5 LTR & RTL CSS path
const facinateRtlCssPath = {

    facinate_rtlcss_src: "./assets/dist/css/" + facinate_compiled_sass_css_file_name,
    facinate_rtlcss_dist: "./assets/dist/css/", // where would you like to save your generated RTL CSS
}


/*
===========================================================
=
= Task 1: Make POT file
=
====================================================
*/

gulp.task('WordpressPot', function () {
    return gulp.src(php_files.php_files_path)
        .pipe(wpPot({
            domain: project_text_domain,
            package: project_name,
        }))
        .pipe(gulp.dest('languages/' + project_text_domain + '.pot'));
});

/*
===========================================================
=
= Task 2: Zips production files
=
====================================================
*/

gulp.task('ZipProductionFiles', function () {
    return gulp.src(files_folders.filefolders_src)
        .pipe(zip(output_filename))
        .pipe(gulp.dest(files_folders.production_zip_file_path))
});

/*
===========================================================
=
= Task 3: Compile facinate static resources
=
====================================================
*/

gulp.task('facinateScriptsTask', function () {
    return gulp.src(facinateScriptsPath.facinate_scripts_path)
        .pipe(concat(facinate_build_js_file_name))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(facinateScriptsPath.facinate_script_dist));
});

gulp.task('facinateConditionalScriptsTask', function () {
    return gulp.src(facinateConditionalScriptsPath.facinate_con_scripts_src)
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(facinateConditionalScriptsPath.facinate_con_scripts_dist));
});

gulp.task('facinateSassTask', function () {
    var onError = function (err) {
        notify.onError({
            title: "Gulp",
            subtitle: "Failure!",
            message: "Error: <%= error.message %>",
            sound: "Beep"
        })(err);
        this.emit('end');
    };
    return gulp.src(facinateSassPath.facinate_sass_src)
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(postcss([autoprefixer('last 2 version'), cssnano()])) // PostCSS plugins
        .pipe(concat(facinate_compiled_sass_css_file_name))
        .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
        .pipe(gulp.dest(facinateSassPath.facinate_sass_dist)); // put final CSS in dist folder
});

gulp.task('facinateConditionalSassTask', function () {
    var onError = function (err) {
        notify.onError({
            title: "Gulp",
            subtitle: "Failure!",
            message: "Error: <%= error.message %>",
            sound: "Beep"
        })(err);
        this.emit('end');
    };
    return gulp.src(facinateConditionalSassPath.facinate_cond_sass_src)
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(postcss([autoprefixer('last 2 version'), cssnano()])) // PostCSS plugins
        .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
        .pipe(gulp.dest(facinateConditionalSassPath.facinate_cond_sass_dist)); // put final CSS in dist folder
});

// task to convert LTR css to RTL
gulp.task('facinateDortlTask', function () {
    return gulp.src(facinateRtlCssPath.facinate_rtlcss_src)
        .pipe(rtlcss()) // Convert to RTL.
        .pipe(rename({ suffix: '-rtl' })) // Append "-rtl" to the filename.
        .pipe(gulp.dest(facinateRtlCssPath.facinate_rtlcss_dist)); // Output RTL stylesheets.
});


/*
++++++++++++++++++++++++++++++++++++++++++++++++++++
=
= Run All tasks
=
++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

//=========================================
// = C O M M A N D S                      = 
//=========================================
//
// 1. Command: gulp makepot (will generate WP POT file)
// 2. Command: gulp assets (will compile facinate scss, js & watch for the changes)
// 3. Command: gulp zipprod (zips the production files)
//
//=========================================

// Run Task: none, just echo message for default command

gulp.task('default', shell.task(

    'echo ====================== ⛔️ Hello Folks, gulp default command is disabled in this project. These are the available commands gulp zip, gulp assets, gulp pot. If you need additional info refer gulpfile.js L269. Cheers 😜 ======================',

));


// Run Task: Zip production files

gulp.task('zip', gulp.series('ZipProductionFiles', (done) => {

    done();
}));

// Run Task: Make Pot file

gulp.task('pot', gulp.series('WordpressPot', (done) => {

    gulp.watch(files_folders.filefolders_src, gulp.series('WordpressPot'));
    done();
}));

// Run Task: Compile facinate assets.

gulp.task('assets', gulp.series('facinateScriptsTask', 'facinateConditionalScriptsTask', 'facinateSassTask', 'facinateConditionalSassTask', 'facinateDortlTask', (done) => {

    gulp.watch(facinateScriptsPath.facinate_scripts_path, gulp.series('facinateScriptsTask'));
    gulp.watch(facinateConditionalScriptsPath.facinate_con_scripts_src, gulp.series('facinateConditionalScriptsTask'));
    gulp.watch(facinateSassPath.facinate_sass_src, gulp.series('facinateSassTask'));
    gulp.watch(facinateConditionalSassPath.facinate_cond_sass_src, gulp.series('facinateConditionalSassTask'));
    gulp.watch(facinateRtlCssPath.facinate_rtlcss_src, gulp.series('facinateDortlTask'));
    done();
}));
