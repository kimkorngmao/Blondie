<?php include('header.php') ?>

<?php
include('../server/connection.php');

if (isset($_SESSION['admin_logged_in'])) {
  header('location: index.php');
  exit;
}

if (isset($_POST['login_btn'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT admin_id,admin_name, admin_email,admin_password FROM admins WHERE admin_email = ? AND admin_password = ? limit 1 ");

  $stmt->bind_param('ss', $email, $password);

  if ($stmt->execute()) {
    $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
      $stmt->fetch();

      $_SESSION['admin_id'] = $admin_id;
      $_SESSION['admin_name'] = $admin_name;
      $_SESSION['admin_email'] = $admin_email;
      $_SESSION['admin_logged_in'] = true;

      header('location: index.php?message=logged in successfully');
    } else {
      header('location: login.php?error=can not verify your account');
    }
  } else {
    header('location: login.php?error=something went wrong');
  }
}
?>

<div class="container-fluid">
  <div style="min-height=1000px">
    <main class="col-md-6 mx-auto col-lg-6 px-md-4 text-center">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <h1 class="mx-auto"></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">

          </div>
        </div>
      </div>
      <div class="mx-auto container">
        <h1 class="mx-auto text">Login</h1>
        <form id="login-form" method="POST" action="login.php">
          <p style="color:red" class="text-center"><?php if (isset($_GET['error'])) { echo $_GET['error'];} ?></p>
          <div class="form-group mt-2">
            <label for="">Email</label>
            <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
          </div>
          <div class="form-group mt-2">
            <label for="">Password</label>
            <input type="text" class="form-control" id="login-password" name="password" placeholder="Password" required>
          </div>
          <div class="from-group mt-3">
            <input type="submit" class="btn btn-secondary edit" id="login-btn" name="login_btn" value="Login">
          </div>
        </form>
      </div>
    </main>
  </div>
</div>