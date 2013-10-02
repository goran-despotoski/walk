<?php
namespace Phpwalk\Core;

class Dispatcher
{
	protected $path;
	protected $application_location;
	
	public function __construct($path)
	{
		$this->path = $path;
		$this->application_location = Config::get('app_path');
	}
	
	public function dispatch()
	{
		try{
			$path_array = explode('/', trim($this->path,'/'));
			$original_path_array = $path_array;
			$tmp = "";
			$controller_file = $this->application_location .'controllers/';
					
			foreach ($path_array as $k=>$v)
			{
				if($v == "")break;
				$tmp = strtolower($tmp) .'/'. ucfirst($v);
				$tmp_controller_file = $controller_file . $tmp . 'Controller.php';
				$controller_class = ucfirst($v) . 'Controller'; 
				if(is_file($tmp_controller_file))
				{
					include_once($tmp_controller_file);
					$controller = new $controller_class;
					if(isset($path_array[$k+1]))
						if(method_exists($controller, $path_array[$k+1]))
						{
							$method = $path_array[$k+1];
							if(method_exists($controller, $method))
							{
								$parameters = array_slice($path_array, $k+2, (count($path_array)- $k + 1));
								call_user_func_array(array($controller,$method), $parameters);
								die;
							}
							else throw new \Exception("Action ".$method." doesn't exist in ". $controller_class);
						}
					if(method_exists($controller, Config::get('default_action')))
					{
						call_user_func_array(array($controller,Config::get('default_action')), array());
						die;
					}
					else throw new \Exception("Default action ".Config::get('default_action')." doesn't exist in ".$controller_class);
				}//endif
			}//endforeach
			
			$controller_file .= ucfirst(Config::get('default_controller')) . 'Controller.php';
			$controller_class = ucfirst(Config::get('default_controller')) . 'Controller';

			if(is_file($controller_file))
			{
				include_once $controller_file;
				
				$controller = new $controller_class;
				if(method_exists($controller, Config::get('default_action')))
				{
					die(call_user_func_array(array($controller, Config::get('default_action')), array()));
				}
				else throw new \Exception("Action ".Config::get('default_action')." doesn't exist in ". $controller_class);
			}
			else throw new \Exception("Default ".$controller_class." controller doesn't exist");
		}catch(\Exception $e)
		{
			echo $e->xdebug_message;
		}
	}
	
	
}