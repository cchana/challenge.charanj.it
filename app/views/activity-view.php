<ul><?php

foreach($activity as $item => $value) {
    echo '<li>'.$item.': '.$value.'</li>';
}

?>
</ul>

<p>Back to <?php echo $user['name']; ?>'s activities</p>
