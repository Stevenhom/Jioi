<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Controller extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper(array('form','url'));
    }

    public function site(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_adminid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_admindata($user_id);
        $user['admin']= $user;
        //$data=$this->models->getData('site',['id_site','nom','prenom','date_naissance','adresse','contact']);
        $data = $this->models->getSite();
        $user['datas']=$data;
        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-site', $user);
    }

    public function site_trait(){
        $this->load->model('models');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_adminid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_admindata($user_id);
        $user['admin']= $user;
        $data = $this->models->getSite();
        $user['datas']=$data;
        $name= $this->input->post('name');
        $insert= $this->models->insert('site',['nom'],[$name]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        //$this->load->view('Back-Office/templates/template-site', $user);
        redirect('Back-Office/Site_Controller/site');
    }

    public function delete(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_adminid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_admindata($user_id);
        $user['admin']= $user;
        $idsite=$this->input->get('id_site');
        //$data = $this->models->getSite();
        $data= $this->models->getDataConditionated2('site',['id_site','nom'],['id_site'],[$idsite]);
        $user['datas']=$data;
        
            $this->load->view('Back-Office/templates/delete_confirm_site', $user);
        //}
        

    }

    public function delete_confirm(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_adminid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_admindata($user_id);
        $user['admin']= $user;
        $data = $this->models->getSite();
        $user['datas']=$data;
        $idsite=$this->input->get('id_site');
        //$data= $this->models->getDataConditionated2('site',['name','tarif_heure'],['id_site'],[$idsite]);
        //$datas= $data;
        //for ($i=0; $i < sizeof($datas); $i++) {
            //$data2= $this->models->insert('site_deleted',['name','tarif_heure'],[$datas[$i]['name'],$datas[$i]['tarif_heure']]);
            $data3= $this->models->delete('site',['id_site'],[$idsite]);
            //$this->session->set_flashdata('success2', 'Suppression réussi');
            //$this->load->view('Back-Office/templates/template', $user);
            redirect('Back-Office/Site_Controller/site');
        //}
        

    }

    public function update(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_adminid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_admindata($user_id);
        $user['admin']= $user;
        $idsite=$this->input->get('id_site');
        $data= $this->models->getDataConditionated2('site',['id_site','nom'],['id_site'],[$idsite]);
        $user['datas']=$data;
        $this->load->view('Back-Office/templates/template-form-update-site', $user); 

    }

    
    public function form_trait_update(){
        $this->load->model('models');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_adminid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_admindata($user_id);
        $idsite=$this->input->get('id_site');
        $user['admin']= $user;
        $data=$this->models->getData('site',['id_site','nom']);
        $user['datas']=$data;
        $name= $this->input->post('name');
        $update= $this->models->update('site',['nom'],[$name],['id_site'],[$idsite]);
        //$this->session->set_flashdata('success', 'réussi');
        //$this->load->view('Back-Office/templates/template', $user);
        redirect('Back-Office/Site_Controller/site');
    }

}

