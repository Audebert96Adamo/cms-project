<?php include "includes/header.php";
?>

<body class="home-body">
    <!-- Navigation -->
    <?php include "includes/navigation.php";
    ?>
    <div>
        <div class="img-home-cont">
            <div class="title-box">
                <h1>Cuisine et moi</h1>
                <p>le restaurant des petits et grand gourmand !</p>
            </div>
            <div class="slider">
                <div class="slides">
                    <div class="slide"><img src="./images/orange-cake-gef7a4ed25_1920.JPG" alt="First slide"></div>
                    <div class="slide"><img src="./images/lasagna-gbb81474ef_1920.JPG" alt=""></div>
                </div>
            </div>

        </div>

    </div>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

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


                if (isset($_POST['submit_search'])) {
                    $search =  $_POST['search'];
                    include "includes/search.php";
                } elseif (isset($_GET['submit_search'])) {
                    $search =  $_GET['submit_search'];
                    include "includes/search.php";
                }
                ?>

            </div>

        </div>

        <hr>

        <ul class="pager">
            <?php
            if (!empty($search)) {
                if (isset($_POST['submit_search']) or isset($_GET['submit_search'])) {

                    for ($i = 1; $i <= $count; $i++) {

                        if ((isset($_GET['submit_search'])) || isset($_POST['submit_search'])) {
                            if ($i == $page) {
                                echo  "<li><a class='active_link' href='index.php?submit_search={$search}&page={$i}'>{$i}</a></li>";
                            } else {
                                echo  "<li><a href='index.php?submit_search={$search}&page={$i}'>{$i}</a></li>";
                            }
                        } else {
                            if ($i == $page) {
                                echo  "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                            } else {
                                echo  "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                            }
                        }
                    }
                }
            }

            ?>
        </ul>

    </div>
    <!-- Footer -->
    <?php include "includes/footer.php";
    ?>