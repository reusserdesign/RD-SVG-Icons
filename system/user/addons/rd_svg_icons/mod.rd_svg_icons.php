<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rd_svg_icons {

	public $return_data = "";

	public function __construct()
	{

	}

	public function icon()
	{
		$folder_path = ee()->config->item('rd_svg_icons_folder');
		$pFilename 	= ee()->TMPL->fetch_param('name');
		$pPath		= ee()->TMPL->fetch_param('path');

		if ($pPath != '' || $pPath != '/') {
			$icon_path = $folder_path . $pPath . '/';
		} else {
			$icon_path = $folder_path;
		}

		$svg_path = $icon_path . $pFilename . '.svg';

		$contents = @file_get_contents($svg_path);

		if (!empty($contents)) {
			return $contents;
		} else {
			return '';
		}
	}
}
// END CLASS

/* End of file mod.rd_svg_icons.php */
/* Location: ./system/user/addons/rd_svg_icons/mod.rd_svg_icons.php */