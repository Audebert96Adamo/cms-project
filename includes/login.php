<?php include "db.php"; ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
  $select_user_query = mysqli_query($connection, $query);
  if (!$select_user_query) {
    die("QUERY FAILED" . mysqli_error($connection));
  }

  while ($row = mysqli_fetch_array($select_user_query)) {
    $db_user_id = $row['user_id'];
    $db_username = $row['user_name'];
    $db_user_password = $row['user_password'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_email = $row['user_email'];
    $db_user_role = $row['user_role'];
  }

  // $crypt_password = crypt($password, $db_user_password);

  // if ($username !== $db_username || $crypt_password !== $db_user_password) {
  //   header("Location: ../index.php ");
  // } elseif ($username == $db_username && $crypt_password == $db_user_password) {
  if (password_verify($password, $db_user_password)) {
    $_SESSION['username'] = $db_username;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_email'] = $db_user_email;
    $_SESSION['user_role'] = $db_user_role;

    if ($_SESSION['user_role'] === 'admin') {
      header("Location: ../admin ");
    } elseif ($_SESSION['user_role'] === 'editor') {
      header("Location: ../editor/posts.php");
    } elseif ($_SESSION['user_role'] === 'subscriber') {
      header("Location: ../user ");
    }
  } else {
    header("Location: ../index.php ");
  }
}
?>