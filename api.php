<?php
define("URL",str_replace("index.php", "",(isset($_SERVER['HTTPS'])? "https" : "http").
"://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"]));

function  getActivite($activity){
    $pdo = getConnexion();
    $req = "SELECT `nif`, `nom`, `sigle`, `adresse`, `activity`, `service_gest`, `form_juridique` ,`etat_societé` 
            from diraf
            WHERE activity LIKE :activity";
    $stmt = $pdo->prepare($req);
    $stmt ->bindValue(":activity", "%$activity%", PDO::PARAM_STR);
    $stmt->execute();
    $diraf = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();
    sendJSON($diraf);

   
}

function  getService_gestionnaire($service_gestionnaire){
    $pdo = getConnexion();
    $req = "SELECT `nif`, `nom`, `sigle`, `adresse`, `activity`, `service_gest`, `form_juridique` ,`etat_societé` 
            from diraf
            WHERE service_gest= :service_gestionnaire";
    $stmt = $pdo->prepare($req);
    $stmt ->bindValue(":service_gestionnaire", $service_gestionnaire, PDO::PARAM_STR);
    $stmt->execute();
    $diraf = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();
    sendJSON($diraf);

   
}

function getSigle($sigle){
    $pdo = getConnexion();
    $req = "SELECT `numero`, `nif`, `forme_juridique`, `raisons_social`, `sigle`, `siege_du_succurale`, `adresse`, 
                    `secteur_d_activite`, `etat_sociale`, `ancien_service_gestionnaire`, `nouveau_service_gestionnaire`, `ref_note_de_service`
            from diraf      
            WHERE sigle= :sigle";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":sigle", $sigle, PDO::PARAM_STR);
    $stmt->execute();
    $diraf = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt->closeCursor();
    sendJSON($diraf);
}

function getNom($nom){
    $pdo = getConnexion();
    $req = "SELECT `numero`, `nif`, `forme_juridique`, `raisons_social`, `sigle`, `siege_du_succurale`, `adresse`, 
                    `secteur_d_activite`, `etat_sociale`, `ancien_service_gestionnaire`, `nouveau_service_gestionnaire`, `ref_note_de_service`
            from diraf      
            WHERE nom LIKE :nom";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":nom", "%$nom%", PDO::PARAM_STR);
    $stmt->execute();
    $diraf = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt->closeCursor();
    sendJSON($diraf);
}
// THIS FUNCTION ALLOWS THE REQUEST TO GET ALL THE RECORDS CONCERNING THE NIF OF THE DB AND DISPLAY IT IN THE API

function getNif($nif){
    $pdo = getConnexion();
    $req = "SELECT `numero`, `nif`, `forme_juridique`, `raisons_social`, `sigle`, `siege_du_succurale`, `adresse`, 
                    `secteur_d_activite`, `etat_sociale`, `ancien_service_gestionnaire`, `nouveau_service_gestionnaire`, `ref_note_de_service`
            from diraf        
            WHERE nif LIKE :nif";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":nif", "%$nif%", PDO::PARAM_STR);
    $stmt->execute();
    $diraf= $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt->closeCursor();
    sendJSON($diraf);
}
// THIS FUNCTION ALLOWS THE REQUEST TO GET ALL THE RECORDS OF THE DB AND DISPLAY IT IN THE API
function getAll(){
    $pdo = getConnexion();
    $req = "SELECT *
            from diraf";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $diraf= $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($diraf);
}
// THIS FUNCTION ALLOWS THE REQUEST TO COUNT ALL THE RECORDS OF THE DB AND DISPLAY IT IN THE API
function getSum(){
    $pdo = getConnexion();
    $req = "SELECT COUNT(`numero`) as nombres_total_des_contribuables from diraf";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $diraf= $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($diraf);
}


function getConnexion(){
    return new PDO("mysql:host=localhost; dbname=diraf_db; charset=utf8", "root", "");
}

function sendJSON($infos){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($infos,JSON_UNESCAPED_UNICODE);
}

//{*Uu7*cYw5HeA>qj dbpassword