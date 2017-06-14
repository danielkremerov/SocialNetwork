<?php session_start(); //necessary for every page to use session variable
// Check if cookie exists, if not redirect to signup page
if (array_key_exists("usercookie", $_COOKIE)){
  //load page
} else {

  echo "<script>window.open('signup.php','_self')</script>";
}?>
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
          </button> <b>
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
                                            <b>     <big>  <big> <big>
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


                <div class="panel panel-default">
                    <div class="panel-body">

<html>
 <head>
 </head>
 <body>

<!-- Start of code for viewing and deleting groups -->
 <h1>Circles of Friends</h1>

<?php
// Justs sets the local db connection up
 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
?>

<?php
// Sets the session variable user to to whoever logged in
$this_session_user = $_SESSION['loggedInUserID'];

// This query that uses aggregate function to get no of user id in the list of groups
$query = "SELECT MAX(groupID) AS count FROM groups ";
mysqli_query($db, $query) or die('Error querying database.');

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

// Variable with value max we need
// will be very useful for the loops
$count_my_groups = $row["count"];

mysqli_close($db);
?>

<?php
// Justs sets the local db connection up
 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
?>

<?php
// This query that uses aggregate function to get no of user id in the list of groups
$query_max_userID = "SELECT MAX(userID) AS count_users FROM user ";
mysqli_query($db, $query_max_userID) or die('Error querying database.');

$result = mysqli_query($db, $query_max_userID);
$row = mysqli_fetch_array($result);

// Variable with value max we need
$count_my_users = $row["count_users"];

// echo $count_my_users;
mysqli_close($db);
?>

<form method="post">
<p>Group Name: <input type="text" name="create_group_field"  />
<input type="submit" name="submit_create_group" value="Create Group" onclick=""  /></p>

<?php

//a function to create a new group (circle of friends)
function create_group(){
$firstname_post = $_POST['create_group_field'];

// Justs sets the local db connection up
 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');

$this_session_user = $_SESSION['loggedInUserID'];

// query finds the maximum groupID as we need to know what the new groupID will be (+1)
$query_create_group = "SELECT MAX(groupID) AS max_group_no FROM groups";

mysqli_query($db, $query_create_group) or die('Error querying database.');

$result_groups = mysqli_query($db, $query_create_group);
$row_max_group_no = mysqli_fetch_array($result_groups);
$max_group_no = $row_max_group_no['max_group_no'];

//increment to set the max group no to the newly created group
$max_group_no++;

//query creates a new group with userid as logged in id, a new groupID and a group nam based on the textfield input
$query_create_group = "INSERT INTO groups(groupName, userID, groupID) VALUES ('$firstname_post', '$this_session_user', '$max_group_no') ";

mysqli_query($db, $query_create_group) or die('Error querying database to create a new group.');

// at the same time, a group welcome message is created into the messages table
$query_group_message = "INSERT INTO messages(messageContent, userID, groupID) VALUES ('Welcome to my group chat!', '$this_session_user', '$max_group_no') ";

mysqli_query($db, $query_group_message) or die('Error querying database to create new group message.');


  echo "<script>window.open('groups.php','_self')</script>";
}

//if the button for is create is pressed, process the function create_group
if(isset($_POST['submit_create_group'])){

create_group();

// refresh page to show the new group on the page
header("Refresh:0");

}

mysqli_close($db);
?>

<?php
// Justs sets the local db connection up
 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
?>

<div class="col-sm-10">

<?php
// For (actually while) loop between 1 to no of users to print out friends
$i=1;
while ($i<=$count_my_groups):?>

<form name="X"  method="POST">
         <!-- <input type="text" name="trekking" > -->

<?php
//NOTE ALL CODE IN THIS SECTION IS A COPY FROM FRIENDS PHP FILE!!!
$this_session = $_SESSION['loggedInUserID'];
//This query fetches all data from the user table based on the user id (the loop $i)
$query = "SELECT * FROM groups WHERE groups.UserID=$this_session_user && groups.groupID=$i";
mysqli_query($db, $query) or die('Error querying database.');
$rows = array();
$userID = $row['userID'];

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

$group_userID= $row["userID"];

//If the users id is in the groups table for the selected group then echo out the group name and the view and add buttons
if($group_userID == $this_session_user){

 $friendID = $row['userID'];

 ?> <h3><?php echo $row["groupName"]; ?> </h3>



   <input type="submit" name= View_Group_<?php echo $row['groupID']; ?> value='View Group'<?php echo  $row['']; ?> >
     <input type="submit" name= Delete_Group_<?php echo $row['groupID']; ?> value='Delete Group'<?php echo  $row['']; ?> >

</form>

<?php
//end of if loop
}
?>


