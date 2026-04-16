<?php

$show_id = $_POST['show_id'];

header("location: movie-seat-plan.php?show_id=" . urlencode($show_id));

exit();


?>