<?php include('layouts/header.php'); ?>
<?php


include('server/connection.php');

//if user has already registered, then take user to account page
if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
  exit;
}

if (isset($_POST['register'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];


  //if password don't match
  if ($password !== $confirmPassword) {
    header("location: register.php?error=Password don't match");



    //if password less than 6 char
  } else if (strlen($password) < 6) {
    header("location: register.php?error=Password must be at least 6 charachters");



    //if there is no error 
  } else {
    //check weather there is a user with this eamil or not
    $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();


    //if there is a user already register with this email
    if ($num_rows != 0) {
      header("location: register.php?error=user with this email already exist");


      //if user never register with this email before 
    } else {

      //create a new user 
      $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password)
                      VALUES(?,?,?)");
      $stmt->bind_param('sss', $name, $email, md5($password));


      //if account was created successfully
      if ($stmt->execute()) {

        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in'] = true;
        header('location: account.php?register=You register successfully');

        //account could not be created
      } else {
        header('location: register.php?error=could not be created an account for now');
      }
    }
  }
}






?>






<!-- Register -->
<section class="my-5 py-5">
  <div class="container text-center mt3 pt-3">
    <h2 class="font-weight-bold">Register</h2>
    <hr class="mx-auto">
  </div>
  <div class="mx-auto container">
    <form id="register-form" method="POST" action="register.php">
      <p style="color:red"><?php if (isset($_GET['error'])) {
                              echo $_GET['error'];
                            } ?></p>
      <div class="form-group">
        <label for="">Name</label>
        <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>

      </div>
      <div class="form-group">
        <label for="">Email</label>
        <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>

      </div>
      <div class="form-group">
        <label for="">Password</label>
        <input type="text" class="form-control" id="register-password" name="password" placeholder="Password" required>
      </div>
      <div class="form-group">
        <label for="">Confirm Password</label>
        <input type="text" class="form-control" id="register-confirm-password" name="confirm-password" placeholder="Confirm Password" required>
      </div>
      <div class="from-group">
        <input type="submit" class="btn" id="register-btn" name="register" value="Register">
      </div>
      <div class="from-group">
        <a id="login-url" href="login.php" class="btn"> Do you have account already? Login</a>
      </div>
    </form>
  </div>
</section>





<?php include('layouts/footer.php'); ?>