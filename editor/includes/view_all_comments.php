<table class="table table-bordered table-hover">
  <h2>Pending Comments :</h2>

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

    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
    $select_comments = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_comments)) {

      $comment_id = $row['comment_id'];
      $comment_post_id = $row['comment_post_id'];
      $comment_author = $row['comment_author'];
      $comment_email = $row['comment_email'];
      $comment_content = $row['comment_content'];
      $comment_status = $row['comment_status'];
      $comment_date = $row['comment_date'];

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
      echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";

      echo "</tr>";
    }
    ?>

  </tbody>

</table>

<hr>

<table class="table table-bordered table-hover">
  <hr>
  <h2>Approved Comments :</h2>

  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>In response to</th>
      <th>Date</th>
      <th>Unaprove</th>
      <th>Delete</th>
    </tr>
  </thead>

  <tbody>

    <?php

    $query = "SELECT * FROM comments WHERE comment_status = 'approved' ";
    $select_comments = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_comments)) {

      $comment_id = $row['comment_id'];
      $comment_post_id = $row['comment_post_id'];
      $comment_author = $row['comment_author'];
      $comment_email = $row['comment_email'];
      $comment_content = $row['comment_content'];
      $comment_status = $row['comment_status'];
      $comment_date = $row['comment_date'];

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
      echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
      echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";

      echo "</tr>";
    }
    ?>

  </tbody>
</table>
<hr>