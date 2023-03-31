<?php include "includes/header.php";
?>
<?php
deleteUser();
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
            Users
          </h1>

          <?php
          if (isset($_GET['source'])) {
            $source = $_GET['source'];
          } else {
            $source = '';
          }

          switch ($source) {
            case 'add_user':
              echo include "includes/add_user.php";
              break;
            case 'edit_user':
              echo include "includes/edit_user.php";
              break;
            default:
              include "includes/view_all_users.php";
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