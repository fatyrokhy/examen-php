<?php
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    if ($page=='ajoutClient') {
         ob_start();
         global $errors;
         $errors=[];
         global $produits;
         $produits = jsonToArray('articles');
         
        
         if (isset($_GET["search_produit"])) {
             rechercheProduit();
         } else {
             $_SESSION["article"]=null;
         }
 
         if (isset($_POST["btnAdd"])) {
            // dd($_SESSION["commandes"]);
             ajouterArticle();
         }
         if (isset($_POST["addClient"])) {
             ajoutClient($_POST["nom"],$_POST["tel"],$_POST["adresse"]);
         }
        require_once("./views/ajoutClient.php");
        $contenu= ob_get_clean();
        require_once("./views/layout/baselayout.php");
    } 
} else {
    ob_start();
    require_once("./views/ajoutClient.php");
    $contenu= ob_get_clean();
    require_once("./views/layout/baselayout.php");
}

function rechercheProduit()  {
    $produit=findArticleByNom($_GET["search_produit"]);
    if ($produit!=null) {
        $_SESSION["article"] = $produit;
    } else{
        $_SESSION["article"]=null;  
    }
}
function ajouterArticle()  {
    if (empty($_POST["nom"])||empty($_POST["telephone"] || empty($_POST["adresse"]))) {
        $errors['msge'] = "Veuillez ajouter un client d'abord";
        $_SESSION['commandes'] = [];
    } else {
        ajoutDettes($_POST["quantite"]);
        }
}