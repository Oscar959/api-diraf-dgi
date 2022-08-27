<?php
    $connect = new PDO('mysql:host=localhost; dbname=diraf_db', 'root', '');
    $connect->exec("SET CHARACTER SET utf-8");
    $con = mysqli_connect("localhost", "root", "", "diraf_db");
    $con->set_charset("utf8");
    function seoUrl($string)
    {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }

    function apostrophe($data)
    {
        $cut = explode("'", $data);
        $ready = implode('\\\'', $cut);
        return $ready;
    }
include("header.php");
?>

 <body>
     <div class="row m-1">
         <div class="col-md-12">
             <div class="col-md-12">
                 <form action="" method="post" class="insert-form">
                     <hr>
                     <h1 class="text-center text-secondary">Formulaire d'ajout des contribuables</h1>
                     <hr>
                     <div class="input-field">
                         <table class="table table-bordered table-secondary" id="table-field">
                             <tr>
                                 <td class="text-mute">Entrez le numero</td>

                                 <td class="text-mute">Entrez le nif</td>

                                 <td class="text-mute">Forme Juridique</td>
                                 <small id="form_juridique_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td class="text-mute">Raison social</td>
                                 <small id="raison_social_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td class="text-mute">Sigle</td>
                                 <small id="sigle_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td class="text-mute">Siege du succurale</td>
                                 <small id="siege_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td class="text-mute">Adresse du contribuable</td>
                                 <small id="adresse_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td class="text-mute">Secteur d'activité</td>
                                 <small id="secteur_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td class="text-mute">Etat social</td>
                                 <small id="etat_social_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td class="text-mute">Ancien siege</td>
                                 <small id="ancien_siege_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td class="text-mute">Nouveau siege</td>
                                 <small id="nouveau_siege_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td class="text-mute">Reference note service</td>
                                 <small id="reference_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small>

                                 <td>Action</td>
                             </tr>
                             <?php
                                if (isset($_POST['save'])) {
                                    $numero_contribuale = $_POST['numero_contribuale'];
                                    $nif = $_POST['nif'];
                                    $form_juridique = $_POST['form_juridique'];
                                    $raison_social = $_POST['raison_social'];
                                    $sigle = $_POST['sigle'];
                                    $siege = $_POST['siege'];
                                    $adresse = $_POST['adresse'];
                                    $secteur = $_POST['secteur'];
                                    $etat_social = $_POST['etat_social'];
                                    $ancien_siege = $_POST['ancien_siege'];
                                    $nouveau_siege = $_POST['nouveau_siege'];
                                    $reference = $_POST['reference'];

                                    foreach ($numero_contribuale as $key => $value) {
                                        /*$save = "INSERT INTO `articles` (`id`, `nom`, `quantite`, `pu`) VALUES (NULL, '" . $value . "', '" . $qte[$key] . "',
                               '" . $pu[$key] . "')";*/

                                        $query = $connect->exec("INSERT INTO `repertoire` (`numero`, `nif`, `forme_juridique`, `raisons_social`, `sigle`, `siege_du_succurale`, `adresse`, `secteur_d_activite`, `etat_sociale`, `ancien_service_gestionnaire`, `nouveau_service_gestionnaire`, `ref_note_de_service`) 
                                        VALUES ('$value', '" .$nif[$key]. "', '" .$form_juridique[$key]. "', '" .$raison_social[$key]. "', '" .$sigle[$key]. "', '" .$siege[$key]. "', '" .$adresse[$key]. "', '" .$secteur[$key]. "', '" .$etat_social[$key]. "', '" .$ancien_siege[$key]. "', '" .$nouveau_siege[$key]. " ', '" .$reference[$key]. "');") or die(print_r($connect->errorInfo()));
                                        //$query = mysqli_query($con, $save);
                                        $message = "";
                                        if ($query) {
                                            $message = "<div class='text-secondary'>Insertion Reussie</div>";
                                        } else {
                                            $message = "<div class='text-secondary'>ça n'as marché</div>";
                                        }
                                        echo $message;
                                    }
                                }
                                ?>
                             <tr>
                                 <td style="width:5%"> <input type="text" name="numero_contribuale[]" id="numero_contribuale" class="form-control" required> </td>
                                 <td style="width:11%"> <input type="text" name="nif[]" id="nif" class="form-control"></td>
                                 <td style="width:9%"> <input type="text" name="form_juridique[]" id="form_juridique" class="form-control"> </td>
                                 <td style="width:9%"> <input type="text" name="raison_social[]" id="raison_social" class="form-control"> </td>
                                 <td style="width:9%"> <input type="text" name="sigle[]" id="sigle" class="form-control"> </td>
                                 <td style="width:9%"> <input type="text" name="siege[]" id="siege" class="form-control"> </td>
                                 <td style="width:15%"> <textarea name="adresse[]" id="adresse" cols="10" rows="5" class="form-control"></textarea> </td>
                                 <td style="width:9%"> <input type="text" name="secteur[]" id="secteur" class="form-control"> </td>
                                 <td style="width:9%"> <input type="text" name="etat_social[]" id="etat_social" class="form-control"> </td>
                                 <td style="width:9%"> <input type="text" name="ancien_siege[]" id="ancien_siege" class="form-control"> </td>
                                 <td style="width:9%"> <input type="text" name="nouveau_siege[]" id="nouveau_siege" class="form-control"> </td>
                                 <td style="width:9%"> <input type="text" name="reference[]" id="reference" class="form-control"> </td>
                                 <td style="width:9%"> <input class="btn btn-dark" type="button" name="add" id="add" type="add" value="Ajouter encore"> </td>
                             </tr>
                         </table>

                         <div>
                             <input class="btn btn-secondary" type="submit" name="save" id="save" value="Enregister">
                         </div>
                     </div>
                 </form>

                 <?php
                    /*if (isset($_POST['submit'])) {
                    $numero_contribuale = seoUrl($_POST['numero_contribuale']);
                    $nif = seoUrl($_POST['nif']);
                    $form_juridique = seoUrl(apostrophe($_POST['form_juridique']));
                    $raison_social = seoUrl(apostrophe($_POST['raison_social']));
                    $sigle = seoUrl(apostrophe($_POST['sigle']));
                    $siege = seoUrl(apostrophe($_POST['siege']));
                    $adresse = seoURL(apostrophe($_POST['adresse']));
                    $secteur = seoUrl(apostrophe($_POST['secteur']));
                    $etat_social = seoUrl(apostrophe($_POST['etat_social']));
                    $ancien_siege = seoUrl(apostrophe($_POST['ancien_siege']));
                    $nouveau_siege = seoUrl(apostrophe($_POST['nouveau_siege']));
                    $reference = seoUrl(apostrophe($_POST['reference']));
                    $output = "";
                    //$output = '<div class="text-primary">' . $adresse . '</div>';
                    $query = $connect->exec("INSERT INTO `repertoire` (`numero`, `nif`, `forme_juridique`, `raisons_social`, `sigle`, `siege_du_succurale`, `adresse`, `secteur_d_activite`, `etat_sociale`, `ANCIEN_SERVICE_GESTIONNAIRE`, `NOUVEAU_SERVICE_GESTIONNAIRE`, `REF_NOTE_DE_SERVICE`) 
                                        VALUES ('$numero_contribuale', '$nif', '$form_juridique', '$raison_social', '$sigle', '$siege', '$adresse', '$secteur', '$etat_social', '$ancien_siege', '$nouveau_siege', '$reference');") or die(print_r($connect->errorInfo()));

                    if ($query) {
                        echo $output = "Insertion Reussie";
                    }
                }*/
                    ?>
             </div>
         </div>
     </div>
     <script src="vendor/jquery.min.js"></script>
     <script>
         $(document).ready(function() {
             var html = '<tr> <td> <input type="text" name="numero_contribuale[]" id="numero_contribuale" class="form-control" required> </td> <td> <input type = "text"name = "nif[]" id="nif" class="form-control"> </td> <td> <input type="text" name ="form_juridique[]" id="form_juridique" class="form-control"> </td> <td> <input type="text" name="raison_social[]" id="raison_social" class="form-control"> </td> <td> <input type ="text" name="sigle[]" id="sigle" class ="form-control"> </td> <td> <input type="text" name="siege[]" id="siege" class="form-control"> </td>  <td> <textarea name = "adresse[]" id="adresse" cols="10" rows="5" placeholder = "Adresse du contribuable" class = "form-control"> </textarea> </td> <small id="adresse_addr" style="display:none" class="text-danger">Remplissez le bar (/) par le tiret (-) ou les espaces vides</small> <td> <input type = "text" name = "secteur[]" id = "secteur" class = "form-control"> </td>  <td> <input type = "text" name = "etat_social[]" id="etat_social" class = "form-control"> </td> <td> <input type="text" name="ancien_siege[]" id="ancien_siege" class="form-control"> </td> <td> <input type="text" name="nouveau_siege[]" id="nouveau_siege" class="form-control"> </td> <td> <input type="text" name="reference[]" id="reference" class ="form-control"> </td><td> <input class="btn btn-danger" type="button" name="remove" id="remove" value="Supprimer"> </td> </tr></br>';
             var x = 1;
             var max = 5;
             $("#add").click(function() {
                 //appending a value field
                 //$("#table-field").append(html);
                 if (x <= max) {
                     $("#table-field").append(html);
                     x++;
                 }
             });

             $("#table-field").on('click', '#remove', function() {
                 $(this).closest('tr').remove();
                 x--;
             });

             /*$("#adresse").on('keyup', function() {
                 var adresse = $("#adresse").val();
                 if (adresse.indexOf('/') != -1) {
                     $("#adresse_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 3000);
                 } else {
                     $("#adresse_addr").css("display", "none");
                 }
             });
             //alert("adresse");
             $("#form_juridique").on('keyup', function() {
                 var form_juridique = $("#form_juridique").val();
                 if (form_juridique.indexOf('/') != -1) {
                     $("#form_juridique_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 10000);
                 } else {
                     $("#form_juridique_addr").css("display", "none");
                 }
             });

             $("#raison_social").on('keyup', function() {
                 var raison_social = $("#raison_social").val();
                 if (raison_social.indexOf('/') != -1) {
                     $("#raison_social_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 10000);
                 } else {
                     $("#raison_social_addr").css("display", "none");
                 }
             });

             $("#sigle").on('keyup', function() {
                 var sigle = $("#sigle").val();
                 if (sigle.indexOf('/') != -1) {
                     $("#sigle_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 10000);
                 } else {
                     $("#sigle_addr").css("display", "none");
                 }
             });

             $("#siege").on('keyup', function() {
                 var siege = $("#siege").val();
                 if (siege.indexOf('/') != -1) {
                     $("#siege_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 10000);
                 } else {
                     $("#siege_addr").css("display", "none");
                 }
             });

             $("#secteur").on('keyup', function() {
                 var secteur = $("#secteur").val();
                 if (secteur.indexOf('/') != -1) {
                     $("#secteur_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 10000);
                 } else {
                     $("#secteur_addr").css("display", "none");
                 }
             });

             $("#etat_social").on('keyup', function() {
                 var etat_social = $("#etat_social").val();
                 if (etat_social.indexOf('/') != -1) {
                     $("#etat_social_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 10000);
                 } else {
                     $("#etat_social_addr").css("display", "none");
                 }
             });

             $("#ancien_siege").on('keyup', function() {
                 var ancien_siege = $("#ancien_siege").val();
                 if (ancien_siege.indexOf('/') != -1) {
                     $("#ancien_siege_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 10000);
                 } else {
                     $("#ancien_siege_addr").css("display", "none");
                 }
             });

             $("#nouveau_siege").on('keyup', function() {
                 var nouveau_siege = $("#nouveau_siege").val();
                 if (nouveau_siege.indexOf('/') != -1) {
                     $("#nouveau_siege_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 10000);
                 } else {
                     $("#nouveau_siege_addr").css("display", "none");
                 }
             });

             $("#reference").on('keyup', function() {
                 var reference = $("#reference").val();
                 if (reference.indexOf('/') != -1) {
                     $("#reference_addr").show();
                     var audio = new Audio("audio/fais_dodo.mp3");
                     audio.play();
                     setTimeout(function() {
                         audio.pause();
                         audio.currentTime = 0;
                     }, 10000);
                 } else {
                     $("#reference_addr").css("display", "none");
                 }
             });*/
         });
     </script>
 </body>

 </html>