<?php include "includes/header.php"; ?>

<body>
    <?php
    $message = " ";
    if (isset($_POST['submit'])) {
        $to = "adamo.audebert@gmail.com";
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        $email = $_POST['email'];
        $header = "From: " . $_POST['email'];
        if (!empty($email) && !empty($subject) && !empty($body)) {
            mail($to, $subject, $body, $header);
            $message = "<div class='succ-message'><p class='p-success'>Message submitted.</p></div>";
        } else {
            $message = "<div class='err-message'><p class='p-danger'>Please make sure all fields are filled in correctly.</p></div>";
        }
    }
    ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <?php
        if (isset($_POST['submit_search'])) {
            $search =  $_POST['search'];
            include "includes/all_posts.php";;
        } elseif (isset($_GET['submit_search'])) {
            $search =  $_GET['submit_search'];
            include "includes/all_posts.php";
        } else {
        ?>
            <section id="login">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-xs-offset-3">
                            <div class="form-wrap">
                                <h1>Send us a message</h1>
                                <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                                    <?php echo $message; ?>
                                    <?php
                                    if (!isset($_SESSION['user_role'])) {
                                    ?>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="hidden" class="form-control" value="<?= $_SESSION['user_email']; ?>" name="email" id="email">
                                            <input type="text" class="form-control" value="<?= $_SESSION['user_email']; ?>" disabled="disabled">
                                        </div>

                                    <?php

                                    }
                                    ?>

                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="body" id="body" cols="74" rows="10"></textarea>
                                    </div>

                                    <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
        ?>
        <hr>
        <?php include "includes/footer.php"; ?>