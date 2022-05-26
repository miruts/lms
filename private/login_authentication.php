<?php 
    session_start();
	include_once 'initialize.php';

	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	if(($value = query_student_using_username_and_password($username, $password))!= null){
	    $_SESSION['username'] = $username;
	    redirect_to('../public/student/index.php');
    }
    elseif(($value = query_instructor_using_username_and_password($username, $password))!= null){
        $_SESSION['username'] = $username;
        redirect_to('../public/instructor/index.php');
    }
    elseif(($value = query_admin_using_username_and_password($username, $password)) != null){
        $_SESSION['username'] = $username;
        redirect_to('../public/admin/index.php');
    }
	else {
	    redirect_to('../public/index.php');
    }


 ?>