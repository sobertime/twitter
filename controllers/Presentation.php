<?php
require_once("controllers/Controller.php");
class Presentation extends Controller
{
	public function show()
	{
		if(isset($_SESSION['email'])){//si une session est demarrer on envoie l'utilisateur sur la page account / sinon page sign up
			return $this -> view("home",["home" => "home"]);
		}
		else
			return $this -> view("presentation");
	}

	public function log($bdd)//check des id lors de la connexion
	{
		if(!$_POST)
				return $this -> view("presentation");
		require_once('./back/back.php');
		$conn = new Log($_POST["email"],$_POST["password"]);
		if(isset($_SESSION['email']))
			header('location: index.php?controller=Home&action=show');
		else if($conn->checkAuth($bdd))
		{
				$_SESSION['email'] = $_POST["email"];
				header('location: index.php?controller=Home&action=show');
		}
		else
			return $this -> view("presentation",["errMdp" =>  "Mail ou mot passe incorrect"]);
	}

	public function send($bdd)//check et envoie du form d'inscription
	{
		if(isset($_SESSION['email']))
			header('Location: index.php?controller=Home&action=show');
		else
		{
			require_once('./back/back.php');
			$_POST["name"] = explode(" ",$_POST["name"]);
			$firstName = $_POST["name"][0];
			$lastName = $_POST["name"][1];

			$signUp = new SendForm($firstName,$lastName,$_POST['pseudo'],$_POST['date'],$_POST['pays'],$_POST["email"],$_POST["password"]);
			if(!$signUp->checkMail($bdd))
			{
				$signUp->insertDb($bdd);
				$_SESSION['email'] = $_POST["email"];
				header('Location: index.php?controller=Home&action=show');
			}
			else if($signUp->checkMail($bdd))
				return $this -> view("presentation",["mail_false" =>  "Mail déjà utilisé"]);
		}
	}

	public function deco(){ //TEMPORAIRE
		session_unset();
		session_destroy();
		header('Location: index.php?controller=presentation&action=show');
	}
}
?>
