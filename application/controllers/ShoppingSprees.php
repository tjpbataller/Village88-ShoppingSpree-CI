<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShoppingSprees extends CI_Controller
{
    public function index()
    {   
        $this->session->set_userdata('user_id', 1);
        $view_data = array("products"=>$this->show_all_products());
        $this->load->view('shoppingspree/index.php', $view_data);
    }

    public function cart()
    {
        $cart_total_amount = $this->show_cart_total_amount();
        $view_data = array("orders"=>$this->show_all_orders(), "total_amount"=>$cart_total_amount['total_amount']);
        // var_dump($view_data);
        $this->load->view('shoppingspree/cart.php', $view_data);
    }

    public function show_all_orders()
    {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('ShoppingSpree');
        return $this->ShoppingSpree->get_all_orders($user_id);
    }

    public function show_all_products()
    {
        $this->load->model('ShoppingSpree');
        return $this->ShoppingSpree->get_all_products();
    }

    public function show_cart_total_amount()
    {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('ShoppingSpree');
        return $this->ShoppingSpree->get_cart_total_amount($user_id);
    }
    public function add_update_orders()
    {
        $order_details = $this->input->post(NULL, TRUE);
        $user_id = $this->session->userdata('user_id');
        $product_id = $order_details['id'];
        $input_quantity = intval($order_details['quantity']);
        $created_at = $updated_at = date('Y-d-m H:i:s');
        //Get current quantity of item
        $this->load->model('ShoppingSpree');
        $result = $this->ShoppingSpree->get_order_quantity($user_id, $product_id);
        // Check if item exists
        if($result)
        { // if it does update quantity
            $current_quantity = intval($result['quantity']);
            //Create variable to add current quantity of item and added quantity
            $item_quantity = $current_quantity + $input_quantity;
            //Update order
            $this->ShoppingSpree->update_order($user_id, $item_quantity, $product_id);
            redirect('cart');
        }
        else
        {//if it does not create new order and set status to pending
            $status = "pending";
            $this->ShoppingSpree->add_order($user_id, $product_id, $input_quantity, $status, $created_at);
            redirect('cart');
        }
    }
    public function delete_order()
    {
        $order_id = $this->input->post('order_id', TRUE);
        $this->load->model('ShoppingSpree');
        $this->ShoppingSpree->remove_order($order_id);
        redirect('cart');
        // var_dump();
    }
}
?>