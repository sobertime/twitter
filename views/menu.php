<?php
if(isset($message)){
?>
  <div class="left_part" style="width:400px">
<?php
}
else {
?>
  <div class="left_part">
<?php
}
?>
<div id="logo">
<img src="../css/logo.png">
</div>
<div id="list">
<ul>
  <?php
    if(isset($home)){
  ?>
  <li><a href="index.php?controller=Home&action=show"><p style="color:#1ea1f2"><i class="fas fa-kiwi-bird" style="margin-right:10px;margin-left:35px"></i>Accueil</p></a></li>
  <?php
    }
    else{
  ?>
    <li><a href="index.php?controller=Home&action=show"><p><i class="fas fa-kiwi-bird" style="margin-right:10px;margin-left:35px"></i>Accueil</p></a></li>
  <?php
    }
  ?>
  <?php
    if(isset($message)){
  ?>
    <li><a href="index.php?controller=Message&action=show"><p style="color:#1ea1f2"><i class="fas fa-envelope" style="margin-right:10px;margin-left:35px"></i>Messages</p></a></li>
  <?php
    }
    else{
  ?>
    <li><a href="index.php?controller=Message&action=show"><p><i class="fas fa-envelope" style="margin-right:10px;margin-left:35px"></i>Messages</p></a></li>
  <?php
  }
  ?>
  <?php
    if(isset($profil)){
  ?>
    <li><a href="index.php?controller=Profil&action=show"><p style="color:#1ea1f2"><i class="fas fa-user-circle" style="margin-right:10px;margin-left:35px"></i>Profil</p></a></li>
  <?php
    }
    else{
  ?>
    <li><a href="index.php?controller=Profil&action=show"><p><i class="fas fa-user-circle" style="margin-right:10px;margin-left:35px"></i>Profil</p></a></li>
  <?php
    }
  ?>
  <?php
    if(isset($parametre)){
  ?>
    <li id="plus"><a><p style="color:#1ea1f2"><i class="fas fa-ellipsis-h" style="margin-right:10px;margin-left:35px"></i>Plus</p></a></li>
  <?php
    }
    else{
  ?>
    <li id="plus"><a><i class="fas fa-ellipsis-h" style="margin-right:10px;margin-left:35px"></i>Plus</a></li>
  <?php
    }
  ?>

  <div id="resultat">
          <!-- Nous allons afficher un retour en jQuery au visiteur -->
      </div>
</ul>
<div id="btn_tweeter">
  <p id="tweet" style="padding-top:18px;"><strong>Tweeter</strong></p>
</div>
</div>
<div class="popup">
  <section class='alert'>
  <div class="up">
    <p><i class="far fa-user-circle"></i></p>
    <p><?= $_SESSION['name']?> <?= $_SESSION['surname'] ?></p>
    <p><a href="index.php?controller=profil&action=show"> <?= "@".$_SESSION['pseudo']?></a></p>
  </div>
  <div class="down">
    <p><a href="index.php?controller=parametre&action=show"><i class="fas fa-cog"></i>Paramètres</a></p>
    <p><i class="far fa-lightbulb"></i>Mode sombre/@@@<label class="onoffbtn"><input type="checkbox"></label></p>
    <p><a href="index.php?controller=presentation&action=deco" style="border-top: 1px solid #e7ecf0">deconnexion</a></p>
  </div>
  </section>
</div>
<div class="popupTweet" style="z-index:9999">
  <div class="up-side-tweet">
    <a href="" id="close" ><p><i class="fas fa-times"></i></p></a>
    <a href="" id="send-tweet"><p>Tweeter</p></a>
  </div>
  <div class="tweet-line"></div>
  <div class="text_tweet" style="height:50px; width:100px">
    <textarea id="text_tweet" name="name" rows="6" cols="55" style="resize:none; border-radius:12px; background-color:#e7ecf0" placeholder="Quoi de neuf ?"></textarea>
    <p id="compteur"></p>
  </div>
</div>
</div>
<div class="queryResult">

</div>
