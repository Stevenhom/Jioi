<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SController extends CI_Controller{

    public function home(){
        $this->load->library('session');
        $this->load->model('models');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_userid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_userdata($user_id);
        $user['user']= $user;
        $this->load->view('Front-Office/templates/template', $user);
    }

	public function login(){
        $this->load->view('Front-Office/login');
    }    

    public function authentification(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');
        $this->load->library('session');
		
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        
        if ($this->models->isUser($email, $pass) == true) 
        {
            $user_id = $this->models->get_userid($email, $pass);
            $this->session->set_userdata('user_id', $user_id);
            $this->session->set_userdata('email', $email);
            $this->session->set_userdata('pass', $pass);
            $user=$this->models->get_userdata($user_id);
            $user['user']= $user;
            //site_url('votre-page?email='.$email);
            $this->load->view('Front-Office/templates/template', $user);  
        }
        else
        {
            $this->session->set_flashdata('error', 'Erreur de connexion !');
            redirect(site_url('Front-Office/SController/login').'?error=Erreur de connexion !');
        }
    }

}

