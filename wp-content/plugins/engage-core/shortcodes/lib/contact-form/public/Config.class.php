<?php
/**
 * Powerful And Easy Configuration with PHP.
 *
 * @package   Config
 * @author    Pedro Rogério <pinceladasdaweb@hotmail.com>
 * @copyright 2015 Pedro Rogério <pinceladasdaweb@hotmail.com>
 * @license   http://opensource.org/licenses/GPL-3.0 GNU General Public License 3.0
 * @version   Release: 0.0.1
 * @link      https://github.com/pinceladasdaweb/Config
 */

if ( !class_exists( 'Engage_Mail_Config' ) ) {
	class Engage_Mail_Config
	{
	    protected $data;
	    protected $default = null;
	
	    public function load($file)
	    {
	        $this->data = include $file;
	    }
	    
	    public function load_config( $config ) {
	    	$this->data = $config;
	    }
	
	    public function get($key, $default = null)
	    {
	        $this->default = $default;
	
	        $segments = explode('.', $key);
	        $data = $this->data;
	
	        foreach ($segments as $segment) {
	            if (isset($data[$segment])) {
	                $data = $data[$segment];
	            } else {
	                $data = $this->default;
	                break;
	            }
	        }
	
	        return $data;
	    }
	
	    public function exists($key)
	    {
	        return $this->get($key) !== $this->default;
	    }
	}
}