<?php
session_start();
include '../connect/connect_local.php';
$errors = [];
$sql = "SELECT `titre`,`debut`,`fin`,`login` FROM `reservations` INNER JOIN utilisateurs WHERE utilisateurs.id = reservations.id_utilisateur;";
$rresult = mysqli_query($connect, $sql);
$infos = $rresult->fetch_all();

/* class Reservation {
    function selectAll() //récupère les réservations de la semaine
    {
        $connect = new mysqli('localhost','root','','reservationsalles');
        $jour = date("w");
        $startweek = date("Y-m-d h:i:s", mktime(0, 0, 0, date("n"), date("d") - $jour + 1, date("y")));
        $endweek = date("Y-m-d h:i:s", mktime(0, 0, 0, date("n"), date("d") - $jour + 7, date("y")));
        $sql = "SELECT titre, debut, fin, login, reservations.id FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id WHERE debut >='$startweek' AND fin <='$endweek'";
        $rresult = mysqli_query($connect, $sql);
        $infos = $rresult->fetch_all();
    
        for ($i = 0; $i < count($infos); $i++) //reformate infos
        {
            $infos[$i]['day'] = date('w', strtotime($infos[$i][1]));
            $infos[$i]['debut'] = date('H', strtotime($infos[$i][1]));
            $infos[$i]['fin'] = date('H', strtotime($infos[$i][2]));
        }
        return $infos;
    }

} */

/* $resa = new Reservation;
$infos = $resa->selectAll();
var_dump($infos);
 */

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

var_dump($infos[0][1])
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo/index.png">
    <title>Planning</title>
</head>
<body>

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
                    <table style="border: 1px;">
                        <thead>
                            <tr>
                                <th>Horaire</th>
                                    <?php
                                    if($week < 10) {
                                        $week = '0'. $week;
                                    }
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
                                   /* while ($hour <= 19) {
                                       echo "<tr>";
                                       for ($j = 0; $j <= 0; $j++) {
                                           $time1 = $hour . ":00";
                                           echo "<td>" . $time1 . "</td>";
                                       }
                                           for ($k = 0; isset($five_days[$k]); $k++) {
                                               $date_match = $five_days[$k].' '.$time1;
                                               echo "<td>" . $time1 . "</td>";
                                           }
                                           for ($j = 5; $j <= 6; $j++) {
                                               echo "<td>" . "Indisponible" . "</td>";
                                           }
                                           echo "</tr>";
                                           $hour++;
                                       } */
                                   $dispo = null;
                                    for ($row=8; $row < 19 ; $row++) { 
                                        echo "<tr>";
                                        for ($j = 0; $j <= 0; $j++) {
                                            $time1 = $row . ":00";
                                            echo "<td>" . $time1 . "</td>";
                                        }
                                        foreach ($five_days as $key => $value) {
                                            echo "<td>";
                                           
                                               for ($i=0; $i < count($infos) ; $i++) { 
                                                   $day = date('d M Y', strtotime($infos[$i][1]));
                                                   $debut = date('H:i', strtotime($infos[$i][1]));
                                                   $fin =  date('H:i', strtotime($infos[$i][2]));
                                  
                                                   if ($debut == $time1 and $day == $value) {

                                                   echo '<em>' . $infos[$i][0] . '</em><br>
                                                        par : ' . $infos[$i][3] . '<br>';
                                                        $dispo = 1;
                                                    } 
                                                    
                                                    
                                               } 
                                               
                                            }
                                        
                                        for ($j = 5; $j <= 6; $j++) {
                                               echo "<td>" . "Indisponible" . "</td>";
                                           }
                                           echo "</tr>";
                                        }
                                           ?>
                               </tbody>
                       </table>
               </div>
           </section>
       </article>
   </main>
   </body>
   </html>
                                    
                                    

