<?php                                                                                                                                                                
// Start the session                                                                                                                                                 
session_start();                                                                                                                                                     
if (isset($_SESSION["user_id"])) {                                                                                                                                   
    $user_id = $_SESSION["user_id"];                                                                                                                                 
} else {                                                                                                                                                             
    header("Location: login.php");                                                                                                                                   
    exit;                                                                                                                                                            
}                                                                                                                                                                    
?>                                                                                                                                                                   
                                                                                                                                                                     
<!DOCTYPE html>                                                                                                                                                      
<html>                                                                                                                                                               
<head>                                                                                                                                                               
    <title>PetCare</title>                                                                                                                                           
    <link rel="stylesheet" type="text/css" href="./vendor/bootstrap/css/bootstrap.min.css">                                                                          
    <link rel="stylesheet" type="text/css" href="./vendor/css/style.css">                                                                                            
    <link rel="stylesheet" type="text/css" href="./vendor/css/new-task-styling.css">                                                                                 
    <link rel="stylesheet" href="./vendor/css/bootstrap-datetimepicker.min.css">                                                                                     
                                                                                                                                                                     
    <script src="./vendor/js/jquery-3.2.0.min.js"></script>                                                                                                          
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>                                                                                                   
    <script src="./vendor/js/jquery.ns-autogrow.min.js"></script>                                                                                                    
    <script src="./vendor/js/bootstrap-datetimepicker.min.js"></script>                                                                                              
    <script src="./vendor/js/find-task.js"></script>                                                                                                                 
</head>                                                                                                                                                              
<body>                                                                                                                                                               
<!-- include php -->                                                                                                                                                 
<?php include "config/db-connection.php"; ?>                                                                                                                         
<?php                                                                                                                                                                
                                                                                                                                                                     
$query = "SELECT name, email, address FROM pet_user WHERE user_id = $user_id";                                                                                       
$result = pg_query($query) or die('Query failed: ' . pg_last_error());                                                                                               
                                                                                                                                                                     
$row = pg_fetch_row($result);                                                                                                                                        
$user_name = $row[0];                                                                                                                                                
$user_email = $row[1];                                                                                                                                               
$user_address = $row[2];                                                                                                                                             
                                                                                                                                                                     
?>                                                                                                                                                                   
                                                                                                                                                                     
                                                                                                                                                                     
<!--navigation bar-->                                                                                                                                                
<nav class="navbar navbar-inverse navigation-bar navbar-fixed-top">                                                                                                  
    <div class="container navbar-container">                                                                                                                         
        <div class="navbar-header pull-left"><a class="navbar-brand" href=""> PetCare</a></div>                                                                      
        <div class="nav navbar-nav navbar-form">                                                                                                                     
            <div class="input-icon">                                                                                                                                 
                <i class="glyphicon glyphicon-search search"></i>                                                                                                    
                <input type="text" placeholder="Type to search..." class="form-control search-form" tabindex="1">                                                    
            </div>                                                                                                                                                   
        </div>                                                                                                                                                       
        <div class="collapse navbar-collapse pull-right">                                                                                                            
            <ul class="nav navbar-nav">                                                                                                                              
                <li><a href="request.php"> Send Request </a></li>                                                                                                    
                <li><a href="history.php"> View History </a></li>                                                                                                    
                <li><a href="logout.php"> Log Out </a></li>                                                                                                          
            </ul>                                                                                                                                                    
        </div>                                                                                                                                                       
    </div>                                                                                                                                                           
