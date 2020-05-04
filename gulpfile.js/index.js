'use strict';
/**
 * @command npm install
 * @command gulp style --silent
 * @command gulp assets --silent
 * @command gulp bump --silent
 * @command gulp translate --silent
 */
var gulp        = require('gulp');
var requireDir  = require('require-dir');
var forwardRef 	= require('undertaker-forward-reference');

gulp.registry(forwardRef());
requireDir('./tasks', {extensions: ['.js']});
