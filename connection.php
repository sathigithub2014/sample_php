<?php
/**
 * Created by PhpStorm.
 * User: SSOMENS-032
 * Date: 15/10/14
 * Time: 11:02 AM
 */
require("php_serial.class.php");
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = null;
$dbschema="test";
try {
    
    
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbschema);
if(! $conn )
{
    die('DB Could not connect: ' . mysqli_error($conn));
}
//echo 'Connected successfully';
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

