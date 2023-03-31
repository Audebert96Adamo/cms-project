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
            }
            $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
            $select_posts_by_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_posts_by_id)) {

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

            ?>
                <div class="post">

                    <h1>
                        <?php echo $post_title ?>
                    </h1>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <div class="content">
                        <?php echo $post_content ?>
                    </div>
                </div>

                <hr>
            <?php
            }

            ?>

            <?php
            if (isset($_POST['create_comment'])) {
                $post_id = $_GET['p_id'];
                $comment_author = $_POST['c_author'];
                $comment_email = $_POST['c_email'];
                $comment_content = $_POST['c_content'];
                $comment_content = mysqli_real_escape_string($connection, $comment_content);

                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                    $query .= "VALUES ('{$post_id}','{$comment_author}','{$comment_email}','{$comment_content}','pending',now() ) ";

                    $create_comment_query = mysqli_query($connection, $query);
                    confirmQuery($create_comment_query);

                    redirect("post.php?p_id=$post_id");
                } else {
                    echo "<script>alert('Fields cannot be empty ! Please complete all required fields. ')</script>";
                }
            }
            ?>
            <?php
            if (!isset($_SESSION['user_role'])) {

            ?>
                <div class="row">
                    <div class='col-md-8 col-sm-offset-2 text-center'>
                        <div class='well'>
                            <p> Log in to use the comment section </p>
                        </div>
                    </div>
                </div>
            <?php

            } else {
            ?>
                <div class="row">
                    <div class="col-md-8 col-sm-offset-2 text-center">
                        <div class="well">

                            <h4>Leave a Comment:</h4>
                            <form action="post.php?p_id=<?= $post_id ?>" method="post" role="form">

                                <div class="form-group">
                                    <label for="c_author">Author</label>
                                    <input type="hidden" class="form-control" value="<?= $_SESSION['username']; ?>" name="c_author">
                                    <input type="text" class="form-control" value="<?= $_SESSION['username']; ?>" disabled="disabled">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" value="<?= $_SESSION['user_email']; ?>" class="form-control" name="c_email">
                                </div>

                                <div class="form-group">
                                    <label for="comment">Your comment</label>
                                    <textarea class="form-control" name="c_content" rows="3"></textarea>
                                </div>
                                <button type="submit" name="create_comment" class="btn btn-primary">
                                    submit
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

            <!-- Posted Comments -->
            <div class="comment-post">
                <hr>

                <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";

                $select_comment_query = mysqli_query($connection, $query);
                confirmQuery($select_comment_query);

                while ($row = mysqli_fetch_array($select_comment_query)) {
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                ?>

                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?= $comment_author; ?>
                                <small><?= $comment_date; ?></small>
                            </h4>
                            <p>
                                <?= $comment_content; ?>
                            </p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include "includes/footer.php";
    ?>