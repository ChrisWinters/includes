/**
 * Default Task
 *
 * @command gulp default|style
 */
var gulp = require('gulp');


/**
 * Default Task
 */
gulp.task('default', gulp.series('style'));
