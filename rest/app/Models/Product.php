<?php


namespace App\Models;


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
    public function __toString()
    {
        return $this->pn.",".$this->man.",".$this->upc.",".$this->sku.",".$this->reg_price.",".$this->saleprice.",".$this->desc.",".$this->idcat.",".$this->iddep;
    }
}
