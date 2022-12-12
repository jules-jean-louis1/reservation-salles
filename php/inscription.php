<?php
$errors = [];

if (isset($_POST['submit_sign-in'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_conf = $_POST['password_conf'];
    $sql = "INSERT INTO (`login`,`password`) VALUES ('$login','$password');";
    $checkLogin = "SELECT login FROM utilisateurs WHERE login = '$login'; ";
    $rs = mysqli_query($connect,$checkLogin);
    if (mysqli_num_rows($rs) > 0) {
        $errors['login'] = "login déjà pris.";
    } elseif ($password === $password_conf) {
        mysqli_query($connect,$sql);
        $errors['succes'] = "Votre compte a etait crée.";
    } else {
        $errors['fail'] = "Les password ne corresponde pas.";
    }
}


?>