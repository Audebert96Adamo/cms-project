<table class="table table-bordered table-hover">
  <h3>Admin </h3>
  <hr>
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Role </th>
      <th>Edit </th>
      <th>Delete </th>
    </tr>
  </thead>
  <tbody>

    <?php

    $query = "SELECT * FROM users WHERE user_role = 'admin' ";
    $select_users = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users)) {

      $user_id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_password = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];

      echo "<tr>";

      echo "<td>$user_id</td>";
      echo "<td>$user_name</td>";
      echo "<td>$user_firstname</td>";
      echo "<td>$user_lastname</td>";
      echo "<td>$user_email</td>";
      echo "<td>$user_role</td>";
      echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
      echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";

      echo "</tr>";
    }
    ?>

  </tbody>
</table>

<hr>

<table class="table table-bordered table-hover">
  <h3>Editor </h3>
  <hr>
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Role </th>
      <th>Edit </th>
      <th>Delete </th>
    </tr>
  </thead>
  <tbody>

    <?php

    $query = "SELECT * FROM users WHERE user_role = 'editor' ";
    $select_users = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users)) {

      $user_id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_password = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];

      echo "<tr>";

      echo "<td>$user_id</td>";
      echo "<td>$user_name</td>";
      echo "<td>$user_firstname</td>";
      echo "<td>$user_lastname</td>";
      echo "<td>$user_email</td>";
      echo "<td>$user_role</td>";
      echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
      echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";

      echo "</tr>";
    }
    ?>

  </tbody>
</table>
<hr>

<hr>

<table class="table table-bordered table-hover">
  <h3>Subscriber </h3>
  <hr>
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Role </th>
      <th>Edit </th>
      <th>Delete </th>
    </tr>
  </thead>
  <tbody>

    <?php

    $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
    $select_users = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users)) {

      $user_id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_password = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];

      echo "<tr>";

      echo "<td>$user_id</td>";
      echo "<td>$user_name</td>";
      echo "<td>$user_firstname</td>";
      echo "<td>$user_lastname</td>";
      echo "<td>$user_email</td>";
      echo "<td>$user_role</td>";
      echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
      echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";

      echo "</tr>";
    }
    ?>

  </tbody>
</table>
<hr>