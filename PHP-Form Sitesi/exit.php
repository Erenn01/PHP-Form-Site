<?php
    ini_set('display_errors', 1);
    session_start();
    session_reset();
    session_destroy();
    header("location: index.php");
?>