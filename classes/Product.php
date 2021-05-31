<?php

class Product
{
    private $id;
    private $name;
    private $image;
    private $description;
    private $price;
    private $stock;

    public function __construct($row = array())
    {
        $this->id = $row['product_id'];
        $this->name = $row['name'];
        $this->image = $row['image'];
        $this->description = $row['description'];
        $this->price = $row['price'];
        $this->stock = $row['stock'];
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_image()
    {
        return $this->image;
    }

    public function get_description()
    {
        return $this->description;
    }

    public function get_price()
    {
        return $this->price;
    }

    public function get_stock()
    {
        return $this->stock;
    }
}
