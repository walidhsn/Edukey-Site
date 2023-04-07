<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Model\reclamation.php';
	class reclamationC {
		function afficherReclamation(){
			$sql="SELECT * FROM reclamation";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function supprimerReclamation($id){
			$sql="DELETE FROM reclamation WHERE id=:id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id', $id);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function ajouterReclamation($reclamation){
			$sql="INSERT INTO reclamation (titre, contenue, nom_immuteur, nom_recepteur) 
			VALUES (:titre,:contenue,:nom_immuteur, :nom_recepteur)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'titre' => $reclamation->getTitre(),
					'contenue' => $reclamation->getContenue(),
                    'nom_immuteur' => $reclamation->getImmuteur(),
                    'nom_recepteur' => $reclamation->getRecepteur()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
        function modifierReclamation($reclamation, $id){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE reclamation SET 
						titre= :titre, 
						contenue= :contenue,
                        nom_immuteur= :nom_immuteur,
                        nom_recepteur= :nom_recepteur
					WHERE id= :id'
				);
				$query->execute([
					'titre' => $reclamation->getTitre(),
					'contenue' => $reclamation->getContenue(),
                    'nom_immuteur' => $reclamation->getImmuteur(),
                    'nom_recepteur' => $reclamation->getRecepteur(),
					'id' => $id
				]);	
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
		function recupererReclamation($id){
			$sql="SELECT * from reclamation where id=$id";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$reclamation=$query->fetch();
				return $reclamation;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

	}
?>