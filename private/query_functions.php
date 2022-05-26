<?php 
	
	function query_student_using_username_and_password($username, $password){
        global $conn;
		$sql = "SELECT username, password from student where username = '$username' and password = '$password'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			return $row['username'];
		}
	}
	function query_instructor_using_username_and_password($username, $password){
	    global $conn;
		$sql = "SELECT username, password from instructor where username = '$username' and password = '$password'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			return $row['username'];
		}
	}
	function query_admin_using_username_and_password($username, $password){
        global $conn;
		$sql = "SELECT username, password from admin where username = '$username' and password = '$password'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			return $row['username'];
		}
	}
	function query_notification_all_in_one($username, $courseId){

    }
    function query_instructor($insId){
	    global $conn;
	    $sql = "select username from instructor where insId = '$insId'";
	    $result = mysqli_query($conn, $sql);
	    if(mysqli_num_rows($result)> 0){
	        return $result;
        }
    }
    function query_schedule($courseId){
	    global $conn;
	    $sql = "select * from schedule where schedule.courseId ='$courseId'";
	    $result = mysqli_query($conn, $sql);
	    if(mysqli_num_rows($result)> 0){
	        return $result;
        }
    }
	function query_notifications($courseId){
	    global $conn;
	    $sql = "select distinct notification.instructor, notification.data from notification, student where notification.courseId = '$courseId' and student.section in (select notification.targetSec from notification where notification.courseId ='$courseId');";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
    function query_enrolls($username){
	    global $conn;
	    $id = mysqli_fetch_assoc(query_student_id($username))['studId'];
	    $sql = "select * from studentenroll where studId = '$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
    function query_student_id($username){
	    global $conn;
	    $sql = "select studId from student where username = '$username'";
	    $result = mysqli_query($conn ,$sql);
	    if(mysqli_num_rows($result)){
	        return $result;
        }
    }
    function query_instructor_courses($insId){
	    $sql = "select * from instructorcourse where insId = '$insId'";
        return standard($sql);
    }
    function update_grade($studId, $courseId, $test, $mid, $final, $assignment, $project){
	    global $conn;
        $sql = "update grade set test = $test, mid = $mid, final = $final, assignment = $assignment, project = $project where courseId = '$courseId' and studId = '$studId'";
        return mysqli_query($conn,$sql);

    }
    function query_course_name($courseId){
	    $sql = "select courseName from course where courseId='$courseId';";
	    return standard($sql);
    }
    function query_course_info($courseId){

	    $sql = "select * from course where courseId = '$courseId'";
        return standard($sql);
    }
    function query_instructor_name($insId){
	    $sql = "select fName, lName from instructor where insId = '$insId'";
	    return standard($sql);
    }
    function register_student($username, $password,$fname, $lname,$year, $semester,$dept ){
	    $sql = "insert into student (fName, lName, password, year, semester, deptId, section, username) values ('$fname','$lname','$password',$year,$semester,1,1,'$username')";
	    return standard($sql);
    }
    function query_instructor_fullname ($courseId){

	    $insId = mysqli_fetch_assoc(query_instructor_course($courseId))['insId'];
	    $result = query_instructor_name($insId);
	    if($result!=null&& mysqli_num_rows($result)> 0){
	        $fName = mysqli_fetch_assoc($result)['fName'];
	        $lName = mysqli_fetch_assoc($result)['lName'];
	        return $fName.' '.$lName;
        }


    }
    function query_instructor_course($courseId){
	    $sql = "select * from instructorcourse where courseId = '$courseId'";
	    return standard($sql);
    }
    function standard($sql){
        global $conn;
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0 ) {
            return $result;
        }
    }
    function query_ins_id($username){
	    $sql = "select insId from instructor where username = '$username'";
	    return standard($sql);
    }
    function query_dept_name($deptId){
	    $sql = "select deptName from department where deptId = '$deptId'";
        return standard($sql);
    }
    function query_ins_section($insId){
	    $sql = "select secNum from instructorsection where insId = '$insId'";
	    return standard($sql);
    }
    function query_student_using_sec($secNum){
	    $sql = "select * from student where student.section = '$secNum'";
	    return standard($sql);
    }
    function query_student_results($studId, $courseId){
	    $sql = "select * from grade where studId = '$studId' and courseId = $courseId";
	    return standard($sql);
    }
    function query_student_result($studId){
	    $sql = "select * from grade where studId = '$studId'";
	    return standard($sql);
    }
 ?>