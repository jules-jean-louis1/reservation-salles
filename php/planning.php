<?php

/* $info = cal_info(0);
var_dump($info);
echo $info['months'][2]; */
$jour = [
    1 => 'Lundi',
    2 => 'Mardi',
    3 => 'Mercredi',
    4 => 'Jeudi',
    5 => 'Vendredi',
    6 => 'Samedi',
    7 => 'Dimanche',
];

if (isset($_GET['years']) AND preg_match("#^[0-9]{4}$#",$_GET['years'])) {
    $annee = $_GET['years'];
} else {
    $annee = date('Y');
}
$NbrDeJour=[];
for($mois=1;$mois<=12;$mois++) {
    $NbrDeJour[$mois]=date("t",mktime(1,1,1,$mois,2,$annee));
    $PremierJourDuMois[$mois]=date("w",mktime(5,1,1,$mois,1,$annee));
}
?>
<table id="recap">
    <tr>
        <td style="background:#FF8888;width:15px;height:15px;"></td><td>Réservé</td>
    </tr>
    <tr>
        <td style="background:#88FF88;width:15px;height:15px;"></td><td>Disponible</td>
    </tr>
</table>
<?php
//$_SESSION[$NomDeSessionAdmin]=1;
if(isset($_SESSION['login'])){
    if(
    isset($_GET['jour']) AND preg_match("#^[0-9]{1,2}$#",$_GET['jour']) AND
    isset($_GET['mois']) AND preg_match("#^[0-9]{1,2}$#",$_GET['mois']) AND
    isset($_GET['choix']) AND preg_match("#^(0|1)$#",$_GET['choix'])) {
        if($_GET['choix']==1){
            if(mysqli_query($connect,"INSERT INTO calendrier SET date='".$annee."-".$_GET['mois']."-".$_GET['jour']."'")) {
                echo "Journée mise en \"réservé\" avec succès !";
            } else {
                echo "Une erreur s'est produite:<br />".mysqli_error($connect);
            }
        } else {
            if(mysqli_query($connect,"DELETE FROM calendrier WHERE date='".$annee."-".$_GET['mois']."-".$_GET['jour']."'")) {
                echo "Journée mise en \"disponible\" avec succès !";
            } else {
                echo "Une erreur s'est produite:<br />".mysqli_error($connect);
            }
        }
    }
}
?>


<section class="content_planning">
<?php
 //affiche le jour actuel
  $année= date('y');
  $mois= date('m');
  $jour= date('d') ;
  echo '<div class ="ajd" align="center">Aujourd\'hui, nous sommes le : '. $jour;
  echo '';
  echo '/'.$mois;
  echo '/'.$année;
?>


