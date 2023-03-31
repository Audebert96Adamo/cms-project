<?php include "includes/header.php";
?>

<body>
  <!-- Navigation -->
  <?php include "includes/navigation.php";
  ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <?php

      if (isset($_GET['category'])) {
        $post_category_id = $_GET['category'];
      }

      $query = "SELECT * FROM categories WHERE cat_id =  $post_category_id";
      $title_query = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($title_query)) {
        $cat_title = $row['cat_title'];
      }

      $query = "SELECT * FROM posts WHERE post_category_id =  $post_category_id AND post_status = 'published'";
      $search_query = mysqli_query($connection, $query);

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

      $count = mysqli_num_rows($search_query);
      $count = ceil($count / $posts_per_page);

      $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_category_id =  $post_category_id ORDER BY post_id DESC LIMIT $current_page, $posts_per_page";
      $search_query = mysqli_query($connection, $query);

      if (isset($_POST['submit_search'])) {
        $search =  $_POST['search'];
        include "includes/search.php";
      } elseif (isset($_GET['submit_search'])) {
        $search =  $_GET['submit'];
        include "includes/search.php";
      } else {
      ?>

        <div>
          <h1 class="page-header">Nos <?= $cat_title; ?></h1>
        </div>

        <?php
        while ($row = mysqli_fetch_assoc($search_query)) {
          $post_id = $row['post_id'];

          $post_title = $row['post_title'];
          $post_author = $row['post_author'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_content = substr($row['post_content'], 0, 100);

          $post_status = $row['post_status'];

          if ($post_status === 'published') {
        ?>
            <div class="post">

              <h2>
                <a href="post.php?p_id=<?= $post_id ?>"><?php echo $post_title ?></a>
              </h2>
              <p class="lead">
                by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
              </p>
              <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
              <hr>
              <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
              <hr>
              <p><?php echo $post_content ?></p>
              <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
              <hr>
            </div>
        <?php
          }
        }
        ?>

    </div>

    <hr>
    <ul class="pager">

    <?php
        for ($i = 1; $i <= $count; $i++) {

          if ((isset($_GET['submit'])) || isset($_POST['submit'])) {
            if ($i == $page) {
              echo  "<li><a class='active_link' href='category.php?category={$post_category_id}&submit_search={$search}&page={$i}'>{$i}</a></li>";
            } else {
              echo  "<li><a href='category.php?category={$post_category_id}&submit_search={$search}&page={$i}'>{$i}</a></li>";
            }
          } else {

            if ($i == $page) {
              echo  "<li><a class='active_link' href='category.php?category={$post_category_id}&page={$i}'>{$i}</a></li>";
            } else {
              echo  "<li><a href='category.php?category={$post_category_id}&page={$i}'>{$i}</a></li>";
            }
          }
        }
      }
    ?>

    </ul>
  </div>

  <?php include "includes/footer.php";
  ?>