<?php $i=$i+1;

   endwhile;
//end of while loop
?>
<div>
<?php
function delete_friend(){

//delete group function that deletes all group data from groups table and messages table
$db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
 $this_group = $_SESSION['group'];

$query_delete_group = "DELETE FROM `groups` WHERE groupID= $this_group";

mysqli_query($db, $query_delete_group) or die('Error querying database.');

$query_delete_group_messages = "DELETE FROM `messages` WHERE groupID= $this_group";

mysqli_query($db, $query_delete_group_messages) or die('Error querying database.');

mysqli_close($db);
$_SESSION['group_selected']=0;

header("Refresh:0");
//refresh page to show group has been deleted
echo "<script>window.open('groups.php','_self')</script>";
}


function view_group(){
?>
     <h1>Group Members</h1>
<?php

// echo'test222';
$db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');

$this_group = $_SESSION['group_view'];

//counts how many group members there are in selected group
$query_group_members = "SELECT MAX(userID) AS count_group_members FROM groups WHERE groups.groupID=$this_group";

mysqli_query($db, $query_group_members) or die('Error querying database for $query_group_members .');

$result = mysqli_query($db, $query_group_members);
$row = mysqli_fetch_array($result);

// Variable with value max we need
$count_my_members = $row["count_group_members"];
// echo 'this many members in group';
// echo $count_my_members;

?>

<?php
// For (actually while) loop between 1 to no of users to print out friends
$j=1;
while ($j<=$count_my_members):?>

<?php
// echo 'j is';
// echo $j;
$this_group = $_SESSION['group_view'];
// echo 'group is';
// echo $this_group;


$query_view_group = "SELECT * FROM groups WHERE groups.UserID=$j && groups.groupID=$this_group";
 //
// echo 'user id query';
// echo $j;
// echo $this_group;



mysqli_query($db, $query_view_group) or die('Error querying database 2.');

$result = mysqli_query($db, $query_view_group);
$row = mysqli_fetch_array($result);

$group_userID = $row["userID"];
// echo 'user id is';
// echo $group_userID;

$query_view_name = "SELECT * FROM user WHERE user.UserID=$group_userID ";
$result = mysqli_query($db, $query_view_name);
$row = mysqli_fetch_array($result);

$group_user_name = $row["firstName"];

$group_user_last_name = $row["lastName"];


// echo $group_user_name;
// echo ' ';
// echo $group_user_last_name;

if (empty($group_user_name)){

    }
        else{

 echo 'First Name:' . ' ' . $group_user_name .'<br />';

 echo 'Last Name:' . ' ' . $group_user_last_name . '<br />';
}



?>
</p>
<?php
// echo 'testing';
// echo $group_user_name;
if (empty($group_user_name)){

    }
        else{
    ?>

<form name="X"  method="POST">
<input type="submit" name= Remove_User_<?php echo $row['userID']; ?> value=Remove >
    </form>
<?php
}
?>

<?php $j=$j+1;

   endwhile;
   mysqli_close($db);
   ?>

<h1>Add Members</h1>

<?php
// Justs sets the local db connection up
 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
?>

<?php

// Sets the session variable user to 1 (temporary, in reality will be fetched from signup.php page!!!)
$_SESSION['user'] = '1';
$this_session_user = $_SESSION['user'];

// This query that uses aggregate function to get max user id in the list of user table
$query = "SELECT MAX(userID) AS max_value FROM user";
mysqli_query($db, $query) or die('Error querying database.');
$userID = $row['userID'];

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

// Variable with value max we need
$no_of_users = $row["max_value"];
// echo $no_of_users;

//Step 4
mysqli_close($db);
?>

<?php
// Justs sets the local db connection up
 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
?>

<?php
// For (actually while) loop between 1 to no of users to print out friends
$i=1;
while ($i<=$no_of_users):?>

<?php

//This query fetches all data from the user table based on the user id (the loop $i)
$query = "SELECT * FROM `user` WHERE user.userID=$i";
mysqli_query($db, $query) or die('Error querying database.');
$rows = array();
$userID = $row['userID'];

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$this_session_user = $_SESSION['loggedInUserID'];
// Query to get all data from table friendship where userb is $i and usera is the session user id
$query_friendship = "SELECT * FROM `friendship` WHERE RelatedUserID=$i && RelatingUserID=$this_session_user";
mysqli_query($db, $query_friendship) or die('Error querying database.');
$rows2 = array();


$result2 = mysqli_query($db, $query_friendship);
$row2 = mysqli_fetch_array($result2);

// Variables storing user a and user b data found in the table based on the query
$a = $row2['RelatingUserID'];
$b = $row2['RelatedUserID'];

// Similar query to get all data from table friendship where userb is the session user id and usera is $i
$query_friendship_2 = "SELECT * FROM `friendship` WHERE RelatedUserID=$this_session_user && RelatingUserID=$i";
mysqli_query($db, $query_friendship_2) or die('Error querying database.');
$rows3 = array();

//Step3
$result3 = mysqli_query($db, $query_friendship_2);
$row3 = mysqli_fetch_array($result3);

// Variables storing user c and user d data found in the table based on the query
$c = $row3['RelatingUserID'];
$d = $row3['RelatedUserID'];

//dummy varaible not actually used
$q='1';

$this_uid =$row['userID'];

 if ( $q = $q){
    // echo 'i is:';
    // echo $i;
    // echo 'b is:';
    // echo $b;
    // echo 'c is:';
    // echo $c;

if($i ==$b && $i ==$c ){

// echo 'testing1';
 $friendID = $row['userID'];
 // echo 'frienddddddd';
 // echo $friendID;
// echo $friendID;
// echo 'testing2';
$group_to_check = $_SESSION['group_view'];
$query_user_group_check = "SELECT * FROM `groups` WHERE groups.userID= $friendID && groups.groupID=$group_to_check";
mysqli_query($db, $query_user_group_check) or die('Error querying database.');
$rows4 = array();
$result4 = mysqli_query($db, $query_user_group_check);
$row4 = mysqli_fetch_array($result4);
$c = $row4['userID'];

// echo 'testing';
// echo $c;

if (empty($c)){

 echo 'First Name:' . ' ' . $row['firstName'] .'<br />';

 echo 'Last Name:' . ' ' . $row['lastName'] . '<br />';

?>
</p>
<form name="X"  method="POST">
     <input type="submit" name= Add_User_<?php echo   $friendID; ?> value=Add>

</form>
</p>

<?php
}
}
}
?>

<?php $i=$i+1;

   endwhile;

?>

   <?php
}
?>

 <?php

