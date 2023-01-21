<h2>Challengers</h2>

<ul class="challengers">
<?php

$output = '';
foreach($users as $user => $details) {
    if($user != $_SESSION['user']) {
        $output .= '<li><a href="/compete/activity/list/'.$user.'" style="background-color: '.$details['color'].';">'.$details['name'].'</a></li>';
    } else {
        $output = '<li><a href="/compete/activity/list/'.$user.'" style="background-color: '.$details['color'].';">You</a></li>'.$output;
    }
}
echo $output;

?>
</ul>

<h2>Total Distance Cycled</h2>

<div class="chart">
<canvas id="distanceCycledInWeeks"></canvas>
</div>

<!--
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
</ul-->

<script>

<?php

$jsLabels = [];
$jsData = [];
foreach($dashboard['totalCycled'] as $distanceData) {
    $jsLabels[] = "'".$distanceData['week']."'";
    $jsData[] = $distanceData['total_distance'];
}

$jsLabels = array_reverse($jsLabels);
$jsData = array_reverse($jsData);

echo 'const distanceCycledInWeeksLabels = ['.join(',', $jsLabels).'],
        distanceCycledInWeeksData = ['.join(',', $jsData).']';

?>

window.onload = function() {
    let chartOptions = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    var distanceCycledInWeeks = document.getElementById('distanceCycledInWeeks').getContext('2d');
    var myChart = new Chart(distanceCycledInWeeks, {
        type: 'bar',
        data: {
    		labels: distanceCycledInWeeksLabels,
    		datasets: [
                {
        			label: 'Distance by Week',
        			data: distanceCycledInWeeksData,
        			fill: true,
                    backgroundColor: 'hsl(109, 94%, 43%)',
                    borderColor: '#F50'
        		}
            ]
    	},
        options: chartOptions
    });
};
</script>
