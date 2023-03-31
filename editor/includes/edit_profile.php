<?php
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

  $query = "SELECT * FROM users WHERE user_name = '{$username}' ";

  $select_user_profile_query = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_array($select_user_profile_query)) {

    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
  }
}
?>

<?php
if (isset($_POST['update_user'])) {
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $username = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
  $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
  $username = mysqli_real_escape_string($connection, $username);
  $user_email = mysqli_real_escape_string($connection, $user_email);

  $query =  "UPDATE users SET ";
  $query .= "user_firstname = '$user_firstname', ";
  $query .= "user_lastname = '$user_lastname', ";
  $query .= "user_name = '$username', ";
  $query .= "user_email = '$user_email' ";
  $query .= "WHERE user_id = $user_id ";

  $update_user = mysqli_query($connection, $query);

  confirmQuery($update_user);
  // confirmMessage($update_user);
  echo "<p class='bg-success'>User updated : " . " " . "<a href='index.php'>View profile</a> </p> ";
}

if (isset($_POST['update_user_password'])) {
  $user_password = $_POST['user_password'];
  $user_password = mysqli_real_escape_string($connection, $user_password);

  $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

  // $query = "SELECT randSalt FROM users";
  // $select_randSalt_query = mysqli_query($connection, $query);

  // $row = mysqli_fetch_array($select_randSalt_query);
  // $salt = $row['randSalt'];
  // $hashed_password = crypt($user_password, $salt);

  $query =  "UPDATE users SET ";
  $query .= "user_password = '$hashed_password' ";
  $query .= "WHERE user_id = $user_id ";


  $update_user = mysqli_query($connection, $query);

  confirmQuery($update_user);
  // confirmMessage($update_user);
  echo "<p class='bg-success'>Password updated : " . " " . "<a href='index.php'>View profile</a> </p> ";
}
?>


<div id="wrapper">



  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Editor Data
          </h1>


          <form action="" method="post" enctype="multipart/form-data">


            <div class="form-group">
              <label for="author">Firstname</label>
              <input value="<?= $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
            </div>

            <div class="form-group">
              <label for="post_status">Lastname</label>
              <input value="<?= $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
            </div>


            <div class="form-group">
              <label for="post_tags">Username</label>
              <input value="<?= $username; ?>" type="text" class="form-control" name="user_name">
            </div>

            <div class="form-group">
              <label for="post_content">Email</label>
              <input value="<?= $user_email; ?>" type="text" class="form-control" name="user_email">
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="update_user" value="Update user">
            </div>

          </form>

          <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="post_content">Password</label>
              <input value="<?= $user_password; ?>" type="password" class="form-control" name="user_password">
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="update_user_password" value="Update password">
            </div>

          </form>

        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->