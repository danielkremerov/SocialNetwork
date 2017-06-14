<?php session_start();
// Check if cookie exists, if not redirect to signup page
if (array_key_exists("usercookie", $_COOKIE)){
  //load page
} else {

  echo "<script>window.open('signup.php','_self')</script>";
}?>
<!DOCTYPE html>
<html>
<?php //necessary for every page to use session variable
include("functions/user_verification.php"); //includes privacy.php too
include("functions/friends_functions.php");


?>

<head>
    <meta charset="utf-8">
    <title>Social Network</title>
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
                   <b> <big>
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
                          <h1>Your Friends</h1>
                          <div class="row">
                            <form class="navbar-form navbar-left" action="friends.php" method="post">
                                <div class="form-group">
                                    <input type="text" name="searchInput" class="form-control" placeholder="Find Friends by Name" required>
                                </div>
                                <!-- Search button -->
                                <button type="submit" name="searchSubmit"class="btn btn-default"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </form>
                            </div>


                          </div>
                        <div class="col-sm-10">
                        <ul class="nav navbar-left">

                            <div class="container">




                        </ul>
                        </div>
                      </div>
                      <?php if(isset($_POST['searchSubmit'])){
                        $searchvar = $_POST['searchInput'];
                      }
                      ?>


            <?php showFriends($searchvar); ?>
                <!-- Can be put into function later (end)-->


                        <!-- loop that populates correct Number of Posts based on postNumber function -->
                       <?php foreach(array_keys($_SESSION["friendIDs"]) as $key) { ?>
                          <!-- start of one post -->

                          <div class="row">
                            <div class="col-sm-2">

                            </div>
                            <div class="col-sm-9"><b>
                              <a href="#"><h3><?php echo  $_SESSION["friendFirstName"][$key];?> <?php echo  $_SESSION["friendLastName"][$key];?> </h3></a>
                              <b>
                            </div>

                            <div class="col-sm-10">
                              <!-- blog Content based on displayBlogPost function -->
                              <?php
                          // about ?>
                            </div>
                            <div class="col-sm-10">
                            <ul class="nav navbar-left">
                              <li>
                                <form class="" action="friends.php" method="post">
                                  <span class="input-group-btn"><b>
                                    <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendIDs"][$key]; ?>" name="OpenFriendProfile">See Profile</button></b>
                                  </span>
                                </form>
                                <?php // delete friend
                                 if(isset($_POST['OpenFriendProfile'])){
                                   $FriendUserId = $_POST['OpenFriendProfile'];
                                  openProfile($FriendUserId);
                                 }
                                 ?>
                                 <form class="" action="friends.php" method="post">
                                   <span class="input-group-btn">
                                     <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendIDs"][$key]; ?>" name="OpenFriendBlog">OpenFriendBlog</button>
                                   </span>
                                 </form>
                                 <?php // delete friend
                                  if(isset($_POST['OpenFriendBlog'])){
                                    $FriendUserId = $_POST['OpenFriendBlog'];
                                   openFriendBlog($FriendUserId);
                                  }
                                  ?>

                                <form class="" action="friends.php" method="post">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendIDs"][$key]; ?>" name="DeleteFriend">Delete this friend</button>
                                  </span>
                                </form>


<style>
    button[type=submit] {
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










                                <?php // delete friend
                                 if(isset($_POST['DeleteFriend'])){
                                   $deleteFriendUserID = $_POST['DeleteFriend'];
                                   deleteFriend($deleteFriendUserID);
                                 }

                                 ?>
                                 <form class="" action="friends.php" method="post">
                                   <span class="input-group-btn">
                                     <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendIDs"][$key]; ?>" name="ShowFriendsAlbum">Show Photo Albums of your friend</button>
                                   </span>
                                 </form>
                                 <?php
                                  if(isset($_POST['ShowFriendsAlbum'])){
                                    $_SESSION['IDfriendalbums'] = $_POST['ShowFriendsAlbum'];
                                    echo "<script>window.open('friendsalbum.php','_self')</script>";

                                    //$FriendUserId = $_POST['OpenFriendProfile'];
                                   //openProfile($FriendUserId);
                                   unset($_POST['ShowFriendsAlbum']);
                                  }
                                  ?>


                                 <form class="" action="friends.php" method="post">
                                   <span class="input-group-btn">
                                     <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendIDs"][$key]; ?>" name="FriendsOfFriends">Show the Friends of your Friends</button>
                                   </span>
                                 </form>




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

                      <?php // delete friend
                       if(isset($_POST['FriendsOfFriends'])){
                         $FriendUserID = $_POST['FriendsOfFriends'];

                        ?>
                        <h3>Friends of Friends you are not Friends with!</h3>

                        <?php showFriendsofFriend($FriendUserID); ?>
                            <!-- Can be put into function later (end)-->


                                    <!-- loop that populates correct Number of Posts based on postNumber function -->
                                   <?php foreach(array_keys($_SESSION["friendofFriendID"]) as $key) { ?>
                                      <!-- start of one post -->

                                      <div class="row">
                                        <div class="col-sm-2">

                                        </div>
                                        <div class="col-sm-9">
                                          <a href="#"><?php echo  $_SESSION["firendofFiredFirstName"][$key];?> <?php echo  $_SESSION["friendofFriedLastName"][$key];?> </a>
                                        </div>

                                        <div class="col-sm-10">
                                          <!-- blog Content based on displayBlogPost function -->
                                          <?php
                                      // about ?>
                                        </div>
                                        <div class="col-sm-10">
                                        <ul class="nav navbar-left">
                                          <li>
                                            <form class="" action="friends.php" method="post">
                                              <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendofFriendID"][$key]; ?>" name="OpenFriendProfile">See Profile</button>
                                              </span>
                                            </form>
                                            <?php
                                             if(isset($_POST['OpenFriendProfile'])){
                                               $FriendUserId = $_POST['OpenFriendProfile'];
                                              openProfile($FriendUserId);
                                             }
                                             ?>
                                             <form class="" action="friends.php" method="post">
                                               <span class="input-group-btn">
                                                 <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendofFriendID"][$key]; ?>" name="sendRequest">Become Friends Now (send request)</button>
                                               </span>
                                             </form>
                                             <?php // delete friend
                                              if(isset($_POST['sendRequest'])){
                                                $receiverID = $_POST['sendRequest'];
                                                sendRequest($receiverID);
                                                unset($_POST['sendRequest']);
                                              }

                                              ?>


                                        </li>
                                          </p></li>
                                        </ul>
                                        </div>
                                      </div>

                                      <!-- end of one post -->

                                  <?php } ?>



                        <?php  } ?>

                        <h2>Open Friend Requests</h2>
                        <?php showFriendRequests(); ?>
                            <!-- Can be put into function later (end)-->


                                    <!-- loop that populates correct Number of Open FriendRequest that the logged in User has to accept -->
                                   <?php foreach(array_keys($_SESSION["friendIDsOpenRequest"]) as $key) { ?>
                                      <!-- start of one post -->

                                      <div class="row">
                                        <div class="col-sm-2">

                                        </div>
                                        <div class="col-sm-9">
                                          <a href="#"><?php echo  $_SESSION["friendFirstNameOpenRequest"][$key];?> <?php echo  $_SESSION["friendLastNameOpenRequest"][$key];?> </a>
                                        </div>

                                        <div class="col-sm-10">
                                          <!-- blog Content based on displayBlogPost function -->
                                          <?php
                                      // about ?>
                                        </div>
                                        <div class="col-sm-10">
                                        <ul class="nav navbar-left">
                                          <li>
                                            <form class="" action="friends.php" method="post">
                                              <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendIDsOpenRequest"][$key]; ?>" name="OpenFriendRequestProfile">See Profile</button>
                                              </span>
                                            </form>
                                            <?php
                                             if(isset($_POST['OpenFriendRequestProfile'])){
                                               $FriendUserId = $_POST['OpenFriendProfile'];
                                              openProfile($FriendUserId);
                                             }

                                             ?>

                                            <form class="" action="friends.php" method="post">
                                              <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendIDsOpenRequest"][$key]; ?>" name="AcceptRequest">Accept this Friendrequest</button>
                                              </span>
                                            </form>
                                            <?php // delete friend
                                             if(isset($_POST['AcceptRequest'])){
                                               $toAcceptedUserID = $_POST['AcceptRequest'];
                                               acceptFriendrequest($toAcceptedUserID);
                                             }

                                             ?>

                                        </li>
                                          </p></li>
                                        </ul>
                                        </div>
                                      </div>

                                      <!-- end of one post -->
                                      <?php } ?>
                                      <h2>Sent Friend Requests</h2>
                                      <?php showSentFriendRequests(); ?>
                                          <!-- Can be put into function later (end)-->


                                                  <!-- loop that populates correct Number of Open FriendRequest that the logged in User has to accept -->
                                                 <?php foreach(array_keys($_SESSION["friendIDsOpenRequest"]) as $key) { ?>
                                                    <!-- start of one post -->

                                                    <div class="row">
                                                      <div class="col-sm-2">


                                                      </div>
                                                      <div class="col-sm-9">
                                                        <a href="#"><?php echo  $_SESSION["friendFirstNameOpenRequest"][$key];?> <?php echo  $_SESSION["friendLastNameOpenRequest"][$key];?> </a>
                                                      </div>

                                                      <div class="col-sm-10">
                                                        <!-- blog Content based on displayBlogPost function -->
                                                        <?php
                                                    // about ?>
                                                      </div>
                                                      <div class="col-sm-10">
                                                      <ul class="nav navbar-left">
                                                        <li>
                                                          <form class="" action="friends.php" method="post">
                                                            <span class="input-group-btn">
                                                              <button class="btn btn-default" type="submit" value="<?php echo $_SESSION["friendIDsOpenRequest"][$key]; ?>" name="OpenFriendRequestProfile">See Profile</button>
                                                            </span>
                                                          </form>
                                                          <?php
                                                           if(isset($_POST['OpenFriendRequestProfile'])){
                                                             $FriendUserId = $_POST['OpenFriendProfile'];
                                                            openProfile($FriendUserId);
                                                           }

                                                           ?>
                                                           <!-- DELETE REQUEST BUTTON - NOT YET IMPLEMENTED
                                                          <form class="" action="friends.php" method="post">
                                                            <span class="input-group-btn">
                                                              <button class="btn btn-default" type="submit" value="<?php// echo $_SESSION["friendIDsOpenRequest"][$key]; ?>" name="AcceptRequest">Accept this Friendrequest</button>
                                                            </span>
                                                          </form>
                                                          -->
                                                          <?php // delete friend
                                                          /*
                                                           if(isset($_POST['AcceptRequest'])){
                                                             $toAcceptedUserID = $_POST['AcceptRequest'];
                                                             acceptFriendrequest($toAcceptedUserID);
                                                           }
                                                           */
                                                           ?>

                                                      </li>
                                                        </p></li>
                                                      </ul>
                                                      </div>
                                                    </div>

                                                    <!-- end of another post -->

                                  <?php } ?>






                </div>
            </div>
            <!-- Right column end -->
        </div>






</body>

</html>
