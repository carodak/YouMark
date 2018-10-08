<?php

include "includes/en_tete.php";
include "fil_dariane.php";
echo fildariane("../ACCUEIL/index.php");

?>
<!-- contenu du site -->
<head>
  <link rel="stylesheet" type="text/css" href="./css/accueil_bootstrap.css" />
</head>

<body>

    <!-- page principal -->
        <div class="container-fluid">
            <div class="row content">
              <p>
                  <div class="container">
                    <form class="form-horizontal" action="" method="post">
                      <div class="form-group">
                        <div class="btn-group btn-group-sm" data-toggle="buttons">
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="ALL">ALL</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" id="a" value="A" onclick="alert('hello');">A</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="B">B</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="C">C</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="D">D</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="E">E</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="F">F</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="G">G</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="H">H</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="I">I</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="J">J</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="K">K</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="L">L</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="M">M</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="N">N</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="O">O</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="P">P</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="Q">Q</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="R">R</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="S">S</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="T">T</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="U">U</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="V">V</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="W">W</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="X">X</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="Y">Y</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="Z">Z</label>
                        </div>
                        <input class="btn btn-default" id="selected" type="submit" name="selectionner" value="Sélectionner" />
                      </div>

                    </form>

                    <?php
                    $selectionner = isset($_POST['selectionner']) ? $_POST['selectionner'] : NULL;
                    if($selectionner){
                      $alphabet = isset($_POST['alphabet']) ? $_POST['alphabet'] : "ALL";
                    }
                    else{
                      $alphabet = "ALL";
                    }

                    if($alphabet == "ALL"){
                      $tag = $managerTag->list_tag();
                    }
                    else{
                      $tag = $managerTag->trie_tag_par_alphabet($alphabet);
                    }

                    if($tag){
                      echo "<div class='row'><ul class='nav nav-pills nav-stacked tag-list'>";
                      foreach ($tag as $key => $value) {
                        $tag_occ = $managerTag->count_occurrence_tag($value['label']);
                        //si l'occurrence est different de 0
                        if($tag_occ != 0){
                        echo "<li class='col-md-4'>
                        <a href='clic_tag.php?label_tag=".rawurlencode($value['label'])."' style='background-color: #2C3E50; color:#FFF;'>".$value['label'];
                        echo "<span class='badge pull-right'>".$tag_occ."</span>
                        </a>
                        </li>";
                      }
                      }
                      echo "</ul></div>";
                    }
                    else{
                      ?>
                    <div class="alert alert-warning">
                      <a href="index.php" class="btn btn-xs btn-warning pull-right">Retour à l'accueil</a>
                        <strong>ATTENTION:</strong> Aucun tag commençant par la lettre <?php echo $alphabet; ?> !
                    </div>
                    <?php
                    }
                    ?>

                  </div>
                </p>
              </div>
            </div>
        </body>

        <script type="text/javascript">

        function submit() {

          document.getElementById("selected").click();
        }

document.getElementById('a').onclick {

  alert("sisi");
}



        </script>
