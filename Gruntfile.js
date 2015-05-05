module.exports = function(grunt) {
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

        jshint: {
            files: ['Gruntfile.js', 'Views/**/*.js'],
            options: {
                globals: {
                    jQuery: true
                }
            }
        },
        watch: {
            files: ['Views/**/*.js', './**/*.php'],
            tasks: ['jshint', 'phpunit']
        }
    });
    // load up your plugins
    grunt.loadNpmTasks('grunt-phpunit');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    // register one or more task lists (you should ALWAYS have a "default" task list)
    grunt.registerTask('default', ['jshint']);
};