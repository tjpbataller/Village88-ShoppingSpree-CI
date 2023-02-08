<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShoppingSpree extends CI_Model
{
    public function get_all_products()
    {
        $query = "SELECT * FROM products";
        return $this->db->query($query)->result_array();
    }

    public function get_cart_total_amount($user_id)
    {
        $query = "SELECT SUM(quantity*price) AS total_amount FROM orders LEFT JOIN products ON products.id = orders.product_id WHERE user_id = ?";
        return $this->db->query($query, $user_id)->row_array();
    }

    public function get_all_orders($user_id)
    {
        $query = "SELECT orders.id AS id, products.name AS name, orders.quantity AS quantity, products.price AS price FROM products LEFT JOIN orders ON orders.product_id = products.id WHERE orders.user_id = ?";
        return $this->db->query($query, $user_id)->result_array();

    }

    public function get_order_quantity($user_id, $product_id)
    {
        $query = "SELECT quantity FROM orders WHERE user_id = ? AND product_id = ?";
        $values = array($user_id, $product_id);
        return $this->db->query($query, $values)->row_array();
    }

    public function add_order($user_id, $product_id, $quantity, $status, $created_at)
    {
        $query = "INSERT INTO orders (user_id, product_id, quantity, status, created_at) VALUES (?, ?, ?, ?, ?)";
        $values = array($user_id, $product_id, $quantity, $status, $created_at);
        return $this->db->query($query, $values);
    }
    public function update_order($user_id, $quantity, $product_id)
    {
        $query = "UPDATE orders SET quantity = ?, updated_at = ? WHERE user_id = ? AND product_id = ?";
        $date = date('Y-d-m H:i:s');
        $values = array($quantity, $date, $user_id, $product_id);
        return $this->db->query($query, $values);
    }

    public function remove_order($order_id)
    {
        $query = "DELETE FROM orders WHERE id = ?";
        return $this->db->query($query, $order_id);
    }

    public function submit_order()
    {
        echo "Submit order";
    }
}

?>