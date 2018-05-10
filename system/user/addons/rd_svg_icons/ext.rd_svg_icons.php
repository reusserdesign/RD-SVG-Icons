<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rd_svg_icons_ext {

	/**
	 * Constructor
	 *
	 * @param 	mixed	Settings array or empty string if none exist.
	 */
	public function __construct($settings = array())
	{
		// required extension properties
		$this->name				= 'RD SVG Icons';
		$this->version			= '3.0.2';
		$this->description		= 'Tired of massive amounts of SVG code in your templates? So were we. With the ability to view your SVGs in the control panel, and implement them with a convenient one-click copy, implementing SVGs into your ExpressionEngine template has just gotten a whole lot easier (and cleaner).';
		$this->settings_exist	= 'y';
	}

	// ------------------------------------------------------

	/**
	 * Activate Extension
	 *
	 * @return void
	 */
	public function activate_extension()
	{
		 //$this->_add_hook('cp_css_end', 10);
		 $this->_add_hook('cp_js_end', 10);
	}

	// ------------------------------------------------------

	/**
	 * Disable Extension
	 *
	 * @return void
	 */
	public function disable_extension()
	{
		ee()->db->where('class', __CLASS__);
		ee()->db->delete('extensions');
	}

	// ------------------------------------------------------

	/**
	 * Update Extension
	 *
	 * @param 	string	String value of current version
	 * @return 	mixed	void on update / FALSE if none
	 */
	public function update_extension($current = '')
	{
		if ($current == '' OR (version_compare($current, $this->version) === 0))
		{
			return FALSE; // up to date
		}

		// update table row with current version
		ee()->db->where('class', __CLASS__);
		ee()->db->update('extensions', array('version' => $this->version));
	}

	// ------------------------------------------------------
    //
    /**
     * Method for cp_css_end hook
     *
     * Add custom CSS to every Control Panel page:
     *
     * @access     public
     * @param      array
     * @return     array
     */
    // public function cp_css_end()
    // {
	// 	$cp_style = file_get_contents( PATH_THIRD . '/rd_svg_icons/css/helper.css');
	//
    // 	return $cp_style;
    // }

	public function cp_js_end()
    {
		$helper_js_file = file_get_contents( PATH_THIRD . '/rd_svg_icons/js/helper.js');

    	return $helper_js_file;
    }

	// --------------------------------------------------------------------

    /**
     * Add extension hook
     *
     * @access     private
     * @param      string
     * @param      integer
     * @return     void
     */
    private function _add_hook($name, $priority = 10)
    {
        ee()->db->insert('extensions',
            array(
                'class'    => __CLASS__,
                'method'   => $name,
                'hook'     => $name,
                'settings' => '',
                'priority' => $priority,
                'version'  => $this->version,
                'enabled'  => 'y'
            )
        );
    }

}