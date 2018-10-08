<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Recherche avancée</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/recherche_style.css" type="text/css" rel="stylesheet" />

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
     <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.0.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3data.js"></script> 

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
   <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.0.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3data.js"></script> 

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );

   $( function() {
    $( "#datepicker2" ).datepicker();
  } );
  </script>

</head>
<body>
<div class="mine" id="mine">
    <div class="container">
        <div class="row">
    		<div class="wrapper">
        	     <div class="side-bar">
                    <ul>
                        <li class="menu-head">
                            FILTRES <a href="#" class="push_menu"><span class="glyphicon glyphicon-align-justify pull-right"></span></a>
                        </li>
                        <form role="form" method='post' action=''>  <br style="clear:both">
                            <div class="menu">
                                <li>
                                    <div class="formulaire_date form-group">
                                        <a href="#" class='classique'>Date de publication <span class="glyphicon glyphicon-dashboard pull-right"></span></a><br>
                                        <input type="text" id="datepicker" name="date1_av" value="<?php if (isset($_POST['date1_av'])){echo $_POST['date1_av'];} ?>">
                                        <input type="text" id="datepicker2" name="date2_av" value="<?php if (isset($_POST['date2_av'])){echo $_POST['date2_av'];} ?>">
                                       
                                    </div>
                                    
                                </li>
                                <li>
                                <div class="formulaire_popularite form-group">
                                    <a href="#" class='classique'>Popularité <span class="glyphicon glyphicon-heart pull-right"></span></a>

                                    <p>
                                       

                                            <div class="well-sm text-center">
                                                
                                                <div class="btn-group" data-toggle="buttons">
                                                    
                                                    <label class="btn btn-success">
                                                        <input type="radio" name="options" value="0" autocomplete="off" checked>
                                                        <span class="glyphicon glyphicon-ok"></span>0
                                                    </label>

                                                    <label class="btn btn-primary">
                                                        <input type="radio" name="options" value="1" autocomplete="off">
                                                        <span class="glyphicon glyphicon-ok"></span>1
                                                    </label>

                                                    <label class="btn btn-info">
                                                        <input type="radio" name="options" value="2" autocomplete="off">
                                                        <span class="glyphicon glyphicon-ok"></span>2
                                                    </label>

                                                    <label class="btn btn-default">
                                                        <input type="radio" name="options" value="3" autocomplete="off">
                                                        <span class="glyphicon glyphicon-ok"></span>3
                                                    </label>

                                                    <label class="btn btn-warning">
                                                        <input type="radio" name="options" value="4" autocomplete="off">
                                                        <span class="glyphicon glyphicon-ok"></span>4
                                                    </label>

                                                    <label class="btn btn-danger">
                                                        <input type="radio" name="options" value="5" autocomplete="off">
                                                        <span class="glyphicon glyphicon-ok"></span>5
                                                    </label>
                                                
                                                </div>


                                            </div>

                                 </p>


                                </div>
                                    
                                </li>
                                <li>
                                    <div class="formulaire form-group">
                                        <a href="#" class='classique'>Auteur <span class="glyphicon glyphicon-star pull-right"></span></a>
                                        <input type="text" class="form-control" id="auteur_av" name="auteur_av" value="<?php if (isset($_POST['auteur_av'])){echo $_POST['auteur_av'];} ?>"  placeholder="Aide éventuelle via le Auteur Cloud">
                                    </div>
                                   <?php
                                        include 'preview_recherche_ac.php';
                                    ?>
                                   
                                </li>
                                <li>
                                    <div class="formulaire form-group">
                                        <a href="#" class='classique'>Url <span class="glyphicon glyphicon-cog pull-right"></span></a>
                                        <input type="text" class="form-control" value="<?php if (isset($_POST['url_av'])){echo $_POST['url_av'];} ?>" name="url_av" placeholder="">
                                    </div>
                                    
                                </li>
                                 <li>
                                    <div class="formulaire form-group">
                                         <a href="#" class='classique'>Tags <span class="glyphicon glyphicon-star pull-right"></span></a>
                                         <input type="text" class="form-control" id="tag_av" name="tag_av" value="<?php if (isset($_POST['tag_av'])){echo $_POST['tag_av'];} ?>" placeholder="Séparés par un ;">
                                         
                                    </div>
                                </li>
                                 <li>
                                    
                                </li>

                                <?php
                                include 'preview_recherche_tg.php';
                                ?>
                                <p><input type="submit" name="envoi_form2" value="Valider" class="btn btn-primary pull-right"></p>
                            </div>
                            
                        </form>
                        
                    </ul>
                </div>   
               
                
    		</div>
    	</div>
    </div>
</div>

<script type="text/javascript">
function completer_valeur_tag(label)
{
    
   var text = label;

    document.getElementById("tag_av").value = document.getElementById("tag_av").value.concat(text).concat(";");

}

function completer_valeur_auteur(auteur)
{
    var text = auteur;

    document.getElementById("auteur_av").value = text;

}
</script>

<script type="text/javascript">
$(document).ready(function(){ 
    $('#characterLeft').text('140 characters left');
    $('#message').keydown(function () {
        var max = 140;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('You have reached the limit');
            $('#characterLeft').addClass('red');
            $('#btnSubmit').addClass('disabled');            
        } 
        else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' characters left');
            $('#btnSubmit').removeClass('disabled');
            $('#characterLeft').removeClass('red');            
        }
    });    
});

</script>


</body>
</html>
