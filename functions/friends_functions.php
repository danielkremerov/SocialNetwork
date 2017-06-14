<?php
session_start();
function showFriends($searchcondition){
$mysqli = new mysqli("localhost","root","root","social_network");
// Connection


// check if it worked
if ($mysqli->connect_errno) {
  echo "Connection Failed";
  echo "Errorcode: " . $mysqli->connect_errno;
}

// emphasize characterset
$mysqli->set_charset("utf-8");
$loggedInUserID = $_SESSION['loggedInUserID'];
if($searchcondition!=""){ // check if search for specific friend
        // with search
        $query=  "SELECT FriendShip.RelatingUserID, FriendShip.RelatedUserID, user.firstName, user.lastName FROM FriendShip
        LEFT JOIN user ON FriendShip.RelatedUserID = user.userID  WHERE FriendShip.RelatingUserID = '$loggedInUserID'AND user.firstName = '$searchcondition' "; //search query

      }    else { //without search
      $query= "SELECT FriendShip.RelatingUserID, FriendShip.RelatedUserID, user.firstName, user.lastName FROM FriendShip
      LEFT JOIN user ON FriendShip.RelatedUserID = user.userID  WHERE FriendShip.RelatingUserID =  '$loggedInUserID' ";
}

if ($result = mysqli_query($mysqli, $query)) {

  // Loop through result
  while ($row = mysqli_fetch_assoc($result)):
    $friendID = $row['RelatedUserID'];
    $friendshipstatus = checkFriendship($friendID);
    if($friendshipstatus==2){ //check if friends (= 2 entries or only one entry = friend request still not accepted)

// populate temporary arrays based on assoc rows
$friendIDs[]  = $row['RelatedUserID'];
$friendFirstName[] = $row['firstName'];
$friendLastName[] =$row['lastName'];
}


endwhile;
//store arrays in Session variables
$_SESSION["friendIDs"] =  $friendIDs;
$_SESSION["friendFirstName"] =   $friendFirstName;
$_SESSION["friendLastName"] = $friendLastName;
 }
}

function deleteFriend($deleteFriendUserID){
  if($deleteFriendUserID!=""){
  $mysqli = new mysqli("localhost","root","root","social_network");
  // Connection

  // check if it worked
  if ($mysqli->connect_errno) {
    echo "Connection Failed";
    echo "Errorcode: " . $mysqli->connect_errno;
  }

  // emphasize characterset
  $mysqli->set_charset("utf-8");

  $loggedInUserID = $_SESSION['loggedInUserID'];
  $query = "DELETE FROM `FriendShip` WHERE (FriendShip.RelatingUserID = $loggedInUserID AND FriendShip.RelatedUserID = $deleteFriendUserID)
  OR (FriendShip.RelatedUserID = $loggedInUserID AND FriendShip.RelatingUserID = $deleteFriendUserID)";
if($result = mysqli_query($mysqli, $query)){
  echo "<script>window.open('friends.php','_self')</script>";
}
}}

function findfriends($searchcondition){
  $mysqli = new mysqli("localhost","root","root","social_network");
  // Connection


  // check if it worked
  if ($mysqli->connect_errno) {
    echo "Connection Failed";
    echo "Errorcode: " . $mysqli->connect_errno;
  }

  // emphasize characterset
  $mysqli->set_charset("utf-8");
  $loggedInUserID = $_SESSION['loggedInUserID'];

  if($searchcondition!=""){
    $query = "SELECT user.userID, user.firstName, user.lastName FROM user WHERE user.userID NOT IN (SELECT FriendShip.RelatedUserID FROM FriendShip
      WHERE FriendShip.RelatingUserID = $loggedInUserID) AND user.userID != $loggedInUserID AND user.firstName = '$searchcondition'";
  }
  else {

  $query = "SELECT user.userID, user.firstName, user.lastName FROM user WHERE user.userID NOT IN (SELECT FriendShip.RelatedUserID FROM FriendShip
    WHERE FriendShip.RelatingUserID = $loggedInUserID) AND user.userID != $loggedInUserID  ";}



    if ($result = mysqli_query($mysqli, $query)) {

      // Loop through result
      while ($row = mysqli_fetch_assoc($result)):

    // populate temporary arrays based on assoc rows
    $friendIDs[]  = $row['userID'];
    $friendFirstName[] = $row['firstName'];
    $friendLastName[] =$row['lastName'];



    endwhile;
    //store arrays in Session variables
    $_SESSION["friendIDs"] =  $friendIDs;
    $_SESSION["friendFirstName"] =   $friendFirstName;
    $_SESSION["friendLastName"] = $friendLastName;
     }

}

