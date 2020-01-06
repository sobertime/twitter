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
  <link rel="stylesheet" href="./css/profil.css"/>
	<title>Profil/Twitter</title>
</head>
<body>
<?php require_once('menu.php') ?>
<div class="mid_part">
  <div id="first_part">
  <div id="go_back"><a href=""><i class="fas fa-arrow-left"></i></a></div>
  <div id="user_name">
    <h3><?= $_SESSION['pseudo']?></h3>
  </div>
</div>
<div id="sec_part">
  <div id="user_info">
    <img src=""/>
    <h5><?= $_SESSION['name']?></h5>
    <h6><?= "@".$_SESSION['pseudo']?></h6>
    <p>0 abonnement</p><p>0 abonné</p>
    <h6><?="Date de naissance :".$_SESSION['birthdate']?></h6>
  </div>
  <div id="edit_profil">
    <button class="editer_profil">Editer le profil</button>
  </div>
      <h6 id="country"><?= "<strong>Pays:</strong> ".$_SESSION['pays']?></h6>
</div>
<div id="user_tweet">
  <?php
    if(isset($_SESSION['post'])){
      for ($i=0; $i < count($_SESSION['post']) ; $i++) {
  ?>
      <div class="tweet">
        <div id="supp" class="<?= $_SESSION['post'][$i]['post_date'] ?>"><a href="" id="<?= $_SESSION['post'][$i]['post_date'] ?>"><i class="fas fa-times"></i></a></div>
          <strong><p style="padding-top:20px;"> <?= $_SESSION['name'] . "  " . $_SESSION['surname'] . "<span style=\"color:#657786; font-style:italic; font-weight:100\">       " . "@".$_SESSION['pseudo'] . " · " . $_SESSION['post'][$i]['post_date']?> </span></p></strong>
          <p> <?= $_SESSION['post'][$i]['post_content'] ?></p>
          <p id="tweet_bottom" ><a href=""><i class="far fa-comment" ></i></a><a href=""><i class="fas fa-retweet" style="margin-left:60px"></i></a><a href=""><i class="far fa-heart" style="margin-left:60px"></i></a><a href=""><i class="far fa-envelope" style="margin-left:60px"></i></a></p>
      </div>
  <?php
      }
    }else {
  ?>
    <p>Mur vide</p>
  <?php
    }
  ?>
</div>
</div>
<div class="right_part">
  <div id="search">
    <input type="text" name="search" placeholder="&#128270; Recherche Twitter">
  </div>
  <div id="tendances">
    <p>Tendances pour vous !</p>
    <ul>
      <li>1. #wac</li>
      <li>2. #keke</li>
      <li>3. #weiwei</li>
        <li>4. #repier</li>
        <li>5. #mathieu</li>
  </div>
  <div id="suggestions">
    <h3>Suggestions</h3>
    <ul>
      <li>User 1<button>suivre</button></li>
      <li>User 2<button>suivre</button></li>
      <li>User 3<button>suivre</button></li>
  </div>
</div>
<div class="popup_edit">
  <form method="post" action="index.php?controller=Home&action=modifyName">
  <div class="editer_header"><a href="" id="close" ><p><i class="fas fa-times"></i></p></a><p>Editer le profil</p><input type="submit" value="Enregister"/></div>
  <div id="img_user"></div><!-- -->
  <div id="editer">
    <label>Pseudo</label></br><input type="text" name="name" id="name" placeholder="<?= $_SESSION['pseudo']?>"/>
  </br>
  <label>Pays</label></br><input type="text" id="pays" placeholder="<?= $_SESSION['pays']?>"/>
</br>
    <label>Bio</label></br><textarea id="bio" placeholder="Veuillez renseigner une Bio.."></textarea>
  </div>
</form>
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
</body>
</html>
