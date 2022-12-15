<?php

session_start();
include '../connect/connect_local.php';

$sql = "SELECT `titre`,`debut`,`fin`,`login` FROM `reservations` INNER JOIN utilisateurs WHERE utilisateurs.id = reservations.id_utilisateur;";
$rresult = mysqli_query($connect, $sql);
while ($lrow = mysqli_fetch_assoc($rresult)){ 
    $ret[] = $lrow; 
  }

var_dump($ret);

$date = $ret[0]['debut']; 
$my_date = date('d M Y', strtotime($date));
$my_date2 = date('H:i', strtotime($date));
echo $my_date;
echo $my_date2;

for ($i=0; isset($ret[$i]) ; $i++) { 
    for ($j=0; isset($ret[$i][$j]) ; $j++) {
        $date = $ret[$i][$j];

    }
}