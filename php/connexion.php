<?php

if (isset($_POST['submit_connex'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `utilisateurs`";
    $result = mysqli_query($connect, $sql);
    $row = $result->fetch_all();
    for ($i=0; isset($row[$i]) ; $i++) { 
        if ($login == $row[$i][1] and $password == $row[$i][2]) {
            $_SESSION['id'] = $row[$i][0];
            $_SESSION['login'] = $row[$i][1];
            $_SESSION['password'] = $row[$i][2];
            header('index.php');
        } else {
            $errors['faild_co'] = "Login / password erroné";
        }
    }
}

?>