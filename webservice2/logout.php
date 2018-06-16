<?php

session_start();
session_unset();
session_destroy();
header('location: restaurantews2.php?page=1');

?>
