<?php
class Date {

    var $days = ['Lundi' , 'Mardi' , 'Mercredi', 'Jeudi', 'Vendredi','Samedi', 'Dimanche'];
    var $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
    function getAll($year) {
        $r = [];
        $date = strtotime($year.'-01-01');
        while (date('Y',$date) <= $year) {
            $y = date('Y', $date);
            $m = date('n', $date);
            $d = date('j', $date);
            $w = date('N', $date);
            $r[$y][$m][$d] = [$w];
            $date = strtotime(date('Y-m-d',$date).'+1 DAY'); 
        }
        return $r;
    }
}
