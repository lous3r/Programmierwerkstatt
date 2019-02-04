<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>

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
							<li><a href="impressum.php" class="active">Contact</a></li>							
							<li><a href="login.php">Login</a></li>							
						</ul>
					</div>
				</span> 
							
				<!-- toggle responsive menu -->
				<script>
					$("span.menu").click(function(){
						$(" ul.navig").slideToggle("slow" , function(){
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
	
	
	<!----start-impressum---->
	
	
	<div class="about">
		<div class="container">
			<div class="about-one">
				<h1>Contact</h1>
				<br/>
				<br/>			
				<br/>
			</div>
			<div class="impressum">
				<div class="col-sm-7">
					<span class="impressum-text">How to find us</span>
					<div id="maps" style="position:relative; width:100%; height:0px; padding-bottom:57%;">
						<iframe style="position:absolute; left:0; top:0; width:100%; height:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2569.842454705092!2d8.852687515862176!3d49.90176103462826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bd690fb15b4e07%3A0x2e9a97c4440c642f!2sH-Da!5e0!3m2!1sde!2sde!4v1517089412675" width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
						</iframe>
					</div>
				</div>	
				<div class="col-sm-4">
					
					<span class="impressum-text">Get in touch</span>
					<span class=abt-left-2>
					<?php
					
						global $Connectingdb;	

						$query = "SELECT * FROM user";
						$Execute=mysql_query($query) or die(mysql_error());
						
							
		
						while ($row = mysql_fetch_array($Execute)) {
						
						 echo '<p>
								<br />Author:  <p> <b> <i> ' . $row['username'] . '</b> </i><br /> Name: ' . $row['name'] . '<br />Kontakt: ' . $row['email'] .'<br /> </p>';
		
						}
					
					
					?>
					</span>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	
	<!----end-impressum---->
	
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