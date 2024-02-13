<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discipline_Controller extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper(array('form','url'));
    }

    public function discipline(){
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
        //$data=$this->models->getData('discipline',['id_discipline','nom','prenom','date_naissance','adresse','contact']);
        $data = $this->models->getDiscipline();
        $user['datas']=$data;
        $type=$this->models->getData('type_discipline',['id_type','label']);
        $user['type']=$type;
        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-disciplines', $user);
    }

    public function discipline_trait(){
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
        $data = $this->models->getDiscipline();
        $user['datas']=$data;
        $type_discipline=$this->models->getData('type_discipline',['id_type','label']);
        $user['type']=$type_discipline;
        $name= $this->input->post('name');
        $code= $this->input->post('code');
        $type= $this->input->post('type');
        $insert= $this->models->insert('disciplines',['nom','code','id_type'],[$name,$code,$type]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        //$this->load->view('Back-Office/templates/template-disciplines', $user);
        redirect('Back-Office/Discipline_Controller/discipline');
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
        $iddiscipline=$this->input->get('id_disciplines');
        //$data = $this->models->getDiscipline();
        $data= $this->models->getDataConditionated2('disciplines',['id_disciplines','nom','code','id_type'],['id_disciplines'],[$iddiscipline]);
        $user['datas']=$data;
        
            $this->load->view('Back-Office/templates/delete_confirm_discipline', $user);
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
        $data = $this->models->getDiscipline();
        $user['datas']=$data;
        $iddiscipline=$this->input->get('id_disciplines');
        //$data= $this->models->getDataConditionated2('discipline',['name','tarif_heure'],['id_discipline'],[$iddiscipline]);
        //$datas= $data;
        //for ($i=0; $i < sizeof($datas); $i++) {
            //$data2= $this->models->insert('discipline_deleted',['name','tarif_heure'],[$datas[$i]['name'],$datas[$i]['tarif_heure']]);
            $data3= $this->models->delete('disciplines',['id_disciplines'],[$iddiscipline]);
            //$this->session->set_flashdata('success2', 'Suppression réussi');
            //$this->load->view('Back-Office/templates/template', $user);
            redirect('Back-Office/Discipline_Controller/discipline');
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
        $type=$this->models->getData('type_discipline',['id_type','label']);
        $user['type']=$type;
        $iddiscipline=$this->input->get('id_disciplines');
        $data= $this->models->getDataConditionated2('disciplines',['id_disciplines','nom','code','id_type'],['id_disciplines'],[$iddiscipline]);
        $user['datas']=$data;
        $this->load->view('Back-Office/templates/template-form-update-disciplines', $user); 

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
        $iddiscipline=$this->input->get('id_disciplines');
        $user['admin']= $user;
        $data=$this->models->getData('disciplines',['id_disciplines','nom','code','id_type']);
        $user['datas']=$data;
        $type=$this->models->getData('type_discipline',['id_type','label']);
        $user['type']=$type;
        $name= $this->input->post('name');
        $code= $this->input->post('code');
        $type= $this->input->post('type');
        $update= $this->models->update('disciplines',['nom','code','id_type'],[$name,$code,$type],['id_disciplines'],[$iddiscipline]);
        //$this->session->set_flashdata('success', 'réussi');
        //$this->load->view('Back-Office/templates/template', $user);
        redirect('Back-Office/Discipline_Controller/discipline');
    }

}

