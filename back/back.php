<?php

class Log
{
	private $email;
	private $password;
    function  __construct($email,$password)
    {
    	$this->setEmail($email);
	    $this->setPassword(hash('ripemd160','vive le projet tweet_academy'.$password));
    }
	public function setEmail($email)
	{
		$this->email= $email;
	}
	public function setPassword($password)
	{
		$this->password = $password;
	}
	public function checkAuth($bdd)//check le mdp
	{
		$flag = false;
		$reponse = $bdd->prepare("SELECT password FROM users WHERE mail = ?");
		if($reponse->execute(array($this->email)))
		{
			while ($row = $reponse->fetch()) {
				if($this->password == $row['password'])
					$flag = true;
			}
		}
		return $flag;
	}
}

class SendForm
{
	private $firstName;
	private $lastName;
	private $pseudo;
	private $date;
	private $pays;
	private $email;
	private $password;
    function  __construct($firstName,$lastName,$pseudo,$date,$pays,$email,$password)
    {
    	$this->setFirstName($firstName);
	    $this->setLastName($lastName);
			$this->setPseudo($pseudo);
			$this->setDate($date);
			$this->setPays($pays);
	    $this->setEmail($email);
	    $this->setPassword(hash('ripemd160','vive le projet tweet_academy'.$password)); // hachage avec l'algorithme ripemd160
    }
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}
	public function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}
	public function setDate($date)
	{
		$this->date = $date;
	}
	public function setPays($pays)
	{
		$this->pays = $pays;
	}
	public function setEmail($email)
	{
		$this->email= $email;
	}
	public function setPassword($password)
	{
		$this->password = $password;
	}
	public function checkMail($bdd)//tant que flag reste false -> aucun mail n'a été trouver donc -> nouveau utilisateur
	{
		$flag = false;
		$reponse = $bdd->prepare("SELECT mail FROM users WHERE mail = ?");
		if($reponse->execute(array($this->email)))
		{
			while ($row = $reponse->fetch()) {
					$flag = true;
			}
		}
		return $flag;
	}
	public function insertDb($bdd)//insert des infos dans la bdd saisie par l'utilisateur
	{
		$id = 0;
		try {
			$reponse = $bdd->prepare("INSERT INTO users (`mail`, `pseudo`, `password`) VALUES (?,?,?)");
			$reponse->execute(array($this->email,$this->pseudo,$this->password));
			$reponse = $bdd->prepare("SELECT id FROM users WHERE mail = ?");
			$reponse->execute(array($this->email));
			while ($row = $reponse->fetch()) {
					$id = $row['id'];
			}
			$reponse = $bdd->prepare("INSERT INTO user_info (`id_user`,`birthdate`, `pays`, `name`, `surname`) VALUES (?,?,?,?,?)");
	//$reposne->bindValue(':birthdate', $this->date)
			$reponse->execute(array($id,$this->date,$this->pays,$this->firstName,$this->lastName));
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}
}

