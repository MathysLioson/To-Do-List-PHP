<?php
require_once '../ConnectBDD/ConnectBDD.php';
require_once "../Modele/ListeTache.php";
require_once '../Modele/ListeTacheGateway.php';


if (isset($_POST['nom'])) {


    $isconnect = 0;
    $isconnect = htmlspecialchars(($_POST['user']));

    $con = new ConnectBDD();
    $connect = $con->getConnect();
    $LTgateway = new ListeTacheGateway($connect);
    $nom = htmlspecialchars(($_POST['nom']));

    //Pour connaitre l'id max
    $query = "SELECT MAX(IdL) from listetache";
    $connect->executeQuery($query, array());
    $results = $connect->getResults();
    foreach ($results as $row) {
        $Nbrow = ($row["MAX(IdL)"]);
    }
    //Pour savoir si une liste avec le même nom existe
    $check = $connect->prepare('SELECT Nom from listetache WHERE Nom = ?');
    $check->execute(array($nom));
    $row = $check->rowCount();

    // si il n'y a aucune liste alors on créer l'id 0
    if ($Nbrow == NULL) {
        $id = 0;
    } else {
        $id = $Nbrow + 1; // Créer une id pour la tâche que l'on créer
    }



    if ($isconnect == 1) {
        if ($row == 0) {

            if (strlen($nom) <= 100) {
                $NewListe = new ListeTache($id, $nom, 0, NULL);
                $LTgateway->insertListe($NewListe);
                header('Location:../Vues/accueilco.php');
            } else {
                header('Location:../Vues/creerListe.php?reg_err=nom&action=user');
            }
        } else {
            header('Location:../Vues/creerListe.php?reg_err=already&action=user');
        }
    } else {
        if ($row == 0) {

            if (strlen($nom) <= 100) {
                $NewListe = new ListeTache($id, $nom, 0, NULL);
                $LTgateway->insertListe($NewListe);
                header('Location:../index.php');
            } else header('Location:../Vues/creerListe.php?reg_err=nom');
        } else header('Location:../Vues/creerListe.php?reg_err=already');
    }
}
