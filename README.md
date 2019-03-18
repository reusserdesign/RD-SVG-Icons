# RD-SVG-Icons

![](https://img.shields.io/badge/ExpressionEngine-3-3784B0.svg)
![](https://img.shields.io/badge/ExpressionEngine-4-3784B0.svg)
![](https://img.shields.io/badge/ExpressionEngine-5-3784B0.svg)

Tired of massive amounts of SVG code in your templates? So were we. With the ability to view your SVGs in the control panel, and implement them with a convenient one-click copy, implementing SVGs into your ExpressionEngine template has just gotten a whole lot easier (and cleaner).

## Steps To Implement
1. Set Config Variable.
2. Upload SVGs.
3. Use the add-on.

### Set Config Variable

Set the `$config['rd_svg_icons_folder']` config variable in system/user/config/config.php to the location you will be storing your SVGs.

**Example:** `$config['rd_svg_icons_folder'] = $basePath .'/build/svgs/';`

### Upload SVGs
Add/Upload SVGs to the directory specified in the config variable.

*Note: The add-on does a recurisve traverse of the directory so you should be able to add as many sub directories as you would like to keep the SVGs organized.*

### Use the add-on
##### Automatic
You should now be able to navigate the add-on in ExpressionEngine to view your SVG library. In order to implement the SVG in your template simply click on the SVG Icon to copy it to your clipboard, and then paste it into your template.

##### Manual
You can also manually implement the tag without the need to navigate to the add-on in the control panel using the following code.

`{exp:rd_svg_icons:icon name='my-svg-name' path='path/to/svg'}`

#### Parameters
*name:* Required. This is simply the name of the svg file without the .svg extension.

*path:* Optional-ish. This is the path to the SVG relative to your config variable. So if the path to my SVG is `path/to/site/assets/svgs/directory/name.svg` and my config variable is set to `path/to/site/assets/svgs/`, then the value for my *path* parameter would be `directory/`. If your SVG is at the root level of your config variable, no path is required.

