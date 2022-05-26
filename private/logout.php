<?php
    include_once 'initialize.php';
    session_unset();
    session_destroy();
    redirect_to("../public/index.php");
?>
