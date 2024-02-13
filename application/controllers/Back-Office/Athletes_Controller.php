<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Athletes_Controller extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper(array('form','url'));
    }

    public function athletes(){
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
        //$data=$this->models->getData('athletes',['id_athletes','nom','prenom','date_naissance','adresse','contact']);
        $data = $this->models->getAthletes();
        $user['datas']=$data;
        $discipline=$this->models->getDataConditionated2('disciplines',['id_disciplines','nom','code','id_type'],['id_type'],[2]);
        $user['discipline']=$discipline;
        $pays=$this->models->getData('pays',['id_pays','nom']);
        $user['pays']=$pays;
        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-athletes', $user);
    }

    public function athletes_trait(){
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
        $data = $this->models->getAthletes();
        $user['datas']=$data;
        $discipline=$this->models->getDataConditionated2('disciplines',['id_disciplines','nom','code','id_type'],['id_type'],[2]);
        $user['discipline']=$discipline;
        $pays=$this->models->getData('pays',['id_pays','nom']);
        $user['pays']=$pays;
        $name= $this->input->post('name');
        $discipline= $this->input->post('discipline');
        $pays= $this->input->post('pays');
        $insert= $this->models->insert('athletes',['nom','id_discipline','id_pays'],[$name,$discipline,$pays]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        //$this->load->view('Back-Office/templates/template-athletes', $user);
        redirect('Back-Office/Athletes_Controller/athletes');
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
        $idathletes=$this->input->get('id_athletes');
        //$data = $this->models->getAthletes();
        $data= $this->models->getDataConditionated2('athletes',['id_athletes','nom','id_discipline','id_pays'],['id_athletes'],[$idathletes]);
        $user['datas']=$data;
        
            $this->load->view('Back-Office/templates/delete_confirm_athlete', $user);
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
        $data = $this->models->getAthletes();
        $user['datas']=$data;
        $idathletes=$this->input->get('id_athletes');
        //$data= $this->models->getDataConditionated2('athletes',['name','tarif_heure'],['id_athletes'],[$idathletes]);
        //$datas= $data;
        //for ($i=0; $i < sizeof($datas); $i++) {
            //$data2= $this->models->insert('athletes_deleted',['name','tarif_heure'],[$datas[$i]['name'],$datas[$i]['tarif_heure']]);
            $data3= $this->models->delete('athletes',['id_athletes'],[$idathletes]);
            //$this->session->set_flashdata('success2', 'Suppression réussi');
            //$this->load->view('Back-Office/templates/template', $user);
            redirect('Back-Office/Athletes_Controller/athletes');
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
        $idathletes=$this->input->get('id_athletes');
        $data= $this->models->getDataConditionated2('athletes',['id_athletes','nom','id_discipline','id_pays'],['id_athletes'],[$idathletes]);
        $user['datas']=$data;
        $discipline=$this->models->getDataConditionated2('disciplines',['id_disciplines','nom','code','id_type'],['id_type'],[2]);
        $user['discipline']=$discipline;
        $pays=$this->models->getData('pays',['id_pays','nom']);
        $user['pays']=$pays;
        $this->load->view('Back-Office/templates/template-form-update-athletes', $user); 

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
        $idathletes=$this->input->get('id_athletes');
        $user['admin']= $user;
        $data=$this->models->getData('athletes',['id_athletes','nom']);
        $user['datas']=$data;
        $name= $this->input->post('name');
        $discipline= $this->input->post('discipline');
        $pays= $this->input->post('pays');
        $update= $this->models->update('athletes',['nom','id_discipline','id_pays'],[$name,$discipline,$pays],['id_athletes'],[$idathletes]);
        $discipline=$this->models->getDataConditionated2('disciplines',['id_disciplines','nom','code','id_type'],['id_type'],[2]);
        $user['discipline']=$discipline;
        $pays=$this->models->getData('pays',['id_pays','nom']);
        $user['pays']=$pays;
        //$this->session->set_flashdata('success', 'réussi');
        //$this->load->view('Back-Office/templates/template', $user);
        redirect('Back-Office/Athletes_Controller/athletes');
    }

}

