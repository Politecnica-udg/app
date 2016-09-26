module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            min: {
                files: {
                    'js/script.min.js' : 'js/script.js'
                }
            }
        },
        less: {
            production: {
                options: {
                    paths: ["less"],
                    cleancss: true,
                    compress: true,
                    sourceMap: true
                },
                files: {
                    "css/style.css": "less/**/style.less"
                }
            },
        },
        watch: {
            options: {
                livereload: true
            },
            less: {
                files: ['less/*.less'],
                tasks: ['less']
            },
            uglify: {
                files: ['js/**/*.js'],
                tasks: ['uglify']
            }
        },
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');


    grunt.registerTask('default', ['uglify', 'less']);
};