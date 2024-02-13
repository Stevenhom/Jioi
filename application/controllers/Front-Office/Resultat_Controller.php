<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resultat_Controller extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper(array('form','url'));
    }

    public function resultat(){
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
        $data = $this->models->getResultat();
        $user['datas']=$data;
        $discipline=$this->models->getDataConditionated2('disciplines',['id_disciplines','nom','code','id_type'],['id_type'],[1]);
        $user['discipline']=$discipline;
        $discipline2=$this->models->getAthleteDiscipline();
        $user['discipline2']=$discipline2;
        $pays=$this->models->getData('pays',['id_pays','nom']);
        $user['pays']=$pays;
        $classement_medailles=$this->models->getData('classement_medailles',['id_classement','nom']);
        $user['classement_medailles']=$classement_medailles;
        //$data=$this->models->getData('resultat',['id_resultat','nom','prenom','date_naissance','adresse','contact']);
        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Front-Office/templates/template-resultat', $user);
    }

    public function resultat_trait(){
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
        $data = $this->models->getResultat();
        $user['datas']=$data;
        $discipline=$this->models->getDataConditionated2('disciplines',['id_disciplines','nom','code','id_type'],['id_type'],[1]);
        $user['discipline']=$discipline;
        $discipline2=$this->models->getAthleteDiscipline();
        $user['discipline2']=$discipline2;
        $pays=$this->models->getData('pays',['id_pays','nom']);
        $user['pays']=$pays;
        $classement_medailles=$this->models->getData('classement_medailles',['id_classement','nom']);
        $user['classement_medailles']=$classement_medailles;
        $discipline= $this->input->post('discipline');
        $pays= $this->input->post('pays');
        $rang= $this->input->post('rang');

        $medailleId = 0;

        if ($rang == 1) {
            $medailleId = 1; // ID correspondant à la médaille d'or
        } elseif ($rang == 2) {
            $medailleId = 2; // ID correspondant à la médaille d'argent
        } elseif ($rang == 3) {
            $medailleId = 3; // ID correspondant à la médaille de bronze
        }

        if($rang<=3){
            $insert= $this->models->insert('resultat',['id_discipline','id_pays','rang','id_classement_medaille'],[$discipline,$pays,$rang,$medailleId]);
        }
        else{
            $insert= $this->models->insert('resultat',['id_discipline','id_pays','rang'],[$discipline,$pays,$rang]);
        }
        $this->session->set_flashdata('success', 'Insertion réussi');
        //$this->load->view('Front-Office/templates/template-resultat', $user);
        redirect('Front-Office/Resultat_Controller/resultat');

    }

    public function resultat_trait2(){
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
        $data = $this->models->getResultat();
        $user['datas']=$data;
        $discipline=$this->models->getDataConditionated2('disciplines',['id_disciplines','nom','code','id_type'],['id_type'],[1]);
        $user['discipline']=$discipline;

        $pays=$this->models->getData('pays',['id_pays','nom']);
        $user['pays']=$pays;
        $classement_medailles=$this->models->getData('classement_medailles',['id_classement','nom']);
        $user['classement_medailles']=$classement_medailles;
        $athlete = $this->input->post('athlete');
        $rang = $this->input->post('rang');

        $id_pays=$this->models->getIdPaysByAthlete($athlete);
        $id_discipline1=$this->models->getIdDisciplineByAthlete2($athlete); 

        $medailleId = 0;
    
        if ($rang == 1) {
            $medailleId = 1; // ID correspondant à la médaille d'or
        } elseif ($rang == 2) {
            $medailleId = 2; // ID correspondant à la médaille d'argent
        } elseif ($rang == 3) {
            $medailleId = 3; // ID correspondant à la médaille de bronze
        }
    
        // Obtenir l'ID de la discipline de l'athlète
    
        
        $medaillesCount = $this->models->getIsany();

        $isaValue = $medaillesCount; 

        if ($rang <= 3) {
            // Insérer le résultat avec le classement de médaille
            //var_dump($isaValue); 
            if ($isaValue > 4) {
                // Afficher un message d'erreur
                $this->session->set_flashdata('error', 'Erreur de connexion !');
                redirect(site_url('Front-Office/Resultat_Controller/resultat').'?error=Erreur de connexion !');
            } else {
                // Insérer le résultat avec le classement de médaille
                $insert = $this->models->insert('resultat', ['id_discipline', 'id_pays', 'rang', 'id_classement_medaille', 'id_athlete'], [$id_discipline1, $id_pays, $rang, $medailleId, $athlete]);
            }  

        } else {
            // Insérer le résultat sans le classement de médaille
            $insert = $this->models->insert('resultat', ['id_discipline', 'id_pays', 'rang'], [$id_discipline1, $id_pays, $rang]);
        }
    

        redirect('Front-Office/Resultat_Controller/resultat'); // Rediriger vers la page de résultats

    }
    

}

