<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styleCo.css" media="screen" type="text/css" />
</head>

<body>
    <div id="container">

        <form action="inscription_verif.php" method="POST">
            <h1>Inscription</h1>

            <label><b>Adresse mail</b></label>
            <input type="mail" placeholder="Entrer l'adresse mail" name="mail" required>

            <label><b>Nom</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="nom" required>

            <label><b>Prénom</b></label>
            <input type="text" placeholder="Entrer le prénom d'utilisateur" name="prenom" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>
            <label><b>Retapper mot de passe</b></label>
            <input type="password" placeholder="Retapper le mot de passe" name="password_retype" required>
            <input type="submit" id='submit' value='Register'>
        </form>
    </div>
</body>
<?php
require_once "../Modele/Utilisateur.php";
require_once "../Modele/UtilisateurGateway.php";

$mail = isset($_POST['mail']) ? $_POST['mail'] : "";
$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$pwd = isset($_POST['password']) ? $_POST['password'] : "";

$utilisateur = new Utilisateur($mail, $nom, $prenom, $pwd);
$Ugateway = new UtilisateurGateway("mysql:host=localhost;dbname=dbroot", "root", "");
$Ugateway->insertUtilisateur($utilisateur);

print("Mail : $mail <br>Nom : $nom <br>Prénom : $prenom<br>password : $pwd");
?>

</html>