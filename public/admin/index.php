<?php
    session_start();
    if(!isset($_SESSION['username']) || $_SERVER['REQUEST_METHOD'] == "GET"){
        redirect_to("../index.php");
    }
?>
<!doctype html>
<html>
<head>
    <title> Welcome &dash; <?php echo $_SESSION['username']; ?> </title>
    <link rel="stylesheet" href="../../public/css/public%20index.css">
</head>
<body>
<?php include_once '../../private/shared/page_header.php'; ?>

</body>
</html>