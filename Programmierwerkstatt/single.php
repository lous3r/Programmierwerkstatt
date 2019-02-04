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
							<li><a href="blog.php" class="active">Blog</a></li>
							<li><a href="impressum.php">Contact</a></li>							
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
	
	
	<!--start-single-->

    <div class="single">
        <div class="container">
            <div class="single-top">
				<?php
				global $Connectingdb;
				$PostIDFromURL=$_GET["id"];
				$ViewQuery = "SELECT * FROM admin_panel WHERE id='$PostIDFromURL' ORDER BY datetime desc";	
				$Execute=mysql_query($ViewQuery) or die(mysql_error());
				while ($DataRows=mysql_fetch_array($Execute)){
					$PostId=$DataRows["id"];
					$DateTime=$DataRows["datetime"];
					$Title=$DataRows["title"];
					$Category=$DataRows["category"];
					$Admin=$DataRows["author"];
					$Image=$DataRows["image"];
					$Post=$DataRows["post"];
					$Location=$DataRows["location"];
				
			
				?>
                <div class=" single-grid">
					<a href="#"><img class="img-responsive" src="Upload/<?php echo $Image; ?>"  alt=""  /></a>
                    <h4><?php echo htmlentities($Title); ?></h4>

                    <ul class="blog-ic">
                        <li><i class="glyphicon glyphicon-user"> </i> <a href="about.php"><span><?php echo htmlentities($Admin); ?></span></a></li>

                        <li><i class="glyphicon glyphicon-time"> </i><span><?php echo htmlentities($DateTime); ?></span></li>
						
						<li><i class="glyphicon glyphicon-cutlery"> </i><span><?php echo htmlentities($Location); ?></span></li>

                    </ul>

                    <p><?php echo htmlentities($Post);?></p>
				</div>
				<?php } ?>
            </div>
        </div>
    </div>
	<!--end-single-->
	
	
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
