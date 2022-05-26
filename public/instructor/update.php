
<?php
    include_once '../../private/initialize.php';
    $courseId = $_REQUEST['courseId'];
    $studId = $_POST['studId'];
    $test = intval($_POST['test']);
    $mid = intval($_POST['mid']);
    $final = intval($_POST['final']);
    $assignment = intval($_POST['assignment']);
    $project = intval($_POST['project']);
    echo $courseId." ".$studId." ".$test." ".$mid." ".$final." ".$assignment." ".$project." ";
    echo update_grade($studId,$courseId,$test,$mid,$final,$assignment,$project);

?>
