<?php
function confirmQuery($result)
{
  global $connection;
  if (!$result) {
    die('QUERY FAILED .' . mysqli_error($connection));
  }
}
function confirmMessage($result)
{
  global $connection;
  if ($result) {
    echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
  } else {
    echo "<script type='text/javascript'>alert('failed!')</script>";
  }
}
function insert_categories()
{
  global $connection;
  if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];

    if ($cat_title == "" || empty($cat_title)) {
      echo "This field should not be empty";
    } else {
      $query = "INSERT INTO categories(cat_title) ";
      $query .= "VALUE('{$cat_title}') ";

      $create_category_query = mysqli_query($connection, $query);

      if (!$create_category_query) {
        die('QUERY FAILED' . mysqli_error($connection));
      }
    }
  }
}
function findAllCategories()
{
  global $connection;
  $query = "SELECT * FROM categories";
  $select_categories = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_categories)) {

    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";
    echo "</tr>";
  }
}
function deleteCategories()
{
  global $connection;
  if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 'admin') { // the 2 if conditions is a protection against URL AND MySQL injections
      if (isset($_GET['delete'])) {
        $get_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php"); // permet de recharger la page quand on delete
      }
    }
  }
}
function deletePost()
{
  if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'editor') { // the 2 if conditions is a protection against URL AND MySQL injections
      global $connection;
      if (isset($_GET['delete'])) {
        $post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$post_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
      }
    }
  }
}
function deleteUser()
{

  global $connection;
  if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 'admin') { // the 2 if conditions is a protection against URL AND MySQL injections

      if (isset($_GET['delete'])) {
        $user_id = mysqli_escape_string($connection, $_GET['delete']);

        $query = "DELETE FROM users WHERE user_id = {$user_id}";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
      }
    }
  }
}
function deleteComment()
{
  global $connection;
  if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
  }
}
function deleteCommentPost()
{
  global $connection;
  if (isset($_GET['deleteid'])) {
    $comment_id = $_GET['deleteid'];

    $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
    $delete_post_comment_query = mysqli_query($connection, $query);
    header("Location: view_post_comments.php?id=" . $_GET['id'] . "");
  }
}
function approveComment()
{
  global $connection;
  if (isset($_GET['approve'])) {
    $comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id ";
    $approve_query = mysqli_query($connection, $query);
    header("Location: comments.php");
  }
}
function unapproveComment()
{
  global $connection;
  if (isset($_GET['unapprove'])) {
    $comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id ";
    $unapprove_query = mysqli_query($connection, $query);
    header("Location: comments.php");
  }
}
function changetoAdmin()
{
  global $connection;
  if (isset($_GET['change_to_admin'])) {
    $user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id ";
    $admin_query = mysqli_query($connection, $query);
    header("Location: users.php");
  }
}
function changetoSub()
{
  global $connection;
  if (isset($_GET['change_to_sub'])) {
    $user_id = $_GET['change_to_sub'];

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id ";
    $sub_query = mysqli_query($connection, $query);
    header("Location: users.php");
  }
}
function redirect($location)
{
  return header(header: "Location:" . $location);
}

// function user_online()
// {

//   if (isset($_GET['onlineusers'])) {

//     global $connection;

//     if (!$connection) {

//       session_start();
//       include("../includes/db.php");

//       $session = session_id();
//       $time = time();
//       $time_out_in_seconds = 5;
//       $time_out = $time - $time_out_in_seconds;

//       $query = "SELECT * FROM users_online WHERE online_session = '$session'";
//       $send_query = mysqli_query($connection, $query);
//       $count = mysqli_num_rows($send_query);

//       if ($count == NULL) {
//         mysqli_query($connection, "INSERT INTO users_online(online_session, online_time) VALUES('$session','$time')");
//       } else {
//         mysqli_query($connection, "UPDATE users_online SET online_time = $time WHERE online_session = '$session'");
//       }

//       $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE online_time > '$time_out'");
//       echo $count_user = mysqli_num_rows($users_online_query);

//       // if (isset($_SESSION['user_role'])) {
//       // }
//     }
//   }
// }

// user_online();

function user_online()
{
  global $connection;

  $session = session_id();
  $time = time();
  $time_out_in_seconds = 60;
  $time_out = $time - $time_out_in_seconds;

  $query = "SELECT * FROM users_online WHERE online_session = '$session'";
  $send_query = mysqli_query($connection, $query);
  $count = mysqli_num_rows($send_query);

  if ($count == NULL) {
    mysqli_query($connection, "INSERT INTO users_online(online_session, online_time) VALUES('$session','$time')");
  } else {
    mysqli_query($connection, "UPDATE users_online SET online_time = $time WHERE online_session = '$session'");
  }

  $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE online_time > '$time_out'");

  return $count_user = mysqli_num_rows($users_online_query);
}

function all_online()
{
  global $connection;

  $session = session_id();
  $time = time();
  $time_out_in_seconds = 60;
  $time_out = $time - $time_out_in_seconds;

  $query = "SELECT * FROM all_users WHERE online_session = '$session'";
  $send_query = mysqli_query($connection, $query);
  $count = mysqli_num_rows($send_query);

  if ($count == NULL) {
    mysqli_query($connection, "INSERT INTO all_users(online_session, online_time) VALUES('$session','$time')");
  } else {
    mysqli_query($connection, "UPDATE all_users SET online_time = $time WHERE online_session = '$session'");
  }

  $all_online_query =  mysqli_query($connection, "SELECT * FROM all_users WHERE online_time > '$time_out'");

  return $all_users = mysqli_num_rows($all_online_query);
}
