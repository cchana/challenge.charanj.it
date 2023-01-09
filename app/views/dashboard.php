<h2>Challengers</h2>

<ul>
<?php

foreach($users as $user => $details) {
    echo '<li><a href="/compete/activity/list/'.$user.'" style="color: '.$details['color'].';">'.$details['name'].'</a></li>';
}

?>
</ul>

<?php

if($myData['allTime']['average']) {
    echo '<h2>My All Time Average</h2>
    <p>'.number_format((($myData['allTime']['average']['distance']/$myData['allTime']['average']['time'])*60*60), 2).'km/h</p>';
}

?>

<p>More coming soon</p>

<ul>
    <li><a href="/compete/activity/list">See my activities</a></li>
    <li><a href="/compete/activity/add">Add an activity</a></li>
</ul>
