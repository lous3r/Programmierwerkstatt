<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php
if(isset($_POST["Submit"]))
{
    //name=Category from <input class="btn btn-default" type="Submit" name="Submit" value="Add New Category">
    $Title=mysql_real_escape_string ($_POST["Title"]); //As 1st Value
    $Category=mysql_real_escape_string ($_POST["Category"]); //As 2nd Value
    //we don't need adding 3rd value for image
    $Post=mysql_real_escape_string ($_POST["Post"]); //As 2nd Value
    $CurrentTime=time();
    $DateTime=strftime ("%d-%m-%Y", $CurrentTime);
    $DateTime;
    $Admin=mysql_real_escape_string ($_POST["Admin"]);
    $Image=$_FILES["Image"]["name"]; //2nd Parameter, name is like keyword
    $Target="../Upload/".basename($_FILES["Image"]["name"]);
    

    global $Connectingdb;
    $DeleteFromURL=$_GET['Delete'];
    $Query = "DELETE FROM admin_panel WHERE id='$DeleteFromURL'";
    $Execute=mysql_query($Query);
    move_uploaded_file ($_FILES["Image"]["tmp_name"],$Target);
    if($Execute){
        $_SESSION["SuccessMessage"]="Post deleted Successfully";
        Redirect_to("dashboard.php");
        
    }
    else{
        $_SESSION["ErrorMessage"]="Something went wrong. Try again :)";
        Redirect_to("dashboard.php");
    }
        



    
}


?>
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
                font-family: Ubuntu;
                font-size: 1.2em;
            }
        </style>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"> <!--(Side Area)
                                        sm is for smalsl screen.
                                        Bootstrap has 12 Columns col-sm-2it will add 2 columms-->
					<!-- logo -->
					<a href="dashboard.php"><img src="images/logo-1.png" alt="" /></a>										
					<ul id="Side_Menu" class="nav nav-pills nav-stacked"> 
						<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
					    <li class="active"><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
						<li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Tags</a></li>
                        <li><a href="locations.php"><span class="glyphicon glyphicon-globe"></span>&nbsp;Locations</a></li>
						<li><a href="admin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
					</ul>
                </div>
                <!-- Ending of side area -->
                
                <div class="col-sm-10">
                    <span class="title-dashboard">Delete Post</span>
                    <?php
                        echo Message();
                        echo SuccessMessage();
                    ?>    
                    <div class="form">
                        <?php
                                    $SearchQueryParameter=$_GET['Delete']; //To search id by using superglobal $_GET
                                    $Connectingdb;
                                    $Query="SELECT * from admin_panel Where id='$SearchQueryParameter'";
                                    $ExecuteQuery=mysql_query($Query);
                                    while($DataRows=mysql_fetch_array($ExecuteQuery)){
                                        $TitleToBeUpdated=$DataRows['title'];
                                        $CategoryToBeUpdated=$DataRows['category'];
                                        $ImageToBeUpdated=$DataRows['image'];
                                        $PostToBeUpdated=$DataRows['post'];
                                    }
                        
                        ?>
						<!-- use multipart/form-data bcos our form includes any <input type="file"> (Bsp: Images) elements. -->
                        <form action="deletepost.php?Delete=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data"> <!-- to succssessfully updated to dashboard -->
                            <fieldset>
                                <div class="form-group">
                                    <!--form group is from bootstrap -->
                                    <label for="title"><span class="FieldInfo">Title:</span></label> <!-- form control is from bootsrap -->
                                     <input disabled value="<?php  echo $TitleToBeUpdated; ?>"class="form-control" type="text" name="Title" id="title" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <span class="FieldInfo">Existing Category:</span>
                                    <?php echo $CategoryToBeUpdated ?>
                                    <br/>
                                    <label for="categoryselect"><span class="FieldInfo">Category:</span></label> <select disabled class="form-control" id="categoryselect" name="Category">
                                        <?php 
                                                    global $Connectingdb;
                                                    /*
                                                    without ORDER BY desc, the data will show in ascending, 
                                                    the last one would be first, the new one would be in the end
                                                    */
                                                    $ViewQuery="SELECT * FROM category ORDER BY datetime desc"; 
                                                    $Execute=mysql_query($ViewQuery);
                                                    
                                                    while($DataRows=mysql_fetch_array($Execute)){
                                                        $Id=$DataRows["id"];
                                                        $CategoryName=$DataRows["name"];
                                                
                                                    ?>
                                    <option><?php echo $CategoryName; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>               
                                <div class="form-group">
                                    <span class="FieldInfo">Existing Image:</span>
                                    <img src="../Upload/<?php echo $ImageToBeUpdated;?>" width="150px" height="80px">
                                    <br/>
                                    <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
                                    <input disabled type="file" class="form-group" name="Image" id="imageselect">
                                </div> 
                                <div class="form-group">
                                    <label for="postarea"><span class="FieldInfo">Post:</span></label>
                                    <textarea disabled class="form-control" name="Post" id="postarea"> <?php echo $PostToBeUpdated; ?></textarea>
                                </div>
                                <input class="btn btn-danger btn-block" type="submit" name="Submit" value="Delete Post">
                            </fieldset>
                        </form>
                    </div>
                </div> <!-- Ending of Main Area -->
            </div> <!-- Ending of Row -->
            
        </div> <!-- ending of Container-->
        <!-- footer-->
            <div id= "footer" >
                <hr><p>&copy;Bootstrap | Kartika Sari Dewi & Kathrin El Kanz | Studiengang Informationswissenschaft | Programmierwerkstatt WS2017/18</p><hr>
            </div>
        <!--end-footer-->
    </body>
    
    
</html>
