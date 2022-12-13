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
$login = $_SESSION['login'];  
        

if(!empty($_POST)){
    extract($_POST);
    $validation=true;
  }

if(isset($_POST['reserver'])){

    $titre=$_POST['titre'];
    $description=$_POST['description'];
    $type=$_POST['type'];

    //Pour transformer le mode d'input - format de date vers celui de sqli afin de permettre plus tard la comparaison entre les deux
        $debut=$_POST['debutdate'];
        $time = strtotime($debut);
    $newformatDebut = date("Y-m-d H:i:s",$time);
    // Pour empêcher de s'inscrire le samedi et le dimanche 
    $jourDebut = date('D',$time);
    //pour empêcher de s'inscrire plus d'un jour
    $jDebut = date('d',$time);
    // pour vérifier l'heure par la suite - ne pas dépasser les 1h
    $heureDebut = date("H:i:s",$time);


        $fin=$_POST['findate'];
        $time1 = strtotime($fin);
    $newformatFin = date("Y-m-d H:00",$time1);
    $jourFin = date('D',$time1);
    $jFin = date('d',$time1);
    $heureFin = date("H:00",$time1);

    $uneHeure = date("1:00:00");
 

    // on va d'abord vérifier les erreurs possibles : champs vides, créneaux déjà réservés, plus d'une heure, plus d'un jour, jour de fin antérieur au jour de fin == validation false
    // si pas d'erreur alors tu me prends l'id de la session ET tu me rentres sa réservation


    if(empty($titre)){
        $validation = false;
        $titreVide = "Veuillez rentrer un titre.";
        echo $titreVide;     
    }
    if(empty($description)){
        $validation = false;
        $descriptionVide = "Veuillez rentrer une description.";
        echo $descriptionVide;     
    }

    // //pour récupérer les dates afin de vérifier s'il y a disponibilité
    $dateVerif=mysqli_query($connect, "SELECT `debut`, `fin` FROM `reservations`");
    $dateFetch=mysqli_fetch_all($dateVerif, MYSQLI_ASSOC);

    foreach($dateFetch as $date){

        if($date['debut']==$newformatDebut && $date['fin']==$newformatFin){
               $validation = false;
               $verifErr = "Le créneaux est indisponible, veuillez-vous référer au planning et choisir un autre créneaux.";
               echo $verifErr;      
        }
    }
        if($newformatFin < $newformatDebut){
            $validation = false;
            $timeErr = "La date de fin est antérieure à la date de début, on ne peut remonter dans le temps !";
            echo $timeErr;
        }elseif (($jourDebut == "Sat" || $jourDebut == "Sun") || ($jourFin == "Sat" || $jourFin == "Sun")){
            $validation=false;
            $weekendErr = "Vous ne pouvez réserver la salle le week-end.";
            echo $weekendErr;
        }elseif($jFin-$jDebut>=1){
            $validation=false;
            $jourErr = "Vous ne pouvez réserver la salle que pour une heure le même jour.";
            echo $jourErr;
        }

        if(@$heureFin - @$heureDebut > @$uneHeure){
            $validation = false;
            $heureErr = "Vous ne pouvez réserver la salle plus d'une heure.";
            echo $heureErr;
        }

    if ($validation){
        $requestId = mysqli_query($connect, "SELECT `id` FROM `utilisateurs` WHERE `login`='".$login."'");
        $recupId = mysqli_fetch_assoc($requestId);
        foreach ($recupId as $id){
            $queryInsert=mysqli_query($connect, "INSERT INTO `reservations`(`titre`, `description`, `debut`, `fin`, `id_utilisateur`, `type_activité`) VALUES ('$titre','$description','$debut','$fin', '$id' ,'$type')");
        }  
    }
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