</nav>                                                                                                                                                               
<div class="content-container container">                                                                                                                            
    <!-- page content -->                                                                                                                                            
    <div class="container-fluid">                                                                                                                                    
                                                                                                                                                                     
        <!-- panel -->                                                                                                                                               
        <div class="panel new-task-panel">                                                                                                                           
            <div class="row">                                                                                                                                        
                <div class="col-md-12">                                                                                                                              
                    <div class="container">                                                                                                                          
                                                                                                                                                                     
                        <div>                                                                                                                                        
                            <h2>Hello <?php echo $user_name;?> </h2>                                                                                                 
                        </div>                                                                                                                                       
                        <table>                                                                                                                                      
                                                                                                                                                                     
                            <tr>                                                                                                                                     
                            <th>Email:</th>                                                                                                                          
                                <td><?php echo $user_email;?></td>                                                                                                   
                            </tr>                                                                                                                                    
                            <tr>                                                                                                                                     
                                <th>Address:</th>                                                                                                                    
                                <td><?php echo $user_address;?></td>                                                                                                 
                            </tr>                                                                                                                                    
                        </table>                                                                                                                                     
                    </div>                                                                                                                                           
                </div>                                                                                                                                               
            </div>                                                                                                                                                   
                                                                                                                                                                     
                                                                                                                                                                     
                                                                                                                                                                     
                                                                                                                                                                     
            <div class="row">                                                                                                                                        
                <div class="col-md-12">                                                                                                                              
                    <div class="container">                                                                                                                          
                        <h3>Your pets</h3>                                                                                                                           
                    </div>                                                                                                                                           
                                                                                                                                                                     
                    <table class="table table-striped">                                                                                                              
                                                                                                                                                                     
                        <tr>                                                                                                                                         
                            <th>Pet ID</th>                                                                                                                          
                            <th>Pet Name</th>                                                                                                                        
                            <th>Pet Size</th>                                                                                                                        
                            <th>Pet Age</th>                                                                                                                         
                        </tr>                                                                                                                                        
                                                                                                                                                                     
                                                                                                                                                                     
                        <?php                                                                                                                                        
                        $query = "SELECT * FROM pet p WHERE p.owner_id =$user_id;";                                                                                  
                        $result = pg_query($query) or die('Query failed: ' . pg_last_error());                                                                       
                                                                                                                                                                     
                                                                                                                                                                     
                        while ($row = pg_fetch_row($result)) {                                                                                                       
                                                                                                                                                                     
                            $pet_id = $row[0];                                                                                                                       
                            $pet_name = pg_fetch_row(pg_query("SELECT name FROM petcategory WHERE pcat_id = " . $row[2] . ";"))[0];                                  
                            $pet_size = pg_fetch_row(pg_query("SELECT size FROM petcategory WHERE pcat_id = " . $row[2] . ";"))[0];                                  
                            $pet_age = pg_fetch_row(pg_query("SELECT age FROM petcategory WHERE pcat_id = " . $row[2] . ";"))[0];                                    
                                                                                                                                                                     
                            echo "<tr>";                                                                                                                             
                            echo "<td >$pet_id</td >";                                                                                                               
                            echo "<td >$pet_name</td >";                                                                                                             
                            echo "<td >$pet_size</td >";                                                                                                             
                            echo "<td >$pet_age</td >";                                                                                                              
                            echo "</tr>";                                                                                                                            
                                                                                                                                                                     
                        }                                                                                                                                            
                        ?>                                                                                                                                           
                                                                                                                                                                     
                                                                                                                                                                     
                    </table>                                                                                                                                         
                    <br/>                                                                                                                                            
                    <br/>                                                                                                                                            
                    <div class="container">                                                                                                                          
                        <h3>Your Requests</h3>                                                                                                                       
                    </div>                                                                                                                                           
                                                                                                                                                                     
                    <div class="container">                                                                                                                          
                        <h4>Ongoing Requests</h4>                                                                                                                    
                    </div>                                                                                                                                           
                                                                                                                                                                     
                                                                                                                                                                     
                                                                                                                                                                     
                    <table class="table table-striped">                                                                                                              
                                                                                                                                                                     
                        <tr>                                                                                                                                         
                            <th>Taker Name</th>                                                                                                                      
                            <th>Pet Name</th>                                                                                                                        
                            <th>Begin</th>                                                                                                                           
                            <th>End</th>                                                                                                                             
                            <th>Your bid</th>                                                                                                                        
                            <th>Status</th>                                                                                                                          
                        </tr>                                                                                                                                        
                                                                                                                                                                     
                        <?php                                                                                                                                        
                        $query = "SELECT * FROM request WHERE owner_id = $user_id AND status = 'successful';";                                                       
                        $result = pg_query($query) or die('Query failed: ' . pg_last_error());                                                                       
                                                                                                                                                                     
                                                                                                                                                                     
                        while ($row = pg_fetch_row($result)) {                                                                                                       
                                                                                                                                                                     
                            $request_id = $row[0];                                                                                                                   
                            $taker_id = $row[2];                                                                                                                     
                            $taker_name = pg_fetch_row(pg_query("SELECT name FROM pet_user WHERE user_id = $taker_id;"))[0];                                         
                            $care_begin = $row[3];                                                                                                                   
                            $care_end = $row[4];                                                                                                                     
                            $bids = $row[6];                                                                                                                         
                            $request_pet_name = pg_fetch_row(pg_query("SELECT name FROM petcategory WHERE pcat_id = " . $row[7] . ";"))[0];                          
                            $status = $row[8];                                                                                                                       
                                                                                                                                                                     
                            echo "<tr>";                                                                                                                             
                            echo "<td >$taker_name</td >";                                                                                                           
                            echo "<td >$request_pet_name</td >";                                                                                                     
                            echo "<td >$care_begin</td >";                                                                                                           
                            echo "<td >$care_end</td >";                                                                                                             
                            echo "<td >$bids</td >";                                                                                                                 
                            echo "<td><a class='waves-effect waves-light btn' style='background-color: #c7cdcc'>Successful</a></td>";                                
                            echo "</tr>";                                                                                                                            
                        }                                                                                                                                            
                        ?>                                                                                                                                           
                                                                                                                                                                     
                    </table>                                                                                                                                         
                                                                                                                                                                     
                                                                                                                                                                     
                    <div class="container">                                                                                                                          
                        <h4>Unsuccessful Requests</h4>                                                                                                               
                    </div>                                                                                                                                           
                                                                                                                                                                     
                    <table class="table table-striped">                                                                                                              
                                                                                                                                                                     
                        <tr>                                                                                                                                         
                            <th>Taker Name</th>                                                                                                                      
                            <th>Pet Name</th>                                                                                                                        
                            <th>Begin</th>                                                                                                                           
                            <th>End</th>                                                                                                                             
                            <th>Your bid</th>                                                                                                                        
                            <th>Status</th>                                                                                                                          
                        </tr>                                                                                                                                        
                                                                                                                                                                     
                                                                                                                                                                     
                        <?php                                                                                                                                        
                        $query = "SELECT * FROM request WHERE owner_id = $user_id AND status = 'failed';";                                                           
                        $result = pg_query($query) or die('Query failed: ' . pg_last_error());                                                                       
                                                                                                                                                                     
                                                                                                                                                                     
                        while ($row = pg_fetch_row($result)) {                                                                                                       
                                                                                                                                                                     
                            $request_id = $row[0];                                                                                                                   
                            $taker_id = $row[2];                                                                                                                     
                            $taker_name = pg_fetch_row(pg_query("SELECT name FROM pet_user WHERE user_id = $taker_id;"))[0];                                         
                            $care_begin = $row[3];                                                                                                                   
                            $care_end = $row[4];                                                                                                                     
                            $bids = $row[6];                                                                                                                         
                            $request_pet_name = pg_fetch_row(pg_query("SELECT name FROM petcategory WHERE pcat_id = " . $row[7] . ";"))[0];                          
                            $status = $row[8];                                                                                                                       
                                                                                                                                                                     
                            echo "<tr>";                                                                                                                             
                            echo "<td >$taker_name</td >";                                                                                                           
                            echo "<td >$request_pet_name</td >";                                                                                                     
                            echo "<td >$care_begin</td >";                                                                                                           
                            echo "<td >$care_end</td >";                                                                                                             
                            echo "<td >$bids</td >";                                                                                                                 
                            echo "<td>                                                                                                                               
                                        <a class='waves-effect waves-light btn' style='background-color: #c7cdcc'>Read</a>                                           
                                        <br>                                                                                                                         
                                        <a class='waves-effect waves-light btn' style='background-color: #c7cdcc'>Find Another Taker</a>                             
                                  </td>";                                                                                                                            
                            echo "</tr>";                                                                                                                            
                        }                                                                                                                                            
                        ?>                                                                                                                                           
                                                                                                                                                                     
                    </table>                                                                                                                                         
                                                                                                                                                                     
                </div>                                                                                                                                               
            </div>                                                                                                                                                   
        </div>                                                                                                                                                       
    </div>                                                                                                                                                           
</body>                                                                                                                                                              

