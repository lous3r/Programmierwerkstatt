<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php
if(isset($_POST["Submit"]))
{
    //name=Category from <input class="btn btn-default" type="Submit" name="Submit" value="Add New Category">
    $Category=mysql_real_escape_string ($_POST["Category"]);
    $CurrentTime=time();
    $DateTime=strftime ("%d-%m-%Y %H:%M:%S", $CurrentTime);
    $DateTime;
    $Admin=$_SESSION["username"];
    //validation: if this field of category is empty, then echo
    if (empty($Category))
    {
        $_SESSION["ErrorMessage"] ="All Fields must be filled out"; //Just echo, this will not show up, use SESSION
        Redirect_to ("categories.php");
        // Look at Database for the name of Category should be just VARCHAR100
        
    }
    elseif(strlen($Category)>99)
    {
        $_SESSION["ErrorMessage"]="Name is too long";
        Redirect_to ("categories.php");
        
    }
    else
    {
        global $Connectingdb;

        $Query = "INSERT INTO category (datetime, name, creatorname) VALUES ('$DateTime', '$Category', '$Admin')";

        $Execute=mysql_query($Query);
        if($Execute){
            $_SESSION["SuccessMessage"]="Category Added Successfully";
            Redirect_to("categories.php");
            
        }
        else{
            $_SESSION["ErrorMessage"]="Category failed to Add";
            Redirect_to("categories.php");
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
                     <li class="active"><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Tags</a></li>
                     <li><a href="locations.php"><span class="glyphicon glyphicon-globe"></span>&nbsp;Locations</a></li>
                     <li><a href="admin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                     <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                  </ul>
               </div> <!-- Ending of side area -->
               <div class="col-sm-10">
                     <span class="title-dashboard">Manage Tags</span>
                    <?php
                        echo Message();
                        echo SuccessMessage();
                    ?>
                  <div class="form">
                        <form action="categories.php" method="post">
                            <fieldset>
                                <div class="form-group">  <!--form group is from bootstrap -->
                                    <label for="categoryname"><span class="FieldInfo">Name:</span></label>
                                    <!-- form control is from bootsrap -->
                                    <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
                                </div>
                                    <!-- btn is from bootsrap, default means white, danger means red -->
                                <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
                            </fieldset>
                        </form>
                  </div>
                  <div>
                     <div class="table-responsive"> <!-- to make the table below responsive -->
                        <table class="table table-bordered table-striped table-hover">
                           <tr>
                              <th>Sr. No.</th>
                              <th>Date & Time</th>
                              <th>Category Name</th>
                              <th>Creator Name</th>
                           </tr>
                           <?php 
                           global $Connectingdb;
                           /*
                           without ORDER BY desc, the data will show in ascending, 
                           the last one would be first, the new one would be in the end
                           */
                           $ViewQuery="SELECT * FROM `pwws17db01`.`category` ORDER BY datetime desc"; 
                           $Execute=mysql_query($ViewQuery) or die(mysql_error());
                           $SrNo=0; //as increment for the loop
                           
                           while($DataRows=mysql_fetch_array($Execute)){
                              $Id=$DataRows["id"];
                              $DateTime=$DataRows["datetime"];
                              $CategoryName=$DataRows["name"];
                              $CreatorName=$DataRows["creatorname"];
                              $SrNo++;
                           
                           ?>
                           <tr>
                              <td><?php echo $SrNo; ?></td>
                              <td><?php echo $DateTime; ?></td>
                              <td><?php echo $CategoryName; ?></td>
                              <td><?php echo $CreatorName; ?></td>
                           </tr>
                           <?php } ?>
                        </table>
                     </div>
                  </div>
               </div> <!-- Ending of Main Area -->
         </div> <!-- Ending of Row -->
      </div> <!-- ending of Container-->
        <!-- footer-->
            <div id= "footer">
                <hr><p>&copy;Bootstrap | Kartika Sari Dewi & Kathrin El Kanz | Studiengang Informationswissenschaft | Programmierwerkstatt WS2017/18</p><hr>
            </div>
        <!--end-footer-->
   </body>
    
    
</html>
