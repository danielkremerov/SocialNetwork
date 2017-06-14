<?php session_start(); //necessary for every page to use session variable
include("functions/user_verification.php"); //include php code
// Check if cookie exists, if not redirect to signup page
if (array_key_exists("usercookie", $_COOKIE)){
  //load page
} else {

  echo "<script>window.open('signup.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html>


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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button><b>  
                              <a class="navbar-brand" href="#" style="color:black">Welcome to the Social Circle</a>
            </div>
 </big>
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
                                           
                          <a class="navbar-brand" href="#" style="color:black">Welcome <?php echo $_SESSION['loggedInFirstName']; ?> &ensp;<?php  echo $_SESSION['loggedInLastName'];?></a>
                         

                           











<style>

    
    background-color: #F05F40;
    color: black;
    

</style>






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
            <!-- Left column end -->
            <div class="col-sm-6">
                <!-- Middle column start -->


                <div class="panel panel-default">
                    <div class="panel-body">

<?php
$switch=0;
// $_SESSION['group_selected']=0;
if ($_SESSION['group_selected'] >0){
   $groupname =  $_SESSION['group_name_selected'];
$group = $_SESSION['group_selected'];
// echo 'group is';
// echo $group;

?>

                        <h1> My Messages - <?php  echo $groupname ?> </h1>

                      <form class="" action="messages.php" method="post">
                        <div class="input-group">
                              <input type="text" class="form-control" name="message" placeholder="Enter Message">
                             <!--  <input type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">Send it!</button>
                              </span>
                            </div><!-- /input-group -->
                      </form>

                      <?php
                      $db = mysqli_connect("localhost","root","root","social_network") or die ("Connection failed");
                      if(isset($_POST['submit'])){
                      $id = $_SESSION['loggedInUserID'];
                      $message = $_POST['message'];
                      $group = $_SESSION['group_selected'];
                      // echo 'group is';
                      // echo $group;

                      $query_insert = "INSERT INTO messages(groupID, messageContent, userID) VALUES ('$group', '$message', '$id') ";
                      $result = mysqli_query($db, $query_insert);}
                       ?>

                        <!-- loop that populates correct Number of Posts based on postNumber function -->
<?php $link = mysqli_connect("localhost","root","root","social_network") or die ("Connection failed");   ?>

<?php
// echo $group;
$query = "SELECT * FROM messages, user WHERE groupID= '$group' && messages.userID=user.userID ORDER BY id DESC"; //most recent messages first
$result = mysqli_query($link, $query) or die('Error querying database.');
$array = array(); ?>

<?php   while($row = mysqli_fetch_array($result)){
   ?>                          <!-- start of one message -->

                          <div class="row">
                            <div class="col-sm-2">
                                <a href="#"><img src="images/profile.png"></a> <!-- dummy photo -->
                            </div>
                            <div class="col-sm-9">
                              <a href="#"><?php echo  $array[] = $row['firstName']; ?></a>
                              <?php echo  ' ' ?>
                              <a href="#"><?php echo  $array[] = $row['lastName']; ?></a>
                            <p>
                              <a href="#"><?php echo  $array[] = $row['timestamp'];?></a> <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                            </div>

                            <div class="col-sm-10">
                              <!-- blog Content based on displayBlogPost function -->
                            <?php echo  $array[] = $row['messageContent']; ?>
                            </div>
                            <div class="col-sm-10">
                            <ul class="nav navbar-left">
                            </ul>
                            </div>
                          </div>

                          <!-- end of one post -->
                      <?php } ?>

 <?php }

else {
// else if group selected is set to 0, show blank messages page
 ?>

 <h1> My Messages  </h1>
<strong> Select a group >> <strong>
<p>
<strong> If no groups appear, create one!<strong>

 <?php }

  ?>
                    </div>
                </div>
            </div>
            <!-- Middle column end -->
            <div class="col-sm-4">
                <!-- Right column start -->
                <div class="panel panel-default">
                    <div class="panel-body">
                   <!--  side panel showing the groups the user is in (if any) -->
 <h1>My Groups</h1>
<?php
// Justs sets the local db connection up
 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
?>

<?php

// Sets the session variable for user to
$this_session_user = $_SESSION['loggedInUserID'];

// This query that uses aggregate function to get no of user id in the list of groups
$query = "SELECT MAX(groupID) AS count FROM groups ";
mysqli_query($db, $query) or die('Error querying database.');

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

// Variable with value max we need
$count_my_groups = $row["count"];
//
// echo $count_my_groups;
//Step 4
mysqli_close($db);
?>

<?php
// Justs sets the local db connection up
 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
?>

<?php
// For (actually while) loop between 1 : no of users to print out members of the group
$i=1;
while ($i<=$count_my_groups):?>

<form name="X"  method="POST">
         <!-- <input type="text" name="trekking" > -->

<?php

//This query fetches all data from the user table based on the user id (the loop $i)
$query = "SELECT * FROM groups WHERE groups.UserID=$this_session_user && groups.groupID=$i";
mysqli_query($db, $query) or die('Error querying database.');
$rows = array();
$userID = $row['userID'];

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

$group_userID= $row["userID"];

if($group_userID == $this_session_user){

$friendID = $row['userID'];

echo $row["groupName"];

?>

   <input class = "select" type="submit" id=kk name= Select_<?php echo $row['groupID']; ?> value=Select<?php echo  $row['']; ?> >

</form>

<?php

}
?>

<?php $i=$i+1;

   endwhile;

?>

<?php

for ($groupid=1 ; $groupid<=$count_my_groups ; $groupid++) {

if(isset($_POST['Select_' . $groupid])){

$_SESSION['group_selected'] = $groupid;

$query_find_group_name = "SELECT * FROM groups WHERE groups.groupID=$groupid";
mysqli_query($db, $query_find_group_name) or die('Error querying database to find group name.');
$rows = array();

$result = mysqli_query($db, $query_find_group_name);
$row = mysqli_fetch_array($result);

$_SESSION['group_name_selected']= $row["groupName"];

header("Refresh:0");
echo "<script>window.open('messages.php','_self')</script>";
}
}

?>

<style>
    input[type=submit] {
    width: 50%;
    background-color: #F05F40;
    color: black;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
<style>


                    </div>
                </div>
            </div>
            <!-- Right column end -->
        </div>






</body>

</html>
