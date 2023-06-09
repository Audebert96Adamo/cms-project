<?php
if (isset($_POST['create_post'])) {
  $post_title = $_POST['title'];
  $post_author = $_POST['author'];
  $post_category = $_POST['post_category'];
  $post_status = $_POST['post_status'];

  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];

  $post_tags = $_POST['post_tags'];
  $post_content = $_POST['post_content'];
  $post_date = date('d-m-y');
  $post_comment_count = 0;

  move_uploaded_file($post_image_temp, "../images/$post_image");

  $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
  $query .= "VALUES('{$post_category}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}' ) ";

  $create_post_query = mysqli_query($connection, $query);

  confirmQuery($create_post_query);
  // header('Location: posts.php');
  $post_id = mysqli_insert_id($connection);
  echo "<p class='bg-success'> Post created : " . " <a href='../post.php?p_id={$post_id}'>View Post</a> " . "or " . "<a href='./posts.php'>View all Posts</a></p>";
}

?>
<hr>
<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
  </div>

  <div class="form-group">
    <label for="post_category">Post Category</label>
    <select name="post_category" id="">

      <?php

      $query = "SELECT * FROM categories";
      $select_categories_id = mysqli_query($connection, $query);
      confirmQuery($select_categories_id);


      while ($row = mysqli_fetch_assoc($select_categories_id)) {

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
        echo '<br>';
      }
      ?>

    </select>
  </div>

  <div class="form-group">
    <label for="author">Post Author</label>
    <input type="hidden" class="form-control" value="<?= $_SESSION['username']; ?>" name="author">
    <input type="text" class="form-control" value="<?= $_SESSION['username']; ?>" disabled="disabled">
  </div>
  <label for="post_status">Post Status</label>
  <div class="form-group">

    <select name="post_status" id="">
      <option value='draft'>draft</option>
      <option value='published'>published</option>
    </select>

  </div>

  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control " name="post_content" id="summernote" cols="30" rows="10"></textarea>
  </div>

  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
  </div>


</form>