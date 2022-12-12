<?php
$jour = [
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi',
    'Samedi',
    'Dimanche',
];

foreach ($jour as $key) {
    echo "<div>" . $key . "</div>";
    for ($h=0 ; $h <= 24 ; $h++) {
        echo $h ."<br>";
    }
}
?>