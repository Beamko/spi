module.exports = function(grunt){
    'use strict';

    require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        sass : {
            dist : {
                options : {
                    sourcemap : true,
                    style : 'compressed'
                },
                files : {
                    'wp-content/themes/_SPI/library/css/style.css' : 'wp-content/themes/_SPI/library/scss/style.scss'
                }
            }
        },

        watch : {
            options : {
                livereload : true
            },
            css : {
                files : ['wp-content/themes/_SPI/library/scss/**/*.scss'],
                tasks : ['sass']
            }
        }
    });

    grunt.registerTask('default', ['watch']);

};