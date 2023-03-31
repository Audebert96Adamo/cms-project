<?php include "includes/header.php";
?>
<?php
approveComment();
unapproveComment();
deleteComment();
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
            Welcome to editor
          </h1>

          <?php
          if (isset($_GET['source'])) {
            $source = $_GET['source'];
          } else {
            $source = '';
          }

          switch ($source) {
            case 'add_post':
              echo include "includes/add_post.php";
              break;
            case 'edit_post':
              echo include "includes/edit_post.php";
              break;
            default:
              include "includes/view_all_comments.php";
              break;
          }
          ?>


        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/footer.php";
  ?>