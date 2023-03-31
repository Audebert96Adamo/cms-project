<?php include "../includes/db.php"; ?>
<?php include "../admin/includes/functions.php";
?>
<?php ob_start(); ?>
<?php session_start();
user_online(); ?>

<?php
if (!isset($_SESSION['user_role'])) {
  header("Location: ../index.php");
} else {
  if ($_SESSION['user_role'] !== 'editor') {
    header("Location: ../index.php");
  }
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

  <title>Editor - CMS PROJECT</title>

  <!-- Bootstrap Core CSS -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/styles-editor.css" rel="stylesheet">
  <link href="css/sb-admn.css" rel="stylesheet">

  <!-- Custom Fonts -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!-- [if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif] -->

  <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->

  <link rel="stylesheet" href="css/summernote.min.css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- <script src="js/jquery.js"></script> -->


</head>

<body>