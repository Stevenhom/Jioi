<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depense_Controller extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper(array('form','url'));
    }

    public function depense(){
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
        $data = $this->models->getCategorie();
        $user['datas']=$data;
        $data2 = $this->models->getBudget();
        $user['datas2']=$data2;
        $categorie=$this->models->getData('type_categorie',['id_type','label']);
        $user['categorie']=$categorie;
        $discipline=$this->models->getData('disciplines',['id_disciplines','nom','code']);
        $user['discipline']=$discipline;
        $categorie2=$this->models->getData('categorie',['id_categorie','id_type','nom','code']);
        $user['categorie2']=$categorie2;
        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-depense', $user);
    }

    public function depense_trait(){
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
        $data = $this->models->getCategorie();
        $user['datas']=$data;
        $data2 = $this->models->getBudget();
        $user['datas2']=$data2;
        $categorie=$this->models->getData('type_categorie',['id_type','label']);
        $user['categorie']=$categorie;
        $discipline=$this->models->getData('disciplines',['id_disciplines','nom','code']);
        $user['discipline']=$discipline;
        $categorie2=$this->models->getData('categorie',['id_categorie','id_type','nom','code']);
        $user['categorie2']=$categorie2;
        $type= $this->input->post('type');
        $name= $this->input->post('name');
        $code= $this->input->post('code');
        $insert= $this->models->insert('categorie',['id_type','nom','code'],[$type,$name,$code]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        //$this->load->view('Back-Office/templates/template-depense', $user);
        redirect('Back-Office/Depense_Controller/depense');
    }

    public function depense_trait2(){
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
        $data = $this->models->getCategorie();
        $user['datas']=$data;
        $data2 = $this->models->getBudget();
        $user['datas2']=$data2;
        $categorie=$this->models->getData('type_categorie',['id_type','label']);
        $user['categorie']=$categorie;
        $discipline=$this->models->getData('disciplines',['id_disciplines','nom','code']);
        $user['discipline']=$discipline;
        $categorie2=$this->models->getData('categorie',['id_categorie','id_type','nom','code']);
        $user['categorie2']=$categorie2;
        $id_categorie= $this->input->post('code_categorie');
        $montant= $this->input->post('montant');
        $daty= $this->input->post('daty');
        $id_disciplines= $this->input->post('code_disciplines');
        $insert= $this->models->insert('budget',['id_categorie','montant','daty','id_discipline'],[$id_categorie,$montant,$daty,$id_disciplines]);
        $this->session->set_flashdata('success2', 'Insertion réussi');
        //$this->load->view('Back-Office/templates/template-depense', $user);
        redirect('Back-Office/Depense_Controller/depense');
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
        $iddepense=$this->input->get('id_depense');
        //$data = $this->models->getdepense();
        $data= $this->models->getDataConditionated2('depense',['id_depense','nom'],['id_depense'],[$iddepense]);
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
        $data = $this->models->getdepense();
        $user['datas']=$data;
        $iddepense=$this->input->get('id_depense');
        //$data= $this->models->getDataConditionated2('depense',['name','tarif_heure'],['id_depense'],[$iddepense]);
        //$datas= $data;
        //for ($i=0; $i < sizeof($datas); $i++) {
            //$data2= $this->models->insert('depense_deleted',['name','tarif_heure'],[$datas[$i]['name'],$datas[$i]['tarif_heure']]);
            $data3= $this->models->delete('depense',['id_depense'],[$iddepense]);
            //$this->session->set_flashdata('success2', 'Suppression réussi');
            //$this->load->view('Back-Office/templates/template', $user);
            redirect('Back-Office/Depense_Controller/depense');
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
        $iddepense=$this->input->get('id_depense');
        $data= $this->models->getDataConditionated2('depense',['id_depense','nom'],['id_depense'],[$iddepense]);
        $user['datas']=$data;
        $this->load->view('Back-Office/templates/template-form-update-depense', $user); 

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
        $iddepense=$this->input->get('id_depense');
        $user['admin']= $user;
        $data=$this->models->getData('depense',['id_depense','nom']);
        $user['datas']=$data;
        $name= $this->input->post('name');
        $update= $this->models->update('depense',['nom'],[$name],['id_depense'],[$idpays]);
        //$this->session->set_flashdata('success', 'réussi');
        $this->load->view('Back-Office/templates/template', $user);
        redirect('Back-Office/Depense_Controller/depense');
    }

}

