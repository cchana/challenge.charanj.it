<a href="/compete/activity/add">Add Activity</a>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Distance</th>
            <th>Duration</th>
            <th>Speed</th>
        </tr>
    </thead>
    <tbody>
<?php

foreach($activities as $activity) {
    $timeVals = explode(':', $activity['time']);
    $seconds = $timeVals[0]*60*60 + $timeVals[1]*60 + $timeVals[2];
    echo '<tr>
        <td>'.date('d-m-Y', strtotime($activity['activity_date'])).'</td>
        <td>'.$activity['distance'].'km</td>
        <td>'.$activity['time'].'</td>
        <td>'.number_format((($activity['distance']/$seconds)*60*60), 2).'km/h</td>
    </tr>';
}

?>
    </tbody>
</table>
