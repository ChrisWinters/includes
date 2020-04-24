/**
 * Generate Translation POT File
 *
 * Compiles:
 *      lang/includes.pot
 *
 * @command gulp translate
 */
var gulp 				= require('gulp');
var sort 				= require('gulp-sort');
var notify 				= require('gulp-notify');
var wpPot 				= require('gulp-wp-pot');
var text_domain         = 'includes';
var bug_report          = 'https://github.com/ChrisWinters/includes/issues';
var translator_contact 	= 'Chris W. <chrisw@null.net>';
var team_contact        = 'Chris W. <chrisw@null.net>';


/**
 * Create Translation File
 */
gulp.task('translate', function () {
    return gulp.src(['!/node_modules', '!/assets', '!/css', '!/fonts', '!/psds', '!/js', '!/images', '!/gulpfile.js', '!/sdk', '!/lang', './**/*.php', './*.php'])
    .pipe(sort())
    .pipe(wpPot({domain: text_domain, package: text_domain, bugReport: bug_report, lastTranslator: translator_contact, team: team_contact}))
    .pipe(gulp.dest('./lang/includes.pot'))
    .pipe(notify({message: 'Task "translate" created includes.pot', onLast: true}))
    .on('error', console.error.bind(console))
});