function sendRequest($receiverID){
  if($receiverID!=""){
  $mysqli = new mysqli("localhost","root","root","social_network");
  // Connection

  // check if it worked
  if ($mysqli->connect_errno) {

  }

  // emphasize characterset
  $mysqli->set_charset("utf-8");

  $loggedInUserID = $_SESSION['loggedInUserID'];
  $query = "INSERT INTO FriendShip (FriendShip.RelatingUserID, FriendShip.RelatedUserID) VALUES ('$loggedInUserID','$receiverID')";
if($result = mysqli_query($mysqli, $query)){
  echo "<script>window.open('FindNewFriends.php','_self')</script>";
}}}

function showFriendRequests(){ // query do rest later
  //$query = "SELECT user.userID, user.firstName, user.lastName FROM user WHERE user.userID NOT IN (SELECT FriendShip.RelatingUserID FROM FriendShip
    //WHERE FriendShip.RelatedUserID = $loggedInUserID) AND user.userID != $loggedInUserID ";
    $mysqli = new mysqli("localhost","root","root","social_network");
    // Connection


    // check if it worked
    if ($mysqli->connect_errno) {
      echo "Connection Failed";
      echo "Errorcode: " . $mysqli->connect_errno;
    }

    // emphasize characterset
    $mysqli->set_charset("utf-8");
    $loggedInUserID = $_SESSION['loggedInUserID'];

          $query= "SELECT FriendShip.RelatingUserID, FriendShip.RelatedUserID, user.firstName, user.lastName FROM FriendShip
          LEFT JOIN user ON FriendShip.RelatingUserID = user.userID  WHERE FriendShip.RelatedUserID =  '$loggedInUserID' ";


    if ($result = mysqli_query($mysqli, $query)) {

      // Loop through result
      while ($row = mysqli_fetch_assoc($result)):
        $friendID = $row['RelatingUserID'];
        $friendshipstatus = checkFriendship($friendID);
        if($friendshipstatus==1){ //check if someone send a request but not yet answerd (= 1 entry or only one entry = friend request still not accepted)

    // populate temporary arrays based on assoc rows
    $friendIDs[]  = $row['RelatingUserID'];
    $friendFirstName[] = $row['firstName'];
    $friendLastName[] =$row['lastName'];
    }


    endwhile;
    //store arrays in Session variables
    $_SESSION["friendIDsOpenRequest"] =  $friendIDs;
    $_SESSION["friendFirstNameOpenRequest"] =   $friendFirstName;
    $_SESSION["friendLastNameOpenRequest"] = $friendLastName;
     }
}

function showSentFriendRequests(){ // query do rest later
  //$query = "SELECT user.userID, user.firstName, user.lastName FROM user WHERE user.userID NOT IN (SELECT FriendShip.RelatingUserID FROM FriendShip
    //WHERE FriendShip.RelatedUserID = $loggedInUserID) AND user.userID != $loggedInUserID ";
    $mysqli = new mysqli("localhost","root","root","social_network");
    // Connection


    // check if it worked
    if ($mysqli->connect_errno) {
      echo "Connection Failed";
      echo "Errorcode: " . $mysqli->connect_errno;
    }

    // emphasize characterset
    $mysqli->set_charset("utf-8");
    $loggedInUserID = $_SESSION['loggedInUserID'];

          $query= "SELECT FriendShip.RelatingUserID, FriendShip.RelatedUserID, user.firstName, user.lastName FROM FriendShip
          LEFT JOIN user ON FriendShip.RelatedUserID = user.userid  WHERE FriendShip.RelatingUserID =  $loggedInUserID";


    if ($result = mysqli_query($mysqli, $query)) {

      // Loop through result
      while ($row = mysqli_fetch_assoc($result)):
        $friendID = $row['RelatedUserID'];
        $friendshipstatus = checkFriendship($friendID);
        if($friendshipstatus==1){ //check if someone send a request but not yet answerd (= 1 entry or only one entry = friend request still not accepted)

    // populate temporary arrays based on assoc rows
    $friendIDs[]  = $row['RelatedUserID'];
    $friendFirstName[] = $row['firstName'];
    $friendLastName[] =$row['lastName'];
    }


    endwhile;
    //store arrays in Session variables
    $_SESSION["friendIDsOpenRequest"] =  $friendIDs;
    $_SESSION["friendFirstNameOpenRequest"] =   $friendFirstName;
    $_SESSION["friendLastNameOpenRequest"] = $friendLastName;
     }
}


