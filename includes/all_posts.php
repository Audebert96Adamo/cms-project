<!-- <div class="row">

  <div>

    <?php
    $posts_per_page = 3;
    $search = "";

    if (isset($_GET['page'])) {
      $page = $_GET['page'];
    } else {
      $page = "";
    }

    if ($page == "" || $page == 1) {
      $current_page = 0;
    } else {
      $current_page = ($page * $posts_per_page) - $posts_per_page;
    }

    $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
    $find_count = mysqli_query($connection, $post_query_count);

    $count = mysqli_num_rows($find_count);
    $count = ceil($count / $posts_per_page);

    $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $current_page, $posts_per_page";
    $search_query = mysqli_query($connection, $query);

    if (isset($_POST['submit_search'])) {
      $search =  $_POST['search'];
      include "includes/search.php";
    } elseif (isset($_GET['submit_search'])) {
      $search =  $_GET['submit_search'];
      include "includes/search.php";
    } else {
      while ($row = mysqli_fetch_assoc($search_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 100);
        $post_status = $row['post_status'];


    ?>
        <div class="post">
          <h2>
            <a href="post.php?p_id=<?= $post_id ?>"> <?php echo $post_title ?></a>
          </h2>
          <p class="lead">
            by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
          </p>
          <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
          <hr>

          <!-- <a href="post.php?p_id=<?= $post_id ?>"> -->
<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
<!-- </a> -->

<hr>
<div class="content">
  <?php echo $post_content ?>
</div>
<div>
  <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<hr>
</div>
<?php
      }




?>

</div>

</div>

<hr>

<ul class="pager">
<?php
      for ($i = 1; $i <= $count; $i++) {

        if ((isset($_GET['submit'])) || isset($_POST['submit'])) {
          if ($i == $page) {
            echo  "<li><a class='active_link' href='index.php?source=view_posts&submit_search={$search}&page={$i}'>{$i}</a></li>";
          } else {
            echo  "<li><a href='index.php?source=view_posts&submit_search={$search}&page={$i}'>{$i}</a></li>";
          }
        } else {
          if ($i == $page) {
            echo  "<li><a class='active_link' href='index.php?source=view_posts&page={$i}'>{$i}</a></li>";
          } else {
            echo  "<li><a href='index.php?source=view_posts&page={$i}'>{$i}</a></li>";
          }
        }
      }
    }
?>
</ul> -->