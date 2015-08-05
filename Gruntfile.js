module.exports = function(grunt) {

  var mozjpeg = require('imagemin-mozjpeg');
  require('load-grunt-tasks')(grunt); // npm install --save-dev load-grunt-tasks 

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        sourceMap: true
      },
      dist: {
        files: {
          'css/main.css': 'css/main.scss'
        }
      }
    },

    uglify: {
      my_target: {
        files: {
          'js/script.min.js': ['js/script-dev.js']
        }
      }
    },

    imagemin: {                        
        dist: {   
          options: {                       
            optimizationLevel: 3,
            svgoPlugins: [{ removeViewBox: false }],
            use: [mozjpeg()]
          },
          files: { 
            'images/src/logo.png' : 'images/logo.png',
            'images/src/telemedellin_pie.png' : 'images/telemedellin_pie.png',
            'images/src/logos-alc.png' : 'images/logos-alc.png'
          }
        },
        dynamic: {     
          files: [{
            expand: true,
            cwd: 'images/', 
            src: ['**/*.{png,jpg,gif}'],
            dest: 'images/src/'     
          }]
        }
    },
   /** concat: {
      options: {
        // Task-level options may go here, overriding task defaults.
      },
      foo: {
        options: {
          // "foo" target options may go here, overriding task-level options.
        },
      },
      bar: {
        // No options specified; this target will use task-level options.
      },
    }, **/
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-imagemin');

  grunt.registerTask('default', ['uglify','imagemin:dist','sass']);
  grunt.registerTask('styles', ['sass']);

}

