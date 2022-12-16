<?php

session_start();
include '../connect/connect_local.php';

$sql = "SELECT `titre`,`debut`,`fin`,`login` FROM `reservations` INNER JOIN utilisateurs WHERE utilisateurs.id = reservations.id_utilisateur;";
$rresult = mysqli_query($connect, $sql);
while ($lrow = mysqli_fetch_assoc($rresult)){ 
    $ret[] = $lrow; 
  }

for ($k=0; ; $k++) { 
    # code...
}
$date = $ret[0]['debut']; 
$my_date = date('d M Y', strtotime($date));
$my_date2 = date('H:i', strtotime($date));
/* echo $my_date;
echo $my_date2; */
echo $date;

for ($i=0; isset($ret[$i]) ; $i++) {
    $date = $ret[$i]['debut'];
    $my_date = date('d M Y ', strtotime($date));
}
?>
<?php
$errors = [];
$days = ['Lundi' , 'Mardi' , 'Mercredi', 'Jeudi', 'Vendredi','Samedi', 'Dimanche',];


$dt = new DateTime;
if (isset($_GET['year']) && isset($_GET['week'])) {
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    $dt->setISODate($dt->format('o'), $dt->format('W'));
}
$year = $dt->format('o');
$week = $dt->format('W');

$sql = "SELECT `titre`,`debut`,`fin`,`login` FROM `reservations` INNER JOIN utilisateurs WHERE utilisateurs.id = reservations.id_utilisateur;";
$rresult = mysqli_query($connect, $sql);
while ($lrow = mysqli_fetch_assoc($rresult)){ 
    $ret[] = $lrow; 
  }

for ($m=0; isset($ret[$m]) ; $m++) { 
    
}
/* var_dump($ret); */
?>




<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<!----------------- Header----------------->
<?php include '../header-footer/header.php'?>
<!----------------- Header----------------->
<main class="main_planning">
<?php include 'inscri-connex.php'; ?>
    <arcticle class="warpper_planning">
        <section class="container_planning">
            <div class="wel_flex_plan">
                <h2>Planning des réservations</h2>
            </div>
            <div class="planning">
                <div class="link_forward_past">
                    <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>" id="btn_prev_1"><< Semaine précédente</a> <!--Previous week-->
                    <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>" id="btn_prev_1">Semaine suivante >></a> <!--Next week-->
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Heure</th>
                            <?php
                            while ($week == $dt->format('W')) {
                                for ($i=0; isset($days[$i]) ; $i++) {
                                    $dt->modify('+1 day');
                                    $time = strtotime($dt->format('d M Y'));
                                    echo "<th>".$days[$i]."<br>". $dt->format('d M Y')."</th>";
                                }
                             }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            for ($i=8; $i <= 19 ; $i++) {
                                echo "<tr>";
                                for ($j=0; $j <= 5 ; $j++) {
                                    echo "<td>".$i.":00"."</td>";
                                    
                                    }
                                for ($j=5; $j <= 6 ; $j++) { 
                                    echo "<td>"."Indisponible"."</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="do_reserv_plan">
                <a href="reservation.php" id="btn_prev_2">Faire une réservation</a>
            </div>
        </section>
    </arcticle>
</main>
    
</body>
</html>
