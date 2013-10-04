<?php
namespace Phpwalk\Core;

class Input {

	public static function get($var, $default = null)
	{
		return isset($_GET[$var]) ? $_GET[$var] : $default;
	}

	public static function post($var, $default = null)
	{
		return isset($_POST[$var]) ? $_POST[$var] : $default;
	}
}