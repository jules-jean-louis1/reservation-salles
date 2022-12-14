<?php

require('date.php');
$date = new Date();
$year = date('Y');
$date2 = $date->getAll($year);


?>


<main>
    <article>
        <section>
            <div class="années"><?php echo $year; ?></div>
            <div class="months">
                <ul>
                    <?php foreach ($date->months as $m) : ?>
                        <li><?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></li>
                   <?php endforeach; ?>
                </ul>
            </div>
            <?php $date2 = current($date2); ?>
            <?php foreach ($date2 as $m=>$days) :?>
                <div class="month" id="month<?php echo $m;?>">
                    <table>
                        <thead>
                            <tr>
                                <?php foreach ($date->days as $d) :?>
                                    <th><?php echo substr($d,0,3);?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($days as $d=>$w): ?>
                                    <?php if ($d == 1) :?>
                                        <td colspan="<?php echo $w-1;?>"></td>
                                    <?php endif; ?>
                                    <td><?php echo $d; ?></td>
                                    <?php if ($w == 7):?>
                                        <tr></tr>
                                    <?php endif; ?>
                                <?php endforeach ; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php endforeach; ?>
        </section>
    </article>
</main>