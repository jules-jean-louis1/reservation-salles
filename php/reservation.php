<?php

if (isset($_POST['submit'])) {
    echo $_POST['titre'];
    echo $_POST['date_debut'];
    echo $_POST['date_fin'];
}

?>


<form action="" method="get">
    <div class="form_reserv">
        <label for="titre">Titre de l'event</label>
        <input type="text" name="titre" id="log" required>
        <label for="debut">Début de l'event</label>
        <input type="datetime-local" name="date_debut" id="" value="" min="2022-12-13T08:00" max="2023-12-13T18:00" required>
        <span class="validity"></span>
        <Label for="fin">Fin de l'event</Label>
        <input type="datetime-local" name="date_fin" id="" min="2022-12-13T08:00" max="2023-12-13T18:00" required>
        <span class="validity"></span>
    </div>
    <div class="btn_container">
        <input type="submit" value="Réserver !" name="submit">
    </div>
</form>