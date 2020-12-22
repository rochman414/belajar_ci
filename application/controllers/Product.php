<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function get_all_product()
    {
        $nyoba = $this->Product_model->getProduct();
        var_dump($nyoba);
    }
}