class UserInfo
{
	private $mail;
    function  __construct($mail)
    {
    	$this->setMail($mail);
    }
	public function setMail($mail)
	{
		$this->mail= $mail;
	}
	public function getProfil($bdd)//prend les infos de l'utilisateur pour les afficher sur la page account
	{
		$user_info = [];
		try {
			$reponse = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
			$reponse->execute(array($this->mail));
			while ($row = $reponse->fetch()) {
					$id = $row['id'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['pseudo'] = $row['pseudo'];
					$_SESSION['email'] = $row['mail'];
			}
			$reponse = $bdd->prepare("SELECT * FROM user_info WHERE id_user = '$id'");
			$reponse->execute();
			while ($row = $reponse->fetch()) {
					$_SESSION['pays'] = $row['pays'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['surname'] = $row['surname'];
			}
			$reponse = $bdd->prepare("SELECT * FROM post WHERE id_user = '$id'");
			$reponse->execute();
			$post = [];
			while ($row = $reponse->fetch()) {
					array_push($post,$row);
			}
			$post = array_reverse($post);
			$_SESSION['post'] = $post;
		}
		catch (Exception $e)
		{
		    return false;
		}


		$reponse = $bdd->prepare("SELECT * FROM users,user_info WHERE mail = ?");
		if($reponse->execute(array($this->mail)))
		{
			if($row = $reponse->fetch()) {
				return $row;
			}
		}
	}

	public function getMsg($bdd){
		$doublons =false;
		$doublons2 =false;
		try{
			$reponse = $bdd->prepare("SELECT from_id,to_id FROM messages WHERE from_id=? OR to_id=?");
			$reponse->execute(array($this->mail,$this->mail));
			$rows = $reponse->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (Exception $e)
		{
		    return false;
		}

		$rows = array_merge($rows);
		$result = [];
		for ($i=0; $i < count($rows); $i++) {
			for ($j=0; $j < count($result); $j++) {
				if($result[$j] == $rows[$i]['from_id'])
					$doublons = true;
				if($result[$j] == $rows[$i]['to_id'])
					$doublons2 = true;
			}
				if($rows[$i]['from_id'] == $_SESSION['id'])
					$doublons = true;
				if($rows[$i]['to_id'] == $_SESSION['id'])
					$doublons2 = true;
			if(!$doublons)
				array_push($result,$rows[$i]['from_id']);
			if(!$doublons2)
				array_push($result,$rows[$i]['to_id']);
			$doublons = false;
			$doublons2 = false;
		}
		$pseudo = [];
		$result = array_reverse($result);
		for ($i=0; $i < count($result); $i++) {
			try{
				$reponse = $bdd->prepare("SELECT pseudo FROM users WHERE id=?");
				$reponse->execute(array($result[$i]));
				$rows = $reponse->fetchAll(PDO::FETCH_ASSOC);
				array_push($pseudo,$rows);
			}
			catch (Exception $e)
			{
			    return false;
			}
		}
		$all = [];
		array_push($all,$result);
		array_push($all,$pseudo);
		//array_push($result,$pseudo);
			$_SESSION['msg'] = $all;

	}

	public function showMsg($bdd){
		try{
			$reponse = $bdd->prepare("SELECT * FROM messages WHERE from_id = ? AND to_id = ? OR from_id = ? AND to_id = ?");
			$reponse->execute(array($this->mail,$_SESSION['id'],$_SESSION['id'],$this->mail));
			$rows = $reponse->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (Exception $e)
		{
				return false;
		}
		return $rows;
	}

	public function showIdMsg($bdd){
		return $_SESSION['id'];
	}
}

class UserName{

	private $data;
	private $mail;

	function __construct($mail,$data){
		$this->setMail($mail);
		$this->setData($data);
	}
	public function setMail($mail){
		$this->mail = $mail;
	}
	public function setData($data){
		$this->data = $data;
	}
	public function changeName($bdd){
		try {
			$reponse = $bdd->prepare("UPDATE users SET pseudo=? WHERE mail =?");
			$reponse->execute(array($this->data,$this->mail));
		}
		catch (Exception $e)
		{
		    return false;
		}
	}

	public function changeMail($bdd){
		try {
			$stmt = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
		  $stmt->execute(array($this->data));
		  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(count($rows) != 0)
				return count($rows);
			else{
				$reponse = $bdd->prepare("UPDATE users SET mail=? WHERE mail = ?");
				$reponse->execute(array($this->data,$this->mail));
			}
		}
		catch (Exception $e)
		{
		    return false;
		}
	}
}
class NewPassword
{
	private $mail;
	private $password;
	function __construct($mail,$password){
		$this->setMail($mail);
		$this->setPassword(hash('ripemd160','vive le projet tweet_academy'.$password));
	}
	public function setMail($mail){
		$this->mail = $mail;
	}
	public function setPassword($password){
		$this->password = $password;
	}
	public function changePassword($bdd){
		try {
				$stmt = $bdd->prepare("UPDATE users SET password=? WHERE mail = ?");
		  	$stmt->execute(array($this->password,$this->mail));
				return true;
			}
		catch (Exception $e)
		{
		    return false;
		}
	}
}

class Tweet
{
	private $mail;
	private $tweet;
	private $hashtags;

	function __construct($mail,$tweet,$hashtags){
		$this->setMail($mail);
		$this->setTweet($tweet);
		$this->setHashtags($hashtags);
	}

	public function setMail($mail){
		$this->mail = $mail;
	}
	public function setTweet($tweet){
		$this->tweet = $tweet;
	}

	public function setHashtags($hashtags){
		$this->hashtags = $hashtags;
	}

	public function tweet($bdd){
		try {
			$reponse = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
			$reponse->execute(array($this->mail));
			while ($row = $reponse->fetch()) {
					$id = $row['id'];
			}
			$stmt = $bdd->prepare("INSERT INTO post (id_user,post_content,post_date,hashtags) VALUES ('$id',?,NOW(),?)");
		  $stmt->execute(array($this->tweet,$this->hashtags));
		}
		catch (Exception $e)
		{
		    return $e->getMessage();
		}
	}

	public function deleteTweet($bdd){
		try {
			$reponse = $bdd->prepare("DELETE FROM post WHERE id_user = ? AND post_date=? ");
			$reponse->execute(array($_SESSION['id'],$this->tweet));
			return true;
		}
		catch (Exception $e)
		{
		    return false;
		}
	}

}

class Search
{
	private $data;

	function __construct($data){
			$this->setData($data);
	}

	public function setData($data){
		$this->data = $data;
	}

	public function search($bdd){
		$query = [];
		$q = [];
		try {
			$reponse = $bdd->prepare("SELECT id,pseudo FROM users WHERE pseudo LIKE ?");
			$reponse->execute(array('%'.$this->data));
			$rows = $reponse->fetchAll(PDO::FETCH_ASSOC);
			array_push($query,$rows);

			for ($i=0; $i < count($rows) ; $i++) {
				$stmt = $bdd->prepare("SELECT * FROM user_info WHERE id_user = " . $rows[$i]['id']. "");
				$stmt->execute();
				$rowss = $stmt->fetchAll(PDO::FETCH_ASSOC);
				array_push($q, $rowss);
			}
			array_push($query,$q);
			return $query;
		}
		catch (Exception $e)
		{
		    return $e->getMessage();
		}
	}
}

class Visit
{
	private $visit;

	function __construct($visit){
		$this->setVisit($visit);
	}
	public function setVisit($visit){
		$this->visit = $visit;
	}

	public function showProfil($bdd){
		$visitT = [];
		$post = [];
		$reponse = $bdd->prepare("SELECT pseudo FROM users WHERE id = ?");
		$reponse->execute(array($this->visit));
		$rows = $reponse->fetchAll(PDO::FETCH_ASSOC);
		array_push($visitT,$rows);
		$reponse = $bdd->prepare("SELECT * FROM user_info WHERE id_user = ?");
		$reponse->execute(array($this->visit));
		$rows = $reponse->fetchAll(PDO::FETCH_ASSOC);
		array_push($visitT,$rows);
		$reponse = $bdd->prepare("SELECT * FROM post WHERE id_user = ?");
		$reponse->execute(array($this->visit));
		$rows = $reponse->fetchAll(PDO::FETCH_ASSOC);
		array_push($visitT,array_reverse($rows));
		//$visitT = array_reverse($visitT);
		return $visitT;
	}
}

class Send
{
	private $myId;
	private $targetId;
	private $targetPseudo;
	private $msgContent;

	function __construct($myId,$targetId,$targetPseudo,$msgContent){
		$this->setMyId($myId);
		$this->setTargetId($targetId);
		$this->setTargetPseudo($targetPseudo);
		$this->setMsgContent($msgContent);
	}

	public function setMyId($myId){
		$this->myId = $myId;
	}

	public function setTargetId($targetId){
		$this->targetId = $targetId;
	}

	public function setTargetPseudo($targetPseudo){
		$this->targetPseudo = $targetPseudo;
	}

	public function setMsgContent($msgContent){
		$this->msgContent = $msgContent;
	}

	public function send($bdd){
		try{
			$reponse = $bdd->prepare("INSERT INTO messages (from_id,to_id,message_content,message_date) VALUES (?,?,?,NOW())");
			$reponse->execute(array($this->myId,$this->targetId,$this->msgContent));
			return true;
		}
		catch (Exception $e)
		{
		    return false;
		}
	}
}
?>
