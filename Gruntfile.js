module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            min: {
                files: {
                    'frontend/assets/js/script.min.js' : 'frontend/assets/js/script.js'
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
                    "frontend/assets/css/style.css": "frontend/assets/less/**/style.less"
                }
            },
        },
        watch: {
            options: {
                livereload: true
            },
            less: {
                files: ['frontend/assets/less/*.less'],
                tasks: ['less']
            },
            uglify: {
                files: ['frontend/assets/js/**/*.js'],
                tasks: ['uglify']
            }
        },
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');


    grunt.registerTask('default', ['uglify', 'less']);
};