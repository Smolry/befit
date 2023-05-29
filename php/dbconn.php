<?php
/*
This file contains database configuration assuming you are running mysql using user "root" and password ""
*/

define('DB_SERVER', 'sql12.freesqldatabase.com');
define('DB_USERNAME', 'sql12622045');
define('DB_PASSWORD', 'lEKdX2SanT');
define('DB_NAME', 'sql12622045');

// Try connecting to the Database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Check the connection
if($conn == false){
    die('Error: Cannot connect'.mysqli_connect_error());
}

?>