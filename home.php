<?php session_start();
include("functions/user_verification.php"); //include php code
include("functions/blog_functions.php");
setcookie("usercookie",$_SESSION['loggedInUserID'], time() + 60 * 10 );
// Check if cookie exists, if not redirect to signup page
if (array_key_exists("usercookie", $_COOKIE)){
  //load page
} else {

  //recho "<script>window.open('signup.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>The Social Circle </title>
    <!-- Jquery always before bootstrap! -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Personal CSS Sheet-->
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>
    <nav class="navbar navbar-default HomepageHeader">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button><b>
                  <a class="navbar-brand" href="#" style="color:black">Welcome to the Social Circle</a>
            </div>
</b> </big>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                </ul>

                </ul>
                <form class="navbar-form navbar-left">
                    <!-- <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search Timeline">
                    </div> -->
                    <!-- Search button -->
                    <!-- <button type="submit" class="btn btn-default"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button> -->
                </form>
                <ul class="nav navbar-nav navbar-right" id="title">
                    <li>
                                             <b>    <big>  <big> <big>
                          <a class="navbar-brand" href="#" style="color:black">Welcome <?php echo $_SESSION['loggedInFirstName']; ?> &ensp;<?php  echo $_SESSION['loggedInLastName'];?></a>













</big></big></big>
</b>







                    </li>



                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
            </nav>
        <!-- start of main using bootstrap grip-->
        <div class="container">
            <!-- Left column start -->
            <div class="col-sm-2">
              <ul class="nav">
              <big>
              <b>
              <ul type="disc">
                <li role="presentation"><a href="home.php" style="color:black" >Blog</a></li>
            <p>
                <li role="presentation"><a href="personalprofile.php" style="color:black">Profile</a></li>
                <p>
                <li role="presentation"><a href="messages.php" style="color:black">Messages</a></li>
                <p>
                <li role="presentation"><a href="album.php" style="color:black" >My Photo Collections</a></li>
                <p>
                <li role="presentation"><a href="groups.php" style="color:black" >Circles of Friends</a></li>
                <p>
                <li role="presentation"><a href="friends.php" style="color:black">Friends</a></li>
                <p>
                <li role="presentation"><a href="findnewfriends.php" style="color:black">Find New Friends</a></li>
                <p>
                <li role="presentation"><a href="collaborate.php?func=creategroups" style="color:black">Find Collaborators</a></li>
                <p>
	              <li role="presentation"><a href="collaborate.php?func=listgroups" style="color:black">List Groups</a></li>
                <p>
                </ul>


                                             <p>
 <FORM METHOD="post" >


<input type="submit" value="Logout" name="logout">

</FORM>


<?php
                             if(isset($_POST['logout'])){


                                                // setcookie("usercookie","$_SESSION['loggedInUserID']", time() - 60 * 60);
                                               echo "<script>window.open('Signup.php','_self')</script>";
                                             }
?>



</big>
</b>
</ul>
            </div>
            <!-- Left column end -->
            <div class="col-sm-6">
                <!-- Middle column start -->
                <div class="panel panel-default">
                    <div class="panel-body">

                      <div class="row">
                        <div class="col-sm-2">                        </div>

                        <div class="col-sm-9">    </div>

                        <div class="col-sm-10">
                          <h2>My Blog</h2>
                          <form class="" action="home.php" method="post">
                            <input type="text" class="form-control" name="BlogPostBox" placeholder="Give your friends a nice read">
                            <b>
                            <button class="btn btn-default" type="submit" background-color= "#F05F40" color= black name="CreateBlogPost">Create Blog Post </button>
 </b>





                          </form>
                          <?php if(isset($_POST['CreateBlogPost'])){
                          $currentUser = $_SESSION['loggedInUserID'];
                          $blogPostContent = $_POST['BlogPostBox'];
                          insertBlogPost($currentUser,$blogPostContent);
                          } ?>


                          </div>
                        <div class="col-sm-10">
                        <ul class="nav navbar-left">
                          <li>   <form class="" action="home.php" method="post">
                            <div class="container">




                        </ul>
                        </div>
                      </div>

                  <?php if(isset($_POST['searchSubmit'])){

                    $condition = $_POST['searchInput'];
                  }
                  ?>

            <?php
            $loggedInUser = $_SESSION['loggedInUserID'];
            // $loggedInUser = 1;
            $$loggedInUserCaster = (int)$loggedInUser;


           setBlogPost($condition, $$loggedInUserCaster); ?>
                <!-- Can be put into function later (end)-->


                        <!-- loop that populates correct Number of Posts based on postNumber function -->
                      <?php foreach(array_keys($_SESSION["blogPostID"]) as $key) { ?>
                          <!-- start of one post -->

                          <div class="row">
                               <b>
                            <div class="col-sm-9">
                              <a href="#"><?php echo  $_SESSION["blogFirstName"][$key];?> <?php echo  $_SESSION["blogLastName"][$key];?> posted on</a>
                              <a href="#"><?php echo $_SESSION["timestamp"][$key]; ?></a> <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                            </div>
<b>
                            <div class="col-sm-10">
                              <!-- blog Content based on displayBlogPost function -->

                              <big><b>
                              <?php


                           echo $_SESSION["blogContent"][$key]; ?>

   </big></b>

                            </div>
                            <div class="col-sm-10">
                            <ul class="nav navbar-left">
                              <li><a href="#"><?php echo $_SESSION["NumberOfLikes"][$key]; ?> <span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a></li>
                              <li>


                              <form class="" action="home.php" method="post">
                                <span class="input-group-btn">
                                 <b>
                                  <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["blogPostID"][$key]; ?>" name="LikeButton">Like it!</button>
                                   </b>

                                   <b>
                                    <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["blogPostID"][$key]; ?>" name="ShowComment">Show Comments</button> </b>
                                </span>

                                </form>



 <?php // like stuff start
                                 if(isset($_POST['LikeButton'])){
                                   $loggedInUser = $_SESSION['loggedInUserID']; //later take from somewhere else
                                   $currentPost = $_POST['LikeButton'];
                                   likePost($loggedInUser,$currentPost);
                                   } // like stuff end
                                 ?>





                            </li>
                              </p></li>
                            </ul>
                            </div>
                          </div>

                          <!-- end of one post -->

                      <?php } ?>




                    </div>
                </div>
            </div>
            <!-- Middle column end -->
            <div class="col-sm-4">
                <!-- Right column start -->
                <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="row">
                        <form class="navbar-form navbar-left" action="home.php" method="post">
                            <div class="form-group">
                                <input type="text" width=100% name="searchInput" class="form-control" placeholder="Search by content" required>
                            </div>
                            <!-- Search button -->
                            <button type="submit" name="searchSubmit"class="btn btn-default"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </form>
                      </div>





                      <?php // like stuff start
                      $currentPost = $_POST['ShowComment'];
                      $GLOBALS['c'] = $currentPost;
                       if(isset($_POST['ShowComment'])){
                         //$currentPost = $_POST['ShowComment'];
                        showComments($currentPost); ?>
<form class="" action="home.php" method="post">
  <input type="text" class="form-control" name="CommentBox" placeholder="New Comment">
  <button class="btn btn-default" value="<?php echo $GLOBALS['c']; ?>"type="submit" name="SubmitComment">Submit</button>
</form>
<?php } ?>
<?php if(isset($_POST['SubmitComment'])){
$currentPost = $_POST['SubmitComment'];
$currentUser = $_SESSION['loggedInUserID'];
$commentContent = $_POST['CommentBox'];
insertComment($currentPost,$currentUser,$commentContent);
} ?>




<?php   ?>
                    </div>
                </div>
            </div>
            <!-- Right column end -->
        </div>


<style>
    input[type=submit] {
    width: 100%;
    background-color: #F05F40;
    color: black;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

 button[type=submit] {
    width: 60%;
    background-color: #F05F40;
    color: black;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>



</body>

</html>
