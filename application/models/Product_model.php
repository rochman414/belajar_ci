<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function getProduct()
    {
        $products = $this->db->get('nyoba')->result_array();
        return $products;
    }
}
