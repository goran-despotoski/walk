<?php

namespace Phpwalk\Core;

class View {
	public static function load($view, $data = array(), $http_status = 200) 
	{
		extract ( $data );
		ob_start ();
		if (! is_array ( $view ) && is_string ( $view ))
			include Config::get ( 'app_path' ) . 'views/' . $view . '.php';
		elseif (is_array ( $view )) {
			foreach ( $view as $vw_v )
				include Config::get ( 'app_path' ) . 'views/' . $vw_v . '.php';
		}
		
		// here we can cache the output too, taken from ob_get_clean()
		return self::cacheOutput ( ob_get_clean () );
	}
	public static function cacheOutput($output) 
	{
		// here comes the caching part :)
		return $output;
	}
}