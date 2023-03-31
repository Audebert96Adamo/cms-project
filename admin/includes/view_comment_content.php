<?php
if (isset($_GET['comment_edit_id'])) {
  $comment_id = $_GET['comment_edit_id'];
}

if (isset($_POST['edit_comment'])) {

  $comment_status = $_POST['comment_status'];

  $query =  "UPDATE comments SET comment_status = '$comment_status' WHERE comment_id = $comment_id ";

  $update_comment = mysqli_query($connection, $query);

  confirmQuery($update_comment);

  echo "<p class='bg-success'> comment status updated : " . " <a href='comments.php'>View all comments</a>";
}
$query = "SELECT * FROM comments WHERE comment_id = $comment_id ";
$select_comments = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_comments)) {

  $comment_author = $row['comment_author'];
  $comment_email = $row['comment_email'];
  $comment_content = $row['comment_content'];
  $comment_status = $row['comment_status'];

?>
  <form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <select name="comment_status" id="">
        <option value="<?php echo  $comment_status; ?>"><?php echo  $comment_status; ?></option>
        <?php
        if ($comment_status == 'pending') {
          echo "<option value='unapproved'>unapproved</option>";
          echo "<option value='approved'>approved</option>";
        } else  if ($comment_status == 'approved') {
          echo "<option value='unapproved'>unapproved</option>";
          echo "<option value='pending'>pending</option>";
        } else {
          echo "<option value='pending'>pending</option>";
          echo "<option value='approved'>approved</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label for="c_author">Author</label>
      <!-- <input type="hidden" class="form-control" value="<?= $comment_author; ?>" name="c_author"> -->
      <input type="text" class="form-control" value="<?= $comment_author; ?>" disabled="disabled">
    </div>

    <div class="form-group">
      <label for="c_email">Email</label>
      <!-- <input type="hidden" class="form-control" value="<?= $comment_email; ?>" name="c_author"> -->
      <input type="text" value="<?= $comment_email; ?>" class="form-control" name="c_email" disabled="disabled">

    </div>


    <div class="form-group">
      <label for="c_content">Comment</label>
      <div class="form-control" rows="3" disabled="disabled">
        <p><?= $comment_content; ?></p>
      </div>
      <button type="submit" name="edit_comment" class="btn btn-primary">
        submit
      </button>
  </form>

<?php

}

?>