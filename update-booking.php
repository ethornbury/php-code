<?php
    require_once 'inc/connect.php'; //file with db connect function
    connect_to_db(); //call the function

    echo '
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Update functionality</title>
		<meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
		  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://kit.fontawesome.com/096239daca.js" crossorigin="anonymous"></script>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Montserrat:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="assets/mystyle.css">
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
            <a class="nav-link" href="update-booking.php">Update booking</a>
        </li>
			  <li class="nav-item">
          <a class="nav-link" href="search.php">Search</a>
			  </li>
			</ul>
		  </div>

		</nav>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <h2>SEARCH TO UPDATE YOUR BOOKING  <i class="fas fa-utensils fa-sm"></i></h2> 
        <br>
        <form action="update-booking.php" method="post">
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
                    
                </select>
                </div>
            </div>
            <br>

            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control" placeholder="Enter booking full name" name="book_name">
            </div>
            <br>

            <button type="submit" class="btn btn-info">SEARCH</button>
        </form>
			
    '; //end echo

    if (isset( $_POST['book_day'], $_POST['book_time'], $_POST['book_name'])) {
        //getting content from html form -> save to php var -> pass to mysql query 
        //var_dump($_POST["book_day"], $_POST["book_time"],$_POST["book_name"]); //html fields
				
        $days = htmlspecialchars($_POST["book_day"]);
        $hours = htmlspecialchars($_POST["book_time"]);
        $booking_name = htmlspecialchars($_POST["book_name"]);
        // var_dump($days, $booking_name);
        //$sql = "SELECT * FROM booking"; //get all
        //get a specific search
        $sql = "SELECT * FROM booking WHERE book_day LIKE ( '".$days."') OR book_name LIKE ( '".$booking_name."')    ";
        //$sql = "SELECT * FROM booking WHERE book_day LIKE '$days' OR book_name LIKE '$booking_name' ";
       
        $result = $mycon->query($sql);
		
        $row = $result->fetch_assoc();
		
        if ($result -> num_rows > 0) {
          
            // output data of each row
            echo '<br><br> <ul class="list-group"> ';
              while($row = $result -> fetch_assoc()) {
                $id = $row["book_id"];
                $days = $row["book_day"];
                $hours = $row["book_time"];
                $booking_name = $row["book_name"];
                $booking_num = $row["book_num"];
                  echo '<li class="list-group-item"> day: '. $row["book_day"]. ' | time: '. $row["book_time"]. ' | name: ' . $row["book_name"] .'</li>';  
              }  

            echo '</ul>';
        } else {
            echo '  <br><br>
                <ul class="list-group">   
                    <li class="list-group-item">no results to display</li> 
                </ul>  ';
        }
    }

    echo '

        </div> <!-- end of middle column with form -->
        <div class="col-md-2"></div>
	</div><!-- end row -->
	<br><br>
	<div class="row">
		<div class="col-md-2"></div>
      <div class="col-md-8">
		  <form action="update-booking.php" method="post">
          <div class="row">
            <div class="col">
              <select name="book_day">
                <option value="day-select" class="form-select"  >Change Date</option>
                <option value="wed">Wednesday</option>
                <option value="thur">Thursday</option>
                <option value="fri">Friday</option>
                <option value="sat">Saturday</option>
                <option value="sun">Sunday</option>
              </select>
            </div>
            <div class="col">
              <select name="book_time">	
                <option value="hour-select">Change Hour</option>
                <option value="15:00">15:00</option>
                <option value="15:15">15:15</option>
                <option value="15:30">15:30</option>
                <option value="15:45">15:45</option>
                <option value="16:00">16:00</option>
                <option value="16:15">16:15</option>
                <option value="16:30">16:30</option>
                <option value="16:45">16:45</option>
                <option value="17:00">17:00</option>
               
              </select>
            </div>

          </div>
          <br>
          <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" id="pwd" placeholder="hopefully db info" name="book_name" disabled>
          </div>
          <br>
          <div class="mb-3">
            <label class="form-label">Number of people:</label>
            <input type="number" class="form-control" placeholder="Update number" name="book_num" min="1">
          </div>
          <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
      </div>
    ';
        // var_dump($days, $booking_name);
        $id = 1;
        $days = 'wed';
        $hours = '15.00';
        $booking_name = 'testy';
        $booking_num = 1;
        //$sql = "SELECT * FROM booking WHERE book_day LIKE '$days' OR book_name LIKE '$booking_name' ";
        $sql = "UPDATE booking SET book_day='$days', book_time='$hours', book_num='$booking_num' where book_id = '$id'";
        $result = $mycon->query($sql);
		
        if ($mycon->query($sql) === TRUE) {
          
          echo '  <br><br>
                <ul class="list-group">   
                    <li class="list-group-item">Records updated</li> 
                </ul>  ';
        } else {
          echo '  <br><br>
          <ul class="list-group">   
              <li class="list-group-item">Error</li> 
          </ul>  ';
          
        }

    // Close the connection
    $mycon->close();
 //echo "<p>working</p>"; //testing line to check file is being picked up
?>

      <div class="col-md-2"></div>
    </div>

</body>
</html>
