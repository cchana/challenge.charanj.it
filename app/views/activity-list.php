<?php

if($activities) {

?>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th class="cell-number">Distance</th>
            <th class="cell-number">Duration<br /><small>(HH:MM:SS)</small></th>
            <th class="cell-number">Speed</th>
            <th>Difficulty</th>
            <?php if($_SESSION['userId'] == $userData['id']) { ?>
            <th>Actions</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
<?php

$i = 0;
foreach($activities as $activity) {
    $timeVals = explode(':', $activity['time']);
    $seconds = $timeVals[0]*60*60 + $timeVals[1]*60 + $timeVals[2];
    $difficulty = 'medium';
    if($activity['difficulty'] <= 4) {
        $difficulty = 'easy';
    } else if($activity['difficulty'] >=7) {
        $difficulty = 'hard';
    }
    $distance += $activity['distance'];
    $time += $seconds;
    echo '<tr>
        <td><a href="/compete/activity/view/'.$activity['id'].'">'.date('d-m-Y', strtotime($activity['activity_date'])).'</a></td>
        <td class="cell-number">'.$activity['distance'].'km</td>
        <td class="cell-number">'.$activity['time'].'</td>
        <td class="cell-number">'.number_format((($activity['distance']/$seconds)*60*60), 2).'km/h</td>
        <td><span class="difficulty difficulty-'.$difficulty.'">'.$difficulty.' <small>('.$activity['difficulty'].')</small></span></td>';
    if($_SESSION['userId'] == $userData['id']) {
        echo '<td><a href="/compete/activity/delete/'.$activity['id'].'" onclick="return confirmAction();">Delete</a></td>';
    }
    echo '</tr>';
    $i++;
}

?>
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <td class="cell-number"><?php echo $distance; ?>km</td>
            <td class="cell-number"><?php

            $hours = $time/60/60;
            $minutes = $time/60;

            $hour = str_pad(explode('.', $hours)[0], 2, '0', STR_PAD_LEFT);
            $minute = str_pad(explode('.', $minutes)[0], 2, '0', STR_PAD_LEFT);
            $second = str_pad($time-(($hour*60*60)+($minute*60)), 2, '0', STR_PAD_LEFT);

            echo $hour.':'.$minute.':'.$second;

            ?></td>
            <td class="cell-number">&mdash;</td>
            <td></td>
            <?php if($_SESSION['userId'] == $userData['id']) { ?>
                <td></td>
            <?php } ?>
        </tr>
        <tr>
            <th>Average</th>
            <td class="cell-number"><?php $avgDist = $distance/$i;
                        echo $avgDist;
            ?>km</td>
            <td class="cell-number"><!--<?php $avgTime = $time/$i;


                        $hours = $avgTime/60/60;
                        $minutes = $avgTime/60;

                        $hour = str_pad(explode('.', $hours)[0], 2, '0', STR_PAD_LEFT);
                        $minute = str_pad(explode('.', $minutes)[0], 2, '0', STR_PAD_LEFT);
                        $second = str_pad($avgTime-(($hour*60*60)+($minute*60)), 2, '0', STR_PAD_LEFT);

                        echo $hour.':'.$minute.':'.$second;
            ?>-->&mdash;</td>
            <td class="cell-number"><?php

            echo number_format((($avgDist/$avgTime)*60*60), 2).'km/h';

            ?></td>
            <td></td>
            <?php if($_SESSION['userId'] == $userData['id']) { ?>
                <td></td>
            <?php } ?>
        </tr>
    </tfoot>
</table>

<?php } else { ?>

<p>Nothing to see here... yet!</p>

<?php } ?>
