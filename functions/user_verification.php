<?php
session_start();
include("privacy_functions.php");
$link = mysqli_connect("localhost","root","root","social_network") or die ("Connection failed");

 //start new session and "save" registered user in the session variable

// BEGIN SQL INJECTION PROTECTION TEST
/*
$stmt = $dbConnection->prepare('SELECT * FROM employees WHERE name = ?');
$stmt->bind_param('s', $name);

$stmt->execute();

$result = $stmt->get_result();
*/


function loginUser(){ //basic Login function - called when pressed the login button
  global $link; //necessary to use $link in the query
  if (isset($_POST['SubmitLogin'])){  //check if form is filled in
    $email = $_POST['email'];
    $password = $_POST['password'];
    //Protect against injection
    $query= $link->prepare("SELECT * FROM user WHERE emailAddress ='$email' AND password = '$password'");
    $query->bind_param('s',$email,$password);
    $query->execute();
    $result = $query->get_result();
    // normal code restarts here
    $check = mysqli_num_rows($result);
    if($check==1){ //only verfication so far is to check if combo of email and password exists
        //$_SESSION["email"] = $email; //setting session variable and directing to next page.
        while ($row = mysqli_fetch_assoc($result)):
          $_SESSION['loggedInUserID']  = $row['userID'];
          $_SESSION['loggedInFirstName'] = $row['firstName'];
          $_SESSION['loggedInLastName'] = $row['lastName'];
          $_SESSION['loggedInEmail'] =$row['emailAddress'];
          endwhile;

      // Create a cookie upon sign in
      $cookieuservar = $row['userID'];


      echo "<script>window.open('home.php','_self')</script>";

    }
    else{
      echo "<script>alert('Combination of email and password is incorrect. Try again!')</script>";
}
  }
}


    function insertUser(){ //function to insert (signup) a new user - called when pressed the signup button
    global $link; //necessary to use $link in the query
    if (isset($_POST['SubmitSignup'])){  //check if form is filled in
      //  $firstName = mysqli_real_escape_string($link, $_POST['firstName']); alternative more secure way preventing bullshit to be entered
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $status = "unverified";
        $posts = "No";

        //email verfication start
        $query = $link->prepare ("SELECT * FROM user WHERE emailAddress='$email'");
        $query->bind_param('s',$email);
        $query->execute();
        $result = $query->get_result();
        $check = mysqli_num_rows($result);
        if($check==1){   // check if email is already existing
            echo "<script>alert('This email is already registered!')</script>";
            exit();
        }   //email verification end
        if(strlen($password)<6){
          echo "<script>alert('The password is too short (min 6 characters)')</script>";
          exit();
          // password length verfication
        }
        else { //insert a new user
          $privacyID = insertPrivacyRow(); // create a Row in the privacy table and retrieve primary Key from privacy table
          // set it directly as Foreign Key in the other table
          $query = $link->prepare("INSERT INTO user (firstName, lastName, emailAddress, password, privacy) VALUES ('$firstName', '$lastName', '$email', '$password','$privacyID')");
          $query->bind_param('s',$firstName, $lastName, $email, $password, $privacyID);
          $query->execute();
          $result = $query->get_result();
          if($result){
            $query = $link->prepare ("SELECT * FROM user WHERE emailAddress='$email'");
            $query->bind_param('s',$email);
            $query->execute();
            $result = $query->get_result();
            
            while ($row = mysqli_fetch_assoc($result)):
              $_SESSION['loggedInUserID']  = $row['userID'];
              $_SESSION['loggedInFirstName'] = $row['firstName'];
              $_SESSION['loggedInLastName'] = $row['lastName'];
              $_SESSION['loggedInEmail'] =$row['emailAddress'];
              $_SESSION['loggedInPrivacyID'] =$row['privacy'];
              endwhile;


            echo "<script>alert('Welcome to the Social Network')</script>";
            echo "<script>window.open('home.php','_self')</script>"; //redirect to next page

        }
        }
    }
}

?>
