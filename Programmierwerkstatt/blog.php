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
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	
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
				
				<div class="header-right">
					<form class="navbar-form" role="search">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search" name="Search">
							
							<span class="input-group-btn">
								<a href="blog.php?SearchButton=&Search=$_Get['search']">
									<button type="submit" class="btn btn-primary search-btn" name="SearchButton">GO</button>
								</a>
							</span>
						</div>
					</form>
				</div>				
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--start-header--ends-here-->

<div class="about">
	<div class="container">
			<div class="about-one">
				<h1>Our Blog</h1>
				<br/>
				<br/>
			</div>
				<p><b>Tags:  </b></p>
			<!-- Brauchen wir SQL Injection? -->
				<?php
					global $Connectingdb;
				
					$TagQuery = "SELECT name FROM category";	
					$ExecuteTags=mysql_query($TagQuery) or die(mysql_error());
					
                
					echo "<a href=\"blog.php\"><button type=\"submit\" class=\"btn btn-success\" name=\"tagbutton\">Alle</button></a> &nbsp;";
					while ($DataRows=mysql_fetch_array($ExecuteTags)){
						$Tag = $DataRows["name"];
						
						echo "<a href=\"blog.php?tag=$Tag\"><button type=\"submit\" class=\"btn btn-success\" name=\"tagbutton\">". htmlentities($Tag) ."</button></a> &nbsp;";}
					
					//The Search Codes 
					if(isset($_GET["SearchButton"])){
						$Search=$_GET["Search"];
						$ViewQuery="SELECT * FROM admin_panel
						WHERE
						author LIKE '%$Search%' OR
						location LIKE '%$Search%' OR
						datetime LIKE '%$Search%' OR 
						title LIKE '%$Search%' OR
						category LIKE '%$Search%' OR
						post LIKE '%$Search%'";//just $Search it will give 0 found´
					}
					//This ones for the tagging
					else if (isset($_GET["tag"])) {
						$Tag = $_GET["tag"];
						$ViewQuery = "SELECT * FROM admin_panel where category = '$Tag'";
					}
					// to show everything on the Blog
				    else {
						$ViewQuery = "SELECT * FROM admin_panel";
						//echo $ViewQuery;
					}
				
					$ViewQueryResult = mysql_query($ViewQuery) or die(mysql_error());
					$number_of_results = mysql_num_rows($ViewQueryResult);
						
					$results_per_page = 4;
					
					$number_of_pages = ceil($number_of_results/$results_per_page);
					
					if(!isset($_GET['page'])){
						$page = 1;
					}else {
						$page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;

					$sql = $ViewQuery . " ORDER BY admin_panel.datetime desc LIMIT " . $this_page_first_result . ',' . $results_per_page;
				
					$result = mysql_query($sql) or die(mysql_error());
			
					
					//pagination

				
					//end of pagination
					while ($DataRows=mysql_fetch_array($result)){
						$PostId=$DataRows["id"];
						$DateTime=$DataRows["datetime"];
						$Title=$DataRows["title"];
						$Category=$DataRows["category"];
						$Admin=$DataRows["author"];
						$Image=$DataRows["image"];
						$Post=$DataRows["post"];	
				?>
			<div class="about-tre">
				<div class="a-1">
					<div class="col-md-10 abt-left">
						<br/>
						<br/>
						<a href="single.php?id=<?php echo $PostId ?>"><img class="img-responsive" src="Upload/<?php echo $Image; ?>"   /></a>
						<h6>Posted by <?php echo htmlentities($Admin); ?></h6>
						<h3><a href="single.php?id=<?php echo $PostId ?>"><?php echo htmlentities($Title); ?></a></h3>
						<p><?php
							if(strlen($Post)>150){$Post=substr($Post,0,150).'...';}
							echo htmlentities($Post);?>
						</p>
						<p><b>Tags:</b>     <button class="btn btn-success"> <?php echo htmlentities($Category)?></button> </p>
						<p><a href="single.php?id=<?php echo $PostId ?>"><span class="btn btn-primary btn-xs"> Read More &rsaquo;&rsaquo; </span></a></p>
						<label> <?php echo htmlentities($DateTime); ?></label>
						<br/>
						<br/>
						<br/>

					</div>
				</div>

					
			</div>
			<?php } ?>
					<div class="clearfix"></div>
					
	</div>
</div>





				
<!--Pagination-->
	
<div class="about-one">

		<div class="pagination">
			<?php
				if (isset($_GET['page'])){
					$pageparam = $_GET['page'];
				}
				else{
					$pageparam = 1;
				}
				
				for ($page=1;$page<=$number_of_pages;$page++){

						if ($page == $pageparam){
						echo '<li><a href="blog.php?page=' . $page . '"class="active">' . $page . '</a> </li> ';}
						else{
							echo '<li><a href="blog.php?page=' . $page . '">' . $page . '</a> </li>';
						}
				}
					
					
				
			?>
		</div>
</div>

<!--/Pagination ends-->

	

	<!--Blog ends-->
	

	
	<!--footer-starts-->
	<div class="footer">
			<div class="footer-text">
				<hr><p>&copy;Bootstrap | Kartika Sari Dewi & Kathrin El Kanz | Studiengang Informationswissenschaft | Programmierwerkstatt WS2017/18</p><hr>
			</div>
	</div>
	<!--footer-end-->
					
</body>