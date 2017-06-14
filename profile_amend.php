<?php session_start(); //necessary for every page to use session variable
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

<!-- </head> -->

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
          </button>
               <b>
                <a class="navbar-brand" href="#" style="color:black">Welcome to the Social Circle</a>
            </div>
</b>
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
                                             <b>
                          <a class="navbar-brand" href="#" style="color:black">Welcome <?php echo $_SESSION['loggedInFirstName']; ?> &ensp;<?php  echo $_SESSION['loggedInLastName'];?></a>



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










<?php
//Step1
 $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
?>

<html>
 <head>
 </head>
 <body>
 <b>
 <h1>Edit Profile Page</h1>
 </b>

 <style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type=submit]:hover {
    background-color: #45a049;
}

/*div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}*/
</style>

<?php
//Step2



 // echo $this_session;
$loggedInUser = $_SESSION['loggedInUserID'];
// echo 'test';
// echo $this_session;

$query = "SELECT * FROM user where userid = $loggedInUser";
mysqli_query($db, $query) or die('Error querying database.');




//Step3
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);


 // echo 'First Name:' . ' ' . $row['firstName'] .'<br />';

 // echo 'Last Name:' . ' ' . $row['lastName'] . '<br />';

 // echo 'Date of Birth (yyyy-mm-dd):' . ' ' . $row['DOB'] . '<br />';

 // echo 'About:' . ' ' . $row['aboutMe'] . '<br />';

 // echo 'Education:' . ' ' . $row['education'] . '<br />';

 // echo 'Work:' . ' ' . $row['work'] . '<br />';

 // echo 'Location:' . ' ' . $row['location'] . '<br />';

 // echo 'Profile Privacy:' . ' ' . $row['privacy'] . '<br />';

 // echo 'Email Address:' . ' ' . $row['emailAddress'] . '<br />';

 // echo 'Password: **********' ;

//Step 4

$firstName=$row['firstName'];
$lastName=$row['lastName'];
$DOB=$row['DOB'];
$aboutMe=$row['aboutMe'];
$education=$row['education'];
$work=$row['work'];
$location=$row['location'];
$privacyno=$row['privacy'];
$_SESSION['privacy_no'] = $privacyno;
$emailAddress=$row['emailAddress'];
$password=$row['password'];

$query_privacy = "SELECT * FROM `privacy` WHERE privacy.PrivacyID='$privacyno'";
mysqli_query($db, $query) or die('Error querying database.');

$result_privacy = mysqli_query($db, $query_privacy);
$row_privacy = mysqli_fetch_array($result_privacy);

$privacyLevel=$row_privacy['privacyLevel'];



mysqli_close($db);





?>

<form method="post">
<p>First name: <input type="text" name="firstname" value='<?php echo  $firstName; ?>' /></p>
<p>Last name: <input type="text" name="lastname" value='<?php echo  $lastName; ?>' /></p>
<p>Date of Birth (yyyy-mm-dd): <input type="text" name="d" value='<?php echo  $DOB; ?>' /></p>
<p>About: <input type="text" name="about" value='<?php echo  $aboutMe; ?>' /></p>
<p>Education: <input type="text" name="edu" value='<?php echo  $education; ?>' /></p>
<p>Work: <input type="text" name="wo" value='<?php echo  $work; ?>' /></p>
<p>Location: <input type="text" name="loc" value='<?php echo  $location; ?>' /></p>


<label for="pri">Privacy</label>
    <select name="pri">
      <option value="global">Private</option>
      <option value="friends">Friends</option>
      <option value="private">Global</option>
    </select>

<!-- <label for="country">Privacy</label>
    <select id="country" name="pri">
      <option value="public">Public</option>
      <option value="friends">Friends</option>
      <option value="friends-of-friends">Friends-of-Friends</option>
    </select> -->

<p>Email Address: <input type="text" name="email" value='<?php echo  $emailAddress; ?>' /></p>
<p>Password: <input type="password" name="pword" value='<?php echo  $password; ?>' /></p>
<!-- <p>Repeat Password: <input type="text" name="pword_repeat" value='<?php echo  $password; ?>' /></p> -->
<!-- <input type="submit" value="Submit">
<button TYPE="submit" name="submit" value="Submit" class="button button1" onclick="profile.php" >Submit Personal Details</button> -->
<b>
<input type="submit" name="submit" value="Submit Profile Details" onclick="profile.php"  />
</b>

</form>

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




<?php

$this_session = $_SESSION['loggedInUserID'];
//echo $this_session;
function amend_details(){



$firstname_post = $_POST['firstname'];
$lastname_post = $_POST['lastname'];
$dob_post = $_POST['d'];
$about_post = $_POST['about'];
$education_post = $_POST['edu'];
$work_post = $_POST['wo'];
$location_post = $_POST['loc'];
$privacy_post = 'global';//$_POST['pri'];
$email_post = $_POST['email'];
$pword_post = $_POST['pword'];
// $pword_repeat_post = $_POST['pword_repeat'];





$this_session = $_SESSION['loggedInUserID'];


   $db = mysqli_connect('localhost','root','root','social_network')
 or die('Error connecting to MySQL server.');
$query = "UPDATE user LEFT JOIN privacy on user.userID = privacy.PrivacyID SET firstName='{$firstname_post}', lastName='{$lastname_post}' , DOB='{$dob_post}',                   aboutMe='{$about_post}', education='{$education_post}', work='{$work_post}',                                 location='{$location_post}', emailAddress='{$email_post}' WHERE user.userID=$this_session";

mysqli_query($db, $query) or die('Error querying database.');


// UPDATE privacy SET privacyLevel='iiji' WHERE privacy.PrivacyID = '871258'
// $query_privacy_amend = "UPDATE privacy SET privacyLevel'{$privacy_post}' WHERE privacy.PrivacyID = $privacyno";


$privacyno = $_SESSION['privacy_no'];
$query_privacy_amend = "UPDATE privacy SET privacyLevel='$privacy_post' WHERE privacy.PrivacyID = '$privacyno'";
mysqli_query($db, $query_privacy_amend) or die('Error querying database.');


mysqli_close($db);// header("Refresh:0");
}

function amend_email_variable(){


}




?>

<?php
if(isset($_POST["submit"])){


    // if ($pword_repeat_post==$pword_post){
    amend_details();
    amend_email_variable();

    //echo "<script>window.open('profile_amend.php','_self')</script>";
    header('Location: personalprofile.php');

// }

// else {

//     echo 'the passwords do not match';
// }
}



?>

<html>
<body>





</script>

</body>
</html>




</body>
</html>

                    </div>
                </div>
            </div>

        </div>







</body>

</html>
