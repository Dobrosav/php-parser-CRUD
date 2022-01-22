<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Message;
use App\Models\Product;

class Home extends BaseController
{
	public function index()
	{
       echo "DobroDosli";
	}
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "testintervju";
	public  function  popunibazu()
    {
        if (($file = fopen('product_categories.csv', "r")) != false) {
            while (($data = fgetcsv($file, 1000, ",")) != false) {
                $array[] = $data;
            }
        }
        for ($i = 1; $i < count($array); $i++) {
            $categaries[] = $array[$i][1];
            $departments[] = $array[$i][2];
        }
        $categaries = array_unique($categaries);
        $departments = array_unique($departments);
        $conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        foreach ($categaries as $c) {
            $query = "INSERT INTO categories (name) values('$c')";
            if (!$conn->query($query)) {
                die('Error: ');
            }
        }
        foreach ($departments as $d) {
            $query = "INSERT INTO departments (name) values('$d')";
            if (!$conn->query($query)) {
                die('Error: ');
            }
        }
        for ($i = 1; $i < count($array); $i++) {
            $pn = $array[$i][0];
            $cat = $array[$i][1];
            $dep = $array[$i][2];
            $man = $array[$i][3];
            $upc = $array[$i][4];
            $sku = $array[$i][5];
            $regpr = $array[$i][6];
            $saleprice = $array[$i][7];
            $desc = $array[$i][8];
            $sql = "select iddep from departments where name='" . $dep . "'";
            $res = $conn->query($sql) or die($conn->error);
            while ($row = $res->fetch_assoc()) {
                $iddep = $row['iddep'];
            }

            $sql = "select idcat from categories where name='" . $cat . "'";
            $res = $conn->query($sql) or die($conn . error);
            while ($row = $res->fetch_assoc()) {
                $idcat = $row['idcat'];
            }
            $query = "INSERT INTO products values(
        '$pn','$man','$upc','$sku','$regpr','$saleprice','$desc','$idcat','$iddep') ";

            $conn->query($query);
        }
        $msg=new Message();
        $msg->message="ok";
        return json_encode($msg);
    }
    public function  readproductinjson(){
	    $productkey=$this->request->getVar('prod-no');
        $conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: ");
        }
        $prod=new Product();
        $sql="select * from products where product_number='".$productkey."'";
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
        return json_encode($prod);
    }
    public function showAllCategories(){
        $conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: ");
        }


        $sql="select * from categories";
        $res=$conn->query($sql) or die($conn->error);
        while($row = $res->fetch_assoc()) {
            $prod=new Categoria();
            $prod->idcat=$row['idcat'];
            $prod->name=$row['name'];
            $arr[]=$prod;
        }
        return json_encode($arr);
    }
    public function editCategories(){
        $conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: ");
        }
        $oldname=$this->request->getVar('oldname');
        $newname=$this->request->getVar('newname');
        $sql = "select idcat from categories where name='" . $oldname . "'";
        $res = $conn->query($sql) or die($conn . error);
        while ($row = $res->fetch_assoc()) {
            $idcat = $row['idcat'];
        }
        $sql="UPDATE categories set name ='".$newname."'"." where idcat=".$idcat;
        $conn->query($sql);
        $msg=new Message();
        $msg->message="ok";
        return json_encode($msg);
    }
    public function deleteCategories(){
        $conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: ");
        }
        $oldname=$this->request->getVar('name');
        $sql = "select idcat from categories where name='" . $oldname . "'";
        $res = $conn->query($sql) or die('dead connection');
        $idcat=0;
        while ($row = $res->fetch_assoc()) {
            $idcat = $row['idcat'];
        }
        $query="DELETE FROM categories where idcat=".$idcat;
        $conn->query($query);
        $msg=new Message();
        $msg->message="ok";
        return json_encode($msg);
    }
}