function checkFriendship($personalProfileID){
  $mysqli = new mysqli("localhost","root","root","social_network");
  if ($mysqli->connect_errno) {
    echo "Connection Failed";
    echo "Errorcode: " . $mysqli->connect_errno;
  }
  $mysqli->set_charset("utf-8");

  $loggedInUserID = $_SESSION['loggedInUserID'];
  $query ="SELECT COUNT(FriendShip.FriendShipID) AS 'count' FROM FriendShip WHERE (FriendShip.RelatingUserID = $loggedInUserID AND FriendShip.RelatedUserID = $personalProfileID)
  OR (FriendShip.RelatingUserID = $personalProfileID AND FriendShip.RelatedUserID = $loggedInUserID)";
  if ($result = mysqli_query($mysqli, $query)) {
    // Loop through result
    while ($row = mysqli_fetch_assoc($result)):
  $friendship = $row['count'];
  endwhile;
  return $friendship; // if 2 friends, if 1 request, if 0 not friends
  }
}

function acceptFriendrequest($toAcceptedUserID){
  $mysqli = new mysqli("localhost","root","root","social_network");
  // Connection


  // emphasize characterset
  $mysqli->set_charset("utf-8");

  $loggedInUserID = $_SESSION['loggedInUserID'];  // the query is a potential point of error - when time cleary define the relating and related user
  $query = "INSERT INTO FriendShip (FriendShip.RelatingUserID, FriendShip.RelatedUserID) VALUES ('$loggedInUserID','$toAcceptedUserID')";
if($result = mysqli_query($mysqli, $query)){
  echo "<script>window.open('Friends.php','_self')</script>";
}

}


function showFriendsofFriend($friendID){
$mysqli = new mysqli("localhost","root","root","social_network");
// Connection


// check if it worked
if ($mysqli->connect_errno) {
  echo "Connection Failed";
  echo "Errorcode: " . $mysqli->connect_errno;
}

// emphasize characterset
$mysqli->set_charset("utf-8");
//without search
$loggedInUserID = $_SESSION['loggedInUserID'];
      $query= "SELECT FriendShip.RelatingUserID, FriendShip.RelatedUserID, user.firstName, user.lastName FROM FriendShip
      LEFT JOIN user ON FriendShip.RelatedUserID = user.userID  WHERE FriendShip.RelatingUserID = $friendID AND FriendShip.RelatingUserID <> $loggedInUserID AND FriendShip.RelatedUserID <> $loggedInUserID ";
// query shows all friends of the people accept anything related to the logged in user

if ($result = mysqli_query($mysqli, $query)) {



  // Loop through result
  while ($row = mysqli_fetch_assoc($result)):
    $friendID = $row['RelatedUserID'];
    $friendshipstatus = checkFriendship($friendID);
    if($friendshipstatus==0){ //check if not friends yet - display only these as friends that we want to show to people

// populate temporary arrays based on assoc rows
$friendIDs[]  = $row['RelatedUserID'];
$friendFirstName[] = $row['firstName'];
$friendLastName[] =$row['lastName'];
}


endwhile;
//store arrays in Session variables
$_SESSION["friendofFriendID"] =  $friendIDs;
$_SESSION["firendofFiredFirstName"] =   $friendFirstName;
$_SESSION["friendofFriedLastName"] = $friendLastName;
 }
}

?>
