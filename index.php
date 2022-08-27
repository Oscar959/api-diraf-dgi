<?php
require_once("./api.php");
try {
    if (!empty($_GET['demande'])) {
        $url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));
        switch ($url[0]) {
            case "all":
                include("header.php");
                getAll();
                break;

            case "nbr":
                include("header.php");
                getSum();
                break;
                break;

            case "nif":
                if (!empty($url[1])) {
                    getNif($url[1]);
                } else {
                    include("header.php");
                    throw new Exception("<div class='text-danger text-center m-10'>Fournissez le nif pour acceder aux informations</div>");
                }
                break;
            case "nom":
                if (!empty($url[1])) {
                    getNom($url[1]);
                } else {
                    include("header.php");
                    throw new Exception("<div class='text-danger text-center m-10'>Fournissez le nom pour acceder aux informations</div>");
                }
                break;

            case "sigle":
                if (!empty($url[1])) {
                    getSigle($url[1]);
                } else {
                    include("header.php");
                    throw new Exception("<div class='text-danger text-center m-10'>Fournissez le sigle pour acceder aux informations</div>");
                }
                break;

            case "s_g":
                if (!empty($url[1])) {
                    getService_gestionnaire($url[1]);
                } else {
                    include("header.php");
                    throw new Exception("<div class='text-danger text-center m-10'>Fournissez le Service_gestionnaire pour acceder aux informations</div>");
                }
                break;
            case "activite":
                if (!empty($url[1])) {
                    getActivite($url[1]);
                } else {
                    include("header.php");
                    throw new Exception("<div class='text-danger text-center m-10'>Fournissez l'activité' pour acceder aux informations</div>");
                }
                break;

            default:
                include("header.php");
                throw new Exception("<div class='text-danger text-center m-10'>Arrange please your url, and retry again</div>");
        }
    } else {
        include("header.php");
        throw new Exception("<div class='text-danger text-center m-10'>We a have a problem when we try to get data, retry please</div>");
    }
} catch (Exception $e) {
    $error = [
        "messages" => $e->getMessage(),
        "code" => $e->getCode()
    ];

    print_r($error);
}
?>

