<?php 
    try {
        //declare variable and add database name in it
        $server_name = "localhost";
        $dbname = "my_blog";
        $dbuser = "root";
        $dbpassword = "";

        //Data source Name
        $dsn = "mysql:host=$server_name;dbname=$dbname";
        $conn = new PDO($dsn,$dbuser,$dbpassword);

        // OR

        // $conn = new PDO("mysql:host=localhost;dbname=my_blog","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // echo"Connection Success";

    } catch (PDOException $e) {
        die("Connection Fail:".$e->getMessage());
    }

?>

<!--
    There ar Three ways of Connecting MySQL and  PHP
1. MySQLi Procedrual
2. MySQLi Object-Oriented
3. PDO(PHP Data Object) //fast and more secure
    3 steps MySQL connet
    1. Connection with database
    2. Run SQL Query
    3. Closing database connection
 -->