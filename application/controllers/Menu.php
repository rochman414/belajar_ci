<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {

        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('templates/user_topbar');
        $this->load->view('menu/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambahMenu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        // $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        // $data['menu'] = $this->db->get('user_menu')->result_array();

        if ($this->form_validation->run() == false) {
            // $data['title'] = 'Menu Management';
            // $this->load->view('templates/user_header', $data);
            // $this->load->view('templates/user_sidebar');
            // $this->load->view('templates/user_topbar');
            // $this->load->view('menu/index');
            // $this->load->view('templates/user_footer');
            redirect(base_url('menu'));
        } else {
            $data = ['menu' => $this->input->post('menu')];
            $this->db->insert('user_menu', $data);
            $this->session->set_flashdata('message', '<script>swal.fire("","Menu has been added!","success")</script>');
            redirect(base_url('menu'));
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<script>swal.fire("","Menu failed to edit!","erorr")</script>');
            redirect(base_url('menu'));
        } else {
            $data = ['menu' => $this->input->post('menu')];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user_menu', $data);
            $this->session->set_flashdata('message', '<script>swal.fire("success","Menu has been edited!","success")</script>');
            redirect(base_url('menu'));
        }
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
        // $this->session->set_flashdata('message', '<script>swal.fire("","Menu has been deleted!","success")</script>');
        redirect(base_url('menu'));
    }

    public function submenu()
    {
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model');

        $data['submenu'] = $this->Menu_model->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();


        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('templates/user_topbar');
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/user_footer');
    }
}
