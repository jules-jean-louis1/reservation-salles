<?php
session_start();
include './connect/connect_local.php';


$errors = [];

if (isset($_POST['submit'])) {

    
    $login = $_POST['login'];
    $password = $_POST['password'];
    $id = $_SESSION['id'];
    $conn = mysqli_query($connect,"SELECT * FROM `utilisateurs`");
    $row = $conn->fetch_all();
    $uplogin = "UPDATE `utilisateurs` SET `login` = '$login' WHERE `utilisateurs`.`id` = '$id'";
    $uppassword = "UPDATE `utilisateurs` SET `password` = '$password' WHERE `utilisateurs`.`id` = '$id'";

    $user_check = "SELECT login FROM utilisateurs WHERE login = '$login'; ";
    $check = mysqli_query($connect, $user_check);

        if (mysqli_num_rows($check) > 0) {
                $errors['login2'] = "Ce Login existe déja";
            }elseif (!empty($_POST['login'])) {
                if (mysqli_query($connect, $uplogin)){
                    $_SESSION['login'] = $login;
                    $errors['up_login'] = 'Votre Login a bien était mise a jour';
                }
        }
        if (!empty($_POST['password'])) {
            if ($_POST['password'] === $_POST['password2']){
                mysqli_query($connect, $uppassword);
                $_SESSION['password'] = $password;
                $errors['up_password'] = 'Votre password a bien était mise a jour';
            }
        }
    }

if (isset($_POST['delete'])) {
    $id = $_SESSION['id'];
    $delete_ac = mysqli_query($connect,"DELETE FROM `utilisateurs` WHERE `utilisateurs`.`id` = '$id'");
    session_destroy();
    header('Location: index.php');
}
?>



<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <!----------------- Header----------------->
    <?php include './header-footer/header.php';?>
    <!----------------- Header----------------->
    <main>
        <section class="container_profil">
            <form action="" method="post">
                <label for="login"><?php echo "Login: " . $_SESSION['login']; ?></label>
                    <input type="text" name="login" id="" placeholder="login">
                <label for=""><?php echo "Password: " . $_SESSION['password']; ?></label>
                <input type="text" name="password" id="">
                <label for="">Confirmer le password</label>
                <input type="text" name="password2" id="" required>
                <input type="submit" value="Envoyer" name="submit">
            </form>
        </section>
    </main>
    <!----------------- FOOTER -------------->
    <?php include './header-footer/footer.php';?>
    <!----------------- FOOTER -------------->
</body>
</html>