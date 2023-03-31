<?php include "includes/header.php";
?>
<?php

deleteCommentPost();
?>

<div id="wrapper">

  <?php include "includes/navigation.php";
  ?>

  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">


          <table class="table table-bordered table-hover">
            <h3>Pending Comments :</h3>

            <thead>
              <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Delete</th>
              </tr>
            </thead>

            <tbody>

              <?php

              $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['id']) . "";
              $select_comments = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_assoc($select_comments)) {

                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                if ($comment_status == 'unapproved') {

                  echo "<tr>";

                  echo "<td>$comment_id</td>";
                  echo "<td>$comment_author</td>";
                  echo "<td>$comment_content</td>";
                  echo "<td>$comment_email</td>";
                  echo "<td>$comment_status</td>";

                  $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                  $select_post_id_query = mysqli_query($connection, $query);
                  while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];

                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                  }

                  echo "<td>$comment_date</td>";
                  echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                  echo "<td><a href='view_post_comments.php?deleteid={$comment_id}&id=" . $_GET['id'] . "'>Delete</a></td>";

                  echo "</tr>";
                }
              }
              ?>

            </tbody>

          </table>

          <hr>

          <table class="table table-bordered table-hover">
            <h3>Published Comments :</h3>

            <thead>
              <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Delete</th>
              </tr>
            </thead>

            <tbody>

              <?php

              $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['id']) . "";
              $select_comments = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_assoc($select_comments)) {

                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                if ($comment_status == 'approved') {

                  echo "<tr>";

                  echo "<td>$comment_id</td>";
                  echo "<td>$comment_author</td>";
                  echo "<td>$comment_content</td>";
                  echo "<td>$comment_email</td>";
                  echo "<td>$comment_status</td>";

                  $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                  $select_post_id_query = mysqli_query($connection, $query);
                  while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];

                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                  }

                  echo "<td>$comment_date</td>";
                  echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                  echo "<td><a href='view_post_comments.php?deleteid={$comment_id}&id=" . $_GET['id'] . "'>Delete</a></td>";

                  echo "</tr>";
                }
              }
              ?>

            </tbody>

          </table>

        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/footer.php";
  ?>