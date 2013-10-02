<?php
namespace Phpwalk\Core;

class Config
{
	public static $config_array;
	
	private function __construct(){}
	
	public static function init($config_array)
	{
		self::$config_array = $config_array;
	}
	
	public static function get($key)
	{
		return isset(self::$config_array[$key])?self::$config_array[$key]:'';
	}
	
	public static function set($key, $value)
	{
		self::$config_array[$key] = $value;
	}
}