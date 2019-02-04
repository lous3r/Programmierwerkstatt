<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php
if(isset($_POST["Submit"]))
{
    //name=Category from <input class="btn btn-default" type="Submit" name="Submit" value="Add New Category">
    $Name=mysql_real_escape_string ($_POST["Name"]);
    $Address=mysql_real_escape_string ($_POST["Address"]);
    $Website=mysql_real_escape_string ($_POST["Website"]);
    $RestaurantTypes=mysql_real_escape_string ($_POST["RestaurantTypes"]);
    $Admin=$_SESSION["username"];

    //validation: if this field of category is empty, then echo
    if (empty($Name))
    {
        $_SESSION["ErrorMessage"] ="Name can't be empty"; 
        Redirect_to ("locations.php");

        
    }
    elseif(strlen($Name)<2)
    {
        $_SESSION["ErrorMessage"]="Name should be at least 2 Characters";
        Redirect_to ("locations.php");
        
    }
    else
    {
        global $Connectingdb;

        $Query = "INSERT INTO location (name, adresse, website, restaurantart, creatorname) VALUES ('$Name', '$Address', '$Website', '$RestaurantTypes', '$Admin')";

        $Execute=mysql_query($Query);
        if($Execute){
            $_SESSION["SuccessMessage"]="Location Added Successfully";
            Redirect_to("locations.php");
            
        }
        else{
            $_SESSION["ErrorMessage"]="Location failed to Add";
            Redirect_to("locations.php");
        }
        

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
                  <ul id="Side_Menu" class="nav nav-pills nav-stacked"> 
                     <li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
                     <li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
                     <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Tags</a></li>
                     <li class="active"><a href="locations.php"><span class="glyphicon glyphicon-globe"></span>&nbsp;Locations</a></li>
                     <li><a href="admin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                     <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                  </ul>
               </div> <!-- Ending of side area -->
               <div class="col-sm-10">
                    <span class="title-dashboard">Add New Location</span>
                    <?php
                        echo Message();
                        echo SuccessMessage();
                    ?>
                  <div class="form">
						<!-- use multipart/form-data bcos our form includes any <input type="file"> (Bsp: Images) elements. -->
                        <form action="locations.php" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <!--form group is from bootstrap -->
                                    <label for="title"><span class="FieldInfo">Name:</span></label> <!-- form control is from bootsrap -->
                                     <input class="form-control" type="text" name="Name" id="name" placeholder="Name">
                                </div>
                                
                                <div class="form-group">
                                    <!--form group is from bootstrap -->
                                    <label for="title"><span class="FieldInfo">Address:</span></label> <!-- form control is from bootsrap -->
                                     <input class="form-control" type="text" name="Address" id="Address" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label for="imageselect"><span class="FieldInfo">Website</span></label>
                                    <input class="form-control" type="text" name="Website" id="Website" placeholder="Website">
                                </div>
                              <div class="form-group">
                                    <label for="restaurantselect"><span class="FieldInfo">Type of Food Place:</span></label> <select class="form-control" id="restaurantselect" name="RestaurantTypes">
                                        <?php 
                                                    global $Connectingdb;
                                                    /*
                                                    without ORDER BY desc, the data will show in ascending, 
                                                    the last one would be first, the new one would be in the end
                                                    */
                                                    $ViewQuery="SELECT * FROM restaurant"; 
                                                    $Execute=mysql_query($ViewQuery);
                                                    
                                                    while($DataRows=mysql_fetch_array($Execute)){
                                                        $Id=$DataRows["id"];
                                                        $TypeOfRestaurant=$DataRows["restaurantart"];
                                                
                                                    ?>
                                    <option><?php echo $TypeOfRestaurant; ?></option>
                                    <?php } ?>
                                    </select>
                              </div>
                                <input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Location">
                            </fieldset>
                        </form>
                  </div>
                  <div class="table-responsive"> <!-- to make the table below responsive -->
                     <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                           <th>Sr. No.</th>
                           <th>Name</th>
                           <th>Address</th>
                           <th>Website</th>
                           <th>Type of Restaurant</th>
                           <th>Creator Name</th>
                        </tr>
                        </thead>
                        <?php 
                        global $Connectingdb;
                        /*
                        without ORDER BY desc, the data will show in ascending, 
                        the last one would be first, the new one would be in the end
                        */
                        $ViewQuery="SELECT * FROM location"; 
                        $Execute=mysql_query($ViewQuery) or die(mysql_error());
                        $SrNo=0; //as increment for the loop
                        
                        while($DataRows=mysql_fetch_array($Execute)){
                           $Id=$DataRows["id"];
                           $Name=$DataRows["name"];
                           $Address=$DataRows["adresse"];
                           $Website=$DataRows["website"];
                           $TypeOfRestaurant=$DataRows["restaurantart"];
                           $CreatorName=$DataRows["creatorname"];
                           $SrNo++;
                        
                        
                        ?>
                        <tbody>
                        <tr>
                           <td><?php echo $SrNo; ?></td>
                           <td><?php echo $Name; ?></td>
                           <td><?php echo $Address; ?></td>
                           <td><?php echo $Website; ?></td>
                           <td><?php echo $TypeOfRestaurant; ?></td>
                           <td><?php echo $CreatorName; ?></td>
                        </tr>
                        </tbody>
                        <?php } ?>
                     </table>
                  </div>
               </div> <!-- Ending of Main Area -->
            </div> <!-- Ending of Row -->
         </div> <!-- ending of Container-->
        <!-- footer-->
            <div id = "footer" >
                <hr><p>&copy;Bootstrap | Kartika Sari Dewi & Kathrin El Kanz | Studiengang Informationswissenschaft | Programmierwerkstatt WS2017/18</p><hr>
            </div>
        <!--end-footer-->
   </body>
    
    
</html>

