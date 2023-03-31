<?php

if (!empty($search)) {

    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published' ORDER BY post_id DESC LIMIT $current_page, $posts_per_page";

    $search_query = mysqli_query($connection, $query);
?>


    <div>
        <h1 class="page-header">Result for : <?= $search; ?></h1>
    </div>


    <?php
    if (!$search_query) {
        die("query failed" . mysqli_error($connection));
    }

    $count = mysqli_num_rows($search_query);

    if ($count === 0) {
        echo "<div class='no-result'><h3>No result try another keyword</h3></div>";
    } else {
        $count = ceil($count / $posts_per_page);
        while ($row = mysqli_fetch_assoc($search_query)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = substr($row['post_content'], 0, 100);

            $post_status = $row['post_status'];

            // $query = "SELECT * FROM posts WHERE post_status = 'published' ";
            // $search_published_posts = mysqli_query($connection, $query);

            if ($post_status === 'published') {
    ?>
                <div class="post">

                    <h2>
                        <a href="post.php?p_id=<?= $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
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
    }
} else {

    echo "<div class='no-result'><h3>We can't search into the void, please write something</h3></div>";
}
?>