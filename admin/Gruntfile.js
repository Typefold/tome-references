'use strict';

module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration.
    sass: {
      compile: {
        files: {
          'dist/tome-references.css' : 'lib/scss/tome-references.scss'
        }
      }
    },
    coffee: {
      compile: {
        files: {
          'lib/js/tome-references.js' : [
            'lib/coffee/references-popup.coffee',
            'lib/coffee/tome-references.coffee',
            'lib/coffee/biblio-form-tinymce.coffee',
            'lib/coffee/biblio-form.coffee',
            'lib/coffee/modal-window.coffee',
            'lib/coffee/biblio-admin-page.coffee',
            'lib/coffee/main.coffee',
          ],
          'dist/references-plugin-helper.js' : 'lib/coffee/references-plugin-helper.coffee',
        },
        options: {
          bare: true,
          join: true
        }
      }
    },
    concat: {
      options: {
        banner: '<%= banner %>',
        stripBanners: true
      },
      dist: {
        src: ['lib/plugins/jquery.validate.min.js',
              'lib/plugins/list.min.js',
              'lib/plugins/list.pagination.min.js',
              'lib/js/biblio-form-helpers.js',
              'lib/js/<%= pkg.name %>.js'
        ],
        dest: 'dist/<%= pkg.name %>.js'
      }
    },
    uglify: {
      options: {
        banner: '<%= banner %>'
      },
      dist: {
        src: 'dist/tome-references.js',
        dest: 'dist/<%= pkg.name %>.min.js'
      },
    },
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      lib: {
        options: {
          jshintrc: 'lib/.jshintrc'
        },
        src: ['lib/**/*.js']
      },
    },
    watch: {
      livereload: {
        options: { livereload: true },
        files: ['dist/tome-references.css'],
      },
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: []
      },
      sass: {
        files: 'lib/scss/**/*.scss',
        tasks: ['sass:compile']
      },
      coffee: {
        files: 'lib/coffee/**/*.coffee',
        tasks: ['coffee:compile', 'concat:dist', 'uglify:dist']
      }
    },
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-sass');

  // Default task.
  grunt.registerTask('default', ['jshint', 'concat', 'uglify']);

};
