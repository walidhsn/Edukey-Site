<?php 
    include_once 'C:\xampp\htdocs\mycruds\config.php';
    include_once 'C:\xampp\htdocs\mycruds\Model\categorie.php';
    class categorieC{
        public function afficher_categorie()
        {
            $sql="SELECT * FROM categorie";
			$db = config::getConnexion();
			try{
				$liste_c = $db->query($sql);
				return $liste_c;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
        }

        public function ajouter_categorie($categorie)
        {
            $sql="insert into categorie (nom_categorie,icon_html) values (:nom_categorie,:icon_html)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $nom_categorie=$categorie->get_nom();
                    $req->bindValue(':nom_categorie',$nom_categorie);
                    $icon_html=$categorie->get_icon_html();
                    $req->bindValue(':icon_html',$icon_html);
                    $req->execute();
            }catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }

        public function supprimer_categorie($id_categorie)
        {
            $sql="DELETE FROM categorie where id_categorie= :id_categorie";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_categorie',$id_categorie);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

        public function modifier_categorie($id_categorie,$categorie)
        {
            try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE categorie SET 
						nom_categorie= :nom_categorie,
                        icon_html= :icon_html
					    WHERE id_categorie= :id_categorie'
				);
				$query->execute([
					'nom_categorie' => $categorie->get_nom(),
                    'icon_html' => $categorie->get_icon_html(),
					'id_categorie' => $id_categorie
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
        }
        public function chercher_categorie($id_categorie)
        {
            $sql="SELECT * FROM categorie where id_categorie = :id_categorie";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_categorie',$id_categorie);
            $stmt->execute();
			$count=$stmt->rowCount();
		    if ($count > 0) {
            $row = $stmt->fetch();
            return $row;
            }
            else return FALSE;
        }
        public function select_all_categorie()
        {
            $sql="SELECT * FROM categorie ";
            $db = config::getConnexion();
            try{
                $liste_c = $db->query($sql);
                $row=$liste_c->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMeesage());
            }
        }
    }
?>