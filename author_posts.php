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
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
                $all_post_author = $_GET['author'];
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
            }

            $query_count = "SELECT * FROM posts WHERE post_author = '{$all_post_author}' AND post_status = 'published'";
            $find_count = mysqli_query($connection, $query_count);
            $count = mysqli_num_rows($find_count);
            $count = ceil($count / $posts_per_page);

            $query = "SELECT * FROM posts WHERE post_author = '{$all_post_author}' AND post_status = 'published' ORDER BY post_id DESC LIMIT $current_page, $posts_per_page";
            $select_posts_by_id = mysqli_query($connection, $query);


            if (isset($_POST['submit_search'])) {
                $search =  $_POST['search'];
                include "includes/search.php";
            } elseif (isset($_GET['submit_search'])) {
                $search =  $_GET['submit'];
                include "includes/search.php";
            } else {
            ?>
                <h1 class="page-header">
                    All posts by :
                    <small> <?php echo $all_post_author ?> </small>
                </h1>
                <?php
                while ($row = mysqli_fetch_assoc($select_posts_by_id)) {

                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $author_post_id = $row['post_id'];

                ?>
                    <div class="post">

                        <h2>
                            <a href="post.php?p_id=<?= $author_post_id ?>"> <?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <?php echo $post_author ?>
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

                ?>
                <!-- include "includes/sidebar.php";
                    ?> -->
        </div>
        <!-- <hr> -->
        <ul class="pager">
        <?php
                for ($i = 1; $i <= $count; $i++) {

                    if ((isset($_GET['submit_search'])) || isset($_POST['submit_search'])) {
                        if ($i == $page) {
                            echo  "<li><a class='active_link' href='author_posts.php?p_id={$post_id}&author={$all_post_author}&submit_search={$search}&page={$i}'>{$i}</a></li>";
                        } else {
                            echo  "<li><a href='author_posts.php?p_id={$post_id}&author={$all_post_author}&submit_search={$search}&page={$i}'>{$i}</a></li>";
                        }
                    } else {
                        if ($i == $page) {
                            echo  "<li><a class='active_link' href='author_posts.php?p_id={$post_id}&author={$all_post_author}&page={$i}'>{$i}</a></li>";
                        } else {
                            echo  "<li><a href='author_posts.php?p_id={$post_id}&author={$all_post_author}&page={$i}'>{$i}</a></li>";
                        }
                    }
                }
            }

        ?>

        </ul>
    </div>
    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php";
    ?>