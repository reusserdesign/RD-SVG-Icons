<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rd_svg_icons_mcp {

	public function __construct()
	{
		$this->include_styles();
	}

	public static function traverseRecursively($folder_path, $dir, $return)
	{
		$files		= preg_grep('~\.(svg)$~', scandir($dir));
		$folders	= scandir($dir);

		// FILES NOT IN FOLDERS
		if (count($files) > 0)
		{
			$return .= '<div class="col-group svg_group" data-dir='.$dir.'><div class="col w-16"><div class="box"><h1>'.(($label = str_replace($folder_path, '', $dir)) === '' ? '/' : rtrim($label, '/')).'</h1><div class="txt-wrap"><div class="svg_container">';

			foreach ($files as $file)
			{
				if(is_dir($file)) continue;

				// Check if file contents start with '<svg' and end with '/svg>'
				// $contents = file_get_contents($dir.$file);
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				$filename = pathinfo($file, PATHINFO_FILENAME);
				if($extension = 'svg') {
					$return .= '<div class="svg_contain">';
					$return .= file_get_contents($dir.$filename.'.svg');
					$return .= '<span>'.$filename.'</span>';
					$return .= '<textarea class="code">{exp:rd_svg_icons:icon name="'.$filename.'" path="'.$label.'"}</textarea>';
					$return .= '</div>';
				}
			}

			$return .= "</div></div></div></div></div>";
		}

		foreach($folders as $key => $value) {
			$new_dir = realpath($dir.'/'.$value) . '/';

			if (is_dir($new_dir) && $value !== "." && $value !== ".." && $new_dir !== $dir) {
				$return = self::traverseRecursively($folder_path, $new_dir, $return);
			}
		}

		return $return;
	}

	public function index()
	{
		$return = "<p>Click the SVG to copy the required code and simply paste it into your template.</p>";

		if (version_compare(APP_VER, '3', '>='))
		{
			ee()->view->header = array( 'title' => lang('rd_svg_icons_module_name') );

			if (ee()->config->item('rd_svg_icons_folder')) {
				$folder_path = ee()->config->item('rd_svg_icons_folder');
			} else {
				return '<h3>Oops!</h3>
						<p>It looks like you forgot to set your config variable. Make sure to set the path to your SVG Icons folder in system/user/config/config.php.</p>
						<p><strong>Example:</strong> $config["rd_svg_icons_folder"] = $basePath ."/assets/svgs/";';
			}
			//? ee()->config->item('rd_svg_icons_folder') : PATH_THIRD_THEMES . 'rd_svg_icons/icons/';

			$return = self::traverseRecursively($folder_path, $folder_path, $return);

			return $return;
		}else{
			$return = '<p>ExpressionEngine version 3 or greater is required.</p>';
		}

		return $return;
	}

	protected function include_styles()
	{
		$cp_style = file_get_contents( PATH_THIRD . '/rd_svg_icons/css/helper.css');

		//add the css to the header
		ee()->cp->add_to_head('<style>'.$cp_style.'</style>');
	}

}
// END CLASS

/* End of file mcp.rd_svg_icons.php */
/* Location: ./system/user/addons/rd_svg_icons/mcp.rd_svg_icons.php */