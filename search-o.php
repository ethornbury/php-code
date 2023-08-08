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
   //echo "Connected successfully"; //testing line

    if (isset($_POST['book_day'], $_POST["book_time"], $_POST['book_name'])) {
        //getting content from html form -> save to php var -> pass to mysql query 
        //var_dump($_POST["book_day"], $_POST["book_time"],$_POST["book_name"]); //html fields
        $days = htmlspecialchars($_POST["book_day"]);
        $hours = htmlspecialchars($_POST["book_time"]);
        $booking_name = htmlspecialchars($_POST["book_name"]);
 
        //$sql = "SELECT book_day, book_time, book_name FROM booking"; //get all
        //get a specific search
        $sql = "SELECT * FROM booking WHERE book_day LIKE ( '  ".$days." ') AND book_time LIKE ('  ".$hours." ')";
        $result = $mycon->query($sql);

        if ($result -> num_rows > 0) {
            // output data of each row
            echo "<ul>";
            while($row = $result -> fetch_assoc()) {

                echo "<li> day: ". $row["book_day"]. " - time: ". $row["book_time"]. " " . $row["book_name"] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "0 results";
            echo "<li>no results to display</li>";
        }
    }
    // Close the connection
    $mycon->close();
}
 //echo "<p>working</p>"; //testing line to check file is being picked up
?>

