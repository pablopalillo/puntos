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
        static: {   
          options: {                       
            optimizationLevel: 3,
            svgoPlugins: [{ removeViewBox: false }],
            use: [mozjpeg()]
          },
          files: {                         // Dictionary of files 
            'images/logo.png': '/images/src/logo.png', // 'destination': 'source' 
            'images/telemedellin_pie.png': '/images/src/telemedellin_pie.png',
            'images/logos-alc.png': '/images/src/logos-alc.png'
          }
        },
        dynamic: {                         // Another target 
          files: [{
            expand: true,                  // Enable dynamic expansion 
            cwd: 'images/src',                   // Src matches are relative to this path 
            src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match 
            dest: 'images/'                  // Destination path prefix 
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

  grunt.registerTask('default', ['uglify','imagemin','sass']);
  grunt.registerTask('styles', ['sass']);

}

