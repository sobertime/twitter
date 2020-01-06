<?php
require_once("controllers/Controller.php");
class Home extends Controller
{
	public function show(){
		if(isset($_SESSION['email']))//si une session est demarrer on envoie l'utilisateur sur la page account / sinon page sign up
			header('location: index.php?controller=Home&action=display');
		else
			return $this -> view("presentation");
	}

	public function display($bdd)//info User ici
	{
		if(isset($_SESSION['email'])){//si une session est demarrer on envoie l'utilisateur sur la page account / sinon page sign up
			require_once('./back/back.php');
			$user = new UserInfo($_SESSION['email']);
			$profil = $user->getProfil($bdd);
			//get tweet
		 	//$profil['mail']/['pseudo']/['birthdate']/['pays']/['name']/['surname']
			return $this -> view("home",[
				"home" => "home"//menu dynamique
				]);
		}
		else
			return $this -> view("presentation");
	}

	public function modifyName($bdd){//change le pseudo
		if(isset($_SESSION['name'])){
			require_once('./back/back.php');
			$string = $_POST['name'];
			if(stristr($string, ' ') === FALSE){
				$name = new UserName($_SESSION['email'],$_POST['name']);
				$newName = $name->changeName($bdd);
				$_SESSION['pseudo'] = $_POST['name'];
				return $this-> view("home",["home" => "home","succesName" => "succes"]);
			}
			else{
				return $this->view("home",["home" => "home","errorName" => "error"]);
			}
		}
		else{
			return $this -> view("home",["home" => "home"]);
		}
	}


	public function modifyMail($bdd){
		if(isset($_SESSION['email'])){
			require_once('./back/back.php');
			$mail = new UserName($_SESSION['email'],$_POST['email']);
			$newMail = $mail->changeMail($bdd);
			if($newMail != 0)
				return $this -> view("home",[
						"home" => "home",
						"errorMail" => "error"
						]);
			else{
				$_SESSION['email'] = $_POST['email'];
				return $this -> view("home",[
						"home" => "home",
						"succesMail" => "succes"
						]);
			}
		}
		else{
			return $this -> view("home",["home" => "home"]);
		}
	}

	public function modifyPassword($bdd){
		if(isset($_SESSION['email'])){
			require_once('./back/back.php');
			$password = new NewPassword($_SESSION['email'],$_POST['password']);
			$newPassword = $password->changePassword($bdd);
			if($newPassword){
				return $this -> view("home",[
							"home" => "home",
							"succesPassword" => "succes"
				]);
			}
			else {
				return $this -> view("home",[
							"home" => "home",
							"errorPassword" => "error"
				]);
		}
		}
		else{
			return $this -> view("home",["home" => "home"]);
		}
	}

	public function tweet($bdd){
		if(isset($_POST['tweet'])){
			$content = explode(" ",$_POST['tweet']);
			$hashtags = "";
			for ($i=0; $i < count($content); $i++) {
				if($content[$i][0] == "#"){
					$hashtags .= $content[$i] . " ";
					$content[$i] = "<a href=\"\" id=\"" . substr($content[$i],1) . "\">" . $content[$i] . "</a>";
				}
				elseif ($content[$i][0] == "@") {
					$content[$i] = "<a href=\"\" id=\"" . substr($content[$i],1) . "\">" . $content[$i] . "</a>";
				}
			}
			$content = implode(" ",$content);
			require_once('./back/back.php');
			$tweet = new Tweet($_SESSION['email'],$content,$hashtags);
			$newTweet = $tweet->tweet($bdd);
			if(!$newTweet)
				var_dump($newTweet);
			else
				echo "Success";
		}
		else
			echo "Failed";
	}

	public function deleteTweet($bdd){
		if(isset($_POST['delete'])){
			require_once('./back/back.php');
			$delete = new Tweet($_SESSION['email'],$_POST['delete'],1);
			$newDelete = $delete-> deleteTweet($bdd);
			if(!$newDelete)
				echo "Failed";
			else
				echo "Success";
		}
		else
			echo "Failed";
	}

	public function showResult($bdd){
		if(isset($_POST['searchQuery'])){
			require_once('./back/back.php');
			$search = new Search($_POST['searchQuery']);
			$result = $search->search($bdd);
			echo json_encode($result);
		}
	}

	public function profilVisit($bdd){
		if(isset($_POST['visit'])){
			require_once('./back/back.php');
			$visit = new Visit($_POST['visit']);
			$resultVisit = $visit->showProfil($bdd);
			echo json_encode($resultVisit);
		}
	}
}
?>
