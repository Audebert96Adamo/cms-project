  <?php
  if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {

      $bulk_options = $_POST['bulk_options'];

      switch ($bulk_options) {
        case 'published':
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";

          $update_to_published_status = mysqli_query($connection, $query);
          confirmQuery($update_to_published_status);
          break;

        case 'draft':
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";

          $update_to_draft_status = mysqli_query($connection, $query);
          confirmQuery($update_to_draft_status);
          break;

        case 'delete':
          $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";

          $update_to_delete_status = mysqli_query($connection, $query);
          confirmQuery($update_to_delete_status);
          break;

        case 'clone':
          $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
          $select_posts_query = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_assoc($select_posts_query)) {

            $post_title = 'COPY OF : ' . $row['post_title'];
            $post_category = $row['post_category_id'];
            $post_author = $row['post_author'];
            $post_status = 'draft';
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
          }
          $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
          $query .= "VALUES('{$post_category}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ) ";

          $create_post_query = mysqli_query($connection, $query);
          break;

        default:
          # code...
          break;
      }
    }
  }
  ?>

  <form action="" method="post">

    <table class="table table-bordered table-hover">

      <div class="bulkContainer">
        <div id="bulkOptionContainer" class="col-xs-4">

          <select class="form-control" name="bulk_options" id="">
            <option value="">Select option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
          </select>

        </div>
        <div class="col-ss-4">
          <input type="submit" name="submit" class="btn btn-success" value="Apply">
          <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
      </div>

      <hr>
      <h3>Drafts post</h3>
      <hr>

      <thead class="thead-dark">
        <tr>
          <!-- <th><input id="selectAllBoxesDraft" type="checkbox"></th> -->
          <th>Select</th>
          <th>Id</th>
          <th>Author</th>
          <th>Title</th>
          <th>Category</th>
          <th>Status</th>
          <th>Image</th>
          <th>Tags</th>
          <th>Comments</th>
          <th>Dates</th>
          <th>View</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
        $select_posts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts)) {

          $post_id = $row['post_id'];
          $post_author = $row['post_author'];
          $post_title = $row['post_title'];
          $post_category = $row['post_category_id'];
          $post_status = $row['post_status'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_comment = $row['post_comment_count'];
          $post_date = $row['post_date'];

          echo "<tr>";
        ?>
          <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
        <?php
          echo "<td>$post_id</td>";
          echo "<td>$post_author</td>";
          echo "<td>$post_title</td>";

          $query = "SELECT * FROM categories WHERE cat_id = {$post_category} ";
          $select_categories = mysqli_query($connection, $query);
          confirmQuery($select_categories);

          while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_title = $row['cat_title'];
            echo "<td>$cat_title</td>";
          }
          echo "<td>$post_status</td>";
          echo "<td><img width='100'src='../images/$post_image'></td>";
          echo "<td>$post_tags</td>";

          $query_count = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
          $comment_count = mysqli_query($connection, $query_count);

          while ($raw = mysqli_fetch_array($comment_count)) {
            $comment_id = $raw['comment_id'];
          }
          $count = mysqli_num_rows($comment_count);

          echo "<td><a href='view_post_comments.php?id={$post_id}'>$count</a></td>";

          echo "<td>$post_date</td>";
          echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
          echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
          echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete this post ?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";

          echo "</tr>";
        }
        ?>

      </tbody>
    </table>

    <hr>

    <table class="table table-bordered table-hover">
      <h3>Published posts</h3>
      <hr>
      <thead>
        <tr>
          <!-- <th><input id="selectAllBoxes" type="checkbox"></th> -->
          <th>Select</th>
          <th>Id</th>
          <th>Author</th>
          <th>Title</th>
          <th>Category</th>
          <th>Status</th>
          <th>Image</th>
          <th>Tags</th>
          <th>Comments</th>
          <th>Dates</th>
          <th>View</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $query = "SELECT * FROM posts WHERE post_status = 'published' ";
        $select_posts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts)) {

          $post_id = $row['post_id'];
          $post_author = $row['post_author'];
          $post_title = $row['post_title'];
          $post_category = $row['post_category_id'];
          $post_status = $row['post_status'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_comment = $row['post_comment_count'];
          $post_date = $row['post_date'];

          echo "<tr>";
        ?>
          <td><input class='checkBoxesPub' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
        <?php

          echo "<td>$post_id</td>";
          echo "<td>$post_author</td>";
          echo "<td>$post_title</td>";

          $query = "SELECT * FROM categories WHERE cat_id = {$post_category}
      ";
          $select_categories = mysqli_query($connection, $query);
          confirmQuery($select_categories);

          while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_title = $row['cat_title'];
            echo "<td>$cat_title</td>";
          }

          echo "<td>$post_status</td>";
          echo "<td><img width='100'src='../images/$post_image'></td>";
          echo "<td>$post_tags</td>";

          $query_count = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
          $comment_count = mysqli_query($connection, $query_count);


          while ($raw = mysqli_fetch_array($comment_count)) {
            $comment_id = $raw['comment_id'];
          }
          $count = mysqli_num_rows($comment_count);

          echo "<td><a href='view_post_comments.php?id={$post_id}'>$count</a></td>";


          echo "<td>$post_date</td>";
          echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
          echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
          echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete this post ?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";

          echo "</tr>";
        }
        ?>

      </tbody>
    </table>
  </form>
  <hr>