<?php 
    include_once 'C:\xampp\htdocs\mycruds\config.php';
    include_once 'C:\xampp\htdocs\mycruds\Model\Etudiant.php';
    class EtudiantC{
        public function afficher_etudiant()
        {
            $sql="SELECT * FROM etudiants";
			$db = config::getConnexion();
			try{
				$liste_e = $db->query($sql);
				return $liste_e;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
        }

        public function ajouter_etudiant($etud)
        {
            $sql="insert into etudiants (id_etudiant,montant,nb_formation) values (:id_etudiant,:montant,:nb_formation)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $id_etudiant=$etud->get_id_etudiant();
                    $montant=$etud->get_montant();
                    $nb_formation=$etud->get_nb_formation();
                   
                    $req->bindValue(':id_etudiant',$id_etudiant);
                    $req->bindValue(':montant',$montant);
                    $req->bindValue(':nb_formation',$nb_formation);

                    $req->execute();
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }

        public function supprimer_etudiant($id_etudiant)
        {
            $sql="DELETE FROM etudiants where id_etudiant=:id_etudiant";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_etudiant',$id_etudiant);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

        public function modifier_etudiant($id_etudiant,$etud)
        {
            try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE etudiants SET 
						montant= :montant, 
						nb_formation= :nb_formation
					    WHERE id_etudiant= :id_etudiant'
				);
				$query->execute([
					'montant' => $etud->get_montant(),
					'nb_formation' => $etud->get_nb_formation(),
					'id_etudiant' => $id_etudiant
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
        }

        public function chercher_etudiant($id_etudiant)
        {
            $sql="SELECT * FROM etudiants where id_etudiant = :id_etudiant";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_etudiant',$id_etudiant);
            $stmt->execute();
			$count=$stmt->rowCount();
		    if ($count > 0) {
            $row = $stmt->fetch();
            return $row;
            }
            else return FALSE;
        }
    }
?>