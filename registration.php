<?php include "includes/header.php"; ?>

<body>
    <?php
    $message = "";

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
        $select_user_query = mysqli_query($connection, $query);
        if (!$select_user_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
        $row = mysqli_fetch_assoc($select_user_query);
        $db_username = isset($row['user_name']) ? isset($row['user_name']) : '';
        $db_user_email = isset($row['user_email']) ? isset($row['user_email']) : '';
        // $db_user_id = $row['user_id'];
        // $db_user_password = isset($row['user_password']);
        // $db_user_firstname = $row['user_firstname'];
        // $db_user_lastname = $row['user_lastname'];
        // $db_user_role = $row['user_role'];

        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        if (!empty($username) && !empty($email) && !empty($password)) {
            if (strlen($username) + 1  > 6) {
                if (strlen($password) > 10) {

                    if ($db_username) {
                        $message = "<div class='err-message'><p class='p-danger'>Username already taken</p></div>";
                    } else {
                        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

                        $query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
                        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber' )";
                        $register_user_query = mysqli_query($connection, $query);

                        if (!$register_user_query) {
                            die("QUERY FAILED" . mysqli_error($connection) . '' . mysqli_errno($connection));
                        }
                        $message = "<div class='succ-message'><p class='p-success'>Registration has been submitted.</p></div>";
                    }
                } else {
                    $message = "<div class='err-message'><p class='p-danger'>The password must be at least 10 characters in length.</p></div>";
                }
            } else {
                $message = "<div class='err-message'><p class='p-danger'>The username must be at least 6 characters in length.</p></div>";
            }
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
                                <h1>Register</h1>
                                <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                                    <?php echo $message; ?>
                                    <div class="form-group">
                                        <label for="username" class="sr-only">username</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="sr-only">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="sr-only">Password</label>
                                        <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                    </div>

                                    <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
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