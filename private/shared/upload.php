<?php
include_once '../initialize.php';
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {

        $uploadOk = 1;
    } else {

        $uploadOk = 1;
    }
}
if (file_exists($target_file)) {

    $uploadOk = 0;
}
if ($_FILES["fileToUpload"]["size"] > 50000000) {

    $uploadOk = 0;
}
if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx"
    && $fileType != "txt" && $fileType != "ppt" &&$fileType != "pptx" && $fileType != "xls" ) {
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    redirect_to('../../public/instructor/index.php?curr_page=Upload resources&uploaded=false');
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        redirect_to('../../public/instructor/index.php?curr_page=Upload resources&uploaded=true');
    } else {
        redirect_to('../../public/instructor/index.php?curr_page=Upload resources&uploaded=false');
    }
}
?>
