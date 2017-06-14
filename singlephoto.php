<!DOCTYPE html>
<html>
<?php session_start(); //necessary for every page to use session variable?>
<?php include("functions/photo_functions.php"); ?>
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
            <div class="col-sm-8">
                <!-- Middle column start -->

<!-- <FORM METHOD="LINK" ACTION="profile.php">
<INPUT TYPE="submit" VALUE="PROFILE PAGE">
</FORM>

<FORM METHOD="LINK" ACTION="profile_amend.php">
<INPUT TYPE="submit" VALUE="EDIT PROFILE PAGE">
</FORM> -->

                <div class="panel panel-default">
                    <div class="panel-body">

<html>
 <head>
 </head>
 <body>





<?php $albumID = $_SESSION["passAlbumID"];
//echo $albumID; ?>
<?php setPhotos($albumID); ?>








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
</style>



</body>
</html>

                    </div>
                </div>
            </div>

        </div>







</body>

</html>
