<?php
  session_start(); //necessary for every page to use session variable
  //necessary for every page to use session variable
  include("functions/user_verification.php");

  //setcookie("usercookie","$_SESSION['loggedInUserID']", time() + 60 * 10);

  if (array_key_exists("usercookie", $_COOKIE)){
    echo $_COOKIE['usercookie'];
  } else {
    echo "no cookies";
  }


?>
<!DOCTYPE html>
<html>
<?php
?>
</html>
