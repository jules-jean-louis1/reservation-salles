<?php 
session_start();
include './connect/connect_local.php';
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./javascript/menu-nav.js" defer type="module"></script>
    <script src="./javascript/dialogue_inscri.js" defer></script>
    <title>Acceuil</title>
</head>
<body>
<!----------------- Header----------------->
    <?php include './header-footer/header.php'?>
<!----------------- Header----------------->
    <main>
        <article>
            <section>
            <div class="container_dialog">
            <dialog class="modal" id="modal" >
                <div class="header_dialog">
                    <h2>S'inscrire</h2>
                </div>
                <button class="button close-button">close modal</button>
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
            </section>
        </article>
    </main>
</body>
</html>