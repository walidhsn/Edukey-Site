<?php 
    include_once 'C:\xampp\htdocs\mycruds\config.php';
    include_once 'C:\xampp\htdocs\mycruds\Model\formation.php';
    class FormationC{
        public function afficher_formation()
        {
            $sql="SELECT * FROM formations";
			$db = config::getConnexion();
			try{
				$liste_f = $db->query($sql);
				return $liste_f;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
        }

        public function ajouter_formation($formation)
        {
            $sql="insert into formations (nom,categorie,nb_cour,temp,prix,taux,date_creation,description,editor) values (:nom,:categorie,:nb_cour,:temp,:prix,:taux,:date_creation,:description,:editor)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $nom=$formation->get_nom();
                    $categorie=$formation->get_categorie();
                    $nb_cour=$formation->get_nb_cour();
                    $temp=$formation->get_temp();
                    $prix=$formation->get_prix();
                    $taux=$formation->get_taux();
                    $date_creation=$formation->get_date_creation();
                    $description=$formation->get_description();
                    $editor=$formation->get_editor();
                    $req->bindValue(':nom',$nom);
                    $req->bindValue(':categorie',$categorie);
                    $req->bindValue(':nb_cour',$nb_cour);
                    $req->bindValue(':temp',$temp);
                    $req->bindValue(':prix',$prix);
                    $req->bindValue(':taux',$taux);
                    $req->bindValue(':date_creation',$date_creation);
                    $req->bindValue(':description',$description);
                    $req->bindValue(':editor',$editor);
                    $req->execute();
            }catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }

        public function supprimer_formation($id_formation)
        {
            $sql="DELETE FROM formations where id_formation= :id_formation";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_formation',$id_formation);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

        public function modifier_formation($id_formation,$formation)
        {
            try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE formations SET 
						nom= :nom,
						categorie= :categorie,
                        nb_cour= :nb_cour,
                        temp= :temp,
                        prix= :prix,
                        taux= :taux,
                        description= :description,
                        editor = :editor
					    WHERE id_formation= :id_formation'
				);
				$query->execute([
					'nom' => $formation->get_nom(),
					'categorie' => $formation->get_categorie(),
                    'nb_cour' => $formation->get_nb_cour(),
                    'temp' => $formation->get_temp(),
                    'prix' => $formation->get_prix(),
                    'taux' => $formation->get_taux(),
                    'description' => $formation->get_description(),
                    'editor' => $formation->get_editor(),
					'id_formation' => $id_formation
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
        }
        public function chercher_par_categorie($nom_categorie)
        {
            $sql="SELECT * FROM formations WHERE categorie = '$nom_categorie' ";
            $db = config::getConnexion();
            try{
                $liste_t = $db->query($sql);
                $row=$liste_t->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
        public function chercher_par_editor($keyword)
        {
            $sql="SELECT * FROM formations WHERE editor = '$keyword' ";
            $db = config::getConnexion();
            try{
                $liste_t = $db->query($sql);
                $row=$liste_t->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
        public function chercher_par_prix($keyword)
        {
            $sql="SELECT * FROM formations WHERE prix = '$keyword' ";
            $db = config::getConnexion();
            try{
                $liste_t = $db->query($sql);
                $row=$liste_t->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
        public function chercher_par_nom($keyword)
        {
            $sql="SELECT * FROM formations WHERE nom = '$keyword' ";
            $db = config::getConnexion();
            try{
                $liste_t = $db->query($sql);
                $row=$liste_t->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
        public function chercher_glob($search_keyword)
        {
            $query = 'SELECT * FROM formations WHERE nom LIKE :keyword OR editor LIKE :keyword OR editor LIKE :keyword OR description LIKE :keyword ORDER BY id_formation DESC '; 
            $pdo_conn = config::getConnexion();
            $pdo_statement = $pdo_conn->prepare($query); 
            $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR); 
            $pdo_statement->execute(); 
            if(!$pdo_statement->rowCount()){ 
            //if the results is null 
            echo "no result found";
            }else{ 
            //found some row according to your search 
            //do some operations based on your application 
             return $result = $pdo_statement->fetchAll(); 
            }
        }
        public function chercher_formation($id_formation)
        {
            $sql="SELECT * FROM formations where id_formation = :id_formation";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_formation',$id_formation);
            $stmt->execute();
			$count=$stmt->rowCount();
		    if ($count > 0) {
            $row = $stmt->fetch();
            return $row;
            }
            else return FALSE;
        }

        public function select_lastest_formation()
        {
            $sql="SELECT * FROM (SELECT * FROM formations ORDER BY id_formation DESC LIMIT 3 ) as r ORDER BY id_formation";
            $db = config::getConnexion();
            try{
                $liste_a = $db->query($sql);
                $row=$liste_a->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
        //**** PARTIE IMAGE FORMATION :

        public function upload_img($id_formation,$imgName,$imgPath,$img_type)
        {
            $sql="insert into formation_image (id_imgf,name_img,type,img) values (:id_imgf,:name_img,:type,:img)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $req->bindValue(':id_imgf',$id_formation);
                    $req->bindValue(':name_img',$imgName);
                    $req->bindValue(':type',$img_type);
                    $req->bindValue(':img',$imgPath);

                    $req->execute();
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
        
        public function display_img($imgID)
        {
            $sql="SELECT * FROM formation_image where id_imgf = :id_imgf";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_imgf',$imgID);
            $stmt->execute();
			$count=$stmt->rowCount();
		    if ($count > 0) {
            $row = $stmt->fetch();
            return $row;
            }
            else return FALSE;
        }

        public function supprimer_img($imgID)
        {
            $sql="DELETE FROM formation_image where id_imgf=:id_imgf";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_imgf',$imgID);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }
    }
?>