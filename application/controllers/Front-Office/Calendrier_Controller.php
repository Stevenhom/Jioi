<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendrier_Controller extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper(array('form','url'));
    }

    public function calendrier(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_userid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_userdata($user_id);
        $user['user']= $user;
        $data = $this->models->getCalendar();
        $user['datas']=$data;
        $discipline=$this->models->getData('disciplines',['id_disciplines','nom']);
        $user['discipline']=$discipline;
        $site=$this->models->getData('site',['id_site','nom']);
        $user['site']=$site;
        //$data=$this->models->getData('calendrier',['id_calendrier','nom','prenom','date_naissance','adresse','contact']);
        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Front-Office/templates/template-calendrier', $user);
    }

    public function calendrier_trait(){
        $this->load->model('models');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_userid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_userdata($user_id);
        $user['user']= $user;
        $data = $this->models->getCalendar();
        $user['datas']=$data;
        $discipline=$this->models->getData('disciplines',['id_disciplines','nom']);
        $user['discipline']=$discipline;
        $site=$this->models->getData('site',['id_site','nom']);
        $user['site']=$site;
        $date_heure = strtotime($_POST['date_heure']);
        $day = date('d', $date_heure);
        $month = date('m', $date_heure);
        $year = date('Y', $date_heure);

        // Vérifiez si le mois est février (mois 2) et le jour dépasse 29
        if ($month == 2 && $day > 29) {
            $this->session->set_flashdata('error', 'Impossible d\'insérer la date, le jour dépasse le 29 février.');
        } else {
            // Effectuez l'insertion uniquement si la vérification est réussie
            $formatted_date = date('Y-m-d H:i:s', $date_heure);
            $discipline = $this->input->post('discipline');
            $site = $this->input->post('site');
            $insert = $this->models->insert('calendrier', ['daty', 'id_discipline', 'id_site'], [$formatted_date, $discipline, $site]);
            $this->session->set_flashdata('success', 'Insertion réussie');
        }

        //$this->load->view('Front-Office/templates/template-calendrier', $user);
        redirect('Front-Office/Calendrier_Controller/calendrier');

    }


}

