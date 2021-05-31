<?php

class Order
{
    public $order_id;
    private $order_datetime;
    private $total_price;
    private $delivery_method;
    private $comments;
    private $status;

    public function __construct($row = array())
    {
        $this->order_id = $row['order_id'];
        $this->order_datetime = $row['ordered_at'];
        $this->total_price = $row['total_price'];
        $this->delivery_method = $row['delivery_method'];
        $this->comments = $row['comments'];
        $this->status = $row['status'];
    }


    public function get_order_id()
    {
        return $this->order_id;
    }


    public function get_order_datetime()
    {
        return date($this->order_datetime);
    }


    public function get_total_price()
    {
        return $this->total_price;
    }

    public function get_delivery_method() {
        
        return $this->delivery_method;
    }

    public function get_comments()
    {
        return $this->comments;
    }

    public function get_status()
    {
        return $this->status;
    }
}