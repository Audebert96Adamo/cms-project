 <!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   <!-- Brand and toggle get grouped for better mobile display -->
   <div class="navbar-header">
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
       <span class="sr-only">Toggle navigation</span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="index.php">Admin session</a>
   </div>

   <!-- Top Menu Items -->
   <ul class="nav navbar-right top-nav">
     <li><a href="#">Users online :
         <?= user_online() ?>
       </a></li>
     <li><a href="#">Visitor :
         <?php
          $visitor = all_online() - user_online();
          echo $visitor; ?>
       </a></li>

     <li><a href="../index.php">HOME SITE</a></li>

     <li class="dropdown show">
       <a href="#" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" role="button" id="dropdownMenuLink"><i class="fa fa-user"></i> <?= $_SESSION['username']; ?><b class="caret"></b></a>
       <ul class="dropdown-menu">
         <li>
           <a href="profile.php"><i class="dropdown-item fa fa-fw fa-user"></i> Profile</a>
         </li>
         <li class="divider"></li>
         <li>
           <a href="../includes/logout.php"><i class="dropdown-item fa fa-fw fa-power-off"></i> Log Out</a>
         </li>
       </ul>
     </li>
   </ul>

   <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
   <div class="collapse navbar-collapse navbar-ex1-collapse">
     <ul class="nav navbar-nav side-nav">
       <li>
         <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
       </li>
       <li>
         <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Post <i class="fa fa-fw fa-caret-down"></i></a>
         <ul id="posts_dropdown" class="collaps">
           <li>
             <a href="posts.php">View post</a>
           </li>
           <li>
             <a href="posts.php?source=add_post">Add post</a>
           </li>
         </ul>
       </li>

       <li>
         <a href="categories.php"><i class="fa fa-fw fa-wrench"></i>Categories</a>
       </li>


       </li>
       <li class="">
         <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
       </li>
       <li>
         <a href="javascript:;" data-toggle="collapse" data-target="#user_dropdown"><i class="fa fa-fw fa-arrows-v"></i>Users<i class="fa fa-fw fa-caret-down"></i></a>
         <ul id="user_dropdown" class="collapse">
           <li>
             <a href="users.php">View users</a>
           </li>
           <li>
             <a href="users.php?source=add_user">Add user</a>
           </li>
         </ul>
       </li>
     </ul>
   </div>


   <!-- /.navbar-collapse -->
 </nav>