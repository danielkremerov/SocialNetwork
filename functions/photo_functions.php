<?php
session_start();

function setAlbums($userID){

      // Connection

      $mysqli = new mysqli("localhost","root","root","social_network");

      // check if it worked
      if ($mysqli->connect_errno) {
        echo "Connection Failed";
        echo "Errorcode: " . $mysqli->connect_errno;
      }

      // emphasize characterset
      $mysqli->set_charset("utf-8");

        $query= "SELECT album.albumID, album.userID, album.albumTitle, album.description, user.firstName, user.lastName FROM album
                LEFT JOIN user ON album.userID = user.userID
                WHERE album.userID = '$userID'
                Group BY album.albumID

                ";



      if ($result = mysqli_query($mysqli, $query)) {

        // Loop through result
        while ($row = mysqli_fetch_assoc($result)):

      // populate temporary arrays based on assoc rows
  $blogPostID[]  = $row['albumID'];
  $userID[] = $row['userID'];
  $albumFirstName[] =$row['firstName'];
  $albumLastName[] = $row['lastName'];
  $albumTitle[] = $row['albumTitle'];
  $albumdescription[] =$row['description'];
  //$privacy[] =$row['privacy'];
  //$NumberOfLikes[] =$row['NumberOfLikes'];


      endwhile;
      //store arrays in Session variables
     $_SESSION["albumID"] =  $blogPostID;
     $_SESSION["userID"] =   $userID;
     $_SESSION["albumfirstName"] = $albumFirstName;
     $_SESSION["albumlastName"] = $albumLastName;
    // $_SESSION["timestamp"] =   $timestamp;
     $_SESSION["albumtitle"] =   $albumTitle;
    $_SESSION["albumdescription"] =   $albumdescription;

     //$_SESSION["privacy"] =   $privacy;
    // $_SESSION["NumberOfLikes"] =   $NumberOfLikes; }




  }


}


