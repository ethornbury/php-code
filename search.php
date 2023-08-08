<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Pizza & Pasta</title>
		<meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
		  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
          <script src="https://kit.fontawesome.com/096239daca.js" crossorigin="anonymous"></script>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Montserrat:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="mystyle.css">
		 <link rel="stylesheet" href="path/to/icon-library.css">
	</head>
	<body class="container-fluid">
        <nav class="navbar navbar-expand-sm bg-light">

            <div class="container-fluid">
                <!-- Links -->
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.html">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="booking.html">Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="online.html">Online</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.html">Search</a>
                </li>
                </ul>
            </div>

		</nav>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2>SEARCH YOUR TABLE NOW</h2>
                <br>
                <form action="search.php" method="post">
                <div class="row">
                    <div class="col">
                    <select name="book_day">
                        <option value="day-select" class="form-select"  >Select Day</option>
                        <option value="wed">Wednesday</option>
                        <option value="thur">Thursday</option>
                        <option value="fri">Friday</option>
                        <option value="sat">Saturday</option>
                        <option value="sun">Sunday</option>
                    </select>
                    </div>
                    <div class="col">
                    <select name="book_time">
                        <option value="hour-select">Select time</option>
                        <option value="15:00">15:00</option>
                        <option value="15:15">15:15</option>
                        <option value="15:30">15:30</option>
                        <option value="15:45">15:45</option>
                        <option value="16:00">16:00</option>
                        <option value="16:15">16:15</option>
                        <option value="16:30">16:30</option>
                        <option value="16:45">16:45</option>
                        <option value="17:00">17:00</option>
                        <option value="17:15">17:15</option>
                        <option value="17:30">17:30</option>
                        <option value="17:45">17:45</option>
                        <option value="18:00">18:00</option>
                        <option value="18:15">18:15</option>
                        <option value="18:30">18:30</option>
                        <option value="18:45">18:45</option>
                        <option value="19:00">19:00</option>
                        <option value="19:15">19:15</option>
                        <option value="19:30">19:30</option>
                        <option value="19:45">19:45</option>
                        <option value="20:00">20:00</option>
                        <option value="20:15">20:15</option>
                        <option value="20:30">20:30</option>
                        <option value="20:45">20:45</option>
                        <option value="21:00">21:00</option>
                        <option value="21:15">21:15</option>
                        <option value="21:30">21:30</option>
                    </select>
                    </div>

                </div>
                <br>

                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" class="form-control" id="pwd" placeholder="Enter booking full name" name="book_name">
                </div>
                <br>

                <button type="submit" class="btn btn-info">SEARCH</button>
                </form>
<!-- php sitting here to pick up the column div -->
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
        $sql = "SELECT * FROM booking WHERE book_day LIKE ( '  ".$days." ')";
        $result = $mycon->query($sql);

        if ($result -> num_rows > 0) {
            // output data of each row
            echo '<br><br> <ul class="list-group"> ';
            while($row = $result -> fetch_assoc()) {
                echo '<li class="list-group-item"> day: '. $row["book_day"]. ' | </i> time: '. $row["book_time"]. ' | name: ' . $row["book_name"] .'</li>';  
            }  

            echo '</ul>';
        } else {
            //echo "0 results";

            echo '
                <br><br>
                <ul class="list-group">   
                    <li class="list-group-item">no results to display</li> 
                </ul>
            </div>
            ';
        }
    }
    // Close the connection
    $mycon->close();
}
 //echo "<p>working</p>"; //testing line to check file is being picked up
?>

            </div> <!-- end of middle column with form -->

            <div class="col-md-2"></div>
        </div>

    </body>
</html>

