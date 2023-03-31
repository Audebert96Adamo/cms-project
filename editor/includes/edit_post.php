<?php
if (isset($_GET['p_id'])) {
  $post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = {$post_id}";
$select_posts_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {

  $post_id = $row['post_id'];
  $post_author = $row['post_author'];
  $post_title = $row['post_title'];
  $post_category = $row['post_category_id'];
  $post_status = $row['post_status'];
  $post_image = $row['post_image'];
  $post_content = $row['post_content'];
  $post_tags = $row['post_tags'];
  $post_comment = $row['post_comment_count'];
  $post_date = $row['post_date'];
}
if (isset($_POST['update_post'])) {
  $post_title = $_POST['title'];
  $post_category = $_POST['post_category'];
  $post_author = $_POST['author'];
  $post_status = $_POST['post_status'];
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];
  $post_tags = $_POST['post_tags'];
  $post_content = $_POST['post_content'];

  move_uploaded_file($post_image_temp, "../images/$post_image");

  if (empty($post_image)) {
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $select_image = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_image)) {
      $post_image = $row['post_image'];
    }
  }

  $query =  "UPDATE posts SET ";
  $query .= "post_title = '$post_title', ";
  $query .= "post_category_id = '$post_category', ";
  $query .= "post_date = now(), ";
  $query .= "post_author = '$post_author', ";
  $query .= "post_status = '$post_status', ";
  $query .= "post_tags = '$post_tags', ";
  $query .= "post_content = '$post_content', ";
  $query .= "post_image = '$post_image' ";
  $query .= "WHERE post_id = $post_id ";

  $update_post = mysqli_query($connection, $query);


  confirmQuery($update_post);
  // header('Location: posts.php');
  echo "<p class='bg-success'> Post updated : " . " <a href='../post.php?p_id={$post_id}'>View Post</a>" . " or " . "<a href='./posts.php'>Edit more posts</a>" . "</p>";
}
?>
<hr>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?= $post_title; ?>" type="text" class="form-control" name="title">
  </div>

  <div class="form-group">
    <label for="post_category">Post Category</label>
    <select name="post_category" id="">
      <?php
      $query = "SELECT * FROM categories WHERE cat_id = {$post_category} ";
      $select_categories = mysqli_query($connection, $query);
      confirmQuery($select_categories);

      while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        echo "<option value='$post_category'>current category : $cat_title</option>";
      }

      ?>
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
  <!-- <div class="form-group">
    <label for="post_category">Post Category</label>
    <input value=" $post_category; " type="text" class="form-control" name="post_category_id">
  </div> -->

  <!-- <div class="form-group">
    <label for="author">Post Author</label>
    <input value="<?= $post_author; ?>" type="text" class="form-control" name="author">
  </div> -->
  <div class="form-group">
    <label for="author">Post Author</label>
    <input type="hidden" class="form-control" value="<?= $post_author; ?>" name="author">
    <input type="text" class="form-control" value="<?= $post_author; ?>" disabled="disabled">
  </div>

  <label for="post_status">Post Status</label>
  <div class="form-group">

    <select name="post_status" id="">
      <option value="<?php echo  $post_status; ?>"><?php echo  $post_status; ?></option>

      <?php
      if ($post_status == 'draft') {
        echo "<option value='published'>published</option>";
      } else {
        echo "<option value='draft'>draft</option>";
      }
      ?>
    </select>

  </div>


  <label for="image">Image</label>
  <div class="form-group">
    <img width="100px" src="../images/<?php echo $post_image; ?>" alt="">
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo  $post_tags; ?>" type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control " name="post_content" id="summernote" cols="30" rows="10"><?php echo  $post_content; ?></textarea>
  </div>

  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_post" value="Update">
  </div>


</form>