<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }




    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        $user       = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {

            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<script>swal.fire("","Wrong password!","error")</script>');
                    redirect(base_url('auth'));
                };
            } else {
                $this->session->set_flashdata('message', '<script>swal.fire("","Email has not activated! Please actived!","error")</script>');
                redirect(base_url('auth'));
            }
        } else {
            $this->session->set_flashdata('message', '<script>swal.fire("","Email is not register!","error")</script>');
            redirect(base_url('auth'));
        }
    }





    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [

            'is_unique'     => 'This email have alredy user!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [

            'matches'       => 'Password dont match!',
            'min_length'    => 'Password to sort',

        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Registration Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name'      => htmlspecialchars($this->input->post('name')),
                'email'     => htmlspecialchars($this->input->post('email')),
                'image'     => 'default.jpg',
                'password'  => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id'   => 2,
                'is_active' => 1,
                'date_created'  => time()
            ];

            $this->db->insert('users', $data);
            $this->session->set_flashdata('message', '<script>swal.fire("","Acount has been created!","success")</script>');
            redirect(base_url('auth'));
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<script>swal.fire("","You have been logout!","success")</script>');
        redirect(base_url('auth'));
    }
}
