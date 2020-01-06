<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <script src="https://kit.fontawesome.com/c30cfcb14d.js" charset="utf-8"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="./alertify.min.js"></script>
  <link rel="stylesheet" href="./css/alertify.min.css"/>
  <link rel="stylesheet" href="./css/themes/default.min.css"/>
  <script src="./script/script.js" charset="utf-8"></script>
	<title>Accueil/Twitter</title>
</head>
<body>
<?php require_once('menu.php') ?>

<div class="mid_part">
  <div id="titre">
    <p>Accueil</p>
  </div>
  <div id="poster">
    <div id="tweeter"><p>quoi de neuf?</p></div>
  </div>
  <?php
    if(count($_SESSION['post']) > 0){
      for ($i=0; $i < count($_SESSION['post']) ; $i++) {
  ?>
      <div class="tweet">
        <div id="supp" class="<?= $_SESSION['post'][$i]['post_date'] ?>"><a href="" id="<?= $_SESSION['post'][$i]['post_date'] ?>"><i class="fas fa-times"></i></a></div>
          <strong><p style="padding-top:20px;"> <?= $_SESSION['name'] . "  " . $_SESSION['surname'] . "<span style=\"color:#657786; font-style:italic; font-weight:100\">       " . "@".$_SESSION['pseudo'] . " · " . $_SESSION['post'][$i]['post_date']?> </span></p></strong>
          <p> <?= $_SESSION['post'][$i]['post_content'] ?></p>
          <p id="tweet_bottom" ><a href=""><i class="far fa-comment" ></i></a><a href=""><i class="fas fa-retweet" style="margin-left:60px"></i></a><a href=""><i class="far fa-heart" style="margin-left:60px"></i></a><a href=""><i class="far fa-envelope" id="envelope" style="margin-left:60px"></i></a></p>
      </div>
  <?php
      }
    }else {
  ?>
    <p style="text-align:center; font-size:1.5em">Aucun tweet ?</p>
    <p style="text-align:center; font-size:1.5em">Commence a tweeter maintenant !</p>
  <?php
    }
  ?>
</div>

<div class="right_part">
  <div id="search">
    <input type="text" name="search" placeholder="&#128270;Recherche Twitter">
  </div>
  <div id="tendances">
    <p>Tendances pour vous !</p>
    <ul>
      <li>1. #wac</li>
      <li>2. #keke</li>
      <li>3. #weiwei</li>
  </div>
</div>
<div class="popup_supp">
  <p>test</p>
</div>



<!------------------------------------------ Notifications // JS --------------------------------------->
<?php
if(isset($succesLog))
{
?>
<script type="text/javascript">
  let delay = alertify.get('notifier','delay');
  alertify.set('notifier','delay', 4);
  alertify.set('notifier','position', 'top-center');
  alertify.success('Connexion réussi');
</script>
<?php
}
?>
<?php
if(isset($succesName))
{
?>
<script type="text/javascript">
  let delay = alertify.get('notifier','delay');
  alertify.set('notifier','delay', 4);
  alertify.set('notifier','position', 'top-center');
  alertify.success('Pseudo changé avec succes!');
</script>
<?php
}
?>

<?php
if(isset($errorName))
{
?>
<script type="text/javascript">
  let delay = alertify.get('notifier','delay');
  alertify.set('notifier','delay', 4);
  alertify.set('notifier','position', 'top-center');
  alertify.error('Votre pseudo ne doit pas avoir d\'espace');
</script>
<?php
}
?>

<?php
if(isset($errorSpace))
{
?>
<script type="text/javascript">
  let delay = alertify.get('notifier','delay');
  alertify.set('notifier','delay', 4);
  alertify.set('notifier','position', 'top-center');
  alertify.error('Erreur votre pseudo a des espace');
</script>
<?php
}
?>
<?php
if(isset($errorMail))
{
?>
<script type="text/javascript">
  let delay = alertify.get('notifier','delay');
  alertify.set('notifier','delay', 4);
  alertify.set('notifier','position', 'top-center');
  alertify.error('Mail déjà utilisé!');
</script>
<?php
}
?>
<?php
if(isset($succesMail))
{
?>
<script type="text/javascript">
  let delay = alertify.get('notifier','delay');
  alertify.set('notifier','delay', 4);
  alertify.set('notifier','position', 'top-center');
  alertify.success('Mail changé !');
</script>
<?php
}
?>
<?php
if(isset($errorPassword))
{
?>
<script type="text/javascript">
  let delay = alertify.get('notifier','delay');
  alertify.set('notifier','delay', 4);
  alertify.set('notifier','position', 'top-center');
  alertify.error('erreur');
</script>
<?php
}
?>
<?php
if(isset($succesPassword))
{
?>
<script type="text/javascript">
  let delay = alertify.get('notifier','delay');
  alertify.set('notifier','delay', 4);
  alertify.set('notifier','position', 'top-center');
  alertify.success('Mot de passe changé !');
</script>
<?php
}
?>
</body>
</html>
