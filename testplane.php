<?php
$days = ['Jour','Lundi' , 'Mardi' , 'Mercredi', 'Jeudi', 'Vendredi','Samedi', 'Dimanche'];
$months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table>
        <thead>
            <tr>
                <?php
                foreach ($days as $jours) {
                    echo "<th>".$jours."</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($days as $jours) {
                /* echo "<tr>".$jours; */
                for ($i=8; $i < 19 ; $i++) {
                    echo "<td>". $i . "</td>";
                }
                /* echo "</tr>"; */
            }
            ?>
        </tbody>
    </table>


    
</body>
</html>