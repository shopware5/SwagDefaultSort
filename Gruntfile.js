module.exports = function(grunt) {
    'use strict';

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        phpunit: {
            classes: {
                dir: 'tests/'
            },
            options: {
                bin: 'phpunit',
                verbose: true,
                debug: true
            }
        },

        jslint: {
            client: {
                src: [
                    'Views/**/*.js'
                ],
                directives: {
                    browser: true
                }
            }
        },

        jshint: {
            files: ['Gruntfile.js', './Views/**/*.js'],
            options: {
                globals: {
                    jQuery: true
                }
            }
        },
        watch: {
            files: ['./**/*.js', './**/*.php'],
            tasks: ['phpunit', 'jshint']
        }
    });

    // load up your plugins
    grunt.loadNpmTasks('grunt-jslint');
    grunt.loadNpmTasks('grunt-phpunit');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-jshint');

    // register one or more task lists (you should ALWAYS have a "default" task list)
    grunt.registerTask('default', ['jshint']);
    grunt.registerTask('alljs', ['jshint', 'jslint']);
};