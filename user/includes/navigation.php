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
     <a class="navbar-brand" href="index.php">User Profile</a>
   </div>


   <!-- Top Menu Items -->
   <ul class="nav navbar-right top-nav">
     <li><a href="../index.php">HOME SITE</a></li>


     <li class="dropdown show">
       <a href="#" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" role="button" id="dropdownMenuLink"><i class="fa fa-user"></i> <?= $_SESSION['username']; ?><b class="caret"></b></a>
       <ul class="dropdown-menu">
         <li>
           <a href="#"><i class="dropdown-item fa fa-fw fa-user"></i> Profile</a>
         </li>
         <li class="divider"></li>
         <li>
           <a href="../includes/logout.php"><i class="dropdown-item fa fa-fw fa-power-off"></i> Log Out</a>
         </li>
       </ul>
     </li>
   </ul>

   <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->


   <!-- /.navbar-collapse -->
 </nav>