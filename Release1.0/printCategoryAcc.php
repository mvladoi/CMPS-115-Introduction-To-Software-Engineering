<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();

$query = "SELECT first_name, last_name  FROM users WHERE active= 1";
$category = $mysqli->escape_string($_POST['category']);
$temp = "";
if ($result = $mysqli->query($query)) {

    /* fetch object array */
    while ($row = $result->fetch_row()) {
       $temp =  $row[0]. ' ' .$row[1];
	   
	   
	   
	}

    /* free result set */
    $result->close();

}






?>
<!DOCTYPE html>
<html>
<title>BudgetTrace</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="WebContent.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">BudgetTrace</a>
    <a href="description.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Description of the Project</a>
    <a href="teamProj.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Team Project</a>
    <a href="contact.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
   
  </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;margin-top:43px;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href="WebContent.php">Home</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="profile.php">Profile</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="insertBudget.php">Update Budget</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="printTable.php">Print your Budget</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="datePrint.php">Print by Date</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="printCategory.php">Print by Category</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="printGraph.php" >Graph your Budget</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="insertTransaction.php">Insert New Transaction</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="deleteTrans.php">Delete Transaction</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="logout.php">Logout</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
  <div class="w3-twothird w3-container">
	  
      <title>This is your Budget Table</title>
	  
	 
	  <div class="form">
	  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ir";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT tr_name, tr_type, tr_cost, date FROM budget WHERE name = '$temp' AND tr_type = '$category' ORDER BY date DESC"); 
$stmt->execute();


if($stmt->rowCount() > 0){
	echo "<table style='border: solid 1px black;'>";
	echo "<tr><th>Name</th><th>Type</th><th>Cost</th><th>Date<th></tr>";
} else {
	echo "<h1>No Data Found<h1>";
}
class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:3600px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT tr_name, tr_type, tr_cost, date FROM budget WHERE name = '$temp' AND tr_type = '$category' ORDER BY date DESC" ); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</div>
</div>
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>
</html>
