<?php
//include connection file
include_once("ez_sql_core.php");
include_once"ez_sql_mysqli.php";
include("connection.php");
// to throw exception message
mysqli_report(MYSQLI_REPORT_STRICT);
try{
   
    $name=$_POST["name"];
 if (isset($_POST)){
//    CREATE TABLE
if(isset($_POST["create"]))
{
    echo "<CENTER><B>CREATE TABLE</B></CENTER>\n";
    $sql="CREATE TABLE SAMPLETESTTBL(NAME VARCHAR(10),AGE INTEGER)";//CREATE TABLE QUERY
    $createtblexec = mysqli_query($conn,$sql);
if(! $createtblexec )
{
die('Could not create table:SAMPLETESTTBL ' . mysqli_error($conn));
}
echo "TABLE CREATED successfully\n";
}
//INSERT TABLE
else if(isset($_POST["insert"])){
    echo "<CENTER><B>INSERT TABLE</B></CENTER>\n";
    $age=$_POST["age"];
    $sql="INSERT INTO SAMPLETESTTBL".
        "(NAME,AGE)".
        "VALUES('$name',$age)";//INSERT QUERY
        $conn->query($sql);
//    $insertexec= mysqli_query($conn,$sql);
//    if(! $insertexec )
//    {
//        die('Could not INSERT INTO table:SAMPLETESTTBL ' . mysqli_error($conn));
//    }
    echo "RECORD INSERTED successfully\n";
}
//SELECT TABLE RECORDS

else if(isset($_POST["select"])){
    echo "<CENTER><B>LIST OF RECORDS</B></CENTER>\n";
    $sql="SELECT * FROM SAMPLETESTTBL";//SELECT QUERY
$selectexec= mysqli_query( $conn,$sql );
if(! $selectexec )
{
die('Could not get data: ' . mysqli_error($conn));
}
//USING EZSQL
//$var = $conn->get_var("SELECT count(*) FROM FROM  SAMPLETESTTBL"); echo $var;
//$rwcount= mysqli_query( $conn,"SELECT COUNT(*) as rcnt FROM  SAMPLETESTTBL");
//while($row = mysqli_fetch_array($rwcount))
//{
//echo "TOTAL RECORDS:".$row[0]."<br>";
//}
    $C=0;
while($row = mysqli_fetch_array($selectexec))
{
    $C++;
echo
    "-----------RECORD:----------".$C."----------<br>".
    "NAME : $row[0] <br> ".
    "AGE : $row[1] <br> ".
    "-------------------------------------<br>";
}
    mysqli_free_result($selectexec);

    echo "TOTAL RECORDS:".$C."\n";

}
else if (isset($_POST["delete"])){
    echo "<CENTER><B>DELETE RECORD BY NAME</B></CENTER>\n";
    $sql="DELETE FROM SAMPLETESTTBL WHERE NAME='$name'";//SELECT QUERY
    $deleteexec= mysqli_query( $conn,$sql );
    if(! $deleteexec )
    {
        die('Could not DELETE RECORD: ' . mysqli_error($conn));
    }

    echo "RECORD DELETED successfully\n".$deleteexec;
}
else if (isset($_POST["update"])){
    echo "<CENTER><B>UPDATE RECORD BY NAME</B></CENTER>\n";
    $sql="UPDATE SAMPLETESTTBL SET NAME='$name' ";//SELECT QUERY
    $deleteexec= mysqli_query( $conn,$sql );
    if(! $deleteexec )
    {
        die('Could not UPDATE RECORD: ' . mysqli_error($conn));
    }

    echo "RECORD UPDATED successfully\n".$deleteexec;
}
    }
//    CLOSE CONNECTION
mysqli_close($conn);
} catch (Exception $e) {
echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>