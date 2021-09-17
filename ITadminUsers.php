<?php 
 session_start();


 if (!isset($_SESSION['username'])) {
   $_SESSION['msg'] = "You must log in first";
   header("location: Login.php");
 }
 if (isset($_GET['logout'])) {
   session_destroy();
   unset($_SESSION['username']);
   unset($_SESSION['nametodisplay']);
   unset($_SESSION['userid']);
   unset($_SESSION['success']);
   header("location: Login.php");
 } 
// Username is root 
$user = 'kxt2384_admin'; 
$password = 'Admin@94';  
  
// Database name is gfg 
$database = 'kxt2384_db';  
  
// Server is localhost with 
// port number 3308 

// $servername='localhost:3308';
$servername='localhost'; 
$mysqli = new mysqli($servername, $user,  
                $password, $database); 
  
// Checking for connections 
if ($mysqli->connect_error) { 
    die('Connect Error (' .  
    $mysqli->connect_errno . ') '.  
    $mysqli->connect_error); 
} 
if (isset($_REQUEST['view_all_orders']))
{
  // param was set in the query string
   if(!empty($_REQUEST['view_all_orders']))
   {
    //  // query string had param set to nothing ie ?param=&param2=something
    //  $mysqli1 = new mysqli($servername, $user, $password, $database); 

    // // Checking for connections 
    // if ($mysqli1->connect_error) { 
    //     die('Connect Error (' .  
    //     $mysqli1->connect_errno . ') '.  
    //     $mysqli1->connect_error); 
    // } 
    // $del_order_id = $_REQUEST['delete_order_id'];
    // $sql1 = "DELETE FROM phase4_orders WHERE orderid ='$del_order_id'"; 
    // $result1 = $mysqli1->query($sql1) or die($mysqli1->error);
    // $mysqli1->close();
    // header("Location: StaffOrder.php");
    $sql = "SELECT * FROM phase4_user"; 
    $result = $mysqli->query($sql) or die($mysqli->error);
    $mysqli->close();
    
   }
}
else{
  $sql = "SELECT * FROM phase4_user LIMIT 5"; 
  $result = $mysqli->query($sql) or die($mysqli->error);
  $mysqli->close(); 
}  
// SQL query to select data from database 


if (isset($_REQUEST['delete_order_id']))
{
  // param was set in the query string
   if(!empty($_REQUEST['delete_order_id']))
   {
     // query string had param set to nothing ie ?param=&param2=something
     $mysqli1 = new mysqli($servername, $user, $password, $database); 

    // Checking for connections 
    if ($mysqli1->connect_error) { 
        die('Connect Error (' .  
        $mysqli1->connect_errno . ') '.  
        $mysqli1->connect_error); 
    } 
    $del_order_id = $_REQUEST['delete_order_id'];
    $sql1 = "DELETE FROM phase4_user WHERE userid ='$del_order_id'"; 
    $result1 = $mysqli1->query($sql1) or die($mysqli1->error);
    $mysqli1->close();
    header("Location: ITadmin.php");
    
   }
}

if (isset($_REQUEST['accept_order_id']))
{
  // param was set in the query string
   if(!empty($_REQUEST['accept_order_id']))
   {
     // query string had param set to nothing ie ?param=&param2=something
     $mysqli2 = new mysqli($servername, $user, $password, $database); 

    // Checking for connections 
    if ($mysqli2->connect_error) { 
        die('Connect Error (' .  
        $mysqli2->connect_errno . ') '.  
        $mysqli2->connect_error); 
    } 
    $accept_order_id = $_REQUEST['accept_order_id'];
    $statusq = $_REQUEST['statusq'];
    $sql2 = "UPDATE phase4_orders SET accepted_status ='$statusq' WHERE orderid='$accept_order_id'"; 
    $result2 = $mysqli2->query($sql2) or die($mysqli2->error);
    $mysqli2->close();
    header("Location: StaffOrder.php");
     
   }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT admin USers Page</title>
    <link rel="stylesheet" href="phase2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="staff_orders">
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div><img src="teacher.png" alt="Staff profile pic">  </div>
        <a href="ITadmin.php"><img src="dashboard.png" alt="dashboard" style="width: 10%;">Dashboard</a>
        <a href="users.php"><img src="product.png" alt="product" style="width: 10%;">Add New User</a>
        <a href="ITadminUsers.php"><img src="online_order.png" alt="online_order" style="width: 10%;">User Profiles</a>
        <a href="Staff.php?logout='yes'"><img src="sign_out_option.png" alt="sign_out_option" style="width: 10%;">Sign off</a>
      </div>
      
      <div id="main1">
        <!-- <h2>Sidenav Push Example</h2>
        <p>Click on the element below to open the side navigation menu, and push this content to the right.</p> -->
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
      </div>
      <div id="main2"> 
        <div class="search-container">
            <form action="#">
              Search Users : <input type="text" placeholder="Search Users" name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <table id="StaffOrders">
            <tr>
              <th>User ID</th>
              <th>User Name</th>
              <th>Department</th>
              <th>Edit/Delete</th>
              
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS--> 
            <?php   // LOOP TILL END OF DATA  
                while($rows=$result->fetch_assoc()) 
                { 
             ?> 
            <tr> 
                <!--FETCHING DATA FROM EACH  
                    ROW OF EVERY COLUMN--> 
                <td><a href="usersinfo.php?order_id=<?php echo $rows['userid'];?>"><?php echo $rows['userid'];?></a></td> 
                <td><?php echo $rows['name'];?></td> 
                <td><?php echo $rows['department'];?></td> 
                
                <td>
                  <a href=""><button type="submit">Edit User</button></a>
                  <a href="ITadminUsers.php?delete_order_id=<?php echo $rows['userid'];?>"><button type="submit">Delete User</button></a></td>
                            
            </tr> 
            <?php 
                } 
             ?>           
            
            <tr>
              <td><a href="users.php"><button type="submit">Place New Order</button></a></td>
              <td></td>
              <td></td>
              <td><a href="ITadminUsers.php?view_all_orders='yes'"><button type="submit">View All Orders</button></a></td>
            </tr>
              <!-- <tr>
                <td><a href="#">OR101</a></td>
                <td>CHAIRS</td>
                <td>Order status can be viewed once approved</td>
                <td><a href=""><button type="submit">Edit Order</button></a><a href=""><button type="submit">Delete Order</button></a></td>
                </tr>
              </tr> -->
            <!-- <tr>
              <td><a href="StudentProducts.php"><button type="submit">Place New Order</button></a></td>
              <td></td>
              <td></td>
              
              <td><a href=""><button type="submit">View All Orders</button></a></td>
            </tr> -->
          </table>
      </div>
      
      <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main1").style.marginLeft = "250px";
        document.getElementById("main2").style.marginLeft = "250px";
      }
      
      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main1").style.marginLeft= "0";
        document.getElementById("main2").style.marginLeft= "0";
      }
      </script>
</body>
</html>