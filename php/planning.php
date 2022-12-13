<?php
session_start();
$login = $_SESSION['login'];
mysqli_set_charset($connect,"utf8");

$queryPlanning = mysqli_query($connect, "SELECT utilisateurs.login, reservations.titre, reservations.debut, reservations.fin, reservations.type_activité, reservations.id  FROM `utilisateurs` INNER JOIN reservations ON id_utilisateur=utilisateurs.id");
$fetchPlanning = mysqli_fetch_all($queryPlanning, MYSQLI_ASSOC);


// $today=time();
// $nextJour = time() + (24 * 60 * 60);
//                    // 24 hours; 60 mins; 60 secs
// echo 'Auj:       '. date('l d-m-y') ."\n";
// echo 'Demain: '. date('l d-m-y', $nextJour) ."\n";

            $monday = date('l d-m-y', strtotime('monday this week'));
            $tuesday = date('l d-m-y', strtotime('tuesday this week'));
            $wednesday = date('l d-m-y', strtotime('wednesday this week'));
            $thursday = date('l d-m-y', strtotime('thursday this week'));
            $friday = date('l d-m-y', strtotime('friday this week'));
            $week=array($monday,$tuesday,$wednesday,$thursday, $friday);

            $eight = "8:00";
            $nine = "9:00";
            $ten = "10:00";
            $eleven = "11:00";
            $twelve = "12:00";
            $thirteen = "13:00";
            $fourteen = "14:00";
            $fifteen = "15:00";
            $sixteen = "16:00";
            $seventeen = "17:00";
            $eighteen = "18:00";
            $nineteen = "19:00"; 
        $horaire=array($eight,$nine,$ten,$eleven,$twelve,$thirteen,$fourteen,$fifteen,$sixteen,$seventeen,$eighteen,$nineteen);
        
?>
 <main>
     <article id="general">
        <section id="legende">
                <h3>Légende</h3>
            <div id="carrés">
                <span class="leg"><div id="soc"></div><p class="key">social</p></span>
                <span class="leg"><div id="loi"></div><p class="key">loisirs</p></span>
                <span class="leg"><div id="sco"></div><p class="key">scolaire</p></span>
                <span class="leg"><div id="spo"></div><p class="key">sport</p></span>
                <span class="leg"><div id="fes"></div><p class="key">festivités</p></span>
            </div>
        </section>
        <section id="tableau">
            <table>
                <thead>
                    <!-- il faut le mm nb de td que de colonne en haut pour que ça marche -->
                    <th></th>
                    <?php foreach ($week as $jour){
                        echo "<th>".$jour."</th>";                         
                    }                   
                 ?>
                    </tr>
                </thead>
                <tbody>  
                    <?php                         

                        for ($i=0; isset($horaire[$i])==true; $i++){
                            echo "<tr>";
                            echo "<td>".$horaire[$i]."</td>";
                            
                         for ($j=0; isset($week[$j])==true; $j++){
                             echo "<td>";   

                            foreach ($fetchPlanning as $value){
                            $debut = $value['debut'];
                            $time = strtotime($debut);
                            $jourDebut = date("l d-m-y",$time);
                            $heureDebut = date("H:00",$time);

                        //  echo $heureDebut;
                        //  echo $jourDebut;
                            if(($jourDebut == $week[$j]) && ($heureDebut == $horaire[$i])) {
                                echo '<div class = "'.$value['type_activité'].'"><a href=./reservation.php?val='.$value['id'].'><span id="font">'. $value['titre'] . '</span><span class="tooltiptext">'.$value['login'].'</span>'.'</a></div>';?>
                                <style>
                                    #font {
                                        font-family: 'Courier New', Courier, monospace;
                                    }
                                </style>
                                <?php
                                if ($value['type_activité'] == "social"){?> 
                                    <style>.social  {background-color: #FFD3B4;
                                    }
                                    .social .tooltiptext {
                                                visibility: hidden;
                                                width: 120px;
                                                background-color: #5D534A;
                                                color: #FDFAF6;
                                                text-align: center;
                                                padding: 5px 0;
                                                border-radius: 3px;
                                                position: absolute;
                                                z-index: 1;
                                                }
                            
                                    .social:hover .tooltiptext {
                                        visibility: visible;
                                            }
                                    </style>
                                    <?php
                                }elseif ($value['type_activité'] == "scolaire"){ ?>
                                    <style>.scolaire  {background-color: #98DDCA;
                                    }
                                    .scolaire .tooltiptext {
                                                visibility: hidden;
                                                width: 120px;
                                                background-color: #5D534A;
                                                color: #FDFAF6;
                                                text-align: center;
                                                padding: 5px 0;
                                                border-radius: 3px;
                                                position: absolute;
                                                z-index: 1;
                                                }
                            
                                    .scolaire:hover .tooltiptext {
                                        visibility: visible;
                                            }
                                    </style>
                                    <?php
                                }elseif ($value['type_activité'] == "loisirs"){ ?>
                                    <style>.loisirs  {background-color: #FFAAA7;
                                                }
                                        .loisirs .tooltiptext {
                                            visibility: hidden;
                                            width: 120px;
                                            background-color: #5D534A;
                                            color: #FDFAF6;
                                            text-align: center;
                                            padding: 5px 0;
                                            border-radius: 3px;
                                            position: absolute;
                                            z-index: 1;
                                            }
                        
                                        .loisirs:hover .tooltiptext {
                                            visibility: visible;
                                                }
                                        </style>
                                    <?php
                                }elseif ($value['type_activité'] == "sport"){ ?>
                                    <style>.sport  {background-color: #D5ECC2;
                                    }
                                    .sport .tooltiptext {
                                                visibility: hidden;
                                                width: 120px;
                                                background-color: #5D534A;
                                                color: #FDFAF6;
                                                text-align: center;
                                                padding: 5px 0;
                                                border-radius: 3px;
                                                position: absolute;
                                                z-index: 1;
                                                }
                            
                                    .sport:hover .tooltiptext {
                                        visibility: visible;
                                            }
                                    </style>
                                    <?php
                                }elseif ($value['type_activité'] == "festivite"){ ?>
                                    <style>.festivite  {background-color: #F6DFEB;
                                        }
                                    .festivite .tooltiptext {
                                            visibility: hidden;
                                            width: 100px;
                                            background-color: #5D534A;
                                            color: #FDFAF6;
                                            text-align: center;
                                            padding: 5px 0;
                                            border-radius: 3px;
                                            position: absolute;
                                            z-index: 1;
                                            }
                            
                                    .festivite:hover .tooltiptext {
                                        visibility: visible;
                                            }  
                                        </style><?php ;
                                        }
                                    }
                                }
                            }
                         }

                      ?>
                </tbody>
            </table>
        </section>
     </article>
    </main>