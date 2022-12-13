<?php
session_start();
// affichage event "SELECT `titre`,`description`, `debut`, `fin`,`login` FROM `reservations` INNER JOIN `utilisateurs` WHERE reservations.id_utilisateur = utilisateurs.id; "
if (isset($_POST['submit_btn'])) {

    $titre = $_POST['titre'];
    $descro = $_POST['message'];
    $dated = $_POST['date_debut'];
    $datef = $_POST['date_fin'];
    $id = $_SESSION['id'];
    $sql = "INSERT INTO `reservations` ('titre', 'description','debut','fin','id_utilisateurs') VALUES ('$titre','$descro','$dated','$datef','$id');";
    $envoyer = mysqli_query($connect, $sql);
    

}


?>


<form action="" method="post">
    <div class="form_reserv">
        <label for="titre">Titre de l'event</label>
        <input type="text" name="titre" id="log">
        <label for="descro">Déscription de l'event</label>
        <textarea name="message" id="" cols="30" rows="10"></textarea>
        <label for="debut">Début de l'event</label>
        <input type="datetime-local" name="date_debut" id="" value="" min="2022-12-13T08:00" max="2023-12-13T18:00">
        <span class="validity"></span>
        <Label for="fin">Fin de l'event</Label>
        <input type="datetime-local" name="date_fin" id="" min="2022-12-13T08:00" max="2023-12-13T18:00">
        <span class="validity"></span>
        <input type="submit" value="Réserver !" name="submit_btn">
    </div>
    <div class="btn_container">
    </div>
</form>