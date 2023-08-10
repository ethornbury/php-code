<?php
    //make the connection in a separate file 
    //then  include this file then call the function where needed
    //remember to close the connection!!

    //set up
    function connect_to_db(){
        $servername = "localhost"; //server name
        $username = "root"; //MySQL username
        $password = ""; //MySQL password
        $dbname = "booking_db"; //your database name

        global $mycon; //global var to use 
        
        // Create a new MySQLi instance under your var name $mycon
        $mycon = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($mycon -> connect_error) {
            die("Connection failed: " . $mycon -> connect_error);
        } 
    }
    
?>