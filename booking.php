<?php
    require_once 'inc/connect.php';
    connect_to_db();

    //save data
    if (isset($_POST['book_day'], $_POST["book_time"], $_POST['book_name'],  $_POST['book_num'])) {
        //getting content from html form -> save to php var -> pass to mysql query 
        //var_dump($_POST["book_day"], $_POST["book_time"],$_POST["book_name"], $_POST["book_num"]); //html fields
        $days = htmlspecialchars($_POST["book_day"]);
        $hours = htmlspecialchars($_POST["book_time"]);
        $booking_name = htmlspecialchars($_POST["book_name"]);
        $booking_pnumber = htmlspecialchars($_POST["book_num"]);
        
        $query ="INSERT INTO booking (book_day, book_time, book_name, book_num) VALUES ( '".$days."','".$hours."','".$booking_name."','".$booking_pnumber."' )";	
        mysqli_query($mycon, $query); 
    }

    // Close the connection
    $mycon->close();
    //go back to html page
    include ("booking.html");
    echo "<p>Thanks for your booking</p>"; //let the user know
?>

