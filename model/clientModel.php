<?php
function jsonToArray($key = null)
{
    $json = file_get_contents('tab.json');
    $tab = json_decode($json, true) ?? [];
    if ($key!==null && isset($tab[$key])) {
        return $tab[$key];
    }
    return $tab; 
}

function arrayToJson(array $tab, string $key)
{
    $recup = jsonToArray();
    $recup[$key][] = $tab;
    $json = json_encode($recup);
    if ($json === false) {
        throw new Exception('Erreur lors de l\'encodage JSON : ' . json_last_error_msg());
    }
    file_put_contents('tab.json', $json);
}

function unique($name)
{
    if (!empty(trim($_POST[$name])) && is_numeric($_POST[$name])) {
        if (is_numeric($_POST[$name])) {
            $errors[$name] = ucfirst($name) . " doit etre numerique";
        }
    }
}

function estNumeric($name, &$errors)
{
    if (!empty(trim($_POST[$name]))) {
        if (!is_numeric($_POST[$name])) {
            $errors[$name] = ucfirst($name) . " doit etre numerique";
        }
    }
}

function estPositif($name, &$errors)
{
    if (!empty(trim($_POST[$name])) && is_numeric($_POST[$name])) {
        if ($_POST[$name] <= 0) {
            $errors[$name] = ucfirst($name) . " doit etre positif";
        }
    }
}

function taille($name, &$errors)
{
    if (!empty(trim($_POST[$name])) && is_numeric($_POST[$name])) {
        if (strlen($_POST[$name])!= 4) {
            $errors[$name] = ucfirst($name) . " devrait contenir exactement 3 chiffres";
        }
    }
}

function findClientById()
{
    $cli = [];
    $clients = jsonToArray('clients');
    if (isset($_GET['client'])) {
        foreach ($clients as  $value) {
            if ($value["id"] == $_GET['client']) {
                $cli = $value;
                break;
            }
        }
    }
    return $cli;
}
function findArticleByNom($nom)
{
    $prod =null;
    $produits = jsonToArray('articles');
    foreach ($produits as $value) {
        if ($value['libelle'] == $nom) {
            $prod = $value;
            break;
        }
    }
    return $prod;
}

// function montantTotalCommande($produits, $details)
// {
//     $total = 0;
//     foreach ($details as $detail) {
//         foreach ($produits as $produit) {
//             if ($produit["id"] == $detail["id_produit"]) {
//                 $total += $produit["prix"] * $detail["quantite"];
//             }
//         }
//     }
//     return $total;
// }
function totalAmount()
{
    global $total;
    if (!isset($total)) {
        $total = 0;
    }
    $total = 0;
    if (isset($_SESSION['commandes'])) {
        foreach ($_SESSION['commandes'] as $pro) {
            $total += $pro["quantite"] * $pro["prix"];
        }  
      }
    return $total;
}

function ajoutDettes($quantite) {

    if (!empty($quantite)) {

        foreach ($_SESSION['commandes'] as &$cmd) {
            if ($cmd["article"] ==  $_SESSION["article"]["libelle"]) {
                $cmd["quantite"] += $quantite; 
                return;
            }
        }
        
        $_SESSION['commandes'][] = [
            "libelle" => $_SESSION["article"]["libelle"],
            "prix" =>$_SESSION["article"]["prix"],
            "quantite" => $quantite
        ];
    }
}
function ajoutClient($nom,$tel,$adresse) {
    $clients=jsonToArray("clients");
    $nouvelle_client = [
        "id" => count($clients) + 1,
        "nom" =>$nom,
        "tel" => $tel,
        "adresse" => $adresse,
    ];

    arrayToJson($nouvelle_client,$clients);
};

function isEmpty($name, &$errors)
{
    if (empty(trim($_POST[$name]))) {
        $errors[$name] = ucfirst($name) . " obligatoire*";
    }
}
function estPositive($name, &$errors)
{
    if ($_POST[$name]<=0) {
        $errors[$name] = "nombre invalide";
    }
}
function dd($val)
{
    echo "<pre>";
    var_dump($val);
    echo "</pre>";
    die();
}
