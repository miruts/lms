<?php
include_once '../initialize.php';
    $file = $_REQUEST['file'];
    $status =  copy(SHARED_PATH.'/uploads/'.$file,SHARED_PATH.'/downloads/'.$file);
    redirect_to("../../public/student/index.php?curr_page=Resources&status=".$status);

?>
