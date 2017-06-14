<?php session_start();  ?>
<!DOCTYPE html>
<html lang="en">
<?php
 include("functions/user_verification.php") //include php code
 ?>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.css" rel="stylesheet">
<title style="color:#f44336;">Welcome to the Social Circle</title>
</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
               <!-- <a class="navbar-brand page-scroll" href="#page-top">Home</a>-->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about" style="color:black">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#page-top" style="color:black">Home</a>
                    </li>
                   <!-- <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading" style="color:#f44336;">Welcome to the Social Circle</h1>
                <hr>
<p>

<!--  <a href="index.html" class="btn btn-primary btn-xl page-scroll">Sign Up</a> -->
                  <!--   <button2  onclick="document.getElementById('id01').style.display='inline-block'" style="color:#f44336">Log In</button2>
  <p>                <button2  onclick="document.getElementById('id02').style.display='inline-block'" style="color:#f44336">Sign Up</button2> -->


  <form class="LoginForm" action="" method="post">


  <div class="container1">
      <div class="col-md-4"><big>
        <label style="color:black"><b>Email Address</b></label></big>
        <input class="tb1" type="text" style="color:#f44336" placeholder="Enter Email Address" name="email" required>
<big>
        <label style="color:black"><b>Password</b></label></big>
        <input class="tb2" type="password" style="color:#f44336" placeholder="Enter Password" name="password" required>
        <big>
         <input type="submit" name="SubmitLogin" value="Login" style="color:black"></big>

      <!--    <button type="submit" id="myButton" class="float-left submit-button" >Login</button>  -->  <!--Button doesn't work as submit yet, figure out why-->
      <!--   <input type="checkbox" checked="checked"> Remember me < -->
      </div>

      </div>
      </form>
      <?php loginUser(); ?>



<form class="SignUpForm" action="" method="post">


<div class="container2">
    <div class="col-md-4"><big>
      <label style="color:black"><b>First Name</b></label></big>
      <input class="tb1" type="text" style="color:#f44336" placeholder="Enter First Name" name="firstName" required>
<big>
      <label style="color:black"><b>Last Name</b></label></big>
      <input class="tb1" type="text" style="color:#f44336" placeholder="Enter Last Name" name="lastName" required>
<big>
      <label style="color:black"><b>Email Address</b></label></big>
      <input class="tb1" type="text" style="color:#f44336" placeholder="Enter Email Address" name="email" required>
<big>
      <label style="color:black"><b>Password</b></label></big>
      <input class="tb2" type="password" style="color:#f44336" placeholder="Enter Password" name="password" required>

    <!--  <input class="tb2" type="password" style="color:#f44336" placeholder="Re type Enter Password" name="passwordRepeated" > -->
      <!--2nd Password right now only as dummy, add verification--><big>
      <input type="submit" name="SubmitSignup" value="Register" style="color:black"></big>
    <!--  <button id="myButton" class="float-left submit-button" >Sign Up</button> --> <!--Button doesn't work as submit yet, figure out why-->
      <input type="checkbox" checked="checked"> Remember me
    </div>

    </div>
    </form>
    <?php insertUser(); ?>
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


</p>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">About</h2>
                    <hr class="light">
                    <p class="text-faded">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                   <!-- <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Get Started!</a>-->
                </div>
            </div>
        </div>
    </section>



    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>

</body>
 <!-- Button to open the modal login form -->
<!--<button onclick="document.getElementById('id01').style.display='block'">Log in</button> -->














<!-- The Modal -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
class="close" title="Close Modal">&times;</span>



  <!-- Modal Content -->
  <form class="modal-content animate" action="action_page.php">









  </form>
</div>

<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'"
class="close" title="Close Modal">&times;</span>

  <!-- Modal Content -->
  <form class="modal-content animate" action="action_page.php">
  </form>
</div>

</html>
