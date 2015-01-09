module.exports = function(grunt) {
  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    meta: {
      banner: '/*!\n' +
        '* <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
        '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
        '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
        '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %> (<%= pkg.author.url %>)\n' +
        '* Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %>\n*/\n'
    },
    watch: {
      options: {
        livereload: true
      },
      views: {
        files: ['views/**/*.phtml'],
        tasks: []
      },
      public: {
        files: ['public/**/*.{php,css,js,jpg,png}'],
        tasks: []
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('default', ['watch']);
};