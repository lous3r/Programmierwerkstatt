<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php

if(isset($_POST["submit"])){
	$Username=mysql_real_escape_string($_POST["username"]);
	$Password=mysql_real_escape_string($_POST["password"]);
	
	if(empty($Username) OR empty($Password)){
		$_SESSION["ErrorMessage"] = "All Fields must be filled out";
		Redirect_to ("login.php");
	}
	else{
		$Found_Account=Login_Attempt($Username,$Password);
		$_SESSION["username"]=$_POST["username"];
		if($Found_Account){
			$_SESSION["SuccessMessage"]="Welcome {$_SESSION["username"]}";
			Redirect_to ("adminbereich/dashboard.php");
		}
		else{
			$_SESSION["ErrorMessage"]="Invalid Username/Password";
			Redirect_to ("login.php");
		}
	}
}




?>

<!DOCTYPE html>

<html>
<head>
	<title>Programmierwerkstatt</title>
	
	<!-- Using the viewport meta tag to control layout on mobile browsers -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--declaring character encoding -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
	
	<!-- password toggle visibility -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>

	
	<!-- FONT FROM GOOGLE -->
	<link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Shrikhand|Ubuntu+Condensed|Ubuntu:300" rel="stylesheet" type="text/css">
	

</head>


<body>
	<!--header-top-starts-->
	<div class="header-top">
		<div class="container">
			<div class="head-main">
				<a href="index.php"><img src="images/logo-1.png" width=150;height=30;/></a>
			</div>
		</div>
	</div>
	<!--header-top-end-->
	

	<!--start-header-->
	<div class="header">
		<div class="container">
			<div class="head">
				<span class="menu">
					<div class="navigation">
						<ul class="navig">
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About</a></li>
							<li><a href="blog.php">Blog</a></li>
							<li><a href="impressum.php">Contact</a></li>							
							<li><a href="login.php" class="active">Login</a></li>							
						</ul>
					</div>
				</span> 
							
				<!-- toggle responsive menu -->
				<script>
					$("span.menu").click(function(){
						$(" ul.navig").slideToggle("fast" , function(){
						});
					});
				</script>
				<!-- toggle ends here -->
				
				<!--header-top-starts-->
				<div class="header-right">
					<form class="navbar-form" role="search">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search" name="Search">
							<span class="input-group-btn"><button type="submit" class="btn btn-primary search-btn" name="SearchButton">GO</button></span>
						</div>
					</form>
					
					<?php
					ob_start();
					
					if (isset($_GET['SearchButton'])){
						$SearchParam = $_GET['SearchButton'];
					}
					else{
						$SearchParam = null;
					}
					
					if ($SearchParam !== null){
						header ("Location: blog.php?SearchButton=&Search=" . $_GET["Search"]);
						exit;
					}

					ob_end_flush();
					?>
					
					
				</div>				
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--start-header--ends-here-->
	


	<!----start-login---->
	<div class="about">
		<div class="container">
			<div class="about-main">
				<div class="about-one">
                        <br>
						<div class="col-md-offset-4 col-md-3">
							<h1>Login</h1><br>
							<div class="form-login">
								<form action="login.php" method="post">
									<input type="text" id="username" class="form-control input-sm chat-input" placeholder="username" name="username"><br/>
									<input type="password" id="password" class="form-control input-sm chat-input" placeholder="password" name="password" data-toggle="password"> <br/>
									<input type="submit" class="btn btn-primary" value="Submit" name="submit">
								</form>
							</div>
						</div>
                    </div>
				</div>
            </div>
		</div>
    </div>
	<!----end-login----
	
	
	
	<!--footer-starts-->
	<div class="footer">
		<div class="container">
			<div class="footer-text">
				<hr><p>&copy;Bootstrap | Kartika Sari Dewi & Kathrin El Kanz | Studiengang Informationswissenschaft | Programmierwerkstatt WS2017/18</p><hr>			</div>
			</div>
		</div>
	</div>
	<!--footer-end-->
</body>
</html>