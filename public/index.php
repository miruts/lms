<?php require_once("../private/initialize.php"); ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>E-Learning | Explore Ask...</title>
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('css/public index.css')  ?>">
      <link rel="stylesheet" href="css/footer.css">
  </head>
  <body>
     <?php include_once '../private/shared/page_header.php'; ?>
    <section id="main-content-section">
      <div id="login-div">
        <form method="post" action="../private/login_authentication.php" >
          <h3>Enter username and password to login</h3>
          <label class="normal" for="username">Username: </label><br>
          <input class="normal" type="text" name="username" id="username"><br>
          <label class="normal" for="password">Password: </label><br>
          <input class="normal" type="password" id="password" name="password"><br>
          <input class="normal" type="submit" name="" id="submit" value="Login">
        </form>
        <p id="status"></p>
      </div>
      <div id="register-div">
        <form action="../private/registration.php" method="post">
          <h3>
            Fill out the required information to register
          </h3>
          <label class="normal" for="fname">First Name: </label><br>
          <input class="normal" type="text" id="fname" name="fname"><br>
          <label for="lname">Last Name: </label><br>
          <input class="normal"type="text" id="lname" name="lname"><br>
          <label for="username">Username: </label><br>

          <input class="normal" type="text" name="usernamer" id="usernamer"><br>
          <label for="password">Password: </label><br>
          <input class="normal" type="password" id="passwordr" name="passwordr"><br>


          <label for="dept">Department: </label><br>
          <input class="normal" type="text" id="dept" name="dept"><br>
          <label for="year">Year: </label><br>
          <label>1</label>
          <input type="radio" value="1" id="year1" name="year">
          <label>2</label>
          <input type="radio" value="2" id="year2" name="year">
          <label>3</label>
          <input type="radio" value="3" id="year3" name="year">
          <label>4</label>
          <input type="radio" value="4" id="year4" name="year">
          <label>5</label>
          <input type="radio" id="year" name="year5"><br>
          <label for="semester">Semester: </label><br>
          <label>1</label>
          <input type="radio" id="semester1" name="semester">
          <label>2</label>
          <input type="radio" id="semester2" name="semester"><br>
          <input id="submitr" type="submit" name="register" value="Register">
        </form>
      </div>
    </section>
  </body>
</html>
