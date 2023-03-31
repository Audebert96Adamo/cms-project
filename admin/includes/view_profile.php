<?php if (isset($_SESSION['username'])) {

  $username = $_SESSION['username'];

  $query = "SELECT * FROM users WHERE user_name = '{$username}' ";

  $select_user_profile_query = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_array($select_user_profile_query)) {

    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
  }
}
?>



<div id="wrapper">

  <div id="page-wrapper">

    <hr>

    <form action="profile.php?source=edit_profile" method="post" enctype="multipart/form-data">

      <div class="form-group">
        <label for="author">Firstname</label>
        <input value="<?= $user_firstname; ?>" type="text" class="form-control" name="user_firstname" disabled="disabled">
      </div>

      <div class="form-group">
        <label for="post_status">Lastname</label>
        <input value="<?= $user_lastname; ?>" type="text" class="form-control" name="user_lastname" disabled="disabled">
      </div>

      <input value="<?= $user_role; ?>" type="hidden" name="user_role" class="form-control">


      <div class="form-group">
        <label for="post_tags">Username</label>
        <input value="<?= $username; ?>" type="text" class="form-control" name="user_name" disabled="disabled">
      </div>

      <div class="form-group">
        <label for="post_content">Email</label>
        <input value="<?= $user_email; ?>" type="text" class="form-control" name="user_email" disabled="disabled">
      </div>


      <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_profile" value="Update profile">
      </div>

    </form>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->