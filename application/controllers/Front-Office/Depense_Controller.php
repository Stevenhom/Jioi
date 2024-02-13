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
        $user_id = $this->models->get_userid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_userdata($user_id);
        $user['user']= $user;

        //$data=$this->models->getData('acte',['id_acte','nom','prenom','date_naissance','adresse','contact']);
        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Front-Office/templates/template-depense', $user);
    }


    public function importer_csv(){
		if (isset($_FILES['fichier_csv']) && $_FILES['fichier_csv']['error'] == UPLOAD_ERR_OK) {
            
            //fgets($handle);

			$csv_file = $_FILES['fichier_csv']['tmp_name'];
			$handle = fopen($csv_file, 'r');
            $content = file_get_contents($csv_file);
            //var_dump($_FILES['fichier_csv']);
			$this->load->model('models');

			while (($data = fgetcsv($handle)) !== false) {
				$array = explode(";", $data[0]);

				$val=$this->models->getdepensebycode($array[1]);
                $date = date("Y-m-d", strtotime($array[0])); // Formater la date en AAAA-MM-JJ
                $montant = is_numeric($array[2]) ? $array[2] : 0; 
				$this->models->ajoutDepenseP(
					$val[0]['id_type_depense'],
					$date,
					$montant
				);
			}
			fclose($handle);
			header('Location:'.base_url().'Front-Office/Depense_Controller/succes_import');
		} else {
			echo 'Erreur lors de l\'importation du fichier CSV.';
		} 
    }

    public function succes_import() {
        // Afficher la page de succès d'importation ici
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
        $this->load->view('Front-Office/templates/template', $user); 
    }


}

