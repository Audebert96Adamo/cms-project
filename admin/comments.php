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
            Comments
          </h1>

          <?php
          if (isset($_GET['source'])) {
            $source = $_GET['source'];
          } else {
            $source = '';
          }

          switch ($source) {
            case 'edit_comment':
              echo include "includes/view_comment_content.php";
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