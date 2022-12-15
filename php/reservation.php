<?php
session_start();
include '../connect/connect_local.php';
// affichage event "SELECT `titre`,`description`, `debut`, `fin`,`login` FROM `reservations` INNER JOIN `utilisateurs` WHERE reservations.id_utilisateur = utilisateurs.id; "

$validation = false;
$errors = [];    

if (isset($_POST['reserver'])) {
    $titre = $_POST['titre'];
    $descro = $_POST['description'];
    $date = $_POST['date'];
    $heureD = $_POST['heureD'];
    $heureF = $_POST['heureF'];
    $strHD = strtotime($_POST['heureF']);
    $strHF = strtotime($_POST['heureF']);
    $id = $_SESSION['id'];
    $sql = "INSERT INTO `reservations` (`titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES ('$titre','$descro','$date''.$heureD','$date''.$heureF','$id')";
    $checkHeureD = "SELECT * FROM `reservations` WHERE `debut` = '$date'.'$heureD'"; 
    if ($heureD <= $heureF) {
        if ($strHF - $strHD = 3600) {
            mysqli_query($connect, $sql);
            $errors['succes'] = "Votre résevation est confirmé pour le " . $date . " de " . $heureD . " à " . $heureF;
        } else {
            $errors['fail1'] = "La salle ne peut pas être réserver pour plus d'un heure";
        }
    } else {
        $errors['fail'] = "Votre réservation n'a pas était effectué.";
    }
    
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Réservation</title>
</head>
<body>
<!----------------- Header----------------->
<?php include '../header-footer/header.php'?>
<!----------------- Header----------------->
<!-- ajoute champs select pour les heure -->
<main>
    <article class="reserv_warpper">
        <section class="reserv_container">
            <div class="reserv_form">
                <form action="" method="post">
                    <div class="form_reserv">
                        <label for="titre">Titre de l'événement</label>
                        <input type="text" name="titre" id="log">
                        <label for="descro">Déscription de l'événement</label>
                        <textarea name="description" id="" cols="30" rows="10"></textarea>
                        <label for="debut">Date de l'événement</label>
                        <input type="date" name="date" id="" value="" min="2022-12-13T08:00">
                        <span class="validity"></span>
                        <label for="heure">Heure de début</label>
                        <select name="heureD" id="">
                            <option value="8:00">8:00</option>
                            <option value="9:00">9:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="19:00">18:00</option>
                            <option value="19:00">19:00</option>
                        </select>
                        <label for="heure">Heure de fin</label>
                        <select name="heureF" id="">
                            <option value="8:00">8:00</option>
                            <option value="9:00">9:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="19:00">18:00</option>
                            <option value="19:00">19:00</option>
                        </select>
                        <input type="submit" value="Réserver !" name="reserver">
                    </div>
                    <div class="btn_container">
                        <?php foreach($errors as $message):?>
                                <?php echo htmlspecialchars($message); ?>
                            <?php endforeach; ?>
                    </div>
                </form>
            </div>
        </section>
    </article>
</main>

</body>
</html>