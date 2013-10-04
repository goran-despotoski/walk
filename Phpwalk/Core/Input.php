<?php
namespace Phpwalk\Core;

class Input {

	public static function get($var)
	{
		return isset($_GET[$var]) ? $_GET[$var] : null;
	}

	public static function post($var)
	{
		return isset($_POST[$var]) ? $_POST[$var] : null;
	}
}