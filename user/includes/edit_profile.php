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
    $user_role = $row['user_role'];
  }
}
?>

<?php
$message = "";

if (isset($_POST['update_profile'])) {

  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_role = $_POST['user_role'];
  $username = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];

  if (!empty($user_firstname) && !empty($user_lastname) && !empty($username) && !empty($user_email) && !empty($user_password)) {

    $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
    $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
    $username = mysqli_real_escape_string($connection, $username);
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $user_password = mysqli_real_escape_string($connection, $user_password);

    $query = "SELECT randSalt FROM users";
    $select_randSalt_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($select_randSalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($user_password, $salt);

    $query =  "UPDATE users SET ";
    $query .= "user_firstname = '$user_firstname', ";
    $query .= "user_lastname = '$user_lastname', ";
    $query .= "user_role = '$user_role', ";
    $query .= "user_name = '$username', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_password = '$hashed_password' ";
    $query .= "WHERE user_id = $user_id ";

    $update_user = mysqli_query($connection, $query);

    confirmQuery($update_user);

    $message = "<div class='succ-message'><p class='p-success'>Data updated : " . " " . "<a href='index.php'> View profile</a> </p> </div>";
  } else {
    $message = "<div class='err-message'><p class='p-danger'>Please make sure all fields are filled in correctly.</p></div>";
  }
}
?>


<div id="wrapper">

  <?php include "includes/navigation.php";
  ?>

  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            User Data
          </h1>


          <form action="" method="post" enctype="multipart/form-data">
            <?php echo $message; ?>
            <div class="form-group">
              <label for="user_firstname">Firstname</label>
              <input value="<?= $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
            </div>

            <div class="form-group">
              <label for="user_lastname">Lastname</label>
              <input value="<?= $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
            </div>

            <input value="<?= $user_role; ?>" type="hidden" name="user_role" class="form-control">



            <div class="form-group">
              <label for="user_name">Username</label>
              <input value="<?= $username; ?>" type="text" class="form-control" name="user_name">
            </div>

            <div class="form-group">
              <label for="user_email">Email</label>
              <input value="<?= $user_email; ?>" type="text" class="form-control" name="user_email">
            </div>

            <div class="form-group">
              <label for="user_password">Password</label>
              <input value="" type="text" class="form-control" name="user_password">
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="update_profile" value="Update profile">
            </div>

          </form>

        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->