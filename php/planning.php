<?php
session_start();
include '../connect/connect_local.php';
$errors = [];
$sql = "SELECT `titre`,`debut`,`fin`,`login` FROM `reservations` INNER JOIN utilisateurs WHERE utilisateurs.id = reservations.id_utilisateur;";
$rresult = mysqli_query($connect, $sql);
$row = $rresult->fetch_all();




$jour = ['Lundi' , 'Mardi' , 'Mercredi', 'Jeudi', 'Vendredi','Samedi', 'Dimanche',];
$year = (isset($_GET['year'])) ? $_GET['year'] : date("Y");
$week = (isset($_GET['week'])) ? $_GET['week'] : date('W');
if($week > 52) {
    $year++;
    $week = 1;
} elseif($week < 1) {
    $year--;
    $week = 52;
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/logo/index.png">
    <title>Planning</title>
</head>
<body>
    <!----------------- Header----------------->
<?php include '../header-footer/header.php'?>
<!----------------- Header----------------->
<!----------------- Modal----------------->
<?php include 'inscri-connex.php'; ?>
        <!----------------- Modal----------------->
    <main class="main_planning">
        <article class="warpper_planning">
            <section class="container_planning">
                <div class="wel_flex_plan">
                    <h2>Planning des réservations</h2>
                </div>
                <div class="planning">
                    <div class="link_forward_past"> 
                        <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 1 ? 52 : $week -1).'&year='.($week == 1 ? $year - 1 : $year); ?>" id="btn_prev_1"><< Semaine précédente</a>
                         
                        <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 52 ? 1 : 1 + $week).'&year='.($week == 52 ? 1 + $year : $year); ?>" id="btn_prev_1">Semaine suivante >></a> 
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Horaire</th>
                                    <?php
                                    /* if($week < 10) {
                                        $week = '0'. $week;
                                    } */
                                    $hour = 8;
                                    $day = 1;
                                    $jours = 0;
                                    
                                    


                                        while ($day <= 7) {
                                            for ($i = 0; isset($jour[$i]); $i++) {
                                                $d = strtotime($year . "W" . $week . $day);
                                                echo "<th>" . $jour[$i] . "<br>" . date('d M Y', $d) . "</th>";
                                                $r[] = date('d M Y', $d);
                                                $day++;
                                            }
                                        }
                                        $t = strtotime($year . "W" . $week . $day);
                                        $r[] = date('d M Y', $t);
                                        $five_days = array_slice($r, 0, 5, true);
                                        ?>
                             </tr>
                        </thead>
                                    <tbody>
                                        <?php
                                        
                                        for ($b = 0; isset($row[$b]); $b++) {
                                            
                                            $event = date('d M Y H:i', strtotime($row[$b][1]));
                                            
                                            
                                            while ($hour <= 19) {
                                                echo "<tr>";
                                                for ($j = 0; $j <= 0; $j++) {
                                                    $time1 = $hour . ":00";
                                                    echo "<td>" . $time1 . "</td>";
                                                }
                                                for ($k = 0; isset($five_days[$k]); $k++) {
                                                        $date_match = $five_days[$k].' '.$time1;
                                                    if ($date_match === $event) {
                                                        
                                                        echo "<td>" . $row[$b][0]."</td>";
                                                    } else {
                                                        echo "<td>" . $time1 . "</td>";
                                                    }
                                                }
                                                for ($j = 5; $j <= 6; $j++) {
                                                    echo "<td>" . "Indisponible" . "</td>";
                                                }
                                                echo "</tr>";
                                                $hour++;
                                            }
                                        }
                    
                    
                                                    ?>
                                    </tbody>
                    </table>
            </div>
        </section>
    </article>
</main>
    <!----------------- Footer ----------------->
    <?php include '../header-footer/footer.php'?>
    <!----------------- Footer ----------------->
</body>
</html>