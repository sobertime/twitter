<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="./alertify.min.js"></script>
        <script src="https://kit.fontawesome.com/85e28e81c5.js"></script>
		<link rel="stylesheet" href="./css/alertify.min.css"/>
		<link rel="stylesheet" href="./css/themes/default.min.css"/>
		<script src="./script/script.js" charset="utf-8"></script>
		<title>Inscription</title>
	</head>
	<body>
		<div class="left-side">
			<div class="text">
				<p><i class="fas fa-search"></i>Suivez vos passions.</p>
				<p><i class="fas fa-user-friends"></i>Découvrez ce dont les gens parlent.</p>
				<p><i class="far fa-comment"></i>Rejoignez la conversation.</p>
			</div>
		</div>
		<div class="right-side">
			<div class="connexion">
			<form class="" action="index.php?controller=Presentation&action=log" method="post">
				<input type="email"  name="email"  placeholder="pseudo ou email" required>
				<input type="password" name="password"  placeholder="mot de passe" required>
				<input type="submit" value="Se connecter" >
			</form>
			</div>
			<div class="bird">
                <img style="width:40px;" src="./images/Twitter_Bird.svg.png" alt="logo">
                <div class="text_right">
			<p>Découvrez ce qui se passe <br> dans le monde en temps réel</p>
			<p>Rejoignez Twitter aujourd'hui.</p>
                </div>
			<a href=""><div id="sign-up">S'inscrire</div></a></br>
			<a href=""><div id="log-in">Se connecter</div></a>
	</div>
	<div class="hiddenConnexion">
	<form id="connexionForm" method="POST" action="index.php?controller=presentation&action=log" class="connexionForm">
	  <fieldset>
	      <label> Addresse mail </label>
	      <input type="email" name="email" id="email" class="form-control membersadded" required/>
	      <br/>
	      <label> Mot de passe </label>
	      <input type="password" name="password" id="password" class="form-control membersadded" required/>
	      <br/>
	      <input type="submit" value="Connexion" class="btn btn-succes"/>
	  </fieldset>
	</form>
	</div>
	<div class="hiddenInscription">
	<form id="inscriptionForm" method="POST" action="index.php?controller=presentation&action=send" class="inscriptionForm">
	  <fieldset>
	      <label> Nom et prénom </label>
	      <input type="text" name="name" id="name-inscription" class="form-control membersadded" required/>
	      <br/>
				<label> Pseudo </label>
				<input type="text" name="pseudo" id="pseudo-inscription" class="form-control membersadded" required/>
	      <br/>
				<label> Date de naissance </label>
				<input type="date" name="date" id="date-inscription" class="form-control membersadded" required/>
	      <br/>
				<label> Pays </label>
				<input type="text" name="pays" id="pays-inscription" class="form-control membersadded" required/>
	      <br/>
	      <label> Email </label>
	      <input type="email" name="email" id="email-inscription" class="form-control membersadded" required/>
	      <br/>
				<label> Mot de passe </label>
				<input type="password" name="password" id="password-inscription" class="form-control membersadded" required/>
	      <br/>
	      <input type="submit" value="Inscription" class="btn btn-succes"/>
	  </fieldset>
	</form>
	</div>
	<!------------------------------------------ Notifications // JS --------------------------------------->
	<?php
	if(isset($mail_false))
	{
	?>
	<script type="text/javascript">
		let delay = alertify.get('notifier','delay');
		alertify.set('notifier','delay', 4);
		alertify.set('notifier','position', 'top-center');
		alertify.error('Ce mail est déjà utilisé !');
	</script>
	<?php
	}
	?>
	<?php
	if(isset($errMdp))
	{
	?>
		<script type="text/javascript">
			let delay = alertify.get('notifier','delay');
			alertify.set('notifier','delay', 4);
			alertify.set('notifier','position', 'top-center');
			alertify.error('Mauvais mail ou mot de passe !');
		</script>
	<?php
	}
	?>
</body>
</html>
