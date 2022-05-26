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
    <title> Welcome &dash; <?php echo $_SESSION['username']; ?> </title>
    <link rel="stylesheet" href="../../public/css/public%20index.css">
    <link rel="stylesheet" href="../../public/css/teacher%20index.css">
    <script>
        function update(studId, courseId){
            let test = document.getElementById('test').value;
            let mid = document.getElementById('mid').value;
            let final = document.getElementById('final').value;
            let assignment = document.getElementById('assignment').value;
            let project = document.getElementById('project').value;

            let req = new XMLHttpRequest();
            req.onreadystatechange = function () {
                if(this.status === 200 && this.readyState === 4){
                    console.log(this.responseText);
                }
            };
            req.open("post",'update.php', true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            req.send("studId="+studId+"&courseId="+courseId+"&test="+test+"&mid="+mid+"&final="+final+"&assignment="+assignment+"&project="+project);
        }
    </script>
</head>
<body>
<?php include_once '../../private/shared/page_header.php';
?>
<nav>
    <ul class="nav-list" type="none">
        <li><a href="">Requests</a></li>
        <li><a href="../../private/logout.php">Log out</a></li>
    </ul>
</nav>
<section class="content-section">
    <div class="left-div">
        <?php
        $current_page = $_REQUEST['curr_page'] ?? "home";
        $nav_lists = [['name'=>'Manage students'],['name'=>'Upload resources'],['name'=>'Help'],] ?>
        <div class="header-box"></div>
        <div class="content">
            <ul>
                <?php
                $current_page = $_REQUEST['curr_page'] ?? 'Manage students';
                foreach($nav_lists as $list){ ?>
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

            <?php $current_page = $_REQUEST['curr_page'] ?? "Manage students"; ?>
            <?php if ($current_page == "home"){ ?>

            <?php } ?>
            <?php if ($current_page == "Manage students"){ ?>
                <div class="manage-content-left">
                    <h3>Student List</h3>
                    <table>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Section</th>
                            <th></th>
                        </tr>
                        <?php
                        $insId = mysqli_fetch_assoc(query_ins_id($username))['insId'];
                        $courseId = mysqli_fetch_assoc(query_instructor_courses($insId))['courseId'];
                        $sections = query_ins_section($insId);
                        while  ($section = mysqli_fetch_assoc($sections)){
                            $students = query_student_using_sec($section['secNum']);
                            while ($students!=null && $student = mysqli_fetch_assoc($students)){?>
                                <tr class="<?php if(isset($_REQUEST['stud_id']) && $student['studId'] == $_REQUEST['stud_id']){
                                    echo 'selected-entry';
                                } ?>" >
                                    <td> <?php echo $student['fName'] ?> </td>
                                    <td> <?php echo $student['lName'] ?> </td>
                                    <td> <?php echo $student['studId'] ?> </td>
                                    <td> <?php echo mysqli_fetch_assoc(query_dept_name($student['deptId']))['deptName'] ?> </td>
                                    <td> <?php echo $student['section'] ?> </td>
                                    <td><a href="<?php
                                        echo 'index.php?curr_page=Manage students&stud_id='.$student['studId'];  ?>"> Grade </a> </td>
                                </tr>
                            <?php } }?>
                    </table>
                </div>
                <div class="manage-content-right">
                    <div>
                        <h3>Grading Information</h3>
                    </div>
                    <div class="manage-content-right-content">
                        <table>
                            <caption>Grading Information</caption>
                            <tr>
                                <th>Test(10%)</th>
                                <th>Mid(20%)</th>
                                <th>Final(40%)</th>
                                <th>Assign(10%)</th>
                                <th>Project(20%)</th>

                                <th></th>
                            </tr>
                            <?php $studId = $_REQUEST['stud_id'] ?? $student['studId'];
                                $grade = query_student_result($studId);
                                    while($grade != null && $gr = mysqli_fetch_assoc($grade)){?>
                                        <tr> <td><input  id="test" value="<?php echo $gr['test'] ?>" max="10" min="0" type="number"> </td>
                                        <td><input id="mid" value="<?php echo $gr['mid'] ?>" max="20" min="0" type="number"> </td>
                                        <td><input id="final" value="<?php echo $gr['final'] ?>" max="40" min="0" type="number"> </td>
                                        <td><input id="assignment" value="<?php echo $gr['assignment'] ?>" max="10" min="0" type="number"> </td>
                                        <td><input id="project" value="<?php echo $gr['project'] ?>" max="20" min="0" type="number"> </td>
                                            <td> <button onclick="update(<?php echo $_REQUEST['stud_id']; ?>, <?php echo $gr['courseId']; ?>)">Save</button> </td> </tr>
                                <?php } ?>

                        </table>

                    </div>
                </div>
            <?php } ?>
            <?php if ($current_page == "Upload resources"){ ?>
                <div class="upload-left">
                    <form action="../../private/shared/upload.php" method="post" enctype="multipart/form-data">
                        <h3>Select file to upload:</h3>
                        <input type="file" name="fileToUpload" id="fileToUpload"><br>
                        <input type="submit" value="Upload">
                    </form>
                     <?php
                        if(isset($_REQUEST['uploaded'])){
                            if($_REQUEST['uploaded'] == 'true'){
                                echo '<p class="green" >File uploaded successfully</p>';
                            }
                            else {
                                echo '<p class="red" > File not uploaded </p>';
                            }
                        }
                        ?>
                </div>
                <div class="upload-right">
                    <h3>Uploads</h3>
                    <ul>
                        <?php
                        $files = scandir(SHARED_PATH.'/uploads/');
                        for($file = 0; $file < count($files) ; $file++){?>
                             <?php if(strlen($files[$file]) > 2 ){
                                    echo "<li class=\"files\">".$files[$file]."</li>";
                                }

                            ?>
                        <?php }?>

                    </ul>
                </div>
            <?php } ?>
            <?php if ($current_page == "Notify"){ ?>

            <?php } ?>
            <?php if ($current_page == "Chat"){ ?>

            <?php } ?>
            <?php if ($current_page == "help"){ ?>

            <?php } ?>
        </div>
    </div>
</section>
<?php include_once '../../private/shared/page_footer.php'; ?>
</body>
</html>