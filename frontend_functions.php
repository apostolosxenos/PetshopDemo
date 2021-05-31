<?php

require_once('backend_functions.php');


function generate_frontpage_product_div($row = array())
{
    $product = new Product($row);

    echo $div = '<div class="card h-100">
                    <div>
                        <img src="' . DOMAIN . $product->get_image() . '">
                    </div>
                    <div style="min-height:100px; padding: 10px">
                        <h5>' . $product->get_name() . '</h5>
                    </div>
                    <div>
                        <h5 style="color:rebeccapurple; font-weight:bold">
                        ' . nf($product->get_price()) . ' €</h5>
                    </div>
                    <div class="mt-1">
                        <div>
                            <button class="btn btn-qty-decr"><i class="fas fa-minus"></i></button>
                            <input type="number" style="width: 3em; text-align: center" value="1" min="1" max="' . $product->get_stock() . '">
                            <button class="btn btn-qty-incr"><i class="fas fa-plus"></i></button>
                        </div>

                        <div class="mt-1">       
                            <button class="btn btn-cart" id="' . $product->get_id() . '"><i class="fa fa-shopping-cart"></i></button>
                            <input type="hidden" id="hidden_price" value="' . $product->get_price() . '">
                        </div>
                    </div>
                </div>';
}

function generate_category_product_div($row = array())
{
    $product = new Product($row);

    echo $div = '<div class="column">
                    <div class="card h-100">
                        <div>
                            <img src="' . DOMAIN . $product->get_image() . '">
                        </div>
                        <div style="min-height:100px; padding: 10px">
                            <h5>' . $product->get_name() . '</h5>
                        </div>
                        <div>
                            <h5 style="color:rebeccapurple; font-weight:bold">
                            ' . nf($product->get_price()) . ' €</h5>
                        </div>
                        <div class="mt-1">
                            <div>
                                <button class="btn btn-qty-decr"><i class="fas fa-minus"></i></button>
                                <input type="number" style="width: 3em; text-align: center" value="1" min="1" max="' . $product->get_stock() . '">
                                <button class="btn btn-qty-incr"><i class="fas fa-plus"></i></button>
                            </div>

                            <div class="mt-1">       
                                <button class="btn btn-cart" id="' . $product->get_id() . '"><i class="fa fa-shopping-cart"></i></button>
                                <input type="hidden" id="hidden_price" value="' . $product->get_price() . '">
                            </div>
                        </div>
                    </div>
                </div>';
}

function generate_orders_table_row($row = array())
{
    $order = new Order($row);

    echo $table = '<tr id="' . $order->get_order_id() . '" class="view-order" style="text-align: center">
                        <td>' . $order->get_order_id() . '</td>
                        <td>' . format_datetime_to_local($order->get_order_datetime()) . '</td>
                        <td>' . nf($order->get_total_price()) . ' €</td>
                        <td>' . $order->get_delivery_method() . '</td>
                        <td>' . $order->get_status() . '</td>
                    </tr>';
}
