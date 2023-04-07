<?php
	include_once 'C:\xampp\htdocs\mycruds\config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Model\evaluation.php';
	class evaluationC {
		function afficherEvaluation(){
			$sql="SELECT * FROM evaluation";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function supprimerEvaluation($id){
			$sql="DELETE FROM evaluation WHERE id=:id";
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
		function ajouterEvaluation($evaluation){
			$sql="INSERT INTO evaluation (cate, nb_qs, base_qs) 
			VALUES (:cate,:nb_qs,:base_qs)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'cate' => $evaluation->getCate(),
					'nb_qs' => $evaluation->getNbq(),
                    'base_qs' => $evaluation->getBaseQ()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
        function modifierEvaluation($evaluation, $id){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE evaluation SET 
						cate= :cate, 
						nb_qs= :nb_qs,
                        base_qs = :base_qs
					WHERE id= :id'
				);
				$query->execute([
					'cate' => $evaluation->getCate(),
					'nb_qs' => $evaluation->getNbq(),
                    'base_qs' => $evaluation->getBaseQ(),
					'id' => $id
				]);	
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
		function recupererEvaluation($id){
			$sql="SELECT * from evaluation where id=$id";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$evaluation=$query->fetch();
				return $evaluation;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		

	}
?>