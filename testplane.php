<?php
$days = ['Lundi' , 'Mardi' , 'Mercredi', 'Jeudi', 'Vendredi','Samedi', 'Dimanche',];


$dt = new DateTime;
if (isset($_GET['year']) && isset($_GET['week'])) {
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    $dt->setISODate($dt->format('o'), $dt->format('W'));
}
$year = $dt->format('o');
$week = $dt->format('W');

?>




<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">Semaine suivante</a> <!--Previous week-->
<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Semaine précédente</a> <!--Next week-->



<table>
    <thead>
        <tr>
            <td>Heure</td>
            <?php  
            while ($week == $dt->format('W')) {
                for ($i=0; isset($days[$i]) ; $i++) { 
                    $dt->modify('+1 day'); 
                    echo "<th>".$days[$i]. $dt->format('d M Y')."</th>";
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
                echo "</tr>"; 
            }
            ?>
        
            </tbody>
</table>
    
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