var path = require('path');
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
        dest: 'tmp/wp-tinymce-plugin-shapefly.min.js'
      }
    },
	clean:['tmp','dist'],
	zip: {
      'skip-path': {
		router: function (filepath) {
		  var filename = path.basename(filepath);
		  return filename;
		},
        compression: 'DEFLATE',
		src:[
		  'tmp/wp-tinymce-plugin-shapefly.min.js',
		  'src/wp-tinymce-plugin-shapefly.php',
		  'bower_components/shapefly-plugin/dist/shapefly-plugin.min.html',
		  'bower_components/tinymce-plugin-shapefly/dist/tinymce-plugin-shapefly.min.css'
		],
		dest: 'dist/wp-tinymce-plugin-shapefly.zip'
	  }
	}
  });
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
  grunt.registerTask('default', ['clean','concat','zip']);
};