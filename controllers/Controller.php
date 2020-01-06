<?php
class Controller
{
	protected function view($view,$param = [])//crée les variables grace au tableau param
	{
		extract($param);
		require_once("views/$view.php");
	}
}
?>
