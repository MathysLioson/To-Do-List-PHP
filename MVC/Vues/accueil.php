<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" media="screen" type="text/css" />
</head>

<body>

    <H1 id="titlePublic"> Page publique </H1>
    <div id="container">
        <button class="bouton" height="100px" onclick=window.location.href='index.php?action=connection'>Connexion</button>
        <button class="bouton" height="100px" onclick=window.location.href='index.php?action=inscription'>Inscription</button>
        <button class="bouton" height="100px" onclick=window.location.href='index.php?action=creerListe'>Ajouter liste</button>
    </div>

    <?php
    require_once '../ConnectBDD/ConnectBDD.php';
    require_once '../Modele/TacheGateway.php';
    require_once '../Modele/ListeTacheGateway.php';

    $con = new ConnectBDD();
    $Tgateway = new TacheGateway($con->getConnect());
    $LTgateway = new ListeTacheGateway($con->getConnect());
    $tabFindListeTache[] = $LTgateway->findAll();

    ?>
    <div class="text-center" id="divLists">


        <?php
        foreach ($tabFindListeTache

            as $tabL) {
            foreach ($tabL

                as $liste) {
                if ($liste->getPrivee() == false) {
                    $tabFindTache[] = $Tgateway->findByIdL($liste->getIdl());


        ?>
                    <div id="containerList">
                        <H2> <?php echo $liste->getNom(); ?></H2>
                        <input type="hidden" action="sppListe.php" method="POST" value=<?php $liste->getIdl() ?> name="idListe" />
                        <button type="button" class="btn" id="suppList" onclick=window.location.href='suppListe.php ? action=<?php $liste->getIdl() ?>'> X </button>

                        </form>


                        <div class="btn-group-vertical">
                            <?php

                            foreach ($tabFindTache as $tabT) {
                                foreach ($tabT as $tache) {


                                    if ($tache->getDateFin() < mktime(0, 0, 0, date("mm"), date("dd") + 1, date("YYYY"))) {
                            ?>
                                        <button type="button" class="btn btn-secondary" onclick=window.location.href='gestionTache' id="BLate">
                                        <?php
                                        echo $tache->getNom();
                                    } else {
                                        ?>
                                            <button type="button" class="btn btn-secondary" onclick=window.location.href='gestionTache' id="BOk">
                                    <?php
                                        echo $tache->getNom();
                                    }
                                }
                            }
                            $tabFindTache = array();
                                    ?>

                                            </button>

                                        <?php
                                    }


                                        ?>

                        </div>
                        <button type="button" class="btn btn-secondary" onclick=window.location.href='creerTache.php' id="addT"> +
                        </button>
                    </div>
            <?php

            }
        }

            ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<style>
    body {
        background: #90cbff;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    #container {
        margin-top: 5%;
        margin-left: 50px;
        margin-right: 50px;
        justify-content: center;
        text-align: center;
    }

    .bouton {
        background-color: #EEB241;
        color: white;
        padding: 14px 20px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        width: 15%;
    }


    #titlePublic {
        text-align: center;
    }


    #containerList {
        justify-content: center;
        text-align: center;
        background-color: lightgray;
        border-radius: 10px;
        width: 40%;
        margin: 20px;

    }

    .btn-group-vertical {
        width: 100%;
    }

    #BLate {
        color: lightsalmon;
    }

    #BOk {
        color: white;
    }

    #addT {
        background-color: antiquewhite;
        color: black;
        margin: 2px;
    }



    #suppList {
        margin: 5px;
        background-color: firebrick;


    }
</style>


</html>