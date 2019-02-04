<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<!DOCTYPE>
    
<html>
    <head>
        <title>Admin Dashboard</title>
        
        <!-- Using the viewport meta tag to control layout on mobile browsers -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!--declaring character encoding -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/adminstyles.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        
        <!-- FONT FROM GOOGLE -->
        <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Shrikhand|Ubuntu+Condensed|Ubuntu:300" rel="stylesheet" type="text/css">
        
        <style>
            .FieldInfo{
                color: rgb(178, 34, 34); /* https://zeamedia.de/helper/rgb-hex-color-codes.php */
                font-family: Bitter,Georgia,"Times New Roman",Times,seriff;
                font-size: 1.2em;
            }
        </style>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"> <!--(Side Area)
                                        sm is for small screen.
                                        Bootstrap has 12 Columns col-sm-2it will add 2 columms-->
					<!-- logo -->
					<a href="dashboard.php"><img src="images/logo-1.png" alt="" /></a>										
                    <ul id="Side_Menu" class="nav nav-pills nav-stacked"> <!--- adding tabs -->
                        <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
                        <li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
                        <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Tags</a></li>
                        <li><a href="locations.php"><span class="glyphicon glyphicon-globe"></span>&nbsp;Locations</a></li>
                        <li><a href="admin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                    </ul>
                </div>
                <!-- Ending of side area -->
                
                <!-- Main Area -->
                <div class="col-sm-10">
                    <div>
                        <?php
                            echo Message();
                            echo SuccessMessage();
                        ?>
                    </div>
                    <span class="title-dashboard"> Admin Dashboard</span> <br/> <br/>
                    <div class="table-responsive">
                        <table id="MyTable" class="table table-striped table-hover tablesorter">
                            <tr>
                                <th>No</th>
                                <th>PostTitle</th>
                                <th>Date Time</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Post</th>
                                <th>Image</th>
                                <th>Action</th>
                                <th>Details</th>
                            </tr>
                            <?php
                                    $Connectingdb;
                                    $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc;";
                                    $Execute=mysql_query($ViewQuery);
                                    $SrNo= 0;
                                    while($DataRows=mysql_fetch_array($Execute)){
                                        $Id = $DataRows["id"];
                                        $DateTime = $DataRows["datetime"];
                                        $Category = $DataRows["category"];
                                        $Title = $DataRows["title"];
                                        $Admin = $DataRows["author"];
                                        $Post = $DataRows["post"];
                                        $Image = $DataRows["image"];
                                        $SrNo++;
                            ?>

                                
                            <tr>
                                
                                <td><?php echo $SrNo; ?></td> 
                                <td><?php  if(strlen($Title)>6){$Title=substr($Title,0,6).'...';} echo $Title; ?></td> 
                                <td><?php echo $DateTime;?></td> 
                                <td><?php echo $Admin;?></td> 
                                <td><?php echo $Category;?></td>
                                <td><?php if(strlen($Post)>50){$Post=substr($Post,0,50).'...';}
                                                echo htmlentities($Post);?></td> 
                                <td><img src="../Upload/<?php echo $Image; ?>" width="150px", height="80px"></td>
                                <td> 
                                    <a href="editpost.php?Edit=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a> 
                                    <a href="deletepost.php?Delete=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span> </td>
                                <td><a href="../single.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview </span></a></td> <!--targetblan = opening new tab -->

                            </tr>
   
                                    
                         <?php } ?>
                        </table>
                    </div>
					
                </div> <!-- Ending of Main Area -->
            </div> <!-- Ending of Row -->
            
        </div> <!-- ending of Container-->
        <div class="clearfix"></div>
        <!-- footer-->
            <div id= "footer" >
                <hr><p>&copy;Bootstrap | Kartika Sari Dewi & Kathrin El Kanz | Studiengang Informationswissenschaft | Programmierwerkstatt WS2017/18</p><hr>
            </div>
        <!--end-footer-->
	</body>
    
    
</html>