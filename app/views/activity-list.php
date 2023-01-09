<?php
if($_SESSION['userId'] == $userData['id']) {
    echo '<p><a href="/compete/activity/add">Add Activity</a></p>';
}

if($activities) {

?>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Distance</th>
            <th>Duration</th>
            <th>Speed</th>
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
    echo '<tr>
        <td><a href="/compete/activity/view/'.$activity['id'].'">'.date('d-m-Y', strtotime($activity['activity_date'])).'</a></td>
        <td>'.$activity['distance'].'km</td>
        <td>'.$activity['time'].'</td>
        <td>'.number_format((($activity['distance']/$seconds)*60*60), 2).'km/h</td>';
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