function showComments($currentphotoID){
  $mysqli = new mysqli("localhost","root","root","social_network");
  $query = "SELECT photocomment.commentID, photocomment.userID, photocomment.content, photocomment.timestamp, photocomment.photoID,
  user.firstName FROM photocomment LEFT JOIN user ON photocomment.userID = user.userID WHERE photocomment.photoID = $currentphotoID
  ORDER BY photocomment.timestamp DESC";

  //$query2 = "SELECT * FROM comment WHERE blogPostID = '$currentPost'";
  if ($result = mysqli_query($mysqli, $query)) {

    // Loop through result
    while ($row = mysqli_fetch_assoc($result)):

      $commentID[]  = $row['ID'];
      $userIDComment[] = $row['userID'];
      $contentComment[] = $row['content'];
      $timestampComment[] =$row['timestamp'];
      $commentPoster[] = $row['firstName'];



          endwhile;
          //store arrays in Session variables
         $_SESSION["photocommentID"] =  $commentID;
         $_SESSION["photouserIDComment"] =   $userIDComment;
         $_SESSION["photocontentComment"] =   $contentComment;
         $_SESSION["phototimestampComment"] =   $timestampComment;
         $_SESSION["photocommentPoster"] =   $commentPoster;?>


  <h3>Comments</h3>
  <?php foreach(array_keys($_SESSION["photocommentID"]) as $key) { ?>
  <p><?php echo $_SESSION["photocommentPoster"] [$key]; ?> commented: <?php   echo $_SESSION["photocontentComment"] [$key]; ?></p>


  <?php   }}

  }


  function setPhotosFriends($personalProfileID,$albumID){
  $privacyLevel = checkProfilePrivacy($personalProfileID);
  if ($privacyLevel=='global') {
    setPhotos($albumID);}

    else {
      $friendshipstatus = checkIfFriends($personalProfileID);
        if ($friendshipstatus==2) {
          setPhotos($albumID);}
          else {
      echo "<script type='text/javascript'>alert('Profile is only visible to friends');</script>";
    }} }


  function setPhotos($albumID){
  $mysqli = new mysqli("localhost","root","root","social_network");

  $query = "SELECT photos.url,photos.photoID, count(annotationphoto.annontationID) AS NumberOfLikes FROM photos
  LEFT JOIN annotationPhoto ON photos.photoID = annotationphoto.photoID
   WHERE albumID = $albumID
   Group BY photos.photoID";

  //$query2 = "SELECT * FROM comment WHERE blogPostID = '$currentPost'";
  if ($result = mysqli_query($mysqli, $query)) {

    // Loop through result
    while ($row = mysqli_fetch_assoc($result)):

      $photoID[]  = $row['photoID'];
      $url[] = $row['url'];
      $likes[] = $row['NumberOfLikes'];

          endwhile;
          //store arrays in Session variables
         $_SESSION["photoID"] =  $photoID;
         $_SESSION["url"] =   $url;
         $_SESSION["photoLikes"] =   $likes;
         ?>



  <h2>Photos</h2>
  <?php foreach(array_keys($_SESSION["photoID"]) as $key) { ?>
  <p><img src="<?php echo $_SESSION["url"][$key] ?>" style="float:center" width="100%"></p>
  <p></p>
  <li><a href="#"><?php echo 'Likes   '; echo $_SESSION["photoLikes"][$key]; ?> <span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a></li>
  <?php   $currentPhotoID = $_SESSION['photoID'][$key];
     ?>
     <?php
     $photoID = $_SESSION["photoID"][$key];
     showComments($photoID);
      ?>
  <form class="" action="" method="post">
    <input type="text" class="form-control" name="CommentBox" placeholder="New Comment">
    <button class="btn btn-default" type="submit" value="<?php echo $currentPhotoID;  ?>" name="SubmitComment">Submit</button>
  </form>
<?php
 if(isset($_POST['SubmitComment'])){
  $commentContent = $_POST['CommentBox'];
  $pressedID = $_POST['SubmitComment'];
  $loggedInUserID = $_SESSION['loggedInUserID'];
insertPhotoComment($pressedID,$commentContent,$loggedInUserID);
unset($_POST['SubmitComment']);
}?>

  <form class="" action="" method="post">
    <button class="btn btn-default" type="submit" value="<?php echo $currentPhotoID;  ?>" name="LikePhotoButton">Like it!</button>
    </form>
<?php // like stuff start
 if(isset($_POST['LikePhotoButton'])){

   $currentPhoto = $_POST['LikePhotoButton'];
   likePhoto($currentPhoto);
   unset($_POST['LikePhotoButton']);
   } // like stuff end
 ?>

  <?php   }
  }

  }
  function insertPhotoComment($currentPhoto,$commentContent,$currentUser){
    $mysqli = new mysqli("localhost","root","root","social_network");
    $query = "INSERT INTO photocomment (userID, content, photoID) Values ($currentUser, '$commentContent' , $currentPhoto) ";
    $result = mysqli_query($mysqli, $query);
  }
  function createAlbum($loggedInUserID,$title,$description){
    $privacyID = insertPrivacyRow();
    $mysqli = new mysqli("localhost","root","root","social_network");
    $query = "INSERT INTO album (userID, albumTitle, description, PrivacyID) Values ($loggedInUserID, '$title' , '$description', '$privacyID') ";
    $result = mysqli_query($mysqli, $query);
  }

  function likePhoto($currentPhoto){
    $loggedInUserID = $_SESSION['loggedInUserID'];
    $mysqli = new mysqli("localhost","root","root","social_network");
    $query= "SELECT photoID FROM annotationPhoto WHERE userID = '$loggedInUser'  AND photoID = '$currentPhoto' ";

    if ($result = mysqli_query($mysqli, $query)){
     $check = mysqli_num_rows($result); // check if already liked by this user if not insert lke
     if ($check == 0) {
    $query= "INSERT INTO `annotationPhoto` (userID,photoID) VALUES ('$loggedInUser','$currentPhoto')";
    if($result = mysqli_query($mysqli, $query)){
    echo "<script>window.open('singlephoto.php','_self')</script>";
      // later ausblenden und page reload
    }
  else{
    echo "already liked";
  }}}
  }
  function checkAlbumPrivacy($albumID){
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

        $query= "SELECT privacy.privacyLevel FROM privacy LEFT JOIN album ON privacy.PrivacyID = album.privacyID WHERE album.albumID = $albumID";

  if ($result = mysqli_query($mysqli, $query)) {
    // Loop through result
    while ($row = mysqli_fetch_assoc($result)):

  // populate temporary arrays based on assoc rows
  $privacyLevel = $row['privacyLevel'];
  endwhile;
  return $privacyLevel;
  }
  }

  function changeAlbumPrivacy($albumID, $privacyLevel){
    $mysqli = new mysqli("localhost","root","root","social_network");
    if ($mysqli->connect_errno) {
      echo "Connection Failed";
      echo "Errorcode: " . $mysqli->connect_errno;
    }
    $mysqli->set_charset("utf-8");
    $query= "SELECT album.PrivacyID FROM album WHERE albumID = $albumID";
    if ($result = mysqli_query($mysqli, $query)) {
      // Loop through result
      while ($row = mysqli_fetch_assoc($result)):

    // populate temporary arrays based on assoc rows
    $privacyID = $row['PrivacyID'];
    endwhile;
    $query = "UPDATE privacy SET privacyLevel = $privacyLevel WHERE PrivacyID  =  $privacyID";
    $result = mysqli_query($mysqli, $query);
    }
  }
function uploadPhoto($albumID){

    // Connect to database
    //Step1
    $db = mysqli_connect('localhost','root','root','social_network') or die('Error connecting to MySQL server.');

    //Step2

    $imagename = addslashes($_FILES['uploadedimage']['name']);


    //Get the content of the image and then add slashes to it
    $imagetmp = addslashes ($_FILES['uploadedimage']['tmp_name']);
    $imagetmp = file_get_contents($imagetmp);
    $imagetmp = base64_decode($imagetmp);

    $loggedInID = $_SESSION['loggedInUserID'];
    //Insert the image name and image content in image_table
    $insert_image = "INSERT INTO photos (userID, timestamp, image, location, albumID, privacy, url, title) VALUES('$loggedInID', CURRENT_TIMESTAMP, '$imagetmp','location','$albumID','privacy','http://m11.brkmd.com/dnet/media/275/895/2895275/10-best-holiday-movies-quotes1.jpg','$imagename')";

    //$insert_image = "INSERT INTO album (albumTitle, description, timestamp, userID) VALUES ('atitle','', CURRENT_TIMESTAMP, 4)";

    mysqli_query($db,$insert_image);

}
