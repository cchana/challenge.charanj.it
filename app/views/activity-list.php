<?php

if($activities) {

?>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Distance</th>
            <th>Duration</th>
            <th>Speed</th>
            <th>Difficulty</th>
            <?php if($_SESSION['userId'] == $userData['id']) { ?>
            <th>Actions</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
<?php

foreach($activities as $activity) {
    $timeVals = explode(':', $activity['time']);
    $seconds = $timeVals[0]*60*60 + $timeVals[1]*60 + $timeVals[2];
    $difficulty = 'medium';
    if($activity['difficulty'] <= 4) {
        $difficulty = 'easy';
    } else if($activity['difficulty'] >=7) {
        $difficulty = 'hard';
    }
    echo '<tr>
        <td><a href="/compete/activity/view/'.$activity['id'].'">'.date('d-m-Y', strtotime($activity['activity_date'])).'</a></td>
        <td>'.$activity['distance'].'km</td>
        <td>'.$activity['time'].'</td>
        <td>'.number_format((($activity['distance']/$seconds)*60*60), 2).'km/h</td>
        <td><span class="difficulty difficulty-'.$difficulty.'">'.$difficulty.' <small>('.$activity['difficulty'].')</small></span></td>';
    if($_SESSION['userId'] == $userData['id']) {
        echo '<td><a href="/compete/activity/delete/'.$activity['id'].'" onclick="return confirmAction();">Delete</a></td>';
    }
    echo '</tr>';
}

?>
    </tbody>
</table>

<?php } else { ?>

<p>Nothing to see here... yet!</p>

<?php } ?>
