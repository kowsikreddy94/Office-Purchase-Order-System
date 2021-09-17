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

$user = 'kxt2384_admin'; 
$password = 'Admin@94';  
$database = 'kxt2384_db';  
$servername='localhost'; 
$mysqli = new mysqli($servername, $user, $password, $database); 
  
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
    $sql = "SELECT * FROM phase4_orders"; 
    $result = $mysqli->query($sql) or die($mysqli->error);
    $mysqli->close();
    
   }
}
else{
  $sql = "SELECT * FROM phase4_orders LIMIT 4"; 
  $result = $mysqli->query($sql) or die($mysqli->error);
  $mysqli->close(); 
}

$user = 'kxt2384_admin';
$passw = 'Admin@94';
$db = 'kxt2384_db';

$mysqli1 = new mysqli('localhost', $user, $passw, $db) or die("Unable to connect");


$pendingSql = "SELECT COUNT(*) as PENDING FROM phase4_orders WHERE order_status = 'Pending'";
$pendingSqlOrders = mysqli_query($mysqli1, $pendingSql);
$pending_status = mysqli_fetch_assoc($pendingSqlOrders);
$pendingTotal = $pending_status['PENDING'];

$deliveredSql = "SELECT COUNT(*) as 'DELIVERED' FROM phase4_orders WHERE order_status = 'Delivered'";
$deliveredSqlOrders = mysqli_query($mysqli1, $deliveredSql);
$delivered_status = mysqli_fetch_assoc($deliveredSqlOrders);
$deliveredTotal = $delivered_status['DELIVERED'];

$shippedSql = "SELECT COUNT(*) as 'SHIPPED' FROM phase4_orders WHERE order_status = 'Shipped'";
$shippedSqlOrders = mysqli_query($mysqli1, $shippedSql);
$shipped_status = mysqli_fetch_assoc($shippedSqlOrders);
$shippedTotal = $shipped_status['SHIPPED'];

$processingSql = "SELECT COUNT(*) as 'PROCESSING' FROM phase4_orders WHERE order_status = 'Processing'";
$processingSqlOrders = mysqli_query($mysqli1, $processingSql);
$processing_status = mysqli_fetch_assoc($processingSqlOrders);
$processingTotal = $processing_status['PROCESSING'];

$productsSql = "SELECT * FROM phase4_products"; 
$productsResult = $mysqli1->query($productsSql) or die($mysqli1->error);

$totalCostSql = "SELECT SUM(cost) as 'TOTALCOST' FROM phase4_orders";
$totalCostSqlOrders = mysqli_query($mysqli1, $totalCostSql);
$totalCost_status = mysqli_fetch_assoc($totalCostSqlOrders);
$totalCost = $totalCost_status['TOTALCOST'];

$ordersSql = "SELECT COUNT(*) as 'TOTALORDERS' FROM phase4_orders";
$totalSqlOrders = mysqli_query($mysqli1, $ordersSql);
$totalOrders_status = mysqli_fetch_assoc($totalSqlOrders);
$totalOrders = $totalOrders_status['TOTALORDERS'];

$totalMessages = 4;

$mysqli1->close();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Admin Page</title>
    <link rel="stylesheet" href="phase2.css">
</head>
<body class="staff">
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div><img src="teacher.png" alt="Staff profile pic">User: <?php echo $_SESSION['nametodisplay']; ?></div>
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

      <!-- <div id="stmain">
        
        <table id="Stmaintable">
            
            <tr>
              <td><h3>$35,210.89</h3>TOTAL REVENUE</td>
              <td><h3>$10,670.00</h3>TOTAL COST</td>
              <td><h3>$28,267.65</h3>TOTAL PROFIT</td>
              <td style="text-align: center;"><h3>1200</h3>GOAL COMPLETIONS</td>
            </tr>
            
        </table>
    </div> -->

      <div id="main2" class="row">
        <div class="leftcolumn">
          <div class="card">
            <h2>Users</h2>
            <table id="StaffOrders">
                <tr>
                  <th>User ID</th>
                  <th>User Name</th>
                  <th>User Details</th>
                </tr>
                <tr>
                  <td><a href="usersinfo.php">U123</a></td>
                  <td>sacxcsa</td>
                  <td>dasfas</td>
                </tr>
                <tr>
                  <td><a href="usersinfo.php">OU123</a></td>
                  <td>PRsdf</td>
                  <td>vsdvds</td>
                </tr>
                <tr>
                  <td><a href="usersinfo.php">U123</a></td>
                  <td>ABC BRAZIL</td>
                  <td>ergege</td>
                </tr>
                <tr>
                  <td><a href="usersinfo.php">OR123</a></td>
                  <td>XYZ</td>
                  <td>fwegwe</td>
                </tr>
                <tr>
                  <td><a href="users.php"><button type="submit">Add New User</button></a></td>
                  <td></td>
                  <td><a href=""><button type="submit">View All Users</button></a></td>
                </tr>
              </table>    
        </div>
          
        </div>
        <div class="rightcolumn">
            
          <div class="card">
            <table id="statusOverviewtable">
                <tr>
                    <td id="statusOverviewtablecell1">
                        PENDING ISSUES
                        <h3>6</h3>
                    </td>
                    <td id="statusOverviewtablecell2">
                        TOTAL USERS
                        <h3>1181</h3>
                    </td>
                    
                </tr>
                <tr>
                    <td id="statusOverviewtablecell3">
                        SOLVED ISSUES
                        <h3>950</h3>
                    </td>
                    <td id="statusOverviewtablecell4"> 
                        APPLICATION HEALTH
                        <h3>98% Capacity Usage. Status: No Issues</h3>
                    </td>
                    
                </tr>
            </table>  
          </div>

          <div class="card">
            <h3>Recently Added Issues</h3>
            <table id="Products">
               
                <tr>
                  <td>
                       <h4>User ID : U1001</h4>
                 </td>
                 
                  <td>System check Issue</td>
                  
                </tr>
                <tr>
                    <td>
                        <h4>User ID : U1045</h4>
                  </td>
                  
                   <td>Login Issue</td>
                  
                </tr>
                
                
              </table>
          </div>
          
          <!-- <div class="card">
            <h3>Follow Me</h3>
            <p>Some text..</p>
          </div> -->
        </div>
      </div>
      
      <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main1").style.marginLeft = "250px";
        document.getElementById("main2").style.marginLeft = "250px";
        document.getElementById("stmain").style.marginLeft = "250px";
      }
      
      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main1").style.marginLeft= "0";
        document.getElementById("main2").style.marginLeft= "0";
        document.getElementById("stmain").style.marginLeft= "0";
      }
      </script>
</body>
</html>