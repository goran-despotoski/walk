<?php
use Phpwalk\Core\View;
use Phpwalk\Core\Response;

class UserController
{
	public function index()
	{
		$test = ["username"=>"Goran", "password"=>"Lozinka"];
		
		$test['left_bar'] = View::load('leftBar',$test);
		return Response::load('testView',$test);
	}
	
	public function login()
	{
		echo "test";
	}
}