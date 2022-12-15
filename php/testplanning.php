<?php

require('date.php');
$date = new Date();
$year = date('Y');
$date2 = $date->getAll($year);


?>


<main>
    <article>
        <section>
            <div class="années"><?php echo $year; ?></div>
            <div class="months">
                <ul>
                    <?php foreach ($date->months as $m) : ?>
                        <li><?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></li>
                   <?php endforeach; ?>
                </ul>
            </div>
            <?php $date2 = current($date2); ?>
            <?php foreach ($date2 as $m=>$days) :?>
                <div class="month" id="month<?php echo $m;?>">
                    <table>
                        <thead>
                            <tr>
                                <?php foreach ($date->days as $d) :?>
                                    <th><?php echo substr($d,0,3);?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($days as $d=>$w): ?>
                                    <?php if ($d == 1) :?>
                                        <td colspan="<?php echo $w-1;?>"></td>
                                    <?php endif; ?>
                                    <td><?php echo $d; ?></td>
                                    <?php if ($w == 7):?>
                                        <tr></tr>
                                    <?php endif; ?>
                                <?php endforeach ; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php endforeach; ?>
        </section>
    </article>
</main>

<?php
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
 if (isset($_POST['reserver'])) {
    $titre = $_POST['titre'];
    $descro = $_POST['description'];
    $date = $_POST['date'];
    $heureD = $_POST['heureD'];
    $heureF = $_POST['heureF'];
    $strHD = strtotime($_POST['heureF']);
    $strHF = strtotime($_POST['heureF']);
    $id = $_SESSION['id'];
    $sql = "INSERT INTO `reservations` (`titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES ('$titre','$descro','$date'.'$heureD','$date'.'$heureF','$id')";
    $checkHeureD = "SELECT * FROM `reservations` WHERE `debut` = '$date'.'$heureD'"; 
    if ($heureD <= $heureF) {
        if ($strHF - $strHD = 3600) {
            mysqli_query($connect, $sql);
            $errors['succes'] = "Votre résevation est confirmé pour le " . $date . "de " . $heureD . "à" . $heureF;
        } else {
            $errors['fail1'] = "La salle ne peut pas être réserver pour plus d'un heure";
        }
    } else {
        $errors['fail'] = "Votre réservation n'a pas était effectué.";
    }
    
}
?>