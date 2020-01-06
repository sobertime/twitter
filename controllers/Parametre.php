<?php
require_once("controllers/Controller.php");
class Parametre extends Controller
{
	public function show()
	{
		if(isset($_SESSION['email'])){//si une session est demarrer on envoie l'utilisateur sur la page account / sinon page sign up
			return $this -> view("parametre",["parametre" => "parametre"]);
		}
		else
			return $this -> view("presentation");
	}
}
