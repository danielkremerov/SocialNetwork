<?php
session_start();
$filename = $_SERVER['PHP_SELF'];
function checkProfilePrivacy($personalProfileID){
$mysqli = new mysqli("localhost","root","root","social_network");
// Connection
// check if it worked
if ($mysqli->connect_errno) {
  echo "Connection Failed";
  echo "Errorcode: " . $mysqli->connect_errno;
}
// emphasize characterset
$mysqli->set_charset("utf-8");
//$loggedInUserID = $_SESSION['loggedInUserID'];
//$personalProfileID .= "p"; //apped letter to distinguash between album and profile

      $query= "SELECT privacy.privacyLevel FROM privacy LEFT JOIN user ON privacy.PrivacyID = user.privacy WHERE user.userID = $personalProfileID";

if ($result = mysqli_query($mysqli, $query)) {
  // Loop through result
  while ($row = mysqli_fetch_assoc($result)):

// populate temporary arrays based on assoc rows
$privacyLevel = $row['privacyLevel'];
endwhile;
return $privacyLevel;
}
}


function openProfile($personalProfileID){
$privacyLevel = checkProfilePrivacy($personalProfileID);
if ($privacyLevel=='global') {
echo "<script>window.open('profile.php','_self')</script>";
$_SESSION['profileuserID'] = $personalProfileID;

}
elseif ($privacyLevel =='private') {
echo "<script type='text/javascript'>alert('Profile Privacy is Private');</script>";

echo "<script>window.open('friends.php','_self')</script>";}
else {
  $friendshipstatus = checkIfFriends($personalProfileID);
  echo $friendshipstatus;
  if ($friendshipstatus==2) { //check if friends
  echo "<script>window.open('profile.php','_self')</script>";
      $_SESSION['profileuserID'] = $personalProfileID;
  }
  else {
    echo "<script type='text/javascript'>alert('Profile is only visible to friends');</script>";
    echo "<script>window.open('findnewfriends.php','_self')</script>";
  }
}
}

function openFriendBlog($friendID){
  $_SESSION['blogOwnerID'] = $friendID;
  echo "<script>window.open('FriendBlog.php','_self')</script>";
}

function checkIfFriends($personalProfileID){
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

function insertPrivacyRow(){
  $mysqli = new mysqli("localhost","root","root","social_network");
  if ($mysqli->connect_errno) {
    echo "Connection Failed";
    echo "Errorcode: " . $mysqli->connect_errno;
  }

  $mysqli->set_charset("utf-8");

  $query = "INSERT INTO privacy (privacyLevel) VALUES ('friends')"; // create new privacy row with default privacy
  if ($result = mysqli_query($mysqli, $query)){
    $query = "SELECT privacy.PrivacyID FROM privacy ORDER BY PrivacyID DESC LIMIT 1"; // query the last (just inserted privacy Id)

    if ($result = mysqli_query($mysqli, $query)) {
      // Loop through result
      while ($row = mysqli_fetch_assoc($result)):

    // populate temporary arrays based on assoc rows
    $privacyID = $row['PrivacyID'];
    endwhile;
    return $privacyID;
  }}

}
?>
