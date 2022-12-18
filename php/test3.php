<?php
session_start();
include '../connect/connect_local.php';

$sql = "SELECT `titre`,`debut`,`fin`,`login` FROM `reservations` INNER JOIN utilisateurs WHERE utilisateurs.id = reservations.id_utilisateur;";
$rresult = mysqli_query($connect, $sql);
$row = $rresult->fetch_all();
var_dump($row);
$date1 = $row[0][1];
$dd = date('d M Y H:i', strtotime($date1));
var_dump($dd);


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

<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 52 ? 1 : 1 + $week).'&year='.($week == 52 ? 1 + $year : $year); ?>">Next  Week</a> <!--Next week-->
<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 1 ? 52 : $week -1).'&year='.($week == 1 ? $year - 1 : $year); ?>">Pre Week</a> <!--Previous week-->

<table border="1px">
    <tr>
        <td>Horaire</td>
            <?php
            if($week < 10) {
                $week = '0'. $week;
            }
            $hour = 8;
            $day = 1;
            $jours = 0;
            while ($day <= 7) {
                for ($i=0; isset($jour[$i]) ; $i++) {
                    $d = strtotime($year ."W". $week . $day); 
                    echo "<td>".$jour[$i]. "<br>". date('d M Y', $d) ."</td>";
                    $r[] = date('d M Y', $d);
                    $day++;
                }
                $t = strtotime($year ."W". $week . $day); 
                $r[] = date('d M Y', $t);
                $five_days = array_slice($r,0,5,true);
                while($hour <= 19) { 
                    echo "<tr>";
                    for ($j=0; $j <= 0 ; $j++) {
                        $time1 = $hour . ":00";
                        echo "<td>".$time1."</td>";
                    } 
                    for ($k=0; isset($five_days[$k]) ; $k++) {
                        for ($b=0; isset($row[$b]) ; $b++) {
                            $event = $row[$b][1];
                            $e = date('d M Y H:i', strtotime($event));
                            
                            if ($e === $five_days[$k] ) {
                                echo $row[$b][0];
                            }
                        }
                        for ($j=4; $j <= 5 ; $j++) {
                        $time1 = $hour . ":00";
                        } 
                    echo "<td>".$five_days[$k]." ".$time1."</td>";
                        /* echo "<td>".$time1."</td>"; */
                        }
                    for ($j=5; $j <= 6 ; $j++) { 
                        echo "<td>"."Indisponible"."</td>";
                    }
                    echo "</tr>";
                    $hour++;
                    
                }
            }
            

            ?>
    </tr>
</table>