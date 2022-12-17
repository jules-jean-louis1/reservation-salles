<?php
session_start();
include '../connect/connect_local.php';
$errors = [];
$days = ['Lundi' , 'Mardi' , 'Mercredi', 'Jeudi', 'Vendredi','Samedi', 'Dimanche',];


$dt = new DateTime;
if (isset($_GET['year']) && isset($_GET['week'])) {
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    $dt->setISODate($dt->format('N'), $dt->format('W'));
}
$year = $dt->format('Y');
$week = $dt->format('W');

$sql = "SELECT `titre`,`debut`,`fin`,`login` FROM `reservations` INNER JOIN utilisateurs WHERE utilisateurs.id = reservations.id_utilisateur;";
$rresult = mysqli_query($connect, $sql);

while ($row = $rresult->fetch_all()) {
    if ($row[0][1] == '2022-12-18 10:00') {
        echo "00";
    }
}

$dt_Monday = new DateTime("last sunday this week 8 am");
$dt_sunday = new DateTime("sunday this week 7 pm");
$Monday = $dt_Monday->format('d M Y');
$sunday = $dt_sunday->format('d M Y');



$nextMonday = new DateTime("last sunday this week 8 am +8 day");
$nMonday = $nextMonday->format('d M Y');
$nextsunday = new DateTime("sunday this week 7 pm +8 day");
$nsunday = $nextsunday->format('d M Y');


function getDatesFromRange($start, $end, $format = 'd M Y') {
      
    // Declare an empty array
    $array = array();
      
    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');
  
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
  
    // Use loop to store date into array
    foreach($period as $date) {                 
        $array[] = $date->format($format); 
    }
  
    // Return the array elements
    return $array;
}
  
// Function call with passing the start date and end date
$Date = getDatesFromRange($Monday, $sunday);


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
                            /* while ($week == $dt->format('W')) {
                                for ($i=0; isset($days[$i]) ; $i++) {
                                    $dt->modify('+1 day');
                                    $time = [($dt->format('d M Y'))];
                                    echo "<th>".$days[$i]."<br>". $dt->format('d M Y')."</th>";
                                }
                             } */
                             for ($i=0; isset($Date[$i]); $i++) { 
                                echo "<th>".$Date[$i]."</th>";
                             }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i=8; $i <= 19 ; $i++) {
                            echo "<tr>";
                            for ($j=1; $j <= 1 ; $j++) {
                                $time1 = $i . ":00";
                                echo "<td>".$time1."</td>";  
                                for ($k=0; isset($Date[$k]); $k++) {
                                echo "<td>".$Date[$k].$time1."</td>";
                                }
                                
                                }
                            /* for ($j=5 ; $j <= 6 ; $j++) { 
                                echo "<td>"."Indisponible"."</td>";
                            } */
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

<?php
function calendar ($col,$row,$week)
{
    for ($i=0; $i < $col ; $i++) { 
        for ($j=0; $j < $row ; $j++) { 
            if ($i == 0) {
                $r[$i][] = (string) ($j + 7) . ":00";
            } else {
                $date = new DateTime();

            }
        }
    }
}
?>