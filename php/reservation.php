<?php
session_start();
// affichage event "SELECT `titre`,`description`, `debut`, `fin`,`login` FROM `reservations` INNER JOIN `utilisateurs` WHERE reservations.id_utilisateur = utilisateurs.id; "

$validation = false;
$login = isset($_SESSION['login']);
$errors = [];      

if(!empty($_POST)){
    extract($_POST);
    $validation = true;
  }

if(isset($_POST['reserver'])){

    $titre = $_POST['titre'];
    $description = $_POST['description'];

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
        $errors['titre']= "Veuillez rentrer un titre.";     
    }
    if(empty($description)){
        $validation = false;
        $errors['decro'] = "Veuillez rentrer une description.";    
    }

    // //pour récupérer les dates afin de vérifier s'il y a disponibilité
    $dateVerif=mysqli_query($connect, "SELECT `debut`, `fin` FROM `reservations`");
    $dateFetch=mysqli_fetch_all($dateVerif, MYSQLI_ASSOC);

    foreach($dateFetch as $date){

        if($date['debut']==$newformatDebut && $date['fin']==$newformatFin){
               $validation = false;
               $errors['verifdate1'] = "Le créneaux est indisponible, veuillez-vous référer au planning et choisir un autre créneaux.";     
        }
    }
        if($newformatFin < $newformatDebut){
            $validation = false;
            $errors['time']= "La date de fin est antérieure à la date de début, on ne peut remonter dans le temps !";
        }elseif (($jourDebut == "Sat" || $jourDebut == "Sun") || ($jourFin == "Sat" || $jourFin == "Sun")){
            $validation=false;
            $errors['date2'] = "Vous ne pouvez réserver la salle le week-end.";
        }elseif($jFin-$jDebut>=1){
            $validation=false;
            $errors['jours']= "Vous ne pouvez réserver la salle que pour une heure le même jour.";
        }

        if(@$heureFin - @$heureDebut > @$uneHeure){
            $validation = false;
            $errors['heure'] = "Vous ne pouvez réserver la salle plus d'une heure.";
        }

    if ($validation){
        $requestId = mysqli_query($connect, "SELECT `id` FROM `utilisateurs` WHERE `login`='$login'");
        $recupId = mysqli_fetch_assoc($requestId);
        foreach ($recupId as $id){
            $queryInsert=mysqli_query($connect, "INSERT INTO `reservations`(`titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES ('$titre','$description','$debut','$fin', '$id')");
        }  
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
                        <label for="titre">Titre de l'event</label>
                        <input type="text" name="titre" id="log">
                        <label for="descro">Déscription de l'event</label>
                        <textarea name="description" id="" cols="30" rows="10"></textarea>
                        <label for="debut">Début de l'event</label>
                        <input type="datetime-local" name="debutdate" id="" value="" min="2022-12-13T08:00" max="2023-12-13T18:00">
                        <span class="validity"></span>
                        <Label for="fin">Fin de l'event</Label>
                        <input type="datetime-local" name="findate" id="" min="2022-12-13T08:00" max="2023-12-13T18:00">
                        <span class="validity"></span>
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