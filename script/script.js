/*form de connexion form d'inscription*/
$(function() {

  $('#log-in').click(function() {
    $('.hiddenConnexion').css("display", "block");
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
    alertify.genericDialog($('#connexionForm')[0]).set('selector', 'input[type="email"]');
    //$('.ajs-body').css("height", "400px"); //hauteur popup connexion
    //$('.ajs-dialog').css("background-image", "url('../image/conn.jpg')"); //background popup connexion
  });
  $('#sign-up').click(function() {
    $('.hiddenInscription').css("display", "block");
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
    alertify.genericDialog($('#inscriptionForm')[0]).set('selector', 'input[type="text"]');
    //$('.ajs-body').css("height", "400px"); //hauteur popup connexion
    //$('.ajs-dialog').css("background-image", "url('../image/conn.jpg')"); //background popup connexion
  });

    let toggle = 0;
    $('#plus').click(function(){
      if(toggle == 0){
        $('.popup').css("display","block");
        toggle = 1;
      }
      else {
        $('.popup').css("display","none");
        toggle = 0;
      }
    });
    $('.onoffbtn').on('click', function(){
  if($(this).children().is(':checked')){
    $(this).addClass('active');
    alert('Imagine le theme il a changer');
  }
  else{
    $(this).removeClass('active')
  }


});

let toggleTweet = 0;
$('#btn_tweeter').click(function(){
  event.stopPropagation();
  if(toggleTweet == 0){
    $('.popupTweet').css("display","block");
    $('body').css("background","rgba(0, 0, 0, 0.20)");
    toggleTweet = 1;
  }
  else {
    $('.popupTweet').css("display","none");
    $('body').css("background","rgba(0, 0, 0, 0)");
    toggleTweet = 0;
  }
  $('.popupTweet').click(function(){event.stopPropagation();});
  $('#text_tweet').click(function(){
      event.stopPropagation();
      $('#text_tweet').css("background","#fff");
      $('#text_tweet').css("border","2px solid #1ea1f2");
  });

  let tweet = false;
  $('#text_tweet').keyup(function() {

    var nombreCaractere = $(this).val().length;

    // On soustrait le nombre limite au nombre de caractère existant
    var nombreCaractere = 144 - nombreCaractere;

    var nombreMots = jQuery.trim($(this).val()).split(' ').length;
    if($(this).val() === '') {
     	nombreMots = 0;
    }

    var msg = nombreCaractere + ' Caracteres restant';
    $('#compteur').text(msg);

    if (nombreCaractere < 0) {
      $('#compteur').css("color","red");
      $('#send-tweet').css("background","#8ed0f8");
      tweet = false;
    }
    else if (nombreCaractere == 144) {
      $('#send-tweet').css("background","#8ed0f8");
      tweet = false;
    }else {
      tweet = true;
      $('#send-tweet').css("background","#1ea1f2");
      $('#compteur').css("color","black");
    }

  });

  $('#send-tweet').click(function(){
    if ($('#compteur').text().length == 0) {
      event.preventDefault();
      $('#send-tweet').css("background","#8ed0f8");
      let delay = alertify.get('notifier','delay');
      alertify.set('notifier','delay', 4);
      alertify.set('notifier','position', 'top-center');
      alertify.error('tweeter un tweet vide t\'es con ?');
    }
    else if(!tweet){
      event.preventDefault();
      let delay = alertify.get('notifier','delay');
      alertify.set('notifier','delay', 4);
      alertify.set('notifier','position', 'top-center');
      alertify.error('Votre tweet ne doit pas dépasser 144 caracteres');
    }
    else{
      $.post(
            'index.php?controller=Home&action=tweet',
            {
                tweet : $('#text_tweet').val()
            },

            function(data){
              if(data){
                  document.location.reload(true);
              }
              else{
                console.log("Failed");
              }
            },
          'text'
         );
    }
  });

});


$(document).click(function() {
  if(toggleTweet == 1 ){
    $('.popupTweet').css("display","none");
    $('body').css("background","rgba(0, 0, 0, 0)");
    $('#text_tweet').css("background","#e7ecf0");
    $('#send-tweet').css("background","#8ed0f8");
    toggleTweet = 0;
  }
});

let editerProfil = false;
$(document).click(function() {
  if(editerProfil){

    $('.popup_edit').css("display","none");
    $('body').css("background","rgba(0, 0, 0, 0)");
    editerProfil = false;
  }
});
$('.editer_profil').click(function(){
  event.stopPropagation();
  $('.popup_edit').css('display','block');
  $('body').css("background","rgba(0, 0, 0, 0.20)");
  editerProfil = true;
  $('.popup_edit').click(function(){
    event.stopPropagation();
  });
});

$('.tweet > #supp').click(function(){
  event.preventDefault();
  //console.log($(this).children().children().attr('id'));
  $.post(
        'index.php?controller=Home&action=deleteTweet',
        {
            delete : $(this).attr('class')
        },

        function(data){
          if(data){

            let delay = alertify.get('notifier','delay');
            alertify.set('notifier','delay', 2);
            alertify.set('notifier','position', 'top-center');
            alertify.success('tweet supprimé !');
            setTimeout(function() {
              document.location.reload(true);
            }, 1000);
          }
          else{
            console.log("Failed");
          }
        },
      'text'
     );

})
let a = 0;
$('#search').keydown(function(event) {
  if (event.keyCode == 13) {
    //console.log($(this).children().val());
    $.post(
          'index.php?controller=Home&action=showResult',
          {
              searchQuery : $(this).children().val()
          },

          function(data){
            if(data){
              let result = JSON.parse(data);
              //console.log(result[0][0]["id"])
              if(result[0].length == 0){
                $('.queryResult').html("");
                $('.queryResult').append("<div class=\"result\" style=\"text-align:center\"><p>Aucun résultat</p></div>");
              }
              else{
                $('.queryResult').html("");
                for (var i = 0; i < result[0].length; i++) {
                  $('.queryResult').append("<div class=\"result\"><h4 style=\"margin-left:30px;\" id=\""+result[0][i]["id"]+"\">"
                      + result[1][i][0]['surname'] + "  " + result[1][i][0]['name']  +
                      "</h4><p style=\"margin-left:40px; color:#657786\"> @"+ result[0][i]['pseudo'] + "</p><div id=\"follow-result\" class=\""+result[0][i]["id"]+"\">Suivre</div><p style=\"margin-left:30px\">Bio a remplir</p>")

                  $('.queryResult').append("</div>")
                }
              }
                $('.queryResult').css('display',"block");
                $('body').css("background","rgba(0, 0, 0, 0.20)");
                a = 1;
                let follow = 0;
                $('.result > #follow-result').click(function(){
                  if($(this).text() == 'Suivre'){
                  //alert($(this).attr('class'))
                    $(this).text('Se désabonner');
                    $(this).css('background','#F44336');
                    $(this).css('width','130px');
                    event.preventDefault();
                    follow = 1;
                    Ffollow($(this).attr('class'))
                  }
                  else  {
                    $(this).text('Suivre');
                    $(this).css('background','#1ea1f2');
                    $(this).css('width','90px');
                    event.preventDefault();
                    follow = 0;
                    unFollow($(this).attr('class'))
                  }
                })
                $('h4').click(function(){
                  $('.queryResult').html("");
                  $('.queryResult').css("display","none");
                  $('body').css("background","rgba(0, 0, 0, 0)");
                  a = 0;
                  $('.mid_part').html("");
                  //console.log($(this).attr('id'))
                  $.post(
                        'index.php?controller=Home&action=profilVisit',
                        {
                            visit : $(this).attr('id')
                        },

                        function(data){
                          if(data){
                              let result = JSON.parse(data);
                              visitProfil(result);
                          }
                          else{
                            console.log("Failed");
                          }
                        },
                      'text'
                     );
                })

            }
            else{
              console.log("Failed");
            }
          },
        'text'
       );
  }

});
$('.queryResult').click(function(){
  event.stopPropagation();
})
let searchNewMsgg = 0
let newMsgWindoww = 0
$(document).click(function() {
      event.stopPropagation();
    if(a == 1){
      $('.queryResult').html("");
      $('.queryResult').css("display","none");
      $('body').css("background","rgba(0, 0, 0, 0)");
      a = 0;
    }
   if (searchNewMsgg == 1) {
      $('.searchNewMsg').css("display","none");
      $('body').css("background","rgba(0, 0, 0, 0)");
      searchNewMsgg = 0;
    }
    if (newMsgWindoww == 1) {
      $('.newMsgWindow').css("display","none");

      $('body').css("background","rgba(0, 0, 0, 0)");
      newMsgWindoww = 0;
    }

})

function visitProfil(result){
  console.log(result)
  $('.mid_part').append("<div><div id=\"go_back\"><a href=\"index.php?controller=Home&action=show\"><i class=\"fas fa-arrow-left\"></i></a></div><p id=\"profil-visit-name\">"+result[1][0]['name']+"  "+result[1][0]['surname']+"</p><p style=\"margin-left:80px; color:#657786; margin-top:-20px;\">0 Tweets</p></div>")
  $('.mid_part').append("<div id=\"suggestions-visit\"><button>suivre</button></div>")
  $('.mid_part').append("<p style=\"font-size:1.3em; font-weight:bold; margin-left:30px; margin-top:20px;\">"+result[1][0]['name']+"  "+result[1][0]['surname']+"</p>")
  $('.mid_part').append("<p style=\"margin-left:30px; color:#657786\">@"+ result[0][0]['pseudo'] +"</p>")
  $('.mid_part').append("<p style=\"margin-left:30px\"> BIO QUI N'EXISTE PAS</p>")
  $('.mid_part').append("<p style=\"margin-left:30px\"><i class=\"far fa-calendar-alt\"></i> A rejoint tweeter le dddddd</p>")
  $('.mid_part').append("<p style=\"border-bottom:1px solid #e7ecf0; margin-left:30px\">0 <span style=\"color:#8f9ca7\">Abonnements</span>  0 <span style=\"color:#8f9ca7\">abonnés</span></p>")

//  $('.mid_part').append("<p id=\"profil-visit-name\">"+result[1][0]['name']+"  "+result[1][0]['surname']+"</p>")
//  $('.mid_part').append("<p style=\"margin-left:30px; color:#657786\">0 Tweets</p></div>")
  // $('.mid_part').append("<p style=\"border-bottom:1px solid black\"> A FAIRE Tweets</p>")
  // $('.mid_part').append("<p>"+result[1][0]['name']+"  "+result[1][0]['surname']+"</p>")
  // $('.mid_part').append("<p>@"+result[0][0]['pseudo']+"</p>")
  // $('.mid_part').append("<p style=\"border-bottom:1px solid black\">TWEETS</p>")
  if(result[2].length == 0){
    $('.mid_part').append("<p style=\"color:blue\">Cette personne n'a aucun tweet incroyable non ?</p>")
  }
  else{
    for (var i = 0; i < result[2].length; i++) {
      $('.mid_part').append("<div class=\"tweet\"><p style=\"padding-top:20px; font-weight:bold;\">"+result[1][0]['name']+ " <span style=\"color:#657786; font-style:italic; font-weight:100\">  @"+ result[0][0]['pseudo']+ " · " +result[2][i]['post_date']+ "</span></p><p >"+result[2][i]['post_content']+"</p><p id=\"tweet_bottom\" ><a href=\"\"><i class=\"far fa-comment\" ></i></a><a href=\"\"><i class=\"fas fa-retweet\" style=\"margin-left:60px\"></i></a><a href=\"\"><i class=\"far fa-heart\" style=\"margin-left:60px\"></i></a><a href=\"\"><i class=\"far fa-envelope\" id=\"envelope\" style=\"margin-left:60px\"></i></a></p></div>")

    }
  }
}

  function Ffollow(id){
    console.log(id)
  }

  function unFollow(id){
    console.log(id)
  }

  $('#content_msg > #new_msg').click(function(){
    //event.stopPropagation();
    searchNewMsg();
  })

  $('#header_msg > #new_msg').click(function(){
    //event.stopPropagation();
    searchNewMsg();
  })

  function searchNewMsg(){
    event.stopPropagation();
    $('.searchNewMsg').css("display","block")
    $('body').css("background","rgba(0, 0, 0, 0.20)");
    searchNewMsgg = 1;
  }

  $(' #inputNewMsg').click(function(){event.stopPropagation()})
  $('.searchNewMsg').click(function(){event.stopPropagation()})
  $(' #inputNewMsg').keydown(function(event) {
    if (event.keyCode == 13) {
      $.post(
            'index.php?controller=Home&action=showResult',
            {
                searchQuery : $(this).val()
            },

            function(data){
              if(data){
                var result = JSON.parse(data);
                $('.searchNewMsgResult').html("")
                if(result[0].length != 0){
                  console.log(JSON.parse(data))
                  for (var i = 0; i < result[0].length; i++) {
                    $('.searchNewMsgResult').append("<p id=\"name_search\">" + result[1][i][0]['name'] + " " + result[1][i][0]['surname'] + "</p>")
                    $('.searchNewMsgResult').append("<p id=\"pseudo_search\" >@" + result[0][i]['pseudo'] + "</p>")
                    $('.searchNewMsgResult').append("<p id=\"msg_to_user\" style=\"float:right; margin-top:-55px; margin-right:20px\"><button class=\""+result[0][i]['pseudo']+"\" id=\""+result[0][i]['id']+"\">Message</button></p>")
                  }

                  $('.searchNewMsgResult > #msg_to_user').click(function(){

                    $('.searchNewMsg').css('display','none')
                    $('.searchNewMsgResult').html("");
                    msgWindow($(this).children().attr('id'),$(this).children().attr('class'));
                  });
                }
                else {
                  $('.searchNewMsgResult').append("<p>Aucun résultat</p>")
                }
              }
              else{
                console.log("Failed");
              }
            },
          'text'
         );
    }
  })
$('.newMsgWindow').click(function(){event.stopPropagation()})
function msgWindow(id,pseudo){
  newMsgWindoww = 1
  $('body').css("background","rgba(0, 0, 0, 0.20)");
  $('.newMsgWindow').html("")
  $('.newMsgWindow').css('display','block')
  $('.newMsgWindow').append("<div class=\"head_msg\"><p id=\"title_msg\">Message à @\""+ pseudo +"\"</p></div><div class=\"content_msg\"><textarea id=\"msg_content\"name=\"name\" rows=\"4\" cols=\"40\"></textarea></div><div class=\"input_msg\"><button id=\"send_msg\">Envoyer</button></div>")
  $('#send_msg').click(function(){
    sendMsg(id,pseudo,$('#msg_content').val(),0);
  })
  console.log(pseudo)
}

function sendMsg(id,pseudo,msg,mode){
  $.post(
        'index.php?controller=Message&action=sendMsg',
        {
            id : id,
            pseudo: pseudo,
            msg: msg
        },

        function(data){
          if(data == "ok"){

            let delay = alertify.get('notifier','delay');
            alertify.set('notifier','delay', 4);
            alertify.set('notifier','position', 'top-center');
            alertify.success('Message envoyé !');
            if(mode == 0){
              setTimeout(function() {
                document.location.reload(true);
              }, 1000);
            }
            else{
              $('.user_msg > #msg_users.'+id+'').click();
            }
          }
          else{
            console.log("Failed");
          }
        },
      'text'
     );
}
$('.user_msg > #msg_users').click(function(){
  $.post(
        'index.php?controller=Message&action=showMsg',
        {
            id_msg : $(this).attr('class')
        },

        function(data){
          if(data){
            var result = JSON.parse(data);
            console.log(result)
            $('.content').html("")
            $('.bottom_msg').html("")
            for (var i = 0; i < result.length; i++) {
              if(result[i]['from_id'] == sessionStorage.getItem("id")){
                $('.content').append("<p id=\"me\" >"+result[i]['message_content']+"</p>")
                $('.bottom_msg').append("<p id=\"hidden_msg\" class=\""+result[i]['to_id']+"\" ></p>")
              }
              else
                $('.content').append("<p id=\"you\" class=\""+result[i]['from_id']+"\" >"+result[i]['message_content']+"</p>")
                $('.bottom_msg').append("<p id=\"hidden_msg\" class=\""+result[i]['from_id']+"\" ></p>")
            }
            $('.bottom_msg').append("<input id=\"send_new_msg\" style=\"width:70%;  margin-left:120px;\" type\"text\"></input><i class=\"far fa-paper-plane\"></i>")


            $('#send_new_msg').keydown(function(event) {
              if (event.keyCode == 13) {
                //$(this).parent().parent().children().children().attr('class') from 16
                //$(this).parent().children().attr('class') to 17
                sendMsg($(this).parent().children().attr('class'),1,$(this).val(),1)
                console.log($(this).parent().children().attr('class'))
              }
            })
          }
          else{
            console.log("Failed");
          }
        },
      'text'
     );
})




$.post(
      'index.php?controller=Message&action=showMsg',
      {
          id_sess_msg : 1
      },

      function(data){
        if(data){
          var result = JSON.parse(data);
          sessionStorage.setItem('id',result);
        }
        else{
          console.log("Failed");
        }
      },
    'text'
   );
// $('.supp_tweet').click(function(){
//   $('.popup_supp').css('display','block');
//   $('body').css("background","rgba(0, 0, 0, 0.20)");
// });

});
