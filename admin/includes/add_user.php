<?php
if (isset($_POST['create_user'])) {


  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_role = $_POST['user_role'];
  $username = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];

  if (!empty($user_firstname) && !empty($user_lastname) && !empty($username) && !empty($user_email) && !empty($user_password)) {

    $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
    $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
    $user_role = mysqli_real_escape_string($connection, $user_role);
    $username = mysqli_real_escape_string($connection, $username);
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $user_password = mysqli_real_escape_string($connection, $user_password);

    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
    // $query = "SELECT randSalt FROM users";
    // $select_randSalt_query = mysqli_query($connection, $query);

    // $row = mysqli_fetch_array($select_randSalt_query);
    // $salt = $row['randSalt'];
    // $hashed_password = crypt($user_password, $salt);

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_name, user_email, user_password) ";
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$hashed_password}' ) ";

    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);
    // confirmMessage($create_user_query);
    echo "<div class='err-message'><p class='p-success'>User Created: " . " " . "<a href='users.php'>View Users</a></p></div> ";
  } else {
    echo "<div class='err-message'><p class='p-danger'>Please make sure all fields are filled in correctly.</p></div>";
  }
}

?>
<h2>Add user</h2>
<hr>

<form action="" method="post" enctype="multipart/form-data">


  <div class="form-group">
    <label for="author">Firstname</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
    <label for="post_status">Lastname</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>

  <label for="user_role">Role</label>
  <div class="form-group">
    <select name="user_role" id="">
      <option value="subscriber">Select options</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
      <option value="editor">Editor</option>
    </select>
  </div>

  <div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" name="user_name">
  </div>

  <div class="form-group">
    <label for="post_content">Email</label>
    <input type="text" class="form-control" name="user_email">
  </div>

  <div class="form-group">
    <label for="post_content">Password</label>
    <input type="text" class="form-control" name="user_password">
  </div>

  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_user" value="Add user">
  </div>

</form>