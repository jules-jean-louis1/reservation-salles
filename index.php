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
        <article class="inccri_connex">
            <section>
            <div class="wapper_inscri">
                <div class="container_inscri">
                    <div class="container_dialog">
                    <dialog class="modal" id="modal" >
                        <div class="header_dialog">
                            <h2>S'inscrire</h2>
                        </div>
                        <button class="button close-button" id="btn_close_dialog"><img src="images/icon/cancel_FILL0_wght400_GRAD0_opsz48.svg" alt=""></button>
                            <form class="form" method="POST" name="sign-in">
                                <div class="form-control">
                                    <label>Login</label>
                                    <input type="text" placeholder="Login" name="login" id="login" required>
                                </div>
                                <div class="form-control">
                                    <label>Mot de passe</label>
                                    <input type="password" placeholder="Password" name="password" id="password" required>
                                </div>
                                <div class="form-control">
                                    <label>Confirmation du mot de passe</label>
                                    <input type="password" placeholder="Password" name="password_conf" id="password_conf" required>
                                </div>
                                <input type="submit" value="Envoyer" name="submit_sign-in" class="btn_submit_inscri" id="submit">
                            </form>
                    </dialog>
                </div>
            </div>
            </section>
            <section>
            <div class="wapper_inscri">
                <div class="container_inscri">
                    <div class="container_dialog">
                    <dialog class="modal_2" id="modal_2" >
                        <div class="header_dialog">
                            <h2>Se connecter</h2>
                        </div>
                        <button class="button close-button_2" id="btn_close_dialog"><img src="images/icon/cancel_FILL0_wght400_GRAD0_opsz48.svg" alt=""></button>
                            <form class="form" method="POST" name="connexion">
                                <div class="form-control">
                                    <label>Login</label>
                                    <input type="text" placeholder="Login" name="login" id="login" required>
                                </div>
                                <div class="form-control">
                                    <label>Mot de passe</label>
                                    <input type="password" placeholder="Password" name="password" id="password" required>
                                </div>
                                <input type="submit" value="Envoyer" name="submit_connex" class="btn_submit_inscri" id="submit">
                            </form>
                    </dialog>
                </div>
            </div>
            </section>
            <div class="error">
                <?php if ($errors != null) {
                        foreach($errors as $message):?>
                            <script>alert("<?php echo htmlspecialchars($message); ?>")</script>
                        <?php endforeach;
                    } else {
                    }?>
            </div>
        </article>
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