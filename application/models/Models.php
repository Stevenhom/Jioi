
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Models extends CI_Model
    {

        public function isAdmin($email, $motdepasse)
        {
            if (sizeof($this->getDataConditionated('admins', ['mail', 'password'], ['mail', 'password'], [$email, $motdepasse])) == 0) 
            {
                return false;
            }
            return true;
        }

        public function isUser($email, $motdepasse)
        {
            if (sizeof($this->getDataConditionated('gestionnaires', ['mail', 'password'], ['mail', 'password'], [$email, $motdepasse])) == 0) 
            {
                return false;
            }
            return true;
        }
        
        public function getPays()
        {
            $this->db->select('pays.id_pays, pays.nom');
            $this->db->from('pays');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getDiscipline()
        {
            $this->db->select('disciplines.id_disciplines, disciplines.nom, disciplines.code, type_discipline.label as type');
            $this->db->from('disciplines');
            $this->db->join('type_discipline','disciplines.id_type=type_discipline.id_type');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getAthleteDiscipline()
        {
            $query = $this->db->select('athletes.id_athletes, athletes.nom, disciplines.nom as discipline, disciplines.code, type_discipline.label as type, pays.nom as pays')
                              ->from('athletes')
                              ->join('disciplines', 'disciplines.id_disciplines = athletes.id_discipline')
                              ->join('type_discipline', 'type_discipline.id_type = disciplines.id_type')
                              ->join('pays', 'pays.id_pays = athletes.id_pays')
                              ->get();
        
            return $query->result_array();
        }
        

        public function getSite()
        {
            $this->db->select('site.id_site, site.nom');
            $this->db->from('site');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getAthletes()
        {
            $this->db->select('athletes.id_athletes, athletes.nom AS athlete_nom, disciplines.nom AS discipline_nom, pays.nom AS pays_nom');
            $this->db->from('athletes');
            $this->db->join('disciplines','athletes.id_discipline=disciplines.id_disciplines');
            $this->db->join('pays','athletes.id_pays=pays.id_pays');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getCalendar()
        {
            $this->db->select('calendrier.id_calendrier, calendrier.daty, disciplines.nom AS discipline_nom, site.nom AS site_nom');
            $this->db->from('calendrier');
            $this->db->join('disciplines','calendrier.id_discipline=disciplines.id_disciplines');
            $this->db->join('site','calendrier.id_site=site.id_site');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getCategorie()
        {
            $this->db->select('categorie.id_categorie, type_categorie.label as type, categorie.nom, categorie.code');
            $this->db->from('categorie');
            $this->db->join('type_categorie','categorie.id_type=type_categorie.id_type');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getIdPaysByAthlete2($athleteId) {

            $this->db->select('pays.id_pays');
            $this->db->from('resultat');
            $this->db->join('pays', 'resultat.id_pays = pays.id_pays');
            $this->db->join('athletes', 'athletes.id_pays = pays.id_pays');
            $this->db->where('athletes.id_athletes', $athleteId);
            
            $query = $this->db->get();
            $result = $query->row();
            
            if ($result) {
                return $result->id_pays;
            } else {
                return null; // Athlète non trouvé, renvoyer null ou une valeur par défaut
            }
        }

        
        public function getIdDisciplineByAthlete2($athleteId) {

            $this->db->select('disciplines.id_disciplines');
            $this->db->from('athletes');
            $this->db->join('disciplines', 'athletes.id_discipline = disciplines.id_disciplines');
            $this->db->where('athletes.id_athletes', $athleteId);
            
            $query = $this->db->get();
            $result = $query->row();

            if ($result) {
                return $result->id_disciplines;
            } else {
                return null; // Athlète non trouvé, renvoyer null ou une valeur par défaut
            }
        }

        public function getResultat()
        {
            $this->db->select('resultat.id_resultat, disciplines.nom AS discipline_nom, pays.nom AS pays_nom, resultat.rang, classement_medailles.nom as medaille');
            $this->db->from('resultat');
            $this->db->join('disciplines', 'resultat.id_discipline = disciplines.id_disciplines');
            $this->db->join('pays', 'resultat.id_pays = pays.id_pays');
            $this->db->join('classement_medailles', 'classement_medailles.id_classement = resultat.id_classement_medaille', 'left'); // Utilisation de LEFT JOIN
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getCalendarSearch($discipline, $daty){
            $sql = "
                SELECT calendrier.daty, disciplines.nom as discipline_nom, site.nom as site_nom 
                FROM calendrier 
                JOIN disciplines ON calendrier.id_discipline = disciplines.id_disciplines
                JOIN site ON calendrier.id_site = site.id_site 
                WHERE calendrier.id_discipline = ? AND DATE(calendrier.daty) = ?
                ORDER BY disciplines.nom ASC, calendrier.daty ASC, site.nom ASC
            ";
        
            $query = $this->db->query($sql, array($discipline, $daty));
            return $query->result_array();
        }

        public function getMedaillePays($id){
            $sql = "
            create or replace view isa_medaille as select  COUNT(*) as medailles_count from resultat where id_pays=$id group by id_classement_medaille;
            ";
        
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        public function getIsany() {
            $sql = "SELECT SUM(medailles_count) as isa FROM isa_medaille;";
            $query = $this->db->query($sql);
            $result = $query->row();
            
            // Assurez-vous que la valeur est convertie en nombre
            $isaValue = intval($result->isa);
            
            return $isaValue;
        }
        


        public function getCalendarSearchDiscipline($discipline){
            $sql = "
                SELECT calendrier.daty, disciplines.nom as discipline_nom, site.nom as site_nom 
                FROM calendrier 
                JOIN disciplines ON calendrier.id_discipline = disciplines.id_disciplines
                JOIN site ON calendrier.id_site = site.id_site 
                WHERE calendrier.id_discipline = ?
                ORDER BY disciplines.nom ASC, calendrier.daty ASC, site.nom ASC
            ";
        
            $query = $this->db->query($sql, array($discipline));
            return $query->result_array();
        }

        public function getCalendarSearchDaty($daty){
            $sql = "
                SELECT calendrier.daty, disciplines.nom as discipline_nom, site.nom as site_nom 
                FROM calendrier 
                JOIN disciplines ON calendrier.id_discipline = disciplines.id_disciplines
                JOIN site ON calendrier.id_site = site.id_site 
                WHERE  DATE(calendrier.daty) = ?
                ORDER BY disciplines.nom ASC, calendrier.daty ASC, site.nom ASC
            ";
        
            $query = $this->db->query($sql, array($daty));
            return $query->result_array();
        }

        public function getDashMedaille() {
            $sql = "
            SELECT
            pays.nom AS pays,
            COALESCE(SUM(CASE WHEN classement_medailles.nom = 'Or' THEN 1 ELSE 0 END), 0) AS or_count,
            COALESCE(SUM(CASE WHEN classement_medailles.nom = 'Argent' THEN 1 ELSE 0 END), 0) AS argent_count,
            COALESCE(SUM(CASE WHEN classement_medailles.nom = 'Bronze' THEN 1 ELSE 0 END), 0) AS bronze_count,
            COALESCE(COUNT(CASE WHEN classement_medailles.nom IN ('Or', 'Argent', 'Bronze') THEN 1 ELSE NULL END), 0) AS total_medailles
        FROM
            pays
        LEFT JOIN
            resultat ON resultat.id_pays = pays.id_pays
        LEFT JOIN
            classement_medailles ON resultat.id_classement_medaille = classement_medailles.id_classement
        GROUP BY
            pays.nom
        ORDER BY
            or_count DESC, argent_count DESC, bronze_count DESC;
        
            ";
        
            $query = $this->db->query($sql);
        
            if ($query && $query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array(); // Aucun résultat trouvé, retourner un tableau vide
            }
        }

        public function CountIsa($pays) {
            $sql = "
                select  COUNT(*) as medailles_count from resultat where id_pays=$pays group by id_classement_medaille;
            ";
        
            $query = $this->db->query($sql);
        
            if ($query && $query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array(); // Aucun résultat trouvé, retourner un tableau vide
            }
        }

        public function countMedaillesByClassement() {
            $sql = "
            select sum(medailles_count) as isa from isa_medaille;
            ";
        
            $query = $this->db->query($sql);
        
            if ($query && $query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array(); // Aucun résultat trouvé, retourner un tableau vide
            }
        }
        
        public function getBudget() {
            $sql = "
            select budget.id_budget, type_categorie.label as type,
            categorie.nom, categorie.code as code_categorie, budget.montant, budget.daty,
            disciplines.nom as discipline, disciplines.code as code_discipline
            from budget join categorie on categorie.id_categorie=budget.id_categorie
            join type_categorie on type_categorie.id_type=categorie.id_type
            join disciplines on disciplines.id_disciplines=budget.id_discipline;
            ";
        
            $query = $this->db->query($sql);
        
            if ($query && $query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array(); // Aucun résultat trouvé, retourner un tableau vide
            }
        }



        public function getIdDisciplineByAthlete($athlete) {
            $this->db->select('id_discipline');
            $this->db->where('id_athletes', $athlete);
            $query = $this->db->get('athletes');
            $result = $query->row_array();
        
            if ($result) {
                return $result['id_discipline'];
            } else {
                return null; // ou une valeur par défaut si l'athlète n'est pas trouvé
            }
        }


        public function getIdPaysByAthlete($athlete) {
            $this->db->select('id_pays');
            $this->db->where('id_athletes', $athlete);
            $query = $this->db->get('athletes');
            $result = $query->row_array();
        
            if ($result) {
                return $result['id_pays'];
            } else {
                return null; // ou une valeur par défaut si l'athlète n'est pas trouvé
            }
        }




        public function getIdTypeByLabel($type){
            $query = $this->db->query("
                select id_type from type_categorie where label=?
            ", array($type));
            $result = $query->row_array();
            return $result['id_type'];
        }
        
        public function getIdCategorieByCodeType($code, $type){
            $query = $this->db->query("
                select id_categorie from categorie where code=? and id_type=?
            ", array($code, $type));
            $result = $query->row_array();
        
            // Si aucune catégorie n'est trouvée, insérez-la dans la table et obtenez son ID
            if (!$result) {
                $this->db->insert('categorie', array('id_type' => $type, 'nom' => 'Nouvelle Catégorie', 'code' => $code));
                $result = $this->db->insert_id();
            }
        
            return $result['id_categorie'];
        }
        
        public function getIdDisciplineByCode($code){
            $query = $this->db->query("
                select id_disciplines from disciplines where code=?
            ", array($code));
            $result = $query->row_array();
            return $result['id_disciplines'];
        }
        
        public function updateViews() {
            // Mettez à jour la vue r_depense
            $this->db->query("CREATE OR REPLACE VIEW r_depense AS
                SELECT discipline, SUM(montant) AS depense
                FROM v_depense
                GROUP BY discipline;");
        
            // Mettez à jour la vue r_recette
            $this->db->query("CREATE OR REPLACE VIEW r_recette AS
                SELECT discipline, SUM(montant) AS recette
                FROM v_recette
                GROUP BY discipline;");
        }
        
        public function getDash_budget() {
            // Appel pour mettre à jour les vues avant de récupérer les données
            $this->updateViews();
        
            // Exécutez la requête SELECT pour obtenir les données de la vue r_depense et r_recette
            $query = $this->db->query("
                    SELECT
                    COALESCE(rd.discipline, rr.discipline) AS discipline,
                    COALESCE(rr.recette, 0) AS recette,
                    COALESCE(rd.depense, 0) AS depense,
                    COALESCE(rr.recette, 0) - COALESCE(rd.depense, 0) AS difference
                FROM r_depense rd
                FULL OUTER JOIN r_recette rr ON rd.discipline = rr.discipline;
            ");
        
            // Renvoie un tableau associatif contenant les données de la requête
            return $query->result_array();
        }

        public function insertResultat($data) {
            // Insérer le résultat dans la table 'resultat'
            $this->db->insert('resultat', $data);
            
            // Récupérer l'ID du résultat inséré
            $id_resultat = $this->db->insert_id();
    
            return $id_resultat;
        }
    

        
        public function insertAthleteResultat($athlete, $id_resultat) {
            // Insérer l'ID de l'athlète et l'ID du résultat dans la table 'athletes_resultat'
            $insert_data = array(
                'id_athlete' => $athlete,
                'id_resultat' => $id_resultat
            );
            $this->db->insert('athletes_resultat', $insert_data);
            
            return ($this->db->affected_rows() > 0); // Retourne vrai si l'insertion a réussi
        }
    

        public function ajoutBudget($id_categorie, $montant, $date, $id_discipline) {
            $data = array(
                'id_categorie' => $id_categorie,
                'montant' => $montant,
                'daty' => $date,
                'id_discipline' => $id_discipline
            );
        
            // Insérer les données dans la table "budget"
            $this->db->insert('budget', $data);
            
            // Vérifier si l'insertion a réussi
            if ($this->db->affected_rows() > 0) {
                return true; // Insertion réussie
            } else {
                return false; // Insertion échouée
            }
        }

        public function convertCsvDate($csvDate) {
            $dateObject = DateTime::createFromFormat('d/m/Y', $csvDate);
            return $dateObject->format('Y-m-d');
        }

        /*public function getBudget() {
            $recettes = $this->getRecettesInfo();
            $sum = 0;
        
            foreach ($recettes as $recette) {
                $sum += $recette['budget_mensuel'];
            }
        
            return $sum;
        }*/


        public function getData($tableName, $columnsName)
        {
            $query = "select ";
            for ($i=0; $i < sizeof($columnsName) - 1; $i++) 
            {
                $query = $query.$columnsName[$i].", ";
            }
            $query = $query.$columnsName[sizeof($columnsName) - 1]." ";
            $query = $query."from ".$tableName; 
            return  $this->db->query($query)->result_array();
        }

        public function getDataConditionated($tableName, $columnsName, $columnsConditionated, $valuesConditionated)
        {
            $query = "select ";
            for ($i=0; $i < sizeof($columnsName) - 1; $i++) 
            {
                $query = $query.$columnsName[$i].", ";
            }
            $query = $query.$columnsName[sizeof($columnsName) - 1]." ";
            $query = $query."from ".$tableName." where "; 
            for ($i=0; $i < sizeof($columnsConditionated) - 1; $i++) 
            {
                $query = $query . $columnsConditionated[$i] . " = '" . $valuesConditionated[$i] . "' and "; 
            }
            $query = $query.$columnsConditionated[sizeof($columnsConditionated) - 1]." = '". $valuesConditionated[sizeof($columnsConditionated) - 1]."'";    
            return $this->db->query($query)->result_array();        
        }

        public function get_adminid($email, $pass){
            $query = "select id_admins from admins where mail='".$email."' and password='".$pass."'";    
            //echo $query;
            $result=$this->db->query($query)->result_array();
            if(!empty($result)) {
                // Retourner la première valeur de la première ligne
                return $result[0]['id_admins'];
            } else {
                // Si le résultat est vide, retourner null
                return null;
            }
        }

        public function get_admindata($id){
            $query = "select*from admins where id_admins=".$id."";    
            return $this->db->query($query)->result_array();
        }

        public function get_admin_data($admin_id) {
            $query = $this->db->get_where('admins', array('id_admins' => $admin_id));
            return $query->row_array();
        }


        public function get_userid($email, $pass){
            $query = "select id_gestionnaires from gestionnaires where mail='".$email."' and password='".$pass."'";    
            //echo $query;
            $result=$this->db->query($query)->result_array();
            if(!empty($result)) {
                // Retourner la première valeur de la première ligne
                return $result[0]['id_gestionnaires'];
            } else {
                // Si le résultat est vide, retourner null
                return null;
            }
        }

        public function get_userdata($id){
            $query = "select*from gestionnaires where id_gestionnaires=".$id."";    
            return $this->db->query($query)->result_array();
        }

        public function get_user_data($user_id) {
            $query = $this->db->get_where('gestionnaires', array('id_gestionnaires' => $user_id));
            return $query->row_array();
        }



        public function getDataConditionated2($tableName, $columnsName, $columnsConditionated, $valuesConditionated)
        {
            $query = "select ";
            for ($i=0; $i < sizeof($columnsName) - 1; $i++) 
            {
                $query = $query.$columnsName[$i].", ";
            }
            $query = $query.$columnsName[sizeof($columnsName) - 1]." ";
            $query = $query."from ".$tableName." where "; 
            for ($i=0; $i < sizeof($columnsConditionated) - 1; $i++) 
            {
                $query = $query . $columnsConditionated[$i] . " = '" . $valuesConditionated[$i] . "' and "; 
            }
            $query = $query.$columnsConditionated[sizeof($columnsConditionated) - 1]." = ". $valuesConditionated[sizeof($columnsConditionated) - 1]."";    
            return  $this->db->query($query)->result_array();        
        }

        public function escapeApostrophe($str) {
            return str_replace("'", "''", $str);
        }

        public function insert($tableName, $column, $values)
        {
            $query = "insert into ".$tableName.' (';
            for ($i=0; $i < sizeof($column) - 1; $i++) 
            { 
                $query = $query.$column[$i].', ';
            } 
            $query = $query.$column[$i].')';
            $query = $query." values (";
            for ($i=0; $i < sizeof($values) - 1; $i++) 
            {
                $query = $query.'\''.$this->escapeApostrophe($values[$i]).'\', ';
            }
            $query = $query.'\''.$this->escapeApostrophe(($values[sizeof($values) - 1])).'\'';
            $query = $query.')';
            $this->db->query($query);
        }
        
        public function update($tableName, $column, $values, $columnsConditionated, $valuesConditionated)
        {
            $query = "update " . $tableName . " set ";
            for ($i = 0; $i < sizeof($column) - 1; $i++) { 
                $query .= $column[$i] . " = '" . $this->db->escape_str($values[$i]) . "', ";
            }
            $query .= $column[sizeof($values) - 1] . " = '" . $this->db->escape_str($values[sizeof($values) - 1]) . "'";
            $query .= " where ";
            for ($i = 0; $i < sizeof($columnsConditionated) - 1; $i++) { 
                $query .= $columnsConditionated[$i] . " = '" . $this->db->escape_str($valuesConditionated[$i]) . "' and ";
            }
            $query .= $columnsConditionated[sizeof($columnsConditionated) - 1] . " = '" . $this->db->escape_str($valuesConditionated[sizeof($valuesConditionated) - 1]) . "'";

            $this->db->query($query);
        }


        public function delete($tableName, $columnsConditionated, $valuesConditionated)
        {
            $query = "delete from ".$tableName;
            $query = $query." where ";
            for ($i=0; $i < sizeof($columnsConditionated) - 1; $i++) 
            { 
                $query = $query.$columnsConditionated[$i]." = '".$valuesConditionated[$i]. "' and ";
            }
            $query = $query.$columnsConditionated[sizeof($columnsConditionated) - 1]." = '".$valuesConditionated[sizeof($valuesConditionated) - 1]."'";

            $this->db->query($query);
        }
    }
?>