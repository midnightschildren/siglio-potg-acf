potg-wp-theme
=============
# Development  (easter-egg)
-------------------------------------------------------------------------------
1. Enable development mode by setting ```ENV_DEVELOPMENT``` to ```true``` in ```config.php```
2. We're using bootstrap and less to configure files, please make changes accordingly to the ```app-variables.less``` and ```custom.less``` for app-specific changes
3. Refer to the grid variables in app.less to change the custom grid to match your design

### CSS
```custom.less``` is intended for theme-specific styles, that probably won't be helpful on a global scale.

For setting global variables, please see ```app.less``` all of the global overrides live there, including link color and grid variables.

By default the grid width is automatically calculated but can be manually overridden to force the document size.

#### Some helpful css classes:
* __.font-icon__ By default I've added the ```ModernPictogramsNormal``` font family by default, so you can specify 'letters' to stand in for common web icons. See http://www.fontsquirrel.com/fonts/modern-pictograms for more information on each of the icons.
```html
// Displays a twitter icon
<span class="font-icon">t</span>
```
* __.alpha | .omega__ despite being very simple, it simply removes the margin left for .alpha items and margin-right for .omega items. Useful for setting the first or last item in a row with multiple columns. Useful when combined with loops and global row variables (see category.php and loop.php for examples)

* __.grid_X__ we use a slightly modified bootstrap grid system, so grid widths can easily be set in ```app.less``` and updated in various templates to control consistent width.

### PHP
For convenience we're using the same loop template structure found in twentyelevn, which means it's easier to break loops down by content type and call them out on a page / post basis.

#### Categories
* By default, all categories attempt to call ```get_template_part``` with the category name, so adding ```loop-categoryName.php``` will automagically load that loop if you are on the categoryName category page.
* By default, ```sidebar.php``` will attempt to load a category-specific sidebar titled the same as the category slug. It falls back on 'Sidebar', and that failing, to the markup in ```sidebar.php``` (It saves a bit on having to define multiple ```sidebar-random-category.php```)

# Deployment
-------------------------------------------------------------------------------
### Get static version of css
get a copy of the css being deployed in development mode and copy this to ```style.css``` in the theme's root directory. We're specficially not automating this remove the posibility of overwriting existing styles for production.

### Disable development mode
change the ```ENV_DEVELOMENT``` variable in ```config.php``` to ```false```, this will force the css to use a static file instead of dynamically generating css from the less.php file

### Ensure security
remove read / write / execute access from less.php or simply delete it; there isn't any special sanitization being done on the requests to that file, so for security purposes, please disable this. @todo figure out a way to automatically remove access to the less file