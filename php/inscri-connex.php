<article class="inccri_connex">
            <section>
            <div class="wapper_inscri">
                <div class="container_inscri">
                    <div class="container_dialog">
                    <dialog class="modal" id="modal" >
                        <div class="header_dialog">
                            <h2>S'inscrire</h2>
                        </div>
                        <button class="button close-button" id="btn_close_dialog"><img src="../images/icon/cancel_FILL0_wght400_GRAD0_opsz48.svg" class="filter-green"/></button>
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
                        <button class="button close-button_2" id="btn_close_dialog"><img src="../images/icon/cancel_FILL0_wght400_GRAD0_opsz48.svg" class="filter-green"/></button>
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