module.exports = function (grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    concat: {
      options: {
        separator: '',
        stripBanners: true
      },
      build:{
        src: [
          'bower_components/shapefly-plugin/dist/shapefly-plugin.min.js',
          'bower_components/tinymce-plugin-shapefly/dist/tinymce-plugin-shapefly.min.js'
        ],
        dest: 'dist/wp-tinymce-plugin-shapefly.min.js'
      }
    },
	clean:['dist'],
    copy: {
      build: {
	    files: [{
		  expand: true,
		  cwd: 'src',
		  src: '**/*.php',
		  dest:'dist/'
		}, {
		  'dist/shapefly-plugin.html':'bower_components/shapefly-plugin/dist/shapefly-plugin.min.html',
		  'dist/tinymce-plugin-shapefly.min.css':'bower_components/tinymce-plugin-shapefly/dist/tinymce-plugin-shapefly.min.css'
		}]
	  }
	}
  });
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
  grunt.registerTask('default', ['clean','concat','copy']);
};