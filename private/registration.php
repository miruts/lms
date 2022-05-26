<?php
include_once 'initialize.php';
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $username = $_REQUEST['usernamer'];
    $password = $_REQUEST['passwordr'];
    $dept =  $_REQUEST['dept'];
    $year = $_REQUEST['year'];
    $semester = $_REQUEST['semester'];
    echo register_student($username,$password,$fname,$lname,$year,$semester,$dept);
    redirect_to("../public/index.php");




?>
