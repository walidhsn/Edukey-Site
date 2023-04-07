<?php 
    include_once 'C:\xampp\htdocs\mycruds\config.php';
    include_once 'C:\xampp\htdocs\mycruds\Model\Formateur.php';
    class FormateurC{

        public function afficher_formateur()
        {
            $sql="SELECT * FROM formateurs";
			$db = config::getConnexion();
			try{
				$liste_f = $db->query($sql);
				return $liste_f;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
        }

        public function ajouter_formateur($forma)
        {
            $sql="insert into formateurs (id_formateur,salaire,categorie,taux) values (:id_formateur,:salaire,:categorie,:taux)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $id_formateur=$forma->get_id_formateur();
                    $salaire=$forma->get_salaire();
                    $categorie=$forma->get_categorie();
                    $taux=$forma->get_taux();
                    $req->bindValue(':id_formateur',$id_formateur);
                    $req->bindValue(':salaire',$salaire);
                    $req->bindValue(':categorie',$categorie);
                    $req->bindValue(':taux',$taux);
                    $req->execute();
            }catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }

        public function supprimer_formateur($id_formateur)
        {
            $sql="DELETE FROM formateurs where id_formateur=:id_formateur";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_formateur',$id_formateur);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

        public function modifier_formateur($id_formateur,$forma)
        {
            try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE formateurs SET 
						salaire=:salaire,
                        categorie =:categorie, 
						taux=:taux
					    WHERE id_formateur=:id_formateur'
				);
				$query->execute([
					'salaire' => $forma->get_salaire(),
					'categorie' => $forma->get_categorie(),
                    'taux' => $forma->get_taux(),
					'id_formateur' => $id_formateur
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
        }

        public function chercher_formateur($id_formateur)
        {
            $sql="SELECT * FROM formateurs where id_formateur = :id_formateur";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_formateur',$id_formateur);
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