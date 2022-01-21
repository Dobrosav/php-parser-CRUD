<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testintervju";
if (($file=fopen('product_categories.csv',"r"))!=false){
    while (($data=fgetcsv($file,1000,","))!=false){
        $array[]=$data;
    }
}
for ($i=1;$i<count($array);$i++) {
    $categaries[] = $array[$i][1];
    $departments[]=$array[$i][2];
}
$categaries=array_unique($categaries);
$departments=array_unique($departments);
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
foreach ($categaries as $c){
    $query="INSERT INTO categories (name) values('$c')";
    if (!$conn->query($query))
    {
        die('Error: ' . mysql_error());
    }
}
foreach ($departments as $d){
    $query="INSERT INTO departments (name) values('$d')";
    if (!$conn->query($query))
    {
        die('Error: ' . mysql_error());
    }
}
for ($i=1;$i<count($array);$i++) {
    $pn=$array[$i][0];
    $cat=$array[$i][1];
    $dep=$array[$i][2];
    $man=$array[$i][3];
    $upc=$array[$i][4];
    $sku=$array[$i][5];
    $regpr=$array[$i][6];
    $saleprice=$array[$i][7];
    $desc=$array[$i][8];
    $sql="select iddep from departments where name='".$dep."'";
    $res=$conn->query($sql) or die($conn->error);
        while($row = $res->fetch_assoc()) {
            $iddep=$row['iddep'];
            echo $iddep.'<br/>';
        }

    $sql="select idcat from categories where name='".$cat."'";
    $res=$conn->query($sql) or die($conn.error);
        while($row = $res->fetch_assoc()) {
            $idcat=$row['idcat'];
            echo $idcat."<br/>";
    }
    $query="INSERT INTO products values(
        '$pn','$man','$upc','$sku','$regpr','$saleprice','$desc','$idcat','$iddep') ";

    $conn->query($query);
}