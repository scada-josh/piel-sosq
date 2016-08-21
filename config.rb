###
# Page options, layouts, aliases and proxies
###

# Per-page layout changes:
#
# With no layout
page '/*.xml', layout: false
page '/*.json', layout: false
page '/*.txt', layout: false

# With alternative layout
# page "/path/to/file.html", layout: :otherlayout

# Proxy pages (http://middlemanapp.com/basics/dynamic-pages/)
# proxy "/this-page-has-no-template.html", "/template-file.html", locals: {
#  which_fake_page: "Rendering a fake page with a local variable" }

# General configuration

###
# Helpers
###

# Methods defined in the helpers block are available in templates
# helpers do
#   def some_helper
#     "Helping"
#   end
# end

set :phase_environment, 'Development' # Development, Test, Production 
set :css_dir, 'stylesheets'
set :js_dir, 'javascripts'
set :images_dir, 'images'
set :helper_dir, 'helper'


set :partials_desktop_home, 'src/desktop/home'
set :partials_desktop_home_kpi_operation_operationPerformance, 'src/desktop/home/menu-kpi/menu-operation/menu-operation-performance'

set :kpi_op001_dir, '/src/desktop/home/kpi/op-001'
set :kpi_op002_dir, '/src/desktop/home/kpi/op-002'
set :kpi_op003_dir, '/src/desktop/home/kpi/op-003'


# Reload the browser automatically whenever files change
 configure :development do
#   activate :livereload
	  activate :php
    activate :bower
 end


# Build-specific configuration
configure :build do
  # Minify CSS on build
  # activate :minify_css

  # Minify Javascript on build
  # activate :minify_javascript
  activate :php

  # Use relative URLs
  activate :relative_assets

  # Any files you want to ignore:
  ignore '/src/desktop/home/index_2016-08-12.php.erb'
  ignore '/src/desktop/home/partials_2016-08-12/*'
  ignore '/javascripts/javascript-desktop-home_2016-08-12/*'
  ignore '/javascripts/javascript-desktop-home_2016-08-12.js.erb'
  ignore '/stylesheets/stylesheet-desktop-home_2016-08-12/*'
  ignore '/stylesheets/stylesheet-desktop-home_2016-08-12.css.erb'

  ignore '/javascripts/javascript-desktop-home/*'
  ignore '/javascripts/javascript-desktop-home-dashboard-op000/*'
  ignore '/javascripts/javascript-desktop-home-kpi-op001/*'
  ignore '/javascripts/javascript-desktop-home-kpi-op002/*'
  ignore '/javascripts/javascript-desktop-home-kpi-op003/*'
  ignore '/javascripts/javascript-desktop-home-kpi-operation-operationPerformance/*'
  ignore '/javascripts/javascript-desktop-login/*'
  ignore '/javascripts/javascript-desktop-unitTest-defiantJS/*'

  # ignore '/stylesheets/stylesheet-desktop-home/*'
  # ignore '/stylesheets/stylesheet-desktop-home-dashboard-op000/*'
  # ignore '/stylesheets/stylesheet-desktop-home-kpi-op001/*'
  # ignore '/stylesheets/stylesheet-desktop-home-kpi-op002/*'
  # ignore '/stylesheets/stylesheet-desktop-home-kpi-op003/*'
  # ignore '/stylesheets/stylesheet-desktop-home-kpi-operation-operationPerformance/*'
  # ignore '/stylesheets/stylesheet-desktop-login/*'
  # ignore '/stylesheets/stylesheet-desktop-unitTest-defiantJS/*'

  ignore '/helper/*'
  ignore '/helper_metronic_v4.5.6/*'

  ignore '/packages/phpoffice/phpexcel/license.md'
  ignore '/packages/phpoffice/phpexcel/README.md'
  ignore '/packages/phpoffice/phpexcel/Documentation/*'
end



# config.rb
# Add bower's directory to sprockets asset path
after_configuration do
  #@bower_config = JSON.parse(IO.read("#{root}.bowerrc"))
  #sprockets.append_path File.join "#{root}", @bower_config["directory"]
  sprockets.append_path File.join "#{root}", "bower_components"
  sprockets.append_path File.join "#{root}", "source"
  #sprockets.import_asset 'jquery'
end