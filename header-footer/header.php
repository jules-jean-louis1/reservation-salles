<header>
    <div class="navbar">
        <div class="navbar-warper">
            <div class="navbar-container">
                <nav id='menu-header'>
                <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
                <ul>
                    <li><a href='index.php'>Home</a></li>
                    <li><a href='http://'>Planning</a></li>
                    <li><a href='http://'>Réservation</a></li>
                </ul>
                </nav>
                <div class="login-header">
                    <ul class="flex-liste">
                        <li> 
                            <?php if (isset($_SESSION['id']) != null) { ?>
                            <a href="./php/deconnexion.php" id="btn_deconnex_h">Deconnexion</a>
                            <?php } else {  ?>
                                <button class="button open-button_2"id="btn_connex_h">Connexion</button>
                            <?php } ?>
                        </li>
                        <li> 
                            <?php if (isset($_SESSION['id']) != null) { ?>
                            <a href="./php/profil.php" id="li_a_logo">
                                <img src="./images/icon/person.svg" alt="">
                                <?php echo htmlspecialchars($_SESSION['login']); ?></a>
                            <?php } else { ?>
                                <button class="button open-button"id="btn_inscri_h" style="color: #FFF;">Crée un compte</button>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>