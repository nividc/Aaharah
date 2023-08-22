<?php
include"conn.php";
if ($connection) {
    echo "<h4 style='color:yellow'>Connection Established </h4>";
}else{
    echo "<h4 style='color:red'>Error".mysqli_error($connection)."</h4>";
}
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$number=$_POST['number'];
$email=$_POST['email'];
$query = "CREATE TABLE project1 (fname varchar(20),lname varchar(20),number varchar(15),email varchar(50));";
if(mysqli_query($connection, $query))
{
    echo "Table Created";
}
else
{
    echo "Table not Created . ".mysqli_error($connection)."";
}
$query = "INSERT INTO project1 VALUES(?, ?, ?, ?);";
$initialize = mysqli_stmt_init($connection);
if(mysqli_stmt_prepare($initialize, $query))
{
    mysqli_stmt_bind_param($initialize, "ssss",$fname,$lname,$number,$email);
    mysqli_stmt_execute($initialize);
    echo "<h4 style='color:yellow'>Record Inserted</h4><br>";
}
else
{
    echo "<h4 style='color:red'>Record Not Inserted</h4><br>";
}

$query = "SELECT * FROM project1;";
$check = mysqli_query($connection, $query);
if(mysqli_num_rows($check))
{
    while($row = mysqli_fetch_assoc($check))
    {
      echo  "<b style='color:orange'>".$row["fname"]."</b>"."  "."<b style='color:blue'>".$row["lname"]."</b>"." "."<b style='color:black'>".	$row["number"]."</b>"."  "."<b style='color:red'>".$row["email"]."</b><br>";
    }
}
header("Location:index.html");
?>

