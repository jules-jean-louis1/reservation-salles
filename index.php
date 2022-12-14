<?php 
session_start();
include './connect/connect_local.php';
include './php/inscription.php';
include './php/connexion.php';
$errors = [];
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./javascript/menu-nav.js" defer type="module"></script>
    <script src="./javascript/dialogue_inscri.js" defer></script>
    <script src="./javascript/dialog_connex.js" defer></script>
    <title>Acceuil</title>
</head>
<body>
<!----------------- Header----------------->
    <?php include './header-footer/header.php'?>
<!----------------- Header----------------->
    <main>
        <?php include './php/inscri-connex.php'; ?>
        <actricle class="main_s1">
            <section class="main_sec">
                    <div class="warpper_main">
                        <div class="container_main">
                            <div class="sub_container_main">
                                <h2>Réservation de salles</h2>
                                    <div class="warpper_link_pla">
                                        <a href="./php/planning.php" id="btn_main_1">Acceder au Planning</a>
                                        <a href="./php/reservation.php"  id="btn_main_1"> Faire une réservation</a>
                                    </div>
                            </div>
                        </div>
                    </div>
            </section>
        </actricle>   
    </main>
</body>
</html>