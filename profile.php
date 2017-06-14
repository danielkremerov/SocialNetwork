<!DOCTYPE html>
<html>
<?php session_start(); //necessary for every page to use session variable

  // Check if cookie exists, if not redirect to signup page
  if (array_key_exists("usercookie", $_COOKIE)){

  } else {

    echo "<script>window.open('signup.php','_self')</script>";
  }

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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
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
 <h1>Profile Page</h1>



<div class="col-md-5 ">

<p>
<p>
<p>
<p>
<p>
<p>

<img src="<?php echo "https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg"; ?>" height="200" width="200">
</div>


  <div class="col-sm-6">
<b>


<?php
//Step2
// echo $this_session;

//$this_session = $_SESSION['loggedInUserID'];
$profileuserID = $_SESSION['profileuserID'];
// echo $this_session;




$query = "SELECT * FROM `user` WHERE user.userID='$profileuserID'";
mysqli_query($db, $query) or die('Error querying database.');

//check this line for its use!


//Step3
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);



 echo 'First Name:' . ' ' . $row['firstName'] .'<br />';

 echo 'Last Name:' . ' ' . $row['lastName'] . '<br />';

 echo 'Date of Birth (yyyy-mm-dd):' . ' ' . $row['DOB'] . '<br />';

 echo 'About:' . ' ' . $row['aboutMe'] . '<br />';

 echo 'Education:' . ' ' . $row['education'] . '<br />';

 echo 'Work:' . ' ' . $row['work'] . '<br />';

 echo 'Location:' . ' ' . $row['location'] . '<br />';

 echo 'Privacy:' . ' ' . $row['privacy'] . '<br />';

 echo 'Email Address:' . ' ' . $row['emailAddress'] . '<br />';

 echo 'Password: **********' ;

//Step 4
mysqli_close($db);
?>
</b>



</div>
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
<style>



</body>
</html>

                    </div>
                </div>
            </div>

        </div>







</body>

</html>
