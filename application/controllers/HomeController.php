<?php
use Phpwalk\Core\Input;

class HomeController
{
	public function index()
	{
		if(!Input::get('test'))
			echo "nema nisto";
		else 
			echo "ima nesto"; 
// 		echo "test";
	}
}