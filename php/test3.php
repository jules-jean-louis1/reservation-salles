<?php
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
            while ($day <= 7) {
                for ($i=0; isset($jour[$i]) ; $i++) {
                    $d = strtotime($year ."W". $week . $day); 
                    echo "<td>".$jour[$i]. "<br>". date('d M Y', $d) ."</td>";
                    $day++;
                }
                while($hour <= 19) { 
                    echo "<tr>";
                    for ($j=0; $j <= 5 ; $j++) {
                        $time1 = $hour . ":00";  
                        echo "<td>".$time1."</td>";
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