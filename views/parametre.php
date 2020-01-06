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
  <?php require_once('menu.php')?>
  <div class="mid_section">
    <div><p id="para-text">Paramètres</p></div>
    <div><p id="para-text"><?= "@".$_SESSION['pseudo'] ?></p></div>
    <div><p style="text-align:center; font-weight: bold; margin-top:30px; margin-bottom:30px;">Nom d'utilisateur</p></div>
    <button id="user-name" type="button" class="btn btn-info" style="display:block; margin:auto; background:#1ea1f2;">Modifier</button>
    <div><p style="text-align:center; font-weight: bold; margin-top:30px; margin-bottom:30px;">Email</p></div>
    <button id="user-mail" type="button" class="btn btn-info" style="display:block; margin:auto; background:#1ea1f2;">Modifier</button>
    <div><p style="text-align:center; font-weight: bold; margin-top:30px; margin-bottom:30px;">Mot de passe</p></div>
    <button id="user-password" type="button" class="btn btn-info" style="display:block; margin:auto; background:#1ea1f2;">Modifier</button>
  </div>
  <!------------------------------------------ Notifications // JS --------------------------------------->
  <script type="text/javascript">
  $('#user-name').click(function() {
    $('.hiddenUserName').css("display", "block");
    event.preventDefault();
    alertify.genericDialog || alertify.dialog('genericDialog', function() {
      return {
        main: function(content) {
          this.setContent(content);
        },
        setup: function() {
          return {
            focus: {
              element: function() {
                return this.elements.body.querySelector(this.get('selector'));
              },
              select: true
            },
            options: {
              basic: true,
              maximizable: false,
              resizable: false,
              overflow: false,
              padding: true
            }
          };
        },
        settings: {
          selector: "undefined"
        }
      };
    });
    //force focusing password box
    alertify.genericDialog($('.hiddenUserName')[0]).set('selector', 'input[type="email"]');
    //$('.ajs-body').css("height", "400px"); //hauteur popup connexion
    //$('.ajs-dialog').css("background-image", "url('../image/conn.jpg')"); //background popup connexion
  });
  $('#user-mail').click(function() {
    $('.hiddenUserMail').css("display", "block");
    event.preventDefault();
    alertify.genericDialog || alertify.dialog('genericDialog', function() {
      return {
        main: function(content) {
          this.setContent(content);
        },
        setup: function() {
          return {
            focus: {
              element: function() {
                return this.elements.body.querySelector(this.get('selector'));
              },
              select: true
            },
            options: {
              basic: true,
              maximizable: false,
              resizable: false,
              overflow: false,
              padding: true
            }
          };
        },
        settings: {
          selector: "undefined"
        }
      };
    });
    //force focusing password box
    alertify.genericDialog($('.hiddenUserMail')[0]).set('selector', 'input[type="email"]');
    //$('.ajs-body').css("height", "400px"); //hauteur popup connexion
    //$('.ajs-dialog').css("background-image", "url('../image/conn.jpg')"); //background popup connexion
  });
  $('#user-password').click(function() {
    $('.hiddenUserPassword').css("display", "block");
    event.preventDefault();
    alertify.genericDialog || alertify.dialog('genericDialog', function() {
      return {
        main: function(content) {
          this.setContent(content);
        },
        setup: function() {
          return {
            focus: {
              element: function() {
                return this.elements.body.querySelector(this.get('selector'));
              },
              select: true
            },
            options: {
              basic: true,
              maximizable: false,
              resizable: false,
              overflow: false,
              padding: true
            }
          };
        },
        settings: {
          selector: "undefined"
        }
      };
    });
    //force focusing password box
    alertify.genericDialog($('.hiddenUserPassword')[0]).set('selector', 'input[type="email"]');
    //$('.ajs-body').css("height", "400px"); //hauteur popup connexion
    //$('.ajs-dialog').css("background-image", "url('../image/conn.jpg')"); //background popup connexion
  });
  </script>
  <form method="POST" action="index.php?controller=Home&action=modifyName" class="hiddenUserName">
    <fieldset>
        <label style="text-align:center"> Nouveau nom d'utilisateur </label>
        <input type="text" name="name" id="name" class="form-control membersadded" required/>
        <br/>
        <input type="submit" value="Modifier" style="display:block; margin:auto" class="btn btn-succes"/>
    </fieldset>
  </form>
  <form method="POST" action="index.php?controller=Home&action=modifyMail" class="hiddenUserMail">
    <fieldset>
        <label style="text-align:center"> Nouvelle adresse Mail </label>
        <input type="email" name="email" id="email" class="form-control membersadded" required/>
        <br/>
        <input type="submit" value="Modifier" style="display:block; margin:auto" class="btn btn-succes"/>
    </fieldset>
  </form>
  <form method="POST" action="index.php?controller=Home&action=modifyPassword" class="hiddenUserPassword">
    <fieldset>
        <label style="text-align:center"> Nouveau mot de passe </label>
        <input type="password" name="password" id="password" class="form-control membersadded" required/>
        <br/>
        <input type="submit" value="Modifier" style="display:block; margin:auto" class="btn btn-succes"/>
    </fieldset>
  </form>
  </body>
</html>
