<?php

$info = cal_info(0);
var_dump($info);
echo $info['months'][2];

?>

<section class="content_planning">
<?php
 //affiche le jour actuel
  $année= date('y');
  $mois= date('m');
  $jour= date('d') ;
  echo '<div class ="ajd" align="center">Aujourd\'hui, nous sommes le : '. $jour;
  echo '';
  echo '/'.$mois;
  echo '/'.$année;
?>
