<?php session_start();  ?>
<!DOCTYPE html>
<html>
<?php //necessary for every page to use session variable
include("functions/user_verification.php");
include("functions/photo_functions.php");
?>

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

                        <div class="col-sm-9">
                        <div class="row">
                            <form class="" action="album.php" method="post">
                                <p>Photo Collection Title: <input type="text" name="albumTItle" placeholder="Enter title"></p>
                                <p>Photo Collection Decription: <input type="text" name="albumDescription" placeholder="Enter description" /></p>
                                <button class="btn btn-default" type="submit" name="createAlbum">create Album</button>
                              </form>

                              <?php
                              if(isset($_POST['createAlbum'])){
                                $title =  $_POST['albumTItle'];
                                $description =  $_POST['albumDescription'];
                                $loggedInUserID = $_SESSION['loggedInUserID'];
                                $castloggedInUserID = (int)$loggedInUserID;
                                createAlbum($castloggedInUserID,$title,$description);
                                unset($_POST['showPhotos']);
                             }
                               ?>
                        </div>
                      </div>

                        <div class="col-sm-10">
                          <h2>Select an album to view the photos!</h2>

                <?php
                  $loggedInUserID = $_SESSION['loggedInUserID'];
                  $castloggedInUserID = (int)$loggedInUserID;
                  setAlbums($castloggedInUserID);
                  ?>
                <!-- Can be put into function later (end)-->


                        <!-- loop that populates correct Number of Posts based on postNumber function -->
                      <?php foreach(array_keys($_SESSION["albumID"]) as $key) { ?>
                          <!-- start of one post -->



                            <div class="container">
                                <div class="jumbotron">
                                  <h1><?php echo  $_SESSION["albumtitle"][$key];?></h1>
                                  <p>Owner:<?php echo $_SESSION["albumfirstName"][$key]; ?> <?php echo $_SESSION["albumlastName"][$key]; ?></p>
                                  <p>Description:<?php echo $_SESSION["albumdescription"][$key]; ?></p>
                                  <form class="" action="album.php" method="post">
                                    <button class="btn btn-default" value="<?php echo  $_SESSION["albumID"][$key]; ?>" type="submit" name="showPhotos">Show Photos</button>
                                  </form>
                                  <?php
                                    if(isset($_POST['showPhotos'])){
                                        $_SESSION["passAlbumID"] = $_POST['showPhotos'];
                                        echo "<script>window.open('singlephoto.php','_self')</script>";
                                        unset($_POST['showPhotos']);
                                   }
                                   ?>

                                   <form action="album.php" enctype="multipart/form-data" method="post">

                                     <table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5">
                                     <tbody><tr><td>
                                       <input name="uploadedimage" type="file">
                                     </td></tr>

                                     <tr><td>
                                       <button class="btn btn-default" type="submit" value="<?php echo  $_SESSION["albumID"][$key]; ?>" name="uploadimage">Upload Image</button>
                                     </td></tr>
                                     </tbody></table>
                                   </form>

                                   <form class="" action="album.php" method="post">

                                    <label for="country">Privacy</label>
                                        <select id="country" name="pri">
                                          <option value="global">Global</option>
                                          <option value="friends">Friends</option>
                                          <option value="friendsoffriends">Friends of friends</option>
                                          <option value="circles">Circles of friends</option>
                                          <option value="private">Private</option>
                                        </select>
                                     <button class="btn btn-default" type="submit" value="<?php echo  $_SESSION["albumID"][$key]; ?>" name="changeprivacy">Change Privacy</button>
                                   </form>
                                   <?php
                                   if(isset($_POST['changeprivacy'])){
                                     $privacylevel =  $_POST['privacylevel'];
                                     $albumID =$_POST['changeprivacy'];
                                     changeAlbumPrivacy($albumID, $privacylevel);
                                     unset($_POST['changeprivacy']);
                                   }
                                    ?>

                                   <?php
                                   if(isset($_POST['uploadimage'])){
                                     $albumID =$_POST['uploadimage'];
                                     uploadPhoto($albumID);
                                     unset($_POST['uploadimage']);
                                   }
                                   ?>
                                </div> <!-- END OF JUMBOTRON -->
                                <?php //currentUser = $_SESSION['loggedInUserID']; ?>


                                </div>
                          <!-- end of one post -->
                      <?php  } ?>

            <!-- Middle column end -->
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
.jumbotron{
  width: 42%;
}
</style>


</body>

</html>
