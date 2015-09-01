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
          'bower_components/jquery-shapefly-client/dist/jquery-shapefly-client.min.js',
          'bower_components/tinymce-plugin-shapefly/dist/tinymce-plugin-shapefly.min.js'
        ],
        dest: 'dist/jquery-shapefly-client.js'
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
		  }, {'dist/shapefly.html':'bower_components/jquery-shapefly-client/dist/shapefly.min.html'}]
	  }
	}
  });
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
  grunt.registerTask('default', ['clean','concat','copy']);
};