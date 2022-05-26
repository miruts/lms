<?php
session_start();
include_once '../../private/initialize.php';
    if(!isset($_SESSION['username'])){
        redirect_to("../index.php");
    }
    $username = $_SESSION['username'];
?>
<!doctype html>
<html>
<head>
    <title> Welcome &dash; <?php

        echo $_SESSION['username']; ?> </title>
    <link rel="stylesheet" href="../../public/css/public%20index.css">
    <link rel="stylesheet" href="../../public/css/student%20index.css">
</head>
<body>
    <?php include_once '../../private/shared/page_header.php'; ?>
    <nav>
        <ul class="nav-list" type="none">
            <li><a href="">New Courses</a></li>
            <li><a href="../../private/logout.php">Log out</a></li>
        </ul>
    </nav>
    <section class="content-section">
        <div class="left-div">
            <?php
                $current_page = $_REQUEST['curr_page'] ?? "Home";
            $nav_lists = [['name'=>'Home'],['name'=>'Courses'],['name'=>'Resources'],['name'=>'Notifications'], ['name'=>'Help'],] ?>
            <div class="header-box"></div>
            <div class="content">
                <ul>
                    <?php foreach($nav_lists as $list){ ?>
                    <li class="<?php if($list['name']==$current_page){
                        echo "selected";
                    }

                    ?>"><a href="<?php echo 'index.php?curr_page='.$list['name']; ?>"><?php echo $list['name'] ?></a> </li>
                    <?php } ?>
                </ul>
            </div>
            <br>
            <hr>
            <br>
            <div class="aside-content"></div>
        </div>
        <div class="right-div">
            <div class="header-box">
                <h2><?php echo $current_page; ?></h2>
            </div>
            <div class="content">
                <?php
                    $current_page = $_REQUEST['curr_page'] ?? "home";
                    $current_page = strtolower($current_page);
                ?>
                <?php if ($current_page == "home"){ ?>
                    <div class="home-left-div">
                        <h3>Notifications</h3>
                        <div class="home-left-inner-content">

                            <?php
                                $courses = query_enrolls($username);
                            ?>
                            <?php  while($row=mysqli_fetch_assoc($courses)){
                                $notifications = query_notifications($row['courseId']);
                                while( $notifications!= null && $not=mysqli_fetch_assoc($notifications)){
                                    $insName = mysqli_fetch_assoc(query_instructor($not["instructor"]));
                                    ?>
                                    <p><span> <strong><?php echo $insName['username']?></strong> </span>
                                        <?php echo $not['data'] ?> </p>
                                    <?php }} ?>
                        </div>
                    </div>
                    <div class="home-right-div">
                        <h3>Schedules</h3>
                        <div class="home-right-inner-content">
                            <table>
                            <tr>
                                <th>Course Name</th>
                                <th>Day</th>
                                <th>Time</th>
                            </tr>
                            <?php
                            $courses = query_enrolls($username);
                            while($course=mysqli_fetch_assoc($courses)){
                                $schedules = query_schedule($course['courseId']);
                                while($schedule=mysqli_fetch_assoc($schedules)){?>
                                        <tr>
                                            <td> <?php echo mysqli_fetch_assoc(query_course_name($course['courseId']))['courseName']; ?> </td>
                                            <td> <?php echo $schedule['day'] ?> </td>
                                            <td> <?php echo  $schedule['time'] ?> </td>
                                        </tr>
                                <?php }} ?>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($current_page == "courses"){ ?>
                    <div class="course-left-div">
                        <div class="course-left-heading">
                            <h3 style="color: green;">Current courses enrolled</h3>
                        </div>
                        <div class="course-left-div-content">
                            <?php $courses = query_enrolls($username); ?>
                            <?php while($course = mysqli_fetch_assoc($courses)){?>
                                <ul> <li> <a href=<?php echo 'index.php?curr_page=Courses&courseId='.$course['courseId']; ?>> <?php echo mysqli_fetch_assoc(query_course_name($course['courseId']))['courseName']; ?> </a>  </li> </ul>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="course-right-div">
                        <div class="course-right-heading">
                            <h3>Course details</h3>
                        </div>
                        <div class="course-right-div-content">
                            <table>
                                <caption>Course Information</caption>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Course ID</th>
                                    <th>Credit Hour</th>
                                    <th>ECTS</th>
                                    <th>Instructor</th>
                                    <?php
                                        $courseId = $_REQUEST['courseId'] ?? $course['courseId'];
                                    ?>
                                    <?php
                                        $courseInfo = query_course_info($courseId);
                                        while($courseInfo != null && $row=mysqli_fetch_assoc($courseInfo)){?>
                                            <tr> <td> <?php echo $row['courseName']?> </td>
                                                <td> <?php echo $row['courseId']?> </td>
                                                <td> <?php echo $row['chour']?> </td>
                                                <td> <?php echo $row['ects']?> </td>
                                                <td> <?php echo query_instructor_fullname($courseId);  ?> </td>
                                            </tr>
                                        <?php  }?>
                                </tr>
                            </table>
                            <br>
                            <hr>
                            <br>
                            <table>
                                <caption>Grading Information</caption>
                                <tr>
                                    <th>Test1(10%)</th>
                                    <th>Mid(20%)</th>
                                    <th>Final(40%)</th>
                                    <th>Project(20%)</th>
                                    <th>Assignment(10%)</th>
                                    <?php
                                    $studId = mysqli_fetch_assoc(query_student_id($username))['studId'];
                                    $grade = null;
                                    if(isset($_REQUEST['courseId'])){
                                    $grade = query_student_results($studId, $courseId);
                                    }
                                    while( $grade != null &&$gr = mysqli_fetch_assoc($grade)){?>
                                <tr> <td> <?php echo $gr['test']; ?> </td>
                                    <td> <?php echo $gr['mid']; ?> </td>
                                    <td> <?php echo $gr['final']; ?> </td>
                                    <td> <?php echo $gr['assignment']; ?> </td>
                                    <td> <?php echo $gr['project']; ?> </td></tr>
                                    <?php } ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($current_page == "resources"){ ?>
                    <div class="resources-div">
                        <table>
                            <caption>Uploaded Files for You</caption>
                            <tr>
                                <th>File</th>
                                <th></th>
                            </tr>
                            <?php
                            $files = scandir(SHARED_PATH.'/uploads/');
                            for($file = 0 ; $file < count($files) ; $file++){
                                if(strlen($files[$file]) > 2){?>
                                    <tr> <td> <?php echo $files[$file] ?> </td> <td><a href="<?php echo "../../private/shared/download.php?file=".$files[$file];?>" >Download</a> </td> </tr>
                                <?php }
                            } ?>
                            <?php if(isset($_REQUEST['status']) && $_REQUEST['status'] == 1){?>
                                <script>
                                    alert("File Downloaded to Downloads Folder Successfully");
                                </script>
                            <?php } ?>

                        </table>
                    </div>

                <?php } ?>
                <?php if ($current_page == "notifications"){ ?>
                    <div class="home-left-div">
                        <h3>Notifications</h3>
                        <div class="home-left-inner-content">

                            <?php
                            $courses = query_enrolls($username);
                            ?>
                            <?php  while($row=mysqli_fetch_assoc($courses)){
                                $notifications = query_notifications($row['courseId']);
                                while( $notifications!= null && $not=mysqli_fetch_assoc($notifications)){
                                    $insName = mysqli_fetch_assoc(query_instructor($not["instructor"]));
                                    ?>
                                    <p><span> <strong><?php echo $insName['username']?></strong> </span>
                                        <?php echo $not['data'] ?> </p>
                                <?php }} ?>
                        </div>
                    </div>

                <?php } ?>
                <?php if ($current_page == "chat"){ ?>

                <?php } ?>
                <?php if ($current_page == "help"){ ?>

                <?php } ?>
            </div>
        </div>
    </section>
</body>
</html>