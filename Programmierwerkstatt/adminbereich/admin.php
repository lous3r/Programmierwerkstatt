<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php


    
if(isset($_POST["Submit"]))
{
   $Username=mysql_real_escape_string ($_POST["Username"]);
   $Password=mysql_real_escape_string ($_POST["Password"]);
   $ConfirmPassword=mysql_real_escape_string ($_POST["ConfirmPassword"]);
   $Name=mysql_real_escape_string ($_POST["Name"]);
   $Email=mysql_real_escape_string ($_POST["Email"]);
   $Details=mysql_real_escape_string ($_POST["Details"]);
    $Image=$_FILES["Image"]["name"]; //2nd Parameter, name is like keyword
    $Target="../Upload/".basename($_FILES["Image"]["name"]);

    //validation: if this field of category is empty, then echo
   if($Password != $ConfirmPassword){
      
      $_SESSION["ErrorMessage"] ="passwords doesn't match";
      Redirect_to ("admin.php");
   }

   else
   {
      global $Connectingdb;
      
      $Query = "INSERT INTO user (username, password, name, email, image, details) VALUES ('$Username', '$Password', '$Name', '$Email', '$Image', '$Details')";
      move_uploaded_file ($_FILES["Image"]["tmp_name"],$Target);
      $Execute=mysql_query($Query);
      if($Execute){
          $_SESSION["SuccessMessage"]="New Admin Added Successfully";
          Redirect_to("admin.php");
          
      }
      else{
          $_SESSION["ErrorMessage"]="Admin failed to Add";
          Redirect_to("admin.php");
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
                     <li><a href="locations.php"><span class="glyphicon glyphicon-globe"></span>&nbsp;Locations</a></li>
                     <li class="active"><a href="admin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                     <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                  </ul>
            </div> <!-- Ending of side area -->
            <div class="col-sm-10">
                  <span class="title-dashboard">Manage Admin</span>
                 <?php
                     echo Message();
                     echo SuccessMessage();
                 ?>
                 <div class="form">
                     <form action="admin.php" method="post" enctype="multipart/form-data">
                         <fieldset>
                              <div class="form-group">  <!--form group is from bootstrap -->
                                  <label for="Username"><span class="FieldInfo">Username:</span></label>
                                  <!-- form control is from bootsrap -->
                                  <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                              </div>
                              <div class="form-group">  <!--form group is from bootstrap -->
                                  <label for="Password"><span class="FieldInfo">Password:</span></label>
                                  <!-- form control is from bootsrap -->
                                  <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
                              </div>
                              <div class="form-group">  <!--form group is from bootstrap -->
                                  <label for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span></label>
                                  <!-- form control is from bootsrap -->
                                  <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirm Password" >
                              </div>                             
                              <div class="form-group">  <!--form group is from bootstrap -->
                                  <label for="Name"><span class="FieldInfo">Name:</span></label>
                                  <!-- form control is from bootsrap -->
                                  <input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
                              </div>
                               <div class="form-group">  <!--form group is from bootstrap -->
                                  <label for="Email"><span class="FieldInfo">E-Mail:</span></label>
                                  <!-- form control is from bootsrap -->
                                  <input class="form-control" type="text" name="Email" id="Email" placeholder="E-Mail">
                              </div>
                              <div class="form-group">
                                    <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
                                    <input type="file" class="form-group" name="Image" id="imageselect">
                              </div>
                              <div class="form-group">
                                 <label for="detailarea"><span class="FieldInfo">How Would You Describe Yourself?</span></label>
                                 <textarea class="form-control" name="Details" id="detailarea"></textarea>
                              </div>
                                 <!-- btn is from bootsrap, default means white, danger means red -->
                             <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Admin">
                         </fieldset>
                     </form>
                 </div>
                  <div class="table-responsive"> <!-- to make the table below responsive -->
                     <table class="table table-bordered table-striped table-hover">
                           <tr>
                              <th>Userid</th>
                              <th>Username</th>
                              <th>Name</th>
                              <th>E-Mail</th>
                           </tr>
                           <?php 
                           global $Connectingdb;
                           /*
                           without ORDER BY desc, the data will show in ascending, 
                           the last one would be first, the new one would be in the end
                           */
                           $ViewQuery="SELECT * FROM user"; 
                           $Execute=mysql_query($ViewQuery) or die(mysql_error());
                           $SrNo=0; //as increment for the loop
                           
                           while($DataRows=mysql_fetch_array($Execute)){
                              $Id=$DataRows["userid"];
                              $Username=$DataRows["username"];
                              $Name=$DataRows["name"];
                              $Email=$DataRows["email"];
                              $SrNo++;
                           
                           ?>
                           <tr>
                              <td><?php echo $Id; ?></td>
                              <td><?php echo $Username; ?></td>
                              <td><?php echo $Name; ?></td>
                              <td><?php echo $Email; ?></td>
                           </tr>
                           <?php } ?>
                     </table>
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
