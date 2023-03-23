<?php 
// fonction debugage : (permet de faire un print_r "amélioré")

function debug($arg){
    echo "<div style='background:#fda500;z-index:1000;padding:20px'>";

    $trace = debug_backtrace();
    // debug_backtrace() : fonction interne de php qui retourne un array avec des infos de l'endroit où l'on fait appel à la fonction 
    echo "<p>Debug demandé dans le fichier : ". $trace[0]['file']. " à la ligne : ". $trace[0]['line']."</p>";

        echo "<pre>";
            print_r($arg);
        echo "</pre>";
    echo "</div>";
}

// ---------------------------------
// Fonction pour executer la requete : 

function execute_requete($req){
    global $pdo;
    $pdostatement = $pdo->query($req);
    return $pdostatement;
}

// ---------------------------------
// fonction userConnect() : si internaute connecté on renvoie TRUE sinon FALSE
function userConnect(){

    if (!isset($_SESSION['membre'])) {// Si la session/membre N'EXISTE PAS cela signifie que l'on est pas connecté et donc renvoie false
        return false;
    }
    else {// Sinon, session/membre existe sa veut dire qu'on est connecté, renvoie true
        return true;
    }

}

// ---------------------------------
// fonction adminConnect() : si l'admin est connecté on renvoie TRUE sinon FALSE
function adminConnect(){
    if (userConnect()&& $_SESSION['membre']['statut']==1) {
        return true;
    }
    else {
        return false;
    }
}

// ---------------------------------
// Fonction pour créer un panier : 
function creation_panier(){
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = array();
            $_SESSION['panier']['titre']=array();
            $_SESSION['panier']['id_produit']=array();
            $_SESSION['panier']['quantite']=array();
            $_SESSION['panier']['prix']=array();
    }
}

// ---------------------------------
// Fonction d'ajout au panier : 
function ajout_panier($titre, $id_produit, $quantite, $prix){
    creation_panier();// appel de la fonction déclaré au dessus

    $index = array_search($id_produit, $_SESSION['panier']['id_produit']);
    // array_search(arg1,arg2) : fonction interne permettant de chercher dans un tableau
        // arg1 : ce que l'on cherche
        // arg2 : dans quel tableau on cherche
    // La aleur de retour de la fonction renverra "l'indice" (correspondant à l'indice du tableau SI il y a un resultat correspondant) SINON false
        debug($index);

    if($index !== false){// SI $index est strictement different de 'false', c'est que le produit est déjà présent dans le panier car la fonction array_search() aura trouvé un indice correspondant et donc on va ajouter la quantite nouvelle récupéré lors de l'ajout
        $_SESSION['panier']['quantite'][$index] += $quantite;
    }
    else {// SINON pas de correspondance avec array_search() donc ajout normal
        $_SESSION['panier']['titre'][]= $titre;
        $_SESSION['panier']['id_produit'][]= $id_produit;
        $_SESSION['panier']['quantite'][]= $quantite;
        $_SESSION['panier']['prix'][]= $prix;
    }

    // ATTENTION de bien penser aux crochets vides qui permettent d'ajouter une valeur supplémentaire à un tableau

}

// ---------------------------------
// fonction montant_total du panier : 
function montant_total(){
    $total = 0;
    for ($i=0; $i < sizeof($_SESSION['panier']['id_produit']); $i++) { 
        $total += ($_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i]);
        // A chaque tour de boucle ( = nombre de produit dans le panier ) on ajoute le montant total (quantité*prix) dans la variable $total
    }
    return $total;
}
// ---------------------------------




