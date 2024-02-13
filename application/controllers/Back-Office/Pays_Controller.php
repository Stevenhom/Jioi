<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pays_Controller extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper(array('form','url'));
    }

    public function pays(){
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
        //$data=$this->models->getData('pays',['id_pays','nom','prenom','date_naissance','adresse','contact']);
        $data = $this->models->getPays();
        $user['datas']=$data;
        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-pays', $user);
    }

    public function pays_trait(){
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
        $data = $this->models->getPays();
        $user['datas']=$data;
        $name= $this->input->post('name');
        $insert= $this->models->insert('pays',['nom'],[$name]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        //$this->load->view('Back-Office/templates/template-pays', $user);
        redirect('Back-Office/Pays_Controller/pays');
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
        $idpays=$this->input->get('id_pays');
        //$data = $this->models->getPays();
        $data= $this->models->getDataConditionated2('pays',['id_pays','nom'],['id_pays'],[$idpays]);
        $user['datas']=$data;
        
            $this->load->view('Back-Office/templates/delete_confirm', $user);
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
        $data = $this->models->getPays();
        $user['datas']=$data;
        $idpays=$this->input->get('id_pays');
        //$data= $this->models->getDataConditionated2('pays',['name','tarif_heure'],['id_pays'],[$idpays]);
        //$datas= $data;
        //for ($i=0; $i < sizeof($datas); $i++) {
            //$data2= $this->models->insert('pays_deleted',['name','tarif_heure'],[$datas[$i]['name'],$datas[$i]['tarif_heure']]);
            $data3= $this->models->delete('pays',['id_pays'],[$idpays]);
            //$this->session->set_flashdata('success2', 'Suppression réussi');
            //$this->load->view('Back-Office/templates/template', $user);
            redirect('Back-Office/Pays_Controller/pays');
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
        $idpays=$this->input->get('id_pays');
        $data= $this->models->getDataConditionated2('pays',['id_pays','nom'],['id_pays'],[$idpays]);
        $user['datas']=$data;
        $this->load->view('Back-Office/templates/template-form-update-pays', $user); 

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
        $idpays=$this->input->get('id_pays');
        $user['admin']= $user;
        $data=$this->models->getData('pays',['id_pays','nom']);
        $user['datas']=$data;
        $name= $this->input->post('name');
        $update= $this->models->update('pays',['nom'],[$name],['id_pays'],[$idpays]);
        //$this->session->set_flashdata('success', 'réussi');
        //$this->load->view('Back-Office/templates/template', $user);
        redirect('Back-Office/Pays_Controller/pays');
    }

}