function add_to_group(){
//function adds friends to a group

$user_to = $_SESSION['user_to_action'];
$this_group = $_SESSION['group_view'];

// echo $user_to;

// echo $this_group;

 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');


$query_find_user_group = "SELECT * FROM `groups` WHERE groups.groupID= $this_group";
mysqli_query($db, $query_find_user_group) or die('Error querying database.');

$result = mysqli_query($db, $query_find_user_group);
$row = mysqli_fetch_array($result);
$group_name = $row['groupName'];


$query_insert_friend_to_group = "INSERT INTO groups(groupName, userID, groupID) VALUES ('$group_name', '$user_to', '$this_group') ";

mysqli_query($db, $query_insert_friend_to_group) or die('Error querying database.');

$query_group_message = "INSERT INTO messages(messageContent, userID, groupID) VALUES ('Welcome to my group chat!', '$this_session_user', '$max_group_no') ";

mysqli_query($db, $query_group_message) or die('Error querying database.');

mysqli_close($db);

}

function remove_from_group(){
//fucntion removes the member from the group

$user_to = $_SESSION['user_to_action'];
$this_group = $_SESSION['group_view'];
// echo 'removing';
// echo $user_to;

 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');

$query_remove_friend_from_group = "DELETE FROM `groups` WHERE groups.groupID= $this_group && groups.userID=$user_to";

mysqli_query($db, $query_remove_friend_from_group) or die('Error querying database.');

mysqli_close($db);
$_SESSION['group_selected']=0;
header("Refresh:0");

}

?>

<?php

// while ($j<=$no_of_users):

for ($i=1 ; $i<=$count_my_groups ; $i++) {

if(isset($_POST['Delete_Group_' . $i])){
    // echo 'tsssssss';
$_SESSION['group'] = $i;
    // if ($pword_repeat_post==$pword_post){
    delete_friend();

}

elseif(isset($_POST['View_Group_' . $i])){

$_SESSION['group_view'] = $i;
    // if ($pword_repeat_post==$pword_post){
    view_group();

}

}

for ($j=1 ; $j<=$count_my_users ; $j++) {

if(isset($_POST['Remove_User_' . $j])){
    // echo 'tsssssss';
$_SESSION['user_to_action'] = $j;
    // if ($pword_repeat_post==$pword_post){
    // echo 'test';
remove_from_group();
}

elseif(isset($_POST['Add_User_' . $j])){

$_SESSION['user_to_action'] = $j;
    // if ($pword_repeat_post==$pword_post){

add_to_group();

}

}

?>

<!--  <FORM METHOD="LINK" ACTION="profile_amend.php">
<INPUT TYPE="submit" VALUE="Edit Personal Details">
</FORM> -->

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

input[type=text], select {
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

<style>

</body>
</html>

                    </div>
                </div>
            </div>

        </div>
</body>
</html>
