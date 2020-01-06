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
<div class="mid_part" style="width:300px">
    <div id="header_msg">
  <h3 style="text-align:center">Messages privés</h3>
    <button  id="new_msg" style="  display:block;margin:auto;">Nouveau message</button>
    </div>
    <?php if(isset($_SESSION['msg']) && count($_SESSION['msg'][0]) > 0){ ?>
    <div class="user_msg" title="cliquez pour voir les messages">
              <?php
                for ($i=0; $i < count($_SESSION['msg'][1]); $i++) {
              ?>
                <p id="msg_users" class="<?= $_SESSION['msg'][0][$i]?>">@<?= $_SESSION['msg'][1][$i][0]['pseudo']?></p>
              <?php
                  }
              ?>
    </div>
    <?php
      }
      else{ ?>
    <div id="content_msg">
        <h4>Envoyez un message, recevez un message</h4>
        <p>Les Messages Privés sont des conversations privées entre vous et d'autres personnes sur Twitter. Partagez des Tweets, du contenu multimédia et plus encore !</p>
        <button id="new_msg" >Commencez une conversation</button>
    </div>
    <?php } ?>
</div>
<div class="message_part">
  <div class="head">

  </div>
  <div class="content">

  </div>
  <div class="bottom_msg">

  </div>
</div>
<div class="searchNewMsg">
    <img src="../css/logo.png" style="width: 11%;height: 11%">
  <label style="font-weight: bold">Rechercher</label>
  <input id="inputNewMsg" type="text" placeholder="à qui envoyer ce message?" style="border-radius:12px; "></input>
  <div class="searchNewMsgResult">

  </div>
</div>
  <div class="newMsgWindow">

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
