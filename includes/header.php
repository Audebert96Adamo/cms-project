<?php include "includes/db.php";
?>
<?php include "./admin/includes/functions.php";
?>
<?php ob_start(); ?>
<?php session_start();
if (isset($_SESSION['user_role'])) {
  user_online();
}
if (isset($_SESSION)) {
  all_online();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CMS PROJECT</title>

  <!-- Bootstrap Core CSS -->

  <link href="./admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="./css/fontawesome.css" />
  <link rel="stylesheet" href="./css/brands.css" />
  <link rel="stylesheet" href="./css/solid.css" />
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->

  <link href="css/blog-home.css" rel="stylesheet">
  <!-- <link href="css/style.css" rel="stylesheet"> -->
  <link href="css/styles.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>