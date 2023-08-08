<?php
//set up
$servername = "localhost"; //server name
$username = "root"; //MySQL username
$password = ""; //MySQL password
$dbname = "booking_db"; //your database name

// Create a new MySQLi instance under your var name $mycon
$mycon = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mycon -> connect_error) {
    die("Connection failed: " . $mycon -> connect_error);
} else {
    //echo "Connected successfully";
    include ("booking.html");
     
}

//save data
if (isset($_POST['book_day'], $_POST["book_time"], $_POST['book_name'],  $_POST['book_num'])) {
    //getting content from html form -> save to php var -> pass to mysql query 
    //var_dump($_POST["book_day"], $_POST["book_time"],$_POST["book_name"], $_POST["book_num"]); //html fields
    $days = htmlspecialchars($_POST["book_day"]);
    $hours = htmlspecialchars($_POST["book_time"]);
    $booking_name = htmlspecialchars($_POST["book_name"]);
    $booking_pnumber = htmlspecialchars($_POST["book_num"]);
    
    $query ="INSERT INTO booking (book_day, book_time, book_name, book_num) VALUES ( '  ".$days." ','  ".$hours." ',' ".$booking_name." ',' ".$booking_pnumber."   ' )";	
    mysqli_query($mycon, $query); 
}


// Close the connection
$mycon->close();
 //echo "<p>working</p>"; //testing line to check file is being picked up
?>

