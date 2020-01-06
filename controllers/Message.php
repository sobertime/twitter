<?php
require_once("controllers/Controller.php");
class Message extends Controller
{
	public function show()
	{
		if(isset($_SESSION['email']))//si une session est demarrer on envoie l'utilisateur sur la page account / sinon page sign up
			header('location: index.php?controller=Message&action=display');
		else
			return $this -> view("presentation");
	}

	public function display($bdd){
		require_once('./back/back.php');
		$getMsg = new UserInfo($_SESSION['id']);
		$newMsg = $getMsg->getMsg($bdd);
		//if(isset($_SESSION['email']))//si une session est demarrer on envoie l'utilisateur sur la page account / sinon page sign up
		return $this -> view("message",["message" => "message"]);
	}

	public function sendMsg($bdd)
	{
		if(isset($_POST['id']) && isset($_POST['pseudo']) && isset($_POST['msg'])){
			//echo $_SESSION['id'];
			require_once('./back/back.php');
			$send = new Send($_SESSION['id'],$_POST['id'], $_POST['pseudo'], $_POST['msg']);
			$sendMsg= $send->send($bdd);
			if($sendMsg)
				echo "ok";
			else
				echo "no";
		}
	}

	public function showMsg($bdd)
	{
		if(isset($_POST['id_msg'])){
			require_once('./back/back.php');
			$msg = new UserInfo($_POST['id_msg']);
			$show = $msg->showMsg($bdd);
			echo json_encode($show);
		}
		if(isset($_POST['id_sess_msg'])){
			require_once('./back/back.php');
			$msg = new UserInfo($_SESSION['id']);
			$show = $msg->showIdMsg($bdd);
			echo json_encode($show);
		}
	}
}
?>
