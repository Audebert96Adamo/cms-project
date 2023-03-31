<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">CMS FRONT</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">
        <!-- <li><a href='index.php?source=view_posts'> Posts</a> </li>; -->

        <li class='dropdown show'>
          <a href='#' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' role='button' id='dropdownMenuLink'><i class="fa fa-utensils"></i> Miam <b class='caret'></b></a>
          <ul class='dropdown-menu'>

            <?php
            $query = "SELECT * FROM categories";
            $select_all_categories_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
              $cat_id = $row['cat_id'];
              $cat_title = $row['cat_title'];
              echo "<li><a href='category.php?category=$cat_id'> {$cat_title} </a> </li>";
            }
            ?>

          </ul>

        <li> <a href='contact.php'><span class='glyphicon glyphicon-envelope'> </span> Contact</a></li>
        </li>


        <?php
        if (isset($_SESSION['user_role'])) {
          if ($_SESSION['user_role'] === 'admin' && (isset($_GET['p_id']))) {
            $post_id = $_GET['p_id'];
            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit post</a></li>";
          } elseif ($_SESSION['user_role'] === 'editor' && (isset($_GET['p_id']))) {
            $post_id = $_GET['p_id'];
            echo "<li><a href='editor/posts.php?source=edit_post&p_id={$post_id}'>Edit post</a></li>";
          }
        }
        ?>
        <ul class="nav navbar-nav">

          <form action="" method="post" class="search-form">
            <div class="input-group search-bar">
              <input name="search" type="text" class="form-control">
              <span class="input-group-btn">
                <button name="submit_search" class="btn btn-default" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
          </form>

        </ul>
      </ul>

      <ul class="nav navbar-nav navbar-right">

        <?php
        if (!isset($_SESSION['user_role'])) {

          // echo  "<li> <a href='registration.php'>Registration</a></li>";
          echo "
    
          <li> <a href='registration.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
          
          <li class='dropdown show'>
                   <a href='#' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' role='button' id='dropdownMenuLink'><i class='glyphicon glyphicon-log-in'> </i>  Log in <b class='caret'></b></a>
                     <ul class='dropdown-menu drop-ul'>
                       <form action='includes/login.php' method='post' class='log-form'>

                       <div class='form-group'>
                       <div><p class='log-form'>Username :</p></div>
                         <li>
                           <input name='username' type='text' class='form-control' placeholder='Enter Username'>
                        </li>
                       </div>

                       <li>
                       <div class='form-group'>
                       <div><p class='log-form'>Password :</p></div>
                           <input name='password' type='password' class='form-control' placeholder='Enter Password'>
                         </div>
                       </li>
                      <li class='divider'></li>
                    
                      <li>
                        <div class='input-group'>
                         <span class='input-group-btn text-center'>
                           <button class='btn log-btn' name='login' type='submit'>
                            Submit
                           </button>
                         </span>
                        </div>
                      </li>
                   </form> 

                  </ul>
                </li>
           
                ";
        } else {

          echo "<li class='dropdown show'>
                <a href='#' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' role='button' id='dropdownMenuLink'><i class='fa fa-fw fa-user'></i> $_SESSION[username] <b class='caret'></b></a>
                <ul class='dropdown-menu'>";

          if ($_SESSION['user_role'] === 'admin') {
            echo  "<li><a href='admin'><i class='dropdown-item fa fa-fw fa-dashboard'></i> Admin</a></li>";
          } elseif ($_SESSION['user_role'] === 'editor') {
            echo  "<li><a href='editor/posts.php'><i class='dropdown-item fa fa-fw fa-dashboard'></i> Editor</a></li>";
          } elseif ($_SESSION['user_role'] === 'subscriber') {
            echo  "<li>
                    <a href='./user/index.php'><i class='dropdown-item fa fa-fw fa-user'></i> Profile</a>
                  </li>";
          }
          echo  "<li class='divider'></li>
                <li>
                <a href='includes/logout.php'><i class='dropdown-item fa fa-fw fa-power-off'></i> Log Out</a>
                </li>
                </ul>
                </li>";
        }

        ?>
      </ul>

      <!-- <li>
          <a href="admin">Contact</a>
        </li> -->

    </div>

    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>