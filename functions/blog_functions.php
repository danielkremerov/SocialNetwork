<?php
session_start();
function setBlogPost($condition,$userID){
    // Connection

    $mysqli = new mysqli("localhost","root","root","social_network");

    // check if it worked
    if ($mysqli->connect_errno) {
      echo "Connection Failed";
      echo "Errorcode: " . $mysqli->connect_errno;
    }

    // emphasize characterset
    $mysqli->set_charset("utf-8");
  if($condition!=""){ // check if search or all allowed posts

            $query=  "SELECT blogpost.blogPostID, blogpost.userID, blogpost.timestamp, blogpost.blogContent, blogpost.privacy, count(annotationBlog.annontationID) as NumberOfLikes, user.firstName, user.lastName FROM blogpost
                  LEFT JOIN user ON blogpost.userID = user.userID
                  LEFT JOIN annotationBlog ON blogpost.blogPostID = annotationBlog.blogPostID
                  WHERE blogpost.userID = '$userID' AND blogpost.blogContent LIKE '%$condition%'
                  Group BY blogpost.blogPostID
                  ORDER by blogpost.timestamp DESC
                  "; //search where the word from the conditon is contained (can be expanded to searching several parameters)
                }    else {
      $query= "SELECT blogpost.blogPostID, blogpost.userID, blogpost.timestamp, blogpost.blogContent, blogpost.privacy, count(annotationBlog.annontationID) as NumberOfLikes, user.firstName, user.lastName FROM blogpost
              LEFT JOIN user ON blogpost.userID = user.userID
              LEFT JOIN annotationBlog ON blogpost.blogPostID = annotationBlog.blogPostID
              WHERE blogpost.userID = '$userID'
              Group BY blogpost.blogPostID
              ORDER by blogpost.timestamp DESC
              ";
    }


    if ($result = mysqli_query($mysqli, $query)) {

      // Loop through result
      while ($row = mysqli_fetch_assoc($result)):

    // populate temporary arrays based on assoc rows
$blogPostID[]  = $row['blogPostID'];
$userID[] = $row['userID'];
$blogFirstName[] =$row['firstName'];
$blogLastName[] = $row['lastName'];
$timestamp[] = $row['timestamp'];
$blogContent[] =$row['blogContent'];
$privacy[] =$row['privacy'];
$NumberOfLikes[] =$row['NumberOfLikes'];


    endwhile;
    //store arrays in Session variables
   $_SESSION["blogPostID"] =  $blogPostID;
   $_SESSION["userID"] =   $userID;
   $_SESSION["blogFirstName"] = $blogFirstName;
   $_SESSION["blogLastName"] = $blogLastName;
   $_SESSION["timestamp"] =   $timestamp;
   $_SESSION["blogContent"] =   $blogContent;
   $_SESSION["privacy"] =   $privacy;
   $_SESSION["NumberOfLikes"] =   $NumberOfLikes; }

}

function insertBlogPost($currentUser,$blogPostContent){
  $mysqli = new mysqli("localhost","root","root","social_network");
  $query3 = $mysqli->prepare( "INSERT INTO blogpost (userID, blogcontent) Values ($currentUser, '$blogPostContent') ");
  $query3->bind_param('s',$currentUser, $blodPostContent);
  $query3->execute();
  $result3 = $query3->get_result();
}


function likePost($loggedInUser,$currentPost){
  $mysqli = new mysqli("localhost","root","root","social_network");
  $query= "SELECT blogPostID FROM annotationBlog WHERE userID = '$loggedInUser'  AND blogPostID = '$currentPost' ";

  if ($result = mysqli_query($mysqli, $query)){
   $check = mysqli_num_rows($result); // check if already liked by this user if not insert lke
   if ($check == 0) {
  $query= "INSERT INTO `annotationBlog` (userID,blogPostID) VALUES ('$loggedInUser','$currentPost')";
  if($result = mysqli_query($mysqli, $query)){
    echo "<script>window.open('home.php','_self')</script>";
    // later ausblenden und page reload
  }}}
}


function showComments($currentPost){
  $mysqli = new mysqli("localhost","root","root","social_network");

  $query = "SELECT comment.commentID, comment.userID, comment.content, comment.timestamp, comment.blogPostID,
  user.firstName FROM comment LEFT JOIN user ON comment.userID = user.userID WHERE comment.blogPostID = '$currentPost'
  ORDER BY comment.timestamp DESC";

  //$query2 = "SELECT * FROM comment WHERE blogPostID = '$currentPost'";
  if ($result = mysqli_query($mysqli, $query)) {

    // Loop through result
    while ($row = mysqli_fetch_assoc($result)):

      $commentID[]  = $row['commentID'];
      $userIDComment[] = $row['userID'];
      $contentComment[] = $row['content'];
      $timestampComment[] =$row['timestamp'];
      $commentPoster[] = $row['firstName'];



          endwhile;
          //store arrays in Session variables
         $_SESSION["commentID"] =  $commentID;
         $_SESSION["userIDComment"] =   $userIDComment;
         $_SESSION["contentComment"] =   $contentComment;
         $_SESSION["timestampComment"] =   $timestampComment;
         $_SESSION["commentPoster"] =   $commentPoster;?>



<h2>Comments</h2>
<?php foreach(array_keys($_SESSION["commentID"]) as $key) { ?>
<p><?php echo $_SESSION["commentPoster"] [$key]; ?> commented: <?php   echo $_SESSION["contentComment"] [$key]; ?></p>


<?php   }}

}

function insertComment($currentPost,$currentUser,$commentContent){
  $mysqli = new mysqli("localhost","root","root","social_network");
  $query3 = $mysqli->prepare( "INSERT INTO comment (userID, content, blogPostID) Values ($currentUser, '$commentContent' , $currentPost) ");
  $query3->bind_param('s',$currentUser, $commentContent, $currentPost);
  $query3->execute();
  $result3 = $query3->get_result();
}


 ?>
