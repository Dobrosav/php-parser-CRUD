<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testintervju";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
class Product{
    public $pn;
    public $man;
    public $upc;
    public $sku;
    public $reg_price;
    public $saleprice;
    public $desc;
    public $idcat;
    public $iddep;
}
$prod=new Product();
$number=$_GET['prod-no'];
$sql="select * from products where product_number='".$number."'";
$res=$conn->query($sql) or die($conn->error);
while($row = $res->fetch_assoc()) {
    $prod->pn=$row['product_number'];
    $prod->man=$row['manufacturer'];
    $prod->upc=$row['upc'];
    $prod->sku=$row['sku'];
    $prod->reg_price=$row['regular_price'];
    $prod->saleprice=$row['sale_price'];
    $prod->desc=$row['description'];
    $prod->idcat=$row['idcat'];
    $prod->iddep=$row['iddep'];
}
echo json_encode($prod);